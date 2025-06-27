<?php
  if (!isset($_SESSION['usuario'])) {
    header('Location: ../../index.php');
    exit();
  }
  include_once "../model/modelMenus.php";
  $permisosUsuarios = $_SESSION['permisos'] ?? []; // Si no hay permisos, inicializar como array vacío
  $rawMenus = ModelMenus::mdlConsultarMenusYSubmenus(); // Obtener todos los menús y submenús

  // Agrupar los submenús por menú
  $menusAgrupados = [];

  foreach($rawMenus as $row){ // Recorremos los menús y submenús obtenidos
    $menuId =  $row['id_menu']; // Obtenemos el ID del menú

    if(!isset($menusAgrupados[$menuId])){ // Si el menú no está en el array, lo inicializamos
      $menusAgrupados[$menuId] = [ // Inicializamos el menú
        'id'       => $row['id_menu'],
        'nombre'   => $row['nombre_menu'],
        'icono'    => $row['icono_menu'],
        'color'    => $row['color_menu'],
        'submenus' => [] // Inicializamos el array de submenús
      ];
    }

    if(!empty($row['permiso_relacionado']) && !empty($permisosUsuarios[$row['permiso_relacionado']])){ // Verificamos si el submenú tiene un permiso relacionado y si el usuario tiene acceso a ese permiso
      $menusAgrupados[$menuId]['submenus'][] = [ // Agregamos el submenú al menú correspondiente
        'id'      => $row['id_submenu'],
        'nombre'  => $row['nombre_submenu'],
        'icono'   => $row['icono_submenu'],
        'ruta'    => $row['ruta_submenu']
      ];
    }

  }
  // print_r($menusAgrupados); // Para depurar y ver la estructura de los menús agrupados
?>

<div class="wrapper">

  <aside class="main-sidebar sidebar-dark-primary elevation-4" id="menuVertical" style="top: -57px;">
    <!-- Brand Logo -->
    <a href="./home.php" class="brand-link" style="text-decoration: none;">
      <img src="../resource/AdminLTE-3.2.0/dist/img/logo1.jpg" alt="Por ti mujer Logo" class="brand-image" width="80" height="80" style="opacity: .8">
      <span class="brand-text font-weight-light">Patrimonium </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu --> 
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Menu desplegable  -->
          <?php foreach ($menusAgrupados as $menu):?> <!-- Recorremos los menús agrupados -->
            <?php if (!empty($menu['submenus'])): ?> <!-- Verificamos si el menú tiene submenús -->
              <li class="nav-item <?= $menu['color'] ?>">
                <a href="#" class="nav-link active">
                  <i class="nav-icon <?= $menu['icono'] ?>"></i>
                  <p><?= $menu['nombre'] ?><i class="right fas fa-angle-left"></i></p>
                </a>
                <ul class="nav nav-treeview">
                  <?php foreach ($menu['submenus'] as $submenu): ?> <!-- Recorremos los submenús del menú -->
                    <li class="nav-item">
                      <a href="../controller/router.php?vista=<?= $submenu['ruta'].'.php' ?>" class="nav-link">
                        <i class="nav-icon fas <?= $submenu['icono'] ?>"></i>
                        <p><?= $submenu['nombre'] ?></p>
                      </a>
                    </li>
                  <?php endforeach; ?>
                </ul>
              </li>
            <?php endif; ?>
          <?php endforeach; ?>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
</div>