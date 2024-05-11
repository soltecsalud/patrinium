<?php
require_once('conexion.php');

class ReportModel {
    public function getData() {
        // Obtener datos, por ejemplo, de una base de datos
        return [
            ["nombre" => "John Doe", "edad" => 30],
            ["nombre" => "Jane Doe", "edad" => 28]
        ];
    }

    static public function  getJsonFactura($id_solicitud){
        try {
            $id_solicitud_busqueda = $id_solicitud;
            $sqlListarJson = " Select * from factura where id_solicitud = :id_solicitud";
            $listaJsonFactura = Conexion::conectar()->prepare($sqlListarJson);
            $listaJsonFactura->bindParam(":id_solicitud", $id_solicitud_busqueda, PDO::PARAM_INT);
            $listaJsonFactura->execute();
            return $listaJsonFactura->fetchAll(PDO::FETCH_OBJ);
            echo "error";
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}


?>