<?php
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');

include('../app/controllers/almacen/listado_de_productos.php'); 
include('../app/controllers/categorias/listado_de_categorias.php'); 
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Registro de un nuevo producto</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                             <h3 class="card-title">Llene con cuidado los datos</h3>
                            <div class="card-tools">
                              <button type="button" class="btn btn-tool" data-card-widget="collapse"> <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="../app/controllers/almacen/create.php" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">Código:</label>
                                                    <?php
                                                    function ceros($numero){
                                                        $len=0;
                                                        $cantidad_ceros = 5;
                                                        $aux=$numero;
                                                        $pos=strlen($numero);
                                                        $len=$cantidad_ceros-$pos;
                                                        for ($i=0;$i<$len;$i++){
                                                            $aux="0".$aux;
                                                        }
                                                        return $aux;
                                                    }
                                                    $contador_de_id_productos = 0;
                                                    foreach ($productos_datos as $productos_dato){ 
                                                        $contador_de_id_productos = $contador_de_id_productos +1;
                                                    }
                                                    ?>
                                                    <input type="text"  class="form-control" 
                                                           value="<?php echo "P-".ceros($contador_de_id_productos); ?>" disabled>
                                                    <input type="text" name="codigo" value="<?php echo "P-".ceros($contador_de_id_productos); ?>" hidden>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">Categoría:</label>
                                                    <div style="display: flex">
                                                        <select name="id_categorias" id="" class="form-control">
                                                        <?php
                                                        foreach ($categorias_datos as $categorias_dato){ ?>
                                                        <option value="<?php echo $categorias_dato ['id_categoria'];?>">
                                                            <?php echo $categorias_dato ['nombre_categoria'];?>
                                                        </option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                    <a href="<?php echo $URL;?>/categorias" class="btn btn-primary"><li class="fa fa-plus"></li></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">Nombre del Producto:</label>
                                                    <input type="text" name="nombre" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">Usuario:</label>
                                                    <input type="text" class="form-control" value="<?php echo $email_sesion;?>" disabled>
                                                    <input type="text" name="id_usuarios" value="<?php echo $id_usuario_sesion;?>" hidden>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">Descripción del producto:</label>
                                                    <textarea name="descripcion" class="form-control" rows="2"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Imagen del producto</label>
                                            <input type="file" class="form-control" name="imagen" id="file">
                                            <output id="list" style=""></output>
                                            <script>
                                            function archivo(evt) {
                                                var files = evt.target.files; 
                                                for (var i = 0, f; f = files[i]; i++) {
                                                    if (!f.type.match('image.*')) {
                                                        continue;
                                                    }
                                                    var reader = new FileReader();
                                                    reader.onload = (function (theFile) {
                                                        return function (e) {
                                                            document.getElementById("list").innerHTML = ['<img class="thumb thumbnail" src="', e.target.result, 
                                                            '" title="', escape(theFile.name), '" width="100%"/>'].join('');
                                                        };
                                                    })(f);
                                                    reader.readAsDataURL(f);
                                                }
                                            }
                                            document.getElementById('file').addEventListener('change', archivo, false);
                                            </script>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">Stock:</label>
                                            <input type="number" name="stock" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">Stock mínimo:</label>
                                            <input type="number" name="stock_minimo" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">Stock máximo:</label>
                                            <input type="number" name="stock_maximo" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">Precio compra:</label>
                                            <input type="number" step="0.01" name="precio_compra" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">Precio venta:</label>
                                            <input type="number" step="0.01" name="precio_venta" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">Fecha de ingreso:</label>
                                            <input type="date" name="fecha_ingreso" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                               
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="index.php" class="btn btn-secondary">Cancelar</a>
                                        <button type="submit" class="btn btn-primary">Guardar producto</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('../layout/mensajes.php'); ?>
<?php include('../layout/parte2.php'); ?>