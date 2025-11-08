# 🚀 PROMPT COMPLETO: E-Commerce Profesional para Restaurante

## 📋 CONTEXTO DEL PROYECTO

Crea un sistema de e-commerce profesional para un restaurante llamado "MyBuenOscar" que permita gestión administrativa completa, sistema de pedidos online, autenticación de usuarios y panel de control con estadísticas en tiempo real.

---

## 🎯 OBJETIVOS DEL SISTEMA

### Objetivo Principal
Desarrollar una plataforma web completa que permita a clientes realizar pedidos de comida online y a administradores gestionar productos, clientes y pedidos desde un panel profesional.

### Objetivos Específicos
1. **Autenticación segura** con roles diferenciados (Admin/Cliente)
2. **Gestión CRUD completa** de productos, clientes y pedidos
3. **Sistema de pedidos** con estados y seguimiento
4. **Panel administrativo** con estadísticas en tiempo real
5. **Interfaz moderna y responsive** que funcione en todos los dispositivos
6. **Experiencia de usuario fluida** con navegación intuitiva

---

## 🏗️ ARQUITECTURA DEL SISTEMA

### Patrón de Diseño
**MVC (Model-View-Controller)** - Separación clara de responsabilidades

```
Estructura de Directorios:
web-MyBuenOscar/
├── config/
│   ├── config.php              # Constantes globales y configuración
│   └── database.php            # Clase de conexión a BD (Singleton)
├── controllers/
│   ├── login.php               # Controlador de autenticación
│   ├── logout.php              # Controlador de cierre de sesión
│   ├── productos.php           # CRUD de productos
│   ├── clientes.php            # CRUD de clientes/usuarios
│   ├── pedidos.php             # Gestión de pedidos y estados
│   └── carrito.php             # Gestión del carrito de compras
├── models/
│   └── (futuro: clases de entidades)
├── views/
│   ├── login.php               # Página de inicio de sesión
│   ├── carta.php               # Catálogo de productos
│   ├── promos.php              # Página de promociones
│   ├── admin/
│   │   ├── dashboard.php       # Panel principal admin
│   │   ├── productos.php       # Gestión de productos
│   │   ├── clientes.php        # Gestión de clientes
│   │   └── pedidos.php         # Gestión de pedidos
│   └── cliente/
│       └── dashboard.php       # Panel del cliente
├── includes/
│   ├── header.php              # Navbar dinámica con sesión
│   └── footer.php              # Footer responsive
├── public/
│   └── assets/
│       ├── css/
│       │   └── Style-new.css   # Estilos principales
│       ├── productos/          # Imágenes de productos subidas
│       └── menu/               # Imágenes del menú estático
├── src/
│   └── DB/
│       ├── web-mybuenoscar.sql              # Estructura completa de BD
│       ├── insert_usuarios_phpmyadmin.sql   # Usuarios de prueba
│       └── create_pedidos_table.sql         # Tablas de pedidos
├── index.php                   # Página de inicio
├── SETUP_COMPLETO.md          # Documentación de configuración
└── GUIA_LOGIN.md              # Guía del sistema de login
```

---

## 💾 BASE DE DATOS

### Estructura de Tablas

