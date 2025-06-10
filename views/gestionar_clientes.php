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
    <title>PatrimoniumAPP || Clientes </title>
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <section class="content">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Clientes Patrimoniun</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="tableDocumentosSociedadContainer_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <table id="serviciosTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>N&uacute;mero cliente</th>
                                            <th>Nombre cliente</th>
											<th>Apellido cliente</th>
                                            <th>Pais de Nacimiento</th>
                                            <th>Fecha creaci&oacute;n</th>
                                            <th colspan="2">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="clientes_patrimonium"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="modal fade" id="modalActualizarServicio" tabindex="-1" role="dialog" aria-labelledby="modalActualizarServicioLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" style="max-width: 90%;width: auto;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalActualizarServicioLabel">Actualizar Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="frm_guardar_sociedad">
                        <input type="hidden" name="id_cliente" id="id_cliente"> 
                        <input type="hidden" name="tipo" id="tipo">
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="nombre">Nombre</label>
                                <input type="text" name="nombre" class="form-control" id="nombre" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="apellido">Apellido</label>
                                <input type="text" name="apellido" class="form-control" id="apellido" required>
                            </div>
                            <div id="divNombreEncontrado" style="display: none;">
                                <p style="color: red;font-weight: bold;"><i>El cliente ya est&aacute; registrado</i></p>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="fechaNacimiento">Fecha de Nacimiento</label>
                                <input type="date" name="fechaNacimiento" class="form-control" id="fechaNacimiento" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="estadoCivil">Estado Civil</label>
                                <select class="form-control" name="estadoCivil" id="estadoCivil">
                                    <option value="soltero">Soltero</option>
                                    <option value="casado">Casado</option>
                                    <option value="viudo">Viudo</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="paisOrigen">País de Origen</label>
                                <input type="text" name="paisOrigen" class="form-control" id="paisOrigen" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="paisResidenciaFiscal">País de Residencia Fiscal</label>
                                <input type="text" name="paisResidenciaFiscal" class="form-control" id="paisResidenciaFiscal" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="paisResidenciaFiscal">Ciudad</label>
                                <input type="text" name="ciudad" class="form-control" id="ciudad" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="paisDomicilio">País de Domicilio</label>
                                <input type="text" name="paisDomicilio" class="form-control" id="paisDomicilio" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="numeroPasaporte">Número de Pasaporte</label>
                                <input type="text" name="numeroPasaporte" class="form-control" id="numeroPasaporte" required>
                            </div>
                            <div class="col-md-6 mb-3"></div>
                            <div id="divPasaporteEncontrado" style="display: none;">
                                <p style="color: red;font-weight: bold;"><i>El cliente ya est&aacute; registrado</i></p>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="paisPasaporte">País de Pasaporte</label>
                                <input type="text" name="paisPasaporte" class="form-control" id="paisPasaporte" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="tipoVisa">Tipo de Visa</label>
                                <input type="text" name="tipoVisa" class="form-control" id="tipoVisa" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="direccionLocal">Dirección Local</label>
                                <input type="text" name="direccionLocal" class="form-control" id="direccionLocal" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="telefonos">Teléfonos</label>
                                <input type="text" name="telefonos" class="form-control" id="telefonos" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="emails">Emails</label>
                                <input type="email" name="emails" class="form-control" id="emails" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="industria">Industria o Sector en el que Opera</label>
                                <input type="text" name="industria" class="form-control" id="industria" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="nombreNegocioLocal">Nombre Principal del Negocio Local</label>
                                <input type="text" name="nombreNegocioLocal" class="form-control" id="nombreNegocioLocal" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="ubicacionNegocioPrincipal">Ubicación del Negocio Principal</label>
                                <input type="text" name="ubicacionNegocioPrincipal" class="form-control" id="ubicacionNegocioPrincipal" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="tamanoNegocio">Tamaño del Negocio</label>
                                <input type="text" name="tamanoNegocio" class="form-control" id="tamanoNegocio" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="contactoEjecutivoLocal">Contacto de su Ejecutivo Local</label>
                                <input type="text" name="contactoEjecutivoLocal" class="form-control" id="contactoEjecutivoLocal" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="numeroEmpleados">No Empleados</label>
                                <input type="number" name="numeroEmpleados" class="form-control" id="numeroEmpleados" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="numeroHijos">Número de Hijos</label>
                                <input type="number" name="numeroHijos" class="form-control" id="numeroHijos" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="razonConsultoria">Razón de la Consultoría</label>
                                <input type="text" name="razonConsultoria" class="form-control" id="razonConsultoria" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="requiereRegistroCorporacion">Requiere Registro de Corporación</label>
                                <select class="form-control" name="requiereRegistroCorporacion" id="requiereRegistroCorporacion">
                                    <option value="si">Sí</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="observaciones">Observaciones y Notas</label>
                                <textarea name="observaciones" class="form-control" id="observaciones" rows="4"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="offset-4 col-8">
                                <button name="submit" id="btnGuardarSociedad" class="btn btn-primary">Guardar</button>
                            </div>
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
        var dataCliente = [];
        $(document).ready(function() {
            var datos = [];
            $.ajax({
                url: '../controller/sociedadController.php',
                type: 'GET',
                data: { accion: 'getAllSociedadesRegistrarSocilitud' },
                dataType: 'json',
                success: function(response){ 
                    // console.log(response);
                    let tbody = $('#clientes_patrimonium');
                    tbody.empty();
                    $.each(response, function(index, cliente) {
                        dataCliente.push(cliente);
                        // let row = `<tr>
                        //     <td>${cliente.id_sociedad}</td>
                        //     <td>${cliente.nombre} ${cliente.apellido}</td>
                        //     <td>${cliente.createdat}</td>
                        //     <td>
                        //         <a style="margin-right: 10px;"  class="btn btn-success m-0" data-toggle="modal" data-target="#modalActualizarServicio" data-id="${cliente.uuid}" data-nombre="${cliente.nombre}" data-created="${cliente.createdat}">
                        //             Actualizar
                        //         </a>
                        //     </td>
                        // </tr>`;
                        // tbody.append(row);
                    });
                    $("#serviciosTable").DataTable({ 
                        "data": dataCliente, // Cargar los datos desde el array
                        "columns": [
                            { "data": "id_sociedad" },
                            { "data": "nombre" },
							{"data":"apellido"},
                            {"data":"pais_origen"},
                            { "data": "createdat" },
                            {
                                "data": null,
                                "render": function(data, type, row) {
                                    return `<a style="margin-right: 10px;" class="btn btn-success m-0" data-toggle="modal" data-target="#modalActualizarServicio" data-id="${row.uuid}" data-nombre="${row.nombre}" data-created="${row.createdat}">Actualizar</a>`;
                                }
                            }
                        ],
                        "dom": 'Bfrtip',
                        "destroy": true,
                        "responsive": true,
                        "lengthChange": true,
                        "autoWidth": false,
                        "buttons": ["excel", "pdf"]
                    }).buttons().container().appendTo('#tableDocumentosSociedadContainer_wrapper .col-md-6:eq(0)');
                },
                error: function(xhr, status, error) {
                    console.error('Error al obtener los datos: ', xhr.responseText);
                }
            });

            $('#modalActualizarServicio').on('show.bs.modal', function(event) {
                var button  = $(event.relatedTarget); 
                var id      = button.data('id');
                //Recorrer el array de objetos y buscar el objeto que coincida con el id
                var cliente = dataCliente.find(cliente => cliente.uuid === id);
                // console.log(cliente);

                $('#id_cliente').val(cliente.uuid);
                $('#tipo').val(cliente.tipo);
                $('#nombre').val(cliente.nombre);
                $('#apellido').val(cliente.apellido);
                $('#fechaNacimiento').val(cliente.fecha_nacimiento);
                $('#estadoCivil').val(cliente.estado_civil);
                $('#paisOrigen').val(cliente.pais_origen);
                $('#paisResidenciaFiscal').val(cliente.pais_residencia_fiscal);
                $('#paisDomicilio').val(cliente.pais_domicilio);
                $('#numeroPasaporte').val(cliente.numero_pasaporte);
                $('#paisPasaporte').val(cliente.pais_pasaporte);
                $('#tipoVisa').val(cliente.tipo_visa);
                $('#direccionLocal').val(cliente.direccion_local);
                $('#telefonos').val(cliente.telefonos);
                $('#emails').val(cliente.emails);
                $('#industria').val(cliente.industria);
                $('#nombreNegocioLocal').val(cliente.nombre_negocio_local);
                $('#ubicacionNegocioPrincipal').val(cliente.ubicacion_negocio_principal);
                $('#tamanoNegocio').val(cliente.tamano_negocio);
                $('#contactoEjecutivoLocal').val(cliente.contacto_ejecutivo_local);
                $('#numeroEmpleados').val(cliente.numero_empleados);
                $('#numeroHijos').val(cliente.numero_hijos);
                $('#razonConsultoria').val(cliente.razon_consultoria);
                $('#requiereRegistroCorporacion').val(cliente.requiere_registro_corporacion);
                $('#observaciones').val(cliente.observaciones);
                $('#ciudad').val(cliente.ciudad);
                $('#id_solicitud').val(cliente.id_solicitud);

            });

            $('#btnGuardarSociedad').click(function(e){        
                e.preventDefault(); // Previene el comportamiento por defecto del botón
                var datos = $('#frm_guardar_sociedad').serialize() + "&accion=actualizarCliente";
                // console.log(datos);  // Verifica que los datos se están serializando correctamente
                $.ajax({
                    type: "POST",
                    url: "../controller/sociedadController.php",
                    data: datos,
                    success: function(response){
                        console.log(response); 
                        if(response.status=='ok'){
                            Swal.fire("Éxito", "Cliente actualizado", "success")
                            .then(() => {
                                window.location.href = 'gestionar_clientes.php';
                            });
                        }else{
                            Swal.fire("Error", "Fallo la actualización del cliente", "error");
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error en la solicitud:", status, error);
                        alert("Error en la solicitud AJAX");
                    }
                });
            });


        });
    </script>
    
</html>