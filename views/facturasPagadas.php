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
                <div class="col-md-10 offset-md-1">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Bills Paid</h3>

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
                            <table id="facturaTable"class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Descargar Comprobante</th>
                                        <th>Solicitud</th> 
                                        <th>Invoice Number</th>                                                                                                                    
                                        <th>Company</th>
                                        <th>Date</th>
                                        <th>Total</th>
                                        <th>Observation</th>

                                        
                                    </tr>
                                </thead>
                                <tbody id="listar_facturas"></tbody>
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
            url: '../controller/facturaController.php', // Cambia esto por la ruta correcta a tu controlador
            type: 'POST',
            data: { action: 'listarFacturasPagadas' },
            dataType: 'json',
            success: function(response) {
                console.log(response); // Añade esto para ver la respuesta en la consola
                let tbody = $('#listar_facturas');
                tbody.empty(); // Limpia cualquier dato anterior

                // Recorre los datos y crea las filas de la tabla
                $.each(response, function(index, factura) {
                    let datos = JSON.parse(factura.datos);
                    let serviciosInfo = '';
                    $.each(datos.servicios, function(nombreServicio, detalleServicio) {
                        serviciosInfo += `${nombreServicio}: Valor ${detalleServicio.valor}, Cantidad ${detalleServicio.cantidad}<br>`;
                    });
                    let total = 0; // Inicializa el total
                    $.each(datos.servicios, function(nombreServicio, detalleServicio) {
                        // Multiplica valor por cantidad y suma al total
                        total += Number(detalleServicio.valor) * Number(detalleServicio.cantidad);
                    });
                    let row = `<tr>
                        <td><a class='btn btn-success' href='../controller/resource/${factura.id_solicitud}/${factura.ruta_pago}' target='_BLANK'><i class=' fas fa-download'></i></a></td>
                        <td>${factura.id_solicitud}</td>
                        <td>${datos.invoice_number}</td>
                        <td>${datos.logo}</td>
                        <td>${factura.created_at}</td>
                        <td>${total}</td>
                        <td>${datos.observaciones}</td>
                    </tr>`;
                    tbody.append(row);
                });
                $('#facturaTable').DataTable();
            },
            error: function(xhr, status, error) {
                console.error('Error al obtener los datos: ', xhr.responseText);
            }
        });

    });

   

</script>


</html>

