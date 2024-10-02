<?php
require_once '../model/modelPlantillas.php';
require_once '../resource/vendor/autoload.php'; // Para usar PHPWord

use PhpOffice\PhpWord\IOFactory;

class PlantillasController {

    // Método para insertar el contenido HTML en la base de datos
    public function insertar() {
        if (isset($_POST['editorContent']) && isset($_POST['id_solicitud'])) {
            $contenido_html = $_POST['editorContent'];
            $id_solicitud = $_POST['id_solicitud'];

            // Aquí puedes manejar el usuario que hace el guardado, por ejemplo, si está almacenado en sesión
            $usuario = 'admin'; // Esto debería ser dinámico según el usuario conectado

            // Guardar el contenido HTML en la base de datos
            $result = ModelPlantillas::guardarContenido($contenido_html, $usuario, $id_solicitud);

            if ($result) {
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Faltan parámetros']);
        }
    }

    // Método para seleccionar y cargar una plantilla (Word) y devolverla como HTML
    public function seleccionarPlantilla() {
        if (isset($_POST['plantilla'])) {
            $plantillaFile = '../resource/plantillas/' . $_POST['plantilla']; // Ruta de la plantilla seleccionada
            
            try {
                // Cargar el archivo Word
                $phpWord = IOFactory::load($plantillaFile);
                
                // Convertir el contenido a HTML
                $htmlWriter = IOFactory::createWriter($phpWord, 'HTML');
                ob_start(); // Iniciar el buffer de salida
                $htmlWriter->save('php://output');
                $htmlContent = ob_get_contents(); // Capturar el HTML
                ob_end_clean();
                
                // Devolver el contenido HTML como respuesta
                echo $htmlContent;
            } catch (Exception $e) {
                echo json_encode(['status' => 'error', 'message' => 'Error al cargar la plantilla: ' . $e->getMessage()]);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Faltan parámetros']);
        }
    }
}

// Procesar la solicitud
$controller = new PlantillasController();

// Determinar la acción que se debe ejecutar
if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'insertar':
            $controller->insertar();
            break;
        case 'seleccionarPlantilla':
            $controller->seleccionarPlantilla();
            break;
        default:
            echo json_encode(['status' => 'error', 'message' => 'Acción no válida']);
    }
}
?>
