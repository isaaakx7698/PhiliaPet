<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Donaciones | PhiliaPet</title>
    <style>
        body {
            background-color: #fcf8f2; /* Fondo cálido general */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #4a3b32;
            margin: 0;
            padding: 0;
        }

        /* Encabezado estético */
        .header-panel {
            background-color: #fcac49; /* Rosa pastel de la marca */
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #fb923ce2;
        }

        .btn-volver {
            background: #ffffff;
            color: #7e22ce;
            padding: 8px 16px;
            border-radius: 20px;
            text-decoration: none;
            font-weight: bold;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            transition: 0.3s;
        }
        .btn-volver:hover {
            background: #f3e8ff;
        }

        .contenedor-principal {
            max-width: 1000px;
            margin: 30px auto;
            padding: 0 20px;
        }

        /* Banner principal tonos amarillo/naranja pastel */
        .banner-donacion {
            background: linear-gradient(135deg, #fef08a 0%, #fed7aa 100%); /* Amarillo y naranja pastel */
            border: 2px solid #fde047;
            border-radius: 20px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(253, 224, 71, 0.2);
            margin-bottom: 30px;
        }

        .titulo-seccion {
            text-align: center;
            color: #78350f;
            margin: 40px 0 20px 0;
            font-size: 1.5rem;
        }

        /* Tarjetas estilo prototipo */
        .grid-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .card-item {
            background: #ffedd5; /* Naranja pastel muy suave */
            border: 2px solid #fdba74;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.03);
            transition: transform 0.2s;
        }
        .card-item:hover {
            transform: translateY(-3px);
        }
        .card-item h4 {
            margin-top: 0;
            color: #9a3412;
        }

        /* Caja central QR Monetario */
        .box-qr {
            background: #fef9c3; /* Amarillo pastel suave */
            border: 2px solid #facc15;
            border-radius: 20px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0,0,0,0.04);
            margin-bottom: 40px;
        }

        .qr-placeholder {
            width: 150px;
            height: 150px;
            background: #e7e5e4;
            margin: 0 auto 15px auto;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #78716c;
            border: 2px dashed #a8a29e;
        }

        .btn-accion {
            background: #fb923c; /* Naranja pastel vibrante */
            color: white;
            padding: 10px 25px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: bold;
            display: inline-block;
            box-shadow: 0 4px 10px rgba(251, 146, 60, 0.3);
            transition: 0.3s;
        }
        .btn-accion:hover {
            background: #f97316;
        }

        /* Barra de progreso de meta */
        .meta-container {
            background: #ffedd5;
            border: 2px solid #fdba74;
            border-radius: 20px;
            padding: 25px;
            margin-bottom: 40px;
        }
        .progress-bar-bg {
            background: #fef3c7;
            border-radius: 15px;
            height: 25px;
            width: 100%;
            border: 1px solid #fcd34d;
            overflow: hidden;
            margin-top: 10px;
        }
        .progress-bar-fill {
            background: #fbbf24; /* Amarillo naranja pastel */
            height: 100%;
            width: 70%; /* 70% completado según prototipo */
            border-radius: 15px;
        }

        /* Mensajes de agradecimiento */
        .grid-gracias {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }
        .card-gracias {
            background: #fef08a; /* Amarillo pastel */
            border: 2px solid #fde047;
            border-radius: 15px;
            padding: 20px;
            font-style: italic;
            box-shadow: 0 3px 6px rgba(0,0,0,0.03);
        }
        .card-gracias strong {
            display: block;
            margin-top: 10px;
            font-style: normal;
            color: #854d0e;
        }
    </style>
