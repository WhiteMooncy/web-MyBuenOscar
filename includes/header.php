<?php
// Verificar si hay sesión activa (sin iniciar nueva sesión)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$is_logged_in = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
$user_name = $_SESSION['user_name'] ?? '';
$user_type = $_SESSION['user_type'] ?? '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'MyBuenOscar Restaurant'; ?></title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/assets/css/Style-new.css">
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
                
                <?php if ($is_logged_in): ?>
                    <!-- Usuario logueado - Mostrar dropdown con opciones -->
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" style="background: linear-gradient(135deg, #16a34a 0%, #15803d 100%); color: white; padding: 0.5rem 1rem; border-radius: 8px;">
                            <i class="fas fa-user-circle"></i> <?php echo htmlspecialchars($user_name); ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="<?php echo BASE_URL; ?>/views/<?php echo $user_type === 'admin' ? 'admin' : 'cliente'; ?>/dashboard.php">
                                    <i class="fas fa-tachometer-alt"></i> Mi Panel
                                </a>
                            </li>
                            <li><a href="<?php echo BASE_URL; ?>/views/carta.php"><i class="fas fa-shopping-cart"></i> Hacer Pedido</a></li>
                            <?php if ($user_type === 'admin'): ?>
                                <li><a href="<?php echo BASE_URL; ?>/views/admin/productos.php"><i class="fas fa-box"></i> Productos</a></li>
                                <li><a href="<?php echo BASE_URL; ?>/views/admin/pedidos.php"><i class="fas fa-receipt"></i> Pedidos</a></li>
                                <li><a href="<?php echo BASE_URL; ?>/views/admin/clientes.php"><i class="fas fa-users"></i> Clientes</a></li>
                            <?php endif; ?>
                            <li style="border-top: 1px solid #e5e7eb; margin-top: 0.5rem; padding-top: 0.5rem;">
                                <a href="<?php echo BASE_URL; ?>/controllers/logout.php" style="color: #ef4444;">
                                    <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php else: ?>
                    <!-- Usuario no logueado - Mostrar botón de Login -->
                    <li class="nav-item">
                        <a href="<?php echo BASE_URL; ?>/views/login.php" class="nav-link nav-login">
                            <i class="fas fa-user"></i> Login
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
            
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </nav>
