<?php
require_once "conexion.php";

class ModelFacturacion {
    
    public function listarFacturas() {

        try {
            $sql = "SELECT * FROM factura where estado = 2 or estado = null";
            $consulta = Conexion::conectar()->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }

    }

    public function listarFacturasPagadas() {

        try {
            $estado = 1;
            $sql = "SELECT * FROM factura where estado = :estado";
            $consulta = Conexion::conectar()->prepare($sql);
            $consulta->bindParam(':estado',$estado , PDO::PARAM_STR);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }

    }

    public function listarServicios() {

        try {
            $estado = 2;
            $sql = "SELECT * FROM factura where estado = :estado";
            $consulta = Conexion::conectar()->prepare($sql);
            $consulta->bindParam(':estado',$estado , PDO::PARAM_INT);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }

    }

    public static function uploadInvoice($datos){
        try {
           
            $sql = "update factura set estado = 1, 
            tipo_consignacion = :tipo_consignacion, 
            ruta_pago = :ruta_pago,
            nota_pago = :nota_pago
            where id_solicitud = :id_solicitud";
            $consulta = Conexion::conectar()->prepare($sql);
            $consulta->bindParam(':tipo_consignacion', $datos['payment_option'], PDO::PARAM_STR);
            $consulta->bindParam(':ruta_pago', $datos['nombre_archivo'], PDO::PARAM_STR);
            $consulta->bindParam(':nota_pago', $datos['payment_notes'], PDO::PARAM_STR);
            $consulta->bindParam(':id_solicitud', $datos['solicitud'], PDO::PARAM_STR); // Usa $datos directamente
            $consulta->execute();

            return "ok";
           
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public static function actualizarEstadoFactura($datos) {
        try {
            // Preparar la consulta SQL para actualizar el estado de la factura
            $sql = "UPDATE factura SET estado = 0 WHERE id_solicitud = :id_solicitud AND id = :id";
            $consulta = Conexion::conectar()->prepare($sql);
    
            // Vincular los parámetros
            $consulta->bindParam(':id_solicitud', $datos['id_solicitud'], PDO::PARAM_INT);
            $consulta->bindParam(':id', $datos['id'], PDO::PARAM_INT);
    
            // Ejecutar la consulta
            $consulta->execute();
    
            return "ok";
           
        } catch (Exception $e) {
            // Manejar la excepción y devolver un mensaje de error
            die($e->getMessage());
        }
    }
  
}
?>