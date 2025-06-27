<?php
// session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
    exit();
}
include_once "../controller/solicitudController.php"; 
$controlador = new Solicitud_controller();
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
    <script src="../resource/AdminLTE-3.2.0/plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="../resource/AdminLTE-3.2.0/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="../resource/AdminLTE-3.2.0/plugins/sweetalert2/sweetalert2.all.js"></script>
    <script src="../resource/AdminLTE-3.2.0/plugins/sweetalert2/sweetalert2.js"></script>
    <title>PatrimoniumAPP || Factura Rápida</title>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Factura R&aacute;pida</h3>
                    </div>
                    <div class="card-body">
                        <form id="billingForm">
                            <div class="row">
                                <div class="form-group">
                                    <label for="selectOptions">Selecciona cliente</label>
                                    <input list="clientefactura" name="clientefactura" class="form-control" id="selectPersonaInput" placeholder="Selecciona cliente" required>
                                    <datalist id="clientefactura">
                                        <option value="">Cargando opciones...</option>
                                    </datalist>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="companySelect">Company Issuing Invoice:</label>
									    <select class="form-select" id="companySelect" name="logo" required>
											<option value="">Select Company</option>
											<option value="patrinium">Patrimonium</option>
											<option value="Vargas & Associates">Vargas & Associates</option>
											<option value="Tándem International Business Services">Tándem International Business Services</option>
											<option value="Lamva Investment">Lamva Investment</option>

										</select>
                                </div>
                                <div class="col-md-3">
                                    <label for="bankAccountSelect">Bank Account for Deposit:</label>
                                    <select class="form-select" id="bankAccountSelect" name="cuenta_bancaria">
                                        <option value="0">Select Bank</option> 
                                        <?php
                                            $banco_consigaciones = $controlador->getBancosConsignacion();
                                            foreach ($banco_consigaciones as $banco_consigacion): ?>
                                                <!-- <option value="<?php echo $banco_consigacion->id_banco; ?>"><?php echo $banco_consigacion->nombre_banco; ?></option> -->
                                                <option value="<?php echo $banco_consigacion->id_banco; ?>"><?php echo $banco_consigacion->nombre_banco."-".$banco_consigacion->nombre_cuenta."-".$banco_consigacion->numero_cuenta;?></option>
                                            <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="invoiceNumberInput">Invoice Number:</label>
                                    <input type="text" class="form-control" id="invoiceNumberInput_facturarapida" name="invoice_number" placeholder="Enter invoice number" required>
                                    <div id="divinvoicenumber_facturarapida_encontrado" style="display: none;">
                                        <p style="color: red;font-weight: bold;"><i>El Invoice Number ingresado ya existe</i></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <!--<label for="tax">TAX:</label>-->
                                    <input type="hidden" class="form-control" name="tax" value="" placeholder="Enter TAX">
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-4">
                                    <label for="email">Email:</label>
                                    <input type="text" class="form-control" name="email" placeholder="Enter Email">
                                </div>
                                <div class="col-md-4">
                                    <label for="adress">Address:</label>
                                    <input type="text" class="form-control" name="adress" placeholder="Enter Address">
                                </div>
                                <div class="col-md-4">
                                    <label for="numberTax">Number TAX:</label>
                                    <input type="text" class="form-control" name="numberTax" placeholder="Enter tax number">
                                </div>
                            </div>

                            <hr class="my-4">

                            <h5 class="mb-3 mt-4">Billing Services (Manual Entry):</h5>
                            <div id="servicesContainer"></div>
                            <div class="row mt-2">
                                <div class="col-md-12 text-right">
                                    <button type="button" id="addServiceBtn" class="btn btn-success">Add Service</button>
                                </div>
                            </div>
                            <input type="hidden" name="total_factura" id="total_factura" value="0">

                            <!-- <hr class="my-4"> -->
                            <!-- <div class="row">
                                <label class="mb-2 h5" style="margin-top: 2%; padding-bottom: 2%;" for="invoiceNumberInput">
                                    In case of issuing an invoice with partial payment:
                                </label>
                                <div class="col-md-6 mb-3">
                                    <label for="total_factura">
                                        Total Invoice
                                        Partial Invoice
                                    </label>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="text" placeholder="Write the partial price" name="total_factura" id="total_factura" class="form-control">
                                </div>
                            </div> -->
                            <hr class="my-4 primary">

                            <div class="row mb-3">
                                <label class="mb-2 h5" for="observaciones">Observations:</label>
                                <div class="col-12">
                                    <textarea class="form-control" rows="5" name="observaciones" placeholder="Write something here"></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <input type="hidden" name="id_solicitud" value="<?php echo $id_revisar_solicitud; ?>">
                                <input type="hidden" name="estado" value="2">
                                <button type="button" id="btnInsertarFactura" class="btn btn-primary">Insert Invoice</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Facturas r&aacute;pidas</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="tableFacturas_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <table id="tableFacturas"class="table table-bordered table-striped dataTable">
                                <thead>
                                    <tr>
                                        <th>Acci&oacute;n</th>
                                        <th>Pagar</th>
                                        <th>Fecha Creacion</th>
                                        <th>Descargar Factura</th>
                                        <th>Descargar Comprobante Pago</th>
                                        <th>Tipo Consignacion</th>
                                        <th>Nota</th>
                                        <th>ID</th>
                                        <th>N&uacute;mero de factura</th>
                                        <th>Valor</th>
                                        <th>Banco</th>
                                    </tr>
                                </thead>
                                <tbody id="tablefacturasrapidas"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="modalPagoFactura" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Formulario de Pago</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="paymentForm">
                            <input type="hidden" id="invoiceNumber" name="id_factura">
                            <div class="form-group">
                                <label for="paymentType">Tipo de Pago</label>
                                <select class="form-control" id="paymentType" name="payment_type" required>
                                    <option value="">selecciona Una Forma De Pago</option>
                                    <option value="total">Total</option>
                                    <option value="parcial">Parcial</option>
                                </select>
                                <!-- Activar input si el pago es parcial -->
                                <div class="form-group" id="partialAmountGroup" style="display: none;">
                                    <label for="partialAmount">Monto Parcial</label>
                                    <input type="number" class="form-control" id="partialAmount" name="partial_amount" placeholder="Ingrese el monto parcial">
                                </div>
                            </div>        
                            <div class="form-group">
                                <label for="paymentImage">Imagen de Pago</label>
                                <input type="file" class="form-control-file" id="paymentImage" name="payment_image">
                            </div>
                            <div class="form-group">
                                <label for="paymentNotes">Notas</label>
                                <textarea class="form-control" id="paymentNotes" name="payment_notes" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="paymentOption">Opci&oacute;n de Pago</label>
                                <!-- <select class="form-control" id="paymentOption" name="payment_option">
                                    <option value="Transferencia">Transferencia</option>
                                    <option value="Cheque">Cheque</option>
                                    <option value="Efectivo">Efectivo</option>
                                </select> -->
                                <select class="form-control" id="paymentOption" name="payment_option">
                                    <!-- Opciones cargadas dinámicamente vía AJAX -->
                                </select>
                            </div>
                            <button type="submit" id="btn-payment" class="btn btn-primary">Enviar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal adjuntar factura-->
        <div class="modal fade" id="billingModal" tabindex="-1" role="dialog" aria-labelledby="billingModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" position-absolute role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="billingModalLabel">Actualiza factura r&aacute;pida</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="billingFormActualizar">
                            <input type="hidden" id="id_factura_rapida" name="id_factura_rapida">
                            <div class="row">
                                <div class="form-group">
                                    <label for="selectOptions">Selecciona cliente</label>
                                    <input list="clientefacturaactualizar" name="clientefactura" class="form-control" id="selectPersonaInputActualizar" placeholder="Selecciona cliente" required>
                                    <datalist id="clientefacturaactualizar">
                                        <option value="">Cargando opciones...</option>
                                    </datalist>
                                </div>
                            </div>
                            <div class="row">
                                <input type="hidden" id="idFactura" name="idFactura" >
                                <div class="col-md-3">
                                    <label class="text-center mb-2" style="font-size: smaller;" for="companySelect">
                                        Company Issuing Invoice:
                                    </label>
                                    <select class="form-select" id="companySelectActualizar" name="logo" required>
                                    <option value="">Select Company</option>
                                    <option value="patrinium">Patrimonium</option>
                                    <option value="Vargas & Associates">Vargas & Associates</option>
                                    <option value="Tándem International Business Services">Tándem International Business Services</option>
                                    <option value="Lamva Investment">Lamva Investment</option>

                                </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="text-center mb-2" style="font-size: smaller;" for="bankAccountSelect">
                                        Bank Account for Deposit:
                                    </label>
                                    <select class="form-select" id="bankAccountSelectActualizar" name="cuenta_bancaria">
                                        <option value="0">Select Bank</option>
                                        <?php
                                        $controlador = new Solicitud_controller();
                                        $banco_consigaciones = $controlador->getBancosConsignacion();
                                        foreach ($banco_consigaciones as $banco_consigacion): ?>
                                            <option value="<?php echo $banco_consigacion->id_banco; ?>"><?php echo $banco_consigacion->nombre_banco."-".$banco_consigacion->nombre_cuenta."-".$banco_consigacion->numero_cuenta;?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="text-center mb-2" style="font-size: smaller;" for="invoiceNumberInput">
                                        Invoice Number:
                                    </label>
                                    <input type="text" class="form-control" id="invoiceNumberInputActualizar" name="invoice_number" placeholder="Enter invoice number">
                                </div>
                                <div class="col-md-3">
                                    
                                    <input type="hidden"   value=" "   class="form-control" id="taxActualizar" name="tax" placeholder="Enter TAX">
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-4">
                                    <label class="text-center mb-2" style="font-size: smaller;" for="email">
                                        Email:
                                    </label>
                                    <input type="text" class="form-control" id="emailActualizar" name="email" placeholder="Enter Email">
                                </div>
                                <div class="col-md-4">
                                    <label class="text-center mb-2" style="font-size: smaller;" for="adress">
                                        Address:
                                    </label>
                                    <input type="text" class="form-control" id="adressActualizar" name="adress" placeholder="Enter Address">
                                </div>
                                <div class="col-md-4">
                                    <label class="text-center mb-2" style="font-size: smaller;" for="numberTax">
                                        Number TAX:
                                    </label>
                                    <input type="text" class="form-control" id="numberTaxActualizar" name="numberTax" placeholder="Enter tax number">
                                </div>
                            </div>

                            <hr class="my-4 primary">

                            <div class="row">
                                <label class="mb-2 h5" style="margin-top: 2%; padding-bottom: 2%;" for="invoiceNumberInput">
                                    Billing Services:
                                </label>
                                <div id="servicesContainerActualizar"></div>
                                <div class="row mt-2">
                                    <div class="col-md-12 text-right">
                                        <button type="button" id="addServiceBtnActualizar" class="btn btn-success">Add Service</button>
                                    </div>
                                </div>
                            </div> 
                            <input type="hidden" name="total_factura" id="total_factura" value="0">

                            <div class="row" style="margin-bottom: 3%;">
                                <label class="mb-2 h5" style="margin-top: 2%; padding-bottom: 2%;" for="observaciones">
                                    Observations:
                                </label>
                                <div class="col-12">
                                    <textarea class="form-control" rows="5" name="observaciones" id="observacionesActualizar" placeholder="Write something here"></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <input type="hidden" name="id_solicitud" value="<?php echo $id_revisar_solicitud; ?>">
                                <input type="hidden" name="estado" value="2">
                                <button type="button" id="btnActualizarFactura" style="margin-bottom: 1%;" class="btn btn-primary">Guardar</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>

