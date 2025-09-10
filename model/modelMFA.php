<?php

require_once "conexion.php";

class modelMFA { 

    public static function mdlActualizarEstadoMFAUsuario($estado, $id_usuario) {
        $stmt = Conexion::conectar()->prepare("UPDATE personas_sociedad SET is_mfa_enabled = :estado WHERE uuid = :id_sociedad");
        $stmt->bindParam(":estado", $estado, PDO::PARAM_BOOL);
        $stmt->bindParam(":id_sociedad", $id_usuario, PDO::PARAM_STR);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public static function mdlActualizarEstadoMFASolicitud($estado, $id_solicitud) {
        $stmt = Conexion::conectar()->prepare("UPDATE solicitud SET is_mfa_enabled = :estado WHERE id_solicitud = :id_solicitud");
        $stmt->bindParam(":estado", $estado, PDO::PARAM_BOOL);
        $stmt->bindParam(":id_solicitud", $id_solicitud, PDO::PARAM_STR);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

}



?>