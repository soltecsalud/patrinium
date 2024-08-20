<?php
include_once "../model/modelSociedad.php";

class SociedadController{

    public function __construct() {
       
    }

    public function guardarSociedad($datos) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //echo "hola";

            
            $datos = array(
                "nombre" => $_POST["nombre"],
                "apellido" => $_POST["apellido"],
                "fecha_nacimiento" => $_POST["fechaNacimiento"],
                "estado_civil" => $_POST["estadoCivil"],
                "pais_origen" => $_POST["paisOrigen"],
                "pais_residencia_fiscal" => $_POST["paisResidenciaFiscal"],
                "pais_domicilio" => $_POST["paisDomicilio"],
                "numero_pasaporte" => $_POST["numeroPasaporte"],
                "pais_pasaporte" => $_POST["paisPasaporte"],
                "tipo_visa" => $_POST["tipoVisa"],
                "direccion_local" => $_POST["direccionLocal"],
                "telefonos" => $_POST["telefonos"],
                "emails" => $_POST["emails"],
                "industria" => $_POST["industria"],
                "nombre_negocio_local" => $_POST["nombreNegocioLocal"],
                "ubicacion_negocio_principal" => $_POST["ubicacionNegocioPrincipal"],
                "tamano_negocio" => $_POST["tamanoNegocio"],
                "contacto_ejecutivo_local" => $_POST["contactoEjecutivoLocal"],
                "numero_empleados" => $_POST["numeroEmpleados"],
                "numero_hijos" => $_POST["numeroHijos"],
                "razon_consultoria" => $_POST["razonConsultoria"],
                "requiere_registro_corporacion" => $_POST["requiereRegistroCorporacion"],                
                "observaciones" => $_POST["observaciones"],
                "id_solicitud" => 189 //$_POST["id_solicitud"]
            );
    
            $respuesta = modelSociedad::mdlInsertarSociedad($datos);
            header('Content-Type: application/json');
            if ($respuesta == "ok") {
                echo json_encode(["status" => "ok"]);
            } else {
                echo json_encode(["status" => "error", "message" => $respuesta]);
            }
        }
    }

    public function getSociedades(){
        try {
            $sociedades = modelSociedad::mdlGetsociedad(); 
            header('Content-Type: application/json');
            echo json_encode($sociedades);
        } catch (Exception $e) {
            echo json_encode(["resultado" => 0, "mensaje" => $e->getMessage()]);
        }
    }

    public function obtenerConsultoria() {
        $respuesta = modelSociedad::mdlObtenerConsultoria();
        header('Content-Type: application/json');
        if ($respuesta) {
            echo json_encode(["status" => "ok", "data" => $respuesta]);
        } else {
            echo json_encode(["status" => "error", "message" => "No se encontró el objeto de consultoría"]);
        }
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['accion']) && $_POST['accion'] == 'guardarSociedad') {
        error_log("Acción guardarSociedad recibida");
        error_log(print_r($_POST, true)); // Imprime los datos recibidos en el log de errores
        $controlador = new SociedadController();
        $controlador->guardarSociedad($_POST);
    } else {
        error_log("Acción no especificada o incorrecta.");
        echo json_encode(["resultado" => 0, "mensaje" => "Acción no especificada o incorrecta."]);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    
    if (isset($_GET['accion']) && $_GET['accion'] == 'getSociedades') {
        //echo "Acción recibida: getSociedades"; // 
        $controlador = new SociedadController();
        $controlador->getSociedades();
    } else {
        echo json_encode(["resultado" => 0, "mensaje" => "Acción no especificada o incorrecta este error."]);
    }
}
?>