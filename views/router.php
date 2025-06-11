<?php
if ($_GET['route'] == 'api-alertas') {
    require_once '../controller/api_alertas_controller.php';
    $api = new apiAlertasController();
    $api->getAlertas();
    exit();
}
?>