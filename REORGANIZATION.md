# 📋 Reorganización del Proyecto Web-MyBuenOscar

## Fecha de Reorganización
**Noviembre 7, 2025**

## Objetivo
Reestructurar el proyecto siguiendo las mejores prácticas de desarrollo web con PHP, implementando un patrón MVC (Model-View-Controller) básico para mejorar la mantenibilidad y escalabilidad del código.

## Cambios Realizados

### 1. Nueva Estructura de Carpetas

#### ✅ Creadas
- `config/` - Archivos de configuración
- `controllers/` - Controladores de lógica de negocio
- `models/` - Modelos de datos (preparado para futuro)
- `views/` - Vistas/Templates
- `includes/` - Archivos incluibles (header, footer)
- `public/` - Carpeta pública para assets
- `public/assets/` - Recursos estáticos (CSS, JS, imágenes)

#### 📦 Reorganizadas
- `src/css/` → `public/assets/css/`
- `src/js/` → `public/assets/js/`
- `src/img/` → `public/assets/img/`
- `src/icons/` → `public/assets/icons/`
- `src/menu/` → `public/assets/menu/`

### 2. Archivos de Configuración

#### `config/config.php` ✨ NUEVO
- Configuración general de la aplicación
- Definición de constantes (rutas, URLs)
- Configuración de errores y zona horaria
- Auto-carga de dependencias

#### `config/database.php` ✨ NUEVO
- Clase `Database` con patrón Singleton
- Conexión reutilizable a MySQL
- Manejo de errores mejorado
- Configuración de charset UTF-8

**Migrado desde:**
- `php/conexion.php` → Reemplazado por clase Database

### 3. Controladores

#### `controllers/carrito.php` ✨ NUEVO
Clase `CarritoController` que unifica la lógica del carrito:
- `iniciarSesion()` - Gestión de sesión del carrito
- `agregar()` - Agregar productos
- `actualizar()` - Actualizar cantidades
- `eliminarItem()` - Eliminar productos
- `obtenerCarrito()` - Obtener items
- `calcularTotal()` - Calcular total
- `vaciarCarrito()` - Limpiar carrito

**Migrado desde:**
- `php/agregar_carrito.php` → Integrado en CarritoController::agregar()
- `php/actualizar_carrito.php` → Integrado en CarritoController::actualizar()

### 4. Vistas e Includes

#### `includes/header.php` ✨ NUEVO
- Header reutilizable para todas las páginas
- Navegación centralizada
- Uso de constantes para rutas

#### `includes/footer.php` ✨ NUEVO
- Footer reutilizable
- Scripts comunes
- Información de copyright

**Beneficio:** Código DRY (Don't Repeat Yourself) - cambios en el header/footer se reflejan en todas las páginas.

### 5. Página Principal

#### `index.php` ✨ NUEVO
- Punto de entrada principal del sitio
- Página de inicio moderna y responsive
- Secciones de características
- Enlaces a carta y promociones

### 6. Documentación

#### `README.md` 📝 ACTUALIZADO
- Estructura completa del proyecto
- Instrucciones de instalación detalladas
- Descripción de la base de datos
- Guía de uso
- Tecnologías utilizadas
- Información de contacto

#### `.gitignore` ✨ NUEVO
- Excluir archivos del sistema
- Excluir configuraciones locales
- Excluir archivos temporales
- Preparado para dependencias futuras

## Archivos Antiguos (Mantener por compatibilidad)

### Carpeta `php/` 
Archivos originales mantenidos temporalmente:
- `php/index.HTML` - Versión antigua del index
- `php/carta.php` - Carta original (migrar a `views/`)
- `php/conexion.php` - Conexión antigua (usar `config/database.php`)

### Carpeta `templates/`
Templates HTML estáticos:
- `login.html` - Migrar a `views/login.php`
- `Promos.html` - Migrar a `views/promos.php`
- `Login-update-prox.html` - Revisar si es necesario

### Carpeta `src/`
Mantiene:
- `src/DB/web-mybuenoscar.sql` - Script de base de datos

### Carpeta `a/`
- Revisar contenido y determinar si es necesario

## Próximos Pasos

### Migración Pendiente
- [ ] Migrar `php/carta.php` a `views/carta.php` con nuevo formato
- [ ] Migrar templates HTML a vistas PHP
- [ ] Actualizar rutas en JavaScript (`cart.js`)
- [ ] Crear modelos para Productos y Usuarios
- [ ] Implementar sistema de autenticación
- [ ] Crear panel de administración

### Mejoras Futuras
- [ ] Implementar autoloader PSR-4
- [ ] Usar Composer para dependencias
- [ ] Implementar sistema de templates (Twig o similar)
- [ ] Añadir validación de formularios
- [ ] Implementar CSRF protection
- [ ] Añadir logging system
- [ ] Crear API REST para el frontend

## Ventajas de la Nueva Estructura

### 🎯 Organización
- Separación clara de responsabilidades
- Código más mantenible
- Fácil de navegar y entender

### 🔒 Seguridad
- Configuración centralizada
- Assets públicos separados
- Preparado para validaciones

### 📈 Escalabilidad
- Fácil añadir nuevas funcionalidades
- Estructura preparada para crecimiento
- Patrones de diseño implementables

### 👥 Colaboración
- Estructura estándar de la industria
- Código más legible
- Documentación completa

## Compatibilidad

La reorganización mantiene compatibilidad con:
- ✅ Base de datos existente
- ✅ Assets (CSS, JS, imágenes)
- ✅ Funcionalidad del carrito
- ⚠️ Rutas antiguas (requieren actualización gradual)

## Notas Importantes

1. **No eliminar carpetas antiguas** hasta verificar que toda la funcionalidad está migrada
2. **Actualizar enlaces** en archivos JavaScript y CSS
3. **Probar exhaustivamente** cada página migrada
4. **Mantener backup** de la estructura antigua

## Testing Checklist

- [ ] Página principal carga correctamente
- [ ] Navegación funciona en todas las páginas
- [ ] Base de datos se conecta correctamente
- [ ] Carrito agrega productos
- [ ] Carrito actualiza cantidades
- [ ] Carrito elimina productos
- [ ] CSS se carga correctamente
- [ ] JavaScript funciona sin errores
- [ ] Imágenes se muestran correctamente

---

**Reorganizado por:** WhiteMooncy  
**Fecha:** Noviembre 7, 2025  
**Versión:** 2.0.0
