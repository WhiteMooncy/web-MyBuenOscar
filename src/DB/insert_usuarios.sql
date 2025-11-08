-- Script para insertar usuarios de prueba
USE `web-mybuenoscar`;

-- 1. Usuario Administrador
INSERT INTO usuarios (Nombre, Correo, Tipo_Usuario) 
VALUES ('Administrador', 'admin@mybuenoscar.com', 'admin');

-- 2. Usuario Cliente
INSERT INTO usuarios (Nombre, Correo, Tipo_Usuario) 
VALUES ('Cliente Prueba', 'cliente@ejemplo.com', 'cliente');

-- 3. Usuario Cliente 2
INSERT INTO usuarios (Nombre, Correo, Tipo_Usuario) 
VALUES ('Juan Perez', 'juan@gmail.com', 'cliente');

-- Actualizar contraseñas
UPDATE usuarios SET `Contraseña` = 'Admin123!' WHERE Correo = 'admin@mybuenoscar.com';
UPDATE usuarios SET `Contraseña` = 'Cliente123!' WHERE Correo = 'cliente@ejemplo.com';
UPDATE usuarios SET `Contraseña` = 'Juan123!' WHERE Correo = 'juan@gmail.com';

-- Verificar que se insertaron correctamente
SELECT ID, Nombre, Correo, Tipo_Usuario FROM usuarios;

