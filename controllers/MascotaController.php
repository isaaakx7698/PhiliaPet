<?php
require_once 'config/database.php';
require_once 'models/mascota.php';

class MascotaController {

    // Método para la portada pública
    public function listarInicio() {
        $database = new Database();
        $db = $database->getConnection();

        $mascota = new Mascota($db);
        $stmt = $mascota->obtenerDisponibles();
        $mascotas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        require_once 'views/inicio_view.php';
    }

    // Método para la vista del CRUD (Admin)
    public function listarAdmin() {
        $database = new Database();
        $db = $database->getConnection();

        $mascota = new Mascota($db);
        $stmt = $mascota->obtenerDisponibles();
        $mascotas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        require_once 'views/mascotas_view.php';
    }

    public function guardar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $database = new Database();
            $db = $database->getConnection();

            $mascota = new Mascota($db);

            $nombre          = $_POST['nombre'] ?? '';
            $especie         = $_POST['especie'] ?? '';
            $edad_aproximada = $_POST['edad_aproximada'] ?? '';
            $historia        = $_POST['historia'] ?? '';
            $estado_salud    = $_POST['estado_salud'] ?? '';
            $estado_adopcion = $_POST['estado_adopcion'] ?? 'disponible';
            $imagen          = $_POST['imagen'] ?? '';

            if ($mascota->registrar($nombre, $especie, $edad_aproximada, $historia, $estado_salud, $estado_adopcion, $imagen)) {
                header("Location: index.php?action=mascotas");
                exit();
            } else {
                echo "Error al guardar el peludito.";
            }
        }
    }

    // Carga los datos de la mascota en el formulario de edición
    public function editar() {
        if (isset($_GET['id'])) {
            $database = new Database();
            $db = $database->getConnection();

            $mascota = new Mascota($db);
            $peludito = $mascota->obtenerPorId($_GET['id']);

            if ($peludito) {
                require_once 'views/editar_mascota_view.php';
            } else {
                echo "Mascota no encontrada.";
            }
        }
    }

    // Procesa la actualización de los datos en la base de datos
    public function actualizar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $database = new Database();
            $db = $database->getConnection();

            $mascota = new Mascota($db);

            $id_mascota      = $_POST['id_mascota'] ?? '';
            $nombre          = $_POST['nombre'] ?? '';
            $especie         = $_POST['especie'] ?? '';
            $edad_aproximada = $_POST['edad_aproximada'] ?? '';
            $historia        = $_POST['historia'] ?? '';
            $estado_salud    = $_POST['estado_salud'] ?? '';
            $estado_adopcion = $_POST['estado_adopcion'] ?? 'disponible'; // <-- CAPTURANDO EL ESTADO
            $imagen          = $_POST['imagen'] ?? '';

            // ENVIANDO LOS 8 PARÁMETROS AL MODELO
            if ($mascota->actualizar($id_mascota, $nombre, $especie, $edad_aproximada, $historia, $estado_salud, $estado_adopcion, $imagen)) {
                header("Location: index.php?action=mascotas");
                exit();
            } else {
                echo "Error al actualizar la mascota.";
            }
        }
    }

    public function eliminar() {
        if (isset($_GET['id'])) {
            $database = new Database();
            $db = $database->getConnection();

            $mascota = new Mascota($db);

            if ($mascota->eliminar($_GET['id'])) {
                header("Location: index.php?action=mascotas");
                exit();
            } else {
                echo "Error al eliminar la mascota.";
            }
        }
    }

    // Mostrar la vista de adopción para el cliente (solo los disponibles)
    public function listarClienteAdopcion() {
        $database = new Database();
        $db = $database->getConnection();

        $mascota = new Mascota($db);
        $stmt = $mascota->obtenerDisponibles(); 
        $mascotas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        require_once 'views/cliente_adopcion_view.php';
    }

    // Mostrar detalles de una mascota para el proceso de adopción y contacto
    public function detalleAdopcion() {
        if (isset($_GET['id'])) {
            $database = new Database();
            $db = $database->getConnection();

            $mascota = new Mascota($db);
            $peludito = $mascota->obtenerPorId($_GET['id']);

            if ($peludito) {
                require_once 'views/detalle_adopcion_view.php';
            } else {
                echo "Peludito no encontrado.";
            }
        }
    }

    // Procesar la adopción (cambia el estado a 'adoptado' y lo oculta del catálogo)
    public function procesarAdopcion() {
        if (isset($_GET['id'])) {
            $database = new Database();
            $db = $database->getConnection();

            $mascota = new Mascota($db);
            
            if ($mascota->cambiarEstadoAdopcion($_GET['id'], 'adoptado')) {
                header("Location: index.php?action=catalogo_adopcion");
                exit();
            } else {
                echo "Hubo un error al procesar la adopción.";
            }
        }
    }
}
?>