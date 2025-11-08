# 🧪 Guía de Testing - Web MyBuenOscar

## ✅ Pasos para Probar la Nueva Estructura

### 1. Verificar que XAMPP esté corriendo
```powershell
# Verificar Apache
netstat -ano | findstr :80

# Verificar MySQL
netstat -ano | findstr :3306
```

### 2. Acceder a la página principal
```
http://localhost/workbench/web-MyBuenOscar/
```

**Esperado:**
- ✅ Página principal con diseño moderno
- ✅ Header con navegación
- ✅ Sección de bienvenida
- ✅ Tarjetas de características
- ✅ Footer con información de contacto

### 3. Probar la base de datos
```powershell
cd c:\xampp\mysql\bin
.\mysql.exe -u root -e "USE web-mybuenoscar; SHOW TABLES;"
```

**Esperado:**
```
+---------------------------+
| Tables_in_web-mybuenoscar |
+---------------------------+
| carrito                   |
| productos                 |
| usuarios                  |
+---------------------------+
```

### 4. Verificar estructura de archivos
```powershell
cd c:\xampp\htdocs\workbench\web-MyBuenOscar
tree /F /A
```

**Esperado:** Ver todas las carpetas nuevas (config/, controllers/, includes/, public/, etc.)

### 5. Probar carga de CSS
```
http://localhost/workbench/web-MyBuenOscar/public/assets/css/Style.css
```

**Esperado:** Ver el código CSS sin errores 404

### 6. Probar carga de imágenes
```
http://localhost/workbench/web-MyBuenOscar/public/assets/img/fondo.png
```

**Esperado:** Ver la imagen de fondo

### 7. Verificar Git
```powershell
cd c:\xampp\htdocs\workbench\web-MyBuenOscar
git log --oneline -5
```

**Esperado:** Ver el commit de reorganización

---

## 🐛 Troubleshooting

### Problema: "Page not found" en index.php
**Solución:**
```powershell
# Verificar que Apache esté corriendo
c:\xampp\apache_start.bat
```

### Problema: CSS no carga
**Solución:** Verificar que la ruta en `config/config.php` sea correcta:
```php
define('BASE_URL', 'http://localhost/workbench/web-MyBuenOscar');
```

### Problema: Error de conexión a MySQL
**Solución:**
```powershell
# Iniciar MySQL
c:\xampp\mysql_start.bat

# Esperar 5 segundos y reintentar
```

### Problema: Imágenes no se ven
**Solución:** Verificar que los archivos estén en `public/assets/`:
```powershell
dir c:\xampp\htdocs\workbench\web-MyBuenOscar\public\assets\img
dir c:\xampp\htdocs\workbench\web-MyBuenOscar\public\assets\menu
```

---

## 📋 Checklist de Testing

### Estructura
- [x] Carpeta `config/` existe
- [x] Carpeta `controllers/` existe
- [x] Carpeta `models/` existe
- [x] Carpeta `views/` existe
- [x] Carpeta `includes/` existe
- [x] Carpeta `public/assets/` existe

### Archivos de Configuración
- [x] `config/config.php` creado
- [x] `config/database.php` creado
- [x] Constantes definidas correctamente

### Controladores
- [x] `controllers/carrito.php` creado
- [x] Clase `CarritoController` funcional

### Includes
- [x] `includes/header.php` creado
- [x] `includes/footer.php` creado

### Assets
- [x] CSS movido a `public/assets/css/`
- [x] JS movido a `public/assets/js/`
- [x] Imágenes movidas a `public/assets/img/`
- [x] Iconos movidos a `public/assets/icons/`
- [x] Menú movido a `public/assets/menu/`

### Documentación
- [x] `README.md` actualizado
- [x] `REORGANIZATION.md` creado
- [x] `SUMMARY.md` creado
- [x] `.gitignore` creado

### Git
- [x] Cambios committed
- [x] Cambios pushed al remoto

### Base de Datos
- [x] Base de datos `web-mybuenoscar` existe
- [x] Tabla `usuarios` existe
- [x] Tabla `productos` existe
- [x] Tabla `carrito` existe

---

## 🎯 Próximos Pasos Después del Testing

1. **Si todo funciona correctamente:**
   - ✅ Marcar la reorganización como completa
   - ✅ Comenzar a migrar `php/carta.php` a `views/carta.php`
   - ✅ Actualizar rutas en JavaScript

2. **Si hay errores:**
   - ⚠️ Revisar logs de Apache: `c:\xampp\apache\logs\error.log`
   - ⚠️ Revisar logs de PHP en el navegador (F12 → Console)
   - ⚠️ Consultar `REORGANIZATION.md` para ver qué cambió

---

## 📊 Testing Avanzado

### Probar Clase Database
Crear archivo temporal `test_db.php` en la raíz:
```php
<?php
require_once 'config/config.php';
require_once CONFIG_PATH . '/database.php';

$database = new Database();
$conn = $database->getConnection();

if ($conn) {
    echo "✅ Conexión exitosa a la base de datos<br>";
    
    $result = $conn->query("SELECT DATABASE()");
    $row = $result->fetch_row();
    echo "📊 Base de datos actual: " . $row[0];
} else {
    echo "❌ Error de conexión";
}
?>
```

Acceder a: `http://localhost/workbench/web-MyBuenOscar/test_db.php`

### Probar Clase CarritoController
Crear archivo temporal `test_carrito.php`:
```php
<?php
require_once 'config/config.php';
require_once CONTROLLERS_PATH . '/carrito.php';

$carrito = new CarritoController();
$carrito->iniciarSesion();

echo "✅ Carrito inicializado<br>";
echo "📦 Items en carrito: " . count($carrito->obtenerCarrito()) . "<br>";
echo "💰 Total: $" . $carrito->calcularTotal();
?>
```

Acceder a: `http://localhost/workbench/web-MyBuenOscar/test_carrito.php`

---

## ✨ Testing Completado

Si todos los checks están marcados, ¡la reorganización fue exitosa! 🎉

**Siguiente paso:** Continuar con el desarrollo de nuevas funcionalidades.

---

**Creado:** Noviembre 7, 2025  
**Por:** WhiteMooncy
