# 🔐 Configuración de Archivos Sensibles

## ⚠️ IMPORTANTE

Este proyecto usa `.gitignore` para proteger archivos con información sensible. 

## 📁 Archivos que NO se suben a GitHub

### 1. Configuración de Base de Datos
- ❌ `config/database.php` - Contiene credenciales de MySQL
- ✅ `config/database.example.php` - Plantilla de ejemplo

### 2. Archivos de Entorno
- ❌ `.env` - Variables de entorno sensibles
- ❌ `config/local.php` - Configuración local

### 3. Archivos Subidos por Usuarios
- ❌ `public/assets/productos/*` - Imágenes de productos
- ✅ `public/assets/productos/.gitkeep` - Mantiene la estructura

### 4. Backups de Base de Datos
- ❌ `*.sql` - Archivos de respaldo SQL
- ❌ `backups/*.sql` - Carpeta de backups

### 5. Logs y Cache
- ❌ `*.log` - Archivos de registro
- ❌ `cache/*` - Archivos de caché
- ❌ `sessions/*` - Sesiones PHP

## 🛠️ Configuración Inicial

### Paso 1: Configurar Base de Datos

```bash
# Copiar archivo de ejemplo
cp config/database.example.php config/database.php

# Editar con tus credenciales
# Abrir config/database.php y cambiar:
# - $host = "localhost"
# - $username = "tu_usuario"
# - $password = "tu_contraseña"
# - $database = "web_mybuenoscar"
```

### Paso 2: Crear Carpetas Necesarias

```bash
# Si no existen, crear:
mkdir -p public/assets/productos
mkdir -p uploads
mkdir -p cache
mkdir -p logs
mkdir -p sessions
```

### Paso 3: Configurar Permisos (Linux/Mac)

```bash
# Dar permisos de escritura a carpetas de uploads
chmod 755 public/assets/productos
chmod 755 uploads
chmod 755 cache
chmod 755 logs
chmod 755 sessions
```

### Paso 4: Configurar Apache (opcional)

Crear archivo `.htaccess` en la raíz si no existe:

```apache
# Habilitar rewrite
RewriteEngine On

# Forzar HTTPS (producción)
# RewriteCond %{HTTPS} off
# RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]

# Proteger archivos sensibles
<FilesMatch "^\.">
    Order allow,deny
    Deny from all
</FilesMatch>

# Proteger archivos de configuración
<FilesMatch "\.(php|ini|log|sh|sql)$">
    Order allow,deny
    Deny from all
</FilesMatch>

# Permitir acceso a archivos PHP públicos
<Files "index.php">
    Allow from all
</Files>
```

## 🔒 Seguridad

### Archivos que NUNCA debes subir a GitHub:

1. **Credenciales de base de datos**
   - `config/database.php`
   - Archivos `.env`

2. **Claves API y secretos**
   - `api_keys.txt`
   - `secrets.json`
   - Archivos `.key`, `.pem`

3. **Información de usuarios**
   - `passwords.txt`
   - `users.csv`
   - Sesiones PHP

4. **Backups**
   - Archivos `.sql`
   - Backups de base de datos

## 📝 Buenas Prácticas

### ✅ SÍ hacer:
- Usar `database.example.php` como plantilla
- Documentar variables de entorno necesarias
- Mantener `.gitignore` actualizado
- Revisar antes de cada commit

### ❌ NO hacer:
- Subir credenciales reales
- Commitear archivos de configuración local
- Incluir datos sensibles en el código
- Desactivar `.gitignore`

## 🚀 Deploy en Producción

### Variables de Entorno Recomendadas:

```php
// En producción, usar variables de entorno
$host = getenv('DB_HOST') ?: 'localhost';
$username = getenv('DB_USER') ?: 'root';
$password = getenv('DB_PASS') ?: '';
$database = getenv('DB_NAME') ?: 'web_mybuenoscar';
```

### Configuración de Servidor:

1. **Crear archivo de configuración** solo en el servidor
2. **Usar variables de entorno** del sistema
3. **Restringir permisos** de archivos sensibles
4. **Habilitar HTTPS** obligatorio
5. **Configurar firewall** y acceso SSH

## 📞 Soporte

Si necesitas ayuda con la configuración, consulta:
- `SETUP_COMPLETO.md` - Guía de instalación
- `GUIA_LOGIN.md` - Configuración de usuarios
- `README.md` - Documentación general

---

**Última actualización:** 2025-11-08  
**Versión:** 1.0
