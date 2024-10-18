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
                try {
                    // Incluir el autoload de Composer
                    require_once '../resource/vendor/autoload.php';
    
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
                    
                    <p>Fecha: ' . $acta['createat'] . '</p>
                   
                    <div>' . $acta['contenido_html'] . '</div>';
    
                    // Convertir el contenido HTML y agregarlo al PDF
                    $pdf->writeHTML($contenidoHtml, true, false, true, false, '');
    
                    // Definir la ruta de almacenamiento temporal del PDF
                    $pdfFileName = 'acta_' . $id_solicitud . '.pdf';
                    $tempDir = __DIR__ . '/../temp/';
                    if (!is_dir($tempDir)) {
                        mkdir($tempDir, 0777, true); // Crea la carpeta si no existe
                    }
                    $pdfFilePath = $tempDir . $pdfFileName;
                    // Guardar el PDF en el servidor
                    $pdf->Output($pdfFilePath, 'F'); // Guardar el PDF en el servidor
    
                    // Devolver la URL del PDF
                    echo json_encode(['status' => 'success', 'pdf_url' => $pdfFilePath]);
    
                } catch (Exception $e) {
                    echo json_encode(['status' => 'error', 'message' => 'Error al generar el PDF: ' . $e->getMessage()]);
                }
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
