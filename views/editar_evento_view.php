<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['rol']) || ($_SESSION['rol'] !== 'refugio' && $_SESSION['rol'] !== 'admin')) {
    header("Location: index.php?action=inicio");
    exit();
}

// Variables seguras para evitar los Warnings de PHP
$id_evento = $eventoData['id_evento'] ?? $eventoData['id'] ?? '';
$titulo = $eventoData['titulo'] ?? '';
$tipo = $eventoData['tipo_evento'] ?? $eventoData['tipo'] ?? '';
$fecha = $eventoData['fecha_hora'] ?? $eventoData['fecha'] ?? '';
$fundacion = $eventoData['fundacion'] ?? '';
$lugar = $eventoData['lugar'] ?? '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PhiliaPet - Editar Evento</title>
    <link rel="stylesheet" href="assets/css/estilos.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f3ff;
            margin: 0;
            padding: 20px;
            color: #4c1d95;
        }
        .header-panel {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #ffffff;
            padding: 15px 30px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            margin-bottom: 30px;
        }
        .btn-volver {
            text-decoration: none;
            color: #6b21a8;
            font-weight: bold;
            background: #f3e8ff;
            padding: 8px 16px;
            border-radius: 10px;
        }
        .contenedor-form {
            background: #ffffff;
            padding: 30px;
            border-radius: 20px;
            max-width: 550px;
            margin: 0 auto 40px auto;
            box-shadow: 0 8px 25px rgba(0,0,0,0.06);
            border: 2px dashed #c084fc;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
            font-size: 0.9rem;
            color: #581c87;
        }
        .form-control {
            width: 100%;
            padding: 10px 12px;
            border-radius: 10px;
            border: 1px solid #ddd6fe;
            box-sizing: border-box;
            font-family: inherit;
            background: #faf5ff;
        }
        .btn-guardar {
            background: #6b21a8;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 10px;
            cursor: pointer;
            font-weight: bold;
            width: 100%;
            font-size: 1rem;
            transition: background 0.3s;
        }
        .btn-guardar:hover {
            background: #581c87;
        }
    </style>
</head>
<body>

    <div class="header-panel">
        <h2>✏️ Editar Jornada o Evento</h2>
        <a href="index.php?action=gestionar_eventos" class="btn-volver">← Volver a Gestión</a>
    </div>

    <div class="contenedor-form">
        <h3 style="margin-top:0; text-align:center; color: #6b21a8;">Actualizar Datos del Evento</h3>
        
        <form action="index.php?action=actualizar_evento" method="POST">
            <input type="hidden" name="id_evento" value="<?php echo htmlspecialchars($id_evento); ?>">

            <div class="form-group">
                <label>Título del Evento:</label>
                <input type="text" name="titulo" class="form-control" value="<?php echo htmlspecialchars($titulo); ?>" required>
            </div>
            
            <div class="form-group">
                <label>Tipo de Evento:</label>
                <select name="tipo_evento" class="form-control" required>
                    <option value="Adopción" <?php echo ($tipo === 'Adopción') ? 'selected' : ''; ?>>🐾 Adopción</option>
                    <option value="Vacunación" <?php echo ($tipo === 'Vacunación') ? 'selected' : ''; ?>>💉 Vacunación</option>
                    <option value="Esterilización" <?php echo ($tipo === 'Esterilización') ? 'selected' : ''; ?>>🐱 Esterilización</option>
                    <option value="Donación" <?php echo ($tipo === 'Donación') ? 'selected' : ''; ?>>🎁 Donación</option>
                </select>
            </div>

            <div class="form-group">
                <label>Fecha y Hora:</label>
                <input type="text" name="fecha_hora" class="form-control" value="<?php echo htmlspecialchars($fecha); ?>" required>
            </div>

            <div class="form-group">
                <label>Fundación:</label>
                <input type="text" name="fundacion" class="form-control" value="<?php echo htmlspecialchars($fundacion); ?>" required>
            </div>

            <div class="form-group">
                <label>Lugar:</label>
                <input type="text" name="lugar" class="form-control" value="<?php echo htmlspecialchars($lugar); ?>" required>
            </div>

            <button type="submit" class="btn-guardar">Actualizar Evento ✨</button>
        </form>
    </div>

</body>
</html>