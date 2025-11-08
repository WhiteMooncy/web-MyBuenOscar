<?php
/**
 * Configuración general de la aplicación
 */

// Configuración de errores (desarrollo)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Zona horaria
date_default_timezone_set('America/Lima');

// Configuración de sesión
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);

// Constantes de la aplicación
define('APP_NAME', 'MyBuenOscar');
define('APP_VERSION', '1.0.0');
define('BASE_URL', 'http://localhost/workbench/web-MyBuenOscar');

// Rutas del proyecto
define('ROOT_PATH', dirname(__DIR__));
define('CONFIG_PATH', ROOT_PATH . '/config');
define('CONTROLLERS_PATH', ROOT_PATH . '/controllers');
define('MODELS_PATH', ROOT_PATH . '/models');
define('VIEWS_PATH', ROOT_PATH . '/views');
define('INCLUDES_PATH', ROOT_PATH . '/includes');
define('PUBLIC_PATH', ROOT_PATH . '/public');
define('ASSETS_PATH', PUBLIC_PATH . '/assets');

// Cargar base de datos
require_once CONFIG_PATH . '/database.php';
?>
