<?php
require_once('../model/modelBancosConsignaciones.php');



class ConsignacionController {
    public function guardar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nombre_banco' => $_POST['nombre_banco'] ?? null,
                'nombre_cuenta' => $_POST['nombre_cuenta'] ?? null,
                'numero_cuenta' => $_POST['numero_cuenta'] ?? null,
                'routing_ach' => $_POST['routing_ach'] ?? null,
                'aba' => $_POST['aba'] ?? null,
                'swift' => $_POST['swift'] ?? null,
                'ciudad' => $_POST['ciudad'] ?? null,
                'sucursal' => $_POST['sucursal'] ?? null
            ];
            
            $modelo = new ModelBancosConsignaciones();
            $resultado = $modelo->insertBancosConsigaciones($data);
            
            if ($resultado == "ok") {
                echo json_encode(['resultado' => 1]); // Éxito
            } else {
                echo json_encode(['resultado' => 0]); // Error
            }
        }
    }

    public function listarBancosConsignaciones() {
        try {
            $modelo = new ModelBancosConsignaciones();
            $resultado = $modelo->getBancosConsignaciones();
            header('Content-Type: application/json'); // Asegúrate de que la respuesta sea JSON
            echo json_encode($resultado);
        } catch (Exception $e) {
            header('Content-Type: application/json');
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}

// En tu archivo de rutas o donde configures tus rutas
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'listarBancosConsignaciones') {
    $controller = new ConsignacionController();
    $controller->listarBancosConsignaciones();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'guardarBancoConsignacion') {
    $controller = new ConsignacionController();
    $controller->guardar();
}
?>