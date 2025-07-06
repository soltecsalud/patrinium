<?php 

require_once "conexion.php";

class ModelEmpresas
{
    static public function insertEmpresa($data)
    {
        try {
            $sql = "INSERT INTO empresas (nombre_empresa, direccion_empresa, ruta_logo, correo) 
            VALUES (:nombre_empresa, :direccion, :logo, :correo)";
            $stmt = Conexion::conectar()->prepare($sql);
            $stmt->bindParam(':nombre_empresa', $data['nombre']);
            $stmt->bindParam(':direccion', $data['direccion']);
            $stmt->bindParam(':correo', $data['correo']);
            $stmt->bindParam(':logo', $data['logo']);
            if ($stmt->execute()) {
                return "ok";
            } else {
                return "error";
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    static public function actualizarEmpresa($data)
    {
        try {
            $sql = "UPDATE empresas SET nombre_empresa = :nombre_empresa, direccion_empresa = :direccion, ruta_logo = :logo, correo = :correo WHERE id_empresa = :id_empresa";
            $stmt = Conexion::conectar()->prepare($sql);
            $stmt->bindParam(':id_empresa', $data['id_empresa']);
            $stmt->bindParam(':nombre_empresa', $data['nombre']);
            $stmt->bindParam(':direccion', $data['direccion']);
            $stmt->bindParam(':correo', $data['correo']);
            $stmt->bindParam(':logo', $data['logo']);
            if ($stmt->execute()) {
                return "ok";
            } else {
                return "error";
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    static public function eliminarEmpresa($id_empresa)// Se inabilita la empresa en lugar de eliminarla, para eso estado pasa a falso
    {
        try {
            $sql = "UPDATE empresas SET estado = false WHERE id_empresa = :id_empresa";// Cambiamos el estado a false en lugar de eliminar
            $stmt = Conexion::conectar()->prepare($sql);
            $stmt->bindParam(':id_empresa', $id_empresa);
            if ($stmt->execute()) {
                return "ok";
            } else {
                return "error";
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    static public function listarEmpresas()
    {
        try {
            $sql = "SELECT * FROM empresas WHERE estado = true ORDER BY id_empresa DESC";
            $stmt = Conexion::conectar()->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}


?>