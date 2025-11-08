<?php
/**
 * Controlador de Productos - CRUD
 */

require_once dirname(__DIR__) . '/config/config.php';
require_once CONFIG_PATH . '/database.php';

session_start();

// Verificar autenticación
if (!isset($_SESSION['logged_in']) || $_SESSION['user_type'] !== 'admin') {
    $_SESSION['error'] = 'Acceso denegado';
    header('Location: ' . BASE_URL . '/views/login.php');
    exit;
}

$database = new Database();
$conn = $database->getConnection();

if (!$conn) {
    $_SESSION['error'] = 'Error de conexión a la base de datos';
    header('Location: ' . BASE_URL . '/views/admin/productos.php');
    exit;
}

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
    default:
        $_SESSION['error'] = 'Acción no válida';
        header('Location: ' . BASE_URL . '/views/admin/productos.php');
        exit;
}

function addProduct($conn) {
    $nombre = $_POST['nombre'] ?? '';
    $categoria = $_POST['categoria'] ?? '';
    $precio = $_POST['precio'] ?? 0;
    $stock = $_POST['stock'] ?? 0;
    $descripcion = $_POST['descripcion'] ?? '';
    
    // Validar campos requeridos
    if (empty($nombre) || empty($categoria) || $precio <= 0) {
        $_SESSION['error'] = 'Por favor completa todos los campos obligatorios';
        header('Location: ' . BASE_URL . '/views/admin/productos.php');
        exit;
    }
    
    // Manejar la imagen
    $imagen = 'public/assets/img/default-product.jpg'; // Imagen por defecto
    
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = dirname(__DIR__) . '/public/assets/productos/';
        
        // Crear directorio si no existe
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
    
    // Insertar en la base de datos
    $stmt = $conn->prepare("INSERT INTO productos (Nombre, Categoria, Precio, Stock, Descripcion, Imagen) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdiis", $nombre, $categoria, $precio, $stock, $descripcion, $imagen);
    
    if ($stmt->execute()) {
        $_SESSION['success'] = 'Producto agregado correctamente';
    } else {
        $_SESSION['error'] = 'Error al agregar el producto: ' . $conn->error;
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
    
    if ($id <= 0 || empty($nombre) || empty($categoria) || $precio <= 0) {
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
        
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        
        $fileExtension = strtolower(pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION));
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
        
        if (in_array($fileExtension, $allowedExtensions)) {
            $newFileName = uniqid('prod_') . '.' . $fileExtension;
            $targetPath = $uploadDir . $newFileName;
            
            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $targetPath)) {
                // Eliminar imagen anterior si no es la por defecto
                if ($imagen !== 'public/assets/img/default-product.jpg' && file_exists(dirname(__DIR__) . '/' . $imagen)) {
                    unlink(dirname(__DIR__) . '/' . $imagen);
                }
                $imagen = 'public/assets/productos/' . $newFileName;
            }
        }
    }
    
    // Actualizar en la base de datos
    $stmt = $conn->prepare("UPDATE productos SET Nombre = ?, Categoria = ?, Precio = ?, Stock = ?, Descripcion = ?, Imagen = ? WHERE ID = ?");
    $stmt->bind_param("ssdissi", $nombre, $categoria, $precio, $stock, $descripcion, $imagen, $id);
    
    if ($stmt->execute()) {
        $_SESSION['success'] = 'Producto actualizado correctamente';
    } else {
        $_SESSION['error'] = 'Error al actualizar el producto: ' . $conn->error;
    }
    
    $stmt->close();
    header('Location: ' . BASE_URL . '/views/admin/productos.php');
    exit;
}

function deleteProduct($conn) {
    $id = $_POST['id'] ?? 0;
    
    if ($id <= 0) {
        $_SESSION['error'] = 'ID de producto inválido';
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
    
    // Eliminar producto
    $stmt = $conn->prepare("DELETE FROM productos WHERE ID = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        // Eliminar imagen si existe y no es la por defecto
        if ($product && $product['Imagen'] !== 'public/assets/img/default-product.jpg') {
            $imagePath = dirname(__DIR__) . '/' . $product['Imagen'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        $_SESSION['success'] = 'Producto eliminado correctamente';
    } else {
        $_SESSION['error'] = 'Error al eliminar el producto: ' . $conn->error;
    }
    
    $stmt->close();
    header('Location: ' . BASE_URL . '/views/admin/productos.php');
    exit;
}

$conn->close();
?>
