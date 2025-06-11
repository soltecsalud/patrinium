<?php
require_once "../model/apiAlertasModel.php"; // Ajusta ruta según ubicación

class apiAlertasController
{
    public function getAlertas()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json");

        try {
            $alertas = apiAlertasModel::mdlGetAlertas();
            echo json_encode([
                "status" => "success",
                "data" => $alertas
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                "status" => "error",
                "message" => $e->getMessage()
            ]);
        }
    }
}
?>
