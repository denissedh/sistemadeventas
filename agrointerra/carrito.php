<?php
include 'config.php';

// Agregar producto al carrito
if (isset($_GET['agregar'])) {
    $id = $_GET['agregar'];
    $cantidad = $_GET['cantidad'] ?? 1;
    if (!isset($_SESSION['carrito'])) $_SESSION['carrito'] = [];
    $_SESSION['carrito'][$id] = ($_SESSION['carrito'][$id] ?? 0) + $cantidad;
    header('Location: carrito.php'); exit;
}

// Eliminar producto
if (isset($_GET['quitar'])) {
    unset($_SESSION['carrito'][$_GET['quitar']]);
    header('Location: carrito.php'); exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras - Agrointerra</title>
    <link href="https://fonts.googleapis.com/css2?family=Zilla+Slab:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'nav.php'; ?>

    <div class="contenedor-pagina">
        <h1>Tu Carrito</h1>
        <?php if (empty($_SESSION['carrito'])): ?>
            <p>Tu carrito está vacío. <a href="catalogo.php">Ver productos</a></p>
        <?php else: ?>
            <table class="tabla-carrito">
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Acción</th>
                </tr>
                <?php foreach ($_SESSION['carrito'] as $id => $cant): ?>
                <tr>
                    <td>Producto #<?= $id ?></td>
                    <td><?= $cant ?></td>
                    <td><a href="?quitar=<?= $id ?>" class="btn-eliminar">Eliminar</a></td>
                </tr>
                <?php endforeach; ?>
            </table>
            <a href="usuario.php" class="btn-comprar">Proceder a Compra</a>
        <?php endif; ?>
    </div>
</body>
</html>