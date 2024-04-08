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
                        <h1>Registrar Sociedad</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="card card-dark shadow-lg">
                    <div class="card-header">
                        <h3 class="card-title">Registrar Sociedad</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                    <form action="" method="POST" id="frm_guardar_sociedad">
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="nombreSociedad">Nombre de la Sociedad</label>
                                    <input type="text" name="nombreSociedad"class="form-control" id="nombreSociedad" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="referenciaSociedad">Referencia de la Sociedad</label>
                                    <input type="text" name="referenciaSociedad" class="form-control" id="referenciaSociedad" required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="estado">Estado USA</label>      
                                    <input type="text" name ="estadoUsa"class="form-control" id="estadoUsa" required>                              
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="fechaRegistro">Fecha de Registro</label>
                                    <input type="date" name="fechaRegistro" class="form-control" id="fechaRegistro" required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="numeroRegistro">Número de Registro</label>
                                    <input type="text" name="numeroRegistro"class="form-control" id="numeroRegistro" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="fechaRenta">Fecha de Renta</label>
                                    <input type="date" name="fechaRenta" class="form-control" id="fechaRenta" required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="paisSociedad">País de la Sociedad</label>
                                    <input type="text" name="paisSociedad"class="form-control" id="paisSociedad" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="estadoSociedad">Estado de la Sociedad</label>
                                    <select class="form-control" name="estado" id="estado">
                                        <option value="true">Activo</option>
                                        <option value="false">Inactivo</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="cantidadSocios">Cantidad de Socios</label>
                                    <input type="number" name="cantidadSocios" class="form-control" id="cantidadSocios" required>
                                </div>
                            </div>
                           
                            <div class="form-group row">
                                    <div class="offset-4 col-8">
                                    <button name="submit"  id="btnGuardarSociedad" class="btn btn-primary">Guardar</button>
                                    </div>
                            </div>
                            
                        </form>
                       
                       
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
      $('#btnGuardarSociedad').click(function(){        
          var datos = $('#frm_guardar_sociedad').serialize()+ "&accion=guardarSociedad";
          console.log(datos);  
        $.ajax({
            type:"POST",
            url:"../controller/sociedadController.php",
            data:datos,
            success:function(r){
                console.log(r);
                if(r.resultado == 0){
                alert("fallo :(");
                }else{
                    alert("Agregado con éxito");
                     // Redirección a listar_empresa.php
                     window.location.href = 'listarEmpresa.php';
                }
            }
          });
          return false;
        });
        
    });
</script>