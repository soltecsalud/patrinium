

          <nav class="main-header navbar navbar-expand navbar-dark navbar-light"  id="menuHorizontal">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <div>
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                    </div>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fas fa-bell"  style='font-size: 24px;'></i>
                        <span class="badge badge-warning navbar-badge" id='newCases' style='padding: 4px; top: 0; right: 0; '></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right">
                        <span class="dropdown-header" id="menuNotificacion"></span>
                        <div class="dropdown-divider"></div>
                        <span id="infoCasos">
                        </span>
                        <a href="#" class="dropdown-item dropdown-footer" onclick='location.reload()') >Ver todos los casos</a>
                    </div>
                </li>
                <li class="user user-menu">
                    <button class="switch" id="switch">
                        <span><i class="fas fa-sun"></i></span>
                        <span><i class="fas fa-moon"></i></span>
                    </button>
                </li>
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <img src="../views/img/usuarios/default/anonymous.png" class="user-image">
                        <span class="hidden-xs"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <li class="user-body">
                            <div class="float-right">
                                <a href="../index.php" class="btn btn-default btn-flat">Salir</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
