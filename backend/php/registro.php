<?php
require('conn.php'); // Incluye conexión a la base de datos

// Verifica que el formulario se haya enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = mysqli_real_escape_string($mysqli, $_POST["id"]);
    $usuario = trim($_POST["usuario"]);
    $contraseña = trim($_POST["contraseña"]);

    // Validación básica de campos
    if (empty($usuario)) {
        echo "Debe ingresar un nombre de usuario";
        exit;
    }
    if (empty($contraseña)) {
        echo "Debe ingresar una contraseña";
        exit;
    }

    // Comprobación de que el usuario no exista ya en la base de datos
    $stmt = $mysqli->prepare("SELECT ID FROM USUARIOS WHERE usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "El usuario ya está registrado.";
    } else {
        // Cifrado seguro de contraseña con password_hash
        $hash = password_hash($contraseña, PASSWORD_DEFAULT);

        // Inserción segura del nuevo usuario
        $stmt = $mysqli->prepare("INSERT INTO USUARIOS (id, usuario, contraseña) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $id, $usuario, $hash);
        if ($stmt->execute()) {
            echo "Usuario registrado con éxito. <a href='login.php'>Iniciar sesión</a>";
        } else {
            echo "Error al registrar usuario.";
        }
    }
}
?>
