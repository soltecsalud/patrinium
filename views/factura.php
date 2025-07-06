<?php
// session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
    exit();
} 
include_once "../controller/solicitudController.php";
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
    <link rel="stylesheet" href="../resource/AdminLTE-3.2.0/plugins/tail-select/css/default/tail.select-light.css">
 <!-- jQuery (carga primero) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">

<!-- DataTables JS (carga después de jQuery) -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.colVis.min.js"></script>

<!-- JSZip para exportar a Excel -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<!-- pdfMake para exportar a PDF -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>


    
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
                            <table id="facturaTable" class="table table-bordered table-striped dataTable">
                                <thead>
                                    <tr>
                                        <th colspan="3">Acciones</th>
                                        <!-- <th>N&uacute;mero de cliente</th>  -->
										<th>Persona facturada</th>
                                        <th>N&uacute;mero factura</th>                                                                                                                    
                                        <th>Facturado por</th>
                                        <th>Banco</th>
                                        <th>N&uacute;mero de cuenta</th>
                                        <th>Fecha</th>
                                        <th>Total</th>
                                        <th>Observaci&oacute;nes</th>
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

    <!-- Modal adjuntar factura-->
    <div class="modal fade" id="billingModal" tabindex="-1" role="dialog" aria-labelledby="billingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="billingModalLabel">Facturar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="billingForm">
                        <div class="row" id="personaafacturar">
                        </div>
                        <div class="row">
                            <input type="hidden" id="idFactura" name="idFactura" >
                            <div class="col-md-3">
                                <label class="text-center mb-2" style="font-size: smaller;" for="companySelect">
                                    Company Issuing Invoice:
                                </label>
                                <select class="form-select" id="companySelect" name="logo" required>
                                    <!-- <option value="">Select Company</option>
                                    <option value="patrinium">Patrimonium</option>
                                    <option value="Vargas & Associates">Vargas & Associates</option>
                                    <option value="Tándem International Business Services">Tándem International Business Services</option>
                                    <option value="Lamva Investment">Lamva Investment</option> -->
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="text-center mb-2" style="font-size: smaller;" for="bankAccountSelect">
                                    Bank Account for Deposit:
                                </label>
                                <select class="form-select" id="bankAccountSelect" name="cuenta_bancaria">
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
                                <input type="text" class="form-control" id="invoiceNumberInput" name="invoice_number" placeholder="Enter invoice number">
                            </div>
                            <div class="col-md-3">
                                
                                <input type="hidden"   value=" "   class="form-control" id="tax" name="tax" placeholder="Enter TAX">
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-4">
                                <label class="text-center mb-2" style="font-size: smaller;" for="email">
                                    Email:
                                </label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email">
                            </div>
                            <div class="col-md-4">
                                <label class="text-center mb-2" style="font-size: smaller;" for="adress">
                                    Address:
                                </label>
                                <input type="text" class="form-control" id="adress" name="adress" placeholder="Enter Address">
                            </div>
                            <div class="col-md-4">
                                <label class="text-center mb-2" style="font-size: smaller;" for="numberTax">
                                    Number TAX:
                                </label>
                                <input type="text" class="form-control" id="numberTax" name="numberTax" placeholder="Enter tax number">
                            </div>
                        </div>

                        <hr class="my-4 primary">

                        <div class="row">
                            <label class="mb-2 h5" style="margin-top: 2%; padding-bottom: 2%;" for="invoiceNumberInput">
                                Billing Services:
                            </label>
                            <div id='serviciosInfo'>

                            </div>
                        </div> 
                        <input type="hidden" name="total_factura">

                        <div class="row" style="margin-bottom: 3%;">
                            <label class="mb-2 h5" style="margin-top: 2%; padding-bottom: 2%;" for="observaciones">
                                Observations:
                            </label>
                            <div class="col-12">
                                <textarea class="form-control" rows="5" name="observaciones" id="observaciones" placeholder="Write something here"></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <input type="hidden" name="id_solicitud" value="<?php echo $id_revisar_solicitud; ?>">
                            <input type="hidden" name="estado" value="2">
                            <button type="button" id="btnInsertarFactura" style="margin-bottom: 1%;" class="btn btn-primary">Insert Invoice</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="tuModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Formulario de Pago</h5>
            </div>
            <div class="modal-body">
                <!-- Formulario -->
                <form id="paymentForm">
                <!-- Campo oculto para invoice_number -->
                <input type="hidden" id="invoiceNumber" name="id_solicitud">
                <!-- Campo oculto para idFactura -->
                <input type="hidden" id="id_factura" name="id_factura">
                <!-- Select si el pago es parcial o total -->
                <div class="form-group">
                    <label for="paymentType">Tipo de Pago</label>
                    <select class="form-control" id="paymentType" name="payment_type" required>
                        <option value="">Selecciona Una Forma de Pago</option>
                        <option value="total">Total</option>
                        <option value="parcial">Parcial</option>
                    </select>
                    <!-- Activar input si el pago es parcial -->
                    <div class="form-group" id="partialAmountGroup" style="display: none;">
                        <label for="partialAmount">Monto Parcial</label>
                        <input type="number" class="form-control" id="partialAmount" name="partial_amount" placeholder="Ingrese el monto parcial">
                    </div>
                </div>        
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
                    <label for="paymentOption">Opci&oacute;n de Pago</label>
                    <select class="form-control" id="paymentOption" name="payment_option">
                        <!-- Opciones cargadas dinámicamente vía AJAX -->
                    </select>
                </div>
                <!-- Botón de envío -->
                <button type="submit" id="btn-payment" class="btn btn-primary">Enviar</button>
                </form>
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
    <script src="../resource/AdminLTE-3.2.0/plugins/tail-select/js/tail.select-full.js"></script>

