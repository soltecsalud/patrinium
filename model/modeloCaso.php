<?php

require_once "conexion.php";

class CasoModelo
{

     /*==================================================
	MODELO para consultar los datos del caso para mostrarlos en el dataTable
	=================================================*/

    static public function mdlConsultarCaso()
    {
        try {
            $sql = "SELECT 
                        caso.*, 
                        paciente.tipo_doc, 
                        paciente.num_documento, 
                        paciente.nombres, 
                        paciente.apellido, 
                        paciente.eps,
                        eps.nombre_eps,
                        ips.nombre_ips     
                    FROM inicio_casos AS caso 
                    INNER JOIN pacientes AS paciente ON caso.id_paciente = paciente.id 
                    INNER JOIN eps AS eps ON paciente.eps::int = eps.id_eps 
                    INNER JOIN ips AS ips ON caso.ips::int = ips.id_ips 
                    WHERE caso.estado = 'Registrado';";
            $consulta = Conexion::conectar()->prepare($sql);
            $consulta->execute();

            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    static public function mdlConsultarListaCasosSeguimientos()
    {
        try {
            $sql = "SELECT 
                        caso.*, 
                        paciente.tipo_doc, 
                        paciente.num_documento, 
                        paciente.nombres, 
                        paciente.apellido, 
                        paciente.eps,
                        eps.nombre_eps,
                        ips.nombre_ips     
                    FROM inicio_casos AS caso 
                    INNER JOIN pacientes AS paciente ON caso.id_paciente = paciente.id 
                    INNER JOIN eps AS eps ON paciente.eps::int = eps.id_eps 
                    INNER JOIN ips AS ips ON caso.ips::int = ips.id_ips;";
            $consulta = Conexion::conectar()->prepare($sql);
            $consulta->execute();

            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    static public function mdlConsultarCasoSeguimiento($idCaso)
    {
        try {
            $sql = "SELECT 
                        id,
                        COALESCE(
                            num_orden_citologia, 
                            num_orden_vph) AS num_orden,
                        motivo_consulta    
                    FROM inicio_casos 
                    WHERE id = :id_caso;";
            $consulta = Conexion::conectar()->prepare($sql);

            $consulta->bindParam(":id_caso", $idCaso, PDO::PARAM_STR);
            $consulta->execute();

            return $consulta->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    static public function mdlConsultarCasoEntregaResultadosCitologia()
    {
        try {
            $sql = "SELECT 
                        caso.id,
                        caso.consecutivo,
                        paciente.num_documento, 
                        paciente.nombres, 
                        paciente.apellido    
                    FROM inicio_casos AS caso 
                    INNER JOIN pacientes AS paciente ON caso.id_paciente = paciente.id WHERE caso.tecnica_tamizage = 'Citología convencional';";
            $consulta = Conexion::conectar()->prepare($sql);
            $consulta->execute();

            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    
    static public function mdlConsultarCasoEntregaResultadosVPH()
    {
        try {
            $sql = "SELECT 
                        caso.id,
                        caso.consecutivo,
                        paciente.num_documento, 
                        paciente.nombres, 
                        paciente.apellido    
                    FROM inicio_casos AS caso 
                    INNER JOIN pacientes AS paciente ON caso.id_paciente = paciente.id WHERE caso.tecnica_tamizage = 'ADN VPH';";
            $consulta = Conexion::conectar()->prepare($sql);
            $consulta->execute();

            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // Consultar los datos del paciente despues de escoger el caso (tipo de tamizage)
    static public function mdlConsultarDatosPaciente($idCaso)
    {
        try {
            $sql = "SELECT 
                        paciente.num_documento, 
                        paciente.nombres, 
                        paciente.apellido,
                        caso.tecnica_tamizage    
                    FROM inicio_casos AS caso 
                    INNER JOIN pacientes AS paciente ON caso.id_paciente = paciente.id 
                    WHERE caso.id = :idCaso;";
            $consulta = Conexion::conectar()->prepare($sql);
            $consulta->bindParam(":idCaso", $idCaso, PDO::PARAM_INT);
            $consulta->execute();

            return $consulta->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


    static public function mdlActualizarInfoInicialCaso($datosCaso)
    {
        try {
            $sql = "UPDATE inicio_casos SET ips = :ips, ese = :esered, motivo_consulta = :motivoConsulta, tecnica_tamizage = :tec_tamizage, fecha_recepcion = :f_recepcion, usuario_recepcion = :userRecepcion, fecha_toma = :fechaToma, usuario_toma = :userToma, update_at = :update_at, update_by = :update_by WHERE id = :id";
            $consulta = Conexion::conectar()->prepare($sql);

            $update_at = date("Y-m-d H:i:s");
            $update_by = $_SESSION['usuario'];
            $consulta->bindParam(':id', $datosCaso['id'], PDO::PARAM_STR);
            $consulta->bindParam(':ips', $datosCaso['ipsToma'], PDO::PARAM_STR);
            $consulta->bindParam(':esered', $datosCaso['eseRed'], PDO::PARAM_STR);
            $consulta->bindParam(':motivoConsulta', $datosCaso['motivoConsulta'], PDO::PARAM_STR);
            $consulta->bindParam(':fechaToma', $datosCaso['fechaToma'], PDO::PARAM_STR);
            $consulta->bindParam(':f_recepcion', $datosCaso['fechaRecepcion'], PDO::PARAM_STR);
            $consulta->bindParam(':userToma', $datosCaso['usuarioToma'], PDO::PARAM_STR);
            $consulta->bindParam(':userRecepcion', $datosCaso['usuarioRecepcion'], PDO::PARAM_STR);
            $consulta->bindParam(':tec_tamizage', $datosCaso['tecnicaTamizage'], PDO::PARAM_STR);
            $consulta->bindParam(':update_at', $update_at, PDO::PARAM_STR);
            $consulta->bindParam(':update_by', $update_by, PDO::PARAM_STR);

            $consulta->execute();

            return $consulta;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


    static public function mdlActualizarHallazgosProcedimiento($datos)
    {
        try {
            $sql = "UPDATE hallazgos_procedimientos SET anular_caso = :anularCaso, motivo_anulacion = :mot_anulacion, sel_aspecto_cuello = :asp_cuello, aspecto_cuello = :asp_cuello_txt, observaciones = :ob_procedimiento, update_at = :update_at, update_by = :update_by WHERE id = :id";
            $consulta = Conexion::conectar()->prepare($sql);

            $update_at = date("Y-m-d H:i:s");
            $update_by = $_SESSION['usuario'];
            $consulta->bindParam(':id', $datos['id'], PDO::PARAM_STR);
            $consulta->bindParam(':anularCaso', $datos['anularCaso'], PDO::PARAM_STR);
            $consulta->bindParam(':mot_anulacion', $datos['motivoAnulacion'], PDO::PARAM_STR);
            $consulta->bindParam(':asp_cuello', $datos['aspectoCuello'], PDO::PARAM_STR);
            $consulta->bindParam(':ob_procedimiento', $datos['observacionesProcedimiento'], PDO::PARAM_STR);
            $consulta->bindParam(':asp_cuello_txt', $datos['aspectoCuelloTxt'], PDO::PARAM_STR);
            $consulta->bindParam(':update_at', $update_at, PDO::PARAM_STR);
            $consulta->bindParam(':update_by', $update_by, PDO::PARAM_STR);

            $consulta->execute();

            return $consulta->rowCount(); // Retorna el número de filas afectadas por el UPDATE
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }



    /*==================================================================
	MODELO para registrar los hallazgos del procedimiento del paciente
	=====================================================================*/

    static public function mdlRegistrarHallazgosProcedimiento($datos)
    {
        try {
            $sql = "INSERT 
                        INTO hallazgos_procedimientos 
                            (id, anular_caso, motivo_anulacion, aspecto_cuello, detalle_aspecto_cuello, observaciones, fecha_registro, add_usuario) 
                        VALUES 
                            (:id, :anularCaso, :mot_anulacion, :asp_cuello, :asp_cuello_txt, :ob_procedimiento, :create_at, :create_by) RETURNING id";
            $consulta = Conexion::conectar()->prepare($sql);

            $create_at = date("Y-m-d H:i:s");
            $create_by = $_SESSION['usuario'];
            $aspectoCuello = $datos['aspectoCuello']!=null? "{". implode(",", $datos['aspectoCuello']) ."}": null;
            // Convertir el array a una cadena que PostgreSQL pueda entender
            $consulta->bindParam(':id', $datos['id'], PDO::PARAM_STR);
            $consulta->bindParam(':anularCaso', $datos['anularCaso'], PDO::PARAM_STR);
            $consulta->bindParam(':mot_anulacion', $datos['motivoAnulacion'], PDO::PARAM_STR);
            $consulta->bindParam(':asp_cuello', $aspectoCuello, PDO::PARAM_STR);
            $consulta->bindParam(':ob_procedimiento', $datos['observacionesProcedimiento'], PDO::PARAM_STR);
            $consulta->bindParam(':asp_cuello_txt', $datos['aspectoCuelloTxt'], PDO::PARAM_STR);
            $consulta->bindParam(':create_at', $create_at);
            $consulta->bindParam(':create_by', $create_by, PDO::PARAM_STR);

            $consulta->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /*====================================================
	MODELO para registrar la informacion inical del caso
	======================================================*/

    static public function mdlRegistrarInfoInicialCaso($datosCaso)
    {
        try {
            $sql = "INSERT INTO inicio_casos (id, ips, id_paciente, id_antecedente, id_gestacion, id_hallazgo, ese, motivo_consulta, tecnica_tamizage, fecha_recepcion, usuario_recepcion, fecha_toma, usuario_toma, estado, fecha_registro, add_usuario) VALUES (:id, :ips, :id_paciente, :id_antecedente, :id_gestacion, :id_hallazgo, :esered, :motivoConsulta, :tec_tamizage, :f_recepcion, :userRecepcion, :fechaToma, :userToma, :estado, :f_registro, :add_user) RETURNING id";
            $consulta = Conexion::conectar()->prepare($sql);

            $fecha_registro = date('Y-m-d h:i:s');
            $add_usuario = $_SESSION['usuario'];
            $estado = 'Registrado';
            $consulta->bindParam(':id', $datosCaso['id'], PDO::PARAM_STR);
            $consulta->bindParam(':ips', $datosCaso['ips'], PDO::PARAM_STR);
            $consulta->bindParam(':id_paciente', $datosCaso['id_paciente'], PDO::PARAM_STR);
            $consulta->bindParam(':id_antecedente', $datosCaso['id_antecedente'], PDO::PARAM_STR);
            $consulta->bindParam(':id_gestacion', $datosCaso['id_gestacion'], PDO::PARAM_STR);
            $consulta->bindParam(':id_hallazgo', $datosCaso['id_hallazgo'], PDO::PARAM_STR);
            $consulta->bindParam(':esered', $datosCaso['eseRed'], PDO::PARAM_STR);
            $consulta->bindParam(':motivoConsulta', $datosCaso['motivoConsulta'], PDO::PARAM_STR);
            $consulta->bindParam(':fechaToma', $datosCaso['fechaToma'], PDO::PARAM_STR);
            $consulta->bindParam(':f_recepcion', $datosCaso['fechaRecepcion'], PDO::PARAM_STR);
            $consulta->bindParam(':userToma', $datosCaso['usuarioToma'], PDO::PARAM_STR);
            $consulta->bindParam(':userRecepcion', $datosCaso['usuarioRecepcion'], PDO::PARAM_STR);
            $consulta->bindParam(':tec_tamizage', $datosCaso['tecnicaTamizage'], PDO::PARAM_STR);
            $consulta->bindParam(':estado', $estado, PDO::PARAM_STR);
            $consulta->bindParam(':f_registro', $fecha_registro);
            $consulta->bindParam(':add_user', $add_usuario, PDO::PARAM_STR);

            $consulta->execute();

            $result = $consulta->fetch(PDO::FETCH_ASSOC);
            // Busco la matriz con el id de la ultima fila insertada
            return $result['id'];
            // retornamos el id del registro ingresado

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }




    /*=============================================
	MODELO para consultar todos los datos del caso
	=============================================*/

    static public function mdlConsultarCasoId($id_caso)
    {
        try {
            $sql = "SELECT 
                        caso.id AS id_caso, 
                        caso.tecnica_tamizage, 
                        caso.consecutivo, 
                        caso.ips, 
                        caso.ese, 
                        caso.fecha_recepcion, 
                        caso.motivo_consulta, 
                        caso.fecha_toma, 
                        caso.usuario_toma, 
                        caso.usuario_recepcion, 
                        paciente.id AS id_paciente, 
                        paciente.tipo_doc, 
                        paciente.num_documento, 
                        paciente.nombres, 
                        paciente.apellido, 
                        paciente.genero, 
                        paciente.eps, 
                        paciente.f_nacimiento, 
                        paciente.regimen, 
                        paciente.edad, 
                        paciente.tel_fijo, 
                        paciente.tel_celular, 
                        paciente.correo, 
                        paciente.departamento, 
                        paciente.mun_residencia, 
                        paciente.barrio, 
                        paciente.comuna, 
                        paciente.direccion, 
                        antec.id AS id_antecedente, 
                        antec.last_menstruacion, 
                        antec.first_rel_sexual, 
                        antec.compañeros_sexuales, 
                        antec.metodo_planificacion, 
                        antec.esquema, 
                        antec.last_citologia, 
                        antec.vacuna_papiloma, 
                        antec.dosis_papiloma, 
                        antec.tratamientos_previos, 
                        antec.tamizacion, 
                        antec.first_menstruacion, 
                        antec.num_com_sexuales_ult_ano, 
                        antec.enfermedades_trasm_sex, 
                        antec.resul_last_citologia, 
                        gesta.id AS id_gestacion, 
                        gesta.embarazos_previos, 
                        gesta.first_embarazo, 
                        gesta.last_embarazo, 
                        gesta.cesareas, 
                        gesta.morfinatos, 
                        gesta.estado_gestacion, 
                        gesta.num_partos, 
                        gesta.abortos, 
                        gesta.num_embarazos, 
                        hallaz.id AS id_hallazgo, 
                        hallaz.anular_caso, 
                        hallaz.motivo_anulacion, 
                        hallaz.sel_aspecto_cuello, 
                        hallaz.aspecto_cuello, 
                        hallaz.observaciones, 
                        ips.nombre_ips, 
                        eps.nombre_eps, 
                        depa.state, 
                        ciu.city 
                    FROM inicio_casos AS caso 
                    INNER JOIN pacientes AS paciente ON caso.id_paciente = paciente.id 
                    INNER JOIN antecedentes AS antec ON caso.id_antecedente = antec.id 
                    INNER JOIN gestacion AS gesta ON caso.id_gestacion = gesta.id 
                    INNER JOIN hallazgos_procedimientos AS hallaz ON caso.id_hallazgo = hallaz.id 
                    INNER JOIN ips AS ips ON caso.ips::int = ips.id_ips 
                    INNER JOIN eps AS eps ON paciente.eps::int = eps.id_eps 
                    INNER JOIN departamentos AS depa ON paciente.departamento::int = depa.id 
                    INNER JOIN ciudades AS ciu ON paciente.mun_residencia::int = ciu.id 
                    WHERE caso.id = :id;";
            $consulta = Conexion::conectar()->prepare($sql);
            $consulta->bindParam(':id', $id_caso, PDO::PARAM_STR);
            $consulta->execute();

            return $consulta->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    static public function mdlConsultarInfoCaso($id_caso)
    {
        try {
            $sql = "SELECT * 
                    FROM inicio_casos
                    WHERE id = :id;";
            $consulta = Conexion::conectar()->prepare($sql);
            $consulta->bindParam(':id', $id_caso, PDO::PARAM_STR);
            $consulta->execute();

            return $consulta->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    static public function mdlActualizarPeticionVPH($id, $peticionVPH)
    {
        try {
            $sql = "UPDATE inicio_casos
                    SET num_peticion_vph = :peticion_vph,
                        update_at = :update_at, 
                        update_by = :update_by 
                    WHERE id = :id";
            $consulta = Conexion::conectar()->prepare($sql);

            $update_at = date("Y-m-d H:i:s");
            $update_by = $_SESSION['usuario'];
            $consulta->bindParam(':id', $id, PDO::PARAM_STR);
            $consulta->bindParam(':peticion_vph', $peticionVPH, PDO::PARAM_STR);
            $consulta->bindParam(':update_at', $update_at, PDO::PARAM_STR);
            $consulta->bindParam(':update_by', $update_by, PDO::PARAM_STR);

            $consulta->execute();

            return $consulta->rowCount(); // Retorna el número de filas afectadas por el UPDATE
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    static public function mdlActualizarPeticionCitologia($id, $peticionCito)
    {
        try {
            $sql = "UPDATE inicio_casos
                    SET num_peticion_citologia = :peticion_cito,
                        update_at = :update_at, 
                        update_by = :update_by 
                    WHERE id = :id";
            $consulta = Conexion::conectar()->prepare($sql);

            $update_at = date("Y-m-d H:i:s");
            $update_by = $_SESSION['usuario'];
            $consulta->bindParam(':id', $id, PDO::PARAM_STR);
            $consulta->bindParam(':peticion_cito', $peticionCito, PDO::PARAM_STR);
            $consulta->bindParam(':update_at', $update_at, PDO::PARAM_STR);
            $consulta->bindParam(':update_by', $update_by, PDO::PARAM_STR);

            $consulta->execute();

            return $consulta->rowCount(); // Retorna el número de filas afectadas por el UPDATE
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /*==========================================================
	MODELO para consultar los casos segun el numero de remision
	============================================================*/

    static public function mdlConsultarCasosRemision($id_remision)
    {
        try {
            $sql = "SELECT  inicio_casos.*, 
                            pacientes.num_documento, 
                            pacientes.nombres, 
                            pacientes.apellido, 
                            pacientes.f_nacimiento, 
                            pacientes.edad,
                            eps.nombre_eps as eps
                    FROM inicio_casos
                    JOIN pacientes ON inicio_casos.id_paciente = pacientes.id
                    -- JOIN eps ON pacientes.eps = eps.id_eps	
                    left JOIN eps ON pacientes.eps::int  = eps.id_eps
                    WHERE inicio_casos.id_remision = :id_remision";
            $consulta = Conexion::conectar()->prepare($sql);
            $consulta->bindParam(':id_remision', $id_remision, PDO::PARAM_INT);
            $consulta->execute();

            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }




}
