<?php
include 'config.php';
$id = $_GET['id'] ?? 0;

// Datos de ejemplo (consulta real a BD)
$producto = [
    'id'=>$id,
    'nombre'=>'Aceite de Oliva Extra Virgen',
    'precio'=>'$180.00',
    'cantidad'=>'Disponible',
    'litros'=>'1 Litro',
    'ingredientes'=>'Aceitunas de variedad cornicabra 100%',
    'propiedades'=>'Rico en antioxidantes, ayuda a reducir colesterol, protege el corazón.',
    'imagen'=>'aceite.jpg'
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $producto['nombre'] ?> - Agrointerra</title>
    <link href="https://fonts.googleapis.com/css2?family=Zilla+Slab:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'nav.php'; ?>

    <div class="contenedor-pagina">
        <div class="detalle-producto">
            <img src="imagenes/<?= $producto['imagen'] ?>" alt="<?= $producto['nombre'] ?>">
            <div class="info-producto">
                <h2><?= $producto['nombre'] ?></h2>
                <p class="precio-grande"><?= $producto['precio'] ?></p>
                <ul>
                    <li><strong>Presentación:</strong> <?= $producto['litros'] ?></li>
                    <li><strong>Disponibilidad:</strong> <?= $producto['cantidad'] ?></li>
                    <li><strong>Ingredientes:</strong> <?= $producto['ingredientes'] ?></li>
                    <li><strong>Propiedades y beneficios:</strong> <?= $producto['propiedades'] ?></li>
                </ul>
                <form action="carrito.php" method="get">
                    <input type="hidden" name="agregar" value="<?= $producto['id'] ?>">
                    <label>Cantidad: <input type="number" name="cantidad" value="1" min="1"></label>
                    <button type="submit" class="btn-comprar">🛒 Agregar al Carrito</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>