<?php include_once "footer/footer_views.php"; ?>
<script src="js/factura.js"></script>
<script>
    let servicioIndex = 0;

    document.getElementById('addServiceBtn').addEventListener('click', function () {
        const container = document.getElementById('servicesContainer');
        const row = document.createElement('div');
        row.className = 'row mb-3 pt-2';
        row.innerHTML = `
            <div class="col-md-6">
                <input type="checkbox" name="check${servicioIndex}" class="check-item" data-clave="${servicioIndex}" checked hidden>
                <input type="text" name="nombre${servicioIndex}" class="form-control mt-2" data-clave="${servicioIndex}" placeholder="Service Name">
            </div>
            <div class="col-md-3">
                <input type="text" name="cantidad${servicioIndex}" class="form-control" placeholder="Qty" data-clave="${servicioIndex}">
            </div>
            <div class="col-md-3">
                <input type="text" name="valor${servicioIndex}" class="form-control" placeholder="Unit Price" data-clave="${servicioIndex}">
            </div>
            `;
        const row2 = document.createElement('div');
        row2.className = 'row col-12';
        row2.innerHTML = `
            <textarea class="form-control" rows="2" name="descripcionservicio${servicioIndex}" data-clave="${servicioIndex}" placeholder="Description"></textarea>
            `;
        container.appendChild(row);
        container.appendChild(row2);
        servicioIndex++;
    });

    $(document).ready(function () { 
        $.ajax({
            url: '../controller/facturaController.php',
            method: 'POST',
            data: { accion: 'obtenerTiposPago' },
            dataType: 'json',
            success: function(response) {
                let select = $('#paymentOption');
                select.empty(); // Limpia el select
                response.forEach(function(item) {
                    select.append(`<option value="${item.tipo_pago}">${item.tipo_pago}</option>`);
                });
            },
            error: function(xhr, status, error) {
                console.error('Error al cargar tipos de pago:', error);
                console.log('Respuesta del servidor:', xhr.responseText); 
            }
        });

        $.ajax({
            url: '../controller/sociedadController.php',
            type: 'GET',
            data: { accion: 'getSociedadesRegistrarSocilitud' },
            dataType: 'json',
            success: function(data) {
                // console.log('Respuesta del servidor:', data); // Depuración
                // var select = $('#selectPersona');
                var select = $('#clientefactura'); // CAMBIO A DATALIST
                select.empty();
                select.append('<option value="">Selecciona una Persona</option>');
                $.each(data, function(index, item) {
                    var nombreCompleto = item.nombre;
                    select.append('<option value="' +nombreCompleto+'">' + nombreCompleto + 
                
                    '</option>');
                });
            },
            error: function(xhr, status, error) {
            console.error('Error en la solicitud AJAX:', status, error);
            console.log('Respuesta del servidor:', xhr.responseText);
            alert('Error al cargar las opciones');
        }
        });


        $('#btnInsertarFactura').click(function () {
            let datos = $('#billingForm').serialize();
            datos += "&accion=insertarFacturaRapida"; 
            // Validar que el campo de cliente no esté vacío
            if ($('#selectPersonaInput').val() === '') {
                Swal.fire("Error", "Por favor, selecciona un cliente.", "error");
                return;
            }

            if ($('#companySelect').val() === '') { 
                Swal.fire("Error", "Por favor, selecciona una compañia.", "error");
                return;
            }
            if ($('#bankAccountSelect').val() === '0') {
                Swal.fire("Error", "Por favor, selecciona el banco", "error");
                return false; // Detener la ejecución si no se ingresa una fecha
            }

            if ($('#invoiceNumberInput_facturarapida').val() === '') { 
                Swal.fire("Error", "Por favor, ingresa el Invoice Number.", "error");
                return;
            }

            // Validar que el invoice number no exista
            if ($('#divinvoicenumber_facturarapida_encontrado').is(':visible')) {
                Swal.fire("Error", "El Invoice Number ingresado ya existe.", "error");
                return;
            }
            // Validar que al menos un servicio esté agregado
            let serviciosAgregados = false;
            $('.check-item').each(function() {
                if ($(this).is(':checked')) {
                    serviciosAgregados = true;
                }
            });
            if (!serviciosAgregados) {
                Swal.fire("Error", "Por favor, agrega al menos un servicio.", "error");
                return;
            }
            
            // Bloquear boton
            $(this).prop('disabled', true);
            $.ajax({
                type: "POST",
                url: "../controller/solicitudController.php",
                data: datos,
                dataType: "json",
                success: function (r) {
                    console.log('===');
                    console.log(r);
                    if(r.status=='0'){
                        Swal.fire("Éxito", "Factura insertada con éxito.", "success")
                            .then(() => {
                                window.location.href = 'solo_factura.php';
                            });
                    }else{
                        Swal.fire("Error", "Fallo en la inserción de la factura.", "error");
                    }
                    // if (r.resultado == 0) {
                    //     Swal.fire("Error", "Fallo en la inserción de la factura.", "error");
                    // } else {
                    //     Swal.fire("Éxito", "Factura insertada con éxito.", "success")
                    //         .then(() => {
                    //             window.location.href = 'solo_factura.php';
                    //         });
                    // }
                },
                error: function () {
                    Swal.fire("Error", "Error en la comunicación con el servidor.", "error");
                }
            });
        });
    });
    let datosFacturas = []; // Array para almacenar los datos de las facturas
    let servicioIndexActualizar = 0;
    $(document).ready(function() {
        // Ejecutar la petición AJAX cuando la página esté lista o al realizar alguna acción
        // var idSolicitud = $('#idSolicitud').text(); // Obtener el valor de id_solicitud desde el div oculto

        // Definir los datos para enviar, incluyendo el id_solicitud y la acción
        var datos = {
            accion: "downloadFacturasRapidas"
        };
        // Ejecutar la petición AJAX
        $.ajax({
            url: '../controller/solicitudController.php', // Ruta del controlador
            type: 'POST',
            data: datos, // Enviar los datos como un objeto
            success: function(response) {
                // Parsear el JSON recibido
                let facturas = JSON.parse(response);
                datosFacturas.push(facturas);

                // Limpiar el contenido actual del tbody
                $('#tablefacturasrapidas').empty();

                // Iterar sobre las facturas recibidas y agregar las filas al tbody
                facturas.forEach(function(factura) {
                    let jsonString = factura.datos;

                    // Parse the JSON string
                    let data = JSON.parse(jsonString);

                    // Extract the invoice_number
                    let invoiceNumber = data.invoice_number;
                    
                    // Validar si los campos son null y asignar 'N/A' si es el caso
                    let createdAt        = factura.created_at ? factura.created_at : 'N/A';
                    let rutaPago         = factura.ruta ? factura.ruta : 'N/A';
                    let tipoConsignacion = factura.tipo_consignacion ? factura.tipo_consignacion : 'N/A';
                    let notaPago         = factura.nota_pago ? factura.nota_pago : 'N/A';
                    let idFactura        = factura.factura_rapida_id ? factura.factura_rapida_id : 'N/A';
                    let idNumeroFacura   = factura.numerofactura ? factura.numerofactura : 'N/A';
                    
                    let nombreBanco      = factura.nombre_banco ? factura.nombre_banco : 'N/A';

                    let datosServicios = JSON.parse(factura.datos);
                    let total = 0; // Inicializa el total
                    $.each(datosServicios.servicios, function(nombreServicio, detalleServicio) {
                        // Multiplica valor por cantidad y suma al total
                        total += Number(detalleServicio.valor) * Number(detalleServicio.cantidad);
                    });

                    // Construir la fila 
                    let filas = `<tr>
                    <td><input id="payment-${idFactura}" class="btn btn-success update-btn" type="button" value="Actualizar" data-id-factura="${idFactura}"  /></td>
                    <td><input id="payment-${factura.id_solicitud}" class="btn btn-primary payment-btn" type="button" value="Payment" data-idfactura="${idFactura}"/></td>
                    <td>${createdAt}</td>
                    <td><a href='factura_report.php?table=facturarapida&numero_solicitud=${idFactura}&invoiceNumber=${invoiceNumber}' target='_blank' rel='noopener noreferrer'>Descargar </a></td>
                    <td><a href='../documents/quick_invoices/${idFactura}/${rutaPago}' target='_blank' rel='noopener noreferrer'>Descargar Comprobante</a></td>
                    <td>${tipoConsignacion}</td>
                    <td>${notaPago}</td>
                    <td>${idFactura}</td>
                    <td>${idNumeroFacura}</td>
                    <td>${total}</td>
                    <td>${nombreBanco}</td>
                    </tr> `;

                    // Agregar la fila al tbody
                    $('#tablefacturasrapidas').append(filas);
                });
                $("#tableFacturas").DataTable({
                    "responsive": true,
                    "lengthChange": true,
                    "autoWidth": false,
                    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                }).buttons().container().appendTo('#tableFacturas_wrapper .col-md-6:eq(0)');
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });

        $(document).on('click', '.payment-btn', function() {
            // Obtén el id_solicitud del botón que fue clickeado
            var idFactura = $(this).data('idfactura');
            // Actualiza el valor del campo oculto en el formulario
            $('#invoiceNumber').val(idFactura);
            // Muestra el modal
            $('#modalPagoFactura').modal('show');
        });

        $('#btn-payment').click(function(event) {
            event.preventDefault(); // Evita el comportamiento por defecto del botón de envío

            var formData = new FormData($('#paymentForm')[0]);
            formData.append('accion', 'insertarPagoFacturaRapida'); // Cambia 'action' por 'accion'

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
                            window.location.href = 'solo_factura.php'; // Redireccionar a la página de factura
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

        let mouseX = 0;
        let mouseY = 0;

        $(document).on('mousemove', function (e) {
            mouseX = e.pageX;
            mouseY = e.pageY;
        });

        $(document).on('click', '.update-btn', function() {
            // Obtén el de la factura del botón que fue clickeado
            var idFactura = $(this).data('id-factura');
            $('#idFactura').val(idFactura);
            // Recorrer el array de datosFacturas para encontrar la factura correspondiente
            var factura = datosFacturas[0].find(factura => factura.factura_rapida_id === idFactura);
            // Parsear el contenido JSON de la propiedad 'datos'
            var datos = JSON.parse(factura.datos);
            console.log(datos);
            
            // Asignar los valores a los campos del formulario
            // $("#clientefacturaactualizar").val(datos.clientefactura);
            $('#id_factura_rapida').val(factura.factura_rapida_id);
            $('#selectPersonaInputActualizar').empty();
            $('#selectPersonaInputActualizar').val(datos.clientefactura);
            $('#companySelectActualizar').val(datos.logo);
            $('#bankAccountSelectActualizar').val(factura.id_banco);
            $('#invoiceNumberInputActualizar').val(datos.invoice_number);
            $('#taxActualizar').val(datos.tax);
            $('#emailActualizar').val(datos.email);
            $('#adressActualizar').val(datos.adress);
            $('#numberTaxActualizar').val(datos.number_tax);
            $('#observacionesActualizar').val(datos.observaciones);


            //Recorrer los servicios y mostrarlos en el modal
            $('#servicesContainerActualizar').empty(); // Limpiar el contenedor de servicios
            if (datos.servicios && Array.isArray(datos.servicios)) {
                datos.servicios.forEach((servicio, index) => { 
                    servicio.descripcionservicio = servicio.descripcionservicio || ''; // Manejar caso de descripción vacía
                    const row = `
                        <div class="row mb-3 pt-2">
                            <div class="col-md-6">
                                <input type="checkbox" name="check${servicioIndexActualizar}" class="check-item" data-clave="${servicioIndexActualizar}" checked hidden>
                                <input type="text" name="nombre${servicioIndexActualizar}" class="form-control mt-2" data-clave="${servicioIndexActualizar}" placeholder="Service Name" value="${servicio.nombre}">
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="cantidad${servicioIndexActualizar}" class="form-control" placeholder="Qty" data-clave="${servicioIndexActualizar}" value="${servicio.cantidad}">
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="valor${servicioIndexActualizar}" class="form-control" placeholder="Unit Price" data-clave="${servicioIndexActualizar}" value="${servicio.valor}">
                            </div>
                        </div>
                        <div class="row col-12"> 
                            <textarea class="form-control" rows="2" name="descripcionservicio${servicioIndexActualizar}" data-clave="${servicioIndexActualizar}" placeholder="Description">${servicio.descripcionservicio}</textarea>
                        </div>
                    `; 
                    $('#servicesContainerActualizar').append(row);
                    servicioIndexActualizar++;
                });
            } else {
                // Si no hay servicios, mostrar un mensaje o manejar el caso
                $('#servicesContainerActualizar').append('<p>No services found for this invoice.</p>');
            }

            
            // Mover el modal cerca del mouse
            const $modalDialog = $('#billingModal .modal-dialog');
            $modalDialog.css({
                top: mouseY + 5 + 'px',  // un poco más abajo del cursor
                left: mouseX - 200 + 'px', // centrado horizontal aprox
            });
            $('#billingModal').modal('show');
        });

        // let servicioIndexActualizar = 0; 
        document.getElementById('addServiceBtnActualizar').addEventListener('click', function () {
            const container = document.getElementById('servicesContainerActualizar');
            const row = document.createElement('div');
            row.className = 'row mb-3 pt-2';
            row.innerHTML = `
                <div class="col-md-6">
                    <input type="checkbox" name="check${servicioIndexActualizar}" class="check-item" data-clave="${servicioIndexActualizar}" checked hidden>
                    <input type="text" name="nombre${servicioIndexActualizar}" class="form-control mt-2" data-clave="${servicioIndexActualizar}" placeholder="Service Name">
                </div>
                <div class="col-md-3">
                    <input type="text" name="cantidad${servicioIndexActualizar}" class="form-control" placeholder="Qty" data-clave="${servicioIndexActualizar}">
                </div>
                <div class="col-md-3">
                    <input type="text" name="valor${servicioIndexActualizar}" class="form-control" placeholder="Unit Price" data-clave="${servicioIndexActualizar}">
                </div>
                `;
            const row2 = document.createElement('div');
            row2.className = 'row col-12';
            row2.innerHTML = `
                <textarea class="form-control" rows="2" name="descripcionservicio${servicioIndexActualizar}" data-clave="${servicioIndexActualizar}" placeholder="Description"></textarea>
                `;
            container.appendChild(row);
            container.appendChild(row2);
            servicioIndexActualizar++;
        });

        $('#btnActualizarFactura').click(function () {
            let datos = $('#billingFormActualizar').serialize();
            datos += "&accion=insertarFacturaRapida"; // Agregar el id de la factura
            $.ajax({ 
                type: "POST",
                url: "../controller/solicitudController.php",
                data: datos,
                dataType: "json",
                success: function (r) {
                    if(r.status=='0'){
                        Swal.fire("Éxito", "Factura actualizada con éxito.", "success")
                            .then(() => {
                                window.location.href = 'solo_factura.php';
                            });
                    }else{
                        Swal.fire("Error", "Fallo en la inserción de la factura.", "error");
                    }
                },
                error: function (r) {
                    console.log(r);
                    Swal.fire("Error", "Error en la comunicación con el servidor.", "error");
                }
            });
        });

    });

    $(document).ready(function() {
        $('#paymentType').change(function() {
            if ($(this).val() === 'parcial') {
                $('#partialAmountGroup').show();
            } else {
                $('#partialAmountGroup').hide();
            }
        });
    });


</script>
</body>
</html>
