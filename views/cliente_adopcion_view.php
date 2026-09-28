<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PhiliaPet 🐾 - Proceso de Adopción</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        :root {
            --primary-color: #2C6B56; /* Verde bosque profesional y cálido */
            --primary-dark: #1E4D3E;
            --accent-color: #E07A5F; /* Coral cálido para llamadas a la acción */
            --bg-light: #F4F7F6;
            --text-main: #2D3748;
            --text-muted: #718096;
        }

        body {
            background: var(--bg-light);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            color: var(--text-main);
        }

        /* Barra superior renovada */
        header {
            background: var(--primary-color) !important;
            color: white;
            padding: 18px 35px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        header a {
            color: white;
            text-decoration: none;
            font-weight: 600;
            transition: opacity 0.2s;
        }

        header a:hover {
            opacity: 0.85;
        }

        .contenedor-principal {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .titulo-seccion h2 {
            color: var(--primary-dark);
            font-size: 2rem;
            margin-bottom: 8px;
        }

        .titulo-seccion p {
            color: var(--text-muted);
            font-size: 1.05rem;
        }

        /* Tarjetas de mascotas con estilo limpio y elegante */
        .grid-mascotas {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
            margin-top: 30px;
        }

        .tarjeta-peludito {
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            border: 1px solid #e2e8f0;
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .tarjeta-peludito:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }

        .badge-adopcion {
            position: absolute;
            top: 12px;
            right: 12px;
            background: rgba(255, 255, 255, 0.9);
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: bold;
            color: var(--primary-dark);
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        .cuerpo-tarjeta {
            padding: 20px;
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
            color: var(--primary-dark);
            font-size: 1.3rem;
        }

        .tag-propiedad {
            background: #edf2f7;
            padding: 3px 8px;
            border-radius: 6px;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-muted);
        }

        .detalles {
            color: var(--text-muted);
            font-size: 0.95rem;
            line-height: 1.4;
            margin-bottom: 20px;
        }

        /* Botón de acción principal */
        .btn-ver-mas {
            display: block;
            text-align: center;
            background: var(--accent-color);
            color: white;
            padding: 12px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            transition: background 0.2s;
        }

        .btn-ver-mas:hover {
            background: #c96548;
        }

        /* Sección nueva recomendada: Historias de Éxito / Finales Felices */
        .seccion-historias {
            margin-top: 60px;
            background: #ffffff;
            border-radius: 16px;
            padding: 35px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            border: 1px solid #e2e8f0;
        }

        .seccion-historias h3 {
            color: var(--primary-dark);
            margin-top: 0;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .aviso-historial {
            background: #edf7ed;
            border-left: 4px solid var(--primary-color);
            padding: 15px;
            border-radius: 0 8px 8px 0;
            color: var(--primary-dark);
            font-size: 0.95rem;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <!-- Barra superior -->
    <header>
        <h2 style="margin: 0; font-size: 1.4rem;">🐾 PhiliaPet - Adopciones</h2>
        <a href="index.php?action=inicio">← Volver al Inicio</a>
    </header>

    <div class="contenedor-principal">
        <div class="titulo-seccion" style="text-align: center; margin-bottom: 40px;">
            <h2>¡Encuentra a tu compañero ideal! ❤️</h2>
            <p>Selecciona al peludito para ver su historia completa, contactar a la fundación y realizar el proceso de adopción.</p>
        </div>

        <div class="grid-mascotas">
            <?php if (empty($mascotas)): ?>
                <p style="text-align: center; color: var(--text-muted); grid-column: 1 / -1;">No hay peluditos disponibles en este momento. ¡Vuelve pronto!</p>
            <?php else: ?>
                <?php foreach ($mascotas as $index => $m): ?>
                    <div class="tarjeta-peludito">
                        <span class="badge-adopcion"><?php echo htmlspecialchars($m['estado_salud']); ?> ✨</span>
                        
                        <!-- Contenedor de la foto -->
                        <div class="contenedor-foto" style="width: 100%; height: 210px; overflow: hidden; background: #e2e8f0; display: flex; align-items: center; justify-content: center;">
                            <?php if (!empty($m['imagen'])): ?>
                                <img src="<?php echo htmlspecialchars($m['imagen']); ?>" alt="<?php echo htmlspecialchars($m['nombre']); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                            <?php else: ?>
                                <div style="font-size: 3.5rem;">
                                    <?php echo ($m['especie'] == 'gato') ? '🐱' : '🐶'; ?>
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

        <!-- Espacio reservado para la sección de comentarios / finales felices que propusiste -->
        <div class="seccion-historias">
            <h3>🏠 Finales Felices (Comentarios de Adoptantes)</h3>
            <div class="aviso-historial">
                💡 <strong>Nota:</strong> Esta sección está habilitada exclusivamente para usuarios que ya completaron su proceso de adopción en PhiliaPet, permitiéndoles compartir fotos y experiencias de sus nuevos peluditos en casa.
            </div>
            <p style="color: var(--text-muted); font-style: italic; text-align: center; margin: 30px 0;">
                Próximamente se mostrarán aquí los testimonios y comentarios de nuestros adoptantes felices. ¡Sé el primero en adoptar!
            </p>
        </div>
    </div>

</body>
</html>