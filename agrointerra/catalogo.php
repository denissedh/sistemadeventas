<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Productos - Agrointerra</title>
    <link href="https://fonts.googleapis.com/css2?family=Zilla+Slab:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'nav.php'; ?>

    <div class="contenedor-pagina">
        <h1>Catálogo de Productos</h1>
        <p>Selecciona un producto para ver más detalles</p>

        <div class="grid-productos">
            <?php
            // Ejemplo de productos (reemplazar por consulta a BD)
            $productos = [
                ['id'=>1,'nombre'=>'Aceite de Oliva','precio'=>'$180.00','litros'=>'1 L','imagen'=>'aceite.jpg'],
                ['id'=>2,'nombre'=>'Miel de Abeja','precio'=>'$120.00','litros'=>'500 ml','imagen'=>'miel.jpg'],
                ['id'=>3,'nombre'=>'Vinagre Orgánico','precio'=>'$95.00','litros'=>'750 ml','imagen'=>'vinagre.jpg']
            ];
            foreach ($productos as $p):
            ?>
            <div class="tarjeta-producto">
                <img src="imagenes/<?= $p['imagen'] ?>" alt="<?= $p['nombre'] ?>">
                <h3><?= $p['nombre'] ?></h3>
                <p class="precio"><?= $p['precio'] ?></p>
                <p>Presentación: <?= $p['litros'] ?></p>
                <a href="producto.php?id=<?= $p['id'] ?>" class="btn-mas-info">Más Información</a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>