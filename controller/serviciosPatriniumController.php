<?php


require_once('../model/modelServiciosPatrinium.php');



class ServiciosPatriniumController {
    public function guardar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                "nombre_servicio" => $_POST['nombre_servicio']
            ];
            
            $modelo = new ModelServiciosPatrinium;
            $resultado = $modelo->insertServiciosPatrinium($data);
            
            if ($resultado == "ok") {
                echo json_encode(['resultado' => 1]); // Éxito
            } else {
                echo json_encode(['resultado' => 0]); // Error
            }
        }
    }

    public function listarServicios() {
        try {
            $modelo = new ModelServiciosPatrinium;
            $resultado = $modelo->getServicios();
            header('Content-Type: application/json'); // Asegúrate de que la respuesta sea JSON
            echo json_encode($resultado);
        } catch (Exception $e) {
            header('Content-Type: application/json');
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function actualizarServicio() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                "nombre_servicio" => $_POST['nombre_servicio'],
                "id_servicio"     => $_POST['id_servicio']
            ];
            
            $modelo    = new ModelServiciosPatrinium;
            $resultado = $modelo->updateServiciosPatrinium($data);
            
            if ($resultado == "ok") {
                echo json_encode(['resultado' => 1]); // Éxito
            } else {
                echo json_encode(['resultado' => 0]); // Error
            }
        }
    }

    public function eliminarServicio() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_servicio = $_POST['id_servicio'];
            $modelo      = new ModelServiciosPatrinium;
            $resultado   = $modelo->eliminarServicio($id_servicio);
            
            if ($resultado == "ok") {
                echo json_encode(['resultado' => 1]); // Éxito
            } else {
                echo json_encode(['resultado' => 0]); // Error
            }
        }
    }

}

// En tu archivo de rutas o donde configures tus rutas
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'listarServicios') {
    $controller = new ServiciosPatriniumController;
    $controller->listarServicios();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'guardarServicio') {
    $controller = new ServiciosPatriniumController();
    $controller->guardar();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'actualizarServicio') {
    $controller = new ServiciosPatriniumController();
    $controller->actualizarServicio();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'eliminarServicio') {
    $controller = new ServiciosPatriniumController;
    $controller->eliminarServicio();
}


?>

