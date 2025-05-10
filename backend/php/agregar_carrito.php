<?php
session_start();

$nombre = $_POST['nombre'];
$precio = intval($_POST['precio']);
$cantidad = intval($_POST['cantidad']);

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

$encontrado = false;

// Si ya existe el producto en el carrito, suma la cantidad
foreach ($_SESSION['carrito'] as &$item) {
    if ($item['nombre'] === $nombre) {
        $item['cantidad'] += $cantidad;
        $encontrado = true;
        break;
    }
}

if (!$encontrado) {
    $_SESSION['carrito'][] = [
        'nombre' => $nombre,
        'precio' => $precio,
        'cantidad' => $cantidad
    ];
}
exit();
