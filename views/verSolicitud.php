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

                                   <table>
                                    <thead>
                                        <tr>
                                            <th>1</th>
                                            <th>2</th>
                                            <th>3</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>2</td>
                                            <td>3</td>
                                        </tr>
                                    </tbody>
                                   </table>
                                   
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

</script>