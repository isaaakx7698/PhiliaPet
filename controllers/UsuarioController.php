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
                    // 🌟 CORREGIDO: Usamos la instancia creada '$usuario' para registrar la actividad correctamente
                    $usuario->registrarActividad('Usuarios', "Nuevo usuario registrado: " . $nombre, 'Verificado');

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
                    
                    $_SESSION['foto'] = $usuario['foto'] ?? $usuario['imagen'] ?? $usuario['foto_perfil'] ?? null;

                    // 🌟 CORREGIDO: Usamos la instancia '$usuarioModel'
                    $usuarioModel->registrarActividad('Seguridad', "Inicio de sesión de: " . $usuario['nombre'] . " ({$usuario['rol']})", 'Verificado');

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
            $_SESSION['foto'] = $usuario['foto'] ?? $usuario['imagen'] ?? $usuario['foto_perfil'] ?? '';
            $_SESSION['nombre'] = $usuario['nombre'] ?? '';
            $_SESSION['correo'] = $usuario['correo'] ?? '';
        }

        require_once 'views/perfil_adoptante_view.php';
    }

    // Procesa la actualización del perfil y la foto
    public function actualizarPerfil() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: index.php?action=login");
            exit();
        }

        $usuario_id = $_SESSION['usuario_id'];
        $nombre = $_POST['nombre'] ?? '';
        $correo = $_POST['correo'] ?? '';
        $descripcion = $_POST['descripcion'] ?? '';
        $localidad = $_POST['localidad'] ?? null;
        $telefono = $_POST['telefono'] ?? null;
        $instagram = $_POST['instagram'] ?? null;
        $facebook = $_POST['facebook'] ?? null;

        // Recuperar la foto actual de la sesión por si no sube una nueva
        $ruta_foto = $_SESSION['foto'] ?? '';

        // Procesar la nueva imagen si se seleccionó una
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['foto']['tmp_name'];
            $fileName = $_FILES['foto']['name'];
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
            if (in_array($fileExtension, $allowedExtensions)) {
                $uploadFileDir = 'assets/img/perfiles/';
                if (!is_dir($uploadFileDir)) {
                    mkdir($uploadFileDir, 0755, true);
                }
                
                $newFileName = 'perfil_' . $usuario_id . '_' . time() . '.' . $fileExtension;
                $dest_path = $uploadFileDir . $newFileName;

                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                    $ruta_foto = $dest_path;
                }
            }
        }

        require_once 'models/Usuario.php';
        $usuarioModel = new Usuario();
        
        $exito = $usuarioModel->actualizarPerfilCompleto($usuario_id, $nombre, $correo, $descripcion, $localidad, $telefono, $instagram, $facebook, $ruta_foto);

        if ($exito) {
            $_SESSION['nombre'] = $nombre;
            $_SESSION['correo'] = $correo;
            $_SESSION['foto'] = $ruta_foto;

            $usuarioModel->registrarActividad('Perfiles', "El usuario " . $nombre . " actualizó su perfil completo.", 'Actualizado');

            echo "<script>
                alert('¡Perfil actualizado con éxito! 🐾');
                window.location.href = 'index.php?action=perfil_adoptante';
            </script>";
            exit();
        } else {
            echo "<script>
                alert('No se pudieron guardar los cambios en la base de datos.');
                window.history.back();
            </script>";
            exit();
        }
    }
}
?>