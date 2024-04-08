<?php
include_once "../model/modelSolicitud.php";

class Solicitud_controller{
    
    public function getSolicitud($id_solicitud) {
        $id_solicitud_model=$id_solicitud;
        $modelo = new ModelSolicitud();
        $solicitud = $modelo->obtenerSolicitud($id_solicitud_model);
        return $solicitud;
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $controlador = new Solicitud_controller();
    $controlador->getSolicitud($id_solicitud);
}

?>