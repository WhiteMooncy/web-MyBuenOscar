<?php
session_start();

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['Nombre'])) {
    header("Location: login.html");
    exit();
}

// Trae los datos del usuario
$nombre = $_SESSION['Nombre'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bienvenido, <?php echo htmlspecialchars($nombre); ?></title>
    <link rel="stylesheet" href="estilos.css"> <!-- Tu archivo CSS -->
</head>
<body>
    <header>
        <h1>Hola, <?php echo htmlspecialchars($nombre); ?> 👋</h1>
        <a href="logout.php">Cerrar sesión</a>
    </header>

    <h2>Menú de Platos</h2>

    <div class="menu">
        <?php
        require_once "conexion.php";

        $consulta = $mysqli->query("SELECT * FROM platos");

        while ($plato = $consulta->fetch_assoc()) {
            echo "<div class='plato'>";
            echo "<h3>" . htmlspecialchars($plato['nombre']) . "</h3>";
            echo "<p>" . htmlspecialchars($plato['descripcion']) . "</p>";
            echo "<strong>Precio: $" . number_format($plato['precio'], 0, ',', '.') . "</strong><br>";
            echo "<form method='POST' action='agregar_carrito.php'>";
            echo "<input type='hidden' name='plato_id' value='" . $plato['id'] . "'>";
            echo "<input type='submit' value='Agregar al carrito'>";
            echo "</form>";
            echo "</div>";
        }
        ?>
    </div>

    <a href="ver_carrito.php">🛒 Ver carrito</a>
</body>
</html>
