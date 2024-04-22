<?php
include_once "../model/modelSolicitud.php";

class Solicitud_controller{
    
    public function getSolicitud($id_solicitud) {
        $id_solicitud_model=$id_solicitud;
        $modelo = new ModelSolicitud();
        $solicitud = $modelo->obtenerSolicitud($id_solicitud_model);
        return $solicitud;
    }
    public function getListadoSolicitudes() {
      
        $modelo = new ModelSolicitud();
        $solicitud = $modelo->obtenerAllSolicitud();
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

    public function insertarSolicitud() {
        $datos = array(
        "nombre_cliente" => $_POST['nombreCliente'],
        "referido_por" => $_POST['referido_por'],
        "necesidad" => $_POST['necesidad']
        );
        
        $respuesta = ModelSolicitud::insertarSolicitud($datos);
        
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

        $id_solicitud_factura=$_POST['id_solicitud'];
        $datos = array(
            "logo"=>$_POST['logo'],
            "General and Specific Delaware's Corporation Advice Consulting" =>$_POST['valor_generalandspecific'],
            "Letter of Delivery"=>$_POST['letter_delivery'],
            "Total"=>$_POST['total_factura']
            
            );

     
            $respuesta = ModelSolicitud::insertarFactura($datos,$id_solicitud_factura);
            
            if ($respuesta == "ok") {
                echo json_encode(["status" => 0]); // Éxito
            } else {
                echo json_encode(["status" => 1]); // Error
            }
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
  


?>