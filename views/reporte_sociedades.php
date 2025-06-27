<?php
// session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once "head/head_views.php"; ?>
   
    
  <!-- Bootstrap 4 -->
<link rel="stylesheet" href="../resource/AdminLTE-3.2.0/plugins/bootstrap/css/bootstrap.min.css">
<!-- DataTables -->
<link rel="stylesheet" href="../resource/AdminLTE-3.2.0/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="../resource/AdminLTE-3.2.0/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

<!-- jQuery -->
<script src="../resource/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../resource/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables & Plugins -->
<script src="../resource/AdminLTE-3.2.0/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../resource/AdminLTE-3.2.0/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../resource/AdminLTE-3.2.0/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../resource/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../resource/AdminLTE-3.2.0/plugins/jszip/jszip.min.js"></script>
<script src="../resource/AdminLTE-3.2.0/plugins/pdfmake/pdfmake.min.js"></script>
<script src="../resource/AdminLTE-3.2.0/plugins/pdfmake/vfs_fonts.js"></script>
<script src="../resource/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../resource/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../resource/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>


    <title>Reporte Sociedades</title>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Reporte Sociedades</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- <div class="col-6"> -->
                                <table id="sociedadesTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nombre Del cliente</th>
                                            <th>Pais Origen</th>
                                            <th>Nombre Corporacion</th>
                                            <th>Estado de Registro</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="sociedades_patrimonium"></tbody>
                                </table>
                            
                        </div> <!-- End row -->
                    </div> <!-- End card-body -->
                </div>
            </div>
        </div>
    </section>
</div>

</body>
    <?php include_once "footer/footer_views.php"; ?>
    <script src="../resource/AdminLTE-3.2.0/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="../resource/AdminLTE-3.2.0/plugins/jquery-validation/additional-methods.min.js"></script>
    <script src="../resource/AdminLTE-3.2.0/plugins/jquery-validation/localization/messages_es.min.js"></script>  

    <script>
    var dataSociedad = [];
    $(document).ready(function() {
        $.ajax({
            url: '../controller/sociedadController.php',
            type: 'GET',
            data: { accion: 'obtenerTodasSociedades' },
            dataType: 'json',
            success: function(response) { 
                let tbody = $('#sociedades_patrimonium');
                tbody.empty();
                $.each(response, function(index, sociedad) {
                    dataSociedad.push(sociedad); 
                });

                // Inicialización de DataTables con Botones
                $("#sociedadesTable").DataTable({ 
                    "data": dataSociedad,
                    "columns": [
                        { "data": "nombrecliente" },
                        { "data": "pais_origen" },
                        { "data": "nombre" },
                        { "data": "estados" },
                        { "data": "activarsociedad" }
                    ],
                    "destroy": true,
                    "responsive": true,
                    "lengthChange": true,
                    "autoWidth": false,
                    "dom": 'Bfrtip',
                    "buttons": [
                        {
                            extend: 'copyHtml5',
                            text: '<i class="fas fa-copy"></i> Copiar',
                            className: 'btn btn-secondary'
                        },
                        {
                            extend: 'excelHtml5',
                            text: '<i class="fas fa-file-excel"></i> Exportar a Excel',
                            className: 'btn btn-success'
                        },
                        {
                            extend: 'pdfHtml5',
                            text: '<i class="fas fa-file-pdf"></i> Exportar a PDF',
                            className: 'btn btn-danger'
                        },
                        {
                            extend: 'print',
                            text: '<i class="fas fa-print"></i> Imprimir',
                            className: 'btn btn-info'
                        }
                    ],
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json"
                    }
                });
            },
            error: function(xhr, status, error) {
                console.error('Error al obtener los datos: ', xhr.responseText);
            }
        });
    });
</script>


   


</html>