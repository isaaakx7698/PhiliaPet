<?php
// Capturamos los filtros actuales de la URL
$especie_sel = isset($_GET['especie']) ? $_GET['especie'] : '';
$edad_sel = isset($_GET['edad']) ? $_GET['edad'] : '';

// Nivel de profundidad para asignar la clase de colores temáticos
$clase_nivel = 'nivel-inicio'; // Nivel 1: Lila
if (!empty($especie_sel) && empty($edad_sel)) {
    $clase_nivel = 'nivel-especie'; // Nivel 2: Azul
} elseif (!empty($especie_sel) && !empty($edad_sel)) {
    $clase_nivel = 'nivel-resultado'; // Nivel 3: Multicolor / Cálido
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PhiliaPet 🐾 - Catálogo de Adopción</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        /* 1. PALETA POR DEFECTO: MORADO / LILA PASTEL (Nivel 1 - Inicio) */
        :root {
            --theme-main: #5f3370;
            --theme-dark: #452b6e;
            --theme-light: #f3e8ff;
            --theme-soft: #faf5ff;
            --theme-border: #ddd6fe;
            --text-main: #421b58cc;
            --text-muted: #6b21a8;

            --bg-gradient: linear-gradient(135deg, #f5f3ff 0%, #ede9fe 50%, #fae8ff 100%);
        }

        /* 2. CAMBIO A AZUL CIELO PASTEL (Nivel 2 - Elección de Especie) */
        body.nivel-especie {
            --theme-main: #4c89a5;
            --theme-dark: #0284c7;
            --theme-light: #e0f2fe;
            --theme-soft: #f0f9ff;
            --theme-border: #bae6fd;
            --text-main: #0c4a6e;
            --text-muted: #0369a1;

            --bg-gradient: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 50%, #e0e7ff 100%);
        }

        /* 3. CAMBIO A MULTICOLOR / CORAL & AMARILLO WARM (Nivel 3 - Ver Mascotas) */
        body.nivel-resultado {
            --theme-main: #dd662e;
            --theme-dark: #bb4813;
            --theme-light: #ffedd5;
            --theme-soft: #fff7ed;
            --theme-border: #fed7aa;
            --text-main: #7c2d12;
            --text-muted: #c2410c;

            --bg-gradient: linear-gradient(135deg, #fff7ed 0%, #fef3c7 50%, #ffe4e6 100%);
        }

        body {
            background: var(--bg-gradient);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            color: var(--text-main);
            min-height: 100vh;
            transition: background 0.6s ease, color 0.4s ease;
            background-attachment: fixed;
        }

        /* Header Dinámico Glassmorphism */
        header {
            background: rgba(255, 255, 255, 0.88) !important;
            backdrop-filter: blur(12px);
            border-bottom: 2px solid var(--theme-border);
            padding: 16px 35px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            transition: border-color 0.4s ease;
        }

        header h2 {
            margin: 0;
            font-size: 1.4rem;
            color: var(--theme-dark);
            font-weight: 800;
            transition: color 0.4s ease;
        }

        header a {
            color: var(--theme-dark);
            text-decoration: none;
            font-weight: 700;
            background: #ffffff;
            padding: 8px 18px;
            border-radius: 20px;
            transition: all 0.25s ease;
            border: 2px solid var(--theme-border);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        header a:hover {
            background: var(--theme-light);
            border-color: var(--theme-main);
            transform: translateY(-2px);
        }

        .contenedor-principal {
            max-width: 1000px;
            margin: 35px auto;
            padding: 0 20px;
        }

        /* Encabezado Principal */
        .encabezado-adopta {
            text-align: center;
            margin-bottom: 30px;
        }

        .encabezado-adopta h1 {
            color: var(--theme-dark);
            font-size: 2.3rem;
            font-weight: 800;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
            transition: color 0.4s ease;
        }

        .encabezado-adopta p {
            color: var(--text-muted);
            font-size: 1.05rem;
            margin: 0;
            font-weight: 500;
            transition: color 0.4s ease;
        }

        /* TARJETA DE PASOS PRINCIPAL */
        .seccion-seleccion {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(8px);
            border-radius: 30px;
            padding: 35px 30px;
            text-align: center;
            border: 3px solid var(--theme-border);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
            transition: all 0.4s ease;
        }

        /* Modo grande cuando está en el paso "Elige la etapa" */
        .seccion-seleccion.modo-etapa-grande {
            padding: 60px 35px;
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.08);
        }

        .titulo-paso {
            font-size: 1.55rem;
            color: var(--theme-dark);
            font-weight: 800;
            margin-bottom: 25px;
            transition: color 0.4s ease;
        }

        .modo-etapa-grande .titulo-paso {
            font-size: 1.9rem;
            margin-bottom: 32px;
        }

        /* Tarjetas de Especies (Perros y Gatos) - HOVER SUAVE SIN COLOR SÓLIDO */
        .grid-tarjetas-especie {
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
        }

        .card-especie {
            background: #ffffff;
            border: 3px solid var(--theme-border);
            border-radius: 24px;
            padding: 25px 45px;
            text-decoration: none;
            color: var(--text-main);
            font-size: 1.35rem;
            font-weight: 800;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.04);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 14px;
            min-width: 180px;
        }

        .card-especie img.img-ilustracion {
            width: 85px;
            height: 85px;
            object-fit: contain;
            transition: transform 0.3s ease;
        }

        .card-especie:hover {
            background: var(--theme-soft);
            color: var(--theme-dark);
            border-color: var(--theme-main);
            transform: translateY(-6px) scale(1.02);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08);
        }

        .card-especie:hover img.img-ilustracion {
            transform: scale(1.12);
        }

        /* Botones de Etapas de Edad */
        .grid-edades {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
            margin-top: 15px;
        }

        .modo-etapa-grande .grid-edades {
            gap: 25px;
        }

        .btn-filtro-edad {
            background: #ffffff;
            border: 2px solid var(--theme-border);
            border-radius: 20px;
            padding: 14px 30px;
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--theme-dark);
            text-decoration: none;
            transition: all 0.25s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        }

        .modo-etapa-grande .btn-filtro-edad {
            padding: 18px 40px;
            font-size: 1.2rem;
            border-radius: 24px;
            border-width: 3px;
        }

        .btn-filtro-edad:hover, .btn-filtro-edad.activo {
            background: var(--theme-main);
            color: white;
            border-color: var(--theme-main);
            transform: translateY(-3px);
            box-shadow: 0 8px 22px rgba(0, 0, 0, 0.15);
        }

        .btn-volver-especies {
            display: inline-block;
            margin-bottom: 20px;
            color: var(--theme-dark);
            text-decoration: none;
            font-weight: 700;
            background: #ffffff;
            padding: 9px 20px;
            border-radius: 14px;
            font-size: 0.9rem;
            border: 2px solid var(--theme-border);
            box-shadow: 0 2px 10px rgba(0,0,0,0.03);
            transition: all 0.2s ease;
        }

        .btn-volver-especies:hover {
            background: var(--theme-light);
            border-color: var(--theme-main);
        }

        /* GRILLA DE MASCOTAS */
        .grid-mascotas {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
            margin-top: 30px;
            margin-bottom: 45px;
        }

        .tarjeta-peludito {
            background: white;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            border: 2px solid var(--theme-border);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .tarjeta-peludito:hover {
            transform: translateY(-6px);
            box-shadow: 0 18px 40px rgba(0, 0, 0, 0.14);
        }

        .badge-adopcion {
            position: absolute;
            top: 14px;
            right: 14px;
            background: rgba(255, 255, 255, 0.95);
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 800;
            color: var(--theme-dark);
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
        }

        .cuerpo-tarjeta {
            padding: 22px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
            justify-content: space-between;
        }

        .encabezado-tarjeta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .encabezado-tarjeta h3 {
            margin: 0;
            color: var(--text-main);
            font-size: 1.35rem;
            font-weight: 800;
        }

        .tag-propiedad {
            background: var(--theme-light);
            padding: 4px 10px;
            border-radius: 10px;
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--theme-dark);
        }

        .detalles {
            color: #4b4453;
            font-size: 0.93rem;
            line-height: 1.5;
            margin-bottom: 20px;
        }

        .btn-ver-mas {
            display: block;
            text-align: center;
            background: var(--theme-main);
            color: white;
            padding: 12px;
            border-radius: 14px;
            text-decoration: none;
            font-weight: 700;
            font-size: 0.98rem;
            transition: all 0.25s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .btn-ver-mas:hover {
            background: var(--theme-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.2);
        }

        /* TARJETA DE AYUDA */
        .seccion-ayuda {
            background: linear-gradient(135deg, var(--theme-main) 0%, var(--theme-dark) 100%);
            color: white;
            border-radius: 24px;
            padding: 24px 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
            flex-wrap: wrap;
            transition: background 0.4s ease;
        }

        .seccion-ayuda h3 {
            margin: 0 0 5px 0;
            font-size: 1.25rem;
        }

        .seccion-ayuda p {
            margin: 0;
            font-size: 0.92rem;
            opacity: 0.95;
        }

        .btn-ayuda-contacto {
            background: white;
            color: var(--theme-dark);
            padding: 11px 22px;
            border-radius: 16px;
            text-decoration: none;
            font-weight: 800;
            font-size: 0.92rem;
            transition: all 0.25s ease;
            white-space: nowrap;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .btn-ayuda-contacto:hover {
            background: var(--theme-soft);
            transform: scale(1.04);
        }

        /* TESTIMONIOS (SÓLO INICIO) */
        .seccion-historias {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 24px;
            padding: 25px 30px;
            border: 3px solid var(--theme-border);
            margin-top: 30px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.04);
        }

        .seccion-historias h3 {
            color: var(--theme-dark);
            margin-top: 0;
            font-size: 1.25rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .aviso-historial {
            background: var(--theme-light);
            border-left: 4px solid var(--theme-main);
            padding: 12px 18px;
            border-radius: 0 12px 12px 0;
            color: var(--text-main);
            font-size: 0.9rem;
        }
    </style>
</head>
<body class="<?php echo $clase_nivel; ?>">

    <!-- Header -->
    <header>
        <h2>🐾 PhiliaPet - Adopciones</h2>
        <a href="index.php?action=inicio">← Volver al Inicio</a>
    </header>

    <div class="contenedor-principal">

        <!-- ENCABEZADO PRINCIPAL -->
        <div class="encabezado-adopta">
            <h1>Encuentra a tu compañero ideal ✨</h1>
            <p>Cada uno de ellos tiene una historia única y está esperando un hogar lleno de amor en Bogotá.</p>
        </div>

        <!-- PASO 1: SELECCIÓN DE ESPECIE (Nivel 1 - Morado/Lila) -->
        <?php if (empty($especie_sel)): ?>
            
            <div class="seccion-seleccion">
                <div class="titulo-paso">¿A quién estás buscando hoy? 💜</div>
                <div class="grid-tarjetas-especie">
                    <a href="index.php?action=catalogo_adopcion&especie=perro" class="card-especie">
                        <img src="assets/img/icono-perro.png" onerror="this.onerror=null; this.src='https://cdn-icons-png.flaticon.com/512/616/616408.png';" alt="Perros" class="img-ilustracion">
                        Perros
                    </a>
                    <a href="index.php?action=catalogo_adopcion&especie=gato" class="card-especie">
                        <img src="assets/img/icono-gato.png" onerror="this.onerror=null; this.src='https://cdn-icons-png.flaticon.com/512/616/616430.png';" alt="Gatos" class="img-ilustracion">
                        Gatos
                    </a>
                </div>
            </div>

            <!-- TARJETA DE AYUDA -->
            <div class="seccion-ayuda">
                <div>
                    <h3>¿Tienes dudas sobre el proceso de adopción? 💬</h3>
                    <p>Nuestro equipo y las fundaciones aliadas te ayudan a orientarte según tu espacio y tiempo.</p>
                </div>
                <a href="index.php?action=contacto" class="btn-ayuda-contacto">Pedir Asistencia 🐾</a>
            </div>

            <!-- TESTIMONIOS Y FINALES FELICES -->
            <div class="seccion-historias">
                <h3>🏠 Finales Felices (Comentarios de Adoptantes)</h3>
                <div class="aviso-historial">
                    💡 <strong>Nota:</strong> Esta sección está habilitada exclusivamente para usuarios que ya completaron su proceso de adopción en PhiliaPet.
                </div>
                <p style="color: var(--text-muted); font-style: italic; text-align: center; margin: 15px 0 0 0; font-size: 0.92rem;">
                    Próximamente se mostrarán aquí las historias y fotos de nuestros adoptantes felices. ¡Sé el primero en adoptar! ✨
                </p>
            </div>

        <!-- PASO 2 Y 3: AL SELECCIONAR ESPECIE O EDAD -->
        <?php else: ?>
            
            <!-- Nivel 2: Azul Pastel cuando no hay edad elegida aún (modo-etapa-grande) -->
            <div class="seccion-seleccion <?php echo empty($edad_sel) ? 'modo-etapa-grande' : ''; ?>">
                <a href="index.php?action=catalogo_adopcion" class="btn-volver-especies">← Cambiar de especie</a>
                <div class="titulo-paso">
                    <?php echo ($especie_sel === 'perro') ? '🐶 Elige la etapa de tu perrito' : '🐱 Elige la etapa de tu gatito'; ?> 🩵
                </div>
                
                <div class="grid-edades">
                    <a href="index.php?action=catalogo_adopcion&especie=<?php echo $especie_sel; ?>&edad=cachorro" 
                       class="btn-filtro-edad <?php echo ($edad_sel === 'cachorro') ? 'activo' : ''; ?>">
                       🍼 Cachorros
                    </a>
                    <a href="index.php?action=catalogo_adopcion&especie=<?php echo $especie_sel; ?>&edad=joven" 
                       class="btn-filtro-edad <?php echo ($edad_sel === 'joven') ? 'activo' : ''; ?>">
                       🎾 Jóvenes
                    </a>
                    <a href="index.php?action=catalogo_adopcion&especie=<?php echo $especie_sel; ?>&edad=adulto" 
                       class="btn-filtro-edad <?php echo ($edad_sel === 'adulto') ? 'activo' : ''; ?>">
                       🛋️ Adultos
                    </a>
                </div>
            </div>

            <!-- Nivel 3: Multicolor / Warm Coral al mostrar Mascotas -->
            <?php if (!empty($edad_sel)): ?>
                <div class="grid-mascotas">
                    <?php if (!isset($mascotas) || empty($mascotas)): ?>
                        <p style="text-align: center; color: var(--theme-dark); grid-column: 1 / -1; font-weight: 700; font-size: 1.1rem; padding: 40px;">
                            No hay peluditos registrados en esta etapa por ahora. ¡Intenta con otra opción o vuelve pronto! 🐾
                        </p>
                    <?php else: ?>
                        <?php foreach ($mascotas as $m): ?>
                            <div class="tarjeta-peludito">
                                <span class="badge-adopcion"><?php echo htmlspecialchars($m['estado_salud']); ?> ✨</span>
                                
                                <div class="contenedor-foto" style="width: 100%; height: 210px; overflow: hidden; background: #fff7ed; display: flex; align-items: center; justify-content: center;">
                                    <?php if (!empty($m['imagen'])): ?>
                                        <img src="<?php echo htmlspecialchars($m['imagen']); ?>" alt="<?php echo htmlspecialchars($m['nombre']); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                                    <?php else: ?>
                                        <div style="font-size: 3.5rem;">
                                            <?php echo (isset($m['especie']) && $m['especie'] == 'gato') ? '🐱' : '🐶'; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="cuerpo-tarjeta">
                                    <div>
                                        <div class="encabezado-tarjeta">
                                            <h3><?php echo htmlspecialchars($m['nombre']); ?></h3>
                                            <span class="tag-propiedad">
                                                <?php echo htmlspecialchars($m['edad_aproximada']); ?>
                                            </span>
                                        </div>
                                        <p class="detalles"><?php echo htmlspecialchars($m['historia']); ?></p>
                                    </div>
                                    
                                    <div>
                                        <a href="index.php?action=detalle_adopcion&id=<?php echo $m['id_mascota']; ?>" class="btn-ver-mas">
                                            🔍 Ver Más e Informes
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <p style="text-align: center; color: var(--theme-dark); font-weight: 700; font-size: 1.1rem; margin: 35px 0;">
                    👇 Selecciona una etapa de vida arriba para ver los peluditos disponibles.
                </p>
            <?php endif; ?>

        <?php endif; ?>

    </div>

</body>
</html>