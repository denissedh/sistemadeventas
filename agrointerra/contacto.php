<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto - Agrointerra</title>
    <link href="https://fonts.googleapis.com/css2?family=Zilla+Slab:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'nav.php'; ?>

    <div class="contenedor-pagina">
        <h1>Contacto</h1>
        <p>Estamos a tu disposición. Contáctanos:</p>

        <div class="datos-contacto">
            <p><strong>📍 Domicilio:</strong> Calle Principal S/N, Nuevo Casas Grandes, Chihuahua, México</p>
            <p><strong>📞 Teléfono:</strong> +52 6XX XXX XXXX</p>
            <p><strong>✉️ Correo electrónico:</strong> contacto@agrointerra.mx</p>
        </div>

        <div class="formulario-contacto">
            <h2>Envíanos un mensaje</h2>
            <form method="post">
                <label>Nombre:</label>
                <input type="text" name="nombre" required>
                <label>Correo:</label>
                <input type="email" name="correo" required>
                <label>Mensaje:</label>
                <textarea name="mensaje" rows="5" required></textarea>
                <button type="submit" class="btn-principal">Enviar Mensaje</button>
            </form>
        </div>
    </div>
</body>
</html>