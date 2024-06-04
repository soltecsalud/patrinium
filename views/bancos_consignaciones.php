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
                            <h3 class="card-title">Formulario de  Bancos Para Consignaciones</h3>

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
                            <form id="consignacionForm">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nombre_banco">Nombre del Banco</label>
                                            <input type="text" class="form-control" id="nombre_banco" name="nombre_banco" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="nombre_cuenta">Nombre de la Cuenta</label>
                                            <input type="text" class="form-control" id="nombre_cuenta" name="nombre_cuenta" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="numero_cuenta">Número de la Cuenta</label>
                                            <input type="text" class="form-control" id="numero_cuenta" name="numero_cuenta" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="routing_ach">Routing ACH</label>
                                            <input type="text" class="form-control" id="routing_ach" name="routing_ach">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="aba">ABA</label>
                                            <input type="text" class="form-control" id="aba" name="aba">
                                        </div>
                                        <div class="form-group">
                                            <label for="swift">SWIFT</label>
                                            <input type="text" class="form-control" id="swift" name="swift">
                                        </div>
                                        <div class="form-group">
                                            <label for="ciudad">Ciudad</label>
                                            <input type="text" class="form-control" id="ciudad" name="ciudad">
                                        </div>
                                        <div class="form-group">
                                            <label for="sucursal">Sucursal</label>
                                            <input type="text" class="form-control" id="sucursal" name="sucursal">
                                        </div>
                                       
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary" id="btn_insertar_banco">Insert</button>
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
                            <h3 class="card-title">Bancos Consiganciones</h3>

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
                            <table id="bancosTable"class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nombre del Banco</th>
                                        <th>Nombre de la Cuenta</th>
                                        <th>Número de la Cuenta</th>
                                        <th>Routing ACH</th>
                                        <th>ABA</th>
                                        <th>SWIFT</th>
                                        <th>Ciudad</th>
                                        <th>Sucursal</th>
                                        <th>Fecha de Ingreso</th>
                                    </tr>
                                </thead>
                                <tbody id="bancosConsignaciones"></tbody>
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
  $(document).ready(function(){
   $('#btn_insertar_banco').click(function(){        
       var datos = $('#consignacionForm').serialize() + "&action=guardarBancoConsignacion"; // Cambio aquí: añadir el # antes de consignacionForm
       console.log(datos);  
       $.ajax({
           type: "POST",
           url: "../controller/bancosConsignacionesController.php",
           data: datos,
           success: function(r) {
               console.log(r);
               if (r.resultado == 0) {
                   alert("fallo :(");
               } else {
                   alert("Agregado con éxito");
                   // Redirección a listar_empresa.php
                   window.location.href = 'bancos_consignaciones.php';
               }
           }
       });
       return false;
   });
});
</script>
 <script>
        $(document).ready(function() {
            $.ajax({
                url: '../controller/bancosConsignacionesController.php', // Cambia esto por la ruta correcta a tu controlador
                type: 'POST',
            
                data: { action: 'listarBancosConsignaciones' },
                dataType: 'json',
                success: function(response) {
                    console.log(response); // Añade esto para ver la respuesta en la consola
                    let tbody = $('#bancosConsignaciones');
                    tbody.empty(); // Limpia cualquier dato anterior

                    // Recorre los datos y crea las filas de la tabla
                    $.each(response, function(index, consignacion) {
                        let row = `<tr>
                         
                            <td>${consignacion.nombre_banco}</td>
                            <td>${consignacion.nombre_cuenta}</td>
                            <td>${consignacion.numero_cuenta}</td>
                            <td>${consignacion.routing_ach}</td>
                            <td>${consignacion.aba}</td>
                            <td>${consignacion.swift}</td>
                            <td>${consignacion.ciudad}</td>
                            <td>${consignacion.sucursal}</td>
                            <td>${consignacion.fecha_ingreso}</td>
                        </tr>`;
                        tbody.append(row);
                    });
                    $('#bancosTable').DataTable();
                },
                error: function(xhr, status, error) {
                    console.error('Error al obtener los datos: ', xhr.responseText);
                }
            });
        });
    </script>
</html>
