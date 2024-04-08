<?php
include_once "../model/RolesModelo.php";
include_once "../model/permisosModelo.php";
include_once "../classes/Random/random.php";

class RolesController
{
    /*============================================================
	METODO Para Obtener el listado de todos los roles registrados
	==============================================================*/
    static public function ctrlConsultarRoles()
    {
        try {
            // Obtienes el listado de roles de la base de datos
            return RolesModelo::mdlConsultarRoles();    
        } catch (Exception $e) {
            // Manejo de errores
            echo "Error: " . $e->getMessage();
            return []; // Retorna un array vacío en caso de error
        }
    }

    /*============================================================
	METODO Para consultar los datos de un rol a traves de su id
	==============================================================*/
    static public function ctrlConsultarDatosRolId($id_rol)
    {
        // Consultamos los datos de un rol a traves del id del rol
        $rol = RolesModelo::mdlConsultarDatosRolId($id_rol);
        // retornamos el array para consultarlo en la vista
        return $rol;
    }

    /*===============================================================================
	METODO Para consultar los permisos asigandos a cada uno de los roles registrados
	=================================================================================*/   
    static public function ctrlListarPermisosRoles()
    {
        try {
            $roles =  RolesModelo::mdlConsultarRoles(); 
            // Obtienes el listado de roles de la base de datos
            $data = [];
            foreach ($roles as $rol) {
                $permisos = PermisosModelo::mdlConsultarPermisos();

                $permisosRol = RolesModelo::mdlConsultarPermisosRol($rol['id']);
                $asignados =[]; 
                foreach ($permisosRol as $row) {
                    array_push($asignados, $row['id_permiso']);
                }

                $fila = [
                    'Acciones'    => $rol['id'],
                    'Rol' => ucfirst($rol['rol']), 
                ];
                foreach ($permisos as $permiso) {
                        $nombre = ucfirst($permiso['nombre']);
                        $valor = in_array($permiso['id'], $asignados)? true: false;
                        $fila[$nombre] = $valor;
                }
                array_push($data, $fila);

            } 
            return $data;  
        } catch (Exception $e) {
            // Manejo de errores
            echo "Error: " . $e->getMessage();
            return []; // Retorna un array vacío en caso de error
        }
    }

    /*============================================================================================
	METODO Para consultar los permisos asigandos a uno de los roles registrados a traves de su id
	==============================================================================================*/
    static public function ctrlConsultarPermisosRol($id_rol)
    {
        $permisosRol = RolesModelo::mdlConsultarPermisosRol($id_rol);
        $data =[]; 
        foreach ($permisosRol as $row) {
            array_push($data, $row['id_permiso']);
        }

        // retornamos el array para consultarlo en la vista
        return $data;
    }

    /*==================================================
	METODO Para editar los permisos asignados a un rol
	====================================================*/
    static public function ctrlEdiarPermisosRol()
    {
        if (
            isset($_POST['permiso']) &&
            isset($_POST['id_rol']) 
        ) {
            $id_rol = $_POST['id_rol'];
            $permisos = $_POST['permiso'];

            RolesModelo::mdlEliminarPermisos($id_rol);
            foreach($permisos AS $permiso){
                $registro = RolesModelo::mdlRegistrarPermisoRol($id_rol, $permiso);
            }
            if ($registro) {
                echo '<script language="javascript">swal("Actualizacion Exitosa", "Los permisos fueron actualizado correctamente.", "success");</script>';
                echo '<meta http-equiv="refresh" content="1;url=../views/listaRoles.php">';
                // Registro exitoso, redirigir o mostrar mensaje de éxito
            } else {
                // Ocurrió un error en el registro, mostrar mensaje de error o redirigir
                echo '<script language="javascript">swal("Error al Actualizar", "El rol no pudo ser actualizado.", "error");</script>';
            }
        }
    }

}
