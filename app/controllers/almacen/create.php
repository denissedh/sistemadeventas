<?php
include('../../config.php');

$codigo = $_POST['codigo'] ?? '';
$id_categorias = $_POST['id_categorias'] ?? '';
$nombre = $_POST['nombre'] ?? '';
$id_usuarios = $_POST['id_usuarios'] ?? '';
$descripcion = $_POST['descripcion'] ?? '';
$stock = $_POST['stock'] ?? 0;
$stock_minimo = $_POST['stock_minimo'] ?? 0;
$stock_maximo = $_POST['stock_maximo'] ?? 0;
$precio_compra = $_POST['precio_compra'] ?? 0;
$precio_venta = $_POST['precio_venta'] ?? 0;
$fecha_ingreso = $_POST['fecha_ingreso'] ?? null;
$fechaHora = date('Y-m-d H:i:s'); 
$filename = "";

if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === 0 && $_FILES['imagen']['name'] != "") {
    
    $directorioDestino = $_SERVER['DOCUMENT_ROOT'] . '/www.sistemadeventas.com/almacen/img_productos/';
    
    $nombreBase = pathinfo($_FILES['imagen']['name'], PATHINFO_FILENAME);
    $extension = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
    $nombreLimpio = preg_replace('/[^a-zA-Z0-9]/', '_', $nombreBase);
    
    $filename = date("YmdHis") . "_" . $nombreLimpio . "." . $extension;
    $location = $directorioDestino . $filename;
        
    if(!move_uploaded_file($_FILES['imagen']['tmp_name'], $location)){
        die("Error al mover el archivo.");
    }
}

$sentencia = $pdo->prepare("INSERT INTO tb_almacen 
(codigo, id_categoria, nombre, id_usuarios, descripcion, stock, stock_minimo, stock_maximo, precio_compra, precio_venta, fecha_ingreso, imagen, fyh_creacion) 
VALUES (:codigo, :id_categoria, :nombre, :id_usuarios, :descripcion, :stock, :stock_minimo, :stock_maximo, :precio_compra, :precio_venta, :fecha_ingreso, :imagen, :fyh_creacion)");

$sentencia->bindParam(':codigo', $codigo);
$sentencia->bindParam(':id_categoria', $id_categorias);
$sentencia->bindParam(':nombre', $nombre);
$sentencia->bindParam(':id_usuarios', $id_usuarios);
$sentencia->bindParam(':descripcion', $descripcion);
$sentencia->bindParam(':stock', $stock);
$sentencia->bindParam(':stock_minimo', $stock_minimo);
$sentencia->bindParam(':stock_maximo', $stock_maximo);
$sentencia->bindParam(':precio_compra', $precio_compra);
$sentencia->bindParam(':precio_venta', $precio_venta);
$sentencia->bindParam(':fecha_ingreso', $fecha_ingreso);
$sentencia->bindParam(':imagen', $filename);
$sentencia->bindParam(':fyh_creacion', $fechaHora);

session_start();
if ($sentencia->execute()) {
    //$_SESSION['mensaje'] = "Se registró el producto correctamente";
    header('Location: ' . $URL . '/almacen/');
} else {
    $_SESSION['mensaje'] = "Error: no se pudo registrar el producto";
    header('Location: ' . $URL . '/almacen/create.php');
}
?>