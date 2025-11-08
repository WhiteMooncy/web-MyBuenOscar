-- Script para insertar usuarios de prueba en MyBuenOscar
-- Ejecutar en phpMyAdmin: http://localhost/phpmyadmin

-- Primero, limpiar la tabla de usuarios
TRUNCATE TABLE usuarios;

-- Insertar usuarios de prueba
INSERT INTO usuarios (Nombre, Correo, Contraseña, Tipo_Usuario) VALUES
('Administrador', 'admin@mybuenoscar.com', 'Admin123!', 'admin'),
('Cliente Prueba', 'cliente@ejemplo.com', 'Cliente123!', 'cliente'),
('Juan Perez', 'juan@gmail.com', 'Juan123!', 'cliente');

-- Verificar que se insertaron correctamente
SELECT ID, Nombre, Correo, Tipo_Usuario, 
       CASE WHEN Contraseña IS NULL OR Contraseña = '' 
            THEN 'SIN CONTRASEÑA' 
            ELSE 'OK' 
       END as Estado_Password
FROM usuarios;
