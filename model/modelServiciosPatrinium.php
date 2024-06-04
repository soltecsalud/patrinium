<?php
require_once('conexion.php');


class ModelServiciosPatrinium
{
        public function insertServiciosPatrinium($data){
                try {
                    $sql = "INSERT INTO servicios (
                        nombre_servicio, created_at
                    ) VALUES (
                        :nombre_servicio,
                        NOW()
                    )"; // Agregar paréntesis cerrados faltantes aquí
                    
                    $consulta = Conexion::conectar()->prepare($sql);
                    $consulta->bindParam(':nombre_servicio', $data['nombre_servicio'], PDO::PARAM_STR);
                    
                    
                    if ($consulta->execute()) {
                        return "ok";
                    } else {
                        return "error";
                    }
                } catch (Exception $e) {
                    die($e->getMessage());
                }
        }
    
    public function getServicios(){
        try {
            $sql = "SELECT * FROM servicios";
            $consulta = Conexion::conectar()->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}

?>