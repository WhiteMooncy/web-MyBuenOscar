-- Tabla de Pedidos para MyBuenOscar
-- Ejecutar en phpMyAdmin

CREATE TABLE IF NOT EXISTS pedidos (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Usuario_ID INT NOT NULL,
    Fecha_Pedido DATETIME DEFAULT CURRENT_TIMESTAMP,
    Estado ENUM('Pendiente', 'En Preparación', 'Listo', 'Entregado', 'Cancelado') DEFAULT 'Pendiente',
    Total DECIMAL(10,2) NOT NULL,
    Direccion VARCHAR(255),
    Telefono VARCHAR(20),
    Notas TEXT,
    FOREIGN KEY (Usuario_ID) REFERENCES usuarios(ID) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS detalle_pedidos (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Pedido_ID INT NOT NULL,
    Producto_ID INT NOT NULL,
    Cantidad INT NOT NULL,
    Precio_Unitario DECIMAL(10,2) NOT NULL,
    Subtotal DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (Pedido_ID) REFERENCES pedidos(ID) ON DELETE CASCADE,
    FOREIGN KEY (Producto_ID) REFERENCES productos(ID) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insertar pedidos de ejemplo
INSERT INTO pedidos (Usuario_ID, Estado, Total, Direccion, Telefono, Notas) VALUES
(2, 'Pendiente', 15500, 'Av. Principal 123, Santiago', '+56912345678', 'Sin cebolla en el plato'),
(3, 'En Preparación', 8900, 'Calle Los Aromos 456', '+56987654321', 'Envío urgente'),
(2, 'Listo', 22000, 'Av. Principal 123, Santiago', '+56912345678', ''),
(3, 'Entregado', 12500, 'Calle Los Aromos 456', '+56987654321', 'Perfecto, gracias');

-- Insertar detalles de pedidos (ajustar según IDs de productos existentes)
INSERT INTO detalle_pedidos (Pedido_ID, Producto_ID, Cantidad, Precio_Unitario, Subtotal) VALUES
(1, 1, 2, 7500, 15000),
(1, 2, 1, 500, 500),
(2, 3, 1, 8900, 8900),
(3, 1, 2, 7500, 15000),
(3, 4, 1, 7000, 7000),
(4, 2, 2, 5000, 10000),
(4, 5, 1, 2500, 2500);
