<?php
include('../app/config.php');
include('../layout/sesion.php');

include('../layout/parte1.php');

include('../app/controllers/categorias/listado_de_categorias.php'); 
include('../app/controllers/almacen/cargar_producto.php'); 
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Actualizar producto</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-success">
                        <div class="card-header">
                             <h3 class="card-title">Llene con cuidado los datos</h3>
                            <div class="card-tools">
                              <button type="button" class="btn btn-tool" data-card-widget="collapse"> <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="../app/controllers/almacen/update.php" method="post" enctype="multipart/form-data">
                                <input type="text" value="<?php echo $id_producto_get; ?>" name="id_producto" hidden>
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">Código:</label>
                                                    <input type="text"  class="form-control" 
                                                           value="<?php echo $codigo; ?>" disabled>
                                                    <input type="text" name="codigo" value="<?php echo $codigo; ?>" hidden>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">Categoría:</label>
                                                    <div style="display: flex">
                                                        <select name="id_categorias" id="" class="form-control" required>
                                                        <?php
                                                        foreach ($categorias_datos as $categorias_dato){ 
                                                            $nombre_categora_tabla = $categorias_dato['nombre_categoria']; 
                                                            $id_categoria = $categorias_dato['id_categoria']?>
                                                        <option value="<?php echo $id_categoria; ?>" <?php if($nombre_categora_tabla == $nombre_categoria)
                                                            { ?> selected="selected" <?php } ?> >
                                                                <?php echo $nombre_categora_tabla;?>
                                                        </option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">Nombre del Producto:</label>
                                                    <input type="text" name="nombre" value="<?php echo $nombre;?>" class="form-control" required>
                                                    <input type="hidden" name="id_producto" value="<?php echo $id_producto_get; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">Usuario:</label>
                                                    <input type="text" class="form-control" value="<?php echo $email;?>" disabled>
                                                    <input type="text" name="id_usuarios" value="<?php echo $id_usuarios;?>" hidden>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">Descripción del producto:</label>
                                                    <textarea name="descripcion" class="form-control" rows="2"><?php echo $descripcion;?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            
                                            <label for="">Imagen del producto</label>
                                            <input type="file" name="image" class="form-control" id="file">
                                            <input type="text" name="image_text" value="<?php echo $imagen; ?>" hidden>
                                            <br>
                                            
                                            <output id="list" style="">
                                                <img src="<?php echo $URL . '/almacen/img_productos/' . $imagen; ?>" width="100px">
                                            </output>
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
                                            <input type="number" name="stock" class="form-control" value="<?php echo $stock;?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">Stock mínimo:</label>
                                            <input type="number" name="stock_minimo" class="form-control" value="<?php echo $stock_minimo;?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">Stock máximo:</label>
                                            <input type="number" name="stock_maximo" class="form-control" value="<?php echo $stock_maximo;?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">Precio compra:</label>
                                            <input type="number" step="0.01" name="precio_compra" class="form-control" value="<?php echo $precio_compra;?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">Precio venta:</label>
                                            <input type="number" step="0.01" name="precio_venta" class="form-control" value="<?php echo $precio_venta;?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">Fecha de ingreso:</label>
                                            <input type="date" name="fecha_ingreso" class="form-control" value="<?php echo $fecha_ingreso;?>" required>
                                        </div>
                                    </div>
                                </div>
                               
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="index.php" class="btn btn-secondary">Cancelar</a>
                                        <button type="submit" class="btn btn-success">Actualizar producto</button>
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