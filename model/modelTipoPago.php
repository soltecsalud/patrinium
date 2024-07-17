<?php
require_once('conexion.php');

class ModelTipoPago{

    public function insertTipoPago($data){
        try {
            $sql = "INSERT INTO tipo_pago (tipo_pago)VALUES (:tipo_pago)";
            $consulta = Conexion::conectar()->prepare($sql);
            $consulta->bindParam(':tipo_pago', $data['nombre_tipo_pago'], PDO::PARAM_STR);
            if ($consulta->execute()) {
                return "ok";
            } else {
                return "error";
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function consultarTipoPago(){
        try {
            $sql = "SELECT * FROM tipo_pago";
            $consulta = Conexion::conectar()->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
?>