#### 1. **usuarios** - Gestión de cuentas
```sql
CREATE TABLE usuarios (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(100) NOT NULL,
    Correo VARCHAR(100) UNIQUE NOT NULL,
    Contraseña VARCHAR(255) NOT NULL,
    Tipo_Usuario ENUM('admin', 'cliente') DEFAULT 'cliente',
    Fecha_Registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_correo (Correo),
    INDEX idx_tipo (Tipo_Usuario)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

**Campos clave:**
- `ID`: Identificador único
- `Correo`: Email único para login
- `Contraseña`: Almacenada en texto plano (MEJORAR: usar password_hash())
- `Tipo_Usuario`: Define permisos (admin o cliente)

#### 2. **productos** - Catálogo de productos
```sql
CREATE TABLE productos (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(150) NOT NULL,
    Categoria VARCHAR(50) NOT NULL,
    Precio DECIMAL(10,2) NOT NULL,
    Stock INT DEFAULT 0,
    Descripcion TEXT,
    Imagen VARCHAR(255) DEFAULT 'public/assets/img/default-product.jpg',
    Fecha_Creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_categoria (Categoria),
    INDEX idx_precio (Precio)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

**Características:**
- Soporte para categorías: Platos, Bebidas, Postres, Entradas, Sushi
- Control de stock con indicadores visuales
- Upload de imágenes (JPG, PNG, WebP, GIF)
- Precio con 2 decimales para mayor precisión

#### 3. **pedidos** - Órdenes de compra
```sql
CREATE TABLE pedidos (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Usuario_ID INT NOT NULL,
    Fecha_Pedido DATETIME DEFAULT CURRENT_TIMESTAMP,
    Estado ENUM('Pendiente', 'En Preparación', 'Listo', 'Entregado', 'Cancelado') 
           DEFAULT 'Pendiente',
    Total DECIMAL(10,2) NOT NULL,
    Direccion VARCHAR(255),
    Telefono VARCHAR(20),
    Notas TEXT,
    FOREIGN KEY (Usuario_ID) REFERENCES usuarios(ID) ON DELETE CASCADE,
    INDEX idx_estado (Estado),
    INDEX idx_fecha (Fecha_Pedido)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

**Estados del pedido:**
- 🟡 **Pendiente**: Recién recibido, esperando confirmación
- 🔵 **En Preparación**: Cocina trabajando en el pedido
- 🟣 **Listo**: Preparado, esperando entrega/retiro
- 🟢 **Entregado**: Completado exitosamente
- 🔴 **Cancelado**: Pedido cancelado (por cliente o admin)

#### 4. **detalle_pedidos** - Items de cada pedido
```sql
CREATE TABLE detalle_pedidos (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Pedido_ID INT NOT NULL,
    Producto_ID INT NOT NULL,
    Cantidad INT NOT NULL,
    Precio_Unitario DECIMAL(10,2) NOT NULL,
    Subtotal DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (Pedido_ID) REFERENCES pedidos(ID) ON DELETE CASCADE,
    FOREIGN KEY (Producto_ID) REFERENCES productos(ID) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

**Relaciones:**
- `ON DELETE CASCADE`: Si se elimina el pedido, se eliminan sus detalles
- `ON DELETE RESTRICT`: No permite eliminar producto si está en pedidos

#### 5. **carrito** - Carrito de compras temporal
```sql
CREATE TABLE carrito (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Usuario_ID INT NOT NULL,
    Producto_ID INT NOT NULL,
    Cantidad INT DEFAULT 1,
    Fecha_Agregado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (Usuario_ID) REFERENCES usuarios(ID) ON DELETE CASCADE,
    FOREIGN KEY (Producto_ID) REFERENCES productos(ID) ON DELETE CASCADE,
    UNIQUE KEY unique_cart_item (Usuario_ID, Producto_ID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

---

## 🔐 SISTEMA DE AUTENTICACIÓN

### Flujo de Login

```
1. Usuario accede a /views/login.php
2. Formulario POST → /controllers/login.php
3. Validación de credenciales:
   - Verificar campos no vacíos
   - Consulta SQL con prepared statement
   - Verificar contraseña (actualmente texto plano)
4. Si credenciales correctas:
   - Crear variables de sesión:
     * $_SESSION['user_id']
     * $_SESSION['user_name']
     * $_SESSION['user_email']
     * $_SESSION['user_type']
     * $_SESSION['logged_in'] = true
   - Cookie "Recordarme" (opcional, 30 días)
5. Redirigir según rol:
   - admin → /views/admin/dashboard.php
   - cliente → /views/cliente/dashboard.php
6. Si credenciales incorrectas:
   - $_SESSION['error'] = mensaje
   - Redirigir a login.php
```

### Código del Controlador de Login

```php
<?php
require_once dirname(__DIR__) . '/config/config.php';
require_once CONFIG_PATH . '/database.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $remember = isset($_POST['remember']);
    
    if (empty($email) || empty($password)) {
        $_SESSION['error'] = 'Por favor completa todos los campos';
        header('Location: ' . BASE_URL . '/views/login.php');
        exit;
    }
    
    $database = new Database();
    $conn = $database->getConnection();
    
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE Correo = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        
        // NOTA: En producción usar password_verify()
        if ($password === $user['Contraseña']) {
            $_SESSION['user_id'] = $user['ID'];
            $_SESSION['user_name'] = $user['Nombre'];
            $_SESSION['user_email'] = $user['Correo'];
            $_SESSION['user_type'] = $user['Tipo_Usuario'];
            $_SESSION['logged_in'] = true;
            
            if ($remember) {
                setcookie('user_email', $email, time() + (86400 * 30), "/");
            }
            
            if ($user['Tipo_Usuario'] === 'admin') {
                header('Location: ' . BASE_URL . '/views/admin/dashboard.php');
            } else {
                header('Location: ' . BASE_URL . '/views/cliente/dashboard.php');
            }
            exit;
        }
    }
    
    $_SESSION['error'] = 'Credenciales incorrectas';
    header('Location: ' . BASE_URL . '/views/login.php');
    exit;
}
?>
```

### Protección de Rutas Administrativas

```php
<?php
session_start();

