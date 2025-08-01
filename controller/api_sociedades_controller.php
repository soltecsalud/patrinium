<?php
include_once "../model/modelSociedad.php";

class apiSociedadesController{ 
    //Obtener las sociedades con el is_carga_eeuu en true
    public function getSociedadesCarga(){
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json");

        try {
            // Llamar al modelo para obtener las sociedades con carga
            $sociedades = modelSociedad::mdlObtenerSociedadesCarga();
            if (empty($sociedades)) {
                echo json_encode([
                    "status" => "success",
                    "message" => "No hay sociedades con carga."
                ]);
                return;
            }
            echo json_encode([ 
                "status" => "success",
                "sociedades_carga" => $sociedades
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

// Instancia del controlador
$apiSociedadesController = new apiSociedadesController();
// Llamada al método para obtener las sociedades con carga
if ($_SERVER['REQUEST_METHOD'] === 'GET') { 
    $apiSociedadesController->getSociedadesCarga();
}
else {
    http_response_code(405);
    echo json_encode([
        "status" => "error",
        "message" => "Método no permitido"
    ]);
}

?>