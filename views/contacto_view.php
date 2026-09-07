<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>PhiliaPet - Contacto</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <header>
        <h1>PhiliaPet</h1>
        <nav>
            <a href="index.php?action=inicio">Inicio</a>
            <a href="index.php?action=mascotas">Mascotas</a>
            <a href="index.php?action=nosotros">Nosotros</a>
            <a href="index.php?action=contacto">Contacto</a>
        </nav>
    </header>

    <main>
        <h2>Contáctanos</h2>
        <form action="#" method="POST" class="formulario-contacto">
            <label for="nombre">Nombre:</label><br>
            <input type="text" id="nombre" name="nombre" placeholder="Tu nombre" required><br><br>

            <label for="correo">Correo electrónico:</label><br>
            <input type="email" id="correo" name="correo" placeholder="tu@email.com" required><br><br>

            <label for="mensaje">Mensaje:</label><br>
            <textarea id="mensaje" name="mensaje" placeholder="Escribe tu mensaje o consulta..." rows="4" required></textarea><br><br>

            <button type="submit">Enviar mensaje</button>
        </form>
    </main>
</body>
</html>