<script>
    $(document).ready(function() {
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
    });
</script>
    <script>
        function cargarPersonas(selectElement,idSeleccionado = null,personaIndex = null, idSolicitud = null) {
            // alert(selectElement + ' # ' + idSeleccionado + ' # ' + personaIndex+ ' # ' + idSolicitud);
            $.ajax({
                url: '../controller/sociedadController.php', 
                type: 'GET',
                data: {
                    accion: 'getSociedades',
                    idSolicitud: idSolicitud
                },
                dataType: 'json',
                success: function(dataSociedades) {
                    // console.log('Respuesta del servidor dataSociedades:', dataSociedades); // Depuración
                    selectElement.empty();
                    selectElement.append('<option value="">Selecciona una Persona</option>');
                    $.each(dataSociedades, function(index, item) {
                        let idSociedadItem = '';
                        if (item.uuid === null && item.idcliente === 0 && item.idextranjero === 0) {
                            idSociedadItem = item.id_sociedad;
                        } else if (item.uuid === null && item.id_sociedad === 0 && item.idextranjero === 0) {
                            idSociedadItem = item.idcliente;
                        } else if (item.id_sociedad === 0 && item.idcliente === 0 && item.idextranjero === 0) {
                            idSociedadItem = item.uuid;
                        }else if(item.uuid === null && item.id_sociedad === 0 && item.idcliente === 0){
                            idSociedadItem = item.idextranjero;
                        } 
                        
                        var tipoTexto, tipoColor;
                        if (item.tipo === 'sociedad') {
                            tipoTexto = "Sociedad";
                            tipoColor = "blue";
                        } else if (item.tipo === 'socio_extranjero') {
                            tipoTexto = "Socio extranjero";
                            tipoColor = "orange";
                        }else if(item.tipo === 'miembro'){
                            tipoTexto = "Cliente";
                            tipoColor = "purple"; 
                        }

                        let idSociedadItemStr = String(idSociedadItem);
                        let idSeleccionadoStr = String(idSeleccionado);

                        let selected = (idSeleccionado !== null && idSeleccionadoStr === idSociedadItemStr) ? 'selected' : '';

                        // console.log(Evaluando: ${item.nombre} | ID: ${idSociedadItemStr} | Seleccionado: ${selected});

                        // if (selected == 'selected'){
                        //     console.log('ID Sociedad:', idSociedadItem , ' | ID Seleccionado:', idSeleccionado); // Depuración
                        // }
                        selectElement.append(` 
                            <option value="${idSociedadItemStr}" ${selected} data-id="${item.tipo}" 
                                data-description="<span style='color:${tipoColor}; font-weight: bold;'>${tipoTexto}</span>">
                                ${item.nombre}
                            </option>
                        `);
                    });
                    // tail.select("#selectPersonaFactura", {
                    tail.select('#' + selectElement.attr('id'), {
                        search: true,
                        descriptions: true, // Activa la descripción con estilos
                        hideSelected: true,
                        hideDisabled: true,
                        // multiLimit: 4,
                        multiShowCount: false,
                        multiContainer: true
                    }).reload();
                },
                error: function(xhr, status, error) {
                    console.error('Error en la solicitud AJAX:', status, error);
                    console.log('Respuesta del servidor:', xhr.responseText);
                    alert('Error al cargar las opciones');
                }
            });
        }
    </script>
