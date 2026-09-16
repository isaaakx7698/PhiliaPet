<?php
require_once 'config/database.php';

class Usuario {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    // REGISTRO DE USUARIOS CON MANEJO DE ERRORES Y ROLES
    public function registrar($nombre, $correo, $password, $codigo_refugio = null) {
        // 1. Validar longitud de la contraseña
        if (strlen($password) < 8) {
            return ["exito" => false, "mensaje" => "La contraseña debe tener al menos 8 caracteres."];
        }

        // 2. Definición del rol según el código introducido
        $CLAVE_SECRETA_REFUGIO = "REFUGIO2026"; 
        $rol = 'adoptante';

        if (!empty($codigo_refugio) && trim($codigo_refugio) === $CLAVE_SECRETA_REFUGIO) {
            $rol = 'refugio';
        }

        try {
            // Cifrado BCRYPT seguro
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
            // Error de correo duplicado
            if ($e->getCode() === '23000' || $e->getCode() == 23000) {
                return ["exito" => false, "mensaje" => "Ese correo ya se encuentra registrado en el sistema."];
            }
            // Muestra el detalle real del error de la BD si ocurre algo inesperado
            error_log("Error en registro: " . $e->getMessage());
            return ["exito" => false, "mensaje" => "Error en la Base de Datos: " . $e->getMessage()];
        }
    }

    // INICIO DE SESIÓN CON VERIFICACIÓN DE HASH
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

    // OBTENER DATOS DE UN USUARIO POR SU ID
    public function obtenerPorId($id) {
        try {
            $sql = "SELECT id, nombre, correo, rol FROM usuarios WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al obtener usuario: " . $e->getMessage());
            return false;
        }
    }
}
?>