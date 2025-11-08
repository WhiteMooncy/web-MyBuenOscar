# 🍝 Web MyBuenOscar - Sistema de Pedidos Online

Sistema web para el restaurante MyBuenOscar con gestión de menú, carrito de compras y pedidos en línea.

## 📋 Descripción

MyBuenOscar es una aplicación web desarrollada en PHP que permite a los clientes:
- Ver el menú completo del restaurante
- Agregar productos al carrito de compras
- Realizar pedidos online
- Gestionar cuenta de usuario
- Ver promociones especiales

## 🏗️ Estructura del Proyecto

```
web-MyBuenOscar/
│
├── config/                     # Archivos de configuración
│   ├── config.php             # Configuración general de la app
│   └── database.php           # Clase de conexión a la BD
│
├── controllers/                # Controladores de lógica de negocio
│   └── carrito.php            # Controlador del carrito de compras
│
├── models/                     # Modelos de datos (ORM)
│   └── (pendiente)
│
├── views/                      # Vistas/Templates HTML
│   ├── carta.php              # Vista del menú/carta
│   ├── login.php              # Vista de inicio de sesión
│   └── promos.php             # Vista de promociones
│
├── includes/                   # Archivos incluibles (header, footer)
│   ├── header.php             # Header común
│   └── footer.php             # Footer común
│
├── public/                     # Archivos públicos accesibles
│   └── assets/                # Recursos estáticos
│       ├── css/               # Hojas de estilo
│       │   └── Style.css
│       ├── js/                # Scripts JavaScript
│       │   └── cart.js
│       ├── img/               # Imágenes generales
│       ├── icons/             # Iconos
│       └── menu/              # Imágenes del menú
│           ├── bebidas/
│           └── platos/
│
├── src/                        # Archivos fuente adicionales
│   └── DB/
│       └── web-mybuenoscar.sql # Script de base de datos
│
├── index.php                   # Página principal/inicio
└── README.md                   # Este archivo
```

## 🚀 Instalación

### Requisitos Previos
- XAMPP (Apache + MySQL + PHP 7.4+)
- Navegador web moderno
- Git (opcional)

### Pasos de Instalación

1. **Clonar o descargar el proyecto**
   ```bash
   cd c:\xampp\htdocs\workbench
   git clone https://github.com/WhiteMooncy/web-MyBuenOscar.git
   ```

2. **Configurar la base de datos**
   
   a. Iniciar XAMPP y activar Apache y MySQL
   
   b. Crear la base de datos:
   ```bash
   cd c:\xampp\mysql\bin
   .\mysql.exe -u root
   ```
   
   c. En la consola MySQL:
   ```sql
   CREATE DATABASE IF NOT EXISTS `web-mybuenoscar`;
   USE `web-mybuenoscar`;
   source c:\xampp\htdocs\workbench\web-MyBuenOscar\src\DB\web-mybuenoscar.sql;
   ```

3. **Configurar la aplicación**
   
   Editar `config/database.php` si es necesario (por defecto usa root sin contraseña):
   ```php
   private $host = "localhost";
   private $usuario = "root";
   private $contrasena = "";
   private $basededatos = "web-mybuenoscar";
   ```

4. **Acceder a la aplicación**
   
   Abrir en el navegador:
   ```
   http://localhost/workbench/web-MyBuenOscar/
   ```

## 📊 Base de Datos

La base de datos incluye las siguientes tablas:

### `usuarios`
- ID (PK, AUTO_INCREMENT)
- Nombre
- Correo (UNIQUE)
- Contraseña (encriptada)
- Tipo_Usuario (admin/cliente)

### `productos`
- ID (PK, AUTO_INCREMENT)
- Nombre
- Descripcion
- precio
- imagen
- categoria

### `carrito`
- ID (PK, AUTO_INCREMENT)
- user_id (FK)
- producto_id (FK)
- cantidad

## 🎨 Características

### Implementadas
- ✅ Sistema de carrito de compras con sesiones
- ✅ Visualización de menú/carta
- ✅ Estructura MVC organizada
- ✅ Diseño responsive
- ✅ Base de datos MySQL

### En Desarrollo
- 🔄 Sistema de autenticación de usuarios
- 🔄 Panel de administración
- 🔄 Gestión de pedidos
- 🔄 Pasarela de pagos
- 🔄 Sistema de promociones

## 💻 Uso

### Para Clientes
1. Navegar por la carta de productos
2. Agregar productos al carrito
3. Ajustar cantidades
4. Realizar pedido (próximamente)

### Para Administradores
1. Login con credenciales de admin
2. Gestionar productos
3. Ver pedidos
4. Administrar usuarios

## 🛠️ Tecnologías Utilizadas

- **Frontend:**
  - HTML5
  - CSS3
  - JavaScript (Vanilla)
  - Google Fonts (Poppins)

- **Backend:**
  - PHP 7.4+
  - MySQL/MariaDB
  - PDO/MySQLi

- **Servidor:**
  - Apache (XAMPP)

## 📝 Notas de Desarrollo

### Convenciones de Código
- Nombres de archivos en minúsculas con guiones bajos
- Clases en PascalCase
- Variables en camelCase
- Comentarios en español

### Rutas y URLs
- Base URL definida en `config/config.php`
- Rutas absolutas usando constantes PHP
- Assets servidos desde `public/assets/`

## 🔐 Seguridad

- Validación de entrada de datos
- Escape de salida HTML
- Sesiones seguras con httponly
- Contraseñas hasheadas (próximamente con password_hash)

## 📞 Contacto

- **Email:** MyBuenOscarRestaurant@gmail.com
- **WhatsApp:** +56 9 5891 7375
- **GitHub:** [WhiteMooncy](https://github.com/WhiteMooncy)

## 📄 Licencia

Este proyecto es privado y pertenece a MyBuenOscar Restaurant.

---

**Versión:** 1.0.0  
**Última actualización:** Noviembre 2025  
**Desarrollador:** WhiteMooncy
