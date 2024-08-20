<?php
include_once "../model/modelBancos.php";

class getBancos{
    
    public function getBancosSociedad() {
        $modelo = new BancosModel();
        $solicitud = $modelo->mdlGetBancosSociedad();
        //return $bancos;
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $controlador = new getBancos();
    $controlador->getBancosSociedad();
}

?>