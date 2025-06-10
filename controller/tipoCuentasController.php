<?php

include_once "../model/modelTipoCuentas.php";

class TipoCuentasController {
    private $tipocuentasModel;

    public function __construct() {
        $this->tipocuentasModel = new TipoCuentasModel();
    }

    public function getTipoCuentas() {
        $estados = $this->tipocuentasModel->getTipoCuentas();
        if (empty($estados)) { 
            echo json_encode(["status" => "error"]);
        }else{
            echo json_encode($estados);
        }
        // return json_encode($estados);
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if(isset($_GET['accion']) && $_GET['accion'] == 'getTipoCuentas') {
        $controller = new TipoCuentasController();
        $controller->getTipoCuentas();
        // echo json_encode(["status" => "error1"]);
    }else{
        echo json_encode(["status" => "error"]);
    }
}


?>