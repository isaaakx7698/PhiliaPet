<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'config/database.php';

$action = $_GET['action'] ?? 'inicio';

switch ($action) {
    case 'guardar_mascota':
        require_once 'controllers/MascotaController.php';
        $controller = new MascotaController();
        $controller->guardar();
        break;

    // NUEVO: Cargar formulario con los datos para editar
    case 'editar_mascota':
        require_once 'controllers/MascotaController.php';
        $controller = new MascotaController();
        $controller->editar();
        break;

    // NUEVO: Procesar la actualización en la base de datos
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

    // NUEVO: Catálogo de adopción para el cliente
    case 'catalogo_adopcion':
        require_once 'controllers/MascotaController.php';
        $controller = new MascotaController();
        $controller->listarClienteAdopcion();
        break;

    // NUEVO: Ver más detalles de la mascota y contacto con la fundación
    case 'detalle_adopcion':
        require_once 'controllers/MascotaController.php';
        $controller = new MascotaController();
        $controller->detalleAdopcion();
        break;

    // NUEVO: Procesar la acción de adoptar (cambia a estado 'adoptado')
    case 'procesar_adopcion':
        require_once 'controllers/MascotaController.php';
        $controller = new MascotaController();
        $controller->procesarAdopcion();
        break;

    case 'guardar_usuario':
        require_once 'controllers/UsuarioController.php';
        $controller = new UsuarioController();
        $controller->guardar();
        break;

    case 'registro':
        require_once 'views/registro_view.php';
        break;

    case 'mascotas':
        // Carga la vista de administración / CRUD con el formulario y botón de eliminar/editar
        require_once 'controllers/MascotaController.php';
        $controller = new MascotaController();
        $controller->listarAdmin();
        break;

    case 'inicio':
    default:
        // Carga la portada pública limpia con el botón de registro
        require_once 'controllers/MascotaController.php';
        $controller = new MascotaController();
        $controller->listarInicio();
        break;
}
?>