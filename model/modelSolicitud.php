<?php
require_once('conexion.php');

class ModelSolicitud
{
    public static function obtenerSolicitud($id_solicitud) {
        try {
            $sqlListarSolicitud = "SELECT * FROM solicitud WHERE id_solicitud = :id_solicitud";
            $listaSolicutd = Conexion::conectar()->prepare($sqlListarSolicitud);
            $listaSolicutd->bindParam(':id_solicitud', $id_solicitud, PDO::PARAM_INT);
            $listaSolicutd->execute();
            return $listaSolicutd->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public static function obtenerNombresServicios() {
        try {
            $sql = "SELECT servicio_name FROM servicios";
            $stmt = Conexion::conectar()->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_COLUMN, 0); // Retorna solo la columna con los nombres
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
   
    public static function obtenerAllSolicitud() {
        try {
            $sqlListarSolicitud = "
            SELECT a.id_solicitud, a.nombre_cliente,a.referido_por, a.created_at FROM solicitud as a
            left join archivo_adjunto as ar ON(a.id_solicitud = ar.id_solicitud)
			where ar.id_solicitud is null 
            ";
            $listaSolicutd = Conexion::conectar()->prepare($sqlListarSolicitud);           
            $listaSolicutd->execute();
            return $listaSolicutd->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public static function obtenerServicios($id_solicitud) {
        try {
            $solicitud_id = $id_solicitud;
            $sqlListarSolicitud = "
                   SELECT a.id_servicios_adicionales, a.servicios, a.servicios_adicionales
                    FROM servicios_adicionales a
                    where a.fk_solicitud =:id_solicitud
            ";
            $listaSolicitud = Conexion::conectar()->prepare($sqlListarSolicitud);   
            $listaSolicitud->bindParam(':id_solicitud', $solicitud_id, PDO::PARAM_INT);        
            $listaSolicitud->execute();
            return $listaSolicitud->fetchAll(PDO::FETCH_ASSOC);
          
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    

    public static function obtenerServiciosFactura($id_solicitud) {
        try {
            $solicitud_id = $id_solicitud;
            $sqlListarSolicitud = "
             SELECT a.id_servicios_adicionales, a.servicios, a.servicios_adicionales
                    FROM servicios_adicionales a
                    where a.fk_solicitud =:id_solicitud
            ";
            $listaSolicitud = Conexion::conectar()->prepare($sqlListarSolicitud);   
            $listaSolicitud->bindParam(':id_solicitud', $solicitud_id, PDO::PARAM_INT);        
            $listaSolicitud->execute();
            $resultados = $listaSolicitud->fetchAll(PDO::FETCH_ASSOC);
          
            return $resultados;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public static function contarSociedades() {
        try {
            $sqlListarSolicitud = "SELECT COUNT(*) as total FROM servicios";
            $listaSolicitud = Conexion::conectar()->prepare($sqlListarSolicitud);
            $listaSolicitud->execute();
            $resultado = $listaSolicitud->fetch(PDO::FETCH_ASSOC); // Cambiar fetchAll() por fetch()
    
            return $resultado; // Retorna directamente el array con el total
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public static function obtenerServiciosFacturados($id_solicitud) {
        try {
            $solicitud_id = $id_solicitud;
            $sqlListarSolicitud = "
            SELECT servicios, servicios_adicionales FROM solicitud where id_solicitud = :id_solicitud 
            ";
            $listaSolicitud = Conexion::conectar()->prepare($sqlListarSolicitud);   
            $listaSolicitud->bindParam(':id_solicitud', $solicitud_id, PDO::PARAM_INT);        
            $listaSolicitud->execute();
            $resultados = $listaSolicitud->fetchAll(PDO::FETCH_ASSOC);
          
            foreach ($resultados as &$resultado) {
                if (isset($resultado['datos'])) {
                    // Decodificar el JSON en 'datos'
                    $resultado['datos'] = json_decode($resultado['datos'], true);
                }
            }
            return json_encode($resultados); // Retornar el resultado completo
        } catch (Exception $e) {
            return json_encode(["error" => $e->getMessage()]); // Retornar el error en formato JSON
        }
    }

    public static function obtenerSociedad($id_solicitud){
        try {
            $solicitud_id = $id_solicitud;
            $sqlListarSolicitud = "
            SELECT id_sociedad, nombre, apellido, fecha_nacimiento, estado_civil, pais_origen,
             pais_residencia_fiscal, pais_domicilio, numero_pasaporte, pais_pasaporte, 
             tipo_visa, direccion_local, telefonos, emails, industria,
              nombre_negocio_local, ubicacion_negocio_principal, 
              tamano_negocio, contacto_ejecutivo_local, numero_empleados, 
              numero_hijos, razon_consultoria, requiere_registro_corporacion,  observaciones
              , fk_solicitud, createdat
	        FROM public.sociedad
            where id_sociedad = :id_sociedad;
            ";
            $listaSolicitud = Conexion::conectar()->prepare($sqlListarSolicitud);   
            $listaSolicitud->bindParam(':id_sociedad', $solicitud_id, PDO::PARAM_INT);        
            $listaSolicitud->execute();
            $resultados = $listaSolicitud->fetchAll(PDO::FETCH_ASSOC);
          
            return $resultados;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public static function getServiciosOfrecidos(){
        try {
            $sqlListarSolicitud = "
                select * from servicios order by nombre_servicio
            ";
            $listaSolicutd = Conexion::conectar()->prepare($sqlListarSolicitud);           
            $listaSolicutd->execute();
            return $listaSolicutd->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public static function obtenerAdjuntos($condicion) {
        try {
            $sqlListarSolicitud = "SELECT a.create_at, a.nombre_archivo, a.descripcion, b.nombre_sociedad
                FROM archivo_adjunto a
                LEFT JOIN (
                    SELECT DISTINCT uuid, nombre_sociedad
                    FROM personas_sociedad
                ) b ON a.sociedad_UUID = b.uuid
                WHERE a.id_solicitud = :condicion";
            $listaSolicitud = Conexion::conectar()->prepare($sqlListarSolicitud);
            $listaSolicitud->bindParam(':condicion', $condicion, PDO::PARAM_INT);
            $listaSolicitud->execute();
            return $listaSolicitud->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public static function getBancosConsignacion() {
        try {
            $sqlListarSolicitud = "
            SELECT * FROM bancos_consignaciones;
            ";
            $listaSolicutd = Conexion::conectar()->prepare($sqlListarSolicitud);           
            $listaSolicutd->execute();
            return $listaSolicutd->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public static function validarFactura($id_solicitud){
        try {
            $sqlListarSolicitud = "
            select count(id) from factura where id_solicitud = :id_solicitud;
            ";
            $listaSolicutd = Conexion::conectar()->prepare($sqlListarSolicitud);  
            $listaSolicutd->bindParam(':id_solicitud', $id_solicitud, PDO::PARAM_INT);         
            $listaSolicutd->execute();
            return $listaSolicutd->fetchColumn();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public static function validarDocumento($id_solicitud){
        try {
            $sqlListarSolicitud = "
            select  count(id_archivo_adjunto) from archivo_adjunto where id_solicitud = :id_solicitud;
            ";
            $listaSolicutd = Conexion::conectar()->prepare($sqlListarSolicitud);  
            $listaSolicutd->bindParam(':id_solicitud', $id_solicitud, PDO::PARAM_INT);         
            $listaSolicutd->execute();
            return $listaSolicutd->fetchColumn();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public static function obtenerSolicitudesConAdjuntos() {
        try {
            $sqlListarSolicitud ="SELECT b.referido_por, STRING_AGG(DISTINCT a.nombre_sociedad, ', ') AS nombre_sociedades,
                b.created_at, b.id_solicitud
                FROM personas_sociedad a
                INNER JOIN solicitud b ON a.fk_solicitud = b.id_solicitud
                GROUP BY b.referido_por,b.created_at,b.id_solicitud";
            $listaSolicutd = Conexion::conectar()->prepare($sqlListarSolicitud);           
            $listaSolicutd->execute();
            return $listaSolicutd->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public static function validacionDocumentoAdjuntoSolicitud($id_solicitud) {
        try {
            $sqlListarSolicitud ="
            SELECT count(a.id_solicitud) FROM solicitud as a
            inner join archivo_adjunto as ar ON(a.id_solicitud = ar.id_solicitud)
            where a.id_solicitud = $id_solicitud
           ";
            $listaSolicutd = Conexion::conectar()->prepare($sqlListarSolicitud);           
            $listaSolicutd->execute();
            return $listaSolicutd->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    //modelo para insertar en BD el nombre del archivo, fecha, descripcion
    public static function insertarSolicitud($datos, $checkbox, $camposDinamicos, $usuario_creacion) {
        try {
            $camposDinamicosJSON = json_encode($camposDinamicos);
            $checkboxJSON = json_encode($checkbox);
    
            // Primera inserción: Insertar en la tabla 'solicitud' y retornar el ID
            $sql = "INSERT INTO solicitud (nombre_cliente, referido_por, necesidad, created_at, servicios, 
                    servicios_adicionales, fk_persona) 
                    VALUES (:nombre_cliente, :referido_por, :necesidad, NOW(), :servicios, :servicios_adicionales, :fk_persona) 
                    RETURNING id_solicitud"; // Asegúrate de retornar el id_solicitud generado
            $stmt1 = Conexion::conectar()->prepare($sql);
            $stmt1->bindParam(':nombre_cliente', $datos['nombre_cliente'], PDO::PARAM_STR);
            $stmt1->bindParam(':referido_por', $datos['referido_por'], PDO::PARAM_STR);
            $stmt1->bindParam(':necesidad', $datos['necesidad'], PDO::PARAM_STR);
            $stmt1->bindParam(':servicios', $checkboxJSON, PDO::PARAM_STR);
            $stmt1->bindParam(':servicios_adicionales', $camposDinamicosJSON, PDO::PARAM_STR);
            $stmt1->bindParam(':fk_persona', $datos['fk_Persona'], PDO::PARAM_INT);
    
            // Ejecutar la primera inserción
            if ($stmt1->execute()) {
                // Obtener el id de la solicitud insertada
                $idSolicitud = $stmt1->fetch(PDO::FETCH_OBJ)->id_solicitud;
    
                // Segunda inserción: Insertar en la otra tabla relacionada
                $sqlInsertarServicios = "
                    INSERT INTO public.servicios_adicionales(
                        servicios, servicios_adicionales, fecha_creacion, usuario_creacion, fk_solicitud)
                    VALUES(:servicios, :servicios_adicionales, NOW(), :usuario_creacion, :fk_solicitud);
                ";
    
                $stmt2 = Conexion::conectar()->prepare($sqlInsertarServicios);
                $stmt2->bindParam(':servicios', $checkboxJSON, PDO::PARAM_STR);
                $stmt2->bindParam(':servicios_adicionales', $camposDinamicosJSON, PDO::PARAM_STR);
                $stmt2->bindParam(':usuario_creacion', $usuario_creacion, PDO::PARAM_STR);
                $stmt2->bindParam(':fk_solicitud', $idSolicitud, PDO::PARAM_INT);
    
                // Ejecutar la segunda inserción
                if ($stmt2->execute()) {
                    return "ok";  // Si ambos inserts son exitosos
                } else {
                    return "error en la segunda inserción";  // Error en el segundo insert
                }
            } else {
                return "error en la primera inserción";  // Error en el primer insert
            }
        } catch (Exception $e) {
            return $e->getMessage();  // Captura y devuelve cualquier error
        }
    }

    public static function insertarArchivoSolicitud($datos) {
        try {
            $sql = "INSERT INTO public.archivo_adjunto(
                 nombre_archivo, descripcion, id_solicitud, create_at,sociedad_uuid)
                VALUES ( :nombre_archivo, :descripcion, :id_solicitud, NOW(), :sociedad_uuid);";
            $stmt = Conexion::conectar()->prepare($sql);
            $stmt->bindParam(':nombre_archivo', $datos['nombre_archivo'], PDO::PARAM_STR);
            $stmt->bindParam(':descripcion', $datos['descripcion'], PDO::PARAM_STR);
            $stmt->bindParam(':id_solicitud', $datos['id_solicitud'], PDO::PARAM_INT);
            $stmt->bindParam(':sociedad_uuid', $datos['sociedad'], PDO::PARAM_INT);
            
            
           
            if($stmt->execute()) {
                return "ok";
            } else {
                return "error";
            } 
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public static function insertarFactura($datos,$id,$estado_factura) {
        try {
            $id_solicitud = $id;
            $estado = $estado_factura;
            $json_datos = json_encode($datos);
            $sql = "INSERT INTO public.factura(
                 datos, created_at,id_solicitud,estado)
                VALUES ( :datos, NOW(),:id_solicitud,:estado);
            ";
            $stmt = Conexion::conectar()->prepare($sql);
            $stmt->bindParam(':datos', $json_datos);
            $stmt->bindParam(':id_solicitud', $id_solicitud, PDO::PARAM_INT);
            $stmt->bindParam(':estado', $estado, PDO::PARAM_INT);
            
           
            if($stmt->execute()) {
                return "ok";
            } else {
                return "error";
            } 
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public static function insertarServiciosAdicionales($checkbox,$camposDinamicos,$fk_solicitud) {
        try {

            $fk_solicitud_insertar= $fk_solicitud;
            $usuario_creacion = '1';
            $camposDinamicosJSON =json_encode($camposDinamicos);
            $checkboxJSON = json_encode($checkbox);

            $sqlInsertarServicios = "
                INSERT INTO public.servicios_adicionales(
                servicios, servicios_adicionales, fecha_creacion, usuario_creacion, fk_solicitud)
                VALUES(:servicios, :servicios_adicionales, NOW(), 
                :usuario_creacion, :fk_solicitud);
            ";
    
            $stmt = Conexion::conectar()->prepare($sqlInsertarServicios);
            $stmt->bindParam(':servicios', $checkboxJSON, PDO::PARAM_STR);
            $stmt->bindParam(':servicios_adicionales', $camposDinamicosJSON, PDO::PARAM_STR);
            $stmt->bindParam(':usuario_creacion', $usuario_creacion, PDO::PARAM_STR);
            $stmt->bindParam(':fk_solicitud', $fk_solicitud_insertar, PDO::PARAM_INT);
    
            return $stmt->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public static function insertarDatosAdiconales($datos) {
        try {
            $sql = "
                INSERT INTO public.datos_adicionales (
                    nombre_cliente, sr_numero, date_organization, state_organization, 
                    principal_business, managing_members, bank_account, fiscal_year, 
                    ein, date_annual_meeting, secretary, treasurer, members, initial_manager, 
                    fecha_creacion, fk_solicitud, createat
                ) VALUES (
                    :nombre_cliente, :sr_numero, :date_organization, :state_organization, 
                    :principal_business, :managing_members, :bank_account, :fiscal_year, 
                    :ein, :date_annual_meeting, :secretary, :treasurer, :members, :initial_manager,
                    NOW(), :fk_solicitud, NOW()
                );
            ";
    
            // Preparar la sentencia SQL
            $stmt = Conexion::conectar()->prepare($sql);
    
            // Vincular los parámetros a la sentencia preparada
            $stmt->bindParam(':nombre_cliente', $datos['nombre_cliente'], PDO::PARAM_STR);
            $stmt->bindParam(':sr_numero', $datos['sr_numero'], PDO::PARAM_STR);
            $stmt->bindParam(':date_organization', $datos['date_organization'], PDO::PARAM_STR);
            $stmt->bindParam(':state_organization', $datos['state_organization'], PDO::PARAM_STR);
            $stmt->bindParam(':principal_business', $datos['principal_business'], PDO::PARAM_STR);
            $stmt->bindParam(':managing_members', $datos['managing_members'], PDO::PARAM_STR);
            $stmt->bindParam(':bank_account', $datos['bank_account'], PDO::PARAM_STR);
            $stmt->bindParam(':fiscal_year', $datos['fiscal_year'], PDO::PARAM_STR);
            $stmt->bindParam(':ein', $datos['ein'], PDO::PARAM_STR);
            $stmt->bindParam(':date_annual_meeting', $datos['date_annual_meeting'], PDO::PARAM_STR);
            $stmt->bindParam(':secretary', $datos['secretary'], PDO::PARAM_STR);
            $stmt->bindParam(':treasurer', $datos['treasurer'], PDO::PARAM_STR);
            $stmt->bindParam(':members', $datos['members'], PDO::PARAM_STR);
            $stmt->bindParam(':initial_manager', $datos['initial_manager'], PDO::PARAM_STR);
            $stmt->bindParam(':fk_solicitud', $datos['fk_solicitud'], PDO::PARAM_INT);
    
            // Ejecutar la consulta
            return $stmt->execute() ? "ok" : "error";
        } catch (Exception $e) {
            // Manejo de errores
            die($e->getMessage());
        }
    }

    public static function insertarSociedad($datos) {
        try {

            // $datos['conjuntosociedad'] = str_replace(["{", "}"], ["{\"", "\"}"], $datos['conjuntosociedad']);
            // $datos['conjuntosociedad'] = '{' .$datos['conjuntosociedad']. '}';


            $sql = "INSERT INTO public.personas_sociedad (
                    nombre_sociedad, fk_persona, porcentaje, fk_solicitud, create_at, create_user, uuid, conjunto_sociedades
                )VALUES (
                    :nombre_sociedad, :fk_persona, :porcentaje, :fk_solicitud, NOW(), :create_user,:uuid, :conjuntoSociedades
                );
            ";

            // Preparar la sentencia SQL
            $stmt = Conexion::conectar()->prepare($sql);

            // Vincular los parámetros a la sentencia preparada
            $stmt->bindParam(':nombre_sociedad', $datos['nombre_sociedad'], PDO::PARAM_STR);
            // $stmt->bindParam(':fk_persona', $datos['fk_persona'], PDO::PARAM_INT);
            $stmt->bindParam(':fk_persona', $datos['conjuntopersonas'], PDO::PARAM_INT);
            $stmt->bindParam(':porcentaje', $datos['porcentaje'], PDO::PARAM_INT);
            $stmt->bindParam(':fk_solicitud', $datos['fk_solicitud'], PDO::PARAM_INT);
            $stmt->bindParam(':create_user', $datos['create_user'], PDO::PARAM_STR);
            $stmt->bindParam(':uuid', $datos['uuid'], PDO::PARAM_STR);
            $stmt->bindParam(':conjuntoSociedades', $datos['conjuntosociedad'], PDO::PARAM_STR);

            // Ejecutar la consulta
            return $stmt->execute() ? "ok" : "error";
        } catch (Exception $e) {
            die($e->getMessage());
        }
    
    }


    public static function actualizarEstadoServicio($id_servicios_adicionales, $clave_servicio, $nuevo_estado) {
        try {
            // Consulta para actualizar el estado del servicio específico en el JSONB
            $sql = "UPDATE servicios_adicionales 
                    SET servicios = jsonb_set(servicios, :ruta, :nuevo_estado::jsonb, false)
                    WHERE id_servicios_adicionales = :id_servicios_adicionales";
    
            $stmt = Conexion::conectar()->prepare($sql);
            
            // Generar la ruta dentro del JSON
            $ruta = '{"' . $clave_servicio . '", "estado"}'; // Ruta a la clave del estado dentro del JSON
            
            // Convertir el nuevo estado a JSON
            $nuevo_estado_json = json_encode($nuevo_estado);  // Asegúrate de que es un número, no un string
            
            $stmt->bindParam(':id_servicios_adicionales', $id_servicios_adicionales, PDO::PARAM_INT);
            $stmt->bindParam(':ruta', $ruta, PDO::PARAM_STR);
            $stmt->bindParam(':nuevo_estado', $nuevo_estado_json, PDO::PARAM_STR);
            
            // Ejecutar la consulta
            if ($stmt->execute()) {
                return "ok"; // Éxito
            } else {
                return "error"; // Error
            }
        } catch (Exception $e) {
            return "error"; // En caso de una excepción
        }
    }

    public static function actualizarEstadoServiciofactura($id_servicios_adicionales, $clave_servicio, $nuevo_estado) {
        try {
            // Consulta para actualizar el estado del servicio específico en el JSONB
            $sql = "UPDATE servicios_adicionales 
                    SET servicios = jsonb_set(servicios, :ruta, :nuevo_estado::jsonb, false)
                    WHERE id_servicios_adicionales = :id_servicios_adicionales";
    
            $stmt = Conexion::conectar()->prepare($sql);
            
            // Generar la ruta dentro del JSON
            $ruta = '{"' . $clave_servicio . '", "estado"}'; // Ruta a la clave del estado dentro del JSON
            
            // Convertir el nuevo estado a JSON
            $nuevo_estado_json = json_encode($nuevo_estado);  // Asegúrate de que es un número, no un string
            
            $stmt->bindParam(':id_servicios_adicionales', $id_servicios_adicionales, PDO::PARAM_INT);
            $stmt->bindParam(':ruta', $ruta, PDO::PARAM_STR);
            $stmt->bindParam(':nuevo_estado', $nuevo_estado_json, PDO::PARAM_STR);
            
            // Ejecutar la consulta
            if ($stmt->execute()) {
                return "ok"; // Éxito
            } else {
                return "error"; // Error
            }
        } catch (Exception $e) {
            return "error"; // En caso de una excepción
        }
    }
     
    
    public static function getFacturasBySolicitud($idSolicitud) {
        try {
            $sql = "SELECT datos, created_at, ruta_pago, tipo_consignacion, nota_pago 
                    FROM public.factura 
                    WHERE id_solicitud = :id_solicitud"; // Filtrar por id_solicitud

            $stmt = Conexion::conectar()->prepare($sql);
            $stmt->bindParam(':id_solicitud', $idSolicitud, PDO::PARAM_INT); // Pasar el id_solicitud
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ); // Devolver los resultados como objetos
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public static function obtenerSociedades($id_solicitud){
        try {
            $solicitud_id = $id_solicitud;
            $sqlListarSolicitud = "SELECT
                a.nombre_sociedad,
                CONCAT(b.nombre, ' ', b.apellido) AS nombre_completo,
                a.porcentaje,
                a.uuid,
                a.conjunto_sociedades
                from personas_sociedad a
                inner join sociedad b ON(a.fk_persona = b.id_sociedad)
                where a.fk_solicitud = :id_solicitud
                group  by 1,2,3,4,5";
            $listaSolicitud = Conexion::conectar()->prepare($sqlListarSolicitud);   
            $listaSolicitud->bindParam(':id_solicitud', $solicitud_id, PDO::PARAM_INT);        
            $listaSolicitud->execute();
            $resultados = $listaSolicitud->fetchAll(PDO::FETCH_ASSOC);
            
            return $resultados;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public static function obtenerSociedadesSociedades($id_solicitud){
        try {
            $solicitud_id = $id_solicitud;
            $sqlListarSolicitud = "SELECT
                distinct(a.conjunto_sociedades)
                from personas_sociedad a
                where a.fk_solicitud = :id_solicitud and a.conjunto_sociedades is not null";
            $listaSolicitud = Conexion::conectar()->prepare($sqlListarSolicitud);   
            $listaSolicitud->bindParam(':id_solicitud', $solicitud_id, PDO::PARAM_INT);        
            $listaSolicitud->execute();
            $resultados = $listaSolicitud->fetchAll(PDO::FETCH_ASSOC);
            
            return $resultados;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


    public static function buscarSociedadxSociedad($sociedad){
        try {
            $sqlBuscarSociedad = "SELECT
                distinct (nombre_sociedad) FROM personas_sociedad
                where uuid = :identi";
            $listaSolicitud = Conexion::conectar()->prepare($sqlBuscarSociedad);   
            $listaSolicitud->bindParam(':identi', $sociedad);        
            $listaSolicitud->execute();
            $resultados = $listaSolicitud->fetch(PDO::FETCH_ASSOC);
            
            return $resultados;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function fetchDescripciones($idSolicitud) {
        try {
                    $sql = "SELECT DISTINCT(uuid), nombre_sociedad 
                    FROM personas_sociedad
                    WHERE fk_solicitud = :id_solicitud";
            $stmt = Conexion::conectar()->prepare($sql);
            $stmt->bindParam(':id_solicitud', $idSolicitud, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public static function insertarEgreso($datos) {
        try {
          
            $sql="INSERT INTO public.egresos_sociedad
                (fk_tercero, valor, create_at, consecutivo_egreso, fk_sociedad, anticipo, factura)
                VALUES (:nombre_tercero, :valor, NOW(), :identificacion_egreso, :fk_sociedad, :anticipo, :factura);";
                
            $stmt = Conexion::conectar()->prepare($sql);
            $stmt->bindParam(':nombre_tercero', $datos['fk_tercero'], PDO::PARAM_INT);
            $stmt->bindParam(':valor', $datos['valor'], PDO::PARAM_STR);
            $stmt->bindParam(':identificacion_egreso', $datos['identificacion_egreso'], PDO::PARAM_STR);
            $stmt->bindParam(':fk_sociedad', $datos['fk_sociedad'], PDO::PARAM_STR);
            $stmt->bindParam(':anticipo', $datos['anticipo'], PDO::PARAM_STR);
            $stmt->bindParam(':factura', $datos['factura'], PDO::PARAM_STR );
            if ($stmt->execute()) {
                return "ok";
            } else {
                return "error";
            }
        } catch (Exception $e) {
            throw new Exception("Error al insertar el egreso: " . $e->getMessage());
        }
    }

    public static function obtenerSolicitudEgresos($id_solicitud) {
        try {
            $sqlListarSolicitud = "Select a.valor, a.consecutivo_egreso, b.nombre_tercero, a.create_at::date, a.anticipo, a.factura
			from egresos_sociedad as a
			inner join terceros b ON(a.fk_tercero = b.id_terceros)
            WHERE a.fk_sociedad =:id_solicitud";
            $listaSolicutd = Conexion::conectar()->prepare($sqlListarSolicitud);
            $listaSolicutd->bindParam(':id_solicitud', $id_solicitud, PDO::PARAM_INT);
            $listaSolicutd->execute();
            return $listaSolicutd->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    static public function mdlInsertarPersonaCliente($datos){

        try {
            $sqlInsertarSociedad = "INSERT INTO personas_cliente(
                nombre, apellido, fecha_nacimiento, estado_civil, pais_origen, 
                pais_residencia_fiscal, pais_domicilio, numero_pasaporte, 
                pais_pasaporte, tipo_visa, direccion_local, telefonos, emails, 
                industria, nombre_negocio_local, ubicacion_negocio_principal, 
                tamano_negocio, contacto_ejecutivo_local, numero_empleados, 
                numero_hijos, razon_consultoria, requiere_registro_corporacion, 
                observaciones,  fk_solicitud, ciudad, numero_solicitud)
                VALUES (:nombre, :apellido, :fecha_nacimiento, :estado_civil, 
                :pais_origen, :pais_residencia_fiscal, :pais_domicilio, 
                :numero_pasaporte, :pais_pasaporte, :tipo_visa, :direccion_local, 
                :telefonos, :emails, :industria, :nombre_negocio_local, 
                :ubicacion_negocio_principal, :tamano_negocio, 
                :contacto_ejecutivo_local, :numero_empleados, :numero_hijos, 
                :razon_consultoria, :requiere_registro_corporacion, 
                :observaciones,:fk_solicitud, :ciudad, :numeroSolicitud)";

            $stmt = Conexion::conectar()->prepare($sqlInsertarSociedad);
            $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":apellido", $datos["apellido"], PDO::PARAM_STR);
            $stmt->bindParam(":fecha_nacimiento", $datos["fecha_nacimiento"]);
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
            $stmt->bindParam(":numeroSolicitud", $datos["numero_solicitud"], PDO::PARAM_INT);
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


}
?>