<?php
/**
 * Gestión de Productos - Panel Administrativo
 */

require_once dirname(dirname(__DIR__)) . '/config/config.php';
require_once CONFIG_PATH . '/database.php';

session_start();

// Verificar autenticación y permisos de admin
if (!isset($_SESSION['logged_in']) || $_SESSION['user_type'] !== 'admin') {
    $_SESSION['error'] = 'Acceso denegado. Solo administradores.';
    header('Location: ' . BASE_URL . '/views/login.php');
    exit;
}

// Obtener productos de la base de datos
$database = new Database();
$conn = $database->getConnection();

$productos = [];
if ($conn) {
    $sql = "SELECT * FROM productos ORDER BY ID DESC";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $productos[] = $row;
        }
    }
}

$title = 'Gestión de Productos | Admin MyBuenOscar';
?>

<?php include dirname(__DIR__) . '/../includes/header.php'; ?>

<main class="main-container">
    <div style="max-width: 1400px; margin: 2rem auto; padding: 0 1rem;">
        
        <!-- Header -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;">
            <div>
                <h1 style="font-size: 2.5rem; color: #1f2937; margin-bottom: 0.5rem; font-weight: 700;">
                    <i class="fas fa-box"></i> Gestión de Productos
                </h1>
                <p style="color: #6b7280; font-size: 1.1rem;">Administra el catálogo de productos del restaurante</p>
            </div>
            <button onclick="openModal('addProduct')" style="background: linear-gradient(135deg, #16a34a 0%, #15803d 100%); color: white; border: none; padding: 1rem 2rem; border-radius: 10px; font-size: 1rem; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 0.5rem; box-shadow: 0 4px 15px rgba(22, 163, 74, 0.3); transition: all 0.3s ease;">
                <i class="fas fa-plus-circle"></i> Agregar Producto
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
                <p style="color: #6b7280; font-size: 0.9rem; margin-bottom: 0.5rem;">Total Productos</p>
                <h3 style="color: #1f2937; font-size: 2rem; margin: 0; font-weight: 700;"><?php echo count($productos); ?></h3>
            </div>
            <div style="background: white; padding: 1.5rem; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); border-left: 4px solid #3b82f6;">
                <p style="color: #6b7280; font-size: 0.9rem; margin-bottom: 0.5rem;">Categorías</p>
                <h3 style="color: #1f2937; font-size: 2rem; margin: 0; font-weight: 700;">
                    <?php echo count(array_unique(array_column($productos, 'Categoria'))); ?>
                </h3>
            </div>
            <div style="background: white; padding: 1.5rem; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); border-left: 4px solid #f59e0b;">
                <p style="color: #6b7280; font-size: 0.9rem; margin-bottom: 0.5rem;">Precio Promedio</p>
                <h3 style="color: #1f2937; font-size: 2rem; margin: 0; font-weight: 700;">
                    $<?php echo !empty($productos) ? number_format(array_sum(array_column($productos, 'Precio')) / count($productos), 0) : '0'; ?>
                </h3>
            </div>
        </div>

        <!-- Tabla de Productos -->
        <div style="background: white; border-radius: 15px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); overflow: hidden;">
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead style="background: linear-gradient(135deg, #16a34a 0%, #15803d 100%); color: white;">
                        <tr>
                            <th style="padding: 1.25rem; text-align: left; font-weight: 600;">ID</th>
                            <th style="padding: 1.25rem; text-align: left; font-weight: 600;">Imagen</th>
                            <th style="padding: 1.25rem; text-align: left; font-weight: 600;">Nombre</th>
                            <th style="padding: 1.25rem; text-align: left; font-weight: 600;">Categoría</th>
                            <th style="padding: 1.25rem; text-align: left; font-weight: 600;">Precio</th>
                            <th style="padding: 1.25rem; text-align: left; font-weight: 600;">Stock</th>
                            <th style="padding: 1.25rem; text-align: center; font-weight: 600;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($productos)): ?>
                            <tr>
                                <td colspan="7" style="padding: 3rem; text-align: center; color: #6b7280;">
                                    <i class="fas fa-box-open" style="font-size: 3rem; margin-bottom: 1rem; display: block; opacity: 0.3;"></i>
                                    No hay productos registrados. Haz clic en "Agregar Producto" para comenzar.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($productos as $producto): ?>
                                <tr style="border-bottom: 1px solid #f3f4f6; transition: background 0.2s;" onmouseover="this.style.background='#f9fafb'" onmouseout="this.style.background='white'">
                                    <td style="padding: 1rem; color: #6b7280; font-weight: 600;">#<?php echo htmlspecialchars($producto['ID']); ?></td>
                                    <td style="padding: 1rem;">
                                        <img src="<?php echo BASE_URL . '/' . htmlspecialchars($producto['Imagen']); ?>" 
                                             alt="<?php echo htmlspecialchars($producto['Nombre']); ?>"
                                             style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                                    </td>
                                    <td style="padding: 1rem; color: #1f2937; font-weight: 600;"><?php echo htmlspecialchars($producto['Nombre']); ?></td>
                                    <td style="padding: 1rem;">
                                        <span style="background: rgba(59, 130, 246, 0.1); color: #3b82f6; padding: 0.375rem 0.75rem; border-radius: 6px; font-size: 0.875rem; font-weight: 500;">
                                            <?php echo htmlspecialchars($producto['Categoria']); ?>
                                        </span>
                                    </td>
                                    <td style="padding: 1rem; color: #16a34a; font-weight: 700; font-size: 1.1rem;">
                                        $<?php echo number_format($producto['Precio'], 0); ?>
                                    </td>
                                    <td style="padding: 1rem;">
                                        <span style="background: <?php echo $producto['Stock'] > 10 ? 'rgba(16, 185, 129, 0.1)' : 'rgba(239, 68, 68, 0.1)'; ?>; 
                                                     color: <?php echo $producto['Stock'] > 10 ? '#10b981' : '#ef4444'; ?>; 
                                                     padding: 0.375rem 0.75rem; border-radius: 6px; font-size: 0.875rem; font-weight: 600;">
                                            <?php echo htmlspecialchars($producto['Stock']); ?> unidades
                                        </span>
                                    </td>
                                    <td style="padding: 1rem; text-align: center;">
                                        <button onclick="editProduct(<?php echo htmlspecialchars(json_encode($producto)); ?>)" 
                                                style="background: #3b82f6; color: white; border: none; padding: 0.5rem 1rem; border-radius: 6px; cursor: pointer; margin-right: 0.5rem; transition: all 0.2s;"
                                                onmouseover="this.style.background='#2563eb'" onmouseout="this.style.background='#3b82f6'">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button onclick="deleteProduct(<?php echo $producto['ID']; ?>, '<?php echo htmlspecialchars($producto['Nombre']); ?>')" 
                                                style="background: #ef4444; color: white; border: none; padding: 0.5rem 1rem; border-radius: 6px; cursor: pointer; transition: all 0.2s;"
                                                onmouseover="this.style.background='#dc2626'" onmouseout="this.style.background='#ef4444'">
                                            <i class="fas fa-trash"></i>
                                        </button>
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

