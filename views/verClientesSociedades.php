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
    <title>Socuedades y clientes</title>
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <section class="content">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Sociedades y Clientes</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- <div class="col-6"> -->
                                <table id="sociedadesTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sociedades</th>
                                            <th>Cliente de la sociedad</th>
                                            <th>Informaci&oacute;n de la sociedad</th>
                                            <th>SEGURIDAD (MFA)</th>
                                            <th>Habilitar Carga</th>
                                            <th>Usuario Carga</th>
                                        </tr>
                                    </thead>
                                    <tbody id="sociedades_patrimonium"></tbody>
                                </table>
                                <!-- </div> -->
                                <!-- <div class="col-6">
                                <table id="clientesTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Clientes</th>
                                        </tr>
                                    </thead>
                                    <tbody id="clientes_patrimonium"></tbody>
                                </table>
                            </div> -->
                            </div> <!-- End row -->
                        </div> <!-- End card-body -->
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modalverinformacion" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document" style="max-width: 90%;width: auto;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel">Informaci&oacute;n sociedad</h5>
                            <button type="button" class="close" id="btnCerrarModalSociedad2" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="conjunto_sociedades[]" id="conjunto_sociedades">
                            <input type="hidden" name="conjunto_personas[]" id="conjunto_personas">
                            <input type="hidden" name="conjunto_clientes[]" id="conjunto_clientes">
                            <input type="hidden" name="conjunto_socios_extranjeros[]" id="conjunto_socios_extranjeros">
                            <form id="formCrearSociedad">
                                <!-- Nombre de la Sociedad -->
                                <input type="hidden" id="idSociedad" name="idSociedad">
                                <div class="form-group" id="divActivarSociedad">
                                    <label class="checkbox-container">
                                        <input type="checkbox" name="activarSociedad" id="activarSociedad" checked="true" disabled>
                                        <span class="checkmark"></span>
                                        Activar Sociedad
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="checkbox-container">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input type="checkbox" name="declararSociedad" id="declararSociedad" checked="true" disabled>
                                                <span class="checkmark"></span>
                                                <h7 id='declararSociedadTexto'></h7>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="inputNombreSociedad">Nombre de la Sociedad</label>
                                    <input type="text" class="form-control" id="inputNombreSociedad" name="nombreSociedad" placeholder="Nombre de la sociedad" disabled>
                                    <div id="divNombreEncontrado" style="display: none;">
                                        <p style="color: red;font-weight: bold;"><i>La sociedad ya est&aacute; registrada</i></p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputNombreSociedad">Tipo de Sociedad</label>
                                    <select id="selectTipoSociedad" name="selectTipoSociedad" class="form-control" disabled>
                                        <option value="">Seleccionar tipo de sociedad</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="inputEstado">Estados</label>
                                    <div id="selectEstado"></div>
                                </div>

                                <!-- Contenedor para las personas y porcentajes -->
                                <hr />
                                <label for="personasContainer">Socios de la Sociedad</label>
                                <div id="personasContainer">
                                </div>
                                <!-- Input hidden -->
                                <input type="hidden" id="hiddenInput" name="hiddenField" value="<?php echo $id_revisar_solicitud; ?>">

                                <!-- Documentos de la Sociedad -->
                                <div id="documentosSociedad" class="form-group pt-2" style="display: none;">
                                    <hr />
                                    <label for="documentosSociedad">Documentos de la Sociedad</label>
                                    <div id="tableDocumentosSociedadContainer_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                        <table id="documentosAdjuntosxSociedad" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Fecha</th>
                                                    <th>Nombre archivo</th>
                                                    <th>Tipo</th>
                                                    <th>N&uacute;mero de registro</th>
                                                    <th>Fecha entrega</th>
                                                    <th>Descargar</th>
                                                </tr>
                                            </thead>
                                            <tbody id="documentosSociedadBody">
                                                <!-- Aquí se insertarán las filas dinámicamente con JavaScript -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Reportes por cada Sociedad -->
                                <div id="reportesSociedad" class="form-group pt-2" style="display: none;">
                                    <hr />
                                    <label for="reportesSociedad">Reportes de la Sociedad</label>
                                    <div id="reportesSociedadContainer" class="pt-2">
                                        <table id="reportesSociedadTabla" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Fecha</th>
                                                    <th>HTML</th>
                                                    <th>PDF</th>
                                                </tr>
                                            </thead>
                                            <tbody id="reportesSociedadTablaBody">
                                                <!-- Aquí se insertarán las filas dinámicamente con JavaScript -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <!-- <button type="button" id="btnGuardarSociedad" class="btn btn-primary">Guardar Sociedad</button> -->
                            <button type="button" class="btn btn-secondary" id='btnCerrarModalSociedad' data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>

