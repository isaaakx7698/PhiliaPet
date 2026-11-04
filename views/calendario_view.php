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
    <title>PhiliaPet - Calendario de Fundaciones</title>
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
            max-width: 900px;
            margin: 0 auto 30px auto;
        }
        .btn-volver {
            text-decoration: none;
            color: #6b21a8;
            font-weight: bold;
            background: #f3e8ff;
            padding: 8px 16px;
            border-radius: 10px;
            transition: background 0.3s;
        }
        .btn-volver:hover {
            background: #e9d5ff;
        }
        .contenedor-agenda {
            max-width: 900px;
            margin: 0 auto;
        }
        .titulo-seccion {
            text-align: center;
            color: #581c87;
            margin-bottom: 5px;
        }
        .subtitulo-seccion {
            text-align: center;
            color: #6b21a8;
            font-size: 0.95rem;
            margin-bottom: 30px;
        }
        .card-evento {
            background: #ffffff;
            border-radius: 20px;
            padding: 20px 25px;
            margin-bottom: 20px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.06);
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-left: 6px solid #a855f7;
            transition: transform 0.2s;
        }
        .card-evento:hover {
            transform: translateY(-2px);
        }
        .evento-info h3 {
            margin: 0 0 8px 0;
            color: #4c1d95;
            font-size: 1.2rem;
        }
        .evento-meta {
            font-size: 0.9rem;
            color: #6b21a8;
            margin: 4px 0;
        }
        .badge-fecha {
            background: #f3e8ff;
            color: #6b21a8;
            padding: 6px 12px;
            border-radius: 8px;
            font-weight: bold;
            font-size: 0.85rem;
            display: inline-block;
            margin-bottom: 8px;
        }
        .icono-fecha {
            font-size: 2.5rem;
            background: #faf5ff;
            padding: 15px;
            border-radius: 15px;
            text-align: center;
            min-width: 70px;
        }
        .sin-eventos {
            text-align: center;
            background: #ffffff;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            color: #6b21a8;
        }
    </style>
</head>
<body>

    <div class="header-panel">
        <h2 style="margin:0; font-size: 1.3rem;">📅 Agenda Oficial</h2>
        <div style="display: flex; gap: 10px; align-items: center;">
            <?php if (isset($_SESSION['rol']) && ($_SESSION['rol'] === 'refugio' || $_SESSION['rol'] === 'admin')): ?>
                <a href="index.php?action=gestionar_eventos" class="btn-volver" style="background: #7e22ce; color: white;">⚙️ Gestionar Eventos</a>
            <?php endif; ?>
            <a href="index.php?action=inicio" class="btn-volver">← Volver al Inicio</a>
        </div>
    </div>

    <div class="contenedor-agenda">
        <h1 class="titulo-seccion">Agenda Oficial de Fundaciones 🗓️</h1>
        <p class="subtitulo-seccion">Consulta las fechas, lugares y horarios donde las fundaciones aliadas de Bogotá estarán realizando jornadas de adopción y bienestar.</p>

        <?php if (!empty($eventos)): ?>
            <?php foreach ($eventos as $e): ?>
                <div class="card-evento">
                    <div style="display: flex; align-items: center; gap: 20px;">
                        <div class="icono-fecha">
                            🗓️
                        </div>
                        <div>
                            <span class="badge-fecha">✨ <?php echo htmlspecialchars($e['fecha_hora'] ?? $e['fecha'] ?? 'Fecha por confirmar'); ?></span>
                            <h3><?php echo htmlspecialchars($e['titulo']); ?></h3>
                            <div class="evento-meta"><strong>🐾 Tipo:</strong> <?php echo htmlspecialchars($e['tipo_evento'] ?? $e['tipo'] ?? 'Jornada'); ?></div>
                          <div class="evento-meta"><strong>🏛️ Fundación:</strong> <?php echo htmlspecialchars($e['fundacion'] ?? $e['nombre_fundacion'] ?? 'Fundación Aliada'); ?></div>
                            <div class="evento-meta"><strong>📍 Lugar:</strong> <?php echo htmlspecialchars($e['lugar']); ?></div>
                        </div>
                    </div>
                    <div>
                        <span style="font-size: 1.8rem;">🐾</span>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="sin-eventos">
                <h3>No hay jornadas programadas por el momento</h3>
                <p>Vuelve pronto para enterarte de los próximos eventos de nuestras fundaciones aliadas.</p>
            </div>
        <?php endif; ?>
    </div>

</body>
</html>