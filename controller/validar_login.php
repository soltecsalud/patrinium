<?php
include_once("model/modelLogin.php");
include_once "model/RolesModelo.php";
include_once "model/permisosModelo.php";

/* Establecemos que las paginas no pueden ser cacheadas */
/* header("Expires: Tue, 01 Jul 2001 06:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); */

if (isset($_POST['usuarioLogin']) && isset($_POST['contrasenaLogin'])) {
    $usuario = $_POST['usuarioLogin'];
    $contrasena = $_POST['contrasenaLogin'];

    // Intentamos traer los datos del usuario a Logear
    $verificarLogin = ModelLogin::mdlValidarLogin($usuario);
    // Validamos de que $verificarLogin tenga datos
    if (!empty($verificarLogin)) {
        // Comparamos las contraseñas
        if (password_verify($contrasena, $verificarLogin[0]->password)) {

            /* Suponiendo que $miRol, $miUser, $miPassword, y $idUser son propiedades de la primera fila de $verificarLogin */
            $miRol = $verificarLogin[0]->rol;
            $miUser = $verificarLogin[0]->usuario;
            $idUser = $verificarLogin[0]->id_usuario;

            // Almacenar información del usuario en variables de sesión
            $_SESSION['usuario'] = $miUser;
            $_SESSION['name_user'] = $verificarLogin[0]->primer_nombre . ' ' . $verificarLogin[0]->primer_apellido;
            $_SESSION['rol'] = $miRol;
            $_SESSION['id_usuario'] = $idUser;
            $permisosRol = RolesModelo::mdlConsultarPermisosNombreRol($miRol);
            $asignados = [];
            foreach ($permisosRol as $row) {
                array_push($asignados, $row['id_permiso']);
            }

            // print_r($asignados); exit;
            
            $permisos = PermisosModelo::mdlConsultarPermisos();

            // Se inicializa el array de permisos en la sesión
            $_SESSION['permisos'] = []; // Inicializar el array de permisos

            foreach ($permisos as $permiso) {
                $clave = $permiso['permiso_relacionado'];
                if(!empty($clave)) {    
                    $_SESSION['permisos'][$clave] = in_array($permiso['id_submenu'], $asignados); // Asignar el permiso como true o false
                }
            }

            // print_r($_SESSION['permisos']); exit;

            echo '<script language="javascript">swal("Bienvenido", "Bienvenido ' . $usuario . '", "success");</script>';

            if ($miRol == "Root" or $miRol == "Administrador" or $miRol == "Auxiliar de Toma" or $miRol == "Digitador" or $miRol == "Verificacion" or $miRol == "Citologos" or $miRol == "Patologos" or $miRol == "Bacteriologos") {

                echo '<meta http-equiv="refresh" content="1;url=./views/home.php">';
            } else {
                echo '<meta http-equiv="refresh" content="2;url=./index.php">';
            }
        } else {
            echo '<script language="javascript">swal("Error", "La contraseña es incorrecta.", "error");</script>';
            echo '<meta http-equiv="refresh" content="2;url=./index.php">';
        }
    } else {
        echo '<script language="javascript">swal("Error", "La contraseña es incorrecta.", "error");</script>';
        echo '<meta http-equiv="refresh" content="2;url=./index.php">';
        // La autenticación falló
    }
}
