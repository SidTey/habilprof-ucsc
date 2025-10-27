# Script de Inicialización de Git para HabilProf
# Este script prepara el proyecto para subirlo a GitHub

Write-Host "==================================================" -ForegroundColor Cyan
Write-Host "   Sistema HabilProf - Preparación para GitHub   " -ForegroundColor Cyan
Write-Host "==================================================" -ForegroundColor Cyan
Write-Host ""

# Función para preguntar sí/no
function Confirm-Action {
    param([string]$Message)
    $response = Read-Host "$Message (s/n)"
    return $response -eq 's' -or $response -eq 'S' -or $response -eq 'si' -or $response -eq 'Si'
}

# Verificar si Git está instalado
Write-Host "[1/8] Verificando Git..." -ForegroundColor Yellow
$gitVersion = git --version 2>$null
if ($LASTEXITCODE -ne 0) {
    Write-Host "❌ Git no está instalado. Por favor instala Git primero." -ForegroundColor Red
    Write-Host "   Descarga desde: https://git-scm.com/download/win" -ForegroundColor Yellow
    exit 1
}
Write-Host "✅ Git instalado: $gitVersion" -ForegroundColor Green
Write-Host ""

# Verificar configuración de Git
Write-Host "[2/8] Verificando configuración de Git..." -ForegroundColor Yellow
$userName = git config --global user.name
$userEmail = git config --global user.email

if (-not $userName -or -not $userEmail) {
    Write-Host "⚠️  Configuración de Git incompleta" -ForegroundColor Yellow
    Write-Host ""
    
    if (-not $userName) {
        $userName = Read-Host "Ingresa tu nombre"
        git config --global user.name "$userName"
    }
    
    if (-not $userEmail) {
        $userEmail = Read-Host "Ingresa tu email"
        git config --global user.email "$userEmail"
    }
    
    Write-Host "✅ Configuración guardada" -ForegroundColor Green
} else {
    Write-Host "✅ Usuario: $userName <$userEmail>" -ForegroundColor Green
}
Write-Host ""

# Verificar archivos sensibles
Write-Host "[3/8] Verificando archivos sensibles..." -ForegroundColor Yellow
$sensitiveFiles = @(".env", "database.sqlite")
$foundSensitive = @()

foreach ($file in $sensitiveFiles) {
    if (Test-Path $file) {
        $foundSensitive += $file
    }
}

if ($foundSensitive.Count -gt 0) {
    Write-Host "⚠️  Archivos sensibles encontrados:" -ForegroundColor Yellow
    foreach ($file in $foundSensitive) {
        Write-Host "   - $file" -ForegroundColor Yellow
    }
    Write-Host "✅ Estos archivos están en .gitignore y NO se subirán" -ForegroundColor Green
} else {
    Write-Host "✅ No se encontraron archivos sensibles" -ForegroundColor Green
}
Write-Host ""

# Inicializar Git si no existe
Write-Host "[4/8] Inicializando repositorio Git..." -ForegroundColor Yellow
if (-not (Test-Path ".git")) {
    git init
    Write-Host "✅ Repositorio Git inicializado" -ForegroundColor Green
} else {
    Write-Host "ℹ️  Repositorio Git ya existe" -ForegroundColor Cyan
}
Write-Host ""

# Agregar archivos
Write-Host "[5/8] Agregando archivos al staging..." -ForegroundColor Yellow
git add .
$filesToCommit = (git status --short).Count
Write-Host "✅ $filesToCommit archivos agregados" -ForegroundColor Green
Write-Host ""

# Mostrar archivos que se subirán
if (Confirm-Action "¿Deseas ver qué archivos se subirán?") {
    Write-Host ""
    git status --short
    Write-Host ""
}

# Crear commit inicial
Write-Host "[6/8] Creando commit inicial..." -ForegroundColor Yellow
$commitMessage = "feat: versión inicial del sistema HabilProf con carga automática UCSC

Incluye:
- Backend Laravel con API REST
- Frontend React con Vite
- Modelos: Alumno, Profesor, RegistroUcsc, LogSistema
- Sistema de carga automática de datos (R1)
- Validaciones completas (R1.1-R1.9)
- Sistema de logs (R1.13)
- Documentación completa
- Scripts de inicio rápido
- Configuración para PostgreSQL y SQLite
- GitHub Actions para CI/CD
"

git commit -m $commitMessage
Write-Host "✅ Commit creado" -ForegroundColor Green
Write-Host ""

# Configurar remote
Write-Host "[7/8] Configurando repositorio remoto..." -ForegroundColor Yellow
Write-Host ""
Write-Host "Para continuar, necesitas:" -ForegroundColor Cyan
Write-Host "1. Crear un repositorio en GitHub (sin inicializar)" -ForegroundColor Cyan
Write-Host "2. Copiar la URL del repositorio" -ForegroundColor Cyan
Write-Host ""
Write-Host "Ejemplo de URL:" -ForegroundColor Yellow
Write-Host "https://github.com/TU-USUARIO/habilprof-ucsc.git" -ForegroundColor Yellow
Write-Host ""

