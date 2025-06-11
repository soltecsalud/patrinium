<?php
require_once '../model/modelPlantillas.php';
require_once '../resource/vendor/autoload.php'; // Asegúrate de tener TCPDF instalada con Composer

class GenerarPdfController {
//revisar git
    // Función para mostrar el contenido HTML
    public function verHtml() {
        if (isset($_POST['id_solicitud'])) {
            $id_solicitud = $_POST['id_solicitud'];
            
            // Obtener el contenido HTML desde la base de datos
            if(isset($_POST['idSociedad'])){
                $actas = ModelPlantillas::obtenerActaPorSolicitudxSociedad($id_solicitud, $_POST['idSociedad']);
            }else{
                $actas = ModelPlantillas::obtenerActaPorSolicitud($id_solicitud);
            }

            if ($actas) {
                // Devolver tanto la fecha como el contenido HTML
                echo json_encode([
                    'status' => 'success',  
                    'data' => $actas
                ]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Acta no encontrada']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Faltan parámetros']);
        }
    }
    // Función para generar el PDF usando TCPDF

    public function generarPdf() {
        
        if (isset($_POST['id_solicitud'])) {
            $id_solicitud = $_POST['id_solicitud'];
    
            // Obtener el contenido HTML desde la base de datos
            if(isset($_POST['idSociedad'])){
                $acta = ModelPlantillas::obtenerHtmlPDFPorSociedad($id_solicitud,$_POST['idSociedad']);
            }else{
                $acta = ModelPlantillas::obtenerHtmlPorId($id_solicitud);
            }
            if (isset($acta['error'])) {
                echo json_encode(['status' => 'error', 'message' => 'Error SQL: ' . $acta['error']]);
                exit;
            }
            if ($acta) {
                try {
                    // Incluir el autoload de Composer
                    require_once '../resource/vendor/autoload.php';
    
                    // Crear una instancia de TCPDF
                
                    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, array(216, 279), true, 'UTF-8', false);
                    $pdf->setPrintHeader(false); // Desactiva encabezado
                    $pdf->setPrintFooter(false); // Desactiva pie de página
                    
                    // Establecer los metadatos del documento
                    $pdf->SetCreator(PDF_CREATOR);
                    $pdf->SetAuthor('Autor del Documento');
                    $pdf->SetTitle('Título del Documento');
                    $pdf->SetSubject('Asunto del Documento');
                    $pdf->SetKeywords('PDF, acta, HTML');
    
                    // Añadir una página
                    $pdf->AddPage();
                    $pdf->SetLineStyle(array('width' => 1, 'color' => array(0, 0, 0), 'dash' => '2,2'));
                    $pdf->Rect(3, 3, 210, 272); // Ajusta según el tamaño del margen

                    // Definir el contenido HTML con estilos CSS
                    $contenidoHtml = '
                    <style>
                        h1 {
                            color: navy;
                            font-family: times;
                            font-size: 24pt;
                        }
                        p {
                            color: black;
                            font-family: helvetica;
                            font-size: 12pt;
                        }
                        .custom-table {
                            width: 100%;
                            border-collapse: collapse;
                        }
                        .custom-table th, .custom-table td {
                            border: 1px solid black;
                            padding: 8px;
                            text-align: left;
                        }
                        .custom-table th {
                            background-color: #f2f2f2;
                        }
                    </style>
                    
                
                    <div>' . $acta['contenido_html'] . '</div>';

        
    
                    // Convertir el contenido HTML y agregarlo al PDF
                    $pdf->writeHTML($contenidoHtml, true, false, true, false, '');
    
                    // Definir la ruta de almacenamiento del PDF
                    $pdfFileName = 'acta_' . $id_solicitud . '.pdf';
                    $tempDir = __DIR__ . '/../temp/';
                    if (!is_dir($tempDir)) {
                        mkdir($tempDir, 0777, true); // Crea la carpeta si no existe
                    }
                    $pdfFilePath = $tempDir . $pdfFileName;
    
                    // Guardar el PDF en el servidor
                    $pdf->Output($pdfFilePath, 'F');
    
                    // Devolver la URL completa del PDF
                    $pdfUrl = '../temp/' . $pdfFileName;
                    echo json_encode(['status' => 'success', 'pdf_url' => $pdfUrl]);
    
                } catch (Exception $e) {
                    echo json_encode(['status' => 'error', 'message' => 'Error al generar el PDF: ' . $e->getMessage()]);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Acta no encontrada 2']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Faltan parámetros']);
        }

    }

    public function guardarChecklist() {
        if (isset($_POST['id_solicitud'])) {
            $id_solicitud = $_POST['id_solicitud'];
            $idSociedad   = $_POST['idSociedad'];
            // $checklist    = $_POST['items'];
            // Convertir todo el POST a JSON sin modificar la estructura
            $checklist = json_encode($_POST['items'], JSON_UNESCAPED_UNICODE);

            $consultarExisteSociedad = ModelPlantillas::consultarExisteSociedad($idSociedad);
            if (!$consultarExisteSociedad) {
                // echo json_encode(['status' => 'error', 'message' => 'La sociedad no existe']);
                // exit;
                $guardar = ModelPlantillas::guardarChecklist($idSociedad,$id_solicitud,$checklist); 
                if ($guardar) {
                    echo json_encode(['status' => 'success', 'message' => 'Checklist guardado correctamente']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Error al guardar el checklist']);
                }
            }else{
                $guardar = ModelPlantillas::actualizarChecklist($idSociedad,$id_solicitud,$checklist); 
                if ($guardar) {
                    echo json_encode(['status' => 'success', 'message' => 'Checklist actualizado correctamente']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Error al actualizar el checklist']);
                }
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Faltan parámetros 3']);
        }
    }

    public function selectChecklist() {
        if (isset($_POST['id_solicitud'])) {
            $id_solicitud = $_POST['id_solicitud'];
            $idSociedad   = $_POST['idSociedad'];
            $consultar  = ModelPlantillas::selectChecklist($idSociedad,$id_solicitud);
            if ($consultar) {
                echo json_encode(['status' => 'success', 'data' => $consultar]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error al consultar el checklist']);
            }
        }else{
            echo json_encode(['status' => 'error', 'message' => 'Faltan parámetros 4']);
        }
    }

    public function actualizarHtml() { 
        if (isset($_POST['id_plantilla']) && isset($_POST['contenido_html'])) {
            $id_plantilla = $_POST['id_plantilla'];
            $html_content = $_POST['contenido_html'];

            // Actualizat el HTML en la base de datos
            $guardar = ModelPlantillas::actualizarPlantillaHtml($id_plantilla, $html_content);
            if ($guardar) {
                echo json_encode(['status' => 'success', 'message' => 'HTML guardado correctamente']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error al guardar el HTML']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Faltan parámetros']);
        }
    }

}    

$controller = new GenerarPdfController();



if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'obtenerActas':
            $controller->verHtml();
            break;
        case 'generarPdf': // Agregado para generar PDF
            $controller->generarPdf();
            break;
        case 'actualizarHtml':
            $controller->actualizarHtml();
            break;
        case 'guardarChecklist':
            $controller->guardarChecklist();
            break;
        case 'selectChecklist':
            $controller->selectChecklist();
            break;
        default:
            echo json_encode(['status' => 'error', 'message' => 'Acción no válida']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Faltan parámetros']);
}
?>
