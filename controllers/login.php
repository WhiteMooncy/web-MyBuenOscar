<?php
/**
 * Controlador de Login - MyBuenOscar
 */

// Cargar configuración
require_once dirname(__DIR__) . '/config/config.php';
require_once CONFIG_PATH . '/database.php';

// Iniciar sesión
session_start();

// Verificar si es POST (formulario enviado)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Obtener datos del formulario
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $remember = isset($_POST['remember']);
    
    // Validar que los campos no estén vacíos
    if (empty($email) || empty($password)) {
        $_SESSION['error'] = 'Por favor completa todos los campos';
        header('Location: ' . BASE_URL . '/views/login.php');
        exit;
    }
    
    // Conectar a la base de datos
    $database = new Database();
    $conn = $database->getConnection();
    
    if (!$conn) {
        $_SESSION['error'] = 'Error de conexión a la base de datos';
        header('Location: ' . BASE_URL . '/views/login.php');
        exit;
    }
    
    // Preparar consulta para evitar SQL injection
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE Correo = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Verificar si el usuario existe
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        
        // Verificar contraseña
        // Nota: En producción usar password_verify() con hash
        if ($password === $user['Contraseña']) {
            // Login exitoso - crear sesión
            $_SESSION['user_id'] = $user['ID'];
            $_SESSION['user_name'] = $user['Nombre'];
            $_SESSION['user_email'] = $user['Correo'];
            $_SESSION['user_type'] = $user['Tipo_Usuario'];
            $_SESSION['logged_in'] = true;
            
            // Si marcó "Recordarme", crear cookie
            if ($remember) {
                setcookie('user_email', $email, time() + (86400 * 30), "/"); // 30 días
            }
            
            // Redirigir según tipo de usuario
            if ($user['Tipo_Usuario'] === 'admin') {
                header('Location: ' . BASE_URL . '/views/admin/dashboard.php');
            } else {
                header('Location: ' . BASE_URL . '/views/cliente/dashboard.php');
            }
            exit;
            
        } else {
            // Contraseña incorrecta
            $_SESSION['error'] = 'Contraseña incorrecta';
            header('Location: ' . BASE_URL . '/views/login.php');
            exit;
        }
        
    } else {
        // Usuario no encontrado
        $_SESSION['error'] = 'Usuario no encontrado';
        header('Location: ' . BASE_URL . '/views/login.php');
        exit;
    }
    
    $stmt->close();
    $conn->close();
    
} else {
    // Si no es POST, redirigir al login
    header('Location: ' . BASE_URL . '/views/login.php');
    exit;
}
?>
