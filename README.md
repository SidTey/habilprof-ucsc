# Sistema HabilProf - UCSC

[![Laravel](https://img.shields.io/badge/Laravel-12.x-red.svg)](https://laravel.com)
[![React](https://img.shields.io/badge/React-19-blue.svg)](https://reactjs.org)
[![PostgreSQL](https://img.shields.io/badge/PostgreSQL-17-blue.svg)](https://www.postgresql.org)
[![License](https://img.shields.io/badge/license-MIT-green.svg)](LICENSE)

Proyecto estructurado de Laravel + React para el sistema "HabilProf" con funcionalidad de carga automática de datos desde sistemas UCSC.

## 📖 Tabla de Contenidos

- [Características](#-características-principales)
- [Tecnologías](#️-tecnologías-utilizadas)
- [Requisitos](#-requisitos-del-sistema)
- [Instalación](#-instalación)
- [Inicio Rápido](#-inicio-rápido)
- [Estructura del Proyecto](#-estructura-del-proyecto)
- [Contribuir](#-contribuir)
- [Licencia](#-licencia)

## 🚀 Características Principales

### R1. Carga automática de datos desde sistemas UCSC

El sistema implementa la funcionalidad completa R1 con todas sus especificaciones:

- **R1.1-R1.10**: Validaciones completas de entrada de datos según requisitos
- **R1.11**: Obtención automática de datos desde sistemas UCSC
- **R1.12**: Verificación y actualización automática de datos
- **R1.13**: Sistema completo de logs con todos los datos procesados
- **R1.14**: Manejo de errores de conexión con mensajes específicos
- **R1.15**: Ejecución automática cada minuto

## 🛠️ Tecnologías Utilizadas

- **Backend**: Laravel 12.x
- **Frontend**: React 19 + Vite
- **Base de Datos**: PostgreSQL 17
- **Estilos**: Tailwind CSS
- **Validaciones**: Laravel Validation Rules
- **APIs**: Axios para comunicación frontend-backend

## 📋 Requisitos del Sistema

- PHP >= 8.2
- Composer >= 2.8
- Node.js >= 18
- NPM >= 8
- PostgreSQL >= 17 (producción) o SQLite (desarrollo)

## 📚 Documentación

- **[INSTALLATION.md](INSTALLATION.md)** - Guía completa de instalación
- **[CONTRIBUTING.md](CONTRIBUTING.md)** - Cómo contribuir al proyecto
- **[GITHUB_SETUP.md](GITHUB_SETUP.md)** - Subir proyecto a GitHub
- **[GIT_COMMANDS.md](GIT_COMMANDS.md)** - Referencia de comandos Git
- **[SECURITY.md](SECURITY.md)** - Políticas de seguridad
- **[CODE_OF_CONDUCT.md](CODE_OF_CONDUCT.md)** - Código de conducta
- **[CHANGELOG.md](CHANGELOG.md)** - Registro de cambios

## 🚀 Instalación y Uso

### Para Colaboradores (Primera Vez)

```bash
# 1. Clonar el repositorio
git clone https://github.com/TU-USUARIO/habilprof-ucsc.git
cd habilprof-ucsc

# 2. Instalar dependencias
composer install
npm install

# 3. Configurar entorno
cp .env.example .env
php artisan key:generate

# 4. Configurar base de datos en .env
# Ver INSTALLATION.md para PostgreSQL o SQLite

# 5. Ejecutar migraciones
php artisan migrate

# 6. Iniciar sistema
.\start-all.ps1  # Windows (abre Laravel + Vite)
```

📖 **Guía completa**: [INSTALLATION.md](INSTALLATION.md)

### Inicio Rápido (Desarrollo Diario)

```powershell
# Opción 1: Todo el sistema (Recomendado)
.\start-all.ps1

# Opción 2: Solo backend
.\start-server.ps1

# Opción 3: Solo frontend
.\start-vite.ps1

# Opción 4: Manual
php artisan serve    # Terminal 1 → http://localhost:8000
npm run dev          # Terminal 2 → http://localhost:5173
```

##  Estructura de la Base de Datos

### Tablas Principales (PostgreSQL 17)

- **alumnos**: Datos de estudiantes con índices optimizados
- **profesores**: Datos de profesores con índices optimizados  
- **registros_ucsc**: Registros con restricciones de verificación
- **logs_sistema**: Logs con campo JSONB para datos adicionales

#### Características de PostgreSQL:
- ✅ Restricciones de verificación (CHECK constraints)
- ✅ Índices compuestos para optimización
- ✅ Campo JSONB para datos estructurados
- ✅ Comentarios en tablas para documentación
- ✅ Claves foráneas con cascada
- ✅ Transacciones ACID completas

## 🔗 Endpoints API

### Carga Automática de Datos
```bash
POST /api/ucsc/carga-automatica
```

### Consulta de Datos
```bash
GET /api/ucsc/registros    # Obtener todos los registros
GET /api/ucsc/logs         # Obtener logs del sistema
```

## 🎯 Validaciones Implementadas

| Campo | Requisito | Validación |
|-------|-----------|------------|
| RUT Alumno | R1.1 | Entero [1,000,000 - 60,000,000] |
| Nombre Alumno | R1.2 | String máx 100 chars (a-z, A-Z, tildes) |
| Correo Alumno | R1.3 | Email válido [1-255 chars] |
| RUT Profesor | R1.4 | Entero [10,000,000 - 60,000,000] |
| Nombre Profesor | R1.5 | String máx 100 chars (a-z, A-Z, tildes) |
| Correo Profesor | R1.7 | Email válido [1-255 chars] |
| Fecha Ingreso | R1.8 | Fecha DD/MM/AAAA [2025-2050] |
| Nota Final | R1.9 | Decimal [1.00-7.00] (opcional) |

## 🎮 Comandos Disponibles

### Comando de Carga Automática (R1.15)
```bash
php artisan ucsc:carga-automatica
```

### Desarrollo
```bash
# Modo desarrollo React
npm run dev

# Compilar para producción
npm run build

# Limpiar cache Laravel
php artisan cache:clear
```

## 🖥️ Interfaz de Usuario

La aplicación React incluye:

1. **Formulario de Carga**: Para carga manual de datos con validaciones en tiempo real
2. **Tabla de Registros**: Visualización de todos los registros UCSC procesados
3. **Logs del Sistema**: Monitoreo completo de operaciones (R1.13)

## 🔄 Proceso Automático

El sistema ejecuta automáticamente cada minuto:
1. Verificación de conexión con sistemas UCSC
2. Procesamiento de datos pendientes
3. Validación según requisitos R1.1-R1.10
4. Actualización automática de datos (R1.12)
5. Registro de logs completos (R1.13)

## 🚨 Manejo de Errores

- **Conexión UCSC**: Mensaje específico "No se ha podido establecer conexión con los sistemas UCSC"
- **Validaciones**: Errores detallados por campo según requisitos
- **Logs de Error**: Registro automático de todos los fallos

## 📝 Datos de Prueba

El sistema incluye datos simulados para:
- 2 estudiantes de ejemplo
- 2 profesores de ejemplo
- Simulación de latencia de red
- Simulación de fallos de conexión (5% probabilidad)

## 🎨 Características de UI

- Diseño moderno y responsivo
- Navegación por tabs
- Indicadores de estado en tiempo real
- Tablas con filtros y ordenamiento
- Formularios con validación en vivo
- Notificaciones de éxito/error

## � Estructura del Proyecto

```
proyecto/
├── app/
│   ├── Console/
│   │   ├── Commands/          # Comandos Artisan personalizados
│   │   └── Kernel.php         # Configuración de tareas programadas
│   ├── Http/Controllers/      # Controladores de API REST
│   ├── Models/                # Modelos Eloquent
│   └── Services/              # Lógica de negocio
├── database/
│   └── migrations/            # Migraciones de base de datos
├── resources/
│   ├── css/
│   └── js/
│       ├── components/        # Componentes React
│       └── app.jsx           # Aplicación React principal
├── routes/
│   ├── api.php               # Rutas de la API
│   └── web.php               # Rutas web
└── public/
    └── build/                # Assets compilados
```

## 🤝 Contribuir

¡Las contribuciones son bienvenidas! Por favor lee la [Guía de Contribución](CONTRIBUTING.md) para más detalles sobre:

- Cómo configurar el entorno de desarrollo
- Convenciones de código
- Proceso de Pull Requests
- Reportar issues

### Pasos Rápidos

1. Fork el proyecto
2. Crea una rama para tu feature (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'feat: agregar nueva característica'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abre un Pull Request

## 📞 Soporte

Si tienes problemas o preguntas:

- Abre un [Issue](https://github.com/TU-USUARIO/habilprof-ucsc/issues)
- Revisa la [documentación](CONTRIBUTING.md)

## 📄 Licencia

Este proyecto está desarrollado para la Universidad Católica de la Santísima Concepción (UCSC).

---

**Desarrollado con ❤️ para UCSC** | © 2025 Sistema HabilProf
