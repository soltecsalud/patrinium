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
            $acta = ModelPlantillas::obtenerActaPorSolicitud($id_solicitud);
    
            if ($acta) {
                // Devolver tanto la fecha como el contenido HTML
                echo json_encode([
                    'status' => 'success', 
                    'data' => [
                        'fecha' => $acta['createat'],
                        'contenido_html' => $acta['contenido_html']
                    ]
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
            $acta = ModelPlantillas::obtenerActaPorSolicitud($id_solicitud);

            if ($acta) {
                // Crear una instancia de TCPDF
                $pdf = new TCPDF();
                
                // Establecer los metadatos del documento
                $pdf->SetCreator(PDF_CREATOR);
                $pdf->SetAuthor('Autor del Documento');
                $pdf->SetTitle('Título del Documento');
                $pdf->SetSubject('Asunto del Documento');
                $pdf->SetKeywords('PDF, acta, HTML');

                // Añadir una página
                $pdf->AddPage();

                // Convertir el contenido HTML y agregarlo al PDF
                $contenidoHtml = $acta['contenido_html'];
                $pdf->writeHTML($contenidoHtml, true, false, true, false, '');

                // Guardar el archivo PDF en el servidor
                $pdfFileName = '../pdfs/acta_' . $id_solicitud . '.pdf';
                $pdf->Output($pdfFileName, 'F'); // Guardar el PDF

                // Devolver la URL del PDF generado
                echo json_encode(['status' => 'success', 'pdf_url' => $pdfFileName]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Acta no encontrada']);
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
        case 'generarPdf':
            $controller->generarPdf();
            break;
        default:
            echo json_encode(['status' => 'error', 'message' => 'Acción no válida']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Faltan parámetros']);
}
?>
