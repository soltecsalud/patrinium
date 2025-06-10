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
    <title>Registrar ESE x</title>
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
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#upload_archivos">
                    Adjuntar Revision
                </button>
                        </div>
                    </div>
                    <div class="card-body">
                        
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
                                            // Asegurándonos de que $solicitud es un objeto antes de intentar acceder a sus propiedades
                                            if (is_object($solicitud)) {
                                                echo "<h3>Nombre Cliente: " . htmlspecialchars($solicitud->nombre_cliente) . "</h3>";
                                                echo "<h3>Referido Por: " . htmlspecialchars($solicitud->referido_por) . "</h3><br>";
                                                echo "<h5>Necesidad: " . htmlspecialchars($solicitud->necesidad) . "</h5><br>";
                                            }
                                            else {
                                                echo "No se encontraron solicitudes.";
                                            }
                                        } 
                                    }
                                    ?>                      
                                                      
                                   
                                   
                                   
                                    </div>
                                </div>
                        </div>
                        <div class="card-body">
                        
                        <div class="card card-info card-outline shadow-none p-0">
                            <div class="card-header">
                                <h3 class="card-title">Datos Persona</h3>
                            </div>
                                <div class="card-body">
                                    hola
                                </div>
                            </div>
                        </div>  <!--Fin Tabal Persona-->
                                <!--tabla documentos descargables-->
                                <div class="card-body">
                                    <div class="card-header">
                                        <h3 class="card-title">Documentos Descargar</h3>
                                    </div>
                                  

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
                                            <?php 
                                            
                                            $verificar_documento = $controlador->validarDocumento($id_revisar_solicitud);
                                           
                                            if($verificar_documento == 1){
                                                
                                            ?>
                                              
                                               
                                           
                                         
                                    <div class="card-body">
                                        <div class="card-header">
                                            <h3 class="card-title">Creacion de factura</h3>
                                        </div>
                                            <?php 
                                              $verificar_factura = $controlador->validarFactura($id_revisar_solicitud);
                                                
                                                if($verificar_factura == 1){?>
                                                  
                                                    <a href="factura_report.php?numero_solicitud=<?php echo $id_revisar_solicitud;?>" class="btn btn-danger" target="_blank" rel="noopener noreferrer">Invoice</a>
                                               <?php }
                                              
                                              else{
                                            ?>
                                    <div class="container mt-4">
                                           
                                            
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

                                                        ?>
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
                                                       
                                                        <label class="text-center mb-2" style="font-size: smaller;" for="invoiceNumberInput">
                                                            TAX:
                                                        </label>
                                                        <input type="text" class="form-control" id="tax" name="tax" placeholder="Enter TAX">
                                                    </div>
                                                    <div class="row mt-4">
                                                        <div class="col-md-4">                                                            
                                                            <label class="text-center mb-2" style="font-size: smaller;" for="invoiceNumberInput">
                                                                Email:
                                                            </label>
                                                            <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email">
                                                        </div>
                                                        <div class="col-md-4">                                                            
                                                            <label class="text-center mb-2" style="font-size: smaller;" for="invoiceNumberInput">
                                                                Adress:
                                                            </label>
                                                            <input type="text" class="form-control" id="adress" name="adress" placeholder="Enter adress">
                                                        </div>
                                                        <div class="col-md-4">                                                            
                                                            <label class="text-center mb-2" style="font-size: smaller;" for="invoiceNumberInput">
                                                                Number TAX:
                                                            </label>
                                                            <input type="text" class="form-control" id="numberTax" name="numberTax" placeholder="Enter tax number">
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                <hr class="my-4 primary" > 

                                                    <div class="row">
                                                        <label class="mb-2 h5" style="margin-top: 2%; padding-bottom: 2%;" for="invoiceNumberInput">
                                                            Billing Services:
                                                        </label>
                                                       
                                                    </div>
                                                                            

                                                    <?php
                                                        $servicios = $controlador->getServicios($id_revisar_solicitud);
                                                        //print_r($servicios);
                                                    

                                                   //Servicios desde JSONb 

                                                          
                                                            // foreach ($servicios as $servicio): ?>
                                                                    <?php if (!empty($servicio['servicios'])): ?>
                                                                        <?php
                                                                        // Decodificar el JSONB
                                                                        $datos = json_decode($servicio['servicios'], true);

                                                                        // Verificar si la decodificación fue exitosa
                                                                        if ($datos) {
                                                                            // Iterar sobre cada par clave-valor del JSONB
                                                                            foreach ($datos as $clave => $valor) {
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
                                                                            }
                                                                        } else {
                                                                            // Si no se pudo decodificar el JSONB, imprimir un mensaje de error
                                                                            ?>
                                                                            
                                                                                <h4>Error al decodificar el JSONB</h4>
                                                                          
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    <?php endif; ?>
                                                                
                                                                <hr class="my-4 primary" > 
                                                                    <div class="row"> 
                                                                            <label class="mb-2 h5" style="margin-top: 2%; padding-bottom: 2%;" for="invoiceNumberInput">
                                                                                In case of issuing an invoice with only a Total:
                                                                            </label>
                                                                            
                                                                                        <div class="col-md-6 mb-3">
                                                                                            <label for="nombreSociedad">Total Invoice</label>
                                                                                        </div>
                                                                                       
                                                                                        <div class="col-md-6 mb-3">
                                                                                            <input type="text" placeholder="Price" name="total_factura" class="form-control" >
                                                                                        </div>
                                                                                        <hr class="my-4 primary" > 
                                                                                    </div>
                                                                    </div>
                                                                    <div class="row" style="margin-bottom: 3%;">
                                                                            <label class="mb-2 h5" style="margin-top: 2%; padding-bottom: 2%;" for="invoiceNumberInput">
                                                                                Observations:
                                                                            </label>
                                                                        <div class="col-12">
                                                                            <textarea class="form-control" rows="5" name="observaciones" id="exampleTextarea" placeholder="write something here"></textarea>
                                                                        </div>
                                                                    </div>
                                                                  
                                                                <div class="row">
                                                                 
                                                                        <input type="hidden" name="id_solicitud" value="<?php echo $id_revisar_solicitud;?>">
                                                                        <button type="button" id="btnInsertarFactura" style="margin-bottom: 1%;" class="btn btn-primary">Insert Invoice</button>
                                                                    
                                                               
                                                                       
                                                                   
                                                                        
                                                                        
                                                                </div>                     
                                                
                                            </form>
                                            <?php } } else{
                                                echo "<div class='alert alert-danger' role='alert'>NO Existe Documento Para Insertar Factura</div>";
                                            }  ?>
                                        </div>
                                        
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
          >   
    
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
                                window.location.href = 'ver_solicitud_adjuntos.php'; // Redireccionar a la página de solicitud adjuntos
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
</script>
