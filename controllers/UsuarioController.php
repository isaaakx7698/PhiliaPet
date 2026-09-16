<?php
require_once 'models/usuario.php';

class UsuarioController {

    // Muestra el formulario de registro
    public function mostrarRegistro() {
        require_once 'views/registro_view.php';
    }

    // Procesa los datos del formulario de registro
    public function guardar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre']);
            $correo = trim($_POST['correo']);
            $password = trim($_POST['password']);
            $codigo_refugio = isset($_POST['codigo_refugio']) ? trim($_POST['codigo_refugio']) : null;

            if (!empty($nombre) && !empty($correo) && !empty($password)) {
                $usuario = new Usuario();
                
                // Registramos al usuario verificando la clave de refugio
                $resultado = $usuario->registrar($nombre, $correo, $password, $codigo_refugio);

                if ($resultado['exito']) {
                    echo "<script>
                        alert('" . $resultado['mensaje'] . "');
                        window.location.href = 'index.php?action=login';
                    </script>";
                    exit();
                } else {
                    echo "<script>alert('" . $resultado['mensaje'] . "'); window.history.back();</script>";
                }
            } else {
                echo "<script>alert('Por favor completa todos los campos.'); window.history.back();</script>";
            }
        }
    }

    // Procesa el inicio de sesión
    public function procesarLogin() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $correo = trim($_POST['correo']);
            $password = trim($_POST['password']);

            if (!empty($correo) && !empty($password)) {
                $usuarioModel = new Usuario();
                $usuario = $usuarioModel->login($correo, $password);

                if ($usuario) {
                    session_start();
                    $_SESSION['usuario_id'] = $usuario['id'];
                    $_SESSION['nombre'] = $usuario['nombre'];
                    $_SESSION['correo'] = $usuario['correo'];
                    $_SESSION['rol'] = $usuario['rol'];

                    // Redirección según su rol de usuario
                    if ($usuario['rol'] === 'refugio' || $usuario['rol'] === 'admin') {
                        header("Location: index.php?action=panel_refugio");
                    } else {
                        header("Location: index.php?action=inicio");
                    }
                    exit();
                } else {
                    echo "<script>alert('Correo o contraseña incorrectos.'); window.history.back();</script>";
                }
            } else {
                echo "<script>alert('Por favor ingresa tu correo y contraseña.'); window.history.back();</script>";
            }
        }
    }
}
?>