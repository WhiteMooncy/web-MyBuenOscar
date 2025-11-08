<?php
/**
 * Página principal de MyBuenOscar
 */

// Cargar configuración
require_once __DIR__ . '/config/config.php';

// Título de la página
$title = 'Inicio | MyBuenOscar Restaurant - Los Mejores Platos';
?>

<?php include INCLUDES_PATH . '/header.php'; ?>

<!-- Main Content -->
<main class="main-container">
    <!-- Hero Section -->
    <section class="hero-section" style="text-align: center; margin-bottom: 4rem;">
        <div style="max-width: 900px; margin: 0 auto; background: rgba(255,255,255,0.95); backdrop-filter: blur(10px); padding: 3rem 2rem; border-radius: 20px; box-shadow: 0 20px 40px rgba(0,0,0,0.15);">
            <h1 style="color: #16a34a; font-size: clamp(2rem, 5vw, 3.5rem); margin-bottom: 1rem; font-weight: 700; text-shadow: 2px 2px 4px rgba(0,0,0,0.1);">
                🍽️ Bienvenido a MyBuenOscar
            </h1>
            <p style="font-size: clamp(1rem, 2vw, 1.3rem); color: #4b5563; margin-bottom: 2rem; line-height: 1.8;">
                Descubre una experiencia culinaria <strong>única</strong> con los platos más deliciosos y creativos de la ciudad. 
                ¡Sabores que nunca olvidarás!
            </p>
            
            <div style="display: flex; gap: 1.5rem; justify-content: center; flex-wrap: wrap; margin-top: 2rem;">
                <a href="<?php echo BASE_URL; ?>/views/carta.php" 
                   style="display: inline-flex; align-items: center; gap: 10px; padding: 1rem 2.5rem; background: linear-gradient(135deg, #16a34a 0%, #15803d 100%); color: white; text-decoration: none; border-radius: 50px; font-weight: 600; font-size: 1.1rem; box-shadow: 0 10px 25px rgba(22, 163, 74, 0.3); transition: all 0.3s ease; border: none;">
                    <i class="fas fa-book-open"></i> Ver Nuestra Carta
                </a>
                <a href="<?php echo BASE_URL; ?>/views/promos.php" 
                   style="display: inline-flex; align-items: center; gap: 10px; padding: 1rem 2.5rem; background: linear-gradient(135deg, #ffd700 0%, #ffa500 100%); color: #1f2937; text-decoration: none; border-radius: 50px; font-weight: 600; font-size: 1.1rem; box-shadow: 0 10px 25px rgba(255, 215, 0, 0.3); transition: all 0.3s ease;">
                    <i class="fas fa-fire"></i> Ver Promociones
                </a>
            </div>
        </div>
    </section>
    
    <!-- Features Section -->
    <section style="margin: 4rem 0;">
        <h2 style="text-align: center; font-size: 2.5rem; color: #1f2937; margin-bottom: 3rem; font-weight: 700;">
            ¿Por qué elegirnos?
        </h2>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 2rem; max-width: 1200px; margin: 0 auto;">
            <!-- Feature 1 -->
            <div class="feature-card" style="background: rgba(255,255,255,0.95); backdrop-filter: blur(10px); padding: 2.5rem; border-radius: 16px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); text-align: center; transition: all 0.3s ease; border-top: 4px solid #16a34a;">
                <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #dcfce7 0%, #86efac 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; box-shadow: 0 5px 15px rgba(22, 163, 74, 0.2);">
                    <i class="fas fa-utensils" style="font-size: 2rem; color: #16a34a;"></i>
                </div>
                <h3 style="color: #1f2937; margin-bottom: 1rem; font-size: 1.5rem; font-weight: 600;">Platos Únicos</h3>
                <p style="color: #6b7280; line-height: 1.8; font-size: 1rem;">Descubre nuestra variedad de platos especiales preparados con ingredientes frescos y recetas originales que no encontrarás en ningún otro lugar.</p>
            </div>
            
            <!-- Feature 2 -->
            <div class="feature-card" style="background: rgba(255,255,255,0.95); backdrop-filter: blur(10px); padding: 2.5rem; border-radius: 16px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); text-align: center; transition: all 0.3s ease; border-top: 4px solid #ffd700;">
                <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; box-shadow: 0 5px 15px rgba(255, 215, 0, 0.2);">
                    <i class="fas fa-truck" style="font-size: 2rem; color: #f59e0b;"></i>
                </div>
                <h3 style="color: #1f2937; margin-bottom: 1rem; font-size: 1.5rem; font-weight: 600;">Delivery Rápido</h3>
                <p style="color: #6b7280; line-height: 1.8; font-size: 1rem;">Recibe tus pedidos en tiempo récord. Contáctanos por WhatsApp y disfruta de tus platos favoritos en la comodidad de tu hogar.</p>
            </div>
            
            <!-- Feature 3 -->
            <div class="feature-card" style="background: rgba(255,255,255,0.95); backdrop-filter: blur(10px); padding: 2.5rem; border-radius: 16px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); text-align: center; transition: all 0.3s ease; border-top: 4px solid #ec4899;">
                <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #fce7f3 0%, #fbcfe8 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; box-shadow: 0 5px 15px rgba(236, 72, 153, 0.2);">
                    <i class="fas fa-tags" style="font-size: 2rem; color: #ec4899;"></i>
                </div>
                <h3 style="color: #1f2937; margin-bottom: 1rem; font-size: 1.5rem; font-weight: 600;">Mejores Precios</h3>
                <p style="color: #6b7280; line-height: 1.8; font-size: 1rem;">Calidad excepcional a precios accesibles. ¡Aprovecha nuestras promociones especiales y ofertas imperdibles!</p>
            </div>
        </div>
    </section>
    
    <!-- Call to Action -->
    <section style="text-align: center; margin: 4rem 0; padding: 3rem 2rem; background: linear-gradient(135deg, rgba(22, 163, 74, 0.9) 0%, rgba(21, 128, 61, 0.9) 100%); border-radius: 20px; box-shadow: 0 20px 40px rgba(0,0,0,0.2);">
        <h2 style="color: white; font-size: 2.5rem; margin-bottom: 1rem; font-weight: 700;">¿Listo para disfrutar?</h2>
        <p style="color: rgba(255,255,255,0.9); font-size: 1.2rem; margin-bottom: 2rem; max-width: 600px; margin-left: auto; margin-right: auto;">
            No esperes más. Haz tu pedido ahora y descubre por qué somos el restaurante favorito de la ciudad.
        </p>
        <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
            <a href="https://wa.me/56958917375" target="_blank" 
               style="display: inline-flex; align-items: center; gap: 10px; padding: 1rem 2rem; background: #25d366; color: white; text-decoration: none; border-radius: 50px; font-weight: 600; font-size: 1.1rem; box-shadow: 0 10px 25px rgba(37, 211, 102, 0.3); transition: all 0.3s ease;">
                <i class="fab fa-whatsapp"></i> Pedir por WhatsApp
            </a>
            <a href="tel:+56958917375" 
               style="display: inline-flex; align-items: center; gap: 10px; padding: 1rem 2rem; background: white; color: #16a34a; text-decoration: none; border-radius: 50px; font-weight: 600; font-size: 1.1rem; box-shadow: 0 10px 25px rgba(255,255,255,0.3); transition: all 0.3s ease;">
                <i class="fas fa-phone"></i> Llamar Ahora
            </a>
        </div>
    </section>
</main>

<?php include INCLUDES_PATH . '/footer.php'; ?>

<style>
    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    }
    
    a[href*="carta"]:hover, a[href*="promos"]:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(22, 163, 74, 0.4);
    }
    
    a[href*="whatsapp"]:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(37, 211, 102, 0.5);
    }
    
    a[href*="tel"]:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(22, 163, 74, 0.3);
    }
</style>
