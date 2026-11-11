<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'refugio') {
    header("Location: index.php?action=inicio");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PhiliaPet - Editar Peludito</title>
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
        .form-control:focus {
            outline: none;
            border-color: #a855f7;
            background: #fff;
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
    </style>
</head>
<body>

    <div class="header-panel">
        <h2>✏️ Editar Información de Peludito</h2>
        <a href="index.php?action=mascotas" class="btn-volver">← Volver al Panel</a>
    </div>

    <div class="contenedor-form">
        <h3 style="margin-top:0; text-align:center; color: #6b21a8;">Actualizar Datos de <?php echo htmlspecialchars($peludito['nombre']); ?></h3>
        
        <form action="index.php?action=actualizar_mascota" method="POST" enctype="multipart/form-data">
            
            <!-- Campo oculto con el ID de la mascota -->
            <input type="hidden" name="id_mascota" value="<?php echo $peludito['id_mascota']; ?>">

            <div class="form-group">
                <label>Nombre de la mascota:</label>
                <input type="text" name="nombre" class="form-control" value="<?php echo htmlspecialchars($peludito['nombre']); ?>" required>
            </div>
            
            <div class="form-group">
                <label>Especie:</label>
                <select name="especie" class="form-control" required>
                    <option value="perro" <?php echo ($peludito['especie'] === 'perro') ? 'selected' : ''; ?>>🐶 Perro</option>
                    <option value="gato" <?php echo ($peludito['especie'] === 'gato') ? 'selected' : ''; ?>>🐱 Gato</option>
                </select>
            </div>

            <div class="form-group">
                <label>Etapa de Vida (Categoría de filtro):</label>
                <select name="edad_aproximada" class="form-control" required>
                    <option value="cachorro" <?php echo (strpos(strtolower($peludito['edad_aproximada']), 'cachorro') !== false) ? 'selected' : ''; ?>>🍼 Cachorro</option>
                    <option value="joven" <?php echo (strpos(strtolower($peludito['edad_aproximada']), 'joven') !== false) ? 'selected' : ''; ?>>⭐ Joven</option>
                    <option value="adulto" <?php echo (strpos(strtolower($peludito['edad_aproximada']), 'adulto') !== false) ? 'selected' : ''; ?>>🐾 Adulto</option>
                </select>
            </div>

            <div class="form-group">
                <label>Edad Específica o Detalle:</label>
                <input type="text" name="edad_detallada" class="form-control" value="<?php echo htmlspecialchars($peludito['edad_aproximada']); ?>" required>
            </div>

            <div class="form-group">
                <label>Estado de Salud:</label>
                <input type="text" name="estado_salud" class="form-control" value="<?php echo htmlspecialchars($peludito['estado_salud']); ?>" required>
            </div>
            
            <div class="form-group">
                <label>Estado de Adopción:</label>
                <select name="estado_adopcion" class="form-control">
                    <option value="disponible" <?php echo ($peludito['estado_adopcion'] === 'disponible') ? 'selected' : ''; ?>>Disponible</option>
                    <option value="adoptado" <?php echo ($peludito['estado_adopcion'] === 'proceso') ? 'selected' : ''; ?>>En proceso de adopcion</option>
                </select>
            </div>

            <div class="form-group">
                <label>Foto Actual o Nueva (Opcional):</label>
                <?php if (!empty($peludito['imagen'])): ?>
                    <div style="margin-bottom: 8px;">
                        <img src="<?php echo htmlspecialchars($peludito['imagen']); ?>" alt="Foto" style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px;">
                    </div>
                <?php endif; ?>
                <input type="file" name="imagen_archivo" accept="image/*" class="form-control">
            </div>

            <div class="form-group">
                <label>Historia / Descripción breve:</label>
                <textarea name="historia" class="form-control" style="height:80px;" required><?php echo htmlspecialchars($peludito['historia']); ?></textarea>
            </div>
            <button type="submit" class="btn-guardar">Actualizar Peludito ✨</button>
        </form>
    </div>

</body>
</html>