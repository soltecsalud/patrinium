<?php
include_once "../model/modelSolicitud.php";

class Solicitud_controller{
    
    public function getSolicitud($id_solicitud) {
        $id_solicitud_model=$id_solicitud;
        $modelo = new ModelSolicitud();
        $solicitud = $modelo->obtenerSolicitud($id_solicitud_model);
        return $solicitud;
    }

    public function getServiciosOfrecidos(){        
        $modelo = new ModelSolicitud();
        $solicitud = $modelo->getServiciosOfrecidos();
        $solicitud = json_encode($solicitud);
        echo $solicitud;
    }


    public function getListadoSolicitudes() {
        $modelo    = new ModelSolicitud();
        $solicitud = $modelo->obtenerAllSolicitud();
        return $solicitud;
    }

    public function getServicios($id_enviado_desde_vista){
        $id_solicitud = $id_enviado_desde_vista;
        $modelo = new ModelSolicitud();
        $solicitud = $modelo->obtenerServicios($id_solicitud);
        return json_encode($solicitud); 
    }

    public function verificarServicioEnFactura($id_enviado_desde_vista){
        $id_solicitud = $id_enviado_desde_vista;
        $modelo = new ModelSolicitud();
        $solicitud = $modelo->mdlVerificarServicioEnFactura($id_solicitud);
        return json_encode($solicitud); 
    }



    public function getServiciosFactura($id_enviado_desde_vista){
        $id_solicitud = $id_enviado_desde_vista;
        $modelo = new ModelSolicitud();
        $solicitud = $modelo->obtenerServiciosFactura($id_solicitud);
        return $solicitud;
    }

    

    public function getServiciosFacturados($id_enviado_desde_vista){
        $id_solicitud = $id_enviado_desde_vista;
        $modelo = new ModelSolicitud();
        $solicitud = $modelo->obtenerServiciosFacturados($id_solicitud);
        echo $solicitud; // Imprimir el JSON decodificado correctamente
    }

    public function getSociedad($id_enviado_desde_vista,$valor){
        $id_solicitud = $id_enviado_desde_vista;
        $modelo = new ModelSolicitud();
        if($valor == '0'){
            $tabla = 'sociedad';
        }else{
            $tabla = 'personas_cliente';
        }
        $solicitud = $modelo->obtenerSociedad($id_solicitud,$tabla);
        return $solicitud;
    }

    public function verificarAdjuntoSolicitud($id_solicitud_adjunto) {
        $id_solicitud_adjunto_model = $id_solicitud_adjunto;
        $modelo = new ModelSolicitud();
        $solicitud = $modelo->validacionDocumentoAdjuntoSolicitud($id_solicitud_adjunto_model);
        return $solicitud;
    }

    public function getListadoSolicitudesConAdjuntos() {
        $modelo = new ModelSolicitud();
        $solicitud = $modelo->obtenerSolicitudesConAdjuntos();
        return $solicitud;
    }

    public function getListadoAdjuntos($id_solicitud_archivo) {
        $id_solicitud_adjunto_mdl = $id_solicitud_archivo;
        $modelo = new ModelSolicitud();
        $solicitud = $modelo->obtenerAdjuntos($id_solicitud_adjunto_mdl);
        return $solicitud;
    }

    public function getBancosConsignacion() {
        $modelo = new ModelSolicitud();
        $solicitud = $modelo->getBancosConsignacion();
        return $solicitud;
    }

