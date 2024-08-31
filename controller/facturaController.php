<?php
require_once "../model/modelFacturacion.php";

class FacturaController {
    
    public function listarFacturas() {
        try {
            $modelo = new ModelFacturacion();
            $resultado = $modelo->listarFacturas();
            header('Content-Type: application/json'); // Asegúrate de que la respuesta sea JSON
            echo json_encode($resultado);
        } catch (Exception $e) {
            header('Content-Type: application/json');
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function listarFacturasPagadas() {
        try {
            $modelo = new ModelFacturacion();
            $resultado = $modelo->listarFacturasPagadas();
            header('Content-Type: application/json'); // Asegúrate de que la respuesta sea JSON
            echo json_encode($resultado);
        } catch (Exception $e) {
            header('Content-Type: application/json');
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function listarServicios() {
        try {
            $modelo = new ModelFacturacion();
            $resultado = $modelo->listarServicios();
            header('Content-Type: application/json'); // Asegúrate de que la respuesta sea JSON
            echo json_encode($resultado);
        } catch (Exception $e) {
            header('Content-Type: application/json');
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    
        public function insertarRevision() {
            $id_solicitud = $_POST['id_solicitud'];
            // Asumiendo que 'resource' es la carpeta dentro de la raíz del proyecto donde quieres guardar los archivos
            $uploadsDir = __DIR__ . '/resource/';
            $folderName = $id_solicitud; // La nueva subcarpeta para las revisiones
    
            // Ruta completa al directorio de revisiones
            $revisionPath = $uploadsDir . '/' . $folderName . '/';
    
            // Verificar si la carpeta de revisiones existe
            if (!file_exists($revisionPath)) {
                // Intenta crear la carpeta con permisos adecuados
                if (!mkdir($revisionPath, 0777, true)) {
                    die("Error al crear la carpeta de revisiones.");
                }
            }
    
            // Procesamiento del archivo subido
            if (isset($_FILES['payment_image']) && $_FILES['payment_image']['error'] === UPLOAD_ERR_OK) { // Cambia 'archivo' por 'payment_image'
                $fileName = $_FILES['payment_image']['name']; // Cambia 'archivo' por 'payment_image'
                // Asegurarse de limpiar el nombre del archivo para evitar vulnerabilidades
                $fileName = basename($fileName);
                $filePath = $revisionPath . $fileName;
                $payment_notes = $_POST['payment_notes'];
                $payment_option = $_POST['payment_option'];
    
                // Crear array para envío al modelo e inserción a BD
                $datos = array(
                    "payment_notes" => $payment_notes,
                    "payment_option" => $payment_option,
                    "nombre_archivo" => $fileName,
                    "solicitud" => $id_solicitud
                );
    
                // Envío a módulo para inserción
                $respuesta = ModelFacturacion::uploadInvoice($datos);
    
                if ($respuesta == "ok") {
                    echo 0; // Éxito
                } else {
                    echo 1; // Error
                }
    
                // Mover el archivo al directorio de revisiones
                if (move_uploaded_file($_FILES['payment_image']['tmp_name'], $filePath)) { // Cambia 'archivo' por 'payment_image'
                    // El archivo se ha cargado correctamente
                    // Aquí se podría incluir más lógica para manejar el archivo cargado,
                    // como insertar detalles en la base de datos.
                    echo "Archivo cargado con éxito: " . $fileName . " variable: " . $payment_option . "&&&" . $id_solicitud;
                } else {
                    // Error al mover el archivo
                    echo "Error al mover el archivo.";
                }
            } else {
                // No se recibió ningún archivo válido o hubo un error en la carga
                echo "No se ha seleccionado ningún archivo o ocurrió un error al cargarlo.";
            }
        }

        public function actualizarFactura() {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (isset($_POST['id_solicitud']) && isset($_POST['id'])) {
                    // Preparar los datos para pasarlos al modelo
                    $datos = [
                        'id_solicitud' => $_POST['id_solicitud'],
                        'id' => $_POST['id']
                    ];
                    
                    // Llamar al modelo para actualizar la factura
                    $resultado = ModelFacturacion::actualizarEstadoFactura($datos);
        
                    // Verificar el resultado y enviar la respuesta
                    if ($resultado == "ok") {
                        echo json_encode(['success' => true]);
                    } else {
                        echo json_encode(['success' => false, 'message' => 'Error al actualizar la factura']);
                    }
                } else {
                    echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Método no permitido']);
            }
        }
}
    

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'listarFacturas') {
    $controller = new FacturaController();
    $controller->listarFacturas();
}

if (isset($_POST['accion']) && $_POST['accion'] === 'insertarPagoInvoice') {
    $controlador = new FacturaController();
    $controlador->insertarRevision(); // Asegúrate de que este método existe y es el correcto
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] ==  'listarFacturasPagadas') {
    
    $controlador = new FacturaController();
    $controlador->listarFacturasPagadas(); // Asegúrate de que este método existe y es el correcto
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] ==  'listarServicios') {
    
    $controlador = new FacturaController();
    $controlador->listarServicios(); // Asegúrate de que este método existe y es el correcto
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] ==  'actualizarFactura') {
    

        $controlador = new FacturaController();
        $controlador->actualizarFactura();
   
    // Puedes seguir añadiendo otros elseif para diferentes acciones aquí.
}
?>