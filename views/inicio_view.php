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
        /* MENÚ DESPLEGABLE CORREGIDO PARA QUE NO SE SALGA */
        .dropdown-usuario {
            position: relative;
            display: inline-block;
        }

        .dropdown-usuario .dropdown-content {
            display: none;
            position: absolute;
            right: 0; /* Anclado al borde derecho del contenedor */
            left: auto;
            top: 110%;
            background-color: #ffffff;
            min-width: 190px;
            box-shadow: 0 10px 25px rgba(109, 40, 217, 0.18);
            border-radius: 14px;
            padding: 6px 0;
            z-index: 9999;
            border: 1px solid #e9d5ff;
        }

        .dropdown-usuario:hover .dropdown-content {
            display: block;
        }

        .dropdown-usuario .dropdown-content a {
            color: #312e81 !important;
            padding: 9px 16px;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.85rem;
            font-weight: 600;
            background: transparent !important;
            border: none !important;
            box-shadow: none !important;
        }

        .dropdown-usuario .dropdown-content a:hover {
            background-color: #f3e8ff !important;
            color: #6d28d9 !important;
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
            width: 50px;
            height: 50px;
            border-radius: 50%;
            overflow: hidden;
            border: 2px solid #7c3aed;
            background: #ede9fe;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .foto-header-circulo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        }

        .foto-header-circulo:hover {
            transform: scale(1.08);
            box-shadow: 0 4px 12px rgba(124, 58, 237, 0.3);
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

        /* ESTILOS SECCIÓN QUIÉNES SOMOS */
        .seccion-quienes-somos {
            padding: 30px 20px;
            max-width: 850px;
            margin: 40px auto;
        }

        .tarjeta-quienes-somos {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            border: 2px dashed #c4b5fd;
            border-radius: 24px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(109, 40, 217, 0.08);
        }

        .tarjeta-quienes-somos h2 {
            color: #5b21b6;
            font-size: 1.5rem;
            font-weight: 800;
            margin-bottom: 10px;
        }

        .tarjeta-quienes-somos p {
            color: #4b5563;
            font-size: 0.95rem;
            margin-bottom: 25px;
        }

        .equipo-grid-pagina {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-top: 20px;
        }

        .miembro-equipo {
            background: #fcf8ff;
            border: 1.5px solid #e9d5ff;
            border-radius: 18px;
            padding: 20px 15px;
            box-shadow: 0 4px 12px rgba(109, 40, 217, 0.05);
            transition: transform 0.2s ease;
        }

        .miembro-equipo:hover {
            transform: translateY(-3px);
            border-color: #8b5cf6;
        }

        .miembro-foto-container {
            width: 85px;
            height: 85px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto 12px auto;
            border: 2.5px solid #7c3aed;
            background: #ede9fe;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .miembro-foto-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .miembro-equipo h3 {
            color: #312e81;
            font-size: 1rem;
            font-weight: 700;
            margin: 0 0 4px 0;
        }

        .miembro-equipo span {
            color: #7c3aed;
            font-size: 0.8rem;
            font-weight: 600;
        }

        /* FOOTER COMPACTO EN TONOS PASTEL */
        footer {
            background: linear-gradient(135deg, #f3e8ff, #ede9fe);
            color: #4c1d95;
            text-align: center;
            padding: 18px 20px 22px 20px;
            margin-top: 25px;
            border-top: 1.5px solid rgba(196, 181, 253, 0.6);
        }

        footer p {
            font-size: 0.95rem;
            margin-bottom: 6px;
            color: #581c87;
            font-weight: 500;
        }

        /* BOTÓN DE TRATAMIENTO DE DATOS */
        .btn-tratamiento-datos {
            background: rgba(255, 255, 255, 0.85);
            color: #6d28d9;
            border: 1.5px solid #c4b5fd;
            padding: 8px 18px;
            border-radius: 22px;
            font-size: 0.88rem;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
            transition: all 0.2s ease;
            box-shadow: 0 3px 8px rgba(109, 40, 217, 0.1);
        }

        .btn-tratamiento-datos:hover {
            background: #ffffff;
            border-color: #8b5cf6;
            color: #5b21b6;
            transform: translateY(-2px);
            box-shadow: 0 5px 12px rgba(124, 58, 237, 0.22);
        }

        /* VENTANA MODAL */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(30, 27, 75, 0.5);
            backdrop-filter: blur(5px);
            z-index: 2000;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .modal-content {
            background: #ffffff;
            color: #1e1b4b;
            padding: 30px;
            border-radius: 24px;
            max-width: 520px;
            width: 100%;
            box-shadow: 0 15px 35px rgba(46, 16, 101, 0.25);
            border: 2px solid #ede9fe;
            text-align: left;
            position: relative;
            animation: modalEntrada 0.25s ease-out;
        }

        @keyframes modalEntrada {
            from { transform: translateY(15px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .modal-content h3 {
            color: #5b21b6;
            font-size: 1.25rem;
            font-weight: 800;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .modal-content p {
            font-size: 0.92rem;
            color: #4b5563;
            line-height: 1.6;
            margin-bottom: 25px;
        }

        .btn-cerrar-modal {
            background: #7c3aed;
            color: #ffffff;
            border: none;
            padding: 10px 22px;
            border-radius: 14px;
            font-weight: 700;
            font-size: 0.88rem;
            cursor: pointer;
            display: block;
            width: 100%;
            transition: background 0.2s ease;
        }

        .btn-cerrar-modal:hover {
            background: #6d28d9;
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

            <!-- MENÚ DE USUARIO CON SÓLO LA FOTO Y DROPDOWN AL HOVER -->
             
        <?php if (isset($_SESSION['rol'])): ?>
        
            <div class="dropdown-usuario">
                   <?php 
                $foto_usuario = $_SESSION['foto'] ?? $_SESSION['imagen'] ?? $_SESSION['foto_perfil'] ?? '';
                if (!empty($foto_usuario) && !str_starts_with($foto_usuario, 'assets/')) {
                    $foto_usuario = 'assets/img/perfiles/' . ltrim($foto_usuario, '/');
                }
            ?>
            <?php if (!empty($foto_usuario)): ?>
                <img src="<?php echo htmlspecialchars($foto_usuario); ?>" alt="Foto de perfil" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; display: block;">
            <?php else: ?>
                <span style="font-size: 1.1rem;">👤</span>
            <?php endif; ?>

                    <div class="dropdown-content">
                        <div style="padding: 8px 14px; font-size: 0.78rem; color: #6d28d9; font-weight: 800; border-bottom: 1px solid #f3e8ff;">
                            Hola, <?php echo htmlspecialchars($_SESSION['nombre'] ?? 'Usuario'); ?>
                        </div>

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
            <h1>🐶 ¡Cambia una vida y llena la tuya de puro amor! 🐱</h1>
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

    <!-- SECCIÓN QUIÉNES SOMOS (CON ISAMAR, ANA MARÍA Y SUSAN) -->
    <section id="quienes-somos" class="seccion-quienes-somos">
        <div class="tarjeta-quienes-somos">
            <h2>👥 Quiénes Somos</h2>
            <p>Los integrantes del equipo creador y desarrollador de PhiliaPet somos:</p>
            
            <div class="equipo-grid-pagina">
                <!-- Isamar -->
                <div class="miembro-equipo">
                    <div class="miembro-foto-container">
                        <img src="assets/img/isamar.jpeg" alt="Isamar" onerror="this.onerror=null; this.parentElement.innerHTML='<span style=\'font-size:2rem;\'>👩‍💻</span>';">
                    </div>
                    <h3>Isamar</h3>
                    <span>Desarrolladora</span>
                </div>

                <!-- Ana María -->
                <div class="miembro-equipo">
                    <div class="miembro-foto-container">
                        <img src="assets/img/anamaria.jpg" alt="Ana María" onerror="this.onerror=null; this.parentElement.innerHTML='<span style=\'font-size:2rem;\'>👩‍💻</span>';">
                    </div>
                    <h3>Ana María</h3>
                    <span>Desarrolladora</span>
                </div>

                <!-- Susan -->
                <div class="miembro-equipo">
                    <div class="miembro-foto-container">
                        <img src="assets/img/susan.jpeg" alt="Susan" onerror="this.onerror=null; this.parentElement.innerHTML='<span style=\'font-size:2rem;\'>👩‍💻</span>';">
                    </div>
                    <h3>Susan</h3>
                    <span>Desarrolladora</span>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER CON BOTÓN DE TRATAMIENTO DE DATOS -->
    <footer>
        <p><strong>PhiliaPet</strong> — Transformando el futuro de los refugios de Bogotá 🐾</p>
        <p>&copy; 2026 Conectando corazones peluditos con total responsabilidad.</p>
        
        <button class="btn-tratamiento-datos" onclick="abrirModalDatos()">
            🔒 Tratamiento de datos
        </button>
    </footer>

    <!-- VENTANA MODAL DE TRATAMIENTO DE DATOS -->
    <div id="modalTratamiento" class="modal-overlay">
        <div class="modal-content">
            <h3>🔒 Tratamiento de Datos Personales</h3>
            <p>El presente proyecto tiene fines exclusivamente académicos. Los datos utilizados durante el desarrollo, las pruebas y la demostración del sistema son ficticios y fueron creados únicamente con fines de simulación. El sistema no recolecta, almacena ni procesa datos personales reales de estudiantes, docentes o terceros.</p>
            <button class="btn-cerrar-modal" onclick="cerrarModalDatos()">Entendido ✨</button>
        </div>
    </div>

    <!-- SCRIPT DE LA MODAL -->
    <script>
        function abrirModalDatos() {
            document.getElementById('modalTratamiento').style.display = 'flex';
        }

        function cerrarModalDatos() {
            document.getElementById('modalTratamiento').style.display = 'none';
        }

        // Cerrar modal haciendo clic fuera de la cajita blanca
        window.onclick = function(event) {
            let modal = document.getElementById('modalTratamiento');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }
    </script>

</body>
</html>