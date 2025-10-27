<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // No hay seeders configurados para el sistema HabilProf
        // Los datos se cargan desde los sistemas UCSC mediante el comando:
        // php artisan ucsc:carga-automatica
    }
}
