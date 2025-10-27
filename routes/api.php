<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UcscDataController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Rutas para funcionalidad R1: Carga automática de datos desde sistemas UCSC
Route::prefix('ucsc')->group(function () {
    // R1: Procesar carga automática de datos
    Route::post('/carga-automatica', [UcscDataController::class, 'procesarCargaAutomatica']);
    
    // Obtener registros UCSC
    Route::get('/registros', [UcscDataController::class, 'obtenerRegistros']);
    
    // Obtener logs del sistema (R1.13)
    Route::get('/logs', [UcscDataController::class, 'obtenerLogs']);
});
