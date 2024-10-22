<?php
require_once('conexion.php');

class ModelPlantillas {

    public static function guardarContenido($contenido_html, $usuario, $id_solicitud) {
        try {
            $sqlInsertar = "INSERT INTO public.plantillas_save_html
                (contenido_html, createat, usuario, fk_solicitud)
                VALUES (:contenido_html, NOW(), :usuario, :id_solicitud)";
            
            // Preparar la consulta
            $stmt = Conexion::conectar()->prepare($sqlInsertar);
            $stmt->bindParam(':contenido_html', $contenido_html, PDO::PARAM_STR);
            $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
            $stmt->bindParam(':id_solicitud', $id_solicitud, PDO::PARAM_INT);
            
            // Ejecutar la inserción
            return $stmt->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public static function obtenerActaPorSolicitud($id_solicitud) {
        try {
            
            $sql = "SELECT createat, contenido_html FROM plantillas_save_html WHERE fk_solicitud = :id_solicitud";
            $stmt = Conexion::conectar()->prepare($sql);
            $stmt->bindParam(':id_solicitud', $id_solicitud, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC); // Usamos fetch porque solo esperamos un acta
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public static function obtenerConsecutivos() {
        try {
            $sql = "
                    select 
                    a.id_solicitud, CONCAT(b.nombre, ' ', b.apellido) AS nombre_completo
                    from solicitud as a
                    inner join sociedad b ON(a.fk_persona = b.id_sociedad) 
                    ";
            $stmt = Conexion::conectar()->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Usamos fetchAll porque esperamos múltiples plantillas
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}

?>