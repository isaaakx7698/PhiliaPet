<?php
require_once 'config/database.php';

class Usuario {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    // Registra un nuevo usuario
    public function registrar($nombre, $correo, $password, $codigo_refugio = null) {
        // Verificar si el correo ya existe
        $sqlCheck = "SELECT id FROM usuarios WHERE correo = ?";
        $stmtCheck = $this->db->prepare($sqlCheck);
        $stmtCheck->execute([$correo]);
        if ($stmtCheck->fetch()) {
            return ['exito' => false, 'mensaje' => 'El correo electrónico ya está registrado.'];
        }

        // Asignación de rol por código secreto
        $rol = 'adoptante';
        if (!empty($codigo_refugio)) {
            if ($codigo_refugio === 'REFUGIO2026' || $codigo_refugio === 'SENA2026') {
                $rol = 'refugio';
            } else {
                return ['exito' => false, 'mensaje' => 'El código de refugio es incorrecto.'];
            }
        }

        $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        $sql = "INSERT INTO usuarios (nombre, correo, password, rol) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        
        if ($stmt->execute([$nombre, $correo, $passwordHash, $rol])) {
            return ['exito' => true, 'mensaje' => '¡Usuario registrado correctamente! Ahora puedes iniciar sesión.'];
        } else {
            return ['exito' => false, 'mensaje' => 'Error al registrar el usuario en la base de datos.'];
        }
    }

    // Inicia sesión
    public function login($correo, $password) {
        $sql = "SELECT * FROM usuarios WHERE correo = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$correo]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($password, $usuario['password'])) {
            return $usuario;
        }
        return false;
    }

    // Obtiene un usuario por su ID
    public function obtenerPorId($id) {
        $sql = "SELECT * FROM usuarios WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualiza los datos del perfil (incluyendo foto y descripción)
    public function actualizar($id, $nombre, $correo, $descripcion, $foto) {
        $sql = "UPDATE usuarios SET nombre = ?, correo = ?, descripcion = ?, foto = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$nombre, $correo, $descripcion, $foto, $id]);
    }
}
?>