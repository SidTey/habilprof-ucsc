# 🚀 Guía Rápida: Subir Proyecto a GitHub

Esta guía te ayudará a subir tu proyecto HabilProf a GitHub paso a paso.

## 📋 Antes de Comenzar

Asegúrate de tener:
- ✅ Cuenta de GitHub creada
- ✅ Git instalado en tu sistema
- ✅ Acceso de escritura al proyecto

## 🔍 Verificar Git

```bash
# Verificar que Git esté instalado
git --version

# Configurar tu identidad (si no lo has hecho)
git config --global user.name "Tu Nombre"
git config --global user.email "tu@email.com"
```

## 🎯 Paso 1: Crear Repositorio en GitHub

1. Ve a https://github.com
2. Haz clic en el botón **"+"** en la esquina superior derecha
3. Selecciona **"New repository"**
4. Configura el repositorio:
   - **Repository name**: `habilprof-ucsc` (o el nombre que prefieras)
   - **Description**: "Sistema HabilProf - Carga automática de datos UCSC (Laravel + React)"
   - **Visibility**: 
     - ✅ **Public** si quieres que sea público
     - ✅ **Private** si solo tú y colaboradores pueden verlo
   - **NO marques**:
     - ❌ "Add a README file" (ya tenemos README.md)
     - ❌ "Add .gitignore" (ya tenemos .gitignore)
     - ❌ "Choose a license" (ya tenemos LICENSE)
5. Haz clic en **"Create repository"**

## 💻 Paso 2: Inicializar Git Local

Abre PowerShell en la carpeta de tu proyecto y ejecuta:

```powershell
# Inicializar repositorio Git (si no existe)
git init

# Agregar todos los archivos
git add .

# Verificar qué archivos se agregarán
git status

# Crear el primer commit
git commit -m "feat: versión inicial del sistema HabilProf con carga automática UCSC"
```

## 🔗 Paso 3: Conectar con GitHub

Reemplaza `TU-USUARIO` con tu nombre de usuario de GitHub y `NOMBRE-REPO` con el nombre de tu repositorio:

```powershell
# Agregar el repositorio remoto
git remote add origin https://github.com/TU-USUARIO/NOMBRE-REPO.git

# Verificar la conexión
git remote -v

# Renombrar la rama principal a 'main' (si es necesario)
git branch -M main

# Subir el código a GitHub
git push -u origin main
```

## 🔐 Autenticación

Si GitHub te pide autenticación:

### Opción 1: Personal Access Token (Recomendado)

1. Ve a GitHub → Settings → Developer settings → Personal access tokens → Tokens (classic)
2. Clic en "Generate new token" → "Generate new token (classic)"
3. Configura:
   - **Note**: "HabilProf Development"
   - **Expiration**: 90 días (o lo que prefieras)
   - **Scopes**: Marca `repo` (completo)
4. Clic en "Generate token"
5. **COPIA EL TOKEN** (solo se muestra una vez)
6. Úsalo como contraseña cuando Git lo pida

### Opción 2: SSH (Alternativa)

```powershell
# Generar clave SSH
ssh-keygen -t ed25519 -C "tu@email.com"

# Copiar la clave pública
Get-Content ~/.ssh/id_ed25519.pub | Set-Clipboard

# Agregar la clave en GitHub:
# Settings → SSH and GPG keys → New SSH key
# Pegar la clave copiada

# Cambiar remote a SSH
git remote set-url origin git@github.com:TU-USUARIO/NOMBRE-REPO.git
```

## ✅ Paso 4: Verificar la Subida

1. Ve a tu repositorio en GitHub: `https://github.com/TU-USUARIO/NOMBRE-REPO`
2. Deberías ver todos tus archivos
3. Verifica que el README.md se muestra correctamente

## 👥 Paso 5: Invitar Colaboradores

1. En tu repositorio de GitHub, ve a **Settings**
2. En el menú lateral, selecciona **Collaborators**
3. Haz clic en **"Add people"**
4. Ingresa el nombre de usuario o email del colaborador
5. Selecciona el nivel de acceso:
   - **Write**: Puede hacer push y crear Pull Requests
   - **Admin**: Control total del repositorio
6. Haz clic en **"Add [usuario] to this repository"**
7. El colaborador recibirá una invitación por email

## 🔄 Paso 6: Configurar Ramas (Recomendado)

```powershell
# Crear rama de desarrollo
git checkout -b develop

# Subir rama de desarrollo
git push -u origin develop
```

### Configurar rama principal protegida en GitHub:

1. Ve a **Settings** → **Branches**
2. Haz clic en **"Add rule"**
3. En "Branch name pattern" escribe: `main`
4. Marca:
   - ✅ "Require a pull request before merging"
   - ✅ "Require approvals" (al menos 1)
   - ✅ "Require status checks to pass before merging"
