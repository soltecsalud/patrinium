<?php
include_once "../model/modelSolicitud.php";

class Solicitud_controller{
    
    public function getSolicitud($id_solicitud) {
        $id_solicitud_model=$id_solicitud;
        $modelo = new ModelSolicitud();
        $solicitud = $modelo->obtenerSolicitud($id_solicitud_model);
        return $solicitud;
    }

    public function getServiciosOfrecidos(){        
        $modelo = new ModelSolicitud();
        $solicitud = $modelo->getServiciosOfrecidos();
        $solicitud = json_encode($solicitud);
        echo $solicitud;
    }


    public function getListadoSolicitudes() {
      
        $modelo = new ModelSolicitud();
        $solicitud = $modelo->obtenerAllSolicitud();
        return $solicitud;
    }

    public function getServicios($id_enviado_desde_vista){
        $id_solicitud = $id_enviado_desde_vista;
        $modelo = new ModelSolicitud();
        $solicitud = $modelo->obtenerServicios($id_solicitud);
        return $solicitud;
    }

    public function getSociedad($id_enviado_desde_vista){
        $id_solicitud = $id_enviado_desde_vista;
        $modelo = new ModelSolicitud();
        $solicitud = $modelo->obtenerSociedad($id_solicitud);
        return $solicitud;
    }

    public function verificarAdjuntoSolicitud($id_solicitud_adjunto) {
        $id_solicitud_adjunto_model = $id_solicitud_adjunto;
        $modelo = new ModelSolicitud();
        $solicitud = $modelo->validacionDocumentoAdjuntoSolicitud($id_solicitud_adjunto_model);
        return $solicitud;
    }

    public function getListadoSolicitudesConAdjuntos() {
      
        $modelo = new ModelSolicitud();
        $solicitud = $modelo->obtenerSolicitudesConAdjuntos();
        return $solicitud;
    }

    public function getListadoAdjuntos($id_solicitud_archivo) {
        $id_solicitud_adjunto_mdl = $id_solicitud_archivo;
        $modelo = new ModelSolicitud();
        $solicitud = $modelo->obtenerAdjuntos($id_solicitud_adjunto_mdl);
        return $solicitud;
    }

    public function getBancosConsignacion() {
        $modelo = new ModelSolicitud();
        $solicitud = $modelo->getBancosConsignacion();
        return $solicitud;
    }

    public function insertarSolicitud() {
        $datos = array(
        "fk_Persona" => $_POST['selectPersona'],
        "nombre_cliente" => $_POST['nombreCliente'],
        "referido_por" => $_POST['referido_por'],
        "necesidad" => $_POST['necesidad']
         
       
        );
       
                        $checkbox = array();

                // Define un array con los nombres de las casillas de verificación
                $checkbox_names = array(
                    'tipoTrust', 'registroCorporacion', 'registroFIP', 'goodStanding',
                    'certificateIncumbency', 'contratoArrendamiento', 'registroCorporacionExterior',
                    'contratosComerciales', 'aperturaCuentaBancosCorporativa', 'aperturaBancosCuentaPersonal',
                    'serviciosContabilidad', 'serviciosImpuestos', 'servicioAgenteRegistrador',
                    'acuerdoDeSocios', 'proteccionDivorcios', 'ProteccióndePatrimonio', 'Actas','ServiciosProfesionales',
                    'investigacionAntecedentes', 'compraVentaEmpresas', 'visasInversionistaUSA',
                    'planesNegocios', 'internacionalizacionEmpresas', 'formasW8', 'formasW8BEN',
                    'formasW9', 'formasFBAR', 'formas1050R', 'formas5471_2', 'reporteB12',
                    'reporteB13', 'reporteFincen', 'reporteBOI', 'serviciosDomicilio', 'servicioTesoreria',
                    'servicioNomina', 'controlInventarios', 'serviciosFacturacion', 'serviciosAdministracionNegocios',
                    'serviciosLegalesNotario', 'serviciosLegalesApostille', 'serviciosReportesEspeciales'
                );

                // Recorre el array de nombres de casillas de verificación
                foreach ($checkbox_names as $name) {
                    // Verifica si la casilla de verificación está seleccionada y asigna su valor al array $checkbox
                    if (isset($_POST[$name]) && $_POST[$name] !== '') {
                        $checkbox[$name] = $_POST[$name];
                    }
                }

                $camposDinamicos = array();
                foreach ($_POST['campoDinamico'] as $indice => $valor) {
                    // Verificar si el valor del campo dinámico está presente y no está vacío
                    if (isset($valor) && $valor !== '') {
                        // Agregar el valor del campo dinámico al array en el formato deseado
                        $camposDinamicos["campoDinamico[$indice]"] = $valor;
                    }
                }
      
        var_dump($datos);
        $respuesta = ModelSolicitud::insertarSolicitud($datos, $checkbox, $camposDinamicos);
        
        if($respuesta == "ok") {
            echo 0; // Éxito
        } else {
            echo 1; // Error
        }
    }

