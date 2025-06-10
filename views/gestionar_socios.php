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
    <title>PatrimoniumAPP || Socios </title>
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <section class="content">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Socios Patrimoniun</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="serviciosTable"class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nombre Socio</th>
                                        <th>Cliente del Socio</th>
                                        <th>Fecha Creacion</th>
                                        <th colspan="2">Pasar de socio a cliente</th>
                                    </tr>
                                </thead>
                                <tbody id="socios_patrimonium"></tbody>
                            </table>
                        </div>
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
    <script src="../resource/AdminLTE-3.2.0/plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="../resource/AdminLTE-3.2.0/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="../resource/AdminLTE-3.2.0/plugins/sweetalert2/sweetalert2.all.js"></script>
    <script src="../resource/AdminLTE-3.2.0/plugins/sweetalert2/sweetalert2.js"></script>
    <script src="../resource/AdminLTE-3.2.0/plugins/sweetalert2/sweetalert2.min.js"></script>

    
    <script>
        $.ajax({
            url: '../controller/sociedadController.php',
            type: 'GET',
            data: { accion: 'getConsultarSocios' },
            dataType: 'json',
            success: function(response) {
                console.log(response);
                let tbody = $('#socios_patrimonium');
                tbody.empty();

                // Verifica si hay datos
                if (response.length > 0) {
                    $.each(response, function(index, socio) {
                        let row = `<tr>
                            <td>${socio.nombre}</td>
                            <td>${socio.nombrecliente}</td>
                            <td>${socio.created_at}</td>
                            <td>
                                <input type="checkbox" id="checktipo" data-id="${socio.id_persona_cliente}" name="checktipo" ${socio.essocio ? 'checked' : ''}>
                                <label for="checktipo" id="labelchecktipo${socio.id_persona_cliente}">${socio.essocio ? 'Cliente' : 'Socio'}</label>
                            </td>
                        </tr>`;
                        tbody.append(row);
                    });
                    $('#serviciosTable').DataTable();
                } else {
                    // Si no hay datos, se muestra el mensaje en una fila completa
                    tbody.append(`
                        <tr>
                            <td colspan="4" class="text-center">
                                <div class="alert alert-info" role="alert">
                                    <strong>NO EXISTEN SOCIOS PARA PASAR A CLIENTE</strong>
                                </div>
                            </td>
                        </tr>
                    `);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error al obtener los datos: ', xhr.responseText);
            }
        });
    
        $(document).on('change', '[name="checktipo"]', function() {
            console.log('Checkbox clicked!');
            let id        = $(this).data('id');
            let isChecked = $(this).is(':checked');
            console.log('ID:', id, 'Checked:', isChecked);

            // Cambiar el texto del label según el estado del checkbox
            var tipo;
            if (isChecked) {
                $('#labelchecktipo' + id).text('Cliente');
                tipo = 'Cliente';
            } else {
                $('#labelchecktipo' + id).text('Socio');
                tipo = 'Socio';
            }

            // Llamada AJAX para actualizar el estado en el servidor
            $.ajax({
                url: '../controller/sociedadController.php',
                type: 'GET',
                data: { accion: 'actualizarTipoSocio', id: id, tipo: isChecked },
                success: function(response) {
                    console.log('Estado actualizado:', response);
                    if (response.status == 'ok') { 
                        Swal.fire({
                            icon: 'success',
                            title: 'Actualizado',
                            text: 'El socio se ha actualizado correctamente a ' + tipo,
                            timer: 2000,
                            showConfirmButton: false
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'No se pudo actualizar el socio',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error al actualizar el estado: ', xhr.responseText);
                }
            });
        });

    </script>

</html>