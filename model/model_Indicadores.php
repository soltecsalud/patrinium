<?php

require_once('conexion.php');

class Model_indicadores{

    public static function getSolicitudes(){
        try
        {
            $sql = "SELECT COUNT(*) as solicitudes FROM solicitud";
            $listaSolicutd = Conexion::conectar()->prepare($sql);  
            $listaSolicutd->execute();
            return $listaSolicutd->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
        
      
       
    }
}


?>