<?php
class Mascota {
    private $conn;
    private $table_name = "mascotas";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function obtenerDisponibles() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE estado_adopcion = 'disponible'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function obtenerFiltradas($especie = null, $edad_aproximada = null) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE estado_adopcion = 'disponible'";
        
        $params = [];

        // 1. Filtro estricto por especie (si viene y no es 'todos')
        if (!empty($especie) && strtolower($especie) !== 'todos') {
            $query .= " AND LOWER(especie) = LOWER(:especie)";
            $params[':especie'] = trim($especie);
        }

        // 2. Filtro estricto por categoría de edad (Cachorro, Joven, Adulto)
        if (!empty($edad_aproximada) && strtolower($edad_aproximada) !== 'todos') {
            $edad_lower = strtolower(trim($edad_aproximada));
            
            if (strpos($edad_lower, 'cachorro') !== false) {
                $query .= " AND (LOWER(edad_aproximada) LIKE '%cachorro%' OR LOWER(edad_aproximada) LIKE '%mes%')";
            } elseif (strpos($edad_lower, 'joven') !== false) {
                $query .= " AND LOWER(edad_aproximada) LIKE '%joven%'";
            } elseif (strpos($edad_lower, 'adulto') !== false) {
                $query .= " AND LOWER(edad_aproximada) LIKE '%adulto%'";
            } else {
                $query .= " AND LOWER(edad_aproximada) LIKE :edad_aproximada";
                $params[':edad_aproximada'] = '%' . $edad_aproximada . '%';
            }
        }

        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);
        return $stmt;
    }

    public function registrar($nombre, $especie, $edad_aproximada, $historia, $estado_salud, $estado_adopcion = 'disponible', $imagen = '', $id_fundacion = 1) {
        $query = "INSERT INTO " . $this->table_name . " 
                 (id_fundacion, nombre, especie, edad_aproximada, historia, estado_salud, estado_adopcion, imagen) 
                 VALUES (:id_fundacion, :nombre, :especie, :edad_aproximada, :historia, :estado_salud, :estado_adopcion, :imagen)";
        
        $stmt = $this->conn->prepare($query);

        $nombre          = htmlspecialchars(strip_tags($nombre));
        $especie         = htmlspecialchars(strip_tags($especie));
        $edad_aproximada = htmlspecialchars(strip_tags($edad_aproximada));
        $historia        = htmlspecialchars(strip_tags($historia));
        $estado_salud    = htmlspecialchars(strip_tags($estado_salud));
        $imagen          = htmlspecialchars(strip_tags($imagen));

        $stmt->bindParam(":id_fundacion", $id_fundacion);
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":especie", $especie);
        $stmt->bindParam(":edad_aproximada", $edad_aproximada);
        $stmt->bindParam(":historia", $historia);
        $stmt->bindParam(":estado_salud", $estado_salud);
        $stmt->bindParam(":estado_adopcion", $estado_adopcion);
        $stmt->bindParam(":imagen", $imagen);

        return $stmt->execute();
    }

    public function obtenerPorId($id) {
        $query = "SELECT mascotas.*, fundaciones.nombre AS nombre_fundacion, fundaciones.telefono, fundaciones.correo 
                  FROM mascotas 
                  LEFT JOIN fundaciones ON mascotas.id_fundacion = fundaciones.id_fundacion 
                  WHERE mascotas.id_mascota = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizar($id_mascota, $nombre, $especie, $edad_aproximada, $historia, $estado_salud, $estado_adopcion, $imagen) {
        $query = "UPDATE " . $this->table_name . " 
                 SET nombre = :nombre, 
                     especie = :especie, 
                     edad_aproximada = :edad_aproximada, 
                     historia = :historia, 
                     estado_salud = :estado_salud, 
                     estado_adopcion = :estado_adopcion,
                     imagen = :imagen 
                 WHERE id_mascota = :id_mascota";
        
        $stmt = $this->conn->prepare($query);

        $nombre          = htmlspecialchars(strip_tags($nombre));
        $especie         = htmlspecialchars(strip_tags($especie));
        $edad_aproximada = htmlspecialchars(strip_tags($edad_aproximada));
        $historia        = htmlspecialchars(strip_tags($historia));
        $estado_salud    = htmlspecialchars(strip_tags($estado_salud));
        $estado_adopcion = htmlspecialchars(strip_tags($estado_adopcion));
        $imagen          = htmlspecialchars(strip_tags($imagen));

        $stmt->bindParam(":id_mascota", $id_mascota);
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":especie", $especie);
        $stmt->bindParam(":edad_aproximada", $edad_aproximada);
        $stmt->bindParam(":historia", $historia);
        $stmt->bindParam(":estado_salud", $estado_salud);
        $stmt->bindParam(":estado_adopcion", $estado_adopcion);
        $stmt->bindParam(":imagen", $imagen);

        return $stmt->execute();
    }

    public function eliminar($id_mascota) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_mascota = :id_mascota";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_mascota", $id_mascota);
        $stmt->execute();
    }

    public function cambiarEstadoAdopcion($id_mascota, $nuevo_estado = 'adoptado') {
        $query = "UPDATE " . $this->table_name . " 
                 SET estado_adopcion = :estado_adopcion 
                 WHERE id_mascota = :id_mascota";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":estado_adopcion", $nuevo_estado);
        $stmt->bindParam(":id_mascota", $id_mascota);
        return $stmt->execute();
    }
}
?>