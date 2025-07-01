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

    public static function obtenerServicioxSolicitud($fksolicitud) {
        try {
            $sql  = "SELECT servicios FROM servicios_adicionales WHERE fk_solicitud=:fksolicitud";
            $stmt = Conexion::conectar()->prepare($sql);
            $stmt->bindParam(':fksolicitud', $fksolicitud, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_COLUMN, 0); // Retorna solo la columna con los nombres
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public static function obtenerAllSolicitud() {
        try {
            // $sqlListarSolicitud = "SELECT 
            //         a.id_solicitud, 
            //         a.nombre_cliente, 
            //         a.referido_por, 
            //         a.created_at,
	        //         a.necesidad,
			// 		s.nombre
            //     FROM solicitud AS a
            //     LEFT JOIN archivo_adjunto AS ar 
            //         ON a.id_solicitud = ar.id_solicitud
            //     LEFT JOIN personas_sociedad AS pr 
            //         ON a.id_solicitud = pr.fk_solicitud
			// 	LEFT JOIN sociedad AS s
			// 		ON (s.id_sociedad =a.fk_persona)
            //     WHERE pr.fk_solicitud IS NULL";

            $sqlListarSolicitud = "SELECT a.id_solicitud, a.nombre_cliente, a.referido_por, a.created_at, a.necesidad,
					   (s.nombre || ' ' || s.apellido) AS nombre
				FROM solicitud AS a
				LEFT JOIN archivo_adjunto AS ar ON a.id_solicitud = ar.id_solicitud
				LEFT JOIN personas_sociedad AS pr ON a.id_solicitud = pr.fk_solicitud
				INNER JOIN sociedad AS s ON s.uuid = a.fk_cliente
				WHERE pr.fk_solicitud IS NULL

				UNION

				SELECT a.id_solicitud, a.nombre_cliente, a.referido_por, a.created_at, a.necesidad,
					   (c.apellido || ' ' || c.nombre) AS nombre
				FROM solicitud AS a
				LEFT JOIN archivo_adjunto AS ar ON a.id_solicitud = ar.id_solicitud
				LEFT JOIN personas_sociedad AS pr ON a.id_solicitud = pr.fk_solicitud
				INNER JOIN personas_cliente AS c ON c.uuid = a.fk_cliente
				WHERE pr.fk_solicitud IS NULL;";
            
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
            $sqlListarSolicitud = "SELECT a.id_servicios_adicionales, a.servicios, a.servicios_adicionales
                    FROM servicios_adicionales a
                    where a.fk_solicitud =:id_solicitud";
            $listaSolicitud = Conexion::conectar()->prepare($sqlListarSolicitud);   
            $listaSolicitud->bindParam(':id_solicitud', $solicitud_id, PDO::PARAM_INT);        
            $listaSolicitud->execute();
            return $listaSolicitud->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // public static function mdlVerificarServicioEnFactura($id_solicitud) {
    //     try {
    //         $sql = "SELECT 
    //             serv_adicional.info_servicio->>'value' AS descripcion
    //         FROM 
    //             factura AS f
    //         JOIN 
    //             servicios_adicionales AS s ON TRUE
    //         JOIN 
    //             LATERAL jsonb_each(CASE 
    //                 WHEN jsonb_typeof(s.servicios) = 'object' THEN s.servicios 
    //                 ELSE '{}' 
    //             END) AS serv_adicional(servicio, info_servicio) ON TRUE
    //         JOIN 
    //             LATERAL jsonb_each(CASE 
    //                 WHEN jsonb_typeof(f.datos->'servicios') = 'object' THEN f.datos->'servicios' 
    //                 ELSE '{}' 
    //             END) AS serv_factura(servicio, datos_servicio) 
    //             ON serv_factura.servicio = serv_adicional.servicio
    //         WHERE 
    //             f.id_solicitud = :id_solicitud AND
    //             s.fk_solicitud=:id_solicitud and 
    //             serv_factura.datos_servicio->>'check' = 'on'
    //         ";
    //         $sql = Conexion::conectar()->prepare($sql);   
    //         $sql->bindParam(':id_solicitud', $id_solicitud, PDO::PARAM_INT);        
    //         $sql->execute();
    //         return $sql->fetchAll(PDO::FETCH_ASSOC);
    //     } catch (Exception $e) {
    //         die($e->getMessage());
    //     }
    // }

    public static function mdlVerificarServicioEnFactura($id_solicitud) {
        try {
            $sql = "SELECT 
                        servicios_finales.info_servicio->>'value' AS descripcion
                    FROM 
                        factura AS f
                    JOIN 
                        servicios_adicionales AS s ON s.fk_solicitud = f.id_solicitud
                    JOIN 
                        LATERAL (
                            SELECT *
                            FROM (
                                SELECT * FROM jsonb_each(
                                    CASE 
                                        WHEN jsonb_typeof(s.servicios) = 'object' THEN s.servicios 
                                        ELSE '{}' 
                                    END
                                )
                                UNION ALL
                                SELECT * FROM jsonb_each(
                                    CASE 
                                        WHEN jsonb_typeof(s.servicios_adicionales) = 'object' THEN s.servicios_adicionales 
                                        ELSE '{}' 
                                    END
                                )
                            ) AS union_servicios(servicio, info_servicio)
                        ) AS servicios_finales ON TRUE
                    JOIN 
                        LATERAL jsonb_each(
                            CASE 
                                WHEN jsonb_typeof(f.datos->'servicios') = 'object' THEN f.datos->'servicios' 
                                ELSE '{}' 
                            END
                        ) AS serv_factura(servicio, datos_servicio) 
                        ON replace(serv_factura.servicio, '_', ' ') = servicios_finales.servicio
                    WHERE 
                        f.id_solicitud = :id_solicitud";
            $sql = Conexion::conectar()->prepare($sql);   
            $sql->bindParam(':id_solicitud', $id_solicitud, PDO::PARAM_INT);        
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


    public static function obtenerServiciosFactura($id_solicitud) {
        try {
            $solicitud_id = $id_solicitud;
            $sqlListarSolicitud = "SELECT a.id_servicios_adicionales, a.servicios, a.servicios_adicionales
                    FROM servicios_adicionales a
                    where a.fk_solicitud =:id_solicitud";
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

    public static function obtenerSociedad($id_solicitud,$tabla){
        try {

            // Consulta para obtener el nombre del primer campo
            $sql = "SELECT column_name 
            FROM information_schema.columns 
            WHERE table_name = :tabla 
            ORDER BY ordinal_position 
            LIMIT 1";

            $stmt = Conexion::conectar()->prepare($sql);
            $stmt->execute(['tabla' => $tabla]);
            $primer_campo = $stmt->fetchColumn();


            $solicitud_id = $id_solicitud;
            $sqlListarSolicitud = "SELECT $primer_campo, nombre, apellido, fecha_nacimiento, estado_civil, pais_origen,
            pais_residencia_fiscal, pais_domicilio, numero_pasaporte, pais_pasaporte, 
            tipo_visa, direccion_local, telefonos, emails, industria,
            nombre_negocio_local, ubicacion_negocio_principal, 
            tamano_negocio, contacto_ejecutivo_local, numero_empleados, 
            numero_hijos, razon_consultoria, requiere_registro_corporacion,observaciones,fk_solicitud, createdat
	        FROM $tabla AS s
            WHERE s.uuid = :id_cliente";
            $listaSolicitud = Conexion::conectar()->prepare($sqlListarSolicitud);   
            $listaSolicitud->bindParam(':id_cliente', $solicitud_id, PDO::PARAM_INT);        
            $listaSolicitud->execute();
            $resultados = $listaSolicitud->fetchAll(PDO::FETCH_ASSOC);
            return $resultados;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public static function getServiciosOfrecidos(){
        try {
            $sqlListarSolicitud = "SELECT * FROM servicios WHERE activo=true ORDER BY nombre_servicio";
            $listaSolicutd = Conexion::conectar()->prepare($sqlListarSolicitud);           
            $listaSolicutd->execute();
            return $listaSolicutd->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public static function obtenerAdjuntos($condicion) {
        try {
            $sqlListarSolicitud = "SELECT a.create_at, a.nombre_archivo, a.descripcion, a.numero_registro, a.fecha_entrega, b.nombre_sociedad, doc.nombre_documento_adjunto
                FROM archivo_adjunto a
                LEFT JOIN (
                    SELECT DISTINCT uuid, nombre_sociedad
                    FROM personas_sociedad
                ) b ON a.sociedad_UUID = b.uuid
                INNER JOIN documentos_adjuntos AS doc ON (a.descripcion::int=doc.id_tipo_documento_adjunto)
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
            $sqlListarSolicitud = "SELECT * FROM bancos_consignaciones";
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
            b.created_at, b.id_solicitud, CONCAT(c.nombre, ' ',c.apellido) AS nombre
            FROM personas_sociedad a
            INNER JOIN solicitud b ON a.fk_solicitud = b.id_solicitud
			INNER JOIN sociedad c ON (c.uuid = b.fk_cliente) 
            GROUP BY b.referido_por,b.created_at,b.id_solicitud,c.nombre,c.apellido
            UNION
            SELECT b.referido_por, STRING_AGG(DISTINCT a.nombre_sociedad, ', ') AS nombre_sociedades,b.created_at, b.id_solicitud, CONCAT(c.nombre, ' ',c.apellido) AS nombre
            FROM personas_sociedad a
            INNER JOIN solicitud b ON a.fk_solicitud = b.id_solicitud
            INNER JOIN personas_cliente c ON (c.uuid = b.fk_cliente)
            GROUP BY b.referido_por,b.created_at,b.id_solicitud,c.nombre,c.apellido";
            $listaSolicutd = Conexion::conectar()->prepare($sqlListarSolicitud);           
            $listaSolicutd->execute();
            return $listaSolicutd->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public static function validacionDocumentoAdjuntoSolicitud($id_solicitud) {
        try {
            $sqlListarSolicitud ="SELECT count(a.id_solicitud) FROM solicitud as a
            inner join archivo_adjunto as ar ON(a.id_solicitud = ar.id_solicitud)
            where a.id_solicitud = $id_solicitud";
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
                    servicios_adicionales, fk_cliente)
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
                $sqlInsertarServicios = "INSERT INTO servicios_adicionales(
                    servicios, servicios_adicionales, fecha_creacion, usuario_creacion, fk_solicitud)
                    VALUES(:servicios, :servicios_adicionales, NOW(), :usuario_creacion, :fk_solicitud)";
    
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
            $sql = "INSERT INTO archivo_adjunto(
                nombre_archivo, descripcion, id_solicitud, create_at,sociedad_uuid, numero_registro, fecha_entrega)
                VALUES ( :nombre_archivo, :descripcion, :id_solicitud, NOW(), :sociedad_uuid, :numeroregistro, :fechaentrega)";
            $stmt = Conexion::conectar()->prepare($sql);
            $stmt->bindParam(':nombre_archivo', $datos['nombre_archivo'], PDO::PARAM_STR);
            $stmt->bindParam(':descripcion', $datos['descripcion'], PDO::PARAM_STR);
            $stmt->bindParam(':id_solicitud', $datos['id_solicitud'], PDO::PARAM_INT);
            $stmt->bindParam(':sociedad_uuid', $datos['sociedad'], PDO::PARAM_INT);
            $stmt->bindParam(':numeroregistro', $datos['numero_registro'], PDO::PARAM_INT);
            $stmt->bindParam(':fechaentrega', $datos['fecha_entrega']);
            
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
            $sql = "INSERT INTO factura(datos, created_at,id_solicitud,estado) VALUES ( :datos, NOW(),:id_solicitud,:estado)";
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

    public static function insertarFacturaRapida($datos,$estado_factura) {
        try {
            $estado     = $estado_factura;
            $json_datos = json_encode($datos);
            $sql  = "INSERT INTO factura_rapida(datos,estado) VALUES (:datos,:estado)";
            $stmt = Conexion::conectar()->prepare($sql);
            $stmt->bindParam(':datos', $json_datos);
            $stmt->bindParam(':estado', $estado, PDO::PARAM_INT);
            if($stmt->execute()) {
                return "ok";
            }else{
                return "error";
            } 
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public static function actualizarFacturaRapida($datos, $estado, $id_factura_rapida){
        try {
            $json_datos = json_encode($datos);
            $sql = "UPDATE factura_rapida SET datos = :datos WHERE factura_rapida_id = :id_factura_rapida";
            $stmt = Conexion::conectar()->prepare($sql);
            $stmt->bindParam(':datos', $json_datos);
            $stmt->bindParam(':id_factura_rapida', $id_factura_rapida, PDO::PARAM_INT);
            
            if($stmt->execute()) {
                return "ok";
            } else {
                return "error";
            } 
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // public static function insertarServiciosAdicionales($checkbox,$camposDinamicos,$fk_solicitud) {
    //     try {

    //         $fk_solicitud_insertar= $fk_solicitud;
    //         $usuario_creacion = '1';
    //         $camposDinamicosJSON =json_encode($camposDinamicos);
    //         $checkboxJSON = json_encode($checkbox); 

    //         // $sqlInsertarServicios = "
    //         //     INSERT INTO public.servicios_adicionales(
    //         //     servicios, servicios_adicionales, fecha_creacion, usuario_creacion, fk_solicitud)
    //         //     VALUES(:servicios, :servicios_adicionales, NOW(), 
    //         //     :usuario_creacion, :fk_solicitud);
    //         // ";

    //         // $sqlInsertarServicios = "UPDATE servicios_adicionales 
    //         // -- SET servicios = servicios || :servicios, servicios_adicionales = :serviciosadicionales
    //         // SET servicios = :servicios, 
    //         // servicios_adicionales = :serviciosadicionales
    //         // WHERE fk_solicitud = :fk_solicitud";

    //         $keys_array = array_keys($checkbox); // solo los que el usuario seleccionó
    //         $keys_array_pg = '{' . implode(',', array_map(fn($k) => '"' . $k . '"', $keys_array)) . '}'; // formato array PG


    //         $sqlInsertarServicios = "UPDATE servicios_adicionales
    //             SET servicios = (
    //                 SELECT jsonb_object_agg(key, value)
    //                 FROM (
    //                     SELECT key, value
    //                     FROM jsonb_each(servicios)
    //                     WHERE key = ANY(:keys_array)
    //                     UNION
    //                     SELECT * FROM jsonb_each(:nuevos_servicios)
    //                 ) AS merged
    //             )
    //             WHERE fk_solicitud = :fk_solicitud";

    //         $stmt = Conexion::conectar()->prepare($sqlInsertarServicios);
    //         // $stmt->bindParam(':servicios', $checkboxJSON, PDO::PARAM_STR);
    //         // $stmt->bindParam(':serviciosadicionales', $camposDinamicosJSON, PDO::PARAM_STR);
    //         // $stmt->bindParam(':usuario_creacion', $usuario_creacion, PDO::PARAM_STR);
    //         $$stmt->bindParam(':keys_array', $keys_array_pg, PDO::PARAM_STR); 
    //         $stmt->bindParam(':nuevos_servicios', json_encode($checkbox), PDO::PARAM_STR);
    //         $stmt->bindParam(':fk_solicitud', $fk_solicitud_insertar, PDO::PARAM_INT);
    
    //         return $stmt->execute();
    //     } catch (Exception $e) {
    //         die($e->getMessage());
    //     }
    // }

    public static function insertarServiciosAdicionales($checkbox, $camposDinamicos, $fk_solicitud) {
        try {
            $conexion = Conexion::conectar();
    
            // Obtener las claves actuales del campo 'servicios' para la fk_solicitud dada
            $sqlObtenerServicios = "SELECT servicios,servicios_adicionales FROM servicios_adicionales WHERE fk_solicitud = :fk_solicitud";
            $stmt = $conexion->prepare($sqlObtenerServicios);
            $stmt->bindParam(':fk_solicitud', $fk_solicitud, PDO::PARAM_INT);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    
            $serviciosActuales = $resultado ? json_decode($resultado['servicios'], true) : [];
            // $adicionalesActuales  = $resultado ? json_decode($resultado['servicios_adicionales'], true) : [];
            $adicionalesActuales = $resultado && !empty($resultado['servicios_adicionales']) ? json_decode($resultado['servicios_adicionales'], true) : [];


    
            // Determinar las claves a agregar y eliminar
            $clavesNuevas = array_keys($checkbox);
            $clavesActuales = array_keys($serviciosActuales);
    
            $clavesAAgregar = array_diff($clavesNuevas, $clavesActuales);
            $clavesAEliminar = array_diff($clavesActuales, $clavesNuevas);
    
            // Construir el nuevo JSON resultante
            $serviciosActualizados = $serviciosActuales;
    
            // Agregar nuevas claves
            foreach ($clavesAAgregar as $clave) {
                $serviciosActualizados[$clave] = $checkbox[$clave];
            }
    
            // Eliminar claves deseleccionadas
            foreach ($clavesAEliminar as $clave) {
                unset($serviciosActualizados[$clave]);
            }

            // Combinar servicios adicionales (mantener los anteriores y agregar nuevos)
            $adicionalesActualizados = array_merge($adicionalesActuales, $camposDinamicos);

    
            // Convertir el array actualizado a JSON
            $serviciosJSON = json_encode($serviciosActualizados);
            $camposDinamicosJSON = json_encode($adicionalesActualizados); 

            // Actualizar el campo 'servicios' en la base de datos
            $sqlActualizarServicios = "UPDATE servicios_adicionales
                SET servicios = :servicios, 
                    servicios_adicionales = :servicios_adicionales
                WHERE fk_solicitud = :fk_solicitud";
    
            $stmt = $conexion->prepare($sqlActualizarServicios);
            $stmt->bindParam(':servicios', $serviciosJSON, PDO::PARAM_STR);
            $stmt->bindParam(':servicios_adicionales', $camposDinamicosJSON, PDO::PARAM_STR);
            $stmt->bindParam(':fk_solicitud', $fk_solicitud, PDO::PARAM_INT);
    
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
            $sql = "INSERT INTO public.personas_sociedad (
                    nombre_sociedad, fk_persona, porcentaje, fk_solicitud, create_at, create_user, uuid, conjunto_sociedades, fk_persona_cliente, datos_sociedad
                ) VALUES (
                    :nombre_sociedad, :fk_persona, :porcentaje, :fk_solicitud, NOW(), :create_user, :uuid, :conjuntoSociedades, :fkpersonacliente, :datosSociedad
                );";
    
            // Preparar la sentencia SQL
            $stmt = Conexion::conectar()->prepare($sql);
    
            // Vincular los parámetros a la sentencia preparada
            $stmt->bindParam(':nombre_sociedad', $datos['nombre_sociedad'], PDO::PARAM_STR);
            $stmt->bindParam(':fk_persona', $datos['conjuntopersonas'], PDO::PARAM_INT);
            $stmt->bindParam(':porcentaje', $datos['porcentaje'], PDO::PARAM_INT);
            $stmt->bindParam(':fk_solicitud', $datos['fk_solicitud'], PDO::PARAM_INT);
            $stmt->bindParam(':create_user', $datos['create_user'], PDO::PARAM_STR);
            $stmt->bindParam(':uuid', $datos['uuid'], PDO::PARAM_STR);
            $stmt->bindParam(':conjuntoSociedades', $datos['conjuntosociedad'], PDO::PARAM_STR);
            $stmt->bindParam(':fkpersonacliente', $datos['conjuntoclientes']);
            $stmt->bindParam(':datosSociedad', $datos['datos_sociedad'], PDO::PARAM_STR);
    
            // Ejecutar la consulta
            return $stmt->execute() ? "ok" : "error";
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public static function mdlActualizarSociedad($datos){
        try {
            $sql = "UPDATE personas_sociedad
                    SET datos_sociedad = :datosSociedad
                    WHERE uuid = :idSociedad";
            $stmt = Conexion::conectar()->prepare($sql);
            $stmt->bindParam(':datosSociedad', $datos['datos_sociedad'], PDO::PARAM_STR);
            $stmt->bindParam(':idSociedad', $datos['id_sociedad'], PDO::PARAM_STR);
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
            $sql = "SELECT 
                    id, 
                    datos,
                    datos->>'invoice_number' as numerofactura, 
                    created_at, 
                    ruta_pago, 
                    tipo_consignacion, 
                    nota_pago,
                    b.nombre_banco
                    FROM factura AS f
                    INNER JOIN bancos_consignaciones AS b 
                    ON NULLIF(f.datos->>'cuenta_bancaria', '')::int = b.id_banco
                    WHERE id_solicitud = :id_solicitud"; // Filtrar por id_solicitud
            $stmt = Conexion::conectar()->prepare($sql);
            $stmt->bindParam(':id_solicitud', $idSolicitud, PDO::PARAM_INT); // Pasar el id_solicitud
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ); // Devolver los resultados como objetos
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public static function getFacturasRapidas() {
        try {
            $sql = "SELECT 
                    factura_rapida_id, 
                    datos,
                    datos->>'invoice_number' as numerofactura, 
                    created_at, 
                    ruta, 
                    tipo_consignacion, 
                    nota_pago,
                    b.id_banco,
                    b.nombre_banco
                    FROM factura_rapida AS f
                    INNER JOIN bancos_consignaciones AS b 
                    ON NULLIF(f.datos->>'cuenta_bancaria', '')::int = b.id_banco";
            $stmt = Conexion::conectar()->prepare($sql);
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
                a.conjunto_sociedades,
                a.datos_sociedad
                from personas_sociedad a
                left join sociedad b ON(a.fk_persona = b.id_sociedad)
                where a.fk_solicitud = :id_solicitud
                group  by 1,2,3,4,5,6";
            $listaSolicitud = Conexion::conectar()->prepare($sqlListarSolicitud);   
            $listaSolicitud->bindParam(':id_solicitud', $solicitud_id, PDO::PARAM_INT);        
            $listaSolicitud->execute();
            $resultados = $listaSolicitud->fetchAll(PDO::FETCH_ASSOC);
            
            return $resultados;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    /* 
        1. CTE (WITH json_data AS (...)): Se extrae y transforma los datos del campo jsonb en personas_sociedad.
            1.1. Se extraen los nombres de las personas, los porcentajes, y los conjuntos de personas y clientes.
            1.2. Convierte los valores jsonb a texto con ->> para conjuntoclientes y conjuntopersonas, que contienen listas de IDs de clientes y sociedades.
            1.3. Filtra por una solicitud específica (fk_solicitud = :id_solicitud).
        2. Consulta principal (SELECT ... FROM json_data jd): Se consultan los nombres correspondientes a cada persona en diferentes tablas.
            2.1. Verifica si persona es un UUID usando una expresión regular (^[0-9a-fA-F-]{36}$). Si es así, busca el nombre_sociedad en personas_sociedad.
            2.2. Verifica si persona está en conjuntopersonas (una lista de sociedades). Si es así, obtiene el nombre desde sociedad.
            2.3. Verifica si persona está en conjuntoclientes (una lista de clientes). Si es así, obtiene el nombre desde personas_cliente.
            2.4. Si no encuentra coincidencia, retorna NULL.
    */
    public static function obtenerSociedadesxJSONB($solicitud_id){
        try {
            

            $sqlListarSolicitud = "WITH json_data AS (
                SELECT 
                    ps.uuid, -- Se agrega el UUID
                    -- ps.nombre_sociedad, -- Se agrega el nombre de la sociedad
                    datos_sociedad->>'nombreSociedad' AS nombre_sociedad,
                    datos_sociedad->>'selectTipoSociedad' AS selecttiposociedad,
                    datos_sociedad->>'activarSociedad' AS activarsociedad,
                    datos_sociedad->>'declararSociedad' AS declararsociedad,
                    datos_sociedad->>'tipoCorporacion' AS tipocorporacion,
                    datos_sociedad->>'estadopais' AS estadopais,
                    jsonb_array_elements_text(datos_sociedad->'personas') AS persona, -- Se extrae cada elemento de personas                                    
                    jsonb_array_elements_text(datos_sociedad->'porcentajes') AS porcentaje,
                    datos_sociedad->>'conjuntoclientes' AS conjuntoclientes,
                    datos_sociedad->>'conjuntopersonas' AS conjuntopersonas
                FROM personas_sociedad as ps
                WHERE fk_solicitud = :id_solicitud 
            )
            SELECT 
                jd.uuid,
                jd.nombre_sociedad,
                jd.selecttiposociedad,
                jd.activarSociedad,
                jd.declararsociedad,
                jd.tipocorporacion,
                jd.estadopais,
                jd.persona,
                jd.porcentaje,
                    COALESCE(
                        -- Buscamos en personas_sociedad si persona es un UUID válido
                        (SELECT 
                            nombre_sociedad 
                            FROM personas_sociedad WHERE uuid = jd.persona LIMIT 1),
                        -- Buscamos en sociedad si persona está en conjuntopersonas
                        (SELECT CONCAT(nombre, ' ',apellido) AS nombre FROM sociedad WHERE id_sociedad = NULLIF(jd.persona, '')::int),
                        -- Buscamos en personas_cliente si persona está en conjuntoclientes
                        (SELECT CONCAT(nombre, ' ',apellido) AS nombre FROM personas_cliente WHERE id_persona_cliente = NULLIF(jd.persona, '')::int),
                        -- Buscamos en sociedad_extranjera si persona está en conjuntosociosextranjeros
                        (SELECT datos_sociedad->>'nombreSociedad' AS nombre FROM sociedad_extranjera WHERE id_sociedad_extranjera = NULLIF(jd.persona, '')::int)
                    ) AS nombre_obtenido,
                COALESCE(
                    -- Determinamos el tipo de relación
                    (SELECT 'sociedad' FROM personas_sociedad WHERE uuid = jd.persona LIMIT 1),
                    (SELECT 'miembro' FROM sociedad WHERE id_sociedad = NULLIF(jd.persona, '')::int),
                    (SELECT 'cliente' FROM personas_cliente WHERE id_persona_cliente = NULLIF(jd.persona, '')::int),
                    (SELECT 'socio_extranjero' FROM sociedad_extranjera WHERE id_sociedad_extranjera = NULLIF(jd.persona, '')::int)
                ) AS tipo,
                COALESCE(
                    (SELECT nombre_tipo_sociedad FROM tipo_sociedad WHERE id_tipo_sociedad = NULLIF(jd.selectTipoSociedad,'')::int)
                ) AS tiposociedad,
                COALESCE( 
                    (SELECT nombre_archivo FROM archivo_adjunto WHERE sociedad_uuid = NULLIF(jd.uuid,'') AND descripcion='10' ORDER BY id_archivo_adjunto DESC LIMIT 1)
                ) AS nombre_archivo
            FROM json_data jd";
            $listaSolicitud = Conexion::conectar()->prepare($sqlListarSolicitud);   
            $listaSolicitud->bindParam(':id_solicitud', $solicitud_id, PDO::PARAM_INT);        
            $listaSolicitud->execute();
            $resultados = $listaSolicitud->fetchAll(PDO::FETCH_ASSOC);
            
            return $resultados;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

	public static function buscarNombreSociedad($uuid){
        try {
            $sql = "SELECT datos_sociedad->>'nombreSociedad' AS nombre_sociedad
                    FROM personas_sociedad
                    WHERE uuid = :uuid";
            $stmt = Conexion::conectar()->prepare($sql);
            $stmt->bindParam(':uuid', $uuid);
            $stmt->execute();
            return $stmt->fetch();
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

    public static function obtenerSociedadesCliente($id_solicitud){
        try {
            $solicitud_id = $id_solicitud;
            $sqlListarSolicitud = "SELECT
                fk_persona_cliente as clientes
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

    public static function buscarSociedadCliente($sociedad){
        try {
            $sqlBuscarSociedad = "SELECT
                nombre||' ' ||apellido AS nombrecompleto FROM personas_cliente
                where id_persona_cliente = :identi";
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
            $sql="INSERT INTO egresos_sociedad
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
            $sqlListarSolicitud = "SELECT a.valor, a.consecutivo_egreso, b.nombre_tercero, a.create_at::date, a.anticipo, a.factura
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

    public static function contarPersonasPorSolicitud($id_solicitud) {
        try {
        $sql = "SELECT jsonb_array_length(datos_sociedad -> 'personas') AS cant_personas, uuid
                FROM personas_sociedad
                WHERE datos_sociedad ->> 'selectTipoSociedad' = '5'
                AND uuid = :id_solicitud";

            $stmt = Conexion::conectar()->prepare($sql);
            $stmt->bindParam(':id_solicitud', $id_solicitud);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC); // ✅ ahora devuelves todo el array asociativo
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Error en modelo: ' . $e->getMessage()]);
            exit;
        }
    }
}
?>