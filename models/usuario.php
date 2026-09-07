<?php
require_once 'config/database.php';

class Usuario {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function registrar($nombre, $correo, $password, $rol) {
        try {
            // Encriptamos la contraseña por seguridad
            $passwordHash = password_hash($password, PASSWORD_BCRYPT);

            $sql = "INSERT INTO usuarios (nombre, correo, password, rol) 
                    VALUES (:nombre, :correo, :password, :rol)";
            
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':correo', $correo);
            $stmt->bindParam(':password', $passwordHash);
            $stmt->bindParam(':rol', $rol);

            return $stmt->execute();
        } catch (PDOException $e) {
            // Esto guardará el error exacto si ocurre en la base de datos
            error_log("Error en registro: " . $e->getMessage());
            return false;
        }
    }
}
?>