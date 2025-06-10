<?php
require_once('conexion.php');

class ModelLugares
{
    static public function mdlPais()
    {
        try {
            $sqlListarPais = "SELECT * FROM pais ";
            $listaPais = Conexion::conectar()->prepare($sqlListarPais);
            $listaPais->execute();
            return $listaPais->fetchAll(PDO::FETCH_OBJ);
            echo "error";
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    static public function mdlInsertarPersona($datos)
    {
        try {
        
            $sqlInsertarPersona = "INSERT INTO public.persona(
                nombres, apellidos, cedula, pais, ciudad, cliente, 
                oficina_envia, estadousa, pasaporte_numero, pasaporte_fecha_expedicion, pasaporte_fecha_caducidad, 
                tipo_visa, fecha_expedicion_visa, fecha_caducidad_visa, fecha_creacion, usuario_createat)
                VALUES (:nombres, :apellidos, :cedula, :pais, 
                :ciudad, :cliente, :oficina_envia, :estadousa, :pasaporte_numero,
                :pasaporte_fecha_expedicion, :pasaporte_fecha_caducidad, :tipo_visa, :fecha_expedicion_visa, 
                :fecha_caducidad_visa, NOW(), :usuario_createat);"; // Asumo NOW() para fecha_creacion
    
            $stmt = Conexion::conectar()->prepare($sqlInsertarPersona);
    
            // Enlazar parámetros
            $stmt->bindParam(":nombres", $datos["nombres"], PDO::PARAM_STR);
            $stmt->bindParam(":apellidos", $datos["apellidos"], PDO::PARAM_STR);
            $stmt->bindParam(":cedula", $datos["cedula"], PDO::PARAM_STR);
            $stmt->bindParam(":pais", $datos["pais"], PDO::PARAM_STR);
            $stmt->bindParam(":ciudad", $datos["ciudad"], PDO::PARAM_STR);
            $stmt->bindParam(":cliente", $datos["cliente"], PDO::PARAM_STR);
            $stmt->bindParam(":oficina_envia", $datos["oficina_envia"], PDO::PARAM_STR);
            $stmt->bindParam(":estadousa", $datos["estado_usa"], PDO::PARAM_STR);
            $stmt->bindParam(":pasaporte_numero", $datos["pasaporte_no"], PDO::PARAM_STR);
            $stmt->bindParam(":pasaporte_fecha_expedicion", $datos["pasaporte_fecha_expedicion"]);
            $stmt->bindParam(":pasaporte_fecha_caducidad", $datos["pasaporte_fecha_caducidad"]);
            $stmt->bindParam(":tipo_visa", $datos["tipo_visa"], PDO::PARAM_STR);
            $stmt->bindParam(":fecha_expedicion_visa", $datos["fecha_expedicion_visa"]);
            $stmt->bindParam(":fecha_caducidad_visa", $datos["fecha_caducidad_visa"]);            
            $stmt->bindParam(":usuario_createat", $datos["nombres"], PDO::PARAM_STR);
    
            if($stmt->execute()) {
                return "ok";
            } else {
                return "error";
            }
    
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    static public function mdlPersonas(){
        try {
            $sqlListarPersona = "SELECT * FROM persona";
            $listaPersona = Conexion::conectar()->prepare($sqlListarPersona);
            $listaPersona->execute();
            return $listaPersona->fetchAll(PDO::FETCH_ASSOC);
            echo "error";
        } catch (Exception $e) {
            die($e->getMessage());
        }

    }

}
?>