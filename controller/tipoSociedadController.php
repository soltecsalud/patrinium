<?php
    require_once('../model/modelTipoSociedad.php');

    class TipoSociedad{
        public function guardar() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                echo $_POST['nombre_tipo_sociedad'];
                $data = [
                    'nombre_tipo_sociedad' => $_POST['nombre_tipo_sociedad'] ?? null
                ];
                
                $modelo    = new ModelTipoSociedad();
                $resultado = $modelo->insertTipoSociedad($data);
                
                if ($resultado == "ok") {
                    echo json_encode(['resultado' => 1]); // Éxito
                } else {
                    echo json_encode(['resultado' => 0]); // Error
                }
            }
    
        }

        public function listarTipoSociedad() {
            try {
                $modelo    = new ModelTipoSociedad();
                $resultado = $modelo->consultarTipoSociedad();
                header('Content-Type: application/json'); // Asegúrate de que la respuesta sea JSON
                echo json_encode($resultado);
            } catch (Exception $e) {
                header('Content-Type: application/json');
                echo json_encode(['error' => $e->getMessage()]);
            }
        }

        public function actualizarTiposociedad() { 
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $data = [
                    'id' => $_POST['id_tiposociedad'] ?? null,
                    'nombre_tipo_sociedad' => $_POST['nombre_tiposociedad'] ?? null
                ];
                
                $modelo = new ModelTipoSociedad(); 
                $resultado = $modelo->actualizarTipoSociedad($data);
                
                if ($resultado == "ok") {
                    echo json_encode(['resultado' => 1]); // Éxito
                } else {
                    echo json_encode(['resultado' => 0]); // Error
                }
            }
        }

        public function eliminarTipoSociedad() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $id = $_POST['id_tiposociedad'] ?? null;
                if ($id) {
                    $modelo = new ModelTipoSociedad();
                    $resultado = $modelo->eliminarTipoSociedad($id);
                    if ($resultado == "ok") {
                        echo json_encode(['resultado' => 1]); // Éxito
                    } else {
                        echo json_encode(['resultado' => 0]); // Error
                    }
                } else {
                    echo json_encode(['resultado' => 0, 'error' => 'ID de banco no proporcionado']);
                }
            }
        }

    }

    
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'guardarTipoSociedad') {
        $controller = new TipoSociedad();
        $controller->guardar();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'actualizartiposociedad') {
        $controller = new TipoSociedad();
        $controller->actualizarTiposociedad();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'listarTipoSociedad') {
        $controller = new TipoSociedad();
        $controller->listarTipoSociedad();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'eliminarTipoSociedad') {
        $controller = new TipoSociedad();
        $controller->eliminarTipoSociedad();
    }


?>