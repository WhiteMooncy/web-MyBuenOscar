<?php
/**
 * Gestión de Pedidos - Panel Administrativo
 */

require_once dirname(dirname(__DIR__)) . '/config/config.php';
require_once CONFIG_PATH . '/database.php';

session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['user_type'] !== 'admin') {
    $_SESSION['error'] = 'Acceso denegado';
    header('Location: ' . BASE_URL . '/views/login.php');
    exit;
}

$database = new Database();
$conn = $database->getConnection();

$pedidos = [];
if ($conn) {
    $sql = "SELECT p.*, u.Nombre as Cliente_Nombre, u.Correo as Cliente_Correo 
            FROM pedidos p 
            LEFT JOIN usuarios u ON p.Usuario_ID = u.ID 
            ORDER BY p.Fecha_Pedido DESC";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $pedidos[] = $row;
        }
    }
}

$title = 'Gestión de Pedidos | Admin MyBuenOscar';
?>

<?php include dirname(__DIR__) . '/../includes/header.php'; ?>

<main class="main-container">
    <div style="max-width: 1400px; margin: 2rem auto; padding: 0 1rem;">
        
        <!-- Header -->
        <div style="margin-bottom: 2rem;">
            <h1 style="font-size: 2.5rem; color: #1f2937; margin-bottom: 0.5rem; font-weight: 700;">
                <i class="fas fa-receipt"></i> Gestión de Pedidos
            </h1>
            <p style="color: #6b7280; font-size: 1.1rem;">Administra y da seguimiento a todos los pedidos</p>
        </div>

        <!-- Mensajes -->
        <?php if (isset($_SESSION['success'])): ?>
            <div style="background: #d1fae5; border-left: 4px solid #10b981; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem;">
                <p style="color: #065f46; margin: 0;"><i class="fas fa-check-circle"></i> <?php echo htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?></p>
            </div>
        <?php endif; ?>

        <!-- Estadísticas -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
            <div style="background: white; padding: 1.5rem; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); border-left: 4px solid #f59e0b;">
                <p style="color: #6b7280; font-size: 0.9rem; margin-bottom: 0.5rem;">Pendientes</p>
                <h3 style="color: #1f2937; font-size: 2rem; margin: 0; font-weight: 700;">
                    <?php echo count(array_filter($pedidos, fn($p) => $p['Estado'] === 'Pendiente')); ?>
                </h3>
            </div>
            <div style="background: white; padding: 1.5rem; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); border-left: 4px solid #3b82f6;">
                <p style="color: #6b7280; font-size: 0.9rem; margin-bottom: 0.5rem;">En Preparación</p>
                <h3 style="color: #1f2937; font-size: 2rem; margin: 0; font-weight: 700;">
                    <?php echo count(array_filter($pedidos, fn($p) => $p['Estado'] === 'En Preparación')); ?>
                </h3>
            </div>
            <div style="background: white; padding: 1.5rem; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); border-left: 4px solid #10b981;">
                <p style="color: #6b7280; font-size: 0.9rem; margin-bottom: 0.5rem;">Completados Hoy</p>
                <h3 style="color: #1f2937; font-size: 2rem; margin: 0; font-weight: 700;">
                    <?php echo count(array_filter($pedidos, fn($p) => $p['Estado'] === 'Entregado' && date('Y-m-d', strtotime($p['Fecha_Pedido'])) === date('Y-m-d'))); ?>
                </h3>
            </div>
            <div style="background: white; padding: 1.5rem; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); border-left: 4px solid #16a34a;">
                <p style="color: #6b7280; font-size: 0.9rem; margin-bottom: 0.5rem;">Total Ventas Hoy</p>
                <h3 style="color: #1f2937; font-size: 2rem; margin: 0; font-weight: 700;">
                    $<?php 
                        $totalHoy = array_sum(array_map(fn($p) => 
                            date('Y-m-d', strtotime($p['Fecha_Pedido'])) === date('Y-m-d') ? $p['Total'] : 0, 
                            $pedidos
                        ));
                        echo number_format($totalHoy, 0);
                    ?>
                </h3>
            </div>
        </div>

        <!-- Filtros -->
        <div style="background: white; padding: 1.5rem; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); margin-bottom: 2rem;">
            <div style="display: flex; gap: 1rem; flex-wrap: wrap; align-items: center;">
                <button onclick="filterByStatus('Todos')" class="filter-btn active" data-status="Todos" style="background: #16a34a; color: white; border: none; padding: 0.75rem 1.5rem; border-radius: 8px; cursor: pointer; font-weight: 600; transition: all 0.2s;">
                    Todos (<?php echo count($pedidos); ?>)
                </button>
                <button onclick="filterByStatus('Pendiente')" class="filter-btn" data-status="Pendiente" style="background: #e5e7eb; color: #374151; border: none; padding: 0.75rem 1.5rem; border-radius: 8px; cursor: pointer; font-weight: 600; transition: all 0.2s;">
                    Pendientes
                </button>
                <button onclick="filterByStatus('En Preparación')" class="filter-btn" data-status="En Preparación" style="background: #e5e7eb; color: #374151; border: none; padding: 0.75rem 1.5rem; border-radius: 8px; cursor: pointer; font-weight: 600; transition: all 0.2s;">
                    En Preparación
                </button>
                <button onclick="filterByStatus('Listo')" class="filter-btn" data-status="Listo" style="background: #e5e7eb; color: #374151; border: none; padding: 0.75rem 1.5rem; border-radius: 8px; cursor: pointer; font-weight: 600; transition: all 0.2s;">
                    Listos
                </button>
                <button onclick="filterByStatus('Entregado')" class="filter-btn" data-status="Entregado" style="background: #e5e7eb; color: #374151; border: none; padding: 0.75rem 1.5rem; border-radius: 8px; cursor: pointer; font-weight: 600; transition: all 0.2s;">
                    Entregados
                </button>
            </div>
        </div>

        <!-- Lista de Pedidos -->
        <div style="display: grid; gap: 1.5rem;">
            <?php if (empty($pedidos)): ?>
                <div style="background: white; padding: 4rem; text-align: center; border-radius: 15px; box-shadow: 0 2px 10px rgba(0,0,0,0.08);">
                    <i class="fas fa-shopping-bag" style="font-size: 4rem; color: #e5e7eb; margin-bottom: 1rem;"></i>
                    <p style="color: #6b7280; font-size: 1.2rem;">No hay pedidos registrados</p>
                </div>
            <?php else: ?>
                <?php foreach ($pedidos as $pedido): 
                    $estadoColor = [
                        'Pendiente' => '#f59e0b',
                        'En Preparación' => '#3b82f6',
                        'Listo' => '#8b5cf6',
                        'Entregado' => '#10b981',
                        'Cancelado' => '#ef4444'
                    ];
                    $color = $estadoColor[$pedido['Estado']] ?? '#6b7280';
                ?>
                    <div class="pedido-card" data-status="<?php echo $pedido['Estado']; ?>" style="background: white; padding: 2rem; border-radius: 15px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); border-left: 4px solid <?php echo $color; ?>;">
                        <div style="display: grid; grid-template-columns: 1fr auto; gap: 2rem; align-items: start;">
                            <div>
                                <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem; flex-wrap: wrap;">
                                    <h3 style="color: #1f2937; font-size: 1.5rem; margin: 0; font-weight: 700;">
                                        Pedido #<?php echo str_pad($pedido['ID'], 4, '0', STR_PAD_LEFT); ?>
                                    </h3>
                                    <span style="background: <?php echo $color; ?>20; color: <?php echo $color; ?>; padding: 0.5rem 1rem; border-radius: 8px; font-weight: 600; font-size: 0.9rem;">
                                        <?php echo $pedido['Estado']; ?>
                                    </span>
                                </div>
                                
                                <div style="display: grid; gap: 0.75rem; margin-bottom: 1.5rem;">
                                    <p style="color: #6b7280; margin: 0; display: flex; align-items: center; gap: 0.5rem;">
                                        <i class="fas fa-user" style="color: #16a34a; width: 20px;"></i>
                                        <strong>Cliente:</strong> <?php echo htmlspecialchars($pedido['Cliente_Nombre']); ?>
                                    </p>
                                    <p style="color: #6b7280; margin: 0; display: flex; align-items: center; gap: 0.5rem;">
                                        <i class="fas fa-envelope" style="color: #16a34a; width: 20px;"></i>
                                        <?php echo htmlspecialchars($pedido['Cliente_Correo']); ?>
                                    </p>
                                    <?php if (!empty($pedido['Telefono'])): ?>
                                        <p style="color: #6b7280; margin: 0; display: flex; align-items: center; gap: 0.5rem;">
                                            <i class="fas fa-phone" style="color: #16a34a; width: 20px;"></i>
                                            <?php echo htmlspecialchars($pedido['Telefono']); ?>
                                        </p>
                                    <?php endif; ?>
                                    <?php if (!empty($pedido['Direccion'])): ?>
                                        <p style="color: #6b7280; margin: 0; display: flex; align-items: center; gap: 0.5rem;">
                                            <i class="fas fa-map-marker-alt" style="color: #16a34a; width: 20px;"></i>
                                            <?php echo htmlspecialchars($pedido['Direccion']); ?>
                                        </p>
                                    <?php endif; ?>
                                    <p style="color: #6b7280; margin: 0; display: flex; align-items: center; gap: 0.5rem;">
                                        <i class="fas fa-clock" style="color: #16a34a; width: 20px;"></i>
                                        <?php echo date('d/m/Y H:i', strtotime($pedido['Fecha_Pedido'])); ?>
                                    </p>
                                </div>

                                <?php if (!empty($pedido['Notas'])): ?>
                                    <div style="background: #f9fafb; padding: 1rem; border-radius: 8px; border-left: 3px solid #3b82f6;">
                                        <p style="margin: 0; color: #374151;"><strong>Notas:</strong> <?php echo htmlspecialchars($pedido['Notas']); ?></p>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div style="text-align: right;">
                                <div style="background: linear-gradient(135deg, #16a34a 0%, #15803d 100%); padding: 1.5rem; border-radius: 12px; color: white; margin-bottom: 1rem;">
                                    <p style="margin: 0 0 0.5rem 0; font-size: 0.9rem; opacity: 0.9;">Total</p>
                                    <p style="margin: 0; font-size: 2rem; font-weight: 700;">$<?php echo number_format($pedido['Total'], 0); ?></p>
                                </div>
                                
                                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                                    <button onclick="viewDetails(<?php echo $pedido['ID']; ?>)" style="background: #3b82f6; color: white; border: none; padding: 0.75rem 1.5rem; border-radius: 8px; cursor: pointer; font-weight: 600; width: 100%;">
                                        <i class="fas fa-eye"></i> Ver Detalles
                                    </button>
                                    <?php if ($pedido['Estado'] !== 'Entregado' && $pedido['Estado'] !== 'Cancelado'): ?>
                                        <select onchange="changeStatus(<?php echo $pedido['ID']; ?>, this.value)" style="padding: 0.75rem; border: 2px solid #e5e7eb; border-radius: 8px; font-weight: 600; cursor: pointer; font-family: 'Poppins', sans-serif;">
                                            <option value="">Cambiar Estado</option>
                                            <option value="Pendiente" <?php echo $pedido['Estado'] === 'Pendiente' ? 'disabled' : ''; ?>>Pendiente</option>
                                            <option value="En Preparación" <?php echo $pedido['Estado'] === 'En Preparación' ? 'disabled' : ''; ?>>En Preparación</option>
                                            <option value="Listo" <?php echo $pedido['Estado'] === 'Listo' ? 'disabled' : ''; ?>>Listo</option>
                                            <option value="Entregado">Entregado</option>
                                            <option value="Cancelado">Cancelar</option>
                                        </select>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

    </div>
