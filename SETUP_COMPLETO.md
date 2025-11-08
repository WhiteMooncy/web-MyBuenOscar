# 🚀 Guía Completa de Configuración - MyBuenOscar Sistema Profesional

## 📋 Tabla de Contenidos
1. [Configuración de Base de Datos](#1-configuración-de-base-de-datos)
2. [Insertar Usuarios de Prueba](#2-insertar-usuarios-de-prueba)
3. [Crear Tablas de Pedidos](#3-crear-tablas-de-pedidos)
4. [Probar el Sistema](#4-probar-el-sistema)
5. [Características Implementadas](#5-características-implementadas)

---

## 1️⃣ Configuración de Base de Datos

### Paso 1: Acceder a phpMyAdmin
1. Abre tu navegador
2. Ve a: **http://localhost/phpmyadmin**
3. Selecciona la base de datos `web_mybuenoscar`

---

## 2️⃣ Insertar Usuarios de Prueba

### En phpMyAdmin → SQL:

```sql
-- Limpiar y reinsertar usuarios
TRUNCATE TABLE usuarios;

INSERT INTO usuarios (Nombre, Correo, Contraseña, Tipo_Usuario) VALUES
('Administrador', 'admin@mybuenoscar.com', 'Admin123!', 'admin'),
('Cliente Prueba', 'cliente@ejemplo.com', 'Cliente123!', 'cliente'),
('Juan Perez', 'juan@gmail.com', 'Juan123!', 'cliente');
```

**Credenciales:**
- **Admin:** admin@mybuenoscar.com / Admin123!
- **Cliente 1:** cliente@ejemplo.com / Cliente123!
- **Cliente 2:** juan@gmail.com / Juan123!

---

## 3️⃣ Crear Tablas de Pedidos

### En phpMyAdmin → SQL:

```sql
-- Tabla de Pedidos
CREATE TABLE IF NOT EXISTS pedidos (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Usuario_ID INT NOT NULL,
    Fecha_Pedido DATETIME DEFAULT CURRENT_TIMESTAMP,
    Estado ENUM('Pendiente', 'En Preparación', 'Listo', 'Entregado', 'Cancelado') DEFAULT 'Pendiente',
    Total DECIMAL(10,2) NOT NULL,
    Direccion VARCHAR(255),
    Telefono VARCHAR(20),
    Notas TEXT,
    FOREIGN KEY (Usuario_ID) REFERENCES usuarios(ID) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabla de Detalles de Pedidos
CREATE TABLE IF NOT EXISTS detalle_pedidos (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Pedido_ID INT NOT NULL,
    Producto_ID INT NOT NULL,
    Cantidad INT NOT NULL,
    Precio_Unitario DECIMAL(10,2) NOT NULL,
    Subtotal DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (Pedido_ID) REFERENCES pedidos(ID) ON DELETE CASCADE,
    FOREIGN KEY (Producto_ID) REFERENCES productos(ID) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insertar pedidos de ejemplo
INSERT INTO pedidos (Usuario_ID, Estado, Total, Direccion, Telefono, Notas) VALUES
(2, 'Pendiente', 15500, 'Av. Principal 123, Santiago', '+56912345678', 'Sin cebolla en el plato'),
(3, 'En Preparación', 8900, 'Calle Los Aromos 456', '+56987654321', 'Envío urgente'),
(2, 'Listo', 22000, 'Av. Principal 123, Santiago', '+56912345678', ''),
(3, 'Entregado', 12500, 'Calle Los Aromos 456', '+56987654321', 'Perfecto, gracias');

-- Insertar detalles (ajustar IDs según tus productos)
INSERT INTO detalle_pedidos (Pedido_ID, Producto_ID, Cantidad, Precio_Unitario, Subtotal) VALUES
(1, 1, 2, 7500, 15000),
(1, 2, 1, 500, 500),
(2, 3, 1, 8900, 8900),
(3, 1, 2, 7500, 15000),
(3, 4, 1, 7000, 7000),
(4, 2, 2, 5000, 10000),
(4, 5, 1, 2500, 2500);
```

---

## 4️⃣ Probar el Sistema

### 🔐 Iniciar Sesión
1. Ve a: **http://localhost/workbench/web-MyBuenOscar/views/login.php**
2. Ingresa credenciales de admin:
   - **Correo:** admin@mybuenoscar.com
   - **Password:** Admin123!
3. Serás redirigido al Dashboard Administrativo

### 📦 Gestión de Productos
**URL:** http://localhost/workbench/web-MyBuenOscar/views/admin/productos.php

**Funciones:**
- ✅ Ver todos los productos en tabla profesional
- ✅ Agregar nuevo producto (con upload de imagen)
- ✅ Editar producto existente
- ✅ Eliminar producto con confirmación
- ✅ Estadísticas de productos, categorías y precios
- ✅ Imágenes responsivas y optimizadas

**Categorías Disponibles:**
- Platos
- Bebidas
- Postres
- Entradas
- Sushi

### 👥 Gestión de Clientes
**URL:** http://localhost/workbench/web-MyBuenOscar/views/admin/clientes.php

**Funciones:**
- ✅ Ver todos los usuarios (admin y clientes)
- ✅ Agregar nuevo cliente/admin
- ✅ Editar información de usuario
- ✅ Cambiar contraseñas
- ✅ Eliminar usuarios (excepto cuenta propia)
- ✅ Estadísticas de usuarios por tipo
- ✅ Avatares con iniciales
- ✅ Validación de correos únicos

### 🛍️ Gestión de Pedidos
**URL:** http://localhost/workbench/web-MyBuenOscar/views/admin/pedidos.php

**Funciones:**
- ✅ Ver todos los pedidos con información completa
- ✅ Filtros por estado (Todos, Pendiente, En Preparación, Listo, Entregado)
- ✅ Cambiar estado de pedidos
- ✅ Ver detalles completos en modal
- ✅ Estadísticas de ventas diarias
- ✅ Contador de pedidos por estado
- ✅ Diseño con códigos de color por estado

**Estados de Pedido:**
- 🟡 **Pendiente** - Nuevo pedido recibido
- 🔵 **En Preparación** - Cocina trabajando
- 🟣 **Listo** - Preparado para entrega
- 🟢 **Entregado** - Completado exitosamente
- 🔴 **Cancelado** - Pedido cancelado

---

## 5️⃣ Características Implementadas

### 🎨 Navbar Inteligente
- **Usuario No Logueado:** Muestra botón "Login"
- **Usuario Logueado:** Dropdown con:
  - Nombre del usuario
  - Link a "Mi Panel" (según rol)
  - Hacer Pedido
  - **Solo Admin:** Links a Productos, Pedidos, Clientes
  - Cerrar Sesión

### 🔐 Sistema de Sesiones
- ✅ Persistencia de sesión en toda la navegación
- ✅ Redirección automática según rol (admin/cliente)
- ✅ Protección de rutas administrativas
- ✅ Validación de permisos en cada página
- ✅ Mensajes de error/éxito con animaciones

### 📊 Panel Administrativo Completo

#### **Dashboard Admin**
- Estadísticas generales
- Acceso rápido a gestión
- Tarjetas interactivas

#### **Gestión de Productos**
- CRUD completo (Create, Read, Update, Delete)
- Upload de imágenes con validación
- Soporte para: JPG, PNG, WebP, GIF
- Límite de 2MB por imagen
- Almacenamiento en `/public/assets/productos/`
- Vista previa de imágenes
- Control de stock
- Categorización

#### **Gestión de Clientes**
- CRUD completo de usuarios
- Roles: Admin y Cliente
- Validación de correos únicos
- Actualización de contraseñas (opcional)
- Protección contra auto-eliminación
- Actualización automática de sesión al editar perfil propio

#### **Gestión de Pedidos**
- Vista completa de todos los pedidos
- Filtros dinámicos por estado
- Cambio de estado con confirmación
- Modal con detalles completos:
  - Información del cliente
  - Dirección y teléfono
  - Notas del pedido
  - Lista de productos con imágenes
  - Total del pedido
- Estadísticas en tiempo real:
  - Pedidos pendientes
  - En preparación
  - Completados hoy
  - Ventas totales del día

### 🎯 Diseño Profesional
- ✅ Interfaz moderna y limpia
- ✅ Colores consistentes (verde corporativo #16a34a)
- ✅ Tipografía Poppins en todo el sistema
- ✅ Icons de Font Awesome 6.4.0
- ✅ Animaciones suaves en hover
- ✅ Sombras y degradados profesionales
- ✅ Responsive design (mobile, tablet, desktop)
- ✅ Modales centrados con backdrop
- ✅ Tablas con hover effects
- ✅ Badges de estado con colores

### 📱 Responsive
- **Desktop:** Tablas completas, grids de 3-4 columnas
- **Tablet:** Grids de 2 columnas, tablas con scroll horizontal
- **Mobile:** 1 columna, cards verticales, hamburger menu

---

## 6️⃣ Estructura de Archivos Creados

```
web-MyBuenOscar/
├── controllers/
│   ├── login.php          ✅ Autenticación
│   ├── logout.php         ✅ Cierre de sesión
│   ├── productos.php      ✅ CRUD productos
│   ├── clientes.php       ✅ CRUD clientes
│   └── pedidos.php        ✅ Gestión pedidos
├── views/
│   ├── admin/
│   │   ├── dashboard.php  ✅ Panel admin
│   │   ├── productos.php  ✅ Gestión productos
│   │   ├── clientes.php   ✅ Gestión clientes
│   │   └── pedidos.php    ✅ Gestión pedidos
│   └── cliente/
│       └── dashboard.php  ✅ Panel cliente
├── includes/
│   └── header.php         ✅ Navbar dinámica
├── public/assets/
│   └── productos/         ✅ Imágenes de productos
└── src/DB/
    ├── insert_usuarios_phpmyadmin.sql     ✅ Script usuarios
    └── create_pedidos_table.sql           ✅ Script pedidos
```

---

## 7️⃣ Flujos de Trabajo

### Flujo de Login
```
1. Usuario → /views/login.php
2. Formulario POST → /controllers/login.php
3. Validación de credenciales
4. Crear sesión con datos del usuario
5. Redirigir según tipo:
   - admin → /views/admin/dashboard.php
   - cliente → /views/cliente/dashboard.php
```

### Flujo de Gestión de Productos
```
1. Admin → /views/admin/productos.php
2. Ver lista de productos desde BD
3. Acciones disponibles:
   - Agregar: Modal → Upload imagen → INSERT BD
   - Editar: Modal con datos → UPDATE BD
   - Eliminar: Confirmación → DELETE BD + eliminar imagen
4. Redirección con mensaje de éxito/error
```

### Flujo de Gestión de Pedidos
```
1. Admin → /views/admin/pedidos.php
2. Cargar pedidos con JOIN usuarios
3. Filtrar por estado (JavaScript client-side)
4. Cambiar estado: Confirmación → UPDATE BD
5. Ver detalles: Fetch async → Modal con productos
6. Actualización automática de estadísticas
```

---

## 8️⃣ Próximos Pasos Sugeridos

### 🔐 Seguridad
- [ ] Implementar `password_hash()` para contraseñas
- [ ] Tokens CSRF en formularios
- [ ] Rate limiting en login
- [ ] Sanitización de inputs con `htmlspecialchars()`

### 📦 Funcionalidades
- [ ] Sistema de carrito para clientes
- [ ] Proceso de checkout
- [ ] Notificaciones por email
- [ ] Generación de reportes PDF
- [ ] Gráficas de ventas con Chart.js
- [ ] Búsqueda y filtros avanzados
- [ ] Paginación en tablas largas
- [ ] Exportar datos a Excel

### 🎨 UI/UX
- [ ] Dark mode
- [ ] Drag & drop para imágenes
- [ ] Crop de imágenes antes de upload
- [ ] Confirmaciones con SweetAlert2
- [ ] Loading spinners
- [ ] Toast notifications

---

## 9️⃣ Solución de Problemas

### ❌ Error: "404 Not Found" en páginas admin
**Solución:** Verifica que XAMPP esté ejecutando Apache

### ❌ Error: "Access Denied" en gestión
**Solución:** Asegúrate de estar logueado como admin

### ❌ Imágenes no se suben
**Solución:** 
1. Verifica permisos de `/public/assets/productos/`
2. Revisa `upload_max_filesize` en php.ini
3. Comprueba extensión del archivo (JPG, PNG, WebP, GIF)

### ❌ No aparecen pedidos
**Solución:** Ejecuta el script SQL de creación de tablas de pedidos

---

## 🎉 ¡Sistema Completamente Funcional!

### URLs Principales:
- 🏠 **Inicio:** http://localhost/workbench/web-MyBuenOscar/
- 🔐 **Login:** http://localhost/workbench/web-MyBuenOscar/views/login.php
- 👨‍💼 **Admin Dashboard:** http://localhost/workbench/web-MyBuenOscar/views/admin/dashboard.php
- 📦 **Productos:** http://localhost/workbench/web-MyBuenOscar/views/admin/productos.php
- 👥 **Clientes:** http://localhost/workbench/web-MyBuenOscar/views/admin/clientes.php
- 🛍️ **Pedidos:** http://localhost/workbench/web-MyBuenOscar/views/admin/pedidos.php

---

**Fecha:** 2025-11-08  
**Versión:** 2.0 - Sistema Profesional Completo  
**Desarrollado para:** MyBuenOscar Restaurant
