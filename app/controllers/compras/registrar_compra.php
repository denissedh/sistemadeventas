<?php
session_start();
include('../../config.php');

$id_producto = $_POST['id_producto'];
$id_proveedor = $_POST['id_proveedor'];
$cantidad_compra = $_POST['cantidad_compra'];
$precio_compra = $_POST['precio_compra'];
$total_compra = $_POST['total_compra'];
$fecha_compra = $_POST['fecha_compra'];
$comprobante = $_POST['comprobante'];
$id_usuario = $_SESSION['id_usuario'];

// Obtener stock actual
$sql = "SELECT stock FROM tb_almacen WHERE id_producto = '$id_producto'";
$query = $pdo->prepare($sql);
$query->execute();
$stock_actual = $query->fetchColumn();
$nuevo_stock = $stock_actual + $cantidad_compra;

try {
    $pdo->beginTransaction();

    // 1. Registrar compra
    $sql_compra = "INSERT INTO tb_compras 
        (nro_compra, id_producto, id_proveedor, cantidad, precio_compra, total, fecha_compra, comprobante, id_usuario)
        VALUES (:nro, :prod, :prov, :cant, :precio, :total, :fecha, :comp, :user)";
    $stmt = $pdo->prepare($sql_compra);
    $stmt->execute([
        ':nro' => $_POST['nro_compra'],
        ':prod' => $id_producto,
        ':prov' => $id_proveedor,
        ':cant' => $cantidad_compra,
        ':precio' => $precio_compra,
        ':total' => $total_compra,
        ':fecha' => $fecha_compra,
        ':comp' => $comprobante,
        ':user' => $id_usuario
    ]);

    // 2. Actualizar stock
    $sql_update = "UPDATE tb_almacen SET stock = :nuevo WHERE id_producto = :id";
    $stmt = $pdo->prepare($sql_update);
    $stmt->execute([':nuevo' => $nuevo_stock, ':id' => $id_producto]);

    $pdo->commit();
    $_SESSION['mensaje'] = "Compra registrada exitosamente";
    $_SESSION['icono'] = "success";
    header('Location: ' . $URL . '/compras');
} catch (Exception $e) {
    $pdo->rollBack();
    $_SESSION['mensaje'] = "Error: " . $e->getMessage();
    $_SESSION['icono'] = "error";
    header('Location: ' . $URL . '/compras/nueva_compra.php');
}