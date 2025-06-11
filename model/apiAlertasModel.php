<?php
require_once "conexion.php";

class apiAlertasModel
{
    static public function mdlGetAlertas()
    {
        try {
            $sql = "SELECT id_alerta, mensaje, tipo_alerta, fecha_creacion FROM alertas";
            $consulta = Conexion::conectar()->prepare($sql);
            $consulta->execute();

            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
?>
