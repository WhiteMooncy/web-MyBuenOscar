<?php
session_start();
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pedir | MyBuenOscar</title>
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body>
    <!--- Header -->
    <header>
        <div class="navbar-brand">
            <nav class="navbar">
                <a href="../frontend">
                    <img src="../src/bebidas/monster-blanca.png" alt="Logo" style="width: 32px; height: 32px; padding: 0; justify-content: center;">  
                </a>
                <a href="../frontend/carta.html">Carta</a>
                <a href="../frontend/Promos.html">Promos</a>
                <details class="dropdown">
                    <summary>Contactanos</summary>
                    <div class="dropdown-menu">
                        <a href="mailto:MyBuenOscarRestaurant@gmail.com">Correo Electrónico</a>
                        <a href="tel:+56958917375">Teléfono</a>
                        <a href="https://wa.me/56958917375" target="_blank">WhatsApp</a>
                    </div>
                </details>
                <a href="../frontend/Login.html" id="cart-link">
                    Login
                </a>
            </nav>
        </div>
    </header>
    <!--- Main -->
    <main>
        <h1>Menú</h1>
        <div class="menu-item">
            <h2>El Mateo</h2>
            <p>$12.000</p>
            <button onclick="agregarCarrito('El Mateo', 12000)">Añadir al carrito</button>
        </div>

        <aside id="cart" class="cart-sidebar">
            <h2>Tu Carrito</h2>
            <div id="items-carrito">
                <?php
                $total = 0;
                foreach ($_SESSION['carrito'] as $index => $item) {
                    $subtotal = $item['precio'] * $item['cantidad'];
                    $total += $subtotal;
                    echo "<div>
                        <p>{$item['nombre']} - {$item['cantidad']} x \$" . number_format($item['precio']) . " = \$" . number_format($subtotal) . "</p>
                        <button onclick='actualizarCantidad($index, \"sumar\")'>+</button>
                        <button onclick='actualizarCantidad($index, \"restar\")'>-</button>
                        <button onclick='actualizarCantidad($index, \"eliminar\")'>Eliminar</button>
                    </div>";
                }
                ?>
            </div>
            <p><strong>Total: $<?php echo number_format($total); ?></strong></p>
        </aside>
    </main>
    <!-- Footer -->
    <footer class="footer">
        <p>Ubicación: Chile <br>Teléfono: +56 9 5891 7375</p>
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
    </script>
</body>
</html>