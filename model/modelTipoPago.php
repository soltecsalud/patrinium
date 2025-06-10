<?php
require_once('conexion.php');

class ModelTipoPago{

    public function insertTipoPago($data){
        try {
            $sql = "INSERT INTO tipo_pago (tipo_pago)VALUES (:tipo_pago)";
            $consulta = Conexion::conectar()->prepare($sql);
            $consulta->bindParam(':tipo_pago', $data['nombre_tipo_pago'], PDO::PARAM_STR);
            if ($consulta->execute()) {
                return "ok";
            } else {
                return "error";
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function consultarTipoPago(){
        try {
            $sql = "SELECT * FROM tipo_pago WHERE activo = true";
            $consulta = Conexion::conectar()->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function consultarSociosBoi(){
        try {
            $sql = "SELECT a.id_personas_sociedad, a.nombre_sociedad,
            a.porcentaje,  CONCAT(b.nombre, ' ', b.apellido) AS nombre_completo,  b.numero_pasaporte 
            from personas_sociedad as a
            inner join sociedad as b ON(a.fk_persona=b.id_sociedad)
            where porcentaje > 25";
            $consulta = Conexion::conectar()->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public static function obtenerDetalleSociedad($id) {
        try {
            $sql = "SELECT * FROM personas_sociedad  as a
            inner join sociedad as b ON(a.fk_persona=b.id_sociedad)
            inner join archivo_adjunto as c ON(a.fk_solicitud=c.id_solicitud)
            WHERE a.id_personas_sociedad = :id";
            $stmt = Conexion::conectar()->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw new Exception("Error al obtener el detalle: " . $e->getMessage());
        }
    }

    public function actualizarTipoPago($data){  
        try {
            $sql = "UPDATE tipo_pago SET tipo_pago = :tipo_pago WHERE id_tipo_pago = :id";
            $consulta = Conexion::conectar()->prepare($sql);
            $consulta->bindParam(':tipo_pago', $data['nombre_tipo_pago'], PDO::PARAM_STR);
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

    public function eliminarTipoPago($id){
        try {
            $sql = "UPDATE tipo_pago SET activo=false WHERE id_tipo_pago=:id";
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