</body>
<?php include_once "footer/footer_views.php"; ?>
<script src="../resource/AdminLTE-3.2.0/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="../resource/AdminLTE-3.2.0/plugins/jquery-validation/additional-methods.min.js"></script>
<script src="../resource/AdminLTE-3.2.0/plugins/jquery-validation/localization/messages_es.min.js"></script>


<script>
    var dataSociedad = [];
    var dataTablaSociedad = [];
    $(document).ready(function() {
        cargarTipoSociedad(null,null);
        function cargarTipoSociedad(id,tipo){
            $.ajax({
                url: '../controller/tipoSociedadController.php', // Cambia esto por la ruta correcta a tu controlador
                type: 'POST',
                data: { action: 'listarTipoSociedad' },
                dataType: 'json',
                success: function(response) {
                    // console.log(response);
                    var selectTipoSociedad = $('#selectTipoSociedad');
                    selectTipoSociedad.empty();
                    if(id !== null){
                        selectTipoSociedad.append(`<option value="${id}" selected>${tipo}</option>`);
                    }else{
                        selectTipoSociedad.append('<option value="">Selecciona un tipo de sociedad</option>');
                    }
                    $.each(response, function(index, tipoSociedad) {
                        if(id !== tipoSociedad.id_tipo_sociedad){
                            selectTipoSociedad.append(`<option value="${tipoSociedad.id_tipo_sociedad}">${tipoSociedad.nombre_tipo_sociedad}</option>`);
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error al obtener los datos: ', xhr.responseText);
                }
            });
        }
        function cargarEstados(estadosSeleccionados = []){
            $.ajax({
                url: '../controller/estadosController.php',
                type: 'GET',
                data: {
                    accion: 'getEstados'
                },
                dataType: 'json',
                success: function(data) {
                    var selectEstado = $('#selectEstado');
                    selectEstado.empty(); 
                    $.each(data, function(index, item) {  
                        var selected = estadosSeleccionados.includes(item.id_estado) ? 'checked' : '';
                        if(selected){
                            selectEstado.append('<ul><li>'+ item.estado + '</li></ul>');
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error al cargar los estados:', error);
                }
            });
        }
        $.ajax({
            url: '../controller/sociedadController.php',
            type: 'GET',
            data: {
                accion: 'obtenerTodasSociedades'
            },
            dataType: 'json',
            success: function(response) {
                let tbody = $('#sociedades_patrimonium');
                tbody.empty();
                $.each(response, function(index, sociedad) {
                    dataSociedad.push(sociedad);

                    //Verificar si la sociedad ya existe en el array
                    if (dataTablaSociedad.some(s => s.uuid === sociedad.uuid)) {
                        return; // Si ya existe, no la agregamos de nuevo
                    }
                    dataTablaSociedad.push(sociedad);
                });
                $("#sociedadesTable").DataTable({
                    "data": dataTablaSociedad, // Cargar los datos desde el array si no se ha
                    "columns": [{
                            "data": "nombre_sociedad"
                        },
                        {
                            "data": "nombrecliente"
                        },
                        {
                            "data": null,
                            "render": function(data, type, row) {
                                return `<a class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalverinformacion" data-id="${row.uuid}">
                                            Ver Informaci&oacute;n
                                            </a>`;
                            }
                        },
                        // checkbox para habilitar MFA, si el campo is_required_mfa es true, el checkbox debe estar marcado y mostrar un mensaje de "Habilitado"
                        {
                            "data": null,
                            "render": function(data, type, row) {
                                return `<label class="checkbox-container">
                                            <input type="checkbox" class="mfa-checkbox" data-id="${row.uuid}" ${row.is_required_mfa === true ? 'checked' : ''}>
                                            <span class="checkmark"></span>
                                        </label>`;
                            }
                        }
                        //checkbox para habilitar carga, si el campo is_carga_eeuu es true, el checkbox debe estar marcado y mostrar un mensaje de "Habilitado"
                        ,
                        {
                            "data": null,
                            "render": function(data, type, row) {
                                return `<label class="checkbox-container">
                                            <input type="checkbox" class="carga-checkbox" data-id="${row.uuid}" ${row.is_carga_eeuu === true ? 'checked' : ''}>
                                            <span class="checkmark"></span>
                                        </label>`;
                            }
                        },
                        {
                            // Mostrar select con los usuarios que cargan datos a la sociedad
                            "data": null,
                            "render": function(data, type, row) {
                                return `
                                    <select class="form-control selectUsuarioCarga" name="usuario_carga" id="usuario_carga_${row.uuid}" data-id="${row.uuid}" data-id_usuario_carga_euu="${row.id_usuario_carga_euu}">
                                        <option value="">Seleccionar usuario</option>
                                    </select>`;
                            }
                            //${row.usuarios_carga.map(usuario => `<option value="${usuario.id_usuario}" ${usuario.is_selected ? 'selected' : ''}>${usuario.nombre_usuario}</option>`).join('')}
                        }
                    ],
                    "destroy": true,
                    "responsive": true,
                    "lengthChange": true,
                    "autoWidth": false,
                });
                cargarUsuarios(); // Cargar los usuarios en los selects después de inicializar la tabla
            },
            error: function(xhr, status, error) {
                console.error('Error al obtener los datos: ', xhr.responseText);
            }
        });

        // Evento para el checkbox de habilitar MFA
        $(document).on('change', '.mfa-checkbox', function() {
            var idSociedad = $(this).data('id');
            var isChecked  = $(this).is(':checked');
            $.ajax({
                url: '../controller/sociedadController.php',
                type: 'POST',
                data: {
                    accion: 'actualizarEstadoMFA',
                    idSociedad: idSociedad,
                    isRequiredMFA: isChecked
                },
                dataType: 'json',
                success: function(response) { 
                    if (response.status === 'success') { 
                        alert('Estado de MFA actualizado correctamente.');
                    } else {
                        alert('Error al actualizar el estado de MFA: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error al actualizar el estado de MFA:', xhr.responseText);
                }
            });
        });

        // Evento para el checkbox de habilitar carga
        $(document).on('change', '.carga-checkbox', function() {
            var idSociedad = $(this).data('id');
            var isChecked  = $(this).is(':checked');
            $.ajax({
                url: '../controller/sociedadController.php',
                type: 'POST',
                data: {
                    accion: 'actualizarEstadoCarga',
                    idSociedad: idSociedad,
                    isCargaEEUU: isChecked 
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        alert('Estado de carga actualizado correctamente.');
                    } else {
                        alert('Error al actualizar el estado de carga: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error al actualizar el estado de carga:', xhr.responseText);
                }
            });
        });

        $('#modalverinformacion').on('show.bs.modal', function(event) {
            var button  = $(event.relatedTarget); 
            var id      = button.data('id');
            // Limpiar los campos del formulario antes de cargar la nueva sociedad
            var sociedad = dataSociedad.find(sociedad => sociedad.uuid === id);

            $('#idSociedad').val(sociedad.uuid);
            $('#inputNombreSociedad').val(sociedad.nombre_sociedad);
            $('#selectTipoSociedad').val(sociedad.selecttiposociedad).trigger('change');
            var estadopais =  JSON.parse(sociedad.estadopais);
            estadopais = estadopais.map(Number);
            cargarEstados(estadopais);
            $('#conjunto_sociedades').val(sociedad.conjunto_sociedades);
            $('#conjunto_personas').val(sociedad.conjunto_personas);
            $('#conjunto_clientes').val(sociedad.conjunto_clientes);
            $('#conjunto_socios_extranjeros').val(sociedad.conjunto_socios_extranjeros);
            $('#activarSociedad').prop('checked', sociedad.activarsociedad === 'on');
            $('#declararSociedad').prop('checked', sociedad.declararsociedad === 'on');
            $('#declararSociedadTexto').text(sociedad.declararsociedad === 'on' ? 'Declarar Sociedad' : 'No Declarar Sociedad');
            $('#documentosSociedad').show();
            $('#reportesSociedad').show();

            // Destruir la tabla si ya existe
            if ($.fn.DataTable.isDataTable('#documentosAdjuntosxSociedad')) {
                $('#documentosAdjuntosxSociedad').DataTable().clear().destroy();
            }

            // Cargar los socios de la sociedad
            $('#personasContainer').empty();
            // $('#personasContainer').append('<label>Socios de la Sociedad</label>');
            var personaIndex = 0; // Reiniciar el índice de personas
            dataSociedad.forEach(function(persona, index) {
                if (persona.uuid === sociedad.uuid) {
                    personaIndex++;
                    var nuevoCampo = `
                        <div class="form-group row">
                            <div class="col-md-8">
                                <label>Socio # ${personaIndex}</label>
                                <select class="form-control selectPersona" id='selectPersona${personaIndex}' name="personas[]" >
                                    <option value="${persona.persona}" selected>${persona.nombre_obtenido}</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Porcentaje</label>
                                <input type="number" class="form-control porcentajeInput" name="porcentajes[]" value="${persona.porcentaje}" min="0" max="100" disabled>
                            </div>
                        </div>
                    `;
                    $('#personasContainer').append(nuevoCampo);
                }
            });
            

            // Cargar los documentos de la sociedad
            $('#documentosSociedadBody').empty();
            $.ajax({ 
                url: '../controller/sociedadController.php',
                type: 'GET',
                data: {
                    accion: 'getDocumentos',    
                    idSolicitud: sociedad.id_solicitud,
                    idSociedad: sociedad.uuid
                },
                dataType: 'json',
                success: function(data) {
                    let nuevoDocumento = '';
                    $.each(data, function(index, item) {
                        var numero_registro = item.numero_registro === null ? 'N/A' : item.numero_registro;
                        var fecha_entrega   = item.fecha_entrega === null ? 'N/A' : item.fecha_entrega;
                        nuevoDocumento += `
                            <tr>
                                <td>${item.create_at}</td>
                                <td>${item.nombre_archivo}</td>
                                <td><span class="badge badge-primary">${item.tipo}</span></td>
                                <td>${numero_registro}</td>
                                <td>${fecha_entrega}</td>
                                <td>   
                                    <a class="btn btn-primary" href="../controller/resource/${item.id_solicitud}/${item.nombre_archivo}" target="_blank" rel="noopener noreferrer"><i class="fa fa-download"></i></a>
                                </td>
                            </tr>
                        `;
                    }); 
                    $('#documentosSociedadBody').append(nuevoDocumento); 
                    $("#documentosAdjuntosxSociedad").DataTable({
                        "destroy": true,
                        "responsive": true, 
                        "lengthChange": true,
                        "autoWidth": false,
                        "buttons": ["excel", "pdf"]
                    }).buttons().container().appendTo('#tableDocumentosSociedadContainer_wrapper .col-md-6:eq(0)');
                },
                error: function(xhr, status, error) {
                    console.error('Error en la solicitud AJAX:', status, error);
                    console.log('Respuesta del servidor:', xhr.responseText);
                    alert('Error al cargar las opciones 2');
                }
            });

            // Cargar los reportes de la sociedad
            $('#reportesSociedadTablaBody').empty();
            $.ajax({
                url: '../controller/obtenerActasController.php',
                type: 'POST',
                data: { 
                    action: 'obtenerActas', 
                    id_solicitud: sociedad.id_solicitud,
                    idSociedad: sociedad.uuid
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status === "success") {
                        let filas = "";
                        response.data.forEach(function(item, index) {
                            filas += `<tr>
                                <td>${item.createat}</td>
                                <td>
                                    <button class="btn btn-info ver-htmlSociedad" data-html='${item.contenido_html.replace(/'/g, "&apos;")}' data-bs-toggle="modal" data-bs-target="#modalContenidoHTML">
                                        Ver HTML
                                    </button>
                                </td>
                                <td>
                                    <button class="btn btn-danger generar-pdfSociedad" data-id="${item.id_solicitud}">
                                        PDF
                                    </button>
                                </td>
                            </tr>`;
                        });
                        $("#reportesSociedadTabla tbody").html(filas);
                    } else {
                        if(response.message=='Acta no encontrada'){
                            let filas = "";
                            filas += `<tr>
                                <td colspan="3">No se encontraron actas</td>
                            </tr>`;
                            $("#reportesSociedadTabla tbody").html(filas);
                        }else{
                            alert("Error: " + response.message);
                        }
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error AJAX:", error);
                }
            });

        }); 
    });

    // Peticion ajax para cargar los usuarios que cargan datos a la sociedad
    function cargarUsuarios(){
        let url = 'http://178.16.142.82/cargar_eeuu/controller/usuario_controller.php';
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',  
            success: function(response) { 
                // console.log('Usuarios cargados:', response.usuarios);
                // Recorrer cada select individualmente
                $('.selectUsuarioCarga').each(function() {
                    let idUsuarioCargaEuu = $(this).data('id_usuario_carga_euu');
                    // console.log('Select encontrado:', $(this).data('id') , ' | ',$(this).data('id_usuario_carga_euu'));
                    let select = $(this);
                    select.empty(); // Limpiar opciones anteriores
                    select.append('<option value="">Seleccionar usuario</option>');
                    // Agregar las opciones
                    $.each(response.usuarios, function(index, usuario) {
                        select.append($('<option>', {
                            value: usuario.id,
                            text: usuario.usuario,
                            selected: usuario.id === idUsuarioCargaEuu // Marcar como seleccionado si coincide
                        }));
                    });
                });
            },
            error: function(xhr, status, error) {
                console.error('Error cargar los usuarios:', xhr.responseText);
            }
        });
    }

    $(document).on('change', '.selectUsuarioCarga', function () {
        let idSociedad = $(this).data('id');
        let idUsuario  = $(this).val();
        // console.log("Usuario seleccionado:", idUsuario, "para sociedad:", idSociedad);
        if (idUsuario === "") {  // Verificar si se ha seleccionado un usuario
            alert("Debe seleccionar un usuario válido.");
            return;
        }

        $.ajax({ 
            url: '../controller/sociedadController.php',
            type: 'POST',
            data: {
                accion: 'actualizarUsuarioCarga',
                id_sociedad: idSociedad, 
                id_usuario: idUsuario 
            },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') { 
                    alert('Usuario asignado correctamente.');
                } else {
                    alert('Error al asignar el usuario: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error al asignar el usuario:', xhr.responseText);
            }
        });

    });

</script>


<!-- <script>
        var dataCliente = [];
        $(document).ready(function() {
            $.ajax({
                url: '../controller/sociedadController.php',
                type: 'GET',
                data: { accion: 'getAllSociedadesRegistrarSocilitud' },
                dataType: 'json',
                success: function(response){ 
                    let tbody = $('#clientes_patrimonium');
                    tbody.empty();
                    $.each(response, function(index, cliente) {
                        dataCliente.push(cliente);
                    });
                    $("#clientesTable").DataTable({ 
                        "data": dataCliente, // Cargar los datos desde el array
                        "columns": [
                            { "data": "nombre" },
                        ],
                        "destroy": true,
                        "responsive": true,
                        "lengthChange": true,
                        "autoWidth": false,
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error al obtener los datos: ', xhr.responseText);
                }
            });
        });
    </script> -->


</html>