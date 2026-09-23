<?php
require_once 'config/database.php';

class Usuario {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    // REGISTRO DE USUARIOS (Adoptante o Refugio con código secreto)
    public function registrar($nombre, $correo, $password, $codigo_refugio = null) {
        if (strlen($password) < 8) {
            return ["exito" => false, "mensaje" => "La contraseña debe tener al menos 8 caracteres."];
        }

        // Validación estricta del correo del Administrador para que nadie más lo registre por fuera
        if (strtolower(trim($correo)) === 'a.i.s.admins@yahoo.com') {
            return ["exito" => false, "mensaje" => "Este correo está reservado para el Administrador del sistema."];
        }

        $CLAVE_SECRETA_REFUGIO = "REFUGIO2026"; 
        $rol = 'adoptante';

        if (!empty($codigo_refugio) && trim($codigo_refugio) === $CLAVE_SECRETA_REFUGIO) {
            $rol = 'refugio';
        }

        try {
            $passwordHash = password_hash($password, PASSWORD_BCRYPT);

            $sql = "INSERT INTO usuarios (nombre, correo, password, rol) 
                    VALUES (:nombre, :correo, :password, :rol)";
            
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':correo', $correo);
            $stmt->bindParam(':password', $passwordHash);
            $stmt->bindParam(':rol', $rol);

            if ($stmt->execute()) {
                return ["exito" => true, "mensaje" => "¡Registro exitoso! Ya puedes iniciar sesión."];
            } else {
                return ["exito" => false, "mensaje" => "No se pudo realizar la inserción en la base de datos."];
            }
        } catch (PDOException $e) {
            if ($e->getCode() === '23000' || $e->getCode() == 23000) {
                return ["exito" => false, "mensaje" => "Ese correo ya se encuentra registrado en el sistema."];
            }
            return ["exito" => false, "mensaje" => "Error en la Base de Datos: " . $e->getMessage()];
        }
    }

    // INICIO DE SESIÓN
    public function login($correo, $password) {
        try {
            $sql = "SELECT * FROM usuarios WHERE correo = :correo";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':correo', $correo);
            $stmt->execute();
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuario && password_verify($password, $usuario['password'])) {
                return $usuario; 
            }
        } catch (PDOException $e) {
            error_log("Error en login: " . $e->getMessage());
        }
        return false;
    }

    public function obtenerPorId($id) {
        try {
            $sql = "SELECT id, nombre, correo, rol FROM usuarios WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }
}
?>