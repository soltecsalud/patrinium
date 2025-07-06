<?php
session_start();

if(!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
    exit();
} 
// elseif (isset($_SESSION['usuario']) && $_SESSION['configuracion'] === false){
//     echo 'Acesso no autorizado.';
//     exit();
// }

include_once "../controller/usuarioController.php";
// Obtener el ID del usuario a editar
$usuario_id = isset($_GET['id']) ? $_GET['id'] : null;

// Obtener la información del usuario a editar
$usuario = UsuarioController::ctrlConsultarUsuarioId($usuario_id);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <?php include_once "../views/head/head_views.php"; ?>
    <link rel="stylesheet" href="css/estilos generales.css">
    <link rel="stylesheet" href="css/estilosPersonalizadosSelect2.css">
</head>

<body>

<section class="content">
            <div class="container-fluid pt-3" >
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title">Actualizar Datos del Usuario</h3>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="row">
                                <div class="form-group col-md-3 col-sm-6 col-12">
                                    <label for="tipo_doc">Tipo de documento:</label>
                                    <select name="tipo_doc" class="form-control" id="tipo_doc" autofocus required>
                                        <option value="<?php echo $usuario['tipo_doc']; ?>" selected><?php echo $usuario['tipo_doc']; ?></option>
                                        <option value="Cédula de Ciudadanía">C&eacute;dula de Ciudadan&iacute;a</option>
                                        <option value="Tarjeta de Identidad">Tarjeta de Identidad</option>
                                        <option value="Pasaporte">Pasaporte</option>
                                        <option value="Cédula Extranjería">C&eacute;dula de Extranjer&iacute;a</option>
                                        <option value="Otro">Otro</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3 col-sm-6 col-12">
                                    <label for="identificacion">Identificaci&oacute;n:</label>
                                    <input type="text" id="identificacion" name="identificacion" class="form-control" value="<?php echo $usuario['identificacion']; ?>" readonly>
                                </div>
                                <div class="form-group col-md-3 col-sm-6 col-12">
                                    <label for="primer_nombre">Primer Nombre:</label>
                                    <input type="text" id="primer_nombre" name="primer_nombre" class="form-control" value="<?php echo $usuario['primer_nombre']; ?>" required>
                                </div>
                                <div class="form-group col-md-3 col-sm-6 col-12">
                                    <label for="segundo_nombre">Segundo Nombre:</label>
                                    <input type="text" id="segundo_nombre" name="segundo_nombre" class="form-control" value="<?php echo $usuario['segundo_nombre']; ?>">
                                </div>
                                <div class="form-group col-md-3 col-sm-6 col-12">
                                    <label for="primer_apellido">Primer Apellido:</label>
                                    <input type="text" id="primer_apellido" name="primer_apellido" class="form-control" value="<?php echo $usuario['primer_apellido']; ?>" required>
                                </div>
                                <div class="form-group col-md-3 col-sm-6 col-12">
                                    <label for="segundo_apellido">Segundo Apellido:</label>
                                    <input type="text" id="segundo_apellido" name="segundo_apellido" class="form-control" value="<?php echo $usuario['segundo_apellido']; ?>">
                                </div>
                                <div class="form-group col-md-3 col-sm-6 col-12">
                                    <label for="correo">Correo:</label>
                                    <input type="email" id="correo" name="correo" class="form-control" value="<?php echo $usuario['correo']; ?>" required>
                                </div>
                                <div class="form-group col-md-3 col-sm-6 col-12">
                                    <label for="telefono">Tel&eacute;fono de Contacto:</label>
                                    <input type="tel" id="telefono" name="telefono" class="form-control" value="<?php echo $usuario['telefono']; ?>" required pattern="[0-9]{10}">
                                </div>
                                <!-- <div class="form-group col-md-3 col-sm-6 col-12">
                                    <label for="eps">EPS a la que Pertenece:</label>
                                    <select name="id_eps" class="prueba custom-select" style="width: 100%;" id="eps" required>
                                        <option value="<?php echo $usuario['id_eps']; ?>" selected><?php echo $usuario['nombre_eps']; ?></option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3 col-sm-6 col-12">
                                    <label for="ips">IPS a la que Pertenece:</label>
                                    <select name="id_sede" class="prueba custom-select" style="width: 100%;" id="ips" required>
                                        <option value="<?php echo $usuario['id_sede']; ?>" selected><?php echo $usuario['nombre_ips']; ?></option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3 col-sm-6 col-12">
                                    <label for="eseRed">ESE a la que Pertenece:</label>
                                    <input type="text" id="eseRed" name="ese" class="form-control" readonly>
                                </div> -->
                                <!-- <div class="form-group col-md-3 col-sm-6 col-12">
                                    <label for="id_especialidad">Especialidad:</label>
                                    <select name="id_especialidad" class="prueba custom-select" style="width: 100%;" id="id_especialidad">
                                        <option value="<?php echo $usuario['id_especialidad']; ?>" selected><?php echo $usuario['id_especialidad']; ?></option>
                                        <option value="Auxiliar de Enfermería">Auxiliar de Enfermer&iacute;a</option>
                                        <option value="Médico General">M&eacute;dico General</option>
                                        <option value="Médico Especialista">M&eacute;dico Especialista</option>
                                        <option value="Bacteriólogo">Bacteri&oacute;logo</option>
                                        <option value="Patólogo">Pat&oacute;logo</option>
                                        <option value="Citólogo">Cit&oacute;logo</option>
                                        <option value="Colposcopista">Colposcopista</option>
                                    </select>
                                </div> -->
                                <div class="form-group col-md-3 col-sm-6 col-12">
                                    <label for="usuario">Usuario:</label>
                                    <input type="text" id="usuario" name="usuario" class="form-control" autocomplete="off" value="<?php echo $usuario['usuario']; ?>" required>
                                </div>
                                <div class="form-group col-md-3 col-sm-6 col-12">
                                    <label for="">Rol:</label>
                                    <select name="rol" class="prueba custom-select" style="width: 100%;" id="rol" required>
                                        <option value="<?php echo $usuario['rol']; ?>" selected><?php echo $usuario['rol']; ?></option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-success mt-4 pr-5 pl-5">Actualizar Usuario</button>
                            </div>

                        </form>
                        <?php
                            $editarUsuario = UsuarioController::ctrlEditarUsuario($usuario_id);
                        ?>
                    </div>
                </div>
            </div>
        </section>

        <?php include_once "footer/footer_views.php"; ?>
        <script src="../resource/AdminLTE-3.2.0/plugins/jquery-validation/jquery.validate.min.js"></script>
        <script src="../resource/AdminLTE-3.2.0/plugins/jquery-validation/additional-methods.min.js"></script>
        <!-- <script src="./js/SelectEPS.js"></script> -->
        <script src="./js/SelectUsuario.js"></script>
        <script src="js/select2.js"></script>
        <script src="./js/validacionFormularios.js"></script>  
</body>

</html>
