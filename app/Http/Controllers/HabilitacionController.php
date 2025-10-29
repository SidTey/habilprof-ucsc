<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHabilitacionRequest;
use App\Models\Habilitacion;
use App\Models\Alumno;
use Illuminate\Http\JsonResponse;

class HabilitacionController extends Controller
{
    public function store(StoreHabilitacionRequest $request): JsonResponse
    {
        $data = $request->validated();

        // Verificar alumno
        $alumno = Alumno::where('rut_alumno', $data['rut_alumno'])->first();
        if (!$alumno) {
            return response()->json(['message' => 'El Rut_Alumno no existe en el sistema'], 422);
        }

        // Generar semestre automáticamente
        $month = now()->month;
        $sem = ($month >= 1 && $month <= 7) ? 1 : 2;
        $semestre_inicio = now()->year . "-{$sem}";

        // Generar ID_Habilitacion
        $id = "{$data['rut_alumno']}_{$semestre_inicio}";

        $hab = Habilitacion::create([
            'id_habilitacion'        => $id,
            'descripcion_habilitacion' => $data['descripcion_habilitacion'],
            'tipo_habilitacion'      => $data['tipo_habilitacion'],
        ]);

        return response()->json([
            'message' => 'Se ha ingresado correctamente la Habilitación Profesional',
            'habilitacion' => $hab,
        ], 201);
    }
}
