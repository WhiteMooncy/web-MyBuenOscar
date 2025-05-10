<?php
// Datos de conexión a la base de datos
$host = "localhost";
$usuario = "root";
$clave = "";#Labaiep25
$bd = "web-mybuenoscar";

// Crea una nueva conexión usando mysqli orientado a objetos
$mysqli = new mysqli($host, $usuario, $clave, $bd);

// Verifica si hay un error de conexión
if ($mysqli->connect_error) {
    // Mostrar un mensaje claro de error sin revelar datos sensibles
    die("Error al conectar con la base de datos: " . $mysqli->connect_error);
}

// OPCIONAL: Solo mostrar mensaje de éxito si estás en desarrollo
// En producción, este mensaje debe estar desactivado
// echo "<p style='color: Blue;'>Conexión exitosa</p>";
?>
