<?php
require_once "../model/modelFacturacion.php";

class FacturaController {
    
    public function listarFacturas() {
        try {
            $modelo = new ModelFacturacion();
            $resultado = $modelo->listarFacturas();
            header('Content-Type: application/json'); // Asegúrate de que la respuesta sea JSON
            echo json_encode($resultado);
        } catch (Exception $e) {
            header('Content-Type: application/json');
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
    
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'listarFacturas') {
    $controller = new FacturaController();
    $controller->listarFacturas();
}
?>