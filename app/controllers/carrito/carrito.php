<?php
session_start();
require_once __DIR__ . "/../conexion.php";

class CarritoController {

    // Método para registrar/agregar producto al carrito
    public function registrar() {
        global $conn;

        // 1. Validar que la solicitud sea por POST
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            echo json_encode(["estado" => "error", "mensaje" => "Método no permitido"]);
            return;
        }

        // 2. Recibir y limpiar datos del formulario
        $producto_id = intval(trim($_POST["producto_id"] ?? 0));
        $cantidad = intval(trim($_POST["cantidad"] ?? 1));
        $usuario_id = $_SESSION["usuario_id"] ?? 1; // Cambia por tu sistema de usuarios

        // 3. Validar datos obligatorios
        if ($producto_id <= 0 || $cantidad <= 0) {
            echo json_encode(["estado" => "error", "mensaje" => "Datos inválidos"]);
            return;
        }

        // 4. Verificar que el producto exista y tenga stock
        $stmt = $conn->prepare("SELECT precio, stock FROM productos WHERE id = ?");
        $stmt->bind_param("i", $producto_id);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows === 0) {
            echo json_encode(["estado" => "error", "mensaje" => "Producto no existe"]);
            return;
        }

        $producto = $resultado->fetch_assoc();
        if ($producto["stock"] < $cantidad) {
            echo json_encode(["estado" => "error", "mensaje" => "Stock insuficiente"]);
            return;
        }
        $precio_unitario = $producto["precio"];
        $stmt->close();

        // 5. Verificar si el producto YA ESTÁ en el carrito del usuario
        $stmt = $conn->prepare("SELECT id, cantidad FROM carrito WHERE usuario_id = ? AND producto_id = ?");
        $stmt->bind_param("ii", $usuario_id, $producto_id);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            // 6. Si existe: ACTUALIZAR cantidad
            $fila = $resultado->fetch_assoc();
            $nueva_cantidad = $fila["cantidad"] + $cantidad;

            $stmt_actualizar = $conn->prepare("UPDATE carrito SET cantidad = ? WHERE id = ?");
            $stmt_actualizar->bind_param("ii", $nueva_cantidad, $fila["id"]);
            $stmt_actualizar->execute();
            $stmt_actualizar->close();
            $mensaje = "Cantidad actualizada en el carrito";
        } else {
            // 7. Si NO existe: INSERTAR nuevo registro
            $stmt_insertar = $conn->prepare("INSERT INTO carrito (usuario_id, producto_id, cantidad, precio_unitario) VALUES (?, ?, ?, ?)");
            $stmt_insertar->bind_param("iiid", $usuario_id, $producto_id, $cantidad, $precio_unitario);
            $stmt_insertar->execute();
            $stmt_insertar->close();
            $mensaje = "Producto agregado al carrito correctamente";
        }
        $stmt->close();

        // 8. Respuesta exitosa
        echo json_encode([
            "estado" => "exito",
            "mensaje" => $mensaje,
            "carrito_total" => $this->calcularTotal($usuario_id)
        ]);
    }

    // Método auxiliar para calcular total del carrito
    private function calcularTotal($usuario_id) {
        global $conn;
        $total = 0;
        $stmt = $conn->prepare("SELECT c.cantidad, c.precio_unitario FROM carrito c WHERE c.usuario_id = ?");
        $stmt->bind_param("i", $usuario_id);
        $stmt->execute();
        $resultado = $stmt->get_result();

        while ($fila = $resultado->fetch_assoc()) {
            $total += $fila["cantidad"] * $fila["precio_unitario"];
        }
        $stmt->close();
        return number_format($total, 2);
    }
}

// EJECUTAR la acción cuando se llame al controlador
if (isset($_POST["accion"]) && $_POST["accion"] === "registrar_carrito") {
    $controlador = new CarritoController();
    $controlador->registrar();
}
?>