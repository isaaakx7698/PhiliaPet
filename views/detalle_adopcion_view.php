<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PhiliaPet 🐾 - Detalles de <?php echo htmlspecialchars($peludito['nombre']); ?></title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body style="background: #f8fafc; font-family: sans-serif; margin: 0;">

    <!-- Barra superior -->
    <header style="background: #4c1d95; color: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center;">
        <h2 style="margin: 0;">🐾 PhiliaPet - Conociendo a <?php echo htmlspecialchars($peludito['nombre']); ?></h2>
        <a href="index.php?action=catalogo_adopcion" style="color: white; text-decoration: none; font-weight: bold;">← Volver al Catálogo</a>
    </header>

    <div style="max-width: 800px; margin: 40px auto; padding: 0 20px;">
        <div style="background: white; border-radius: 16px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); overflow: hidden; border: 2px solid #f3e8ff;">
            
            <!-- Imagen Grande de la Mascota -->
            <div style="width: 100%; height: 350px; background: #f3e8ff; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                <?php if (!empty($peludito['imagen'])): ?>
                    <img src="<?php echo htmlspecialchars($peludito['imagen']); ?>" alt="<?php echo htmlspecialchars($peludito['nombre']); ?>" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                <?php else: ?>
                    <div style="font-size: 5em;">
                        <?php echo ($peludito['especie'] == 'gato') ? '🐱' : '🐶'; ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Contenido de los Detalles -->
            <div style="padding: 30px;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                    <h1 style="margin: 0; color: #4c1d95; font-size: 2.2em;"><?php echo htmlspecialchars($peludito['nombre']); ?></h1>
                    <span style="background: #e0e7ff; color: #3730a3; padding: 6px 14px; border-radius: 20px; font-weight: bold; font-size: 0.9em;">
                        <?php echo htmlspecialchars($peludito['edad_aproximada']); ?>
                    </span>
                </div>

                <div style="margin-bottom: 20px; display: flex; gap: 10px; flex-wrap: wrap;">
                    <span style="background: #d1fae5; color: #065f46; padding: 6px 12px; border-radius: 8px; font-size: 0.9em; font-weight: bold;">
                        ✨ Salud: <?php echo htmlspecialchars($peludito['estado_salud']); ?>
                    </span>
                    <span style="background: #ede9fe; color: #5b21b6; padding: 6px 12px; border-radius: 8px; font-size: 0.9em; font-weight: bold;">
                        🐾 Especie: <?php echo ucfirst(htmlspecialchars($peludito['especie'])); ?>
                    </span>
                </div>

                <h3 style="color: #1e293b; border-bottom: 2px solid #f1f5f9; padding-bottom: 8px;">📖 Su Historia</h3>
                <p style="color: #475569; line-height: 1.6; font-size: 1.1em; margin-bottom: 25px;">
                    <?php echo nl2br(htmlspecialchars($peludito['historia'])); ?>
                </p>

                <!-- Puente de Contacto con la Fundación -->
                <div style="background: #fdf4ff; border: 2px dashed #d8b4fe; border-radius: 12px; padding: 20px; margin-bottom: 25px;">
                    <h3 style="color: #6b21a8; margin-top: 0; margin-bottom: 10px;">🏢 Puente de Contacto con la Fundación</h3>
                    <p style="color: #6b7280; font-size: 0.95em; margin-bottom: 15px;">¿Tienes dudas sobre el proceso o requisitos de adopción? Comunícate directamente con el refugio asignado:</p>
                    
                    <div style="display: flex; gap: 15px; flex-wrap: wrap;">
                        <a href="https://wa.me/573000000000?text=Hola,%20estoy%20interesado%20en%20adoptar%20a%20<?php echo urlencode($peludito['nombre']); ?>" target="_blank" 
                           style="background: #25d366; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: bold; display: inline-flex; align-items: center; gap: 8px;">
                           💬 Contactar por WhatsApp
                        </a>
                        <a href="mailto:fundacion@philiapet.com?subject=Interés%20en%20adopción%20de%20<?php echo urlencode($peludito['nombre']); ?>" 
                           style="background: #4f46e5; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: bold; display: inline-flex; align-items: center; gap: 8px;">
                           ✉️ Enviar Correo
                        </a>
                    </div>
                </div>

                <!-- Botón para confirmar adopción -->
                <div style="text-align: center; border-top: 1px solid #e2e8f0; padding-top: 20px;">
                    <a href="index.php?action=procesar_adopcion&id=<?php echo $peludito['id_mascota']; ?>" 
                       onclick="return confirm('¿Estás seguro de completar la adopción de <?php echo htmlspecialchars($peludito['nombre']); ?>? Pasará a estado adoptado y se cerrará su proceso.');"
                       style="display: inline-block; background: #10b981; color: white; padding: 14px 30px; border-radius: 10px; text-decoration: none; font-weight: bold; font-size: 1.1em; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);">
                       🏠 ¡Confirmar Adopción de <?php echo htmlspecialchars($peludito['nombre']); ?>!
                    </a>
                </div>

            </div>
        </div>
    </div>

</body>
</html>