<?php
require_once('conexion.php');

class modelSociedad{



    static public function mdlInsertarSociedad($datos) {
        try {
            

            $sqlInsertarSociedad = "INSERT INTO public.sociedad(
                nombre, apellido, fecha_nacimiento, estado_civil, pais_origen, 
                pais_residencia_fiscal, pais_domicilio, numero_pasaporte, 
                pais_pasaporte, tipo_visa, direccion_local, telefonos, emails, 
                industria, nombre_negocio_local, ubicacion_negocio_principal, 
                tamano_negocio, contacto_ejecutivo_local, numero_empleados, 
                numero_hijos, razon_consultoria, requiere_registro_corporacion, 
                observaciones,  fk_solicitud, createdat)
                VALUES (:nombre, :apellido, :fecha_nacimiento, :estado_civil, 
                :pais_origen, :pais_residencia_fiscal, :pais_domicilio, 
                :numero_pasaporte, :pais_pasaporte, :tipo_visa, :direccion_local, 
                :telefonos, :emails, :industria, :nombre_negocio_local, 
                :ubicacion_negocio_principal, :tamano_negocio, 
                :contacto_ejecutivo_local, :numero_empleados, :numero_hijos, 
                :razon_consultoria, :requiere_registro_corporacion, 
                 :observaciones,:fk_solicitud, now())";

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
            $sqlListarSociedades = "SELECT * FROM sociedad";
            $listaSociedades = Conexion::conectar()->prepare($sqlListarSociedades);
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
}
















?>