<?php
require_once('conexion.php');

class ModelTipoSociedad{
    public function insertTipoSociedad($data){
        try {
            $sql = "INSERT INTO tipo_sociedad (nombre_tipo_sociedad)VALUES (:nombretiposociedad)";
            $consulta = Conexion::conectar()->prepare($sql);
            $consulta->bindParam(':nombretiposociedad', $data['nombre_tipo_sociedad'], PDO::PARAM_STR);
            if ($consulta->execute()) {
                return "ok";
            } else {
                return "error";
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function consultarTipoSociedad(){
        try {
            $sql = "SELECT * FROM tipo_sociedad WHERE activo = true ORDER BY id_tipo_sociedad ASC";
            $consulta = Conexion::conectar()->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function actualizarTipoSociedad($data){   
        try {
            $sql = "UPDATE tipo_sociedad SET nombre_tipo_sociedad = :tipo_sociedad WHERE id_tipo_sociedad = :id";
            $consulta = Conexion::conectar()->prepare($sql);
            $consulta->bindParam(':tipo_sociedad', $data['nombre_tipo_sociedad'], PDO::PARAM_STR);
            $consulta->bindParam(':id', $data['id'], PDO::PARAM_INT);
            if ($consulta->execute()) {
                return "ok";
            } else {
                return "error";
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function eliminarTipoSociedad($id){
        try {
            $sql = "UPDATE tipo_sociedad SET activo=false WHERE id_tipo_sociedad=:id";
            $consulta = Conexion::conectar()->prepare($sql);
            $consulta->bindParam(':id', $id, PDO::PARAM_INT);
            
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