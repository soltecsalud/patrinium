<?php
session_start();session_start();
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
    <!-- hoja de estilo para los datatable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/plug-ins/preview/searchPane/dataTables.searchPane.min.css">
    <!-- hoja de estilo para el SearchPane del datatable -->
    <link rel="stylesheet" href="css/dataTableSearchPanes.css">
    <!-- hoja de estilo personalizada para searchPane -->
    <link rel="stylesheet" href="css/estilos generales.css">
    <title>Listado de Solicitudes</title>
</head>
<body>
    <div class="container-fluid h-100" >
        <div class="card card-dark  h-100">
            <div class="card-header">
                <h3 class="card-title">Listado de Solicitudes </h3>
                <div class="card-tools">
                    <?php echo date('Y-m-d'); ?>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize">
                        <i class="fas fa-expand"></i>
                    </button>
                </div>
            </div>
            <div class="card-body table-responsive p-1 w-100">
            <table id="tablaPersonas" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Nombre Del Cliente</th>
                <th>Referido Por</th>             
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
     <?php $id=1;?>
            <tr>
            
                <td>1</td>
                <td>2</td>
                <td>3</td>
                <td><a href="verSolicitud.php?numero_solicitud=2" class="btn btn-primary"><i class="fa fa-eye"></i></a></td>
             
            </tr>
            
        </tbody>
    </table>
            </div>
        </div>
    </div>


    <?php include_once "footer/footer_views.php"; ?>

</body>
</html>