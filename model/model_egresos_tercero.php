<?php
require_once('conexion.php');

class ModelEgresosTercero {



    public function consultarEgresosTercero(){
        try {
            $sql = "
           SELECT a.consecutivo_egreso, a.valor, a.create_at, 
            b.nombre_tercero, b.tin, b.tipo_entidad, b.nombre_comercial
            FROM egresos_sociedad as a 
            inner join terceros as b ON(a.fk_tercero = b.id_terceros)
           ";
            $consulta = Conexion::conectar()->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function consultarSociosBoi(){
        try {
            $sql = "select a.id_personas_sociedad, a.nombre_sociedad,
            a.porcentaje,  CONCAT(b.nombre, ' ', b.apellido) AS nombre_completo,  b.numero_pasaporte 
            from personas_sociedad as a
            inner join sociedad as b ON(a.fk_persona=b.id_sociedad)
            where porcentaje > 25
            ";
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

}
?>