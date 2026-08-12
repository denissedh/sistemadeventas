<?php
include ('../../config.php');

// Recibimos los datos
$id_compra = $_GET['id_compra'];
$id_producto_nuevo = $_GET['id_producto'];
$nro_compra = $_GET['nro_compra'];
$fecha_compra = $_GET['fecha_compra'];
$id_proveedor = $_GET['id_proveedor'];
$comprobante = $_GET['comprobante'];
$id_usuarios = $_GET['id_usuarios']; 
$precio_compra = $_GET['precio_compra'];
$cantidad_nueva = $_GET['cantidad_compra'];
$stock_total = $_GET['stock_total'];

// PASO 1: OBTENER LOS VALORES ORIGINALES DE LA COMPRA
$consulta = $pdo->prepare("SELECT id_producto, cantidad FROM tb_compras WHERE id_compra = :id_compra");
$consulta->bindParam(':id_compra', $id_compra);
$consulta->execute();
$compra_original = $consulta->fetch(PDO::FETCH_ASSOC);

$id_producto_original = $compra_original['id_producto'];
$cantidad_original = $compra_original['cantidad'];

$pdo->beginTransaction();

// PASO 2: Actualizar la compra
$sentencia = $pdo->prepare("UPDATE tb_compras 
SET id_producto=:id_producto,
    nro_compra=:nro_compra,
    fecha_compra=:fecha_compra,
    id_proveedor=:id_proveedor,
    comprobante=:comprobante,
    id_usuarios=:id_usuarios,
    precio_compra=:precio_compra,
    cantidad=:cantidad,
    fyh_actualizacion=:fyh_actualizacion 
WHERE id_compra=:id_compra");

$sentencia->bindParam('id_producto',$id_producto_nuevo);
$sentencia->bindParam('nro_compra',$nro_compra);
$sentencia->bindParam('fecha_compra',$fecha_compra);
$sentencia->bindParam('id_proveedor',$id_proveedor);
$sentencia->bindParam('comprobante',$comprobante);
$sentencia->bindParam('id_usuarios',$id_usuarios); 
$sentencia->bindParam('precio_compra',$precio_compra);
$sentencia->bindParam('cantidad',$cantidad_nueva);
$sentencia->bindParam('fyh_actualizacion',$fechaHora);
$sentencia->bindParam('id_compra',$id_compra);

if($sentencia->execute()){
    
    // PASO 3: SOLO MODIFICAR STOCK SI CAMBIÓ PRODUCTO O CANTIDAD
    if ($id_producto_nuevo != $id_producto_original || $cantidad_nueva != $cantidad_original) {
        
        // RESTAR la cantidad original al producto antiguo
        $restar = $pdo->prepare("UPDATE tb_almacen SET stock = stock - :cantidad WHERE id_producto = :id_producto");
        $restar->bindParam(':cantidad', $cantidad_original);
        $restar->bindParam(':id_producto', $id_producto_original);
        $restar->execute();

        // SUMAR la nueva cantidad al producto nuevo
        $sumar = $pdo->prepare("UPDATE tb_almacen SET stock = stock + :cantidad WHERE id_producto = :id_producto");
        $sumar->bindParam(':cantidad', $cantidad_nueva);
        $sumar->bindParam(':id_producto', $id_producto_nuevo);
        $sumar->execute();
    }

    $pdo->commit();

    session_start();
    $_SESSION['mensaje'] = "Se actualizó la compra correctamente";
    $_SESSION['icono'] = "success";
    ?>
    <script>
        location.href = "<?php echo $URL;?>/compras";
    </script>
    <?php
}else{
    $pdo->rollBack();

    session_start();
    $_SESSION['mensaje'] = "Error: no se pudo actualizar la compra en la base de datos";
    $_SESSION['icono'] = "error";
    ?>
    <script>
        location.href = "<?php echo $URL;?>/compras";
    </script>
    <?php
}
?>