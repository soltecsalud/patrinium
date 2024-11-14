<?php
require_once('conexion.php');


class ModelDocumentoAdjunto
{
        public function insertar_tipo_documento_adjunto($data){
                try {
                    $sql = "INSERT INTO public.documentos_adjuntos(
	                nombre_documento_adjunto, create_at)
	                VALUES ( :nombre_documento_adjunto, NOW());"; // Agregar paréntesis cerrados faltantes aquí
                    
                    $consulta = Conexion::conectar()->prepare($sql);
                    $consulta->bindParam(':nombre_documento_adjunto', $data['nombre_documento_adjunto'], PDO::PARAM_STR);
              
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
            $sql = "SELECT * FROM documentos_adjuntos";
            $consulta = Conexion::conectar()->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}