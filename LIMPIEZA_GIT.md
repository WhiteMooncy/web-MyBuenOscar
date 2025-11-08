# 🧹 Script de Limpieza de Archivos Sensibles

## ⚠️ IMPORTANTE - Leer antes de ejecutar

Este script elimina archivos sensibles del tracking de Git **sin borrarlos del disco**.

## 📋 Archivos a remover del tracking

### ❌ Archivos que contienen credenciales:
- `config/database.php` - Credenciales de MySQL
- `CREDENTIALS.md` - Credenciales de usuarios de prueba

### ℹ️ Archivos SQL (mantener en repositorio):
- `src/DB/*.sql` - Scripts de estructura (SÍ deben estar en Git)

## 🛠️ Comandos para Limpiar

### Opción 1: Remover solo del tracking (Recomendado)

Esto mantiene los archivos en tu disco pero deja de trackearlos en Git:

```bash
# Remover config/database.php del tracking
git rm --cached config/database.php

# Remover CREDENTIALS.md del tracking
git rm --cached CREDENTIALS.md

# Commit de los cambios
git commit -m "chore: Remover archivos sensibles del tracking de Git"

# Push al repositorio
git push origin WhiteMooncy-patch-carta
```

### Opción 2: Limpiar del historial completo (Avanzado)

⚠️ **ADVERTENCIA:** Esto reescribe el historial de Git. Úsalo solo si es necesario.

```bash
# Instalar git-filter-repo (si no lo tienes)
# pip install git-filter-repo

# Remover archivo del historial
git filter-repo --path config/database.php --invert-paths
git filter-repo --path CREDENTIALS.md --invert-paths

# Force push (requiere permisos)
git push origin --force --all
```

## 📝 Pasos Recomendados

### 1. Backup antes de proceder

```bash
# Hacer backup de archivos importantes
cp config/database.php config/database.backup.php
cp CREDENTIALS.md CREDENTIALS.backup.md
```

### 2. Remover del tracking

```bash
# Ejecutar desde la raíz del proyecto
cd c:\xampp\htdocs\workbench\web-MyBuenOscar

# Remover archivos del tracking
git rm --cached config/database.php
git rm --cached CREDENTIALS.md

# Verificar estado
git status
```

### 3. Crear versiones de ejemplo

```bash
# Ya creamos database.example.php
# Actualizar CREDENTIALS.md con instrucciones, sin datos reales
```

### 4. Commit y Push

```bash
git add .
git commit -m "chore: Remover archivos sensibles y agregar .gitignore completo"
git push origin WhiteMooncy-patch-carta
```

## ✅ Verificación Post-Limpieza

### Comprobar que archivos ya no están trackeados:

```bash
git ls-files | Select-String -Pattern "database.php|CREDENTIALS.md"
# No debería mostrar resultados
```

### Comprobar .gitignore funciona:

```bash
# Modificar database.php
# Ejecutar git status
# No debería aparecer en cambios
```

## 🔐 Alternativa: Actualizar CREDENTIALS.md

En lugar de eliminarlo, puedes convertirlo en documentación sin datos sensibles:

```markdown
# Credenciales del Sistema

## ⚠️ IMPORTANTE
No almacenar credenciales reales en este archivo.

## Usuarios de Prueba

Para crear usuarios de prueba, ejecuta el script SQL en phpMyAdmin:
- Archivo: `src/DB/insert_usuarios_phpmyadmin.sql`
- Credenciales de ejemplo se definen ahí

## Admin de Ejemplo:
- Email: admin@mybuenoscar.com
- Password: [Definir en instalación]

## Cliente de Ejemplo:
- Email: cliente@ejemplo.com
- Password: [Definir en instalación]

Consulta SETUP_COMPLETO.md para instrucciones de configuración.
```

## 📞 Soporte

Si tienes dudas sobre este proceso:
1. Revisa la documentación de Git
2. Haz backup antes de cualquier operación
3. Prueba en un branch separado primero

---

**Fecha:** 2025-11-08  
**Autor:** Sistema MyBuenOscar
