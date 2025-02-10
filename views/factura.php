<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
    exit();
} elseif (isset($_SESSION['usuario']) && $_SESSION['facturacion'] === false) {
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
                            <h3 class="card-title">Billing</h3>

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
                                        <th>Action</th>
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
            url: '../controller/facturaController.php', // Cambia esto por la ruta correcta a tu controlador
            type: 'POST',
            data: { action: 'listarFacturas' },
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
                        <td><input id="payment-${factura.id_solicitud}" class="btn btn-primary payment-btn" type="button" value="Payment" data-id-solicitud="${factura.id_solicitud}"/></td>
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

        $(document).on('click', '.payment-btn', function() {
            // Obtén el id_solicitud del botón que fue clickeado
            var idSolicitud = $(this).data('id-solicitud');
            // Actualiza el valor del campo oculto en el formulario
            $('#invoiceNumber').val(idSolicitud);
            // Muestra el modal
            $('#tuModal').modal('show');
        });
    });

    $(document).ready(function() {
    $('#btn-payment').click(function(event) {
        event.preventDefault(); // Evita el comportamiento por defecto del botón de envío

        var formData = new FormData($('#paymentForm')[0]);
        formData.append('accion', 'insertarPagoInvoice'); // Cambia 'action' por 'accion'

        $.ajax({
            url: '../controller/facturaController.php', // Asegúrate de que la ruta es correcta
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log(response);
                Swal.fire({
                    title: '¡Éxito!',
                    text: '¡Archivo guardado exitosamente!',
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'factura.php'; // Redireccionar a la página de factura
                    }
                });
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});
</script>

<!-- Modal -->
<div class="modal fade" id="tuModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Formulario de Pago</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Formulario -->
        <form id="paymentForm">
          <!-- Campo oculto para invoice_number -->
          <input type="hidden" id="invoiceNumber" name="id_solicitud">
          <!-- Input de archivo -->
          <div class="form-group">
            <label for="paymentImage">Imagen de Pago</label>
            <input type="file" class="form-control-file" id="paymentImage" name="payment_image">
          </div>
          <!-- Área de texto -->
          <div class="form-group">
            <label for="paymentNotes">Notas</label>
            <textarea class="form-control" id="paymentNotes" name="payment_notes" rows="3"></textarea>
          </div>
          <!-- Select -->
          <div class="form-group">
            <label for="paymentOption">Opción de Pago</label>
            <select class="form-control" id="paymentOption" name="payment_option">
                <option value="Transferencia">Transferencia</option>
                <option value="Cheque">Cheque</option>
                <option value="Efectivo">Efectivo</option>
            </select>
          </div>
          <!-- Botón de envío -->
          <button type="submit" id="btn-payment" class="btn btn-primary">Enviar</button>
        </form>
      </div>
    </div>
  </div>
</div>
</html>

