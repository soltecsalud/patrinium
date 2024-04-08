<?php
include_once "../model/modeloUsuario.php";
include_once "../classes/Random/random.php";

if(isset($_GET['cerrarSesion'])){
    UsuarioController::ctrlCerrarSesion();
}

if(isset($_GET['deleteUsuario'])){
    UsuarioController::ctrlDeleteUsuario($_GET['deleteUsuario']);
}

class UsuarioController
{
    static public function ctrlRegistrarUsuario()
    {
        // Verificamos que los campos necesarios estén presentes en el formulario
        if (
            isset($_POST['identificacion']) &&
            isset($_POST['usuario']) &&
            isset($_POST['password']) &&
            isset($_POST['tipo_doc']) &&
            isset($_POST['primer_nombre']) &&
            isset($_POST['primer_apellido']) &&
            isset($_POST['correo']) &&
            isset($_POST['telefono']) &&
            isset($_POST['id_sede']) &&
            isset($_POST['id_especialidad']) &&
            isset($_POST['id_servicio']) &&
            isset($_POST['rol']) &&
            isset($_POST['id_eps'])
        ) {

            // Se genera el id de tipo uuuidV4
            $id = Random::generateUuidV4();

            $estado = "activo";
            $fechaRegistro = date("Y-m-d");

            $usuario = $_SESSION['usuario'];


            // Creamos un array con los datos del usuario
            $datos = array(
                'id' => $id,
                'identificacion' => $_POST['identificacion'],
                'usuario' => $_POST['usuario'],
                'password' => $_POST['password'],
                'tipo_doc' => $_POST['tipo_doc'],
                'primer_nombre' => ucfirst($_POST['primer_nombre']),
                'segundo_nombre' => ucfirst($_POST['segundo_nombre']) ?? null,
                'primer_apellido' => ucfirst($_POST['primer_apellido']),
                'segundo_apellido' => ucfirst($_POST['segundo_apellido']) ?? null,
                'correo' => $_POST['correo'],
                'telefono' => $_POST['telefono'],
                'id_sede' => $_POST['id_sede'],
                'id_especialidad' => $_POST['id_especialidad'],
                'id_servicio' => $_POST['id_servicio'],
                'rol' => $_POST['rol'],
                'id_eps' => $_POST['id_eps'],
                'estado' => $estado,
                'fecha_creacion' => $fechaRegistro,
                'usuario_add' => $usuario
            );

            // Encriptamos la contraseña llegada en el formulario
            $datos['password'] = password_hash($datos['password'], PASSWORD_DEFAULT);

            //Validamos si ya existe la identificacion
            if (Usuarios::existeIdentificacion($_POST['identificacion'])) {
                echo '<script language="javascript">swal("Error al registrar", "Error al registrar, la identificacion ya existe.", "error");</script>';
                $response = array('status' => 'error', 'message' => 'Error al registrar, la identificacion ya existe.');
                echo json_encode($response);
                exit; // Redirigir o mostrar un mensaje apropiado
            } else {
                //Validamos si ya existe el usuario
                if (Usuarios::existeUsuario($_POST['usuario'])) {
                    echo '<script language="javascript">swal("Error al registrar", "Error al registrar, el usuario ya existe.", "error");</script>';
                    exit; // Redirigir o mostrar un mensaje apropiado
                } else {
                    //Validamos si ya existe el correo
                    if (Usuarios::existeCorreo($_POST['correo'])) {
                        echo '<script language="javascript">swal("Error al registrar", "Error al registrar, este correo ya existe", "error");</script>';
                        exit; // Redirigir o mostrar un mensaje apropiado
                    } else {
                        //Validamos si ya existe el telefono
                        if (Usuarios::existeTelefono($_POST['telefono'])) {
                            echo '<script language="javascript">swal("Error al registrar", "Error al registrar, el telefono ya existe", "error");</script>';
                            exit; // Redirigir o mostrar un mensaje apropiado
                        } else {
                            try {
                                // Una vez validado los datos continuamos con la consulta para insertar
                                // Intentamos registrar al usuario una vez validado lo anterior
                                $resultadoRegistro = Usuarios::registrarUsuario($datos);

                                // Validamos que metodo registrarUsuario devuelva True
                                if ($resultadoRegistro == 1) {
                                    echo '<script language="javascript">swal("Registro Exitoso", "Usuario registrado con exito.", "success");</script>';
                                    echo '<meta http-equiv="refresh" content="2;url=../views/crear_usuario.php">';
                                    // Registro exitoso, redirigir o mostrar mensaje de éxito
                                } else {
                                    echo '<script language="javascript">swal("Error al registrar", "Ocurrio un error al registrar el usuario", "error");</script>';
                                    echo '<meta http-equiv="refresh" content="2;url=../views/crear_usuario.php">';
                                    // Registro exitoso, redirigir o mostrar mensaje de éxito                                    
                                }
                            } catch (PDOException $e) {
                                // Capturamos y manejamos la excepción de la base de datos
                                echo "Error en la base de datos: " . $e->getMessage();
                            }
                        }
                    }
                }
            }
        }
    }

