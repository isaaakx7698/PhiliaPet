<?php
// Aseguramos que la sesión esté activa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil - PhiliaPet 🐾</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Outfit', sans-serif;
            min-height: 100vh;
            background: linear-gradient(rgba(0, 0, 0, 0.18), rgba(0, 0, 0, 0.18)), 
                        url('https://images.unsplash.com/photo-1548199973-03cce0bbc87b?q=80&w=1920&auto=format&fit=crop') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px 15px;
        }

        .contenedor-principal {
            width: 100%;
            max-width: 520px;
            background: rgba(255, 255, 255, 0.88);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-radius: 28px;
            padding: 35px 30px;
            border: 3.5px solid #fef08a;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
        }

        .perfil-header {
            text-align: center;
            margin-bottom: 25px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .avatar-wrapper {
            position: relative;
            margin-bottom: 15px;
            display: inline-block;
        }

        .avatar-container {
            width: 110px;
            height: 110px;
            border-radius: 50%;
            overflow: hidden;
            background: #e0e7ff;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 4px solid #4f46e5;
            box-shadow: 0 6px 16px rgba(79, 70, 229, 0.25);
        }

        .avatar-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* BOTÓN ESTILIZADO DEBAJO DE LA FOTO */
        .btn-cambiar-foto {
            margin-top: 8px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #4f46e5;
            color: #ffffff;
            font-weight: 700;
            font-size: 0.8rem;
            padding: 6px 16px;
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 3px 8px rgba(79, 70, 229, 0.3);
        }

        .btn-cambiar-foto:hover {
            background: #4338ca;
            transform: translateY(-1px);
        }

        /* OCULTAMOS EL INPUT FILE GENÉRICO */
        input[type="file"]#foto {
            display: none;
        }

        .perfil-header h1 {
            font-size: 1.6rem;
            color: #0f172a;
            font-weight: 700;
            margin-top: 10px;
        }

        .perfil-header p {
            font-size: 0.88rem;
            color: #64748b;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .form-group label {
            font-weight: 800;
            font-size: 0.78rem;
            color: #0f172a;
            text-transform: uppercase;
            letter-spacing: 0.6px;
        }

        .form-group input, 
        .form-group textarea {
            width: 100%;
            padding: 12px 14px;
            border-radius: 14px;
            border: 2px solid #cbd5e1;
            background: rgba(255, 255, 255, 0.95);
            font-size: 0.95rem;
            font-weight: 600;
            color: #0f172a;
            outline: none;
            transition: all 0.2s ease;
            font-family: 'Outfit', sans-serif;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 85px;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.15);
        }

        .badge-estado {
            background: #ecfdf5;
            border: 2px solid #10b981;
            color: #065f46;
            padding: 12px 16px;
            border-radius: 14px;
            font-weight: bold;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-guardar {
            width: 100%;
            padding: 14px;
            border-radius: 50px;
            border: none;
            font-weight: 800;
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: white;
            background: #4f46e5;
            cursor: pointer;
            margin-top: 10px;
            transition: all 0.25s ease;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
        }

        .btn-guardar:hover {
            background: #4338ca;
            transform: translateY(-2px);
        }

        .btn-volver {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #4f46e5;
            text-decoration: none;
            font-weight: bold;
            font-size: 0.9rem;
        }

        .btn-volver:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="contenedor-principal">
        <!-- ENCABEZADO Y FOTO DE PERFIL CON VISTA PREVIA -->
        <form action="index.php?action=actualizar_perfil" method="POST" enctype="multipart/form-data">
            
            <div class="perfil-header">
                <div class="avatar-wrapper">
                    <div class="avatar-container" id="avatarPreviewContainer">
                        <?php if (!empty($usuario['foto'])): ?>
                            <img src="<?php echo htmlspecialchars($usuario['foto']); ?>" id="imgPreview" alt="Foto de perfil">
                        <?php else: ?>
                            <span id="iconDefault" style="font-size: 2.8rem; color: #4338ca;">👤</span>
                            <img src="" id="imgPreview" alt="Foto de perfil" style="display: none;">
                        <?php endif; ?>
                    </div>

                    <!-- BOTÓN ETIQUETA QUE ACTIVA EL CAMPO DE ARCHIVO OCULTO -->
                    <label for="foto" class="btn-cambiar-foto">
                        📷 Cambiar foto
                    </label>
                    <input type="file" name="foto" id="foto" accept="image/*">
                </div>

                <h2>
                    <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'refugio'): ?>
                        Mi Perfil de Refugio 🏢
                    <?php else: ?>
                        Mi Perfil de Adoptante 🐾
                    <?php endif; ?>
                </h2>
                <p>Información personal, foto y descripción en la plataforma</p>
            </div>

            <!-- CAMPOS DEL FORMULARIO -->
            <div class="form-group">
                <label for="nombre">Nombre Completo:</label>
                <input type="text" name="nombre" id="nombre" value="<?php echo htmlspecialchars($_SESSION['nombre'] ?? ''); ?>" required>
            </div>

            <div class="form-group">
                <label for="correo">Correo Electrónico:</label>
                <input type="email" name="correo" id="correo" value="<?php echo htmlspecialchars($_SESSION['correo'] ?? ''); ?>" required>
            </div>

            <div class="form-group">
                <label>
                    <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'refugio'): ?>
                        DESCRIPCIÓN DE LA FUNDACIÓN / REFUGIO:
                    <?php else: ?>
                        DESCRIPCIÓN / BIOGRAFÍA PERSONAL:
                    <?php endif; ?>
                </label>
                <textarea name="descripcion" id="descripcion" placeholder="Cuéntanos un poco sobre ti, por qué amas a los animales o qué buscas en PhiliaPet..."><?php echo htmlspecialchars($usuario['descripcion'] ?? ''); ?></textarea>
            </div>

            <div class="badge-estado">
                🐾 Estado del perfil: <?php echo ucfirst($_SESSION['rol'] ?? 'Adoptante'); ?> Verificado Activo.
            </div>

            <button type="submit" class="btn-guardar">Guardar Cambios 💾</button>
        </form>

        <a href="index.php?action=inicio" class="btn-volver">← Volver al Inicio</a>
    </div>

    <!-- SCRIPT DE VISTA PREVIA INSTANTÁNEA -->
    <script>
        document.getElementById('foto').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    const imgPreview = document.getElementById('imgPreview');
                    const iconDefault = document.getElementById('iconDefault');
                    
                    imgPreview.src = event.target.result;
                    imgPreview.style.display = 'block';
                    imgPreview.style.width = '100%';
                    imgPreview.style.height = '100%';
                    imgPreview.style.objectFit = 'cover';
                    
                    if (iconDefault) {
                        iconDefault.style.display = 'none';
                    }
                };
                reader.readAsDataURL(file);
            }
        });
    </script>

</body>
</html>