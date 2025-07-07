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

    static public function  getJsonFactura($id_solicitud,$invoiceNumber){
        try {
            $id_solicitud_busqueda = $id_solicitud;
            $invoiceNumberConsulta = $invoiceNumber;
            // $sqlListarJson = "SELECT * from factura as a
            // INNER JOIN solicitud as b ON (a.id_solicitud = b.id_solicitud)
            // WHERE a.id_solicitud = :id_solicitud
            // AND (datos->>'invoice_number')=:invoiceNumber";

            $sqlListarJson = "WITH json_data AS (
                SELECT 
                    a.id, a.datos, a.created_at, a.id_solicitud, a.estado, a.ruta_pago, a.tipo_consignacion, a.nota_pago,
                    datos->>'selectPersonaFactura' AS persona,c.nombre_empresa,c.ruta_logo
                FROM factura AS a
                INNER JOIN solicitud AS b ON a.id_solicitud = b.id_solicitud
                LEFT JOIN empresas AS c ON a.datos->>'logo' = c.id_empresa::TEXT
                WHERE a.id_solicitud = :id_solicitud
                AND datos->>'invoice_number' = :invoiceNumber
            )
            SELECT 
                jd.id,
                jd.datos,
                jd.created_at,
                jd.id_solicitud,
                jd.estado,
                jd.ruta_pago,
                jd.tipo_consignacion,
                jd.nota_pago,
                jd.nombre_empresa,
				jd.ruta_logo,
                COALESCE(
                    -- Buscar en personas_sociedad si es UUID válido
                    (SELECT nombre_sociedad 
                    FROM personas_sociedad 
                    WHERE uuid = jd.persona LIMIT 1),

                    -- Buscar en sociedad si es entero válido
                    (SELECT CONCAT(nombre, ' ', apellido) 
                    FROM sociedad 
                    WHERE id_sociedad = NULLIF(jd.persona, '')::INT LIMIT 1),

                    -- Buscar en personas_cliente si es entero válido
                    (SELECT CONCAT(nombre, ' ', apellido) 
                    FROM personas_cliente 
                    WHERE id_persona_cliente = NULLIF(jd.persona, '')::INT LIMIT 1),

                    -- Buscar en sociedad_extranjera si es entero válido
                    (SELECT datos_sociedad->>'nombreSociedad' 
                    FROM sociedad_extranjera 
                    WHERE id_sociedad_extranjera = NULLIF(jd.persona, '')::INT LIMIT 1)
                ) AS nombre_obtenido
            FROM json_data jd";
            $listaJsonFactura = Conexion::conectar()->prepare($sqlListarJson);
            $listaJsonFactura->bindParam(":id_solicitud", $id_solicitud_busqueda, PDO::PARAM_INT);
            $listaJsonFactura->bindParam(":invoiceNumber", $invoiceNumberConsulta);
            $listaJsonFactura->execute();
            return $listaJsonFactura->fetchAll(PDO::FETCH_OBJ);
            echo "error";
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    static public function  getJsonFacturaRapida($id_solicitud,$invoiceNumber){
        try {
            $id_solicitud_busqueda = $id_solicitud;
            $invoiceNumberConsulta = $invoiceNumber;
            $sqlListarJson = "SELECT 
            f.factura_rapida_id,
            f.datos,
            f.estado,
            f.ruta,
            f.tipo_consignacion,
            f.nota_pago,
            f.created_at,
            -- CONCAT(s.nombre, ' ', s.apellido) AS nombre_cliente,
            f.datos->>'clientefactura' AS nombre_cliente,
            c.nombre_empresa,c.ruta_logo
            FROM factura_rapida AS f
            -- INNER JOIN sociedad AS s ON NULLIF(f.datos->>'clientefactura', '')::int = s.id_sociedad
            LEFT JOIN empresas AS c ON f.datos->>'logo' = c.id_empresa::TEXT
            WHERE f.factura_rapida_id = :id_solicitud
            AND (datos->>'invoice_number')=:invoiceNumber";
            $listaJsonFactura = Conexion::conectar()->prepare($sqlListarJson);
            $listaJsonFactura->bindParam(":id_solicitud", $id_solicitud_busqueda, PDO::PARAM_INT);
            $listaJsonFactura->bindParam(":invoiceNumber", $invoiceNumberConsulta);
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

    static public function getCliente($numeroSolicitud,$tabla){
        try {
            $sql = "SELECT 
                CONCAT (so.nombre, ' ', so.apellido) nombre
                FROM factura AS f
                INNER JOIN solicitud AS s ON f.id_solicitud=s.id_solicitud
                INNER JOIN $tabla AS so ON s.fk_cliente=so.uuid
                WHERE f.id_solicitud=:idSolicitud";
            $sql = Conexion::conectar()->prepare($sql);
            $sql->bindParam(":idSolicitud", $numeroSolicitud, PDO::PARAM_INT);
            $sql->execute();
            return $sql->fetch();
    
        } catch (Exception $e) {
            die($e->getMessage());
        }

    }

    static public function getNombreServicio($servicio_name){
        try {
            $sql = "SELECT nombre_servicio FROM servicios WHERE servicio_name=:servicio_name";
            $sql = Conexion::conectar()->prepare($sql);
            $sql->bindParam(":servicio_name", $servicio_name, PDO::PARAM_STR);
            $sql->execute();
            return $sql->fetch();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


}


?>