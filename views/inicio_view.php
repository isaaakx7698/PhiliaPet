<?php
// Aseguramos que la sesión esté activa para verificar el rol del usuario
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PhiliaPet 🐾 ¡Encuentra tu Amor Peludito!</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

    <!-- MARQUESINA -->
    <div class="marquesina-contenedor">
        <div class="marquesina-texto">
            🐶 ¡ADOPTA, NO COMPRES! • Próxima jornada en C.C. Gran Estación este Sábado 🎉 • Vacunación gratuita con la Fundación Huellas de Amor 🐱 • ¡Ayúdanos a salvar vidas en Bogotá! ❤️ • 
        </div>
    </div>

    <!-- ENCABEZADO CON CONTROL DINÁMICO DE ROLES -->
    <header>
        <div class="logo-animado">
            <span>🐾</span> PhiliaPet <span class="heart">❤️</span>
        </div>
        <nav>
            <a href="index.php?action=inicio" class="nav-link activo">Inicio</a>
            <a href="index.php?action=catalogo_adopcion" class="nav-link" style="color: #047857; font-weight: bold;">🐾 Adopta</a>
            
            <!-- MENÚ DESPLEGABLE DE FUNDACIONES -->
            <div class="dropdown-fundaciones">
                <a href="#mascotas" class="nav-link">Fundaciones ▾</a>
                <div class="dropdown-content">
                    <a href="#mascotas">Ver Listado</a>
                    <a href="index.php?action=unir_refugio" style="color: var(--verde-borde) !important; font-weight: bold;">🐾 Unir mi Refugio</a>
                </div>
            </div>

            <a href="#calendario" class="nav-link">📅 Calendario</a>
            <a href="#donar" class="nav-link btn-nav-donar">🎁 Donar</a>

            <!-- LÓGICA DE VISIBILIDAD DE BOTONES SEGÚN EL ROL -->
            <?php if (isset($_SESSION['rol'])): ?>
                
                <?php if ($_SESSION['rol'] === 'adoptante'): ?>
                    <!-- EXCLUSIVO ADOPTANTE: Solo puede ver su Perfil -->
                    <a href="index.php?action=perfil_adoptante" class="nav-link" style="background: #e0e7ff; color: #4338ca; padding: 6px 14px; border-radius: 12px; font-weight: bold;">
                        👤 Mi Perfil
                    </a>
                <?php elseif ($_SESSION['rol'] === 'refugio' || $_SESSION['rol'] === 'admin'): ?>
                    <!-- EXCLUSIVO REFUGIO / ADMIN: Acceso al panel de gestión -->
                    <a href="index.php?action=panel_refugio" class="nav-link" style="color: #4c1d95; font-weight: bold;">
                        ⚙️ Panel Refugio
                    </a>
                <?php endif; ?>

                <a href="index.php?action=logout" class="nav-link" style="color: #ef4444; font-weight: 600;">Cerrar Sesión</a>

            <?php else: ?>
                <!-- VISITANTES SIN INICIAR SESIÓN -->
                <a href="index.php?action=registro" class="nav-link">Registrarse</a>
                <a href="index.php?action=login" class="nav-link" style="color: #0284c7; font-weight: bold;">Ingresar</a>
            <?php endif; ?>
        </nav>
    </header>

    <!-- HERO SECTION -->
    <section id="inicio" class="hero-section">
        <div class="hero-contenido">
            <span class="badge-alerta">✨ Red de Apoyo de Bogotá ✨</span>
            <h1>¡Cambia una vida y llena la tuya de puro amor! 🐶🐱</h1>
            <p>Conectamos y validamos las fundaciones más lindas de la ciudad para que adoptes de forma 100% segura. ¡Tu nuevo mejor amigo te está esperando!</p>
            
            <div class="buscador-magico">
                <div class="input-grupo">
                    <label>¿Qué buscas?</label>
                    <select>
                        <option value="">🐾 Todos los peluditos</option>
                        <option value="perro">Perritos hermosos</option>
                        <option value="gato">Gatitos adorables</option>
                    </select>
                </div>
                <div class="input-grupo">
                    <label>¿De qué edad?</label>
                    <select>
                        <option value="">🍼 Cualquier edad</option>
                        <option value="cachorro">Cachorros (Bebés)</option>
                        <option value="adulto">Adultos consentidos</option>
                    </select>
                </div>
                <button class="btn-buscar-glow">¡Buscar mi Flechazo! ✨</button>
            </div>
        </div>
    </section>

    <!-- SECCIÓN CALENDARIO -->
    <section id="calendario" class="seccion-calendario" style="padding: 40px 20px;">
        <div class="tarjeta-calendario">
            <h3>📅 Agenda de Jornadas Informativas</h3>
            <div class="eventos-grid">
                <div class="evento-item">
                    <span class="fecha">06 JUN</span>
                    <p><strong>C.C. Plaza Central:</strong> Pasarela de adopción de peluditos y charlas de tenencia responsable.</p>
                </div>
                <div class="evento-item">
                    <span class="fecha">13 JUN</span>
                    <p><strong>Parque Simón Bolívar:</strong> Jornada masiva de recolección de alimento y cobijas para refugios.</p>
                </div>
                <div class="evento-item">
                    <span class="fecha">20 JUN</span>
                    <p><strong>C.C. Gran Estación:</strong> Jornada de esterilización y adopción con la Fundación Huellas de Amor.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- GALERÍA DE TARJETAS DE MASCOTAS -->
    <section id="mascotas" class="seccion-mascotas">
        <div class="titulo-decorado">
            <h2>Mascotas esperando por ti 🐾</h2>
            <p class="subtitulo">Revisa su edad, estado de salud y habla directo con su fundación por medio de los botones específicos.</p>
        </div>

        <div class="grid-mascotas">
            <?php if (!empty($mascotas)): ?>
                <?php foreach ($mascotas as $index => $m): ?>
                    <div class="tarjeta-peludito <?php echo ($index % 2 == 0) ? 'card-lavanda' : 'card-menta'; ?>">
                        <span class="badge-adopcion"><?php echo htmlspecialchars($m['estado_salud']); ?> ✨</span>
                        
                        <div class="contenedor-foto" style="width: 100%; height: 220px; overflow: hidden; background: #f3e8ff; display: flex; align-items: center; justify-content: center; border-radius: 20px;">
                            <?php if (!empty($m['imagen'])): ?>
                                <img src="<?php echo htmlspecialchars($m['imagen']); ?>" alt="<?php echo htmlspecialchars($m['nombre']); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                            <?php else: ?>
                                <div style="font-size: 3em;">
                                    <?php echo ($m['especie'] == 'gato') ? '🐱' : '🐶'; ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="cuerpo-tarjeta">
                            <div class="encabezado-tarjeta">
                                <h3><?php echo htmlspecialchars($m['nombre']); ?></h3>
                                <span class="tag-propiedad <?php echo ($m['especie'] == 'gato') ? 'color-amarillo' : 'color-azul'; ?>">
                                    <?php echo htmlspecialchars($m['edad_aproximada']); ?>
                                </span>
                            </div>
                            <p class="detalles"><?php echo htmlspecialchars($m['historia']); ?></p>
                            <div class="fundacion-info">
                                <p>🏢 <strong>Fundación:</strong> Huellas & Patitas</p>
                                <p>📞 Redes y contacto verificado</p>
                            </div>
                            <a href="index.php?action=detalle_adopcion&id=<?php echo $m['id']; ?>" class="btn-tarjeta-contacto">Contactar Fundación 🐾</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p style="text-align: center; grid-column: 1 / -1; color: #64748b;">No hay mascotas disponibles en este momento. 🐾</p>
            <?php endif; ?>
        </div>
    </section>

    <!-- SECCIÓN DONACIONES -->
    <section id="donar" class="seccion-donaciones">
        <div class="tarjeta-donaciones-completa">
            <h2>Libertad de apoyar con lo que puedas 🎁</h2>
            <p>Las fundaciones independientes no tienen recursos fijos. Desde PhiliaPet puedes apoyarlas directamente con dinero, alimento o cobijas de forma transparente.</p>
            
            <div class="nequi-caja-destacada">
                <h3>Aporte Directo por Nequi</h3>
                <p>Cada lugar tiene su QR verificado para que tu ayuda llegue directo y sin intermediarios.</p>
                <div class="qr-grafico">
                    <div class="qr-interior">NEQUI QR</div>
                </div>
                <p class="alerta-nequi">🔒 Proyecto Seguro, Validado y Transparente</p>
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