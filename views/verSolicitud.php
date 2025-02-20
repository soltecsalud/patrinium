<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
    exit();
} elseif (isset($_SESSION['usuario']) && $_SESSION['configuracion general'] === false) {
    echo 'Acesso no autorizado.';
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="css/barraFiltros.css">
    <title>Registrar ESE</title>
    <style>
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
            color: #0066cc; /* Color morado */
            font-weight: bold;
        }

        .card-text-serazo {
            font-size: 20px;
            color:#0221fe; /* Color negro */
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

#modal_nuevo_servicos{
    max-width: 90%;
    width: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
    font-family: Arial, sans-serif;
}

th, td {
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
    </style>
</head>

<body>
    <div class="content-wrapper">
            <div  id="filtros-bar">
                    <button type="button" id="fa-filter" class="btn  btn-xs barra filtros-bar " data-toggle="modal" data-target="#modalSolicitud" >
                        <i class="fas fa-briefcase"></i>
                    </button>
                    <button type="button" id="fa-bars" class="btn  btn-xs barra first-child " data-toggle="modal" data-target="#billingModal" >
                        <i class="fas fa-file-invoice"></i>
                    </button>
                    
                    <button type="button" id="fa-minus-circle" class="btn  btn-xs barra first-child " data-toggle="modal" data-target="#upload_archivos" >
                        <i class="fas fa-upload"></i>
                    </button>
                            
                          
                        
                        
        </div>
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    <h3>Revisar Solicitud</h3>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="card card-dark shadow-lg card-registroSolicitudCliente">
                    <div class="card-header">
                        <h3 class="card-title">Revisar Solicitud Cliente</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#modalCrearCliente"><i class="fas fa-user-plus"></i></button>
                            
                            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#upload_archivos"><i class="fas  fa-upload"></i>
                                
                            </button>
                            <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#billingModal">
                                <i class="fas fa-file-invoice"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-bs-toggle="modal" data-bs-target="#modalSolicitud">
                                <i class="fas fa-briefcase"></i>
                            </button>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCrearSociedad">
                            Crear Sociedad
                            </button>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#egresoModal">
                                Crear Egreso
                            </button>
                        </div>
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
                                    <form action="" method="POST" id="frm_guardar_sociedad">
                                        <input type="hidden" name="numeroSolicitud" name="numeroSolicitud"  value="<?php echo $_GET['numero_solicitud']; ?>" >
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
                        
                        <div class="row">
                            <div class="col-md-9">
                                <div class="card card-info card-outline shadow-none p-0">
                                    <div class="card-header">
                                        <h3 class="card-title">Revisar Solicitud</h3>
                                    </div>
                                    <div class="card-body">
                                    <?php 
        if(isset($_GET['numero_solicitud'])){
            $id_revisar_solicitud = $_GET['numero_solicitud'];
        }

        $controlador = new Solicitud_controller();
        $solicitudes = $controlador->getSolicitud($id_revisar_solicitud);

        if (is_array($solicitudes) && count($solicitudes) > 0) {
            foreach ($solicitudes as $solicitud) {
                if (is_object($solicitud)) {
                    echo "<div class='info-row'>";
                    echo "<span class='info-title'>Referido Por:</span>";
                    echo "<span class='info-value'>" . htmlspecialchars($solicitud->referido_por) . "</span>";
                    echo "</div>";

                    echo "<div class='info-row'>";
                    echo "<span class='info-title'>Necesidad:</span>";
                    echo "<span class='info-value'>" . htmlspecialchars($solicitud->necesidad) . "</span>";
                    echo "</div>";
                } else {
                    echo "<p>No se encontraron solicitudes.</p>";
                }
            } 
        } else {
            echo "<p>No se encontraron solicitudes.</p>";
        }
        ?>         
                                    
                                    
                                    
                                        </div>
                                    </div>
                           
                            </div>
                            <div class="col-md-3">
                                        
                                    <div class="card-serazo">
                                        <div class="card-number-serazo"><?php echo  $id_revisar_solicitud?></div>
                                        <div class="card-text-serazo">Numero Solicitud</div>
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
                                                $solicitudes    = $controlador->getSociedades($id_revisar_solicitud);
                                                $idSociedades   = $controlador->getSociedadesSociedades($id_revisar_solicitud);
                                                $idClientes     = $controlador->obtenerSociedadesCliente($id_revisar_solicitud);
                                                $miembrosSociedad = [];
                                                $miembrosClientes = [];
                                                foreach ($idSociedades as $value) { 
                                                    if (preg_match('/^\{.+\}$/', $value['conjunto_sociedades'])) {
                                                        $uuids = explode(",", trim($value['conjunto_sociedades'], "{}"));
                                                        foreach ($uuids as $uuid) {
                                                            $buscarMiembroSociedad = $controlador->buscarSociedadxSociedad($uuid);
                                                            if (is_array($buscarMiembroSociedad)) {
                                                                $miembrosSociedad[]    = implode(", ", $buscarMiembroSociedad);
                                                            }
                                                        }
                                                    }
                                                }
                                                
                                                foreach ($idClientes as $value) {
                                                    $uuids      = explode(",", trim($value['clientes'], "{}"));
                                                    foreach ($uuids as $uuid) {
                                                        $buscarMiembroCliente = $controlador->buscarSociedadCliente($uuid);
                                                        if($buscarMiembroCliente){
                                                            $miembrosClientes[]   = implode(", ", $buscarMiembroCliente);
                                                        }
                                                    }
                                                }


                                                // Array para agrupar representantes por sociedad
                                                $sociedades_representantes = [];

                                                if (isset($solicitudes)) {
                                                    // Agrupamos los representantes por sociedad
                                                    foreach ($solicitudes as $datosSOlicitud) { 
                                                        $uuidString = str_replace(["{", "}"], "", $datosSOlicitud['conjunto_sociedades']);
                                                        $uuidArray  = explode(",", $uuidString);

                                                        // $tieneSociedad = $datosSOlicitud['conjunto_sociedades'];

                                                        foreach ($uuidArray as $uuid) {
                                                            if(!empty($uuid)){
                                                                $nombreSociedad = $controlador->buscarSociedadxSociedad($uuid);
                                                            }
                                                        }
                                                        $sociedades_representantes[$datosSOlicitud['nombre_sociedad']][] = [
                                                            'nombre_completo' => $datosSOlicitud['nombre_completo'],
                                                            'porcentaje' => $datosSOlicitud['porcentaje'],
                                                            'uuid' => $datosSOlicitud['uuid'],
                                                            'tieneSociedad' => $datosSOlicitud['conjunto_sociedades']
                                                        ];
                                                    }

                                                    // Ahora mostramos cada sociedad con sus representantes
                                                    foreach ($sociedades_representantes as $nombre_sociedad => $representantes) {
                                            ?>
                                                        <div class="col-md-4">
                                                            <div class="info-box">
                                                                <span class="info-box-icon bg-info"><i class="far fa-bookmark"></i></span>
                                                                <div class="info-box-content">
                                                                    <span class="info-box-number"><?php echo $nombre_sociedad; ?></span>
                                                                    <span class="info-box-text">
                                                                        <?php 
                                                                            if (preg_match('/^\{.+\}$/', $representantes[0]['tieneSociedad'])) {
                                                                                foreach ($miembrosSociedad as $miembro) {
                                                                                    echo $miembro . "<br>";
                                                                                }
                                                                            }
                                                                        
                                                                            foreach ($miembrosClientes as $cliente) {
                                                                                echo $cliente . "<br>";
                                                                            }
                                                                        ?>
                                                                    </span>
                                                                    <?php foreach ($representantes as $representante) { ?>
                                                                        <span class="info-box-text">
                                                                            <?php  
                                                                                if($representante['nombre_completo'] != ''){
                                                                                    echo $representante['nombre_completo'].' '.$representante['porcentaje'].'%';
                                                                                }
                                                                            ?>
                                                                        </span>
                                                                    <?php } ?>
                                                                </div>
                                                                <div class="progress">
                                                                    <div class="progress-bar bg-info" style="width: 70%"></div>
                                                                </div>
                                                                <a href="#" class="small-box-footer" data-toggle="modal" data-target="#detalleModal" data-uuid="<?php echo $representantes[0]['uuid']; ?>">
                                                                    <i class="fas fa-arrow-circle-right"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                            <?php
                                                    }
                                                } else {
                                                    echo "no hay sociedades";
                                                }
                                            ?>
                                        </div>
                                    </div>
                        </div>  <!--Fin Tabal Persona-->
                       
                       
                      
                    
                    
               
                        <div class="card-body">
                        
                            <div class="card card-info card-outline shadow-none p-0">
                                <div class="card-header">
                                    <h3 class="card-title">Datos Persona</h3>
                                </div>
                                    <div class="card-body">

                                        <table class="table">
                    
                                                <?php
                                                        $sociedad_controller = new Solicitud_controller();
                                                        $fk_persona = $solicitud->fk_persona;
                                                        $fila = $sociedad_controller->getSociedad($fk_persona);

                                                    
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
                                                    Servicios a Facturas
                                                </button>
                                                
                                            </div>
                                        
                                    </div>
                                        <div class="card-body">
                                                    <table>
                                                        <tr>
                                                            <th>Servicio</th>
                                                           
                                                            <th>Estado</th>
                                                        </tr>

                                                    <?php
                                                                $solicitud_servicios_json = $controlador->getServicios($id_revisar_solicitud);

                                                                // Decodificar el JSON a un array asociativo
                                                                $solicitud_servicios = json_decode($solicitud_servicios_json, true);
                                                               
                                                                // Recorrer el array de servicios
                                                                foreach ($solicitud_servicios as $servicio) {
                                                                    $nombre_servicio = json_decode($servicio['servicios'], true); // Decodificar el campo 'servicios'
                                                                   

                                                                    // Asignar estado
                                                                   
                                                                    

                                                                    // Generar filas de la tabla
                                                                    foreach ($nombre_servicio as $clave => $valor) {
                                                                        ?>
                                                                        <tr>
                                                                            <td>
                                                                                <?php echo $valor['value']; ?></td>
                                                                        
                                                                            <td>
                                                                                <?php 
                                                                                   $estado = $valor['estado'];
                                                                                  
                                                                                   $estado_texto="";	
                                                                                    if ($estado == 2) {
                                                                                        $estado_texto = '<span class="badge badge-info">Orden Servicio</span>';
                                                                                    } else if  ($estado == 1) {
                                                                                        $estado_texto = '<span class="badge badge-success">Pagada</span>';
                                                                                    }else if ($estado == 0){
                                                                                        $estado_texto = '<span class="badge badge-primary">Para Facturada</span>';
                                                                                    }
                                                                                    else if ($estado == 3){
                                                                                        $estado_texto = '<span class="badge badge-warning">Insertada</span>';
                                                                                    }
                                                                                    echo $estado_texto;
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
                                                                $solicitud_servicios_json = $controlador->getServicios($id_revisar_solicitud);

                                                                // Decodificar el JSON a un array asociativo
                                                                $solicitud_servicios = json_decode($solicitud_servicios_json, true);
                                                               
                                                                // Recorrer el array de servicios
                                                                foreach ($solicitud_servicios as $servicio) {
                                                                    $nombre_servicio = json_decode($servicio['servicios_adicionales'], true); // Decodificar el campo 'servicios'
                                                                    

                                                                   

                                                                    // Generar filas de la tabla
                                                                    foreach ($nombre_servicio as $clave => $valor) {
                                                                        $estado = $valor['estado'];
                                                                       
                                                                          
                                                                        ?>
                                                                        <tr>
                                                                            <td>
                                                                                <?php echo $valor['value']; ?></td>
                                                                        
                                                                            <td>
                                                                                <?php 
                                                                                   
                                                                                   $estado_texto="";	
                                                                                    if ($estado == 2) {
                                                                                        $estado_texto = '<span class="badge badge-info">Orden Servicio</span>';
                                                                                    } else if  ($estado == 1) {
                                                                                        $estado_texto = '<span class="badge badge-success">Pagada</span>';
                                                                                    }else if ($estado == 0){
                                                                                        $estado_texto = '<span class="badge badge-primary">Para Facturada</span>';
                                                                                    }
                                                                                    else if ($estado == 3){
                                                                                        $estado_texto = '<span class="badge badge-warning">Insertada</span>';
                                                                                    }
                                                                                    echo $estado_texto;
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
                                    <h3 class="card-title">Facturas Download</h3>
                                </div>
                                    <div class="card-body">
                                    <div id="idSolicitud" style="display:none;"><?php echo $id_revisar_solicitud; ?></div>
                                        <table id="documentosAdjuntos" class="table table-bordered table-striped">
                                           <thead>
                                           <tr>
                                            <th>Fecha Creacion</th>
                                            <th>Descargar Factura</th>
                                            <th>Descargar Comprobante Pago</th>
                                            <th>Tipo Consignacion</th>
                                            <th>Nota</th>
                                           </tr>
                                           </thead>
                                            <tbody id="facturasDownload" >                                              
                                               
                                        
                                            </tbody>
                                        </table>
                                        
                                    </div>
                            </div>
                    
                        
                        <div class="card card-info card-outline shadow-none p-0">
                                <div class="card-header">
                                    <h3 class="card-title">Reportes Download</h3>
                                </div>
                                <div class="card-body">
                                    <table id="actas" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Fecha</th>
                                                <th>Accion</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Aquí se insertarán las filas dinámicamente con JavaScript -->
                                        </tbody>
                                    </table>
                                </div>
                        </div>
                       
                       
                    
                        <div class="card card-info card-outline shadow-none p-0">
                                <div class="card-header">
                                    <h3 class="card-title">Documentos Download</h3>
                                </div>
                                    <div class="card-body">
                                        <table id="documentosAdjuntos" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Fecha</th>
                                                    <th>Nombre Archivo</th>
                                                    <th>Sociedad</th>
                                                    <th>Accion</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $solicitudes = $controlador->getListadoAdjuntos($id_revisar_solicitud);
                                                

                                                foreach($solicitudes as $adjuntos){
                                                ?>
                                                <tr>
                                                    <td><?php  echo $adjuntos->create_at?></td>
                                                    <td><?php  echo $adjuntos->nombre_archivo?></td>
                                                    <td><?php  echo $adjuntos->nombre_sociedad?></td>
                                                    <td><a class="btn btn-primary"href="../controller/resource/<?php echo $adjuntos->id_solicitud."/".$adjuntos->nombre_archivo;?>" target="_blank" rel="noopener noreferrer"><i class="fa fa-download"></i></a></td>
                                                </tr>
                                                <?php } ?>
                                        
                                            </tbody>
                                        </table>
                                        
                                    </div>
                            </div>
                        </div>  <!--Fin Tabal Persona-->
                       
                       
                      
                    
                    
                </div>
            </div>

            
            
        </section>
    </div>

    <?php include_once "footer/footer_views.php"; ?>
    <script src="../resource/AdminLTE-3.2.0/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="../resource/AdminLTE-3.2.0/plugins/jquery-validation/additional-methods.min.js"></script>
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
                    <select class="form-control" id="descripcion_tipo_docuemnto_adjunto" name="descripcion">
                           <!-- Options will be populated by AJAX -->
                    </select>
                <input type="hidden" class="form-control" value='<?php echo $id_revisar_solicitud?>'id="id_descripcion" name="id_solicitud" >
            </div>
            <div class="form-group">
                <label for="sociedad">Sociedad</label>
                <select class="form-control sociedad"  name="sociedad">
                    <!-- Options will be populated by AJAX -->
                </select>
                <input type="hidden" class="form-control" value='<?php echo $id_revisar_solicitud?>' id="id_descripcion" name="id_solicitud">
            </div>
            <button type="button" id="btn-cargar" class="btn btn-primary">Cargar Archivo</button>
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
                    <div class="row">
                        <div class="col-md-3">
                            <label class="text-center mb-2" style="font-size: smaller;" for="companySelect">
                                Company Issuing Invoice:
                            </label>
                            <select class="form-select" id="companySelect" name="logo">
                                <option value="0">Select Company</option>
                                <option value="patrinium">Patrinium</option>
                                <option value="JairoVargas">Jairo Vargas</option>
                                <option value="empresa_3">Empresasss</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="text-center mb-2" style="font-size: smaller;" for="bankAccountSelect">
                                Bank Account for Deposit:
                            </label>
                            <select class="form-select" id="bankAccountSelect" name="cuenta_bancaria">
                                <option value="0">Select Bank</option>
                                <?php
                                    $banco_consigaciones = $controlador->getBancosConsignacion();   
                                    foreach ($banco_consigaciones as $banco_consigacion): ?>
                                        <option value="<?php echo $banco_consigacion->id_banco; ?>"><?php echo $banco_consigacion->nombre_banco; ?></option>
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
                            <label class="text-center mb-2" style="font-size: smaller;" for="tax">
                                TAX:
                            </label>
                            <input type="text" class="form-control" id="tax" name="tax" placeholder="Enter TAX">
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
                    </div>

                    <?php
                        $servicios = $controlador->getServiciosFactura($id_revisar_solicitud);
                        foreach ($servicios as $servicio):
                            if (!empty($servicio['servicios'])):
                                $datos = json_decode($servicio['servicios'], true);
                                if ($datos):
                                    foreach ($datos as $clave => $valor):
                          if($valor['estado']==0){             
                    ?> 
                        <div class="row">
                          
                            <div class="col-md-6 mb-3">
                                <label><?php echo $valor['value']; ?></label>
                            </div>
                            <div class="col-md-3 mb-3">
                                <input type="text" placeholder="Qty" name="cantidad<?php echo $clave; ?>" class="form-control">
                            </div>
                            <div class="col-md-3 mb-3">
                                <input type="text" placeholder="Unit Price" name="valor<?php echo $clave; ?>" class="form-control">
                            </div>
                        </div>
                    <?php
                          }endforeach;
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
                    ?>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label><?php echo $valor['value']; ?></label>
                            </div>
                            <div class="col-md-3 mb-3">
                                <input type="text" placeholder="Qty" name="cantidad<?php echo $valor['value']; ?>" class="form-control">
                            </div>
                            <div class="col-md-3 mb-3">
                                <input type="text" placeholder="Unit Price" name="valor<?php echo $valor['value']; ?>" class="form-control">
                            </div>
                        </div>
                    <?php
                                    endforeach;
                                endif;
                            endif;
                        endforeach;
                    ?>

                    <hr class="my-4 primary">

                    <div class="row">
                        <label class="mb-2 h5" style="margin-top: 2%; padding-bottom: 2%;" for="invoiceNumberInput">
                            In case of issuing an invoice with only a Total:
                        </label>

                        <div class="col-md-6 mb-3">
                            <label for="total_factura">Total Invoice</label>
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="text" placeholder="Price" name="total_factura" class="form-control">
                        </div>
                    </div>

                    <hr class="my-4 primary">

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
            <input type="hidden" name="fk_solicitud" value="<?php echo $id_revisar_solicitud;?>">
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
        <input type="hidden" name="fk_solicitud" value="<?php echo $id_revisar_solicitud;?>">
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
              <th>Seleccionar</th>
            </tr>
            <?php
            $solicitud_servicios_json = $controlador->getServicios($id_revisar_solicitud);
            $solicitud_servicios = json_decode($solicitud_servicios_json, true);
            foreach ($solicitud_servicios as $servicio) {
              $nombre_servicio = json_decode($servicio['servicios'], true);
              $id_servicios_adicionales = $servicio['id_servicios_adicionales'];
              foreach ($nombre_servicio as $clave => $valor) {
                $estado = $valor['estado'];
                $estado_texto = "";
                if($estado == 3){
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
              <input type="hidden" name="id_servicios_solicitados" value="<?php echo $id_servicios_adicionales ;?>"></td>
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
              <th>Seleccionar</th>
            </tr>
            <?php
            $solicitud_servicios_json = $controlador->getServicios($id_revisar_solicitud);
            $solicitud_servicios = json_decode($solicitud_servicios_json, true);
            foreach ($solicitud_servicios as $servicio) {
              $nombre_servicio = json_decode($servicio['servicios'], true);
              $id_servicios_adicionales = $servicio['id_servicios_adicionales'];
              foreach ($nombre_servicio as $clave => $valor) {
                $estado = $valor['estado'];
                $estado_texto = "";
                if($estado == 2){
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
              <input type="hidden" name="id_servicios_solicitados" value="<?php echo $id_servicios_adicionales ;?>"></td>
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
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="conjunto_sociedades[]" id="conjunto_sociedades">
        <input type="hidden" name="conjunto_personas[]" id="conjunto_personas">
        <input type="hidden" name="conjunto_clientes[]" id="conjunto_clientes">
        <form id="formCrearSociedad">
          <!-- Nombre de la Sociedad -->
          <div class="form-group">
            <label for="inputNombreSociedad">Nombre de la Sociedad</label>
            <input type="text" class="form-control" id="inputNombreSociedad" name="nombreSociedad" placeholder="Nombre de la sociedad">
          </div>

          <!-- Contenedor para las personas y porcentajes -->
          <div id="personasContainer">
            <!-- Primera Persona y Porcentaje -->
            <div class="form-group row">
              <div class="col-md-8">
                <label for="selectPersona">Persona Sociedad 1</label>
                <select class="form-control selectPersona" id='selectPersona' name="personas[]">
                  <option value="">Seleccionar persona</option>
                  <!-- Opciones dinámicas -->
                </select>
              </div>
              <div class="col-md-4">
                <label for="inputPorcentaje">Porcentaje</label>
                <input type="number" class="form-control" name="porcentajes[]" placeholder="Porcentaje" min="0" max="100">
              </div>
            </div>
          </div>

          <!-- Botón para agregar más personas -->
          <button type="button" class="btn btn-secondary" id="btnAgregarPersona">Agregar Persona</button>

          <!-- Input hidden -->
          <input type="hidden" id="hiddenInput" name="hiddenField" value="<?php echo $id_revisar_solicitud;?>">

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnGuardarSociedad" class="btn btn-primary">Guardar Sociedad</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        
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

<script>
    $(document).ready(function(){
        $('#btnGuardarPersonaCliente').click(function(e){        
            e.preventDefault(); // Previene el comportamiento por defecto del botón
            var datos = $('#frm_guardar_sociedad').serialize() + "&accion=guardarSociedad";
            var numeroSolicitud = $('#numeroSolicitud').val();
            console.log(datos);  // Verifica que los datos se están serializando correctamente
            $.ajax({
                type: "POST",
                url: "../controller/solicitudController.php",
                data: datos,
                success: function(r){
                    console.log(r);  // Verifica la respuesta del servidor
                    console.log('status=> ' ,r.status);  // Verifica la respuesta del servidor
                    if(r.status=='ok'){
                        alert("Persona Agregada con Exito :)");
                        // window.location.href = "verSolicitud.php?numero_solicitud="+numeroSolicitud;
                    }else{
                        alert("Error al intentar registrar el cliente, intentar de nuevo");
                    }
                    // if(r.resultado == 0) {
                    //     alert("fallo :(");
                    // }else{
                    //     alert("Persona Agregada con Exito :)");
                    //     // window.location.href = "registrarSolicitud.php";
                    // }
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
                        console.log(response);
                        Swal.fire({
                            title: '¡Éxito!',
                            text: '¡File Saved Successfully!',
                            icon: 'success',
                            confirmButtonText: 'Aceptar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'verSolicitud.php?numero_solicitud=<?php echo $id_revisar_solicitud;?>';
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
        dom: 'Bfrtip',
       
        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
        }
    });
});



$(document).ready(function(){
    $('#btnInsertarFactura').click(function(){
        var datos = $('#billingForm').serialize();
        datos += "&accion=insertarFactura"; // Añadir acción específica para el controlador
        console.log(datos); // Para depuración

        $.ajax({
            type: "POST",
            url: "../controller/solicitudController.php",
            data: datos,
            success: function(r){
                console.log(r); // Para depuración
                if(r.resultado == 0){
                    alert("Fallo en la inserción de la factura.");
                } else {
                    alert("Factura insertada con éxito.");
                    window.location.href = 'verSolicitud.php?numero_solicitud=<?php echo $id_revisar_solicitud;?>';
                }
            },
            error: function(){
                alert("Error en la comunicación con el servidor.");
            }
        });
        return false;
    });
});

$(document).ready(function() {
        $.ajax({
            url: '../controller/solicitudController.php', // Ajusta el path según sea necesario
            method: 'POST',           
            data: { action: 'listarServicios' },
            dataType: 'json',
            success: function(response) {
                var serviciosDiv = $('.nuevos_servicios');
                
                serviciosDiv.empty(); // Limpiar cualquier contenido previo

                // Contenedor principal
                var servicioHtml = '<div class="row">';

                // Contador para los elementos
                var counter = 0;
                var counter_list =1 ;

                $.each(response, function(index, servicio) {
                    // Si el contador es múltiplo de 15, cerrar la columna actual y abrir una nueva
                    if (counter % 15 === 0) {
                        // No agregar '</div>' al principio
                        if (counter !== 0) {
                            servicioHtml += '</div>';
                        }
                        servicioHtml += '<div class="col-lg-4 col-md-6 col-sm-12">';
                    }

                    // Agregar el elemento
                    servicioHtml += '<div class="custom-control custom-checkbox">';
                    servicioHtml += '<input type="checkbox" class="custom-control-input" id="' + servicio.servicio_name + '" name="' + servicio.servicio_name + '" value="' + servicio.nombre_servicio + '">';
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
 $(document).ready(function(){
      $('#btnServiciosAdicionales').click(function(){        
          var datos = $('#formulario-insertar-servicios').serialize()+ "&accion=insertarServiciosAdicionales";
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
                    window.location.href = 'verSolicitud.php?numero_solicitud=<?php echo $id_revisar_solicitud;?>';
                    
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
                    window.location.href = 'verSolicitud.php?numero_solicitud=<?php echo $id_revisar_solicitud;?>';
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
        console.log("idSolicitud definido: ", idSolicitud);
        // Solicitud AJAX para obtener las actas
        $.ajax({
            url: '../controller/obtenerActasController.php',
            method: 'POST',
            data: { action: 'obtenerActas', id_solicitud: idSolicitud },
            dataType: 'json',
            success: function(response) {
                console.log("Respuesta del servidor: ", response);
                if (response.status === 'success') {
                    let acta = response.data;
                    let tbody = $('#actas tbody');
                    tbody.empty();

                    let row = `
                        <tr>
                            <td>${acta.fecha}</td>
                            <td>
                                <button class="btn btn-primary ver-html" data-id_solicitud="${idSolicitud}">Ver HTML</button>
                                <button class="btn btn-success generar-pdf" data-id_solicitud="${idSolicitud}">Generar PDF</button>
                            </td>
                        </tr>
                    `;
                    tbody.append(row);

                    // Adjuntar manejadores de eventos
                    $('.ver-html').on('click', function() {
                        let idSolicitud = $(this).data('id_solicitud');
                        console.log("Ver HTML solicitado para id_solicitud:", idSolicitud); // Asegúrate de que este valor es correcto

                        // Solicitud AJAX para obtener el contenido HTML
                        $.ajax({
                            url: '../controller/obtenerActasController.php',
                            method: 'POST',
                            data: { action: 'obtenerActas', id_solicitud: idSolicitud },
                            dataType: 'json',
                            success: function(response) {
                                console.log("Respuesta de Ver HTML: ", response); // Depurar la respuesta

                                if (response.status === 'success') {
                                    $('#modalHtml .modal-body').html(response.data.contenido_html); // Debe ser 'response.html'
                                    $('#modalHtml').modal('show');
                                } else {
                                    alert(response.message);
                                }
                            },
                            error: function() {
                                alert('Error al obtener el contenido HTML.');
                            }
                        });
                    });

                    $('.generar-pdf').on('click', function() {
                        let idSolicitud = $(this).data('id_solicitud');
                        console.log("Generar PDF solicitado para id_solicitud:", idSolicitud);

                        // Solicitud AJAX para generar el PDF
                        $.ajax({
                            url: '../controller/obtenerActasController.php',
                            method: 'POST',
                            data: { action: 'generarPdf', id_solicitud: idSolicitud },
                            dataType: 'json',
                            success: function(response) {
                                console.log("Respuesta de Generar PDF: ", response);

                                if (response.status === 'success') {
                                    // Abrir el PDF en una nueva pestaña
                                    window.open(response.pdf_url, '_blank');
                                } else {
                                    alert(response.message);
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error("Error en la solicitud AJAX para generar PDF:", xhr.responseText);
                                alert('Error al generar el PDF.');
                            }
                        });
                    });
                } else {
                    alert(response.message);
                }
            },
            error: function() {
                console.error('Error en la solicitud AJAX.');
                alert('Error al cargar las actas.');
            }
        });
    }
});

$('#guardarCambiosOrdenServicio').on('click', function() {
    var formData = $('#formActualizarOrdenServicio').serialize()+ "&accion=ActualizarServicio"; // Serializar los datos del formulario
    console.log('Datos que se envían:', formData); 
    $.ajax({
        url: '../controller/solicitudController.php',  // Ajusta la URL
        method: 'POST',
        data: formData,
        
        success: function(response) {
            alert('Servicios actualizados exitosamente.');
            location.reload();  // Recargar la página si es necesario
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
    });
});

$('#guardarCambiosServiciosFacturar').on('click', function() {
    var formData = $('#formActualizarServiciosFacturar').serialize()+ "&accion=ActualizarServicioFactura"; // Serializar los datos del formulario
    console.log('Datos que se envían:', formData); 
    $.ajax({
        url: '../controller/solicitudController.php',  // Ajusta la URL
        method: 'POST',
        data: formData,
        
        success: function(response) {
            alert('Servicios actualizados exitosamente.');
            location.reload();  // Recargar la página si es necesario
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
    });
});

$(document).ready(function(){
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
        success: function(response){
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

                // Print the invoice_number to the console
                
              
                // Validar si los campos son null y asignar 'N/A' si es el caso
                let createdAt = factura.created_at ? factura.created_at : 'N/A';
                let rutaPago = factura.ruta_pago ? factura.ruta_pago : 'N/A';
                let tipoConsignacion = factura.tipo_consignacion ? factura.tipo_consignacion : 'N/A';
                let notaPago = factura.nota_pago ? factura.nota_pago : 'N/A';

             

                // Construir la fila
                let fila = "<tr><td>" + createdAt + "</td><td> <a href='factura_report.php?numero_solicitud=<?php echo $id_revisar_solicitud;?>&invoiceNumber="+invoiceNumber+"' target='_blank' rel='noopener noreferrer'>Descargar </a></td><td><a href='../controller/resource/<?php echo $id_revisar_solicitud;?>/" + rutaPago + "'target='_blank' rel='noopener noreferrer'>Descargar Comprobante</a></td><td>" + tipoConsignacion + "</td><td>" + notaPago + "</td></tr>";
                
                // Agregar la fila al tbody
                $('#facturasDownload').append(fila);
            });
        },
        error: function(xhr, status, error){
            console.error('Error:', error);
        }
    });
});

$(document).ready(function() {
    // Función para cargar las opciones en cualquier select de personas
    function cargarPersonas(selectElement) {
        $.ajax({
            url: '../controller/sociedadController.php',
            type: 'GET',
            data: { accion: 'getSociedades', idSolicitud: '<?php echo $id_revisar_solicitud; ?>' },
            dataType: 'json',
            success: function(data) {
                console.log('Respuesta del servidor:', data); // Depuración
                selectElement.empty();
                selectElement.append('<option value="">Selecciona una Persona</option>');
                $.each(data, function(index, item) {
                    var idSociedad;
                    if(item.uuid === null && item.idcliente === 0){
                        idSociedad = item.id_sociedad;
                    }else if(item.uuid === null && item.id_sociedad === 0){
                        idSociedad = item.idcliente;
                    }else if(item.id_sociedad === 0 && item.idcliente === 0){
                        idSociedad = item.uuid;
                    }
                    // var idSociedad = item.uuid === null ? item.id_sociedad : item.uuid;
                    selectElement.append('<option value="' + idSociedad + '" data-id="' + item.tipo + '"  >' + item.nombre + '</option>');
                });
            },
            error: function(xhr, status, error) {
                console.error('Error en la solicitud AJAX:', status, error);
                console.log('Respuesta del servidor:', xhr.responseText);
                alert('Error al cargar las opciones');
            }
        });
    }

    
    // Cargar personas en el primer select de personas
    cargarPersonas($('#personasContainer').find('select').first());

    // Función para agregar nuevos campos de persona y porcentaje
    var personaIndex = 2; // Comienza en 2 porque ya tienes una persona por defecto
    $('#btnAgregarPersona').click(function() {
        var nuevoCampo = `
        <div class="form-group row">
            <div class="col-md-8">
                <label for="selectPersona${personaIndex}">Persona Sociedad ${personaIndex}</label>
                <select class="form-control selectPersona" name="personas[]">
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
        cargarPersonas(nuevoSelect); // Cargar las opciones en el nuevo select
        personaIndex++;
    });

    function generateUUID() {
        return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
            var r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
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
        var conjunto_personas   = document.getElementById('conjunto_personas').value;
        var nombreSociedad = '{' + conjunto_sociedades + '}'; 

        var conjunto_clientes = '{' + document.getElementById('conjunto_clientes').value + '}'; 

        // Si todo está bien, serializar los datos del formulario
        var datosFormulario = $('#formCrearSociedad').serialize() + '&conjuntopersonas=' + conjunto_personas + '&conjuntoclientes=' + conjunto_clientes + '&sociedades=' + nombreSociedad  +'&uuid=' + uuid + '&accion=crearSociedad';
        // console.log('Datos enviados:', datosFormulario);
        // console.log('============');
        // console.log('conjunto_sociedades:', nombreSociedad); 

        // Envío de datos con AJAX
        $.ajax({
            type: 'POST',
            url: '../controller/solicitudController.php',  // Ruta hacia el controlador PHP
            data: datosFormulario,
            success: function(response) {
                console.log('Respuesta del servidor:', response);
                var resultado = JSON.parse(response);
                if (resultado.status === 0) {
                    alert('Sociedad creada exitosamente');
                    $('#modalCrearSociedad').modal('hide');
                    location.reload();
                } else {
                    alert('Error al crear la sociedad');
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

$(document).on('change', '.selectPersona', function() {
    var selectedUUIDs  = [];
    var selectedUUIDs2 = [];
    var selectedUUIDs3 = [];
    $('.selectPersona').each(function() {
        var selectedValue = $(this).val();
        var selectedTipo  = $(this).find('option:selected').data('id');
        // alert(selectedTipo);
        if (selectedValue) {
            if(selectedTipo == 'sociedad'){
                selectedUUIDs.push(selectedValue);
            }else if(selectedTipo == 'miembro'){
                selectedUUIDs2.push(selectedValue);
            }else if(selectedTipo == 'cliente'){
                selectedUUIDs3.push(selectedValue);
            }
        }
        // if (selectedValue) {
        //     if(selectedValue.length > 2) {
        //         selectedUUIDs.push(selectedValue);
        //     }else{
        //         selectedUUIDs2.push(selectedValue);
        //     }
        // }
    });
    $('#conjunto_sociedades').val(selectedUUIDs.join(','));
    $('#conjunto_personas').val(selectedUUIDs2.join(','));
    $('#conjunto_clientes').val(selectedUUIDs3.join(','));
    
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
            $.each(data, function(index, item) {
                select.append('<option value="' + item.uuid + '">' + item.nombre_sociedad + '</option>');
            });
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
            
                data: { action: 'listarTipoPago' },
                dataType: 'json',
        success: function(data) {
            var select = $('#descripcion_tipo_docuemnto_adjunto');
            select.empty();
            $.each(data, function(index, item) {
                select.append('<option value="' + item.id_tipo_documento_adjunto + '">' + item.nombre_documento_adjunto + '</option>');
            });
        },
        error: function(xhr, status, error) {
            console.error('Error fetching data: ', error);
        }
    });
});

$(document).ready(function() {
    // Fetch data for the new select element
    $.ajax({
        url: '../controller/terceros_controller.php', // Cambia esto por la ruta correcta a tu controlador
        type: 'POST',
        data: { action: 'listarTipoPago' },
        dataType: 'json',
        success: function(data) {
            var select = $('#nombreTercero');
            select.empty();
            $.each(data, function(index, item) {
                select.append('<option value="' + item.id_terceros + '">' +item.nombre_tercero + '</option>');
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
        processData: false,  // Necesario para enviar archivos
        contentType: false,  // Necesario para enviar archivos
        success: function(response) {
            console.log('Response from server:', response);
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
                    htmlContent += '<td><a href='+item.factura+' class="btn btn-danger" target="_blank"><i class="fa fa-download"></i></td>';
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