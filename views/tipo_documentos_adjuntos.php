<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
    exit();
} elseif (isset($_SESSION['usuario']) && $_SESSION['casos'] === false) {
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
                            <table id="tipoPagoTable"class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Id Tipo Pago</th>
                                        <th>Descripcion Tipo Pago</th>
                                        <th>Fecha Creacion</th>
                                        
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
   $('#btn_insertar__tipo_documento_adjunto').click(function(){        
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
            
                data: { action: 'listarTipoPago' },
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
</html>
