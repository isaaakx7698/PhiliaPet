<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil 🐾 PhiliaPet</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body style="background-color: var(--fondo-suave, #f8fafc); min-height: 100vh; display: flex; flex-direction: column; justify-content: space-between;">

    <header>
        <div class="logo-animado">
            <span>🐾</span> PhiliaPet <span class="heart">❤️</span>
        </div>
        <nav>
            <a href="index.php?action=inicio" class="nav-link">← Volver al Inicio</a>
            <a href="index.php?action=logout" class="nav-link" style="color: #ef4444; font-weight: 600;">Cerrar Sesión</a>
        </nav>
    </header>

    <main style="max-width: 550px; width: 90%; margin: 40px auto; padding: 20px;">
        <div style="background: white; border-radius: 28px; padding: 35px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); border: 3px solid #e0e7ff;">
            
            <div style="text-align: center; margin-bottom: 25px;">
                <div style="font-size: 3.5rem; margin-bottom: 8px;">👤</div>
                <h2 style="color: #312e81; margin: 0;">Mi Perfil de Adoptante</h2>
                <p style="color: #64748b; font-size: 0.95rem;">Información personal y estado en la plataforma</p>
            </div>

            <form action="#" method="POST" style="display: flex; flex-direction: column; gap: 16px;">
                <div>
                    <label style="display: block; font-weight: 600; color: #334155; margin-bottom: 6px;">Nombre Completo:</label>
                    <input type="text" name="nombre" value="<?php echo htmlspecialchars($_SESSION['nombre'] ?? 'Usuario'); ?>" required style="width: 100%; padding: 12px; border: 2px solid #cbd5e1; border-radius: 12px; box-sizing: border-box;">
                </div>

                <div>
                    <label style="display: block; font-weight: 600; color: #334155; margin-bottom: 6px;">Correo Electrónico:</label>
                    <input type="email" name="correo" value="<?php echo htmlspecialchars($_SESSION['correo'] ?? ''); ?>" required style="width: 100%; padding: 12px; border: 2px solid #cbd5e1; border-radius: 12px; box-sizing: border-box;">
                </div>

                <div style="background: #f0fdf4; border-left: 4px solid #22c55e; padding: 15px; border-radius: 12px; margin-top: 10px;">
                    <p style="margin: 0; color: #15803d; font-size: 0.9rem;">
                        🐾 <strong>Estado del perfil:</strong> Adoptante Verificado Activo.
                    </p>
                </div>

                <button type="submit" onclick="alert('Perfil actualizado correctamente'); return false;" style="background: #6366f1; color: white; padding: 14px; border: none; border-radius: 14px; font-weight: bold; cursor: pointer; margin-top: 10px;">
                    Guardar Cambios 💾
                </button>
            </form>
        </div>
    </main>

    <footer>
        <p><strong>PhiliaPet</strong> — Tu espacio de adopción responsable 🐾</p>
    </footer>

</body>
</html>