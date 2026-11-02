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
    <title>PhiliaPet 🐾 Calendario de Fundaciones</title>
    <link rel="stylesheet" href="assets/css/estilos.css">
    <style>
        .calendario-wrapper {
            max-width: 900px;
            margin: 30px auto 50px auto;
            padding: 0 20px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .header-acciones {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            flex-wrap: wrap;
            gap: 15px;
        }
        .btn-volver-inicio {
            background: #f3e8ff;
            color: #6b21a8;
            padding: 10px 20px;
            border-radius: 14px;
            text-decoration: none;
            font-weight: bold;
            box-shadow: 0 4px 10px rgba(0,0,0,0.03);
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-volver-inicio:hover {
            background: #e9d5ff;
            transform: translateY(-2px);
        }
        .btn-gestion-refugio {
            background: linear-gradient(135deg, #7c3aed, #6d28d9);
            color: white;
            padding: 10px 22px;
            border-radius: 14px;
            text-decoration: none;
            font-weight: bold;
            box-shadow: 0 4px 15px rgba(124, 58, 237, 0.25);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s ease;
        }
        .btn-gestion-refugio:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(124, 58, 237, 0.35);
        }
        /* Tarjetas con estilo idéntico al de los peluditos */
        .card-jornada {
            background: #ffffff;
            border-radius: 20px;
            padding: 25px;
            margin-bottom: 22px;
            box-shadow: 0 8px 25px rgba(139, 92, 246, 0.08);
            position: relative;
            display: flex;
            align-items: center;
            gap: 25px;
            border: 2px solid #ede9fe;
            transition: all 0.3s ease;
        }
        .card-jornada:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(139, 92, 246, 0.15);
            border-color: #d8b4fe;
        }
        .badge-fecha {
            background: #f3e8ff;
            color: #6b21a8;
            padding: 15px;
            border-radius: 16px;
            text-align: center;
            min-width: 85px;
            font-weight: bold;
            border: 1px solid #ddd6fe;
        }
        .info-jornada {
            flex-grow: 1;
        }
        .info-jornada h3 {
            margin: 0 0 8px 0;
            color: #1f2937;
            font-size: 1.35rem;
        }
        .info-jornada p {
            margin: 5px 0;
            color: #4b5563;
            font-size: 0.95rem;
        }
        .icono-decorativo {
            font-size: 2.5rem;
            opacity: 0.9;
        }
    </style>
</head>
<body>

    <?php 
        if (file_exists(__DIR__ . '/header.php')) {
            include __DIR__ . '/header.php';
        } elseif (file_exists(__DIR__ . '/../header.php')) {
            include __DIR__ . '/../header.php';
        }
    ?>

    <div class="calendario-wrapper">
        
        <!-- Botones de Acción Superior (Volver y Gestión) -->
        <div class="header-acciones">
            <a href="index.php?action=inicio" class="btn-volver-inicio">
                ← Volver al Inicio
            </a>

            <?php if (isset($_SESSION['rol']) && ($_SESSION['rol'] === 'refugio' || $_SESSION['rol'] === 'admin')): ?>
                <a href="index.php?action=gestionar_eventos" class="btn-gestion-refugio">
                    📅 Gestionar / Programar Jornadas
                </a>
            <?php endif; ?>
        </div>

        <div style="text-align: center; margin-bottom: 35px;">
            <h2 style="color: #4c1d95; font-size: 2.2rem; margin-bottom: 8px;">Agenda Oficial de Fundaciones 📅</h2>
            <p style="color: #6b7280; font-size: 1.05rem;">Consulta las fechas, lugares y horarios donde las fundaciones aliadas de Bogotá estarán realizando jornadas de adopción y bienestar.</p>
        </div>

        <?php if (!empty($eventos)): ?>
            <?php foreach ($eventos as $ev): ?>
                <?php 
                    $tipo = $ev['tipo_evento'] ?? ($ev['tipo'] ?? 'Adopción');
                    $fechaTexto = $ev['fecha_hora'] ?? ($ev['fecha'] ?? ($ev['fecha_evento'] ?? 'Por definir'));
                    $fundacionTexto = $ev['fundacion'] ?? ($ev['nombre_fundacion'] ?? 'Fundación Aliada');
                    
                    $icono = '🐾';
                    $bordeIzq = '#a855f7'; // Morado elegante

                    if (stripos($tipo, 'Vacunación') !== false) {
                        $icono = '💉';
                        $bordeIzq = '#0ea5e9'; // Azul celeste
                    } elseif (stripos($tipo, 'Esterilización') !== false) {
                        $icono = '🐱';
                        $bordeIzq = '#10b981'; // Verde menta
                    } elseif (stripos($tipo, 'Donación') !== false) {
                        $icono = '🎁';
                        $bordeIzq = '#f59e0b'; // Amarillo cálido
                    }
                ?>
                <div class="card-jornada" style="border-left: 7px solid <?php echo $bordeIzq; ?>;">
                    <div class="badge-fecha">
                        <span style="font-size: 1.4rem; display: block;">🗓️</span>
                        <span style="font-size: 0.75rem; text-transform: uppercase; display: block; margin-top: 3px; color: #7e22ce;">Jornada</span>
                    </div>

                    <div class="info-jornada">
                        <div style="font-size: 0.85rem; font-weight: bold; color: #7c3aed; margin-bottom: 4px;">
                            ✨ <?php echo htmlspecialchars($fechaTexto); ?>
                        </div>
                        <h3><?php echo htmlspecialchars($ev['titulo']); ?></h3>
                        <p>🏢 <strong>Fundación:</strong> <?php echo htmlspecialchars($fundacionTexto); ?></p>
                        <p>📍 <strong>Lugar:</strong> <?php echo htmlspecialchars($ev['lugar']); ?></p>
                    </div>

                    <div class="icono-decorativo">
                        <?php echo $icono; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div style="text-align: center; background: white; padding: 45px; border-radius: 20px; color: #6b7280; box-shadow: 0 8px 25px rgba(139, 92, 246, 0.05); font-size: 1.1rem; border: 2px dashed #d8b4fe;">
                <p style="margin:0;">No hay jornadas programadas en este momento. ¡Vuelve pronto! 🐾</p>
            </div>
        <?php endif; ?>
    </div>

</body>
</html>