<script>
    var datosFacturas  = [];
    var datosServicios = [];
    $(document).ready(function() {
        $.ajax({
            url: '../controller/serviciosPatriniumController.php',
            type: 'POST',
            data: { action: 'listarServicios' },
            dataType: 'json',
            success: function(response) {
                $.each(response, function(index, servicio) {
                    datosServicios.push(servicio);
                });
            },
            error: function(xhr, status, error) {
                console.error('Error al obtener los datos: ', xhr.responseText);
            }
        });

        $.ajax({
            url: '../controller/facturaController.php', // Cambia esto por la ruta correcta a tu controlador
            type: 'POST',
            data: { action: 'listarFacturas' },
            dataType: 'json',
            success: function(response) {
                // console.log(response); // Añade esto para ver la respuesta en la consola
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
                    datosFacturas.push(factura);
                    // <td>${factura.id_solicitud}</td>
                    let row = `<tr>
                        <td><input id="payment-${factura.id_solicitud}" class="btn btn-primary payment-btn" type="button" value="Payment"  data-id-factura="${factura.id}" data-id-solicitud="${factura.id_solicitud}"/></td>
                        <td><input id="payment-${factura.id}" class="btn btn-success update-btn" type="button" value="Actualizar" data-id-factura="${factura.id}"  /></td>
                        <td><input id="payment-${factura.id}" class="btn btn-danger delete-btn" type="button" value="Eliminar" data-id-factura="${factura.id}"  /></td>
                        <td>${factura.nombre_obtenido}</td>
                        <td>${datos.invoice_number}</td>
                        <td>${datos.logo}</td>
                        <td>${factura.nombre_banco}</td>
                        <td>${factura.numero_cuenta}</td>
                        <td>${factura.created_at}</td>
                        <td>${Number(total).toLocaleString('es-CO', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                        <td>${datos.observaciones}</td>
                    </tr>`;
                    tbody.append(row);
                });
               
        $("#facturaTable").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "destroy": true, // Esto evita que se duplique la tabla al recargar datos
            "buttons": ["copy", "excel", "pdf", "print", "colvis"]
            
        }).buttons().container().appendTo('#facturaTable_wrapper .col-md-6:eq(1)');
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
            $('#id_factura').val($(this).data('id-factura')); // Actualiza el id_factura en el formulario
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
                dataType: 'json',
                success: function(response) {
                    // console.log(response);
                    if(response.status == 'success') {
                        Swal.fire({
                        title: '¡Éxito!',
                        text: '¡Archivo guardado exitosamente!',
                        icon: 'success',
                        confirmButtonText: 'Aceptar',
                        location:  'top-end',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload(); // Recargar la página para mostrar los cambios
                            }
                        });
                    }else{
                        Swal.fire({
                            title: 'Error',
                            text: 'No se pudo guardar el archivo.',
                            icon: 'error',
                            confirmButtonText: 'Aceptar'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

        $(document).on('click', '.delete-btn', function() {
            var idFactura = $(this).data('id-factura');
            if(idFactura!=null){
                $.ajax({
                    url: '../controller/facturaController.php', // Asegúrate de que la ruta es correcta
                    type: 'POST',
                    data: { 
                        accion: 'eliminarFactura', 
                        idFactura: idFactura
                    },
                    dataType: 'json',
                    success: function(response) {
                        // console.log(response);
                        if(response.status=='ok'){
                            Swal.fire("Éxito", "Factura eliminada", "success")
                            .then(() => { 
                                location.reload(); // Recargar la página para mostrar los cambios
                            });
                        }else{
                            Swal.fire("Error", "Fallo la creacion del socio", "error");
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
            
        });

        $(document).on('click', '.update-btn', function() {
            // Obtén el de la factura del botón que fue clickeado
            var idFactura = $(this).data('id-factura'); 

            $('#idFactura').val(idFactura);
            
            // Recorrer el array de datosFacturas para encontrar la factura correspondiente
            var factura = datosFacturas.find(factura => factura.id === idFactura);
            // console.log(factura);
            // Parsear el contenido JSON de la propiedad 'datos'
            var datos = JSON.parse(factura.datos);
            // Asignar los valores a los campos del formulario
            $('#companySelect').val(datos.logo);
            $('#bankAccountSelect').val(factura.id_banco);
            $('#invoiceNumberInput').val(datos.invoice_number);
            $('#tax').val(datos.tax);
            $('#email').val(datos.email);
            $('#adress').val(datos.adress);
            $('#numberTax').val(datos.number_tax);
            $('#observaciones').val(datos.observaciones);

            var companySelect = $('#companySelect'); 
            $.ajax({
                url: '../controller/empresasController.php',
                type: 'POST',
                data: { action: 'listarEmpresas' },
                dataType: 'json',
                success: function(response) { 
                    if (response.status === "success") {
                        // Limpia el select antes de agregar las opciones
                        companySelect.empty(); 
                        companySelect.append(new Option("Seleccionar empresa", "", true, true)); // Opción por defecto
                        response.data.forEach(function(company) { 
                            // Agrega la opción de la empresa actual
                            if (company.id_empresa === parseInt(datos.logo)) {
                                companySelect.append(new Option(company.nombre_empresa, company.id_empresa, true, true));
                            }else{ // Agrega las demás opciones
                                companySelect.append(new Option(company.nombre_empresa, company.id_empresa));
                            }
                        });
                    } else {
                        console.error("Error al cargar las empresas:", response.mensaje);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error en la solicitud AJAX:", error);
                }
            });


            var campoPersonaFacturar = `
                <div class="form-group row">
                    <div class="col-md-8">
                        <label for="selectPersona">Persona a facturar</label>
                        <select class="form-control selectPersona" id='selectPersonaFactura-${idFactura}' name="selectPersonaFactura" required>
                            <option value="">Seleccionar persona</option>
                        </select>
                    </div>
                </div>
            `;
            $('#personaafacturar').empty(); // Limpiar el contenedor antes de agregar el nuevo campo
            $('#personaafacturar').append(campoPersonaFacturar);
            var personaafacturar = $('#selectPersonaFactura-'+idFactura); // Seleccionar el ultimo select
            cargarPersonas(personaafacturar,datos.selectPersonaFactura,'factura',factura.id_solicitud);
            //Rorrer datos.servicios y mostrar en el modal
            var servicios = datos.servicios;
            var serviciosInfo = '';
			$.each(servicios, function(nombreServicio, detalleServicio) {
				var servicio = datosServicios.find(servicio => servicio.servicio_name === nombreServicio);

				if (!servicio) {
					//console.warn(`Servicio no encontrado: ${nombreServicio}`);
					servicio = { nombre_servicio: nombreServicio }; // Asignar un valor temporal para evitar el error
				}

                detalleServicio.descripcionservicio = detalleServicio.descripcionservicio || '';

				serviciosInfo += `
					<div class="row  col-12">
						<div class="col-md-6 mb-3">
							<input type="checkbox" id="check${nombreServicio}" name="check${nombreServicio}" class="check-item" data-clave="${nombreServicio}" checked hidden>
							&nbsp;
							<label>${servicio.nombre_servicio}</label>
							</div>
							<div class="col-md-3 mb-2">
								<input type="text" placeholder="Qty" name="cantidad${nombreServicio}" class="form-control"  value="${detalleServicio.cantidad}" data-clave="${nombreServicio}">
							</div>
							<div class="col-md-3 mb-2">
								<input type="text" placeholder="Unit Price" name="valor${nombreServicio}" class="form-control" value="${detalleServicio.valor}" data-clave="${nombreServicio}">
							</div>
						</div>
                        <div class="row col-12">
                            <textarea class="form-control" rows="2" name="descripcionservicio${nombreServicio}" data-clave="${nombreServicio}">${detalleServicio.descripcionservicio}</textarea>
                        </div>
                        <br>
					`;
			});
            // Aquí puedes mostrar los servicios en el modal, por ejemplo:
            $('#serviciosInfo').html(serviciosInfo); // Asegúrate de tener un elemento con este ID en tu modal
            
            // Mostrar los servicios en el modal
            $('#billingModal').modal('show');
            
        });

        $('#btnInsertarFactura').click(function() {
            var datos = $('#billingForm').serialize();
            datos += "&accion=actualizarDatosFactura"; // Añadir acción específica para el controlador
            // console.log(datos);
            $.ajax({
                type: "POST",
                url: "../controller/facturaController.php",
                data: datos,
                success: function(response) {
                    // console.log(response);
                    // var m = JSON.parse(response)
                    // console.log(m.status);
                    // console.log(response.message);
                    if(response.status==="ok"){
                        Swal.fire("Éxito", "Factura actualizada", "success")
                        .then(() => {
                            location.reload();
                        });
                    }else{
                        Swal.fire("Error", "Fallo la actualización de la factura", "error");
                    }
                },
                error: function() {
                    alert("Error en la comunicación con el servidor.");
                }
            });
            return false;
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

    
</html>


