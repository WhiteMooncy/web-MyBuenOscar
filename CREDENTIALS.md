# 🔐 Credenciales de Acceso - MyBuenOscar

## 📋 Usuarios de Prueba

### 👨‍💼 Administrador
- **Email:** admin@mybuenoscar.com
- **Contraseña:** Admin123!
- **Tipo:** admin
- **Permisos:** Acceso completo al sistema

### 👤 Cliente
- **Email:** cliente@ejemplo.com
- **Contraseña:** Cliente123!
- **Tipo:** cliente
- **Permisos:** Realizar pedidos, ver historial

### 👨‍🍳 Empleado (Opcional - No implementado aún)
- **Email:** empleado@mybuenoscar.com
- **Contraseña:** Empleado123!
- **Tipo:** empleado
- **Permisos:** Gestionar pedidos, ver inventario

---

## 🗄️ Script SQL para Crear Usuarios

```sql
-- Insertar usuarios de prueba en la base de datos
USE `web-mybuenoscar`;

-- Nota: Las contraseñas deben ser hasheadas en producción
-- Actualmente están en texto plano solo para desarrollo

-- 1. Usuario Administrador
INSERT INTO usuarios (ID, Nombre, Correo, Contraseña, Tipo_Usuario) 
VALUES (
    1,
    'Administrador',
    'admin@mybuenoscar.com',
    'Admin123!',
    'admin'
) ON DUPLICATE KEY UPDATE 
    Nombre = 'Administrador',
    Contraseña = 'Admin123!',
    Tipo_Usuario = 'admin';

-- 2. Usuario Cliente
INSERT INTO usuarios (ID, Nombre, Correo, Contraseña, Tipo_Usuario) 
VALUES (
    2,
    'Cliente Prueba',
    'cliente@ejemplo.com',
    'Cliente123!',
    'cliente'
) ON DUPLICATE KEY UPDATE 
    Nombre = 'Cliente Prueba',
    Contraseña = 'Cliente123!',
    Tipo_Usuario = 'cliente';

-- 3. Más usuarios de ejemplo
INSERT INTO usuarios (ID, Nombre, Correo, Contraseña, Tipo_Usuario) 
VALUES (
    3,
    'Juan Pérez',
    'juan@gmail.com',
    'Juan123!',
    'cliente'
) ON DUPLICATE KEY UPDATE 
    Nombre = 'Juan Pérez',
    Contraseña = 'Juan123!',
    Tipo_Usuario = 'cliente';
```

---

## 🚀 Cómo Usar

### 1. Insertar Usuarios en la Base de Datos

**⚠️ IMPORTANTE: Ejecutar desde phpMyAdmin (Recomendado)**

1. Abre http://localhost/phpmyadmin
2. Selecciona la base de datos `web-mybuenoscar`
3. Click en la tabla `usuarios`
4. Ve a la pestaña "Insertar"
5. Agrega los usuarios manualmente:

**Usuario Admin:**
```
Nombre: Administrador
Correo: admin@mybuenoscar.com
Contraseña: Admin123!
Tipo_Usuario: admin
```

**Usuario Cliente:**
```
Nombre: Cliente Prueba
Correo: cliente@ejemplo.com
Contraseña: Cliente123!
Tipo_Usuario: cliente
```

**O ejecuta este SQL en la pestaña "SQL":**
```sql
-- Limpiar tabla
TRUNCATE TABLE usuarios;

-- Insertar usuarios
INSERT INTO usuarios (Nombre, Correo, Contraseña, Tipo_Usuario) VALUES 
('Administrador', 'admin@mybuenoscar.com', 'Admin123!', 'admin'),
('Cliente Prueba', 'cliente@ejemplo.com', 'Cliente123!', 'cliente'),
('Juan Perez', 'juan@gmail.com', 'Juan123!', 'cliente');
```

### 2. Probar Login

1. Ve a: http://localhost/workbench/web-MyBuenOscar/views/login.php
2. Usa cualquiera de las credenciales de arriba
3. Click en "Iniciar Sesión"

---

## ⚠️ Notas de Seguridad

### ⚡ Para Desarrollo (Actual)
- ✅ Contraseñas en texto plano
- ✅ Fácil de probar
- ⚠️ **NO USAR EN PRODUCCIÓN**

### 🔒 Para Producción (Implementar)
```php
// Usar password_hash() y password_verify()
$hashedPassword = password_hash('Admin123!', PASSWORD_DEFAULT);

// Al verificar
if (password_verify($passwordInput, $hashedPasswordFromDB)) {
    // Login exitoso
}
```

---

## 📝 Tabla de Usuarios Actual

| ID | Nombre | Email | Contraseña | Tipo |
|----|--------|-------|------------|------|
| 1 | Administrador | admin@mybuenoscar.com | Admin123! | admin |
| 2 | Cliente Prueba | cliente@ejemplo.com | Cliente123! | cliente |
| 3 | Juan Pérez | juan@gmail.com | Juan123! | cliente |

---

## 🔄 Actualización de Contraseñas

Si necesitas cambiar una contraseña:

```sql
UPDATE usuarios 
SET Contraseña = 'NuevaContraseña123!' 
WHERE Correo = 'admin@mybuenoscar.com';
```

---

## 🎯 Próximos Pasos

1. ✅ Crear usuarios en la base de datos
2. ⏳ Implementar lógica de login en `/controllers/login.php`
3. ⏳ Agregar hash de contraseñas con `password_hash()`
4. ⏳ Crear sesiones de usuario
5. ⏳ Implementar dashboard según tipo de usuario
6. ⏳ Agregar logout

---

**Fecha de creación:** Noviembre 7, 2025  
**Última actualización:** Noviembre 7, 2025
