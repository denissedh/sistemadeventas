<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cooperativa Agrointerra</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Zilla+Slab:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Barra de Navegación -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="index.php" class="logo">Agrointerra</a>
            <ul class="nav-links">
                <li><a href="index.php">Inicio</a></li>
                <li><a href="quienes_somos.php">Quiénes Somos</a></li>
                <li><a href="catalogo.php">Catálogo</a></li>
                <li><a href="usuario.php">Mi Cuenta</a></li>
                <li><a href="contacto.php">Contacto</a></li>
                <li><a href="carrito.php" class="carrito-icon">🛒 Carrito</a></li>
            </ul>
        </div>
    </nav>

    <!-- Sección Principal -->
    <header class="hero">
        <div class="hero-content">
            <h1>Bienvenidos a Cooperativa Agrointerra</h1>
            <p>Productos agrícolas de calidad, directo del campo a tu mesa</p>
            <a href="catalogo.php" class="btn-principal">Ver Catálogo</a>
        </div>
    </header>

    <!-- Sección Destacada -->
    <section class="seccion-destacada">
        <div class="contenedor">
            <h2>Nuestros Productos</h2>
            <p>El catálogo es nuestro principal atractivo. Conoce la calidad de nuestros productos.</p>
            <a href="catalogo.php" class="btn-secundario">Explorar Productos</a>
        </div>
    </section>

    <!-- Pie de Página -->
    <footer>
        <p>&copy; <?php echo date('Y'); ?> Cooperativa Agrointerra - Todos los derechos reservados</p>
    </footer>
</body>
</html>