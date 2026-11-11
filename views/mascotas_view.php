<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['rol']) || ($_SESSION['rol'] !== 'refugio' && $_SESSION['rol'] !== 'admin')) {
    header("Location: index.php?action=inicio");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PhiliaPet - Panel de Gestión de Mascotas</title>
    <link rel="stylesheet" href="assets/css/estilos.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f3ff;
            margin: 0;
            padding: 20px;
            color: #4c1d95;
        }
        .header-panel {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #ffffff;
            padding: 15px 30px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            margin-bottom: 30px;
        }
        .btn-volver {
            text-decoration: none;
            color: #6b21a8;
            font-weight: bold;
            background: #f3e8ff;
            padding: 8px 16px;
            border-radius: 10px;
        }
        .contenedor-form {
            background: #ffffff;
            padding: 30px;
            border-radius: 20px;
            max-width: 550px;
            margin: 0 auto 40px auto;
            box-shadow: 0 8px 25px rgba(0,0,0,0.06);
            border: 2px dashed #c084fc;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
            font-size: 0.9rem;
            color: #581c87;
        }
        .form-control {
            width: 100%;
            padding: 10px 12px;
            border-radius: 10px;
            border: 1px solid #ddd6fe;
            box-sizing: border-box;
            font-family: inherit;
            background: #faf5ff;
        }
        .btn-guardar {
            background: #6b21a8;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 10px;
            cursor: pointer;
            font-weight: bold;
            width: 100%;
            font-size: 1rem;
            transition: background 0.3s;
        }
        .btn-guardar:hover {
            background: #581c87;
        }
        .tabla-contenedor {
            background: #ffffff;
            padding: 20px;
            border-radius: 20px;
            max-width: 900px;
            margin: 0 auto;
            box-shadow: 0 8px 25px rgba(0,0,0,0.06);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
        }
        th {
            background-color: #7e22ce;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #faf5ff;
        }
        .btn-editar {
            background: #a855f7;
            color: white;
            padding: 6px 12px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            font-size: 0.85rem;
            display: inline-block;
            margin-right: 5px;
        }
        .btn-editar:hover {
            background: #9333ea;
        }
        .btn-eliminar {
            color: #dc2626;
            text-decoration: none;
            font-weight: bold;
            font-size: 0.85rem;
        }
    </style>
</head>
<body>

    <div class="header-panel">
        <h2>🐾 Panel de Gestión de Peluditos</h2>
        <a href="index.php?action=inicio" class="btn-volver">← Volver al Inicio</a>
    </div>

    <!-- Formulario para Registrar Nuevo Peludito -->
    <div class="contenedor-form">
        <h3 style="margin-top:0; text-align:center; color: #6b21a8;">Registrar Nuevo Peludito ✨</h3>
        <form action="index.php?action=guardar_mascota" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Nombre de la mascota:</label>
                <input type="text" name="nombre" class="form-control" required placeholder="Ej: Nieve">
            </div>
            
            <div class="form-group">
                <label>Especie:</label>
                <select name="especie" class="form-control" required>
                    <option value="perro">🐶 Perro</option>
                    <option value="gato">🐱 Gato</option>
                </select>
            </div>

            <div class="form-group">
                <label>Etapa de Vida:</label>
                <select name="edad_aproximada" class="form-control" required>
                    <option value="cachorro">🍼 Cachorro</option>
                    <option value="joven">⭐ Joven</option>
                    <option value="adulto">🐾 Adulto</option>
                </select>
            </div>

            <div class="form-group">
                <label>Edad Detallada:</label>
                <input type="text" name="edad_detallada" class="form-control" placeholder="Ej: 4 años">
            </div>

            <div class="form-group">
                <label>Estado de Salud:</label>
                <input type="text" name="estado_salud" class="form-control" required placeholder="Ej: Esterilizada, sana">
            </div>

            <div class="form-group">
                <label>Foto del Peludito:</label>
                <input type="file" name="imagen_archivo" accept="image/*" class="form-control">
            </div>

            <div class="form-group">
                <label>Historia / Descripción breve:</label>
                <textarea name="historia" class="form-control" style="height:70px;" required placeholder="Cuenta un poco sobre su historia..."></textarea>
            

            <button type="submit" class="btn-guardar">Guardar Peludito ✨</button>
        </form>
    </div>

    <!-- Tabla de Mascotas Registradas -->
    <div class="tabla-contenedor">
        <h3 style="margin-top:0; text-align:center; color: #6b21a8;">📋 Peluditos Registrados Actualmente</h3>
        
        <table>
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nombre</th>
                    <th>Especie</th>
                    <th>Etapa</th>
                    <th>Salud</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($mascotas)): ?>
                    <?php foreach ($mascotas as $m): ?>
                        <tr>
                            <td>
                                <?php if (!empty($m['imagen'])): ?>
                                    <img src="<?php echo htmlspecialchars($m['imagen']); ?>" alt="Foto" style="width: 45px; height: 45px; object-fit: cover; border-radius: 8px;">
                                <?php elseif (!empty($m['foto_ruta'])): ?>
                                    <img src="<?php echo htmlspecialchars($m['foto_ruta']); ?>" alt="Foto" style="width: 45px; height: 45px; object-fit: cover; border-radius: 8px;">
                                <?php else: ?>
                                    🐾
                                <?php endif; ?>
                            </td>
                            <td><strong><?php echo htmlspecialchars($m['nombre']); ?></strong></td>
                            <td><?php echo ucfirst(htmlspecialchars($m['especie'])); ?></td>
                            <td><?php echo htmlspecialchars($m['edad_aproximada']); ?></td>
                            <td><?php echo htmlspecialchars($m['estado_salud']); ?></td>
                            <td>
                                <a href="index.php?action=editar_mascota&id=<?php echo $m['id_mascota']; ?>" class="btn-editar">✏️ Editar</a>
                                <a href="index.php?action=eliminar_mascota&id=<?php echo $m['id_mascota']; ?>" class="btn-eliminar" onclick="return confirm('¿Seguro que deseas eliminar esta mascota?');">🗑️ Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="text-align: center;">No hay mascotas registradas aún.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</body>
</html>