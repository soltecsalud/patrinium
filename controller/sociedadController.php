<?php
include_once "../model/modelSociedad.php";

class SociedadController{

    public function __construct() {
    }

    public function guardarSociedad($datos) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
                "ciudad" => $_POST["ciudad"],
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

    public function actualizarCliente($datos) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if($_POST['tipo']=='cliente'){
                $tipo = 'sociedad'; 
            }else if($_POST['tipo']=='sociocliente'){
                $tipo = 'personas_cliente';
            }

            $datos = array(
                "id_cliente" => $_POST["id_cliente"],
                "tipo" => $tipo,
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
                "ciudad" => $_POST["ciudad"],
                "id_solicitud" => 189 //$_POST["id_solicitud"]
            );
    
            $respuesta = modelSociedad::mdlActualizarCliente($datos);
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

    public function getAllClientes(){
        try {
            $sociedades = modelSociedad::mdlGetAllClientes(); 
            header('Content-Type: application/json');
            echo json_encode($sociedades);
        } catch (Exception $e) {
            echo json_encode(["resultado" => 0, "mensaje" => $e->getMessage()]);
        }
    }
    
    public function getPersonaSociedadySociedad($idSolicitud){
        try {
            $sociedades = modelSociedad::mdlGetPersonaSociedadySociedad($idSolicitud); 
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

    public function obtenerDocumentosSociead($idSolicitud, $idSociedad){
        try {
            $sociedades = modelSociedad::mdlObtenerDocumentosSociedad($idSolicitud, $idSociedad); 
            header('Content-Type: application/json');
            echo json_encode($sociedades);
        } catch (Exception $e) {
            echo json_encode(["resultado" => 0, "mensaje" => $e->getMessage()]);
        }
    }

    public function obtenerTiposSociedad(){
        try {
            $sociedades = modelSociedad::mdlObtenerTiposSociedad(); 
            header('Content-Type: application/json');
            echo json_encode($sociedades);
        } catch (Exception $e) {
            echo json_encode(["resultado" => 0, "mensaje" => $e->getMessage()]);
        }
    }

    public function obtenerCliente($campo){
        try {
            $sociedades = modelSociedad::mdlObtenerCliente($campo); 
            header('Content-Type: application/json');
            // echo json_encode($sociedades);
            if ($sociedades) {
                echo json_encode(["status" => "ok"]);
            } else {
                echo json_encode(["status" => "error"]);
            }
        } catch (Exception $e) {
            echo json_encode(["resultado" => 0, "mensaje" => $e->getMessage()]);
        }
    }

    public function obtenerNombreSociedad($campo){
        try {
            $sociedades = modelSociedad::mdlObtenerNombreSociedad($campo); 
            header('Content-Type: application/json');
            // echo json_encode($sociedades);
            if ($sociedades) {
                echo json_encode(["status" => "ok"]);
            } else {
                echo json_encode(["status" => "error"]);
            }
        } catch (Exception $e) {
            echo json_encode(["resultado" => 0, "mensaje" => $e->getMessage()]);
        }
    }

    public function guardarSociedadExtranjera($datos){
        $datos_sociedad = json_encode($datos, JSON_UNESCAPED_UNICODE);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $datosModelo = array(
                "datos"   => $datos_sociedad,
                "usuario" => "001",
            );

            $respuesta = modelSociedad::mdlInsertarSociedadExtranjera($datosModelo);
            header('Content-Type: application/json');
            if ($respuesta == "ok") {
                echo json_encode(["status" => "ok"]);
            } else {
                echo json_encode(["status" => "error", "message" => $respuesta]);
            }

        }
    }

    public function getConsultarSocios(){
        try {
            $socios = modelSociedad::mdlConsultarSocios(); 
            header('Content-Type: application/json');
            echo json_encode($socios);
        } catch (Exception $e) {
            echo json_encode(["resultado" => 0, "mensaje" => $e->getMessage()]);
        }
    }

    // Actualizar, se cambia de socio a cliente, pasando el campo es_socio de false a true
    public function actualizarTipoSocio($id, $tipo){
        try {
            $socios = modelSociedad::mdlActualizarTipoSocio($id,$tipo);
            header('Content-Type: application/json');
            if ($socios) {
                echo json_encode(["status" => "ok"]);
            } else {
                echo json_encode(["status" => "error"]);
            }
        } catch (Exception $e) {
            echo json_encode(["resultado" => 0, "mensaje" => $e->getMessage()]);
        }
    }

    public function obtenerTodasSociedades(){
        try {
            $sociedades = modelSociedad::mdlObtenerSociedades(); 
            header('Content-Type: application/json');
            echo json_encode($sociedades);
        } catch (Exception $e) {
            echo json_encode(["resultado" => 0, "mensaje" => $e->getMessage()]);
        }
    }

    public function actualizarEstadoMFA($idSociedad, $isRequiredMFA) {
        try {
            $respuesta = modelSociedad::mdlActualizarEstadoMFA($idSociedad, $isRequiredMFA);
            header('Content-Type: application/json');
            if ($respuesta) {
                echo json_encode(["status" => "success"]);
            } else {
                echo json_encode(["status" => "error", "message" => "No se pudo actualizar el estado de MFA"]);
            }
        } catch (Exception $e) {
            echo json_encode(["resultado" => 0, "mensaje" => $e->getMessage()]);
        }
    }

}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['accion']) && $_POST['accion'] == 'guardarSociedad') {
        $controlador = new SociedadController();
        $controlador->guardarSociedad($_POST);
    }else if(isset($_POST['accion']) && $_POST['accion'] == 'crearSociedadExtranjera'){
        $controlador = new SociedadController();
        $controlador->guardarSociedadExtranjera($_POST);
    }else if(isset($_POST['accion']) && $_POST['accion'] == 'actualizarCliente'){
        $controlador = new SociedadController();
        $controlador->actualizarCliente($_POST);
    }else if(isset($_POST['accion']) && $_POST['accion'] == 'actualizarEstadoMFA'){
        $controlador = new SociedadController();
        $controlador->actualizarEstadoMFA($_POST['idSociedad'], $_POST['isRequiredMFA']);
    }else {
        error_log("Acción no especificada o incorrecta.");
        echo json_encode(["resultado" => 0, "mensaje" => "Acción no especificada o incorrecta."]);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    
    if (isset($_GET['accion']) && $_GET['accion'] == 'getSociedades') {
        $idSolicitud = isset($_GET['idSolicitud']) ? $_GET['idSolicitud'] : null;
        $controlador = new SociedadController();
        $controlador->getPersonaSociedadySociedad($idSolicitud);

    }elseif (isset($_GET['accion']) && $_GET['accion'] == 'getAllSociedadesRegistrarSocilitud') {
        $controlador = new SociedadController();
        $controlador->getAllClientes();

    }elseif (isset($_GET['accion']) && $_GET['accion'] == 'obtenerTodasSociedades') {
        $controlador = new SociedadController();
        $controlador->obtenerTodasSociedades();
    
    }elseif (isset($_GET['accion']) && $_GET['accion'] == 'getSociedadesRegistrarSocilitud') {
        $controlador = new SociedadController();
        $controlador->getSociedades();

    } elseif (isset($_GET['accion']) && $_GET['accion'] == 'getConsultarSocios') {
        $controlador = new SociedadController();
        $controlador->getConsultarSocios();

    } elseif (isset($_GET['accion']) && $_GET['accion'] == 'actualizarTipoSocio') {
        $controlador = new SociedadController();
        $controlador->actualizarTipoSocio($_GET['id'], $_GET['tipo']);

    } elseif (isset($_GET['accion']) && $_GET['accion'] == 'getDocumentos') {
        $idSolicitud = isset($_GET['idSolicitud']) ? $_GET['idSolicitud'] : null;
        $idSociedad  = isset($_GET['idSociedad']) ? $_GET['idSociedad'] : null;
        $controlador = new SociedadController();
        $controlador->obtenerDocumentosSociead($idSolicitud, $idSociedad);
    
    }elseif(isset($_GET['accion']) && $_GET['accion'] == 'getTiposSociedad'){ 
        $controlador = new SociedadController();
        $controlador->obtenerTiposSociedad();
    }elseif(isset($_GET['accion']) && $_GET['accion'] == 'buscarPersona'){
        $campo  = isset($_GET['input']) ? $_GET['input'] : null; 
        $controlador = new SociedadController();
        $controlador->obtenerCliente($campo);
    }elseif(isset($_GET['accion']) && $_GET['accion'] == 'buscarNombreSociedad'){
        $campo  = isset($_GET['input']) ? $_GET['input'] : null; 
        $controlador = new SociedadController();
        $controlador->obtenerNombreSociedad($campo);
    }else {
        echo json_encode(["resultado" => 0, "mensaje" => "Acción no especificada o incorrecta este error."]);
    }
}




?>