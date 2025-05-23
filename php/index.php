<?php
require_once 'conexion.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/css/Style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <title>Inicio| MyBuenOscarRestaurant</title>
</head>
<body style="background-image: url(../src/img/fondo.png);">
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
    <div id="back-container" class="container">
        <div class="main-content">
            <div class="container">
                <h1 class="titulo-bienvenida">¡Bienvenido a Restaurant MyBuenOscar!</h1>
                <p>Nos encontramos en el mejor lugar para disfrutar de una gran noche.</p>
            </div>

            <div class="carousel">
                <div class="carousel-images">
                    <img src="../src/menu/platos/elmateo.png" alt="Imagen 1">
                    <img src="../src/menu/platos/elmarcelo.png" alt="Imagen 2">
                    <img src="../src/menu/platos/elmateo.png" alt="Imagen 3">
                    <img src="../src/menu/platos/elpablo.png" alt="Imagen 4">
                </div>
                <button class="carousel-button prev" onclick="moveSlide(-1)">&#10094;</button>
                <button class="carousel-button next" onclick="moveSlide(1)">&#10095;</button>
            </div>

            <div class="container">
                <h2>¡Encuéntranos aquí!</h2>
                <div class="mapa">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d274.1769716790572!2d-70.72120720848278!3d-32.75624071872713!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x968816d24a9a5773%3A0xf33243d141a5b549!2sAIEP%20San%20Felipe!5e1!3m2!1ses!2scl!4v1745240899379!5m2!1ses!2scl" 
                        width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>

        <div class="instagram-embeds-container" style="display: flex; gap: 20px; justify-content: center;">
            <!-- Aquí publicaciones de Instagram algun update mas adelante-->
        </div>
    </div>

    <footer class="footer">
        <p>Ubicación: Chile <br>Teléfono: +56 9 5891 7375</p>
        <div class="section">
            <div class="social-media">
                <a href="https://www.facebook.com" target="_blank" aria-label="Facebook">
                    <img src="../src/icons/facebook-icon.png" alt="Facebook" style="width: 32px; margin: 0 10px;">
                </a>
                <a href="https://www.instagram.com" target="_blank" aria-label="Instagram">
                    <img src="../src/icons/instagram-icon.png" alt="Instagram" style="width: 32px; margin: 0 10px;">
                </a>
                <a href="https://www.twitter.com" target="_blank" aria-label="Twitter">
                    <img src="../src/icons/twitter-icon.png" alt="Twitter" style="width: 32px; margin: 0 10px;">
                </a>
            </div>
        </div>
        <p>© 2025 Comidas Restoran. Todos los derechos reservados. <br>Desarrollado por los Incervibles</p>
    </footer>

    <script>
        let currentSlide = 0;

        function moveSlide(direction) {
            const slides = document.querySelector('.carousel-images');
            const totalSlides = slides.children.length;
            currentSlide = (currentSlide + direction + totalSlides) % totalSlides;
            slides.style.transform = `translateX(-${currentSlide * 100}%)`;
        }
    </script>
</body>
</html>
