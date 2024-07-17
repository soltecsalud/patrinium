<?php
require_once "conexion.php";

class ModelFacturacion {
    
    public function listarFacturas() {

        try {
            $sql = "SELECT * FROM factura";
            $consulta = Conexion::conectar()->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }

    }
  
}
?>