<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Cuenta - Agrointerra</title>
    <link href="https://fonts.googleapis.com/css2?family=Zilla+Slab:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'nav.php'; ?>

    <div class="contenedor-pagina">
        <h1>Información del Usuario</h1>
        <p>Regístrate o inicia sesión para facilitar tus compras y guardar tus productos favoritos.</p>

        <div class="formulario-usuario">
            <h2>Registro / Inicio de Sesión</h2>
            <form method="post">
                <label>Nombre Completo:</label>
                <input type="text" name="nombre" required>

                <label>Correo Electrónico:</label>
                <input type="email" name="correo" required>

                <label>Teléfono:</label>
                <input type="tel" name="telefono">

                <label>Dirección de Envío:</label>
                <textarea name="direccion" rows="3"></textarea>

                <button type="submit" class="btn-principal">Guardar Información</button>
            </form>
        </div>
    </div>
</body>
</html>