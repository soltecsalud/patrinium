<?php 

require_once('../model/model_Indicadores.php');

class Indicadores_Controller{



    public function getSolicides(){
        $cantidadSolicitud = Model_indicadores::getSolicitudes();
        return $cantidadSolicitud;
    }
}

?>