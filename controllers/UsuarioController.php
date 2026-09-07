<?php
require_once 'models/usuario.php';

class UsuarioController {

    // Muestra el formulario en pantalla
    public function mostrarRegistro() {
        require_once 'views/registro_view.php';
    }

    // Procesa los datos enviados desde el formulario
    public function guardar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre']);
            $correo = trim($_POST['correo']);
            $password = trim($_POST['password']);
            $rol = $_POST['rol'];

            if (!empty($nombre) && !empty($correo) && !empty($password)) {
                $usuario = new Usuario();
                if ($usuario->registrar($nombre, $correo, $password, $rol)) {
                    // Si todo sale bien, lo mandamos al inicio
                    header("Location: index.php?action=inicio");
                    exit();
                } else {
                    echo "Ocurrió un error al registrar el usuario.";
                }
            }
        }
    }
}
?>