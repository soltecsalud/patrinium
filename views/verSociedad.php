<?php
include_once "../controller/getBancosController.php";

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
            <table class="table table-striped">
                
                <tbody>
                    
                    <th scope="col"  style="text-align: center;">Numero sociedad</th>
                        <td>123456789</td>
                        <th scope="col"  style="text-align: center;">Fecha Creacion</th>
                        <td>01/03/2024</td>
                        <th>Estado de la Sociedad</th> 
                        <td>Activo</td> 
                    <tr>
                        <th >Nombre de la Sociedad</th>
                        <td>green sas</td>
                        <th >Referencia de la Sociedad</th>                      
                        <td>12345678</td>
                        <th>Número de Registro</th>                      
                        <td>12345678</td>
                        
                        
                    </tr>
                    <tr>
                        <th>País de la Sociedad</th>
                        <td>Estados Unidos</td>
                        <th>Estado (solo USA)</th>                      
                        <td>Florida</td>
                              
                        <th>Cantidad de Socios</th>    
                        <th>3</th>                   
                        
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!--socios-->
    <div class="card card-primary collapsed-card">
        <div class="card-header">
            <h3 class="card-title">Datos Socios</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#miModal">
                    Crear Socio
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
    <!--Bancos-->
    <div class="card card-primary collapsed-card">
        <div class="card-header">
            <h3 class="card-title">Datos Bancarios</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#bancos">
                    Asignar banco
                </button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          
          <table id="tablaBancos" class="table table-bordered table-striped">
                  <thead>
                      <tr>
                          <th>Nombre Banco</th>
                          <th>Cuenta Banco</th>
                          <th>Titular Cuenta</th>
                          <th>Tipo Banco</th>                                           
                      </tr>
                  </thead>
                  <tbody>                  
                        <?php 
                        $controlador = new getBancos();
                        $bancosSociedades = $controlador->getBancosSociedad();
                        //print_r($bancosSociedades);
                         
                        foreach($bancosSociedades as $bancosSociedad){
                        ?>
                            <tr>
                                <td><?php echo htmlspecialchars($bancosSociedad['nombre_banco']); ?></td>
                                <td><?php echo htmlspecialchars($bancosSociedad['cuenta_banco']); ?></td>
                                <td><?php echo htmlspecialchars($bancosSociedad['titular_cuenta']); ?></td>
                                <td><?php echo htmlspecialchars($bancosSociedad['tipo_cuenta']); ?></td>
                                
                            </tr>
                        <?php }?>
                   </tbody>
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