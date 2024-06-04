<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
    exit();
} elseif (isset($_SESSION['usuario']) && $_SESSION['casos'] === false) {
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
    <link rel="stylesheet" href="css/estilos generales.css">
    <link rel="stylesheet" href="css/estilosPersonalizadosSelect2.css">
    <title>PatrimoniumAPP || Bancos </title>
</head>
<body>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Formulario Agregar Servicios</h3>

                            <div class="card-tools">
                                <!-- This will cause the card to maximize when clicked -->
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                                <!-- This will cause the card to collapse when clicked -->
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                <!-- This will cause the card to be removed when clicked -->
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form id="serviciosForm">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="nombre_servicio">Nombre Servicio</label>
                                            <input type="text" name="nombre_servicio" id="nombre_servicio" class="form-control" placeholder="Nombre Servicio" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary" id="btn_insertar_servicio">Insert</button>
                                    </div>
                                </div>
    
                            </form>
                            <div id="result"></div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Servicios Patrimoniun</h3>

                            <div class="card-tools">
                                <!-- This will cause the card to maximize when clicked -->
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                                <!-- This will cause the card to collapse when clicked -->
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                <!-- This will cause the card to be removed when clicked -->
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="serviciosTable"class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Id Servicio</th>
                                        <th>Nombre Servicio</th>
                                        <th>Fecha Creacion</th>
                                    </tr>
                                </thead>
                                <tbody id="servicios_patrimonium"></tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </section>
    </div>        
  
</body>
<?php include_once "footer/footer_views.php"; ?>
    <script src="../resource/AdminLTE-3.2.0/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="../resource/AdminLTE-3.2.0/plugins/jquery-validation/additional-methods.min.js"></script>
    <script src="../resource/AdminLTE-3.2.0/plugins/jquery-validation/localization/messages_es.min.js"></script>  
    <script src="../resource/AdminLTE-3.2.0/plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="../resource/AdminLTE-3.2.0/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="../resource/AdminLTE-3.2.0/plugins/sweetalert2/sweetalert2.all.js"></script>
    <script src="../resource/AdminLTE-3.2.0/plugins/sweetalert2/sweetalert2.js"></script>
    <script src="../resource/AdminLTE-3.2.0/plugins/sweetalert2/sweetalert2.min.js"></script>
    
    <script>
    $(document).ready(function() {
        $('#serviciosForm').on('submit', function(event) {
            event.preventDefault(); // Evita el comportamiento predeterminado del formulario
            var datos = $(this).serialize() + "&action=guardarServicio"; // Serializa los datos del formulario
            console.log(datos);  
            $.ajax({
                type: "POST",
                url: "../controller/serviciosPatriniumController.php",
                data: datos,
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response.resultado == 0) {
                        alert("fallo :(");
                    } else {
                        alert("Agregado con éxito");
                        window.location.href = 'servicios_patrinium.php';
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error al enviar los datos: ', xhr.responseText);
                }
            });
        });
    });
</script>
 <script>
       $(document).ready(function() {
            $.ajax({
                url: '../controller/serviciosPatriniumController.php',
                type: 'POST',
                data: { action: 'listarServicios' },
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    let tbody = $('#servicios_patrimonium');
                    tbody.empty();

                    $.each(response, function(index, servicio) {
                        let row = `<tr>
                            <td>${servicio.id_servicio}</td>
                            <td>${servicio.nombre_servicio}</td>
                            <td>${servicio.created_at}</td>
                        </tr>`;
                        tbody.append(row);
                    });
                    $('#serviciosTable').DataTable();
                },
                error: function(xhr, status, error) {
                    console.error('Error al obtener los datos: ', xhr.responseText);
                }
            });
        });
    </script>
</html>
