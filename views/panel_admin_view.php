<?php
// Aseguramos sesión y validación de seguridad estricta para el Admin
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header("Location: index.php?action=inicio");
    exit();
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
        .admin-container { max-width: 1200px; margin: 40px auto; padding: 0 20px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .admin-header { background: linear-gradient(135deg, #4f46e5, #3b82f6); color: white; padding: 30px; border-radius: 20px; margin-bottom: 30px; box-shadow: 0 10px 25px rgba(79, 70, 229, 0.2); }
        .admin-header h1 { margin: 0 0 10px 0; font-size: 2.2rem; }
        .admin-header p { margin: 0; opacity: 0.9; }
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 40px; }
        .stat-card { background: white; padding: 25px; border-radius: 16px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border-left: 5px solid #4f46e5; }
        .stat-card h3 { margin: 0 0 10px 0; color: #64748b; font-size: 1rem; }
        .stat-card .numero { font-size: 2rem; font-weight: bold; color: #1e293b; margin: 0; }
        .admin-seccion { background: white; padding: 30px; border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); margin-bottom: 30px; }
        .admin-seccion h2 { margin-top: 0; color: #1e293b; display: flex; align-items: center; gap: 10px; border-bottom: 2px solid #f1f5f9; padding-bottom: 15px; }
        .tabla-admin { width: 100%; border-collapse: collapse; margin-top: 15px; }
        .tabla-admin th, .tabla-admin td { padding: 12px 15px; text-align: left; border-bottom: 1px solid #e2e8f0; }
        .tabla-admin th { background: #f8fafc; color: #475569; font-weight: 600; }
        .btn-accion { padding: 6px 12px; border-radius: 8px; text-decoration: none; font-size: 0.85rem; font-weight: bold; display: inline-block; margin-right: 5px; }
        .btn-editar { background: #e0e7ff; color: #4338ca; }
        .btn-eliminar { background: #fee2e2; color: #991b1b; }
        .btn-volver { display: inline-block; margin-bottom: 20px; color: #4f46e5; text-decoration: none; font-weight: bold; }
        .btn-volver:hover { text-decoration: underline; }
    </style>
</head>
<body style="background-color: #f8fafc;">

    <div class="admin-container">
        <a href="index.php?action=inicio" class="btn-volver">← Volver al Inicio de PhiliaPet</a>

        <!-- ENCABEZADO DEL PANEL -->
        <div class="admin-header">
            <h1>🛡️ Panel de Control Maestro</h1>
            <p>Bienvenida, Administradora Isa. Desde aquí tienes el control total de la plataforma, usuarios y registros recientes.</p>
        </div>

        <!-- TARJETAS DE ESTADÍSTICAS RÁPIDAS -->
        <div class="stats-grid">
            <div class="stat-card" style="border-left-color: #4f46e5;">
                <h3>🐾 Estado del Sistema</h3>
                <p class="numero" style="font-size: 1.5rem; color: #4f46e5;">100% Activo ✨</p>
            </div>
            <div class="stat-card" style="border-left-color: #10b981;">
                <h3>👤 Tu Rango Actual</h3>
                <p class="numero" style="font-size: 1.5rem; color: #10b981;">Administradora</p>
            </div>
            <div class="stat-card" style="border-left-color: #f59e0b;">
                <h3>📍 Ciudad Principal</h3>
                <p class="numero" style="font-size: 1.5rem; color: #f59e0b;">Bogotá D.C.</p>
            </div>
        </div>

        <!-- SECCIÓN DE ACCESOS Y GESTIÓN GLOBAL -->
        <div class="admin-seccion">
            <h2>⚙️ Acciones y Gestión Global</h2>
            <p>Como administradora, puedes supervisar las secciones críticas de la red de apoyo:</p>
            <div style="margin-top: 20px; display: flex; gap: 15px; flex-wrap: wrap;">
                <a href="index.php?action=mascotas" class="btn-accion btn-editar" style="padding: 12px 20px; font-size: 1rem;">🐶 Gestionar / Editar Todas las Mascotas</a>
                <a href="index.php?action=catalogo_adopcion" class="btn-accion" style="background: #d1fae5; color: #065f46; padding: 12px 20px; font-size: 1rem;">👁️ Ver Catálogo Público</a>
                <a href="index.php?action=unir_refugio" class="btn-accion" style="background: #fef3c7; color: #92400e; padding: 12px 20px; font-size: 1rem;">🏢 Solicitudes de Refugios</a>
            </div>
        </div>

        <!-- SECCIÓN DE ACTIVIDAD RECIENTE -->
        <div class="admin-seccion">
            <h2>📊 Actividad Reciente en la Red de Bogotá</h2>
            <p>Monitoreo en tiempo real de los últimos movimientos registrados en el sistema:</p>
            
            <table class="tabla-admin">
                <thead>
                    <tr>
                        <th>Fecha / Hora</th>
                        <th>Módulo</th>
                        <th>Descripción de la Actividad</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Hoy, 09:00 AM</td>
                        <td>Seguridad</td>
                        <td>Inicio de sesión exitoso de la cuenta Administradora (Isa).</td>
                        <td><span style="color: #10b981; font-weight: bold;">✔ Verificado</span></td>
                    </tr>
                    <tr>
                        <td>Junio 2026</td>
                        <td>Eventos</td>
                        <td>Actualización de agenda masiva en C.C. Gran Estación y Parque Simón Bolívar.</td>
                        <td><span style="color: #3b82f6; font-weight: bold;">ℹ️ Publicado</span></td>
                    </tr>
                    <tr>
                        <td>Sistema</td>
                        <td>Base de Datos</td>
                        <td>Conexión establecida correctamente con el servidor local de PhiliaPet.</td>
                        <td><span style="color: #10b981; font-weight: bold;">✔ Estable</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>