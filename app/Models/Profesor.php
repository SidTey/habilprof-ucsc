<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    protected $table = 'profesores';
    
    protected $fillable = [
        'rut_profesor',
        'nombre_profesor', 
        'correo_profesor'
    ];

    /**
     * Reglas de validación según requisitos R1.4, R1.5, R1.7
     */
    public static function validationRules()
    {
        return [
            'rut_profesor' => 'required|integer|min:10000000|max:60000000|unique:profesores,rut_profesor',
            'nombre_profesor' => 'required|string|max:100|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/',
            'correo_profesor' => 'required|string|max:255|email'
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
