<?php
// session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once "head/head_views.php"; ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="css/estilos generales.css">
    <link rel="stylesheet" href="css/estilosPersonalizadosSelect2.css">
    <title>PatrimoniumAPP || Bancos </title>
</head>
<body>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Formulario Agregar Servicios</h3>

                            <div class="card-tools">
                                <!-- This will cause the card to maximize when clicked -->
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                                <!-- This will cause the card to collapse when clicked -->
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                <!-- This will cause the card to be removed when clicked -->
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form id="serviciosForm">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="nombre_servicio">Nombre Servicio</label>
                                            <input type="text" name="nombre_servicio" id="nombre_servicio" class="form-control" placeholder="Nombre Servicio" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary" id="btn_insertar_servicio">Insert</button>
                                    </div>
                                </div>
    
                            </form>
                            <div id="result"></div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Servicios Patrimoniun</h3>

                            <div class="card-tools">
                                <!-- This will cause the card to maximize when clicked -->
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                                <!-- This will cause the card to collapse when clicked -->
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                <!-- This will cause the card to be removed when clicked -->
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="serviciosTable"class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Identificador Del Servicio</th>
                                        <th>Nombre Servicio</th>
                                        <th>Fecha Creacion</th>
                                        <th colspan="2">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="servicios_patrimonium"></tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>

            <div class="modal fade" id="modalActualizarServicio" tabindex="-1" role="dialog" aria-labelledby="modalActualizarServicioLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalActualizarServicioLabel">Actualizar Servicio</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <!-- <div class="form-group">
                                    <label for="id_servicio">ID Servicio</label>
                                </div> -->
                                <input type="hidden" class="form-control" id="id_servicio">
                                <div class="form-group">
                                    <label for="nombre_servicio_actualizar">Nombre Servicio</label>
                                    <input type="text" class="form-control" id="nombre_servicio_actualizar">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary" id="btnActualizarServicio">Guardar Cambios</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modalEliminarServicio" tabindex="-1" role="dialog" aria-labelledby="modalEliminarServicioLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalEliminarServicioLabel">Eliminar Servicio</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <input type="hidden" class="form-control" id="id_servicio_eliminar">
                                <p>Se eliminara el servicio: <b id="nombre_servicio_eliminar"></b></p>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary" id="btnEliminarServicio">Eliminar Servicio</button>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>        

</body>
<?php include_once "footer/footer_views.php"; ?>
    <script src="../resource/AdminLTE-3.2.0/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="../resource/AdminLTE-3.2.0/plugins/jquery-validation/additional-methods.min.js"></script>
    <script src="../resource/AdminLTE-3.2.0/plugins/jquery-validation/localization/messages_es.min.js"></script>  
    <script src="../resource/AdminLTE-3.2.0/plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="../resource/AdminLTE-3.2.0/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="../resource/AdminLTE-3.2.0/plugins/sweetalert2/sweetalert2.all.js"></script>
    <script src="../resource/AdminLTE-3.2.0/plugins/sweetalert2/sweetalert2.js"></script>
    <script src="../resource/AdminLTE-3.2.0/plugins/sweetalert2/sweetalert2.min.js"></script>
    
    <script>
        $(document).ready(function() {
            $('#serviciosForm').on('submit', function(event) {
                event.preventDefault(); // Evita el comportamiento predeterminado del formulario
                var datos = $(this).serialize() + "&action=guardarServicio"; // Serializa los datos del formulario
                console.log(datos);  
                $.ajax({
                    type: "POST",
                    url: "../controller/serviciosPatriniumController.php",
                    data: datos,
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        if (response.resultado == 0) {
                            alert("fallo :(");
                        } else {
                            alert("Agregado con éxito");
                            location.reload();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error al enviar los datos: ', xhr.responseText);
                    }
                });
            });
        });
    </script>
    <script>
    $(document).ready(function() {
        // Inicialización del DataTable antes de cargar datos
        const table = $('#serviciosTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json"
            },
            "order": [[0, "asc"]],
            "columns": [
                { "width": "10%" },
                { "width": "35%" },
                { "width": "25%" },
                { "width": "15%" },
                { "width": "15%" }
            ]
        });

        // Petición AJAX para obtener los datos
        $.ajax({
            url: '../controller/serviciosPatriniumController.php',
            type: 'POST',
            data: { action: 'listarServicios' },
            dataType: 'json',
            success: function(response) {
                console.log(response);
                
                // Limpiar el DataTable
                table.clear();
                
                // Recorrer la respuesta y añadir filas al DataTable
                $.each(response, function(index, servicio) {
                    table.row.add([
                        servicio.id_servicio,
                        servicio.nombre_servicio,
                        servicio.created_at,
                        `<a class="btn btn-success m-0" data-toggle="modal" data-target="#modalActualizarServicio" data-id="${servicio.id_servicio}" data-nombre="${servicio.nombre_servicio}" data-created="${servicio.created_at}">
                            Actualizar
                        </a>`,
                        `<a class="btn btn-danger m-0" data-toggle="modal" data-target="#modalEliminarServicio" data-id="${servicio.id_servicio}" data-nombre="${servicio.nombre_servicio}">
                            Eliminar
                        </a>`
                    ]).draw(false); // Redibujar tabla
                });
            },
            error: function(xhr, status, error) {
                console.error('Error al obtener los datos: ', xhr.responseText);
            }
        });
    });
</script>
    <script>
        $(document).ready(function() {
            $('#modalActualizarServicio').on('show.bs.modal', function(event) {
                var button  = $(event.relatedTarget); 
                var id      = button.data('id');
                var nombre  = button.data('nombre');
                var created = button.data('created');

                var modal = $(this);
                modal.find('.modal-body #id_servicio').val(id);
                modal.find('.modal-body #nombre_servicio_actualizar').val(nombre);
                modal.find('.modal-body #created_at').val(created);
            });
            $('#modalEliminarServicio').on('show.bs.modal', function(event) {
                var button  = $(event.relatedTarget); 
                var id      = button.data('id');
                var nombre  = button.data('nombre');
                
                var modal = $(this); 
                modal.find('.modal-body #id_servicio_eliminar').val(id);
                modal.find('.modal-body #nombre_servicio_eliminar').text(nombre);
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#btnActualizarServicio').on('click', function() {
                var id      = $('#id_servicio').val();
                var nombre  = $('#nombre_servicio_actualizar').val();
                $.ajax({
                    url: '../controller/serviciosPatriniumController.php',
                    type: 'POST',
                    data: {
                        action: 'actualizarServicio',
                        id_servicio: id,
                        nombre_servicio: nombre,
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        if (response.resultado == 0) {
                            alert("fallo :(");
                        } else {
                            alert("Actualizado con éxito");
                            location.reload();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error al enviar los datos: ', xhr.responseText);
                    }
                });
            });
            $('#btnEliminarServicio').on('click', function() {
                var id      = $('#id_servicio_eliminar').val();
                $.ajax({
                    url: '../controller/serviciosPatriniumController.php',
                    type: 'POST',
                    data: {
                        action: 'eliminarServicio',
                        id_servicio: id,
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        if (response.resultado == 0) {
                            alert("fallo :(");
                        } else {
                            alert("Servicio eliminado con éxito");
                            location.reload();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error al enviar los datos: ', xhr.responseText);
                    }
                });
            });
        });
    </script>

</html>
