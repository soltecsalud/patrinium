<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
    exit();
} elseif (isset($_SESSION['usuario']) && $_SESSION['casos'] === false) {
    echo 'Acesso no autorizado.';
    exit();
}
include_once "../controller/personaController.php";
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once "head/head_views.php"; ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="css/estilos generales.css">
    <link rel="stylesheet" href="css/estilosPersonalizadosSelect2.css">
    <title>Registrar Caso</title>
 
</head>

<body>

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Registrar Persona</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="card card-dark shadow-lg">
                    <div class="card-header">
                        <h3 class="card-title">Registrar Caso</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" id="frm_guardar_persona">
                            <!-- Crear Persona -->
                            <div class="row">
                                <!-- Columna izquierda -->
                                <div class="col">
                                    <div class="form-group">
                                        <label for="nombres">Nombres</label>
                                        <input type="text" name="nombre" class="form-control" id="nombres">
                                    </div>
                                    <div class="form-group">
                                        <label for="apellidos">Apellidos</label>
                                        <input type="text" name="apellido" class="form-control" id="apellidos">
                                    </div>
                                    <div class="form-group">
                                        <label for="cedula">Cédula</label>
                                        <input type="text" name ="cedula" class="form-control" id="cedula">
                                    </div>
                                    <div class="form-group">
                                        <label for="pais">País</label>
                                        <select name="pais"id="paisSelect" class="form-control">
                                            <option value="">Selecciona una ciudad</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="ciudad">Ciudad</label>
                                        <input type="text" name="ciudad"class="form-control" id="ciudad">
                                    </div>
                                    <div class="form-group">
                                        <label for="cliente">Cliente</label>
                                        <input type="text" name="cliente" class="form-control" id="cliente">
                                    </div>
                                    <div class="form-group">
                                        <label for="oficina_envia">Oficina envía</label>
                                        <input type="text" name="oficina_envia" class="form-control" id="oficina_envia">
                                    </div>
                                </div>
                                <!-- Columna derecha -->
                                <div class="col">
                                    <div class="form-group">
                                        <label for="estadousa">Estado USA</label>
                                        <select name="estado_usa"id="estadosSelect" class="form-control">
                                            <option value="">Selecciona una ciudad</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="pasaporte">Pasaporte Numero</label>
                                        <input type="text" name="pasaporte_no" class="form-control" id="pasaporte">
                                    </div>
                                    <div class="form-group">
                                        <label for="pasaporte_fecha_expedicion">Pasaporte Fecha Expedición</label>
                                        <input type="date" name="pasaporte_fecha_expedicion" class="form-control" id="pasaporte_fecha_expedicion">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="pasaporte_fecha_caducidad">Pasaporte Fecha Caducidad</label>
                                        <input type="date" name="pasaporte_fecha_caducidad" class="form-control" id="pasaporte_fecha_caducidad">
                                    </div>
                                    <div class="form-group">
                                        <label for="tipo_visa">Tipo Visa</label>
                                        <input type="text" name="tipo_visa" class="form-control" id="tipo_visa">
                                    </div>
                                    <div class="form-group">
                                        <label for="fecha_expedicion_visa">Fecha Expedición Visa</label>
                                        <input type="date" name="fecha_expedicion_visa"  class="form-control" id="fecha_expedicion_visa">
                                    </div>
                                    <div class="form-group">
                                        <label for="fecha_caducidad_visa">Fecha Caducidad Visa</label>
                                        <input type="date" name="fecha_caducidad_visa"class="form-control" id="fecha_caducidad_visa">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                    <div class="offset-4 col-8">
                                    <button name="submit"  id="btnGuardarPersona" class="btn btn-primary">Guardar</button>
                                    </div>
                            </div>
                        </form>
                        <?php
                            //CasoController::ctrlRegistrarCaso();
                        ?>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <?php include_once "footer/footer_views.php"; ?>
    <script src="../resource/AdminLTE-3.2.0/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="../resource/AdminLTE-3.2.0/plugins/jquery-validation/additional-methods.min.js"></script>
    <script src="./js/ubicaciones.js"></script>
    <script src="./js/SelectEPS.js"></script>
    <script src="./js/SelectUsuario.js"></script>
    <script src="./js/calcularEdad.js"></script>
    <script src="js/select2.js"></script>
    <script src="./js/registrarCaso.js"></script>
    <script src="./js/validacionFormularios.js"></script>
    <script src="js/selectMultiples.js"></script>

</body>

</html>
<script>
$(document).ready(function() {
    $.ajax({
        url: '../controller/personaController.php?accion=listar', // Ajusta esto a tu estructura de archivos/rutas
        type: 'GET',
        dataType: 'json',
        success: function(ciudades) {
            $.each(ciudades, function(i, ciudad) {
                $('#paisSelect').append($('<option>', { 
                    value: ciudad.id_pais,
                    text : ciudad.pais 
                }));
            });
        },
        error: function() {
            alert("Error al cargar las ciudades");
        }
    });
});
</script>
<script>
  $(document).ready(function(){
      $('#btnGuardarPersona').click(function(){        
          var datos = $('#frm_guardar_persona').serialize()+ "&accion=guardar";
          console.log(datos);  
        $.ajax({
            type:"POST",
            url:"../controller/personaController.php",
            data:datos,
            success:function(r){
                if(r.resultado == 0){
                alert("fallo :(");
                }else{
                    alert("Agregado con éxito");
                }
            }
          });
          return false;
        });
        
    });
</script>