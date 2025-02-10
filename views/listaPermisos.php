<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
    exit();
} elseif (isset($_SESSION['usuario']) && $_SESSION['seguridad'] === false) {
    echo 'Acesso no autorizado.';
    exit();
}
include_once "../controller/permisosController.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permisos</title>
    <?php include_once "head/head_views.php"; ?>
    <link rel="stylesheet" href="css/estilos generales.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <!-- hoja de estilo para los datatable -->
</head>
<body>
<div class="content-wrapper">
<section class="content">
      <div class="container-fluid pt-3">
    <div class="card card-dark">
        <div class="card-header">
            <h3 class="card-title">Permisos</h3>
            <div class="card-tools">
                <a type="button" class="btn btn-tool" href="./formCrearPermiso.php">
                    <i class="nav-icon fas fa-edit"> Crear Permiso</i>
                </a>
            </div>
        </div>
        <div class="card-body table-responsive p-1">
            <div class="wrapper">
                <div class="content">
                        <table class="table table-head-fixed table-light table-striped table-bordered " style="width: 100%;" id="permisos-table">
                            <thead>
                                <tr>
                                    <th>Acciones</th>
                                    <th>Permiso</th>
                                    <th>Fecha Creaci&oacute;n</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
     </div>
</section>
</div>
    <?php include_once "footer/footer_views.php"; ?>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap4.min.js"></script>
    <script>
        const data = <?php echo PermisosController::ctrlConsultarPermisos(); ?>
     
        var table_permisos = $('#permisos-table').DataTable({
            data: data,
            // se cargan los datos
            "autoWidth": false,
            columns: [
                        {data: 'Acciones'},
                        { data: 'Permiso' },
                        { data: 'Creacion' },
                    ],
            // se especifican las columnas
            "language": {
                "url": 'https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json'
            },
            "lengthChange": true,
            "searching": true,
            "pageLength": 5,
            "lengthMenu": [
                [5, 10, 20, -1],
                [5, 10, 20, "Todos"]
            ],
            "responsive": {
                "details": {
                    "type": 'column'
                }
            },
            width: '100%',
            columnDefs: [
                { width: '150px', targets: [0,1] },
                { responsivePriority: 1, targets: 0 },
                { responsivePriority: 2, targets: 1 },
                { responsivePriority: 3, targets: 2 },

            ],
            scrollX: false,
        });
 
    </script>
</body>
</html>