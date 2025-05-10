<?php
session_start();
$id = $_POST['id'];
$cantidad = $_POST['cantidad'];

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

if (isset($_SESSION['carrito'][$id])) {
    $_SESSION['carrito'][$id]['cantidad'] += $cantidad;
} else {
    // Consultar producto desde la BD
    $producto = ...;
    $_SESSION['carrito'][$id] = [
        'nombre' => $producto['nombre'],
        'precio' => $producto['precio'],
        'cantidad' => $cantidad
    ];
}
$total = 0;
foreach ($_SESSION['carrito'] as $item) {
    echo $item['nombre'] . " x " . $item['cantidad'] . "<br>";
    $total += $item['precio'] * $item['cantidad'];
}
echo "Total: $total";

?>
