<?php
// se hace la modiificacion de
// forma temporal
//kmjdkjnhdkuwheñolkmaljubg
//ishjahdkugheifhaj

// Configuración de errores para desarrollo
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'config/database.php';

// Capturamos la acción de la URL, por defecto es 'inicio'
$action = $_GET['action'] ?? 'inicio';

switch ($action) {
    // ==========================================
    // 👤 RUTAS DE AUTENTICACIÓN Y USUARIOS
    // ==========================================
    case 'registro':
        require_once 'views/registro_view.php';
        break;

    case 'guardar_usuario':
        require_once 'controllers/UsuarioController.php';
        $controller = new UsuarioController();
        $controller->guardar();
        break;

    case 'login':
        // Vista del formulario de inicio de sesión
        require_once 'views/login_view.php'; 
        break;

    case 'procesar_login':
        require_once 'controllers/UsuarioController.php';
        $controller = new UsuarioController();
        $controller->procesarLogin();
        break;

    case 'logout':
        // Cierra la sesión de forma segura y devuelve al inicio
        session_start();
        session_destroy();
        header("Location: index.php?action=inicio");
        exit();
        break;

    // ==========================================
    // 🛡️ VISTAS PROTEGIDAS POR ROL (SEGURIDAD)
    // ==========================================
    case 'perfil_adoptante':
        session_start();
        // Validación: Solo usuarios autenticados pueden entrar a su perfil de adoptante
        if (!isset($_SESSION['rol'])) {
            header("Location: index.php?action=login");
            exit();
        }
        require_once 'views/perfil_adoptante_view.php'; // Tu vista de perfil de adoptante
        break;

    case 'panel_refugio':
        session_start();
        // Validación estricta: Solo los roles 'refugio' o 'admin' pueden gestionar mascotas
        if (!isset($_SESSION['rol']) || ($_SESSION['rol'] !== 'refugio' && $_SESSION['rol'] !== 'admin')) {
            header("Location: index.php?action=inicio");
            exit();
        }
        require_once 'controllers/MascotaController.php';
        $controller = new MascotaController();
        $controller->listarAdmin(); // Panel exclusivo del refugio para administrar
        break;

    // ==========================================
    // 🐾 RUTAS DE MASCOTAS Y ADOPCIÓN (PÚBLICAS/CLIENTE)
    // ==========================================
    case 'catalogo_adopcion':
        require_once 'controllers/MascotaController.php';
        $controller = new MascotaController();
        $controller->listarClienteAdopcion();
        break;

    case 'detalle_adopcion':
        require_once 'controllers/MascotaController.php';
        $controller = new MascotaController();
        $controller->detalleAdopcion();
        break;

    case 'procesar_adopcion':
        require_once 'controllers/MascotaController.php';
        $controller = new MascotaController();
        $controller->procesarAdopcion();
        break;
        
    case 'unir_refugio':
        require_once 'views/unir_refugio_view.php';
        break;

    // ==========================================
    // ⚙️ GESTIÓN DE MASCOTAS (ADMIN / REFUGIO)
    // ==========================================
    case 'guardar_mascota':
        require_once 'controllers/MascotaController.php';
        $controller = new MascotaController();
        $controller->guardar();
        break;

    case 'editar_mascota':
        require_once 'controllers/MascotaController.php';
        $controller = new MascotaController();
        $controller->editar();
        break;

    case 'actualizar_mascota':
        require_once 'controllers/MascotaController.php';
        $controller = new MascotaController();
        $controller->actualizar();
        break;

    case 'eliminar_mascota':
        require_once 'controllers/MascotaController.php';
        $controller = new MascotaController();
        $controller->eliminar();
        break;

    case 'mascotas':
        require_once 'controllers/MascotaController.php';
        $controller = new MascotaController();
        $controller->listarAdmin();
        break;

    // ==========================================
    // 🏠 PORTADA PRINCIPAL
    // ==========================================
    case 'inicio':
    default:
        require_once 'controllers/MascotaController.php';
        $controller = new MascotaController();
        $controller->listarInicio();
        break;
}
?>