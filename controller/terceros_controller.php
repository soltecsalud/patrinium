<?php
require_once('../model/modelTerceros.php');

class TipoPago {
    public function guardar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //echo $_POST['nombre_documento_adjunto'];
            $data = [
                'nombre_documento_adjunto' => $_POST['nombre'] ?? null,
                'nombre_comercial' => $_POST['nombre_comercial'] ?? null,
                'tipo_entidad' => $_POST['tipo_entidad'] ?? null,
                'direccion' => $_POST['direccion'] ?? null,
                'ciudad' => $_POST['ciudad'] ?? null,
                'estado' => $_POST['estado'] ?? null,
                'codigo_postal' => $_POST['codigo_postal'] ?? null,
                'tin' => $_POST['tin'] ?? null,
                'firma' => $_POST['firma'] ?? null,
                'fecha' => $_POST['fecha'] ?? null,
            ];
            
            $modelo = new ModelTerceros();
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
            $modelo = new ModelTerceros();
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