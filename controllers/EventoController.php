<?php
require_once __DIR__ . '/../models/evento.php';
require_once __DIR__ . '/../config/database.php';

class EventoController {

    public function listarCalendario() {
        $database = new Database();
        $db = $database->getConnection();

        $evento = new Evento($db);
        $stmt = $evento->obtenerTodos();
        $eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        require_once __DIR__ . '/../views/calendario_view.php';
    }

    public function gestionarEventos() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['rol']) || ($_SESSION['rol'] !== 'refugio' && $_SESSION['rol'] !== 'admin')) {
            header("Location: index.php?action=inicio");
            exit();
        }

        $database = new Database();
        $db = $database->getConnection();

        $evento = new Evento($db);
        $stmt = $evento->obtenerTodos();
        $eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        require_once __DIR__ . '/../views/gestionar_eventos_view.php';
    }

    public function guardar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $database = new Database();
            $db = $database->getConnection();

            $evento = new Evento($db);

            $titulo       = $_POST['titulo'] ?? '';
            $tipo_evento = $_POST['tipo_evento'] ?? 'Adopción';
            $fecha_hora  = $_POST['fecha_hora'] ?? '';
            $fundacion   = $_POST['fundacion'] ?? '';
            $lugar       = $_POST['lugar'] ?? '';

            if ($evento->registrar($titulo, $tipo_evento, $fecha_hora, $fundacion, $lugar)) {
                header("Location: index.php?action=gestionar_eventos");
                exit();
            } else {
                echo "<script>alert('Error al registrar el evento.'); window.history.back();</script>";
            }
        }
    }

    public function editar() {
        if (isset($_GET['id'])) {
            $database = new Database();
            $db = $database->getConnection();
            $evento = new Evento($db);
            
            $eventoData = $evento->obtenerPorId($_GET['id']);

            if ($eventoData) {
                require_once __DIR__ . '/../views/editar_evento_view.php';
            } else {
                echo "<script>alert('Evento no encontrado.'); window.location='index.php?action=gestionar_eventos';</script>";
            }
        } else {
            header("Location: index.php?action=gestionar_eventos");
            exit();
        }
    }

    public function actualizar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_evento'])) {
            $database = new Database();
            $db = $database->getConnection();
            $evento = new Evento($db);

            $id_evento   = $_POST['id_evento'];
            $titulo      = $_POST['titulo'] ?? '';
            $tipo_evento = $_POST['tipo_evento'] ?? '';
            $fecha_hora  = $_POST['fecha_hora'] ?? '';
            $fundacion   = $_POST['fundacion'] ?? '';
            $lugar       = $_POST['lugar'] ?? '';

            if ($evento->actualizar($id_evento, $titulo, $tipo_evento, $fecha_hora, $fundacion, $lugar)) {
                header("Location: index.php?action=gestionar_eventos");
                exit();
            } else {
                echo "<script>alert('Error al actualizar el evento.'); window.history.back();</script>";
            }
        }
    }

    public function eliminar() {
        if (isset($_GET['id'])) {
            $database = new Database();
            $db = $database->getConnection();
            $evento = new Evento($db);
            
            $evento->eliminar($_GET['id']);
            header("Location: index.php?action=gestionar_eventos");
            exit();
        }
    }
}
?>