# 🚀 Comandos Git - Referencia Rápida

## 📋 Inicialización y Configuración

```powershell
# Inicializar repositorio
git init

# Configurar identidad
git config --global user.name "Tu Nombre"
git config --global user.email "tu@email.com"

# Ver configuración
git config --list

# Configurar editor predeterminado
git config --global core.editor "code --wait"

# Configurar fin de línea (Windows)
git config --global core.autocrlf true
```

## 🔗 Trabajar con Remotos

```powershell
# Agregar remote
git remote add origin https://github.com/TU-USUARIO/REPO.git

# Ver remotes
git remote -v

# Cambiar URL de remote
git remote set-url origin https://github.com/TU-USUARIO/NUEVO-REPO.git

# Remover remote
git remote remove origin

# Renombrar remote
git remote rename origin upstream
```

## 📝 Commits y Staging

```powershell
# Ver estado
git status

# Agregar archivos específicos
git add archivo.php
git add carpeta/

# Agregar todos los archivos
git add .

# Agregar archivos por partes (interactivo)
git add -p

# Ver diferencias antes de commit
git diff
git diff --staged

# Commit
git commit -m "feat: descripción del cambio"

# Commit con mensaje detallado
git commit

# Modificar último commit
git commit --amend

# Deshacer staging
git restore --staged archivo.php
```

## 📤 Push y Pull

```powershell
# Push por primera vez
git push -u origin main

# Push normal
git push

# Push de rama específica
git push origin nombre-rama

# Push forzado (CUIDADO)
git push --force

# Push de todas las ramas
git push --all

# Pull (actualizar desde remoto)
git pull

# Pull con rebase
git pull --rebase

# Fetch (descargar sin merge)
git fetch
git fetch origin
```

## 🌿 Ramas (Branches)

```powershell
# Ver ramas locales
git branch

# Ver todas las ramas (incluye remotas)
git branch -a

# Crear rama
git branch nombre-rama

# Cambiar de rama
git checkout nombre-rama

# Crear y cambiar de rama
git checkout -b nombre-rama

# Renombrar rama actual
git branch -m nuevo-nombre

# Eliminar rama local
git branch -d nombre-rama

# Eliminar rama forzado
git branch -D nombre-rama

# Eliminar rama remota
git push origin --delete nombre-rama

# Actualizar lista de ramas remotas
git fetch -p
```

## 🔀 Merge y Rebase

```powershell
# Merge de rama a rama actual
git merge nombre-rama

# Merge sin fast-forward
git merge --no-ff nombre-rama

# Abortar merge
git merge --abort

# Rebase
git rebase main

# Continuar rebase después de resolver conflictos
git rebase --continue

# Abortar rebase
git rebase --abort

# Rebase interactivo (últimos 3 commits)
git rebase -i HEAD~3
```

## 📜 Historial y Logs

```powershell
# Ver historial
git log

# Ver historial resumido
git log --oneline

# Ver historial con gráfico
git log --graph --oneline --all

# Ver últimos N commits
git log -n 5

# Ver commits de un autor
git log --author="Nombre"

# Ver cambios de un archivo
git log -p archivo.php

# Ver quién modificó cada línea
git blame archivo.php

# Buscar en commits
git log --grep="búsqueda"
```

## 🔍 Inspección y Comparación

```powershell
# Ver cambios no commiteados
git diff

# Ver cambios en staging
git diff --staged

# Comparar ramas
git diff main..develop

# Comparar con commit específico
git diff HEAD~2

# Ver archivos cambiados
git diff --name-only

# Ver estadísticas de cambios
git diff --stat
```

## ↩️ Deshacer Cambios

```powershell
# Descartar cambios en archivo (antes de staging)
git restore archivo.php
git checkout -- archivo.php

# Quitar archivo de staging
git restore --staged archivo.php
git reset HEAD archivo.php

# Deshacer último commit (mantiene cambios)
git reset --soft HEAD~1

# Deshacer último commit (descarta cambios)
git reset --hard HEAD~1

# Volver a commit específico
git reset --hard abc123

# Crear commit que revierte cambios
git revert abc123

# Limpiar archivos no trackeados
git clean -n  # Ver qué se eliminará
git clean -f  # Eliminar archivos
git clean -fd # Eliminar archivos y directorios
```

## 🏷️ Tags

```powershell
# Listar tags
git tag

# Crear tag ligero
git tag v1.0.0

# Crear tag anotado
git tag -a v1.0.0 -m "Versión 1.0.0"

# Tag en commit específico
git tag -a v1.0.0 abc123

# Push de tag
git push origin v1.0.0

# Push de todos los tags
git push origin --tags

# Eliminar tag local
git tag -d v1.0.0

# Eliminar tag remoto
git push origin --delete v1.0.0

# Ver información de tag
git show v1.0.0
```