</head>
<body>

    <div class="header-panel">
        <h2 style="margin:0; color: #701a75;">🎁 Centro de Donaciones</h2>
        <a href="index.php?action=inicio" class="btn-volver">← Volver al Inicio</a>
    </div>

    <div class="contenedor-principal">

        <!-- Banner Principal -->
        <div class="banner-donacion">
            <h1 style="color: #78350f; margin-top:0;">❤️ Ayuda a Salvar Más Vidas</h1>
            <p>Las fundaciones necesitan apoyo constante para alimentar, cuidar y proteger a cientos de animales rescatados en Bogotá.</p>
        </div>

        <!-- Donaciones Monetarias -->
        <h3 class="titulo-seccion">💰 Donaciones Monetarias</h3>
        <div class="box-qr">
            <!-- AQUÍ REEMPLAZAMOS EL CUADRO GRIS POR LA IMAGEN REAL -->
            <div style="margin: 0 auto 15px auto; width: 180px; height: 180px; background: #ffffff; border-radius: 12px; padding: 10px; box-shadow: 0 3px 10px rgba(0,0,0,0.05); display: flex; align-items: center; justify-content: center;">
               <img src="assets/img/qr_nequi.jpeg" alt="Código QR Nequi PhiliaPet" style="max-width: 100%; max-height: 100%; object-fit: contain; border-radius: 8px;">
            </div>
            
            <p style="margin: 5px 0 15px 0; font-weight: 600;">Escanea el código QR para aportar directamente a las fundaciones.</p>
            <a href="#" class="btn-accion" onclick="alert('¡Gracias por tu generosidad con los peluditos!'); return false;">❤️ Donar Ahora</a>
        </div>

        <!-- También Puedes Donar (Insumos) -->
        <h3 class="titulo-seccion">📦 También Puedes Donar</h3>
        <div class="grid-cards">
            <div class="card-item">
                <h4>🍖 Alimento</h4>
                <p style="font-size: 0.9rem; margin-bottom:0;">Concentrado para perros y gatos, comida húmeda y suplementos.</p>
            </div>
            <div class="card-item">
                <h4>🛌 Cobijas</h4>
                <p style="font-size: 0.9rem; margin-bottom:0;">Ayuda a proteger a los animales del frío y la lluvia de Bogotá.</p>
            </div>
            <div class="card-item">
                <h4>💊 Medicamentos</h4>
                <p style="font-size: 0.9rem; margin-bottom:0;">Antiparasitarios, vitaminas y elementos veterinarios básicos.</p>
            </div>
            <div class="card-item">
                <h4>🧸 Juguetes</h4>
                <p style="font-size: 0.9rem; margin-bottom:0;">Juguetes y accesorios para estimular su bienestar emocional.</p>
            </div>
        </div>

        <!-- Mensaje de coordinación para donaciones en especie -->
        <div style="background: #fef08a; border: 2px dashed #facc15; border-radius: 15px; padding: 20px; text-align: center; margin-bottom: 40px; box-shadow: 0 3px 6px rgba(0,0,0,0.03);">
            <p style="margin: 0 0 8px 0; font-weight: 600; color: #78350f;">
                🐾 ¿Prefieres donar alguno de estos elementos en físico?
            </p>
            <p style="margin: 0; font-size: 0.95rem; color: #9a3412;">
                Escríbenos con confianza a nuestro correo institucional y coordinamos la entrega contigo: 
                <a href="mailto:PhiliaPet2026@gmail.com" style="color: #7e22ce; font-weight: bold; text-decoration: underline;">PhiliaPet2026@gmail.com</a> 💌
            </p>
        </div>

        <!-- Meta de Recaudación -->
        <div class="meta-container">
            <h3 style="text-align: center; color: #9a3412; margin-top:0;">🎯 Meta de Recaudación Mensual</h3>
            <p style="text-align: center; font-weight: bold; margin: 5px 0;">$3.500.000 COP Recaudados (70% completado)</p>
            <div class="progress-bar-bg">
                <div class="progress-bar-fill"></div>
            </div>
        </div>

        <!-- ¿En qué se utilizan? -->
        <h3 class="titulo-seccion">🐾 ¿En Qué Se Utilizan Las Donaciones?</h3>
        <div class="grid-cards">
            <div class="card-item">
                <h4>🍽️ Alimentación</h4>
                <p style="font-size: 0.9rem; margin-bottom:0;">Compra masiva de concentrado para los refugios aliados.</p>
            </div>
            <div class="card-item">
                <h4>💉 Atención Médica</h4>
                <p style="font-size: 0.9rem; margin-bottom:0;">Vacunas, cirugías de urgencia y tratamientos veterinarios.</p>
            </div>
            <div class="card-item">
                <h4>🏠 Refugios</h4>
                <p style="font-size: 0.9rem; margin-bottom:0;">Mantenimiento y mejora de caniles y espacios de protección.</p>
            </div>
        </div>

        <!-- Mensajes de Agradecimiento -->
        <h3 class="titulo-seccion">💌 Mensajes de Agradecimiento</h3>
        <div class="grid-gracias">
            <div class="card-gracias">
                "Gracias a las donaciones pudimos rescatar y alimentar a más de 30 perritos este mes."
                <strong>🐾 Fundación Patitas Felices</strong>
            </div>
            <div class="card-gracias">
                "Las cobijas y alimentos recibidos ayudaron muchísimo durante la temporada de lluvias."
                <strong>🐾 Huellitas de Amor</strong>
            </div>
            <div class="card-gracias">
                "Cada aporte nos acerca a encontrar un hogar definitivo para más animales."
                <strong>🐾 Peluditos Bogotá</strong>
            </div>
        </div>

    </div>

</body>
</html>