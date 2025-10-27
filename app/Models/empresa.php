<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table = 'empresa';
    protected $fillable = ['rut_empresa','nombre_empresa'];

    protected $casts = [
        'rut_empresa' => 'integer',
        'nombre_empresa'=> 'varchar',
    ];
}
