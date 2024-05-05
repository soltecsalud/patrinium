<?php
require_once('conexion.php');

class ModelSolicitud
{
    public static function obtenerSolicitud($id_solicitud) {
        try {
            $sqlListarSolicitud = "SELECT * FROM solicitud WHERE id_solicitud = :id_solicitud";
            $listaSolicutd = Conexion::conectar()->prepare($sqlListarSolicitud);
            $listaSolicutd->bindParam(':id_solicitud', $id_solicitud, PDO::PARAM_INT);
            $listaSolicutd->execute();
            return $listaSolicutd->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public static function obtenerAllSolicitud() {
        try {
            $sqlListarSolicitud = "
            SELECT a.id_solicitud, a.nombre_cliente,a.referido_por, a.created_at FROM solicitud as a
            left join archivo_adjunto as ar ON(a.id_solicitud = ar.id_solicitud)
			where ar.id_solicitud is null
            ";
            $listaSolicutd = Conexion::conectar()->prepare($sqlListarSolicitud);           
            $listaSolicutd->execute();
            return $listaSolicutd->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public static function obtenerServicios($id_solicitud) {
        try {
            $solicitud_id = $id_solicitud;
            $sqlListarSolicitud = "
            SELECT servicios, servicios_adicionales FROM solicitud where id_solicitud = :id_solicitud 
            ";
            $listaSolicitud = Conexion::conectar()->prepare($sqlListarSolicitud);   
            $listaSolicitud->bindParam(':id_solicitud', $solicitud_id, PDO::PARAM_INT);        
            $listaSolicitud->execute();
            $resultados = $listaSolicitud->fetchAll(PDO::FETCH_ASSOC);
          
            return $resultados;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public static function obtenerAdjuntos($condicion) {
        try {
            $sqlListarSolicitud = "
            SELECT * FROM archivo_adjunto where id_solicitud = $condicion ;
            ";
            $listaSolicutd = Conexion::conectar()->prepare($sqlListarSolicitud);           
            $listaSolicutd->execute();
            return $listaSolicutd->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public static function obtenerSolicitudesConAdjuntos() {
        try {
            $sqlListarSolicitud ="
            SELECT * FROM solicitud as a
            inner join archivo_adjunto as ar ON(a.id_solicitud = ar.id_solicitud)
           ";
            $listaSolicutd = Conexion::conectar()->prepare($sqlListarSolicitud);           
            $listaSolicutd->execute();
            return $listaSolicutd->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public static function validacionDocumentoAdjuntoSolicitud($id_solicitud) {
        try {
            $sqlListarSolicitud ="
            SELECT count(a.id_solicitud) FROM solicitud as a
            inner join archivo_adjunto as ar ON(a.id_solicitud = ar.id_solicitud)
            where a.id_solicitud = $id_solicitud
           ";
            $listaSolicutd = Conexion::conectar()->prepare($sqlListarSolicitud);           
            $listaSolicutd->execute();
            return $listaSolicutd->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    //modelo para insertar en BD el nombre del archivo, fecha, descripcion
    public static function insertarSolicitud($datos,$checkbox,$camposDinamicos) {
        try {
            $camposDinamicosJSON =json_encode($camposDinamicos);
            $checkboxJSON = json_encode($checkbox);

            $sql = "INSERT INTO solicitud (nombre_cliente, referido_por, necesidad, created_at,servicios,servicios_adicionales) 
            VALUES (:nombre_cliente, :referido_por, :necesidad, NOW(),:servicios,:servicios_adicionales)";
            $stmt = Conexion::conectar()->prepare($sql);
            $stmt->bindParam(':nombre_cliente', $datos['nombre_cliente'], PDO::PARAM_STR);
            $stmt->bindParam(':referido_por', $datos['referido_por'], PDO::PARAM_STR);
            $stmt->bindParam(':necesidad', $datos['necesidad'], PDO::PARAM_STR);
            $stmt->bindParam(':servicios', $checkboxJSON, PDO::PARAM_STR);
            $stmt->bindParam(':servicios_adicionales', $camposDinamicosJSON, PDO::PARAM_STR);
            
            
           
            if($stmt->execute()) {
                return "ok";
            } else {
                return "error";
            } 
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public static function insertarArchivoSolicitud($datos) {
        try {
            $sql = "INSERT INTO public.archivo_adjunto(
                 nombre_archivo, descripcion, id_solicitud, create_at)
                VALUES ( :nombre_archivo, :descripcion, :id_solicitud, NOW());";
            $stmt = Conexion::conectar()->prepare($sql);
            $stmt->bindParam(':nombre_archivo', $datos['nombre_archivo'], PDO::PARAM_STR);
            $stmt->bindParam(':descripcion', $datos['descripcion'], PDO::PARAM_STR);
            $stmt->bindParam(':id_solicitud', $datos['id_solicitud'], PDO::PARAM_INT);
            
            
           
            if($stmt->execute()) {
                return "ok";
            } else {
                return "error";
            } 
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public static function insertarFactura($datos,$id) {
        try {
            $id_solicitud = $id;
            $json_datos = json_encode($datos);
            $sql = "INSERT INTO public.factura(
                 datos, created_at,id_solicitud)
                VALUES ( :datos, NOW(),:id_solicitud);
            ";
            $stmt = Conexion::conectar()->prepare($sql);
            $stmt->bindParam(':datos', $json_datos);
            $stmt->bindParam(':id_solicitud', $id_solicitud, PDO::PARAM_INT);
            
            
           
            if($stmt->execute()) {
                return "ok";
            } else {
                return "error";
            } 
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    
}
?>