<?php
// session_start();
include_once "../controller/usuarioController.php";

// if (!isset($_SESSION['usuario'])) {
//     header('Location: ../index.php');
//     exit();
// } elseif (isset($_SESSION['usuario']) && $_SESSION['configuracion'] === false) {
//     echo 'Acesso no autorizado.';
//     exit();
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once "head/head_views.php"; ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <!-- hoja de estilo para los datatable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/plug-ins/preview/searchPane/dataTables.searchPane.min.css">
    <!-- hoja de estilo para el SearchPane del datatable -->
    <link rel="stylesheet" href="../views/css/dataTableSearchPanes.css">
    <!-- hoja de estilo personalizada para searchPane -->
    <link rel="stylesheet" href="../views/css/estilos generales.css">
    <title>Administracion de Usuarios</title>
    <style>
        .btn-success {
            box-shadow: none;
            border: none;
        }
    </style>
</head>

<body>
    <div class="container-fluid h-100">
        <div class="card card-dark h-100">
            <div class="card-header">
                <h3 class="card-title">Administración de Usuarios</h3>
                <div class="card-tools d-inline">
                <a href="router.php?vista=crear_usuario.php" class="btn btn-outline-light btn_header">Registrar Usuario</a>
                </div>
            </div>
            <div class="card-body table-responsive p-1 w-100">
                <div class="wrapper">
                    <!-- <nav id="sidebar">
                        <div class="sidebar-header">
                            <h5>Filtros</h5>
                            <hr>
                        </div>
                        <div class="searchPanes"></div>
                    </nav> -->
                    <div class="content w-100">
                        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                            <button type="button" id="sidebarCollapse" class="btn btn-outline-secondary btn-sm">
                                <i class="fa fa-filter" aria-hidden="true"></i>
                            </button>
                        </nav>
                        <div class="contenido-wrapper" style="min-height: 600px; max-width: 97%;">
                            <table class="table table-head-fixed table-light table-striped table-bordered " style="width: 100%;" id="usuarios">
                                <thead>
                                    <tr>
                                        <th>Ver Mas</th>
                                        <th>Acciones</th>
                                        <th>Identificacion</th>
                                        <th>Usuario</th>
                                        <th>Nombres</th>
                                        <th>Apellidos</th>
                                        <th>Correo</th>
                                        <th>Telefono</th>
                                        <!-- <th>Especialidad</th> -->
                                        <!-- <th>IPS</th>
                                        <th>ESE</th>
                                        <th>EPS</th> -->
                                        <th>Rol</th>
                                        <th>Estado</th>
                                        <th>Fecha de Creacion</th>
                                        <th>Fecha de Baja</th>
                                        <th>Registro</th>
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
    </div>


    <?php include_once "footer/footer_views.php"; ?>
    <!-- script para el SearchPane del datatable -->
    <script src="../views/js/dataTableSearchPane.js"></script>
    <script src="../views/js/delete_usuario.js"></script>
    <script>
        const data = <?php echo UsuarioController::ctrlConsultarUsuarios(); ?>;

        console.log(data);

        var table_usuarios = $('#usuarios').DataTable({
            "createdRow": function(row, data, dataIndex) {
                var estado = data.Estado;

                if (estado === 'activo') {
                    $('td', row).eq(13).html('<span class="badge badge-success">Activo</span>');
                } else {
                    $('td', row).eq(13).html('<span class="badge badge-danger">Inactivo</span>');
                }
            },
            data: data,
            // se cargan los datos
            columns: [{
                    data: 'VerMas'
                },
                {
                    data: 'Acciones'
                },
                {
                    data: 'Identificacion'
                },
                {
                    data: 'Usuario'
                },
                {
                    data: 'Nombres'
                },
                {
                    data: 'Apellidos'
                },
                {
                    data: 'Correo'
                },
                {
                    data: 'Telefono'
                },
                // {
                //     data: 'Especialidad'
                // },
                // {
                //     data: 'IPS'
                // },
                // {
                //     data: 'ESE'
                // },
                // {
                //     data: 'EPS'
                // },
                {
                    data: 'Rol'
                },
                {
                    data: 'Estado'
                },
                {
                    data: 'FechaCreacion'
                },
                {
                    data: 'FechaBaja'
                },
                {
                    data: 'Creador'
                }
            ],
            // se especifican las columnas
            searchPane: {
                container: '.searchPanes',
                columns: [8, 9, 11],
                threshold: 0
            },
            "language": {
                "url": 'https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json'
            },
            "lengthChange": true,
            "searching": true,
            "autoWidth": true,
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
                    width: '80px',
                    targets: [0]
                },
                {
                    className: 'dt-center',
                    targets: [0, 1]
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
                {
                    responsivePriority: 4,
                    targets: 3
                },
                {
                    responsivePriority: 5,
                    targets: 4
                },
                {
                    responsivePriority: 6,
                    targets: 5
                },
                {
                    responsivePriority: 7,
                    targets: 12
                },
                // { Se comento para evitar problemas de visualizacion
                //     responsivePriority: 8,
                //     targets: 13
                // },
            ],
            scrollX: true,
        });
        table_usuarios.draw();
        table_usuarios.searchPanes.rebuild();
    </script>
</body>


</html>