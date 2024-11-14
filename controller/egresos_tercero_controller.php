<?php
require_once('../model/model_egresos_tercero.php');

class EgresosTerceroController {
   
    public function listarEgresosPorTerceros() {
        try {
            $modelo = new ModelEgresosTercero();
            $resultado = $modelo->consultarEgresosTercero();
            header('Content-Type: application/json'); // Asegúrate de que la respuesta sea JSON
            echo json_encode($resultado);
        } catch (Exception $e) {
            header('Content-Type: application/json');
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
   

}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'egresos_por_tercero') {
    $controller = new EgresosTerceroController();
    $controller->listarEgresosPorTerceros();
}





?>