<?php
// Include the main TCPDF library


require_once('../app/TCPDF-main/tcpdf.php');
include('../app/config.php');
include('../app/controllers/ventas/literal.php');

session_start();

$nombres_sesion = "Usuario"; 

if (isset($_SESSION['sesion_email'])) {
    // echo "si existe sesion de ".$_SESSION['sesion_email'];
    $email_sesion = $_SESSION['sesion_email'];

    $sql = "SELECT us.id_usuarios as id_usuarios, us.nombres as nombres, us.email as email, rol.rol as rol
            FROM tb_usuarios as us INNER JOIN tb_roles as rol ON us.id_rol = rol.id_rol WHERE email='$email_sesion'";

    $query = $pdo->prepare($sql);
    $query->execute();

    $usuarios = $query->fetchAll(PDO::FETCH_ASSOC);

    foreach ($usuarios as $usuario) {
        $id_usuario_sesion = $usuario['id_usuarios'];
        $nombres_sesion = $usuario['nombres'];
        $rol_sesion = $usuario['rol'];
    }

} else {
    echo "no existe sesion";
    header("Location: ".$URL."/login");
}

$id_venta_get = isset($_GET['id_venta']) ? $_GET['id_venta'] : '';

$sql_ventas = "SELECT *, cli.nombre_cliente as nombre_cliente, cli.nit_ci_cliente as nit_ci_cliente 
FROM tb_ventas as ve INNER JOIN tb_clientes as cli ON cli.id_cliente = ve.id_cliente where ve.id_venta = '$id_venta_get' ";
$query_ventas = $pdo->prepare($sql_ventas);
$query_ventas->execute();
$ventas_datos = $query_ventas->fetchAll(PDO::FETCH_ASSOC);

foreach($ventas_datos as $ventas_dato){
    $nro_venta_get = $ventas_dato['nro_venta'];
}
{
    $fyh_creacion = $ventas_dato['fyh_creacion'];
    $nit_ci_cliente = $ventas_dato['nit_ci_cliente'];
    $nombre_cliente = $ventas_dato['nombre_cliente'];
    $total_pagado = $ventas_dato['total_pagado'];
}

$monto_literal = numtoletras($total_pagado);

$fecha = date("d/m/Y", strtotime($fyh_creacion));

// Crear nuevo documento PDF
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, array(215,279), true, 'UTF-8', false);

// Información del documento
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('Sistema de Ventas Hilari Web');
$pdf->setTitle('Factura de Venta');
$pdf->setSubject('Factura');
$pdf->setKeywords('TCPDF, PDF, factura, ventas');

// Quitar encabezado y pie por defecto
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// Fuente y márgenes
$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->setMargins(15, 15, 15);
$pdf->setAutoPageBreak(true, 5);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// Idioma
if (@file_exists(dirname(__FILE__).'/lang/spa.php')) {
    require_once(dirname(__FILE__).'/lang/spa.php');
    $pdf->setLanguageArray($l);
}

// Fuente principal
$pdf->setFont('Helvetica', '', 12);

// Agregar página
$pdf->AddPage();

// create some HTML content
$html = '
<table border="0" style="font-size: 10px">
<tr>
    <td style="text-align: center;width: 230px">
        <img src="../public/images/Agrointerra.png.jpeg" width="80px" alt=""><br><br>
        <b>SISTEMA DE VENTAS AGROINTERRA</b> <br>
        Calle Hortalizas #3935, Colonia San Juan <br>
        C.P. 31820 Ascensión, Chihuahua<br>
        636 101 7629
    </td>
    <td style="width: 150px"></td>
    <td style="font-size: 16px;width: 290px"><br><br><br>
        <b>NIT: </b>10001099920 <br>
        <b>Nro factura:</b> '.$id_venta_get.' <br>
        <b>Nro de autorización: </b>100020029930
        <p style="text-align: center"><B>ORIGINAL</B></p>
    </td>
</tr>
</table>

<p style="text-align: center;font-size: 25px"><b>FACTURA</b></p>

<div style="border: 1px solid #000000">
<table border="0" cellpadding="6px">
<tr>
    <td><b>Fecha:</b> '.$fecha.'</td>
    <td></td>
    <td><b>Nit/CI: </b>'.$nit_ci_cliente.'</td>
