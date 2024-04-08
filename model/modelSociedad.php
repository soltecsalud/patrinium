<?php
require_once('conexion.php');

class modelSociedad{



    static public function mdlInsertarSociedad($datos)
    {
        try {
            echo '<pre>';
            print_r($datos);
            echo '</pre>';
            $sqlInsertarSociedad="INSERT INTO public.sociedades(
                    nombre_sociedad, referencia_sociedad, 
                    estado, fecha_registro, numero_registro, 
                    fecha_renta, pais_sociedad, estado_sociedad, cantidad_socios)
                    VALUES ( :nombre_sociedad, :referencia_sociedad, :estado,
                    :fecha_registro, :numero_registro, :fecha_renta, :pais_sociedad,
                    :estado_sociedad, :cantidad_socios);";
                    
             $stmt = Conexion::conectar()->prepare($sqlInsertarSociedad);
             $stmt->bindParam(":nombre_sociedad",$datos["nombreSociedad"],  PDO::PARAM_STR);
             $stmt->bindParam(":referencia_sociedad",$datos["referenciaSociedad"], PDO::PARAM_STR);
             $stmt->bindParam(":estado",$datos["estadoUsa"], PDO::PARAM_STR);
             $stmt->bindParam(":fecha_registro",$datos["fechaRegistro"]);
             $stmt->bindParam(":numero_registro",$datos["numeroRegistro"], PDO::PARAM_STR);
             $stmt->bindParam(":fecha_renta",$datos["fechaRenta"]);
             $stmt->bindParam(":pais_sociedad",$datos["paisSociedad"], PDO::PARAM_STR);
             $stmt->bindParam(":estado_sociedad",$datos["estado"], PDO::PARAM_STR);
             $stmt->bindParam(":cantidad_socios",$datos["cantidadSocios"], PDO::PARAM_INT);

             

             if($stmt->execute()) {
                return "ok";
            } else {
                return "error";
            } 
            
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    static public function  mdlGetsociedad(){
        try {
            $sqlListarSociedades = "SELECT * FROM sociedades";
            $listaSociedades = Conexion::conectar()->prepare($sqlListarSociedades);
            $listaSociedades->execute();
            return $listaSociedades->fetchAll(PDO::FETCH_ASSOC);
            echo "error";
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
















?>