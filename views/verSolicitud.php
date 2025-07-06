<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
    exit();
}
include_once "../controller/solicitudController.php";

$uuid_extensiones = '0d51f6e1-08ad-4716-b5a6-865e99aa9725';
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="css/barraFiltros.css">
    <script src="../resource/vendor/tinymce/tinymce/tinymce.min.js"></script>
    <title>Datos Solicitud # <?php echo $_GET['numero_solicitud']; ?></title>
    <style>
        .text-na {
            color: red;
            font-weight: bold;
        }

        .card-registroSolicitudCliente {
            width: 85vw;
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


        .card-serazo {
            width: 200px;
            height: 180px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            font-family: Arial, sans-serif;
        }

        .card-number-serazo {
            font-size: 80px;
            color: #0066cc;
            /* Color morado */
            font-weight: bold;
        }

        .card-text-serazo {
            font-size: 20px;
            color: #0221fe;
            /* Color negro */
            margin-top: 5px;
        }

        .info-card {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            font-family: Arial, sans-serif;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #e0e0e0;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-title {
            font-weight: bold;
            color: #333333;
            flex-basis: 40%;
        }

        .info-value {
            color: #555555;
            flex-basis: 60%;
            text-align: right;
        }

        #modal_nuevo_servicos {
            max-width: 90%;
            width: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-family: Arial, sans-serif;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            font-weight: bold;
            color: #333;
            background-color: #f9f9f9;
        }

        td {
            font-size: 14px;
            color: #333;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .table-title {
            font-weight: bold;
            color: #333;
        }

        .checkbox-container {
            display: flex;
            align-items: center;
            cursor: pointer;
            font-size: 18px;
        }

        .checkbox-container input {
            display: none;
        }

        .checkmark {
            width: 24px;
            height: 24px;
            background-color: #fff;
            border: 2px solid #007bff;
            border-radius: 5px;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: all 0.3s ease;
            margin-right: 10px;
        }

        .checkbox-container input:checked+.checkmark {
            background-color: #007bff;
            border-color: #0056b3;
        }

        .checkmark::after {
            content: "";
            width: 10px;
            height: 10px;
            border: solid white;
            border-width: 0 3px 3px 0;
            transform: rotate(45deg);
            display: none;
        }

        .checkbox-container input:checked+.checkmark::after {
            display: block;
        }

        .fondo-verde {
            background-color: #d4edda !important;
        }

        .fondo-rojo {
            background-color: #f8d7da !important;
        }

        .btn-verde,
        .btn-amarillo {
            width: 160px;
            /* Ancho uniforme */
            height: 40px;
            /* Alto consistente */
            font-size: 14px;
            /* Tamaño de texto más legible */
            font-weight: bold;
            /* Texto más visible */
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            /* Espacio entre ícono y texto */
            border-radius: 10px;
            /* Bordes redondeados */
        }

        .btn-verde {
            background-color: #28a745 !important;
            color: white !important;
            border: none;
        }

        .btn-amarillo {
            background-color: #ffc107 !important;
            color: black !important;
            border: none;
        }
    </style>
</head>

