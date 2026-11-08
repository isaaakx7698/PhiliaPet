<?php
// Aseguramos sesión y validación de seguridad estricta para el Admin
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header("Location: index.php?action=inicio");
    exit();
}

// ==========================================
// CONSULTA AUTOMÁTICA CON PDO PARA EL ÍTEM 5
// ==========================================
$actividades = [];
try {
    // Intentamos conectar por PDO (ajusta las variables si en tu proyecto se llaman diferente)
    $host = 'localhost';
    $dbname = 'philiapet_db';
    $username = 'root';
    $password = '';

    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Traemos los registros ordenados del más reciente al más antiguo
    $stmt = $pdo->query("SELECT * FROM actividad_log ORDER BY id DESC");
    $actividades = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (Exception $e) {
    // Si llegara a haber un error de conexión aquí, la tabla simplemente queda vacía sin romper la página
    $actividades = [];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - PhiliaPet 🛡️</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background-color: #f8fafc;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #1e293b;
        }

        .admin-container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .btn-volver {
            display: inline-block;
            margin-bottom: 40px;
            color: #4f46e5;
            text-decoration: none;
            font-weight: bold;
            font-size: 1.5rem;
            transition: color 0.2s;
        }

        .btn-volver:hover {
            text-decoration: underline;
            color: #322a8b;
        }

        /* ENCABEZADO */
        .admin-header {
            background: linear-gradient(135deg, #332e94, #3270d3);
            color: white;
            padding: 30px;
            border-radius: 20px;
            margin-bottom: 30px;
            box-shadow: 0 10px 25px rgba(79, 70, 229, 0.2);
        }

        .admin-header h1 {
            margin-bottom: 10px;
            font-size: 2.2rem;
        }

        .admin-header p {
            margin: 0;
            opacity: 0.9;
            font-size: 1rem;
        }

        /* TARJETAS DE ESTADÍSTICAS */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            border-left: 5px solid #4f46e5;
        }

        .stat-card.sistema { border-left-color: #4f46e5; }
        .stat-card.rango { border-left-color: #10b981; }
        .stat-card.ciudad { border-left-color: #f59e0b; }

        .stat-card h3 {
            margin-bottom: 10px;
            color: #64748b;
            font-size: 1rem;
        }

        .stat-card .numero {
            font-size: 1.5rem;
            font-weight: bold;
            margin: 0;
        }

        .stat-card.sistema .numero { color: #4f46e5; }
        .stat-card.rango .numero { color: #10b981; }
        .stat-card.ciudad .numero { color: #f59e0b; }

        /* SECCIONES GENERALES */
        .admin-seccion {
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            margin-bottom: 30px;
        }

        .admin-seccion h2 {
            margin-top: 0;
            color: #1e293b;
            display: flex;
            align-items: center;
            gap: 10px;
            border-bottom: 2px solid #f1f5f9;
            padding-bottom: 15px;
            font-size: 1.4rem;
        }

        .admin-seccion p {
            color: #64748b;
            margin-top: 10px;
        }

        /* BOTONES DE ACCIÓN GLOBAL */
        .acciones-wrapper {
            margin-top: 20px;
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .btn-accion {
            padding: 12px 20px;
            border-radius: 10px;
            text-decoration: none;
            font-size: 1rem;
            font-weight: bold;
            display: inline-block;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .btn-accion:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }


        /* TABLA DE ACTIVIDAD */
        .tabla-admin {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        .tabla-admin th, 
        .tabla-admin td {
            padding: 14px 15px;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
            font-size: 0.95rem;
        }

        .tabla-admin th {
            background: #f8fafc;
            color: #475569;
            font-weight: 600;
        }

        .badge-estado {
            font-weight: bold;
        }

        .badge-verde { color: #10b981; }

        /* BOTÓN SALVAVIDAS PARA EXPORTAR A PDF (ÍTEM 5) */
        .btn-exportar-pdf {
            background-color: #203aae;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            margin-top: 40px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: background 0.2s;
        }

        .btn-exportar-pdf:hover {
            background-color: #052c4c;
        }

        /* Ocultar botones e inicio al imprimir para que salga limpio el PDF */
        @media print {
            .btn-volver, .acciones-wrapper, .btn-exportar-pdf, .stats-grid {
                display: none !important;
            }
            body {
                background-color: white;
            }
            .admin-seccion {
                box-shadow: none;
                padding: 0;
            }
        }
    </style>
</head>
<body>

    <div class="admin-container">
        <a href="index.php?action=inicio" class="btn-volver">← Volver al Inicio de PhiliaPet</a>

        <!-- ENCABEZADO DEL PANEL -->
        <div class="admin-header">
            <h1>🛡️ Panel de Control Maestro</h1>
            <p>Bienvenida, Administradora Isa. Desde aquí tienes el control total de la plataforma, usuarios y registros recientes.</p>
        </div>

        <!-- TARJETAS DE ESTADÍSTICAS RÁPIDAS -->
        <div class="stats-grid">
            <div class="stat-card sistema">
                <h3>🐾 Estado del Sistema</h3>
                <p class="numero">100% Activo ✨</p>
            </div>
            <div class="stat-card rango">
                <h3>👤 Tu Rango Actual</h3>
                <p class="numero">Administradora</p>
            </div>
            <div class="stat-card ciudad">
                <h3>📍 Ciudad Principal</h3>
                <p class="numero">Bogotá D.C.</p>
            </div>
        </div>

        <!-- SECCIÓN DE ACTIVIDAD RECIENTE (INFORME / ÍTEM 5) -->
        <div class="admin-seccion">
            <h2>📊 Actividad Reciente en la Red de Bogotá</h2>
            <p>Monitoreo en tiempo real de los últimos movimientos registrados en el sistema:</p>
            
            <table class="tabla-admin">
                <thead>
                    <tr>
                        <th>Fecha / Hora</th>
                        <th>Módulo</th>
                        <th>Descripción de la Activity</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($actividades)): ?>
                        <?php foreach ($actividades as $act): ?>
                            <tr>
                                <td><?php echo date('d M Y, h:i A', strtotime($act['fecha'])); ?></td>
                                <td><?php echo htmlspecialchars($act['modulo']); ?></td>
                                <td><?php echo htmlspecialchars($act['descripcion']); ?></td>
                                <td><span class="badge-estado badge-verde">✔ <?php echo htmlspecialchars($act['estado']); ?></span></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" style="text-align: center; color: #64748b; padding: 20px;">
                                No hay actividad reciente registrada todavía. 🐾
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <!-- BOTÓN SALVAVIDAS PARA EL ÍTEM 5 (Genera y exporta el reporte en PDF) -->
            <button onclick="window.print()" class="btn-exportar-pdf">
                📥 Generar y Exportar Informe en PDF
            </button>
        </div>
    </div>

</body>
</html>