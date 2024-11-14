<?php
if (!isset($_SESSION['usuario'])) {
  header('Location: ../../index.php');
  exit();
}
?>
<div class="wrapper">
<aside class="main-sidebar sidebar-dark-primary elevation-4" id="menuVertical" style="top: -57px;">
  <!-- Brand Logo -->
  <a href="./home.php" class="brand-link" style="text-decoration: none;">
    <img src="../resource/AdminLTE-3.2.0/dist/img/logo1.jpg"  alt="Por ti mujer Logo" class="brand-image"  width="80" height="80"  style="opacity: .8">
    <span class="brand-text font-weight-light" >Patrimonium</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Menu desplegable  -->
        <li class="nav-item">
            <a href="#" class="nav-link active">
            <i class="nav-icon fas fa-clipboard"></i>
              <p>
                Solicitudes
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./crearPersona.php" class="nav-link">
                  <i class="nav-icon fas fa-tasks"></i>
                  <p>Crear Persona</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./registrarSolicitud.php" class="nav-link">
                  <i class="nav-icon fas fa-clipboard"></i>
                  <p>Registrar Solicitud</p>
                </a>
              </li>
             
              <li class="nav-item">
                <a href="./listado_solicitudes.php" class="nav-link">
                <i class="fa fa-list" aria-hidden="true"></i>
                  <p>Listado de Solicitudes</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./ver_solicitud_adjuntos.php" class="nav-link">
                <i class="fa fa-list" aria-hidden="true"></i>
                  <p>Respuestas Solicitudes</p>
                </a>
              </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link active">
            <i class="nav-icon fas fa-users"></i>
              <p>
              BOI
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./revisar_socios_boi.php" class="nav-link">
                  <i class="nav-icon fas fa-clipboard"></i>
                  <p>Revisar Socios</p>
                </a>
              </li>       
            </ul>

           
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link active">
            <i class="nav-icon fas fa-users"></i>
              <p>
                Facturacion
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./factura.php" class="nav-link">
                  <i class="nav-icon fas fa-clipboard"></i>
                  <p>Facturas</p>
                </a>
              </li>       
            </ul>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./facturasPagadas.php" class="nav-link">
                  <i class="nav-icon fas fa-clipboard"></i>
                  <p>Facturas Pagadas</p>
                </a>
              </li>       
            </ul>
        </li>
          <li class="nav-item">
            <a href="#" class="nav-link active">
           <i class="fas fa-share-square"></i>

              <p>
                Generar Reportes
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
            
              <li class="nav-item">
                <a href="./reportes_editables.php" class="nav-link">
                <i class="fa fa-clipboard" aria-hidden="true"></i>
                  <p>Informes Sociedades</p>
                </a>
              </li>
            
            </ul>
            <ul class="nav nav-treeview">
            
            <li class="nav-item">
              <a href="./reporte_terceros.php" class="nav-link">
              <i class="fa fa-clipboard" aria-hidden="true"></i>
                <p>Reporte Terceros</p>
              </a>
            </li>
          
          </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-clipboard"></i>
              <p>
                Crear Generales
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./bancos_consignaciones.php" class="nav-link">
                  <i class="nav-icon fas fa-clipboard"></i>
                  <p>Bancos Consiganciones</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./servicios_patrinium.php" class="nav-link">
                <i class="fa fa-list" aria-hidden="true"></i>
                  <p>Servicios</p>
                </a>
              </li> <li class="nav-item">
                <a href="./tipo_pagos.php" class="nav-link">
                <i class="fa fa-list" aria-hidden="true"></i>
                  <p>Tipo Pagos</p>
                </a>
              </li>
              </li> <li class="nav-item">
                <a href="./tipo_documentos_adjuntos.php" class="nav-link">
                <i class="fa fa-list" aria-hidden="true"></i>
                  <p>Tipo Documentos Adjuntos</p>
                </a>
              </li>
              </li> <li class="nav-item">
                <a href="./crear_tercero.php" class="nav-link">
                <i class="fa fa-list" aria-hidden="true"></i>
                  <p>Terceros</p>
                </a>
              </li>
             
            </ul>
          </li>       
          <li class="nav-item">
            <a href="./agenda.php" class="nav-link active">
            <i class="fa fa-calendar" aria-hidden="true"></i>
              <p>Agenda
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
           
     
     

              <li class="nav-item">
                <a href="./prueba_pdf_editable.php class="nav-link">
                <i class="nav-icon fas fa-clipboard"></i>
                  <p>Consultar Agenda</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="prueba_pdf_editable.php" class="nav-link">
                <i class="nav-icon fas fa-file-alt"></i>
                  <p>Informe Agenda</p>
                </a>
              </li>
            </ul>
          </li>
       



        
          <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>
                Informes
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
           
        
        

              <li class="nav-item">
                <a href="indicadores.php" class="nav-link">
                  <i class="nav-icon fas fa-tasks"></i>
                  <p>Indicadores </p>
                </a>
              </li>
            </ul>
          </li>
       



        <?php if (isset($_SESSION['configuracion']) && $_SESSION['configuracion'] == 1) { ?>
          <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-gear"></i>
              <p>
                Configuracion General
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./crear_usuario.php" class="nav-link nav-link-a" data-target="#usuario-tab">
                  <i class="nav-icon fas fa-user-plus"></i>
                  <p>Crear Usuario</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./consultar_usuarios.php" class="nav-link">
                  <i class="nav-icon fas fa-list"></i>
                  <p>Lista de Usuarios</p>
                </a>
              </li>

            </ul>
          </li>
        <?php } ?>



       
          <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fa fa-shield"></i>
              <p>
                Seguridad
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./listaRoles.php" class="nav-link">
                  <i class="nav-icon fas fa-tasks"></i>
                  <p>Roles</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./listaPermisos.php" class="nav-link">
                  <i class="fas fa-lock"></i>
                  <p>Permisos</p>
                </a>
              </li>
        

           </ul>
          </li>
     

        <!--  LOGOUT -->
        <li class="nav-item">
        <li class="nav-item">
          <a href="#" class="nav-link">
            <!-- <i class="nav-icon fas fa-clipboard"></i> -->
            <i class="fas fa-sign-out-alt"></i>
            <!-- <i class="nav-icon fas fa-book-heart"></i> -->
            <p>Cerrar Sesion</p>
          </a>
        </li>
        </li>
        <!-- /LOGOUT -->

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
</div>