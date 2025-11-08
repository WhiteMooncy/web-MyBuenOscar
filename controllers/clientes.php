<?php
/**
 * Controlador de Clientes - CRUD
 */

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

if (!$conn) {
    $_SESSION['error'] = 'Error de conexión';
    header('Location: ' . BASE_URL . '/views/admin/clientes.php');
    exit;
}

$action = $_POST['action'] ?? '';

switch ($action) {
    case 'add':
        addClient($conn);
        break;
    case 'edit':
        editClient($conn);
        break;
    case 'delete':
        deleteClient($conn);
        break;
    default:
        $_SESSION['error'] = 'Acción no válida';
        header('Location: ' . BASE_URL . '/views/admin/clientes.php');
        exit;
}

function addClient($conn) {
    $nombre = trim($_POST['nombre'] ?? '');
    $correo = trim($_POST['correo'] ?? '');
    $password = $_POST['password'] ?? '';
    $tipo = $_POST['tipo'] ?? 'cliente';
    
    if (empty($nombre) || empty($correo) || empty($password)) {
        $_SESSION['error'] = 'Todos los campos son obligatorios';
        header('Location: ' . BASE_URL . '/views/admin/clientes.php');
        exit;
    }
    
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = 'Correo electrónico inválido';
        header('Location: ' . BASE_URL . '/views/admin/clientes.php');
        exit;
    }
    
    if (strlen($password) < 6) {
        $_SESSION['error'] = 'La contraseña debe tener al menos 6 caracteres';
        header('Location: ' . BASE_URL . '/views/admin/clientes.php');
        exit;
    }
    
    // Verificar si el correo ya existe
    $stmt = $conn->prepare("SELECT ID FROM usuarios WHERE Correo = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $_SESSION['error'] = 'Este correo ya está registrado';
        $stmt->close();
        header('Location: ' . BASE_URL . '/views/admin/clientes.php');
        exit;
    }
    $stmt->close();
    
    // Insertar nuevo cliente
    $stmt = $conn->prepare("INSERT INTO usuarios (Nombre, Correo, Contraseña, Tipo_Usuario) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nombre, $correo, $password, $tipo);
    
    if ($stmt->execute()) {
        $_SESSION['success'] = 'Cliente agregado correctamente';
    } else {
        $_SESSION['error'] = 'Error al agregar cliente: ' . $conn->error;
    }
    
    $stmt->close();
    header('Location: ' . BASE_URL . '/views/admin/clientes.php');
    exit;
}

function editClient($conn) {
    $id = $_POST['id'] ?? 0;
    $nombre = trim($_POST['nombre'] ?? '');
    $correo = trim($_POST['correo'] ?? '');
    $password = $_POST['password'] ?? '';
    $tipo = $_POST['tipo'] ?? 'cliente';
    
    if ($id <= 0 || empty($nombre) || empty($correo)) {
        $_SESSION['error'] = 'Datos inválidos';
        header('Location: ' . BASE_URL . '/views/admin/clientes.php');
        exit;
    }
    
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = 'Correo electrónico inválido';
        header('Location: ' . BASE_URL . '/views/admin/clientes.php');
        exit;
    }
    
    // Verificar si el correo ya existe (excluyendo el usuario actual)
    $stmt = $conn->prepare("SELECT ID FROM usuarios WHERE Correo = ? AND ID != ?");
    $stmt->bind_param("si", $correo, $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $_SESSION['error'] = 'Este correo ya está en uso por otro usuario';
        $stmt->close();
        header('Location: ' . BASE_URL . '/views/admin/clientes.php');
        exit;
    }
    $stmt->close();
    
    // Actualizar datos
    if (!empty($password)) {
        if (strlen($password) < 6) {
            $_SESSION['error'] = 'La contraseña debe tener al menos 6 caracteres';
            header('Location: ' . BASE_URL . '/views/admin/clientes.php');
            exit;
        }
        $stmt = $conn->prepare("UPDATE usuarios SET Nombre = ?, Correo = ?, Contraseña = ?, Tipo_Usuario = ? WHERE ID = ?");
        $stmt->bind_param("ssssi", $nombre, $correo, $password, $tipo, $id);
    } else {
        $stmt = $conn->prepare("UPDATE usuarios SET Nombre = ?, Correo = ?, Tipo_Usuario = ? WHERE ID = ?");
        $stmt->bind_param("sssi", $nombre, $correo, $tipo, $id);
    }
    
    if ($stmt->execute()) {
        $_SESSION['success'] = 'Cliente actualizado correctamente';
        
        // Si es el usuario actual, actualizar sesión
        if ($id == $_SESSION['user_id']) {
            $_SESSION['user_name'] = $nombre;
            $_SESSION['user_email'] = $correo;
            $_SESSION['user_type'] = $tipo;
        }
    } else {
        $_SESSION['error'] = 'Error al actualizar cliente: ' . $conn->error;
    }
    
    $stmt->close();
    header('Location: ' . BASE_URL . '/views/admin/clientes.php');
    exit;
}

function deleteClient($conn) {
    $id = $_POST['id'] ?? 0;
    
    if ($id <= 0) {
        $_SESSION['error'] = 'ID inválido';
        header('Location: ' . BASE_URL . '/views/admin/clientes.php');
        exit;
    }
    
    // No permitir eliminar al usuario actual
    if ($id == $_SESSION['user_id']) {
        $_SESSION['error'] = 'No puedes eliminar tu propia cuenta';
        header('Location: ' . BASE_URL . '/views/admin/clientes.php');
        exit;
    }
    
    $stmt = $conn->prepare("DELETE FROM usuarios WHERE ID = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        $_SESSION['success'] = 'Cliente eliminado correctamente';
    } else {
        $_SESSION['error'] = 'Error al eliminar cliente: ' . $conn->error;
    }
    
    $stmt->close();
    header('Location: ' . BASE_URL . '/views/admin/clientes.php');
    exit;
}

$conn->close();
?>
