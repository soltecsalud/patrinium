<?php
require_once('conexion.php');


class ModelTerceros
{
        public function insertar_tipo_documento_adjunto($data){
                try {
                    $sql = "INSERT INTO public.terceros (
                        nombre_tercero, create_at, nombre_comercial, tipo_entidad, direccion, 
                        ciudad, estado, codigo_postal, tin, firma, fecha
                    ) VALUES (
                        :nombre_tercero, NOW(), :nombre_comercial, :tipo_entidad, :direccion, 
                        :ciudad, :estado, :codigo_postal, :tin, :firma, :fecha
                    );";
            
                    $consulta = Conexion::conectar()->prepare($sql);
                    
                    // Enlazar los parámetros con los valores en $data
                    $consulta->bindParam(':nombre_tercero', $data['nombre_documento_adjunto'], PDO::PARAM_STR);
                    $consulta->bindParam(':nombre_comercial', $data['nombre_comercial'], PDO::PARAM_STR);
                    $consulta->bindParam(':tipo_entidad', $data['tipo_entidad'], PDO::PARAM_STR);
                    $consulta->bindParam(':direccion', $data['direccion'], PDO::PARAM_STR);
                    $consulta->bindParam(':ciudad', $data['ciudad'], PDO::PARAM_STR);
                    $consulta->bindParam(':estado', $data['estado'], PDO::PARAM_STR);
                    $consulta->bindParam(':codigo_postal', $data['codigo_postal'], PDO::PARAM_STR);
                    $consulta->bindParam(':tin', $data['tin'], PDO::PARAM_STR);
                    $consulta->bindParam(':firma', $data['firma'], PDO::PARAM_STR);
                    $consulta->bindParam(':fecha', $data['fecha'], PDO::PARAM_STR);
                    
                    // Ejecutar la consulta y devolver el resultado
                    if ($consulta->execute()) {
                        return "ok";
                    } else {
                        return "error";
                    }
                } catch (Exception $e) {
                    die($e->getMessage());
                }
        }
    
    public function getDocumentoAdjunto(){
        try {
            $sql = "SELECT * FROM terceros";
            $consulta = Conexion::conectar()->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}