<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['rol']) || ($_SESSION['rol'] !== 'refugio' && $_SESSION['rol'] !== 'admin')) {
    header("Location: index.php?action=inicio");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PhiliaPet - Gestionar Eventos y Calendario</title>
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
        .tabla-contenedor {
            background: #ffffff;
            padding: 20px;
            border-radius: 20px;
            max-width: 950px;
            margin: 0 auto;
            box-shadow: 0 8px 25px rgba(0,0,0,0.06);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
        }
        th {
            background-color: #7e22ce;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #faf5ff;
        }
        .btn-editar {
            background: #a855f7;
            color: white;
            padding: 6px 12px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            font-size: 0.85rem;
            display: inline-block;
            margin-right: 5px;
        }
        .btn-eliminar {
            color: #dc2626;
            text-decoration: none;
            font-weight: bold;
            font-size: 0.85rem;
        }
    </style>
</head>
<body>

    <div class="header-panel">
        <h2>📅 Gestión de Agenda y Calendario</h2>
        <a href="index.php?action=calendario" class="btn-volver">← Volver al Calendario</a>
    </div>

    <!-- Formulario para Registrar Nuevo Evento -->
    <div class="contenedor-form">
        <h3 style="margin-top:0; text-align:center; color: #6b21a8;">Programar Nueva Jornada ✨</h3>
        <form action="index.php?action=guardar_evento" method="POST">
            <div class="form-group">
                <label>Título del Evento:</label>
                <input type="text" name="titulo" class="form-control" required placeholder="Ej: Pasarela de Adopción y Charlas">
            </div>
            
            <div class="form-group">
                <label>Tipo de Evento:</label>
                <select name="tipo_evento" class="form-control" required>
                    <option value="Adopción">🐾 Jornada de Adopción</option>
                    <option value="Vacunación">💉 Campaña de Vacunación</option>
                    <option value="Esterilización">🐱 Jornada de Esterilización</option>
                    <option value="Donación">🎁 Donación y Suministros</option>
                </select>
            </div>

            <div class="form-group">
                <label>Fecha y Hora (Texto descriptivo):</label>
                <input type="text" name="fecha_hora" class="form-control" required placeholder="Ej: Sábado, 06 JUN • 10:00 AM - 4:00 PM">
            </div>

            <div class="form-group">
                <label>Nombre de la Fundación:</label>
                <input type="text" name="fundacion" class="form-control" required placeholder="Ej: Huellas & Patitas">
            </div>

            <div class="form-group">
                <label>Lugar (Dirección en Bogotá):</label>
                <input type="text" name="lugar" class="form-control" required placeholder="Ej: C.C. Plaza Central (Bogotá)">
            </div>

            <button type="submit" class="btn-guardar">Publicar Jornada ✨</button>
        </form>
    </div>

    <!-- Tabla de Eventos Registrados -->
    <div class="tabla-contenedor">
        <h3 style="margin-top:0; text-align:center; color: #6b21a8;">📋 Jornadas Programadas Actuales</h3>
        
        <table>
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Tipo</th>
                    <th>Fecha y Hora</th>
                    <th>Fundación</th>
                    <th>Lugar</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($eventos)): ?>
                    <?php foreach ($eventos as $e): ?>
                        <tr>
                            <td><strong><?php echo htmlspecialchars($e['titulo'] ?? ''); ?></strong></td>
                            <td><?php echo htmlspecialchars($e['tipo_evento'] ?? ($e['tipo'] ?? '')); ?></td>
                            <td><?php echo htmlspecialchars($e['fecha_hora'] ?? ($e['fecha'] ?? '')); ?></td>
                            <td><?php echo htmlspecialchars($e['fundacion'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($e['lugar'] ?? ''); ?></td>
                            <td>
                                <a href="index.php?action=editar_evento&id=<?php echo $e['id_evento'] ?? $e['id'] ?? 0; ?>" class="btn-editar">✏️ Editar</a>
                                <a href="index.php?action=eliminar_evento&id=<?php echo $e['id_evento'] ?? $e['id'] ?? 0; ?>" class="btn-eliminar" onclick="return confirm('¿Seguro que deseas eliminar este evento?');">🗑️ Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="text-align: center;">No hay jornadas programadas aún.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</body>
</html>