<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\UcscDataController;
use App\Services\UcscApiService;
use App\Models\LogSistema;
use Illuminate\Http\Request;

class CargaAutomaticaUcsc extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ucsc:carga-automatica';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ejecuta la carga automática de datos desde sistemas UCSC según R1.15';

    private $ucscController;

    public function __construct()
    {
        parent::__construct();
        $this->ucscController = new UcscDataController(new UcscApiService());
    }

    /**
     * Execute the console command.
     * R1.15: Este proceso se activará automáticamente cada minuto
     */
    public function handle()
    {
        $this->info('Iniciando carga automática de datos UCSC...');

        try {
            // Verificar conexión con sistema UCSC
            $ucscService = new UcscApiService();
            if (!$ucscService->verificarConexion()) {
                $this->error('No se ha podido establecer conexión con los sistemas UCSC');
                return Command::FAILURE;
            }

            // Simular datos de entrada para prueba
            // En producción, estos datos vendrían desde un archivo, cola o API externa
            $datosPrueba = $this->obtenerDatosPendientes();

            $procesados = 0;
            $errores = 0;

            foreach ($datosPrueba as $datos) {
                try {
                    $request = new Request($datos);
                    $response = $this->ucscController->procesarCargaAutomatica($request);
                    
                    $responseContent = $response->getContent();
                    $responseData = json_decode($responseContent, true);
                    
                    if ($response->getStatusCode() === 200 && ($responseData['success'] ?? false)) {
                        $procesados++;
                        $this->line("✓ Procesado: RUT Alumno {$datos['rut_alumno']}, RUT Profesor {$datos['rut_profesor']}");
                    } else {
                        $errores++;
                        $errorMsg = $responseData['message'] ?? 'Error desconocido';
                        $this->error("✗ Error procesando: RUT Alumno {$datos['rut_alumno']}, RUT Profesor {$datos['rut_profesor']} - {$errorMsg}");
                    }
                } catch (\Exception $e) {
                    $errores++;
                    $this->error("✗ Excepción: " . $e->getMessage());
                    $this->error("Archivo: " . $e->getFile() . " Línea: " . $e->getLine());
                    LogSistema::crearLogError($datos, $e->getMessage());
                }
            }

            $this->info("Carga completada: {$procesados} registros procesados, {$errores} errores");
            return Command::SUCCESS;

        } catch (\Exception $e) {
            $this->error('Error en carga automática: ' . $e->getMessage());
            return Command::FAILURE;
        }
    }

    /**
     * Obtener datos pendientes de procesar
     * En producción, esto vendría desde una cola, archivo CSV, o API externa
     */
    private function obtenerDatosPendientes()
    {
        // Datos de ejemplo para demostración
        return [
            [
                'rut_alumno' => 12345678,
                'rut_profesor' => 11222333,
                'fecha_ingreso' => '2025-03-15', // Formato correcto YYYY-MM-DD
                'nota_final' => 6.5
            ],
            [
                'rut_alumno' => 23456789,
                'rut_profesor' => 44555666,
                'fecha_ingreso' => '2025-03-15', // Formato correcto YYYY-MM-DD
                'nota_final' => null
            ]
        ];
    }
}
