<?php
require_once "conexion.php";

class BancosModel
{   
        static public function mdlGetBancosSociedad()
    {
        try {
            $sql = "SELECT 
                        b.nombre_banco,
                        a.cuenta_banco,
                        a.tipo_cuenta,
                        a.titular_cuenta
                        from datos_bancarios_sociedad a
                        inner join bancos as b ON (a.id_banco = b.id_banco)";
            $consulta = Conexion::conectar()->prepare($sql);
            $consulta->execute();

            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}
?>