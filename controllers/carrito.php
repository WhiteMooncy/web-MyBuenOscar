<?php
/**
 * Controlador del Carrito de Compras
 */

require_once dirname(__DIR__) . '/config/config.php';

class CarritoController {
    
    /**
     * Iniciar sesión del carrito
     */
    public function iniciarSesion() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['carrito']) || !is_array($_SESSION['carrito'])) {
            $_SESSION['carrito'] = [];
        }
    }
    
    /**
     * Agregar producto al carrito
     */
    public function agregar() {
        $this->iniciarSesion();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'] ?? '';
            $precio = intval($_POST['precio'] ?? 0);
            $src = $_POST['src'] ?? '';
            
            $existe = false;
            foreach ($_SESSION['carrito'] as &$item) {
                if ($item['nombre'] === $nombre) {
                    $item['cantidad'] += 1;
                    $existe = true;
                    break;
                }
            }
            
            if (!$existe) {
                $_SESSION['carrito'][] = [
                    'imagen' => $src,
                    'nombre' => $nombre,
                    'precio' => $precio,
                    'cantidad' => 1
                ];
            }
            
            return true;
        }
        
        return false;
    }
    
    /**
     * Actualizar cantidad de productos en el carrito
     */
    public function actualizar() {
        $this->iniciarSesion();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $index = intval($_POST['index'] ?? -1);
            $accion = $_POST['accion'] ?? '';
            
            if (isset($_SESSION['carrito'][$index])) {
                switch ($accion) {
                    case "sumar":
                        $_SESSION['carrito'][$index]['cantidad']++;
                        break;
                        
                    case "restar":
                        $_SESSION['carrito'][$index]['cantidad']--;
                        if ($_SESSION['carrito'][$index]['cantidad'] <= 0) {
                            $this->eliminarItem($index);
                        }
                        break;
                        
                    case "eliminar":
                        $this->eliminarItem($index);
                        break;
                }
            }
            
            return true;
        }
        
        return false;
    }
    
    /**
     * Eliminar un item del carrito
     */
    private function eliminarItem($index) {
        unset($_SESSION['carrito'][$index]);
        $_SESSION['carrito'] = array_values($_SESSION['carrito']);
    }
    
    /**
     * Obtener items del carrito
     */
    public function obtenerCarrito() {
        $this->iniciarSesion();
        return $_SESSION['carrito'];
    }
    
    /**
     * Calcular total del carrito
     */
    public function calcularTotal() {
        $this->iniciarSesion();
        $total = 0;
        
        foreach ($_SESSION['carrito'] as $item) {
            $total += $item['precio'] * $item['cantidad'];
        }
        
        return $total;
    }
    
    /**
     * Vaciar carrito
     */
    public function vaciarCarrito() {
        $this->iniciarSesion();
        $_SESSION['carrito'] = [];
    }
}

// Si se llama directamente, ejecutar acción
if (basename($_SERVER['PHP_SELF']) === 'carrito.php') {
    $controller = new CarritoController();
    
    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'agregar':
                $controller->agregar();
                break;
            case 'actualizar':
                $controller->actualizar();
                break;
        }
    }
}
?>
