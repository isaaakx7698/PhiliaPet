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
            background-color: #71b85bc6;
            margin: 0;
            padding: 20px;
            color: #1a4f15e9;
        }
        .header-panel {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #dafece;
            padding: 15px 30px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            max-width: 1000px;
            margin: 0 auto 30px auto;
        }
        .btn-volver {
            text-decoration: none;
            color: #daffb7;
            font-weight: bold;
            background: #1a5912c4;
            padding: 8px 16px;
            border-radius: 10px;
            transition: background 0.3s;
        }
        .btn-volver:hover {
            background: #1a571c;
        }
        .contenedor-agenda {
            max-width: 900px;
            margin: 0 auto;
        }
        .titulo-seccion {
            text-align: center;
            color: #134e1c;
            margin-bottom: 5px;
            font-family: Cooper Black;
            font-size: 38px;
        }
        .subtitulo-seccion {
            text-align: center;
            color: #13440fe9;
            font-size: 0.97rem;
            margin-bottom: 40px;
        }
        .card-evento {
            background: #d5fccad6;
            border-radius: 20px;
            padding: 20px 25px;
            margin: 0 auto 20px auto; /* 0 arriba, auto a la derecha, 20px abajo para separar tarjetas, auto a la izquierda */
            box-shadow: 0 8px 25px rgba(0,0,0,0.06);
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-left: 6px solid #216b28;
            transition: transform 0.2s;
            width: 1000px;
            max-width: 90%; /* Para que en pantallas pequeñas no se desborde */
        }
        .card-evento:hover {
            transform: translateY(-2px);
        }
        .evento-info h3 {
            margin: 0 0 8px 0;
            color: #951d1d;
            font-size: 1.2rem;
        }
        .evento-meta {
            font-size: 0.9rem;
            color: #153d11;
            margin: 4px 0;
        }
        .badge-fecha {
            background: #164f13cb;
            color: #d6ffd6;
            padding: 6px 12px;
            border-radius: 8px;
            font-weight: bold;
            font-size: 0.85rem;
            display: inline-block;
            margin-bottom: 8px;
        }
        .icono-fecha {
            font-size: 2.5rem;
            background: #cdffcd;
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
            color: #37792b;
        }
    </style>
</head>
<body>

    <div class="header-panel">
        <h2 style="margin:0; font-size: 1.3rem;">📅 Agenda Oficial</h2>
        <div style="display: flex; gap: 10px; align-items: center;">
            <?php if (isset($_SESSION['rol']) && ($_SESSION['rol'] === 'refugio' || $_SESSION['rol'] === 'admin')): ?>
                <a href="index.php?action=gestionar_eventos" class="btn-volver" style="background: #1a5912c4; color: #daffb7;">⚙️ Gestionar Eventos</a>
            <?php endif; ?>
            <a href="index.php?action=inicio" class="btn-volver">← Volver al Inicio</a>
        </div>
    </div>

    <!-- Contenedor con fondo claro para que resalte hermoso -->
    <div style="background-color: #e4fed4f4; border: 4px solid #1a6d14; border-radius: 20px; padding: 25px; max-width: 800px; margin: 20px auto; text-align: center; box-shadow: 0 4px 10px rgba(0,0,0,0.03);">
        <h1 class="titulo-seccion" style="margin-top: 0;">Agenda Oficial de Fundaciones</h1>
        <p style="color: #335c33; margin-bottom: 0; font-size: 1.05rem;">
            Consulta las fechas, lugares y horarios donde las fundaciones aliadas de Bogotá estarán realizando jornadas de adopción y bienestar.
        </p>
    </div>
        <?php if (!empty($eventos)): ?>
            <?php foreach ($eventos as $e): ?>
                <div class="card-evento">
                    <div style="display: flex; align-items: center; gap: 20px;">
                        <div class="icono-fecha">
                            📅
                        </div>
                        <div>
                            <span class="badge-fecha">✨ <?php echo htmlspecialchars($e['fecha_hora'] ?? $e['fecha'] ?? 'Fecha por confirmar'); ?></span>
                            <h3><?php echo htmlspecialchars($e['titulo']); ?></h3>
                            <div class="evento-meta"><strong>🐾 Tipo:</strong> <?php echo htmlspecialchars($e['tipo_evento'] ?? $e['tipo'] ?? 'Jornada'); ?></div>
                          <div class="evento-meta"><strong>🏛️ Fundación:</strong> <?php echo htmlspecialchars($e['fundacion'] ?? $e['nombre_fundacion'] ?? 'Fundación Aliada'); ?></div>
                            <div class="evento-meta"><strong>📍 Lugar:</strong> <?php echo htmlspecialchars($e['lugar']); ?></div>
                        </div>
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