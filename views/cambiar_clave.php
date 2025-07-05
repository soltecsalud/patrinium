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
    <title>Editar Usuario</title>
    <?php include_once "../views/head/head_views.php"; ?>
    <link rel="stylesheet" href="css/estilos generales.css">
</head>

<body>
    <?php
    include_once "../controller/usuarioController.php";
    // Obtener el ID del usuario a editar
    $usuario_id = isset($_GET['id']) ? $_GET['id'] : null;

    // Obtener la información del usuario a editar
    $usuario = UsuarioController::ctrlConsultarUsuarioId($usuario_id);
    ?>

<div class="card card-dark" style="margin: 5% 15% 15% 15%;">
    <div class="card-header">
        <h3 class="card-title">Cambiar Contrase&ntilde;a <?php echo $usuario['usuario']; ?> </h3>
    </div>
    <div class="card-body">
        <form action="" method="post">
            <input type="hidden" name="id_usuario" value="<?php echo $usuario['id_usuario']; ?>">
            <div class="row">
                <div class="col-4">
                    <label for="">Nombre:</label>
                    <input type="text" value="<?php echo $usuario['primer_nombre'].' '.$usuario['segundo_nombre'].' '.$usuario['primer_apellido'].' '.$usuario['segundo_apellido']; ?>" readonly id="primer_nombre" name="primer_nombre" class="form-control">
                </div>
                <div class="col-4">
                    <label for="">Contrase&ntilde;a:</label>
                    <input type="password"  id="password" name="password" class="form-control" placeholder="Digite la Contrase&ntilde;a" required>
                </div>
                <div class="col-4">
                    <label for="">Confirmar Contrase&ntilde;aa:</label>
                    <input type="password"  id="confirm_password" name="confirm_password" class="form-control" placeholder="Confirme la Contrase&ntilde;a" required>
                </div>

            <div class="col-12 text-center">
                <button type="submit" class="btn btn-success mt-4 pr-5 pl-5">Actualizar Clave</button>
            </div>

        </form>
        <?php
            $editarClave = UsuarioController::ctrlEditarClave();
        ?>
    </div>
</div>    

    <?php include_once "../views/footer/footer_views.php"; ?>
</body>

</html>
