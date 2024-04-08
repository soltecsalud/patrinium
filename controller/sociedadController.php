<?php
include_once "../model/modelSociedad.php";

class SociedadController{

    public function __construct() {
       
    }

    public function guardarSociedad(){
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $datos = array(
                "nombreSociedad" => $_POST["nombreSociedad"], 
                "referenciaSociedad" => $_POST["referenciaSociedad"], 
                "estadoUsa" => $_POST["estadoUsa"], 
                "fechaRegistro" => $_POST["fechaRegistro"], 
                "numeroRegistro" => $_POST["numeroRegistro"], 
                "fechaRenta" => $_POST["fechaRenta"], 
                "paisSociedad" => $_POST["paisSociedad"], 
                "estado" => $_POST["estado"], 
                "cantidadSocios" => $_POST["cantidadSocios"] 
          
            );
          
            $respuesta = modelSociedad::mdlInsertarSociedad($datos);
            if($respuesta == "ok") {
                echo 0; // Éxito
            } else {
                echo 1; // Error
            }
        }
    }

    public function getSociedades(){
        $sociedades = modelSociedad::mdlGetsociedad(); // Ahora $personas contiene los datos
        return $sociedades;
    }
}
// Manejar la acción enviada por Ajax
if(isset($_POST['accion']) && $_POST['accion'] == 'guardarSociedad') {
    $controlador = new SociedadController();
    $controlador->guardarSociedad();
}
?>