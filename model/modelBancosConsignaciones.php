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
                    fecha_ingreso,
                    fk_tipo_cuenta
                ) VALUES (
                    :nombre_banco, 
                    :nombre_cuenta, 
                    :numero_cuenta, 
                    :routing_ach, 
                    :aba, 
                    :swift, 
                    :ciudad, 
                    :sucursal, 
                    NOW(),
                    :fktipocuenta
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
                $consulta->bindParam(':fktipocuenta', $data['tipocuenta'], PDO::PARAM_INT);
                
                if ($consulta->execute()) {
                    return "ok";
                } else {
                    return "error";
                }
            } catch (Exception $e) {
                die($e->getMessage());
            }
    }

    public function actualizarBancosConsigaciones($data){
        try {
            $sql = "UPDATE bancos_consignaciones SET 
                nombre_banco   = :nombre_banco, 
                nombre_cuenta  = :nombre_cuenta, 
                numero_cuenta  = :numero_cuenta, 
                routing_ach    = :routing_ach, 
                aba            = :aba, 
                swift          = :swift, 
                ciudad         = :ciudad, 
                sucursal       = :sucursal,
                fk_tipo_cuenta = :fktipocuenta
                WHERE id_banco = :id";
                
            $consulta = Conexion::conectar()->prepare($sql);
            $consulta->bindParam(':nombre_banco', $data['nombre_banco'], PDO::PARAM_STR);
            $consulta->bindParam(':nombre_cuenta', $data['nombre_cuenta'], PDO::PARAM_STR);
            $consulta->bindParam(':numero_cuenta', $data['numero_cuenta'], PDO::PARAM_STR);
            $consulta->bindParam(':routing_ach', $data['routing_ach'], PDO::PARAM_STR);
            $consulta->bindParam(':aba', $data['aba'], PDO::PARAM_STR);
            $consulta->bindParam(':swift', $data['swift'], PDO::PARAM_STR);
            $consulta->bindParam(':ciudad', $data['ciudad'], PDO::PARAM_STR);
            $consulta->bindParam(':sucursal', $data['sucursal'], PDO::PARAM_STR);
            $consulta->bindParam(':fktipocuenta', $data['tipocuenta'], PDO::PARAM_INT);
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
    
    public function getBancosConsignaciones(){
        try {
            $sql = "SELECT * FROM bancos_consignaciones as b
            LEFT JOIN tipo_cuenta_bancos AS t ON b.fk_tipo_cuenta=t.id_tipo_cuenta_bancos
            WHERE b.activo = true";
            $consulta = Conexion::conectar()->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function insertarTipoCuenta($data){
        try {
            $sql = "INSERT INTO tipo_cuenta_bancos (tipo_cuenta) VALUES (:nombre_tipocuenta)";
            $consulta = Conexion::conectar()->prepare($sql);
            $consulta->bindParam(':nombre_tipocuenta', $data['nombre_tipocuenta'], PDO::PARAM_STR);
            
            if ($consulta->execute()){ 
                return "ok";
            } else {
                return "error";
            }

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function eliminarBanco($id){
        try {
            $sql = "UPDATE bancos_consignaciones SET activo=false WHERE id_banco=:id";
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