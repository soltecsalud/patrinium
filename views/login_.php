<!DOCTYPE html>
<html lang="es">
<head>
    <title>Login</title>
    <link rel="stylesheet" href="path/to/AdminLTE-3.2.0/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="path/to/AdminLTE-3.2.0/plugins/bootstrap/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="path/to/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="path/to/AdminLTE-3.2.0/plugins/select2/js/select2.full.min.js"></script>
    <!-- Otros scripts y estilos -->
</head>
<body class="hold-transition sidebar-collapse">
    <!-- Contenido de la página -->
    <section class="vh-75">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 px-0 d-none d-sm-block">
                    <img src="views/imgs/logo1.png" alt="Login image" class="w-100 vh-100" style="object-fit: cover; object-position: right;">
                </div>
                <div class="col-sm-6 text-black" style="background:#f6f7fc;">
                    <div class="px-5 ms-xl-4">
                        <i class="fas fa-crow fa-2x me-3 pt-5 mt-xl-4" style="color: #ffffff;"></i>
                        <span class="h4 fw-bold mb-0" style="color:#020381;margin:-70px">Patrimonium APP</span>
                    </div>
                    <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">
                        <form style="width: 23rem;" action="" method="post">
                            <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Inicia Sesi&oacute;n</h3>
                            <div class="form-outline mb-4">
                                <input type="text" id="usuarioLogin" name="usuarioLogin" class="form-control form-control-lg" />
                                <label class="form-label" for="usuarioLogin">Usuario</label>
                            </div>
                            <div class="form-outline mb-4">
                                <input type="password" id="contrasenaLogin" name="contrasenaLogin" class="form-control form-control-lg" />
                                <label class="form-label" for="contrasenaLogin">Contrase&ntilde;a</label>
                            </div>
                            <div class="pt-1 mb-4">
                                <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
                            </div>
                            <p class="small mb-5 pb-lg-2"><a class="text-muted" href="#!">Olvid&oacute; su contrase&ntilde;a?</a></p>
                            <!-- <p>Don't have an account? <a href="#!" class="link-info">Register here</a></p> -->
                        </form>
                        <?php
                        include_once "controller/validar_login.php";
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
