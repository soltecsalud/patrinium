<?php
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
    <link rel="stylesheet" href="../views/css/estilos generales.css">
    <link rel="stylesheet" href="../views/css/estilosPersonalizadosSelect2.css">
    <link rel="stylesheet" href="../resource/AdminLTE-3.2.0/plugins/tail-select/css/default/tail.select-light.css">
    <title>PatrimoniumAPP || Empresas </title>
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <section class="content">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Formulario de empresas</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <form id="form_empresa" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nombre_empresa">Nombre de la empresa</label>
                                            <input type="text" class="form-control" id="nombre_empresa" name="nombre_empresa" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="direccion_empresa">Direcci&oacute;n de la empresa</label>
                                            <input type="text" class="form-control" id="direccion_empresa" name="direccion_empresa" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="correo_empresa">Correo de la empresa</label>
                                            <input type="text" class="form-control" id="correo_empresa" name="correo_empresa" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="logo_empresa">Logo</label>
                                            <input type="file" class="form-control" id="logo_empresa" name="logo_empresa" accept="image/png" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary" id="btn_insertar_empresa">Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Empresas</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="empresasTable" class="table table-bordered table-striped dataTable">
                                <thead>
                                    <tr>
                                        <th colspan="2">Acciones</th>
                                        <th>Empresa</th>
                                        <th>Direcci&oacute; de la empresa</th>
                                        <th>Logo</th>
                                        <th>Correo</th>
                                    </tr>
                                </thead>
                                <tbody id="empresas_tbody"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Modal Bootstrap -->
        <div class="modal fade" id="modalActualizarEmpresa" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Actualizar Empresa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="actualizarempresaForm" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="nombre_empresa_modal">Nombre de la empresa</label>
                                <input type="text" class="form-control" id="nombre_empresa" name="nombre_empresa" required>
                            </div>
                            <div class="form-group">
                                <label for="direccion_empresa_modal">Direcci&oacute;n de la empresa</label>
                                <input type="text" class="form-control" id="direccion_empresa" name="direccion_empresa" required>
                            </div>
                            <div class="form-group">
                                <label for="correo_empresa_modal">Correo de la empresa</label>
                                <input type="email" class="form-control" id="correo_empresa" name="correo_empresa" required>    
                            </div>
                            <div class="form-group">
                                <label for="logo_empresa_modal">Logo</label>
                                <input type="file" class="form-control" id="logo_empresa" name="logo_empresa">
                            </div>
                            <input type="" id="id_empresa_modal" name="id_empresa_modal">
                            <input type="hidden" id="ruta_logo_modal" name="ruta_logo_modal">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btnActualizarEmpresa" class="btn btn-primary">Guardar Empresa</button>
                        <button type="button" class="btn btn-secondary" id='btnCerrarModalEmpresa' data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>



    </div>

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
            $('#btn_insertar_empresa').click(function(e){        
                e.preventDefault();
                // Obtener el archivo seleccionado
                var archivo = $('#logo_empresa')[0].files[0];

                // Validar que haya archivo seleccionado
                if (!archivo) {
                    alert("Por favor, selecciona un archivo.");
                    return;
                }

                // Validar que sea PNG
                if (archivo.type !== "image/png") {
                    alert("Solo se permiten LOGOS archivos PNG.");
                    return;
                }
                // Validar que se haya seleccionado un archivo para el logo
                var formData = new FormData($('#form_empresa')[0]);
                formData.append('action', 'gestionarEmpresa');
                formData.append('ejecutar', 'insertarEmpresa');
                $.ajax({ 
                    type: "POST",
                    url: "../controller/empresasController.php",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(r) {
                        try {
                            if (r.resultado == 0) {
                                alert("fallo :(");
                            } else {
                                alert("Agregado con éxito");
                                location.reload();
                            }
                        } catch (e) {
                            console.error("Error al parsear la respuesta JSON:", e);
                            alert("Error al procesar la respuesta del servidor.");
                            return;
                        }
                        
                    }
                });
                return false;
            });
        });
    </script>

    <script>
        var dataEmpresas = [];
        $(document).ready(function() {
            $.ajax({
                type: "POST",
                url: "../controller/empresasController.php",
                data: { action: 'listarEmpresas' },
                dataType: "json",
                success: function(response) {
                    if (response && response.status=="success") {
                        dataEmpresas = response.data; 
                        var tbody = $('#empresas_tbody');
                        tbody.empty(); // Limpiar el tbody antes de agregar nuevos datos

                        // Recorrer el array de empresas y crear las filas de la tabla
                        dataEmpresas.forEach(function(empresa) {
                            var logo = empresa.ruta_logo ? `<img src="${empresa.ruta_logo}" alt="Logo" style="width: 50px; height: 50px;">` : 'No disponible';
                            var row = `<tr>
                                <td>
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalActualizarEmpresa" data-id="${empresa.id_empresa}">Editar</button>
                                </td>
                                <td>
                                    <button class="btn btn-danger" onclick="eliminarEmpresa(${empresa.id_empresa})">Eliminar</button>
                                </td>
                                <td>${empresa.nombre_empresa}</td>
                                <td>${empresa.direccion_empresa}</td>
                                <td>${logo}</td>
                                <td>${empresa.correo}</td>
                            </tr>`;
                            tbody.append(row);
                        });
                    } else {
                        $('#empresas_tbody').html('<tr><td colspan="6">No hay empresas registradas.</td></tr>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error al cargar las empresas:", error);
                    $('#empresas_tbody').html('<tr><td colspan="6">Error al cargar las empresas.</td></tr>');
                }
            });
        });
        // Cargar datos en el modal de actualización
        $('#modalActualizarEmpresa').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Botón que activó el modal
            var idEmpresa = button.data('id'); // Extraer el ID de la empresa del atributo data-id
            var modal = $(this);
            // Buscar la empresa por ID en el array dataEmpresas
            var empresa = dataEmpresas.find(e => e.id_empresa === idEmpresa);
            if (empresa) {
                modal.find('#id_empresa_modal').val(empresa.id_empresa);
                modal.find('#nombre_empresa').val(empresa.nombre_empresa);
                modal.find('#direccion_empresa').val(empresa.direccion_empresa);
                modal.find('#correo_empresa').val(empresa.correo);
                modal.find('#ruta_logo_modal').val(empresa.ruta_logo);
            } else {
                console.error("Empresa no encontrada con ID:", idEmpresa);
            }
        });
        // Actualizar empresa
        $('#btnActualizarEmpresa').click(function(e) {
            e.preventDefault();
            // Validar que se haya seleccionado un archivo para el logo
            var formData = new FormData($('#actualizarempresaForm')[0]);
            formData.append('action', 'gestionarEmpresa');
            formData.append('ejecutar', 'actualizarEmpresa');
            $.ajax({
                type: "POST",
                url: "../controller/empresasController.php",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    var res = JSON.parse(response);
                    if (res.resultado == 1) {
                        alert("Empresa actualizada con éxito");
                        location.reload(); // Recargar la página para mostrar los cambios
                    } else {
                        alert("Error al actualizar la empresa");
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error al actualizar la empresa:", error);
                    alert("Error al procesar la solicitud.");
                }
            });
        });
        // Eliminar empresa
        window.eliminarEmpresa = function(idEmpresa) {
            if (confirm("¿Estás seguro de que deseas eliminar esta empresa?")) {
                $.ajax({
                    type: "POST",
                    url: "../controller/empresasController.php",
                    data: { action: 'eliminarEmpresa', id_empresa: idEmpresa },
                    dataType: "json",
                    success: function(response) {
                        if (response.resultado == 1) {
                            alert("Empresa eliminada con éxito");
                            location.reload();
                        } else {
                            alert("Error al eliminar la empresa");
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error al eliminar la empresa:", error);
                        alert("Error al procesar la solicitud.");
                    }
                });
            }
        };
    </script>

</body>
</html>