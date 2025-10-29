<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\HabilitacionProfesional;
use App\Models\Alumno;
use App\Models\Profesor;
use App\Models\Empresa;
use App\Models\Supervisor;
use App\Models\Asigna;
use App\Models\Pring;
use App\Models\Prniv;

class HabilitacionProfesionalController extends Controller
{
    /**
     * Obtener lista de alumnos disponibles (R2.19)
     */
    public function getAlumnosDisponibles()
    {
        $alumnos = Alumno::select('rut_alumno', 'nombre_alumno')->get();
        return response()->json([
            'success' => true,
            'data' => $alumnos
        ]);
    }

    /**
     * Obtener lista de profesores disponibles
     */
    public function getProfesoresDisponibles(Request $request)
    {
        $idHabilitacion = $request->input('id_habilitacion');
        
        // Excluir profesores ya asignados a esta habilitación
        $profesoresAsignados = Asigna::where('id_habilitacion', $idHabilitacion)
            ->pluck('rut_profesor');

        $profesores = Profesor::select('rut_profesor', 'nombre_profesor')
            ->whereNotIn('rut_profesor', $profesoresAsignados)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $profesores
        ]);
    }

    /**
     * Crear nueva habilitación profesional
     */
    public function store(Request $request)
    {
        // Validación inicial según R2.16 (campos obligatorios)
        $validator = Validator::make($request->all(), [
            'rut_alumno' => 'required|integer|min:1000000|max:60000000',
            'tipo_habilitacion' => 'required|string|size:5|in:PrIng,PrInv,PrTut',
            'descripcion_habilitacion' => 'required|string|min:50|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();

            // Generar ID_Habilitacion según R2.24
            $ano = date('Y');
            $mes = date('n');
            $semestre = ($mes >= 1 && $mes <= 7) ? 1 : 2;
            $idHabilitacion = $request->rut_alumno . "_" . $ano . "_" . $semestre;

            // Crear habilitación profesional
            $habilitacion = new HabilitacionProfesional();
            $habilitacion->id_habilitacion = $idHabilitacion;
            $habilitacion->rut_alumno = $request->rut_alumno;
            $habilitacion->descripcion_habilitacion = $request->descripcion_habilitacion;
            $habilitacion->ano_semestre = $ano;
            $habilitacion->numero_semestre = $semestre;
            $habilitacion->save();

            // Procesar según tipo de habilitación
            if (in_array($request->tipo_habilitacion, ['PrIng', 'PrInv'])) {
                $this->procesarPracticaIngenieriaInvestigacion($request, $habilitacion);
            } else {
                $this->procesarPracticaTutorial($request, $habilitacion);
            }

            DB::commit();

            // Cargar relaciones para la respuesta
            $habilitacion->load(['alumno', 'asignaciones.profesor']);

            return response()->json([
                'success' => true,
                'message' => 'Se ha ingresado correctamente la Habilitacion Profesional',
                'data' => $habilitacion
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Procesar habilitación tipo PrIng o PrInv
     */
    private function procesarPracticaIngenieriaInvestigacion($request, $habilitacion)
    {
        // Validaciones específicas
        $validator = Validator::make($request->all(), [
            'titulo_proyecto' => 'required|string|min:3|max:100',
            'rut_profesor_guia' => 'required|integer|min:10000000|max:60000000',
            'rut_profesor_comision' => 'required|integer|min:10000000|max:60000000',
            'rut_profesor_co_guia' => 'nullable|integer|min:10000000|max:60000000',
        ]);

        if ($validator->fails()) {
            throw new \Exception('Datos inválidos para práctica de ingeniería/investigación');
        }

        // Crear registro en tabla pring o prniv según corresponda
        if ($request->tipo_habilitacion === 'PrIng') {
            Pring::create([
                'id_habilitacion' => $habilitacion->id_habilitacion,
                'titulo_proy' => $request->titulo_proyecto
            ]);
        } else {
            Prniv::create([
                'id_habilitacion' => $habilitacion->id_habilitacion,
                'titulo_proy' => $request->titulo_proyecto
            ]);
        }

        // Asignar profesores
        $this->asignarProfesor($habilitacion->id_habilitacion, $request->rut_profesor_guia, 'Profesor_Guia');
        $this->asignarProfesor($habilitacion->id_habilitacion, $request->rut_profesor_comision, 'Profesor_Comision');
        
        if ($request->has('rut_profesor_co_guia')) {
            $this->asignarProfesor($habilitacion->id_habilitacion, $request->rut_profesor_co_guia, 'Profesor_Co_Guia');
        }
    }

    /**
     * Procesar habilitación tipo PrTut
     */
    private function procesarPracticaTutorial($request, $habilitacion)
    {
        // Validaciones específicas
        $validator = Validator::make($request->all(), [
            'rut_supervisor' => 'required|integer|min:1000000|max:60000000',
            'nombre_supervisor' => 'required|string|max:100',
            'rut_empresa' => 'required|integer|min:1000000|max:60000000',
            'nombre_empresa' => 'required|string|max:100',
            'rut_profesor_tutor' => 'required|integer|min:10000000|max:60000000',
        ]);

        if ($validator->fails()) {
            throw new \Exception('Datos inválidos para práctica tutorial');
        }

        // Crear o actualizar empresa
        $empresa = Empresa::updateOrCreate(
            ['rut_empresa' => $request->rut_empresa],
            ['nombre_empresa' => $request->nombre_empresa]
        );

        // Crear o actualizar supervisor
        $supervisor = Supervisor::updateOrCreate(
            ['rut_supervisor' => $request->rut_supervisor],
            [
                'nombre_supervisor' => $request->nombre_supervisor,
                'rut_empresa' => $empresa->rut_empresa
            ]
        );

        // Asignar profesor tutor
        $this->asignarProfesor($habilitacion->id_habilitacion, $request->rut_profesor_tutor, 'Profesor_Tutor');
    }

    /**
     * Asignar profesor a habilitación
     */
    private function asignarProfesor($idHabilitacion, $rutProfesor, $rol)
    {
        return Asigna::create([
            'id_habilitacion' => $idHabilitacion,
            'rut_profesor' => $rutProfesor,
            'rol' => $rol
        ]);
    }

    /**
     * Obtener lista de habilitaciones profesionales
     */
    public function index()
    {
        $habilitaciones = HabilitacionProfesional::with([
            'alumno',
            'asignaciones.profesor',
            'practica_ingenieria',
            'practica_nivelacion'
        ])->get();

        // Agregar el tipo de habilitación basado en las relaciones
        $habilitaciones = $habilitaciones->map(function ($habilitacion) {
            $data = $habilitacion->toArray();
            if ($habilitacion->practica_ingenieria) {
                $data['tipo_habilitacion'] = 'PrIng';
            } elseif ($habilitacion->practica_nivelacion) {
                $data['tipo_habilitacion'] = 'PrInv';
            } else {
                $data['tipo_habilitacion'] = 'PrTut';
            }
            return $data;
        });

        return response()->json([
            'success' => true,
            'data' => $habilitaciones
        ]);
    }
}