    public function insertarSolicitud() {
        $estado = 3;
        $modelo = new ModelSolicitud();
    
        $datos = array(
            "fk_Persona"     => $_POST['selectPersona'],
            "nombre_cliente" => $_POST['nombreCliente'],
            "referido_por"   => $_POST['referido_por'],
            "necesidad"      => $_POST['necesidad']
        );
    
        // Obtiene los nombres dinámicos desde la BD
        $checkbox_names = $modelo->obtenerNombresServicios();
    
        $checkbox = array();
    
        // Recorre los nombres obtenidos desde la BD
        foreach ($checkbox_names as $name) {
            if (isset($_POST[$name]) && $_POST[$name] !== '') {
                $checkbox[$name] = array(
                    'value' => $_POST[$name],
                    'estado' => $estado
                );
            }
        }
    
        // Capturar los campos dinámicos
        $camposDinamicos = array();
        if (isset($_POST['campoDinamico']) && is_array($_POST['campoDinamico'])) {
            foreach ($_POST['campoDinamico'] as $indice => $valor) {
                if (!empty($valor)) {
                    // $camposDinamicos["campoDinamico[$indice]"] = array(
                    $camposDinamicos[$valor] = array(
                        'value'  => $valor,
                        'estado' => 0
                    );
                }
            }
        }
    
        // Debugging: Verificar datos antes de insertarlos
        error_log("Datos: " . json_encode($datos));
        error_log("Checkbox: " . json_encode($checkbox));
        error_log("Campos Dinámicos: " . json_encode($camposDinamicos));
    
        // Insertar en BD
        $usuario = "serazo";
        $respuesta = ModelSolicitud::insertarSolicitud($datos, $checkbox, $camposDinamicos, $usuario);
    
        echo ($respuesta == "ok") ? 0 : 1;
    }