## 🔧 Stash (Guardar Cambios Temporalmente)

```powershell
# Guardar cambios temporalmente
git stash

# Guardar con mensaje
git stash save "descripción"

# Listar stashes
git stash list

# Aplicar último stash
git stash apply

# Aplicar stash específico
git stash apply stash@{1}

# Aplicar y eliminar stash
git stash pop

# Eliminar stash
git stash drop stash@{1}

# Eliminar todos los stashes
git stash clear

# Ver contenido de stash
git stash show -p stash@{0}
```

## 🔎 Búsqueda

```powershell
# Buscar en archivos trackeados
git grep "búsqueda"

# Buscar en todo el historial
git log -S "búsqueda"

# Buscar commits que agregaron/eliminaron texto
git log -G "expresión-regular"
```

## 📊 Estadísticas

```powershell
# Ver estadísticas del repo
git shortlog -sn

# Ver contribuciones por autor
git shortlog -sn --all

# Tamaño del repositorio
git count-objects -vH

# Ver archivos más grandes
git rev-list --objects --all | `
  git cat-file --batch-check='%(objecttype) %(objectname) %(objectsize) %(rest)' | `
  Where-Object { $_ -match '^blob' } | `
  Sort-Object -Property @{Expression={($_ -split '\s+')[2] -as [int]}} -Descending | `
  Select-Object -First 10
```

## 🛠️ Mantenimiento

```powershell
# Optimizar repositorio
git gc

# Verificar integridad
git fsck

# Limpiar referencias obsoletas
git remote prune origin

# Ver espacio usado
git count-objects -vH
```

## 🔐 Credenciales

```powershell
# Guardar credenciales temporalmente (15 min)
git config --global credential.helper cache

# Guardar credenciales permanentemente (Windows)
git config --global credential.helper manager

# Ver credenciales guardadas
git credential-manager-core list

# Borrar credenciales
git credential-manager-core remove
```

## 🎯 Workflows Comunes

### Iniciar nuevo proyecto en GitHub

```powershell
git init
git add .
git commit -m "feat: commit inicial"
git branch -M main
git remote add origin https://github.com/TU-USUARIO/REPO.git
git push -u origin main
```

### Crear feature branch

```powershell
git checkout -b feature/nueva-funcionalidad
# ... hacer cambios ...
git add .
git commit -m "feat: agregar nueva funcionalidad"
git push -u origin feature/nueva-funcionalidad
# Crear Pull Request en GitHub
```

### Actualizar fork

```powershell
git remote add upstream https://github.com/ORIGINAL-OWNER/REPO.git
git fetch upstream
git checkout main
git merge upstream/main
git push origin main
```

### Sincronizar con main

```powershell
git checkout main
git pull origin main
git checkout mi-rama
git rebase main
git push -f origin mi-rama
```

### Corregir último commit

```powershell
# Cambiar mensaje
git commit --amend -m "nuevo mensaje"

# Agregar archivos olvidados
git add archivo-olvidado.php
git commit --amend --no-edit

# Push del cambio
git push --force-with-lease origin mi-rama
```

## 🚨 Emergencias

### Recuperar commit eliminado

```powershell
git reflog
git checkout abc123  # código del commit perdido
```

### Resolver conflictos

```powershell
# Ver archivos con conflictos
git status

# Abrir en editor
code archivo-con-conflicto.php

# Marcar como resuelto
git add archivo-con-conflicto.php

# Continuar merge/rebase
git merge --continue
# o
git rebase --continue
```

### Cancelar todo y empezar de nuevo

```powershell
git fetch origin
git reset --hard origin/main
```

## 📚 Alias Útiles

Agregar a `~/.gitconfig`:

```ini
[alias]
    st = status
    co = checkout
    br = branch
    ci = commit
    unstage = restore --staged
    last = log -1 HEAD
    visual = log --graph --oneline --all
    amend = commit --amend --no-edit
    undo = reset --soft HEAD~1
    contributors = shortlog -sn
```

Usar:
```powershell
git st
git co main
git visual
```

## 🔗 Recursos

- [Git Documentation](https://git-scm.com/doc)
- [GitHub Guides](https://guides.github.com/)
- [Git Cheat Sheet](https://training.github.com/downloads/github-git-cheat-sheet.pdf)
- [Oh My Git!](https://ohmygit.org/) - Juego para aprender Git

---

**Tip**: Usa `git help <comando>` para ver ayuda detallada de cualquier comando.

Ejemplo: `git help commit`
