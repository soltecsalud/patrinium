<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
    exit();
} elseif (isset($_SESSION['usuario']) && $_SESSION['crear generales'] === false) {
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
    <title>PatrimoniumAPP || Crear Terceros </title>
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
                            <h3 class="card-title">Formulario Terceros</h3>

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
                            <form id="tipoDocumentoAdjunto">
                            <div class="row">
                        <!-- Columna Izquierda -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nombre">Nombre completo</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre_comercial">Nombre comercial (si aplica)</label>
                                        <input type="text" class="form-control" id="nombre_comercial" name="nombre_comercial">
                                    </div>
                                    <div class="form-group">
                                        <label for="tipo_entidad">Tipo de entidad</label>
                                        <select class="form-control" id="tipo_entidad" name="tipo_entidad" required>
                                            <option value="individual">Persona física</option>
                                            <option value="c_corporation">Corporación C</option>
                                            <option value="s_corporation">Corporación S</option>
                                            <option value="partnership">Sociedad</option>
                                            <option value="trust_estate">Fideicomiso o Patrimonio</option>
                                            <option value="llc">LLC</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="direccion">Dirección</label>
                                        <input type="text" class="form-control" id="direccion" name="direccion" required>
                                    </div>
                                </div>

                                <!-- Columna Derecha -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ciudad">Ciudad</label>
                                        <input type="text" class="form-control" id="ciudad" name="ciudad" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="estado">Estado</label>
                                        <input type="text" class="form-control" id="estado" name="estado" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="codigo_postal">Código Postal</label>
                                        <input type="text" class="form-control" id="codigo_postal" name="codigo_postal" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="tin">Número de Identificación Fiscal (SSN o EIN)</label>
                                        <input type="text" class="form-control" id="tin" name="tin" required>
                                    </div>
                                </div>
                            </div>

                                <!-- Firma y Fecha -->
                                <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="firma">Firma (nombre completo)</label>
                                                <input type="text" class="form-control" id="firma" name="firma" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fecha">Fecha</label>
                                                <input type="date" class="form-control" id="fecha" name="fecha" required>
                                            </div>
                                        </div>
                                 </div>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary" id="btn_insertar__tipo_documento_adjunto">Insert</button>
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
                            <h3 class="card-title">Lista de Terceros</h3>

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
                            <table id="tipoPagoTable"class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Id Tipo Pago</th>
                                        <th>Descripcion Tipo Pago</th>
                                        <th>Fecha Creacion</th>
                                        
                                    </tr>
                                </thead>
                                <tbody id="tipoPago"></tbody>
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
   $('#btn_insertar__tipo_documento_adjunto').click(function(){        
       var datos = $('#tipoDocumentoAdjunto').serialize() + "&action=guardarTipoDocumento_adjunto"; // Cambio aquí: añadir el # antes de consignacionForm
       console.log(datos);  
       $.ajax({
           type: "POST",
           url: "../controller/terceros_controller.php",
           data: datos,
           success: function(r) {
               console.log(r);
               if (r.resultado == 0) {
                   alert("fallo :(");
               } else {
                   alert("Agregado con éxito");
                   // Redirección a listar_empresa.php
                   window.location.href = 'crear_tercero.php';
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
                url: '../controller/terceros_controller.php', // Cambia esto por la ruta correcta a tu controlador
                type: 'POST',
            
                data: { action: 'listarTipoPago' },
                dataType: 'json',
                success: function(response) {
                    console.log(response); // Añade esto para ver la respuesta en la consola
                    let tbody = $('#tipoPago');
                    tbody.empty(); // Limpia cualquier dato anterior

                    // Recorre los datos y crea las filas de la tabla
                    $.each(response, function(index, tipoPago) {
                        let row = `<tr>
                         
                            <td>${tipoPago.id_terceros}</td>
                            <td>${tipoPago.nombre_tercero}</td>
                            <td>${tipoPago.create_at}</td>
                          
                        </tr>`;
                        tbody.append(row);
                    });
                    $('#tipoPagoTable').DataTable();
                },
                error: function(xhr, status, error) {
                    console.error('Error al obtener los datos: ', xhr.responseText);
                }
            });
        });
    </script>
</html>
