<!DOCTYPE html>
<?php
include_once "../controller/sociedadController.php";
?>
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
</head>
<body>
<div class="container mt-5">
    <table id="tablaPersonas" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Accion</th>
                <th>Nombre Sociedad</th>
                <th>Referencia Sociedad</th>
                <th>Fecha de Registro</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        $controlador = new SociedadController();
        $sociedades = $controlador->getSociedades();
        //print_r($personas);
        foreach($sociedades as $sociedad): 
        ?>
            <tr>
                <td><a href="verSociedad.php?id_solicitud=<?php echo $sociedad['fk_solicitud']?> " class="btn btn-primary"><i class="fa fa-eye"></i></a></td>
                <td><?php echo htmlspecialchars($sociedad['nombre']); ?></td>
                <td><?php echo htmlspecialchars($sociedad['id_sociedad']); ?></td>
                <td><?php echo htmlspecialchars($sociedad['fecha_nacimiento']); ?></td>
                <td><?php echo htmlspecialchars($sociedad['pais_origen']); ?></td>
             
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include_once "footer/footer_views.php"; ?>
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
    $('#tablaPersonas').DataTable({
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
</body>
</html>
