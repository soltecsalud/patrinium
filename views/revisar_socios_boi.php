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
                            <h3 class="card-title">Socios > 25% de participacion</h3>

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
                                    <td>Numero Pasaporte</td>
                                    <td>Nombre Sociedad</td>
                                    <td>Porcentaje accionario</td>
                                    <td>Nombre Completo</td>
                                    <td>Enviar BOI</td>
                                        
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
   <!-- Modal -->
   <div class="modal fade" id="detalleModal" tabindex="-1" aria-labelledby="detalleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detalleModalLabel">Detalle de Sociedad</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Content will be loaded by AJAX -->
                    <div id="modalContent" style="max-height: 400px; overflow-y: auto;"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
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
   $('#btn_insertar__tipo_pago').click(function(){        
       var datos = $('#tipoPagoForm').serialize() + "&action=guardarTipoPago"; // Cambio aquí: añadir el # antes de consignacionForm
       console.log(datos);  
       $.ajax({
           type: "POST",
           url: "../controller/tipoPagoController.php",
           data: datos,
           success: function(r) {
               console.log(r);
               if (r.resultado == 0) {
                   alert("fallo :(");
               } else {
                   alert("Agregado con éxito");
                   // Redirección a listar_empresa.php
                   window.location.href = 'tipo_pagos.php';
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
                url: '../controller/tipoPagoController.php', // Cambia esto por la ruta correcta a tu controlador
                type: 'POST',
                data: { action: 'sociosBoi' },
                dataType: 'json',
                success: function(response) {
                    console.log(response); // Añade esto para ver la respuesta en la consola
                    let tbody = $('#tipoPago');
                    tbody.empty(); // Limpia cualquier dato anterior

                    // Recorre los datos y crea las filas de la tabla
                    $.each(response, function(index, tipoPago) {
                        let row = `<tr>
                            <td>${tipoPago.id_personas_sociedad}</td>
                            <td>${tipoPago.numero_pasaporte}</td>
                            <td>${tipoPago.nombre_sociedad}</td>
                            <td>${tipoPago.porcentaje}</td>
                            <td>${tipoPago.nombre_completo}</td>
                            <td><button class="btn btn-primary btnDetalle" data-id="${tipoPago.id_personas_sociedad}" data-toggle="modal" data-target="#detalleModal">Ver Detalle</button></td>
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
