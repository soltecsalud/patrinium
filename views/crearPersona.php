<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
    exit();
} elseif (isset($_SESSION['usuario']) && $_SESSION['solicitudes'] === false) {
    echo 'Acesso no autorizado.';
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
    <title>Registrar Caso</title>
</head>

<body>

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Nuevo Cliente</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="card card-dark shadow-lg">
                    <div class="card-header">
                        <h3 class="card-title">Crear Persona</h3>
                        <div class="card-tools">
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
                </div>
            </div>
        </section>
    </div>
    <?php include_once "footer/footer_views.php"; ?>
    <script src="../resource/AdminLTE-3.2.0/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="../resource/AdminLTE-3.2.0/plugins/jquery-validation/additional-methods.min.js"></script>

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
