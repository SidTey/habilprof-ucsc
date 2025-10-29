<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supervisor extends Model
{
    protected $table = 'supervisor';
    protected $primaryKey = 'rut_supervisor';
    public $timestamps = false;

    protected $fillable = [
        'rut_supervisor',
        'nombre_supervisor',
        'rut_empresa',

    ];

    /**
     * Reglas de validación según requisitos R1.1, R1.2, R1.3
     */
    public static function validationRules()
    {
        return [
            'rut_supervisor' => 'required|integer|min:1000000|max:60000000|unique:alumnos,rut_alumno',
            'nombre_supervisor' => 'required|string|max:100|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/',
            'rut_empresa' => 'required|integer|min:1000000|max:60000000|unique:alumnos,rut_alumno',

        ];
    }

    /**
     * Relación con registros UCSC
     */
    public function registrosUcsc()
    {
        return $this->hasMany(RegistroUcsc::class);
    }
}
