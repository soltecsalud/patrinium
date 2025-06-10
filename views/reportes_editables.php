<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
    exit();
} elseif (isset($_SESSION['usuario']) && $_SESSION['generar reportes'] === false) {
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
                                    <select id="plantilla" name="plantilla" class="form-select">
                                        <option value="" disabled selected>Elige una plantilla</option>
                                    </select>
                            <form id="plantillaForm">
                            <div class="row" style="padding-top: 2%;">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="nombre">Cargar A:</label>
                                            <select id="id_solicitud_select" name="id_solicitud" class="form-select">
                                                <option value="" disabled selected>Elige una Sociedad</option>
                                            </select>
                                        </div>
                                    </div>
                                        
                                </div>
                                <div class="row" style="padding-top: 2%;">
                                    <label for="">Editar Plantilla:</label>
                                    <div class="col-md-12" >
                                        <textarea name="editorContent" id="editor"></textarea>
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
    menubar: true,
    plugins: 'advlist autolink lists link image charmap preview anchor ' +
             'searchreplace visualblocks code fullscreen ' +
             'insertdatetime media table paste help wordcount',
    toolbar: 'undo redo | formatselect fontsizeselect | ' +
             'bold italic underline strikethrough | forecolor backcolor | ' +
             'alignleft aligncenter alignright alignjustify | ' +
             'bullist numlist outdent indent | removeformat',
    font_size_formats: '8pt 10pt 12pt 14pt 18pt 24pt 36pt',
    height: 1600,
    width: '100%',
    branding: false,
    content_style: `
        body {
            width: 216mm;
            min-height: 240mm;
            margin: auto;
            background: white;
            padding: 1cm;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            position: relative;
        }
        .page-end {
            display: block;
            width: 100%;
            height: 2px;
            border-bottom: 2px dashed blue;
            margin-top: 10px;
            margin-bottom: 10px;
        }
    `,
    setup: function (editor) {
        editor.on('init', function () {
            editor.setContent(<?php echo json_encode($htmlContent); ?>);
            updatePageMarkers(editor);
        });

        editor.on('input', function () {
            updatePageMarkers(editor);
        });
    }
});

/**
 * Insertar líneas punteadas al final de cada hoja (~240mm)
 */
function updatePageMarkers(editor) {
    const body = editor.getBody();
    body.querySelectorAll(".page-end").forEach(marker => marker.remove());

    const pageHeightPx = 240 * 3.779528; // 240mm a px
    const totalHeight = body.scrollHeight;
    const totalPages = Math.floor(totalHeight / pageHeightPx);

    for (let i = 1; i <= totalPages; i++) {
        const marker = document.createElement("div");
        marker.className = "page-end";
        marker.style.position = "absolute";
        marker.style.top = `${i * pageHeightPx}px`;
        body.appendChild(marker);
    }
}
</script>
<script>
/**
 * Función para recalcular los saltos de página
 */
function updatePageMarkers(editor) {
    let allMarkers = editor.getBody().querySelectorAll(".page-end");
    allMarkers.forEach(marker => marker.remove()); // Eliminar los marcadores antiguos

    let pageHeight = 240 * 3.779528; // Convertir mm a píxeles
    let totalPages = Math.floor(editor.getBody().scrollHeight / pageHeight);

    for (let i = 1; i <= totalPages; i++) {
        let pageMarker = document.createElement("div");
        pageMarker.className = "page-end";
        pageMarker.style.position = "absolute";
        pageMarker.style.top = `${i * pageHeight}px`; 
        editor.getBody().appendChild(pageMarker);
    }
}
// Evento de cambio en el select para cargar la plantilla seleccionada
$('#plantilla').on('change', function () {
    var plantilla = $(this).val(); // Obtener el valor seleccionado (nombre del archivo .docx)

    // Hacer una llamada AJAX para cargar el contenido de la plantilla
    $.ajax({
        url: '../controller/plantillasController.php',  // Controlador para cargar la plantilla
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
    var idSolicitud = $('#id_solicitud_select').val(); // Obtener el valor seleccionado del select

    // Verifica en la consola si el idSolicitud se obtiene correctamente
   // console.log("ID de Solicitud seleccionado: " + idSolicitud);

    // Asegúrate de que el idSolicitud esté definido
    if (idSolicitud === undefined || idSolicitud === null || idSolicitud === "") {
        alert("Por favor selecciona una solicitud");
        return;
    }

    $.ajax({
        url: '../controller/plantillasController.php',
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

$(document).ready(function() {
    $.ajax({
        url: '../controller/plantillasController.php',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            var select = $('#id_solicitud_select');
            select.empty();
            select.append('<option value="" disabled selected>Elige una sociedad</option>');
            $.each(data, function(index, item) {
                select.append('<option value="' + item.uuid + '"> '+item.nombre_sociedad + '</option>');
            });
        },
        error: function(xhr, status, error) {
            console.error('Error fetching data: ', error);
        }
    });
});
</script>  
<script>
$(document).ready(function() {
    $.ajax({
        url: '../controller/plantillasController.php?action=listar',
        type: 'GET',
        dataType: 'json',
		
        success: function(response) {
			 console.log('====plantillas====');
            console.log(response);
            if (response.length > 0) {
                response.forEach(function(plantilla) {
                    $('#plantilla').append('<option value="' + plantilla.nombre_archivo + '">' + plantilla.nombre.toUpperCase() + '</option>');
                });
            } else {
                $('#plantilla').append('<option disabled>No hay plantillas disponibles</option>');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error al obtener las plantillas:', error);
			console.error('AJAX error - Falló la petición');
            console.log('XHR:', xhr);
            console.log('Status:', status);
            console.log('Error:', error);
        }
    });
});
</script>
