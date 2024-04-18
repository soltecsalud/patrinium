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
                        <form action="" method="post">
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
                                <!--tabla documentos descargables-->
                                <div class="card-body">
                                   
                                   <h1>Documentos Descargar</h1>

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

                                <div class="card-body">
                                   
                                   <h1>Creacion de factura</h1>
                                   <div class="container mt-4">
                                        
                                        <form id="billingForm">
                                            <div class="form-group">
                                                <label for="documentList">Selecciona los Items:</label>
                                                <div class="form-check">
                                                    <input class="form-check-input document-item" type="checkbox" name="minutes" value="35" data-description="Minutes of the First Meeting" id="document1">
                                                    <label class="form-check-label" for="document1">
                                                        Minutes of the First Meeting
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input document-item" type="checkbox" name="meeting" value="50" data-description="Minutes Meeting of the Assembly of Member" id="document1">
                                                    <label class="form-check-label" for="document1">
                                                    Minutes Meeting of the Assembly of Member
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input document-item" type="checkbox" name="operating" value="50" data-description="Operating Agreement Real State" id="document1">
                                                    <label class="form-check-label" for="document1">
                                                        Operating Agreement Real State 
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input document-item" type="checkbox" value="50" name="power" data-description="Power of Attorney" id="document2">
                                                    <label class="form-check-label" for="document2">
                                                        Power of Attorney
                                                    </label>
                                                </div>

                                                <div class="form-check">
                                                    <input class="form-check-input document-item" type="checkbox" name="register" value="106" data-description="Register of Members" id="document3">
                                                    <label class="form-check-label" for="document3">
                                                        Register of Members
                                                    </label>
                                                </div>

                                                <div class="form-check">
                                                    <input class="form-check-input document-item" type="checkbox" value="34" data-description="STATEMENT OF MANAGING MEMBER" name="statement" id="document4">
                                                    <label class="form-check-label" for="document4">
                                                        STATEMENT OF MANAGING MEMBER
                                                    </label>
                                                </div>

                                              

                                                <div class="form-check">
                                                    <input class="form-check-input document-item" type="checkbox" name="company" value="36" data-description="Company Information Details" id="document6">
                                                    <label class="form-check-label" for="document6">
                                                        Company Information Details
                                                    </label>
                                                </div>

                                                <div class="form-check">
                                                    <input class="form-check-input document-item" type="checkbox" value="37" name="certificate" data-description="Certificate of Formation Washington USA LLC" id="document7">
                                                    <label class="form-check-label" for="document7">
                                                        Certificate of Formation Washington USA LLC
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group mt-3">
                                                <button type="button" id="btnInsertarFactura" class="btn btn-primary" onclick="calculateTotal()">Calcular Total</button>
                                            </div>
                                            <div id="totalDetails" class="mt-2">
                                                <!-- Los inputs y labels generados se colocarán aquí -->
                                            </div>
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
    $('#archivoInput').change(function() {
    var fileName = $(this).val();
    console.log('Archivo seleccionado:', fileName);
});
</script>
<script>
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
                alert("¡AJAX ejecutado con éxito!");
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

/*function calculateTotal() {
    const container = document.getElementById('totalDetails');
    container.innerHTML = ''; // Limpiar contenido anterior
    let total = 0;
    document.querySelectorAll('.document-item:checked').forEach((item, index) => {
        total += parseInt(item.value);
        const wrapper = document.createElement('div');
        wrapper.className = 'form-group';

        const label = document.createElement('label');
        label.textContent = item.dataset.description + ':';
        label.htmlFor = 'docValue' + index;

        const input = document.createElement('input');
        input.type = 'text';
        input.className = 'form-control';
        input.id = 'docValue' + index;
        input.name = 'documentValues[]';
        input.readOnly = true;
        input.value = item.dataset.description + ': ' + item.value + '  USD';

        wrapper.appendChild(label);
        wrapper.appendChild(input);
        container.appendChild(wrapper);
    });

    // Agregar total al final
    const totalWrapper = document.createElement('div');
    totalWrapper.className = 'form-group';
    
    const totalLabel = document.createElement('label');
    totalLabel.textContent = 'Total:';
    
    const totalInput = document.createElement('input');
    totalInput.type = 'text';
    totalInput.className = 'form-control';
    totalInput.readOnly = true;
    totalInput.value = total + ' USD';

    totalWrapper.appendChild(totalLabel);
    totalWrapper.appendChild(totalInput);
    container.appendChild(totalWrapper);
}*/
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
