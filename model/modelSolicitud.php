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
                    SELECT a.servicios, a.servicios_adicionales, b.estado
                    FROM servicios_adicionales a
                    inner join factura as b ON(a.fk_solicitud=b.id_solicitud)
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
            SELECT servicios, servicios_adicionales FROM solicitud where id_solicitud = :id_solicitud 
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

    public static function obtenerServiciosFacturados($id_solicitud) {
        try {
            $solicitud_id = $id_solicitud;
            $sqlListarSolicitud = "
            select estado,datos from factura where id_solicitud=:id_solicitud 
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
            $sqlListarSolicitud = "
            SELECT * FROM archivo_adjunto where id_solicitud = $condicion ;
            ";
            $listaSolicutd = Conexion::conectar()->prepare($sqlListarSolicitud);   
                    
            $listaSolicutd->execute();
            return $listaSolicutd->fetchAll(PDO::FETCH_OBJ);
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
            $sqlListarSolicitud ="
                SELECT a.id_solicitud, ar.id_solicitud, a.nombre_cliente, a.referido_por, a.created_at
                FROM solicitud as a
                RIGHT JOIN (
                    SELECT DISTINCT ON (id_solicitud) *
                    FROM archivo_adjunto
                    ORDER BY id_solicitud, id_archivo_adjunto
                ) as ar ON a.id_solicitud = ar.id_solicitud;

           ";
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
                 nombre_archivo, descripcion, id_solicitud, create_at)
                VALUES ( :nombre_archivo, :descripcion, :id_solicitud, NOW());";
            $stmt = Conexion::conectar()->prepare($sql);
            $stmt->bindParam(':nombre_archivo', $datos['nombre_archivo'], PDO::PARAM_STR);
            $stmt->bindParam(':descripcion', $datos['descripcion'], PDO::PARAM_STR);
            $stmt->bindParam(':id_solicitud', $datos['id_solicitud'], PDO::PARAM_INT);
            
            
           
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
       
    
}
?>