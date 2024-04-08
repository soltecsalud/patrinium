<?php
session_start();

if(!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once "head/head_views.php"; ?>
    <link rel="stylesheet" href="css/menu.css">
    <title>Ruta de Atenci&oacute;n C&aacute;ncer de Cuello Uterino</title>
    <style>
        .tab-nav {
            background-color: #F8F9FA;
            color: #332D3D;
        }

        .tab-nav:hover {
            background-color: #DAE0E5;
            color: #332D3D;
        }

        .navbar-light .navbar-nav .show>.nav-link,
        .navbar-light .navbar-nav .nav-link.active {
            background-color: #d1d1d1;
            color: rgba(0, 0, 0, 0.9);
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">

    <?php include_once "head/nav.php"; ?>

    <?php include_once "menu/menu_views.php";
    ?>
    <div class="content-wrapper iframe-mode" data-widget="iframe" data-loading-screen="750">
        <div class="nav navbar navbar-expand-lg navbar-white navbar-light border-bottom p-0">
            <a class="nav-link tab-nav" href="#" data-widget="iframe-close"><i class="fa fa-times" aria-hidden="true"></i></a>
            <a class="nav-link bg-light" href="#" data-widget="iframe-scrollleft"><i class="fas fa-angle-double-left"></i></a>
            <ul class="navbar-nav" role="tablist"></ul>
            <a class="nav-link bg-light" href="#" data-widget="iframe-scrollright"><i class="fas fa-angle-double-right"></i></a>
        </div>
        <div class="tab-content">
            <!-- <div class="tab-pane fade active show" id="panel-index" role="tabpanel" aria-labelledby="tab-index"><iframe src="./registrarCaso.php" style="height: 671px;"></iframe></div> -->
            <div class="tab-empty">
                <h2 class="display-4">No tab selected!</h2>
            </div>
            <div class="tab-loading">
                <div>
                    <h2 class="display-4">Tab is loading <i class="fa fa-sync fa-spin"></i></h2>
                </div>
            </div>
        </div>
    </div>
    <?php include_once "footer/footer_views.php"; ?>

</body>

</html>