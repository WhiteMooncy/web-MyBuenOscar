<?php
/**
 * Configuración de la base de datos
 * 
 * Este archivo contiene la configuración para la conexión a MySQL
 */

class Database {
    private $host = "localhost";
    private $usuario = "root";
    private $contrasena = "";
    private $basededatos = "web-mybuenoscar";
    private $conn;

    /**
     * Obtener conexión a la base de datos
     * @return mysqli Conexión a MySQL
     */
    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new mysqli(
                $this->host, 
                $this->usuario, 
                $this->contrasena, 
                $this->basededatos
            );

            // Configurar charset a UTF-8
            $this->conn->set_charset("utf8mb4");

            if ($this->conn->connect_error) {
                throw new Exception("Error de conexión: " . $this->conn->connect_error);
            }

        } catch(Exception $e) {
            echo "Error de conexión a la base de datos: " . $e->getMessage();
        }

        return $this->conn;
    }

    /**
     * Cerrar conexión
     */
    public function closeConnection() {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}
?>
