<?php
include_once "../model/modelLugares.php";



class CiudadController {
    

    public function __construct() {
       
    }

    public function obtenerCiudades() {
        $getPais = ModelLugares::mdlPais();
        echo json_encode($getPais);
    }

    public function guardarPersona() {
        var_dump($_POST);
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $datos = array(
                "nombres" => $_POST['nombre'],
                "apellidos" => $_POST["apellido"],  
                "cedula"=>$_POST["cedula"] , 
                "pais"=>$_POST["pais"],
                "ciudad"=>$_POST["ciudad"],
                "cliente"=>$_POST["cliente"],
                "oficina_envia"=>$_POST["oficina_envia"],
                "estado_usa"=>$_POST["estado_usa"],
                "pasaporte_no"=>$_POST["pasaporte_no"],
                "pasaporte_fecha_expedicion"=>$_POST["pasaporte_fecha_expedicion"],
                "pasaporte_fecha_caducidad"=>$_POST["pasaporte_fecha_caducidad"],
                "tipo_visa"=>$_POST["tipo_visa"],
                "fecha_expedicion_visa"=>$_POST["fecha_expedicion_visa"],
                "fecha_caducidad_visa"=>$_POST["fecha_caducidad_visa"]
                // Agrega el resto de los campos aquí
            );
            $respuesta = ModelLugares::mdlInsertarPersona($datos);

            
            if($respuesta == "ok") {
                echo 0; // Éxito
            } else {
                echo 1; // Error
            }
        }
    }

    public function getPersonas(){
       
        $personas = ModelLugares::mdlPersonas(); // Ahora $personas contiene los datos
        return $personas;
    }

}
// Si se llama a este controlador mediante Ajax, ejecutar la función
if(isset($_GET['accion']) && $_GET['accion'] == 'listar') {
    $controlador = new CiudadController();
    $controlador->obtenerCiudades();
}
// Manejar la acción enviada por Ajax
if(isset($_POST['accion']) && $_POST['accion'] == 'guardar') {
    $controlador = new CiudadController();
    $controlador->guardarPersona();
}

?>