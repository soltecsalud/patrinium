<?php
include_once "../model/modelPersona.php";

class CargarPersona{
    
    public function cargarNombres() {
        $modelo = new ModelBuscarPersona();
        $nombres = $modelo->obtenerPersona();
        echo json_encode($nombres);
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $controlador = new CargarPersona();
    $controlador->cargarNombres();
}

?>