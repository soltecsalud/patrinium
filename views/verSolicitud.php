<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
    exit();
} elseif (isset($_SESSION['usuario']) && $_SESSION['configuracion'] === false) {
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
        .table-title  {
            text-align: left;
            color: #0066cc; /* Reemplaza con el color exacto del outline */
            font-weight: bold; /* Si quieres que los títulos estén en negrita */
        }

        /* También asegúrate de que los elementos de datos estén alineados a la izquierda */
        .table-data {
            text-align: left;
        }

        .card-serazo {
    width: 200px;
    height: 260px;
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
    font-size: 30px;
    color: #000000; /* Color negro */
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
    </style>
</head>

<body>
    <div class="content-wrapper">
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
                    echo "<span class='info-title'>Nombre Cliente:</span>";
                    echo "<span class='info-value'>" . htmlspecialchars($solicitud->nombre_cliente) . "</span>";
                    echo "</div>";

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
                        <div class="card-body">
                        
                            <div class="card card-info card-outline shadow-none p-0">
                                <div class="card-header">
                                    <h3 class="card-title">Datos Persona</h3>
                                </div>
                                    <div class="card-body">

                                        <table class="table table-striped">
                    
                                                <?php
                                                        $sociedad_controller = new Solicitud_controller();
                                                        $fk_persona = $solicitud->fk_persona;
                                                        $fila = $sociedad_controller->getSociedad($fk_persona);

                                                    
                                                    ?>
                                            <tbody>
                                            
                                            <tr>
                                                        <th scope="col" class="table-title" >ID Solicitud</th>
                                                        <td><?php echo $fila[0]['id_sociedad']; ?></td>
                                                        <th scope="col" class="table-title" >Nombre</th>
                                                        <td><?php echo $fila[0]['nombre']; ?></td>
                                                        <th scope="col" class="table-title" >Apellido</th>
                                                        <td><?php echo $fila[0]['apellido']; ?></td>
                                                        <th scope="col" class="table-title" >Fecha de Nacimiento</th>
                                                        <td><?php echo $fila[0]['fecha_nacimiento']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="col" class="table-title" >Estado Civil</th>
                                                        <td><?php echo $fila[0]['estado_civil']; ?></td>
                                                        <th scope="col" class="table-title" >País de Origen</th>
                                                        <td><?php echo $fila[0]['pais_origen']; ?></td>
                                                        <th scope="col" class="table-title" >País de Residencia Fiscal</th>
                                                        <td><?php echo $fila[0]['pais_residencia_fiscal']; ?></td>
                                                        <th scope="col" class="table-title" >País de Domicilio</th>
                                                        <td><?php echo $fila[0]['pais_domicilio']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="col" class="table-title" >Número de Pasaporte</th>
                                                        <td><?php echo $fila[0]['numero_pasaporte']; ?></td>
                                                        <th scope="col" class="table-title" >País de Pasaporte</th>
                                                        <td><?php echo $fila[0]['pais_pasaporte']; ?></td>
                                                        <th scope="col" class="table-title" >Tipo de Visa</th>
                                                        <td><?php echo $fila[0]['tipo_visa']; ?></td>
                                                        <th scope="col" class="table-title" >Dirección Local</th>
                                                        <td><?php echo $fila[0]['direccion_local']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="col" class="table-title" >Teléfonos</th>
                                                        <td><?php echo $fila[0]['telefonos']; ?></td>
                                                        <th scope="col" class="table-title" >Emails</th>
                                                        <td><?php echo $fila[0]['emails']; ?></td>
                                                        <th scope="col" class="table-title" >Industria</th>
                                                        <td><?php echo $fila[0]['industria']; ?></td>
                                                        <th scope="col" class="table-title" >Nombre del Negocio Local</th>
                                                        <td><?php echo $fila[0]['nombre_negocio_local']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="col" class="table-title" >Ubicación del Negocio Principal</th>
                                                        <td><?php echo $fila[0]['ubicacion_negocio_principal']; ?></td>
                                                        <th scope="col" class="table-title" >Tamaño del Negocio</th>
                                                        <td><?php echo $fila[0]['tamano_negocio']; ?></td>
                                                        <th scope="col" class="table-title" >Contacto Ejecutivo Local</th>
                                                        <td><?php echo $fila[0]['contacto_ejecutivo_local']; ?></td>
                                                        <th scope="col" class="table-title" >Número de Empleados</th>
                                                        <td><?php echo $fila[0]['numero_empleados']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="col"  class="table-title" >Número de Hijos</th>
                                                        <td><?php echo $fila[0]['numero_hijos']; ?></td>
                                                        <th scope="col"  class="table-title" >Razón de Consultoría</th>
                                                        <td><?php echo $fila[0]['razon_consultoria']; ?></td>
                                                        <th colpan="2" scope="col"  class="table-title" >Requiere Registro de Corporación</th>
                                                        <td colpan="2"><?php echo $fila[0]['requiere_registro_corporacion']; ?></td>
                                                    
                                                    </tr>
                                                    <tr>
                                                        <th scope="col" class="table-title">Observaciones</th>
                                                        <td><?php echo $fila[0]['observaciones']; ?></td>
                                                    
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
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalServicios">
                                                    Actualizar Estados
                                                </button>
                                            </div>
                                        
                                    </div>
                                        <div class="card-body">
                                                    <?php 
                                                    $solicitud_servicios = $controlador->getServicios($id_revisar_solicitud);
                                                    
                                                    $servicios = json_decode($solicitud_servicios[0]['servicios'], true);
                                                  

                                                    // Imprimir la lista ordenada
                                                    echo "<ol>";

                                                    if (!empty($servicios)) {
                                                        foreach ($servicios as $clave => $valor) {
                                                            echo "<li>" . htmlspecialchars($valor) . " " .  "</li>";
                                                        }
                                                    }

                                                   

                                                    echo "</ol>";
                                                    ?>
                                                    
                                                </div>
                                        </div>
                            </div>
                            <div class="col-md-6">
                            <div class="card card-info card-outline shadow-none p-0">
                                    <div class="card-header">
                                        <h3 class="card-title">Servicios Adicionales</h3>
                                    </div>
                                        <div class="card-body">
                                                    <?php 
                                                    
                                                    
                                                  
                                                    $servicios_adicionales = json_decode($solicitud_servicios[0]['servicios_adicionales'], true);

                                                    // Imprimir la lista ordenada
                                                    echo "<ol>";

                                                  

                                                    if (!empty($servicios_adicionales)) {
                                                        foreach ($servicios_adicionales as $clave => $valor) {
                                                            echo "<li>" . htmlspecialchars($valor) ."</li>";
                                                        }
                                                    }else{
                                                        echo "No hay servicios adicionales :(";
                                                    }

                                                    echo "</ol>";
                                                    ?>
                                                    
                                                </div>
                                        </div>
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
                <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Ingrese una descripción">
                <input type="hidden" class="form-control" value='<?php echo $id_revisar_solicitud?>'id="id_descripcion" name="id_solicitud" >
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
                <h5 class="modal-title" id="billingModalLabel">Insertar Servicios</h5>
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
                        $servicios = $controlador->getServicios($id_revisar_solicitud);
                        foreach ($servicios as $servicio):
                            if (!empty($servicio['servicios'])):
                                $datos = json_decode($servicio['servicios'], true);
                                if ($datos):
                                    foreach ($datos as $clave => $valor):
                    ?>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label><?php echo $valor; ?></label>
                            </div>
                            <div class="col-md-3 mb-3">
                                <input type="text" placeholder="Qty" name="cantidad<?php echo $clave; ?>" class="form-control">
                            </div>
                            <div class="col-md-3 mb-3">
                                <input type="text" placeholder="Unit Price" name="valor<?php echo $clave; ?>" class="form-control">
                            </div>
                        </div>
                    <?php
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
                    ?>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label><?php echo $valor; ?></label>
                            </div>
                            <div class="col-md-3 mb-3">
                                <input type="text" placeholder="Qty" name="cantidad<?php echo $valor; ?>" class="form-control">
                            </div>
                            <div class="col-md-3 mb-3">
                                <input type="text" placeholder="Unit Price" name="valor<?php echo $valor; ?>" class="form-control">
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
<!-- Modal actualizar servicios-->
<div class="modal fade" id="modalServicios" tabindex="-1" role="dialog" aria-labelledby="modalServiciosLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalServiciosLabel">Revisar y Actualizar Servicios</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="formServicios" action="tu_accion_de_actualizacion.php" method="POST">
        <div class="modal-body">
            <ol>
                <?php  
                // Decodificar las cadenas JSON
                $servicios = json_decode($solicitud_servicios[0]['servicios'], true);
                $servicios_adicionales = json_decode($solicitud_servicios[0]['servicios_adicionales'], true);

                // Verificar si las decodificaciones fueron exitosas
                if (json_last_error() !== JSON_ERROR_NONE) {
                    echo "Error al decodificar JSON: " . json_last_error_msg();
                }

                // Imprimir los servicios con sus checkboxes
                if (!empty($servicios)) {
                    foreach ($servicios as $clave => $valor) {
                        echo "<li>" . htmlspecialchars($valor);
                        echo "<div class='form-group'>";
                        echo "<div class='custom-control custom-checkbox custom-control-inline'>";
                        echo "<input type='checkbox' class='custom-control-input' id='pendiente-$clave' name='estado[$clave]' value='pendiente'>";
                        echo "<label class='custom-control-label' for='pendiente-$clave'>Pendiente</label>";
                        echo "</div>";
                        echo "<div class='custom-control custom-checkbox custom-control-inline'>";
                        echo "<input type='checkbox' class='custom-control-input' id='en_proceso-$clave' name='estado[$clave]' value='en_proceso'>";
                        echo "<label class='custom-control-label' for='en_proceso-$clave'>En Proceso</label>";
                        echo "</div>";
                        echo "<div class='custom-control custom-checkbox custom-control-inline'>";
                        echo "<input type='checkbox' class='custom-control-input' id='completado-$clave' name='estado[$clave]' value='completado'>";
                        echo "<label class='custom-control-label' for='completado-$clave'>Completado</label>";
                        echo "</div>";
                        echo "</div>";
                        echo "</li>";
                    }
                } else {
                    echo "No hay servicios disponibles.";
                }

                if (!empty($servicios_adicionales)) {
                    foreach ($servicios_adicionales as $clave => $valor) {
                        echo "<li>" . htmlspecialchars($valor);
                        echo "<div class='form-group'>";
                        echo "<div class='custom-control custom-checkbox custom-control-inline'>";
                        echo "<input type='checkbox' class='custom-control-input' id='pendiente-adicional-$clave' name='estado_adicional[$clave]' value='pendiente'>";
                        echo "<label class='custom-control-label' for='pendiente-adicional-$clave'>Pendiente</label>";
                        echo "</div>";
                        echo "<div class='custom-control custom-checkbox custom-control-inline'>";
                        echo "<input type='checkbox' class='custom-control-input' id='en_proceso-adicional-$clave' name='estado_adicional[$clave]' value='en_proceso'>";
                        echo "<label class='custom-control-label' for='en_proceso-adicional-$clave'>En Proceso</label>";
                        echo "</div>";
                        echo "<div class='custom-control custom-checkbox custom-control-inline'>";
                        echo "<input type='checkbox' class='custom-control-input' id='completado-adicional-$clave' name='estado_adicional[$clave]' value='completado'>";
                        echo "<label class='custom-control-label' for='completado-adicional-$clave'>Completado</label>";
                        echo "</div>";
                        echo "</div>";
                        echo "</li>";
                    }
                } else {
                    echo "No hay servicios adicionales disponibles.";
                }
                ?>
            </ol>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!--modal servicios--->
<div class="modal fade" id="modalSolicitud" tabindex="-1" aria-labelledby="modalSolicitudLabel" aria-hidden="true">
  <div class="modal-dialog" id="modal_nuevo_servicos">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalSolicitudLabel">Crear Solicitud</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formulario-solicitud">
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
            <button type="submit" id="btnCrearSolicitud" class="btn btn-primary" style="margin-top:1.5%;">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
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
$(document).ready(function(){
    $('#btnCrearSolicitud').click(function(event){
        event.preventDefault(); // Evitar que se envíe el formulario de forma predeterminada
        
        var datos = $('#formulario-solicitud').serialize() + "&accion=guardarSolicitud";
        console.log(datos);
        
        $.ajax({
            type: "POST",
            url: "../controller/solicitudController.php",
            data: datos,
            dataType: "json", // Suponiendo que el servidor devuelve un JSON
            success: function(r) {
                console.log(r);
                if (r.resultado == 0) {
                    alert("Fallo :(");
                } else {
                    alert("Agregado con éxito");
                    // Redirección a listar_empresa.php
                    window.location.href = 'listado_solicitudes.php';
                }
            },
            error: function(xhr, status, error) {
                console.error("Ocurrió un error: " + error);
                console.log(xhr.responseText);
            }
        });
        
        return false;
    });
    
    $('#agregarCampo').click(function(){
        var campoHTML = '<div class="form-group"><input type="text" name="campo[]" class="form-control" placeholder="Ingrese valor"></div>';
        $('#contenedorCampos').append(campoHTML);
    });
});
</script>