<?php
session_start();
include_once "../controller/RolesController.php";
$roles = RolesController::ctrlListarPermisosRoles();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
    exit();
} elseif (isset($_SESSION['usuario']) && $_SESSION['seguridad'] === false) {
    echo 'Acesso no autorizado.';
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roles</title>
    <?php include_once "head/head_views.php"; ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <!-- hoja de estilo para los datatable -->
    <link rel="stylesheet" href="css/estilos generales.css">
</head>

<body>
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid pt-3">
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title">Roles</h3>
                        <div class="card-tools">
                            <!-- <a type="button" class="btn btn-tool" href="#">
                                <i class="nav-icon fas fa-edit"> Crear Rol</i>
                            </a> -->
                        </div>
                    </div>
                    <div class="card-body table-responsive p-1">
                        <div class="wrapper">
                            <div class="content">
                                <table class="table table-head-fixed table-light table-striped table-bordered " style="width: 100%;" id="roles-table">
                                    <thead>
                                        <tr>
                                            <th>Ver M&aacute;s</th>
                                            <?php
                                            $encabezados = array_keys($roles[0]);
                                            foreach ($encabezados as $encabezado) {
                                            ?>
                                                <th> <?php echo $encabezado; ?> </th>
                                            <?php
                                            }
                                            ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($roles as $rol) { ?>
                                            <tr>
                                                <td class="dt-center">
                                                    <div class="row">
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Ver m&aacute;s"><i class="fa fa-plus-circle" aria-hidden="true"></i></button>
                                                        </div>
                                                    </div>
                                                </td>
                                                <?php foreach ($rol as $key => $value) {
                                                    if ($key == 'Acciones') {
                                                ?>
                                                        <td class="dt-center">
                                                            <div class="btn-group">
                                                                <a style="margin-right: 10px;" href="editarPermisosRoles.php?id=<?php echo $value; ?>" class="btn btn-success m-0"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                            </div>
                                                        </td>
                                                        <?php
                                                    } else {
                                                        if ($key == 'Rol') {
                                                        ?>
                                                            <td><?php echo $value; ?></td>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <td class="dt-center"><span class="badge <?php echo $value == true ? 'badge-success' : 'badge-danger'; ?>"><?php echo $value == true ? '<i class="fas fa-check"></i>' : '<i class="fas fa-times"></i>'; ?></span></td>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                            <?php }
                                            } ?>
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
        var table_roles = $('#roles-table').DataTable({
            "autoWidth": true,
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
            columnDefs: [{
                    width: '150px',
                    targets: [0, 1, 2, 3]
                },
                {
                    responsivePriority: 1,
                    targets: 0
                },
                {
                    responsivePriority: 2,
                    targets: 1
                },
                {
                    responsivePriority: 3,
                    targets: 2
                },

            ],
            scrollX: false,
        });
    </script>
</body>
</html>