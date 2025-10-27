# 🔄 Flujo de Trabajo con Git - Equipo HabilProf

Esta guía explica cómo trabajar en equipo usando **Git** y **GitHub** para gestionar versiones del código de forma profesional.

## 📋 Tabla de Contenidos

- [Conceptos Básicos](#-conceptos-básicos)
- [Configuración Inicial](#-configuración-inicial)
- [Flujo de Trabajo Diario](#-flujo-de-trabajo-diario)
- [Crear Pull Request](#-crear-pull-request)
- [Revisar y Aprobar PR](#-revisar-y-aprobar-pr)
- [Resolver Conflictos](#-resolver-conflictos)
- [Convenciones del Proyecto](#-convenciones-del-proyecto)
- [Comandos Útiles](#-comandos-útiles)
- [Reglas del Equipo](#-reglas-del-equipo)
- [Solución a Problemas](#-solución-a-problemas)

## 🎯 Conceptos Básicos

### ¿Qué es una Rama (Branch)?

Una **rama** es una versión paralela del código donde puedes trabajar sin afectar el código principal.

```
main (código estable)
  │
  ├── feature/login          ← Compañero 1 trabaja aquí
  ├── feature/reportes       ← Compañero 2 trabaja aquí
  └── feature/dashboard      ← Compañero 3 trabaja aquí
```

### ¿Qué es un Pull Request (PR)?

Un **Pull Request** es una solicitud para fusionar tus cambios con la rama principal. Permite:
- ✅ Revisión de código antes de fusionar
- ✅ Discusión sobre los cambios
- ✅ Ejecutar tests automáticos
- ✅ Mantener calidad del código

## ⚙️ Configuración Inicial

### Primera Vez (Solo una vez)

```bash
# 1. Configurar tu identidad
git config --global user.name "Tu Nombre"
git config --global user.email "tu.email@alumnos.ucsc.cl"

# 2. Clonar el repositorio
git clone https://github.com/SidTey/habilprof-ucsc.git
cd habilprof-ucsc

# 3. Configurar el proyecto (ver SETUP-COLABORADORES.md)
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
```

## 🚀 Flujo de Trabajo Diario

### Paso 1: Actualizar tu Código

**SIEMPRE** antes de empezar a trabajar:

```bash
# Ir a la rama principal
git checkout main

# Descargar últimos cambios
git pull origin main
```

### Paso 2: Crear tu Rama de Trabajo

```bash
# Crear y cambiar a nueva rama
git checkout -b feature/descripcion-de-tu-tarea

# Ejemplos:
git checkout -b feature/agregar-validacion-rut
git checkout -b fix/error-carga-datos
git checkout -b docs/actualizar-readme
```

**Convención de nombres:**
- `feature/` - Nueva funcionalidad
- `fix/` - Corrección de error
- `docs/` - Cambios en documentación
- `test/` - Agregar tests
- `refactor/` - Mejorar código existente

### Paso 3: Trabajar en tu Código

```bash
# Ver en qué rama estás
git branch
# Debería mostrar: * feature/tu-rama

# Hacer tus cambios en los archivos...
# Editar código, crear archivos, etc.
```

### Paso 4: Guardar tus Cambios (Commits)

```bash
# Ver qué archivos cambiaron
git status

# Ver diferencias específicas
git diff

# Agregar archivos al commit
git add .                          # Todos los archivos
git add archivo.php                # Un archivo específico
git add app/Models/                # Una carpeta específica

# Hacer commit con mensaje descriptivo
git commit -m "feat: agregar validación de RUT en formulario"

# Ejemplos de buenos mensajes:
git commit -m "feat: implementar login de estudiantes"
git commit -m "fix: corregir error en validación de fecha"
git commit -m "docs: actualizar guía de instalación"
git commit -m "test: agregar tests para modelo Alumno"
```

**💡 Tip:** Haz commits pequeños y frecuentes, no esperes terminar todo.

### Paso 5: Subir tu Rama a GitHub

```bash
# Primera vez que subes esta rama
git push -u origin feature/tu-rama

# Siguientes veces (cuando ya existe en GitHub)
git push
```

### Paso 6: Continuar Trabajando

Si necesitas seguir trabajando varios días:

```bash
# DÍA 1
git add .
git commit -m "feat: agregar estructura de validaciones"
git push

# DÍA 2
git add .
git commit -m "feat: completar validaciones de formulario"
git push

# DÍA 3
git add .
git commit -m "feat: agregar mensajes de error personalizados"
git push
```

## 📤 Crear Pull Request

Cuando termines tu trabajo y quieras fusionarlo con `main`:

### Opción 1: Desde GitHub (Recomendado)

1. Ve a: https://github.com/SidTey/habilprof-ucsc
2. Verás un banner amarillo: **"Compare & pull request"** → Click
3. Llena el formulario:
   ```
   Título: feat: Agregar validación de RUT en formulario
   
   Descripción:
   ## Cambios realizados
   - Implementada validación de RUT según requisito R1.1
   - Agregados tests unitarios
   - Actualizada documentación
   
   ## Cómo probar
   1. Ir a formulario de registro
   2. Ingresar RUT inválido
   3. Verificar mensaje de error
   
   ## Capturas (opcional)
   [adjuntar imagen si aplica]
   ```
4. Asignar revisores (compañeros del equipo)
5. Click en **"Create pull request"**

### Opción 2: Desde Terminal

```bash
# Asegurarte de tener todos los cambios subidos
git push

# Luego ir a GitHub y seguir pasos anteriores
```

## 👀 Revisar y Aprobar PR

### Si eres Revisor

1. Ve a: https://github.com/SidTey/habilprof-ucsc/pulls
2. Click en el PR que te asignaron
3. Click en **"Files changed"**
4. Revisar código línea por línea:
   - ✅ ¿El código funciona?
   - ✅ ¿Sigue las convenciones del proyecto?
   - ✅ ¿Tiene comentarios claros?
   - ✅ ¿Los tests pasan?
   - ✅ ¿No tiene errores de seguridad?

5. **Dejar comentarios:**
   - Hover sobre línea → Click en `+` azul
   - Escribir sugerencia o pregunta
   - Click "Add review comment"

6. **Aprobar o Solicitar Cambios:**
   - Click en "Review changes"
   - Seleccionar:
     - ✅ **Approve** - Si está todo bien
     - 💬 **Comment** - Solo comentarios
     - ⚠️ **Request changes** - Necesita correcciones
   - Click "Submit review"

7. **Hacer Merge (solo si tienes permisos):**
   - Click en **"Merge pull request"**
   - Confirmar merge
   - **Opcional:** Borrar rama: "Delete branch"

### Si te Piden Cambios

```bash
# Hacer las correcciones solicitadas
# Editar archivos...

# Commit de correcciones
git add .
git commit -m "fix: corregir validaciones según review"
git push

# El PR se actualiza automáticamente
# Pedir nueva revisión en GitHub
```

## ⚔️ Resolver Conflictos

### ¿Cuándo ocurren conflictos?

Cuando **dos personas** editan las **mismas líneas** del **mismo archivo**.

### Cómo Resolverlos

```bash
# 1. Actualizar tu rama con los cambios de main
git checkout feature/tu-rama
git pull origin main

# 2. Si hay conflictos, Git te lo dirá:
# Auto-merging archivo.php
# CONFLICT (content): Merge conflict in archivo.php
# Automatic merge failed; fix conflicts and then commit the result.

# 3. Abrir archivos con conflictos
# Verás marcadores así:

<<<<<<< HEAD
// Tu código
function validarRut($rut) {
    return preg_match('/^\d{7,8}-[\dkK]$/', $rut);
}
=======
// Código de otro compañero
function validarRut($rut) {
    return validateRutFormat($rut);
}
>>>>>>> main

# 4. Editar y decidir qué conservar:
// Versión final (combinar lo mejor de ambos)
function validarRut($rut) {
    return preg_match('/^\d{7,8}-[\dkK]$/', $rut) 
           && validateRutFormat($rut);
}

# 5. Eliminar los marcadores <<<<<<, =======, >>>>>>>

# 6. Marcar como resuelto
git add archivo.php

# 7. Finalizar merge
git commit -m "merge: resolver conflictos con main"

# 8. Subir
git push
```

### Evitar Conflictos

- ✅ Actualiza frecuentemente: `git pull origin main`
- ✅ Haz PRs pequeños y rápidos
- ✅ Comunica en qué archivos estás trabajando
- ✅ Divide tareas para evitar editar los mismos archivos

## 📜 Convenciones del Proyecto

### Nombres de Ramas

```bash
feature/nombre-descriptivo      # Nueva funcionalidad
fix/descripcion-del-bug         # Corrección
docs/que-se-actualiza          # Documentación
test/que-se-prueba             # Tests
refactor/que-se-mejora         # Refactorización
hotfix/emergencia              # Corrección urgente
```

**Ejemplos:**
```bash
feature/login-estudiantes
feature/validacion-rut
fix/error-carga-datos
fix/corregir-migracion-alumnos
docs/actualizar-readme
docs/agregar-guia-api
test/modelo-profesor
refactor/optimizar-queries
```

### Mensajes de Commit

**Formato:** `tipo: descripción breve`

**Tipos permitidos:**
- `feat:` - Nueva funcionalidad
- `fix:` - Corrección de bug
- `docs:` - Cambios en documentación
- `style:` - Formato, punto y coma, etc (no afecta código)
- `refactor:` - Refactorizar código (sin cambiar funcionalidad)
- `test:` - Agregar o modificar tests
- `chore:` - Mantenimiento, dependencias, etc
- `perf:` - Mejoras de rendimiento

**Ejemplos:**
```bash
✅ feat: agregar validación de RUT en formulario de alumnos
✅ fix: corregir error de validación en fecha de ingreso
✅ docs: actualizar README con instrucciones de deploy
✅ test: agregar tests unitarios para modelo Profesor
✅ refactor: simplificar lógica de UcscApiService
✅ chore: actualizar dependencias de Laravel a 12.1

❌ "cambios varios"
❌ "arreglos"
❌ "update"
❌ "fix bug"
```

### Estructura de Pull Request

**Título:**
```
feat: Descripción breve de la funcionalidad
```

**Descripción:**
```markdown
## Descripción
Breve explicación de qué hace este PR

## Cambios realizados
- Lista de cambios específicos
- Archivos modificados
- Funcionalidades agregadas

## Requisitos implementados
- R1.1: Validación de RUT
- R1.2: Validación de nombre

## Cómo probar
1. Paso 1
2. Paso 2
3. Resultado esperado

## Capturas de pantalla
[Si aplica]

## Checklist
- [ ] Tests pasan
- [ ] Código comentado
- [ ] Documentación actualizada
- [ ] Sin conflictos con main
```

## 🛠️ Comandos Útiles

### Ver Estado

```bash
# ¿En qué rama estoy?
git branch

# ¿Qué archivos cambié?
git status

# ¿Qué cambios específicos hice?
git diff

# Ver commits recientes
git log --oneline

# Ver commits con gráfico de ramas
git log --oneline --graph --all

# Ver quién modificó cada línea
git blame archivo.php
```

### Cambiar de Rama

```bash
# Ver todas las ramas
git branch -a

# Cambiar a rama existente
git checkout nombre-rama

# Crear y cambiar a nueva rama
git checkout -b nueva-rama

# Cambiar a main
git checkout main
```

### Deshacer Cambios

```bash
# Deshacer cambios NO guardados en un archivo
git checkout -- archivo.php

# Deshacer TODOS los cambios no guardados
git checkout -- .

# Quitar archivo del staging (antes de commit)
git reset archivo.php

# Volver al último commit (CUIDADO: pierdes cambios)
git reset --hard HEAD

# Deshacer último commit (mantiene cambios)
git reset --soft HEAD~1

# Ver commits anteriores
git reflog
```

### Limpiar y Actualizar

```bash
# Eliminar ramas locales ya fusionadas
git branch -d nombre-rama

# Forzar eliminación de rama
git branch -D nombre-rama

# Actualizar lista de ramas remotas
git fetch --prune

# Limpiar archivos no trackeados
git clean -fd
```

### Stash (Guardar Temporalmente)

```bash
# Guardar cambios sin commit
git stash

# Ver cambios guardados
git stash list

# Recuperar últimos cambios guardados
git stash pop

# Aplicar cambios específicos
git stash apply stash@{0}

# Eliminar cambios guardados
git stash drop
```

## ✅ Reglas del Equipo

### SIEMPRE

1. ✅ **Actualizar antes de empezar**: `git pull origin main`
2. ✅ **Crear rama nueva** para cada tarea
3. ✅ **Commits pequeños y frecuentes** con mensajes claros
4. ✅ **Pull Request para TODO**: nunca push directo a `main`
5. ✅ **Revisar código** de compañeros cuando te asignen
6. ✅ **Ejecutar tests** antes de crear PR: `php artisan test`
7. ✅ **Pedir ayuda** si tienes dudas
8. ✅ **Comunicar** en qué estás trabajando

### NUNCA

1. ❌ **NUNCA** hacer `git push --force` en `main`
2. ❌ **NUNCA** commit directo a `main`
3. ❌ **NUNCA** subir archivos `.env` o credenciales
4. ❌ **NUNCA** subir `node_modules/` o `vendor/`
5. ❌ **NUNCA** hacer merge de tu propio PR sin revisión
6. ❌ **NUNCA** hacer commits con "fix", "changes", sin descripción
7. ❌ **NUNCA** ignorar conflictos o tests fallidos

## 🆘 Solución a Problemas

### "No puedo hacer push a main"

✅ **Normal y correcto.** La rama `main` está protegida. Debes:
1. Crear tu rama: `git checkout -b feature/mi-tarea`
2. Trabajar ahí
3. Hacer Pull Request

### "Mi rama está desactualizada"

```bash
git checkout feature/mi-rama
git pull origin main
# Resolver conflictos si los hay
git push
```

### "Hice commit en main por error"

```bash
# Crear rama con tus cambios
git checkout -b feature/mis-cambios

# Volver main al estado remoto
git checkout main
git reset --hard origin/main
```

### "Subí archivo .env por error"

```bash
# Remover del historio (ANTES de hacer push)
git rm --cached .env
git commit -m "chore: remover .env del repositorio"

# Si ya hiciste push, contactar al líder del equipo
```

### "Tests fallan en GitHub pero pasan en local"

1. Verificar que `.env.example` tenga todas las variables
2. Revisar versiones de PHP/Node en `.github/workflows/tests.yml`
3. Ejecutar `php artisan test` localmente en ambiente limpio

### "Conflictos muy complejos"

```bash
# Opción 1: Descartar tus cambios y empezar de nuevo
git checkout main
git pull origin main
git checkout -b feature/mi-tarea-v2
# Rehacer cambios

# Opción 2: Pedir ayuda al equipo
# No fuerces nada si no estás seguro
```

### "Quiero deshacer todo y empezar de nuevo"

```bash
# Guardar rama actual por si acaso
git branch backup-rama-vieja

# Volver a main limpio
git checkout main
git pull origin main

# Crear nueva rama
git checkout -b feature/nueva-rama
```

## 📚 Recursos Adicionales

- **Git Cheat Sheet**: https://education.github.com/git-cheat-sheet-education.pdf
- **Guía Visual Git**: https://marklodato.github.io/visual-git-guide/index-es.html
- **GitHub Flow**: https://docs.github.com/es/get-started/quickstart/github-flow
- **Conventional Commits**: https://www.conventionalcommits.org/es/

## 🎓 Ejemplo Completo de Flujo

### Historia: Juan agrega validación de RUT

```bash
# LUNES - Comenzar tarea
git checkout main
git pull origin main
git checkout -b feature/validacion-rut

# Trabajar...
# Editar app/Models/Alumno.php

git add app/Models/Alumno.php
git commit -m "feat: agregar validación básica de RUT"
git push -u origin feature/validacion-rut

# MARTES - Continuar
# Editar tests/Unit/Models/AlumnoTest.php

git add tests/Unit/Models/AlumnoTest.php
git commit -m "test: agregar tests para validación de RUT"
git push

# MIÉRCOLES - Finalizar
# Actualizar documentación

git add README.md
git commit -m "docs: documentar validación de RUT"
git push

# Crear Pull Request en GitHub
# Título: feat: Agregar validación de RUT en modelo Alumno
# Asignar revisor: María

# JUEVES - María revisa y pide cambios
# Juan hace correcciones

git add app/Models/Alumno.php
git commit -m "fix: mejorar regex de validación según review"
git push

# María aprueba → Merge a main

# VIERNES - Actualizar local
git checkout main
git pull origin main
git branch -d feature/validacion-rut

# Listo para siguiente tarea
```

---

## 📞 Contacto y Ayuda

Si tienes problemas:

1. Revisa esta guía
2. Consulta `CONTRIBUTING.md`
3. Pregunta en el grupo del equipo
4. Revisa los Issues en GitHub
5. Pide ayuda al líder del proyecto

---

**Última actualización**: 26 de octubre de 2025  
**Versión**: 1.0  
**Proyecto**: HabilProf UCSC  
**Repositorio**: https://github.com/SidTey/habilprof-ucsc
