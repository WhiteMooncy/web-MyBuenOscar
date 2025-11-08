<?php
/**
 * Página de Carta/Menú - MyBuenOscar
 */

// Cargar configuración
require_once dirname(__DIR__) . '/config/config.php';
require_once CONTROLLERS_PATH . '/carrito.php';

// Iniciar carrito
$carritoController = new CarritoController();
$carritoController->iniciarSesion();

// Título de la página
$title = 'Nuestra Carta | MyBuenOscar Restaurant';
?>

<?php include INCLUDES_PATH . '/header.php'; ?>

<!-- Main Content -->
<main class="main-container">
    <!-- Título del Menú -->
    <div style="text-align: center; margin-bottom: 3rem;">
        <h1 style="font-size: 3rem; color: #16a34a; margin-bottom: 1rem; font-weight: 700;">
            <i class="fas fa-book-open"></i> Nuestro Menú
        </h1>
        <p style="font-size: 1.2rem; color: #6b7280;">
            Descubre nuestros deliciosos platos únicos
        </p>
    </div>

    <!-- Platos Especiales -->
    <section style="margin-bottom: 4rem;">
        <div style="background: linear-gradient(135deg, #16a34a 0%, #15803d 100%); padding: 1.5rem; border-radius: 16px; margin-bottom: 2rem; text-align: center;">
            <h2 style="color: white; font-size: 2rem; margin: 0;">
                <i class="fas fa-star"></i> Especiales de la Casa
            </h2>
        </div>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
            <!-- El Mateo -->
            <div style="background: rgba(255,255,255,0.95); border-radius: 16px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.1); transition: transform 0.3s ease;">
                <img src="<?php echo BASE_URL; ?>/public/assets/menu/platos/elmateo.png" alt="El Mateo" style="width: 100%; height: 250px; object-fit: cover;">
                <div style="padding: 1.5rem;">
                    <h3 style="font-size: 1.5rem; color: #1f2937; margin-bottom: 0.5rem;">El Mateo</h3>
                    <p style="color: #6b7280; margin-bottom: 1rem;">Delicioso pollo cthulu para 4 personas.</p>
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-size: 1.5rem; font-weight: 700; color: #16a34a;">$12.000</span>
                        <button onclick="agregarAlCarrito('El Mateo', 12000, '<?php echo BASE_URL; ?>/public/assets/menu/platos/elmateo.png')" 
                                style="background: #16a34a; color: white; border: none; padding: 0.75rem 1.5rem; border-radius: 50px; cursor: pointer; font-weight: 600; transition: all 0.3s ease;">
                            <i class="fas fa-shopping-cart"></i> Agregar
                        </button>
                    </div>
                </div>
            </div>

            <!-- El Pablo -->
            <div style="background: rgba(255,255,255,0.95); border-radius: 16px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.1); transition: transform 0.3s ease;">
                <img src="<?php echo BASE_URL; ?>/public/assets/menu/platos/elpablo.png" alt="El Pablo" style="width: 100%; height: 250px; object-fit: cover;">
                <div style="padding: 1.5rem;">
                    <h3 style="font-size: 1.5rem; color: #1f2937; margin-bottom: 0.5rem;">El Pablo</h3>
                    <p style="color: #6b7280; margin-bottom: 1rem;">Fina carne de ratón bañada en ketchup acompañada de papas y lechuga + bebida a elección.</p>
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-size: 1.5rem; font-weight: 700; color: #16a34a;">$12.000</span>
                        <button onclick="agregarAlCarrito('El Pablo', 12000, '<?php echo BASE_URL; ?>/public/assets/menu/platos/elpablo.png')" 
                                style="background: #16a34a; color: white; border: none; padding: 0.75rem 1.5rem; border-radius: 50px; cursor: pointer; font-weight: 600; transition: all 0.3s ease;">
                            <i class="fas fa-shopping-cart"></i> Agregar
                        </button>
                    </div>
                </div>
            </div>

            <!-- El Estic -->
            <div style="background: rgba(255,255,255,0.95); border-radius: 16px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.1); transition: transform 0.3s ease;">
                <img src="<?php echo BASE_URL; ?>/public/assets/menu/platos/elestic.png" alt="El Estic" style="width: 100%; height: 250px; object-fit: cover;">
                <div style="padding: 1.5rem;">
                    <h3 style="font-size: 1.5rem; color: #1f2937; margin-bottom: 0.5rem;">El Estic</h3>
                    <p style="color: #6b7280; margin-bottom: 1rem;">Sabrosas paletas de caldo de pollo a la gelatina, perfectas para el calor.</p>
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-size: 1.5rem; font-weight: 700; color: #16a34a;">$12.000</span>
                        <button onclick="agregarAlCarrito('El Estic', 12000, '<?php echo BASE_URL; ?>/public/assets/menu/platos/elestic.png')" 
                                style="background: #16a34a; color: white; border: none; padding: 0.75rem 1.5rem; border-radius: 50px; cursor: pointer; font-weight: 600; transition: all 0.3s ease;">
                            <i class="fas fa-shopping-cart"></i> Agregar
                        </button>
                    </div>
                </div>
            </div>

            <!-- El Marcelo -->
            <div style="background: rgba(255,255,255,0.95); border-radius: 16px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.1); transition: transform 0.3s ease;">
                <img src="<?php echo BASE_URL; ?>/public/assets/menu/platos/elmarcelo.png" alt="El Marcelo" style="width: 100%; height: 250px; object-fit: cover;">
                <div style="padding: 1.5rem;">
                    <h3 style="font-size: 1.5rem; color: #1f2937; margin-bottom: 0.5rem;">El Marcelo</h3>
                    <p style="color: #6b7280; margin-bottom: 1rem;">Pizza con una deliciosa base de porotos y huevos fritos.</p>
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-size: 1.5rem; font-weight: 700; color: #16a34a;">$12.000</span>
                        <button onclick="agregarAlCarrito('El Marcelo', 12000, '<?php echo BASE_URL; ?>/public/assets/menu/platos/elmarcelo.png')" 
                                style="background: #16a34a; color: white; border: none; padding: 0.75rem 1.5rem; border-radius: 50px; cursor: pointer; font-weight: 600; transition: all 0.3s ease;">
                            <i class="fas fa-shopping-cart"></i> Agregar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Otros Platos -->
    <section style="margin-bottom: 4rem;">
        <div style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); padding: 1.5rem; border-radius: 16px; margin-bottom: 2rem; text-align: center;">
            <h2 style="color: white; font-size: 2rem; margin: 0;">
                <i class="fas fa-utensils"></i> Más Platos Deliciosos
            </h2>
        </div>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
            <!-- Foreskin Oreos -->
            <div style="background: rgba(255,255,255,0.95); border-radius: 16px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
                <img src="<?php echo BASE_URL; ?>/public/assets/menu/platos/foreskinoreos.png" alt="Foreskin Oreos" style="width: 100%; height: 250px; object-fit: cover;">
                <div style="padding: 1.5rem;">
                    <h3 style="font-size: 1.5rem; color: #1f2937; margin-bottom: 0.5rem;">Foreskin Oreos</h3>
                    <p style="color: #6b7280; margin-bottom: 1rem;">Ricas oreos cubiertas de prepucio.</p>
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-size: 1.5rem; font-weight: 700; color: #16a34a;">$10.000</span>
                        <button onclick="agregarAlCarrito('Foreskin Oreos', 10000, '<?php echo BASE_URL; ?>/public/assets/menu/platos/foreskinoreos.png')" 
                                style="background: #f59e0b; color: white; border: none; padding: 0.75rem 1.5rem; border-radius: 50px; cursor: pointer; font-weight: 600;">
                            <i class="fas fa-shopping-cart"></i> Agregar
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sushi -->
            <div style="background: rgba(255,255,255,0.95); border-radius: 16px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
                <img src="<?php echo BASE_URL; ?>/public/assets/menu/platos/sushi.png" alt="Sushi" style="width: 100%; height: 250px; object-fit: cover;">
                <div style="padding: 1.5rem;">
                    <h3 style="font-size: 1.5rem; color: #1f2937; margin-bottom: 0.5rem;">Sushi Especial</h3>
                    <p style="color: #6b7280; margin-bottom: 1rem;">Delicioso sushi fresco del día.</p>
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-size: 1.5rem; font-weight: 700; color: #16a34a;">$8.500</span>
                        <button onclick="agregarAlCarrito('Sushi Especial', 8500, '<?php echo BASE_URL; ?>/public/assets/menu/platos/sushi.png')" 
                                style="background: #f59e0b; color: white; border: none; padding: 0.75rem 1.5rem; border-radius: 50px; cursor: pointer; font-weight: 600;">
                            <i class="fas fa-shopping-cart"></i> Agregar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include INCLUDES_PATH . '/footer.php'; ?>

<script>
function agregarAlCarrito(nombre, precio, imagen) {
    // Crear formulario para enviar al controlador
    const formData = new FormData();
    formData.append('nombre', nombre);
    formData.append('precio', precio);
    formData.append('src', imagen);
    
    fetch('<?php echo BASE_URL; ?>/controllers/carrito.php?action=agregar', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        alert('✅ ' + nombre + ' agregado al carrito!');
    })
    .catch(error => {
        console.error('Error:', error);
        alert('❌ Error al agregar al carrito');
    });
}
</script>

<style>
    button:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(22, 163, 74, 0.3);
    }
    
    div[style*="box-shadow"]:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.15) !important;
    }
</style>
