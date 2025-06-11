<?php
require_once "conexion.php";

class apiAlertasModel
{
    static public function mdlGetAlertas()
    {
        try {
            $sql = "SELECT 
                    f.id as system_number, 
                    f.datos->>'invoice_number' AS invoice_number,
                    f.datos->>'logo' AS logo,
                    SUM(
                        (s.value->>'valor')::numeric * 
                        (s.value->>'cantidad')::numeric
                    ) AS total_calculado, created_at as fecha
                    
                    FROM 
                    factura f,
                    jsonb_each(f.datos->'servicios') AS s(key, value)
                    where 
                    f.estado = 2 -- porque estado 2 es no pagada
                    GROUP BY 
                    f.id, f.datos->>'invoice_number', f.datos->>'logo'
                    order by 1 ASC;
                        ";
            $consulta = Conexion::conectar()->prepare($sql);
            $consulta->execute();

            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
?>
