<?php
require_once('conexion.php');


class ModelServiciosPatrinium
{
        public function insertServiciosPatrinium($data){
                try {
                    $sql = "INSERT INTO servicios (nombre_servicio, created_at, servicio_name, activo)
                    VALUES (:nombre_servicio, NOW(),:servicio_name, true)
                    "; // Agregar paréntesis cerrados faltantes aquí
                    $nombreServicioSinEspacios = str_replace(' ', '', $data['nombre_servicio']);
                    $consulta = Conexion::conectar()->prepare($sql);
                    $consulta->bindParam(':nombre_servicio', $data['nombre_servicio'], PDO::PARAM_STR);
                    $consulta->bindParam(':servicio_name',  $nombreServicioSinEspacios, PDO::PARAM_STR);
                    
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
            $sql = "SELECT * FROM servicios WHERE activo=true";
            $consulta = Conexion::conectar()->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function updateServiciosPatrinium($data){
        try {
            $sql = "UPDATE servicios SET nombre_servicio = :nombre_servicio WHERE id_servicio=:id_servicio";
            $consulta = Conexion::conectar()->prepare($sql);
            $consulta->bindParam(':nombre_servicio', $data['nombre_servicio'], PDO::PARAM_STR);
            $consulta->bindParam(':id_servicio', $data['id_servicio'], PDO::PARAM_INT);
            if ($consulta->execute()) {
                return "ok";
            } else {
                return "error";
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function eliminarServicio($id_servicio){
        try {
            $sql = "UPDATE servicios SET activo=false WHERE id_servicio=:id_servicio"; 
            $consulta = Conexion::conectar()->prepare($sql);
            $consulta->bindParam(':id_servicio', $id_servicio, PDO::PARAM_INT);
            if ($consulta->execute()) {
                return "ok";
            } else {
                return "error";
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}

?>