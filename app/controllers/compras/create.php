<?php
include('../../config.php');

$id_producto   = $_GET['id_producto'] ?? null;
$nro_compra    = $_GET['nro_compra'] ?? null;
$fecha_compra  = $_GET['fecha_compra'] ?? null;
$id_proveedor  = $_GET['id_proveedor'] ?? null;
$comprobante   = $_GET['comprobante'] ?? null;
$id_usuarios   = $_GET['id_usuarios'] ?? null;
$precio_compra = $_GET['precio_compra'] ?? null;
$cantidad      = $_GET['cantidad'] ?? null;
$stock_actual      = $_GET['stock_actual'] ?? null;

$fyh_creacion  = date('Y-m-d H:i:s');

$sentencia = $pdo->prepare("INSERT INTO tb_compras
    (id_producto, nro_compra, fecha_compra, id_proveedor, comprobante, id_usuarios, precio_compra, cantidad, fyh_creacion)
VALUES 
    (:id_producto, :nro_compra, :fecha_compra, :id_proveedor, :comprobante, :id_usuarios, :precio_compra, :cantidad, :fyh_creacion)");

$sentencia->bindParam(':id_producto', $id_producto);
$sentencia->bindParam(':nro_compra', $nro_compra);
$sentencia->bindParam(':fecha_compra', $fecha_compra);
$sentencia->bindParam(':id_proveedor', $id_proveedor);
$sentencia->bindParam(':comprobante', $comprobante);
$sentencia->bindParam(':id_usuarios', $id_usuarios);
$sentencia->bindParam(':precio_compra', $precio_compra);
$sentencia->bindParam(':cantidad', $cantidad);
$sentencia->bindParam(':fyh_creacion', $fyh_creacion);


$pdo->beginTRansaction();


if ($sentencia->execute()) {
    //actualiza el stock desde la compra
    $sentencia = $pdo->prepare("UPDATE tb_almacen SET stock=:stock WHERE id_producto = :id_producto");
    $sentencia->bindParam(':stock', $stock_total);
    $sentencia->bindParam(':id_producto', $id_producto);
    $sentencia->execute();

    $pdo->commit();

    session_start();
    //$_SESSION['mensaje'] = "Se registró la compra correctamente";
    $_SESSION['icono'] = "success";
?>
    <script> location.href = "<?php echo $URL;?>/compras"; </script>
<?php
} else {

    $pdo->rollBack();

    session_start();
    $_SESSION['mensaje'] = "Error: No se pudo registrar en la base de datos";
    $_SESSION['icono'] = "error";
?>
    <script> location.href = "<?php echo $URL;?>/compras/create.php"; </script>
<?php
}
//actualiza el stock desde la compra
$sentencia = $pdo->prepare("UPDATE tb_almacen SET stock=:stock WHERE id_producto = :id_producto");

?>

