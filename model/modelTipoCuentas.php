<?php 
    require_once('conexion.php');

    class TipoCuentasModel {
        public function getTipoCuentas() { 
            try {
                $query = "SELECT * FROM tipo_cuenta_bancos";
                $result = Conexion::conectar()->prepare($query);
                $result->execute();
                return $result->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                return array("error" => "Error en la consulta: " . $e->getMessage());
            }
        }
    }

?>