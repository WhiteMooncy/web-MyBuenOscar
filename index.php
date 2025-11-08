<?php
/**
 * Página principal de MyBuenOscar
 */

// Cargar configuración
require_once __DIR__ . '/config/config.php';

// Título de la página
$title = 'Inicio | MyBuenOscar Restaurant';
?>

<?php include INCLUDES_PATH . '/header.php'; ?>

<!-- Main Content -->
<main>
    <div class="main-container" style="text-align: center; padding: 50px 20px;">
        <div class="hero-section" style="max-width: 800px; margin: 0 auto; background-color: rgba(255,255,255,0.9); padding: 40px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            <h1 style="color: #333; font-size: 3em; margin-bottom: 20px;">Bienvenido a MyBuenOscar</h1>
            <p style="font-size: 1.2em; color: #666; margin-bottom: 30px;">
                El mejor restaurant con los platos más deliciosos y únicos de la ciudad.
            </p>
            
            <div class="action-buttons" style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap;">
                <a href="<?php echo BASE_URL; ?>/views/carta.php" class="button" 
                   style="padding: 15px 30px; background-color: #ffd700; color: #333; text-decoration: none; border-radius: 8px; font-weight: 600; font-size: 1.1em; transition: all 0.3s;">
                    Ver Carta
                </a>
                <a href="<?php echo BASE_URL; ?>/views/promos.php" class="button" 
                   style="padding: 15px 30px; background-color: #ff6b6b; color: white; text-decoration: none; border-radius: 8px; font-weight: 600; font-size: 1.1em; transition: all 0.3s;">
                    Ver Promociones
                </a>
            </div>
        </div>
        
        <div class="features-section" style="margin-top: 50px; display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 30px; max-width: 1200px; margin: 50px auto 0;">
            <div class="feature-card" style="background-color: rgba(255,255,255,0.9); padding: 30px; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                <h3 style="color: #333; margin-bottom: 15px;">🍽️ Platos Únicos</h3>
                <p style="color: #666;">Descubre nuestra variedad de platos especiales preparados con ingredientes frescos.</p>
            </div>
            
            <div class="feature-card" style="background-color: rgba(255,255,255,0.9); padding: 30px; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                <h3 style="color: #333; margin-bottom: 15px;">🚚 Delivery Rápido</h3>
                <p style="color: #666;">Recibe tus pedidos en tiempo récord. Contáctanos por WhatsApp.</p>
            </div>
            
            <div class="feature-card" style="background-color: rgba(255,255,255,0.9); padding: 30px; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                <h3 style="color: #333; margin-bottom: 15px;">💰 Mejores Precios</h3>
                <p style="color: #666;">Calidad excepcional a precios accesibles. ¡Aprovecha nuestras promos!</p>
            </div>
        </div>
    </div>
</main>

<?php include INCLUDES_PATH . '/footer.php'; ?>

<style>
    .button:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }
</style>
