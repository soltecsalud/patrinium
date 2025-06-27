<?php
// session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
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
            <table id="tablaSolicitudes" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Fecha</th>
                <th># Cliente</th>
                <th>Sociedades</th> 
                <th>Nombre Del Cliente</th>                           
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php

        $controlador = new Solicitud_controller();
        $solicitudes = $controlador->getListadoSolicitudesConAdjuntos();
                                    
        foreach ($solicitudes as $solicitud) {
        ?>
            <tr>
                <td><?php echo  htmlspecialchars($solicitud->created_at);?></td>
                <td><?php echo  htmlspecialchars($solicitud->id_solicitud);?></td>
                <td><b><?php echo  htmlspecialchars($solicitud->nombre_sociedades);?></b></td>
                <td><?php echo  htmlspecialchars($solicitud->nombre);?></td>
                <td><a href="../views/verSolicitud.php?numero_solicitud=<?php echo $solicitud->id_solicitud;?>" class="btn btn-primary"><i class="fa fa-eye"></i></a></td>
            </tr>
            <?php }?> 
        </tbody>
    </table>
            </div>
        </div>
    </div>


    <?php include_once "footer/footer_views.php"; ?>

</body>
</html>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/preview/searchPane/dataTables.searchPane.min.js"></script>
    <!-- script para el SearchPane del datatable -->
    <!-- JS de Botones y Funcionalidades de Exportación -->
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
    <script>
$(document).ready(function() {
    $('#tablaSolicitudes').DataTable({
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