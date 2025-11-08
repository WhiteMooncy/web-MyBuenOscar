<?php
/**
 * Dashboard Cliente - MyBuenOscar
 */

// Cargar configuración
require_once dirname(dirname(__DIR__)) . '/config/config.php';

// Iniciar sesión
session_start();

// Verificar que el usuario esté logueado
if (!isset($_SESSION['logged_in'])) {
    $_SESSION['error'] = 'Debes iniciar sesión para acceder';
    header('Location: ' . BASE_URL . '/views/login.php');
    exit;
}

// Título de la página
$title = 'Mi Cuenta | MyBuenOscar';
?>

<?php include dirname(__DIR__) . '/../includes/header.php'; ?>

<!-- Main Content -->
<main class="main-container">
    <div style="max-width: 1200px; margin: 2rem auto; padding: 0 1rem;">
        
        <!-- Header del Dashboard -->
        <div style="background: linear-gradient(135deg, #16a34a 0%, #15803d 100%); padding: 2.5rem; border-radius: 20px; margin-bottom: 2rem; box-shadow: 0 10px 30px rgba(22, 163, 74, 0.3); color: white;">
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                <div>
                    <h1 style="font-size: 2.5rem; margin-bottom: 0.5rem; font-weight: 700;">
                        <i class="fas fa-user"></i> Mi Cuenta
                    </h1>
                    <p style="font-size: 1.1rem; opacity: 0.95;">
                        Hola, <strong><?php echo htmlspecialchars($_SESSION['user_name']); ?></strong>
                    </p>
                </div>
                <a href="<?php echo BASE_URL; ?>/controllers/logout.php" style="background: rgba(255,255,255,0.2); color: white; padding: 0.875rem 1.75rem; border-radius: 10px; text-decoration: none; font-weight: 600; transition: all 0.3s ease; display: inline-flex; align-items: center; gap: 0.5rem; backdrop-filter: blur(10px);" onmouseover="this.style.background='rgba(255,255,255,0.3)'" onmouseout="this.style.background='rgba(255,255,255,0.2)'">
                    <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                </a>
            </div>
        </div>

        <!-- Opciones Principales -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
            
            <!-- Mis Pedidos -->
            <div style="background: white; padding: 2rem; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); transition: all 0.3s ease; cursor: pointer;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.15)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(0,0,0,0.1)'">
                <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #16a34a 0%, #15803d 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem;">
                    <i class="fas fa-shopping-bag" style="font-size: 1.75rem; color: white;"></i>
                </div>
                <h3 style="color: #1f2937; margin-bottom: 0.75rem; font-size: 1.5rem;">Mis Pedidos</h3>
                <p style="color: #6b7280; margin-bottom: 1.5rem; line-height: 1.6;">Ver historial de pedidos y seguimiento</p>
                <a href="#" style="color: #16a34a; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 0.5rem;">
                    Ver pedidos <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <!-- Hacer un Pedido -->
            <div style="background: white; padding: 2rem; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); transition: all 0.3s ease; cursor: pointer;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.15)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(0,0,0,0.1)'">
                <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem;">
                    <i class="fas fa-utensils" style="font-size: 1.75rem; color: white;"></i>
                </div>
                <h3 style="color: #1f2937; margin-bottom: 0.75rem; font-size: 1.5rem;">Hacer un Pedido</h3>
                <p style="color: #6b7280; margin-bottom: 1.5rem; line-height: 1.6;">Explora nuestro menú y realiza tu pedido</p>
                <a href="<?php echo BASE_URL; ?>/views/carta.php" style="color: #3b82f6; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 0.5rem;">
                    Ver menú <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <!-- Mi Perfil -->
            <div style="background: white; padding: 2rem; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); transition: all 0.3s ease; cursor: pointer;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.15)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(0,0,0,0.1)'">
                <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem;">
                    <i class="fas fa-user-edit" style="font-size: 1.75rem; color: white;"></i>
                </div>
                <h3 style="color: #1f2937; margin-bottom: 0.75rem; font-size: 1.5rem;">Mi Perfil</h3>
                <p style="color: #6b7280; margin-bottom: 1.5rem; line-height: 1.6;">Actualizar información personal y contraseña</p>
                <a href="#" style="color: #f59e0b; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 0.5rem;">
                    Editar perfil <i class="fas fa-arrow-right"></i>
                </a>
            </div>

        </div>

        <!-- Información de la Cuenta -->
        <div style="background: white; padding: 2.5rem; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
            <h2 style="color: #1f2937; margin-bottom: 1.5rem; font-size: 1.75rem; display: flex; align-items: center; gap: 0.75rem;">
                <i class="fas fa-id-card" style="color: #16a34a;"></i>
                Información de la Cuenta
            </h2>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem;">
                <div>
                    <p style="color: #6b7280; margin-bottom: 0.5rem; font-size: 0.9rem;">Nombre Completo</p>
                    <p style="color: #1f2937; font-size: 1.1rem; font-weight: 600; margin: 0;">
                        <?php echo htmlspecialchars($_SESSION['user_name']); ?>
                    </p>
                </div>
                
                <div>
                    <p style="color: #6b7280; margin-bottom: 0.5rem; font-size: 0.9rem;">Correo Electrónico</p>
                    <p style="color: #1f2937; font-size: 1.1rem; font-weight: 600; margin: 0;">
                        <?php echo htmlspecialchars($_SESSION['user_email']); ?>
                    </p>
                </div>
                
                <div>
                    <p style="color: #6b7280; margin-bottom: 0.5rem; font-size: 0.9rem;">Tipo de Usuario</p>
                    <p style="color: #1f2937; font-size: 1.1rem; font-weight: 600; margin: 0;">
                        <span style="background: rgba(22, 163, 74, 0.1); color: #16a34a; padding: 0.25rem 0.75rem; border-radius: 6px; text-transform: capitalize;">
                            <?php echo htmlspecialchars($_SESSION['user_type']); ?>
                        </span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Promociones Destacadas -->
        <div style="margin-top: 2rem; background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); padding: 2rem; border-radius: 15px; color: white; text-align: center;">
            <h3 style="font-size: 1.75rem; margin-bottom: 1rem;">🎉 ¡Ofertas Especiales!</h3>
            <p style="font-size: 1.1rem; margin-bottom: 1.5rem; opacity: 0.95;">Descubre nuestras promociones exclusivas</p>
            <a href="<?php echo BASE_URL; ?>/views/promos.php" style="background: white; color: #3b82f6; padding: 0.875rem 2rem; border-radius: 10px; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 0.5rem; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.2)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                <i class="fas fa-fire"></i> Ver Promociones
            </a>
        </div>

    </div>
</main>

<?php include dirname(__DIR__) . '/../includes/footer.php'; ?>

<style>
    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
