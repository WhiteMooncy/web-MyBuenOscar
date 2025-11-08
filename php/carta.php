<?php
session_start();
if (!isset($_SESSION['carrito']) || !is_array($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Pedir | MyBuenOscar</title>
        <link rel="stylesheet" href="../src/css/Style.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    </head>
    <body style="background-image: url(../src/img/fondo.png);">
        <!-- Header -->
        <header>
            <div class="navbar-brand">
                <nav class="navbar">
                    <a href="../php/index.php" class="logo">
                        <img src="../src/menu/bebidas/monster-blanca.png" alt="Logo" style="width: 32px; height: 32px; padding: 0; justify-content: center;">
                    </a>
                    <a href="../php/carta.php">Carta</a>
                    <a href="../templates/Promos.html">Promos</a>
                    <details class="dropdown">
                        <summary>Contactanos</summary>
                        <div class="dropdown-menu">
                            <a href="mailto:MyBuenOscarRestaurant@gmail.com">Correo Electrónico</a>
                            <a href="tel:+56958917375">Teléfono</a>
                            <a href="https://wa.me/56958917375" target="_blank">WhatsApp</a>
                        </div>
                    </details>
                    <a href="../templates/login.html" id="cart-link">Login</a>
                </nav>
            </div>
        </header>
        <!-- Main -->
        <main>
            <div class="main-container">
                <div id="tag-menu" class="container">
                    <h1>Menú</h1>
                </div>
                <div class="menu-columns">
                    <div class="container">
                        <div id="tag-especiales" class="container">
                            <h1>Especiales</h1>
                        </div>
                        <div id="plato-semana" class="section">
                            <div class="menu-grid">
                                <!-- Platos -->
                                <div class="item">
                                    <div class="item-info">
                                        <h3>El Mateo</h3>
                                        <p>Delicioso pollo cthulu para 4 personas.</p>
                                        <span class="price">$12.000</span>
                                        <button class="button" onclick="agregarCarrito('El Mateo', 12000, 'platos', 'elmateo')">Añadir al carrito</button>
                                    </div>
                                    <img src="../src/menu/platos/elmateo.png" alt="Plato El Mateo">
                                </div>
                                <div class="item">
                                    <div class="item-info">
                                        <h3>El Pablo</h3>
                                        <p>Fina carne de ratón bañada en ketchup acompañada de papas y lechuga + bebida a elección.</p>
                                        <span class="price">$12.000</span>
                                        <button class="button" onclick="agregarCarrito('El Pablo', 12000, 'platos', 'elpablo')">Añadir al carrito</button>
                                    </div>
                                    <img src="../src/menu/platos/elpablo.png" alt="Plato El Pablo">
                                </div>
                                <div class="item">
                                    <div class="item-info">
                                        <h3>El Estic</h3>
                                        <p>Sabrosas paletas de caldo de pollo a la gelatina, perfectas para el calor.</p>
                                        <span class="price">$12.000</span>
                                        <button class="button" onclick="agregarCarrito('El Estic', 12000, 'platos', 'elestic')">Añadir al carrito</button>
                                    </div>
                                    <img src="../src/menu/platos/elestic.png" alt="Plato El Estic">
                                </div>
                                <div class="item">
                                    <div class="item-info">
                                        <h3>El Marcelo</h3>
                                        <p>Pizza con una deliciosa base de porotos y huevos fritos.</p>
                                        <span class="price">$12.000</span>
                                        <button class="button" onclick="agregarCarrito('El Marcelo', 12000, 'platos', 'elmarcelo')">Añadir al carrito</button>
                                    </div>
                                    <img src="../src/menu/platos/elmarcelo.png" alt="Plato El Marcelo">
                                </div>
                            </div>
                        </div>
                        <div id="tag-platos" class="container">
                            <h1>Platos</h1>
                        </div>
                        <div id="menu" class="section">
                            <div class="menu-grid">
                                <div class="item">
                                    <div class="item-info">
                                        <h3>foreskin Oreos</h3>
                                        <p>Ricas oreos cubiertas de prepucio.</p>
                                        <span class="price">$10.000</span>
                                        <button class="button" onclick="agregarCarrito('foreskin Oreos', 10000, 'platos', 'foreskinoreos')">Añadir al carrito</button>
                                    </div>
                                    <img src="../src/menu/platos/foreskinoreos.png" alt="oreos">
                                </div>
                                <div class="item">
                                    <div class="item-info">
                                        <h3>Almuerzo vegano</h3>
                                        <p>Delicioso arroz con ketchup acompañado de pollo vegano.</p>
                                        <span class="price">$12.000</span>
                                        <button class="button" onclick="agregarCarrito('Almuerzo vegano', 12000, 'platos', 'pollovegano')">Añadir al carrito</button>
                                    </div>
                                    <img src="../src/menu/platos/pollovegano.png" alt="pollo vegano">
                                </div>
                                <div class="item">
                                    <div class="item-info">
                                        <h3>Completo dulce</h3>
                                        <p>completo con cubierta de cereal y papitas.</p>
                                        <span class="price">$2.500</span>
                                        <button class="button" onclick="agregarCarrito('Completo dulce', 2500, 'platos', 'completodulce')">Añadir al carrito</button>
                                    </div>
                                    <img src="../src/menu/platos/completodulce.png" alt="Empanadas de queso">
                                </div>
                                <div class="item">
                                    <div class="item-info">
                                        <h3>mamfimfla dulce</h3>
                                        <p>mamfimflas recien horneadas.</p>
                                        <span class="price">$5.000</span>
                                        <button class="button" onclick="agregarCarrito('mamfimfla dulce', 5000, 'platos', 'mamflimfladulce')">Añadir al carrito</button>
                                    </div>
                                    <img src="../src/menu/platos/mamflimfladulce.png" alt="Empanadas de queso">
                                </div>
                                <div class="item">
                                    <div class="item-info">
                                        <h3>Ratasush</h3>
                                        <p>ricos ratones trozados rellenos con queso crema.</p>
                                        <span class="price">$12.000</span>
                                        <button class="button" onclick="agregarCarrito('Ratasush', 12000, 'platos', 'ratasush')">Añadir al carrito</button>
                                    </div>
                                    <img src="../src/menu/platos/ratasush.png" alt="Sushi">
                                </div>
                                <div class="item">
                                    <div class="item-info">
                                        <h3>Cheetos con leche</h3>
                                        <p>ricos ratones trozados rellenos con queso crema.</p>
                                        <span class="price">$12.000</span>
                                        <button class="button" onclick="agregarCarrito('Cheetos con leche', 12000, 'platos', 'cheetosconleche')">Añadir al carrito</button>
                                    </div>
                                    <img src="../src/menu/platos/cheetosconleche.png" alt="Cheetos">
                                </div>
                                <div class="item">
                                    <div class="item-info">
                                        <h3>pepinillos mounstrosos</h3>
                                        <p>finos pepinillos conservado en Monster.</p>
                                        <span class="price">$8.000</span>
                                        <button class="button" onclick="agregarCarrito('pepinillos mounstrosos', 8000, 'platos','pepinillos-monstruosos')">Añadir al carrito</button>
                                    </div>
                                    <img src="../src/menu/platos/pepinillos-mounstrosos.png" alt="pepinillos">
                                </div>
                                <div class="item">
                                    <div class="item-info">
                                        <h3>BananaSplit</h3>
                                        <p>delicionsa banana trozada con sardinas.</p>
                                        <span class="price">$6.000</span>
                                        <button class="button" onclick="agregarCarrito('BananaSplit', 6000, 'platos', 'postre')">Añadir al carrito</button>
                                    </div>
                                    <img src="../src/menu/platos/postre.png" alt="postre">
                                </div>
                                <div class="item">
                                    <div class="item-info">
                                        <h3>SoupOfMakako</h3>
                                        <p>caldo de mono autraliano exportado.</p>
                                        <span class="price">$9.000</span>
                                        <button class="button" onclick="agregarCarrito('SoupOfMakako', 9000, 'platos', 'sopa')">Añadir al carrito</button>
                                    </div>
                                    <img src="../src/menu/platos/sopa.png" alt="sopademakako">
                                </div>
                                <div class="item">
                                    <div class="item-info">
                                        <h3>Sushi</h3>
                                        <p>riko salmon recien pescado del artico.</p>
                                        <span class="price">$6.000</span>
                                        <button class="button" onclick="agregarCarrito('Sushi', 6000, 'platos', 'sushi')">Añadir al carrito</button>
                                    </div>
                                    <img src="../src/menu/platos/sushi.png" alt="sushi">
                                </div>
                                <div class="item">
                                    <div class="item-info">
                                        <h3>TdoPizza</h3>
                                        <p>Deliciosa pizza con todas las sobras de la Semana.</p>
                                        <span class="price">$12.000</span>
                                        <button class="button" onclick="agregarCarrito('TdoPizza', 12000, 'platos', 'tdopizza')">Añadir al carrito</button>
                                    </div>
                                    <img src="../src/menu/platos/tdopizza.png" alt="pizza">
                                </div>
                                <div class="item">
                                    <div class="item-info">
                                        <h3>Torta</h3>
                                        <p>Torta de fideos decorada con peperoni.</p>
                                        <span class="price">$20.000</span>
                                        <button class="button" onclick="agregarCarrito('Torta', 20000, 'platos', 'torta')">Añadir al carrito</button>
                                    </div>
                                    <img src="../src/menu/platos/torta.png" alt="Torta">
                                </div>
                            </div>
                        </div>
                        <div id="tag-bebidas" class="container">
                            <h1>Bebidas</h1>
                        </div>
                        <div id="menu" class="section">
                            <div class="menu-grid">
                                <div class="item">
                                    <div class="item-info">
                                        <h3>Fanta de uva</h3>
                                        <span class="price">$2.000</span>
                                        <button class="button" onclick="agregarCarrito('Fanta de uva', 2000, 'bebidas', 'fanta-de-uva')">Añadir al carrito</button>
                                    </div>
                                    <img src="../src/menu/bebidas/fanta-de-uva.png" alt="Fanta de uva">
                                </div>
                                <div class="item">
                                    <div class="item-info">
                                        <h3>Sprite</h3>
                                        <span class="price">$2.000</span>
                                        <button class="button" onclick="agregarCarrito('Sprite', 2000, 'bebidas', 'sprite')">Añadir al carrito</button>
                                    </div>
                                    <img src="../src/menu/bebidas/sprite.png" alt="Sprite">
                                </div>
                                <div class="item">
                                    <div class="item-info">
                                        <h3>Coca-Cola</h3>
                                        <span class="price">$2.000</span>
                                        <button class="button" onclick="agregarCarrito('Coca-Cola', 2000, 'bebidas', 'coca-cola')">Añadir al carrito</button>
                                    </div>
                                    <img src="../src/menu/bebidas/coca-cola.png" alt="Coca-Cola">
                                </div>
                                <div class="item">
                                    <div class="item-info">
                                        <h3>Inka Cola</h3>
                                        <span class="price">$2.000</span>
                                        <button class="button" onclick="agregarCarrito('Inka Cola', 2000, 'bebidas', 'inkacola')">Añadir al carrito</button>
                                    </div>
                                    <img src="../src/menu/bebidas/inkacola.png" alt="Inka Cola">
                                </div>
                                <div class="item">
                                    <div class="item-info">
                                        <h3>Sake</h3>
                                        <span class="price">$2.000</span>
                                        <button class="button" onclick="agregarCarrito('Sake', 2000, 'bebidas', 'sake')">Añadir al carrito</button>
                                    </div>
                                    <img src="../src/menu/bebidas/sake.png" alt="Sake">
                                </div>
                                <div class="item">
                                    <div class="item-info">
                                        <h3>Bebida</h3>
                                        <span class="price">$2.000</span>
                                        <button class="button" onclick="agregarCarrito('Bebida', 2000, 'bebidas', 'inkacola')">Añadir al carrito</button>
                                    </div>
                                    <img src="../src/menu/bebidas/inkacola.png" alt="Bebida">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Aside -->
                    <aside class="cart-sidebar" id="cart">
                        <section>
                            <h2>Tu Carrito (<span id="cart-count"><?php echo isset($_SESSION['carrito']) && is_array($_SESSION['carrito']) ? count($_SESSION['carrito']) : 0; ?></span>)</h2>
                            <div class="cart-location">
                                <label for="location">¿Dónde quieres pedir?</label>
                                <select id="location">
                                    <option value="">Selecciona una ubicación</option>
                                    <option value="local1">Local 1</option>
                                    <option value="local2">Local 2</option>
                                </select>
                            </div>
                        </section>
                        <div id="items-carrito">
                            <?php
                            $total = 0;
                            foreach ($_SESSION['carrito'] as $index => $item) {
                                $imagen = isset($item['imagen']) && !empty($item['imagen']) ? $item['imagen'] : '../src/menu/default-image.png';
                                $subtotal = $item['precio'] * $item['cantidad'];
                                $total += $subtotal;
                                echo "
                                <div class='container'>
                                    <div class='cart-item'>
                                        <img src='{$imagen}' alt='{$item['nombre']}' class='cart-item-image'>
                                        <div class='cart-item-details'>
                                            <p class='cart-item-name'>{$item['nombre']}</p>
                                            <p class='cart-item-price' id='subtotal-{$index}'>\$" . number_format($subtotal) . "</p>
                                            <div class='quantity-container'>
                                                <button class='buton-cart-min' onclick='actualizarCantidad($index, \"restar\")'>-</button>
                                                <span id='cantidad-{$index}'>{$item['cantidad']}</span>
                                                <button class='buton-cart-max' onclick='actualizarCantidad($index, \"sumar\")'>+</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>";
                            }
                            ?>
                        </div>
                        <div class="cart-summary">
                            <p>Subtotal: <span class="cart-subtotal">$<?php echo number_format($total); ?></span></p>
                            <button class="cart-continue-btn" onclick="continuarCompra()">Continuar</button>
                        </div>
                    </aside>
                </div>
            </div>
            
        </main>
        <!-- Footer -->
        <footer class="footer" style="padding: 10px; font-size: 12px; text-align: center;">
            <p>Ubicación: Chile <br>Teléfono: +56 9 5891 7375</p>
            <div class="section" style="margin: 10px 0;">
                <div>
                    <p class="social-media">
                        <a href="https://www.facebook.com" target="_blank" aria-label="Facebook">
                            <img src="../src/icons/facebook-icon.png" alt="Facebook" style="width: 24px; margin: 0 5px;">
                        </a>
                        <a href="https://www.instagram.com" target="_blank" aria-label="Instagram">
                            <img src="../src/icons/instagram-icon.png" alt="Instagram" style="width: 24px; margin: 0 5px;">
                        </a>
                        <a href="https://www.twitter.com" target="_blank" aria-label="Twitter">
                            <img src="../src/icons/twitter-icon.png" alt="Twitter" style="width: 24px; margin: 0 5px;">
                        </a>
                    </p>
                </div>
            </div>
            <p>©2025 Restaurant MyBuenOscar. Todos los derechos reservados. <br>Desarrollado por los Incervibles</p>
        </footer>
        <script>
            // Se añadio un type y una imagen para obtener la imagen del producto.
            function agregarCarrito(nombre, precio, type, img) {

                // este genera un SRC para obtener la imagen del producto.
                // por ejemplo: agregarCarrito('El Mateo', 12000, 'platos', 'elmateo');
                // el src sería: ../src/menu/platos/elmateo.png
                var src = '../src/menu/' + type + '/' + img + '.png';

                fetch('agregar_carrito.php', {
                    method: 'POST',
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    
                    // al body se le añadio el src para obtener la imagen del producto.
                    body: `nombre=${encodeURIComponent(nombre)}&precio=${precio}&src=${encodeURIComponent(src)}`
                }).then(() => location.reload());
            }

            function actualizarCantidad(index, accion) {
                fetch('actualizar_carrito.php', {
                    method: 'POST',
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: `index=${index}&accion=${accion}`
                }).then(() => location.reload());
            }

            function continuarCompra() {
                alert('Redirigiendo a la página de pago...');
            }
        </script>
    </body>
</html>
