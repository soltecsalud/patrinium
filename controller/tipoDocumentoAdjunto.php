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
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'guardarTipoDocumento_adjunto') {
    $controller = new TipoPago();
    $controller->guardar();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'listarTipoPago') {
    $controller = new TipoPago();
    $controller->listarTipoPago();
}
?>