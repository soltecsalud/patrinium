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
    <title>Extensión Sociedades</title>
    <?php include_once "head/head_views.php"; ?>

    <!-- Bootstrap y DataTables -->
    <link rel="stylesheet" href="../resource/AdminLTE-3.2.0/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../resource/AdminLTE-3.2.0/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../resource/AdminLTE-3.2.0/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<div class="container mt-4">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Declaracion De Sociedades Con Formularios</h3>
        </div>
        <div class="card-body">
            <table id="tablaExtensionSociedades" class="table table-bordered table-striped w-100">
                <thead>
                    <tr>
                        <th>System Number Sociedades</th>
                        <th>Nombre Corporación</th>
                        <th>Tipo Sociedad</th>
                        <th>Estado de Registro U operacion</th>
                        <th>Formulario Fiscal</th>
                        <th>Declararon en Marzo</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>

            <hr>
            <h4 class="mt-4">Sociedades Para Extension </h4>
            <table id="tablaSinMarzo" class="table table-bordered table-striped w-100">
                <thead>
                    <tr>
                        <th>System Number Sociedades</th>
                        <th>Nombre Corporación</th>
                        <th>Tipo Sociedad</th>
                        <th>Estado de Registro</th>
                        <th>Formulario Fiscal</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

<?php include_once "footer/footer_views.php"; ?>

<!-- JS -->
<script src="../resource/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
<script src="../resource/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../resource/AdminLTE-3.2.0/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../resource/AdminLTE-3.2.0/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../resource/AdminLTE-3.2.0/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../resource/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../resource/AdminLTE-3.2.0/plugins/jszip/jszip.min.js"></script>
<script src="../resource/AdminLTE-3.2.0/plugins/pdfmake/pdfmake.min.js"></script>
<script src="../resource/AdminLTE-3.2.0/plugins/pdfmake/vfs_fonts.js"></script>
<script src="../resource/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../resource/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.print.min.js"></script>

<script>
$(document).ready(function () {
    // Tabla principal (editable)
    const tablaPrincipal = $('#tablaExtensionSociedades').DataTable({
        ajax: {
            url: '../controller/extensionSociedadesController.php',
            type: 'GET',
            data: { accion: 'obtenerExtensionSociedades' },
            dataSrc: ''
        },
        columns: [
            { data: 'uuid' },
            { data: 'nombre' },
            { data: 'tipo' },
            { data: 'estado' },
            { data: 'formularios_fiscales' },
            {
                    data: 'declararon_marzo',
                    render: function (data, type, row) {
                        const checked = data ? 'checked' : '';
                        return `
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input marzo-switch"
                                    id="switch_${row.uuid}" 
                                    data-id="${row.uuid}" ${checked}>
                                <label class="custom-control-label" for="switch_${row.uuid}"></label>
                            </div>`;
                    }
                }
            ],
        dom: 'Bfrtip',
        buttons: [
            { extend: 'copyHtml5', className: 'btn btn-secondary', text: 'Copiar' },
            { extend: 'excelHtml5', className: 'btn btn-success', text: 'Excel' },
            { extend: 'pdfHtml5', className: 'btn btn-danger', text: 'PDF' },
            { extend: 'print', className: 'btn btn-info', text: 'Imprimir' }
        ],
        language: {
            url: "../resource/datatables/i18n/es-ES.json"
        }
    });

    // Tabla secundaria (sin declarar en marzo)
    const tablaSinMarzo = $('#tablaSinMarzo').DataTable({
        ajax: {
            url: '../controller/extensionSociedadesController.php',
            type: 'GET',
            data: { accion: 'obtenerSociedadesSinMarzo' },
            dataSrc: ''
        },
        columns: [
            { data: 'uuid' },
            { data: 'nombre' },
            { data: 'tipo' },
            { data: 'estado' },
            { data: 'formularios_fiscales' }
        ],
        dom: 'Bfrtip',
        buttons: [
            { extend: 'copyHtml5', className: 'btn btn-secondary', text: 'Copiar' },
            { extend: 'excelHtml5', className: 'btn btn-success', text: 'Excel' },
            { extend: 'pdfHtml5', className: 'btn btn-danger', text: 'PDF' },
            { extend: 'print', className: 'btn btn-info', text: 'Imprimir' }
        ],
        language: {
            url: "../resource/datatables/i18n/es-ES.json"
        }
    });

    // Acción del switch
    $(document).on('change', '.marzo-switch', function () {
        const id = $(this).data('id');
        const estado = $(this).is(':checked');

        $.ajax({
            url: '../controller/extensionSociedadesController.php',
            type: 'POST',
            data: {
                accion: 'actualizarDeclaracionMarzo',
                id_personas_sociedad: id,
                declararon_marzo: estado
            },
            success: function () {
                Swal.fire({
                    icon: 'success',
                    title: 'Guardado',
                    text: 'Actualización exitosa',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 1500
                });

                // Buscar y ocultar fila de la tabla inferior si fue marcada como true
                if (estado) {
                    const fila = tablaSinMarzo.rows().nodes().to$().filter(function () {
                        return $(this).find('td:first').text().trim() === id.toString();
                    });

                    if (fila.length > 0) {
                        fila.fadeOut(500, function () {
                            tablaSinMarzo.row(fila).remove().draw(false);
                        });
                    }
                } else {
                    tablaSinMarzo.ajax.reload(); // si se desmarca, simplemente recargar
                }
            },
            error: function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'No se pudo guardar',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000
                });
            }
        });
    });
});
</script>
</body>
</html>
