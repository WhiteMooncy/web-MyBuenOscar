<?php
/**
 * Página de Login - MyBuenOscar
 */

// Cargar configuración
require_once dirname(__DIR__) . '/config/config.php';

// Título de la página
$title = 'Iniciar Sesión | MyBuenOscar Restaurant';
?>

<?php include INCLUDES_PATH . '/header.php'; ?>

<!-- Main Content -->
<main class="main-container">
    <div style="max-width: 450px; margin: 2rem auto; background: rgba(255,255,255,0.95); backdrop-filter: blur(10px); padding: 3rem 2.5rem; border-radius: 20px; box-shadow: 0 20px 40px rgba(0,0,0,0.15);">
        
        <!-- Logo y Título -->
        <div style="text-align: center; margin-bottom: 2rem;">
            <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #16a34a 0%, #15803d 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; box-shadow: 0 10px 25px rgba(22, 163, 74, 0.3);">
                <i class="fas fa-user" style="font-size: 2.5rem; color: white;"></i>
            </div>
            <h1 style="font-size: 2rem; color: #1f2937; margin-bottom: 0.5rem; font-weight: 700;">Bienvenido</h1>
            <p style="color: #6b7280; font-size: 1rem;">Inicia sesión en tu cuenta</p>
        </div>

        <!-- Formulario -->
        <form action="<?php echo BASE_URL; ?>/controllers/login.php" method="POST" style="display: flex; flex-direction: column; gap: 1.5rem;">
            
            <!-- Email -->
            <div style="position: relative;">
                <label for="email" style="display: block; color: #374151; font-weight: 600; margin-bottom: 0.5rem; font-size: 0.9rem;">
                    <i class="fas fa-envelope" style="color: #16a34a; margin-right: 8px;"></i>
                    Correo Electrónico
                </label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    required
                    placeholder="tu@email.com"
                    style="width: 100%; padding: 0.875rem 1rem; border: 2px solid #e5e7eb; border-radius: 10px; font-size: 1rem; transition: all 0.3s ease; font-family: 'Poppins', sans-serif;"
                    onfocus="this.style.borderColor='#16a34a'; this.style.boxShadow='0 0 0 3px rgba(22, 163, 74, 0.1)'"
                    onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none'"
                >
            </div>

            <!-- Contraseña -->
            <div style="position: relative;">
                <label for="password" style="display: block; color: #374151; font-weight: 600; margin-bottom: 0.5rem; font-size: 0.9rem;">
                    <i class="fas fa-lock" style="color: #16a34a; margin-right: 8px;"></i>
                    Contraseña
                </label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    required
                    placeholder="••••••••"
                    style="width: 100%; padding: 0.875rem 1rem; border: 2px solid #e5e7eb; border-radius: 10px; font-size: 1rem; transition: all 0.3s ease; font-family: 'Poppins', sans-serif;"
                    onfocus="this.style.borderColor='#16a34a'; this.style.boxShadow='0 0 0 3px rgba(22, 163, 74, 0.1)'"
                    onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none'"
                >
            </div>

            <!-- Recordarme / Olvidé contraseña -->
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer; font-size: 0.9rem; color: #6b7280;">
                    <input type="checkbox" name="remember" style="width: 18px; height: 18px; cursor: pointer; accent-color: #16a34a;">
                    Recordarme
                </label>
                <a href="#" style="color: #16a34a; text-decoration: none; font-size: 0.9rem; font-weight: 600;">
                    ¿Olvidaste tu contraseña?
                </a>
            </div>

            <!-- Botón de Login -->
            <button 
                type="submit"
                style="width: 100%; background: linear-gradient(135deg, #16a34a 0%, #15803d 100%); color: white; border: none; padding: 1rem; border-radius: 10px; font-size: 1.1rem; font-weight: 700; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(22, 163, 74, 0.3); font-family: 'Poppins', sans-serif;"
                onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(22, 163, 74, 0.4)'"
                onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(22, 163, 74, 0.3)'"
            >
                <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
            </button>
        </form>

        <!-- Divider -->
        <div style="display: flex; align-items: center; margin: 2rem 0; gap: 1rem;">
            <div style="flex: 1; height: 1px; background: #e5e7eb;"></div>
            <span style="color: #9ca3af; font-size: 0.9rem;">o</span>
            <div style="flex: 1; height: 1px; background: #e5e7eb;"></div>
        </div>

        <!-- Registro -->
        <div style="text-align: center;">
            <p style="color: #6b7280; margin-bottom: 1rem;">¿No tienes una cuenta?</p>
            <a href="#" style="display: inline-flex; align-items: center; gap: 8px; color: #16a34a; text-decoration: none; font-weight: 600; padding: 0.75rem 2rem; border: 2px solid #16a34a; border-radius: 10px; transition: all 0.3s ease;">
                <i class="fas fa-user-plus"></i> Crear una cuenta
            </a>
        </div>

    </div>

    <!-- Nota -->
    <div style="max-width: 600px; margin: 2rem auto 0; text-align: center; padding: 1.5rem; background: rgba(59, 130, 246, 0.1); border-radius: 12px; border-left: 4px solid #3b82f6;">
        <p style="color: #1f2937; margin: 0;">
            <i class="fas fa-info-circle" style="color: #3b82f6;"></i> 
            <strong>Próximamente:</strong> Sistema de pedidos online con seguimiento en tiempo real
        </p>
    </div>
</main>

<?php include INCLUDES_PATH . '/footer.php'; ?>

<style>
    a[style*="border: 2px solid"]:hover {
        background: #16a34a;
        color: white;
        transform: translateY(-2px);
    }
</style>
