<?php
require_once 'models/usuario.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

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

                // Validación de contraseña en el servidor
                $tieneMayuscula = preg_match('/[A-Z]/', $password);
                $tieneNumero = preg_match('/[0-9]/', $password);

                if (strlen($password) < 8 || !$tieneMayuscula || !$tieneNumero) {
                    echo "<script>
                        alert('La contraseña debe tener mínimo 8 caracteres, al menos una letra mayúscula y al menos un número.');
                        window.history.back();
                    </script>";
                    exit();
                }

                $usuario = new Usuario();
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
                    if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }

                    $_SESSION['usuario_id'] = $usuario['id'];
                    $_SESSION['nombre'] = $usuario['nombre'];
                    $_SESSION['correo'] = $usuario['correo'];
                    $_SESSION['rol'] = $usuario['rol'];
                    $_SESSION['foto'] = $usuario['foto'] ?? null; // Carga la foto guardada en la BD

                    if ($usuario['rol'] === 'admin') {
                        header("Location: index.php?action=panel_admin");
                    } elseif ($usuario['rol'] === 'refugio') {
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

    // Muestra la vista del perfil trayendo la información actualizada de la base de datos
    public function mostrarPerfil() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['usuario_id'])) {
            header("Location: index.php?action=login");
            exit();
        }

        $usuarioModel = new Usuario();
        $usuario = $usuarioModel->obtenerPorId($_SESSION['usuario_id']);

        if ($usuario) {
            $_SESSION['foto'] = $usuario['foto'];
            $_SESSION['nombre'] = $usuario['nombre'];
            $_SESSION['correo'] = $usuario['correo'];
        }

        require_once 'views/perfil_adoptante_view.php';
    }

    // Procesa la actualización del perfil y la foto
    public function actualizarPerfil() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            if (!isset($_SESSION['usuario_id'])) {
                header("Location: index.php?action=login");
                exit();
            }

            $usuario_id = $_SESSION['usuario_id'];
            $nombre = trim($_POST['nombre']);
            $correo = trim($_POST['correo']);
            $descripcion = trim($_POST['descripcion'] ?? '');
            
            $usuarioModel = new Usuario();
            $usuarioActual = $usuarioModel->obtenerPorId($usuario_id);
            $ruta_foto = $usuarioActual['foto'] ?? null;

            // Procesar la subida de imagen
            if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
                $ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
                $extensionesPermitidas = ['jpg', 'jpeg', 'png', 'webp', 'gif'];

                if (in_array($ext, $extensionesPermitidas)) {
                    $nombreArchivo = 'perfil_' . $usuario_id . '_' . time() . '.' . $ext;
                    $directorioDestino = 'assets/img/perfiles/';

                    if (!file_exists($directorioDestino)) {
                        mkdir($directorioDestino, 0777, true);
                    }

                    $rutaCompleta = $directorioDestino . $nombreArchivo;

                    if (move_uploaded_file($_FILES['foto']['tmp_name'], $rutaCompleta)) {
                        $ruta_foto = $rutaCompleta;
                    }
                }
            }

            $exito = $usuarioModel->actualizar($usuario_id, $nombre, $correo, $descripcion, $ruta_foto);

            if ($exito) {
                $_SESSION['nombre'] = $nombre;
                $_SESSION['correo'] = $correo;
                $_SESSION['foto'] = $ruta_foto;

                echo "<script>
                    alert('¡Perfil actualizado con éxito! 🐾');
                    window.location.href = 'index.php?action=inicio';
                </script>";
                exit();
            } else {
                echo "<script>
                    alert('No se pudieron guardar los cambios en la base de datos.');
                    window.history.back();
                </script>";
            }
        }
    }
}
?>