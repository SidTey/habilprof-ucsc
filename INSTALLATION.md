# Instalación del Sistema HabilProf

Esta guía te ayudará a configurar el proyecto desde cero.

## 📋 Prerrequisitos

Verifica que tienes instaladas las siguientes herramientas:

```bash
# Verificar versiones
php --version      # >= 8.2
composer --version # >= 2.8
node --version     # >= 18
npm --version      # >= 8
```

## 🔧 Instalación Paso a Paso

### 1. Clonar el Repositorio

```bash
git clone https://github.com/TU-USUARIO/habilprof-ucsc.git
cd habilprof-ucsc
```

### 2. Instalar Dependencias de Backend

```bash
composer install
```

Si encuentras problemas, puedes actualizar las dependencias:

```bash
composer update
```

### 3. Instalar Dependencias de Frontend

```bash
npm install
```

Si encuentras problemas:

```bash
# Limpiar caché de npm
npm cache clean --force
npm install
```

### 4. Configurar Variables de Entorno

```bash
# Copiar archivo de ejemplo
cp .env.example .env

# En Windows PowerShell
Copy-Item .env.example .env
```

Edita `.env` y configura según tu entorno:

```env
APP_NAME="HabilProf UCSC"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

# Base de datos PostgreSQL (recomendado para producción)
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=habilprof_ucsc
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_password

# O SQLite para desarrollo rápido
# DB_CONNECTION=sqlite
# DB_DATABASE=database/database.sqlite
```

### 5. Generar Clave de Aplicación

```bash
php artisan key:generate
```

### 6. Configurar Base de Datos

#### Opción A: PostgreSQL (Recomendado)

**Windows:**
```powershell
# Instalar PostgreSQL
winget install --id=PostgreSQL.PostgreSQL

# Crear base de datos
createdb -U postgres habilprof_ucsc
```

**Linux (Ubuntu/Debian):**
```bash
sudo apt update
sudo apt install postgresql postgresql-contrib
sudo systemctl start postgresql
sudo -u postgres createdb habilprof_ucsc
```

**macOS:**
```bash
brew install postgresql
brew services start postgresql
createdb habilprof_ucsc
```

#### Opción B: SQLite (Desarrollo)

```bash
# Crear archivo de base de datos
touch database/database.sqlite

# En Windows PowerShell
New-Item -Path database/database.sqlite -ItemType File
```

Actualiza `.env`:
```env
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```

### 7. Ejecutar Migraciones

```bash
# Ejecutar migraciones
php artisan migrate

# O eliminar datos existentes y migrar desde cero
php artisan migrate:fresh
```

### 8. Compilar Assets de Frontend

```bash
# Para desarrollo
npm run dev

# Para producción
npm run build
```

## 🚀 Iniciar la Aplicación

### Método 1: Scripts Automáticos (Windows)

```powershell
# Iniciar todo el sistema
.\start-all.ps1

# Solo backend
.\start-server.ps1

# Solo frontend
.\start-vite.ps1
```

### Método 2: Manual

Abre dos terminales:

**Terminal 1 - Backend Laravel:**
```bash
php artisan serve
# Disponible en: http://localhost:8000
```

**Terminal 2 - Frontend Vite:**
```bash
npm run dev
# Disponible en: http://localhost:5173
```

### Método 3: Usando VS Code Tasks

Si usas Visual Studio Code:

1. Presiona `Ctrl+Shift+P` (o `Cmd+Shift+P` en Mac)
2. Escribe "Tasks: Run Task"
3. Selecciona "Iniciar Sistema HabilProf" o "Iniciar Frontend (Vite)"

## ✅ Verificar Instalación

Una vez iniciado el sistema, verifica:

1. **Backend**: http://localhost:8000
   - Deberías ver la página de bienvenida de Laravel

2. **Frontend**: http://localhost:5173
   - Deberías ver la interfaz de HabilProf

3. **API**: http://localhost:8000/api/ucsc/registros
   - Debería devolver un JSON con los registros

## 🧪 Ejecutar Tests (Opcional)

```bash
php artisan test
```

## 🔄 Comandos de Mantenimiento

```bash
# Limpiar caché de Laravel
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Ejecutar carga automática de datos UCSC
php artisan ucsc:carga-automatica

# Ver logs del sistema
php artisan debug:logs
```

## 🐛 Solución de Problemas Comunes

### Error: "No application encryption key has been specified"

```bash
php artisan key:generate
```

### Error: "could not find driver"

Asegúrate de tener la extensión PDO habilitada en `php.ini`:

```ini
extension=pdo_pgsql  # Para PostgreSQL
extension=pdo_sqlite  # Para SQLite
```

### Error de permisos en storage/

```bash
# Linux/Mac
chmod -R 775 storage bootstrap/cache

# Windows (ejecutar como administrador)
icacls storage /grant Users:F /t
icacls bootstrap/cache /grant Users:F /t
```

### Error al instalar dependencias de npm

```bash
# Limpiar caché y reinstalar
rm -rf node_modules package-lock.json
npm cache clean --force
npm install
```

### Puerto 8000 o 5173 ya en uso

```bash
# Laravel en otro puerto
php artisan serve --port=8001

# Vite en otro puerto (editar vite.config.js)
```

## 📚 Siguientes Pasos

Una vez instalado correctamente:

1. Lee la [Guía de Contribución](CONTRIBUTING.md)
2. Revisa la estructura del proyecto en [README.md](README.md)
3. Familiarízate con los comandos Git en [GIT_COMMANDS.md](GIT_COMMANDS.md)

## 💡 Consejos

- Usa **SQLite** para desarrollo rápido
- Usa **PostgreSQL** para producción y cuando necesites todas las características
- Mantén `.env` sincronizado con tu entorno
- Ejecuta `composer update` y `npm update` periódicamente
- Lee los logs en `storage/logs/` si algo falla

## 📞 ¿Necesitas Ayuda?

- Abre un [Issue](https://github.com/TU-USUARIO/habilprof-ucsc/issues)
- Revisa la documentación oficial de [Laravel](https://laravel.com/docs)
- Revisa la documentación de [React](https://react.dev)

---

¡Listo! Ahora estás preparado para contribuir al proyecto HabilProf. 🎉
