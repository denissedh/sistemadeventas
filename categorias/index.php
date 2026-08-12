<?php
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');
include('../app/controllers/categorias/listado_de_categorias.php');
?>

<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Listado de Categorías
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-create">
                          <i class="fa fa-plus"></i> Nuevo
                        </button>
                    </h1>
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
                            <h3 class="card-title">Categorías Registradas</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th><center>Nro</center></th>
                                    <th><center>Nombre de la Categoría</center></th>
                                    <th><center>Acciones</center></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $contador = 0;
                                foreach ($categorias_datos as $categoria_dato){
                                    $id_categoria = $categoria_dato['id_categoria'];
                                    $nombre_categoria = $categoria_dato['nombre_categoria'];
                                ?>
                                <tr>
                                    <td><center><?php echo $contador + 1; ?></center></td>
                                    <td><center><?php echo $nombre_categoria; ?></center></td>
                                    <td>
                                        <center>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-success" data-toggle="modal" 
                                                        data-target="#modal-update<?php echo $id_categoria; ?>">
                                                    <i class="fa fa-pencil-alt"></i> Editar
                                                </button>

                                                <div class="modal fade" id="modal-update<?php echo $id_categoria; ?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color: #28a745; color: white;">
                                                                <h4 class="modal-title">Actualizar Categoría</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group" style="text-align: left;">
                                                                            <label for="">Nombre de la Categoría</label>
                                                                            <input type="text" id="nombre_categoria<?php echo $id_categoria; ?>"
                                                                             value="<?php echo $nombre_categoria; ?>" class="form-control">
                                                                            <small style="color:red; display: none" id="lbl_update
                                                                            <?php echo $id_categoria; ?>">*Este campo es requerido</small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                                <button type="button" class="btn btn-success" id="btn_update<?php echo $id_categoria; ?>">Actualizar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <script>
                                                    $('#btn_update<?php echo $id_categoria; ?>').click(function (){
                                                        var nombre_categoria = $('#nombre_categoria<?php echo $id_categoria; ?>').val();
                                                        var id_categoria = '<?php echo $id_categoria; ?>';
                                                        
                                                        if(nombre_categoria == "") {
                                                            $('#nombre_categoria<?php echo $id_categoria; ?>').focus();
                                                            $('#lbl_update<?php echo $id_categoria; ?>').css('display','block');
                                                        } else {
                                                            var url = "../app/controllers/categorias/update_de_categorias.php";
                                                            $.get(url, {nombre_categoria: nombre_categoria, id_categoria: id_categoria}, function (datos) {
                                                                $('#respuesta_update<?php echo $id_categoria; ?>').html(datos);
                                                            });
                                                        }
                                                    });
                                                </script>
                                                <div id="respuesta_update<?php echo $id_categoria; ?>"></div>
                                            </div>
                                        </center>
                                    </td>
                                </tr>
                                <?php
                                $contador++;
                                }
                                ?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th><center>Nro</center></th>
                                    <th><center>Nombre de la Categoría</center></th>
                                    <th><center>Acciones</center></th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div id="respuesta_create"></div>

<?php include('../layout/mensajes.php'); ?>
<?php include('../layout/parte2.php'); ?>

<script>
    $(function () {
        $('#example1').DataTable({
            "pageLength": 5,
            "language": {
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Categorías",
                "infoEmpty": "Mostrando 0 a 0 de 0 Categorías",
                "infoFiltered": "(Filtrado de _MAX_ total Categorías)",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Categorías",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscador:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            "responsive": true, "lengthChange": true, "autoWidth": false,
            buttons: [{
                extend: 'collection',
                text: 'Reportes',
                buttons: [{ text: 'Copiar', extend: 'copy' }, { extend: 'pdf' }, { extend: 'csv' }, { extend: 'excel' }, { text: 'Imprimir', extend: 'print' }]
            },
            { extend: 'colvis', text: 'Visor de columnas' }]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>

<div class="modal fade" id="modal-create">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #007bff; color: white;">
              <h4 class="modal-title">Creación de Nueva Categoría</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Nombre de la Categoría</label>
                        <input type="text" id="nombre_categoria_create" class="form-control">
                        <small style="color:red;display: none" id="lbl_create">*Este campo es requerido</small>
                    </div>
                </div>
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-primary" id="btn_create">Guardar</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('#btn_create').click(function () {
        var nombre_categoria = $('#nombre_categoria_create').val();

        if(nombre_categoria == ""){
            $('#nombre_categoria_create').focus();
            $('#lbl_create').css('display','block');
        }else{
            var url = "../app/controllers/categorias/registro_de_categorias.php";
            $.get(url, {nombre_categoria:nombre_categoria}, function (datos) {
                $('#respuesta').html(datos);
            });
        }
    });
</script>
<div id="respuesta"></div>