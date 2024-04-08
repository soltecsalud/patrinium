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
                    <h3>Revisar Solicitud
</h3>
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