<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'MyBuenOscar'; ?></title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/assets/css/Style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body style="background-image: url(<?php echo BASE_URL; ?>/public/assets/img/fondo.png);">
    <!-- Header -->
    <header>
        <div class="navbar-brand">
            <nav class="navbar">
                <a href="<?php echo BASE_URL; ?>/index.php" class="logo">
                    <img src="<?php echo BASE_URL; ?>/public/assets/menu/bebidas/monster-blanca.png" 
                         alt="Logo" style="width: 32px; height: 32px; padding: 0; justify-content: center;">
                </a>
                <a href="<?php echo BASE_URL; ?>/views/carta.php">Carta</a>
                <a href="<?php echo BASE_URL; ?>/views/promos.php">Promos</a>
                <details class="dropdown">
                    <summary>Contáctanos</summary>
                    <div class="dropdown-menu">
                        <a href="mailto:MyBuenOscarRestaurant@gmail.com">Correo Electrónico</a>
                        <a href="tel:+56958917375">Teléfono</a>
                        <a href="https://wa.me/56958917375" target="_blank">WhatsApp</a>
                    </div>
                </details>
                <a href="<?php echo BASE_URL; ?>/views/login.php" id="cart-link">Login</a>
            </nav>
        </div>
    </header>
