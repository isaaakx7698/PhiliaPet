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
                    
                    <!-- WhatsApp dinámico de la fundación corregido -->
                        <?php 
                            // Limpiamos cualquier carácter raro del número de la base de datos
                            $telBD = preg_replace('/[^0-9]/', '', $peludito['telefono'] ?? '57 3224585562');
                            
                            // Si el número guardado en la BD no tiene el 57 adelante, se lo agregamos de forma segura
                            if (substr($telBD, 0, 2) !== '57') {
                                $telefonoFinal = '57' . $telBD;
                            } else {
                                $telefonoFinal = $telBD;
                            }

                            $mensajeWhatsApp = "Estoy interesado en adoptar a " . $peludito['nombre'] . ", qué requisitos piden?";
                        ?>
                        <a href="https://api.whatsapp.com/send?phone=<?php echo $telefonoFinal; ?>&text=<?php echo urlencode($mensajeWhatsApp); ?>" target="_blank" 
                        style="background: #25d366; color: white; padding: 12px 22px; border-radius: 8px; text-decoration: none; font-weight: bold; display: inline-flex; align-items: center; gap: 8px;">
                            💬 Contactar por WhatsApp
                        </a>
                        <!-- Correo dinámico de la fundación -->
                        <a href="https://mail.google.com/mail/?view=cm&fs=1&to=<?php echo htmlspecialchars($peludito['correo'] ?? 'philiapet@gmail.com'); ?>&su=Interés%20en%20adopción%20de%20<?php echo urlencode($peludito['nombre']); ?>&body=Estoy%20interesado%20en%20adoptar%20a%20<?php echo urlencode($peludito['nombre']); ?>,%20qué%20requisitos%20piden?" target="_blank"
                        style="background: #4f46e5; color: white; padding: 12px 22px; border-radius: 8px; text-decoration: none; font-weight: bold; display: inline-flex; align-items: center; gap: 8px;">
                            ✉️ Enviar Correo
                        </a>
                </div>

            </div>
        </div>
    </div>

</body>
</html>