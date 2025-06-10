<?php
require_once('conexion.php');

class modelSociedad{



    static public function mdlInsertarSociedad($datos) {
        try {
            $sqlInsertarSociedad = "INSERT INTO sociedad(
                nombre, apellido, estado_civil, pais_origen, 
                pais_residencia_fiscal, pais_domicilio, numero_pasaporte, 
                pais_pasaporte, tipo_visa, direccion_local, telefonos, emails, 
                industria, nombre_negocio_local, ubicacion_negocio_principal, 
                tamano_negocio, contacto_ejecutivo_local, numero_empleados, 
                numero_hijos, razon_consultoria, requiere_registro_corporacion, 
                observaciones,  fk_solicitud, createdat,ciudad,fecha_nacimiento)
                VALUES (:nombre, :apellido, :estado_civil, 
                :pais_origen, :pais_residencia_fiscal, :pais_domicilio, 
                :numero_pasaporte, :pais_pasaporte, :tipo_visa, :direccion_local, 
                :telefonos, :emails, :industria, :nombre_negocio_local, 
                :ubicacion_negocio_principal, :tamano_negocio, 
                :contacto_ejecutivo_local, :numero_empleados, :numero_hijos, 
                :razon_consultoria, :requiere_registro_corporacion, 
                :observaciones,:fk_solicitud, now(),:ciudad, :fecha_nacimiento)";

            $stmt = Conexion::conectar()->prepare($sqlInsertarSociedad);
            $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":apellido", $datos["apellido"], PDO::PARAM_STR);
            // $stmt->bindParam(":fecha_nacimiento", $datos["fecha_nacimiento"]);
            $stmt->bindParam(":estado_civil", $datos["estado_civil"], PDO::PARAM_STR);
            $stmt->bindParam(":pais_origen", $datos["pais_origen"], PDO::PARAM_STR);
            $stmt->bindParam(":pais_residencia_fiscal", $datos["pais_residencia_fiscal"], PDO::PARAM_STR);
            $stmt->bindParam(":pais_domicilio", $datos["pais_domicilio"], PDO::PARAM_STR);
            $stmt->bindParam(":numero_pasaporte", $datos["numero_pasaporte"], PDO::PARAM_STR);
            $stmt->bindParam(":pais_pasaporte", $datos["pais_pasaporte"], PDO::PARAM_STR);
            $stmt->bindParam(":tipo_visa", $datos["tipo_visa"], PDO::PARAM_STR);
            $stmt->bindParam(":direccion_local", $datos["direccion_local"], PDO::PARAM_STR);
            $stmt->bindParam(":telefonos", $datos["telefonos"], PDO::PARAM_STR);
            $stmt->bindParam(":emails", $datos["emails"], PDO::PARAM_STR);
            $stmt->bindParam(":industria", $datos["industria"], PDO::PARAM_STR);
            $stmt->bindParam(":nombre_negocio_local", $datos["nombre_negocio_local"], PDO::PARAM_STR);
            $stmt->bindParam(":ubicacion_negocio_principal", $datos["ubicacion_negocio_principal"], PDO::PARAM_STR);
            $stmt->bindParam(":tamano_negocio", $datos["tamano_negocio"], PDO::PARAM_STR);
            $stmt->bindParam(":contacto_ejecutivo_local", $datos["contacto_ejecutivo_local"], PDO::PARAM_STR);
            $stmt->bindParam(":numero_empleados", $datos["numero_empleados"], PDO::PARAM_INT);
            $stmt->bindParam(":numero_hijos", $datos["numero_hijos"], PDO::PARAM_INT);
            $stmt->bindParam(":razon_consultoria", $datos["razon_consultoria"], PDO::PARAM_STR);
            $stmt->bindParam(":requiere_registro_corporacion", $datos["requiere_registro_corporacion"], PDO::PARAM_BOOL);
            $stmt->bindParam(":observaciones", $datos["observaciones"], PDO::PARAM_STR);
            $stmt->bindParam(":fk_solicitud", $datos["id_solicitud"], PDO::PARAM_STR);
            $stmt->bindParam(":ciudad", $datos["ciudad"], PDO::PARAM_STR);
            $stmt->bindParam(":fecha_nacimiento", $datos["fecha_nacimiento"]);
            if ($stmt->execute()) {
                return "ok";
            } else {
                $error = $stmt->errorInfo();
                return "error: " . $error[2];
            }

        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public static function mdlActualizarCliente($datos){
        try {
            $tipo = $datos['tipo'];

            $sql = "UPDATE  $tipo SET nombre=:nombre, apellido=:apellido, estado_civil=:estado_civil,
            pais_origen=:pais_origen, pais_residencia_fiscal=:pais_residencia_fiscal, pais_domicilio=:pais_domicilio,
            numero_pasaporte=:numero_pasaporte, pais_pasaporte=:pais_pasaporte, tipo_visa=:tipo_visa,
            direccion_local=:direccion_local, telefonos=:telefonos, emails=:emails, industria=:industria,
            nombre_negocio_local=:nombre_negocio_local, ubicacion_negocio_principal=:ubicacion_negocio_principal,
            tamano_negocio=:tamano_negocio, contacto_ejecutivo_local=:contacto_ejecutivo_local,
            numero_empleados=:numero_empleados, numero_hijos=:numero_hijos, razon_consultoria=:razon_consultoria,
            requiere_registro_corporacion=:requiere_registro_corporacion, observaciones=:observaciones, ciudad=:ciudad, fecha_nacimiento=:fecha_nacimiento
            WHERE uuid=:id";
            $stmt = Conexion::conectar()->prepare($sql);
            $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":apellido", $datos["apellido"], PDO::PARAM_STR);
            $stmt->bindParam(":estado_civil", $datos["estado_civil"], PDO::PARAM_STR);
            $stmt->bindParam(":pais_origen", $datos["pais_origen"], PDO::PARAM_STR);
            $stmt->bindParam(":pais_residencia_fiscal", $datos["pais_residencia_fiscal"], PDO::PARAM_STR);
            $stmt->bindParam(":pais_domicilio", $datos["pais_domicilio"], PDO::PARAM_STR);
            $stmt->bindParam(":numero_pasaporte", $datos["numero_pasaporte"], PDO::PARAM_STR);
            $stmt->bindParam(":pais_pasaporte", $datos["pais_pasaporte"], PDO::PARAM_STR);
            $stmt->bindParam(":tipo_visa", $datos["tipo_visa"], PDO::PARAM_STR);
            $stmt->bindParam(":direccion_local", $datos["direccion_local"], PDO::PARAM_STR);
            $stmt->bindParam(":telefonos", $datos["telefonos"], PDO::PARAM_STR);
            $stmt->bindParam(":emails", $datos["emails"], PDO::PARAM_STR);
            $stmt->bindParam(":industria", $datos["industria"], PDO::PARAM_STR);
            $stmt->bindParam(":nombre_negocio_local", $datos["nombre_negocio_local"], PDO::PARAM_STR);
            $stmt->bindParam(":ubicacion_negocio_principal", $datos["ubicacion_negocio_principal"], PDO::PARAM_STR);
            $stmt->bindParam(":tamano_negocio", $datos["tamano_negocio"], PDO::PARAM_STR);
            $stmt->bindParam(":contacto_ejecutivo_local", $datos["contacto_ejecutivo_local"], PDO::PARAM_STR);
            $stmt->bindParam(":numero_empleados", $datos["numero_empleados"], PDO::PARAM_INT);
            $stmt->bindParam(":numero_hijos", $datos["numero_hijos"], PDO::PARAM_INT);
            $stmt->bindParam(":razon_consultoria", $datos["razon_consultoria"], PDO::PARAM_STR);
            $stmt->bindParam(":requiere_registro_corporacion", $datos["requiere_registro_corporacion"], PDO::PARAM_BOOL);
            $stmt->bindParam(":observaciones", $datos["observaciones"], PDO::PARAM_STR);
            // $stmt->bindParam(":fk_solicitud", $datos["id_solicitud"], PDO::PARAM_STR);
            $stmt->bindParam(":ciudad", $datos["ciudad"], PDO::PARAM_STR);
            $stmt->bindParam(":fecha_nacimiento", $datos["fecha_nacimiento"]);
            $stmt->bindParam(":id", $datos["id_cliente"]);
            if ($stmt->execute()) {
                return "ok";
            } else {
                $error = $stmt->errorInfo();
                return "error: " . $error[2];
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }


    static public function  mdlGetsociedad(){
        try {
            // $sqlListarSociedades = "SELECT * FROM sociedad";
            $sqlListarSociedades = "SELECT id_sociedad, s.uuid, CONCAT(nombre, ' ',apellido) AS nombre, createdat FROM sociedad AS s
            UNION
            SELECT id_persona_cliente, c.uuid, CONCAT(nombre, ' ',apellido) AS nombre, createdat FROM personas_cliente AS c WHERE es_socio=true";
            $listaSociedades = Conexion::conectar()->prepare($sqlListarSociedades);
            $listaSociedades->execute();
            return $listaSociedades->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    static public function  mdlGetAllClientes(){
        try {
            $sqlListarSociedades = "SELECT uuid,id_sociedad, nombre, apellido, fecha_nacimiento, estado_civil, pais_origen,
            pais_residencia_fiscal, pais_domicilio, numero_pasaporte, pais_pasaporte, 
            tipo_visa, direccion_local, telefonos, emails, industria,
            nombre_negocio_local, ubicacion_negocio_principal, 
            tamano_negocio, contacto_ejecutivo_local, numero_empleados, 
            numero_hijos, razon_consultoria, requiere_registro_corporacion,observaciones,fk_solicitud, createdat, ciudad,'cliente' as tipo
	        FROM sociedad AS s
            UNION
            SELECT uuid,id_persona_cliente, nombre, apellido, fecha_nacimiento, estado_civil, pais_origen,
            pais_residencia_fiscal, pais_domicilio, numero_pasaporte, pais_pasaporte, 
            tipo_visa, direccion_local, telefonos, emails, industria,
            nombre_negocio_local, ubicacion_negocio_principal, 
            tamano_negocio, contacto_ejecutivo_local, numero_empleados, 
            numero_hijos, razon_consultoria, requiere_registro_corporacion,observaciones,fk_solicitud, createdat, ciudad, 'sociocliente' as tipo
	        FROM personas_cliente AS s";
            $listaSociedades = Conexion::conectar()->prepare($sqlListarSociedades);
            $listaSociedades->execute();
            return $listaSociedades->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    static public function mdlConsultarSocios(){
        try {
            $sqlListarSocios= "SELECT 
            id_persona_cliente, 
            CONCAT(p.nombre, ' ',p.apellido) AS nombre, 
            p.createdat, 
            CONCAT(sc.nombre, ' ',sc.apellido) AS nombrecliente,
            es_socio AS essocio
	        FROM personas_cliente AS p
            INNER JOIN solicitud AS s ON (p.numero_solicitud=s.id_solicitud)
	        INNER JOIN sociedad AS sc ON (s.fk_persona=sc.id_sociedad)";
            $listaSocios = Conexion::conectar()->prepare($sqlListarSocios);
            $listaSocios->execute();
            return $listaSocios->fetchAll(PDO::FETCH_ASSOC); 
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    static public function mdlActualizarTipoSocio($id, $tipo) {
        try {
            $sqlActualizarTipoSocio = "UPDATE personas_cliente SET es_socio=:tipo WHERE id_persona_cliente=:id";
            $stmt = Conexion::conectar()->prepare($sqlActualizarTipoSocio);
            $stmt->bindParam(":tipo", $tipo, PDO::PARAM_BOOL);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            
            if ($stmt->execute()) {
                return "ok";
            } else {
                return "error: " . $stmt->errorInfo()[2];
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    static public function mdlGetPersonaSociedadySociedad($idSolicitud){
        try {
            // $sqlListarSociedades = "SELECT DISTINCT(NULL) as uuid,id_sociedad,0 as idcliente,nombre||' ' ||apellido AS nombre,'miembro' as tipo FROM sociedad AS s
            //                         UNION
            //                         SELECT DISTINCT(uuid),0,0 as idcliente,nombre_sociedad,'sociedad' as tipo from personas_sociedad
            //                         UNION
            //                         SELECT DISTINCT(NULL) as uuid,0,id_persona_cliente  as idcliente, nombre||' ' ||apellido AS nombre,'cliente' as tipo FROM personas_cliente
            //                         WHERE numero_solicitud=:id_solicitud";

            $sqlListarSociedades = "SELECT DISTINCT(NULL) as uuid,id_sociedad,0 as idcliente,0  as idextranjero,nombre||' ' ||apellido AS nombre,'miembro' as tipo FROM sociedad AS s
                UNION
                SELECT DISTINCT(uuid),0,0 as idcliente,0,nombre_sociedad,'sociedad' as tipo from personas_sociedad
                UNION
                SELECT DISTINCT(NULL) as uuid,0,0,id_sociedad_extranjera,datos_sociedad->>'nombreSociedad','socio_extranjero' FROM sociedad_extranjera
                UNION 
                SELECT DISTINCT(NULL) as uuid,0,id_persona_cliente  as idcliente, 0,nombre||' ' ||apellido AS nombre,'cliente' as tipo FROM personas_cliente
                WHERE numero_solicitud=:id_solicitud";

            $listaSociedades = Conexion::conectar()->prepare($sqlListarSociedades);
            $listaSociedades->bindParam(":id_solicitud", $idSolicitud, PDO::PARAM_INT);
            $listaSociedades->execute();
            return $listaSociedades->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


    static public function mdlObtenerConsultoria() {
        try {
            $sqlObtenerConsultoria = "SELECT  servicios, servicios_adicionales
	        FROM public.solicitud  where id_solicitud='189';";
            $stmt = Conexion::conectar()->prepare($sqlObtenerConsultoria);
            $stmt->execute();

                return $stmt->fetch(PDO::FETCH_ASSOC); // Devolver el resultado como un array asociativo
            } 
        catch (Exception $e) {
                return false;
        }
    }

    static public function mdlObtenerDocumentosSociedad($solicitud, $sociedad){
        try {
            $sqlListarDocumentosSociedad = "SELECT 
            id_archivo_adjunto,nombre_archivo,a.create_at,id_solicitud,a.numero_registro,a.fecha_entrega,doc.nombre_documento_adjunto as tipo
            FROM archivo_adjunto AS a
            INNER JOIN documentos_adjuntos AS doc ON (a.descripcion::int=doc.id_tipo_documento_adjunto)
            WHERE id_solicitud=:solicitud AND sociedad_uuid=:sociedad";
            $listaDocumentosSociedad = Conexion::conectar()->prepare($sqlListarDocumentosSociedad);
            $listaDocumentosSociedad->bindParam(":solicitud", $solicitud, PDO::PARAM_INT);
            $listaDocumentosSociedad->bindParam(":sociedad", $sociedad, PDO::PARAM_STR);
            
            $listaDocumentosSociedad->execute();
            return $listaDocumentosSociedad->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    static public function mdlObtenerTiposSociedad(){
        try {
            $sqlListarTiposSociedad = "SELECT id_tipo_sociedad, nombre_tipo_sociedad FROM tipo_sociedad";
            $listaTiposSociedad = Conexion::conectar()->prepare($sqlListarTiposSociedad);
            $listaTiposSociedad->execute();
            return $listaTiposSociedad->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    static public function mdlObtenerCliente($campo){
        try {
            $nombre ="%$campo%"; 
            $sqlListarCliente = "SELECT id_sociedad FROM sociedad WHERE (nombre LIKE :campo) OR (numero_pasaporte=:pasaporte)";
            $listaCliente = Conexion::conectar()->prepare($sqlListarCliente);
            $listaCliente->bindParam(":campo", $nombre);
            $listaCliente->bindParam(":pasaporte", $campo);
            $listaCliente->execute();
            return $listaCliente->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    static public function mdlObtenerNombreSociedad($campo){
        try {
            $nombre ="%$campo%"; 
            $sqlListarCliente = "SELECT id_personas_sociedad FROM personas_sociedad WHERE (datos_sociedad->>'nombreSociedad' LIKE :campo) OR (datos_sociedad->>'nombreSociedad'=:nombrecompleto)";
            $listaSociedad = Conexion::conectar()->prepare($sqlListarCliente);
            $listaSociedad->bindParam(":campo", $nombre);
            $listaSociedad->bindParam(":nombrecompleto", $campo);
            $listaSociedad->execute();
            return $listaSociedad->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    static public function mdlInsertarSociedadExtranjera($datos) {
        try {
            
            $sqlInsertarSociedad = "INSERT INTO sociedad_extranjera(datos_sociedad,usuario) VALUES (:datosSociedad, :usuario)";

            $stmt = Conexion::conectar()->prepare($sqlInsertarSociedad);
            $stmt->bindParam(":datosSociedad", $datos["datos"], PDO::PARAM_STR);
            $stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
            
            if ($stmt->execute()){
                return "ok";
            }else{ 
                $error = $stmt->errorInfo();
                return "error: " . $error[2];
            }

        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

}


?>