<?php
/**
 * Configuración de Base de Datos - EJEMPLO
 * 
 * INSTRUCCIONES:
 * 1. Copia este archivo y renómbralo a 'database.php'
 * 2. Actualiza las credenciales con tus datos locales
 * 3. NO subas 'database.php' al repositorio (está en .gitignore)
 */

class Database {
    private $host = "localhost";          // Cambiar si usas otro host
    private $username = "root";           // Tu usuario de MySQL
    private $password = "";               // Tu contraseña de MySQL
    private $database = "web_mybuenoscar"; // Nombre de la base de datos
    private $conn = null;

    /**
     * Obtiene la conexión a la base de datos (Singleton)
     * 
     * @return mysqli|null
     */
    public function getConnection() {
        if ($this->conn === null) {
            try {
                $this->conn = new mysqli(
                    $this->host, 
                    $this->username, 
                    $this->password, 
                    $this->database
                );

                // Configurar charset UTF-8
                if (!$this->conn->connect_error) {
                    $this->conn->set_charset("utf8mb4");
                } else {
                    error_log("Error de conexión: " . $this->conn->connect_error);
                    return null;
                }
            } catch (Exception $e) {
                error_log("Excepción en conexión DB: " . $e->getMessage());
                return null;
            }
        }

        return $this->conn;
    }

    /**
     * Cierra la conexión a la base de datos
     */
    public function closeConnection() {
        if ($this->conn !== null) {
            $this->conn->close();
            $this->conn = null;
        }
    }
}
?>
