# Script para iniciar el servidor Laravel con el PATH correcto
# Configurar PATH con todas las herramientas necesarias
$env:Path = [System.Environment]::GetEnvironmentVariable('Path','Machine') + ';' + [System.Environment]::GetEnvironmentVariable('Path','User') + ';C:\ProgramData'

Write-Host "============================================" -ForegroundColor Cyan
Write-Host "  Sistema HabilProf - Servidor Laravel     " -ForegroundColor Cyan
Write-Host "============================================" -ForegroundColor Cyan
Write-Host ""

# Verificar que PHP esté disponible
$phpVersion = php -v 2>&1 | Select-String -Pattern "PHP (\d+\.\d+\.\d+)" | ForEach-Object { $_.Matches.Groups[1].Value }
if ($phpVersion) {
    Write-Host "PHP Version: $phpVersion" -ForegroundColor Green
} else {
    Write-Host "ERROR: PHP no encontrado" -ForegroundColor Red
    Write-Host "Ejecuta primero:" -ForegroundColor Yellow
    Write-Host '$env:Path = [System.Environment]::GetEnvironmentVariable(''Path'',''Machine'') + '';'' + [System.Environment]::GetEnvironmentVariable(''Path'',''User'') + '';C:\ProgramData''' -ForegroundColor White
    Pause
    Exit 1
}

Write-Host ""
Write-Host "Iniciando servidor Laravel..." -ForegroundColor Yellow
Write-Host "URL: http://127.0.0.1:8000" -ForegroundColor Cyan
Write-Host ""
Write-Host "Presiona Ctrl+C para detener el servidor" -ForegroundColor Gray
Write-Host ""

# Iniciar servidor
php artisan serve --host=127.0.0.1 --port=8000
