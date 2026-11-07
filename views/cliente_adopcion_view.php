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
    <title>PhiliaPet - Catálogo de Adopciones</title>
    <link rel="stylesheet" href="assets/css/estilos.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fffbeb;
            margin: 0;
            padding: 20px;
            color: #4c1d95;
        }
        .header-catalogo {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #ffffff;
            padding: 15px 30px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            margin-bottom: 25px;
        }
        .btn-volver {
            text-decoration: none;
            color: #c2410c;
            font-weight: bold;
            background: #ffedd5;
            padding: 8px 16px;
            border-radius: 10px;
            transition: background 0.3s;
        }
        .btn-volver:hover {
            background: #fed7aa;
        }
        .filtros-container {
            background: #ffffff;
            padding: 20px;
            border-radius: 20px;
            text-align: center;
            max-width: 800px;
            margin: 0 auto 35px auto;
            box-shadow: 0 4px 15px rgba(0,0,0,0.04);
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        .grupo-filtros {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 8px;
        }
        .filtros-container a {
            display: inline-block;
            padding: 8px 18px;
            border-radius: 20px;
            text-decoration: none;
            font-weight: bold;
            background: #f3f4f6;
            color: #4b5563;
            transition: all 0.3s;
        }
        .filtros-container a:hover, .filtros-container a.activo {
            background: #f97316;
            color: white;
        }
        .grid-mascotas {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 30px;
            max-width: 1150px;
            margin: 0 auto;
        }
        .tarjeta-mascota {
            background: #ffffff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0,0,0,0.07);
            border: 2px solid #ffedd5;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s;
        }
        .tarjeta-mascota:hover {
            transform: translateY(-5px);
        }
        .contenedor-imagen {
            width: 100%;
            height: 280px;
            background-color: #fff7ed;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        .contenedor-imagen img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .info-tarjeta {
            padding: 20px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }
        .nombre-mascota {
            font-size: 1.4rem;
            font-weight: 800;
            color: #9a3412;
            margin: 0 0 8px 0;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .cabecera-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }
        .badge-etapa {
            background: #ffedd5;
            color: #c2410c;
            padding: 4px 10px;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: bold;
            text-transform: capitalize;
        }
        .salud-texto {
            font-size: 0.85rem;
            color: #6b7280;
            margin-bottom: 10px;
            font-weight: 600;
        }
        .historia-texto {
            font-size: 0.9rem;
            color: #4b5563;
            margin-bottom: 20px;
            flex-grow: 1;
            line-height: 1.4;
        }
        .btn-ver-mas {
            background: #f97316;
            color: white;
            text-align: center;
            padding: 10px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: bold;
            transition: background 0.3s;
        }
        .btn-ver-mas:hover {
            background: #ea580c;
        }
    </style>
</head>
<body>

    <div class="header-catalogo">
        <h2>🐾 PhiliaPet - Adopciones</h2>
        <a href="index.php?action=inicio" class="btn-volver">← Volver al Inicio</a>
    </div>

    <?php 
        // Capturamos lo que esté seleccionado actualmente en la URL
        $especieActual = $_GET['especie'] ?? 'todos';
        $edadActual = $_GET['edad'] ?? 'todos';
    ?>

    <!-- CONTENEDOR DE FILTROS UNIFICADO Y ESTILIZADO -->
    <div class="filtros-container">
        <!-- FILTROS DE ESPECIE (Mantienen la edad actual) -->
        <div class="grupo-filtros">
            <span style="font-weight: bold; align-self: center; margin-right: 10px; color: #9a3412;">Especie:</span>
            <a href="index.php?action=cliente_adopcion&especie=todos&edad=<?php echo htmlspecialchars($edadActual); ?>" class="<?php echo ($especieActual == 'todos') ? 'activo' : ''; ?>">Todos</a>
            <a href="index.php?action=cliente_adopcion&especie=perro&edad=<?php echo htmlspecialchars($edadActual); ?>" class="<?php echo ($especieActual == 'perro') ? 'activo' : ''; ?>">Perros</a>
            <a href="index.php?action=cliente_adopcion&especie=gato&edad=<?php echo htmlspecialchars($edadActual); ?>" class="<?php echo ($especieActual == 'gato') ? 'activo' : ''; ?>">Gatos</a>
        </div>

        <!-- FILTROS DE EDAD / ETAPA (Mantienen la especie actual) -->
        <div class="grupo-filtros">
            <span style="font-weight: bold; align-self: center; margin-right: 10px; color: #9a3412;">Etapa:</span>
            <a href="index.php?action=cliente_adopcion&especie=<?php echo htmlspecialchars($especieActual); ?>&edad=todos" class="<?php echo ($edadActual == 'todos') ? 'activo' : ''; ?>">Todas</a>
            <a href="index.php?action=cliente_adopcion&especie=<?php echo htmlspecialchars($especieActual); ?>&edad=cachorro" class="<?php echo ($edadActual == 'cachorro') ? 'activo' : ''; ?>">Cachorros</a>
            <a href="index.php?action=cliente_adopcion&especie=<?php echo htmlspecialchars($especieActual); ?>&edad=joven" class="<?php echo ($edadActual == 'joven') ? 'activo' : ''; ?>">Jóvenes</a>
            <a href="index.php?action=cliente_adopcion&especie=<?php echo htmlspecialchars($especieActual); ?>&edad=adulto" class="<?php echo ($edadActual == 'adulto') ? 'activo' : ''; ?>">Adultos</a>
        </div>
    </div>

    <!-- Catálogo de Mascotas -->
    <div class="grid-mascotas">
        <?php if (!empty($mascotas)): ?>
            <?php foreach ($mascotas as $m): ?>
                <div class="tarjeta-mascota">
                    <div class="contenedor-imagen">
                        <?php if (!empty($m['imagen'])): ?>
                            <img src="<?php echo htmlspecialchars($m['imagen']); ?>" alt="Foto de <?php echo htmlspecialchars($m['nombre']); ?>">
                        <?php else: ?>
                            <div style="font-size:4rem;">🐶</div>
                        <?php endif; ?>
                    </div>

                    <div class="info-tarjeta">
                        <h3 class="nombre-mascota">
                            ✨ <?php echo htmlspecialchars($m['nombre']); ?>
                        </h3>

                        <div class="cabecera-info">
                            <span style="font-weight: bold; color: #1f2937; text-transform: capitalize;"><?php echo htmlspecialchars($m['especie']); ?></span>
                            <span class="badge-etapa">
                                <?php 
                                    $etapaMostrar = $m['edad_aproximada'];
                                    if (stripos($etapaMostrar, 'cachorro') !== false) echo 'Cachorro';
                                    elseif (stripos($etapaMostrar, 'joven') !== false) echo 'Joven';
                                    elseif (stripos($etapaMostrar, 'adulto') !== false) echo 'Adulto';
                                    else echo htmlspecialchars($etapaMostrar);
                                ?>
                            </span>
                        </div>

                        <div class="salud-texto">
                            🩺 <strong>Salud:</strong> <?php echo htmlspecialchars($m['estado_salud']); ?>
                        </div>

                        <div class="historia-texto">
                            <?php echo htmlspecialchars($m['historia']); ?>
                        </div>

                        <a href="index.php?action=detalle_adopcion&id=<?php echo $m['id_mascota']; ?>" class="btn-ver-mas">
                            🔍 Ver Más e Informes
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div style="grid-column: 1 / -1; text-align: center; padding: 40px; background: white; border-radius: 15px;">
                <p style="color: #6b7280; font-size: 1.1rem;">No hay peluditos disponibles en esta categoría por el momento. 🐾</p>
            </div>
        <?php endif; ?>
    </div>

</body>
</html>