<?php
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');

include('../app/controllers/almacen/listado_de_productos.php');
include('../app/controllers/proveedores/listado_de_proveedores.php');
include('../app/controllers/compras/cargar_compra.php');
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Compra Nro <?php echo $nro_compra; ?></h1>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Datos de la Compra</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"> <i class="fas fa-minus"></i></button>
                                    </div>
                                </div>

                                <div class="card-body" style="display: block;">

                                    <!-- Formulario de carga de datos -->
                                    <div class="row" style="font-size: 12px;">
                                        <div class="col-md-9">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <input type="text" id="id_producto" hidden>
                                                        <label for="">Código</label>
                                                        <input type="text" class="form-control" value="<?= $codigo;?>" id="codigo" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">Categoria</label>
                                                        <input type="text" class="form-control" value="<?= $nombre_categoria;?>" id="categoria" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">Nombre del Producto</label>
                                                        <input type="text" class="form-control" value="<?= $nombre_producto;?>" id="nombre_producto" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="">Usuario</label>
                                                        <input type="text" class="form-control" value="<?= $nombre_usuarios_producto;?>" id="usuario" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="form-group">
                                                        <label for="">Descripción del producto</label>
                                                        <textarea name="descripcion" id="descripcion_producto"  cols="30" rows="2" class="form-control"  disabled ><?= $descripcion;?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="">Stock</label>
                                                        <input type="number" name="stock" value="<?= $stock;?>" id="stock" class="form-control" style="background-color: #fff819" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="">Stock Mínimo</label>
                                                        <input type="number" value="<?= $stock_minimo;?>" name="stock_minimo"  class="form-control" id="stock_minimo" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="">Stock Máximo</label>
                                                        <input type="number" value="<?= $stock_maximo;?>" name="stock_maximo"  class="form-control" id="stock_maximo" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="">Precio Compra</label>
                                                        <input type="text" value="<?= $precio_compra_producto;?>" name="precio_compra" class="form-control" id="precio_compra" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="">Precio Venta</label>
                                                        <input type="text"  value="<?= $precio_venta_producto;?>" name="precio_venta" class="form-control" id="precio_venta" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="">Fecha de Ingreso</label>
                                                        <input type="date" value="<?= $fecha_ingreso;?>" name="fecha_ingreso" class="form-control" id="fecha_ingreso" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Imagen del Producto</label>
                                                <br>
                                                <img src="<?php echo $URL."/almacen/img_productos/".$imagen;?>"  id="imagen_producto_formulario" 
                                                style="max-width: 100%; height: auto; margin-top: 8px;" alt="Imagen del producto">
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    <!-- Datos del Proveedor -->
                                    <div style="display: flex; align-items: center; margin-bottom: 15px;">
                                        <h5>Datos del Proveedor </h5>
                                    </div>
                                    <!-- Campos para mostrar el proveedor seleccionado -->
                                    <div class="row mt-3">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" id="id_proveedor" hidden>
                                                <label>Nombre del proveedor</label>
                                                <input type="text" class="form-control" value="<?= $nombre_proveedor_tabla;?>" id="nombre_proveedor" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Celular</label>
                                                <input type="text" class="form-control" value="<?= $celular_proveedor;?>" id="celular_proveedor" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Teléfono</label>
                                                <input type="text" class="form-control" value="<?= $telefono_proveedor;?>" id="telefono_proveedor" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Empresa</label>
                                                <input type="text" class="form-control" value="<?= $empresa;?>" id="empresa_proveedor" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" class="form-control" value="<?= $email_proveedor;?>" id="email_proveedor" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Dirección</label>
                                                <input type="text" class="form-control" value="<?= $direccion_proveedor;?>" id="direccion_proveedor" disabled>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Detalle de la Compra</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="col-md-12">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="">Número de la compra</label>
                                            <input type="text" value="<?php echo $id_compra_get;?>" style="text-align: center" class="form-control" disabled>
                                            <input type="text" value="<?php echo $id_compra_get;?>" id="nro_compra" hidden>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Fecha de la compra</label>
                                            <input type="date" class="form-control" value="<?= $fecha_compra;?>" id="fecha_compra" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Comprobante de la compra</label>
                                            <input type="text" class="form-control" value="<?= $comprobante;?>" id="comprobante" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Precio de la compra</label>
                                           <input type="text" class="form-control" value="<?= $precio_compra;?>" id="precio_compra_controlador" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Cantidad de la compra</label>
                                           <input type="number" value="<?= $cantidad;?>" id="cantidad" style="text-align: center" class="form-control" min="1" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Usuario</label>
                                        <input type="text" class="form-control" value="<?php echo $nombres_usuarios;?>" disabled>
                                    </div> 
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
                <div id="respuesta_create"></div>
            </div>
        </div>
    </div>
</div>

<?php include('../layout/mensajes.php'); ?>
<?php include('../layout/parte2.php'); ?>

<!-- Script de inicialización igual al vídeo -->
<script>
  $(function () {
    // Inicializar tabla de productos
    $("#tabla_productos").DataTable({
      "pageLength": 5,
      "language": {
        "search": "Buscar:",
        "lengthMenu": "Mostrar _MENU_ registros",
        "zeroRecords": "No se encontraron resultados",
        "info": "Mostrando página _PAGE_ de _PAGES_",
        "infoEmpty": "No hay registros disponibles",
        "paginate": {
          "first": "Primero",
          "last": "Último",
          "next": "Siguiente",
          "previous": "Anterior"
        }
      }
    });

    // Inicializar tabla de proveedores
    $("#tabla_proveedores").DataTable({
      "pageLength": 5,
      "language": {
        "search": "Buscar:",
        "lengthMenu": "Mostrar _MENU_ registros",
        "zeroRecords": "No se encontraron resultados",
        "info": "Mostrando página _PAGE_ de _PAGES_",
        "infoEmpty": "No hay registros disponibles",
        "paginate": {
          "first": "Primero",
          "last": "Último",
          "next": "Siguiente",
          "previous": "Anterior"
        }
      }
    });

    // Calcular stock nuevo automáticamente
    $('#cantidad').keyup(function(){
        var stock_actual = parseInt($('#stock_actual').val()) || 0;
        var cantidad = parseInt($(this).val()) || 0;
        var stock_nuevo = stock_actual + cantidad;
        $('#stock_total').val(stock_nuevo);
    });

  });
</script>