     public function insertarRevision() {
        $id_solicitud = $_POST['id_solicitud'];
    
        // Asumiendo que 'resource' es la carpeta dentro de la raÃ­z del proyecto donde quieres guardar los archivos
        $uploadsDir = __DIR__ . '/resource/';
        $folderName = $id_solicitud ; // La nueva subcarpeta para las revisiones
    
        // Ruta completa al directorio de revisiones
        $revisionPath = $uploadsDir . '/' . $folderName . '/';
    
        // Verificar si la carpeta de revisiones existe
        if (!file_exists($revisionPath)) {
            // Intenta crear la carpeta con permisos adecuados
            if (!mkdir($revisionPath, 0777, true)) {
                die("Error al crear la carpeta de revisiones.");
            }
            // DespuÃ©s de crear la carpeta, se aplica el chmod para asegurar de que tenga los permisos correctos
            chmod($revisionPath, 0777);
        }
    
        // Procesamiento del archivo subido
        if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] === UPLOAD_ERR_OK) {

            $obtenerNombreSociedad = ModelSolicitud::buscarNombreSociedad($_POST['sociedad']);    

            $fileName = $_FILES['archivo']['name'];
            // Asegurarse de limpiar el nombre del archivo para evitar vulnerabilidades
            $fileName = $obtenerNombreSociedad[0]. '_'. basename($fileName);
            $filePath = $revisionPath . $fileName;
            $descripcion = $_POST['descripcion'];
            $sociedad =$_POST['sociedad'];
            $numero_registro = ($descripcion=='10' || $descripcion=='14') ? $_POST['numeroregistro'] : null;
            
            if($descripcion=='10'){
                $fecha_entrega = $_POST['fechaein'];
            }else if($descripcion=='14'){
                $fecha_entrega = $_POST['fecharegistro'];
            }else{
                $fecha_entrega = null;
            }
            
            // $fecha_entrega   = ($descripcion=='10' || $descripcion=='14') ? $_POST['fechaein'] : null;
            

            //crer array para envio al modelo e insercion a BD
            $datos = array(
                "nombre_archivo"  => $fileName,
                "descripcion"     => $descripcion,
                "id_solicitud"    => $id_solicitud,
                "sociedad"        => $sociedad,
                "numero_registro" => $numero_registro,
                "fecha_entrega"   => $fecha_entrega
                );
           //envio a modulo para inserciono
            $respuesta = ModelSolicitud::insertarArchivoSolicitud($datos);    

            if($respuesta == "ok") {
                echo 0; // Ã‰xito
            } else {
                echo 1; // Error
            }
            // Mover el archivo al directorio de revisiones
            if (move_uploaded_file($_FILES['archivo']['tmp_name'], $filePath)) {
                // El archivo se ha cargado correctamente
                // AquÃ­ se podrÃ­a incluir mÃ¡s lÃ³gica para manejar el archivo cargado,
                // como insertar detalles en la base de datos.
                echo "Archivo cargado con Ã©xito: ".$fileName."variable:$$ ".$descripcion."&&&".$id_solicitud;
            } else {
                // Error al mover el archivo
                echo "Error al mover el archivo.";
            }
        } else {
            // No se recibiÃ³ ningÃºn archivo vÃ¡lido o hubo un error en la carga
            echo "No se ha seleccionado ningÃºn archivo o ocurriÃ³ un error al cargarlo.";
        }
    }

    
    public function insertarFactura() {
        $id_solicitud_factura = $_POST['id_solicitud'];
        $estado = $_POST['estado'];
        $logo = $_POST['logo'];
        $total_factura = $_POST['total_factura'];
        $cuenta_bancaria = $_POST['cuenta_bancaria'];
        $observaciones = $_POST['observaciones'];
        $invoice_number = $_POST['invoice_number']; 
        $email=$_POST['email'];
        $adress=$_POST['adress'];
        $tax=$_POST['tax'];
        $number_tax=$_POST['numberTax'];
        $selectPersonaFactura = $_POST['selectPersonaFactura'];

        $datos = [
            "logo" => $logo,
            "Total" => $total_factura,
            "cuenta_bancaria" => $cuenta_bancaria,
            "observaciones" => $observaciones,
            "invoice_number" => $invoice_number,
            "email" => $email,
            "adress" => $adress,
            "tax" => $tax,
            "number_tax" => $number_tax,
            "selectPersonaFactura" => $selectPersonaFactura,
            "servicios" => []
        ];

        // Procesar cada servicio detectando los nombres de campos que comienzan con 'cantidad' y 'valor'
        foreach ($_POST as $clave => $valor) {
            if (strpos($clave, 'cantidad') === 0) {
                $key = substr($clave, 8); // Extraer la parte después de 'cantidad'
				$key = str_replace('_', ' ', $key);
                $datos['servicios'][$key]['cantidad'] = $valor;
            } elseif (strpos($clave, 'valor') === 0) {
                $key = substr($clave, 5); // Extraer la parte después de 'valor'
				$key = str_replace('_', ' ', $key);
                $datos['servicios'][$key]['valor'] = $valor;
            } elseif (strpos($clave, 'check') === 0) {
                $key = substr($clave, 5);
				$key = str_replace('_', ' ', $key);
                $datos['servicios'][$key]['check'] = $valor;
            }else if(strpos($clave, 'descripcionservicio') === 0){
                $key = substr($clave, 19);
                $key = str_replace('_', ' ', $key);
                $datos['servicios'][$key]['descripcionservicio'] = $valor;
            }
        }

        // foreach ($datos['servicios'] as $clave => $valores) {
        //     if (isset($valores["check"]) && $valores["check"] === "on") {
        //         // Acción que deseas realizar si el checkbox está activado
        //         echo "Procesando: $clave - Cantidad: {$valores['cantidad']}, Valor: {$valores['valor']}<br>";
        //         $actualizarServicio = ModelSolicitud::actualizarEstadoServiciofactura($id_solicitud_factura, $clave, 1);
        //     }
        // }

        $respuesta = ModelSolicitud::insertarFactura($datos, $id_solicitud_factura, $estado);
        if ($respuesta == "ok") {
            echo json_encode(["status" => 0, "servisios" => $datos['servicios']]); // Éxito
        } else {
            echo json_encode(["status" => 1]); // Error
        }
    }

    public function insertarFacturaRapida() {
        $estado          = $_POST['estado'];
        $logo            = $_POST['logo'];
        $total_factura   = $_POST['total_factura'];
        $cuenta_bancaria = $_POST['cuenta_bancaria'];
        $observaciones   = $_POST['observaciones'];
        $invoice_number  = $_POST['invoice_number']; 
        $email           = $_POST['email'];
        $adress          = $_POST['adress'];
        $tax             = $_POST['tax'];
        $number_tax      = $_POST['numberTax'];
        $clienteFactura  = $_POST['clientefactura'];


        $datos = [
            "logo" => $logo,
            "Total" => $total_factura,
            "cuenta_bancaria" => $cuenta_bancaria,
            "observaciones" => $observaciones,
            "invoice_number" => $invoice_number,
            "email" => $email,
            "adress" => $adress,
            "tax" => $tax,
            "number_tax" => $number_tax,
            "clientefactura" => $clienteFactura,
            "servicios" => []
        ];

        // Procesar cada servicio detectando los nombres de campos que comienzan con 'cantidad' y 'valor'
        foreach ($_POST as $clave => $valor) {
            if (strpos($clave, 'cantidad') === 0) { // Verifica si la clave comienza con 'cantidad'
                $key = substr($clave, 8); // Extraer la parte después de 'cantidad'
                $datos['servicios'][$key]['cantidad'] = $valor;
            } elseif (strpos($clave, 'valor') === 0) {
                $key = substr($clave, 5); // Extraer la parte después de 'valor'
                $datos['servicios'][$key]['valor'] = $valor;
            } elseif (strpos($clave, 'check') === 0) {
                $key = substr($clave, 5);
                $datos['servicios'][$key]['check'] = $valor;
            }else if(strpos($clave, 'nombre') === 0){
                $key = substr($clave, 6);
                $datos['servicios'][$key]['nombre'] = $valor;
            }else if(strpos($clave, 'descripcionservicio') === 0){
                $key = substr($clave, 19);
                $key = str_replace('_', ' ', $key);
                $datos['servicios'][$key]['descripcionservicio'] = $valor;
            }
        }

        if(isset($_POST['id_factura_rapida']) && !empty($_POST['id_factura_rapida'])) {
            $respuesta = ModelSolicitud::actualizarFacturaRapida($datos, $estado, $_POST['id_factura_rapida']);
        } else {
            $respuesta = ModelSolicitud::insertarFacturaRapida($datos, $estado);
        }

        if ($respuesta == "ok") {
            echo json_encode(["status" => 0, "servisios" => $datos['servicios']]); // Éxito
        } else {
            echo json_encode(["status" => 1]); // Error
        }

    }
    
    public function validarFactura($id_revisar_solicitud) {
        $id_revisar=$id_revisar_solicitud;
        $facturaValida = ModelSolicitud::validarFactura($id_revisar);
        return $facturaValida;
    }   
    public function validarDocumento($id_revisar_solicitud) {
        $id_revisar=$id_revisar_solicitud;
        $documentoValidado = ModelSolicitud::validarDocumento($id_revisar);
        return $documentoValidado;
    } 
    
    public function insertarServiciosAdicionales() {
        $fk_solicitud = $_POST['fk_solicitud'];
        $checkbox     = array();
        $estado       = 3;


        $checkbox_names   = ModelSolicitud::obtenerNombresServicios();
        $servicioActuales = ModelSolicitud::obtenerServicioxSolicitud($fk_solicitud);
    
        // Define un array con los nombres de las casillas de verificación
        // $checkbox_names = array(
        //     'tipoTrust', 'registroCorporacion', 'registroFIP', 'goodStanding',
        //     'certificateIncumbency', 'contratoArrendamiento', 'registroCorporacionExterior',
        //     'contratosComerciales', 'aperturaCuentaBancosCorporativa', 'aperturaBancosCuentaPersonal',
        //     'serviciosContabilidad', 'serviciosImpuestos', 'servicioAgenteRegistrador',
        //     'acuerdoDeSocios', 'proteccionDivorcios', 'ProteccióndePatrimonio', 'Actas','ServiciosProfesionales',
        //     'investigacionAntecedentes', 'compraVentaEmpresas', 'visasInversionistaUSA',
        //     'planesNegocios', 'internacionalizacionEmpresas', 'formasW8', 'formasW8BEN',
        //     'formasW9', 'formasFBAR', 'formas1050R', 'formas5471_2', 'reporteB12',
        //     'reporteB13', 'reporteFincen', 'reporteBOI', 'serviciosDomicilio', 'servicioTesoreria',
        //     'servicioNomina', 'controlInventarios', 'serviciosFacturacion', 'serviciosAdministracionNegocios',
        //     'serviciosLegalesNotario', 'serviciosLegalesApostille', 'serviciosReportesEspeciales'
        // );
    
        // Recorre el array de nombres de casillas de verificación
        foreach ($checkbox_names as $name) {
            // Verifica si la casilla de verificación está seleccionada y asigna su valor al array $checkbox
            if (isset($_POST[$name]) && $_POST[$name] !== '') {
                // $checkbox[$name] = $_POST[$name];
                $checkbox[$name] = array(
                    'value'  => $_POST[$name],
                    'estado' => $estado
                );
            }
        }

        $camposDinamicos = array();
        foreach ($_POST['campoDinamico'] as $indice => $valor) {
            // Verificar si el valor del campo dinámico está presente y no está vacío
            if (isset($valor) && $valor !== '') {
                // Agregar el valor del campo dinámico al array en el formato deseado
                // $camposDinamicos["campoDinamico[$indice]"] = $valor;
                $camposDinamicos[$valor] = array(
                    'value'  => $valor,
                    'estado' => 0 
                );
            }
        }
        
        //var_dump($datos);
        $respuesta = ModelSolicitud::insertarServiciosAdicionales($checkbox, $camposDinamicos, $fk_solicitud);
        echo json_encode($camposDinamicos);
        // if($respuesta == "ok") {
        //     echo 0; // Éxito
        // }else{
        //     echo 1; // Error
        // }
    }

    public function crearSociedad() {
        // Convertir todo el POST a JSON sin modificar la estructura
        $datos_sociedad = json_encode($_POST, JSON_UNESCAPED_UNICODE);
    
        $nombreSociedad = $_POST['nombreSociedad'];
        $personas = $_POST['personas']; // Array de personas
        $porcentajes = $_POST['porcentajes']; // Array de porcentajes
        $fk_solicitud = $_POST['hiddenField'];
        $create_user = 'usuario_ejemplo';
        $uuid = $_POST['uuid'];
    
        $conjuntopersonas  = $_POST['conjuntopersonas'] == '' ? '0' : $_POST['conjuntopersonas'];
        $conjuntopersonasA = explode(',', $conjuntopersonas);
        $conjuntoClientes = $_POST['conjuntoclientes'] == '{}' ? '{1}' : $_POST['conjuntoclientes'];
    
        // foreach ($conjuntopersonasA as $index => $persona) {
            $datos = [
                'uuid'             => $uuid,
                'nombre_sociedad'  => $nombreSociedad,
                'fk_persona'       => '0',
                'porcentaje'       => '0',
                'fk_solicitud'     => $fk_solicitud,
                'create_user'      => $create_user,
                'conjuntopersonas' => '0',
                'conjuntosociedad' => $_POST['sociedades'],
                'conjuntoclientes' => $conjuntoClientes,
                'datos_sociedad'   => $datos_sociedad // Incluir JSON en el array de datos
            ];
    
            // Enviar el array con todos los datos al modelo
            $respuesta = ModelSolicitud::insertarSociedad($datos);
            
            if ($respuesta != "ok") {
                // echo json_encode(["status" => 1, "message" => ]);
                echo json_encode(["status" => 1, "message" => "Error al crear la sociedad"]); // Error si falla la inserción
                return;
            }
        // }
            // Sociedad creada exitosamente
        // echo json_encode(["status" => 0]); // Éxito
        echo json_encode(["status" => 0, "message" => "Sociedad creada exitosamente"]); // Éxito
    }

    public function actualizarSociedad() {
        $datos_sociedad = json_encode($_POST, JSON_UNESCAPED_UNICODE);
        $uuid           = $_POST['idSociedad'];
        $datos = [
            'id_sociedad'     => $uuid,
            'datos_sociedad'  => $datos_sociedad
        ];
        $respuesta = ModelSolicitud::mdlActualizarSociedad($datos);
        if ($respuesta == "ok") {
            echo json_encode(["status" => 0, "message" => "Sociedad actualiza exitosamente"]); // Éxito
        } else {
            echo json_encode(["status" => 1, "message" => "Error al actualizar la sociedad"]); // Error
        }
    }
    

    function generateUUID() {
        return sprintf(
            '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff), mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }

        public function insertarDatosAdicionales() {
            $datos = [
                'nombre_cliente' => $_POST['nombre_cliente'],
                'sr_numero' => $_POST['sr_numero'],
                'date_organization' => $_POST['date_organization'],
                'state_organization' => $_POST['state_organization'],
                'principal_business' => $_POST['principal_business'],
                'managing_members' => $_POST['managing_members'],
                'bank_account' => $_POST['bank_account'],
                'fiscal_year' => $_POST['fiscal_year'],
                'ein' => $_POST['ein'],
                'date_annual_meeting' => $_POST['date_annual_meeting'],
                'secretary' => $_POST['secretary'],
                'treasurer' => $_POST['treasurer'],
                'members' => $_POST['members'],
                'initial_manager' => $_POST['initial_manager'],
                'fk_solicitud' => $_POST['fk_solicitud']
            ];

            $respuesta = ModelSolicitud::insertarDatosAdiconales($datos);
            if ($respuesta == "ok") {
                echo json_encode(["status" => 0]); // Éxito
            } else {
                echo json_encode(["status" => 1]); // Error
            }
        }

        public function actualizarServicioJson() {
            // Obtener los datos enviados desde el formulario
            $id_servicios_adicionales = $_POST['id_servicios_solicitados'];
            $servicios_seleccionados = $_POST['servicios']; // Array con los servicios seleccionados
      

           
            // Iterar sobre los servicios seleccionados para actualizar su estado
            foreach ($servicios_seleccionados as $clave_servicio) {
               
                $nuevo_estado = 2;
        
                // Llamar al modelo para actualizar el estado del servicio
                $respuesta = ModelSolicitud::actualizarEstadoServicio($id_servicios_adicionales, $clave_servicio, $nuevo_estado);
                
                // Verificar si la actualización fue exitosa
                if ($respuesta == "ok") {
                    echo 0; // Éxito
                } else {
                    echo 1; // Error
                }
            }
        }

        public function actualizarServiciosFactura() {
            // Obtener los datos enviados desde el formulario
            $id_servicios_adicionales = $_POST['id_servicios_solicitados'];
            $servicios_seleccionados = $_POST['servicios']; // Array con los servicios seleccionados
      

           
            // Iterar sobre los servicios seleccionados para actualizar su estado
            foreach ($servicios_seleccionados as $clave_servicio) {
               
                $nuevo_estado = 0;
        
                // Llamar al modelo para actualizar el estado del servicio
                $respuesta = ModelSolicitud::actualizarEstadoServiciofactura($id_servicios_adicionales, $clave_servicio, $nuevo_estado);
                
                // Verificar si la actualización fue exitosa
                if ($respuesta == "ok") {
                    echo 0; // Éxito
                } else {
                    echo 1; // Error
                }
            }
        }

        public function facturasDownload($idSolicitud) {
            $modelo = new ModelSolicitud();
            $facturas =  $modelo->getFacturasBySolicitud($idSolicitud);
            echo json_encode($facturas); // Respuesta en formato JSON
        }

        public function facturasRapidasDownload() {
            $modelo = new ModelSolicitud();
            $facturas =  $modelo->getFacturasRapidas();
            echo json_encode($facturas); // Respuesta en formato JSON
        }

        public function getSociedades($id_revisar_solicitud){
            $id_solicitud = $id_revisar_solicitud;
            $modelo = new ModelSolicitud();
            $solicitud = $modelo->obtenerSociedades($id_solicitud);
            return $solicitud;
        }

        public function getSociedadesxJSONB($id_revisar_solicitud){
            $id_solicitud = $id_revisar_solicitud;
            $modelo = new ModelSolicitud();
            $solicitud = $modelo->obtenerSociedadesxJSONB($id_solicitud);
            return $solicitud;
        }

        public function getSociedadesSociedades($id_revisar_solicitud){
            $id_solicitud = $id_revisar_solicitud;
            $modelo = new ModelSolicitud();
            return $modelo->obtenerSociedadesSociedades($id_solicitud);
            // return $solicitud;
        }

        public function obtenerSociedadesCliente($id_revisar_solicitud){
            $id_solicitud = $id_revisar_solicitud;
            $modelo = new ModelSolicitud();
            return $modelo->obtenerSociedadesCliente($id_solicitud);
            // return $solicitud;
        }

        

        public function buscarSociedadxSociedad($id_revisar_solicitud){
            $id_solicitud = $id_revisar_solicitud;
            $modelo = new ModelSolicitud();
            return $modelo->buscarSociedadxSociedad($id_solicitud);
            // return $solicitud[0];
        }

        public function buscarSociedadCliente($id_revisar_solicitud){
            $id_solicitud = $id_revisar_solicitud;
            $modelo = new ModelSolicitud();
            return $modelo->buscarSociedadCliente($id_solicitud);
        }

        public function obtenerDescripciones($idSolicitud) {
            $modelo = new ModelSolicitud();
            $descripciones = $modelo->fetchDescripciones($idSolicitud);
            echo json_encode($descripciones);
        }

        public function insertarEgreso() {
            $rutaFactura = null;
            if (isset($_FILES['factura']) && $_FILES['factura']['error'] === UPLOAD_ERR_OK) {
                $directorio = '../resource/innvoice_terceros/';
                $nombreArchivo = uniqid() . "_" . basename($_FILES['factura']['name']);
                $rutaArchivo = $directorio . $nombreArchivo;

                if (move_uploaded_file($_FILES['factura']['tmp_name'], $rutaArchivo)) {
                    $rutaFactura = $rutaArchivo;
                } else {
                    echo json_encode(["status" => "error", "message" => "Error al cargar la factura"]);
                    return;
                }
            }

            // Datos a insertar
            $datos = [
                'identificacion_egreso' => $_POST['identificacion_egreso'],
                'fk_sociedad' => $_POST['sociedad_tercero'],
                'fk_tercero' => $_POST['nombre_tercero'],
                'valor' => $_POST['valor'],
                'anticipo' => $_POST['anticipo'],
                'factura' => $rutaFactura
            ];

            $respuesta = ModelSolicitud::insertarEgreso($datos);
            if ($respuesta == "ok") {
                echo json_encode(["status" => "success"]); // Éxito
            } else {
                echo json_encode(["status" => "error", "message" => "Error al insertar el egreso"]); // Error
            }
        }

    public function getSolicitudEgresos($id_solicitud) {
        $modelo = new ModelSolicitud();
        $solicitud = $modelo->obtenerSolicitudEgresos($id_solicitud);
        echo json_encode($solicitud);
    }

    public function getContarSociedades() {
        $modelo = new ModelSolicitud();
        $sociedades = $modelo->contarSociedades();
    
        echo json_encode(["total" => $sociedades["total"]]); // Acceder correctamente a la clave "total"
    }

    public function guardarSociedad($datos) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //echo "hola";

            $datos = array(
                "nombre" => $_POST["nombre"],
                "apellido" => $_POST["apellido"],
                "fecha_nacimiento" => $_POST["fechaNacimiento"],
                "estado_civil" => $_POST["estadoCivil"],
                "pais_origen" => $_POST["paisOrigen"],
                "pais_residencia_fiscal" => $_POST["paisResidenciaFiscal"],
                "pais_domicilio" => $_POST["paisDomicilio"],
                "numero_pasaporte" => $_POST["numeroPasaporte"],
                "pais_pasaporte" => $_POST["paisPasaporte"],
                "tipo_visa" => $_POST["tipoVisa"],
                "direccion_local" => $_POST["direccionLocal"],
                "telefonos" => $_POST["telefonos"],
                "emails" => $_POST["emails"],
                "industria" => $_POST["industria"],
                "nombre_negocio_local" => $_POST["nombreNegocioLocal"],
                "ubicacion_negocio_principal" => $_POST["ubicacionNegocioPrincipal"],
                "tamano_negocio" => $_POST["tamanoNegocio"],
                "contacto_ejecutivo_local" => $_POST["contactoEjecutivoLocal"],
                "numero_empleados" => $_POST["numeroEmpleados"] == '' ? 0 : $_POST["numeroEmpleados"],
                "numero_hijos" => $_POST["numeroHijos"] == '' ? 0 : $_POST["numeroHijos"],
                "razon_consultoria" => $_POST["razonConsultoria"],
                "requiere_registro_corporacion" => $_POST["requiereRegistroCorporacion"],                
                "observaciones" => $_POST["observaciones"],
                "ciudad" => $_POST["ciudad"],
                "id_solicitud" => 189, //$_POST["id_solicitud"]
                "numero_solicitud" => $_POST["numeroSolicitud"]
            );
    
            $respuesta = ModelSolicitud::mdlInsertarPersonaCliente($datos);
            header('Content-Type: application/json');
            if ($respuesta == "ok") {
                echo json_encode(["status" => "ok"]);
            } else {
                echo json_encode(["status" => "error", "message" => $respuesta]);
            }
        }
    }

}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $controlador = new Solicitud_controller();

    // Verificamos si se recibe 'accion'
    if (isset($_POST['accion'])) {
        if ($_POST['accion'] === 'guardarSolicitud') {
            $controlador->insertarSolicitud();
        } elseif ($_POST['accion'] === 'insertarRevision') {
            $controlador->insertarRevision();
        } elseif ($_POST['accion'] === 'insertarFactura') {
            $controlador->insertarFactura();
        } elseif ($_POST['accion'] === 'insertarFacturaRapida') {
            $controlador->insertarFacturaRapida();
        } elseif ($_POST['accion'] === 'insertarServiciosAdicionales') {
            $controlador->insertarServiciosAdicionales();
        } elseif ($_POST['accion'] === 'guardarCliente') {
            $controlador->insertarDatosAdicionales();
        } elseif ($_POST['accion'] === 'ActualizarServicio') {
            $controlador->actualizarServicioJson();
        }elseif ($_POST['accion'] === 'ActualizarServicioFactura') {
            $controlador->actualizarServiciosFactura();
        }elseif ($_POST['accion'] == 'downloadFacturas') {          
            $controlador->facturasDownload($_POST['id_solicitud']);
        }elseif ($_POST['accion'] == 'downloadFacturasRapidas') {
            $controlador->facturasRapidasDownload();
        }elseif($_POST['accion'] == 'crearSociedad') {
            $controlador->crearSociedad();
        }elseif($_POST['accion'] == 'actualizarSociedad'){
            $controlador->actualizarSociedad();
        }elseif($_POST['accion'] == 'insertarEgreso') {
            $controlador->insertarEgreso();
        }elseif ($_POST['accion'] === 'guardarSociedad') {
            $controlador->guardarSociedad($_POST);
        }elseif ($_POST['accion'] === 'obtenerSolicitud') {
            $idSolicitud = $_POST['id_solicitud'];
            $solicitud = $controlador->getSolicitudEgresos($idSolicitud);
        }elseif ($_POST['accion'] === 'contarPersonasSociedad') {
            header('Content-Type: application/json');

            $idSolicitudUUID = $_POST['id_solicitud'];
            $modelo = new ModelSolicitud();
            $resultado = $modelo->contarPersonasPorSolicitud($idSolicitudUUID);

            echo json_encode($resultado); // ✅ ahora se envía el objeto completo (cant_personas + uuid)
        }
        else {
            echo json_encode(['status' => 'error', 'message' => 'Acción no válida']);
        }

    // Verificamos si se recibe 'action'
    } elseif (isset($_POST['action'])) {
        if ($_POST['action'] === 'listarServicios') {
            $controlador->getServiciosOfrecidos();
        }elseif ($_POST['action'] == 'contarServicios') {
            $controlador->getContarSociedades();
        }
        else {
            echo json_encode(['status' => 'error', 'message' => 'Acción no válida']);
        }
    }

    
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['accion']) && $_GET['accion'] === 'obtenerSociedadesSelect') {
        $idSolicitud = isset($_GET['idSolicitud']) ? $_GET['idSolicitud'] : null;
        $controller = new Solicitud_controller();
        $controller->obtenerDescripciones($idSolicitud);
    }

}


?>