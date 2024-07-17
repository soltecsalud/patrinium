<?php

require_once('conexion.php');

class Model_indicadores{

    public static function getSolicitudes(){
        try
        {
            $sql = "SELECT COUNT(a.id_solicitud) as solicitudes FROM solicitud a
            left join archivo_adjunto as ar ON(a.id_solicitud = ar.id_solicitud)
			where ar.id_solicitud is not null
            ";
            $listaSolicutd = Conexion::conectar()->prepare($sql);  
            $listaSolicutd->execute();
            return $listaSolicutd->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
        
      
       
    }

    
    public static function getResponseToRequests(){
        try
        {
            $sql = "SELECT COUNT(a.id_solicitud) as solicitudes FROM solicitud a
            left join archivo_adjunto as ar ON(a.id_solicitud = ar.id_solicitud)
			where ar.id_solicitud is null
            ";
            $listaSolicutd = Conexion::conectar()->prepare($sql);  
            $listaSolicutd->execute();
            return $listaSolicutd->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
        
      
       
    }
}


?>