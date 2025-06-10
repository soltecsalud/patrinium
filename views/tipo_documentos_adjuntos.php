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

<body>

    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Formulario Tipos Documentos Adjuntos</h3>

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
                                <form id="tipoDocumentoAdjunto">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tipo_documento">Tipo documento Adjunto</label>
                                                <input type="text" class="form-control" id="nombre_documento_adjunto" name="nombre_documento_adjunto" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary" id="btn_insertar__tipo_documento_adjunto">Insert</button>
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
                                <h3 class="card-title">Lista de Nombres Para Documentos Adjuntos</h3>

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
                                <table id="tipoPagoTable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Id tipo documento</th>
                                            <th>Descripci&oacute;nn tipo documento</th>
                                            <th>Fecha creaci&oacute;n</th>
                                            <th colspan="2">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tipoPago"></tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </section>

            <div class="modal fade" id="modalActualizarDocumentos" tabindex="-1" role="dialog" aria-labelledby="modalActualizarDocumentosLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalActualizarDocumentosLabel">Actualizar documento adjunto</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <input type="hidden" class="form-control" id="id_documento">
                                <div class="form-group">
                                    <label for="nombre_documento_actualizar">Nombre documento adjunto</label>
                                    <input type="text" class="form-control" id="nombre_documento_actualizar">
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

            <div class="modal fade" id="modalEliminarDocumento" tabindex="-1" role="dialog" aria-labelledby="modalEliminarDocumentoLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalEliminarDocumentoLabel">Eliminar tipo de documento</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <input type="hidden" class="form-control" id="id_documento_eliminar">
                                <p>Se eliminara el tipo de documento: <b id="nombre_documento_eliminar"></b></p>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary" id="btnEliminarDocumento">Eliminar Documento</button>
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
        $(document).ready(function() {
            $('#btn_insertar__tipo_documento_adjunto').click(function() {
                var datos = $('#tipoDocumentoAdjunto').serialize() + "&action=guardarTipoDocumento_adjunto"; // Cambio aquí: añadir el # antes de consignacionForm
                console.log(datos);
                $.ajax({
                    type: "POST",
                    url: "../controller/tipoDocumentoAdjunto.php",
                    data: datos,
                    success: function(r) {
                        console.log(r);
                        if (r.resultado == 0) {
                            alert("fallo :(");
                        } else {
                            alert("Agregado con éxito");
                            // Redirección a listar_empresa.php
                            window.location.href = 'tipo_documentos_adjuntos.php';
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
                url: '../controller/tipoDocumentoAdjunto.php', // Cambia esto por la ruta correcta a tu controlador
                type: 'POST',

                data: {
                    action: 'listarTipoPago'
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response); // Añade esto para ver la respuesta en la consola
                    let tbody = $('#tipoPago');
                    tbody.empty(); // Limpia cualquier dato anterior

                    // Recorre los datos y crea las filas de la tabla
                    $.each(response, function(index, tipoPago) {
                        let row = `<tr>
                            <td>${tipoPago.id_tipo_documento_adjunto}</td>
                            <td>${tipoPago.nombre_documento_adjunto}</td>
                            <td>${tipoPago.create_at}</td>
                            <td>
                                <a style="margin-right: 10px;"  class="btn btn-success m-0" data-toggle="modal" data-target="#modalActualizarDocumentos" data-id="${tipoPago.id_tipo_documento_adjunto}" data-nombre="${tipoPago.nombre_documento_adjunto}">
                                    Actualizar
                                </a>
                            </td>
                            <td>
                                <a style="margin-right: 10px;" class="btn btn-danger m-0" data-toggle="modal" data-target="#modalEliminarDocumento" data-id="${tipoPago.id_tipo_documento_adjunto}" data-nombre="${tipoPago.nombre_documento_adjunto}">
                                    Eliminar
                                </a>
                            </td>
                        </tr>`;
                        tbody.append(row);
                    });
                    $('#tipoPagoTable').DataTable();
                },
                error: function(xhr, status, error) {
                    console.error('Error al obtener los datos: ', xhr.responseText);
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#modalActualizarDocumentos').on('show.bs.modal', function(event) {
                var button  = $(event.relatedTarget);
                var id      = button.data('id');
                var nombre  = button.data('nombre');
                var modal   = $(this); 
                modal.find('.modal-body #id_documento').val(id);
                modal.find('.modal-body #nombre_documento_actualizar').val(nombre);
            });
            $('#modalEliminarDocumento').on('show.bs.modal', function(event) {
                var button  = $(event.relatedTarget); 
                var id      = button.data('id');
                var nombre  = button.data('nombre');
                
                var modal = $(this); 
                modal.find('.modal-body #id_documento_eliminar').val(id);
                modal.find('.modal-body #nombre_documento_eliminar').text(nombre);
            });
            $('#btnActualizarServicioTipoSociedad').on('click', function() {
                var id      = $('#id_documento').val();
                var nombre  = $('#nombre_documento_actualizar').val();
                $.ajax({
                    url: '../controller/tipoDocumentoAdjunto.php',
                    type: 'POST',
                    data: {
                        action: 'actualizartipodocumento',
                        id_tipodocumento: id,
                        nombre_tipodocumento: nombre, 
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        if (response.resultado == 0) {
                            alert("fallo :(");
                        } else {
                            alert("Actualizado con éxito");
                            window.location.href = 'tipo_documentos_adjuntos.php';
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error al enviar los datos: ', xhr.responseText);
                    }
                });
            });

            $('#btnEliminarDocumento').on('click', function() {
                var id      = $('#id_documento_eliminar').val();
                $.ajax({
                    url: '../controller/tipoDocumentoAdjunto.php', // Cambia esto por la ruta correcta a tu controlador
                    type: 'POST',
                    data: { 
                        action: 'eliminarDocumento',
                        id_documento: id
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        if (response.resultado == 0) {
                            alert("fallo :(");
                        } else {
                            alert("Tipo de documento eliminado con éxito");
                            window.location.href = 'tipo_documentos_adjuntos.php';
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