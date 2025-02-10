<?php
session_start();
include_once "../controller/RolesController.php";
include_once "../controller/permisosController.php";
$Rol = RolesController::ctrlConsultarDatosRolId($_GET['id']);
$permisos = PermisosController::ctrlConsultarListaPermisos();
$permisosRol = RolesController::ctrlConsultarPermisosRol($Rol['id']);
if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
    exit();
} elseif (isset($_SESSION['usuario']) && $_SESSION['seguridad'] === false) {
    echo 'Acesso no autorizado.';
    exit(); 
}
?>
<!DOCTYPE html> 
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roles</title>
    <?php include_once "head/head_views.php"; ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="css/estilos generales.css">
</head>

<body>
<div class="content-wrapper">
<section class="content">
      <div class="container-fluid pt-3">
    <div class="card_form">
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title">Permisos del Rol <strong><?php echo $Rol['rol']; ?></strong></h3>
                <div class="card-tools">
                </div>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <input type="hidden" name="id_rol" value="<?php echo $Rol['id'];?>">
                    <div class="row">
                        <?php 
                            foreach ($permisos as $permiso) {
                        ?>
                            <div class="col-md-4 col-sm-6 col-12">
                                <div class="form-check-inline">
                                    <div class="custom-control custom-switch">
                                        <input name="permiso[]" type="checkbox" class="custom-control-input" id="customSwitch<?php echo $permiso['id']; ?>" value="<?php echo $permiso['id']; ?>" <?php echo in_array($permiso['id'],$permisosRol) ? 'checked' : ''; ?>>
                                        <label class="custom-control-label" for="customSwitch<?php echo $permiso['id']; ?>"></label>
                                    </div>
                                    <label style="margin: 0 20px 0 0;"><?php echo ucfirst($permiso['nombre']); ?></label>
                                </div>
                            </div>
                        <?php
                            }
                        ?>
                        <div class="col-12 text-center botones-acciones">
                            <button type="submit" class="btn btn-success mt-4 mr-5 pr-5 pl-5">Agregar</button>
                            <a href="./listaRoles.php" class="btn btn-primary mt-4 pr-5 pl-5">Cancelar</a>
                        </div>
                    </div>
                </form>
                <?php
                $editarPermisos = RolesController::ctrlEdiarPermisosRol();
                ?>
            </div>
        </div>
    </div>
      </div>
</section>
</div>
    <?php include_once "footer/footer_views.php"; ?>



</body>

</html>