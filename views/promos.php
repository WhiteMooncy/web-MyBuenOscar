<?php
/**
 * Página de Promociones - MyBuenOscar
 */

// Cargar configuración
require_once dirname(__DIR__) . '/config/config.php';

// Título de la página
$title = 'Promociones | MyBuenOscar Restaurant';
?>

<?php include INCLUDES_PATH . '/header.php'; ?>

<!-- Main Content -->
<main class="main-container">
    <!-- Título -->
    <div style="text-align: center; margin-bottom: 3rem;">
        <h1 style="font-size: 3rem; color: #16a34a; margin-bottom: 1rem; font-weight: 700;">
            <i class="fas fa-fire"></i> Promociones Especiales
        </h1>
        <p style="font-size: 1.2rem; color: #6b7280;">
            ¡Aprovecha nuestras increíbles ofertas!
        </p>
    </div>

    <!-- Promociones -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 2rem; max-width: 1200px; margin: 0 auto;">
        
        <!-- Promo 1 -->
        <div style="background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%); border-radius: 20px; padding: 2rem; color: white; position: relative; overflow: hidden; box-shadow: 0 10px 30px rgba(245, 158, 11, 0.3);">
            <div style="position: absolute; top: -20px; right: -20px; background: rgba(255,255,255,0.2); width: 100px; height: 100px; border-radius: 50%;"></div>
            <div style="position: relative; z-index: 1;">
                <span style="background: #dc2626; padding: 0.5rem 1rem; border-radius: 50px; font-weight: 700; font-size: 0.9rem;">-20% OFF</span>
                <h3 style="font-size: 2rem; margin: 1.5rem 0 1rem; font-weight: 700;">Combo Familiar</h3>
                <p style="font-size: 1.1rem; margin-bottom: 1.5rem; opacity: 0.95;">2 platos principales + bebidas + postre para toda la familia</p>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <span style="text-decoration: line-through; opacity: 0.7; display: block;">$35.000</span>
                        <span style="font-size: 2.5rem; font-weight: 700;">$28.000</span>
                    </div>
                    <a href="https://wa.me/56958917375?text=Quiero el Combo Familiar" target="_blank" style="background: white; color: #f59e0b; padding: 1rem 2rem; border-radius: 50px; text-decoration: none; font-weight: 700; box-shadow: 0 4px 15px rgba(0,0,0,0.2);">
                        <i class="fab fa-whatsapp"></i> Pedir
                    </a>
                </div>
            </div>
        </div>

        <!-- Promo 2 -->
        <div style="background: linear-gradient(135deg, #ec4899 0%, #db2777 100%); border-radius: 20px; padding: 2rem; color: white; position: relative; overflow: hidden; box-shadow: 0 10px 30px rgba(236, 72, 153, 0.3);">
            <div style="position: absolute; top: -20px; right: -20px; background: rgba(255,255,255,0.2); width: 100px; height: 100px; border-radius: 50%;"></div>
            <div style="position: relative; z-index: 1;">
                <span style="background: #7c3aed; padding: 0.5rem 1rem; border-radius: 50px; font-weight: 700; font-size: 0.9rem;">2x1</span>
                <h3 style="font-size: 2rem; margin: 1.5rem 0 1rem; font-weight: 700;">Martes de Sushi</h3>
                <p style="font-size: 1.1rem; margin-bottom: 1.5rem; opacity: 0.95;">Todos los martes, lleva 2 rolls de sushi al precio de 1</p>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <span style="font-size: 2.5rem; font-weight: 700;">$8.500</span>
                        <span style="display: block; opacity: 0.9;">por 2 rolls</span>
                    </div>
                    <a href="https://wa.me/56958917375?text=Quiero la promo Martes de Sushi" target="_blank" style="background: white; color: #ec4899; padding: 1rem 2rem; border-radius: 50px; text-decoration: none; font-weight: 700; box-shadow: 0 4px 15px rgba(0,0,0,0.2);">
                        <i class="fab fa-whatsapp"></i> Pedir
                    </a>
                </div>
            </div>
        </div>

        <!-- Promo 3 -->
        <div style="background: linear-gradient(135deg, #16a34a 0%, #15803d 100%); border-radius: 20px; padding: 2rem; color: white; position: relative; overflow: hidden; box-shadow: 0 10px 30px rgba(22, 163, 74, 0.3);">
            <div style="position: absolute; top: -20px; right: -20px; background: rgba(255,255,255,0.2); width: 100px; height: 100px; border-radius: 50%;"></div>
            <div style="position: relative; z-index: 1;">
                <span style="background: #fbbf24; color: #1f2937; padding: 0.5rem 1rem; border-radius: 50px; font-weight: 700; font-size: 0.9rem;">ESPECIAL</span>
                <h3 style="font-size: 2rem; margin: 1.5rem 0 1rem; font-weight: 700;">Happy Hour</h3>
                <p style="font-size: 1.1rem; margin-bottom: 1.5rem; opacity: 0.95;">De 3pm a 6pm - 30% de descuento en bebidas seleccionadas</p>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <span style="font-size: 2.5rem; font-weight: 700;">-30%</span>
                        <span style="display: block; opacity: 0.9;">en bebidas</span>
                    </div>
                    <a href="https://wa.me/56958917375?text=Consulta sobre Happy Hour" target="_blank" style="background: white; color: #16a34a; padding: 1rem 2rem; border-radius: 50px; text-decoration: none; font-weight: 700; box-shadow: 0 4px 15px rgba(0,0,0,0.2);">
                        <i class="fab fa-whatsapp"></i> Consultar
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Nota informativa -->
    <div style="max-width: 800px; margin: 4rem auto 0; padding: 2rem; background: rgba(255,255,255,0.95); border-radius: 16px; text-align: center; border-left: 4px solid #16a34a;">
        <p style="font-size: 1.1rem; color: #1f2937; margin: 0;">
            <i class="fas fa-info-circle" style="color: #16a34a;"></i> 
            <strong>Nota:</strong> Promociones válidas hasta fin de mes. No acumulables con otras ofertas.
        </p>
    </div>
</main>

<?php include INCLUDES_PATH . '/footer.php'; ?>

<style>
    div[style*="linear-gradient"]:hover {
        transform: translateY(-5px);
        transition: all 0.3s ease;
    }
    
    a[style*="background: white"]:hover {
        transform: scale(1.05);
        transition: all 0.3s ease;
    }
</style>
