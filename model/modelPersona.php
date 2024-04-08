<?php
require_once('conexion.php');

class ModelBuscarPersona
{
    public static  function obtenerPersona() {
        try {
            $sqlListarPersona = "SELECT * FROM persona ";
            $listaPersona = Conexion::conectar()->prepare($sqlListarPersona);
            $listaPersona->execute();
            return $listaPersona->fetchAll(PDO::FETCH_OBJ);
            
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}
?>