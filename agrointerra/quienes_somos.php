<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiénes Somos - Agrointerra</title>
    <link href="https://fonts.googleapis.com/css2?family=Zilla+Slab:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'nav.php'; ?>

    <div class="contenedor-pagina">
        <h1>¿Quiénes Somos?</h1>
        <p>Conoce nuestra historia, principios y compromiso.</p>

        <!-- Botones Interactivos -->
        <div class="botones-mision-vision">
            <button class="btn-interactivo" onclick="mostrarSeccion('mision')">Misión</button>
            <button class="btn-interactivo" onclick="mostrarSeccion('vision')">Visión</button>
            <button class="btn-interactivo" onclick="mostrarSeccion('valores')">Valores</button>
        </div>

        <!-- Contenido Dinámico -->
        <div class="contenido-info" id="contenido-info">
            <div id="mision" class="seccion-info">
                <h3>Misión</h3>
                <p>Proveer productos agrícolas de la más alta calidad, promoviendo prácticas sostenibles y apoyando a nuestros productores locales para entregar lo mejor del campo a cada hogar.</p>
            </div>
            <div id="vision" class="seccion-info" style="display:none;">
                <h3>Visión</h3>
                <p>Ser una cooperativa líder en el mercado nacional, reconocida por nuestra calidad, confianza y compromiso con el medio ambiente y la comunidad.</p>
            </div>
            <div id="valores" class="seccion-info" style="display:none;">
                <h3>Valores</h3>
                <p>Calidad, Honestidad, Compromiso, Sostenibilidad, Respeto y Trabajo en Equipo.</p>
            </div>
        </div>

        <!-- Imágenes con Animación -->
        <div class="contenedor-imagenes-deslizantes">
            <div class="imagen-deslizante">🌾 Imagen de campo agrícola</div>
            <div class="imagen-deslizante">🌱 Imagen de cultivo</div>
        </div>
    </div>

    <script>
        function mostrarSeccion(id) {
            document.querySelectorAll('.seccion-info').forEach(sec => sec.style.display = 'none');
            document.getElementById(id).style.display = 'block';
        }
    </script>
</body>
</html>