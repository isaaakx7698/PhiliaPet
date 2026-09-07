<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PhiliaPet 🐾 - Proceso de Adopción</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body style="background: #f8fafc; font-family: sans-serif; margin: 0;">

    <!-- Barra superior -->
    <header style="background: #4c1d95; color: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center;">
        <h2 style="margin: 0;">🐾 PhiliaPet - Adopciones</h2>
        <a href="index.php?action=inicio" style="color: white; text-decoration: none; font-weight: bold;">← Volver al Inicio</a>
    </header>

    <div style="max-width: 1200px; margin: 30px auto; padding: 0 20px;">
        <div style="text-align: center; margin-bottom: 30px;">
            <h2 style="color: #4c1d95;">¡Encuentra a tu compañero ideal! ❤️</h2>
            <p style="color: #64748b;">Selecciona al peludito para ver su historia completa, contactar a la fundación y realizar el proceso de adopción.</p>
        </div>

        <div class="grid-mascotas">
            <?php if (empty($mascotas)): ?>
                <p style="text-align: center; color: #64748b; grid-column: 1 / -1;">No hay peluditos disponibles en este momento. ¡Vuelve pronto!</p>
            <?php else: ?>
                <?php foreach ($mascotas as $index => $m): ?>
                    <div class="tarjeta-peludito <?php echo ($index % 2 == 0) ? 'card-lavanda' : 'card-menta'; ?>">
                        <span class="badge-adopcion"><?php echo htmlspecialchars($m['estado_salud']); ?> ✨</span>
                        
                        <!-- Contenedor de la foto con object-fit: contain para que no se corte -->
                        <div class="contenedor-foto" style="width: 100%; height: 200px; overflow: hidden; background: #f3e8ff; display: flex; align-items: center; justify-content: center;">
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
                            
                            <!-- Botón para ver detalles y contactar a la fundación -->
                            <div style="margin-top: 15px;">
                                <a href="index.php?action=detalle_adopcion&id=<?php echo $m['id_mascota']; ?>" 
                                   style="display: block; text-align: center; background: #7c3aed; color: white; padding: 10px; border-radius: 8px; text-decoration: none; font-weight: bold;">
                                   🔍 Ver Más e Informes
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

</body>
</html>