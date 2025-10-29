<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pring extends Model
{
    protected $table = 'practica_ingenieria';
    protected $primaryKey = 'id_practica_ingenieria';
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
