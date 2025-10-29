<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Alumno;
use App\Models\Profesor;
use App\Models\RegistroUcsc;

class PruebaSeeder extends Seeder
{
    public function run()
    {
        // Crear alumno de prueba
        $alumno = Alumno::create([
            'rut_alumno' => 12345678,
            'nombre_alumno' => 'Alumno de Prueba',
            'correo_alumno' => 'alumno@ucsc.cl'
        ]);

        // Crear profesor de prueba
        $profesor = Profesor::create([
            'rut_profesor' => 12345678,
            'nombre_profesor' => 'Profesor de Prueba',
            'correo_profesor' => 'profesor@ucsc.cl'
        ]);

        // Crear registro UCSC
        RegistroUcsc::create([
            'alumno_id' => $alumno->id,
            'profesor_id' => $profesor->id,
            'fecha_ingreso' => now(),
            'nota_final' => 6.5
        ]);
    }
}