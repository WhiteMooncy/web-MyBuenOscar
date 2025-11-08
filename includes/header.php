<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'MyBuenOscar Restaurant'; ?></title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/assets/css/Style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- Navegación -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="<?php echo BASE_URL; ?>/index.php" class="nav-logo">
                <img src="<?php echo BASE_URL; ?>/public/assets/menu/bebidas/monster-blanca.png" 
                     alt="MyBuenOscar Logo" class="logo-img">
                <span class="logo-text">MyBuenOscar</span>
            </a>
            
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="<?php echo BASE_URL; ?>/index.php" class="nav-link">
                        <i class="fas fa-home"></i> Inicio
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo BASE_URL; ?>/views/carta.php" class="nav-link">
                        <i class="fas fa-utensils"></i> Carta
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo BASE_URL; ?>/views/promos.php" class="nav-link">
                        <i class="fas fa-tags"></i> Promociones
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle">
                        <i class="fas fa-phone"></i> Contacto
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="mailto:MyBuenOscarRestaurant@gmail.com"><i class="fas fa-envelope"></i> Email</a></li>
                        <li><a href="tel:+56958917375"><i class="fas fa-phone-alt"></i> Teléfono</a></li>
                        <li><a href="https://wa.me/56958917375" target="_blank"><i class="fab fa-whatsapp"></i> WhatsApp</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="<?php echo BASE_URL; ?>/views/login.php" class="nav-link nav-login">
                        <i class="fas fa-user"></i> Login
                    </a>
                </li>
            </ul>
            
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </nav>
