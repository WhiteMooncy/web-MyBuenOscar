# 🔐 Guía de Prueba del Sistema de Login - MyBuenOscar

## 📋 Pasos para Configurar y Probar

### 1️⃣ Insertar Usuarios en la Base de Datos

**Método Recomendado: phpMyAdmin**

1. Abre tu navegador y ve a: **http://localhost/phpmyadmin**
2. En el panel izquierdo, selecciona la base de datos `web_mybuenoscar`
3. Haz clic en la pestaña **SQL** en la parte superior
4. Copia y pega el siguiente código:

```sql
-- Limpiar tabla de usuarios
TRUNCATE TABLE usuarios;

-- Insertar usuarios de prueba
INSERT INTO usuarios (Nombre, Correo, Contraseña, Tipo_Usuario) VALUES
('Administrador', 'admin@mybuenoscar.com', 'Admin123!', 'admin'),
('Cliente Prueba', 'cliente@ejemplo.com', 'Cliente123!', 'cliente'),
('Juan Perez', 'juan@gmail.com', 'Juan123!', 'cliente');
```

5. Haz clic en el botón **"Continuar"** o **"Go"**
6. Verifica que aparezca el mensaje de éxito

---

### 2️⃣ Probar el Login

#### **Login como Administrador:**
- **URL:** http://localhost/workbench/web-MyBuenOscar/views/login.php
- **Email:** `admin@mybuenoscar.com`
- **Password:** `Admin123!`
- **Redirige a:** Panel Administrativo (`/views/admin/dashboard.php`)

#### **Login como Cliente:**
- **URL:** http://localhost/workbench/web-MyBuenOscar/views/login.php
- **Email:** `cliente@ejemplo.com`
- **Password:** `Cliente123!`
- **Redirige a:** Panel de Cliente (`/views/cliente/dashboard.php`)

#### **Otro Cliente:**
- **URL:** http://localhost/workbench/web-MyBuenOscar/views/login.php
- **Email:** `juan@gmail.com`
- **Password:** `Juan123!`
- **Redirige a:** Panel de Cliente (`/views/cliente/dashboard.php`)

---

### 3️⃣ Funciones Implementadas

✅ **Sistema de Autenticación:**
- Login con email y contraseña
- Validación de credenciales
- Protección contra SQL injection (prepared statements)
- Mensajes de error descriptivos

✅ **Gestión de Sesiones:**
- Sesión iniciada al hacer login exitoso
- Variables de sesión: `user_id`, `user_name`, `user_email`, `user_type`, `logged_in`
- Cookie "Recordarme" (30 días) si se marca la casilla

✅ **Control de Acceso por Rol:**
- **Admin:** Acceso al panel administrativo con estadísticas y gestión
- **Cliente:** Acceso al panel de cliente con pedidos y perfil
- Protección de rutas (redirige si no tiene permisos)

✅ **Dashboards:**
- **Admin Dashboard:** Estadísticas, gestión de productos, pedidos y clientes
- **Cliente Dashboard:** Mis pedidos, hacer pedido, editar perfil, promociones
- Botón de "Cerrar Sesión" en ambos paneles

✅ **Logout:**
- Destruye todas las variables de sesión
- Elimina cookies de sesión y "recordarme"
- Redirige al login con mensaje de confirmación

---

### 4️⃣ Arquitectura de Archivos

```
web-MyBuenOscar/
├── controllers/
│   ├── login.php        ✅ Procesa el formulario de login
│   ├── logout.php       ✅ Cierra la sesión del usuario
│   └── carrito.php      (Existente)
├── views/
│   ├── login.php        ✅ Formulario de inicio de sesión
│   ├── admin/
│   │   └── dashboard.php ✅ Panel administrativo
│   └── cliente/
│       └── dashboard.php ✅ Panel de cliente
├── config/
│   ├── config.php       (Configuración general)
│   └── database.php     (Conexión a BD)
└── src/DB/
    └── insert_usuarios_phpmyadmin.sql ✅ Script SQL para usuarios
```

---

### 5️⃣ Flujo del Sistema de Login

```
1. Usuario ingresa email/password en login.php
   ↓
2. Form envía POST a controllers/login.php
   ↓
3. Controller valida datos y consulta BD
   ↓
4. Si credenciales correctas:
   - Crea sesión con datos del usuario
   - Redirige según tipo_usuario:
     * admin → /views/admin/dashboard.php
     * cliente → /views/cliente/dashboard.php
   ↓
5. Si credenciales incorrectas:
   - Muestra mensaje de error
   - Vuelve a login.php
```

---

### 6️⃣ Verificar que Todo Funciona

**Checklist de Pruebas:**

- [ ] ✅ Usuarios insertados correctamente en phpMyAdmin
- [ ] ✅ Login con admin@mybuenoscar.com funciona
- [ ] ✅ Login con cliente@ejemplo.com funciona
- [ ] ✅ Login con credenciales incorrectas muestra error
- [ ] ✅ Admin redirige a `/views/admin/dashboard.php`
- [ ] ✅ Cliente redirige a `/views/cliente/dashboard.php`
- [ ] ✅ Dashboard muestra nombre del usuario
- [ ] ✅ Botón "Cerrar Sesión" funciona
- [ ] ✅ Después de logout vuelve a login.php
- [ ] ✅ No se puede acceder a dashboards sin login

---

### 7️⃣ Solución de Problemas

#### ❌ **Error: "404 Not Found" en controllers/login.php**
**Solución:** Verifica que el archivo existe en `c:\xampp\htdocs\workbench\web-MyBuenOscar\controllers\login.php`

#### ❌ **Error: "Usuario no encontrado"**
**Solución:** Ejecuta el script SQL en phpMyAdmin para insertar usuarios

#### ❌ **Error: "Contraseña incorrecta"**
**Solución:** Asegúrate de escribir exactamente: `Admin123!` o `Cliente123!` (mayúsculas y minúsculas importan)

#### ❌ **Error de conexión a la base de datos**
**Solución:** 
1. Verifica que XAMPP esté ejecutando Apache y MySQL
2. Verifica que la base de datos `web_mybuenoscar` existe
3. Revisa config/database.php

#### ❌ **Después de login no redirige**
**Solución:** 
1. Verifica que no haya espacios o saltos de línea antes de `<?php` en login.php
2. Abre las herramientas de desarrollo del navegador (F12) → pestaña "Network" → verifica la respuesta

---

### 8️⃣ Mejoras Futuras (Próximas Implementaciones)

🔜 **Seguridad:**
- Implementar `password_hash()` y `password_verify()` para encriptar contraseñas
- Protección contra ataques de fuerza bruta (límite de intentos)
- Tokens CSRF en formularios

🔜 **Funcionalidades:**
- Recuperación de contraseña por email
- Registro de nuevos usuarios
- Edición de perfil
- Cambio de contraseña
- Sistema de roles más complejo

🔜 **UX/UI:**
- Mostrar/ocultar contraseña
- Validación en tiempo real
- Autocompletado del email si hay cookie
- Mensajes de error más específicos

---

## 🎉 ¡Listo para Probar!

1. Abre phpMyAdmin: http://localhost/phpmyadmin
2. Ejecuta el script SQL de usuarios
3. Ve a: http://localhost/workbench/web-MyBuenOscar/views/login.php
4. Prueba con: `admin@mybuenoscar.com` / `Admin123!`
5. ¡Disfruta tu panel de administración!

---

**Fecha de Creación:** 2025-11-07  
**Versión:** 1.0  
**Autor:** Sistema de Login MyBuenOscar
