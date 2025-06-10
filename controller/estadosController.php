<?php

include_once "../model/modelEstados.php";

class EstadosController {
    private $estadosModel;

    public function __construct() {
        $this->estadosModel = new EstadosModel();
    }

    public function getEstados() {
        $estados = $this->estadosModel->getEstados();
        if (empty($estados)) { 
            echo json_encode(["status" => "error"]);
        }else{
            echo json_encode($estados);
        }
        // return json_encode($estados);
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if(isset($_GET['accion']) && $_GET['accion'] == 'getEstados') {
        $controller = new EstadosController();
        $controller->getEstados();
    }else{
        echo json_encode(["status" => "error"]);
    }
}


?>