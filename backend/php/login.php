<?php
session_start();
require_once 'conexion.php'; 

$correo = $_POST['Correo'] ?? '';
$contraseña = $_POST['Contraseña'] ?? '';

if (empty($correo) || empty($contraseña)) {
    echo json_encode(["status" => "error", "message" => "Correo y contraseña son obligatorios"]);
    exit;
}

$query = $mysqli->prepare("SELECT * FROM usuarios WHERE correo = ?");
$query->bind_param("s", $correo);
$query->execute();
$resultado = $query->get_result();

if ($usuario = $resultado->fetch_assoc()) {
    if (password_verify($contraseña, $usuario['Contraseña'])) {
        $_SESSION['Nombre'] = $usuario['Nombre'];
        $_SESSION['rol'] = $usuario['Tipo_Usuario'];

        if ($usuario['Tipo_Usuario'] === 'admin') {
            header('Location: admin.php');
        } else {
            header('Location: cliente.php');
        }
        exit; }
    } else {
        echo json_encode(["status" => "error", "message" => "Contraseña incorrecta"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Usuario no encontrado"]);
}
?>
