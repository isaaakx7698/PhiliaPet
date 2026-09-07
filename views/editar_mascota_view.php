<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PhiliaPet 🐾 - Editar Peludito</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body style="background: #fdf4ff; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0;">

    <div style="background: #ffffff; padding: 30px; border-radius: 20px; width: 100%; max-width: 550px; box-shadow: 0 8px 20px rgba(0,0,0,0.08); border: 2px solid #e9d5ff;">
        <h3 style="color: #4c1d95; margin-top: 0; text-align: center;">✏️ Editar Información de <?php echo htmlspecialchars($peludito['nombre']); ?></h3>
        
        <form action="index.php?action=actualizar_mascota" method="POST">
            <!-- Campo oculto para enviar el ID -->
            <input type="hidden" name="id_mascota" value="<?php echo $peludito['id_mascota']; ?>">

            <label style="font-weight: bold; color: #4c1d95; font-size: 0.9em;">Nombre:</label>
            <input type="text" name="nombre" value="<?php echo htmlspecialchars($peludito['nombre']); ?>" required style="width:100%; margin-bottom:12px; padding:10px; border-radius:8px; border:1px solid #ddd; box-sizing: border-box;">
            
            <label style="font-weight: bold; color: #4c1d95; font-size: 0.9em;">Especie:</label>
            <select name="especie" style="width:100%; margin-bottom:12px; padding:10px; border-radius:8px; border:1px solid #ddd; box-sizing: border-box;">
                <option value="perro" <?php echo ($peludito['especie'] == 'perro') ? 'selected' : ''; ?>>🐶 Perro</option>
                <option value="gato" <?php echo ($peludito['especie'] == 'gato') ? 'selected' : ''; ?>>🐱 Gato</option>
            </select>

            <label style="font-weight: bold; color: #4c1d95; font-size: 0.9em;">Edad aproximada:</label>
            <input type="text" name="edad_aproximada" value="<?php echo htmlspecialchars($peludito['edad_aproximada']); ?>" required style="width:100%; margin-bottom:12px; padding:10px; border-radius:8px; border:1px solid #ddd; box-sizing: border-box;">
            
            <label style="font-weight: bold; color: #4c1d95; font-size: 0.9em;">Estado de salud:</label>
            <input type="text" name="estado_salud" value="<?php echo htmlspecialchars($peludito['estado_salud']); ?>" required style="width:100%; margin-bottom:12px; padding:10px; border-radius:8px; border:1px solid #ddd; box-sizing: border-box;">

            <!-- NUEVO: Selector de Estado de Adopción -->
            <label style="font-weight: bold; color: #4c1d95; font-size: 0.9em;">Estado de Adopción:</label>
            <select name="estado_adopcion" style="width:100%; margin-bottom:12px; padding:10px; border-radius:8px; border:1px solid #ddd; box-sizing: border-box;">
                <option value="disponible" <?php echo ($peludito['estado_adopcion'] == 'disponible') ? 'selected' : ''; ?>>Disponible</option>
                <option value="adoptado" <?php echo ($peludito['estado_adopcion'] == 'adoptado') ? 'selected' : ''; ?>>Adoptado</option>
            </select>
            
            <label style="font-weight: bold; color: #4c1d95; font-size: 0.9em;">URL o Ruta de la imagen:</label>
            <input type="text" name="imagen" value="<?php echo htmlspecialchars($peludito['imagen']); ?>" required style="width:100%; margin-bottom:12px; padding:10px; border-radius:8px; border:1px solid #ddd; box-sizing: border-box;">

            <label style="font-weight: bold; color: #4c1d95; font-size: 0.9em;">Historia / Descripción:</label>
            <textarea name="historia" required style="width:100%; margin-bottom:16px; padding:10px; border-radius:8px; border:1px solid #ddd; box-sizing: border-box; height:80px;"><?php echo htmlspecialchars($peludito['historia']); ?></textarea>

            <div style="display: flex; gap: 10px;">
                <button type="submit" style="background: #0284c7; color: white; border: none; padding: 12px 20px; border-radius: 10px; cursor: pointer; font-weight: bold; flex: 1;">
                    Guardar Cambios ✨
                </button>
                <a href="index.php?action=mascotas" style="background: #e2e8f0; color: #334155; text-align: center; padding: 12px 20px; border-radius: 10px; text-decoration: none; font-weight: bold; flex: 1; box-sizing: border-box;">
                    Cancelar
                </a>
            </div>
        </form>
    </div>

</body>
</html>