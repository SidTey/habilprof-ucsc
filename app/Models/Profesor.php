<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Profesor extends Authenticatable
{
    use Notifiable;
    protected $table = 'profesor';
    protected $primaryKey = 'rut_profesor';
    public $timestamps = false;
    public $incrementing = false;
    protected $keyType = 'int';

    protected $fillable = [
        'rut_profesor',
        'nombre_profesor',
        'correo_profesor',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    /**
     * Reglas de validación según requisitos R1.4, R1.5, R1.7
     */

    public function username()
    {
        return 'rut_profesor';
    }
    public static function validationRules()
    {
        return [
            'rut_profesor' => 'required|integer|min:10000000|max:60000000|unique:profesor,rut_profesor',
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