<body>
    <div class="content-wrapper">
        <div id="filtros-bar">
            <button type="button" id="btn_crear_factura" class="btn btn-xs barra btn-verde" data-toggle="modal" data-target="#billingModal">
                <i class="fas fa-file-invoice"></i> Crear Factura
            </button>

            <button type="button" class="btn btn-xs barra btn-amarillo" data-toggle="modal" data-target="#upload_archivos">
                <i class="fas fa-upload"></i> Cargar Archivo
            </button>

        </div>
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h3>Informacion General Cliente</h3>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="card card-dark shadow-lg card-registroSolicitudCliente">
                    <div class="card-header">
                        <h3 class="card-title">Informacion General</h3>
                        <div class="d-flex justify-content-center w-100">
                            <button type="button" class="btn btn-primary mr-2 crearSociedad" data-toggle="modal" data-target="#modalCrearSociedad">
                                Crear Sociedad
                            </button>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" id="btnModalSolicitud" data-bs-target="#modalSolicitud">
                                Nuevos Servicios A Facturar
                            </button>

                        </div>
                        <div class="card-tools">
                            <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-bars"></i> Opciones
                            </button>

                            <!-- Menú desplegable -->
                            <div class="dropdown-menu dropdown-menu-right bg-primary text-white" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item text-white" href="#" data-toggle="modal" data-target="#modalCrearCliente">
                                    <i class="fas fa-user-plus"></i> Crear Socio
                                </a>
                                <a class="dropdown-item text-white" href="#" data-toggle="modal" data-target="#upload_archivos">
                                    <i class="fas fa-upload"></i> Cargar Archivos<br>Info. Cliente
                                </a>
                                <a class="dropdown-item text-white" href="#" data-toggle="modal" data-target="#billingModal">
                                    <i class="fas fa-file-invoice"></i> Crear Factura
                                </a>

                                <a class="dropdown-item text-white" href="#" data-toggle="modal" data-target="#egresoModal">
                                    <i class="fas fa-handshake"></i> Contratar Terceros
                                </a>
                                <a class="dropdown-item text-white" href="#" data-card-widget="maximize">
                                    <i class="fas fa-expand"></i> Maximizar
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="modalCrearCliente" tabindex="-1" role="dialog" aria-labelledby="modalCrearClienteLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalCrearClienteLabel">Crear Socio</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="POST" id="frm_guardar_sociedad">
                                        <input type="hidden" name="numeroSolicitud" name="numeroSolicitud" value="<?php echo $_GET['numero_solicitud']; ?>">
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
                                                <button name="submit" id="btnGuardarPersonaCliente" class="btn btn-primary">Guardar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="row mb-3">

                            <div class="col-md-12">

                                <div class="card-serazo">
                                    <div class="card-number-serazo"><?php

                                                                    if (isset($_GET['numero_solicitud'])) {
                                                                        $id_revisar_solicitud = $_GET['numero_solicitud'];
                                                                    }

                                                                    $controlador = new Solicitud_controller();
                                                                    $solicitudes = $controlador->getSolicitud($id_revisar_solicitud);

                                                                    if (is_array($solicitudes) && count($solicitudes) > 0) {
                                                                        foreach ($solicitudes as $solicitud) {
                                                                            if (is_object($solicitud)) {
                                                                                //  echo "hola";
                                                                            } else {
                                                                                // echo "<p>No se encontraron solicitudes.</p>";
                                                                            }
                                                                        }
                                                                    } else {
                                                                        // echo "<p>No se encontraron solicitudes.</p>";
                                                                    }

                                                                    echo $id_revisar_solicitud ?></div>
                                    <div class="card-text-serazo">Numero Cliente</div>
                                </div>

                            </div>
                        </div>
                        <div class="card card-info card-outline shadow-none p-0">
                            <div class="card-header">
                                <h3 class="card-title">Sociedades</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row"> <!-- Agregamos una fila que envolverá las columnas -->
                                    <?php
                                    $controlador = new Solicitud_controller();
                                    // $solicitudes    = $controlador->getSociedades($id_revisar_solicitud);
                                    $solicitudes    = $controlador->getSociedadesxJSONB($id_revisar_solicitud);
                                    $sociedades = [];
                                    // Se agrupa los datos por nombre_sociedad.
                                    foreach ($solicitudes as $item) {
                                        $nombre = $item["nombre_sociedad"];
                                        if (!isset($sociedades[$nombre])) {
                                            $sociedades[$nombre] = [];
                                        }
                                        $sociedades[$nombre][] = $item;
                                        // print_r($item);
                                        // Decodificar JSONB que viene en datos_sociedad
                                        // $datos_sociedad = json_decode($item["datos_sociedad"], true);

                                        // Verificar que $datos_sociedad es un array antes de continuar
                                        // if (is_array($datos_sociedad)) {
                                        //     $numPersonas = isset($datos_sociedad["personas"]) ? count($datos_sociedad["personas"]) : 0;
                                        //     $numConjuntoclientes = isset($datos_sociedad["conjuntoclientes"]) && $datos_sociedad["conjuntoclientes"] !== "{}" ? count(explode(",", trim($datos_sociedad["conjuntoclientes"], "{}"))) : 0;
                                        //     $numSociedades = isset($datos_sociedad["sociedades"]) && $datos_sociedad["sociedades"] !== "{}" ? count(explode(",", trim($datos_sociedad["sociedades"], "{}"))) : 0;

                                        //     // Primera condición: Solo una persona
                                        //     if ($numPersonas === 1 && $numConjuntoclientes === 0 && $numSociedades === 0) {
                                        //         echo "Número de persona: " . $datos_sociedad["personas"][0] . "<br>";
                                        //         echo "Porcentaje: " . $datos_sociedad["porcentajes"][0] . "%<br>";
                                        //         echo "Nombre de la sociedad: " . $datos_sociedad["nombreSociedad"] . "<br><br>";
                                        //     } 
                                        //     // Segunda condición: Más de una persona
                                        //     else if ($numPersonas > 1 && $numConjuntoclientes === 0 && $numSociedades === 0) {
                                        //         echo "Número de personas: " . implode(", ", $datos_sociedad["personas"]) . "<br>";
                                        //         echo "Porcentajes: " . implode(", ", $datos_sociedad["porcentajes"]) . "%<br>";
                                        //         echo "Nombre de la sociedad: " . $datos_sociedad["nombreSociedad"] . "<br><br>";
                                        //     }
                                        //     // Tercera condición: 0 personas, pero conjuntoclientes y sociedades tienen valores
                                        //     else if ($numPersonas > 0 && $numConjuntoclientes > 0 && $numSociedades > 0) {
                                        //         echo "No hay personas en esta sociedad.<br>";
                                        //         echo "Número de conjuntoclientes: " . $numConjuntoclientes . "<br>";
                                        //         echo "Número de sociedades: " . $numSociedades . "<br>";
                                        //         echo "Nombre de la sociedad: " . $datos_sociedad["nombreSociedad"] . "<br><br>";
                                        //     }
                                        // }
                                    }
                                    foreach ($sociedades as $nombre_sociedad => $detalles) { ?>
                                        <div class="col-md-4">
                                            <div class="info-box">
                                                <span class="info-box-icon bg-info"><i class="far fa-bookmark"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-number"><?php echo $nombre_sociedad; ?></span>
                                                    <span class="info-box-text">
                                                        <?php
                                                        $personas = [];
                                                        $infoSociedades = [];
                                                        foreach ($detalles as $detalle) {
                                                            //Se concatena los nombres y porcentajes de las personas asociadas a cada sociedad sin repetir el nombre de la sociedad.
                                                            $personas[]       = "{$detalle['nombre_obtenido']} {$detalle['porcentaje']}%";
                                                            $idSociedad       = $detalle['uuid'];
                                                            $idtipoSociedad   = $detalle['selecttiposociedad'];
                                                            $tipoSociedad     = $detalle['tiposociedad'];
                                                            $nombre_archivo   = $detalle['nombre_archivo'];
                                                            $activarSociedad  = $detalle['activarsociedad'];
                                                            $declararSociedad = $detalle['declararsociedad'];
                                                            $tipocorporacion  = $detalle['tipocorporacion'];
                                                            $estadopais       = $detalle['estadopais'];
                                                            //Se crea un array con la información de las personas asociadas a cada sociedad.
                                                            $infoSociedades[] = [
                                                                'nombre'         => $detalle['nombre_obtenido'],
                                                                'id'             => $detalle['persona'], // ID único de la persona
                                                                'porcentaje'     => $detalle['porcentaje'],
                                                                'tipo'           => $detalle['tipo'],
                                                                'uuid'           => $detalle['uuid'],
                                                                'idtiposociedad' => $detalle['selecttiposociedad'],
                                                                'tiposociedad'   => $detalle['tiposociedad']
                                                            ];
                                                        }
                                                        echo implode(" <br> ", $personas);
                                                        ?>
                                                    </span>
                                                    <input type="hidden" id='inputIdSociedad_<?php echo $idSociedad; ?>' value='<?php echo $idSociedad; ?>'>
                                                    <!-- Botón para abrir el modal -->
                                                    <button
                                                        data-id="<?php echo $idSociedad; ?>"
                                                        data-nombre="<?php echo $nombre_sociedad; ?>"
                                                        data-idtiposociedad="<?php echo $idtipoSociedad; ?>"
                                                        data-tiposociedad="<?php echo $tipoSociedad; ?>"
                                                        data-activarsociedad="<?php echo $activarSociedad; ?>"
                                                        data-declararsociedad="<?php echo $declararSociedad; ?>"
                                                        data-tipocorporacion="<?php echo $tipocorporacion; ?>"
                                                        data-estadopais='<?php echo $estadopais; ?>'
                                                        data-personas='<?php echo htmlspecialchars(json_encode($infoSociedades, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT), ENT_QUOTES, 'UTF-8'); ?>'
                                                        class="btn btn-primary btn-sm mt-2 btnVerDetalles">
                                                        Ver Detalles
                                                    </button>
                                                    <?php if ($nombre_archivo != '') { ?>
                                                        <a class="btn" style="background-color: #28a745; color: white; border-color: #28a745;" href="../controller/resource/<?php echo $id_revisar_solicitud . '/' . $nombre_archivo; ?>" target="_blank" rel="noopener noreferrer">EIN</a>

                                                    <?php } ?>
                                                </div>
                                                <a href="#" class="small-box-footer" data-toggle="modal" data-target="#detalleModal" data-uuid="<?php echo $idSociedad; ?>">
                                                    <i class="fas fa-arrow-circle-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div> <!--Fin Tabal Persona-->








                        <div class="card-body">

                            <div class="card card-info card-outline shadow-none p-0">
                                <div class="card-header">
                                    <h3 class="card-title">Datos Persona</h3>
                                </div>
                                <div class="card-body">
                                    <table id="tabla_datos_persona" class="table">
                                        <?php
                                        $sociedad_controller = new Solicitud_controller();
                                        $fk_cliente          = $solicitud->fk_cliente;
                                        $fila                = $sociedad_controller->getSociedad($fk_cliente, '0');
                                        if (empty($fila)) {
                                            $fila            = $sociedad_controller->getSociedad($fk_cliente, '1');
                                        }
                                        ?>
                                        <tbody>
                                            <tr>
                                                <th scope="col" class="table-title">ID Persona</th>
                                                <td><?php echo $fila[0]['id_sociedad']; ?></td>
                                                <th scope="col" class="table-title">Nombre</th>
                                                <td><?php echo $fila[0]['nombre']; ?></td>
                                                <th scope="col" class="table-title">Apellido</th>
                                                <td><?php echo $fila[0]['apellido']; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="col" class="table-title">Fecha de Nacimiento</th>
                                                <td><?php echo $fila[0]['fecha_nacimiento']; ?></td>
                                                <th scope="col" class="table-title">Estado Civil</th>
                                                <td><?php echo $fila[0]['estado_civil']; ?></td>
                                                <th scope="col" class="table-title">País de Origen</th>
                                                <td><?php echo $fila[0]['pais_origen']; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="col" class="table-title">País de Residencia Fiscal</th>
                                                <td><?php echo $fila[0]['pais_residencia_fiscal']; ?></td>
                                                <th scope="col" class="table-title">País de Domicilio</th>
                                                <td><?php echo $fila[0]['pais_domicilio']; ?></td>
                                                <th scope="col" class="table-title">Número de Pasaporte</th>
                                                <td><?php echo $fila[0]['numero_pasaporte']; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="col" class="table-title">País de Pasaporte</th>
                                                <td><?php echo $fila[0]['pais_pasaporte']; ?></td>
                                                <th scope="col" class="table-title">Tipo de Visa</th>
                                                <td><?php echo $fila[0]['tipo_visa']; ?></td>
                                                <th scope="col" class="table-title">Dirección Local</th>
                                                <td><?php echo $fila[0]['direccion_local']; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="col" class="table-title">Teléfonos</th>
                                                <td><?php echo $fila[0]['telefonos']; ?></td>
                                                <th scope="col" class="table-title">Emails</th>
                                                <td><?php echo $fila[0]['emails']; ?></td>
                                                <th scope="col" class="table-title">Industria</th>
                                                <td><?php echo $fila[0]['industria']; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="col" class="table-title">Nombre del Negocio Local</th>
                                                <td><?php echo $fila[0]['nombre_negocio_local']; ?></td>
                                                <th scope="col" class="table-title">Ubicación del Negocio Principal</th>
                                                <td><?php echo $fila[0]['ubicacion_negocio_principal']; ?></td>
                                                <th scope="col" class="table-title">Tamaño del Negocio</th>
                                                <td><?php echo $fila[0]['tamano_negocio']; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="col" class="table-title">Contacto Ejecutivo Local</th>
                                                <td><?php echo $fila[0]['contacto_ejecutivo_local']; ?></td>
                                                <th scope="col" class="table-title">Número de Empleados</th>
                                                <td><?php echo $fila[0]['numero_empleados']; ?></td>
                                                <th scope="col" class="table-title">Número de Hijos</th>
                                                <td><?php echo $fila[0]['numero_hijos']; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="col" class="table-title">Razón de Consultoría</th>
                                                <td><?php echo $fila[0]['razon_consultoria']; ?></td>
                                                <th scope="col" class="table-title">Requiere Registro de Corporación</th>
                                                <td><?php echo $fila[0]['requiere_registro_corporacion']; ?></td>
                                                <th scope="col" class="table-title">Observaciones</th>
                                                <td colspan="3"><?php echo $fila[0]['observaciones']; ?></td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!--Fin Tabal Persona-->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card card-info card-outline shadow-none p-0">
                                        <div class="card-header">
                                            <h3 class="card-title">Servicios Solicitados</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#serviciosModal">
                                                    Orden Servicio
                                                </button>
                                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#serviciosModalFactura">
                                                    Servicios a Facturar
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div id="tableServiciosSolicitados_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                                <table id='tableServiciosSolicitados' class="table table-bordered table-striped dataTable">
                                                    <thead>
                                                        <tr>
                                                            <th>Servicio</th>
                                                            <th>Estado</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $solicitud_servicios_json   = $controlador->getServicios($id_revisar_solicitud);
                                                        $verificarServicioEnFactura = $controlador->verificarServicioEnFactura($id_revisar_solicitud);

                                                        // Decodificar el JSON a un array asociativo
                                                        $solicitud_servicios = json_decode($solicitud_servicios_json, true);
                                                        $factura_servicios   = json_decode($verificarServicioEnFactura, true);

                                                        // Extraer los nombres de servicios facturados en un array plano
                                                        $servicios_facturados = array_map(function ($item) {
                                                            return trim($item['descripcion']); // Eliminamos espacios en blanco
                                                        }, $factura_servicios);

                                                        // print_r($servicios_facturados);
                                                        // Recorrer el array de servicios
                                                        $nombre_servicio = [];
                                                        foreach ($solicitud_servicios as $servicio) {
                                                            $nombre_servicio = json_decode($servicio['servicios'], true); // Decodificar el campo 'servicios'
                                                            // Asignar estado
                                                            // Generar filas de la tabla
                                                            foreach ($nombre_servicio as $clave => $valor) {
                                                                // Verificar si el servicio está en la factura
                                                                // $en_factura = in_array($valor['value'], $servicios_factura);
                                                                $servicio_value = trim($valor['value']);
                                                                $en_factura     = in_array($servicio_value, $servicios_facturados);
                                                        ?>

                                                                <tr>
                                                                    <td>
                                                                        <?php echo $valor['value']; ?></td>
                                                                    <td>
                                                                        <?php
                                                                        $estado = $valor['estado'];

                                                                        $estado_texto = "";
                                                                        if ($estado == 2) {
                                                                            $estado_texto = '<span class="badge badge-info">Orden Servicio</span>';
                                                                        } else if ($estado == 1) {
                                                                            $estado_texto = '<span class="badge badge-success">Pagada</span>';
                                                                        } else if ($estado == 0) {
                                                                            $estado_texto = '<span class="badge badge-primary">Para Facturar</span>';
                                                                        } else if ($estado == 3) {
                                                                            $estado_texto = '<span class="badge badge-warning">Insertada</span>';
                                                                        }
                                                                        if ($en_factura) {
                                                                            echo '<span class="badge badge-dark">En Factura</span>';
                                                                            // Aquí puedes realizar la acción que necesites
                                                                        } else {
                                                                            echo $estado_texto;
                                                                        }
                                                                        // echo $estado_texto;
                                                                        ?>

                                                                    </td>
                                                                </tr>

                                                        <?php
                                                            }
                                                        }
                                                        $jsonNombre_servicio = json_encode($nombre_servicio);
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card card-info card-outline shadow-none p-0">
                                        <div class="card-header">
                                            <h3 class="card-title">Servicios Adicionales</h3>
                                        </div>
                                        <div class="card-body">
                                            <table>
                                                <tr>
                                                    <th>Servicio</th>
                                                    <th>Estado</th>
                                                </tr>

                                                <?php
                                                $solicitud_servicios_json   = $controlador->getServicios($id_revisar_solicitud);
                                                $verificarServicioEnFactura = $controlador->verificarServicioEnFactura($id_revisar_solicitud);

                                                // Decodificar el JSON a un array asociativo 
                                                $solicitud_servicios = json_decode($solicitud_servicios_json, true);
                                                $factura_servicios   = json_decode($verificarServicioEnFactura, true);

                                                // Extraer los nombres de servicios facturados en un array plano
                                                $servicios_facturados = array_map(function ($item) {
                                                    return trim($item['descripcion']); // Eliminamos espacios en blanco
                                                }, $factura_servicios);

                                                // Recorrer el array de servicios
                                                foreach ($solicitud_servicios as $servicio) {
                                                    $nombre_servicioAdicionales = json_decode($servicio['servicios_adicionales'], true); // Decodificar el campo 'servicios'
                                                    // Generar filas de la tabla
                                                    foreach ($nombre_servicioAdicionales as $clave => $valor) {
                                                        $estado         = $valor['estado'];
                                                        $servicio_value = trim($valor['value']);
                                                        $en_factura     = in_array($servicio_value, $servicios_facturados);


                                                ?>
                                                        <tr>
                                                            <td>
                                                                <?php echo $valor['value']; ?></td>
                                                            <td>
                                                                <?php

                                                                $estado_texto = "";
                                                                if ($estado == 2) {
                                                                    $estado_texto = '<span class="badge badge-info">Orden Servicio</span>';
                                                                } else if ($estado == 1) {
                                                                    $estado_texto = '<span class="badge badge-success">Pagada</span>';
                                                                } else if ($estado == 0) {
                                                                    $estado_texto = '<span class="badge badge-primary">Para Facturar</span>';
                                                                } else if ($estado == 3) {
                                                                    $estado_texto = '<span class="badge badge-warning">Insertada</span>';
                                                                }
                                                                if ($en_factura) {
                                                                    echo '<span class="badge badge-dark">En Factura</span>';
                                                                } else {
                                                                    echo $estado_texto;
                                                                }
                                                                ?>

                                                            </td>
                                                        </tr>
                                                <?php
                                                    }
                                                }

                                                ?>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card card-info card-outline shadow-none p-0">
                                <div class="card-header">
                                    <h3 class="card-title">Consulta Facturas Creadas</h3>
                                </div>
                                <div class="card-body">
                                    <div id="tableFacturas_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                        <div id="idSolicitud" style="display:none;"><?php echo $id_revisar_solicitud; ?></div>
                                        <table id="tableFacturas" class="table table-bordered table-striped dataTable">
                                            <thead>
                                                <tr>
                                                    <th>Fecha Creacion</th>
                                                    <th>Descargar Factura</th>
                                                    <th>Descargar Comprobante Pago</th>
                                                    <th>Pago Con:</th>
                                                    <th>Nota</th>
                                                    <th>ID</th>
                                                    <th>N&uacute;mero de factura</th>
                                                    <th>Valor</th>
                                                    <th>Banco</th>
                                                </tr>
                                            </thead>
                                            <tbody id="facturasDownload">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>


                            <div class="card card-info card-outline shadow-none p-0">
                                <div class="card-header">
                                    <h3 class="card-title pt-1">Kit Entrega de Servicios A Clientes</h3>
                                    &nbsp;
                                    <button
                                        class="btn btn-primary btn-sm btnVerActas">
                                        Clic Para Ver Archivos & Actas
                                    </button>
                                </div>
                                <div class="card-body">
                                    <!-- <table id="actas" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Fecha</th>
                                                <th>Accion</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table> -->
                                    <table id="tablaPlantillas" class="table table-bordered mt-3">
                                        <thead>
                                            <tr>
                                                <th>Fecha Creaci&oacute;n</th>
                                                <th>Ver Contenido Acta</th>
                                                <th>Nombre Sociedad</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="modal fade" id="modalContenidoHTML" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalLabel">Contenido del Acta</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div id="contenidoHTML">
                                                <textarea name="editorContent" id="editor"></textarea>
                                            </div>
                                            <form id="formGuardarHtml">

                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            <input type="hidden" id="id_plantilla" name="id_plantilla" value="">
                                            <button type="button" class="btn btn-primary" id="guardarhtml">Guardar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="card card-info card-outline shadow-none p-0">
                                <div class="card-header">
                                    <h3 class="card-title">Consulta De Archivos & Documentos Del Cliente</h3>
                                </div>
                                <div class="card-body">
                                    <table id="documentosAdjuntos" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Fecha upload</th>
                                                <th>Nombre archivo</th>
                                                <th>Sociedad</th>
                                                <th>Tipo Documento</th>
                                                <th>N&uacute;mero de registro</th>
                                                <th>Fecha Registro</th>
                                                <th>Download Document</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $solicitudes = $controlador->getListadoAdjuntos($id_revisar_solicitud);
                                            if (!empty($solicitudes)) {
                                                foreach ($solicitudes as $adjuntos) {
                                            ?>
                                                    <tr>
                                                        <td><?php echo $adjuntos->create_at; ?></td>
                                                        <td><?php echo $adjuntos->nombre_archivo; ?></td>
                                                        <td><?php echo $adjuntos->nombre_sociedad; ?></td>
                                                        <td><?php echo $adjuntos->nombre_documento_adjunto; ?></td>
                                                        <td><?php echo $adjuntos->numero_registro; ?></td>
                                                        <td><?php echo $adjuntos->fecha_entrega; ?></td>
                                                        <td><a class="btn btn-primary" href="../controller/resource/<?php echo $id_revisar_solicitud . "/" . $adjuntos->nombre_archivo; ?>" target="_blank" rel="noopener noreferrer"><i class="fa fa-download"></i></a></td>
                                                    </tr>
                                            <?php }
                                            } ?>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div> <!--Fin Tabal Persona-->





                    </div>
                </div>



        </section>
    </div>

    <?php include_once "footer/footer_views.php"; ?>
    <script src="../resource/AdminLTE-3.2.0/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="../resource/AdminLTE-3.2.0/plugins/jquery-validation/additional-methods.min.js"></script>
    <script src="../resource/AdminLTE-3.2.0/plugins/tail-select/js/tail.select-full.js"></script>
</body>

</html>
<!--Modal upload archivos-->
<div class="modal fade" id="upload_archivos" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Formulario Insertar Documentos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Aquí va el formulario -->
                <form id='accion' method="POST" enctype="multipart/form-data">
                    <!-- seleccionar image -->


                    <!-- Otros campos del formulario -->
                    <div class="form-group">
                        <label for="archivoInput">Seleccionar Archivo</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="archivoInput" name="archivo">
                            <label class="custom-file-label" for="archivoInput">Elegir archivo</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción del Archivo</label>
                        <select class="form-control" id="descripcion_tipo_docuemnto_adjunto" name="descripcion" required>
                            <!-- Options will be populated by AJAX -->
                        </select>
                        <input type="hidden" class="form-control" value='<?php echo $id_revisar_solicitud ?>' id="id_descripcion" name="id_solicitud">
                    </div>
                    <div class="form-group" id="divfechaein" style="display: none;">
                        <label for="fechaein">Fecha</label>
                        <input type="date" name="fechaein" class="form-control">
                    </div>
                    <div class="form-group" id="divfecharegistro" style="display: none;">
                        <label for="fecharegistro">Fecha</label>
                        <input type="datetime-local" name="fecharegistro" class="form-control">
                    </div>
                    <div class="form-group" id="divnumeroregistro" style="display: none;">
                        <label for="numeroregistro">N&uacute;mero de registro</label>
                        <input type="text" name="numeroregistro" id="numeroregistro" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="sociedad">Sociedad</label>
                        <select class="form-control sociedad" id='sociedadArchivo' name="sociedad">
                            <!-- Options will be populated by AJAX -->
                        </select>
                        <input type="hidden" class="form-control" value='<?php echo $id_revisar_solicitud ?>' id="id_descripcion" name="id_solicitud">
                    </div>
                    <button type="button" id="btn-cargar" class="btn btn-primary">Cargar Archivox</button>
                    <!-- El tipo de botón debe ser 'button' si estás manejando el envío a través de JavaScript -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

            </div>
        </div>
    </div>
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
                        <!-- <div id="personaafacturar">
                        </div> -->
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label class="text-center mb-2" style="font-size: smaller;" for="companySelect">
                                Company Issuing Invoice:
                            </label>
                            <select class="form-select" id="companySelect" name="logo" required>
                                <option value="">Select Company</option>
                                <!-- <option value="patrinium">Patrimonium</option>
                                <option value="Vargas & Associates">Vargas & Associates</option>
                                <option value="Tándem International Business Services">Tándem International Business Services</option>
                                <option value="Lamva Investment">Lamva Investment</option> -->
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="text-center mb-2" style="font-size: smaller;" for="bankAccountSelect">
                                Bank Account for Deposit:
                            </label>
                            <select class="form-select" id="bankAccountSelect" name="cuenta_bancaria" required>
                                <option value="">Select Bank</option>
                                <?php
                                $banco_consigaciones = $controlador->getBancosConsignacion();
                                foreach ($banco_consigaciones as $banco_consigacion): ?>
                                    <!-- <option value="<?php echo $banco_consigacion->id_banco; ?>"><?php echo $banco_consigacion->nombre_banco; ?></option> -->
                                    <option value="<?php echo $banco_consigacion->id_banco; ?>"><?php echo $banco_consigacion->nombre_banco . "-" . $banco_consigacion->nombre_cuenta . "-" . $banco_consigacion->numero_cuenta; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="text-center mb-2" style="font-size: smaller;" for="invoiceNumberInput">
                                Invoice Number:
                            </label>
                            <input type="text" class="form-control" id="invoiceNumberInput" name="invoice_number" placeholder="Enter invoice number" required>
                            <div id="divinvoicenumberencontrado" style="display: none;">
                                <p style="color: red;font-weight: bold;"><i>El Invoice Number ingresado ya existe</i></p>
                            </div>
                        </div>
                        <div class="col-md-3">

                            <input type="hidden" class="form-control" id="tax" name="tax" value=" " placeholder="Enter TAX">
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-4">
                            <label class="text-center mb-2" style="font-size: smaller;" for="email">
                                Email Cliente:
                            </label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email" required>
                        </div>
                        <div class="col-md-4">
                            <label class="text-center mb-2" style="font-size: smaller;" for="adress">
                                Address Cliente:
                            </label>
                            <input type="text" class="form-control" id="adress" name="adress" placeholder="Enter Address" required>
                        </div>
                        <div class="col-md-4">
                            <label class="text-center mb-2" style="font-size: smaller;" for="numberTax">
                                SALE TAX:
                            </label>
                            <input type="text" class="form-control" id="numberTax" name="numberTax" placeholder="Enter tax number">
                        </div>
                    </div>

                    <hr class="my-4 primary">

                    <div class="row">
                        <label class="mb-2 h5" style="margin-top: 2%; padding-bottom: 2%;" for="invoiceNumberInput">
                            Billing Services:
                        </label>
                    </div>

                    <?php
                    $servicios = $controlador->getServiciosFactura($id_revisar_solicitud);
                    $verificarServicioEnFactura = $controlador->verificarServicioEnFactura($id_revisar_solicitud);
                    $factura_servicios   = json_decode($verificarServicioEnFactura, true);

                    // Extraer los nombres de servicios facturados en un array plano
                    $servicios_facturados = array_map(function ($item) {
                        return trim($item['descripcion']); // Eliminamos espacios en blanco
                    }, $factura_servicios);

                    foreach ($servicios as $servicio):
                        if (!empty($servicio['servicios'])):
                            // servicios y serviciones adicionales 
                            $datos       = json_decode($servicio['servicios'], true);
                            // $adicionales = json_decode($servicio['servicios_adicionales'], true);

                            // Combinar los servicios base y adicionales en un solo array
                            // $todos_los_servicios = array_merge(
                            //     is_array($datos) ? $datos : [],
                            //     is_array($adicionales) ? $adicionales : []
                            // );

                            if ($datos):
                                foreach ($datos as $clave => $valor):
                                    $en_factura = in_array(trim($valor['value']), $servicios_facturados);
                                    if (!$en_factura && $valor['estado'] == 0) {
                                        // if ($valor['estado'] == 0) { 
                    ?>
                                        <div class="row  col-12">
                                            <div class="col-md-6 mb-3">
                                                <input type="checkbox" id="check<?php echo $clave; ?>" name="check<?php echo $clave; ?>" class="check-item" data-clave="<?php echo $clave; ?>">
                                                &nbsp;
                                                <label><?php echo $valor['value']; ?></label>
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <input type="text" placeholder="Qty" name="cantidad<?php echo $clave; ?>" class="form-control" data-clave="<?php echo $clave; ?>" disabled>
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <input type="text" placeholder="Unit Price USD" name="valor<?php echo $clave; ?>" class="form-control" data-clave="<?php echo $clave; ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="row col-12">
                                            <textarea class="form-control" rows="2" name="descripcionservicio<?php echo $clave; ?>" data-clave="<?php echo $clave; ?>" placeholder="Description" disabled></textarea>
                                        </div>
                                        <br>
                                <?php
                                        // }
                                    }
                                endforeach;
                            else:
                                ?>
                                <h4>Error al decodificar el JSONB</h4>
                    <?php
                            endif;
                        endif;
                    endforeach;
                    ?>

                    <?php
                    foreach ($servicios as $servicio_adicionales):
                        if (!empty($servicio['servicios_adicionales'])):
                            $datos_adicionales = json_decode($servicio['servicios_adicionales'], true);
                            if ($datos_adicionales):
                                foreach ($datos_adicionales as $clave => $valor):
                                    $en_factura = in_array(trim($valor['value']), $servicios_facturados);
                                    if (!$en_factura) {
                    ?>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label><?php echo $valor['value']; ?></label>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <input type="text" placeholder="Qty" name="cantidad<?php echo $valor['value']; ?>" class="form-control">
                                            </div>
                                            <div class="col-md-3 mb-3">btnInsertarFactura
                                                <input type="text" placeholder="Unit Price" name="valor<?php echo $valor['value']; ?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row col-12">
                                            <textarea class="form-control" rows="2" name="descripcionservicio<?php echo $clave; ?>" placeholder="Description"></textarea>
                                        </div>
                                        <br>
                    <?php
                                    }
                                endforeach;
                            endif;
                        endif;
                    endforeach;
                    ?>

                    <hr class="my-4 primary">
                    <input type="hidden" name="total_factura" id="total_factura">
                    <!-- <div class="row">
                        <label class="mb-2 h5" style="margin-top: 2%; padding-bottom: 2%;" for="invoiceNumberInput">
                            In case of issuing an invoice with only a Total:
                        </label>

                        <div class="col-md-6 mb-3">
                            <label for="total_factura">Total Invoice</label>
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="text" placeholder="Price" name="total_factura" class="form-control">
                        </div>
                    </div> -->

                    <!-- <hr class="my-4 primary"> -->

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

<!--modal servicios--->
<div class="modal fade" id="modalSolicitud" tabindex="-1" aria-labelledby="modalSolicitudLabel" aria-hidden="true">
    <div class="modal-dialog" id="modal_nuevo_servicos">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalSolicitudLabel">Adicionar Servicios</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formulario-insertar-servicios">
                    <div class="nuevos_servicios"></div>
                    <div class="row">
                        <div class="form-group" style="display: flex; justify-content: flex-end;">
                            <button type="button" id="agregarCampo" class="btn btn-info"><i class="fas fa-plus-square"></i></button>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Contenedor donde se agregarán los campos de texto -->
                        <div id="contenedorCampos"></div>
                    </div>
                    <div class="row">
                        <input type="hidden" name="fk_solicitud" value="<?php echo $id_revisar_solicitud; ?>">
                        <button type="submit" id="btnServiciosAdicionales" class="btn btn-primary" style="margin-top:1.5%;">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal PDF 2 -->
<div class="modal fade" id="modalDatosAdicionales" tabindex="-1" aria-labelledby="modalDatosAdiacionales" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDatosAdicionales">Agregar Datos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario de cliente en dos columnas -->
                <form id="formDatosAdicionales">
                    <div class="row">
                        <!-- Primera columna -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombre_cliente">Nombre del Cliente</label>
                                <input type="text" class="form-control" id="nombre_cliente" name="nombre_cliente" placeholder="Ingresa el nombre del cliente">
                            </div>
                            <div class="form-group">
                                <label for="sr_numero">Sr. Numero</label>
                                <input type="text" class="form-control" id="sr_numero" name="sr_numero" placeholder="Ingresa el Sr. Numero">
                            </div>
                            <div class="form-group">
                                <label for="date_organization">Date of Organization and Registration</label>
                                <input type="date" class="form-control" id="date_organization" name="date_organization">
                            </div>
                            <div class="form-group">
                                <label for="state_organization">State of Organization</label>
                                <input type="text" class="form-control" id="state_organization" name="state_organization" placeholder="Ingresa el estado de organización">
                            </div>
                            <div class="form-group">
                                <label for="principal_business">Principal Place of Business</label>
                                <input type="text" class="form-control" id="principal_business" name="principal_business" placeholder="Ingresa el lugar de negocio">
                            </div>
                            <div class="form-group">
                                <label for="managing_members">Managing Members</label>
                                <input type="text" class="form-control" id="managing_members" name="managing_members" placeholder="Ingresa los miembros directivos">
                            </div>
                        </div>

                        <!-- Segunda columna -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="bank_account">Bank Account</label>
                                <input type="text" class="form-control" id="bank_account" name="bank_account" placeholder="Ingresa la cuenta bancaria">
                            </div>
                            <div class="form-group">
                                <label for="fiscal_year">Fiscal Year</label>
                                <input type="text" class="form-control" id="fiscal_year" name="fiscal_year" placeholder="Ingresa el año fiscal">
                            </div>
                            <div class="form-group">
                                <label for="ein">EIN</label>
                                <input type="text" class="form-control" id="ein" name="ein" placeholder="Ingresa el EIN">
                            </div>
                            <div class="form-group">
                                <label for="date_annual_meeting">Date of Annual Meeting</label>
                                <input type="date" class="form-control" id="date_annual_meeting" name="date_annual_meeting">
                            </div>
                            <div class="form-group">
                                <label for="secretary">Secretary</label>
                                <input type="text" class="form-control" id="secretary" name="secretary" placeholder="Ingresa el secretario">
                            </div>
                            <div class="form-group">
                                <label for="treasurer">Treasurer</label>
                                <input type="text" class="form-control" id="treasurer" name="treasurer" placeholder="Ingresa el tesorero">
                            </div>
                            <div class="form-group">
                                <label for="members">Members</label>
                                <input type="text" class="form-control" id="members" name="members" placeholder="Ingresa los miembros">
                            </div>
                            <div class="form-group">
                                <label for="initial_manager">Initial Temporal Manager</label>
                                <input type="text" class="form-control" id="initial_manager" name="initial_manager" placeholder="Ingresa el manager temporal inicial">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="fk_solicitud" value="<?php echo $id_revisar_solicitud; ?>">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary" id="guardarDatosAdicionales">Guardar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal para mostrar el contenido HTML -->
<div class="modal fade" id="modalHtml" tabindex="-1" aria-labelledby="modalHtmlLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalHtmlLabel">Contenido HTML</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Aquí se cargará el contenido HTML -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap actualiza JSONB a los servicios-->
<div class="modal fade" id="serviciosModal" tabindex="-1" role="dialog" aria-labelledby="serviciosModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="serviciosModalLabel">Orden De Servicio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formActualizarOrdenServicio">

                    <table class="table">
                        <tr>
                            <th>Servicio</th>
                            <th>Estado</th>
                            <th>Seleccionar Para Orden De Servicio</th>
                        </tr>
                        <?php
                        $solicitud_servicios_json = $controlador->getServicios($id_revisar_solicitud);
                        $solicitud_servicios = json_decode($solicitud_servicios_json, true);
                        foreach ($solicitud_servicios as $servicio) {
                            $nombre_servicioOrdenServicio = json_decode($servicio['servicios'], true);
                            $id_servicios_adicionales = $servicio['id_servicios_adicionales'];
                            foreach ($nombre_servicioOrdenServicio as $clave => $valor) {
                                $estado = $valor['estado'];
                                $estado_texto = "";
                                if ($estado == 3) {
                        ?>
                                    <tr>

                                        <td><?php echo $valor['value']; ?></td>
                                        <td>
                                            <?php

                                            if ($estado == 2) {
                                                $estado_texto = '<span class="badge badge-info">Orden Servicio</span>';
                                            } else if ($estado == 1) {
                                                $estado_texto = '<span class="badge badge-success">Pagada</span>';
                                            } else if ($estado == 0) {
                                                $estado_texto = '<span class="badge badge-primary">Facturada</span>';
                                            } else if ($estado == 3) {
                                                $estado_texto = '<span class="badge badge-warning">Insertada</span>';
                                            }
                                            echo $estado_texto;
                                            ?>
                                        </td>

                                        <td><input type="checkbox" name="servicios[]" value="<?php echo $clave; ?>">
                                            <input type="hidden" name="id_servicios_solicitados" value="<?php echo $id_servicios_adicionales; ?>">
                                        </td>
                                    </tr>
                        <?php
                                }
                            }
                        }
                        ?>
                    </table>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="guardarCambiosOrdenServicio">Guardar</button>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap actualiza JSONB a los servicios-->
<div class="modal fade" id="serviciosModalFactura" tabindex="-1" role="dialog" aria-labelledby="serviciosModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="serviciosModalLabel">Servicio a Facturar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formActualizarServiciosFacturar">

                    <table class="table">
                        <tr>
                            <th>Servicio</th>
                            <th>Estado</th>
                            <th>Seleccionar Para Facturar</th>
                        </tr>
                        <?php
                        $solicitud_servicios_json = $controlador->getServicios($id_revisar_solicitud);
                        $solicitud_servicios = json_decode($solicitud_servicios_json, true);
                        foreach ($solicitud_servicios as $servicio) {
                            $nombre_servicioFacturar = json_decode($servicio['servicios'], true);
                            $id_servicios_adicionales = $servicio['id_servicios_adicionales'];
                            foreach ($nombre_servicioFacturar as $clave => $valor) {
                                $estado = $valor['estado'];
                                $estado_texto = "";
                                if ($estado == 2) {
                        ?>
                                    <tr>

                                        <td><?php echo $valor['value']; ?></td>
                                        <td>
                                            <?php

                                            if ($estado == 2) {
                                                $estado_texto = '<span class="badge badge-info">Orden Servicio</span>';
                                            } else if ($estado == 1) {
                                                $estado_texto = '<span class="badge badge-success">Pagada</span>';
                                            } else if ($estado == 0) {
                                                $estado_texto = '<span class="badge badge-primary">Facturada</span>';
                                            } else if ($estado == 3) {
                                                $estado_texto = '<span class="badge badge-warning">Insertada</span>';
                                            }
                                            echo $estado_texto;
                                            ?>
                                        </td>

                                        <td><input type="checkbox" name="servicios[]" value="<?php echo $clave; ?>">
                                            <input type="hidden" name="id_servicios_solicitados" value="<?php echo $id_servicios_adicionales; ?>">
                                        </td>
                                    </tr>
                        <?php
                                }
                            }
                        }
                        ?>
                    </table>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="guardarCambiosServiciosFacturar">Guardar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Bootstrap -->
<div class="modal fade" id="modalCrearSociedad" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Crear Sociedad</h5>
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
                            <input type="checkbox" name="activarSociedad" id="activarSociedad" checked="true">
                            <span class="checkmark"></span>
                            <p id='activarSociedadTexto'></p>
                            <!-- Sociedad Activa -->
                        </label>
                        <label class="checkbox-container">
                            <input type="checkbox" name="declararSociedad" id="declararSociedad" data-id_solicitudUUID="">
                            <span class="checkmark"></span>
                            <p id='declararSociedadTexto'></p>
                        </label>
                        <div class="form-group " id="divTipoCorporacion" style="display: none;">
                            <label for="tipoCorporacion">¿Elige Declarar Como Corporacion?</label>
                            <select class="form-control" id="tipoCorporacion" name="tipoCorporacion">
                                <option value="no">No aplica</option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="inputNombreSociedad">Nombre de la Sociedad</label>
                        <input type="text" class="form-control" id="inputNombreSociedad" name="nombreSociedad" placeholder="Nombre de la sociedad">
                        <div id="divNombreEncontrado" style="display: none;">
                            <p style="color: red;font-weight: bold;"><i>La sociedad ya est&aacute; registrada</i></p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputNombreSociedad">Tipo de Sociedad</label>
                        <select id="selectTipoSociedad" name="selectTipoSociedad" class="form-control">
                            <option value="">Seleccionar tipo de sociedad</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="inputEstado">Estado</label>
                        <select id="selectEstado" name="estadopais[]" multiple class="form-control">
                            <option value="">Seleccionar tipo de sociedad</option>
                        </select>
                        <!-- <input type="text" class="form-control" id="selectEstado" name="estadopais" placeholder="Estado/pais de la sociedad"> -->
                    </div>

                    <!-- Contenedor para las personas y porcentajes -->
                    <div id="personasContainer">
                        <!-- Primera Persona y Porcentaje -->
                        <!-- <div class="form-group row">
                            <div class="col-md-8">
                                <label for="selectPersona">Persona Sociedad 1</label>
                                <select class="form-control selectPersona" id='selectPersona' name="personas[]">
                                    <option value="">Seleccionar persona</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="inputPorcentaje">Porcentaje</label>
                                <input type="number" class="form-control selectPorcentajes" name="porcentajes[]" placeholder="Porcentaje" min="0" max="100">
                            </div>
                        </div> -->
                    </div>

                    <!-- Botón para agregar más personas -->
                    <button type="button" class="btn btn-secondary" id="btnAgregarPersona">Agregar Socio</button>
                    <button type="button" id="btnEliminarPersona" class="btn btn-danger">Eliminar Última Persona</button>

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
                        &nbsp;
                        <div class="row col-md-8">
                            <div class="col-md-4">
                                <button type="button" class="btn btn-primary" id="btnCheckList" data-bs-toggle="modal" data-bs-target="#checklistModal">
                                    Abrir lista de chequeo
                                </button>
                            </div>

                            <div id="pdf-lista-check" class="col-md-3">
                            </div>
                        </div>

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
                <button type="button" id="btnGuardarSociedad" class="btn btn-primary">Guardar Sociedad</button>
                <button type="button" class="btn btn-secondary" id='btnCerrarModalSociedad' data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="checklistModal" tabindex="-1" aria-labelledby="checklistModalLabel" aria-hidden="true">
    <div class="modal-dialog" id="modal_nuevo_servicos">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="checklistModalLabel">Lista de Verificaci&oacute;n</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- <div class="modal-body">
                    <form id="checklistForm">
                        <ul class="list-group" id="checklistItems">
                            <li class="list-group-item"><input class="form-check-input me-2" type="checkbox"> General and specific Delaware's Corporation - Advice / Consulting</li>
                            <li class="list-group-item"><input class="form-check-input me-2" type="checkbox"> Letter of Delivery</li>
                            <li class="list-group-item"><input class="form-check-input me-2" type="checkbox"> Delaware Company Guidebook</li>
                            <li class="list-group-item"><input class="form-check-input me-2" type="checkbox"> Mandate Agreement</li>
                            <li class="list-group-item"><input class="form-check-input me-2" type="checkbox"> Draft - Preparation of Certificate of Formation</li>
                            <li class="list-group-item"><input class="form-check-input me-2" type="checkbox"> Certificate of Formation with Apostille de la Hague</li>
                            <li class="list-group-item"><input class="form-check-input me-2" type="checkbox"> Authentication (True and Correct Copy) Certificate Of Formation</li>
                            <li class="list-group-item"><input class="form-check-input me-2" type="checkbox"> Certified Copy of the Certificate of Formation</li>
                            <li class="list-group-item"><input class="form-check-input me-2" type="checkbox"> Company Information Details</li>
                            <li class="list-group-item"><input class="form-check-input me-2" type="checkbox"> Minutes of the First Meeting of the Members</li>
                            <li class="list-group-item"><input class="form-check-input me-2" type="checkbox"> Minutes of the Meeting of the Assembly of Members</li>
                            <li class="list-group-item"><input class="form-check-input me-2" type="checkbox"> Operating Agreement</li>
                            <li class="list-group-item"><input class="form-check-input me-2" type="checkbox"> Register of Members</li>
                            <li class="list-group-item"><input class="form-check-input me-2" type="checkbox"> Statement of Authorized Person</li>
                            <li class="list-group-item"><input class="form-check-input me-2" type="checkbox"> POA to open Checking Account</li>
                            <li class="list-group-item"><input class="form-check-input me-2" type="checkbox"> Bank Account Information</li>
                            <li class="list-group-item"><input class="form-check-input me-2" type="checkbox"> Certificate of Good Standing</li>
                            <li class="list-group-item"><input class="form-check-input me-2" type="checkbox"> Form SS-4</li>
                        </ul>
                        <div class="mt-3">
                            <label class="form-label">Agregar EIN Letter Copy</label>
                            <div class="input-group mb-2">
                                <input type="text" id="einText" class="form-control" placeholder="Escribe el contenido">
                                <button type="button" class="btn btn-success" onclick="agregarItem('EIN Letter Copy', 'einText')">+</button>
                            </div>
                            
                            <label class="form-label">Agregar Customizable Numbered Stock Certificate</label>
                            <div class="input-group">
                                <input type="text" id="stockText" class="form-control" placeholder="Escribe el contenido">
                                <button type="button" class="btn btn-success" onclick="agregarItem('Customizable Numbered Stock Certificate', 'stockText')">+</button>
                            </div>
                        </div>
                    </form>
                </div> -->
            <div class="modal-body">
                <form id="checklistForm">
                    <div class="row">
                        <!-- Lista de verificación en 3 columnas -->
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-4">
                                    <ul class="list-group" id="checklistColumn1"></ul>
                                </div>
                                <div class="col-md-4">
                                    <ul class="list-group" id="checklistColumn2"></ul>
                                </div>
                                <div class="col-md-4">
                                    <ul class="list-group" id="checklistColumn3"></ul>
                                </div>
                            </div>
                        </div>

                        <!-- Sección para elementos agregados -->
                        <div class="col-md-4">
                            <h5>Elementos Agregados</h5>
                            <ul class="list-group" id="checklistAdded"></ul>
                        </div>
                    </div>

                    <!-- Sección para agregar elementos dinámicamente -->
                    <div class="mt-3">
                        <label class="form-label">Customize Numbered Stock Certificate</label>
                        <div class="input-group mb-2">
                            <input type="text" id="einText" class="form-control" placeholder="Escribe el contenido">
                            <button type="button" class="btn btn-success" onclick="agregarItem('Customize Numbered Stock Certificate', 'einText')">+</button>
                        </div>

                        <label class="form-label">Agregar Customizable Numbered Stock Certificate</label>
                        <div class="input-group">
                            <input type="text" id="stockText" class="form-control" placeholder="Escribe el contenido">
                            <button type="button" class="btn btn-success" onclick="agregarItem('Customizable Numbered Stock Certificate', 'stockText')">+</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="guardarBtn">Guardar Selección</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Egresos -->
<div class="modal fade" id="egresoModal" tabindex="-1" aria-labelledby="egresoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="egresoModalLabel">Pagos Terceros</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formEgreso">
                    <div class="form-group">
                        <label for="identificacionEgreso">Consecutivo Egreso</label>
                        <input type="text" class="form-control" id="identificacionEgreso" name="identificacion_egreso" required>
                    </div>
                    <div class="form-group">
                        <label for="nombreTercero">Nombre Tercero</label>
                        <select class="form-control" id="nombreTercero" name="nombre_tercero" required>
                            <!-- Opciones pobladas por AJAX -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="aplicarSociedad">Aplicar a Sociedad</label>
                        <select class="form-control sociedad" name="sociedad_tercero" required>
                            <!-- Opciones pobladas por AJAX -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="valor">Valor</label>
                        <input type="number" class="form-control" id="valor" name="valor" required>
                    </div>
                    <!-- Nuevos campos -->
                    <div class="form-group">
                        <label for="anticipo">Anticipo</label>
                        <input type="number" class="form-control" id="anticipo" name="anticipo" required>
                    </div>
                    <div class="form-group">
                        <label for="factura">Adjuntar Factura</label>
                        <input type="file" class="form-control" id="factura" name="factura" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btnAgregarEgreso">Agregar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal ver Egresosdesde card -->
<div class="modal fade" id="detalleModal" tabindex="-1" aria-labelledby="detalleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detalleModalLabel">Detalle de Egreso</h5>
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

<script src="js/solicitud.js"></script>
<script src="js/factura.js"></script>


<script>
    const checklistItems = [
        "General and specific Delaware's Corporation - Advice / Consulting",
        "Letter of Delivery",
        "Delaware Company Guidebook",
        "Mandate Agreement",
        "Draft - Preparation of Certificate of Formation",
        "Certificate of Formation with Apostille de la Hague",
        "Authentication (True and Correct Copy) Certificate Of Formation",
        "Certified Copy of the Certificate of Formation",
        "Company Information Details",
        "Minutes of the First Meeting of the Members",
        "Minutes of the Meeting of the Assembly of Members",
        "Operating Agreement",
        "Register of Members",
        "Statement of Authorized Person",
        "POA to open Checking Account",
        "Bank Account Information",
        "Certificate of Good Standing",
        "Form SS-4"
    ];

    const columns = [
        document.getElementById("checklistColumn1"),
        document.getElementById("checklistColumn2"),
        document.getElementById("checklistColumn3")
    ];

    // Distribuir elementos en las 3 columnas
    checklistItems.forEach((item, index) => {
        let li = document.createElement("li");
        li.classList.add("list-group-item");
        li.innerHTML = `<input class="form-check-input me-2" type="checkbox"> ${item}`;
        columns[index % 3].appendChild(li); // Distribuye entre las columnas
    });


    function agregarItem(tipo, inputId) {
        const inputField = document.getElementById(inputId);
        const texto = inputField.value.trim();

        if (texto === "") {
            alert("Por favor, ingresa un texto antes de agregar.");
            return;
        }

        // const lista = document.getElementById("checklistItems");
        const listaAgregados = document.getElementById("checklistAdded");
        const nuevoItem = document.createElement("li");
        nuevoItem.classList.add("list-group-item", "d-flex", "justify-content-between");
        nuevoItem.innerHTML = `
            <div>
                <input class="form-check-input me-2" type="checkbox"> ${tipo}: ${texto}
            </div>
            <button type="button" class="btn btn-danger btn-sm" onclick="eliminarItem(this)">X</button>
        `;
        // lista.appendChild(nuevoItem);
        listaAgregados.appendChild(nuevoItem);

        // Limpiar el campo de texto después de agregar
        inputField.value = "";
    }

    function eliminarItem(boton) {
        boton.parentElement.remove();
    }

    function consultarPersonasPorSociedad(idSolicitud, tipocorporacion, idtiposociedad) {
        // console.log('🧪 ID recibido en consultarPersonasPorSociedad:', idSolicitud);
        $.ajax({
            url: '../controller/solicitudController.php',
            method: 'POST',
            data: {
                accion: 'contarPersonasSociedad',
                id_solicitud: idSolicitud
            },
            dataType: 'json',
            success: function(respuesta) {
                if (respuesta.cant_personas >= 2 && respuesta.tipo_sociedad == '5') {
                    // LLCs
                    $('#divTipoCorporacion').show();
                    $('#tipoCorporacion').html(`
                        <option value="llc 1065">LLC 1065</option>
                        <option value="Corporacion  C  8832">LLC Como Corporacion  C  8832 Para Eleccion</option>
                        <option value="Corporacion  S  2553">LLC Como Corporacion  S  2553 Para Eleccion</option>
                    `);
                } else if (respuesta.cant_personas >= 2 && (respuesta.tipo_sociedad == '6' || respuesta.tipo_sociedad == '7')) {
                    // Corporaciones Regulares
                    $('#divTipoCorporacion').show();
                    $('#tipoCorporacion').html(`
                        <option value="1120">Corporación Regular C (1120)</option>
                        <option value="1065">Corporación Colectiva (1065)</option>
                        <option value="1120-S">S Corporación (1120-S)</option>
                    `);
                } else {
                    // Caso general: ocultar y mostrar "No aplica"
                    $('#divTipoCorporacion').hide();
                    $('#tipoCorporacion').html(`<option value="no">No aplica</option>`);
                }
                if (tipocorporacion) {
                    $('#tipoCorporacion').val(tipocorporacion);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error AJAX:', error);
            }
        });
    }
</script>
<script>
    $('#archivoInput').on('change', function() {
        // Obtener el nombre del archivo
        let fileName = $(this).val().split('\\').pop();
        // Reemplazar el texto del label con el nombre del archivo
        $(this).next('.custom-file-label').html(fileName);
    });
</script>
<script>
    $(document).ready(function() {

        $(document).on("click", ".btnVerActas", function() {
            $.ajax({
                url: '../controller/obtenerActasController.php',
                type: 'POST',
                data: {
                    action: 'obtenerActas',
                    id_solicitud: '<?php echo $id_revisar_solicitud; ?>'
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status === "success") {
                        let filas = "";
                        response.data.forEach(function(item, index) {
                            filas += `<tr>
                                <td>${item.createat}</td>
                                <td>
                                    <button class="btn btn-info ver-html" data-id='${item.id_plantillas_save}' data-html='${item.contenido_html.replace(/'/g, "&apos;")}' data-bs-toggle="modal" data-bs-target="#modalContenidoHTML">
                                        Ver HTML
                                    </button>
                                </td>
                                <td>${item.nombre_sociedad}</td>
                                <td>
                                    <button class="btn btn-danger generar-pdf" data-id="${item.id_plantillas_save}" data-sociedad="${item.uuid_sociedad}">
                                        PDF
                                    </button>
                                </td>
                            </tr>`;
                        });
                        $("#tablaPlantillas tbody").html(filas);
                    } else {
                        if (response.message == 'Acta no encontrada') {
                            alert('No se encontraron actas');
                        } else {
                            alert("Error: " + response.message);
                        }
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error AJAX:", error);
                }
            });
        });


        // Evento para abrir el modal con el contenido HTML
        $(document).on("click", ".ver-html", function() {
            $("#id_plantilla").val($(this).data("id")); // Guardar el ID de la plantilla en un input oculto
            let contenidoHTML = $(this).data("html");
            $("#editor").empty(); // Establecer el contenido del editor
            // Destruir instancia anterior si existe
            if (tinymce.get('editor')) {
                tinymce.get('editor').destroy();
            }
            tinymce.init({
                selector: '#editor',
                menubar: false,
                plugins: 'advlist autolink lists link image charmap print preview anchor searchreplace visualblocks code fullscreen insertdatetime media table paste code help wordcount',
                toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | pagebreak | link image table code',
                height: 1600, // Espacio suficiente para múltiples páginas visibles en el editor
                width: '100%', // Ancho adecuado para una hoja legal en pantalla
                branding: false,
                content_style: `
                    /* Línea punteada azul al final de cada página */
                    .page-end {
                        display: block;
                        width: 100%;
                        height: 2px;
                        border-bottom: 2px dashed blue; 
                        margin-top: 10px;
                        margin-bottom: 10px;
                    }
                `,
                setup: function(editor) {
                    editor.on('init', function() {
                        // Vaciar antes de establecer el contenido
                        editor.setContent(''); // Limpiar el contenido del editor
                        editor.setContent(contenidoHTML);
                        // Insertar visualmente las líneas que marcan el final de cada página
                        updatePageMarkers(editor);
                    });
                    editor.on('input', function() {
                        updatePageMarkers(editor);
                    });
                }
            });

            function updatePageMarkers(editor) {
                let allMarkers = editor.getBody().querySelectorAll(".page-end");
                allMarkers.forEach(marker => marker.remove()); // Eliminar los marcadores antiguos

                let pageHeight = 240 * 3.779528; // Convertir mm a píxeles
                let totalPages = Math.floor(editor.getBody().scrollHeight / pageHeight);

                for (let i = 1; i <= totalPages; i++) {
                    let pageMarker = document.createElement("div");
                    pageMarker.className = "page-end";
                    pageMarker.style.position = "absolute";
                    pageMarker.style.top = `${i * pageHeight}px`;
                    editor.getBody().appendChild(pageMarker);
                }
            }
        });

        $(document).on("click", "#guardarhtml", function() {
            $("#editor").each(function() {
                var contenidoHTML = tinymce.get('editor').getContent();
                var idPlantilla = $("#id_plantilla").val(); // Obtener el ID de la plantilla del input oculto
                if (contenidoHTML.trim() === "") {
                    alert("El contenido HTML no puede estar vacío.");
                    return;
                }

                if (idPlantilla.trim() === "") {
                    alert("El ID de la plantilla no puede estar vacío.");
                    return;
                }

                $.ajax({
                    url: '../controller/obtenerActasController.php',
                    type: 'POST',
                    data: {
                        action: 'actualizarHtml',
                        contenido_html: contenidoHTML,
                        id_plantilla: idPlantilla
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === "success") {
                            alert("Guardado exitosamente.");
                            $("#modalContenidoHTML").modal('hide'); // Cerrar el modal
                        } else {
                            alert("Error al guardar HTML: " + response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error AJAX:", error);
                    }
                });
            });
        });

        // Evento para generar el PDF y abrirlo en nueva pestaña
        $(document).on("click", ".generar-pdf", function() {
            $.ajax({
                url: '../controller/obtenerActasController.php',
                type: 'POST',
                data: {
                    action: 'generarPdf',
                    // id_solicitud: id_solicitud 
                    id_solicitud: $(this).data("id")
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status === "success") {
                        window.open(response.pdf_url, '_blank'); // Abrir el PDF en una nueva pestaña
                    } else {
                        alert("Error: " + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error AJAX:", error);
                }
            });
        });

    });
</script>

<script>
    var selectSociedades = [];
    var selectMiembros = [];
    var selectClientes = [];
    var selectSociosExtranjeros = [];
</script>

<script>
    function cargarPersonas(selectElement, idSeleccionado = null, personaIndex = null) {
        // alert(selectElement + ' # ' + idSeleccionado + ' # ' + personaIndex);
        $.ajax({
            url: '../controller/sociedadController.php',
            type: 'GET',
            data: {
                accion: 'getSociedades',
                idSolicitud: '<?php echo $id_revisar_solicitud; ?>'
            },
            dataType: 'json',
            success: function(data) {
                selectElement.empty();
                selectElement.append('<option value="">SELECCIONE SOCIO</option>');
                $.each(data, function(index, item) {
                    var idSociedadItem;
                    if (item.uuid === null && item.idcliente === 0 && item.idextranjero === 0) {
                        idSociedadItem = item.id_sociedad;
                    } else if (item.uuid === null && item.id_sociedad === 0 && item.idextranjero === 0) {
                        idSociedadItem = item.idcliente;
                    } else if (item.id_sociedad === 0 && item.idcliente === 0 && item.idextranjero === 0) {
                        idSociedadItem = item.uuid;
                    } else if (item.uuid === null && item.id_sociedad === 0 && item.idcliente === 0) {
                        idSociedadItem = item.idextranjero;
                    }

                    // var tipo = "<span style="color: red;">${tipo}</span>";
                    var tipoTexto, tipoColor;
                    if (item.tipo === 'sociedad') {
                        tipoTexto = " ";
                        tipoColor = "blue";
                    } else if (item.tipo === 'socio_extranjero') {
                        tipoTexto = "Socio extranjero";
                        tipoColor = "orange";
                    } else if (item.tipo === 'miembro') {
                        tipoTexto = "Cliente";
                        tipoColor = "purple";
                    }

                    // Verificar si es la opción preseleccionada
                    var selected = (idSeleccionado && idSeleccionado == idSociedadItem) ? 'selected' : '';
                    // selectElement.append(`<option value="${idSociedadItem}" ${selected}  data-id="${item.tipo}" data-description="<span style='color:${tipoColor}; font-weight: bold;'>${item.nombre}</option>`);

                    // El color se coloca en data-description en vez de dentro de <option>
                    // Tail Select usa data-description para mostrar el color dentro del menú desplegable.
                    selectElement.append(`
                            <option value="${idSociedadItem}" ${selected} data-id="${item.tipo}" 
                                data-description="<span style='color:${tipoColor}; font-weight: bold;'>${tipoTexto}</span>">
                                ${item.nombre}
                            </option>
                        `);

                    if (personaIndex !== null && personaIndex !== 'factura') {
                        tail.select("#selectPersona" + personaIndex, {
                            search: true,
                            descriptions: true, // Activa la descripción con estilos
                            hideSelected: true,
                            hideDisabled: true,
                            // multiLimit: 4,
                            multiShowCount: false,
                            multiContainer: true
                        }).reload();
                    } else if (personaIndex == 'factura') {
                        tail.select("#selectPersonaFactura", {
                            search: true,
                            descriptions: true, // Activa la descripción con estilos
                            hideSelected: true,
                            hideDisabled: true,
                            // multiLimit: 4,
                            multiShowCount: false,
                            multiContainer: true
                        }).reload();
                    } else {
                        tail.select("#selectPersona", {
                            search: true,
                            descriptions: true, // Activa la descripción con estilos
                            hideSelected: true,
                            hideDisabled: true,
                            // multiLimit: 4,
                            multiShowCount: false,
                            multiContainer: true
                        }).reload();
                    }
                });
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
    $(document).ready(function() {

        $('#btnCerrarModalSociedad').click(function() {
            $('#modalCrearSociedad').modal('hide');
        });

        $('#btnCerrarModalSociedad2').click(function() {
            $('#modalCrearSociedad').modal('hide');
        });

        function cargarTipoSociedad(id, tipo) {
            $.ajax({
                url: '../controller/tipoSociedadController.php', // Cambia esto por la ruta correcta a tu controlador
                type: 'POST',
                data: {
                    action: 'listarTipoSociedad'
                },
                dataType: 'json',
                success: function(response) {
                    var selectTipoSociedad = $('#selectTipoSociedad');
                    selectTipoSociedad.empty();
                    if (id !== null) {
                        selectTipoSociedad.append(`<option value="${id}" selected>${tipo}</option>`);
                    } else {
                        selectTipoSociedad.append('<option value="">Selecciona un tipo de sociedad</option>');
                    }
                    $.each(response, function(index, tipoSociedad) {
                        if (id !== tipoSociedad.id_tipo_sociedad) {
                            selectTipoSociedad.append(`<option value="${tipoSociedad.id_tipo_sociedad}">${tipoSociedad.nombre_tipo_sociedad}</option>`);
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error al obtener los datos: ', xhr.responseText);
                }
            });
        }

        function cargarEstados(estadosSeleccionados = []) {
            $.ajax({
                url: '../controller/estadosController.php',
                type: 'GET',
                data: {
                    accion: 'getEstados'
                },
                dataType: 'json',
                success: function(data) {
                    // Cargar los estados en el select multiples
                    var selectEstado = $('#selectEstado');
                    selectEstado.empty();
                    // selectEstado.append('<option value="">Seleccionar Estado/Pais</option>');

                    $.each(data, function(index, item) {
                        var selected = estadosSeleccionados.includes(item.id_estado) ? 'selected' : '';

                        selectEstado.append('<option value="' + item.id_estado + '" ' + selected + ' >' + item.estado + '</option>');
                    });
                    // Inicializar el select con tail.select
                    tail.select("#selectEstado", {
                        search: true,
                        descriptions: true,
                        hideSelected: true,
                        hideDisabled: true,
                        // multiLimit: 4,
                        multiShowCount: false,
                        multiContainer: true
                    }).reload();
                },
                error: function(xhr, status, error) {
                    console.error('Error al cargar los estados:', error);
                }
            });
        }

        $('.crearSociedad').click(function() {

            // Limpiar el contenedor de personas antes de agregar nuevas
            // $('#conjunto_sociedades').val('');
            // $('#conjunto_personas').val();
            // $('#conjunto_clientes').val();
            // $('#conjunto_socios_extranjeros').val();

            // $('#personasContainer .row').find('select').first().remove();
            // $('#personasContainer .row').first().val('');

            // Eliminar los select que se crean dinamicamente


            // $('.selectPersona').val('');
            // $('.selectPersona').remove();


            // if ($('.selectPersona').length) {
            //     alert('El select existe 0');
            //     alert($('.selectPersona').length);
            // } else {
            //     alert('El select NO existe 0');
            // }


            // if ($('#selectPersona').length) {
            //     alert('El select existe 1');
            // } else {
            //     alert('El select NO existe 1');
            // }

            // if ($('#selectPersona' + 2).length) {
            //     alert('El select existe 2');
            // } else {
            //     alert('El select NO existe 2');
            // }

            // alert($('#selectPersona' + 2).val());

            // $('#selectPersona' + 2).val('');
            // $('#selectPersona' + 2).remove();


            var personasContainer = $('#personasContainer .row');
            if (personasContainer.length > 0) {
                // alert('personasContainer');
                for (var i = 0; i < personasContainer.length; i++) {
                    personasContainer[i].remove();
                }
                $('#personasContainer .row').find('select').first().val('');
                $('#personasContainer .row').find('select').first().remove();
                // $('#personasContainer .row').find('select').first().empty(); 

                // if ($('#selectPersona').length) {
                //     alert('El select existe 3');
                // } else {
                //     alert('El select NO existe 3');
                // }


                // var conjuntoSociedadCrearSociedad  = $('#personasContainer .persona-item'); 
                // var conjuntoSociedadEditarSociedad = $('#personasContainer .row');
                // alert(conjuntoSociedadCrearSociedad.length + ' # ' + conjuntoSociedadEditarSociedad.length);

                // cargarPersonas($('#personasContainer .row').find('select').first());
                // var selectElement = $('#personasContainer .row').find('select').first();
                // selectElement.empty();
                // selectElement.append('<option value="">Selecciona una Persona</option>');
            }

            // AHORA SE AGREGA EL PRIMER SELECT POR JS PARA QUE AL MOMENTO DE ABRIR EL MODAL DE LAS SOCIEDADES, ESTE APAREZCA NUEVAMENTE VACIO
            var campoSelectSociedades = `
                <div class="form-group row">
                    <div class="col-md-8">
                        <label for="selectPersona">Socio No 1</label>
                        <select class="form-control selectPersona" id='selectPersona' name="personas[]">
                            <option value="">Seleccionar persona</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="inputPorcentaje">Porcentaje</label>
                        <input type="number" class="form-control porcentajeInput" name="porcentajes[]" placeholder="Porcentaje" min="0" max="100">
                    </div>
                </div>
            `;
            $('#personasContainer').append(campoSelectSociedades);
            var primerSelectSociedades = $('#personasContainer').find('select').last(); // Seleccionar el nuevo select
            cargarPersonas(primerSelectSociedades);


            // $('#personasContainer .row').find('select').first().empty();
            // alert($('#personasContainer .row').find('select').first().val());

            cargarTipoSociedad(null, null);
            cargarEstados();

            divActivarSociedad = $('#divActivarSociedad');
            divActivarSociedad.hide();
            $('#activarSociedad').prop('checked', true);

            // Limpiar el contenedor de personas antes de agregar nuevas
            if ($('#idSociedad').val() !== '') {
                $('.selectPersona').empty();
            }
            $('#idSociedad').val('');
            $('#idSociedad').empty();
            $('.selectPorcentajes').val('0');
            // Llenar el campo del nombre de la sociedad
            $('#inputNombreSociedad').val('');
            $('#idSociedad').val('');
            // Cambiar el texto del botón dependiendo si se va a guardar o actualizar
            $('#btnGuardarSociedad').text('Guardar Sociedad');
            // Abrir el modal
            $("#documentosSociedad").hide();
            $("#reportesSociedad").hide();
            $('#modalCrearSociedad .modal-title').text('Crear Sociedad');
            $('#modalCrearSociedad .modal-dialog').removeAttr('id', 'modal_nuevo_servicos');
            $('#modalCrearSociedad').modal('show');

        });

        let checklistModal = document.getElementById("checklistModal");

        checklistModal.addEventListener("hidden.bs.modal", function() {
            // alert('cerrando modal');
            let checklistList = document.getElementById("checklistItems");

            // 🔹 1️⃣ Desmarcar todos los checkboxes
            // checklistList.querySelectorAll("input[type='checkbox']").forEach(checkbox => {
            //     checkbox.checked = false;
            // });

            // 🔹 2️⃣ Eliminar elementos agregados dinámicamente
            checklistList.querySelectorAll(".dynamic-item").forEach(item => item.remove());
        });
        let idSolicituduuid;
        let tipocorporacion;
        $('.btnVerDetalles').click(function() {

            // alert($(this).data('estadopais'));
            var estadopais = $(this).data('estadopais');
            estadopais = estadopais.map(Number);
            cargarEstados(estadopais);


            $('#divActivarSociedad').show();
            $('#activarSociedad').prop('checked', false);

            // Obtener datos de la sociedad desde los atributos del botón
            var nombreSociedad = $(this).data('nombre');
            var personas = $(this).data('personas');
            // Llenar el campo del nombre de la sociedad
            $('#inputNombreSociedad').val(nombreSociedad);
            $('#idSociedad').val($(this).data('id'));
            document.getElementById('declararSociedad').setAttribute('data-id_solicitudUUID', $(this).data('id'));
            idSolicituduuid = null;
            idSolicituduuid = $(this).data('id');
            tipocorporacion = null;
            tipocorporacion = $(this).data('tipocorporacion') == null ? null : $(this).data('tipocorporacion');
            var idtiposociedad = $(this).data('idtiposociedad') == null ? null : $(this).data('idtiposociedad');


            // Mostrar el check activado o desactivado segun lo que viene de la BD
            $('#activarSociedad').prop('checked', $(this).data('activarsociedad') == 'on' ? true : false);

            // Si el check activarSociedad es true, mostrar el div de activarSociedad
            if ($(this).data('activarsociedad') == 'on') {
                $('#activarSociedadTexto').text('Activada');
            } else {
                $('#activarSociedadTexto').text('Desactivada');
            }

            $('#activarSociedad').change(function() {
                if ($(this).is(':checked')) {
                    $('#activarSociedadTexto').text('Activada');
                } else {
                    $('#activarSociedadTexto').text('Desactivada');
                }
            });



            $('#declararSociedad').prop('checked', $(this).data('declararsociedad') == 'on' ? true : false);
            // Si el check declararSociedad es true, agregar texto a la etiqueta p
            if ($(this).data('declararsociedad') == 'on') {
                $('#declararSociedadTexto').text('Declarando');
                // Si idtiposociedad es igual a 5 ejcutar la funcion consultarPersonasPorSociedad
                consultarPersonasPorSociedad(idSolicituduuid, tipocorporacion, idtiposociedad); // Cargar las personas de la sociedad
            } else {
                $('#declararSociedadTexto').text('No esta Declarando');
                $('#divTipoCorporacion').hide();
            }
            // Cuando el check declararSociedad cambie de valor, cambiar el texto
            $('#declararSociedad').change(function() {
                if ($(this).is(':checked')) {
                    $('#declararSociedadTexto').text('Declarando');
                    // Mostrar el select y cargar opciones C y S
                    //$('#divTipoCorporacion').show();
                    // $('#tipoCorporacion').html(`
                    //    <option value="LLL 1065">LLC 1065</option>
                    //    <option value="Corporacion  C  8832">LLC Como Corporacion  C  8832 Para Eleccion</option>
                    //    <option value="Corporacion  S  2553">LLC Como Corporacion  S  2553 Para Eleccion</option>
                    //`);
                    // const idSolicituduuid = $(this).data('id_solicitudUUID');
                    // consultarPersonasPorSociedad(idSolicituduuid,tipocorporacion); 
                    consultarPersonasPorSociedad(idSolicituduuid, tipocorporacion, idtiposociedad); // Cargar las personas de la sociedad
                } else {
                    $('#declararSociedadTexto').text('No está Declarando');
                    $('#divTipoCorporacion').hide();
                    $('#tipoCorporacion').html(`
                            <option value="no">No aplica</option>
                        `);
                }
            });
            // alert($(this).data('tiposociedad'));

            var tiposociedad = $(this).data('tiposociedad') == null ? null : $(this).data('tiposociedad');

            cargarTipoSociedad(idtiposociedad, tiposociedad);

            var idSociedad = $(this).data('id');

            // alert('idSociedad=> ' +idSociedad);

            // Cambiar el texto del botón dependiendo si se va a guardar o actualizar
            $('#btnGuardarSociedad').text($('#idSociedad').val() === '' ? 'Guardar Sociedad' : 'Actualizar Sociedad');

            $('#modalCrearSociedad .modal-title').text($('#idSociedad').val() === '' ? 'Crear Sociedad' : 'Información Sociedad');


            // Limpiar el contenedor de personas antes de agregar nuevas
            $('#personasContainer').empty();

            // Convertirlo a un array de objetos
            try {
                personas = JSON.parse(personas); // ← Convierte el string JSON en un array
            } catch (error) {
                console.error("Error al parsear JSON de personas:", error);
            }

            // Validar si realmente es un array antes de usar forEach
            var selectedUUIDs = [];
            var selectedUUIDs2 = [];
            var selectedUUIDs3 = [];
            var selectedUUIDs4 = [];
            // <div class="form-group">
            //                 <label for="inputNombreSociedad">Tipo de Sociedad</label>
            //                 <select id="selectTipoSociedad" name="selectTipoSociedad" class="form-control">
            //                     <option value="${persona.idtiposociedad}" selected>${persona.tiposociedad}</option>
            //                 </select>
            //             </div>
            if (Array.isArray(personas)) {
                personas.forEach(function(persona, index) {
                    var personaIndex = index + 1;
                    var nuevoCampo = `
                        <div class="form-group row">
                            <div class="col-md-8">
                                <label>Persona Sociedad ${personaIndex}</label>
                                <select class="form-control selectPersona" id='selectPersona${personaIndex}' name="personas[]">
                                    <option value="${persona.id}" selected>${persona.nombre}</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Porcentaje</label>
                                <input type="number" class="form-control porcentajeInput" name="porcentajes[]" value="${persona.porcentaje}" min="0" max="100">
                            </div>
                        </div>
                    `;
                    $('#personasContainer').append(nuevoCampo);
                    // Cargar las opciones en el select recién agregado y preseleccionar la persona actual
                    var nuevoSelect = $('#personasContainer').find('select').last();
                    cargarPersonas(nuevoSelect, persona.id, personaIndex);

                    if (persona.tipo === 'cliente') {
                        $('#conjunto_clientes').val(persona.id);
                    }

                    if (persona.tipo == 'sociedad') {
                        selectedUUIDs.push(persona.id);
                    } else if (persona.tipo == 'miembro') {
                        selectedUUIDs2.push(persona.id);
                    } else if (persona.tipo == 'cliente') {
                        selectedUUIDs3.push(persona.id);
                    } else if (persona.tipo == 'socio_extranjero') {
                        selectedUUIDs4.push(persona.id);
                    }

                });
                $('#conjunto_sociedades').val(selectedUUIDs.join(','));
                $('#conjunto_personas').val(selectedUUIDs2.join(','));
                $('#conjunto_clientes').val(selectedUUIDs3.join(','));
                $('#conjunto_socios_extranjeros').val(selectedUUIDs4.join(','));
            } else {
                console.error("Error: personas no es un array", personas);
            }

            // Destruir la tabla si ya existe
            if ($.fn.DataTable.isDataTable('#documentosAdjuntosxSociedad')) {
                $('#documentosAdjuntosxSociedad').DataTable().clear().destroy();
            }
            $('#documentosSociedadBody').empty();
            // Cargar los documentos de la sociedad
            $.ajax({
                url: '../controller/sociedadController.php',
                type: 'GET',
                data: {
                    accion: 'getDocumentos',
                    idSolicitud: '<?php echo $id_revisar_solicitud; ?>',
                    idSociedad: idSociedad
                },
                dataType: 'json',
                success: function(data) {
                    let nuevoDocumento = '';
                    $.each(data, function(index, item) {
                        var numero_registro = item.numero_registro === null ? 'N/A' : item.numero_registro;
                        var fecha_entrega = item.fecha_entrega === null ? 'N/A' : item.fecha_entrega;
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
            // alert(idSociedad);
            $('#reportesSociedadTablaBody').empty();
            $.ajax({
                url: '../controller/obtenerActasController.php',
                type: 'POST',
                data: {
                    action: 'obtenerActas',
                    id_solicitud: '<?php echo $id_revisar_solicitud; ?>',
                    idSociedad: idSociedad,
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status === "success") {
                        let filas = "";
                        response.data.forEach(function(item, index) {
                            filas += `<tr>
                                <td>${item.createat}</td>
                                <td>
                                    <button class="btn btn-info ver-htmlSociedad" data-id='${item.id_plantillas_save}' data-html='${item.contenido_html.replace(/'/g, "&apos;")}' data-bs-toggle="modal" data-bs-target="#modalContenidoHTML">
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
                        if (response.message == 'Acta no encontrada') {
                            let filas = "";
                            filas += `<tr>
                                <td colspan="3">No se encontraron actas</td>
                            </tr>`;
                            $("#reportesSociedadTabla tbody").html(filas);
                        } else {
                            alert("Error: " + response.message);
                        }
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error AJAX:", error);
                }
            });

            // Evento para abrir el modal con el contenido HTML
            $(document).on("click", ".ver-htmlSociedad", function(event) {
                event.preventDefault(); // Prevent the default action
                $("#id_plantilla").val($(this).data("id"));
                let contenidoHTML = $(this).data("html");
                // $("#contenidoHTML").html(contenidoHTML); // Use .html() to replace content instead of .append()
                $("#editor").empty(); // Establecer el contenido del editor
                // Destruir instancia anterior si existe
                if (tinymce.get('editor')) {
                    tinymce.get('editor').destroy();
                }
                tinymce.init({
                    selector: '#editor',
                    menubar: false,
                    plugins: 'advlist autolink lists link image charmap print preview anchor searchreplace visualblocks code fullscreen insertdatetime media table paste code help wordcount',
                    toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | pagebreak | link image table code',
                    height: 1600, // Espacio suficiente para múltiples páginas visibles en el editor
                    width: '100%', // Ancho adecuado para una hoja legal en pantalla
                    branding: false,
                    content_style: `
                        /* Línea punteada azul al final de cada página */
                        .page-end {
                            display: block;
                            width: 100%;
                            height: 2px;
                            border-bottom: 2px dashed blue; 
                            margin-top: 10px;
                            margin-bottom: 10px;
                        }
                    `,
                    setup: function(editor) {
                        editor.on('init', function() {
                            // Vaciar antes de establecer el contenido
                            editor.setContent(''); // Limpiar el contenido del editor
                            editor.setContent(contenidoHTML);
                            // Insertar visualmente las líneas que marcan el final de cada página
                            updatePageMarkers(editor);
                        });
                        editor.on('input', function() {
                            updatePageMarkers(editor);
                        });
                    }
                });

                function updatePageMarkers(editor) {
                    let allMarkers = editor.getBody().querySelectorAll(".page-end");
                    allMarkers.forEach(marker => marker.remove()); // Eliminar los marcadores antiguos

                    let pageHeight = 240 * 3.779528; // Convertir mm a píxeles
                    let totalPages = Math.floor(editor.getBody().scrollHeight / pageHeight);

                    for (let i = 1; i <= totalPages; i++) {
                        let pageMarker = document.createElement("div");
                        pageMarker.className = "page-end";
                        pageMarker.style.position = "absolute";
                        pageMarker.style.top = `${i * pageHeight}px`;
                        editor.getBody().appendChild(pageMarker);
                    }
                }
            });

            // Evento para generar el PDF y abrirlo en nueva pestaña
            $(document).on("click", ".generar-pdfSociedad", function(event) {
                event.preventDefault();
                $.ajax({
                    url: '../controller/obtenerActasController.php',
                    type: 'POST',
                    data: {
                        action: 'generarPdf',
                        id_solicitud: '<?php echo $id_revisar_solicitud; ?>',
                        idSociedad: idSociedad,
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === "success") {
                            window.open(response.pdf_url, '_blank'); // Abrir el PDF en una nueva pestaña
                        } else {
                            alert("Error: " + response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error AJAX:", error);
                    }
                });
            });

            // Abrir el modal
            $("#documentosSociedad").show();
            $("#reportesSociedad").show();
            $('#modalCrearSociedad .modal-dialog').attr('id', 'modal_nuevo_servicos');
            $('#modalCrearSociedad').modal('show');


            document.getElementById('btnCheckList').addEventListener('click', function() {
                var inputIdSociedad = $('#inputIdSociedad_' + idSociedad).val();
                // alert(inputIdSociedad);
                $.ajax({
                    url: '../controller/obtenerActasController.php',
                    type: 'POST',
                    data: {
                        action: 'selectChecklist',
                        id_solicitud: '<?php echo $id_revisar_solicitud; ?>',
                        idSociedad: inputIdSociedad,
                    },
                    dataType: 'json',
                    success: function(response) {
                        let checklistList = document.getElementById("checklistItems");
                        let columns = [
                            document.getElementById("checklistColumn1"),
                            document.getElementById("checklistColumn2"),
                            document.getElementById("checklistColumn3")
                        ];
                        let checklistAdded = document.getElementById("checklistAdded");
                        if (response.status === "success") {
                            let checklistItems = JSON.parse(response.data[0].datos);

                            // Limpiar solo los elementos dinámicos agregados anteriormente
                            checklistAdded.innerHTML = "";

                            // Limpiar solo los elementos dinámicos agregados anteriormente
                            // checklistList.querySelectorAll(".dynamic-item").forEach(item => item.remove());


                            // let listaExistente = checklistList.querySelectorAll("li");
                            // Obtener los elementos de la lista existente
                            let listaExistente = document.querySelectorAll("#checklistColumn1 li, #checklistColumn2 li, #checklistColumn3 li");


                            let textosEnLista = new Set();

                            listaExistente.forEach(li => {
                                let checkbox = li.querySelector("input[type='checkbox']");
                                let texto = li.textContent.trim();

                                // Guardamos en el set los textos existentes
                                textosEnLista.add(texto);

                                // Verificar si el elemento en checklistItems tiene `checked: true`
                                let itemEncontrado = checklistItems.find(item => item.text.trim() === texto);
                                if (itemEncontrado && itemEncontrado.checked === "true") {
                                    checkbox.checked = true;
                                } else {
                                    checkbox.checked = false;
                                }
                            });

                            checklistItems.forEach(item => {
                                if (!textosEnLista.has(item.text.trim())) {
                                    let li = document.createElement("li");
                                    li.classList.add("list-group-item", "dynamic-item");
                                    li.innerHTML = `<div>
                                        <input class="form-check-input me-2" type="checkbox" ${item.checked ? 'checked' : ''}> ${item.text}
                                    </div>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="eliminarItem(this)">X</button>`;
                                    checklistAdded.appendChild(li);
                                    // document.getElementById("checklistItems").appendChild(li);
                                }
                            });
                        } else {
                            // alert("Error: " + response.message);
                            checklistAdded.innerHTML = "";
                            // checklistList.querySelectorAll(".dynamic-item").forEach(item => item.remove());
                            $('#checklistItems input[type="checkbox"]').each(function() {
                                if ($(this).prop('checked')) { // Si está marcado 
                                    $(this).prop('checked', false); // Lo desmarca
                                }
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error AJAX:", error);
                    }
                });
            });
            // Agregar el boton para mostrar el PDF de la lista de chequeo
            $('#pdf-lista-check').empty();
            let btnPDF = "<a class='btn btn-danger' href='pdf_listas_verificacion_sociedades.php?idSolicitud=<?php echo $id_revisar_solicitud; ?>&sociedad=" + $('#inputIdSociedad_' + idSociedad).val() + "' target='_blank' rel='noopener noreferrer'>PDF</a>";
            $('#pdf-lista-check').append(btnPDF);

            // <a href="pdf_listas_verificacion_sociedades.php" target="_blank" rel="noopener noreferrer"></a>


            // document.getElementById('guardarBtn').addEventListener('click', function () {

            //     let selectedItems = [];
            //     document.querySelectorAll('#checklistForm input[type="checkbox"]:checked').forEach((checkbox) => {
            //         // selectedItems.push(checkbox.parentElement.textContent.trim());
            //         let itemText = checkbox.parentElement.textContent.trim();
            //         selectedItems.push({
            //             text: itemText,
            //             checked: checkbox.checked
            //         });
            //     });

            //     if (selectedItems.length > 0) {
            //         alert("Elementos seleccionados 222 :\n" + selectedItems.join("\n"));
            //         $.ajax({
            //             url: '../controller/obtenerActasController.php',
            //             type: 'POST',
            //             data: { 
            //                 action: 'guardarChecklist', 
            //                 id_solicitud: '<?php echo $id_revisar_solicitud; ?>',
            //                 items: selectedItems,
            //                 idSociedad: idSociedad,
            //             },
            //             dataType: 'json',
            //             success: function(response) {
            //                 if (response.status === "success") {
            //                     alert("Checklist guardado correctamente.");
            //                 } else {
            //                     alert("Error: " + response.message);
            //                 }
            //             },
            //             error: function(xhr, status, error) {
            //                 console.error("Error AJAX:", error);
            //             }
            //         });

            //     } else {
            //         alert("No se ha seleccionado ningún elemento.");
            //     }
            // });

        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#btnGuardarPersonaCliente').click(function(e) {
            e.preventDefault(); // Previene el comportamiento por defecto del botón
            var datos = $('#frm_guardar_sociedad').serialize() + "&accion=guardarSociedad";
            var numeroSolicitud = $('#numeroSolicitud').val();
            $.ajax({
                type: "POST",
                url: "../controller/solicitudController.php",
                data: datos,
                success: function(r) {
                    if (r.status == 'ok') {
                        alert("Persona Agregada con Exito :)");
                    } else {
                        alert("Error al intentar registrar el cliente, intentar de nuevo");
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


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Selecciona todos los checkboxes con la clase toggle-checkbox
        var checkboxes = document.querySelectorAll('.toggle-checkbox');

        checkboxes.forEach(function(checkbox) {
            // Encuentra el contenedor correspondiente al checkbox
            var inputContainerId = 'inputContainer' + checkbox.id.replace('document', '');
            var inputContainer = document.getElementById(inputContainerId);

            checkbox.addEventListener('change', function() {
                if (checkbox.checked) {
                    inputContainer.style.display = 'block'; // Muestra el input
                } else {
                    inputContainer.style.display = 'none'; // Oculta el input
                }
            });
        });
    });



    $(document).ready(function() {
        $('#btn-cargar').click(function() {
            var formData = new FormData($('#accion')[0]);
            formData.append('accion', 'insertarRevision');

            $.ajax({
                url: '../controller/solicitudController.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    Swal.fire({
                        title: '¡Éxito!',
                        text: '¡File Saved Successfully!',
                        icon: 'success',
                        confirmButtonText: 'Aceptar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'verSolicitud.php?numero_solicitud=<?php echo $id_revisar_solicitud; ?>';
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });

    $(document).ready(function() {
        $('#documentosAdjuntos').DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            dom: 'Bfrtip',
            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
            }
        });
    });



    $(document).ready(function() {

        $(".check-item").change(function() {
            var clave = $(this).data("clave");
            var isChecked = $(this).is(":checked");

            // Habilitar o deshabilitar los inputs correspondientes
            $("input[name='cantidad" + clave + "'], input[name='valor" + clave + "'], textarea[name='descripcionservicio" + clave + "']")
                .prop("disabled", !isChecked);
        });

        var campoPersonaFacturar = `
                <div class="form-group row">
                    <div class="col-md-8">
                        <label for="selectPersona">Persona a facturar</label>
                        <select class="form-control selectPersona" id='selectPersonaFactura' name="selectPersonaFactura" required>
                            <option value="">Seleccionar persona</option>
                        </select>
                    </div>
                </div>
            `;
        $('#personaafacturar').append(campoPersonaFacturar);
        var personaafacturar = $('#personaafacturar').find('select').last(); // Seleccionar el nuevo select
        cargarPersonas(personaafacturar, null, 'factura');


        // Cargar los select companySelect/empresas
        $('#btn_crear_factura').click(function() {
            var companySelect = $('#companySelect');
            $.ajax({
                url: '../controller/empresasController.php',
                type: 'POST',
                data: {
                    action: 'listarEmpresas'
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status === "success") {
                        response.data.forEach(function(company) {
                            companySelect.append(new Option(company.nombre_empresa, company.id_empresa));
                        });
                    } else {
                        console.error("Error al cargar las empresas:", response.mensaje);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error en la solicitud AJAX:", error);
                }
            });
            // ver las empresas cuando cambia el select
            // companySelect.change(function() {
            //     var selectedCompany = $(this).val();
            // });
        });

        $('#btnInsertarFactura').click(function() {
            var datos = $('#billingForm').serialize();
            datos += "&accion=insertarFactura"; // Añadir acción específica para el controlador
            if ($('#selectPersonaFactura').val() === '') {
                Swal.fire("Error", "Por favor, selecciona una persona a facturar.", "error");
                return false; // Detener la ejecución si no se selecciona una persona
            }
            if ($('#companySelect').val() === '') {
                Swal.fire("Error", "Por favor, selecciona una compañia.", "error");
                return;
            }
            if ($('#bankAccountSelect').val() === '') {
                Swal.fire("Error", "Por favor, selecciona el banco", "error");
                return false; // Detener la ejecución si no se ingresa una fecha
            }
            if ($('#invoiceNumberInput').val() === '') {
                Swal.fire("Error", "Por favor, ingresa el Invoice Number.", "error");
                return false; // Detener la ejecución si no se ingresa un número de factura
            }

            // Validar que el invoice number no exista
            if ($('#divinvoicenumberencontrado').is(':visible')) {
                Swal.fire("Error", "El Invoice Number ingresado ya existe.", "error");
                return;
            }

            // Bloquear boton
            $(this).prop('disabled', true);
            $.ajax({
                type: "POST",
                url: "../controller/solicitudController.php",
                data: datos,
                success: function(r) {
                    if (r.resultado == 0) {
                        alert("Fallo en la inserción de la factura.");
                    } else {
                        alert("Factura insertada con éxito.");
                        window.location.href = 'verSolicitud.php?numero_solicitud=<?php echo $id_revisar_solicitud; ?>';
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
        $('#btnModalSolicitud').click(function() {
            $.ajax({
                url: '../controller/solicitudController.php', // Ajusta el path según sea necesario
                method: 'POST',
                data: {
                    action: 'listarServicios'
                },
                dataType: 'json',
                success: function(response) {
                    var serviciosDiv = $('.nuevos_servicios');
                    serviciosDiv.empty(); // Limpiar cualquier contenido previo
                    // Contenedor principal
                    var servicioHtml = '<div class="row">';
                    // Contador para los elementos
                    var counter = 0;
                    var counter_list = 1;

                    var servicios = <?php echo $jsonNombre_servicio; ?>;

                    $.each(response, function(index, servicio) {
                        // Si el contador es múltiplo de 15, cerrar la columna actual y abrir una nueva
                        if (counter % 15 === 0) {
                            // No agregar '</div>' al principio
                            if (counter !== 0) {
                                servicioHtml += '</div>';
                            }
                            servicioHtml += '<div class="col-lg-4 col-md-6 col-sm-12">';
                        }

                        // Verificar si el servicio está en el array de servicios
                        var isChecked = servicios.hasOwnProperty(servicio.servicio_name) ? 'checked' : '';


                        // Agregar el elemento
                        servicioHtml += '<div class="custom-control custom-checkbox">';
                        servicioHtml += '<input type="checkbox" class="custom-control-input" id="' + servicio.servicio_name + '" name="' + servicio.servicio_name + '" value="' + servicio.nombre_servicio + '" ' + isChecked + '>';
                        servicioHtml += '<label class="custom-control-label" for="' + servicio.servicio_name + '">' + counter_list + '. ' + servicio.nombre_servicio + '</label>';
                        servicioHtml += '</div>';

                        counter++;
                        counter_list++;

                    });

                    // Cerrar la última columna y el contenedor principal
                    servicioHtml += '</div></div>';

                    serviciosDiv.append(servicioHtml);


                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Error al obtener los servicios:', textStatus, errorThrown);
                }
            });
        });

    });

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
    // Evento al hacer clic en el botón de Guardar (#btnServiciosAdicionales)
    $(document).ready(function() {
        $('#btnServiciosAdicionales').click(function() {
            var datos = $('#formulario-insertar-servicios').serialize() + "&accion=insertarServiciosAdicionales";
            $.ajax({
                type: "POST",
                url: "../controller/solicitudController.php",
                data: datos,
                success: function(r) {
                    if (r.resultado == 0) {
                        alert("fallo :(");
                    } else {
                        alert("Agregado con éxito");
                        window.location.href = 'verSolicitud.php?numero_solicitud=<?php echo $id_revisar_solicitud; ?>';
                    }
                }
            });
            return false;
        });

    });

    $(document).ready(function() {
        $('#guardarDatosAdicionales').click(function(e) {
            e.preventDefault();

            $.ajax({
                url: '../controller/solicitudController.php', // Cambia por la ruta real de tu controlador
                type: 'POST',
                data: $('#formDatosAdicionales').serialize() + '&accion=guardarCliente',
                success: function(response) {
                    var resultado = JSON.parse(response);
                    if (resultado.status === 0) {
                        alert('Datos guardados correctamente');
                        $('#modalCliente').modal('hide'); // Cerrar el modal al guardar
                        window.location.href = 'verSolicitud.php?numero_solicitud=<?php echo $id_revisar_solicitud; ?>';
                    } else {
                        alert('Hubo un error al guardar el cliente');
                    }
                },
                error: function() {
                    alert('Error al procesar la solicitud');
                }
            });
        });
    });

    $(document).ready(function() {
        let idSolicitud = "<?php echo isset($id_revisar_solicitud) ? $id_revisar_solicitud : ''; ?>";

        if (idSolicitud === '') {
            console.error("idSolicitud no está definido.");
        } else {
            // Solicitud AJAX para obtener las actas
            // $.ajax({
            //     url: '../controller/obtenerActasController.php',
            //     method: 'POST',
            //     data: {
            //         action: 'obtenerActas',
            //         id_solicitud: idSolicitud
            //     },
            //     dataType: 'json',
            //     success: function(response) {
            //         if (response.status === 'success') {
            //             let acta = response.data;
            //             let tbody = $('#actas tbody');
            //             tbody.empty();

            //             let row = `
            //             <tr>
            //                 <td>${acta.createat}</td>
            //                 <td>
            //                     <button class="btn btn-primary ver-html" data-id_solicitud="${idSolicitud}">Ver HTML</button>
            //                     <button class="btn btn-success generar-pdf" data-id_solicitud="${idSolicitud}">Generar PDF</button>
            //                 </td>
            //             </tr>
            //         `;
            //             tbody.append(row);

            //             $('.generar-pdf').on('click', function() {
            //                 let idSolicitud = $(this).data('id_solicitud');
            
            //                 // Solicitud AJAX para generar el PDF
            //                 $.ajax({
            //                     url: '../controller/obtenerActasController.php',
            //                     method: 'POST',
            //                     data: {
            //                         action: 'generarPdf',
            //                         id_solicitud: idSolicitud
            //                     },
            //                     dataType: 'json',
            //                     success: function(response) {
            
            //                         if (response.status === 'success') {
            //                             window.open(response.pdf_url, '_blank');
            //                         } else {
            //                             alert(response.message);
            //                         }
            //                     },
            //                     error: function(xhr, status, error) {
            //                         console.error("Error en la solicitud AJAX para generar PDF:", xhr.responseText);
            //                         alert('Error al generar el PDF.');
            //                     }
            //                 });
            //             });
            //         } else {
            //             alert(response.message);
            //         }
            //     },
            //     error: function() {
            //         console.error('Error en la solicitud AJAX.');
            //         alert('Error al cargar las actas.');
            //     }
            // });
        }
    });

    $('#guardarCambiosOrdenServicio').on('click', function() {
        var formData = $('#formActualizarOrdenServicio').serialize() + "&accion=ActualizarServicio"; // Serializar los datos del formulario
        $.ajax({
            url: '../controller/solicitudController.php', // Ajusta la URL
            method: 'POST',
            data: formData,
            success: function(response) {
                alert('Servicios actualizados exitosamente.');
                location.reload(); // Recargar la página si es necesario
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    });

    $('#guardarCambiosServiciosFacturar').on('click', function() {
        var formData = $('#formActualizarServiciosFacturar').serialize() + "&accion=ActualizarServicioFactura"; // Serializar los datos del formulario
        $.ajax({
            url: '../controller/solicitudController.php', // Ajusta la URL
            method: 'POST',
            data: formData,

            success: function(response) {
                alert('Servicios actualizados exitosamente.');
                location.reload(); // Recargar la página si es necesario
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    });

    $(document).ready(function() {
        // Ejecutar la petición AJAX cuando la página esté lista o al realizar alguna acción
        var idSolicitud = $('#idSolicitud').text(); // Obtener el valor de id_solicitud desde el div oculto

        // Definir los datos para enviar, incluyendo el id_solicitud y la acción
        var datos = {
            id_solicitud: idSolicitud,
            accion: "downloadFacturas"
        };

        // Ejecutar la petición AJAX
        $.ajax({
            url: '../controller/solicitudController.php', // Ruta del controlador
            type: 'POST',
            data: datos, // Enviar los datos como un objeto
            success: function(response) {
                // Parsear el JSON recibido
                let facturas = JSON.parse(response);

                // Limpiar el contenido actual del tbody
                $('#facturasDownload').empty();

                // Iterar sobre las facturas recibidas y agregar las filas al tbody
                facturas.forEach(function(factura) {
                    let jsonString = factura.datos;

                    // Parse the JSON string
                    let data = JSON.parse(jsonString);

                    // Extract the invoice_number
                    let invoiceNumber = data.invoice_number;

                    // Validar si los campos son null y asignar 'N/A' si es el caso
                    let createdAt = factura.created_at ? factura.created_at : "<span class='text-na'>N/A</span>";
                    let rutaPago = factura.ruta_pago ? factura.ruta_pago : "<span class='text-na'>N/A</span>";
                    let tipoConsignacion = factura.tipo_consignacion ? factura.tipo_consignacion : "<span class='text-na'>N/A</span>";
                    let notaPago = factura.nota_pago ? factura.nota_pago : "<span class='text-na'>N/A</span>";
                    let idFactura = factura.id ? factura.id : "<span class='text-na'>N/A</span>";
                    let idNumeroFacura = factura.numerofactura ? factura.numerofactura : "<span class='text-na'>N/A</span>";
                    let nombreBanco = factura.nombre_banco ? factura.nombre_banco : "<span class='text-na'>N/A</span>";
                    let comprobanteHTML = (factura.ruta_pago && factura.ruta_pago !== 'N/A') ?
                        "<a href='../controller/resource/<?php echo $id_revisar_solicitud; ?>/" + rutaPago + "' target='_blank' rel='noopener noreferrer'>Descargar Comprobante</a>" :
                        "<span class='text-na'>N/A</span>";

                    // Determinar si hay comprobante o no
                    let tieneComprobante = factura.ruta_pago && factura.ruta_pago !== 'N/A';

                    // Definir clase para la celda del número de factura
                    let claseColorFactura = tieneComprobante ? 'fondo-verde' : 'fondo-rojo';
                    let datosServicios = JSON.parse(factura.datos);
                    let total = 0; // Inicializa el total
                    $.each(datosServicios.servicios, function(nombreServicio, detalleServicio) {
                        // Multiplica valor por cantidad y suma al total
                        total += Number(detalleServicio.valor) * Number(detalleServicio.cantidad);
                    });

                    // Construir la fila
                    //let fila = "<tr><td>" + createdAt + "</td><td> <a href='factura_report.php?numero_solicitud=<?php echo $id_revisar_solicitud; ?>&invoiceNumber=" + invoiceNumber + "' target='_blank' rel='noopener noreferrer'>Descargar </a></td><td><a href='../controller/resource/<?php echo $id_revisar_solicitud; ?>/" + rutaPago + "'target='_blank' rel='noopener noreferrer'>Descargar Comprobante</a></td><td>" + tipoConsignacion + "</td><td>" + notaPago + "</td><td>" + idFactura + "</td><td>"+idNumeroFacura+"</td><td>"+total+"</td><td>"+nombreBanco+"</td></tr>";
                    let fila = "<tr><td>" + createdAt + "</td><td> <a href='factura_report.php?numero_solicitud=<?php echo $id_revisar_solicitud; ?>&invoiceNumber=" + invoiceNumber + "' target='_blank' rel='noopener noreferrer'>Descargar </a></td><td>" + comprobanteHTML + "</td><td>" + tipoConsignacion + "</td><td>" + notaPago + "</td><td>" + idFactura + "</td><td class='" + claseColorFactura + "'>" + idNumeroFacura + "</td><td>" + total + "</td><td>" + nombreBanco + "</td></tr>";

                    // Agregar la fila al tbody
                    $('#facturasDownload').append(fila);
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

        $("#tableServiciosSolicitados").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "buttons": ["excel", "pdf"],
            "searching": false,
            "paging": false,
            "info": false
        }).buttons().container().appendTo('#tableServiciosSolicitados_wrapper .col-md-6:eq(0)');
    });

    $(document).ready(function() {
        // Función para cargar las opciones en cualquier select de personas



        // Cargar personas en el primer select de personas
        cargarPersonas($('#personasContainer').find('select').first());

        // Función para agregar nuevos campos de persona y porcentaje
        var personaIndex = 2; // Comienza en 2 porque ya tienes una persona por defecto
        $('#btnAgregarPersona').click(function() {
            var nuevoCampo = `
                <div class="form-group row persona-item">
                    <div class="col-md-8">
                        <label for="selectPersona${personaIndex}">Persona Sociedad ${personaIndex}</label>
                        <select class="form-control selectPersona" id='selectPersona${personaIndex}' name="personas[]">
                            <option value="">Seleccionar persona</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="inputPorcentaje${personaIndex}">Porcentaje</label>
                        <input type="number" class="form-control porcentajeInput" name="porcentajes[]" placeholder="Porcentaje" min="0" max="100">
                    </div>
                </div>
            `;
            $('#personasContainer').append(nuevoCampo);
            var nuevoSelect = $('#personasContainer').find('select').last(); // Seleccionar el nuevo select
            cargarPersonas(nuevoSelect, null, personaIndex); // Cargar las opciones en el nuevo select
            personaIndex++;
        });

        // Función para eliminar la última persona agregada
        $('#btnEliminarPersona').click(function() {
            var conjuntoSociedadCrearSociedad = $('#personasContainer .persona-item');
            var conjuntoSociedadEditarSociedad = $('#personasContainer .row');

            var personas = conjuntoSociedadCrearSociedad.length > 0 ? conjuntoSociedadCrearSociedad : conjuntoSociedadEditarSociedad;

            if (personas.length > 0) {
                alert('Eliminando persona');
                var lastSelect = personas.last().find('select').val(); // Obtener el valor del último select
                var lastTipo = personas.last().find('select option:selected').data('id'); // Obtener el tipo del último select

                // Eliminar el último elemento del contenedor
                personas.last().remove();
                personaIndex--; // Disminuir el índice

                // Eliminar el valor del array correspondiente
                if (lastTipo == 'sociedad') {
                    selectSociedades = selectSociedades.filter(item => item !== lastSelect);
                    // Actualizar el valor del campo oculto
                    $('#conjunto_sociedades').val(selectSociedades.join(','));
                } else if (lastTipo == 'miembro') {
                    selectMiembros = selectMiembros.filter(item => item !== lastSelect);
                    $('#conjunto_personas').val(selectMiembros.join(','));
                } else if (lastTipo == 'cliente') {
                    selectClientes = selectClientes.filter(item => item !== lastSelect);
                    $('#conjunto_clientes').val(selectClientes.join(','));
                } else if (lastTipo == 'socio_extranjero') {
                    selectSociosExtranjeros = selectSociosExtranjeros.filter(item => item !== lastSelect);
                    $('#conjunto_socios_extranjeros').val(selectSociosExtranjeros.join(','));
                }
            }
        });

        function generateUUID() {
            return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
                var r = Math.random() * 16 | 0,
                    v = c == 'x' ? r : (r & 0x3 | 0x8);
                return v.toString(16);
            });
        }

        // Validar que la suma de porcentajes no exceda 100% y mostrar mensaje en JS
        $('#btnGuardarSociedad').click(function(e) {
            e.preventDefault();

            // Obtener todos los porcentajes
            var totalPorcentaje = 0;
            $('.porcentajeInput').each(function() {
                var valor = parseFloat($(this).val()) || 0; // Si no hay valor, se asume 0
                totalPorcentaje += valor;
            });

            // Verificar que la suma no exceda el 100%
            if (totalPorcentaje > 100) {
                // Mostrar mensaje en pantalla
                alert('La suma de los porcentajes no puede exceder el 100%. Por favor ajusta los valores.');
                return; // Detener el envío del formulario
            }

            var uuid = generateUUID();
            var conjunto_sociedades = document.getElementById('conjunto_sociedades').value;
            var conjunto_personas = document.getElementById('conjunto_personas').value;
            var conjunto_socios_extranjeros = document.getElementById('conjunto_socios_extranjeros').value;
            var nombreSociedad = '{' + conjunto_sociedades + '}';

            var conjunto_clientes = '{' + document.getElementById('conjunto_clientes').value + '}';

            var accion = $('#idSociedad').val() === '' ? 'crearSociedad' : 'actualizarSociedad';

            // Si todo está bien, serializar los datos del formulario
            var datosFormulario = $('#formCrearSociedad').serialize() + '&conjuntosociosextranjeros=' + conjunto_socios_extranjeros + '&conjuntopersonas=' + conjunto_personas + '&conjuntoclientes=' + conjunto_clientes + '&sociedades=' + nombreSociedad + '&uuid=' + uuid + '&accion=' + accion;
            // Envío de datos con AJAX
            $.ajax({
                type: 'POST',
                url: '../controller/solicitudController.php', // Ruta hacia el controlador PHP
                data: datosFormulario,
                success: function(response) {
                    var resultado = JSON.parse(response);
                    if (resultado.status === 0) {
                        alert(resultado.message);
                        $('#modalCrearSociedad').modal('hide');
                        location.reload();
                    } else {
                        alert(resultado.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.log('Error en la solicitud AJAX:', status, error);
                    console.log('Respuesta del servidor:', xhr.responseText);
                    alert('Error al crear la sociedad');
                }
            });
        });
    });




    $(document).ready(function() {
        // Fetch data for the new select element
        $.ajax({
            url: '../controller/solicitudController.php',
            type: 'GET',
            data: {
                accion: 'obtenerSociedadesSelect',
                idSolicitud: '<?php echo $id_revisar_solicitud; ?>'
            },
            dataType: 'json',
            success: function(data) {
                var select = $('.sociedad');
                select.empty();
                if (data.length > 0) {
                    select.append('<option value="">Seleccionar sociedad</option>');
                    $.each(data, function(index, item) {
                        select.append('<option value="' + item.uuid + '">' + item.nombre_sociedad + '</option>');
                    });
                } else {
                    select.append('<option value="Sin Sociedad<">Sin Sociedad</option>');
                }
                // $.each(data, function(index, item) {
                //     select.append('<option value="' + item.uuid + '">' + item.nombre_sociedad + '</option>');
                // });
            },
            error: function(xhr, status, error) {
                console.error('Error fetching data: ', error);
            }
        });
    });

    $(document).ready(function() {
        // Fetch data for the new select element
        $.ajax({
            url: '../controller/tipoDocumentoAdjunto.php', // Cambia esto por la ruta correcta a tu controlador
            type: 'POST',

            data: {
                action: 'listarTipoPago'
            },
            dataType: 'json',
            success: function(data) {
                var select = $('#descripcion_tipo_docuemnto_adjunto');
                select.empty();
                select.append('<option value="">Seleccionar el tipo de archivo</option>');
                $.each(data, function(index, item) {
                    select.append('<option value="' + item.id_tipo_documento_adjunto + '">' + item.nombre_documento_adjunto + '</option>');
                });
            },
            error: function(xhr, status, error) {
                console.error('Error fetching data: ', error);
            }
        });

        var selectTipoArchivo = $('#descripcion_tipo_docuemnto_adjunto');
        selectTipoArchivo.on('change', function() {
            var selectTipoArchivo = $(this).val();
            if (selectTipoArchivo == 10) {
                $('#divfechaein').show();
                $('#divfecharegistro').hide();
                $('#divnumeroregistro').show();
            } else if (selectTipoArchivo == 14) {
                $('#divfechaein').hide();
                $('#divfecharegistro').show();
                $('#divnumeroregistro').show();
            } else {
                $('#divfechaein').hide();
                $('#divfecharegistro').hide();
                $('#divnumeroregistro').hide();
            }

        });

    });

    $(document).ready(function() {
        // Fetch data for the new select element
        $.ajax({
            url: '../controller/terceros_controller.php', // Cambia esto por la ruta correcta a tu controlador
            type: 'POST',
            data: {
                action: 'listarTipoPago'
            },
            dataType: 'json',
            success: function(data) {
                var select = $('#nombreTercero');
                select.empty();
                $.each(data, function(index, item) {
                    select.append('<option value="' + item.id_terceros + '">' + item.nombre_tercero + '</option>');
                });
            },
            error: function(xhr, status, error) {
                console.error('Error fetching data: ', error);
            }
        });

        $('#btnAgregarEgreso').click(function() {
            var form = $('#formEgreso')[0];
            var formData = new FormData(form);
            formData.append('accion', 'insertarEgreso'); // Agregar el campo de acción manualmente

            $.ajax({
                type: 'POST',
                url: '../controller/solicitudController.php',
                data: formData,
                processData: false, // Necesario para enviar archivos
                contentType: false, // Necesario para enviar archivos
                success: function(response) {
                    try {
                        var result = JSON.parse(response);
                        if (result.status === 'success') {
                            alert('Egreso agregado exitosamente');
                            location.reload(); // Recargar la página
                        } else {
                            alert('Error al agregar el egreso');
                        }
                    } catch (e) {
                        console.error("Error parsing JSON response:", e);
                        alert('Error al procesar la respuesta del servidor');
                    }
                },

                error: function(xhr, status, error) {
                    console.error('Error in AJAX request:', status, error);
                    alert('Error al agregar el egreso');
                }
            });
        });
    });

    $(document).ready(function() {
        $(document).on('click', '.small-box-footer', function(e) {
            e.preventDefault();
            var idSolicitud = $(this).data('uuid'); // Obtén el UUID del atributo data-uuid
            // alert(idSolicitud);
            $.ajax({
                url: '../controller/solicitudController.php',
                type: 'POST',
                data: {
                    accion: 'obtenerSolicitud',
                    id_solicitud: idSolicitud
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    var htmlContent = '<table id="egresosTable" class="display">';
                    htmlContent += '<thead><tr><th>Consecutivo Egreso</th><th>Valor</th><th>Nombre Tercero</th><th>Anticipo</th><th>Factura</th><th>Fecha Creación</th></tr></thead>';
                    htmlContent += '<tbody>';
                    data.forEach(function(item) {
                        htmlContent += '<tr>';
                        htmlContent += '<td>' + item.consecutivo_egreso + '</td>';
                        htmlContent += '<td>' + item.valor + '</td>';
                        htmlContent += '<td>' + item.nombre_tercero + '</td>'; // Asegúrate de que el campo sea correcto
                        htmlContent += '<td>' + item.anticipo + '</td>';
                        htmlContent += '<td><a href=' + item.factura + ' class="btn btn-danger" target="_blank"><i class="fa fa-download"></i></td>';
                        htmlContent += '<td>' + item.create_at + '</td>';
                        htmlContent += '</tr>';
                    });
                    htmlContent += '</tbody></table>';
                    $('#modalContent').html(htmlContent);

                    // Inicializa DataTables
                    $('#egresosTable').DataTable();
                },
                error: function(xhr, status, error) {
                    console.error('Error al cargar los datos:', error);
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {


        $('#checklistModal').on('hidden.bs.modal', function() {
            let checklistAdded = document.getElementById("checklistAdded");
            checklistAdded.innerHTML = "";
            location.reload();
            $('#checklistItems input[type="checkbox"]').each(function() {
                if ($(this).prop('checked')) { // Si está marcado 
                    console.log('Desmarcando:', $(this).parent().text().trim());
                    $(this).prop('checked', false); // Lo desmarca
                }
            });
        });

        // Prevent multiple event bindings for the "Guardar Selección" button
        $('#guardarBtn').off('click').on('click', function() {
            let selectedItems = [];

            $('#checklistColumn1 input[type="checkbox"]:checked, #checklistColumn2 input[type="checkbox"]:checked, #checklistColumn3 input[type="checkbox"]:checked')
                .each(function() {
                    let itemText = $(this).closest("li").clone().children().remove().end().text().trim();
                    if (itemText) { // Solo agregar si hay texto válido
                        selectedItems.push({
                            text: itemText,
                            checked: true
                        });
                    }
                });

            // Seleccionar checkboxes marcados en la lista de elementos agregados (checklistAdded)
            $('#checklistAdded input[type="checkbox"]:checked').each(function() {
                let itemText = $(this).closest("li").clone().children("input, button").remove().end().text().trim();
                if (itemText) {
                    selectedItems.push({
                        text: itemText,
                        checked: true
                    });
                }
            });


            // alert(selectedItems);


            // $('#checklistItems input[type="checkbox"]:checked').each(function () {
            //     let itemText = $(this).parent().text().trim();
            //     selectedItems.push({
            //         text: itemText,
            //         checked: true
            //     });
            // });

            if (selectedItems.length > 0) {
                $.ajax({
                    url: '../controller/obtenerActasController.php',
                    type: 'POST',
                    data: {
                        action: 'guardarChecklist',
                        id_solicitud: '<?php echo $id_revisar_solicitud; ?>',
                        items: selectedItems,
                        idSociedad: $('#idSociedad').val(),
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === "success") {
                            alert(response.message);
                            location.reload();
                            // alert("Checklist guardado correctamente.");
                        } else {
                            alert("Error: " + response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error AJAX:", error);
                    }
                });
            } else {
                alert("No se ha seleccionado ningún elemento.");
            }
        });
    });
</script>