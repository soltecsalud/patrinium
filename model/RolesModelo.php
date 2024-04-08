<?php
require_once "conexion.php";
class RolesModelo
{
    /*==================================================
	MODELO para consultar los roles de la base de datos
	====================================================*/
    static public function mdlConsultarRoles()
    {
        try {
            $sql = "SELECT * FROM roles";
            $consulta = Conexion::conectar()->prepare($sql);
            $consulta->execute();

            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /*===========================================================
	MODELO para consultar los datos de un rol a traves de su id
	=============================================================*/
    static public function mdlConsultarDatosRolId($id_rol)
    {
        try {
            $sql = "SELECT * FROM roles WHERE id = :id";
            $consulta = Conexion::conectar()->prepare($sql);
            $consulta->bindParam(':id', $id_rol, PDO::PARAM_STR);
            $consulta->execute();

            return $consulta->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /*=============================================
	MODELO para actualizar los datos de un rol
	===============================================*/
    static public function mdlEditarPermisosRol($datos)
    {
        try {
            // $sql = "UPDATE roles SET inicio_ruta = :iniRuta, entrega_resultados = :entregaResul, resultados_entregados = :resulEntreg, impresion_resultados = :impresResult, laboratorio = :laboratorio, vph = :vph, integracion_viper = :viper, seguimientos = :segui, colposcopia = :colcos, pacientes = :pacie, informacion = :inform, informes = :info, config_general = :configGene, seguridad = :seguridad WHERE id = :id";
            // $consulta = Conexion::conectar()->prepare($sql);
            // $consulta->bindParam(':id', $datos['id'], PDO::PARAM_STR);
            // return $consulta->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /*============================================================================
	MODELO para consultar los permisos asignados a un rol a traves del id del rol
	==============================================================================*/
    static public function mdlConsultarPermisosRol($id_rol)
    {
        try {
            $sql = "SELECT roles_has_permiso.id_permiso
                            FROM roles_has_permiso
                            WHERE id_rol=:id_rol";
            $consulta = Conexion::conectar()->prepare($sql);
            $consulta->bindParam(':id_rol', $id_rol, PDO::PARAM_STR);
            $consulta->execute();

            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


    /*================================================================================
	MODELO para consultar los permisos asignados a un rol a traves del nombre del rol
	==================================================================================*/
    static public function mdlConsultarPermisosNombreRol($rol)
    {
        try {
            $sql = "SELECT roles_has_permiso.id_permiso
                            FROM roles_has_permiso
                            INNER JOIN roles AS rol ON rol.id = roles_has_permiso.id_rol 
                            WHERE rol.rol=:rol";
            $consulta = Conexion::conectar()->prepare($sql);
            $consulta->bindParam(':rol', $rol, PDO::PARAM_STR);
            $consulta->execute();

            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /*=============================================
    MODELO para registrar un permiso a un rol
    ===============================================*/
    static public function mdlRegistrarPermisoRol($id_rol, $id_permiso)
    {
        try {
            $sql = "INSERT 
                            INTO roles_has_permiso 
                                (id_rol, id_permiso	) 
                            VALUES 
                                (:id_rol, :id_permiso)";
            $consulta = Conexion::conectar()->prepare($sql);
            // Bind de parámetros
            $consulta->bindParam(':id_rol', $id_rol, PDO::PARAM_STR);
            $consulta->bindParam(':id_permiso', $id_permiso, PDO::PARAM_STR);

            return $consulta->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /*=============================================
	MODELO para eliminar los permisos a un rol
	===============================================*/

    static public function mdlEliminarPermisos($id_rol)
    {
        try {
            $sql = "DELETE FROM roles_has_permiso WHERE id_rol = :id";
            $consulta = Conexion::conectar()->prepare($sql);
            $consulta->bindParam(':id', $id_rol, PDO::PARAM_STR);
            $consulta->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
