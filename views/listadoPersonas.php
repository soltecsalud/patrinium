<!DOCTYPE html>
<?php
include_once "../controller/personaController.php";
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
                <th>ID Persona</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Cédula</th>
                <th>País</th>
                <th>Ciudad</th>
                <th>Cliente</th>
                <th>Oficina Envia</th>
                <th>Estado USA</th>
                <th>Número de Pasaporte</th>
                <th>Fecha de Expedición del Pasaporte</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        $controlador = new CiudadController();
        $personas = $controlador->getPersonas();
        //print_r($personas);
        foreach($personas as $persona): 
        ?>
            <tr>
                <td><?php echo htmlspecialchars($persona['id_persona']); ?></td>
                <td><?php echo htmlspecialchars($persona['nombres']); ?></td>
                <td><?php echo htmlspecialchars($persona['apellidos']); ?></td>
                <td><?php echo htmlspecialchars($persona['cedula']); ?></td>
                <td><?php echo htmlspecialchars($persona['pais']); ?></td>
                <td><?php echo htmlspecialchars($persona['ciudad']); ?></td>
                <td><?php echo htmlspecialchars($persona['cliente']); ?></td>
                <td><?php echo htmlspecialchars($persona['oficina_envia']); ?></td>
                <td><?php echo htmlspecialchars($persona['estadousa']); ?></td>
                <td><?php echo htmlspecialchars($persona['pasaporte_numero']); ?></td>
                <td><?php echo htmlspecialchars($persona['pasaporte_fecha_expedicion']); ?></td>
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
