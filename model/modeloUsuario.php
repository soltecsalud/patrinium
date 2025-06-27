<?php

require_once "conexion.php";

class Usuarios {

   /*====================================================================
	    METODO consultar datos de los usuarios
        Autor: Camilo Castillo
        Actualizado por: Camilo Castillo
        Fecha ultima actualizacion: 2024-04-03
	======================================================================*/

    static public function consultarUsuarios(){
        try {
            $sql = "SELECT 
                        usuarios.*
                        -- ips.nombre_ips,
                        -- eps.nombre_eps
                    FROM usuarios
                    -- INNER JOIN ips AS ips ON usuarios.id_sede = ips.id_ips
                    -- INNER JOIN eps AS eps ON usuarios.id_eps = eps.id_eps
                    WHERE usuarios.estado = :estado";
            $consulta = Conexion::conectar()->prepare($sql);

            $estado = 'activo';
            $consulta->bindParam(':estado', $estado, PDO::PARAM_STR);
            $consulta->execute();

            return $consulta->fetchAll(PDO::FETCH_ASSOC);

        } catch (Exception $e){
            die($e->getMessage());
        }
    }

    /*=============================================
	MODELO para registrar usuarios
	=============================================*/

    static public function registrarUsuario($datos){
        try {
            $sql = "INSERT INTO 
                        usuarios 
                        (id_usuario, identificacion, usuario, password, tipo_doc, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, correo, telefono, rol, estado, fecha_creacion, usuario_add) 
                    VALUES 
                        (:id, :ident, :user, :pass, :t_doc, :p_nom, :s_nom, :p_ape, :s_ape, :correo, :tel, :rol, :estado, :f_registro, :usuario_add) 
                    RETURNING id_usuario";
            $consulta = Conexion::conectar()->prepare($sql);
            
            // Bind de parámetros
            $consulta->bindParam(':id', $datos['id'], PDO::PARAM_STR);
            $consulta->bindParam(':ident', $datos['identificacion'], PDO::PARAM_INT);
            $consulta->bindParam(':user', $datos['usuario'], PDO::PARAM_STR);
            $consulta->bindParam(':pass', $datos['password'], PDO::PARAM_STR);
            $consulta->bindParam(':t_doc', $datos['tipo_doc'], PDO::PARAM_STR);
            $consulta->bindParam(':p_nom', $datos['primer_nombre'], PDO::PARAM_STR);
            $consulta->bindParam(':s_nom', $datos['segundo_nombre'], PDO::PARAM_STR);
            $consulta->bindParam(':p_ape', $datos['primer_apellido'], PDO::PARAM_STR);
            $consulta->bindParam(':s_ape', $datos['segundo_apellido'], PDO::PARAM_STR);
            $consulta->bindParam(':correo', $datos['correo'], PDO::PARAM_STR);
            $consulta->bindParam(':tel', $datos['telefono'], PDO::PARAM_STR);
            // $consulta->bindParam(':id_sede', $datos['id_sede'], PDO::PARAM_INT);
            // $consulta->bindParam(':id_esp', $datos['id_especialidad'], PDO::PARAM_STR);
            // $consulta->bindParam(':ese', $datos['ese'], PDO::PARAM_STR);
            $consulta->bindParam(':rol', $datos['rol'], PDO::PARAM_STR);
            // $consulta->bindParam(':id_eps', $datos['id_eps'], PDO::PARAM_INT);
            $consulta->bindParam(':estado', $datos['estado'], PDO::PARAM_STR); 
            $consulta->bindParam(':f_registro', $datos['fecha_creacion'], PDO::PARAM_STR);
            $consulta->bindParam(':usuario_add', $datos['usuario_add'], PDO::PARAM_STR);
            // $consulta->bindParam(':firma', $datos['firma'], PDO::PARAM_STR);

            return $consulta->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    
    /*==================================================
	MODELO para consultar los usuarios
	=================================================*/

    static public function mdlConsultarUsuariosActivos()
    {
        try {
            $sql = "SELECT * FROM usuarios WHERE estado = 'activo'";
            $consulta = Conexion::conectar()->prepare($sql);
            $consulta->execute();

            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /*==================================================
        MODELO para consultar los datos de un usuario
        Autor: Camilo Castillo
        Actualizado por: Hector Diaz
        Fecha ultima actualizacion: 2024-03-10
	====================================================*/

    static public function consultarUsuarioId($id_usuario){
        try {
            $sql = "SELECT 
                        usuarios.*
                        -- ips.nombre_ips,
                        -- eps.nombre_eps
                    FROM usuarios 
                    -- INNER JOIN ips AS ips ON usuarios.id_sede = ips.id_ips
                    -- INNER JOIN eps AS eps ON usuarios.id_eps = eps.id_eps
                    WHERE usuarios.id_usuario = :id";

            $consulta = Conexion::conectar()->prepare($sql);
            $consulta->bindParam(':id', $id_usuario, PDO::PARAM_INT);
            $consulta->execute();

            return $consulta->fetch(PDO::FETCH_ASSOC);
        }
        catch (Exception $e){
            die($e->getMessage());
        }
    }

    /*=============================================
	MODELO para actualizar los datos del usuario
	=============================================*/

    static public function editarUsuario($datosUsuario){
        try {
            //agregar (actualizar password)
            $sql = "UPDATE 
                        usuarios 
                    SET 
                        identificacion = :ident, 
                        usuario = :user, 
                        tipo_doc = :t_doc, 
                        primer_nombre = :p_nom, 
                        segundo_nombre = :s_nom, 
                        primer_apellido = :p_ape, 
                        segundo_apellido = :s_ape, 
                        correo = :correo, 
                        telefono = :tel, 
                        -- id_sede = :id_sede, 
                        -- id_especialidad = :id_esp, 
                        -- ese = :id_ser, 
                        rol = :rol
                        -- id_eps = :id_eps 
                    WHERE id_usuario = :id_usuario";
            $consulta = Conexion::conectar()->prepare($sql);

            $consulta->bindParam('id_usuario', $datosUsuario['id_usuario'], PDO::PARAM_INT);
            $consulta->bindParam(':ident', $datosUsuario['identificacion'], PDO::PARAM_INT);
            $consulta->bindParam(':user', $datosUsuario['usuario'], PDO::PARAM_STR);
            $consulta->bindParam(':t_doc', $datosUsuario['tipo_doc'], PDO::PARAM_STR);
            $consulta->bindParam(':p_nom', $datosUsuario['primer_nombre'], PDO::PARAM_STR);
            $consulta->bindParam(':s_nom', $datosUsuario['segundo_nombre'], PDO::PARAM_STR);
            $consulta->bindParam(':p_ape', $datosUsuario['primer_apellido'], PDO::PARAM_STR);
            $consulta->bindParam(':s_ape', $datosUsuario['segundo_apellido'], PDO::PARAM_STR);
            $consulta->bindParam(':correo', $datosUsuario['correo'], PDO::PARAM_STR);
            $consulta->bindParam(':tel', $datosUsuario['telefono'], PDO::PARAM_STR);
            // $consulta->bindParam(':id_sede', $datosUsuario['id_sede'], PDO::PARAM_INT);
            // $consulta->bindParam(':id_esp', $datosUsuario['id_especialidad'], PDO::PARAM_INT);
            // $consulta->bindParam(':id_ser', $datosUsuario['ese'], PDO::PARAM_INT);
            $consulta->bindParam(':rol', $datosUsuario['rol'], PDO::PARAM_STR);
            // $consulta->bindParam(':id_eps', $datosUsuario['id_eps'], PDO::PARAM_INT);

            return $consulta->execute();
        }
        catch (Exception $e){
            die($e->getMessage());
        }
    }

    static public function editarClave($datosUsuario){
        try {
            //agregar (actualizar password)
            $sql = "UPDATE usuarios SET password = :password, update_at = :update_at, update_by = :update_by WHERE id_usuario = :id_usuario";
            $consulta = Conexion::conectar()->prepare($sql);

            $update_at = date("Y-m-d H:i:s");
            $update_by = $_SESSION['usuario'];
            $consulta->bindParam(':id_usuario', $datosUsuario['id_usuario'], PDO::PARAM_INT);
            $consulta->bindParam(':update_at', $update_at);
            $consulta->bindParam(':update_by', $update_by, PDO::PARAM_STR);
            $consulta->bindParam(':password', $datosUsuario['password'], PDO::PARAM_STR);
            return $consulta->execute();
        }
        catch (Exception $e){
            die($e->getMessage());
        }
    }

    /*=================================================================================
	MODELO para eliminar (Cambiar estado a Inactivo) Usuarios
	====================================================================================*/

    static public function eliminarUsuario($id_usuario){
        try {
            $sql = "UPDATE usuarios SET estado = :estado, delete_at = :delete_at, delete_by = :delete_by WHERE id_usuario = :id";
            $consulta = Conexion::conectar()->prepare($sql);
            $consulta->bindParam(':id', $id_usuario, PDO::PARAM_INT);
            $estado = "Inactivo";
            $delete_at = date("Y-m-d H:i:s");
            $delete_by = $_SESSION['usuario'];
            $consulta->bindParam(':delete_at', $delete_at);
            $consulta->bindParam(':delete_by', $delete_by, PDO::PARAM_STR);
            $consulta->bindParam(':estado', $estado, PDO::PARAM_STR);
            $consulta->execute();

        }
        catch (Exception $e){
            die($e->getMessage());
        }
    }

    /*======================================================================================
	MODELO para validar que la (identificacion) no sean repetidos.
	=======================================================================================*/

    static public function existeIdentificacion($identificacion){
        $sql = "SELECT COUNT(*) FROM usuarios WHERE identificacion = :identificacion";

        $consulta = Conexion::conectar()->prepare($sql);
        $consulta->bindParam(':identificacion', $identificacion, PDO::PARAM_INT);
        $consulta->execute();

        return $consulta->fetchColumn() > 0;
    }

    /*======================================================================================
	MODELO para validar que la (usuario) no sean repetidos.
	=======================================================================================*/

    static public function existeUsuario($usuario){
        $sql = "SELECT COUNT(*) FROM usuarios WHERE usuario = :usuario";

        $consulta = Conexion::conectar()->prepare($sql);
        $consulta->bindParam(':usuario', $usuario, PDO::PARAM_STR);
        $consulta->execute();

        return $consulta->fetchColumn() > 0;
    }

    /*======================================================================================
	MODELO para validar que la (identificacion) no sean repetidos.
	=======================================================================================*/

    static public function existeCorreo($correo){
        $sql = "SELECT COUNT(*) FROM usuarios WHERE correo = :correo";

        $consulta = Conexion::conectar()->prepare($sql);
        $consulta->bindParam(':correo', $correo, PDO::PARAM_STR);
        $consulta->execute();

        return $consulta->fetchColumn() > 0;
    }

    /*======================================================================================
	MODELO para validar que la (identificacion) no sean repetidos.
	=======================================================================================*/

    static public function existeTelefono($telefono){
        $sql = "SELECT COUNT(*) FROM usuarios WHERE telefono = :telefono";

        $consulta = Conexion::conectar()->prepare($sql);
        $consulta->bindParam(':telefono', $telefono, PDO::PARAM_STR);
        $consulta->execute();

        return $consulta->fetchColumn() > 0;
    }

}
