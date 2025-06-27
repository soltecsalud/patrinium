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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="css/estilos generales.css">
    <link rel="stylesheet" href="css/estilosPersonalizadosSelect2.css">
    <link rel="stylesheet" href="../resource/AdminLTE-3.2.0/plugins/tail-select/css/default/tail.select-light.css">
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
                                <button type="button" class="btn btn-danger crearSociedad" data-toggle="modal" data-target="#modalCrearTipoSociedad">
                                    Crear tipo cuenta
                                </button>
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
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="aba">Tipo cuenta</label>
                                            <select class="form-control" id="tipo_cuenta" name="tipo_cuenta" required>
                                                <option value="">Seleccionar tipo de cuenta</option>
                                            </select>
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
                            <table id="bancosTable" class="table table-bordered table-striped dataTable">
                                <thead>
                                    <tr>
                                        <th colspan="2">Acciones</th>
                                        <th>Nombre del Banco</th>
                                        <th>Nombre de la Cuenta</th>
                                        <th>Número de la Cuenta</th>
                                        <th>Routing ACH</th>
                                        <th>ABA</th>
                                        <th>SWIFT</th>
                                        <th>Ciudad</th>
                                        <th>Sucursal</th>
                                        <th>Fecha de Ingreso</th>
                                        <th>Tipo Cuenta</th>
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

        <!-- Modal Bootstrap -->
        <div class="modal fade" id="modalActualizarBanco" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Actualizar Banco</h5>
                        <button type="button" class="close" id="btnCerrarModalSociedad2" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="actualizarbancoForm">
                            <div class="row">
                                <input type="hidden" class="form-control" id="id_banco" name="id_banco" required>
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="aba">Tipo cuenta</label>
                                        <select class="form-control" id="tipo_cuenta" name="tipo_cuenta" required>
                                            <option value="">Seleccionar tipo de cuenta</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btnActualizarBanco" class="btn btn-primary">Guardar Banco</button>
                        <button type="button" class="btn btn-secondary" id='btnCerrarModalSociedad' data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalEliminarBanco" tabindex="-1" role="dialog" aria-labelledby="modalEliminarBancoLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEliminarBancoLabel">Eliminar Banco</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <input type="hidden" class="form-control" id="id_banco_eliminar">
                            <p>Se eliminara el banco: <b id="nombre_banco_eliminar"></b></p>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" id="btnEliminarBanco">Eliminar Banco</button>
                    </div>
                </div>
            </div>
        </div>



        <div class="modal fade" id="modalCrearTipoSociedad" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Crear tipo cuenta</h5>
                        <button type="button" class="close" id="btnCerrarModalSociedad2" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="creartipocuentaForm">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nombre_tipocuenta">Nombre del tipo de cuenta</label>
                                        <input type="text" class="form-control" id="nombre_tipocuenta" name="nombre_tipocuenta" required>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btnCrearTipoCuenta" class="btn btn-primary">Guardar</button>
                        <button type="button" class="btn btn-secondary" id='btnCerrarModalSociedad' data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>


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
    <script src="../resource/AdminLTE-3.2.0/plugins/tail-select/js/tail.select-full.js"></script>
    
    <script>
        function cargarTipoCuentas(campoSelect,idcampoSelect,tipocuentaSeleccionada=[]) {
            $.ajax({
                url: '../controller/tipoCuentasController.php',
                type: 'GET',
                data: {
                    accion: 'getTipoCuentas'
                },
                dataType: 'json',
                success: function(data) {
                    console.log('Respuesta del servidor de Tipo Cuentas:', data); // Depuración
                    // Cargar los estados en el select multiples
                    var tipo_cuenta = campoSelect;
                    tipo_cuenta.empty(); 
                    tipo_cuenta.append('<option value="">Seleccionar tipo cuenta</option>');
                    $.each(data, function(index, item) {  
                        var selected = tipocuentaSeleccionada.includes(item.id_tipo_cuenta_bancos) ? 'selected' : ''; // Cambia esto según tu lógica
                        tipo_cuenta.append('<option value="' + item.id_tipo_cuenta_bancos + '" '+selected+'>' + item.tipo_cuenta + '</option>');
                    });
                    tail.select(idcampoSelect, { 
                        search: true,
                        descriptions: true,
                        hideSelected: true,
                        hideDisabled: true,
                        // multiLimit: 4,
                        multiShowCount: false,
                        multiContainer: true
                    }).reload();
                },
                error: function(xhr, status, error) {
                    console.error('Error al cargar los estados:', error);
                }
            });
        }
        $(document).ready(function(){
            cargarTipoCuentas($('#tipo_cuenta'),'#tipo_cuenta');
        });
    </script>
    
    
    <script>
        $(document).ready(function(){
            $('#btn_insertar_banco').click(function(){        
                var datos = $('#consignacionForm').serialize() + "&action=guardarBancoConsignacion"; // Cambio aquí: añadir el # antes de consignacionForm
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

            $('#btnActualizarBanco').click(function(){        
                var datos = $('#actualizarbancoForm').serialize() + "&action=actualizarBancoConsignacion"; // Cambio aquí: añadir el # antes de consignacionForm
                $.ajax({
                    type: "POST",
                    url: "../controller/bancosConsignacionesController.php",
                    data: datos,
                    success: function(r) {
                        console.log(r);
                        if (r.resultado == 0) {
                            alert("fallo :(");
                        } else {
                            alert("Actualizado con éxito"); 
                            // Redirección a listar_empresa.php
                            window.location.href = 'bancos_consignaciones.php';
                        }
                    }
                });
            });

            $('#btnCrearTipoCuenta').click(function(){
                var datos = $('#creartipocuentaForm').serialize() + "&action=creartipocuenta"; // Cambio aquí: añadir el # antes de consignacionForm
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
            });

        });
    </script>
    <script>
        var dataBancos = [];
        $(document).ready(function() {
            $.ajax({
                url: '../controller/bancosConsignacionesController.php', // Cambia esto por la ruta correcta a tu controlador
                type: 'POST',
                data: { action: 'listarBancosConsignaciones' },
                dataType: 'json',
                success: function(response) {
                    // console.log(response); // Añade esto para ver la respuesta en la consola
                    let tbody = $('#bancosConsignaciones');
                    tbody.empty(); // Limpia cualquier dato anterior

                    // Recorre los datos y crea las filas de la tabla
                    $.each(response, function(index, consignacion) {
                        dataBancos.push(consignacion);
                        var tipocuenta = consignacion.tipo_cuenta || 'No definido'; // Manejo de tipo_cuenta
                        let row = `<tr>
                            <td>
                                <a style="margin-right: 10px;"  class="btn btn-success m-0" data-toggle="modal" data-target="#modalActualizarBanco" data-id="${consignacion.id_banco}">
                                    Actualizar
                                </a>
                            </td>
                            <td>
                                <a style="margin-right: 10px;" class="btn btn-danger m-0" data-toggle="modal" data-target="#modalEliminarBanco" data-id="${consignacion.id_banco}" data-nombre="${consignacion.nombre_banco}">
                                    Eliminar
                                </a>
                            </td>
                            <td>${consignacion.nombre_banco}</td>
                            <td>${consignacion.nombre_cuenta}</td>
                            <td>${consignacion.numero_cuenta}</td>
                            <td>${consignacion.routing_ach}</td>
                            <td>${consignacion.aba}</td>
                            <td>${consignacion.swift}</td>
                            <td>${consignacion.ciudad}</td>
                            <td>${consignacion.sucursal}</td>
                            <td>${consignacion.fecha_ingreso}</td>
                            <td>${tipocuenta}</td>
                        </tr>`;
                        tbody.append(row);
                    });
                    // $('#bancosTable').DataTable();
                    $("#bancosTable").DataTable({
                        "responsive": true,
                        "lengthChange": true,
                        "autoWidth": false,
                        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error al obtener los datos: ', xhr.responseText);
                }
            });

            $('#modalActualizarBanco').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); 
                var id     = button.data('id');
                var banco  = dataBancos.find(banco => banco.id_banco === id);
                $('#actualizarbancoForm #id_banco').val(banco.id_banco);
                $('#actualizarbancoForm #nombre_banco').val(banco.nombre_banco);
                $('#actualizarbancoForm #aba').val(banco.aba);

                $('#actualizarbancoForm #nombre_cuenta').val(banco.nombre_cuenta);
                $('#actualizarbancoForm #swift').val(banco.swift);

                $('#actualizarbancoForm #numero_cuenta').val(banco.numero_cuenta);
                $('#actualizarbancoForm #ciudad').val(banco.ciudad);

                $('#actualizarbancoForm #routing_ach').val(banco.routing_ach);
                $('#actualizarbancoForm #sucursal').val(banco.sucursal);

                var tipocuenta = [banco.fk_tipo_cuenta];

                var tipocuenta2 = tipocuenta.map(Number);

                cargarTipoCuentas($('#actualizarbancoForm #tipo_cuenta'),'#actualizarbancoForm #tipo_cuenta',tipocuenta2); // Cargar el select con el tipo de cuenta seleccionado
            });

            $('#modalEliminarBanco').on('show.bs.modal', function(event) {
                var button  = $(event.relatedTarget); 
                var id      = button.data('id');
                var nombre  = button.data('nombre');
                
                var modal = $(this); 
                modal.find('.modal-body #id_banco_eliminar').val(id);
                modal.find('.modal-body #nombre_banco_eliminar').text(nombre);
            });

            $('#btnEliminarBanco').on('click', function() {
                var id      = $('#id_banco_eliminar').val();
                $.ajax({
                    url: '../controller/bancosConsignacionesController.php', // Cambia esto por la ruta correcta a tu controlador
                    type: 'POST',
                    data: { 
                        action: 'eliminarBanco',
                        id_banco: id
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        if (response.resultado == 0) {
                            alert("fallo :(");
                        } else {
                            alert("Banco eliminado con éxito");
                            window.location.href = 'bancos_consignaciones.php';
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error al enviar los datos: ', xhr.responseText);
                    }
                });
            });

        });
    </script>
</html>
