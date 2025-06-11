<?php
// Detectar método POST con JSON en el body
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $body = json_decode(file_get_contents('php://input'), true);

    if (!empty($body['route']) && $body['route'] === 'api-alertas') {
        require_once '../controller/api_alertas_controller.php';
        $api = new apiAlertasController();
        $api->getAlertas();
        exit();
    }
}
?>