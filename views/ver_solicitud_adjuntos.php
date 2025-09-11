<?php
// session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
    exit();
} 
include_once "../controller/solicitudController.php";
include_once '../libs/phpqrcode-master/qrlib.php'; // Librería PHP QR Code
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once "head/head_views.php"; ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <!-- hoja de estilo para los datatable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/plug-ins/preview/searchPane/dataTables.searchPane.min.css">
    <!-- hoja de estilo para el SearchPane del datatable -->
    <link rel="stylesheet" href="css/dataTableSearchPanes.css">
    <!-- hoja de estilo personalizada para searchPane -->
    <link rel="stylesheet" href="css/estilos generales.css">
    <title>Listado de Solicitudes</title>
</head>
<body>
    <div class="container-fluid h-100" >
        <div class="card card-dark  h-100">
            <div class="card-header">
                <h3 class="card-title">Administracion Clientes </h3>
                <div class="card-tools">
                    <?php echo date('Y-m-d'); ?>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize">
                        <i class="fas fa-expand"></i>
                    </button>
                </div>
            </div>
            <div class="card-body table-responsive p-1 w-100">
                <table id="tablaSolicitudes" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th># Cliente</th>
                            <th>Sociedades</th> 
                            <th>Nombre Del Cliente</th>                           
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php

                    $controlador = new Solicitud_controller();
                    $solicitudes = $controlador->getListadoSolicitudesConAdjuntos();
                                        
                    foreach ($solicitudes as $solicitud) {
                        $is_required_mfa = $solicitud->is_required_mfa;
                        $totp_secret     = $solicitud->totp_secret;
                        $is_mfa_enabled  = $solicitud->is_mfa_enabled;

                        // Generar la URL OTP
                        $issuer  = 'Patrinium'; 
                        
                        // $secret = $gAuth->createSecret();
                        // $totpUrl = 'otpauth://totp/'.urlencode($nombre_sociedad).'?secret='.$totp_secret.'&issuer='.urlencode($issuer);
                        $totpUrl = "otpauth://totp/{$solicitud->id_solicitud}?secret={$totp_secret}&issuer={$issuer}";

                        $tempDir  = '../qr_temp/';
                        $filename = $tempDir . 'qrcode_' . $solicitud->id_solicitud . '.png';
                        QRcode::png($totpUrl, $filename, QR_ECLEVEL_L, 6); // Genera el archivo QR

                    ?>
                        <tr>
                            <td><?php echo  htmlspecialchars($solicitud->created_at);?></td>
                            <td><?php echo  htmlspecialchars($solicitud->id_solicitud);?></td>
                            <td><b><?php echo  htmlspecialchars($solicitud->nombre_sociedades);?></b></td>
                            <td><?php echo  htmlspecialchars($solicitud->nombre);?></td>
                            <td>
                                <button
                                style="color:white; background-color: red; display: <?php echo ($is_required_mfa && $totp_secret != null) ? 'inline-block' : 'none'; ?>;"
                                class="btn btn-sm mt-2 btn_validar_mfa" data-id="<?php echo $solicitud->id_solicitud; ?>" data-qr="<?php echo $filename; ?>" data-ismfaenabled="<?php echo $is_mfa_enabled; ?>" data-totpsecret="<?php echo $totp_secret; ?>">
                                <i class="fas fa-lock"></i></button>
                                                                
                                <a 
                                    style="display: <?php echo ($is_required_mfa && $totp_secret != null) ? 'none' : 'inline-block'; ?>;"
                                    class="btn btn-primary btn-sm mt-2 btnVerDetalles" data-id="<?php echo $solicitud->id_solicitud; ?>" 
                                    href="../views/verSolicitud.php?numero_solicitud=<?php echo $solicitud->id_solicitud;?>" class="btn btn-primary">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Modal MFA -->
        <div class="modal fade" id="mfaModal" tabindex="-1" aria-labelledby="mfaModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mfaModalLabel">Autenticación de Dos Factores</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formMFA">
                            <div class="form-group text-center" id="qrCodeContainer">
                                <label for="">Escanea este c&oacute;digo QR con tu aplicaci&oacute;n de autenticaci&oacute;n</label>
                                <img id="img_qr" class="img_qr" alt="Código QR">
                            </div>
                            <div class="form-group" id="mfaCodeContainer">
                                <label for="mfaCode">C&oacute;digo de Autenticaci&oacute;n</label>
                                <input type="text" class="form-control" id="mfaCode" name="mfa_code" maxlength="6" placeholder="Ingresa el código de autenticación" required>
                            </div>
                            <input type="hidden" id="totpsecret">
                            <input type="hidden" id="idsolicitudmfa">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary" id="btnSubmitMFA">Enviar</button>
                    </div>
                </div>
            </div>
        </div> 
    </div>


    <?php include_once "footer/footer_views.php"; ?>

</body>
</html>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/preview/searchPane/dataTables.searchPane.min.js"></script>
    <!-- script para el SearchPane del datatable -->
    <!-- JS de Botones y Funcionalidades de Exportación -->
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
    <script>
$(document).ready(function() {
    $('#tablaSolicitudes').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: 'Datos de Personas',
                className: 'btn btn-success'
            },
            {
                extend: 'pdfHtml5',
                title: 'Datos de Personas',
                className: 'btn btn-danger'
            }
        ],
        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
        }
    });

    $('.btn_validar_mfa').click(function() {
        $('#img_qr').attr('src', $(this).data('qr'));
        $('#totpsecret').val($(this).data('totpsecret'));
        $('#idsolicitudmfa').val($(this).data('id'));
        if($(this).data('ismfaenabled')==true){
            $('#qrCodeContainer').hide(); // Ocultar el contenedor del código QR si MFA está habilitado
            $('#mfaCodeContainer').show(); // Mostrar el campo de código MFA
        } else {
            $('#qrCodeContainer').show(); // Mostrar el contenedor del código QR si MFA no está habilitado
            $('#mfaCodeContainer').show(); // Mostrar el campo de código MFA
        }
        $('#mfaCode').val(''); // Limpiar el campo de código MFA
        $('#mfaModal').modal('show'); 
    });

    $('#btnSubmitMFA').click(function() {
        var mfaCode     = $('#mfaCode').val().trim();
        var totpSecret  = $('#totpsecret').val().trim();
        var idSolicitud = $('#idsolicitudmfa').val().trim();
        if (mfaCode === '') {
            alert('Por favor, ingresa el código de autenticación.');
            return;
        }
        $.ajax({ 
            url: '../controller/mfaController.php',
            method: 'POST',
            data: { 
                action: 'validarMFASolicitud',
                mfa_code: mfaCode,
                totp_secret: totpSecret,
                id_solicitud: idSolicitud
            },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    alert('Autenticación exitosa.');
                    // Mostrar el boton de clase btnVerDetalles con el mismo id de la sociedad
                    $('.btnVerDetalles').each(function() {
                        if ($(this).data('id') === idSolicitud) {
                            $(this).show(); // Mostrar el botón si coincide el ID
                        }
                    }); 
                    $('.btn_validar_mfa').each(function() { 
                        if ($(this).data('id') === idSolicitud) {
                            $(this).hide(); // Ocultar el botón si coincide el ID
                        }
                    });
                    $('#mfaModal').modal('hide');
                    window.location.href = '../views/verSolicitud.php?numero_solicitud=' + idSolicitud;
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error en la solicitud AJAX:', error);
                alert('Error al validar el código MFA. Por favor, inténtalo de nuevo.');
            }
        });

    });

});
</script>