// En CADA página administrativa
if (!isset($_SESSION['logged_in']) || $_SESSION['user_type'] !== 'admin') {
    $_SESSION['error'] = 'Acceso denegado. Solo administradores.';
    header('Location: ' . BASE_URL . '/views/login.php');
    exit;
}
?>
```

---

## 🎨 DISEÑO Y EXPERIENCIA DE USUARIO

### Paleta de Colores

```css
:root {
    /* Colores Principales */
    --primary-green: #16a34a;
    --primary-dark: #15803d;
    --secondary-blue: #3b82f6;
    --accent-orange: #f59e0b;
    
    /* Colores de Estado */
    --success: #10b981;
    --warning: #f59e0b;
    --error: #ef4444;
    --info: #3b82f6;
    
    /* Grises */
    --gray-50: #f9fafb;
    --gray-100: #f3f4f6;
    --gray-200: #e5e7eb;
    --gray-300: #d1d5db;
    --gray-400: #9ca3af;
    --gray-500: #6b7280;
    --gray-600: #4b5563;
    --gray-700: #374151;
    --gray-800: #1f2937;
    --gray-900: #111827;
    
    /* Tipografía */
    --font-primary: 'Poppins', sans-serif;
}
```

### Tipografía

```html
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
```

**Jerarquía:**
- H1: 2.5rem (40px) - Bold (700)
- H2: 2rem (32px) - Bold (700)
- H3: 1.75rem (28px) - SemiBold (600)
- Body: 1rem (16px) - Regular (400)
- Small: 0.875rem (14px) - Regular (400)

### Componentes UI

#### Navbar Dinámica con Sesión

```php
<?php
// En includes/header.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$is_logged_in = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
$user_name = $_SESSION['user_name'] ?? '';
$user_type = $_SESSION['user_type'] ?? '';
?>

<nav class="navbar">
    <ul class="nav-menu">
        <li><a href="/index.php">Inicio</a></li>
        <li><a href="/views/carta.php">Carta</a></li>
        <li><a href="/views/promos.php">Promociones</a></li>
        
        <?php if ($is_logged_in): ?>
            <!-- Usuario Logueado -->
            <li class="dropdown">
                <a href="#" style="background: linear-gradient(135deg, #16a34a 0%, #15803d 100%);">
                    <i class="fas fa-user-circle"></i> <?php echo htmlspecialchars($user_name); ?>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="/views/<?php echo $user_type === 'admin' ? 'admin' : 'cliente'; ?>/dashboard.php">
                        Mi Panel
                    </a></li>
                    <?php if ($user_type === 'admin'): ?>
                        <li><a href="/views/admin/productos.php">Productos</a></li>
                        <li><a href="/views/admin/pedidos.php">Pedidos</a></li>
                        <li><a href="/views/admin/clientes.php">Clientes</a></li>
                    <?php endif; ?>
                    <li><a href="/controllers/logout.php" style="color: #ef4444;">Cerrar Sesión</a></li>
                </ul>
            </li>
        <?php else: ?>
            <!-- Usuario No Logueado -->
            <li><a href="/views/login.php">Login</a></li>
        <?php endif; ?>
    </ul>
</nav>
```

#### Modales Profesionales

```html
<!-- Modal Genérico -->
<div id="modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; 
     background: rgba(0,0,0,0.5); z-index: 9999; align-items: center; justify-content: center;">
    <div style="background: white; padding: 2.5rem; border-radius: 20px; max-width: 600px; 
         width: 90%; max-height: 90vh; overflow-y: auto; 
         box-shadow: 0 20px 60px rgba(0,0,0,0.3);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <h2 id="modalTitle">Título del Modal</h2>
            <button onclick="closeModal()" style="background: none; border: none; font-size: 1.5rem; 
                    cursor: pointer; color: #6b7280;">&times;</button>
        </div>
        <div id="modalContent">
            <!-- Contenido dinámico -->
        </div>
    </div>
</div>

<script>
function openModal() {
    document.getElementById('modal').style.display = 'flex';
}

function closeModal() {
    document.getElementById('modal').style.display = 'none';
}

// Cerrar al hacer clic fuera
document.getElementById('modal').addEventListener('click', function(e) {
    if (e.target === this) closeModal();
});
</script>
```

#### Tarjetas de Estadísticas

```html
<div style="background: white; padding: 1.5rem; border-radius: 12px; 
     box-shadow: 0 2px 10px rgba(0,0,0,0.08); border-left: 4px solid #16a34a;">
    <p style="color: #6b7280; font-size: 0.9rem; margin-bottom: 0.5rem;">
        Título de la Métrica
    </p>
    <h3 style="color: #1f2937; font-size: 2rem; margin: 0; font-weight: 700;">
        156
    </h3>
    <p style="color: #10b981; margin: 0; font-size: 0.9rem; margin-top: 0.5rem;">
        <i class="fas fa-arrow-up"></i> +12% vs mes anterior
    </p>
