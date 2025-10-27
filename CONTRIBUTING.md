# Guía de Contribución - HabilProf UCSC

¡Gracias por tu interés en contribuir al proyecto HabilProf! Esta guía te ayudará a configurar el entorno de desarrollo y comenzar a trabajar.

## 📋 Requisitos Previos

Asegúrate de tener instalado:

- **PHP**: 8.2.29 o superior
- **Composer**: 2.8.12 o superior
- **Node.js**: 22.21.0 o superior
- **NPM**: 10.9.4 o superior
- **PostgreSQL**: 17.6 (producción) o SQLite (desarrollo)

## 🚀 Configuración Inicial

### 1. Clonar el Repositorio

```bash
git clone https://github.com/TU-USUARIO/habilprof-ucsc.git
cd habilprof-ucsc
```

### 2. Instalar Dependencias de PHP

```bash
composer install
```

### 3. Instalar Dependencias de Node.js

```bash
npm install
```

### 4. Configurar Variables de Entorno

```bash
# Copiar el archivo de ejemplo
cp .env.example .env

# Generar la clave de la aplicación
php artisan key:generate
```

### 5. Configurar Base de Datos

Edita el archivo `.env` con tus credenciales de PostgreSQL:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=habilprof_ucsc
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_password
```

**Alternativa con SQLite para desarrollo:**

```env
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```

### 6. Ejecutar Migraciones

```bash
php artisan migrate
```

### 7. Compilar Assets

```bash
# Para desarrollo
npm run dev

# Para producción
npm run build
```

## 🏃 Ejecutar el Proyecto

### Opción 1: Inicio Rápido (Windows PowerShell)

```powershell
# Iniciar todo el sistema (Laravel + Vite)
.\start-all.ps1

# Solo backend
.\start-server.ps1

# Solo frontend
.\start-vite.ps1
```

### Opción 2: Manual

```bash
# Terminal 1 - Backend Laravel
php artisan serve

# Terminal 2 - Frontend Vite
npm run dev
```

El sistema estará disponible en:
- **Backend**: http://localhost:8000
- **Frontend**: http://localhost:5173

## 📂 Estructura del Proyecto

```
proyecto/
├── app/
│   ├── Console/Commands/     # Comandos Artisan personalizados
│   ├── Http/Controllers/     # Controladores de API
│   ├── Models/               # Modelos Eloquent
│   └── Services/             # Lógica de negocio
├── database/
│   └── migrations/           # Migraciones de base de datos
├── resources/
│   └── js/
│       ├── components/       # Componentes React
│       └── app.jsx          # Aplicación React principal
└── routes/
    └── api.php              # Rutas de la API
```

## 🔧 Comandos Útiles

```bash
# Ejecutar carga automática de datos UCSC
php artisan ucsc:carga-automatica

# Ver logs del sistema
php artisan debug:logs

# Ejecutar tests
php artisan test

# Limpiar caché
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

## 📝 Convenciones de Código

### PHP/Laravel

- Seguir [PSR-12](https://www.php-fig.org/psr/psr-12/) para estilo de código
- Usar validaciones de Laravel para entrada de datos
- Documentar requisitos funcionales en comentarios (R1.x)
- Manejar errores con try-catch y logs apropiados

### JavaScript/React

- Usar componentes funcionales con Hooks
- Seguir convenciones de nombres: PascalCase para componentes
- Usar Tailwind CSS para estilos

### Git

- **Commits**: Mensajes descriptivos en español
  - Ejemplo: `feat: agregar validación de RUT de alumno (R1.1)`
  - Ejemplo: `fix: corregir formato de fecha en registros UCSC`
  - Ejemplo: `docs: actualizar README con nuevas instrucciones`

- **Ramas**:
  - `main`: Código de producción estable
  - `develop`: Desarrollo activo
  - `feature/nombre-funcionalidad`: Nuevas características
  - `fix/descripcion-bug`: Corrección de errores
  - `docs/descripcion`: Documentación

## 🧪 Ejecutar Tests

```bash
# Todos los tests
php artisan test

# Tests específicos
php artisan test --filter NombreDelTest
```

## 📋 Requisitos Funcionales

El proyecto implementa los siguientes requisitos:

- **R1**: Sistema de carga automática de datos UCSC
  - R1.1-R1.9: Validaciones de datos
  - R1.13: Sistema de logs
  - R1.15: Ejecución automática cada minuto

Revisa el archivo `.github/copilot-instructions.md` para más detalles.

## 🐛 Reportar Problemas

Usa el sistema de Issues de GitHub:

1. Describe el problema claramente
2. Incluye pasos para reproducirlo
3. Indica tu entorno (SO, versiones de PHP, Node, etc.)
4. Adjunta logs relevantes si aplica

## 💡 Solicitar Funcionalidades

1. Abre un Issue describiendo la funcionalidad
2. Explica el caso de uso
3. Espera feedback antes de empezar a codificar

## ✅ Pull Requests

1. Crea una rama desde `develop`
2. Implementa tus cambios
3. Asegúrate de que los tests pasen
4. Actualiza la documentación si es necesario
5. Crea un Pull Request hacia `develop`
6. Describe tus cambios en detalle

## 📞 Contacto

Si tienes preguntas, abre un Issue en GitHub o contacta al equipo de desarrollo.

---

¡Gracias por contribuir a HabilProf! 🎉
