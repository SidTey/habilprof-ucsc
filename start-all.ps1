# Script maestro para iniciar todo el sistema HabilProf
# Inicia Laravel y Vite en ventanas separadas

Write-Host "============================================" -ForegroundColor Cyan
Write-Host "  Sistema HabilProf - Inicio Completo      " -ForegroundColor Cyan
Write-Host "============================================" -ForegroundColor Cyan
Write-Host ""

# Verificar que estamos en el directorio correcto
if (-not (Test-Path "composer.json")) {
    Write-Host "ERROR: Ejecuta este script desde la carpeta raiz del proyecto" -ForegroundColor Red
    Pause
    Exit 1
}

Write-Host "Iniciando servidores..." -ForegroundColor Yellow
Write-Host ""

# Iniciar servidor Laravel en nueva ventana
Write-Host "[1/2] Iniciando servidor Laravel..." -ForegroundColor Cyan
Start-Process powershell -ArgumentList "-NoExit", "-ExecutionPolicy", "Bypass", "-Command", "& '.\start-server.ps1'"

Start-Sleep -Seconds 2

# Iniciar servidor Vite en nueva ventana
Write-Host "[2/2] Iniciando servidor Vite..." -ForegroundColor Cyan
Start-Process powershell -ArgumentList "-NoExit", "-ExecutionPolicy", "Bypass", "-Command", "& '.\start-vite.ps1'"

Start-Sleep -Seconds 2

Write-Host ""
Write-Host "============================================" -ForegroundColor Green
Write-Host "  Servidores Iniciados                     " -ForegroundColor Green
Write-Host "============================================" -ForegroundColor Green
Write-Host ""
Write-Host "Laravel (Backend):" -ForegroundColor Cyan
Write-Host "  http://127.0.0.1:8000" -ForegroundColor White
Write-Host ""
Write-Host "Vite (Frontend):" -ForegroundColor Cyan
Write-Host "  http://localhost:5173 (puerto por defecto)" -ForegroundColor White
Write-Host ""
Write-Host "Para detener los servidores:" -ForegroundColor Yellow
Write-Host "  Cierra las ventanas de PowerShell que se abrieron" -ForegroundColor White
Write-Host "  o presiona Ctrl+C en cada una" -ForegroundColor White
Write-Host ""
Write-Host "Comandos utiles:" -ForegroundColor Cyan
Write-Host "  php artisan ucsc:carga-automatica  # Ejecutar carga de datos" -ForegroundColor White
Write-Host "  php artisan route:list             # Ver rutas API" -ForegroundColor White
Write-Host "  php artisan migrate:fresh          # Recrear base de datos" -ForegroundColor White
Write-Host ""

Pause