5. Haz clic en **"Create"**

## 📝 Paso 7: Actualizar URLs en Documentación

Reemplaza `TU-USUARIO` y `NOMBRE-REPO` en estos archivos:

- `README.md`
- `CONTRIBUTING.md`
- `INSTALLATION.md`
- `CHANGELOG.md`
- `CODE_OF_CONDUCT.md`
- `SECURITY.md`

Ejemplo en PowerShell:

```powershell
# Buscar archivos que necesitan actualización
Select-String -Path "*.md" -Pattern "TU-USUARIO" -List
```

Actualiza manualmente cada archivo o usa un script.

## 🚀 Workflow de Trabajo

### Para los colaboradores:

```bash
# Clonar el repositorio
git clone https://github.com/TU-USUARIO/NOMBRE-REPO.git
cd NOMBRE-REPO

# Instalar dependencias
composer install
npm install

# Configurar entorno
cp .env.example .env
php artisan key:generate

# Crear rama para nueva funcionalidad
git checkout -b feature/mi-funcionalidad

# Hacer cambios, commits
git add .
git commit -m "feat: descripción del cambio"

# Subir rama
git push origin feature/mi-funcionalidad

# Crear Pull Request en GitHub
```

## 📊 Comandos Git Útiles

```bash
# Ver estado de cambios
git status

# Ver historial de commits
git log --oneline

# Ver ramas
git branch -a

# Cambiar de rama
git checkout nombre-rama

# Actualizar desde GitHub
git pull origin main

# Ver diferencias
git diff

# Deshacer cambios no commiteados
git checkout -- archivo.php

# Ver remotes configurados
git remote -v
```

## 🎯 Convenciones de Commits

Usa prefijos semánticos en tus commits:

- `feat:` - Nueva funcionalidad
- `fix:` - Corrección de bug
- `docs:` - Cambios en documentación
- `style:` - Formato de código
- `refactor:` - Refactorización
- `test:` - Agregar tests
- `chore:` - Tareas de mantenimiento

Ejemplos:
```
feat: agregar validación de RUT de alumno (R1.1)
fix: corregir formato de fecha en registros UCSC
docs: actualizar README con instrucciones de instalación
```

## ⚠️ Archivos que NO Deben Subirse

Estos archivos están en `.gitignore`:

- ❌ `.env` - Variables de entorno con credenciales
- ❌ `node_modules/` - Dependencias de npm
- ❌ `vendor/` - Dependencias de Composer
- ❌ `*.log` - Archivos de logs
- ❌ `/public/build/` - Assets compilados
- ❌ `database.sqlite` - Base de datos local

Si accidentalmente subiste algo sensible:

```bash
# Remover del historial (CUIDADO)
git rm --cached archivo-sensible
git commit -m "chore: remover archivo sensible"
git push origin main --force
```

## 🆘 Problemas Comunes

### "remote origin already exists"
```bash
git remote remove origin
git remote add origin https://github.com/TU-USUARIO/NOMBRE-REPO.git
```

### "Permission denied"
- Verifica tu autenticación (token o SSH)
- Verifica que tienes permisos en el repositorio

### "Updates were rejected"
```bash
git pull origin main --rebase
git push origin main
```

### Ver archivos que Git está ignorando
```bash
git status --ignored
```

## 📚 Recursos Adicionales

- [GitHub Guides](https://guides.github.com/)
- [Git Documentation](https://git-scm.com/doc)
- [GitHub Flow](https://guides.github.com/introduction/flow/)
- [Conventional Commits](https://www.conventionalcommits.org/)

## ✅ Checklist Final

Antes de compartir el repositorio con colaboradores:

- [ ] Repositorio creado en GitHub
- [ ] Código subido exitosamente
- [ ] README.md se ve correctamente
- [ ] `.env.example` actualizado (sin credenciales reales)
- [ ] URLs actualizadas en documentación
- [ ] Colaboradores invitados
- [ ] Rama `develop` creada
- [ ] Protecciones de rama configuradas
- [ ] GitHub Actions funcionando
- [ ] Documentación revisada
- [ ] License agregada

## 🎉 ¡Listo!

Tu proyecto ahora está en GitHub y listo para colaboración. Los colaboradores pueden:

1. Clonar el repositorio
2. Seguir las instrucciones en `INSTALLATION.md`
3. Leer `CONTRIBUTING.md` para comenzar a contribuir
4. Crear Issues para reportar bugs o sugerir funcionalidades
5. Crear Pull Requests con sus contribuciones

---

**¿Necesitas ayuda?** Abre un Issue en el repositorio o consulta la [documentación de GitHub](https://docs.github.com).

¡Feliz colaboración! 🚀