</tr>
<tr>
    <td colspan="3"><b>Señor(es): </b>'.$nombre_cliente.' </td>
</tr>
</table>
</div>
<br>

<table border="1" cellpadding="5" cellspacing="0" style="font-size: 12px; width:100%; margin-top:8px;">
<tr style="text-align: center;background-color: #f0f0f0;font-weight:bold;">
    <th width="6%">Nro</th>
    <th width="18%">Producto</th>
    <th width="38%">Descripción</th>
    <th width="10%">Cantidad</th>
    <th width="14%">Precio Unitario</th>
    <th width="14%">Sub total</th>
</tr>
';
$contador_de_carrito = 0;
$cantidad_total = 0;
$precio_unitario_total= 0;
$precio_total = 0;

$sql_carrito = "SELECT *,pro.nombre as nombre_producto, pro.descripcion as descripcion, pro.precio_venta as precio_venta, pro.stock as stock, pro.id_producto as id_producto 
FROM tb_carrito AS carr INNER JOIN tb_almacen as pro ON carr.id_producto = pro.id_producto 
WHERE nro_venta = '$nro_venta_get' ORDER BY id_carrito ASC ";

$query_carrito = $pdo->prepare($sql_carrito);
$query_carrito->execute();
$carrito_datos = $query_carrito->fetchAll(PDO::FETCH_ASSOC);
foreach ($carrito_datos as $carrito_dato) {
    $id_carrito = $carrito_dato['id_carrito'];
    $contador_de_carrito = $contador_de_carrito + 1;
    $cantidad_total = $cantidad_total + $carrito_dato['cantidad'];
    $precio_unitario_total = $precio_unitario_total + floatval($carrito_dato['precio_venta']);
    $subtotal = $carrito_dato['cantidad'] * $carrito_dato['precio_venta'];
    $precio_total = $precio_total + $subtotal;

    $html .= '
    <tr>
        <td style="text-align: center">'.$contador_de_carrito.'</td>
        <td>'.$carrito_dato['nombre_producto'].'</td>
        <td>'.$carrito_dato['descripcion'].'</td>
        <td style="text-align: center">'.$carrito_dato['cantidad'].'</td>
        <td style="text-align: center">Bs. '.$carrito_dato['precio_venta'].'</td>
        <td style="text-align: center">Bs. '.$subtotal.'</td>
    </tr>
    ';
}

$html .= '
<tr>
    <td colspan="3" style="text-align: right;background-color: #d6d6d6"><b>Total</b></td>
    <td style="text-align: center;background-color: #d6d6d6">'.$cantidad_total.'</td>
    <td style="text-align: center;background-color: #d6d6d6">Bs. '.$precio_unitario_total.'</td>
    <td style="text-align: center;background-color: #d6d6d6">Bs. '.$precio_total.'</td>
</tr>
</table>


<p style="text-align: right">
    <b>Monto Total: </b> Bs. '.$precio_total.'
</p>
<p>
<b>Son: </b>'.$monto_literal.'
</p>
<br>
--------------------------------------------------------------------------------<br>
<b>USUARIO:</b> '.$nombres_sesion.' <br>

<p style="text-align: center">"ESTA FACTURA CONTRIBUYE AL DESARROLLO DEL PAÍS, EL USO ILÍCITO DE ÉSTA SERÁ SANCIONADO DE ACUERDO A LA LEY"
</p>
<p style="text-align: center"><b>GRACIAS POR SU PREFERENCIA</b></p>
';

// Escribir contenido HTML en el PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Código QR en esquina inferior derecha
$style = array(
    'border' => 0,
    'vpadding' => '3',
    'hpadding' => '3',
    'fgcolor' => array(0, 0, 0),
    'bgcolor' => false,
    'module_width' => 1,
    'module_height' => 1
);

$QR = 'Factura realizada por el sistema de ventas AGROINTERRA, al cliente '.$nombre_cliente.' con nit/ci: '.$nit_ci_cliente.' 
generada el: '.$fecha.' con el monto total de: '.$precio_total.' ';
$pdf->write2DBarcode($QR, 'QRCODE,L', 165, 230, 45, 45, $style);

// Salida del PDF
$pdf->Output('Factura_Venta_'.$nro_venta_get.'.pdf', 'I');
?>