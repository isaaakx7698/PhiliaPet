<?php
// Configuración de errores para desarrollo
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'config/database.php';

// Capturamos la acción de la URL, por defecto es 'inicio'
$action = $_GET['action'] ?? 'inicio';

switch ($action) {

    // RUTAS DE AUTENTICACIÓN Y USUARIOS
    case 'registro':
        require_once 'views/registro_view.php';
        break;

    case 'guardar_usuario':
        require_once 'controllers/UsuarioController.php';
        $controller = new UsuarioController();
        $controller->guardar();
        break;

    case 'login':
        require_once 'views/login_view.php'; 
        break;

    case 'procesar_login':
        require_once 'controllers/UsuarioController.php';
        $controller = new UsuarioController();
        $controller->procesarLogin();
        break;

    case 'actualizar_perfil':
        require_once 'controllers/UsuarioController.php';
        $controller = new UsuarioController();
        $controller->actualizarPerfil();
        break;

    case 'logout':
        session_start();
        session_destroy();
        header("Location: index.php?action=inicio");
        exit();
        break;

    // VISTAS PROTEGIDAS POR ROL (SEGURIDAD)
    case 'perfil_adoptante':
        session_start();
        if (!isset($_SESSION['rol'])) {
            header("Location: index.php?action=login");
            exit();
        }
        require_once 'controllers/UsuarioController.php';
        $controller = new UsuarioController();
        $controller->mostrarPerfil();
        break;

    case 'panel_admin':
        session_start();
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
            header("Location: index.php?action=inicio");
            exit();
        }
        require_once 'views/panel_admin_view.php';
        break;

    case 'panel_refugio':
        session_start();
        if (!isset($_SESSION['rol']) || ($_SESSION['rol'] !== 'refugio' && $_SESSION['rol'] !== 'admin')) {
            header("Location: index.php?action=inicio");
            exit();
        }
        require_once 'controllers/MascotaController.php';
        $controller = new MascotaController();
        $controller->listarAdmin();
        break;

    case 'fundaciones':
        require_once 'views/fundaciones_view.php';
        break;

    // RUTAS DE MASCOTAS Y ADOPCIÓN (PÚBLICAS / CLIENTE)     
    case 'catalogo_adopcion':
    case 'cliente_adopcion':
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

    // GESTIÓN DE EVENTOS Y CALENDARIO (CRUD - REFUGIO / ADMIN)
    case 'calendario':
        require_once 'controllers/EventoController.php';
        $controller = new EventoController();
        $controller->listarCalendario();
        break;

    case 'gestionar_eventos':
        require_once 'controllers/EventoController.php';
        $controller = new EventoController();
        $controller->gestionarEventos();
        break;

    case 'guardar_evento':
        require_once 'controllers/EventoController.php';
        $controller = new EventoController();
        $controller->guardar();
        break;

    case 'editar_evento':
        require_once 'controllers/EventoController.php';
        $controller = new EventoController();
        $controller->editar();
        break;

    case 'actualizar_evento':
        require_once 'controllers/EventoController.php';
        $controller = new EventoController();
        $controller->actualizar();
        break;

    case 'eliminar_evento':
        require_once 'controllers/EventoController.php';
        $controller = new EventoController();
        $controller->eliminar();
        break;

    // GESTIÓN DE MASCOTAS (CRUD - ADMIN / REFUGIO)
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

    // PORTADA PRINCIPAL
    case 'inicio':
    default:
        require_once 'controllers/MascotaController.php';
        $controller = new MascotaController();
        $controller->listarInicio();
        break;
}
?>