    public function insertarRevision() {
        $id_solicitud = $_POST['id_solicitud'];
        // Asumiendo que 'resource' es la carpeta dentro de la raíz del proyecto donde quieres guardar los archivos
        $uploadsDir = __DIR__ . '/resource/';
        $folderName = $id_solicitud ; // La nueva subcarpeta para las revisiones
    
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
        if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] === UPLOAD_ERR_OK) {
            $fileName = $_FILES['archivo']['name'];
            // Asegurarse de limpiar el nombre del archivo para evitar vulnerabilidades
            $fileName = basename($fileName);
            $filePath = $revisionPath . $fileName;
            $descripcion = $_POST['descripcion'];
            

            //crer array para envio al modelo e insercion a BD
            $datos = array(
                "nombre_archivo" => $fileName ,
                "descripcion" => $descripcion,
                "id_solicitud" =>$id_solicitud  
                );
           //envio a modulo para inserciono
            $respuesta = ModelSolicitud::insertarArchivoSolicitud($datos);    

            if($respuesta == "ok") {
                echo 0; // Éxito
            } else {
                echo 1; // Error
            }
            // Mover el archivo al directorio de revisiones
            if (move_uploaded_file($_FILES['archivo']['tmp_name'], $filePath)) {
                // El archivo se ha cargado correctamente
                // Aquí se podría incluir más lógica para manejar el archivo cargado,
                // como insertar detalles en la base de datos.
                echo "Archivo cargado con éxito: ".$fileName."variable:$$ ".$descripcion."&&&".$id_solicitud;
            } else {
                // Error al mover el archivo
                echo "Error al mover el archivo.";
            }
        } else {
            // No se recibió ningún archivo válido o hubo un error en la carga
            echo "No se ha seleccionado ningún archivo o ocurrió un error al cargarlo.";
        }
    }
    
    public function insertarFactura() {
        $id_solicitud_factura = $_POST['id_solicitud'];
        $estado = $_POST['estado'];
        $logo = $_POST['logo'];
        $total_factura = $_POST['total_factura'];
        $cuenta_bancaria = $_POST['cuenta_bancaria'];
        $observaciones = $_POST['observaciones'];
        $invoice_number = $_POST['invoice_number']; 
        $email=$_POST['email'];
        $adress=$_POST['adress'];
        $tax=$_POST['tax'];
        $number_tax=$_POST['numberTax'];

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
        "servicios" => []
    ];

    // Procesar cada servicio detectando los nombres de campos que comienzan con 'cantidad' y 'valor'
    foreach ($_POST as $clave => $valor) {
        if (strpos($clave, 'cantidad') === 0) {
            $key = substr($clave, 8); // Extraer la parte después de 'cantidad'
            $datos['servicios'][$key]['cantidad'] = $valor;
        } elseif (strpos($clave, 'valor') === 0) {
            $key = substr($clave, 5); // Extraer la parte después de 'valor'
            $datos['servicios'][$key]['valor'] = $valor;
        }
    }

    $respuesta = ModelSolicitud::insertarFactura($datos, $id_solicitud_factura, $estado);
            if ($respuesta == "ok") {
                echo json_encode(["status" => 0]); // Éxito
            } else {
                echo json_encode(["status" => 1]); // Error
            }
        }
    
    public function validarFactura($id_revisar_solicitud) {
        $id_revisar=$id_revisar_solicitud;
        $facturaValida = ModelSolicitud::validarFactura($id_revisar);
       return $facturaValida;
       
    }   
    public function validarDocumento($id_revisar_solicitud) {
        $id_revisar=$id_revisar_solicitud;
        $documentoValidado = ModelSolicitud::validarDocumento($id_revisar);
        return $documentoValidado;
       
    } 
    

    
}
if ($_SERVER['REQUEST_METHOD'] == 'GET' AND isset($_GET['numero_solicitud'])) {
    $id_solicitud = $_GET['numero_solicitud'];
    $controlador = new Solicitud_controller();
    $controlador->getSolicitud($id_solicitud);
}
if ($_SERVER['REQUEST_METHOD'] == 'GET' ) {
   
    $controlador = new Solicitud_controller();
    $controlador->getListadoSolicitudes();
}
// Manejar la acción enviada por Ajax
if(isset($_POST['accion'])) {
    
    $controlador = new Solicitud_controller();
    $controlador->insertarSolicitud();
}

if(isset($_POST['accion']) && $_POST['accion'] === 'insertarRevision') {
    // Suponiendo que el var_dump era para depuración, puede ser removido en producción
    // var_dump($_FILES); 
    $controlador = new Solicitud_controller();
    $controlador->insertarRevision(); // Asegúrate de que este método existe y es el correcto
}

if (isset($_POST['accion']) && $_POST['accion'] === 'insertarFactura') {
    // var_dump($_FILES); 
    $controlador = new Solicitud_controller();
    $controlador->insertarFactura();
  
}
  
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'listarServicios') {
    $controller = new Solicitud_controller();
    $controller->getServiciosOfrecidos();
}

?>