<?php
    session_start();
    if (!isset($_SESSION['usuario'])) {
        header('Location: ../index.php');
        exit();
    } elseif (isset($_SESSION['usuario']) && $_SESSION['solicitudes'] === false) {
        echo 'Acesso no autorizado.';
        exit();
    }
    include_once "../controller/personaController.php";
    include_once "../controller/solicitudController.php";
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
    <script src="../resource/AdminLTE-3.2.0/plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="../resource/AdminLTE-3.2.0/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="../resource/AdminLTE-3.2.0/plugins/sweetalert2/sweetalert2.all.js"></script>
    <script src="../resource/AdminLTE-3.2.0/plugins/sweetalert2/sweetalert2.js"></script>   
    <!-- Agregando css de librería HandsonTable -->
    <title>Registrar Socio</title>
</head>
<body>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Ingreso Socio Extranjero</h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="card card-dark shadow-lg">
                    <div class="card-header">
						<h3 class="card-title">Ingresar Socio Extranjero</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#modalCrearCliente"><i class="fas fa-user-plus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="formCrearSocioExtranjero"> 
                            <div class="form-row">
                                <label for="inputNombreSociedad">Nombre de la Sociedad</label>
                                <input type="text" class="form-control" id="inputNombreSociedad" name="nombreSociedad" placeholder="Nombre de la sociedad">
                            </div>
                            <div class="form-row pt-2">
                                <div class="col-md-6 mb-3">
                                    <label for="nombre">Representante o director general</label>
                                    <input type="text" name="representante" class="form-control" id="representante" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="nombre">Pa&iacute;s de origen</label>
                                    <input type="text" name="representante" class="form-control" id="representante" required>
                                </div>
                            </div>
                            <div id="personasContainer" class="pt-2">
                                <!-- Primera Persona y Porcentaje -->
                                <div class="form-group row">
                                    <div class="col-md-8">
                                        <label for="selectPersona">Socio 1</label>
                                        <input class="form-control" type="text" name="socio[]" id="socio" placeholder="Nombre del socio" required>
                                        <!-- <select class="form-control selectPersona" id='selectPersona' name="personas[]">
                                            <option value="">Seleccionar persona</option>
                                        </select> -->
                                    </div>
                                    <div class="col-md-4">
                                        <label for="inputPorcentaje">Porcentaje</label>
                                        <input type="number" class="form-control selectPorcentajes" name="porcentajes[]" placeholder="Porcentaje" min="0" max="100">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <button type="button" class="btn btn-secondary" id="btnAgregarPersona">Agregar persona</button>
                                &nbsp;
                                <button type="button" id="btnEliminarPersona" class="btn btn-danger">Eliminar &uacute;ltima persona</button>
                            </div>
                            <div class="form-row pt-6 pb-4" style="text-align: center;align-items: center;">
                                <div class="col-md-12">
                                    <button type="button" id="btnGuardarSociedad" class="btn btn-primary">Guardar Socio</button>
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
    <!-- Agregando JS de librería HandsonTable -->
    <script src="https://cdn.jsdelivr.net/npm/handsontable/dist/handsontable.full.min.js"></script>

    <script>

        
        $(document).ready(function() {

            // Inicializar el select2 para los selects de personas
            var personaIndex = 2; // Comienza en 2 porque ya tienes una persona por defecto
            $('#btnAgregarPersona').click(function() {
                var nuevoCampo = `
                    <div class="form-group row persona-item">
                        <div class="col-md-8">
                            <label for="selectPersona${personaIndex}">Socio ${personaIndex}</label>
                            <input class="form-control" type="text" name="socio[]" placeholder="Nombre del socio">
                        </div>
                        <div class="col-md-4">
                            <label for="inputPorcentaje${personaIndex}">Porcentaje</label>
                            <input type="number" class="form-control porcentajeInput" name="porcentajes[]" placeholder="Porcentaje" min="0" max="100">
                        </div>
                    </div>
                `;
                $('#personasContainer').append(nuevoCampo);
                var nuevoSelect = $('#personasContainer').find('select').last(); // Seleccionar el nuevo select
                // cargarPersonas(nuevoSelect); // Cargar las opciones en el nuevo select
                personaIndex++;
            });

            // Función para eliminar la última persona agregada
            $('#btnEliminarPersona').click(function() {
                var personas = $('#personasContainer .persona-item'); 
                if (personas.length > 0) {
                    var lastSelect = personas.last().find('select').val(); // Obtener el valor del último select
                    var lastTipo   = personas.last().find('select option:selected').data('id'); // Obtener el tipo del último select

                    // Eliminar el último elemento del contenedor
                    personas.last().remove();
                    personaIndex--; // Disminuir el índice

                }
            });

            $('#btnGuardarSociedad').click(function(e) {
                e.preventDefault();
                var form = $('#formCrearSocioExtranjero').serialize() + '&accion=crearSociedadExtranjera'; // Serializar el formulario y agregar la acción

                $.ajax({
                    type: 'POST',
                    url: '../controller/sociedadController.php', // Ruta hacia el controlador PHP
                    data: form,
                    success: function(response) { 
                        console.log('Respuesta del servidor:', response);
                        if(response.status=='ok'){
                            Swal.fire("Éxito", "Socio extranjero creado", "success")
                            .then(() => {
                                location.reload(); // Recargar la página para mostrar los cambios
                            });
                        }else{
                            Swal.fire("Error", "Fallo la creacion del socio", "error");
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log('Error en la solicitud AJAX:', status, error);
                        console.log('Respuesta del servidor:', xhr.responseText);
                        alert('Error al crear la sociedad');
                    }
                });


            });



        });
    </script>
    
</body>
</html>