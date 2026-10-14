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
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

    <!-- MARQUESINA -->
    <div class="marquesina-contenedor">
        <div class="marquesina-texto">
            🐶 ¡ADOPTA, NO COMPRES! • Próxima jornada en C.C. Gran Estación este Sábado 🎉 • Vacunación gratuita con la Fundación Huellas de Amor 🐱 • ¡Ayúdanos a salvar vidas en Bogotá! ❤️ • 
        </div>
    </div>

    <!-- ENCABEZADO -->
    <header>
        <div class="logo-animado">
            <span>🐾</span> PhiliaPet <span class="heart">❤️</span>
        </div>
        <nav>
            <a href="index.php?action=inicio" class="nav-link">Inicio</a>
            <a href="index.php?action=catalogo_adopcion" class="nav-link" style="color: #047857; font-weight: bold;">🐾 Adopta</a>
            
            <div class="dropdown-fundaciones">
                <a href="index.php?action=inicio#mascotas" class="nav-link">Fundaciones ▾</a>
                <div class="dropdown-content">
                    <a href="index.php?action=inicio#mascotas">Ver Listado</a>
                    <a href="index.php?action=unir_refugio" style="color: var(--verde-borde) !important; font-weight: bold;">🐾 Unir mi Refugio</a>
                </div>
            </div>

            <a href="index.php?action=calendario" class="nav-link activo" style="font-weight: bold;">📅 Calendario</a>
            <a href="index.php?action=inicio#donar" class="nav-link btn-nav-donar">🎁 Donar</a>

            <?php if (isset($_SESSION['rol'])): ?>
                <?php if ($_SESSION['rol'] === 'adoptante'): ?>
                    <a href="index.php?action=perfil_adoptante" class="nav-link" style="background: #e0e7ff; color: #4338ca; padding: 6px 14px; border-radius: 12px; font-weight: bold;">👤 Mi Perfil</a>
                <?php elseif ($_SESSION['rol'] === 'refugio'): ?>
                    <a href="index.php?action=panel_refugio" class="nav-link" style="color: #4c1d95; font-weight: bold;">⚙️ Panel Refugio</a>
                <?php elseif ($_SESSION['rol'] === 'admin'): ?>
                    <a href="index.php?action=panel_admin" class="nav-link" style="color: #4c1d95; font-weight: bold;">🛡️ Panel Admin</a>
                <?php endif; ?>
                <a href="index.php?action=logout" class="nav-link" style="color: #ef4444; font-weight: 600;">Cerrar Sesión</a>
            <?php else: ?>
                <a href="index.php?action=registro" class="nav-link">Registrarse</a>
                <a href="index.php?action=login" class="nav-link" style="color: #0284c7; font-weight: bold;">Ingresar</a>
            <?php endif; ?>
        </nav>
    </header>

    <!-- CONTENIDO PRINCIPAL: CALENDARIO DE JORNADAS -->
    <section class="seccion-mascotas" style="padding: 40px 20px;">
        <div class="titulo-decorado">
            <h2>Agenda Oficial de Fundaciones 📅</h2>
            <p class="subtitulo">Consulta las fechas, lugares y horarios donde las fundaciones aliadas de Bogotá estarán realizando jornadas de adopción y bienestar.</p>
        </div>

        <div style="max-width: 900px; margin: 0 auto; display: flex; flex-direction: column; gap: 20px;">
            
            <!-- Evento 1 -->
            <div class="tarjeta-peludito card-lavanda" style="padding: 25px; display: flex; justify-content: space-between; align-items: center; text-align: left;">
                <div>
                    <span class="tag-propiedad color-azul" style="margin-bottom: 8px; display: inline-block;">Sábado, 06 JUN • 10:00 AM - 4:00 PM</span>
                    <h3 style="color: #3b0764; margin-bottom: 8px;">Pasarela de Adopción y Charlas</h3>
                    <p style="margin: 0; color: #4b5563;"><strong>🏢 Fundación:</strong> Huellas & Patitas</p>
                    <p style="margin: 4px 0 0 0; color: #4b5563;">📍 <strong>Lugar:</strong> C.C. Plaza Central (Bogotá)</p>
                </div>
                <div style="font-size: 2.5em;">🐾</div>
            </div>

            <!-- Evento 2 -->
            <div class="tarjeta-peludito card-menta" style="padding: 25px; display: flex; justify-content: space-between; align-items: center; text-align: left;">
                <div>
                    <span class="tag-propiedad color-amarillo" style="margin-bottom: 8px; display: inline-block;">Sábado, 13 JUN • 9:00 AM - 3:00 PM</span>
                    <h3 style="color: #064e3b; margin-bottom: 8px;">Jornada de Donación de Alimento y Cobijas</h3>
                    <p style="margin: 0; color: #4b5563;"><strong>🏢 Fundación:</strong> Refugio Amigos de 4 Patas</p>
                    <p style="margin: 4px 0 0 0; color: #4b5563;">📍 <strong>Lugar:</strong> Parque Simón Bolívar (Costado Salitre)</p>
                </div>
                <div style="font-size: 2.5em;">🎁</div>
            </div>

            <!-- Evento 3 -->
            <div class="tarjeta-peludito card-lavanda" style="padding: 25px; display: flex; justify-content: space-between; align-items: center; text-align: left;">
                <div>
                    <span class="tag-propiedad color-azul" style="margin-bottom: 8px; display: inline-block;">Sábado, 20 JUN • 8:30 AM - 2:00 PM</span>
                    <h3 style="color: #3b0764; margin-bottom: 8px;">Jornada de Esterilización y Adopción</h3>
                    <p style="margin: 0; color: #4b5563;"><strong>🏢 Fundación:</strong> Huellas de Amor</p>
                    <p style="margin: 4px 0 0 0; color: #4b5563;">📍 <strong>Lugar:</strong> C.C. Gran Estación (Plazoleta principal)</p>
                </div>
                <div style="font-size: 2.5em;">🐱</div>
            </div>

        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        <p><strong>PhiliaPet</strong> — Transformando el futuro de los refugios de Bogotá 🐾</p>
        <p>&copy; 2026 Conectando corazones peluditos con total responsabilidad.</p>
    </footer>

</body>
</html>