</div>
```

#### Badges de Estado

```php
<?php
$estadoColor = [
    'Pendiente' => '#f59e0b',
    'En Preparación' => '#3b82f6',
    'Listo' => '#8b5cf6',
    'Entregado' => '#10b981',
    'Cancelado' => '#ef4444'
];
$color = $estadoColor[$estado] ?? '#6b7280';
?>

<span style="background: <?php echo $color; ?>20; 
             color: <?php echo $color; ?>; 
             padding: 0.5rem 1rem; border-radius: 8px; 
             font-weight: 600; font-size: 0.9rem;">
    <?php echo $estado; ?>
</span>
```

### Responsive Design

```css
/* Mobile First Approach */

/* Mobile (default) */
.grid-container {
    display: grid;
    grid-template-columns: 1fr;
    gap: 1rem;
}

/* Tablet */
@media (min-width: 768px) {
    .grid-container {
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }
}

/* Desktop */
@media (min-width: 1024px) {
    .grid-container {
        grid-template-columns: repeat(3, 1fr);
        gap: 2rem;
    }
}

/* Large Desktop */
@media (min-width: 1280px) {
    .grid-container {
        grid-template-columns: repeat(4, 1fr);
    }
}
```

---

## 📦 GESTIÓN DE PRODUCTOS

### Controlador CRUD Completo

```php
<?php
// controllers/productos.php

require_once dirname(__DIR__) . '/config/config.php';
require_once CONFIG_PATH . '/database.php';

session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['user_type'] !== 'admin') {
    $_SESSION['error'] = 'Acceso denegado';
    header('Location: ' . BASE_URL . '/views/login.php');
    exit;
}

$database = new Database();
$conn = $database->getConnection();
$action = $_POST['action'] ?? '';

switch ($action) {
    case 'add':
        addProduct($conn);
        break;
    case 'edit':
        editProduct($conn);
        break;
    case 'delete':
        deleteProduct($conn);
        break;
}

function addProduct($conn) {
    $nombre = $_POST['nombre'] ?? '';
    $categoria = $_POST['categoria'] ?? '';
    $precio = $_POST['precio'] ?? 0;
    $stock = $_POST['stock'] ?? 0;
    $descripcion = $_POST['descripcion'] ?? '';
    
    if (empty($nombre) || empty($categoria) || $precio <= 0) {
        $_SESSION['error'] = 'Completa todos los campos';
        header('Location: ' . BASE_URL . '/views/admin/productos.php');
        exit;
    }
    
    // Manejar imagen
    $imagen = 'public/assets/img/default-product.jpg';
    
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = dirname(__DIR__) . '/public/assets/productos/';
        
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        
        $fileExtension = strtolower(pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION));
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
        
        if (in_array($fileExtension, $allowedExtensions)) {
            $newFileName = uniqid('prod_') . '.' . $fileExtension;
            $targetPath = $uploadDir . $newFileName;
            
            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $targetPath)) {
                $imagen = 'public/assets/productos/' . $newFileName;
            }
        }
    }
    
    $stmt = $conn->prepare("INSERT INTO productos (Nombre, Categoria, Precio, Stock, Descripcion, Imagen) 
                           VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdiis", $nombre, $categoria, $precio, $stock, $descripcion, $imagen);
    
    if ($stmt->execute()) {
        $_SESSION['success'] = 'Producto agregado correctamente';
    } else {
        $_SESSION['error'] = 'Error: ' . $conn->error;
    }
    
    $stmt->close();
    header('Location: ' . BASE_URL . '/views/admin/productos.php');
    exit;
}

