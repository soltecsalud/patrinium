<?php 
    include_once "../model/modelSociedad.php";

    if (isset($_POST['datos'])) {
        // Obtener los datos enviados por AJAX
        $datosRecibidos  = json_decode($_POST['datos'], true);

        // Obtener los datos de Handsontable
        $datosTabla = $datosRecibidos['tabla'];

        if (is_array($datosTabla)) {
            // Iterar sobre cada fila de la tabla
            foreach ($datosTabla as $index => $fila) {
                $nombre = isset($fila[0]) ? $fila[0] : null;  // Nombre
                $apellido = isset($fila[1]) ? $fila[1] : null;  // Apellido
                $fechaNacimiento = isset($fila[2]) ? $fila[2] : null;  // Fecha de nacimiento
                $estadoCivil = isset($fila[3]) ? $fila[3] : null;  // Estado civil
                $paisOrigen = isset($fila[4]) ? $fila[4] : null;  // Pais de origen
                $paisResidenciaFiscal = isset($fila[5]) ? $fila[5] : null;  // Pais de residencia fiscal
                $ciudad = isset($fila[6]) ? $fila[6] : null;  // Ciudad
                $paisDomicilio = isset($fila[7]) ? $fila[7] : null;  // Pais de domicilio
                $numeroPasaporte = isset($fila[8]) ? $fila[8] : null;  // Numero de pasaporte
                $paispasaporte = isset($fila[9]) ? $fila[9] : null;  // Pais de pasaporte
                $tipoVisa = isset($fila[10]) ? $fila[10] : null;  // Tipo de visa
                $direccionLocal = isset($fila[11]) ? $fila[11] : null;  // Direccion local
                $telefonos = isset($fila[12]) ? $fila[12] : null;  // Telefonos
                $emails = isset($fila[13]) ? $fila[13] : null;  // Emails
                $industria = isset($fila[14]) ? $fila[14] : null;  // Industria
                $nombreprincipal = isset($fila[15]) ? $fila[15] : null;  // Nombre del negocio principal
                $ubicacionprincipal = isset($fila[16]) ? $fila[16] : null;  // Ubicacion del negocio principal
                $tamanonegocio = isset($fila[17]) ? $fila[17] : null;  // Tamaño del negocio
                $contactoejecutivo = isset($fila[18]) ? $fila[18] : null;  // Contacto ejecutivo
                $numeroempleados = isset($fila[19]) ? $fila[19] : null;  // Numero de empleados
                $numerohijos = isset($fila[20]) ? $fila[20] : null;  // Numero de hijos
                $razonconsultoria = isset($fila[21]) ? $fila[21] : null;  // Razon de consultoria
                $requiereregistro = isset($fila[22]) ? $fila[22] : null;  // Requiere registro de corporacion
                $observaciones = isset($fila[23]) ? $fila[23] : null;  // Observaciones

                $datos = array(
                    "nombre" => $nombre,
                    "apellido" => $apellido,
                    "fecha_nacimiento" => $fechaNacimiento,
                    "estado_civil" => $estadoCivil,
                    "pais_origen" => $paisOrigen,
                    "pais_residencia_fiscal" => $paisResidenciaFiscal,
                    "pais_domicilio" => $paisDomicilio,
                    "numero_pasaporte" => $numeroPasaporte,
                    "pais_pasaporte" => $paispasaporte,
                    "tipo_visa" => $tipoVisa,
                    "direccion_local" => $direccionLocal,
                    "telefonos" => $telefonos,
                    "emails" => $emails,
                    "industria" => $industria,
                    "nombre_negocio_local" => $nombreprincipal,
                    "ubicacion_negocio_principal" => $ubicacionprincipal,
                    "tamano_negocio" => $tamanonegocio,
                    "contacto_ejecutivo_local" => $contactoejecutivo,
                    "numero_empleados" => $numeroempleados,
                    "numero_hijos" => $numerohijos,
                    "razon_consultoria" => $razonconsultoria,
                    "requiere_registro_corporacion" => $requiereregistro,
                    "observaciones" => $observaciones,
                    "ciudad" => $ciudad,
                    "id_solicitud" => 189 //$_POST["id_solicitud"]
                );

                $respuesta = modelSociedad::mdlInsertarSociedad($datos);
                // if ($respuesta == "ok") {
                //     echo json_encode(['status' => 'success', 'message' => 'Datos guardados con exito', 'nombre' => $nombre, 'apellido' => $apellido, 'fecha_nacimiento' => $fechaNacimiento]);
                // } else {
                //     echo json_encode(['status' => 'error', 'message' => 'Error al guardar los datos '. $respuesta. ' | '. $fechaNacimiento]);
                // }
                $index++;
                if($respuesta == 'ok'){
                    $resultados[] = [
                        "index" => $index,
                        "status" => "success",
                        "message" => "Fila $index registrada correctamente (Nombre: $nombre)",
                    ];
                }else{
                    $resultados[] = [
                        "index" => $index,
                        "status" => "error",
                        "message" => "Error al registrar la fila $index (Nombre: $nombre)",
                    ];
                }
            }
            header('Content-Type: application/json');
            echo json_encode(['resultados' => $resultados]);

        }
    }

?>