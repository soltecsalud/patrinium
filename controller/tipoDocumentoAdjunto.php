<?php
require_once('../model/modelDocumentoAdjunto.php');

class TipoPago {
    public function guardar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //echo $_POST['nombre_documento_adjunto'];
            $data = [
                'nombre_documento_adjunto' => $_POST['nombre_documento_adjunto'] ?? null
            ];
            
            $modelo = new ModelDocumentoAdjunto();
            $resultado = $modelo->insertar_tipo_documento_adjunto($data);
            
            if ($resultado == "ok") {
                echo json_encode(['resultado' => 1]); // Éxito
            } else {
                echo json_encode(['resultado' => 0]); // Error
            }
        }

    }

    public function listarTipoPago() {
        try {
            $modelo = new ModelDocumentoAdjunto();
            $resultado = $modelo->getDocumentoAdjunto();
            header('Content-Type: application/json'); // Asegúrate de que la respuesta sea JSON
            echo json_encode($resultado);
        } catch (Exception $e) {
            header('Content-Type: application/json');
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function actualizarTipodocumento() { 
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'id' => $_POST['id_tipodocumento'] ?? null,
                'nombre_tipo_documento' => $_POST['nombre_tipodocumento'] ?? null
            ];
            
            $modelo = new ModelDocumentoAdjunto(); 
            $resultado = $modelo->actualizarTipoDocumento($data);
            
            if ($resultado == "ok") {
                echo json_encode(['resultado' => 1]); // Éxito
            } else {
                echo json_encode(['resultado' => 0]); // Error
            }
        }
    }

    public function eliminarDocumento() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_documento'] ?? null;
            if ($id) {
                $modelo = new ModelDocumentoAdjunto();
                $resultado = $modelo->eliminarDocumento($id);
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

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'guardarTipoDocumento_adjunto') {
    $controller = new TipoPago();
    $controller->guardar();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'actualizartipodocumento') {
    $controller = new TipoPago();
    $controller->actualizarTipodocumento();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'listarTipoPago') {
    $controller = new TipoPago();
    $controller->listarTipoPago();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'eliminarDocumento') {
    $controller = new TipoPago();
    $controller->eliminarDocumento();
}
?>