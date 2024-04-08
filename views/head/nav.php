<nav class="main-header navbar navbar-expand navbar-dark navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="dropdown user user-menu">
        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
          <img src="imgs/us.png" class="user-image">
          <span class="hidden-xs"><?php echo  $_SESSION['name_user']; ?></span>
        </a>
        <ul class="dropdown-menu">
          <li class="user-body">
            <div class="float-right">
              <a href="../controller/usuarioController.php?cerrarSesion" class="btn btn-default btn-flat">Salir</a>
            </div>
          </li>
        </ul>
      </li>
    </ul>

  </nav>