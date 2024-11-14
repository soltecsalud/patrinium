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
    <title>PatrimoniumAPP || Reporte Terceros </title>
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
                            <h3 class="card-title">Reporte Terceros</h3>

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
                                    <td>Consecutivo</td>
                                    <td>Fecha</td>
                                    <td>Nombre_tercero</td>       
                                    <td>TIN</td>                             
                                    <td>Tipo de Entidad</td>
                                    <td>Nombre Comercial</td>
                                    <td>Valor Total</td>
                                    <td>Anticipo</td>
                                    <td>Saldo</td>
                                   
                                        
                                    </tr>
                                </thead>
                                <tbody id="egresoTecero"></tbody>
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
        $(document).ready(function() {
            $.ajax({
                url: '../controller/egresos_tercero_controller.php', // Cambia esto por la ruta correcta a tu controlador
                type: 'POST',
                data: { action: 'egresos_por_tercero' },
                dataType: 'json',
                success: function(response) {
                    console.log(response); // Añade esto para ver la respuesta en la consola
                    let tbody = $('#egresoTecero');
                    tbody.empty(); // Limpia cualquier dato anterior

                    // Recorre los datos y crea las filas de la tabla
                    $.each(response, function(index, egresoTecero) {
                        let row = `<tr>
                            <td>${egresoTecero.consecutivo_egreso}</td>
                            <td>${egresoTecero.create_at}</td>
                            <td>${egresoTecero.nombre_tercero}</td>
                            <td>${egresoTecero.tin}</td>
                            <td>${egresoTecero.tipo_entidad}</td>
                            <td>${egresoTecero.nombre_comercial}</td>
                            <td>${egresoTecero.valor}</td>
                            <td>calcular anticipo</td>
                            <td>calcula Saldo</td>

                           
                            
                        
                        </tr>`;
                        tbody.append(row);
                    });
                    $('#tipoPagoTable').DataTable({
                        dom: 'Bfrtip',
                        buttons: [
                            'excelHtml5',
                            'pdfHtml5'
                        ]
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error al obtener los datos: ', xhr.responseText);
                }
            });

            // Handle the click event for the detail button
            $(document).on('click', '.btnDetalle', function() {
            var id = $(this).data('id');
            $.ajax({
                url: '../controller/tipoPagoController.php', // Cambia esto por la ruta correcta a tu controlador
                type: 'POST',
                data: { action: 'detalleSociedad', id: id },
                success: function(response) {
                    var formattedJson = JSON.stringify(JSON.parse(response), null, 4);
                    $('#modalContent').html('<pre style="color: blue;">' + formattedJson + '</pre>');
                },
                error: function(xhr, status, error) {
                    console.error('Error al obtener el detalle: ', xhr.responseText);
                }
            });
        });
    });
    </script>
</html>
