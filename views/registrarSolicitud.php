<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
    exit();
} elseif (isset($_SESSION['usuario']) && $_SESSION['configuracion'] === false) {
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
    <title>Registrar ESE</title>
    <style>
        .card-registroSolicitudCliente {
            width: 70vw;
            margin: auto;
        }

        .btn-acciones {
            display: flex;
            justify-content: space-evenly;
        }

        .btn-volver {
            border: 1px solid #0056b2;
            box-shadow: rgb(0, 80, 165) 2px 2px 2px 0px;
        }
    </style>
</head>

<body>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h3>Solicitudes</h3>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="card card-dark shadow-lg card-registroSolicitudCliente">
                    <div class="card-header">
                        <h3 class="card-title">Registrar Solicitud Cliente</h3>
                        <div class="card-tools">
                            <?php echo date('d/m/Y'); ?>
                            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                    <form action="" method="post" id="formulario-solicitud">
                                <div class="card card-info card-outline shadow-none p-0">
                                    <div class="card-header">
                                        <h3 class="card-title">Registro Solicitud</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <h5 class="card-title">Formulario de Cliente</h5>
                                            <!-- Formulario -->
                                            <form>
                                                <!-- Grupo de Nombre del Cliente -->
                                                <div class="form-group">
                                                    <label for="nombreCliente">Nombre del Cliente:</label>
                                                    <input type="text" name="nombreCliente" class="form-control" id="nombreCliente" placeholder="Ingresa el nombre del cliente">
                                                </div>

                                                <!-- Grupo de Referido de -->
                                                <div class="form-group">
                                                    <label for="referidoDe">Referido:</label>
                                                    <input type="text" name="referido_por" class="form-control" id="referidoDe" placeholder="¿Quién te refirió?">
                                                </div>

                                                <!-- Grupo de Necesidad -->
                                                <div class="form-group">
                                                    <label for="necesidad">Necesidad:</label>
                                                    <textarea class="form-control" name="necesidad" rows="3" placeholder="Describe la necesidad"></textarea>
                                                </div>

                                                <!-- Opciones de Servicios divididas en 3 columnas -->
                                                <div class="row">
                                                    <label>Servicios:</label>
                                                    <div class="col-md-4">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="tipoTrust" name="tipoTrust" value="Tipo Trust">
                                                            <label class="custom-control-label" for="tipoTrust">Tipo de Trust</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="registroCorporacion" name="registroCorporacion" value="Registro Corporacion">
                                                            <label class="custom-control-label" for="registroCorporacion">Registro de Corporación</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="registroFIP" name="registroFIP" value="Registro FIP">
                                                            <label class="custom-control-label" for="registroFIP">Registro de FIP</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="goodStanding" name="goodStanding" value="Good Standing">
                                                            <label class="custom-control-label" for="goodStanding">Good Standing</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="certificateIncumbency" name="certificateIncumbency" value="Certificate Incumbency">
                                                            <label class="custom-control-label" for="certificateIncumbency">Certificate of Incumbency</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="contratoArrendamiento" name="contratoArrendamiento" value="Contrato Arrendamiento">
                                                            <label class="custom-control-label" for="contratoArrendamiento">Contrato de Arrendamiento</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="registroCorporacionExterior" name="registroCorporacionExterior" value="Registro Corporacion Exterior">
                                                            <label class="custom-control-label" for="registroCorporacionExterior">Registro de Corporación Exterior</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="contratosComerciales" name="contratosComerciales" value="Contratos Comerciales">
                                                            <label class="custom-control-label" for="contratosComerciales">Contratos Comerciales</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="aperturaCuentaBancosCorporativa" name="aperturaCuentaBancosCorporativa" value="Apertura Cuenta Bancos Corporativa">
                                                            <label class="custom-control-label" for="aperturaCuentaBancosCorporativa">Apertura Cuenta Bancos Corporativa</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="aperturaBancosCuentaPersonal" name="aperturaBancosCuentaPersonal" value="Apertura Bancos CuentaPersonal">
                                                            <label class="custom-control-label" for="aperturaBancosCuentaPersonal">Apertura Bancos Cuenta Personal</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="serviciosContabilidad" name="serviciosContabilidad" value="Servicios Contabilidad">
                                                            <label class="custom-control-label" for="serviciosContabilidad">Servicios de Contabilidad</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="serviciosImpuestos" name="serviciosImpuestos" value="Servicios Impuestos">
                                                            <label class="custom-control-label" for="serviciosImpuestos">Servicios de Impuestos</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="servicioAgenteRegistrador" name="servicioAgenteRegistrador" value="Servicio Agente Registrador">
                                                            <label class="custom-control-label" for="servicioAgenteRegistrador">Servicio de Agente Registrador</label>
                                                        </div>
                 
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="acuerdoDeSocios" name="acuerdoDeSocios" value="Acuerdo De Socios">
                                                            <label class="custom-control-label" for="acuerdoDeSocios">Acuerdo de Socios</label>
                                                        </div>
                                                                                                                    <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="proteccionDivorcios" name="proteccionDivorcios"  value="Proteccion Divorcios">
                                                                <label class="custom-control-label" for="proteccionDivorcios">Proteccion para Divorcios</label>
                                                            </div>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="proteccionPatrimonio" name="proteccionPatrimonio"  value="Proteccion Patrimonio">
                                                                <label class="custom-control-label" for="proteccionPatrimonio">Proteccion de Patrimonio</label>
                                                            </div>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="actas" name="actas"  value="">
                                                                <label class="custom-control-label" for="actas">Actas</label>
                                                            </div>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="investigacionAntecedentes" name="investigacionAntecedentes"  value="Investigacion Antecedentes">
                                                                <label class="custom-control-label" for="investigacionAntecedentes">Investigacion de Antecedentes</label>
                                                            </div>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="compraVentaEmpresas" name="compraVentaEmpresas"  value="Compra Venta Empresas">
                                                                <label class="custom-control-label" for="compraVentaEmpresas">Compra Venta de Empresas</label>
                                                            </div>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="visasInversionistaUSA" name="visasInversionistaUSA"  value="Visas Inversionista USA">
                                                                <label class="custom-control-label" for="visasInversionistaUSA">Visas de Inversionista para USA</label>
                                                            </div>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="planesNegocios" name="planesNegocios"  value="Planes Negocios">
                                                                <label class="custom-control-label" for="planesNegocios">Planes de Negocios</label>
                                                            </div>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="internacionalizacionEmpresas" name="internacionalizacionEmpresas"  value="Internacionalizacion Empresas">
                                                                <label class="custom-control-label" for="internacionalizacionEmpresas">Internacionalizacion de Empresas</label>
                                                            </div>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="formasW8" name="formasW8"  value="Formas W8">
                                                                <label class="custom-control-label" for="formasW8">Formas W8</label>
                                                            </div>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="formasW8BEN" name="formasW8BEN"  value="Formas W8BEN">
                                                                <label class="custom-control-label" for="formasW8BEN">Formas W8BEN</label>
                                                            </div>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="formasW9" name="formasW9"  value="Formas W9">
                                                                <label class="custom-control-label" for="formasW9">Formas W9</label>
                                                            </div>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="formasFBAR" name="formasFBAR"  value="Formas FBAR">
                                                                <label class="custom-control-label" for="formasFBAR">Formas FBAR</label>
                                                            </div>
          
                                                        
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="formas1050R" name="formas1050R"  value="Formas 1050R">
                                                            <label class="custom-control-label" for="formas1050R">Formas 1050R</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="formas5471_2" name="formas5471_2"  value="Formas 5471_2">
                                                            <label class="custom-control-label" for="formas5471_2">Formas 5471/2</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="reporteB12" name="reporteB12"  value="Reporte B12">
                                                            <label class="custom-control-label" for="reporteB12">Reporte B12</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="reporteB13" name="reporteB13"  value="Reporte B13">
                                                            <label class="custom-control-label" for="reporteB13">Reporte B13</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="reporteFincen" name="reporteFincen"  value="Reporte Fincen">
                                                            <label class="custom-control-label" for="reporteFincen">Reporte Fincen</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="reporteBOI" name="reporteBOI"  value="Reporte BOI">
                                                            <label class="custom-control-label" for="reporteBOI">Reporte BOI</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="serviciosDomicilio" name="serviciosDomicilio"  value="Servicios Domicilio">
                                                            <label class="custom-control-label" for="serviciosDomicilio">Servicios de Domicilio</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="servicioTesoreria" name="servicioTesoreria"  value="Servicio Tesoreria">
                                                            <label class="custom-control-label" for="servicioTesoreria">Servicio de Tesoreria</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="servicioNomina" name="servicioNomina"  value="Servicio Nomina">
                                                            <label class="custom-control-label" for="servicioNomina">Servicio de Nomina</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="controlInventarios" name="controlInventarios"  value="Control Inventarios">
                                                            <label class="custom-control-label" for="controlInventarios">Control de Inventarios</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="serviciosFacturacion" name="serviciosFacturacion"  value="Servicios Facturacion">
                                                            <label class="custom-control-label" for="serviciosFacturacion">Servicios de Facturacion</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="serviciosAdministracionNegocios" name="serviciosAdministracionNegocios"  value="Servicios Administracion Negocios">
                                                            <label class="custom-control-label" for="serviciosAdministracionNegocios">Servicios Administracion Negocios</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="serviciosLegalesNotario" name="serviciosLegalesNotario"  value="Servicios Legales Notario">
                                                            <label class="custom-control-label" for="serviciosLegalesNotario">Servicios Legales de Notario</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="serviciosLegalesApostille" name="serviciosLegalesApostille"  value="Servicios Legales Apostille">
                                                            <label class="custom-control-label" for="serviciosLegalesApostille">Servicios Legales de Apostille</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="serviciosReportesEspeciales" name="serviciosReportesEspeciales"  value="Servicios Reportes Especiales">
                                                            <label class="custom-control-label" for="serviciosReportesEspeciales">Servicios Reportes Especiales</label>
                                                        </div>

                                                    </div>
                                                </div>
                                               
                                                <div class="row">
                                                        <div class="form-group" style="display: flex; justify-content: flex-end;">
                                                            <button type="button" id="agregarCampo" class="btn btn-info"><i class="fas fa-plus-square"></i></button>
                                                        </div>

                                                        <!-- Contenedor donde se agregarán los campos de texto -->
                                                        <div id="contenedorCampos"></div>
                                                </div>
                                                <div class="row">
                                                        <button type="submit" id="btnCrearSolicitud" class="btn btn-primary" style="margin-top:1.5%;">Guardar</button>
                                                </div>
                                                <!-- Botón de envío -->
                                                
                                            </form>
                                        </div>
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

document.getElementById('agregarCampo').addEventListener('click', function() {
    // Contador para asignar un índice único a cada campo
    var contador = document.querySelectorAll('[name^="campoDinamico["]').length;

    // Crear un nuevo elemento input de tipo texto
    var nuevoInput = document.createElement('input');
    nuevoInput.setAttribute('type', 'text');
    nuevoInput.setAttribute('placeholder', 'Introduce un nuevo servicio');
    // Modificar el name para incluir el índice actual del contador
    nuevoInput.setAttribute('name', 'campoDinamico[' + contador + ']'); 
    nuevoInput.setAttribute('class', 'form-control mt-2'); // Agregar margen y clases de Bootstrap

    // Añadir el nuevo input al contenedor
    document.getElementById('contenedorCampos').appendChild(nuevoInput);
});


$(document).ready(function(){
      $('#btnCrearSolicitud').click(function(){        
          var datos = $('#formulario-solicitud').serialize()+ "&accion=guardarSolicitud";
          console.log(datos);  
        $.ajax({
            type:"POST",
            url:"../controller/solicitudController.php",
            data:datos,
            success:function(r){
                console.log(r);
                if(r.resultado == 0){
                alert("fallo :(");
                }else{
                    alert("Agregado con éxito");
                     // Redirección a listar_empresa.php
                     window.location.href = 'listado_solicitudes.php';
                }
            }
          });
          return false;
        });
        
    });
</script>