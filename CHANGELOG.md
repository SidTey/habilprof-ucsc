# Changelog

Todos los cambios notables en este proyecto serán documentados en este archivo.

El formato está basado en [Keep a Changelog](https://keepachangelog.com/es-ES/1.0.0/),
y este proyecto adhiere a [Semantic Versioning](https://semver.org/lang/es/).

## [Unreleased]

### 🎯 Planificado
- Tests automatizados para componentes React
- Documentación de API con Swagger/OpenAPI
- Sistema de notificaciones en tiempo real
- Dashboard de estadísticas
- Exportación de datos a Excel/PDF

## [1.0.0] - 2025-10-26

### ✨ Agregado

#### Backend (Laravel)
- Implementación completa del requisito R1 (Carga automática de datos UCSC)
- Modelos: `Alumno`, `Profesor`, `RegistroUcsc`, `LogSistema`
- Controlador `UcscDataController` para manejo de carga de datos
- Servicio `UcscApiService` para simulación de conexión UCSC
- Comando Artisan `ucsc:carga-automatica` con ejecución programada
- Comando de depuración `debug:logs`
- Sistema completo de logs (R1.13)
- Validaciones según requisitos R1.1-R1.9:
  - RUT Alumno: entero [1,000,000 - 60,000,000]
  - Nombre Alumno: string máx 100 caracteres
  - Correo Alumno: email válido [1-255 caracteres]
  - RUT Profesor: entero [10,000,000 - 60,000,000]
  - Nombre Profesor: string máx 100 caracteres
  - Correo Profesor: email válido [1-255 caracteres]
  - Fecha Ingreso: DD/MM/AAAA [2025-2050]
  - Nota Final: decimal [1.00-7.00] (opcional)

#### Frontend (React + Vite)
- Componente `App.jsx` con navegación por tabs
- Componente `UcscDataForm.jsx` para carga manual
- Componente `UcscDataTable.jsx` para visualización de registros
- Componente `UcscLogs.jsx` para sistema de logs
- Integración completa con API de Laravel
- Validaciones en tiempo real
- Diseño responsive con Tailwind CSS

#### Base de Datos
- Soporte para PostgreSQL 17.6 (producción)
- Soporte para SQLite (desarrollo)
- Migraciones para todas las tablas principales
- Índices optimizados
- Restricciones CHECK para validaciones
- Campo JSONB en logs para datos estructurados

#### Documentación
- README.md completo con guía de uso
- CONTRIBUTING.md con guía para colaboradores
- INSTALLATION.md con instalación paso a paso
- CODE_OF_CONDUCT.md con código de conducta
- SECURITY.md con políticas de seguridad
- LICENSE con licencia MIT
- Copilot instructions para desarrollo asistido

#### DevOps
- Scripts PowerShell para inicio rápido:
  - `start-all.ps1` - Inicia sistema completo
  - `start-server.ps1` - Solo backend
  - `start-vite.ps1` - Solo frontend
- Tasks de VS Code para desarrollo
- GitHub Actions workflow para CI/CD
- Templates para Issues y Pull Requests
- Configuración de .gitignore optimizada

#### Configuración
- Variables de entorno con `.env.example`
- Configuración de Tailwind CSS
- Configuración de Vite para desarrollo
- Configuración de tareas programadas en Laravel

### 🔧 Configurado
- PHP 8.2.29 como versión mínima
- Composer 2.8.12 para gestión de dependencias PHP
- Node.js 22.21.0 para frontend
- NPM 10.9.4 para gestión de paquetes
- PostgreSQL 17.6 como base de datos principal
- Hot Module Replacement (HMR) con Vite

### 📝 Documentado
- Estructura completa del proyecto
- Requisitos funcionales (R1.1 - R1.15)
- Guía de instalación y configuración
- Convenciones de código
- Proceso de contribución
- Políticas de seguridad

### 🛡️ Seguridad
- Validaciones exhaustivas de entrada de datos
- Protección CSRF (Laravel por defecto)
- Sanitización de salidas
- Configuraciones seguras de sesión
- Variables de entorno protegidas
- Guías de seguridad para producción

## Tipos de Cambios

- `✨ Agregado` - Para nuevas funcionalidades
- `🔧 Cambiado` - Para cambios en funcionalidades existentes
- `⚠️ Deprecado` - Para funcionalidades que serán removidas
- `🗑️ Removido` - Para funcionalidades removidas
- `🐛 Corregido` - Para corrección de bugs
- `🛡️ Seguridad` - Para correcciones de seguridad
- `📝 Documentado` - Para cambios en documentación
- `⚡ Rendimiento` - Para mejoras de rendimiento

## Versionado

Este proyecto usa [Semantic Versioning](https://semver.org/lang/es/):

- **MAJOR** (X.0.0): Cambios incompatibles con versiones anteriores
- **MINOR** (0.X.0): Nueva funcionalidad compatible con versiones anteriores
- **PATCH** (0.0.X): Correcciones de bugs compatibles con versiones anteriores

## Enlaces

- [Unreleased]: https://github.com/TU-USUARIO/habilprof-ucsc/compare/v1.0.0...HEAD
- [1.0.0]: https://github.com/TU-USUARIO/habilprof-ucsc/releases/tag/v1.0.0

---

Para ver todos los commits, visita el [historial de commits](https://github.com/TU-USUARIO/habilprof-ucsc/commits/main).
