<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginProfesorController;

/*
|--------------------------------------------------------------------------
| Rutas Web
|--------------------------------------------------------------------------
*/

// --- RUTAS DE AUTENTICACIÓN (PARA REACT) ---
// Las ponemos dentro de un prefijo '/api' para que coincidan
// con la configuración de Axios en tu App.jsx
Route::prefix('api')->group(function () {

    // Ruta de Login: /api/login
    Route::post('/login', [LoginProfesorController::class, 'store'])->name('login');

    // Rutas que requieren estar logueado (auth:profesor)
    Route::middleware('auth:profesor')->group(function () {
        // Ruta de Logout: /api/logout
        Route::post('/logout', [LoginProfesorController::class, 'destroy'])->name('logout');

        // Ruta para verificar quién está logueado: /api/user
        Route::get('/user', [LoginProfesorController::class, 'user'])->name('user');

        // Aquí irán tus otras rutas de API seguras
        // (Probablemente ya las tengas en routes/api.php, lo cual está bien)
    });
});


// --- RUTA "CATCH-ALL" PARA REACT ---
// Esta ruta carga tu app de React. Debe ir AL FINAL.
Route::get('/{any?}', function () {
    return view('welcome'); // Carga resources/views/welcome.blade.php
})->where('any', '.*');
