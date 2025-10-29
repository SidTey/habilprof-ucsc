<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Habilitacion extends Model
{
    protected $primaryKey = 'id_habilitacion';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_habilitacion',
        'descripcion_habilitacion',
        'tipo_habilitacion',
    ];

    // Relación con alumno
    public function alumno()
    {
        return $this->belongsTo(Alumno::class, 'rut_alumno', 'rut_alumno');
    }

    // Relación con profesores (según rol)
    public function profesorGuia()
    {
        return $this->belongsTo(Profesor::class, 'rut_profesor_guia', 'rut_profesor');
    }
}
