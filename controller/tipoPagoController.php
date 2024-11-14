<?php
require_once('../model/modelTipoPago.php');

class TipoPago {
    public function guardar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            echo $_POST['nombre_tipo_pago'];
            $data = [
                'nombre_tipo_pago' => $_POST['nombre_tipo_pago'] ?? null
            ];
            
            $modelo = new ModelTipoPago();
            $resultado = $modelo->insertTipoPago($data);
            
            if ($resultado == "ok") {
                echo json_encode(['resultado' => 1]); // Éxito
            } else {
                echo json_encode(['resultado' => 0]); // Error
            }
        }

    }

    public function listarTipoPago() {
        try {
            $modelo = new ModelTipoPago();
            $resultado = $modelo->consultarTipoPago();
            header('Content-Type: application/json'); // Asegúrate de que la respuesta sea JSON
            echo json_encode($resultado);
        } catch (Exception $e) {
            header('Content-Type: application/json');
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
    public function listarSociosBoi() {
        try {
            $modelo = new ModelTipoPago();
            $resultado = $modelo->consultarSociosBoi();
            header('Content-Type: application/json'); // Asegúrate de que la respuesta sea JSON
            echo json_encode($resultado);
        } catch (Exception $e) {
            header('Content-Type: application/json');
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function detalleSociedad() {
        $id = $_POST['id'];
        // Fetch the details based on the id
        $detalle = ModelTipoPago::obtenerDetalleSociedad($id);
        echo json_encode($detalle);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'guardarTipoPago') {
    $controller = new TipoPago();
    $controller->guardar();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'listarTipoPago') {
    $controller = new TipoPago();
    $controller->listarTipoPago();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $controller = new TipoPago();

    if ($_POST['action'] == 'sociosBoi') {
        $controller->listarSociosBoi();
    } elseif ($_POST['action'] == 'detalleSociedad') {
        $controller->detalleSociedad();
    }
}



?>