<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTRO - PHILIAPET</title>
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
            max-width: 480px;
            text-align: center;
        }

        .titulo-principal {
            display: inline-block;
            font-size: 2rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 4px;
            color: #ffffff;
            padding: 10px 36px;
            margin-bottom: 28px;
            background: rgba(255, 255, 255, 0.22);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 2px solid rgba(254, 240, 138, 0.9);
            border-radius: 50px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.5);
        }

        .card-box {
            background: rgba(255, 255, 255, 0.32);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-radius: 28px;
            padding: 30px 26px;
            width: 100%;
            text-align: left;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            border: 3.5px solid #fef08a;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.22);
        }

        .card-title {
            font-size: 1.45rem;
            font-weight: 700;
            margin-bottom: 22px;
            color: #0f172a;
            display: flex;
            align-items: center;
            justify-content: space-between;
            text-shadow: 0 1px 3px rgba(255, 255, 255, 0.9);
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .inputs-contenedor {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .form-group label {
            font-weight: 800;
            font-size: 0.78rem;
            color: #0f172a;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            text-shadow: 0 1px 2px rgba(255, 255, 255, 0.8);
        }

        .form-group input, 
        .form-group select {
            width: 100%;
            padding: 12px 14px;
            border-radius: 14px;
            border: 2px solid rgba(254, 240, 138, 0.9);
            background: rgba(255, 255, 255, 0.82);
            font-size: 0.95rem;
            font-weight: 700;
            color: #0f172a;
            outline: none;
            transition: all 0.2s ease;
        }

        .form-group input::placeholder {
            color: #64748b;
            font-weight: 500;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #fde047;
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 0 0 3px rgba(253, 224, 71, 0.35);
        }

        .btn-enviar {
            width: 100%;
            padding: 14px;
            border-radius: 50px;
            border: 2px solid #fef08a;
            font-weight: 800;
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #1e293b;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(8px);
            cursor: pointer;
            margin-top: 10px;
            transition: all 0.25s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .btn-enviar:hover {
            background: #fef08a;
            color: #0f172a;
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
        }
    </style>
</head>
<body>

    <div class="contenedor-principal">
        
        <h1 class="titulo-principal">Registro PhiliaPet</h1>

        <div class="card-box">
            <h2 class="card-title">Crear Cuenta 👤</h2>
            <form action="index.php?action=guardar_usuario" method="POST">
                <div class="inputs-contenedor">
                    <div class="form-group">
                        <label for="nombre">Nombre completo</label>
                        <input type="text" name="nombre" id="nombre" placeholder="Ej. Ana Pérez" required>
                    </div>

                    <div class="form-group">
                        <label for="correo">Correo electrónico</label>
                        <input type="email" name="correo" id="correo" placeholder="correo@ejemplo.com" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" name="password" id="password" placeholder="••••••••" required>
                    </div>

                    <div class="form-group">
                        <label for="rol">Tipo de cuenta</label>
                        <select name="rol" id="rol">
                            <option value="adoptante">Adoptante / Donante</option>
                            <option value="refugio">Refugio de animales</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn-enviar">Registrarse</button>
            </form>
        </div>

    </div>

</body>
</html>