function editProduct($conn) {
    $id = $_POST['id'] ?? 0;
    $nombre = $_POST['nombre'] ?? '';
    $categoria = $_POST['categoria'] ?? '';
    $precio = $_POST['precio'] ?? 0;
    $stock = $_POST['stock'] ?? 0;
    $descripcion = $_POST['descripcion'] ?? '';
    
    if ($id <= 0 || empty($nombre)) {
        $_SESSION['error'] = 'Datos inválidos';
        header('Location: ' . BASE_URL . '/views/admin/productos.php');
        exit;
    }
    
    // Obtener imagen actual
    $stmt = $conn->prepare("SELECT Imagen FROM productos WHERE ID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $currentProduct = $result->fetch_assoc();
    $imagen = $currentProduct['Imagen'] ?? 'public/assets/img/default-product.jpg';
    $stmt->close();
    
    // Actualizar imagen si se subió una nueva
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = dirname(__DIR__) . '/public/assets/productos/';
        $fileExtension = strtolower(pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION));
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
        
        if (in_array($fileExtension, $allowedExtensions)) {
            $newFileName = uniqid('prod_') . '.' . $fileExtension;
            $targetPath = $uploadDir . $newFileName;
            
            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $targetPath)) {
                // Eliminar imagen anterior
                if ($imagen !== 'public/assets/img/default-product.jpg' && 
                    file_exists(dirname(__DIR__) . '/' . $imagen)) {
                    unlink(dirname(__DIR__) . '/' . $imagen);
                }
                $imagen = 'public/assets/productos/' . $newFileName;
            }
        }
    }
    
    $stmt = $conn->prepare("UPDATE productos SET Nombre = ?, Categoria = ?, Precio = ?, 
                           Stock = ?, Descripcion = ?, Imagen = ? WHERE ID = ?");
    $stmt->bind_param("ssdissi", $nombre, $categoria, $precio, $stock, $descripcion, $imagen, $id);
    
    if ($stmt->execute()) {
        $_SESSION['success'] = 'Producto actualizado';
    } else {
        $_SESSION['error'] = 'Error: ' . $conn->error;
    }
    
    $stmt->close();
    header('Location: ' . BASE_URL . '/views/admin/productos.php');
    exit;
}

