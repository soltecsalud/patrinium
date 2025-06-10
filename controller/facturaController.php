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

        public function pagarFacturaRapida(){
            $id_factura = $_POST['id_factura'];
            // Asumiendo que 'resource' es la carpeta dentro de la raíz del proyecto donde quieres guardar los archivos
            $uploadsDir = '../documents/quick_invoices';
            $folderName = $id_factura; // La nueva subcarpeta para las revisiones

            // Ruta completa al directorio de revisiones
            $revisionPath = $uploadsDir . '/' . $folderName . '/';

            // Verificar si la carpeta de revisiones existe
            if (!file_exists($revisionPath)) {
                // Intenta crear la carpeta con permisos adecuados
                if (!mkdir($revisionPath, 0777, true)) {
                    die($revisionPath);
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
                    "payment_notes"  => $payment_notes,
                    "payment_option" => $payment_option,
                    "nombre_archivo" => $fileName,
                    "idfactura"      => $id_factura 
                );
    
                // Envío a módulo para inserción
                $respuesta = ModelFacturacion::mdlPagarFacturaRapida($datos);
    
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
                    echo "Archivo cargado con éxito: " . $fileName . " variable: " . $payment_option . "&&&" . $id_factura;
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

        public function actualizarDatosFactura() {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $idFactura       = $_POST['idFactura'];
                $estado          = $_POST['estado'];
                $logo            = $_POST['logo'];
                $total_factura   = $_POST['total_factura'];
                $cuenta_bancaria = $_POST['cuenta_bancaria'];
                $observaciones   = $_POST['observaciones'];
                $invoice_number  = $_POST['invoice_number']; 
                $email           = $_POST['email'];
                $adress          = $_POST['adress'];
                $tax             = $_POST['tax'];
                $number_tax      = $_POST['numberTax'];
                $selectPersonaFactura = $_POST['selectPersonaFactura'];

                $datos = [
                    "logo" => $logo,
                    "Total" => $total_factura,
                    "cuenta_bancaria" => $cuenta_bancaria,
                    "observaciones" => $observaciones,
                    "invoice_number" => $invoice_number,
                    "email" => $email,
                    "adress" => $adress,
                    "tax" => $tax,
                    "number_tax" => $number_tax,
                    "selectPersonaFactura" => $selectPersonaFactura,
                    "servicios" => []
                ];

                foreach ($_POST as $clave => $valor) {
                    if (strpos($clave, 'cantidad') === 0) {
                        $key = substr($clave, 8); // Extraer la parte después de 'cantidad'
                        $key = str_replace('_', ' ', $key);
                        $datos['servicios'][$key]['cantidad'] = $valor;
                    } elseif (strpos($clave, 'valor') === 0) {
                        $key = substr($clave, 5); // Extraer la parte después de 'valor'
                        $key = str_replace('_', ' ', $key);
                        $datos['servicios'][$key]['valor'] = $valor;
                    } elseif (strpos($clave, 'check') === 0) {
                        $key = substr($clave, 5);
                        $key = str_replace('_', ' ', $key);
                        $datos['servicios'][$key]['check'] = $valor;
                    }else if(strpos($clave, 'descripcionservicio') === 0){
                        $key = substr($clave, 19);
                        $key = str_replace('_', ' ', $key);
                        $datos['servicios'][$key]['descripcionservicio'] = $valor;
                    }
                }

                // echo json_encode(["status" => 'ok' , "datos" => $datos,"idFactura" => $idFactura]); // Para depuración

                $respuesta = ModelFacturacion::actualizarFactura($datos, $idFactura);
                header('Content-Type: application/json');
                if ($respuesta == "ok") {
                    echo json_encode(["status" => 'ok']); // Éxito
                } else {
                    echo json_encode(["status" => 'error']); // Error
                } 
            
            } else {
                echo json_encode(['success' => false, 'message' => 'Método no permitido']);
            }
        }

        public function eliminarFactura(){
            try {
                $idFactura = $_POST['idFactura'];
                // Llamar al modelo para eliminar la factura
                $resultado = ModelFacturacion::eliminarFactura($idFactura);

                // Verificar el resultado y enviar la respuesta
                if ($resultado == "ok") {
                    echo json_encode(['status' => 'ok']);
                } else {
                    echo json_encode(['status' => 'error']);
                }
            } catch (Exception $e) {
                echo json_encode(['status' => 'ok', 'message' => $e->getMessage()]);
            }
        }
        public function obtenerTiposPago() {
            try {
                $resultado = ModelFacturacion::obtenerTiposPago();
                header('Content-Type: application/json');
                echo json_encode($resultado);
            } catch (Exception $e) {
                echo json_encode(['error' => $e->getMessage()]);
            }
        }

        public function obtenerInvoiceNumber($campo, $tipo_factura) {
            // Verifica si el campo está vacío  
            try {
                
                switch ($tipo_factura) { 
                    case 'factura':
                        $resultado = ModelFacturacion::buscarInvoiceNumber($campo);
                        break;
                    case 'facturarapida':
                        $resultado = ModelFacturacion::buscarInvoiceNumberFacturaRapida($campo);
                        break;
                    default:
                        throw new Exception('Tipo de factura no válido');
                }
                
                // $resultado = ModelFacturacion::buscarInvoiceNumber($campo);
                header('Content-Type: application/json'); // Asegúrate de que la respuesta sea JSON
                if ($resultado) {
                    echo json_encode(["status" => "ok"]);
                } else {
                    echo json_encode(["status" => "error"]);
                }
            } catch (Exception $e) {
                header('Content-Type: application/json');
                echo json_encode(['error' => $e->getMessage()]);
            }
        }

}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['accion'] == 'obtenerTiposPago') {
    $controlador = new FacturaController();
    $controlador->obtenerTiposPago();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'listarFacturas') {
    $controller = new FacturaController();
    $controller->listarFacturas();
}

if (isset($_POST['accion']) && $_POST['accion'] === 'insertarPagoInvoice') {
    $controlador = new FacturaController();
    $controlador->insertarRevision(); // Asegúrate de que este método existe y es el correcto
}

if (isset($_POST['accion']) && $_POST['accion'] === 'insertarPagoFacturaRapida') {
    $controlador = new FacturaController();
    $controlador->pagarFacturaRapida(); // Asegúrate de que este método existe y es el correcto
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['accion'] ==  'eliminarFactura') {
    $controlador = new FacturaController();
    $controlador->eliminarFactura(); 
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['accion'] ==  'actualizarDatosFactura') {
    $controlador = new FacturaController();
    $controlador->actualizarDatosFactura(); 
    // echo json_encode(['status' => 'ok', 'message' => 'Método no permitido']);
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
// Busca si ya existe el Invoice Number
if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['accion']) && $_GET['accion'] == 'buscarInvoiceNumber'){
    $campo        = isset($_GET['input']) ? $_GET['input'] : null; 
    $tipo_factura = isset($_GET['tipo_factura']) ? $_GET['tipo_factura'] : null;
    $controlador  = new FacturaController();
    $controlador->obtenerInvoiceNumber($campo, $tipo_factura);
}
?>