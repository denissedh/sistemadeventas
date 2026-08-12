<!DOCTYPE html>
<html>
<head>
    <title>Agregar al carrito</title>
</head>
<body>
    <h3>Agregar producto al carrito</h3>

    <form action="../controladores/CarritoController.php" method="POST">
        <input type="hidden" name="accion" value="registrar_carrito">
        <input type="hidden" name="producto_id" value="1"> <!-- Cambia por el ID real -->

        <label>Cantidad:</label>
        <input type="number" name="cantidad" min="1" value="1" required>

        <button type="submit">Agregar al carrito</button>
    </form>
</body>
</html>