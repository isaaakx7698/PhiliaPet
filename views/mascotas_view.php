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
            <a href="index.php?action=inicio" class="nav-link">Inicio</a>
            <a href="#mascotas" class="nav-link activo">Panel Admin</a>
            <a href="index.php?action=catalogo_adopcion" class="nav-link">🏠 Catálogo Adopciones</a>
        </nav>
    </header>

    <!-- HERO SECTION -->
    <section id="inicio" class="hero-section">
        <div class="hero-contenido">
            <span class="badge-alerta">✨ Red de Apoyo de Bogotá ✨</span>
            <h1>Panel de Administración - PhiliaPet 🐾</h1>
            <h2>Mascotas Registradas en el Sistema 🐾</h2>
        </div>
    </section>

    <div style="max-width: 1200px; margin: 30px auto; padding: 0 20px;">
        <div class="grid-mascotas">
            <?php if (empty($mascotas)): ?>
                <p style="text-align: center; color: #64748b; grid-column: 1 / -1;">No hay mascotas registradas en el sistema actualmente.</p>
            <?php else: ?>
                <?php foreach ($mascotas as $index => $m): ?>
                    <div class="tarjeta-peludito <?php echo ($index % 2 == 0) ? 'card-lavanda' : 'card-menta'; ?>">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 5px;">
                            <span class="badge-adopcion"><?php echo htmlspecialchars($m['estado_salud']); ?> ✨</span>
                            <!-- Indicador visual del estado de adopción -->
                            <span style="font-size: 0.8em; font-weight: bold; padding: 3px 8px; border-radius: 20px; background: <?php echo ($m['estado_adopcion'] == 'disponible') ? '#dcfce7; color: #166534;' : '#fee2e2; color: #991b1b;'; ?>">
                                <?php echo ucfirst(htmlspecialchars($m['estado_adopcion'])); ?>
                            </span>
                        </div>
                        
                        <div class="contenedor-foto" style="width: 100%; height: 250px; overflow: hidden; background: #f3e8ff; display: flex; align-items: center; justify-content: center;">
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

                            <!-- BOTONES DE ACCIÓN: EDITAR Y ELIMINAR -->
                            <div style="display: flex; gap: 8px; justify-content: center; margin-top: 12px;">
                                <a href="index.php?action=editar_mascota&id=<?php echo $m['id_mascota']; ?>" 
                                   style="background: #0284c7; color: white; padding: 6px 14px; border-radius: 6px; text-decoration: none; font-weight: bold; font-size: 0.9em;">
                                   ✏️ Editar
                                </a>
                                
                                <a href="index.php?action=eliminar_mascota&id=<?php echo $m['id_mascota']; ?>" 
                                   onclick="return confirm('¿Seguro que deseas eliminar a <?php echo htmlspecialchars($m['nombre']); ?>?');" 
                                   style="background: #dc2626; color: white; padding: 6px 14px; border-radius: 6px; text-decoration: none; font-weight: bold; font-size: 0.9em;">
                                   🗑️ Eliminar
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- FORMULARIO INTEGRADO PARA AÑADIR MASCOTA -->
        <div style="background: #ffffff; padding: 25px; border-radius: 20px; max-width: 550px; margin: 40px auto 10px auto; box-shadow: 0 8px 20px rgba(0,0,0,0.06); font-family: sans-serif; border: 2px dashed #c084fc;">
            <h3 style="color: #4c1d95; margin-top: 0; text-align: center;">➕ Añadir Nuevo Peludito al Sistema</h3>
            <form action="index.php?action=guardar_mascota" method="POST">
                <input type="text" name="nombre" placeholder="Nombre de la mascota" required style="width:100%; margin-bottom:12px; padding:10px; border-radius:8px; border:1px solid #ddd; box-sizing: border-box;">
                
                <label style="font-size: 0.9em; color: #4c1d95; font-weight: bold;">Especie:</label>
                <select name="especie" style="width:100%; margin-bottom:12px; padding:10px; border-radius:8px; border:1px solid #ddd; box-sizing: border-box;">
                    <option value="perro">🐶 Perro</option>
                    <option value="gato">🐱 Gato</option>
                </select>

                <input type="text" name="edad_aproximada" placeholder="Edad (ej: 5 meses / 2 años)" required style="width:100%; margin-bottom:12px; padding:10px; border-radius:8px; border:1px solid #ddd; box-sizing: border-box;">
                <input type="text" name="estado_salud" placeholder="Estado de salud (ej: Sana y Lista)" required style="width:100%; margin-bottom:12px; padding:10px; border-radius:8px; border:1px solid #ddd; box-sizing: border-box;">
                
                <label style="font-size: 0.9em; color: #4c1d95; font-weight: bold;">Estado de Adopción Inicial:</label>
                <select name="estado_adopcion" style="width:100%; margin-bottom:12px; padding:10px; border-radius:8px; border:1px solid #ddd; box-sizing: border-box;">
                    <option value="disponible">Disponible</option>
                    <option value="adoptado">Adoptado</option>
                </select>

                <input type="text" name="imagen" placeholder="URL o Ruta de la imagen" required style="width:100%; margin-bottom:12px; padding:10px; border-radius:8px; border:1px solid #ddd; box-sizing: border-box;">
                <textarea name="historia" placeholder="Historia / Descripción breve" required style="width:100%; margin-bottom:12px; padding:10px; border-radius:8px; border:1px solid #ddd; box-sizing: border-box; height:80px;"></textarea>

                <button type="submit" style="background: #4c1d95; color: white; border: none; padding: 12px 20px; border-radius: 10px; cursor: pointer; font-weight: bold; width: 100%;">
                    Guardar Peludito ✨
                </button>
            </form>
        </div>
    </div>

    <!-- FOOTER -->
    <footer>
        <p><strong>PhiliaPet</strong> — Transformando el futuro de los refugios de Bogotá 🐾</p>
        <p>&copy; 2026 Conectando corazones peluditos con total responsabilidad.</p>
    </footer>

</body>
</html>