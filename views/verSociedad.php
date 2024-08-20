<?php

require_once "../controller/solicitudController.php";

$id_revisar_solicitud = $_GET['id_solicitud'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once "head/head_views.php"; ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <!-- hoja de estilo para los datatable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/plug-ins/preview/searchPane/dataTables.searchPane.min.css">
    <!-- hoja de estilo para el SearchPane del datatable -->
    <link rel="stylesheet" href="css/dataTableSearchPanes.css">
    <!-- hoja de estilo personalizada para searchPane -->
    <link rel="stylesheet" href="css/estilos generales.css">
    <!-- Incluye Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <!-- Incluye Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
</head>
<body>
<div class="container">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Datos Principales Sociedad</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
                     <?php
                        $sociedad_controller = new Solicitud_controller();

                        $fila = $sociedad_controller->getSociedad($id_revisar_solicitud);

                      
                    ?>
            <table class="table table-striped">
                
                
                <tbody>
                   
                <tr>
                            <th scope="col" style="text-align: center;">ID Solicitud</th>
                            <td><?php echo $fila[0]['id_sociedad']; ?></td>
                            <th scope="col" style="text-align: center;">Nombre</th>
                            <td><?php echo $fila[0]['nombre']; ?></td>
                            <th scope="col" style="text-align: center;">Apellido</th>
                            <td><?php echo $fila[0]['apellido']; ?></td>
                            <th scope="col" style="text-align: center;">Fecha de Nacimiento</th>
                            <td><?php echo $fila[0]['fecha_nacimiento']; ?></td>
                        </tr>
                        <tr>
                            <th scope="col" style="text-align: center;">Estado Civil</th>
                            <td><?php echo $fila[0]['estado_civil']; ?></td>
                            <th scope="col" style="text-align: center;">País de Origen</th>
                            <td><?php echo $fila[0]['pais_origen']; ?></td>
                            <th scope="col" style="text-align: center;">País de Residencia Fiscal</th>
                            <td><?php echo $fila[0]['pais_residencia_fiscal']; ?></td>
                            <th scope="col" style="text-align: center;">País de Domicilio</th>
                            <td><?php echo $fila[0]['pais_domicilio']; ?></td>
                        </tr>
                        <tr>
                            <th scope="col" style="text-align: center;">Número de Pasaporte</th>
                            <td><?php echo $fila[0]['numero_pasaporte']; ?></td>
                            <th scope="col" style="text-align: center;">País de Pasaporte</th>
                            <td><?php echo $fila[0]['pais_pasaporte']; ?></td>
                            <th scope="col" style="text-align: center;">Tipo de Visa</th>
                            <td><?php echo $fila[0]['tipo_visa']; ?></td>
                            <th scope="col" style="text-align: center;">Dirección Local</th>
                            <td><?php echo $fila[0]['direccion_local']; ?></td>
                        </tr>
                        <tr>
                            <th scope="col" style="text-align: center;">Teléfonos</th>
                            <td><?php echo $fila[0]['telefonos']; ?></td>
                            <th scope="col" style="text-align: center;">Emails</th>
                            <td><?php echo $fila[0]['emails']; ?></td>
                            <th scope="col" style="text-align: center;">Industria</th>
                            <td><?php echo $fila[0]['industria']; ?></td>
                            <th scope="col" style="text-align: center;">Nombre del Negocio Local</th>
                            <td><?php echo $fila[0]['nombre_negocio_local']; ?></td>
                        </tr>
                        <tr>
                            <th scope="col" style="text-align: center;">Ubicación del Negocio Principal</th>
                            <td><?php echo $fila[0]['ubicacion_negocio_principal']; ?></td>
                            <th scope="col" style="text-align: center;">Tamaño del Negocio</th>
                            <td><?php echo $fila[0]['tamano_negocio']; ?></td>
                            <th scope="col" style="text-align: center;">Contacto Ejecutivo Local</th>
                            <td><?php echo $fila[0]['contacto_ejecutivo_local']; ?></td>
                            <th scope="col" style="text-align: center;">Número de Empleados</th>
                            <td><?php echo $fila[0]['numero_empleados']; ?></td>
                        </tr>
                        <tr>
                            <th scope="col" style="text-align: center;">Número de Hijos</th>
                            <td><?php echo $fila[0]['numero_hijos']; ?></td>
                            <th scope="col" style="text-align: center;">Razón de Consultoría</th>
                            <td><?php echo $fila[0]['razon_consultoria']; ?></td>
                            <th colpan="2" scope="col" style="text-align: center;">Requiere Registro de Corporación</th>
                            <td colpan="2"><?php echo $fila[0]['requiere_registro_corporacion']; ?></td>
                         
                        </tr>
                        <tr>
                            <th scope="col" style="text-align: center;">Observaciones</th>
                            <td><?php echo $fila[0]['observaciones']; ?></td>
                          
                        </tr>
                </tbody>
            </table>

            <?php
                                                      
                                                        $servicios = $controlador->getServicios($id_revisar_solicitud);
                                                        //print_r($servicios);
                                                    

                                                   //Servicios desde JSONb 

                                                          
                                                            foreach ($servicios as $servicio): ?>
                                                                    <?php if (!empty($servicio['servicios'])): ?>
                                                                        <?php
                                                                        // Decodificar el JSONB
                                                                        $datos = json_decode($servicio['servicios'], true);

                                                                        // Verificar si la decodificación fue exitosa
                                                                        if ($datos) {
                                                                            // Iterar sobre cada par clave-valor del JSONB
                                                                            foreach ($datos as $clave => $valor) {
                                                                                ?>
                                                                              
                                                                             
                                                                                    <li class="col-md-6 mb-3">
                                                                                        <label><?php echo $valor; ?></label>
                                                                                    </li>
                                                                           
                                                                                    
                                                                                <?php
                                                                            }
                                                                        } else {
                                                                            // Si no se pudo decodificar el JSONB, imprimir un mensaje de error
                                                                            ?>
                                                                            
                                                                                <h4>Error al decodificar el JSONB</h4>
                                                                          
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    <?php endif; ?>
                                                                <?php endforeach; ?>
                                                                <?php foreach ($servicios as $servicio_adicionales): ?>
                                                                    <?php if (!empty($servicio['servicios_adicionales'])): ?>
                                                                        <?php
                                                                        // Decodificar el JSONB
                                                                        $datos_adicionales = json_decode($servicio['servicios_adicionales'], true);

                                                                        // Verificar si la decodificación fue exitosa
                                                                        if ($datos_adicionales) {
                                                                           
                                                                            // Iterar sobre cada par clave-valor del JSONB
                                                                            foreach ($datos_adicionales as $clave => $valor) {
                                                                               
                                                                                ?>
                                                                             
                                                                              
                                                                                    <li class="col-md-6 mb-3">
                                                                                        <label><?php echo $valor; ?></label>
                                                                                    </li>
                                                                                   
                                                                              
                                                                                
                                                                                <?php
                                                                            }
                                                                        } 
                                                                        ?>
                                                                    <?php endif; ?>
                                                                <?php endforeach; ?>
                                   
        </div>
        <!-- /.card-body -->
    </div>
    
     <!--ESTRUCTURA CORPORATIVA-->
     <div class="card card-primary collapsed-card">
        <div class="card-header">
            <h3 class="card-title">Estructura Corporativa</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
        <form>
                    <div class="form-group">
                        <label for="tipoTrust">Tipo de Trust</label>
                        <select id="tipoTrust" class="form-control">
                            <option value="" disabled selected>Selecciona una opción</option>
                            <option value="Revocable">Revocable</option>
                            <option value="Irrevocable">Irrevocable</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="corporacionHolding">Corporación Holding LLC</label>
                        <select id="corporacionHolding" class="form-control">
                            <option value="" disabled selected>Selecciona una opción</option>
                            <option value="SI">SI</option>
                            <option value="NO">NO</option>
                            <option value="PROBABLE">PROBABLE</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="corporacionLLC1">Corporación LLC</label>
                        <select id="corporacionLLC1" class="form-control">
                            <option value="" disabled selected>Selecciona una opción</option>
                            <option value="Tenedora">Tenedora</option>
                            <option value="Operativa">Operativa</option>
                            <option value="Socia">Socia</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="corporacionLLC2">Corporación LLC</label>
                        <select id="corporacionLLC2" class="form-control">
                            <option value="" disabled selected>Selecciona una opción</option>
                            <option value="SI">SI</option>
                            <option value="NO">NO</option>
                            <option value="PROBABLE">PROBABLE</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="corporacionTerceros">Corporación en Terceros Países</label>
                        <select id="corporacionTerceros" class="form-control">
                            <option value="" disabled selected>Selecciona una opción</option>
                            <option value="SI">SI</option>
                            <option value="NO">NO</option>
                            <option value="PROBABLE">PROBABLE</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!--Corporacion sociedad-->
    <div class="card card-primary collapsed-card">
        <div class="card-header">
            <h3 class="card-title">Corporacion sociedad</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
               
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
        <table class="table table-striped">
                
              
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!--Facturas-->
    <div class="card card-primary collapsed-card">
        <div class="card-header">
            <h3 class="card-title">Facturas Agregadas</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#factura">
                   Insertar Factura
                </button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
        <table class="table table-striped">
                
              
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!--Documentos para Imprimir-->
    <div class="card card-primary collapsed-card">
        <div class="card-header">
            <h3 class="card-title">Documentos Para Imprimir</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
               
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
        <table class="table table-striped">
                
                <tbody>
                    
                    <th scope="col" colspan="8" style="text-align: center;">Documentos Generados</th>
                        
                       
                    <tr>
                        <th>Carta de entrega  llc MODELO</th>
                        <th>Company Information Details</th>
                        <th>Certificate of Formation Washington USA LLC</th>                      
                        <th>Minutes of the First Meeting</th>
                        <th>Minutes Meeting of the Assembly of Member</th>                      
                        <th>Operating Agreement Real State</th>
                        <th>Power of attorney</th>
                        <th>STATEMENT OF MANAGING MEMBER</th>
                    </tr>
                    <tr>
                        <td><a class="btn btn-danger"><i class="fa fa-file-pdf"></i></a></td>
                        <th><a class="btn btn-danger"><i class="fa fa-file-pdf"></i></a></th>                      
                        <th><a class="btn btn-danger"><i class="fa fa-file-pdf"></i></a></th>
                        <td><a class="btn btn-danger"><i class="fa fa-file-pdf"></i></a></td>
                        <th><a class="btn btn-danger"><i class="fa fa-file-pdf"></i></a></th>         
                        <td><a class="btn btn-danger"><i class="fa fa-file-pdf"></i></a></td>    
                        <th><a class="btn btn-danger"><i class="fa fa-file-pdf"></i></a></th>         
                        <td><a class="btn btn-danger"><i class="fa fa-file-pdf"></i></a></td>                   
                        
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!--Documentos Adjuntados-->
    <div class="card card-primary collapsed-card">
        <div class="card-header">
            <h3 class="card-title">Documentos Adjuntados</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#upload_archivos">
                    Adjuntar documento
                </button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
        <table class="table table-striped">
                
              
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>

<!-- Modal Socios -->
<div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Formulario Registrar Persona - Sociedad</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Aquí va el formulario -->
        <form id="formularioContacto">
          <div class="form-group">
            <label for="nombre">Nombre:</label>
            <select class="form-control select2" id="nombre" style="width: 100%;">
                <!-- Las opciones se cargarán dinámicamente -->
            </select>
          </div>
          <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" placeholder="Ingresa tu email">
          </div>
          <div class="form-group">
            <label for="mensaje">Mensaje:</label>
            <textarea class="form-control" id="mensaje" rows="3" placeholder="Escribe tu mensaje"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary" form="formularioContacto">Enviar</button>
      </div>
    </div>
  </div>
</div>
<!--Modal Bancos-->
<div class="modal fade" id="bancos" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Formulario Insercion Bancos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Aquí va el formulario -->
        <form id="formularioContacto">
          <div class="form-group">
            <label for="nombre">Nombre Banco:</label>
            <input type="email" class="form-control" id="email" placeholder="Ingrese El banco">
          </div>
          <div class="form-group">
            <label for="email">Cuenta No:</label>
            <input type="email" class="form-control" id="email" placeholder="Ingresa tu email">
          </div>
          <div class="form-group">
            <label for="mensaje">Firma:</label>
            <textarea class="form-control" id="mensaje" rows="3" placeholder="Escribe tu mensaje"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary" form="formularioContacto">Enviar</button>
      </div>
    </div>
  </div>
</div>
<!--Modal Factura-->
<div class="modal fade" id="factura" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Formulario Insertar Factura</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Aquí va el formulario -->
        <form id="formularioContacto">
          <div class="form-group">
            <label for="nombre">No Factura:</label>
            <input type="email" class="form-control" id="email" placeholder="Ingresa No factura">
          </div>
          <div class="form-group">
            <label for="email">Valor:</label>
            <input type="email" class="form-control" id="email" placeholder="Ingresa El Valor">
          </div>
          <div class="form-group">
            <label for="mensaje">Valor:</label>
            <textarea class="form-control" id="mensaje" rows="3" placeholder="Escribe tu mensaje"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary" form="formularioContacto">Enviar</button>
      </div>
    </div>
  </div>
</div>
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
                         <form>
                            <div class="form-group">
                                <label for="archivo">Seleccionar Archivo</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="archivo">
                                    <label class="custom-file-label" for="archivo">Elegir archivo</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="descripcion">Descripción del Archivo</label>
                                <input type="text" class="form-control" id="descripcion" placeholder="Ingrese una descripción">
                            </div>
                            <button type="submit" class="btn btn-primary">Cargar Archivo</button>
                        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        
      </div>
    </div>
  </div>
</div>
</body>
</html>
<?php include_once "footer/footer_views.php"; ?>
<script>
  
$(document).ready(function() {
    $('.select2').select2({
        ajax: {
            url: '../controller/cargarPersonaController.php', // Asegúrate de que esta ruta sea correcta
            dataType: 'json',
            processResults: function (data) {
                return {
                    results: $.map(data, function(obj) {
                        return { id: obj.id_persona, text: obj.nombres }; // Asegúrate de que obj.nombres exista
                    })
                };
            }
        }
    });
});
</script>
<script>
$(document).ready(function() {
    $('.select2_bancos').select2({
        ajax: {
            url: '../controller/cargarPersonaController.php', // Asegúrate de que esta ruta sea correcta
            dataType: 'json',
            processResults: function (data) {
                return {
                    results: $.map(data, function(obj) {
                        return { id: obj.id_persona, text: obj.nombres }; // Asegúrate de que obj.nombres exista
                    })
                };
            }
        }
    });
});
</script>
<script>
$(document).ready(function() {
    $('#tablaBancos').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: 'Datos de Personas',
                className: 'btn btn-success'
            },
            {
                extend: 'pdfHtml5',
                title: 'Datos de Personas',
                className: 'btn btn-danger'
            }
        ],
        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
        }
    });
});
</script>