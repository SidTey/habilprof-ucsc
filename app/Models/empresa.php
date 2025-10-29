<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class empresa extends Model
    {
        protected $table = 'empresa';
        protected $primaryKey = 'rut_empresa';
        public $timestamps = false;
        public $incrementing = false;

        protected $keyType = 'int';
        protected $fillable = [
            'rut_empresa',
            'nombre_empresa',

        ];

        /**
         * Reglas de validación según requisitos R1.4, R1.5, R1.7
         */
        public static function validationRules()
        {
            return [
                'rut_empresa' => 'required|integer|min:10000000|max:60000000|unique:empresa,rut_empresa',
                'nombre_empresa' => 'required|string|max:100|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/',

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
