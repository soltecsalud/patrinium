<?php
    session_start();
    if (!isset($_SESSION['usuario'])) {
        header('Location: ../index.php');
        exit();
    } elseif (isset($_SESSION['usuario']) && $_SESSION['crear generales'] === false) {
        echo 'Acesso no autorizado.';
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
    <title>PatrimoniumAPP || Pagos </title>
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <section class="content">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Formulario Tipos De Sociedades</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <form id="tipoSociedadForm">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nombre_tipo_sociedad">Tipo de Sociedad</label>
                                            <input type="text" class="form-control" id="nombre_tipo_sociedad" name="nombre_tipo_sociedad" required>
                                        </div>
                                    
                                    </div>
                                    
                                </div>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary" id="btn_insertar__tipo_sociedad">Insert</button>
                                </div>
                            </form>
                            <div id="result"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Tipo Sociedad</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="tipoSociedadTable"class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Id tipo sociedad</th>
                                        <th>Descripci&oacute;n tipo sociedad</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="tipoSociedad"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="modal fade" id="modalActualizarTipoSociedad" tabindex="-1" role="dialog" aria-labelledby="modalActualizarTiposociedadLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalActualizarTiposociedadLabel">Actualizar tipo sociedad</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <input type="hidden" class="form-control" id="id_tiposociedad">
                            <div class="form-group">
                                <label for="nombre_tiposociedad_actualizar">Nombre tipo sociedad</label>
                                <input type="text" class="form-control" id="nombre_tiposociedad_actualizar">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" id="btnActualizarServicioTipoSociedad">Guardar Cambios</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalEliminarTipoSociedad" tabindex="-1" role="dialog" aria-labelledby="modalEliminarTipoSociedadLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEliminarTipoSociedadLabel">Eliminar tipo sociedad</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <input type="" class="form-control" id="id_tiposociedad_eliminar">
                            <p>Se eliminara el tipo sociedad: <b id="nombre_tiposociedad_eliminar"></b></p>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" id="btnEliminarTipoSociedad">Eliminar tipo sociedad</button>
                    </div>
                </div>
            </div>
        </div>

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
    $(document).ready(function(){
        $('#btn_insertar__tipo_sociedad').click(function(){        
            var datos = $('#tipoSociedadForm').serialize() + "&action=guardarTipoSociedad"; // Cambio aquí: añadir el # antes de consignacionForm
            $.ajax({
                type: "POST",
                url: "../controller/tipoSociedadController.php",
                data: datos,
                success: function(r) {
                    console.log(r);
                    if (r.resultado == 0) {
                        alert("fallo :(");
                    }else{
                        alert("Agregado con éxito");
                        window.location.href = 'tipo_sociedades.php';
                    }
                }
            });
            return false;
        });
    });
</script>

<script>
    $(document).ready(function() {
        $.ajax({
            url: '../controller/tipoSociedadController.php', // Cambia esto por la ruta correcta a tu controlador
            type: 'POST',
            data: { action: 'listarTipoSociedad' },
            dataType: 'json',
            success: function(response) {
                // console.log(response); // Añade esto para ver la respuesta en la consola
                let tbody = $('#tipoSociedad');
                tbody.empty(); // Limpia cualquier dato anterior

                $.each(response, function(index, tipoSociedad) {
                    let row = `<tr>
                        <td>${tipoSociedad.id_tipo_sociedad}</td>
                        <td>${tipoSociedad.nombre_tipo_sociedad}</td>
                        <td>
                            <a style="margin-right: 10px;"  class="btn btn-success m-0" data-toggle="modal" data-target="#modalActualizarTipoSociedad" data-id="${tipoSociedad.id_tipo_sociedad}" data-nombre="${tipoSociedad.nombre_tipo_sociedad}">
                                Actualizar
                            </a>
                        </td>
                        <td>
                            <a style="margin-right: 10px;" class="btn btn-danger m-0" data-toggle="modal" data-target="#modalEliminarTipoSociedad" data-id="${tipoSociedad.id_tipo_sociedad}" data-nombre="${tipoSociedad.nombre_tipo_sociedad}">
                                Eliminar
                            </a>
                        </td>
                    </tr>`;
                    tbody.append(row);
                });
                $('#tipoSociedadTable').DataTable();
            },
            error: function(xhr, status, error) {
                console.error('Error al obtener los datos: ', xhr.responseText);
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#modalActualizarTipoSociedad').on('show.bs.modal', function(event) {
            var button  = $(event.relatedTarget);
            var id      = button.data('id');
            var nombre  = button.data('nombre');
            var modal   = $(this); 
            modal.find('.modal-body #id_tiposociedad').val(id);
            modal.find('.modal-body #nombre_tiposociedad_actualizar').val(nombre);
        });
        $('#modalEliminarTipoSociedad').on('show.bs.modal', function(event) {
            var button  = $(event.relatedTarget); 
            var id      = button.data('id');
            var nombre  = button.data('nombre');
            
            var modal = $(this);
            modal.find('.modal-body #id_tiposociedad_eliminar').val(id);
            modal.find('.modal-body #nombre_tiposociedad_eliminar').text(nombre);
        });
        $('#btnActualizarServicioTipoSociedad').on('click', function() {
            var id      = $('#id_tiposociedad').val();
            var nombre  = $('#nombre_tiposociedad_actualizar').val();
            $.ajax({
                url: '../controller/tipoSociedadController.php',
                type: 'POST',
                data: {
                    action: 'actualizartiposociedad',
                    id_tiposociedad: id,
                    nombre_tiposociedad: nombre, 
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response.resultado == 0) {
                        alert("fallo :(");
                    } else {
                        alert("Actualizado con éxito");
                        window.location.href = 'tipo_sociedades.php';
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error al enviar los datos: ', xhr.responseText);
                }
            });
        });

        $('#btnEliminarTipoSociedad').on('click', function() {
            var id      = $('#id_tiposociedad_eliminar').val();
            $.ajax({
                url: '../controller/tipoSociedadController.php', // Cambia esto por la ruta correcta a tu controlador
                type: 'POST',
                data: { 
                    action: 'eliminarTipoSociedad',
                    id_tiposociedad: id
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response.resultado == 0) {
                        alert("fallo :(");
                    } else {
                        alert("Tipo sociedad eliminado con éxito");
                        window.location.href = 'tipo_sociedades.php';
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