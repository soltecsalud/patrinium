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

    static public function getBanco($id_banco){
        try {
            $id_banco_busqueda = $id_banco;
            $sqlListarBanco = " Select * from bancos_consignaciones where id_banco = :id_banco";
            $listaBanco = Conexion::conectar()->prepare($sqlListarBanco);
            $listaBanco->bindParam(":id_banco", $id_banco_busqueda, PDO::PARAM_INT);
            $listaBanco->execute();
            return $listaBanco->fetchAll(PDO::FETCH_ASSOC);
            echo "error";
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}


?>