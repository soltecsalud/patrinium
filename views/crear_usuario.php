<?php
// session_start();
include_once "../controller/usuarioController.php";
if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
    exit();
} 
// elseif (isset($_SESSION['usuario']) && $_SESSION['configuracion'] === false) {
//     echo 'Acesso no autorizado.';
//     exit();
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Usuario</title>
    <?php include_once "../views/head/head_views.php"; ?>
    <link rel="stylesheet" href="css/estilos generales.css">
    <link rel="stylesheet" href="css/estilosPersonalizadosSelect2.css">
</head>

<body>
        <section class="content">
            <div class="container-fluid pt-3" >
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title">Registrar Usuario</h3>
                    </div>
                    <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="registrar" value="registrar">
                            <div class="row">
                                <div class="form-group col-md-3 col-sm-6 col-12">
                                    <label for="tipo_doc">Tipo de documento:</label>
                                    <select name="tipo_doc" class="form-control" id="tipo_doc" autofocus required>
                                        <option disabled selected>Selecciona el tipo de documento</option>
                                        <option value="Cédula de Ciudadanía">C&eacute;dula de Ciudadan&iacute;a</option>
                                        <option value="Tarjeta de Identidad">Tarjeta de Identidad</option>
                                        <option value="Pasaporte">Pasaporte</option>
                                        <option value="Cédula Extranjería">C&eacute;dula de Extranjer&iacute;a</option>
                                        <option value="Otro">Otro</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3 col-sm-6 col-12">
                                    <label for="identificacion">Identificaci&oacute;n:</label>
                                    <input type="text" id="identificacion" name="identificacion" class="form-control" placeholder="" required>
                                </div>
                                <div class="form-group col-md-3 col-sm-6 col-12">
                                    <label for="primer_nombre">Primer Nombre:</label>
                                    <input type="text" id="primer_nombre" name="primer_nombre" class="form-control" placeholder="" required>
                                </div>
                                <div class="form-group col-md-3 col-sm-6 col-12">
                                    <label for="segundo_nombre">Segundo Nombre:</label>
                                    <input type="text" id="segundo_nombre" name="segundo_nombre" class="form-control" placeholder="">
                                </div>
                                <div class="form-group col-md-3 col-sm-6 col-12">
                                    <label for="primer_apellido">Primer Apellido:</label>
                                    <input type="text" id="primer_apellido" name="primer_apellido" class="form-control" placeholder="" required>
                                </div>
                                <div class="form-group col-md-3 col-sm-6 col-12">
                                    <label for="segundo_apellido">Segundo Apellido:</label>
                                    <input type="text" id="segundo_apellido" name="segundo_apellido" class="form-control" placeholder="">
                                </div>
                                <div class="form-group col-md-3 col-sm-6 col-12">
                                    <label for="correo">Correo:</label>
                                    <input type="email" id="correo" name="correo" class="form-control" placeholder="" required>
                                </div>
                                <div class="form-group col-md-3 col-sm-6 col-12">
                                    <label for="telefono">Tel&eacute;fono de Contacto:</label>
                                    <input type="tel" id="telefono" name="telefono" class="form-control" placeholder="" required pattern="[0-9]{10}">
                                </div>
                                <!-- <div class="form-group col-md-3 col-sm-6 col-12">
                                    <label for="eps">EPS a la que Pertenece:</label>
                                    <select name="id_eps" class="prueba custom-select" style="width: 100%;" id="eps" required>
                                        <option selected>Seleccionar EPS</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3 col-sm-6 col-12">
                                    <label for="ips">IPS a la que Pertenece:</label>
                                    <select name="id_sede" class="prueba custom-select" style="width: 100%;" id="ips" required>
                                        <option disabled selected>Seleccionar IPS</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3 col-sm-6 col-12">
                                    <label for="eseRed">ESE a la que Pertenece:</label>
                                    <input type="text" id="eseRed" name="ese" class="form-control" readonly>
                                </div> -->
                                <!-- <div class="form-group col-md-3 col-sm-6 col-12">
                                    <label for="id_especialidad">Especialidad:</label>
                                    <select name="id_especialidad" class="prueba custom-select" style="width: 100%;" id="id_especialidad">
                                        <option disabled selected>Seleccionar Especialidad</option>
                                        <option value="No Aplica">No Aplica</option>
                                        <option value="Auxiliar de Enfermería">Auxiliar de Enfermer&iacute;a</option>
                                        <option value="Médico General">M&eacute;dico General</option>
                                        <option value="Médico Especialista">M&eacute;dico Especialista</option>
                                        <option value="Bacteriólogo">Bacteri&oacute;logo</option>
                                        <option value="Patólogo">Pat&oacute;logo</option>
                                        <option value="Citólogo">Cit&oacute;logo</option>
                                        <option value="Colposcopista">Colposcopista</option>
                                    </select>
                                </div> -->
                                <div class="form-group col-md-12 col-sm-12 col-12">
                                    <label for="firma"><i class="fas fa-signature"></i> Firma:</label>
                                    <div class="input-group-prepend border border-info bg-light d-flex justify-content-center">
                                        <canvas id="firma_canvas" width="600" height="150" style="background-color: #ffffff;"></canvas>
                                        <input type="hidden" name="firma_base64" id="firma_base64">
                                    </div>
                                </div>
                                <div class="form-group col-md-3 col-sm-6 col-12">
                                    <label for="usuario">Usuario:</label>
                                    <input type="text" id="usuario" name="usuario" class="form-control" autocomplete="off" required>
                                </div>
                                <div class="form-group col-md-3 col-sm-6 col-12">
                                    <label for="password">Contrase&ntilde;a:</label>
                                    <input type="password" id="password" name="password" class="form-control" autocomplete="new-password" required>
                                </div>
                                <div class="form-group col-md-3 col-sm-6 col-12">
                                    <label for="confirmar">Confirmar Contrase&ntilde;a:</label>
                                    <input type="password" id="confirmar" name="confirmar" class="form-control" autocomplete="new-password" required>
                                </div>
                                <div class="form-group col-md-3 col-sm-6 col-12">
                                    <label for="">Rol:</label>
                                    <select name="rol" class="prueba custom-select" style="width: 100%;" id="rol" required>
                                        <option disabled selected>Seleccionar Rol</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-success mt-4 pr-5 pl-5">Crear Usuario</button>
                            </div>

                        </form>
                        <?php
                        $usuario = UsuarioController::ctrlRegistrarUsuario();
                        // if (isset($usuario) && $usuario === "ok") { 
                        //     echo '<div class="alert alert-success mt-3" role="alert">Usuario creado exitosamente.</div>';
                        // } elseif (isset($usuario) && $usuario === "error") {
                        //     echo '<div class="alert alert-danger mt-3" role="alert">Error al crear el usuario. Por favor, intente nuevamente.</div>';
                        // }
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
        <script>
            const canvas = document.getElementById('firma_canvas');
            const ctx = canvas.getContext('2d');

            let isDrawing = false;
            let lastX = 0;
            let lastY = 0;

            // Función para iniciar el dibujo
            function startDrawing(e) {
                isDrawing = true;
                lastX = e.offsetX;
                lastY = e.offsetY;
            }

            // Función para dibujar
            function draw(e) {
                if (!isDrawing) return;
                const currentX = e.offsetX;
                const currentY = e.offsetY;

                ctx.beginPath();
                ctx.moveTo(lastX, lastY);
                ctx.lineTo(currentX, currentY);
                ctx.strokeStyle = '#000';
                ctx.stroke();

                lastX = currentX;
                lastY = currentY;
            }

            // Función para finalizar el dibujo
            function stopDrawing() {
                isDrawing = false;
            }

            // Eventos del mouse
            canvas.addEventListener('mousedown', startDrawing);
            canvas.addEventListener('mousemove', draw);
            canvas.addEventListener('mouseup', stopDrawing);

            function obtenerFirmaBase64() {
                return canvas.toDataURL();
            }

            // Al enviar el formulario, guarda la firma en el campo oculto
            document.querySelector('form').addEventListener('submit', (e) => {
                e.preventDefault();
                document.getElementById('firma_base64').value = obtenerFirmaBase64();
                document.querySelector('form').submit();
            });
        </script>
</body>

</html>