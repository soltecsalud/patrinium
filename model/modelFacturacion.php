<?php
require_once "conexion.php";

class ModelFacturacion {
    
    public function listarFacturas() {

        try {
           /* $sql = "SELECT * FROM factura AS f
            INNER JOIN bancos_consignaciones AS b 
            ON NULLIF(f.datos->>'cuenta_bancaria', '')::int = b.id_banco
            WHERE estado = 2 OR estado = null";*/
			$sql = "SELECT 
                f.*, 
                b.*, 
                c.nombre_empresa,c.ruta_logo,
                COALESCE(
                    (SELECT nombre_sociedad 
                    FROM personas_sociedad 
                    WHERE uuid::text = f.datos->>'selectPersonaFactura' 
                    LIMIT 1), 
                    (SELECT CONCAT(nombre, ' ', apellido) AS nombre 
                    FROM sociedad 
                    WHERE id_sociedad::text = NULLIF(f.datos->>'selectPersonaFactura', '')),
                    -- WHERE uuid::text = NULLIF(f.datos->>'selectPersonaFactura', '')),
                    (SELECT CONCAT(nombre, ' ',apellido) AS nombre FROM personas_cliente WHERE id_persona_cliente = NULLIF(f.datos->>'selectPersonaFactura', '')::int),
                    (SELECT datos_sociedad->>'nombreSociedad' AS nombre 
                    FROM sociedad_extranjera 
                    WHERE id_sociedad_extranjera = NULLIF(f.datos->>'selectPersonaFactura', '')::int),
                    'N/A'
                ) AS nombre_obtenido
            FROM 
                factura AS f
            INNER JOIN bancos_consignaciones AS b ON NULLIF(f.datos->>'cuenta_bancaria', '')::int = b.id_banco
            LEFT JOIN empresas AS c ON f.datos->>'logo' = c.id_empresa::TEXT
            WHERE 
                f.estado = 2 OR f.estado IS NULL";
            $consulta = Conexion::conectar()->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }

    }

    public function listarFacturasPagadas() {

        try {
            $estado = 1;
            $sql = "SELECT 
                f.*, 
                b.*, 
                COALESCE(
                    (SELECT nombre_sociedad 
                    FROM personas_sociedad 
                    WHERE uuid::text = f.datos->>'selectPersonaFactura' 
                    LIMIT 1), 
                    (SELECT CONCAT(nombre, ' ', apellido) AS nombre 
                    FROM sociedad 
                    WHERE uuid::text = NULLIF(f.datos->>'selectPersonaFactura', '')),
                    (SELECT CONCAT(nombre, ' ',apellido) AS nombre FROM personas_cliente WHERE id_persona_cliente = NULLIF(f.datos->>'selectPersonaFactura', '')::int),
                    (SELECT datos_sociedad->>'nombreSociedad' AS nombre 
                    FROM sociedad_extranjera 
                    WHERE id_sociedad_extranjera = NULLIF(f.datos->>'selectPersonaFactura', '')::int),
                    'N/A'
                ) AS nombre_obtenido
            FROM 
                factura AS f
            INNER JOIN 
                bancos_consignaciones AS b 
                ON NULLIF(f.datos->>'cuenta_bancaria', '')::int = b.id_banco
            WHERE 
                estado =:estado OR estado IS NULL
            ";
            $consulta = Conexion::conectar()->prepare($sql);
            $consulta->bindParam(':estado',$estado , PDO::PARAM_STR);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }

    }

    public function listarServicios() {

        try {
            $estado = 2;
            $sql = "SELECT * FROM factura where estado = :estado";
            $consulta = Conexion::conectar()->prepare($sql);
            $consulta->bindParam(':estado',$estado , PDO::PARAM_INT);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }

    }

    public static function uploadInvoice($datos,$estado_factura,$dato_partial_amount){
        try {
            $sql = "UPDATE factura SET 
            datos = datos || :datos::jsonb,
            estado = :estado, 
            tipo_consignacion = :tipo_consignacion, 
            ruta_pago = :ruta_pago,
            nota_pago = :nota_pago
            where id_solicitud = :id_solicitud AND id = :id_factura";
            $consulta = Conexion::conectar()->prepare($sql); 
            // Convertir $datos a JSON
            // $json_datos = json_encode($dato_partial_amount,JSON_UNESCAPED_UNICODE);
            $json_datos = !empty($dato_partial_amount) ? json_encode($dato_partial_amount, JSON_UNESCAPED_UNICODE) : '{}';
            // Vincular los parámetros
            $consulta->bindParam(':datos', $json_datos, PDO::PARAM_STR);
            $consulta->bindParam(':estado', $estado_factura, PDO::PARAM_INT);
            $consulta->bindParam(':tipo_consignacion', $datos['payment_option'], PDO::PARAM_STR);
            $consulta->bindParam(':ruta_pago', $datos['nombre_archivo'], PDO::PARAM_STR);
            $consulta->bindParam(':nota_pago', $datos['payment_notes'], PDO::PARAM_STR);
            $consulta->bindParam(':id_solicitud', $datos['solicitud'], PDO::PARAM_STR); // Usa $datos directamente
            $consulta->bindParam(':id_factura', $datos['id_factura'], PDO::PARAM_INT); // Usa $datos directamente
            $consulta->execute();

            return "ok";
        
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public static function mdlPagarFacturaRapida($datos,$estado_factura,$dato_partial_amount){
        try {
            $sql = "UPDATE factura_rapida set estado =  :estado, 
            datos = datos || :datos::jsonb,
            tipo_consignacion = :tipo_consignacion, 
            ruta = :ruta_pago,
            nota_pago = :nota_pago
            WHERE factura_rapida_id = :id_factura";
            $consulta = Conexion::conectar()->prepare($sql);

            // Convertir $datos a JSON
            $json_datos = !empty($dato_partial_amount) ? json_encode($dato_partial_amount, JSON_UNESCAPED_UNICODE) : '{}';
            // Vincular los parámetros
            $consulta->bindParam(':datos', $json_datos, PDO::PARAM_STR);
            $consulta->bindParam(':estado', $estado_factura, PDO::PARAM_INT);
            $consulta->bindParam(':tipo_consignacion', $datos['payment_option'], PDO::PARAM_STR);
            $consulta->bindParam(':ruta_pago', $datos['nombre_archivo'], PDO::PARAM_STR);
            $consulta->bindParam(':nota_pago', $datos['payment_notes'], PDO::PARAM_STR);
            $consulta->bindParam(':id_factura', $datos['idfactura']); // Usa $datos directamente
            $consulta->execute();

            return "ok";
        
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public static function actualizarEstadoFactura($datos) {
        try {
            // Preparar la consulta SQL para actualizar el estado de la factura
            $sql = "UPDATE factura SET estado = 0 WHERE id_solicitud = :id_solicitud AND id = :id";
            $consulta = Conexion::conectar()->prepare($sql);
    
            // Vincular los parámetros
            $consulta->bindParam(':id_solicitud', $datos['id_solicitud'], PDO::PARAM_INT);
            $consulta->bindParam(':id', $datos['id'], PDO::PARAM_INT);
    
            // Ejecutar la consulta
            $consulta->execute();
    
            return "ok";
        } catch (Exception $e) {
            // Manejar la excepción y devolver un mensaje de error
            die($e->getMessage());
        }
    }

    public static function actualizarFactura($datos, $id_factura) { 
        try {
            $json_datos = json_encode($datos);
            // Preparar la consulta SQL para actualizar el estado de la factura
            $sql = "UPDATE factura SET datos = :datos WHERE id = :id";
            $consulta = Conexion::conectar()->prepare($sql);
            // Vincular los parámetros
            $consulta->bindParam(':datos', $json_datos); 
            $consulta->bindParam(':id', $id_factura, PDO::PARAM_INT);
            // Ejecutar la consulta
            $consulta->execute();
    
            return "ok";
        } catch (Exception $e) {
            // Manejar la excepción y devolver un mensaje de error
            die($e->getMessage());
        }
    }

    public static function eliminarFactura($id_factura) {
        try {
            // Preparar la consulta SQL para eliminar la factura
            $sql = "DELETE FROM factura WHERE id = :id";
            $consulta = Conexion::conectar()->prepare($sql);
            // Vincular los parámetros
            $consulta->bindParam(':id', $id_factura, PDO::PARAM_INT);
            // Ejecutar la consulta
            // $consulta->execute(); 
            return $consulta->execute() ? "ok" : "error";
        } catch (Exception $e) {
            // Manejar la excepción y devolver un mensaje de error
            die($e->getMessage());
        }
    }

    public static function obtenerTiposPago() {
        try {
            $sql = "SELECT tipo_pago FROM tipo_pago";
            $consulta = Conexion::conectar()->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


    public static function buscarInvoiceNumber($campo){ 
        try {
            $nombre ="%$campo%"; 
            $sqlListarCliente = "SELECT id FROM factura WHERE (datos->>'invoice_number' LIKE :campo) OR (datos->>'invoice_number'=:numerocompleto)";
            $listaSociedad = Conexion::conectar()->prepare($sqlListarCliente);
            $listaSociedad->bindParam(":campo", $nombre);
            $listaSociedad->bindParam(":numerocompleto", $campo);
            $listaSociedad->execute();
            return $listaSociedad->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public static function buscarInvoiceNumberFacturaRapida($campo){  
        try {
            $nombre ="%$campo%"; 
            $sqlListarCliente = "SELECT factura_rapida_id FROM factura_rapida WHERE (datos->>'invoice_number' LIKE :campo) OR (datos->>'invoice_number'=:numerocompleto)";
            $listaSociedad = Conexion::conectar()->prepare($sqlListarCliente);
            $listaSociedad->bindParam(":campo", $nombre);
            $listaSociedad->bindParam(":numerocompleto", $campo);
            $listaSociedad->execute();
            return $listaSociedad->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}
?>