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

    <!-- ENCABEZADO -->
    <header>
        <div class="logo-animado">
            <span>🐾</span> PhiliaPet <span class="heart">❤️</span>
        </div>
        <nav>
            <a href="#inicio" class="nav-link activo">Inicio</a>
            <a href="index.php?action=catalogo_adopcion" class="nav-link" style="color: #10b981; font-weight: bold;">🐾 Adopta</a>
            <a href="#mascotas" class="nav-link">Fundaciones</a>
            <a href="#calendario" class="nav-link">📅 Calendario</a>
            <a href="#donar" class="nav-link btn-nav-donar">🎁 Donar</a>
            <a href="index.php?action=registro" class="nav-link">Registrarse</a>
            <a href="index.php?action=mascotas" class="nav-link" style="color: #4c1d95; font-weight: bold;">⚙️ Admin</a>
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

    <!-- SECCIÓN CALENDARIO ORGANIZADO -->
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

    <!-- GALERÍA DE TARJETAS DE MASCOTAS (VISTA PÚBLICA) -->
    <section id="mascotas" class="seccion-mascotas">
        <div class="titulo-decorado">
            <h2>Mascotas esperando por ti 🐾</h2>
            <p class="subtitulo">Revisa su edad, estado de salud y habla directo con su fundación por medio de los botones específicos.</p>
        </div>

        <div class="grid-mascotas">
            <?php foreach ($mascotas as $index => $m): ?>
                <div class="tarjeta-peludito <?php echo ($index % 2 == 0) ? 'card-lavanda' : 'card-menta'; ?>">
                    <span class="badge-adopcion"><?php echo htmlspecialchars($m['estado_salud']); ?> ✨</span>
                    
                    <!-- IMAGEN REAL EN EL INICIO -->
                    <div class="contenedor-foto" style="width: 100%; height: 350px; overflow: hidden; background: #f3e8ff; display: flex; align-items: center; justify-content: center;">
                            <?php if (!empty($m['imagen'])): ?>
                        <img src="<?php echo htmlspecialchars($m['imagen']); ?>" alt="<?php echo htmlspecialchars($m['nombre']); ?>" style="max-width: 100%; max-height: 100%; object-fit: contain;">
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
                        <button class="btn-tarjeta-contacto">Contactar Fundación 🐾</button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- SECCIÓN DONACIONES -->
    <section id="donar">
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