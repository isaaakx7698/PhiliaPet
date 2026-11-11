<?php
require_once __DIR__ . '/../models/mascota.php';
require_once __DIR__ . '/../config/database.php';

class MascotaController {
    
    public function listar() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'refugio') {
            header("Location: index.php?action=inicio");
            exit();
        }

        $database = new Database();
        $db = $database->getConnection();

        $mascota = new Mascota($db);
        $stmt = $mascota->obtenerDisponibles();
        $mascotas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        require_once __DIR__ . '/../views/mascotas_view.php';
    }

    public function listarAdmin() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'refugio') {
            header("Location: index.php?action=inicio");
            exit();
        }

        $database = new Database();
        $db = $database->getConnection();

        $mascota = new Mascota($db);
        // Usamos una consulta general para el panel de control del refugio
        $query = "SELECT * FROM mascotas";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $mascotas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        require_once __DIR__ . '/../views/mascotas_view.php';
    }

    public function listarInicio() {
        $database = new Database();
        $db = $database->getConnection();

        $mascota = new Mascota($db);
        
        // Modificamos la consulta para traer solo los 2 más recientes que estén disponibles
        $query = "SELECT * FROM mascotas WHERE estado_adopcion = 'disponible' ORDER BY id_mascota DESC LIMIT 2";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $mascotas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        require_once __DIR__ . '/../views/inicio_view.php';
    }

    public function listarClienteAdopcion() {
        $database = new Database();
        $db = $database->getConnection();

        $mascota = new Mascota($db);

        $especie = $_GET['especie'] ?? null;
        $edad = $_GET['edad'] ?? null;

        $stmt = $mascota->obtenerFiltradas($especie, $edad);
        $mascotas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        require_once __DIR__ . '/../views/cliente_adopcion_view.php';
    }

    public function detalleAdopcion() {
        if (isset($_GET['id'])) {
            $database = new Database();
            $db = $database->getConnection();

            $mascota = new Mascota($db);
            $peludito = $mascota->obtenerPorId($_GET['id']);

            if ($peludito) {
                require_once __DIR__ . '/../views/detalle_adopcion_view.php';
            } else {
                echo "<script>alert('Peludito no encontrado.'); window.location='index.php?action=cliente_adopcion';</script>";
            }
        } else {
            header("Location: index.php?action=cliente_adopcion");
            exit();
        }
    }

    public function guardar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            $database = new Database();
            $db = $database->getConnection();

            $mascota = new Mascota($db);

            $nombre           = $_POST['nombre'] ?? '';
            $especie          = $_POST['especie'] ?? '';
            
            $etapa            = $_POST['edad_aproximada'] ?? '';
            $detallada        = $_POST['edad_detallada'] ?? '';
            $edad_aproximada  = trim("$etapa ($detallada)");

            $historia         = $_POST['historia'] ?? '';
            $estado_salud     = $_POST['estado_salud'] ?? '';
            $estado_adopcion  = $_POST['estado_adopcion'] ?? 'disponible';
            
            // 🏢 Toma el ID numérico de la fundación en sesión (o 1 por defecto si no está definido)
            $id_fundacion     = $_SESSION['id_fundacion'] ?? $_SESSION['usuario_id'] ?? 1; 
            
            $imagen           = ''; 

            if (isset($_FILES['imagen_archivo']) && $_FILES['imagen_archivo']['error'] === UPLOAD_ERR_OK) {
                $ext = strtolower(pathinfo($_FILES['imagen_archivo']['name'], PATHINFO_EXTENSION));
                $extensionesPermitidas = ['jpg', 'jpeg', 'png', 'webp'];

                if (in_array($ext, $extensionesPermitidas)) {
                    $nombreArchivo = 'mascota_' . time() . '_' . rand(100, 999) . '.' . $ext;
                    $directorioDestino = __DIR__ . '/../assets/img/';

                    if (!file_exists($directorioDestino)) {
                        mkdir($directorioDestino, 0777, true);
                    }

                    $rutaCompletaServidor = $directorioDestino . $nombreArchivo;
                    $rutaParaBD = 'assets/img/' . $nombreArchivo;

                    if (move_uploaded_file($_FILES['imagen_archivo']['tmp_name'], $rutaCompletaServidor)) {
                        $imagen = $rutaParaBD;
                    }
                }
            }

            if ($mascota->registrar($nombre, $especie, $edad_aproximada, $historia, $estado_salud, $estado_adopcion, $imagen, $id_fundacion)) {
                header("Location: index.php?action=mascotas");
                exit();
            } else {
                echo "<script>alert('Error al guardar el peludito.'); window.history.back();</script>";
            }
        }
    }

    public function actualizar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            $database = new Database();
            $db = $database->getConnection();
            $mascotaObj = new Mascota($db);

            $id_mascota      = $_POST['id_mascota'] ?? 0;
            $nombre          = $_POST['nombre'] ?? '';
            $especie         = $_POST['especie'] ?? '';
            
            $etapa           = $_POST['edad_aproximada'] ?? '';
            $detallada       = $_POST['edad_detallada'] ?? '';
            $edad_aproximada = trim("$etapa ($detallada)");

            $historia        = $_POST['historia'] ?? '';
            $estado_salud    = $_POST['estado_salud'] ?? '';
            $estado_adopcion = $_POST['estado_adopcion'] ?? 'disponible';

            $peluditoActual  = $mascotaObj->obtenerPorId($id_mascota);
            $imagen          = $peluditoActual['imagen'] ?? '';

            if (isset($_FILES['imagen_archivo']) && $_FILES['imagen_archivo']['error'] === UPLOAD_ERR_OK) {
                $ext = strtolower(pathinfo($_FILES['imagen_archivo']['name'], PATHINFO_EXTENSION));
                $extensionesPermitidas = ['jpg', 'jpeg', 'png', 'webp'];

                if (in_array($ext, $extensionesPermitidas)) {
                    $nombreArchivo = 'mascota_' . time() . '_' . rand(100, 999) . '.' . $ext;
                    $directorioDestino = $_SERVER['DOCUMENT_ROOT'] . '/PhiliaPet/assets/img/';

                    if (!file_exists($directorioDestino)) {
                        mkdir($directorioDestino, 0777, true);
                    }

                    $rutaCompletaServidor = $directorioDestino . $nombreArchivo;
                    $rutaParaBD = 'assets/img/' . $nombreArchivo;

                    if (move_uploaded_file($_FILES['imagen_archivo']['tmp_name'], $rutaCompletaServidor)) {
                        $imagen = $rutaParaBD; 
                    }
                }
            }

            if ($mascotaObj->actualizar($id_mascota, $nombre, $especie, $edad_aproximada, $historia, $estado_salud, $estado_adopcion, $imagen)) {
                header("Location: index.php?action=mascotas");
                exit();
            } else {
                echo "<script>alert('Error al actualizar el peludito.'); window.history.back();</script>";
            }
        }
    }

    public function editar() {
        if (isset($_GET['id'])) {
            $database = new Database();
            $db = $database->getConnection();
            
            // Consulta directa para buscar la mascota sin depender del JOIN de fundaciones al editar
            $query = "SELECT * FROM mascotas WHERE id_mascota = ?";
            $stmt = $db->prepare($query);
            $stmt->execute([$_GET['id']]);
            $peludito = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($peludito) {
                // Asegúrate de que este nombre sea exactamente el archivo de la vista que tú ya usabas para editar
                require_once __DIR__ . '/../views/editar_mascota_view.php'; 
            } else {
                echo "<script>alert('Peludito no encontrado.'); window.location='index.php?action=mascotas';</script>";
            }
        } else {
            header("Location: index.php?action=mascotas");
            exit();
        }
    }

    public function marcarAdoptado() {
        if (isset($_GET['id'])) {
            $database = new Database();
            $db = $database->getConnection();
            $mascota = new Mascota($db);
            
            $mascota->cambiarEstadoAdopcion($_GET['id'], 'adoptado');
            header("Location: index.php?action=mascotas");
            exit();
        }
    }

    public function eliminar() {
        if (isset($_GET['id'])) {
            $database = new Database();
            $db = $database->getConnection();
            $mascota = new Mascota($db);
            
            $mascota->eliminar($_GET['id']);
            header("Location: index.php?action=mascotas");
            exit();
        }
    }
}
?>