<?php

require_once('conexion.php');

class ModelLogin
{
    /*=============================================
	MODELO validar Login
	=============================================*/

    static public function mdlValidarLogin($usr)
    {
        try {
            $sqlListarCaso = "SELECT * FROM usuarios WHERE usuario = :usr";
            $listaCaso = Conexion::conectar()->prepare($sqlListarCaso);
            $listaCaso->bindParam(':usr', $usr, PDO::PARAM_STR, 25);
            $listaCaso->execute();
            return $listaCaso->fetchAll(PDO::FETCH_OBJ);
            echo "error";
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}
