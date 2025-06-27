<?php

require_once "conexion.php";

class ModelMenus
{
    /*==================================================
    MODELO para consultar los menus de la base de datos
    ====================================================*/
    static public function mdlConsultarMenus()
    {
        try {
            $sql = "SELECT * FROM menus ORDER BY orden ASC";
            $consulta = Conexion::conectar()->prepare($sql);
            $consulta->execute();

            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /*===========================================================
    MODELO para consultar los datos de un menu a traves de su id
    =============================================================*/
    static public function mdlConsultarDatosMenuId($id_menu)
    {
        try {
            $sql = "SELECT * FROM menus WHERE id = :id ORDER BY orden ASC";
            $consulta = Conexion::conectar()->prepare($sql);
            $consulta->bindParam(':id', $id_menu, PDO::PARAM_STR);
            $consulta->execute();

            return $consulta->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public static function mdlConsultarSubmenusPorMenu($id_menu)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM submenus WHERE id_menu = :id_menu ORDER BY orden ASC");
        $stmt->bindParam(':id_menu', $id_menu, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function mdlConsultarMenusYSubmenus()
    {
        $sql = "SELECT 
                    m.id AS id_menu, m.nombre AS nombre_menu, m.icono AS icono_menu, m.color as color_menu,
                    s.id_submenu, s.nombre AS nombre_submenu, s.icono AS icono_submenu, s.ruta AS ruta_submenu, s.permiso_relacionado
                FROM menus m
                INNER JOIN submenus s ON m.id = s.id_menu
                ORDER BY m.orden ASC, s.orden ASC";

        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function mdlConsultarMenusYSubmenusAgrupados()
    {
        try {
            $sql = "SELECT 
                    m.id AS menu_id,
                    m.nombre AS menu_nombre,
                    m.icono AS menu_icono,
                    -- m.orden AS menu_orden,
                    s.id_submenu,
                    s.nombre AS submenu_nombre,
                    s.ruta
                FROM menus m
                INNER JOIN submenus s ON s.id_menu = m.id
                ORDER BY m.orden ASC, s.orden ASC";

            $stmt = Conexion::conectar()->prepare($sql);
            $stmt->execute();
            $filas = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Agrupar menús y submenús
            $agrupado = [];

            foreach ($filas as $fila) {
                $menuId = $fila['menu_id'];

                // Si el menú aún no ha sido agregado
                if (!isset($agrupado[$menuId])) {
                    $agrupado[$menuId] = [
                        'id' => $menuId,
                        'nombre' => $fila['menu_nombre'],
                        'icono'  => $fila['menu_icono'],
                        'submenus' => []
                    ];
                }

                // Si existe un submenú válido, agregarlo
                if (!empty($fila['id_submenu'])) {
                    $agrupado[$menuId]['submenus'][] = [
                        'id_submenu' => $fila['id_submenu'],
                        'nombre'     => $fila['submenu_nombre'],
                        'ruta'       => $fila['ruta']
                    ];
                }
            }

            // Reindexar el array (pasar de clave `id_menu` a índices numéricos)
            return array_values($agrupado);
        } catch (Exception $e) {
            die("Error al consultar menús y submenús agrupados: " . $e->getMessage());
        }
    }

    /*===========================================================
    MODELO para registrar un menu
    =============================================================*/
    static public function mdlRegistrarMenu($datos){
        try {
            $sql = "INSERT INTO menus (nombre, icono, color) VALUES (:nombre, :icono, :color)";
            $consulta = Conexion::conectar()->prepare($sql);
            $consulta->bindParam(':nombre', $datos['nombre'], PDO::PARAM_STR);
            $consulta->bindParam(':icono', $datos['icono'], PDO::PARAM_STR);
            $consulta->bindParam(':color', $datos['color'], PDO::PARAM_STR);

            return $consulta->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /*==================================================
    MODELO para consultar los Submenus de la base de datos
    ====================================================*/
    static public function mdlConsultarSubmenus()
    {
        try {
            $sql = "SELECT * FROM submenus ORDER BY orden,fecha_creacion ASC";
            $consulta = Conexion::conectar()->prepare($sql);
            $consulta->execute();

            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    static public function mdlConsultarOrdenMaximoSubmenu($id_menu){
        try {
            $sql = "SELECT MAX(orden) AS max_orden FROM submenus WHERE id_menu = :id_menu";
            $consulta = Conexion::conectar()->prepare($sql);
            $consulta->bindParam(':id_menu', $id_menu, PDO::PARAM_STR);
            $consulta->execute();

            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
            return $resultado['max_orden'] ? (int)$resultado['max_orden'] : null; // Retorna null si no hay submenús
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /*===========================================================
    MODELO para registrar un submenu
    =============================================================*/
    static public function mdlRegistrarSubMenu($datos){
        try {
            $sql = "INSERT INTO submenus (id_menu, nombre, icono, ruta, permiso_relacionado, orden) 
                    VALUES (:id_menu, :nombre, :icono, :ruta, :permiso_relacionado , :orden)";
            $consulta = Conexion::conectar()->prepare($sql);
            $consulta->bindParam(':id_menu', $datos['id_menu'], PDO::PARAM_INT);
            $consulta->bindParam(':nombre', $datos['nombre'], PDO::PARAM_STR);
            $consulta->bindParam(':icono', $datos['icono'], PDO::PARAM_STR);
            $consulta->bindParam(':ruta', $datos['ruta'], PDO::PARAM_STR);
            $consulta->bindParam(':permiso_relacionado', $datos['permiso_relacionado'], PDO::PARAM_STR);
            $consulta->bindParam(':orden', $datos['orden'], PDO::PARAM_INT);

            return $consulta->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // ===========================================================
    // METODO para consultar si un menu ya tiene el mismo numero de orden
    static public function mdlConsultarMenuPorOrden($orden,$id_menu)
    {
        try {
            $sql = "SELECT * FROM menus WHERE orden = :orden AND id != :id_menu";
            $consulta = Conexion::conectar()->prepare($sql);
            $consulta->bindParam(':orden', $orden, PDO::PARAM_INT);
            $consulta->bindParam(':id_menu', $id_menu, PDO::PARAM_STR);
            $consulta->execute();

            return $consulta->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /*===========================================================
    MODELO para editar un menu
    =============================================================*/
    static public function mdlEditarMenu($datos){
        try {
            $sql = "UPDATE menus 
                    SET nombre = :nombre, icono = :icono, color = :color, orden = :orden 
                    WHERE id = :id_menu";
            $consulta = Conexion::conectar()->prepare($sql);
            $consulta->bindParam(':id_menu', $datos['id_menu'], PDO::PARAM_STR);
            $consulta->bindParam(':nombre', $datos['nombre'], PDO::PARAM_STR);
            $consulta->bindParam(':icono', $datos['icono'], PDO::PARAM_STR);
            $consulta->bindParam(':color', $datos['color'], PDO::PARAM_STR);
            $consulta->bindParam(':orden', $datos['orden'], PDO::PARAM_INT);

            return $consulta->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // ===========================================================
    // METODO para eliminar un menu
    // ===========================================================
    static public function mdlEliminarMenu($id_menu)
    {
        try {
            $sql = "DELETE FROM menus WHERE id = :id_menu";
            $consulta = Conexion::conectar()->prepare($sql); 
            $consulta->bindParam(':id_menu', $id_menu, PDO::PARAM_STR);
            return $consulta->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /*===========================================================
    MODELO para editar un submenu
    =============================================================*/
    static public function mdlEditarSubMenu($datos){
        try {
            $sql = "UPDATE submenus 
                    SET nombre = :nombre, icono = :icono, ruta = :ruta, id_menu = :menu_padre 
                    WHERE id_submenu = :id_submenu";
            $consulta = Conexion::conectar()->prepare($sql);
            $consulta->bindParam(':id_submenu', $datos['id_submenu'], PDO::PARAM_STR);
            $consulta->bindParam(':nombre', $datos['nombre'], PDO::PARAM_STR);
            $consulta->bindParam(':icono', $datos['icono'], PDO::PARAM_STR);
            $consulta->bindParam(':ruta', $datos['ruta'], PDO::PARAM_STR);
            $consulta->bindParam(':menu_padre', $datos['menu_padre'], PDO::PARAM_INT);

            return $consulta->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


}
