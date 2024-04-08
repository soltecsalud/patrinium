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

}
?>