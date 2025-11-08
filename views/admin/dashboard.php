<?php
/**
 * Dashboard Administrativo - MyBuenOscar
 */

// Cargar configuración
require_once dirname(dirname(__DIR__)) . '/config/config.php';

// Iniciar sesión
session_start();

// Verificar que el usuario esté logueado y sea admin
if (!isset($_SESSION['logged_in']) || $_SESSION['user_type'] !== 'admin') {
    $_SESSION['error'] = 'Acceso denegado. Solo administradores.';
    header('Location: ' . BASE_URL . '/views/login.php');
    exit;
}

// Título de la página
$title = 'Panel Administrativo | MyBuenOscar';
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
                        <i class="fas fa-user-shield"></i> Panel Administrativo
                    </h1>
                    <p style="font-size: 1.1rem; opacity: 0.95;">
                        Bienvenido, <strong><?php echo htmlspecialchars($_SESSION['user_name']); ?></strong>
                    </p>
                </div>
                <a href="<?php echo BASE_URL; ?>/controllers/logout.php" style="background: rgba(255,255,255,0.2); color: white; padding: 0.875rem 1.75rem; border-radius: 10px; text-decoration: none; font-weight: 600; transition: all 0.3s ease; display: inline-flex; align-items: center; gap: 0.5rem; backdrop-filter: blur(10px);" onmouseover="this.style.background='rgba(255,255,255,0.3)'" onmouseout="this.style.background='rgba(255,255,255,0.2)'">
                    <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                </a>
            </div>
        </div>

        <!-- Estadísticas Rápidas -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
            
            <!-- Total Pedidos -->
            <div style="background: white; padding: 2rem; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); border-left: 4px solid #3b82f6;">
                <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 1rem;">
                    <div>
                        <p style="color: #6b7280; margin: 0 0 0.5rem 0; font-size: 0.9rem;">Total Pedidos</p>
                        <h2 style="color: #1f2937; margin: 0; font-size: 2.5rem; font-weight: 700;">156</h2>
                    </div>
                    <div style="width: 60px; height: 60px; background: rgba(59, 130, 246, 0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-shopping-bag" style="font-size: 1.75rem; color: #3b82f6;"></i>
                    </div>
                </div>
                <p style="color: #10b981; margin: 0; font-size: 0.9rem;">
                    <i class="fas fa-arrow-up"></i> +12% vs mes anterior
                </p>
            </div>

            <!-- Ingresos -->
            <div style="background: white; padding: 2rem; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); border-left: 4px solid #10b981;">
                <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 1rem;">
                    <div>
                        <p style="color: #6b7280; margin: 0 0 0.5rem 0; font-size: 0.9rem;">Ingresos</p>
                        <h2 style="color: #1f2937; margin: 0; font-size: 2.5rem; font-weight: 700;">$8,540</h2>
                    </div>
                    <div style="width: 60px; height: 60px; background: rgba(16, 185, 129, 0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-dollar-sign" style="font-size: 1.75rem; color: #10b981;"></i>
                    </div>
                </div>
                <p style="color: #10b981; margin: 0; font-size: 0.9rem;">
                    <i class="fas fa-arrow-up"></i> +8% vs mes anterior
                </p>
            </div>

            <!-- Clientes -->
            <div style="background: white; padding: 2rem; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); border-left: 4px solid #f59e0b;">
                <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 1rem;">
                    <div>
                        <p style="color: #6b7280; margin: 0 0 0.5rem 0; font-size: 0.9rem;">Clientes Activos</p>
                        <h2 style="color: #1f2937; margin: 0; font-size: 2.5rem; font-weight: 700;">89</h2>
                    </div>
                    <div style="width: 60px; height: 60px; background: rgba(245, 158, 11, 0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-users" style="font-size: 1.75rem; color: #f59e0b;"></i>
                    </div>
                </div>
                <p style="color: #10b981; margin: 0; font-size: 0.9rem;">
                    <i class="fas fa-arrow-up"></i> +23 nuevos
                </p>
            </div>

            <!-- Productos -->
            <div style="background: white; padding: 2rem; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); border-left: 4px solid #8b5cf6;">
                <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 1rem;">
                    <div>
                        <p style="color: #6b7280; margin: 0 0 0.5rem 0; font-size: 0.9rem;">Productos</p>
                        <h2 style="color: #1f2937; margin: 0; font-size: 2.5rem; font-weight: 700;">42</h2>
                    </div>
                    <div style="width: 60px; height: 60px; background: rgba(139, 92, 246, 0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-box" style="font-size: 1.75rem; color: #8b5cf6;"></i>
                    </div>
                </div>
                <p style="color: #6b7280; margin: 0; font-size: 0.9rem;">
                    <i class="fas fa-check-circle"></i> Todos disponibles
                </p>
            </div>

        </div>

        <!-- Menú de Acciones -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
            
            <!-- Gestionar Productos -->
            <div style="background: white; padding: 2rem; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); transition: all 0.3s ease; cursor: pointer;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.15)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(0,0,0,0.1)'">
                <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #16a34a 0%, #15803d 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem;">
                    <i class="fas fa-utensils" style="font-size: 1.75rem; color: white;"></i>
                </div>
                <h3 style="color: #1f2937; margin-bottom: 0.75rem; font-size: 1.5rem;">Gestionar Productos</h3>
                <p style="color: #6b7280; margin-bottom: 1.5rem; line-height: 1.6;">Agregar, editar o eliminar productos del menú</p>
                <a href="#" style="color: #16a34a; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 0.5rem;">
                    Ver productos <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <!-- Pedidos -->
            <div style="background: white; padding: 2rem; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); transition: all 0.3s ease; cursor: pointer;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.15)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(0,0,0,0.1)'">
                <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem;">
                    <i class="fas fa-receipt" style="font-size: 1.75rem; color: white;"></i>
                </div>
                <h3 style="color: #1f2937; margin-bottom: 0.75rem; font-size: 1.5rem;">Ver Pedidos</h3>
                <p style="color: #6b7280; margin-bottom: 1.5rem; line-height: 1.6;">Gestionar pedidos en curso y completados</p>
                <a href="#" style="color: #3b82f6; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 0.5rem;">
                    Ver pedidos <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <!-- Clientes -->
            <div style="background: white; padding: 2rem; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); transition: all 0.3s ease; cursor: pointer;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.15)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(0,0,0,0.1)'">
                <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem;">
                    <i class="fas fa-user-friends" style="font-size: 1.75rem; color: white;"></i>
                </div>
                <h3 style="color: #1f2937; margin-bottom: 0.75rem; font-size: 1.5rem;">Gestionar Clientes</h3>
                <p style="color: #6b7280; margin-bottom: 1.5rem; line-height: 1.6;">Ver y administrar base de datos de clientes</p>
                <a href="#" style="color: #f59e0b; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 0.5rem;">
                    Ver clientes <i class="fas fa-arrow-right"></i>
                </a>
            </div>

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
