<?php
// session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
    exit();
}
include_once "../controller/personaController.php";
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
    <!-- Agregando css de librería HandsonTable -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/handsontable/dist/handsontable.full.min.css">
    <style>
        #section_handsontable {
            margin: 0 auto;
            background-color: #f9f7f7;
            height: 250px;
            overflow-y: scroll;
        }
    </style>
    <title>Registrar Caso</title>
</head>

<body>

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Ingresar Nuevo Cliente</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="card card-dark shadow-lg">
                    <div class="card-header">
                        <h3 class="card-title">Ingresar Nuevo Cliente</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#modalCrearCliente"><i class="fas fa-user-plus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" id="frm_guardar_sociedad">
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
                                    <label for="observaciones">Necesidad, Observaciones y Notas</label>
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

                    <div class="modal fade" id="modalCrearCliente" tabindex="-1" role="dialog" aria-labelledby="modalCrearClienteLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content"> 
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalCrearClienteLabel">Crear Cliente</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <section id="section_handsontablex">
                                        <div id="content_handsontable"></div>
                                    </section>
                                    <br>
                                    <button id="enviarDatos" class="btn btn-info float-right pt-2">Enviar Datos a Registrar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
    <?php include_once "footer/footer_views.php"; ?>
    <script src="../resource/AdminLTE-3.2.0/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="../resource/AdminLTE-3.2.0/plugins/jquery-validation/additional-methods.min.js"></script>
    <!-- Agregando JS de librería HandsonTable -->
    <script src="https://cdn.jsdelivr.net/npm/handsontable/dist/handsontable.full.min.js"></script>
    <script src="js/cliente.js"></script>

    <!-- <script>
        function buscarPaciente(input,div){
            if(input.length > 3) {
                $.ajax({
                    url: '../controller/sociedadController.php',
                    method: 'GET',
                    data: {input: input, accion: 'buscarPersona'},
                    success: function(response) {
                        console.log('===');
                        
                        console.log(response.status);
                        console.log('===');
                        
                        if(response.status=='ok'){ 
                            div.css('display', 'block');
                        }else{
                            div.css('display', 'none');
                        }
                    }
                });
            }
        }

        $(document).ready(function(){
            $('#nombre').on('input', function() {
                this.value = this.value.charAt(0).toUpperCase() + this.value.slice(1);
                var input  = $(this).val();
                buscarPaciente(input,$('#divNombreEncontrado'));
            });
            $('#numeroPasaporte').on('input', function() {
                var input  = $(this).val();
                buscarPaciente(input,$('#divPasaporteEncontrado'));
            });
        });
    </script> -->

    <script>

        const dataBD = [
            {
                "nombre":"sass",
                "apellido":"apellido",
                "fechaNacimiento":"fechaNacimiento",
                "estadoCivil":"estadoCivil",
                "paisOrigen":"paisOrigen",
                "paisResidenciaFiscal":"paisResidenciaFiscal",
                "ciudad":"ciudad",
                "paisDomicilio":"paisDomicilio",
                "numeroPasaporte":"numeroPasaporte",
                "paisPasaporte":"paisPasaporte",
                "tipoVisa":"tipoVisa",
                "direccionLocal":"direccionLocal",
                "telefonos":"telefonos",
                "emails":"emails",
                "industria":"industria",
                "nombreNegocioLocal":"nombreNegocioLocal",
                "ubicacionNegocioPrincipal":"ubicacionNegocioPrincipal",
                "tamanoNegocio":"tamanoNegocio",
                "contactoEjecutivoLocal":"contactoEjecutivoLocal",
                "numeroEmpleados":"numeroEmpleados",
                "numeroHijos":"numeroHijos",
                "razonConsultoria":"razonConsultoria",
                "requiereRegistroCorporacion":"requiereRegistroCorporacion", 
                "observaciones":"observaciones"
            }
        ];

        const container = document.querySelector('#content_handsontable');
        const columnasHeaders = ['Nombre','Apellido','Fecha de Nacimiento','Estado Civil','País de Origen','País de Residencia Fiscal','Ciudad','País de Domicilio','Número de Pasaporte','País de Pasaporte','Tipo de Visa','Dirección Local','Teléfonos','Emails','Industria o Sector en el que Opera','Nombre Principal del Negocio Local','Ubicación del Negocio Principal','Tamaño del Negocio','Contacto de su Ejecutivo Local','No Empleados','Número de Hijos','Razón de la Consultoría','Requiere Registro de Corporación','Observaciones y Notas'];
        const hot = new Handsontable(container, {
            data: dataBD,
            colHeaders: columnasHeaders,
            columns: [
                {type: 'text', validator: notEmptyValidator}, // Nombre
                {type: 'text', validator: notEmptyValidator}, // Apellido
                {type: 'date', dateFormat: 'YYYY-MM-DD', strict: true}, // Fecha de Nacimiento
                {type: 'dropdown', source: ['soltero', 'casado', 'viudo'], strict: true}, // Estado Civil
                {type: 'text', validator: notEmptyValidator}, // País de Origen
                {type: 'text', validator: notEmptyValidator}, // País de Residencia Fiscal
                {type: 'text', validator: notEmptyValidator}, // Ciudad
                {type: 'text', validator: notEmptyValidator}, // País de Domicilio
                {type: 'text', validator: notEmptyValidator}, // Número de Pasaporte
                {type: 'text', validator: notEmptyValidator}, // País de Pasaporte
                {type: 'text', validator: notEmptyValidator}, // Tipo de Visa
                {type: 'text', validator: notEmptyValidator}, // Dirección Local
                {type: 'text', validator: notEmptyValidator}, // Teléfonos
                {type: 'text', validator: notEmptyValidator}, // Emails
                {type: 'text', validator: notEmptyValidator}, // Industria o Sector en el que Opera
                {type: 'text', validator: notEmptyValidator}, // Nombre Principal del Negocio Local
                {type: 'text', validator: notEmptyValidator}, // Ubicación del Negocio Principal
                {type: 'text', validator: notEmptyValidator}, // Tamaño del Negocio
                {type: 'text', validator: notEmptyValidator}, // Contacto de su Ejecutivo Local
                {type: 'numeric', validator: numericValidator}, // No Empleados
                {type: 'numeric', validator: numericValidator}, // Número de Hijos  
                {type: 'text', validator: notEmptyValidator}, // Razón de la Consultoría
                {type: 'dropdown', source: ['si', 'no'], strict: true}, // Requiere Registro de Corporación
                {type: 'text', validator: notEmptyValidator}, // Observaciones y Notas
            ],
            rowHeaders: true,
            stretchH: 'all',
            height: 200,
            licenseKey: 'non-commercial-and-evaluation',
            contextMenu: true,
            readOnly: false,
            validateCells: true
        });

        function notEmptyValidator(value, callback) {
            if (value === null || value === undefined || value.toString().trim() === '') {
                callback(false);
            } else {
                callback(true);
            }
        }

        function numericValidator(value, callback) {
            const isValid = value !== null && value !== undefined && value.toString().trim() !== '' && !isNaN(value);
            callback(isValid);
        }


        // Función para validar todas las celdas
        function validarTodasLasCeldas(callbackFinal) {
            hot.validateCells(function (valid) {
                callbackFinal(valid); // Se pasa true o false dependiendo de la validación
            });
        }

        // Manejo del evento click en el botón de enviar
        document.getElementById('enviarDatos').addEventListener('click', function () {
            // Deshabilitar el botón para evitar múltiples envíos
            document.getElementById('enviarDatos').disabled = true; 
            // Validar todas las celdas antes de enviar los datos
            validarTodasLasCeldas(function(valid) {
                if (!valid) { 
                    // Si alguna celda tiene error
                    alert('Hay errores en el formulario. Por favor corrija las celdas marcadas en rojo.');
                    // Habilitar el botón nuevamente
                    document.getElementById('enviarDatos').disabled = false; 
                } else {
                    // Si todas las celdas son válidas, enviar los datos
                    const datos = hot.getData(); // Obtener los datos de Handsontable
                    // Enviar los datos a través de AJAX
                    enviarDatos(datos);
                    // Deshabilitar el botón después de enviar
                    
                    // Mostrar mensaje de éxito
                    alert('Datos enviados con éxito.');
                    // Limpiar el formulario
                    hot.loadData(dataBD); // Limpiar los datos de Handsontable


                    // alert(datos);
                    
                    // Habilitar el botón nuevamente después de un tiempo
                    setTimeout(function() {
                        document.getElementById('enviarDatos').disabled = false;
                    }, 5000); // Habilitar después de 5 segundos
                }
            });

        });

        // Función para enviar datos por AJAX
        function enviarDatos(datos) {
            // alert('hola 1');
            // Crear un objeto con los datos de Handsontable y el valor del input
            const datosCombinados = {
                tabla: datos,
                // input: valorInput,
                // date:  fechaCenso
            };

            // Convertir los datos a formato JSON
            const datosJSON = JSON.stringify(datosCombinados);

            // Realizar la llamada AJAX para enviar los datos
            $.ajax({
                url: '../controller/enviarHotCrearCliente.php', // Cambia esto por el archivo donde procesarás los datos
                method: 'POST',
                data: { datos: datosJSON }, // Enviar los datos como JSON
                success: function(response) {

                    if(response.resultados && Array.isArray(response.resultados)) {
                        let mensajeFinal  = "Resultados del registro:\n\n";
                        let filasFallidas = [];
                        response.resultados.forEach(res => {
                            mensajeFinal += `${res.status === 'success' ? '✔️' : '❌'} Fila ${res.index}: ${res.message}\n`;
                            if (res.status === 'error') {
                                filasFallidas.push(res.index - 1);
                            }
                        });
                        alert(mensajeFinal);

                        // Filtrar solo las filas con error
                        // const dataOriginal = hot.getData();
                        const nuevasFilas = filasFallidas.map(i => datos[i]);
                        // Cargar solo las filas con error en la tabla
                        hot.loadData(nuevasFilas); 


                    }else{
                        alert("Error inesperado");
                    }

                    const todoBien = response.resultados.every(r => r.status === 'success');
                    if (todoBien) {
                        // hot.loadData(dataBD);
                        alert("Todos los datos guardados");
                        window.location.href = "gestionar_clientes.php";
                    }


                    // alert(response.message);
                    // setTimeout(function() {
                    //     // location.reload();
                    //     window.location.href = "gestionar_clientes.php";
                    // }, 1000); 

                },
                error: function(xhr, status, error) {
                    // Manejo de errores en la solicitud AJAX
                    console.error('Error al enviar los datos:', error);
                }
            });

        }

    </script>

</body>

</html>


<script>
$(document).ready(function(){
    $('#btnGuardarSociedad').click(function(e){        
        e.preventDefault(); // Previene el comportamiento por defecto del botón
        var datos = $('#frm_guardar_sociedad').serialize() + "&accion=guardarSociedad";
        console.log(datos);  // Verifica que los datos se están serializando correctamente
        $.ajax({
            type: "POST",
            url: "../controller/sociedadController.php",
            data: datos,
            success: function(r){
                console.log(r);  // Verifica la respuesta del servidor
                if (r.resultado == 0) {
                    alert("fallo :(");
                } else {
                    alert("Persona Agregada con Exito :)");
                    window.location.href = "registrarSolicitud.php";
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
