<?php

include('../../config.php');

$codigo = $_POST['codigo'];
$id_categoria = $_POST['id_categorias'];
$nombre = $_POST['nombre'];
$id_usuarios = $_POST['id_usuarios'];
$descripcion = $_POST['descripcion'];
$stock = $_POST['stock'];
$stock_minimo = $_POST['stock_minimo'];
$stock_maximo = $_POST['stock_maximo'];
$precio_compra = $_POST['precio_compra'];
$precio_venta = $_POST['precio_venta'];
$fecha_ingreso = $_POST['fecha_ingreso'];
$id_producto = $_POST['id_producto'];
$image_text = $_POST['image_text'];



if($_FILES['image']['name'] != null){
    $nombreDelArchivo = date("Y-m-d-h-i-s");
    $image_text = $nombreDelArchivo."_".$_FILES['image']['name'];
    
    // CORRECCIÓN: Cambia $filename por $image_text
    $location = "../../../almacen/img_productos/".$image_text;

    move_uploaded_file($_FILES['image']['tmp_name'], $location);
}

$sentencia = $pdo->prepare("UPDATE tb_almacen 
    SET codigo = :codigo,
        nombre = :nombre,
        descripcion = :descripcion,
        stock = :stock,
        stock_minimo = :stock_minimo,
        stock_maximo = :stock_maximo,
        precio_compra = :precio_compra,
        precio_venta = :precio_venta,
        fecha_ingreso = :fecha_ingreso,
        imagen = :imagen,
        id_usuarios = :id_usuarios,
        id_categoria = :id_categoria,
        fyh_actualizacion = :fyh_actualizacion

    WHERE id_producto = :id_producto
");

$sentencia->bindParam(':codigo',$codigo);
$sentencia->bindParam(':nombre',$nombre);
$sentencia->bindParam(':descripcion',$descripcion);
$sentencia->bindParam(':stock',$stock);
$sentencia->bindParam(':stock_minimo',$stock_minimo);
$sentencia->bindParam(':stock_maximo',$stock_maximo);
$sentencia->bindParam(':precio_compra',$precio_compra);
$sentencia->bindParam(':precio_venta',$precio_venta);
$sentencia->bindParam(':fecha_ingreso',$fecha_ingreso);
$sentencia->bindParam(':imagen',$image_text);
$sentencia->bindParam(':id_usuarios',$id_usuarios);
$sentencia->bindParam(':id_categoria',$id_categoria);
$sentencia->bindParam(':fyh_actualizacion',$fechaHora);
$sentencia->bindParam(':id_producto',$id_producto);


if($sentencia->execute()){

    session_start();
    //$_SESSION['mensaje']="Se actualizó el producto correctamente";
    $_SESSION['icono']="success";

    header('Location: '.$URL.'/almacen/');

}else{

    session_start();
    $_SESSION['mensaje']="Error: no se pudo actualizar el producto";
    $_SESSION['icono']="error";

    header('Location: '.$URL.'/almacen/update.php?id='.$id_producto);

}