    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-section">
                <h3><i class="fas fa-utensils"></i> MyBuenOscar</h3>
                <p>El mejor restaurante con los platos más deliciosos y únicos.</p>
            </div>
            
            <div class="footer-section">
                <h4>Enlaces Rápidos</h4>
                <ul>
                    <li><a href="<?php echo BASE_URL; ?>/index.php">Inicio</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/views/carta.php">Carta</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/views/promos.php">Promociones</a></li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h4>Contacto</h4>
                <ul>
                    <li><i class="fas fa-envelope"></i> <a href="mailto:MyBuenOscarRestaurant@gmail.com">MyBuenOscarRestaurant@gmail.com</a></li>
                    <li><i class="fas fa-phone"></i> <a href="tel:+56958917375">+56 9 5891 7375</a></li>
                    <li><i class="fab fa-whatsapp"></i> <a href="https://wa.me/56958917375" target="_blank">WhatsApp</a></li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h4>Síguenos</h4>
                <div class="social-links">
                    <a href="#" title="Facebook"><i class="fab fa-facebook"></i></a>
                    <a href="#" title="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" title="Twitter"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> MyBuenOscar Restaurant. Todos los derechos reservados.</p>
            <p>Desarrollado por <a href="https://github.com/WhiteMooncy" target="_blank">WhiteMooncy</a></p>
        </div>
    </footer>
    
    <!-- Scripts -->
    <script src="<?php echo BASE_URL; ?>/public/assets/js/cart.js"></script>
    <script>
        // Hamburger Menu Toggle
        const hamburger = document.querySelector('.hamburger');
        const navMenu = document.querySelector('.nav-menu');
        
        if (hamburger) {
            hamburger.addEventListener('click', () => {
                hamburger.classList.toggle('active');
                navMenu.classList.toggle('active');
            });
        }
        
        // Close menu when clicking on a link
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', () => {
                hamburger.classList.remove('active');
                navMenu.classList.remove('active');
            });
        });
        
        // Dropdown functionality
        const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
        dropdownToggles.forEach(toggle => {
            toggle.addEventListener('click', (e) => {
                e.preventDefault();
                const dropdown = toggle.parentElement;
                dropdown.classList.toggle('active');
            });
        });
    </script>
</body>
</html>
