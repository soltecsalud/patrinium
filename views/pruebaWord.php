<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
    exit();
} elseif (isset($_SESSION['usuario']) && $_SESSION['casos'] === false) {
    echo 'Acesso no autorizado.';
    exit();
}

require_once '../resource/vendor/autoload.php';

use PhpOffice\PhpWord\IOFactory;

$wordFile = '../resource/plantillas/CompanyInformationDetails.docx';
$phpWord = IOFactory::load($wordFile);


// Convertir el contenido del archivo Word a HTML
$htmlWriter = IOFactory::createWriter($phpWord, 'HTML');
ob_start(); // Inicia el buffer de salida
$htmlWriter->save('php://output');
$htmlContent = ob_get_contents(); // Captura el contenido generado en HTML
ob_end_clean();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once "head/head_views.php"; ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
	   <script src="../resource/vendor/tinymce/tinymce/tinymce.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                            <h3 class="card-title">Edicion De Plantillas</h3>

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
                        <label for="plantilla">Seleccionar plantilla:</label>
                                <select id="plantilla" name="plantilla">
                                    <option value="" disabled selected>Elige una plantilla</option>
                                    <option value="CompanyInformationDetails.docx">Company Information Details</option>
                                    <option value="Certificate_Of_Formation.docx">Certificate Of Formation</option>
                                    <!-- Puedes agregar más plantillas aquí -->
                                </select>
                            <form id="plantillaForm">
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <textarea name="editorContent" id="editor"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="nombre">Id Solicitud</label>
                                            <select name="id_solicitud" id="id_solicitud">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                            </select>
                                        </div>
                                    </div>
                                        
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="hidden" name="">
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                                </div>
							
							</form>
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
            tinymce.init({
                selector: '#editor',
                menubar: false,
                plugins: 'advlist autolink lists link charmap print preview anchor',
                toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright alignjustify',
                setup: function (editor) {
                    editor.on('init', function () {
                        editor.setContent(<?php echo json_encode($htmlContent); ?>);
                    });
                }
            });
// Evento de cambio en el select para cargar la plantilla seleccionada
$('#plantilla').on('change', function () {
    var plantilla = $(this).val(); // Obtener el valor seleccionado (nombre del archivo .docx)

    // Hacer una llamada AJAX para cargar el contenido de la plantilla
    $.ajax({
        url: '../controller/PlantillasController.php',  // Controlador para cargar la plantilla
        method: 'POST',
        data: { 
            action: 'seleccionarPlantilla', 
            plantilla: plantilla 
        },
        success: function (response) {
            // Establecer el contenido en TinyMCE cuando la plantilla sea cargada
            tinymce.get('editor').setContent(response);
        },
        error: function () {
            alert('Error al cargar la plantilla.');
        }
    });
});

// Enviar el contenido del formulario por AJAX para guardarlo
$('#plantillaForm').on('submit', function (e) {
    e.preventDefault(); // Prevenir que se envíe de forma tradicional

    var editorContent = tinymce.get('editor').getContent(); // Obtener el contenido del editor
    var idSolicitud = $('#id_solicitud').val(); // Obtener el valor seleccionado del select

    // Verifica en la consola si el idSolicitud se obtiene correctamente
   // console.log("ID de Solicitud seleccionado: " + idSolicitud);

    // Asegúrate de que el idSolicitud esté definido
    if (idSolicitud === undefined || idSolicitud === null || idSolicitud === "") {
        alert("Por favor selecciona una solicitud");
        return;
    }

    $.ajax({
        url: '../controller/PlantillasController.php',
        method: 'POST',
        data: { 
            action: 'insertar', 
            editorContent: editorContent, 
            id_solicitud: idSolicitud // Pasar el valor del select id_solicitud
        },
        success: function (response) {
            var res = JSON.parse(response);
            if (res.status === 'success') {
                alert('Contenido guardado correctamente');
            } else {
                alert('Error al guardar el contenido.');
            }
        },
        error: function () {
            alert('Error al guardar el contenido.');
        }
    });
});
    </script>  
  