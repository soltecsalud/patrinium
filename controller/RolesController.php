<?php
include_once "../model/RolesModelo.php";
include_once "../model/permisosModelo.php";
include_once "../model/modelMenus.php";
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

    static public function ctrlConsultarPermisosYMenusRol($rol){
        if (!$rol) { // Verificamos si el rol está definido
            echo json_encode([]);
            exit;
        }

        // Consultamos los permisos asignados al rol
        $permisosRol = RolesModelo::mdlConsultarPermisosRolId($rol);
        $idsAsignados = array_column($permisosRol, 'id_permiso'); // Extraemos los IDs de los permisos asignados
        
        $menusYSubmenus = ModelMenus::mdlConsultarMenusYSubmenusAgrupados(); // Consultamos los menús y submenús agrupados

        foreach ($menusYSubmenus as &$menu) { // Iteramos sobre cada menú
            foreach ($menu['submenus'] as &$submenu) { // Iteramos sobre cada submenú del menú
                $submenu['activo'] = in_array($submenu['id_submenu'], $idsAsignados); // Verificamos si el submenú está activo según los permisos asignados
            }
        }

        // Retornamos los datos en formato JSON
        header('Content-Type: application/json');
        echo json_encode($menusYSubmenus); // Retornamos los menús y submenús con su estado de permisos
        exit;

    }
    
    static public function ctrlEditarPermisosRol(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_rol   = $_POST['rol'] ?? null;
            $permisos = $_POST['permisos'] ?? [];

            if (!$id_rol) {
                echo json_encode(['status' => 'error', 'message' => 'Rol no especificado.']);
                exit;
            } 

            try { 
                RolesModelo::mdlEliminarPermisos($id_rol); // Eliminamos los permisos existentes del rol
                foreach ($permisos as $permiso) { // Iteramos sobre los permisos seleccionados
                    if (empty($permiso)) {
                        continue; // Si el permiso está vacío, lo saltamos
                    }
                    RolesModelo::mdlRegistrarPermisoRol($id_rol, $permiso); // Registramos los nuevos permisos
                }
                echo json_encode(['status' => 'success', 'message' => 'Permisos actualizados correctamente.']);
            } catch (\Throwable $th) {
                // Manejo de errores
                echo json_encode(['status' => 'error', 'message' => 'Error al actualizar los permisos: ' . $th->getMessage()]);
            }

        }else{
            echo json_encode(['status' => 'error', 'message' => 'Método no permitido.']);
        }
    }

}

if($_REQUEST['accion'] == 'consultarPermisosRol') { // Verificamos si la acción es consultar permisos de un rol
    $rol = $_GET['id_rol'] ?? null; // Obtener el rol desde la solicitud POST
    // Llamamos al método para consultar los permisos de un rol
    RolesController::ctrlConsultarPermisosYMenusRol($rol);
}else if($_REQUEST['accion'] == 'editarPermisosRol') { // Verificamos si la acción es editar permisos de un rol
    // Llamamos al método para editar los permisos de un rol
    RolesController::ctrlEditarPermisosRol();
}