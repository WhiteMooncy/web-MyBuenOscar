<?php
/**
 * Controlador de Logout - MyBuenOscar
 */

// Cargar configuración
require_once dirname(__DIR__) . '/config/config.php';

// Iniciar sesión
session_start();

// Destruir todas las variables de sesión
$_SESSION = array();

// Destruir la cookie de sesión si existe
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 3600, '/');
}

// Destruir la cookie de "recordarme" si existe
if (isset($_COOKIE['user_email'])) {
    setcookie('user_email', '', time() - 3600, '/');
}

// Destruir la sesión
session_destroy();

// Redirigir al login con mensaje de éxito
session_start(); // Reiniciar para el mensaje
$_SESSION['success'] = 'Sesión cerrada correctamente';
header('Location: ' . BASE_URL . '/views/login.php');
exit;
?>
