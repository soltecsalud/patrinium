<?php

include_once "../model/permisosModelo.php";
include_once "../classes/Random/random.php";

class PermisosController
{
    /*=========================================================
	METODO Para Obtener el listado de los permisos registrados
	===========================================================*/
    static public function ctrlConsultarListaPermisos()
    {
        try {
            return  PermisosModelo::mdlConsultarPermisos();
        } catch (Exception $e) {
            // Manejo de errores
            echo "Error: " . $e->getMessage();
            return []; // Retorna un array vacío en caso de error
        }
    }

    /*==============================================================================================
	METODO Para Obtener el listado de los permisos registrados retornando el nombre de los permisos
	================================================================================================*/
    static public function ctrlConsultarPermisos()
    {
        try {
            // Obtienes el listado de los permisos registrados
            $permisos =  PermisosModelo::mdlConsultarPermisos();
            $data = [];
            /* declaramos el array */
            foreach ($permisos as $row) {
                $id_permiso = $row['id'];
                /* capturamos el id del traslado */
                // href='editarPermiso.php?id=$id_permiso'
                $acciones    =  "<div class='btn-group'>
                                    <a href='#' class='btn btn btn-success'>
                                        <i class='fa fa-pencil-square-o' aria-hidden='true'></i>
                                    </a> 
                                </div>";

                $fila = [
                    "Acciones"      => $acciones,
                    "Permiso"       => ucfirst($row['nombre']),
                    "Creacion"      => $row['created_at']
                ];
                array_push($data, $fila);
            }
            return json_encode(
                $data
            );
        } catch (Exception $e) {
            // Manejo de errores
            echo "Error: " . $e->getMessage();
            return []; // Retorna un array vacío en caso de error
        }
    }

    /*=========================================================
	METODO Para registrar un permiso
	===========================================================*/
    static public function ctrlRegistrarPermiso()
    {
        if (isset($_POST['permiso'])) {
            // Se genera el id de tipo uuuidV4
            $id = Random::generateUuidV4();

            // Creamos un array con los datos del permiso
            $datos = array(
                'id'                    => $id,
                'permiso'               => $_POST['permiso'],
            );

            // Enviamos el array de datos al modelo para hacer el registro
            $registrarPermiso = PermisosModelo::mdlRegistrarPermiso($datos);

            // Validamos que metodo registrarUsuario devuelva True
            if ($registrarPermiso == 1) {
                echo '<script language="javascript">swal("Registro Exitoso", "El Permiso ha sido registrado correctamente.", "success");</script>';
                echo '<meta http-equiv="refresh" content="2;url=./listaPermisos.php">';
            } else {
                echo '<script language="javascript">swal("Error", "Error al registrar el permiso.", "error");</script>';
            }
        }
    }
}