function deleteProduct($conn) {
    $id = $_POST['id'] ?? 0;
    
    if ($id <= 0) {
        $_SESSION['error'] = 'ID inválido';
        header('Location: ' . BASE_URL . '/views/admin/productos.php');
        exit;
    }
    
    // Obtener imagen para eliminarla
    $stmt = $conn->prepare("SELECT Imagen FROM productos WHERE ID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    $stmt->close();
    
    $stmt = $conn->prepare("DELETE FROM productos WHERE ID = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        // Eliminar imagen
        if ($product && $product['Imagen'] !== 'public/assets/img/default-product.jpg') {
            $imagePath = dirname(__DIR__) . '/' . $product['Imagen'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        $_SESSION['success'] = 'Producto eliminado';
    } else {
        $_SESSION['error'] = 'Error: ' . $conn->error;
    }
    
    $stmt->close();
    header('Location: ' . BASE_URL . '/views/admin/productos.php');
    exit;
}
?>
```

### Vista de Gestión de Productos

**Características clave:**
- Tabla responsive con imágenes
- Modal para agregar/editar
- Confirmación antes de eliminar
- Estadísticas en tiempo real
- Filtros por categoría
- Indicadores de stock (verde si >10, rojo si ≤10)

---

## 👥 GESTIÓN DE CLIENTES

### Funcionalidades

1. **Crear Usuario**
   - Validar email único
   - Contraseña mínimo 6 caracteres
   - Seleccionar rol (admin/cliente)

2. **Editar Usuario**
   - Cambiar nombre, correo, contraseña
   - Cambiar rol
   - Validar que el correo no esté en uso

3. **Eliminar Usuario**
   - Confirmación antes de eliminar
   - No permitir eliminar cuenta propia
   - CASCADE: elimina pedidos y carrito del usuario

4. **Seguridad**
   - Prepared statements contra SQL injection
   - Validación de email con `filter_var()`
   - Protección contra auto-eliminación

---

## 🛍️ GESTIÓN DE PEDIDOS

### Estados y Flujo

```
1. PENDIENTE (naranja)
   ↓ Cliente realiza pedido
   
2. EN PREPARACIÓN (azul)
   ↓ Admin confirma y cocina prepara
   
3. LISTO (morado)
   ↓ Pedido preparado, esperando entrega
   
4. ENTREGADO (verde)
   ✓ Pedido completado exitosamente
   
CANCELADO (rojo)
   × En cualquier momento antes de Entregado
```

### Controlador de Pedidos

```php
<?php
// controllers/pedidos.php

// Actualizar estado de pedido
function updateStatus($conn) {
    $id = $_POST['id'] ?? 0;
    $estado = $_POST['estado'] ?? '';
    
    $estadosValidos = ['Pendiente', 'En Preparación', 'Listo', 'Entregado', 'Cancelado'];
    
    if ($id <= 0 || !in_array($estado, $estadosValidos)) {
        $_SESSION['error'] = 'Datos inválidos';
        header('Location: ' . BASE_URL . '/views/admin/pedidos.php');
        exit;
    }
    
    $stmt = $conn->prepare("UPDATE pedidos SET Estado = ? WHERE ID = ?");
    $stmt->bind_param("si", $estado, $id);
    
    if ($stmt->execute()) {
        $_SESSION['success'] = 'Estado actualizado correctamente';
    } else {
        $_SESSION['error'] = 'Error: ' . $conn->error;
    }
    
    $stmt->close();
    header('Location: ' . BASE_URL . '/views/admin/pedidos.php');
    exit;
}

// Obtener detalles del pedido (para modal)
function getDetails($conn) {
    $id = $_GET['id'] ?? 0;
    
    if ($id <= 0) {
        echo '<p style="color: #ef4444;">ID inválido</p>';
        exit;
    }
    
    // Pedido principal
    $stmt = $conn->prepare("SELECT p.*, u.Nombre as Cliente_Nombre, u.Correo as Cliente_Correo 
                           FROM pedidos p 
                           LEFT JOIN usuarios u ON p.Usuario_ID = u.ID 
                           WHERE p.ID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $pedido = $result->fetch_assoc();
    $stmt->close();
    
    // Detalles (productos)
    $stmt = $conn->prepare("SELECT dp.*, pr.Nombre as Producto_Nombre, pr.Imagen 
                           FROM detalle_pedidos dp 
                           LEFT JOIN productos pr ON dp.Producto_ID = pr.ID 
                           WHERE dp.Pedido_ID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $detalles = [];
    while ($row = $result->fetch_assoc()) {
        $detalles[] = $row;
    }
    $stmt->close();
    
    // Renderizar HTML del modal
    // ... (código de presentación)
}
?>
```

### Vista de Pedidos

**Características:**
- Cards con información completa del pedido
- Filtros dinámicos JavaScript (sin recargar página)
- Estadísticas en tiempo real:
  - Pedidos pendientes
  - En preparación
  - Completados hoy
  - Total de ventas del día
- Modal con detalles completos
- Cambio de estado con dropdown
- Códigos de color por estado

---

## 🎨 MEJORES PRÁCTICAS IMPLEMENTADAS

### 1. Seguridad

```php
// ✅ Prepared Statements
$stmt = $conn->prepare("SELECT * FROM usuarios WHERE Correo = ?");
$stmt->bind_param("s", $email);

// ✅ Escape de HTML
echo htmlspecialchars($user['Nombre']);

// ✅ Validación de Email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    // error
}

// ⚠️ MEJORAR: Hash de contraseñas
// Actual: texto plano
$password === $user['Contraseña']

// Recomendado:
// Al registrar:
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Al verificar:
if (password_verify($password, $user['Contraseña'])) {
    // login exitoso
}
```

### 2. Arquitectura

```php
// ✅ Clase Database (Singleton)
class Database {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "web_mybuenoscar";
    private $conn = null;

    public function getConnection() {
        if ($this->conn === null) {
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
            $this->conn->set_charset("utf8mb4");
        }
        return $this->conn;
    }
}

// ✅ Configuración centralizada
// config/config.php
define('BASE_URL', 'http://localhost/workbench/web-MyBuenOscar');
define('ROOT_PATH', __DIR__ . '/..');
define('CONFIG_PATH', ROOT_PATH . '/config');
define('INCLUDES_PATH', ROOT_PATH . '/includes');
```

### 3. UX/UI

```javascript
// ✅ Confirmación antes de eliminar
function deleteProduct(id, nombre) {
    if (confirm(`¿Estás seguro de eliminar "${nombre}"?\n\nEsta acción no se puede deshacer.`)) {
        // Crear form y submit
    }
}

// ✅ Modales con cierre al hacer clic fuera
document.getElementById('modal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeModal();
    }
});

// ✅ Filtros dinámicos sin recargar
function filterByStatus(status) {
    const cards = document.querySelectorAll('.pedido-card');
    cards.forEach(card => {
        if (status === 'Todos' || card.dataset.status === status) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
}
```

### 4. Responsive

```css
/* ✅ Grid Responsive */
.grid-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
}

/* ✅ Tabla con scroll en mobile */
@media (max-width: 768px) {
    .table-container {
        overflow-x: auto;
    }
    
    table {
        min-width: 800px;
    }
}
```

---

## 📊 ESTADÍSTICAS EN TIEMPO REAL

### Dashboard Administrativo

```php
<?php
// Calcular estadísticas dinámicamente

// Total de productos
$totalProductos = count($productos);

// Categorías únicas
$categorias = array_unique(array_column($productos, 'Categoria'));
$totalCategorias = count($categorias);

// Precio promedio
$precioPromedio = array_sum(array_column($productos, 'Precio')) / $totalProductos;

// Pedidos del día
$pedidosHoy = array_filter($pedidos, function($p) {
    return date('Y-m-d', strtotime($p['Fecha_Pedido'])) === date('Y-m-d');
});

// Ventas del día
$ventasHoy = array_sum(array_column($pedidosHoy, 'Total'));

// Pedidos por estado
$pendientes = count(array_filter($pedidos, fn($p) => $p['Estado'] === 'Pendiente'));
$enPreparacion = count(array_filter($pedidos, fn($p) => $p['Estado'] === 'En Preparación'));
$completados = count(array_filter($pedidosHoy, fn($p) => $p['Estado'] === 'Entregado'));
?>
```

---

## 🚀 OPTIMIZACIONES Y MEJORAS FUTURAS

### Seguridad
- [ ] **Password Hashing:** Implementar `password_hash()` y `password_verify()`
- [ ] **CSRF Tokens:** Protección contra ataques Cross-Site Request Forgery
- [ ] **Rate Limiting:** Limitar intentos de login (prevenir fuerza bruta)
- [ ] **HTTPS:** Configurar SSL para conexiones seguras
- [ ] **XSS Protection:** Sanitización más estricta de inputs
- [ ] **Validación Backend:** No confiar solo en validación frontend

### Funcionalidades
- [ ] **Carrito Funcional:** Sistema completo de agregar al carrito y checkout
- [ ] **Proceso de Pago:** Integración con pasarelas (WebPay, MercadoPago)
- [ ] **Notificaciones Email:** Confirmación de pedidos, cambios de estado
- [ ] **Recuperar Contraseña:** Link por email para resetear password
- [ ] **Registro de Clientes:** Formulario público de registro
- [ ] **Historial de Pedidos:** Para clientes ver sus pedidos anteriores
- [ ] **Búsqueda Avanzada:** Filtros por precio, categoría, stock
- [ ] **Paginación:** Para tablas con muchos registros
- [ ] **Exportar Datos:** PDF de pedidos, Excel de ventas
- [ ] **Gráficas:** Chart.js para visualizar ventas, productos más vendidos
- [ ] **Sistema de Cupones:** Códigos de descuento

### UX/UI
- [ ] **Dark Mode:** Tema oscuro con toggle
- [ ] **Drag & Drop:** Para subir imágenes
- [ ] **Image Cropper:** Recortar imágenes antes de upload
- [ ] **SweetAlert2:** Confirmaciones más elegantes
- [ ] **Loading Spinners:** Indicadores de carga
- [ ] **Toast Notifications:** Mensajes no invasivos
- [ ] **Animaciones:** Transiciones suaves entre páginas
- [ ] **PWA:** Progressive Web App para instalación en móvil
- [ ] **Lazy Loading:** Cargar imágenes solo cuando son visibles

### Performance
- [ ] **Caché:** Implementar Redis o Memcached
- [ ] **CDN:** Para archivos estáticos
- [ ] **Compresión de Imágenes:** WebP automático, lazy loading
- [ ] **Minificación:** CSS/JS minificados
- [ ] **Queries Optimizadas:** Índices en BD, evitar N+1
- [ ] **Paginación en BD:** LIMIT/OFFSET en queries

### DevOps
- [ ] **Docker:** Contenedorización del proyecto
- [ ] **CI/CD:** GitHub Actions para deploy automático
- [ ] **Testing:** PHPUnit para tests unitarios
- [ ] **Logs:** Sistema de logging estructurado
- [ ] **Backups Automáticos:** BD y archivos

---

## 🎓 LECCIONES APRENDIDAS

### 1. Arquitectura MVC
✅ **Beneficio:** Separación clara facilita mantenimiento y escalabilidad
⚠️ **Nota:** Implementar namespace y autoloader para mejor organización

### 2. Sesiones PHP
✅ **Beneficio:** Persistencia de estado del usuario
⚠️ **Cuidado:** Siempre verificar `session_status()` antes de `session_start()`

### 3. Upload de Archivos
✅ **Validaciones necesarias:**
- Extensión permitida
- Tamaño máximo
- Tipo MIME
- Nombres únicos (uniqid())
- Permisos de directorio (755)

### 4. Responsive Design
✅ **Mobile First:** Diseñar primero para móvil, luego escalar
✅ **Grid/Flexbox:** Layouts flexibles sin media queries complejas
✅ **Breakpoints estándar:** 640px, 768px, 1024px, 1280px

### 5. Seguridad
⚠️ **Nunca confiar en el cliente:** Validar TODO en el backend
⚠️ **Prepared Statements:** SIEMPRE para prevenir SQL injection
⚠️ **Escape HTML:** htmlspecialchars() en TODOS los outputs dinámicos

---

## 📝 CONFIGURACIÓN INICIAL

### Requisitos del Sistema
- **PHP:** 7.4 o superior
- **MySQL/MariaDB:** 5.7 o superior
- **Apache:** 2.4 o superior (con mod_rewrite)
- **Extensiones PHP:**
  - mysqli
  - gd (para manipulación de imágenes)
  - fileinfo (para validación de uploads)

### Instalación Paso a Paso

1. **Clonar/Descargar el proyecto**
```bash
git clone https://github.com/WhiteMooncy/web-MyBuenOscar.git
cd web-MyBuenOscar
```

2. **Configurar Base de Datos**
```sql
-- En phpMyAdmin o MySQL CLI
CREATE DATABASE web_mybuenoscar CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE web_mybuenoscar;

-- Ejecutar scripts SQL en orden:
-- 1. src/DB/web-mybuenoscar.sql (estructura)
-- 2. src/DB/insert_usuarios_phpmyadmin.sql (usuarios)
-- 3. src/DB/create_pedidos_table.sql (pedidos)
```

3. **Configurar config/database.php**
```php
private $host = "localhost";
private $username = "root";
private $password = ""; // Tu contraseña de MySQL
private $database = "web_mybuenoscar";
```

4. **Configurar config/config.php**
```php
define('BASE_URL', 'http://localhost/tu-carpeta/web-MyBuenOscar');
```

5. **Configurar permisos**
```bash
# Linux/Mac
chmod 755 public/assets/productos
chmod 755 public/assets

# Windows: clic derecho → Propiedades → Seguridad → Editar
```

6. **Acceder al sistema**
```
URL: http://localhost/tu-carpeta/web-MyBuenOscar
Login Admin: admin@mybuenoscar.com / Admin123!
```

---

## 🎯 CASOS DE USO PRINCIPALES

### 1. Cliente realiza un pedido
```
1. Cliente navega a /views/carta.php
2. Hace clic en "Agregar al Carrito"
3. JavaScript envía POST a /controllers/carrito.php
4. Se agrega a tabla `carrito`
5. Cliente va a carrito y confirma pedido
6. POST a /controllers/pedidos.php
7. Se crea registro en `pedidos` y `detalle_pedidos`
8. Estado inicial: "Pendiente"
9. Se vacía el carrito del cliente
10. Redirección a confirmación con número de pedido
```

### 2. Admin gestiona un producto
```
1. Admin accede a /views/admin/productos.php
2. Clic en "Agregar Producto"
3. Modal se abre con formulario
4. Completa datos y selecciona imagen
5. Submit → POST a /controllers/productos.php
6. Imagen se sube a /public/assets/productos/
7. INSERT en tabla `productos`
8. Redirección con mensaje de éxito
9. Producto aparece en tabla
```

### 3. Admin cambia estado de pedido
```
1. Admin accede a /views/admin/pedidos.php
2. Ve listado de pedidos con filtros
3. Selecciona "En Preparación" en dropdown
4. Confirmación JavaScript
5. POST a /controllers/pedidos.php (action=updateStatus)
6. UPDATE en tabla `pedidos`
7. Página recarga
8. Badge del pedido cambia de color (naranja → azul)
9. Estadísticas se actualizan automáticamente
```

---

## 🌟 CONCLUSIÓN

Este prompt documenta un **sistema e-commerce completo y profesional** con:

✅ **Arquitectura MVC** bien definida  
✅ **Sistema de autenticación** con roles  
✅ **CRUD completo** de productos, clientes y pedidos  
✅ **Upload de archivos** con validaciones  
✅ **UI/UX moderno** y responsive  
✅ **Estadísticas en tiempo real**  
✅ **Código limpio** y bien documentado  
✅ **Seguridad básica** implementada  

### Stack Tecnológico
- **Backend:** PHP 7.4+ con MySQLi
- **Frontend:** HTML5, CSS3, JavaScript Vanilla
- **Base de Datos:** MySQL/MariaDB
- **Diseño:** CSS Grid, Flexbox, Mobile First
- **Iconos:** Font Awesome 6.4.0
- **Tipografía:** Poppins (Google Fonts)

### Ideal para:
- Restaurantes con pedidos online
- E-commerce de productos físicos
- Sistemas de gestión con roles
- Proyectos educativos de PHP/MySQL
- Base para aplicaciones más complejas

---

**Repositorio:** https://github.com/WhiteMooncy/web-MyBuenOscar  
**Branch:** WhiteMooncy-patch-carta  
**Fecha:** Noviembre 2025  
**Autor:** WhiteMooncy  
**Licencia:** MIT (o la que corresponda)
