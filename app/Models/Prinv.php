<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prinv extends Model
{
    protected $table = 'prinv';
    protected $primaryKey = 'id_habilitacion';
    public $incrementing = true;
    protected $keyType = 'varchar';

    protected $fillable = [
        'id_habilitacion',
        'titulo_proy',
    ];

    // Relación inversa con HabilitacionProfesional
    public function habilitacionProfesional()
    {
        return $this->belongsTo(HabilitacionProfesional::class, 'id_habilitacion', 'id_habilitacion');
    }
}
