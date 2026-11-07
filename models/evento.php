<?php
class Evento {
    private $conn;
    private $table_name = "eventos";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function obtenerTodos() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function obtenerPorId($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_evento = :id LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function registrar($titulo, $tipo_evento, $fecha_hora, $fundacion, $lugar) {
        $query = "INSERT INTO " . $this->table_name . " (titulo, tipo_evento, fecha_hora, fundacion, lugar) 
                  VALUES (:titulo, :tipo_evento, :fecha_hora, :fundacion, :lugar)";
        
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(":titulo", $titulo);
        $stmt->bindValue(":tipo_evento", $tipo_evento);
        $stmt->bindValue(":fecha_hora", $fecha_hora);
        $stmt->bindValue(":fundacion", $fundacion);
        $stmt->bindValue(":lugar", $lugar);

        return $stmt->execute();
    }

    public function actualizar($id, $titulo, $tipo_evento, $fecha_hora, $fundacion, $lugar) {
        $query = "UPDATE " . $this->table_name . " 
                  SET titulo = :titulo, tipo_evento = :tipo_evento, fecha_hora = :fecha_hora, fundacion = :fundacion, lugar = :lugar 
                  WHERE id_evento = :id";
        
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(":id", $id);
        $stmt->bindValue(":titulo", $titulo);
        $stmt->bindValue(":tipo_evento", $tipo_evento);
        $stmt->bindValue(":fecha_hora", $fecha_hora);
        $stmt->bindValue(":fundacion", $fundacion);
        $stmt->bindValue(":lugar", $lugar);

        return $stmt->execute();
    }

    public function eliminar($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_evento = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
?>