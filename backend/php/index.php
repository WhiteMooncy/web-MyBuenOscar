<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Pedir | MyBuenOscar</title>
        <link rel="stylesheet" href="../css/Style.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
        <style>
            .container {
                text-align: center;
            }
            .quantity-container {
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .buton-cart-min, .buton-cart-max {
                color: white;
                border: none;
                padding: 5px 5px;
                cursor: pointer;
                font-size: 5%;
            }
            .buton-cart-min:hover, .buton-cart-max:hover {
                background-color: green;
            }
            #cantidad {
                margin: 0 8px;
                font-size: 100%;
            }
    </style>
    </head>
    <body>
        <!-- Header -->
        <header>
            <div class="navbar-brand">
                <nav class="navbar">
                    <a href="../frontend">
                        <img src="../src/menu/bebidas/monster-blanca.png" alt="Logo" style="width: 32px; height: 32px; padding: 0; justify-content: center;">
                    </a>
                    <a href="../frontend/carta.php">Carta</a>
                    <a href="../frontend/Promos.html">Promos</a>
                    <details class="dropdown">
                        <summary>Contactanos</summary>
                        <div class="dropdown-menu">
                            <a href="mailto:MyBuenOscarRestaurant@gmail.com">Correo Electrónico</a>
                            <a href="tel:+56958917375">Teléfono</a>
                            <a href="https://wa.me/56958917375" target="_blank">WhatsApp</a>
                        </div>
                    </details>
                    <a href="../frontend/Login.html" id="cart-link">Login</a>
                </nav>
            </div>
        </header>
        <!-- Main -->
        <main>
            <div id="tag-menu" class="container">
                <h1>Menú</h1>
            </div>
            <div class="main-container">
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
                                        <button class="button" onclick="agregarCarrito('El Mateo', 12000)">Añadir al carrito</button>
                                    </div>
                                    <img src="../src/menu/platos/elmateo.jpg" alt="Plato El Mateo">
                                </div>
                                <div class="item">
                                    <div class="item-info">
                                        <h3>El Pablo</h3>
                                        <p>Fina carne de ratón bañada en ketchup acompañada de papas y lechuga + bebida a elección.</p>
                                        <span class="price">$12.000</span>
                                        <button class="button" onclick="agregarCarrito('El Pablo', 12000)">Añadir al carrito</button>
                                    </div>
                                    <img src="../src/menu/platos/elpablo.jpg" alt="Plato El Pablo">
                                </div>
                                <div class="item">
                                    <div class="item-info">
                                        <h3>El Estic</h3>
                                        <p>Sabrosas paletas de caldo de pollo a la gelatina, perfectas para el calor.</p>
                                        <span class="price">$12.000</span>
                                        <button class="button" onclick="agregarCarrito('El Estic', 12000)">Añadir al carrito</button>
                                    </div>
                                    <img src="../src/menu/platos/elestic.jpg" alt="Plato El Estic">
                                </div>
                                <div class="item">
                                    <div class="item-info">
                                        <h3>El Marcelo</h3>
                                        <p>Pizza con una deliciosa base de porotos y huevos fritos.</p>
                                        <span class="price">$12.000</span>
                                        <button class="button" onclick="agregarCarrito('El Marcelo', 12000)">Añadir al carrito</button>
                                    </div>
                                    <img src="../src/menu/platos/elmarcelo.jpg" alt="Plato El Marcelo">
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
                                        <button class="button" onclick="agregarCarrito('foreskin Oreos', 10000)">Añadir al carrito</button>
                                    </div>
                                    <img src="../src/menu/platos/Opera Captura de pantalla_2025-04-21_121249_www.google.com.png" alt="oreos">
                                </div>
                                <div class="item">
                                    <div class="item-info">
                                        <h3>Almuerzo vegano</h3>
                                        <p>Delicioso arroz con ketchup acompañado de pollo vegano.</p>
                                        <span class="price">$12.000</span>
                                        <button class="button" onclick="agregarCarrito('Almuerzo vegano', 12000)">Añadir al carrito</button>
                                    </div>
                                    <img src="../src/menu/platos/Opera Captura de pantalla_2025-04-21_121329_www.google.com.png" alt="pollo vegano">
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
                                        <button class="button" onclick="agregarCarrito('Fanta de uva', 2000)">Añadir al carrito</button>
                                    </div>
                                    <img src="../src/menu/bebidas/fanta de uva.jpg" alt="Fanta de uva">
                                </div>
                                <div class="item">
                                    <div class="item-info">
                                        <h3>sprite</h3>
                                        <span class="price">$2.000</span>
                                        <button class="button" onclick="agregarCarrito('sprite', 2000)">Añadir al carrito</button>
                                    </div>
                                    <img src="../src/menu/bebidas/sprite.png" alt="Sprite">
                                </div>
                                <div class="item">
                                    <div class="item-info">
                                        <h3>coca-cola</h3>
                                        <span class="price">$2.000</span>
                                        <button class="button" onclick="agregarCarrito('coca-cola', 2000)">Añadir al carrito</button>
                                    </div>
                                    <img src="../src/menu/bebidas/coca-cola.png" alt="Coca-Cola">
                                </div>
                                <div class="item">
                                    <div class="item-info">
                                        <h3>inkacola</h3>
                                        <span class="price">$2.000</span>
                                        <button class="button" onclick="agregarCarrito('inkacola', 2000)">Añadir al carrito</button>
                                    </div>
                                    <img src="../src/menu/bebidas/inkacola.png" alt="Inka Cola">
                                </div>
                                <div class="item">
                                    <div class="item-info">
                                        <h3>sake</h3>
                                        <span class="price">$2.000</span>
                                        <button class="button" onclick="agregarCarrito('sake', 2000)">Añadir al carrito</button>
                                    </div>
                                    <img src="../src/menu/bebidas/sake.png" alt="Sake">
                                </div>
                                <div class="item">
                                    <div class="item-info">
                                        <h3>bebida</h3>
                                        <span class="price">$2.000</span>
                                        <button class="button" onclick="agregarCarrito('bebida', 2000)">Añadir al carrito</button>
                                    </div>
                                    <img src="../src/menu/bebidas/inkacola.png" alt="Bebida">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Aside -->
                <aside class="cart-sidebar" id="cart">
                    <section>
                        <h2>Tu Carrito (<span id="cart-count"><?php echo count($_SESSION['carrito']); ?></span>)</h2>
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
            
        </main>
        <!-- Footer -->
        <footer class="footer">
            <p>Ubicación: Chile <br>Teléfono: +56 9 5891 7375</p> <br>Teléfono: +56 9 5891 7375</p>
            <div class="section">
                <div>
                    <p class="social-media">
                        <a href="https://www.facebook.com" target="_blank" aria-label="Facebook">
                            <img src="../src/icons/facebook-icon.png" alt="Facebook" style="width: 32px; margin: 0 10px;">
                        </a>
                        <a href="https://www.instagram.com" target="_blank" aria-label="Instagram">
                            <img src="../src/icons/instagram-icon.png" alt="Instagram" style="width: 32px; margin: 0 10px;">
                        </a>
                        <a href="https://www.twitter.com" target="_blank" aria-label="Twitter">
                            <img src="../src/icons/twitter-icon.png" alt="Twitter" style="width: 32px; margin: 0 10px;">
                        </a>
                    </p>
                </div>
            </div>
            <p>©2025 Restaurant MyBuenOscar. Todos los derechos reservados. <br>Desarrollado por los Incervibles</p>
        </footer>
        <script>
            function agregarCarrito(nombre, precio) {
                fetch('agregar_carrito.php', {
                    method: 'POST',
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: `nombre=${encodeURIComponent(nombre)}&precio=${precio}`
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