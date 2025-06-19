<?php
require_once('conexion.php');

class ModelPlantillas {

    public static function guardarContenido($contenido_html, $usuario, $id_solicitud) {
        try {
            $sqlInsertar = "INSERT INTO public.plantillas_save_html
                (contenido_html, createat, usuario, uuid_sociedad)
                VALUES (:contenido_html, NOW(), :usuario, :uuid_sociedad)";
            
            // Preparar la consulta
            $stmt = Conexion::conectar()->prepare($sqlInsertar);
            $stmt->bindParam(':contenido_html', $contenido_html, PDO::PARAM_STR);
            $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
            $stmt->bindParam(':uuid_sociedad', $id_solicitud, PDO::PARAM_INT);
            
            // Ejecutar la inserción
            return $stmt->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public static function obtenerActaPorSolicitud($id_solicitud) {
        try {
            $sql = "SELECT psh.id_plantillas_save, psh.createat, psh.contenido_html, psh.uuid_sociedad, ps.nombre_sociedad
                FROM plantillas_save_html psh
                JOIN (
                    SELECT CAST(uuid AS UUID) AS uuid_sociedad, nombre_sociedad
                    FROM personas_sociedad 
                    WHERE fk_solicitud = :uuid_sociedad
                ) ps ON psh.uuid_sociedad = ps.uuid_sociedad";
            $stmt = Conexion::conectar()->prepare($sql);
            $stmt->bindParam(':uuid_sociedad', $id_solicitud, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Cambio importante: fetchAll()
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public static function actualizarPlantillaHtml($id_plantilla, $html_content){
        try {
            $sql = "UPDATE plantillas_save_html SET contenido_html = :contenido_html WHERE id_plantillas_save = :id_plantilla";
            $stmt = Conexion::conectar()->prepare($sql);
            $stmt->bindParam(':contenido_html', $html_content, PDO::PARAM_STR);
            $stmt->bindParam(':id_plantilla', $id_plantilla, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public static function obtenerActaPorSolicitudxSociedad($id_solicitud,$sociedad) {
        try {
            $sql = "SELECT psh.id_plantillas_save, psh.createat, psh.contenido_html, psh.uuid_sociedad, ps.nombre_sociedad
                FROM plantillas_save_html psh
                JOIN (
                    SELECT CAST(uuid AS UUID) AS uuid_sociedad, nombre_sociedad
                    FROM personas_sociedad 
                    WHERE fk_solicitud = :uuid_sociedad
                ) ps ON psh.uuid_sociedad = ps.uuid_sociedad AND psh.uuid_sociedad=:uuid";
            $stmt = Conexion::conectar()->prepare($sql);
            $stmt->bindParam(':uuid_sociedad', $id_solicitud, PDO::PARAM_INT);
            $stmt->bindParam(':uuid', $sociedad);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Cambio importante: fetchAll()
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public static function obtenerHtmlPorId($id_plantillas_save) {
        // 19 de junio de 2025, estaba comentado la linea 80, se descomento para que se busque por el ID de la plantilla y no por el de la sociedad, 
        // porque una sociedad puede tener varias plantillas guardadas, pero al parecer primero se estaba buscando por el id de la plantilla y se cambio
        // Si se necesita cambiar por alguna razon la manera de filtrar, se puede comentar la linea 80 y descomentar la linea 81, pero tener presente que este metodo funciona para ver los PDF en la vista de verSolicitud
        try {
            $conexion = Conexion::conectar();
            $query = "SELECT contenido_html FROM plantillas_save_html 
            WHERE 
            id_plantillas_save = :uuid
            -- uuid_sociedad = :uuid
            ";
            $stmt = $conexion->prepare($query);
            $stmt->bindParam(':uuid', $id_plantillas_save);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die(json_encode(['status' => 'error', 'message' => 'Error en la consulta SQL: ' . $e->getMessage()]));
        }
    }

    public static function obtenerHtmlPDFPorSociedad($id_solicitud,$sociedad) {
        try {
            $conexion = Conexion::conectar();
            $query = "SELECT psh.contenido_html
                FROM plantillas_save_html psh
                JOIN (
                    SELECT CAST(uuid AS UUID) AS uuid_sociedad, nombre_sociedad
                    FROM personas_sociedad 
                    WHERE fk_solicitud = :uuid_sociedad
                ) ps ON psh.uuid_sociedad = ps.uuid_sociedad AND psh.uuid_sociedad=:uuid";
            $stmt = $conexion->prepare($query);
            $stmt->bindParam(':uuid_sociedad', $id_solicitud, PDO::PARAM_INT);
            $stmt->bindParam(':uuid', $sociedad);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die(json_encode(['status' => 'error', 'message' => 'Error en la consulta SQL: ' . $e->getMessage()]));
        }
    }
    

    public static function obtenerConsecutivos() {
        try {
            /*$sql = "
                    select 
                    a.id_solicitud, CONCAT(b.nombre, ' ', b.apellido) AS nombre_completo
                    from solicitud as a
                    inner join sociedad b ON(a.fk_persona = b.id_sociedad) 
                    ";*/
            $sql = "SELECT DISTINCT(a.uuid), a.nombre_sociedad
                    FROM personas_sociedad a";
            $stmt = Conexion::conectar()->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Usamos fetchAll porque esperamos múltiples plantillas
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function obtenerPlantillas() {
        try {
            $sql = "SELECT id, nombre, nombre_archivo FROM plantillas ORDER BY nombre ASC";
            $consulta = Conexion::conectar()->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return [];
        }
    }

    public static function guardarChecklist($sociedad,$solicitud,$items){ 
        try {
            $sqlInsertar = "INSERT INTO listas_verificacion_sociedades
                (fk_sociedad, fk_solicitud, datos)
                VALUES (:sociedad,:solicitud,:datos)";
            $stmt = Conexion::conectar()->prepare($sqlInsertar);
            $stmt->bindParam(':sociedad', $sociedad);
            $stmt->bindParam(':solicitud', $solicitud);
            $stmt->bindParam(':datos', $items);
            return $stmt->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public static function actualizarChecklist($sociedad,$solicitud,$items){
        try {
            $sql = "UPDATE listas_verificacion_sociedades SET datos=:datos WHERE fk_sociedad=:sociedad AND fk_solicitud=:solicitud";
            $stmt = Conexion::conectar()->prepare($sql);
            $stmt->bindParam(':sociedad', $sociedad);
            $stmt->bindParam(':solicitud', $solicitud);
            $stmt->bindParam(':datos', $items);
            return $stmt->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public static function consultarExisteSociedad($sociedad){
        try {
            $sql = "SELECT listas_verificacion_sociedades_id FROM listas_verificacion_sociedades WHERE fk_sociedad=:sociedad";
            $stmt = Conexion::conectar()->prepare($sql);
            $stmt->bindParam(':sociedad', $sociedad);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Cambio importante: fetchAll()
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public static function selectChecklist($sociedad,$solicitud){
        try {
            $sql = "SELECT datos FROM listas_verificacion_sociedades WHERE fk_sociedad=:sociedad AND fk_solicitud=:solicitud";
            $stmt = Conexion::conectar()->prepare($sql);
            $stmt->bindParam(':sociedad', $sociedad);
            $stmt->bindParam(':solicitud', $solicitud);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Cambio importante: fetchAll()
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

}


?>

  


