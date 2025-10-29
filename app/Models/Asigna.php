<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Asigna extends Model
{
    protected $table = 'asigna';
    protected $primaryKey = ['id_habilitacion', 'rut_profesor'];
    public $incrementing = false;
    public $timestamps = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_habilitacion',
        'rut_profesor',
        'rol'
    ];

    public static function validationRules($data)
    {
        return [
            'id_habilitacion' => [
                'required',
                'string', // Es un string, no un integer
                'exists:habilitacion_profesional,id_habilitacion' // Debe existir
            ],
            'rut_profesor' => [
                'required',
                'integer',
                'min:10000000',
                'max:60000000',
                'exists:profesores,rut_profesor', // Debe existir en la tabla profesores

                // 2. REGLA DE UNICIDAD COMPUESTA
                // El rut_profesor debe ser único EN COMBINACIÓN con id_habilitacion
                Rule::unique('asigna')->where(function ($query) use ($data) {
                    // Asegurarse de que id_habilitacion esté presente en los datos
                    if (isset($data['id_habilitacion'])) {
                        return $query->where('id_habilitacion', $data['id_habilitacion']);
                    }
                    return $query;
                }),
            ],
            'rol' => 'required|string|max:50' // También deberías validar el rol
        ];
    }

    public function habilitacion()
    {
        return $this->belongsTo(HabilitacionProfesional::class, 'id_habilitacion', 'id_habilitacion');
    }

    public function profesor()
    {
        return $this->belongsTo(Profesor::class, 'rut_profesor', 'rut_profesor');
    }
}
