<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PhiliaPet 🐾 Fundaciones Aliadas</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        /* ========================================================== */
        /* ESTILOS ESPECÍFICOS PARA LA VISTA DE FUNDACIONES - PHILÍAPET */
        /* ========================================================== */
        
        .badge-verificada-top {
            display: inline-block;
            background-color: #f4a2a3;
            border: 2px solid #2d2d2d;
            padding: 6px 18px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: bold;
            margin-top: 10px;
            box-shadow: 2px 2px 0px rgba(0,0,0,0.1);
        }

        .contenedor-logo-fundacion {
            width: 100%;
            height: 170px;
            overflow: hidden;
            background: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 14px;
            border: 2px solid #2d2d2d;
            margin-bottom: 15px;
            padding: 5px;
        }

        .contenedor-logo-fundacion img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .info-fundacion-lista {
            font-size: 0.85rem;
            line-height: 1.6;
            margin: 12px 0;
            color: #2d2d2d;
        }

        .info-fundacion-lista p {
            margin: 4px 0;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .btn-contactar-mint {
            background-color: #aed9cf;
            color: #2d2d2d;
            border: 2px solid #2d2d2d;
            padding: 8px 18px;
            border-radius: 10px;
            font-size: 0.9rem;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            box-shadow: 2px 2px 0px #2d2d2d;
            transition: all 0.15s ease;
        }

        .btn-contactar-mint:hover {
            background-color: #92c9bc;
            transform: scale(1.02);
        }

        .tag-verificada-status {
            background-color: #dcfce7;
            border: 1.5px solid #2d2d2d;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: bold;
            color: #166534;
            display: inline-block;
        }

        .seccion-impacto-box {
            background-color: #e3ebd3;
            border: 2.5px solid #2d2d2d;
            border-radius: 20px;
            padding: 35px 20px;
            margin: 50px 0;
            box-shadow: 4px 4px 0px rgba(0,0,0,0.1);
        }

        .card-estadistica {
            background-color: #ffffff;
            border: 2.5px solid #2d2d2d;
            border-radius: 16px;
            padding: 22px 15px;
            text-align: center;
            box-shadow: 3px 3px 0px rgba(0,0,0,0.08);
        }

        .card-estadistica h2 {
            font-size: 2rem;
            margin: 0 0 5px 0;
            color: #2d2d2d;
            font-weight: 800;
        }

        .card-estadistica p {
            font-size: 0.78rem;
            color: #555;
            text-transform: uppercase;
            font-weight: 700;
            margin: 0;
            letter-spacing: 0.5px;
        }

        .card-mascota-reciente {
            background-color: #f3d4c1;
            border: 2.5px solid #2d2d2d;
            border-radius: 18px;
            padding: 15px;
            text-align: center;
            box-shadow: 3px 3px 0px rgba(0,0,0,0.1);
        }

        .foto-mascota-reciente {
            width: 100%;
            height: 150px;
            background-color: #e0beaa;
            border: 2px solid #2d2d2d;
            border-radius: 12px;
            margin-bottom: 12px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        footer.footer-fundaciones {
            background-color: #f4a2a3;
            border-top: 2.5px solid #2d2d2d;
            padding: 30px 20px;
            text-align: center;
            margin-top: 50px;
        }

        footer.footer-fundaciones h4 {
            font-size: 1.2rem;
            margin-bottom: 6px;
            color: #2d2d2d;
        }

        footer.footer-fundaciones p {
            font-size: 0.85rem;
            color: #333;
            margin: 3px 0;
        }
    </style>
</head>
<body>

    <!-- MARQUESINA SUPERIOR -->
    <div class="marquesina-contenedor">
        <div class="marquesina-texto">
            🐶 ¡ADOPTA, NO COMPRES! • Próxima jornada en C.C. Gran Estación este Sábado 🎉 • Vacunación gratuita con la Fundación Huellas de Amor 🐱 • ¡Ayúdanos a salvar vidas en Bogotá! ❤️ • 
        </div>
    </div>

    <!-- ENCABEZADO DE NAVEGACIÓN -->
    <header>
        <div class="logo-animado">
            <span>🐾</span> PhiliaPet <span style="color: #7c3aed;">❤️</span>
        </div>
        <nav>
            <a href="index.php?action=inicio" class="nav-link">🏠 Inicio</a>
            <a href="index.php?action=catalogo_adopcion" class="nav-link">🐾 Adopta</a>
            <a href="index.php?action=fundaciones" class="nav-link activo">🏢 Fundaciones</a>
            <a href="index.php?action=calendario" class="nav-link">📅 Calendario</a>
        </nav>
    </header>

    <!-- HERO SECTION PRINCIPAL -->
    <section id="inicio" class="hero-section" style="text-align: center; padding: 40px 20px;">
        <div class="hero-contenido">
            <h1 style="font-size: 2.2rem; margin-bottom: 10px; display: flex; align-items: center; justify-content: center; gap: 10px;">
                🏢 Fundaciones Aliadas
            </h1>
            <p style="max-width: 650px; margin: 0 auto 15px auto; color: #444; font-size: 1rem;">
                Conoce las organizaciones que trabajan cada día por rescatar, cuidar y encontrar hogares para cientos de animales.
            </p>
            <div class="badge-verificada-top">
                🛡️ Todas las fundaciones están verificadas
            </div>
        </div>
    </section>

    <!-- CONTENEDOR GENERAL -->
    <div style="max-width: 1200px; margin: 20px auto; padding: 0 20px;">
        
        <!-- MÓDULO DE BUSCADOR -->
        <div style="background-color: #f3d4c1; border: 2.5px solid #2d2d2d; border-radius: 18px; padding: 22px; max-width: 480px; margin: 0 auto 45px auto; text-align: center; box-shadow: 4px 4px 0px rgba(0,0,0,0.12);">
            <h3 style="margin-top: 0; margin-bottom: 15px; font-size: 1.15rem; color: #2d2d2d;">🔎 Buscar Fundación</h3>
            <form method="GET" action="index.php">
                <input type="hidden" name="action" value="fundaciones">
                
                <div style="display: flex; gap: 10px; margin-bottom: 15px;">
                    <select name="localidad" style="width: 50%; padding: 9px; border-radius: 8px; border: 1.5px solid #2d2d2d; background: white; font-size: 0.85rem;">
                        <option value="">Todas las localidades</option>
                        <option value="suba">Suba</option>
                        <option value="engativa">Engativá</option>
                        <option value="kennedy">Kennedy</option>
                    </select>
                    
                    <select name="tipo" style="width: 50%; padding: 9px; border-radius: 8px; border: 1.5px solid #2d2d2d; background: white; font-size: 0.85rem;">
                        <option value="">Tipo</option>
                        <option value="perros">Perros</option>
                        <option value="gatos">Gatos</option>
                        <option value="mixto">Mixto</option>
                    </select>
                </div>
                
                <button type="submit" class="btn-contactar-mint" style="width: auto; padding: 8px 24px;">
                    Buscar Fundación
                </button>
            </form>
        </div>

        <!-- TÍTULO DE SECCIÓN -->
        <div style="text-align: center; margin-bottom: 30px;">
            <h2 style="font-size: 1.6rem; color: #2d2d2d; display: flex; align-items: center; justify-content: center; gap: 8px;">
                🐾 Fundaciones Destacadas
            </h2>
        </div>

        <!-- GRID DE TARJETAS DE FUNDACIONES DESTACADAS -->
        <div class="grid-mascotas">
            
            <!-- TARJETA 1: Patitas Felices -->
            <div class="tarjeta-peludito card-lavanda">
                <div>
                    <div class="contenedor-logo-fundacion">
                        <img src="assets/img/patitas_felices.jpeg" alt="Patitas Felices" onerror="this.onerror=null; this.parentElement.innerHTML='<span style=\'font-size:3.5em;\'>🐶</span>';">
                    </div>
                    
                    <h3 style="font-size: 1.2rem; margin-bottom: 4px; color: #2d2d2d;">🐶 Patitas Felices</h3>
                    <p style="font-size: 0.82rem; color: #555; margin-bottom: 12px; line-height: 1.4;">Especialistas en rescate de perros abandonados.</p>
                    
                    <div class="info-fundacion-lista">
                        <p>📍 <strong>Localidad:</strong> Suba</p>
                        <p>📞 <strong>Teléfono:</strong> 300 123 4567</p>
                        <p>✉️ <strong>Correo:</strong> patitasfelices@gmail.com</p>
                        <p>📸 <strong>Instagram:</strong> @patitasfelices</p>
                        <p>📘 <strong>Facebook:</strong> Patitas Felices</p>
                    </div>
                </div>

                <div style="margin-top: 15px; display: flex; flex-direction: column; gap: 10px; align-items: flex-start;">
                    <span class="tag-verificada-status">🛡️ Verificada</span>
                    <a href="#" class="btn-contactar-mint">💬 Contactar</a>
                </div>
            </div>

            <!-- TARJETA 2: Huellitas de Amor -->
            <div class="tarjeta-peludito card-menta">
                <div>
                    <div class="contenedor-logo-fundacion">
                        <img src="assets/img/huellitas_de_amor.jpeg" alt="Huellitas de Amor" onerror="this.onerror=null; this.parentElement.innerHTML='<span style=\'font-size:3.5em;\'>🐱</span>';">
                    </div>

                    <h3 style="font-size: 1.2rem; margin-bottom: 4px; color: #2d2d2d;">🐱 Huellitas de Amor</h3>
                    <p style="font-size: 0.82rem; color: #555; margin-bottom: 12px; line-height: 1.4;">Rescate y adopción de gatos y perros.</p>

                    <div class="info-fundacion-lista">
                        <p>📍 <strong>Localidad:</strong> Engativá</p>
                        <p>📞 <strong>Teléfono:</strong> 311 987 6543</p>
                        <p>✉️ <strong>Correo:</strong> huellitas@gmail.com</p>
                        <p>📸 <strong>Instagram:</strong> @huellitasamor</p>
                        <p>📘 <strong>Facebook:</strong> Huellitas de Amor</p>
                    </div>
                </div>

                <div style="margin-top: 15px; display: flex; flex-direction: column; gap: 10px; align-items: flex-start;">
                    <span class="tag-verificada-status">🛡️ Verificada</span>
                    <a href="#" class="btn-contactar-mint">💬 Contactar</a>
                </div>
            </div>

            <!-- TARJETA 3: Peluditos en Apuros -->
            <div class="tarjeta-peludito card-lavanda">
                <div>
                    <div class="contenedor-logo-fundacion">
                        <img src="assets/img/peluditos.jpeg" alt="Peluditos en Apuros" onerror="this.onerror=null; this.parentElement.innerHTML='<span style=\'font-size:3.5em;\'>🐕</span>';">
                    </div>

                    <h3 style="font-size: 1.2rem; margin-bottom: 4px; color: #2d2d2d;">🐕 Peluditos Bogotá</h3>
                    <p style="font-size: 0.82rem; color: #555; margin-bottom: 12px; line-height: 1.4;">Más de 500 rescates realizados.</p>

                    <div class="info-fundacion-lista">
                        <p>📍 <strong>Localidad:</strong> Kennedy</p>
                        <p>📞 <strong>Teléfono:</strong> 320 555 8899</p>
                        <p>✉️ <strong>Correo:</strong> peluditos@gmail.com</p>
                        <p>📸 <strong>Instagram:</strong> @peluditosbogota</p>
                        <p>📘 <strong>Facebook:</strong> Peluditos Bogotá</p>
                    </div>
                </div>

                <div style="margin-top: 15px; display: flex; flex-direction: column; gap: 10px; align-items: flex-start;">
                    <span class="tag-verificada-status">🛡️ Verificada</span>
                    <a href="#" class="btn-contactar-mint">💬 Contactar</a>
                </div>
            </div>

        </div>

        <!-- SECCIÓN: Impacto de las Fundaciones -->
        <div class="seccion-impacto-box">
            <h2 style="text-align: center; font-size: 1.5rem; color: #2d2d2d; margin-top: 0; margin-bottom: 25px;">
                📊 Impacto de las Fundaciones
            </h2>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 18px;">
                <div class="card-estadistica">
                    <h2>30+</h2>
                    <p>Fundaciones Registradas</p>
                </div>
                <div class="card-estadistica">
                    <h2>1200+</h2>
                    <p>Animales Rescatados</p>
                </div>
                <div class="card-estadistica">
                    <h2>700+</h2>
                    <p>Adopciones Exitosas</p>
                </div>
                <div class="card-estadistica">
                    <h2>100%</h2>
                    <p>Verificadas</p>
                </div>
            </div>
        </div>

        <!-- SECCIÓN: Mascotas Recientemente Publicadas -->
        <div style="text-align: center; margin-bottom: 25px;">
            <h2 style="font-size: 1.5rem; color: #2d2d2d; display: flex; align-items: center; justify-content: center; gap: 8px;">
                📷 Mascotas Recientemente Publicadas
            </h2>
        </div>

        <div class="grid-mascotas" style="margin-bottom: 40px;">
            <!-- Mascota 1 -->
            <div class="card-mascota-reciente">
                <div class="foto-mascota-reciente">
                    <span style="font-size: 3rem;">🐱</span>
                </div>
                <h4 style="font-size: 1.1rem; margin: 5px 0 2px 0; color: #2d2d2d;">Luna</h4>
                <p style="font-size: 0.8rem; color: #666; margin: 0;">Patitas Felices</p>
            </div>

            <!-- Mascota 2 -->
            <div class="card-mascota-reciente">
                <div class="foto-mascota-reciente">
                    <span style="font-size: 3rem;">🐶</span>
                </div>
                <h4 style="font-size: 1.1rem; margin: 5px 0 2px 0; color: #2d2d2d;">Milo</h4>
                <p style="font-size: 0.8rem; color: #666; margin: 0;">Huellitas de Amor</p>
            </div>

            <!-- Mascota 3 -->
            <div class="card-mascota-reciente">
                <div class="foto-mascota-reciente">
                    <span style="font-size: 3rem;">🐶</span>
                </div>
                <h4 style="font-size: 1.1rem; margin: 5px 0 2px 0; color: #2d2d2d;">Max</h4>
                <p style="font-size: 0.8rem; color: #666; margin: 0;">Peluditos Bogotá</p>
            </div>
        </div>

    </div>

    <!-- PIE DE PÁGINA (FOOTER) -->
    <footer class="footer-fundaciones">
        <h4>🐾 PhiliaPet</h4>
        <p>Fundaciones verificadas para una adopción segura.</p>
        <p>✉️ contacto@philiapet.com</p>
        <p style="margin-top: 15px; font-size: 0.75rem; color: #555;">&copy; 2026 Conectando corazones peluditos con total responsabilidad.</p>
    </footer>

</body>
</html>