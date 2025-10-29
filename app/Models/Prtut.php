<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prtut extends Model
{
    protected $table = 'prtut';
    protected $primaryKey = 'id_habilitacion';
    public $incrementing = true;
    protected $keyType = 'varchar';

    protected $fillable = [
        'id_habilitacion',
        'rut_empresa',
        'rut_supervisor',
    ];


    // Relación inversa con HabilitacionProfesional
    public function habilitacionProfesional()
    {
        return $this->belongsTo(HabilitacionProfesional::class, 'id_habilitacion', 'id_habilitacion');
    }
}
