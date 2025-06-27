<?php

include_once "../model/modelMenus.php";

class MenusController
{
    /*============================================================
    METODO Para Obtener el listado de todos los menús y submenús registrados
    ==============================================================*/
    static public function ctrlCrearMenu(){
        // Verificar si se recibieron los datos necesarios
        if(isset($_POST['nombre']) && isset($_POST['icono']) && isset($_POST['color'])) {
            $datos = [
                'nombre' => $_POST['nombre'],
                'icono'  => $_POST['icono'],
                'color'  => $_POST['color'],
            ]; 

            // Llamar al modelo para registrar el menú
            $resultado = ModelMenus::mdlRegistrarMenu($datos);

            if($resultado) {
                echo json_encode(['status' => 'success', 'message' => 'Menú creado exitosamente.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error al crear el menú.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Datos incompletos.']);
        }
    }

    static public function ctrlCrearSubMenu(){
        // Verificar si se recibieron los datos necesarios
        if(isset($_POST['menu']) && isset($_POST['nombre_submenu']) && isset($_POST['icono']) && isset($_POST['ruta'])) {
            $datos = [
                'id_menu' => $_POST['menu'],
                'nombre'  => $_POST['nombre_submenu'],
                'icono'   => $_POST['icono'],
                'ruta'    => $_POST['ruta'],
                'permiso_relacionado' => strtolower(str_replace(' ', '_', $_POST['nombre_submenu'])) // Generar un permiso relacionado basado en el nombre del submenú
            ]; 

            // // Consultar si un submenú ya tiene el mismo permiso relacionado
            // $subMenuExistente = ModelMenus::mdlConsultarSubmenuPorPermiso($datos['permiso_relacionado'], $datos['id_menu']);
            // if($subMenuExistente) {
            //     echo json_encode(['status' => 'error', 'message' => 'Ya existe un submenú con ese permiso relacionado.']);
            //     return;
            // }

            // Consultar el número maximo de orden para el submenú
            $ordenMaximo = ModelMenus::mdlConsultarOrdenMaximoSubmenu($datos['id_menu']);
            //Agregar orden maximo al array de datos
            $datos['orden'] = $ordenMaximo ? $ordenMaximo + 1 : 1; // Asignar el orden máximo + 1 o 1 si no hay submenús
            
            // Llamar al modelo para registrar el submenú
            $resultado = ModelMenus::mdlRegistrarSubMenu($datos);

            if($resultado) {
                echo json_encode(['status' => 'success', 'message' => 'Submenú creado exitosamente.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error al crear el submenú.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Datos incompletos.']);
        }
    }

    static public function ctlEditarMenu() {
        try {

            // Verificar si se recibieron los datos necesarios
            if(isset($_POST['id_menu']) || isset($_POST['nombre']) || isset($_POST['icono']) || isset($_POST['color']) || isset($_POST['orden']) ) {
                $datos = [
                    'id_menu' => $_POST['id_menu'],
                    'nombre'  => $_POST['nombre'],
                    'icono'   => $_POST['icono'],
                    'color'   => $_POST['color'],
                    'orden'   => $_POST['orden']
                ];
                // Consultar si un menu ya tiene el mismo numero de orden
                $menuExistente = ModelMenus::mdlConsultarMenuPorOrden($datos['orden'], $datos['id_menu']);
                if($menuExistente) {
                    echo json_encode(['status' => 'error', 'message' => 'Ya existe un menú con ese número de orden.']);
                    return;
                }
                $resultado = ModelMenus::mdlEditarMenu($datos);
                if($resultado) {
                    echo json_encode(['status' => 'success', 'message' => 'Menu creado exitosamente.']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Error al actualizar el menu.']);
                }

            }else{
                echo json_encode(['status' => 'error', 'message' => 'Datos incompletos.']);
            }
        } catch (Exception $e) {
            die("Error al editar el menú: " . $e->getMessage());
        }
    }

    static public function ctlEliminarMenu() {
        try {
            // Verificar si se recibió el ID del menú a eliminar
            if(isset($_POST['id_menu'])) {
                $id_menu = $_POST['id_menu'];
                // Llamar al modelo para eliminar el menú
                $resultado = ModelMenus::mdlEliminarMenu($id_menu);
                if($resultado) {
                    echo json_encode(['status' => 'success', 'message' => 'Menu eliminado exitosamente.']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Error al eliminar el menu.']);
                }
            } else { 
                echo json_encode(['status' => 'error', 'message' => 'Menu no especificado.']);
            }
        } catch (Exception $e) {
            die("Error al eliminar el menú: " . $e->getMessage());
        }
    }

    static public function ctlEditarSubMenu() {
        try {
            // Verificar si se recibieron los datos necesarios
            if(isset($_POST['id_submenu']) || isset($_POST['nombre']) || isset($_POST['icono']) || isset($_POST['ruta']) || isset($_POST['menu_padre']) ) {
                $datos = [
                    'id_submenu' => $_POST['id_submenu'],
                    'nombre'     => $_POST['nombre'],
                    'icono'      => $_POST['icono'],
                    'ruta'       => $_POST['ruta'],
                    'menu_padre' => $_POST['menu_padre']
                ];
                // Consultar si un submenú ya tiene el mismo numero de orden
                // $submenuExistente = ModelMenus::mdlConsultarSubmenuPorOrden($datos['orden'], $datos['id_submenu']);
                // if($submenuExistente) {
                //     echo json_encode(['status' => 'error', 'message' => 'Ya existe un submenú con ese número de orden.']);
                //     return;
                // }
                $resultado = ModelMenus::mdlEditarSubMenu($datos);
                if($resultado) {
                    echo json_encode(['status' => 'success', 'message' => 'Submenu actualizado exitosamente.']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Error al actualizar el submenu.']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Datos incompletos.']);
            }
        } catch (Exception $e) {
            die("Error al editar el submenu: " . $e->getMessage());
        }
    }

}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['accion'])) {
    if($_POST['accion'] === 'registrarMenu'){
        // Llamar al método para crear un menú
        MenusController::ctrlCrearMenu();
    }else if ($_POST['accion'] === 'registrarSubmenu'){
        MenusController::ctrlCrearSubMenu();
    }else if ($_POST['accion']=== 'editarMenu'){
        MenusController::ctlEditarMenu();
    }else if($_POST['accion']==='eliminarMenu'){
        MenusController::ctlEliminarMenu();
    }else if($_POST['accion']==='editarSubmenu'){
        MenusController::ctlEditarSubMenu();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Acción no reconocida.']);
    }
}

if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['accion'])) {
    if($_GET['accion'] === 'consultarSubmenus'){
        // Llamar al método para consultar los submenús
        $submenus = ModelMenus::mdlConsultarSubmenus();
        echo json_encode($submenus);
    } else if ($_GET['accion'] === 'consultarMenus') {
        // Llamar al método para consultar los menús
        $menus = ModelMenus::mdlConsultarMenus();
        echo json_encode($menus);
    }
        // Llamar al método
}

?>