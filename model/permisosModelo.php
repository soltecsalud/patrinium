<?php
require_once "conexion.php";
class PermisosModelo
{
    /*==================================================
	MODELO para consultar todos los permisos
	====================================================*/
    static public function mdlConsultarPermisos()
    {
        try {
            // $sql = "SELECT * FROM permisos";
            $sql = "SELECT * FROM submenus"; // Cambié a submenus para la prueba
            $consulta = Conexion::conectar()->prepare($sql);
            $consulta->execute();

            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /*=============================================
        MODELO para registrar un permiso
    ===============================================*/
    static public function mdlRegistrarPermiso($datos)
    {
        try {
            $sql = "INSERT INTO permisos 
                        (id, nombre, created_at) 
                    VALUES 
                        (:id, :nombre, :created_at) 
                    RETURNING id";
            $consulta = Conexion::conectar()->prepare($sql);
            $created_at = date('Y-m-d h:i:s');
            // Bind de parámetros
            $consulta->bindParam(':id', $datos['id'], PDO::PARAM_STR);
            $consulta->bindParam(':nombre', $datos['permiso'], PDO::PARAM_STR);
            $consulta->bindParam(':created_at', $created_at);

            return $consulta->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}
