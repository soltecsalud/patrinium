<?php 
    require_once('conexion.php');

    class EstadosModel {
        public function getEstados() {
            try {
                $query = "SELECT * FROM estados";
                $result = Conexion::conectar()->prepare($query);
                $result->execute();
                return $result->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                return array("error" => "Error en la consulta: " . $e->getMessage());
            }
        }
    }

?>