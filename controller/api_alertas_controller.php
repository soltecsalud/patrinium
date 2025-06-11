<?php
require_once "../model/apiAlertasModel.php"; // Ajusta ruta según ubicación

class apiAlertasController
{
    public function getAlertas()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json");

        try {
            $facturas = apiAlertasModel::mdlGetAlertas();
            $alertas = [];

            foreach ($facturas as $factura) {
                $fechaFactura = new DateTime($factura['fecha']);
                $hoy = new DateTime();
                $diferencia = $fechaFactura->diff($hoy)->days;

                if ($diferencia > 10) {
                    $alertas[] = [
                        'system_number'   => $factura['system_number'],
                        'invoice_number'  => $factura['invoice_number'],
                        'logo'            => $factura['logo'],
                        'total_calculado' => $factura['total_calculado'],
                        'dias_sin_pagar'  => $diferencia,
                        'fecha'         => $factura['fecha']
                    ];
                }
            }

            echo json_encode([
                "status" => "success",
                "alertas_mayor_30_dias" => $alertas
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