</main>

<!-- Modal Ver Detalles -->
<div id="detailsModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 9999; align-items: center; justify-content: center;">
    <div style="background: white; padding: 2.5rem; border-radius: 20px; max-width: 800px; width: 90%; max-height: 90vh; overflow-y: auto; box-shadow: 0 20px 60px rgba(0,0,0,0.3);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <h2 style="color: #1f2937; font-size: 1.75rem; margin: 0;"><i class="fas fa-receipt"></i> Detalles del Pedido</h2>
            <button onclick="closeModal()" style="background: none; border: none; font-size: 1.5rem; cursor: pointer; color: #6b7280;">&times;</button>
        </div>
        <div id="detailsContent"></div>
    </div>
</div>

<?php include dirname(__DIR__) . '/../includes/footer.php'; ?>

<script>
function filterByStatus(status) {
    const cards = document.querySelectorAll('.pedido-card');
    const buttons = document.querySelectorAll('.filter-btn');
    
    buttons.forEach(btn => {
        btn.style.background = '#e5e7eb';
        btn.style.color = '#374151';
        if (btn.dataset.status === status) {
            btn.style.background = '#16a34a';
            btn.style.color = 'white';
        }
    });
    
    cards.forEach(card => {
        if (status === 'Todos' || card.dataset.status === status) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
}

function changeStatus(id, status) {
    if (!status) return;
    
    if (confirm(`¿Cambiar estado del pedido #${id} a "${status}"?`)) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '<?php echo BASE_URL; ?>/controllers/pedidos.php';
        
        const inputId = document.createElement('input');
        inputId.type = 'hidden';
        inputId.name = 'id';
        inputId.value = id;
        
        const inputStatus = document.createElement('input');
        inputStatus.type = 'hidden';
        inputStatus.name = 'estado';
        inputStatus.value = status;
        
        const inputAction = document.createElement('input');
        inputAction.type = 'hidden';
        inputAction.name = 'action';
        inputAction.value = 'updateStatus';
        
        form.appendChild(inputId);
        form.appendChild(inputStatus);
        form.appendChild(inputAction);
        document.body.appendChild(form);
        form.submit();
    }
}

async function viewDetails(id) {
    const response = await fetch(`<?php echo BASE_URL; ?>/controllers/pedidos.php?action=getDetails&id=${id}`);
    const html = await response.text();
    document.getElementById('detailsContent').innerHTML = html;
    document.getElementById('detailsModal').style.display = 'flex';
}

function closeModal() {
    document.getElementById('detailsModal').style.display = 'none';
}

document.getElementById('detailsModal').addEventListener('click', function(e) {
    if (e.target === this) closeModal();
});
</script>
