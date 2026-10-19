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
    
    <style>
        /* ESTILOS DEL NUEVO HEADER EN TIERRA LILA / DIFUMINADO */
        header {
            background: linear-gradient(135deg, rgba(237, 233, 254, 0.85), rgba(221, 214, 254, 0.75));
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 2px solid rgba(196, 181, 253, 0.6);
            padding: 12px 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 4px 20px rgba(109, 40, 217, 0.08);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .logo-animado {
            font-size: 1.5rem;
            font-weight: 800;
            color: #1e1b4b;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        header nav {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        /* BOTONES COMPACTOS, DIFUMINADOS Y ESTILIZADOS */
        header nav a.nav-link, 
        .btn-perfil-header {
            background: rgba(255, 255, 255, 0.65);
            backdrop-filter: blur(6px);
            border: 1.5px solid rgba(196, 181, 253, 0.8);
            color: #312e81;
            padding: 7px 14px;
            border-radius: 30px;
            font-size: 0.88rem;
            font-weight: 700;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s ease;
            box-shadow: 0 2px 6px rgba(109, 40, 217, 0.05);
        }

        /* EFECTO HOVER: SE OSCURECE Y ELEVA LEVEMENTEMENTE */
        header nav a.nav-link:hover, 
        .btn-perfil-header:hover {
            background: rgba(221, 214, 254, 0.9);
            border-color: #8b5cf6;
            color: #3b0764;
            transform: translateY(-1px);
            box-shadow: 0 4px 10px rgba(109, 40, 217, 0.15);
        }

        /* FOTO DE PERFIL EN CÍRCULO ESTILO INSTAGRAM */
        .foto-header-circulo {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            overflow: hidden;
            border: 2px solid #7c3aed;
            background: #ede9fe;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .foto-header-circulo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* MENÚ DESPLEGABLE */
        .dropdown-usuario, .dropdown-fundaciones {
            position: relative;
            display: inline-block;
        }

        .dropdown-usuario .dropdown-content,
        .dropdown-fundaciones .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            top: 105%;
            background-color: #ffffff;
            min-width: 180px;
            box-shadow: 0 10px 25px rgba(109, 40, 217, 0.15);
            border-radius: 14px;
            padding: 6px 0;
            z-index: 1000;
            border: 1px solid #e9d5ff;
        }

        .dropdown-usuario:hover .dropdown-content,
        .dropdown-fundaciones:hover .dropdown-content {
            display: block;
        }

        .dropdown-usuario .dropdown-content a,
        .dropdown-fundaciones .dropdown-content a {
            color: #312e81 !important;
            padding: 8px 14px;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.85rem;
            font-weight: 600;
            background: transparent !important;
            border: none !important;
            border-radius: 0 !important;
            box-shadow: none !important;
            transition: background 0.15s ease;
        }

        .dropdown-usuario .dropdown-content a:hover,
        .dropdown-fundaciones .dropdown-content a:hover {
            background-color: #f3e8ff !important;
            color: #6d28d9 !important;
        }
    </style>
</head>
<body>

    <!-- MARQUESINA -->
    <div class="marquesina-contenedor">
        <div class="marquesina-texto">
            🐶 ¡ADOPTA, NO COMPRES! • Próxima jornada en C.C. Gran Estación este Sábado 🎉 • Vacunación gratuita con la Fundación Huellas de Amor 🐱 • ¡Ayúdanos a salvar vidas en Bogotá! ❤️ • 
        </div>
    </div>

    <!-- ENCABEZADO CON DISEÑO LILA DIFUMINADO -->
    <header>
        <div class="logo-animado">
            <span>🐾</span> PhiliaPet <span style="color: #7c3aed;">❤️</span>
        </div>
        <nav>
            <a href="index.php?action=inicio" class="nav-link">🏠 Inicio</a>
            <a href="index.php?action=catalogo_adopcion" class="nav-link">🐾 Adopta</a>
            
            <!-- MENÚ DESPLEGABLE DE FUNDACIONES -->
            <div class="dropdown-fundaciones">
                <a href="#mascotas" class="nav-link">🏢 Fundaciones ▾</a>
                <div class="dropdown-content">
                    <a href="#mascotas">Ver Listado</a>
                    <a href="index.php?action=unir_refugio" style="color: #6d28d9 !important; font-weight: bold;">🐾 Unir mi Refugio</a>
                </div>
            </div>

            <a href="index.php?action=calendario" class="nav-link">📅 Calendario</a>
            <a href="#donar" class="nav-link">🎁 Donar</a>

            <!-- MENÚ DE USUARIO ESTILO INSTAGRAM -->
            <?php if (isset($_SESSION['rol'])): ?>
                
                <div class="dropdown-usuario">
                    <a href="#" class="btn-perfil-header">
                        <div class="foto-header-circulo">
                            <?php if (!empty($_SESSION['foto'])): ?>
                                <img src="<?php echo htmlspecialchars($_SESSION['foto']); ?>" alt="Foto de perfil">
                            <?php else: ?>
                                <span style="font-size: 0.95rem;">👤</span>
                            <?php endif; ?>
                        </div>
                        <span><?php echo htmlspecialchars($_SESSION['nombre'] ?? 'Mi Cuenta'); ?> ▾</span>
                    </a>

                    <div class="dropdown-content">
                        <?php if ($_SESSION['rol'] === 'adoptante'): ?>
                            <a href="index.php?action=perfil_adoptante">👤 Mi Perfil</a>
                        <?php elseif ($_SESSION['rol'] === 'refugio'): ?>
                            <a href="index.php?action=panel_refugio">⚙️ Panel Refugio</a>
                            <a href="index.php?action=perfil_adoptante">👤 Mi Perfil</a>
                        <?php elseif ($_SESSION['rol'] === 'admin'): ?>
                            <a href="index.php?action=panel_admin">🛡️ Panel Admin</a>
                            <a href="index.php?action=perfil_adoptante">👤 Mi Perfil</a>
                        <?php endif; ?>
                        
                        <div style="border-top: 1px solid #f3e8ff; margin: 3px 0;"></div>
                        <a href="index.php?action=logout" style="color: #ef4444 !important; font-weight: 700;">🚪 Cerrar Sesión</a>
                    </div>
                </div>

            <?php else: ?>
                <!-- VISITANTES SIN INICIAR SESIÓN -->
                <a href="index.php?action=registro" class="nav-link">Registrarse</a>
                <a href="index.php?action=login" class="nav-link" style="color: #6d28d9; font-weight: bold;">Ingresar</a>
            <?php endif; ?>
        </nav>
    </header>

    <!-- HERO SECTION -->
    <section id="inicio" class="hero-section">
        <div class="hero-contenido">
            <span class="badge-alerta">✨ Red de Apoyo de Bogotá ✨</span>
            <h1>🐶¡Cambia una vida y llena la tuya de puro amor! 🐱</h1>
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
                            
                            <!-- CAJITA INFORMATIVA -->
                            <div class="fundacion-info">
                                <p style="margin: 0 0 4px 0;">🏢 <strong>Fundación:</strong> Huellas & Patitas</p>
                                <p style="margin: 0;">📞 Redes y contacto verificado</p>
                            </div>

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