    static public function ctrlConsultarUsuarios()
    {
        return Usuarios::consultarUsuarios();
    }

    static public function ctrlConsultarUsuarioId($id_usuario)
    {
        return Usuarios::consultarUsuarioId($id_usuario);
    }

    static public function ctrlEditarUsuario()
    {
            // Validamos que los campos no vengan vacios 
            if (
                isset($_POST['identificacion']) &&
                isset($_POST['usuario']) &&
                isset($_POST['tipo_doc']) &&
                isset($_POST['primer_nombre']) &&
                isset($_POST['primer_apellido']) &&
                isset($_POST['correo']) &&
                isset($_POST['telefono']) &&
                isset($_POST['id_sede']) &&
                isset($_POST['id_especialidad']) &&
                isset($_POST['id_servicio']) &&
                isset($_POST['rol']) &&
                isset($_POST['id_eps'])
            ) {

                // // Creamos un array con los datos del usuario
                $datosUsuario = array(
                    'id_usuario' => $_POST['id_usuario'],
                    'identificacion' => $_POST['identificacion'],
                    'usuario' => $_POST['usuario'],
                    'tipo_doc' => $_POST['tipo_doc'],
                    'primer_nombre' => $_POST['primer_nombre'],
                    'segundo_nombre' => $_POST['segundo_nombre'] ?? null,
                    'primer_apellido' => $_POST['primer_apellido'],
                    'segundo_apellido' => $_POST['segundo_apellido'] ?? null,
                    'correo' => $_POST['correo'],
                    'telefono' => $_POST['telefono'],
                    'id_sede' => $_POST['id_sede'],
                    'id_especialidad' => $_POST['id_especialidad'],
                    'id_servicio' => $_POST['id_servicio'],
                    'rol' => $_POST['rol'],
                    'id_eps' => $_POST['id_eps']
                );

                // Enviamos la informacion recogida de los campos al modelo para ejecutar la consulta
                $editarInformacion = Usuarios::editarUsuario($datosUsuario);

                // Validamos que el metodo editarUsuario devuelva un true (Los datos se actualizaron)
                if ($editarInformacion) {
                    echo '<script language="javascript">swal("Registro Exitoso", "El usuario '.$_POST['usuario'].' fue actualizado satisfactoriamente.", "success");</script>';
                    // Registro exitoso, redirigir o mostrar mensaje de éxito
                } else {
                    // Ocurrió un error en el registro, mostrar mensaje de error o redirigir
                    echo "Error en el registro.";
                }
            }
    }

    static public function ctrlEditarClave()
    {
            // Validamos que los campos no vengan vacios 
            if (
                isset($_POST['id_usuario']) &&
                isset($_POST['password']) &&
                isset($_POST['confirm_password'])
            ) {

                // // Creamos un array con los datos del usuario
                $datosUsuario = array(
                    'id_usuario' => $_POST['id_usuario'],
                    'clave' => $_POST['password'],
                    'confirmarClave' => $_POST['confirm_password']
                );

                if($datosUsuario['clave'] === $datosUsuario['confirmarClave']){

                     // Encriptamos la contraseña llegada en el formulario
                    $datosUsuario['password'] = password_hash($datosUsuario['confirmarClave'], PASSWORD_DEFAULT);
                     // Enviamos la informacion recogida de los campos al modelo para ejecutar la consulta
                    $editarClave = Usuarios::editarClave($datosUsuario);
                     // Validamos que el metodo editarUsuario devuelva un true (Los datos se actualizaron)
                    if ($editarClave) {
                        echo '<script language="javascript">swal("Registro Exitoso", "La clave fue actualizada correctamente.", "success");</script>';
                        // Registro exitoso, redirigir o mostrar mensaje de éxito
                    } else {
                        // Ocurrió un error en el registro, mostrar mensaje de error o redirigir
                        echo "Error en el registro.";
                    }
                }
                else {
                    echo '<script language="javascript">swal("Error al cambiar la clave", "Las claves no coinciden.", "error");</script>';
                }       
            }
    }

    static public function ctrlCerrarSesion(){
        session_start();
        session_destroy();
        echo '<meta http-equiv="refresh" content="0;url=../index.php">';
    }

    static public function ctrlDeleteUsuario($id_usuario){
        session_start();
        Usuarios::eliminarUsuario($id_usuario);
        echo "Éxito";
    }
    

}

