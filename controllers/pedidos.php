<?php
/**
 * Controlador de Pedidos
 */

require_once dirname(__DIR__) . '/config/config.php';
require_once CONFIG_PATH . '/database.php';

session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['user_type'] !== 'admin') {
    http_response_code(403);
    echo json_encode(['error' => 'Acceso denegado']);
    exit;
}

$database = new Database();
$conn = $database->getConnection();

if (!$conn) {
    http_response_code(500);
    echo json_encode(['error' => 'Error de conexión']);
    exit;
}

$action = $_POST['action'] ?? $_GET['action'] ?? '';

switch ($action) {
    case 'updateStatus':
        updateStatus($conn);
        break;
    case 'getDetails':
        getDetails($conn);
        break;
    default:
        http_response_code(400);
        echo json_encode(['error' => 'Acción no válida']);
        exit;
}

function updateStatus($conn) {
    $id = $_POST['id'] ?? 0;
    $estado = $_POST['estado'] ?? '';
    
    $estadosValidos = ['Pendiente', 'En Preparación', 'Listo', 'Entregado', 'Cancelado'];
    
    if ($id <= 0 || !in_array($estado, $estadosValidos)) {
        $_SESSION['error'] = 'Datos inválidos';
        header('Location: ' . BASE_URL . '/views/admin/pedidos.php');
        exit;
    }
    
    $stmt = $conn->prepare("UPDATE pedidos SET Estado = ? WHERE ID = ?");
    $stmt->bind_param("si", $estado, $id);
    
    if ($stmt->execute()) {
        $_SESSION['success'] = 'Estado actualizado correctamente';
    } else {
        $_SESSION['error'] = 'Error al actualizar: ' . $conn->error;
    }
    
    $stmt->close();
    header('Location: ' . BASE_URL . '/views/admin/pedidos.php');
    exit;
}

function getDetails($conn) {
    $id = $_GET['id'] ?? 0;
    
    if ($id <= 0) {
        echo '<p style="color: #ef4444;">ID inválido</p>';
        exit;
    }
    
    // Obtener información del pedido
    $stmt = $conn->prepare("SELECT p.*, u.Nombre as Cliente_Nombre, u.Correo as Cliente_Correo 
                           FROM pedidos p 
                           LEFT JOIN usuarios u ON p.Usuario_ID = u.ID 
                           WHERE p.ID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $pedido = $result->fetch_assoc();
    $stmt->close();
    
    if (!$pedido) {
        echo '<p style="color: #ef4444;">Pedido no encontrado</p>';
        exit;
    }
    
    // Obtener detalles del pedido
    $stmt = $conn->prepare("SELECT dp.*, pr.Nombre as Producto_Nombre, pr.Imagen 
                           FROM detalle_pedidos dp 
                           LEFT JOIN productos pr ON dp.Producto_ID = pr.ID 
                           WHERE dp.Pedido_ID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $detalles = [];
    while ($row = $result->fetch_assoc()) {
        $detalles[] = $row;
    }
    $stmt->close();
    
    // Renderizar HTML
    ?>
    <div style="margin-bottom: 2rem;">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.5rem;">
            <div>
                <p style="color: #6b7280; margin-bottom: 0.25rem; font-size: 0.9rem;">Cliente</p>
                <p style="color: #1f2937; font-weight: 600; margin: 0;"><?php echo htmlspecialchars($pedido['Cliente_Nombre']); ?></p>
            </div>
            <div>
                <p style="color: #6b7280; margin-bottom: 0.25rem; font-size: 0.9rem;">Correo</p>
                <p style="color: #1f2937; font-weight: 600; margin: 0;"><?php echo htmlspecialchars($pedido['Cliente_Correo']); ?></p>
            </div>
            <?php if (!empty($pedido['Telefono'])): ?>
            <div>
                <p style="color: #6b7280; margin-bottom: 0.25rem; font-size: 0.9rem;">Teléfono</p>
                <p style="color: #1f2937; font-weight: 600; margin: 0;"><?php echo htmlspecialchars($pedido['Telefono']); ?></p>
            </div>
            <?php endif; ?>
            <div>
                <p style="color: #6b7280; margin-bottom: 0.25rem; font-size: 0.9rem;">Estado</p>
                <p style="color: #1f2937; font-weight: 600; margin: 0;"><?php echo htmlspecialchars($pedido['Estado']); ?></p>
            </div>
        </div>
        
        <?php if (!empty($pedido['Direccion'])): ?>
        <div style="background: #f9fafb; padding: 1rem; border-radius: 8px; margin-bottom: 1rem;">
            <p style="color: #6b7280; margin-bottom: 0.25rem; font-size: 0.9rem;">Dirección de Entrega</p>
            <p style="color: #1f2937; font-weight: 600; margin: 0;"><?php echo htmlspecialchars($pedido['Direccion']); ?></p>
        </div>
        <?php endif; ?>
        
        <?php if (!empty($pedido['Notas'])): ?>
        <div style="background: #eff6ff; padding: 1rem; border-radius: 8px; border-left: 3px solid #3b82f6;">
            <p style="color: #6b7280; margin-bottom: 0.25rem; font-size: 0.9rem;">Notas del Cliente</p>
            <p style="color: #1f2937; margin: 0;"><?php echo htmlspecialchars($pedido['Notas']); ?></p>
        </div>
        <?php endif; ?>
    </div>

    <h3 style="color: #1f2937; margin-bottom: 1rem; font-weight: 700;">Productos</h3>
    <div style="background: #f9fafb; border-radius: 12px; overflow: hidden; margin-bottom: 1.5rem;">
        <?php if (empty($detalles)): ?>
            <p style="padding: 2rem; text-align: center; color: #6b7280; margin: 0;">No hay productos en este pedido</p>
        <?php else: ?>
            <?php foreach ($detalles as $index => $detalle): ?>
                <div style="padding: 1.25rem; <?php echo $index > 0 ? 'border-top: 1px solid #e5e7eb;' : ''; ?> display: flex; justify-content: space-between; align-items: center; gap: 1rem;">
                    <div style="display: flex; align-items: center; gap: 1rem; flex: 1;">
                        <?php if (!empty($detalle['Imagen'])): ?>
                            <img src="<?php echo BASE_URL . '/' . htmlspecialchars($detalle['Imagen']); ?>" 
                                 alt="<?php echo htmlspecialchars($detalle['Producto_Nombre']); ?>"
                                 style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px;">
                        <?php endif; ?>
                        <div>
                            <p style="color: #1f2937; font-weight: 600; margin: 0 0 0.25rem 0;">
                                <?php echo htmlspecialchars($detalle['Producto_Nombre'] ?? 'Producto eliminado'); ?>
                            </p>
                            <p style="color: #6b7280; margin: 0; font-size: 0.9rem;">
                                Cantidad: <?php echo $detalle['Cantidad']; ?> × $<?php echo number_format($detalle['Precio_Unitario'], 0); ?>
                            </p>
                        </div>
                    </div>
                    <div style="text-align: right;">
                        <p style="color: #16a34a; font-weight: 700; font-size: 1.1rem; margin: 0;">
                            $<?php echo number_format($detalle['Subtotal'], 0); ?>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <div style="background: linear-gradient(135deg, #16a34a 0%, #15803d 100%); padding: 1.5rem; border-radius: 12px; display: flex; justify-content: space-between; align-items: center; color: white;">
        <span style="font-size: 1.25rem; font-weight: 700;">TOTAL</span>
        <span style="font-size: 2rem; font-weight: 700;">$<?php echo number_format($pedido['Total'], 0); ?></span>
    </div>
    <?php
    exit;
}

$conn->close();
?>
