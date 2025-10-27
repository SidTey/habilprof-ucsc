# Script para iniciar el servidor de desarrollo Vite
# Configurar PATH con todas las herramientas necesarias
$env:Path = [System.Environment]::GetEnvironmentVariable('Path','Machine') + ';' + [System.Environment]::GetEnvironmentVariable('Path','User')

Write-Host "============================================" -ForegroundColor Cyan
Write-Host "  Sistema HabilProf - Vite Dev Server      " -ForegroundColor Cyan
Write-Host "============================================" -ForegroundColor Cyan
Write-Host ""

# Verificar que Node esté disponible
$nodeVersion = node -v 2>&1
if ($nodeVersion) {
    Write-Host "Node.js Version: $nodeVersion" -ForegroundColor Green
} else {
    Write-Host "ERROR: Node.js no encontrado" -ForegroundColor Red
    Pause
    Exit 1
}

Write-Host ""
Write-Host "Iniciando Vite en modo desarrollo..." -ForegroundColor Yellow
Write-Host "Hot reload activado para cambios en React" -ForegroundColor Cyan
Write-Host ""
Write-Host "Presiona Ctrl+C para detener el servidor" -ForegroundColor Gray
Write-Host ""

# Iniciar Vite
npm run dev
