<?php
require_once('conexion.php');


class ModelBancosConsignaciones
{
        public function insertBancosConsigaciones($data){
                try {
                    $sql = "INSERT INTO bancos_consignaciones (
                        nombre_banco, 
                        nombre_cuenta, 
                        numero_cuenta, 
                        routing_ach, 
                        aba, 
                        swift, 
                        ciudad, 
                        sucursal, 
                        fecha_ingreso
                    ) VALUES (
                        :nombre_banco, 
                        :nombre_cuenta, 
                        :numero_cuenta, 
                        :routing_ach, 
                        :aba, 
                        :swift, 
                        :ciudad, 
                        :sucursal, 
                        NOW()
                    )"; // Agregar paréntesis cerrados faltantes aquí
                    
                    $consulta = Conexion::conectar()->prepare($sql);
                    $consulta->bindParam(':nombre_banco', $data['nombre_banco'], PDO::PARAM_STR);
                    $consulta->bindParam(':nombre_cuenta', $data['nombre_cuenta'], PDO::PARAM_STR);
                    $consulta->bindParam(':numero_cuenta', $data['numero_cuenta'], PDO::PARAM_STR);
                    $consulta->bindParam(':routing_ach', $data['routing_ach'], PDO::PARAM_STR);
                    $consulta->bindParam(':aba', $data['aba'], PDO::PARAM_STR);
                    $consulta->bindParam(':swift', $data['swift'], PDO::PARAM_STR);
                    $consulta->bindParam(':ciudad', $data['ciudad'], PDO::PARAM_STR);
                    $consulta->bindParam(':sucursal', $data['sucursal'], PDO::PARAM_STR);
                    
                    if ($consulta->execute()) {
                        return "ok";
                    } else {
                        return "error";
                    }
                } catch (Exception $e) {
                    die($e->getMessage());
                }
        }
    
    public function getBancosConsignaciones(){
        try {
            $sql = "SELECT * FROM bancos_consignaciones";
            $consulta = Conexion::conectar()->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}