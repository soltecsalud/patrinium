<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
    exit();
}
include_once "../controller/plantillaController.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once "head/head_views.php"; ?>
    <title>Subir Plantilla</title>
</head>
<body>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Subir Nueva Plantilla</h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="card card-dark shadow-lg">
                    <div class="card-header">
                        <h3 class="card-title">Carga de Plantilla</h3>
                    </div>
                    <div class="card-body">
                        <form action="../controller/upPlantillasController.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="nombre">Nombre de la Plantilla</label>
                                <input type="text" name="nombre" class="form-control" id="nombre" required>
                            </div>
                            <div class="form-group">
                                <label for="archivo">Seleccionar Archivo</label>
                                <input type="file" name="archivo" class="form-control-file" id="archivo" required>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">Subir Plantilla</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <?php include_once "footer/footer_views.php"; ?>
</body>
</html>
