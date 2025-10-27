# 🚀 Guía de Configuración para Colaboradores

Esta guía te ayudará a configurar el proyecto HabilProf en tu máquina local después de clonarlo desde GitHub.

## 📋 Prerrequisitos

Antes de comenzar, asegúrate de tener instalado:

- **PHP** 8.2.29 o superior
- **Composer** 2.8.12 o superior
- **Node.js** 22.21.0 o superior
- **NPM** 10.9.4 o superior
- **PostgreSQL** 17.6 (o puedes usar SQLite para desarrollo)
- **Git** 2.51.1 o superior

## 🔧 Proceso de Configuración

### 1. Clonar el Repositorio

```bash
git clone https://github.com/SidTey/habilprof-ucsc.git
cd habilprof-ucsc
```

### 2. Configurar Variables de Entorno

El archivo `.env` **NO está en el repositorio** por seguridad. Debes crearlo:

```bash
# Windows PowerShell
Copy-Item .env.example .env

# Linux/Mac
cp .env.example .env
```

Luego edita el archivo `.env` con tu configuración:

```bash
# Windows
notepad .env

# Linux/Mac
nano .env
```

**Configuraciones importantes a modificar:**

```env
APP_NAME="HabilProf UCSC"
APP_ENV=local
APP_KEY=         # Se generará automáticamente en el paso 4
APP_DEBUG=true
APP_URL=http://localhost:8000

# Base de datos - Opción 1: PostgreSQL
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=habilprof_ucsc
DB_USERNAME=tu_usuario_postgres
DB_PASSWORD=tu_contraseña_postgres

# Base de datos - Opción 2: SQLite (más simple para desarrollo)
DB_CONNECTION=sqlite
# DB_HOST=127.0.0.1
# DB_PORT=5432
# DB_DATABASE=
# DB_USERNAME=
# DB_PASSWORD=
```

### 3. Instalar Dependencias PHP

```bash
composer install
```

Esto descargará todas las librerías PHP necesarias (carpeta `vendor/`).

### 4. Generar Clave de Aplicación

```bash
php artisan key:generate
```

Este comando generará una clave única en tu archivo `.env` (campo `APP_KEY`).

### 5. Instalar Dependencias JavaScript

```bash
npm install
```

Esto descargará todas las librerías de React y Vite (carpeta `node_modules/`).

### 6. Configurar Base de Datos

#### Opción A: Usar PostgreSQL

1. Crea la base de datos en PostgreSQL:
   ```sql
   CREATE DATABASE habilprof_ucsc;
   ```

2. Ejecuta las migraciones:
   ```bash
   php artisan migrate
   ```

#### Opción B: Usar SQLite (más simple)

1. Las migraciones crearán automáticamente el archivo:
   ```bash
   php artisan migrate
   ```

### 7. Verificar Instalación

Ejecuta los tests para asegurarte de que todo funciona:

```bash
php artisan test
```

Deberías ver algo como:
```
Tests:    13 passed (33 assertions)
Duration: 0.94s
```

## ▶️ Iniciar el Proyecto

### Opción 1: Usar Scripts de PowerShell (Windows)

```powershell
# Iniciar todo el sistema (Backend + Frontend)
.\start-all.ps1

# O iniciar por separado:
.\start-server.ps1   # Solo Laravel (puerto 8000)
.\start-vite.ps1     # Solo Vite (puerto 5173)
```

### Opción 2: Comandos Manuales

```bash
# Terminal 1 - Backend Laravel
php artisan serve

# Terminal 2 - Frontend Vite
npm run dev
```

## 🌐 Acceder a la Aplicación

- **Frontend (React)**: http://localhost:5173
- **Backend API (Laravel)**: http://localhost:8000

## 📁 Archivos que NO están en GitHub

Estos archivos se generan localmente y **NO debes subirlos** al repositorio:

- `.env` - Configuración personal (contiene contraseñas)
- `vendor/` - Dependencias PHP (se instalan con `composer install`)
- `node_modules/` - Dependencias JavaScript (se instalan con `npm install`)
- `public/build/` - Assets compilados (se generan con `npm run build`)
- `storage/logs/*.log` - Archivos de log
- `*.sqlite` - Base de datos SQLite local
- `bootstrap/cache/*.php` - Archivos de caché

## 🔄 Mantener tu Código Actualizado

Antes de empezar a trabajar cada día:

```bash
# Obtener los últimos cambios
git pull origin main

# Actualizar dependencias si alguien las modificó
composer install
npm install

# Ejecutar nuevas migraciones si las hay
php artisan migrate
```

## 🆘 Problemas Comunes

### Error: "No application encryption key has been specified"
**Solución:**
```bash
php artisan key:generate
```

### Error: "SQLSTATE[HY000] [1045] Access denied"
**Solución:** Verifica tus credenciales de base de datos en `.env`

### Error: "Vite manifest not found"
**Solución:**
```bash
npm install
npm run dev
```

### Error al ejecutar scripts PowerShell
**Solución:**
```powershell
powershell.exe -ExecutionPolicy Bypass -File .\start-all.ps1
```

### Cambios no se reflejan en el frontend
**Solución:** Asegúrate de que `npm run dev` esté corriendo

## 📚 Comandos Útiles

```bash
# Ver rutas disponibles
php artisan route:list

# Limpiar caché
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Ejecutar carga automática UCSC
php artisan ucsc:carga-automatica

# Ver logs del sistema
php artisan debug:logs

# Crear migración
php artisan make:migration nombre_de_migracion

# Crear controlador
php artisan make:controller NombreController

# Crear modelo
php artisan make:model NombreModelo

# Ejecutar tests
php artisan test

# Ejecutar tests con cobertura
php artisan test --coverage
```

## 🤝 Flujo de Trabajo con Git

```bash
# 1. Crear nueva rama para tu feature
git checkout -b feature/nombre-de-tu-feature

# 2. Hacer cambios y commits
git add .
git commit -m "descripcion de cambios"

# 3. Subir tu rama
git push origin feature/nombre-de-tu-feature

# 4. Crear Pull Request en GitHub
# Ve a: https://github.com/SidTey/habilprof-ucsc/pulls

# 5. Después de que aprueben tu PR, actualiza main
git checkout main
git pull origin main
```

## 📞 Soporte

Si tienes problemas:

1. Revisa esta guía completa
2. Consulta `CONTRIBUTING.md` para convenciones de código
3. Lee `INSTALLATION.md` para más detalles de instalación
4. Contacta al equipo del proyecto

## 📝 Checklist de Configuración

Marca cuando completes cada paso:

- [ ] Clonar repositorio
- [ ] Copiar `.env.example` a `.env`
- [ ] Configurar variables de entorno
- [ ] Ejecutar `composer install`
- [ ] Ejecutar `npm install`
- [ ] Ejecutar `php artisan key:generate`
- [ ] Configurar base de datos
- [ ] Ejecutar `php artisan migrate`
- [ ] Ejecutar `php artisan test` (todos los tests pasan)
- [ ] Iniciar servidor con `.\start-all.ps1` o manualmente
- [ ] Acceder a http://localhost:5173 y ver la aplicación funcionando

¡Listo! Ahora puedes empezar a desarrollar. 🎉