<!-- Modal Agregar/Editar Producto -->
<div id="productModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 9999; align-items: center; justify-content: center;">
    <div style="background: white; padding: 2.5rem; border-radius: 20px; max-width: 600px; width: 90%; max-height: 90vh; overflow-y: auto; box-shadow: 0 20px 60px rgba(0,0,0,0.3);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <h2 id="modalTitle" style="color: #1f2937; font-size: 1.75rem; margin: 0;"><i class="fas fa-plus-circle"></i> Agregar Producto</h2>
            <button onclick="closeModal()" style="background: none; border: none; font-size: 1.5rem; cursor: pointer; color: #6b7280;">&times;</button>
        </div>
        
        <form id="productForm" method="POST" action="<?php echo BASE_URL; ?>/controllers/productos.php" enctype="multipart/form-data">
            <input type="hidden" id="productId" name="id">
            <input type="hidden" id="action" name="action" value="add">
            
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; color: #374151; font-weight: 600; margin-bottom: 0.5rem;">Nombre del Producto</label>
                <input type="text" id="nombre" name="nombre" required style="width: 100%; padding: 0.75rem; border: 2px solid #e5e7eb; border-radius: 8px; font-family: 'Poppins', sans-serif;">
            </div>
            
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; color: #374151; font-weight: 600; margin-bottom: 0.5rem;">Categoría</label>
                <select id="categoria" name="categoria" required style="width: 100%; padding: 0.75rem; border: 2px solid #e5e7eb; border-radius: 8px; font-family: 'Poppins', sans-serif;">
                    <option value="">Seleccionar categoría</option>
                    <option value="Platos">Platos</option>
                    <option value="Bebidas">Bebidas</option>
                    <option value="Postres">Postres</option>
                    <option value="Entradas">Entradas</option>
                    <option value="Sushi">Sushi</option>
                </select>
            </div>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.5rem;">
                <div>
                    <label style="display: block; color: #374151; font-weight: 600; margin-bottom: 0.5rem;">Precio ($)</label>
                    <input type="number" id="precio" name="precio" required min="0" step="1" style="width: 100%; padding: 0.75rem; border: 2px solid #e5e7eb; border-radius: 8px; font-family: 'Poppins', sans-serif;">
                </div>
                <div>
                    <label style="display: block; color: #374151; font-weight: 600; margin-bottom: 0.5rem;">Stock</label>
                    <input type="number" id="stock" name="stock" required min="0" style="width: 100%; padding: 0.75rem; border: 2px solid #e5e7eb; border-radius: 8px; font-family: 'Poppins', sans-serif;">
                </div>
            </div>
            
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; color: #374151; font-weight: 600; margin-bottom: 0.5rem;">Descripción</label>
                <textarea id="descripcion" name="descripcion" rows="3" style="width: 100%; padding: 0.75rem; border: 2px solid #e5e7eb; border-radius: 8px; font-family: 'Poppins', sans-serif; resize: vertical;"></textarea>
            </div>
            
            <div style="margin-bottom: 2rem;">
                <label style="display: block; color: #374151; font-weight: 600; margin-bottom: 0.5rem;">Imagen</label>
                <input type="file" id="imagen" name="imagen" accept="image/*" style="width: 100%; padding: 0.75rem; border: 2px solid #e5e7eb; border-radius: 8px; font-family: 'Poppins', sans-serif;">
                <p style="color: #6b7280; font-size: 0.875rem; margin-top: 0.5rem;">Formatos: JPG, PNG, WebP. Máximo 2MB</p>
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
    const modal = document.getElementById('productModal');
    const form = document.getElementById('productForm');
    const title = document.getElementById('modalTitle');
    
    form.reset();
    document.getElementById('productId').value = '';
    document.getElementById('action').value = mode === 'addProduct' ? 'add' : 'edit';
    title.innerHTML = mode === 'addProduct' ? '<i class="fas fa-plus-circle"></i> Agregar Producto' : '<i class="fas fa-edit"></i> Editar Producto';
    
    modal.style.display = 'flex';
}

function closeModal() {
    document.getElementById('productModal').style.display = 'none';
}

function editProduct(producto) {
    openModal('editProduct');
    document.getElementById('productId').value = producto.ID;
    document.getElementById('nombre').value = producto.Nombre;
    document.getElementById('categoria').value = producto.Categoria;
    document.getElementById('precio').value = producto.Precio;
    document.getElementById('stock').value = producto.Stock;
    document.getElementById('descripcion').value = producto.Descripcion || '';
}

function deleteProduct(id, nombre) {
    if (confirm(`¿Estás seguro de eliminar "${nombre}"?\n\nEsta acción no se puede deshacer.`)) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '<?php echo BASE_URL; ?>/controllers/productos.php';
        
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

// Cerrar modal al hacer clic fuera
document.getElementById('productModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeModal();
    }
});
</script>
