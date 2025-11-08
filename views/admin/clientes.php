<?php
/**
 * Gestión de Clientes - Panel Administrativo
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

$clientes = [];
if ($conn) {
    $sql = "SELECT * FROM usuarios ORDER BY ID DESC";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $clientes[] = $row;
        }
    }
}

$title = 'Gestión de Clientes | Admin MyBuenOscar';
?>

<?php include dirname(__DIR__) . '/../includes/header.php'; ?>

<main class="main-container">
    <div style="max-width: 1400px; margin: 2rem auto; padding: 0 1rem;">
        
        <!-- Header -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;">
            <div>
                <h1 style="font-size: 2.5rem; color: #1f2937; margin-bottom: 0.5rem; font-weight: 700;">
                    <i class="fas fa-users"></i> Gestión de Clientes
                </h1>
                <p style="color: #6b7280; font-size: 1.1rem;">Administra los usuarios registrados en el sistema</p>
            </div>
            <button onclick="openModal('addClient')" style="background: linear-gradient(135deg, #16a34a 0%, #15803d 100%); color: white; border: none; padding: 1rem 2rem; border-radius: 10px; font-size: 1rem; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 0.5rem; box-shadow: 0 4px 15px rgba(22, 163, 74, 0.3);">
                <i class="fas fa-user-plus"></i> Agregar Cliente
            </button>
        </div>

        <!-- Mensajes -->
        <?php if (isset($_SESSION['success'])): ?>
            <div style="background: #d1fae5; border-left: 4px solid #10b981; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem;">
                <p style="color: #065f46; margin: 0;"><i class="fas fa-check-circle"></i> <?php echo htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?></p>
            </div>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['error'])): ?>
            <div style="background: #fee2e2; border-left: 4px solid #ef4444; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem;">
                <p style="color: #991b1b; margin: 0;"><i class="fas fa-exclamation-circle"></i> <?php echo htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?></p>
            </div>
        <?php endif; ?>

        <!-- Estadísticas -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
            <div style="background: white; padding: 1.5rem; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); border-left: 4px solid #16a34a;">
                <p style="color: #6b7280; font-size: 0.9rem; margin-bottom: 0.5rem;">Total Usuarios</p>
                <h3 style="color: #1f2937; font-size: 2rem; margin: 0; font-weight: 700;"><?php echo count($clientes); ?></h3>
            </div>
            <div style="background: white; padding: 1.5rem; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); border-left: 4px solid #3b82f6;">
                <p style="color: #6b7280; font-size: 0.9rem; margin-bottom: 0.5rem;">Clientes</p>
                <h3 style="color: #1f2937; font-size: 2rem; margin: 0; font-weight: 700;">
                    <?php echo count(array_filter($clientes, fn($c) => $c['Tipo_Usuario'] === 'cliente')); ?>
                </h3>
            </div>
            <div style="background: white; padding: 1.5rem; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); border-left: 4px solid #f59e0b;">
                <p style="color: #6b7280; font-size: 0.9rem; margin-bottom: 0.5rem;">Administradores</p>
                <h3 style="color: #1f2937; font-size: 2rem; margin: 0; font-weight: 700;">
                    <?php echo count(array_filter($clientes, fn($c) => $c['Tipo_Usuario'] === 'admin')); ?>
                </h3>
            </div>
        </div>

        <!-- Tabla de Clientes -->
        <div style="background: white; border-radius: 15px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); overflow: hidden;">
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead style="background: linear-gradient(135deg, #16a34a 0%, #15803d 100%); color: white;">
                        <tr>
                            <th style="padding: 1.25rem; text-align: left; font-weight: 600;">ID</th>
                            <th style="padding: 1.25rem; text-align: left; font-weight: 600;">Nombre</th>
                            <th style="padding: 1.25rem; text-align: left; font-weight: 600;">Correo</th>
                            <th style="padding: 1.25rem; text-align: left; font-weight: 600;">Tipo</th>
                            <th style="padding: 1.25rem; text-align: left; font-weight: 600;">Fecha Registro</th>
                            <th style="padding: 1.25rem; text-align: center; font-weight: 600;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($clientes)): ?>
                            <tr>
                                <td colspan="6" style="padding: 3rem; text-align: center; color: #6b7280;">
                                    <i class="fas fa-users-slash" style="font-size: 3rem; margin-bottom: 1rem; display: block; opacity: 0.3;"></i>
                                    No hay clientes registrados
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($clientes as $cliente): ?>
                                <tr style="border-bottom: 1px solid #f3f4f6; transition: background 0.2s;" onmouseover="this.style.background='#f9fafb'" onmouseout="this.style.background='white'">
                                    <td style="padding: 1rem; color: #6b7280; font-weight: 600;">#<?php echo htmlspecialchars($cliente['ID']); ?></td>
                                    <td style="padding: 1rem;">
                                        <div style="display: flex; align-items: center; gap: 0.75rem;">
                                            <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #16a34a 0%, #15803d 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600;">
                                                <?php echo strtoupper(substr($cliente['Nombre'], 0, 1)); ?>
                                            </div>
                                            <span style="color: #1f2937; font-weight: 600;"><?php echo htmlspecialchars($cliente['Nombre']); ?></span>
                                        </div>
                                    </td>
                                    <td style="padding: 1rem; color: #6b7280;"><?php echo htmlspecialchars($cliente['Correo']); ?></td>
                                    <td style="padding: 1rem;">
                                        <span style="background: <?php echo $cliente['Tipo_Usuario'] === 'admin' ? 'rgba(239, 68, 68, 0.1)' : 'rgba(59, 130, 246, 0.1)'; ?>; 
                                                     color: <?php echo $cliente['Tipo_Usuario'] === 'admin' ? '#ef4444' : '#3b82f6'; ?>; 
                                                     padding: 0.375rem 0.75rem; border-radius: 6px; font-size: 0.875rem; font-weight: 600; text-transform: capitalize;">
                                            <?php echo htmlspecialchars($cliente['Tipo_Usuario']); ?>
                                        </span>
                                    </td>
                                    <td style="padding: 1rem; color: #6b7280;">
                                        <?php echo isset($cliente['Fecha_Registro']) ? date('d/m/Y', strtotime($cliente['Fecha_Registro'])) : 'N/A'; ?>
                                    </td>
                                    <td style="padding: 1rem; text-align: center;">
                                        <button onclick="editClient(<?php echo htmlspecialchars(json_encode($cliente)); ?>)" 
                                                style="background: #3b82f6; color: white; border: none; padding: 0.5rem 1rem; border-radius: 6px; cursor: pointer; margin-right: 0.5rem; transition: all 0.2s;">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <?php if ($cliente['ID'] != $_SESSION['user_id']): ?>
                                            <button onclick="deleteClient(<?php echo $cliente['ID']; ?>, '<?php echo htmlspecialchars($cliente['Nombre']); ?>')" 
                                                    style="background: #ef4444; color: white; border: none; padding: 0.5rem 1rem; border-radius: 6px; cursor: pointer; transition: all 0.2s;">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</main>

<!-- Modal Agregar/Editar Cliente -->
<div id="clientModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 9999; align-items: center; justify-content: center;">
    <div style="background: white; padding: 2.5rem; border-radius: 20px; max-width: 600px; width: 90%; max-height: 90vh; overflow-y: auto; box-shadow: 0 20px 60px rgba(0,0,0,0.3);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <h2 id="modalTitle" style="color: #1f2937; font-size: 1.75rem; margin: 0;"><i class="fas fa-user-plus"></i> Agregar Cliente</h2>
            <button onclick="closeModal()" style="background: none; border: none; font-size: 1.5rem; cursor: pointer; color: #6b7280;">&times;</button>
        </div>
        
        <form id="clientForm" method="POST" action="<?php echo BASE_URL; ?>/controllers/clientes.php">
            <input type="hidden" id="clientId" name="id">
            <input type="hidden" id="action" name="action" value="add">
            
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; color: #374151; font-weight: 600; margin-bottom: 0.5rem;">Nombre Completo</label>
                <input type="text" id="nombre" name="nombre" required style="width: 100%; padding: 0.75rem; border: 2px solid #e5e7eb; border-radius: 8px; font-family: 'Poppins', sans-serif;">
            </div>
            
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; color: #374151; font-weight: 600; margin-bottom: 0.5rem;">Correo Electrónico</label>
                <input type="email" id="correo" name="correo" required style="width: 100%; padding: 0.75rem; border: 2px solid #e5e7eb; border-radius: 8px; font-family: 'Poppins', sans-serif;">
            </div>
            
            <div style="margin-bottom: 1.5rem;" id="passwordField">
                <label style="display: block; color: #374151; font-weight: 600; margin-bottom: 0.5rem;">Contraseña</label>
                <input type="password" id="password" name="password" style="width: 100%; padding: 0.75rem; border: 2px solid #e5e7eb; border-radius: 8px; font-family: 'Poppins', sans-serif;">
                <p style="color: #6b7280; font-size: 0.875rem; margin-top: 0.5rem;">Mínimo 6 caracteres. Dejar en blanco para no cambiar.</p>
            </div>
            
            <div style="margin-bottom: 2rem;">
                <label style="display: block; color: #374151; font-weight: 600; margin-bottom: 0.5rem;">Tipo de Usuario</label>
                <select id="tipo" name="tipo" required style="width: 100%; padding: 0.75rem; border: 2px solid #e5e7eb; border-radius: 8px; font-family: 'Poppins', sans-serif;">
                    <option value="cliente">Cliente</option>
                    <option value="admin">Administrador</option>
                </select>
            </div>
            
            <div style="display: flex; gap: 1rem; justify-content: flex-end;">
                <button type="button" onclick="closeModal()" style="background: #e5e7eb; color: #374151; border: none; padding: 0.875rem 1.75rem; border-radius: 8px; font-weight: 600; cursor: pointer;">
                    Cancelar
                </button>
                <button type="submit" style="background: linear-gradient(135deg, #16a34a 0%, #15803d 100%); color: white; border: none; padding: 0.875rem 1.75rem; border-radius: 8px; font-weight: 600; cursor: pointer; box-shadow: 0 4px 15px rgba(22, 163, 74, 0.3);">
                    <i class="fas fa-save"></i> Guardar
                </button>
            </div>
        </form>
    </div>
</div>

<?php include dirname(__DIR__) . '/../includes/footer.php'; ?>

<script>
function openModal(mode) {
    const modal = document.getElementById('clientModal');
    const form = document.getElementById('clientForm');
    const title = document.getElementById('modalTitle');
    const passwordField = document.getElementById('password');
    
    form.reset();
    document.getElementById('clientId').value = '';
    document.getElementById('action').value = mode === 'addClient' ? 'add' : 'edit';
    title.innerHTML = mode === 'addClient' ? '<i class="fas fa-user-plus"></i> Agregar Cliente' : '<i class="fas fa-edit"></i> Editar Cliente';
    
    passwordField.required = mode === 'addClient';
    
    modal.style.display = 'flex';
}

function closeModal() {
    document.getElementById('clientModal').style.display = 'none';
}

function editClient(cliente) {
    openModal('editClient');
    document.getElementById('clientId').value = cliente.ID;
    document.getElementById('nombre').value = cliente.Nombre;
    document.getElementById('correo').value = cliente.Correo;
    document.getElementById('tipo').value = cliente.Tipo_Usuario;
    document.getElementById('password').value = '';
}

function deleteClient(id, nombre) {
    if (confirm(`¿Estás seguro de eliminar a "${nombre}"?\n\nEsta acción no se puede deshacer.`)) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '<?php echo BASE_URL; ?>/controllers/clientes.php';
        
        const inputId = document.createElement('input');
        inputId.type = 'hidden';
        inputId.name = 'id';
        inputId.value = id;
        
        const inputAction = document.createElement('input');
        inputAction.type = 'hidden';
        inputAction.name = 'action';
        inputAction.value = 'delete';
        
        form.appendChild(inputId);
        form.appendChild(inputAction);
        document.body.appendChild(form);
        form.submit();
    }
}

document.getElementById('clientModal').addEventListener('click', function(e) {
    if (e.target === this) closeModal();
});
</script>
