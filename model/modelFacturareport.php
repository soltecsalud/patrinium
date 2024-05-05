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

    static public function  getJsonFactura(){
        try {
            $sqlListarJson = " Select * from factura  ";
            $listaJsonFactura = Conexion::conectar()->prepare($sqlListarJson);
            //$listaJsonFactura->bindParam(':usr', $usr, PDO::PARAM_STR, 25);
            $listaJsonFactura->execute();
            return $listaJsonFactura->fetchAll(PDO::FETCH_OBJ);
            echo "error";
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}


?>