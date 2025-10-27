# Copilot Instructions

<!-- Use this file to provide workspace-specific custom instructions to Copilot. For more details, visit https://code.visualstudio.com/docs/copilot/copilot-customization#_use-a-githubcopilotinstructionsmd-file -->

## Proyecto HabilProf - Sistema UCSC

Este es un proyecto Laravel + React para el sistema "HabilProf" con funcionalidad de carga automática de datos desde sistemas UCSC.

### Estructura del Proyecto

- **Backend**: Laravel 12.x con API REST
- **Frontend**: React con Vite como bundler
- **Base de Datos**: PostgreSQL 17.6 (producción), SQLite (desarrollo)
- **Estilos**: Tailwind CSS
- **Versiones**:
  - PHP 8.2.29
  - Composer 2.8.12
  - Node.js 22.21.0
  - NPM 10.9.4

### Funcionalidades Implementadas

#### R1. Carga automática de datos desde sistemas UCSC

**Modelos principales:**
- `Alumno`: Gestiona datos de estudiantes (RUT, nombre, correo)
- `Profesor`: Gestiona datos de profesores (RUT, nombre, correo)
- `RegistroUcsc`: Registros de datos con fecha de ingreso y nota final
- `LogSistema`: Sistema de logs para auditoría (R1.13)

**Controladores:**
- `UcscDataController`: Maneja la lógica de carga automática de datos

**Servicios:**
- `UcscApiService`: Simula conexión con sistemas UCSC externos

**Comandos:**
- `ucsc:carga-automatica`: Comando que se ejecuta automáticamente cada minuto (R1.15)
  - Configurado en `app/Console/Kernel.php`
  - Log en `storage/logs/carga-automatica.log`
- `debug:logs`: Comando para depuración de logs del sistema

### Validaciones Implementadas

Según los requisitos del proyecto:

- **R1.1**: RUT Alumno: entero [1,000,000 - 60,000,000]
- **R1.2**: Nombre Alumno: string máximo 100 caracteres (a-z, A-Z, tildes)
- **R1.3**: Correo Alumno: alfanuméricos con "@" y "." [1-255 caracteres]
- **R1.4**: RUT Profesor: entero [10,000,000 - 60,000,000]
- **R1.5**: Nombre Profesor: string máximo 100 caracteres (a-z, A-Z, tildes)
- **R1.7**: Correo Profesor: alfanuméricos con "@" y "." [1-255 caracteres]
- **R1.8**: Fecha Ingreso: formato DD/MM/AAAA [2025-2050]
- **R1.9**: Nota Final: decimal [1.00-7.00] (opcional)

### Rutas API

- `POST /api/ucsc/carga-automatica`: Procesar carga de datos
- `GET /api/ucsc/registros`: Obtener registros UCSC
- `GET /api/ucsc/logs`: Obtener logs del sistema

### Componentes React

- `App.jsx`: Componente principal con navegación por tabs
- `UcscDataForm.jsx`: Formulario para carga manual de datos
- `UcscDataTable.jsx`: Tabla de registros UCSC
- `UcscLogs.jsx`: Visualización de logs del sistema

### Comandos Útiles

```powershell
# Iniciar sistema completo (Laravel + Vite)
.\start-all.ps1

# Iniciar solo backend Laravel
.\start-server.ps1

# Iniciar solo frontend Vite
.\start-vite.ps1

# Ejecutar migraciones
php artisan migrate

# Ejecutar carga automática manual
php artisan ucsc:carga-automatica

# Ver logs de depuración
php artisan debug:logs

# Compilar assets de React para desarrollo
npm run dev

# Compilar para producción
npm run build
```

### Notas de Desarrollo

- El sistema está completamente configurado con PostgreSQL 17.6
- Scripts de PowerShell para inicio rápido del sistema (start-all.ps1, start-server.ps1, start-vite.ps1)
- El sistema simula la conexión con UCSC usando datos de prueba
- Los logs se registran automáticamente según R1.13
- El comando de carga automática está configurado para ejecutarse cada minuto
- La interfaz React proporciona visualización completa del sistema
- Uso de VS Code tasks para facilitar el inicio del sistema

### Estilo de Código

- Usar validaciones de Laravel para entrada de datos
- Manejar errores con try-catch y logs apropiados
- Seguir convenciones REST para APIs
- Usar Tailwind CSS para estilos consistentes
- Comentar código según los requisitos (R1.x)
