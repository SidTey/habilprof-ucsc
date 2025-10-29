<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prinv extends Model
{
    protected $table = 'practica_nivelacion';
    protected $primaryKey = 'id_practica_nivelacion';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'id_habilitacion',
        'fecha_inicio',
        'fecha_termino',
        'nota',
        'observaciones'
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_termino' => 'date',
        'nota' => 'decimal:2'
    ];

    // Relación inversa con HabilitacionProfesional
    public function habilitacionProfesional()
    {
        return $this->belongsTo(HabilitacionProfesional::class, 'id_habilitacion', 'id_habilitacion');
    }
}