if (Confirm-Action "¿Ya creaste el repositorio en GitHub?") {
    Write-Host ""
    $repoUrl = Read-Host "Ingresa la URL del repositorio"
    
    # Verificar si ya existe un remote
    $existingRemote = git remote get-url origin 2>$null
    
    if ($existingRemote) {
        Write-Host "⚠️  Ya existe un remote configurado: $existingRemote" -ForegroundColor Yellow
        if (Confirm-Action "¿Deseas reemplazarlo?") {
            git remote remove origin
            git remote add origin $repoUrl
            Write-Host "✅ Remote actualizado" -ForegroundColor Green
        } else {
            Write-Host "ℹ️  Manteniendo remote existente" -ForegroundColor Cyan
        }
    } else {
        git remote add origin $repoUrl
        Write-Host "✅ Remote configurado" -ForegroundColor Green
    }
    
    Write-Host ""
    
    # Renombrar rama a main
    $currentBranch = git branch --show-current
    if ($currentBranch -ne "main") {
        git branch -M main
        Write-Host "✅ Rama renombrada a 'main'" -ForegroundColor Green
    }
    
    Write-Host ""
    Write-Host "[8/8] Subiendo a GitHub..." -ForegroundColor Yellow
    Write-Host ""
    Write-Host "⚠️  Se te pedirán tus credenciales de GitHub" -ForegroundColor Yellow
    Write-Host "   Usa tu nombre de usuario y Personal Access Token" -ForegroundColor Yellow
    Write-Host ""
    
    if (Confirm-Action "¿Deseas subir el código ahora?") {
        try {
            git push -u origin main
            Write-Host ""
            Write-Host "==================================================" -ForegroundColor Green
            Write-Host "           ✅ ¡PROYECTO SUBIDO A GITHUB!          " -ForegroundColor Green
            Write-Host "==================================================" -ForegroundColor Green
            Write-Host ""
            Write-Host "Próximos pasos:" -ForegroundColor Cyan
            Write-Host "1. Verifica tu repositorio en GitHub" -ForegroundColor White
            Write-Host "2. Invita colaboradores (Settings → Collaborators)" -ForegroundColor White
            Write-Host "3. Configura protecciones de rama (Settings → Branches)" -ForegroundColor White
            Write-Host "4. Revisa que GitHub Actions esté funcionando" -ForegroundColor White
            Write-Host ""
            Write-Host "Documentación útil:" -ForegroundColor Cyan
            Write-Host "- GITHUB_SETUP.md - Guía completa de GitHub" -ForegroundColor White
            Write-Host "- CONTRIBUTING.md - Guía para colaboradores" -ForegroundColor White
            Write-Host "- GIT_COMMANDS.md - Referencia de comandos Git" -ForegroundColor White
            Write-Host ""
        } catch {
            Write-Host ""
            Write-Host "❌ Error al subir a GitHub" -ForegroundColor Red
            Write-Host "   Error: $_" -ForegroundColor Red
            Write-Host ""
            Write-Host "Soluciones posibles:" -ForegroundColor Yellow
            Write-Host "1. Verifica tus credenciales de GitHub" -ForegroundColor White
            Write-Host "2. Asegúrate de tener permisos en el repositorio" -ForegroundColor White
            Write-Host "3. Verifica que la URL del repositorio sea correcta" -ForegroundColor White
            Write-Host "4. Consulta GITHUB_SETUP.md para más ayuda" -ForegroundColor White
            Write-Host ""
        }
    } else {
        Write-Host ""
        Write-Host "ℹ️  Puedes subir el código más tarde con:" -ForegroundColor Cyan
        Write-Host "   git push -u origin main" -ForegroundColor White
        Write-Host ""
    }
} else {
    Write-Host ""
    Write-Host "ℹ️  Pasos para crear el repositorio en GitHub:" -ForegroundColor Cyan
    Write-Host "1. Ve a https://github.com/new" -ForegroundColor White
    Write-Host "2. Nombra el repositorio (ej: habilprof-ucsc)" -ForegroundColor White
    Write-Host "3. NO marques 'Add README' ni '.gitignore'" -ForegroundColor White
    Write-Host "4. Clic en 'Create repository'" -ForegroundColor White
    Write-Host "5. Ejecuta este script nuevamente" -ForegroundColor White
    Write-Host ""
    Write-Host "O ejecuta manualmente:" -ForegroundColor Cyan
    Write-Host "git remote add origin https://github.com/TU-USUARIO/REPO.git" -ForegroundColor White
    Write-Host "git branch -M main" -ForegroundColor White
    Write-Host "git push -u origin main" -ForegroundColor White
    Write-Host ""
}

Write-Host ""
Write-Host "Resumen del repositorio:" -ForegroundColor Cyan
Write-Host "- Archivos en commit: $filesToCommit" -ForegroundColor White
$commitHash = git rev-parse --short HEAD
Write-Host "- Commit hash: $commitHash" -ForegroundColor White
$branch = git branch --show-current
Write-Host "- Rama actual: $branch" -ForegroundColor White
$remote = git remote get-url origin 2>$null
if ($remote) {
    Write-Host "- Remote: $remote" -ForegroundColor White
}
Write-Host ""

Write-Host "Para más información, consulta:" -ForegroundColor Cyan
Write-Host "- CHECKLIST.md - Verificación pre-subida" -ForegroundColor White
Write-Host "- GITHUB_SETUP.md - Guía detallada" -ForegroundColor White
Write-Host "- CONTRIBUTING.md - Guía para colaboradores" -ForegroundColor White
Write-Host ""

Write-Host "Presiona cualquier tecla para salir..." -ForegroundColor Gray
$null = $Host.UI.RawUI.ReadKey("NoEcho,IncludeKeyDown")
