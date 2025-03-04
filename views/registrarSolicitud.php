<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
    exit();
} elseif (isset($_SESSION['usuario']) && $_SESSION['solicitudes'] === false) {
    echo 'Acesso no autorizado.';
    exit();
}

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
    <title>Registrar ESE</title>
    <style>
        .card-registroSolicitudCliente {
            width: 70vw;
            margin: auto;
        }

        .btn-acciones {
            display: flex;
            justify-content: space-evenly;
        }

        .btn-volver {
            border: 1px solid #0056b2;
            box-shadow: rgb(0, 80, 165) 2px 2px 2px 0px;
        }
    </style>
</head>

<body>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h3>Solicitudes</h3>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="card card-dark shadow-lg card-registroSolicitudCliente">
                    <div class="card-header">
                        <h3 class="card-title">Registrar Solicitud Cliente</h3>
                        <div class="card-tools">
                            <?php echo date('d/m/Y'); ?>
                            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        
                    <form action="" method="post" id="formulario-solicitud">

                        <!-- Grupo de Select -->
                        <div class="form-group">
                            <label for="selectOptions">Selecciona Una Persona Registrada:</label>
                            <select name="selectPersona" class="form-control" id="selectPersona">
                                <option value="">Cargando opciones...</option>
                            </select>
                        </div>

                         <!-- Grupo de Nombre del Cliente -->
                         <div class="form-group">
                            
                            <input type="hidden" name="nombreCliente" class="form-control" id="nombreCliente" placeholder="Ingresa el nombre del cliente" value="no va ">
                        </div>

                        <!-- Grupo de Referido de -->
                        <div class="form-group">
                            <label for="referidoDe">Referido:</label>
                            <input type="text" name="referido_por" class="form-control" id="referidoDe" placeholder="¿Quién te refirió?">
                        </div>

                        <!-- Grupo de Necesidad -->
                        <div class="form-group">
                            <label for="necesidad">Necesidad:</label>
                            <textarea class="form-control" name="necesidad" rows="3" placeholder="Describe la necesidad"></textarea>
                        </div>

                          <div class="servicios"></div>    
                          <div class="row">
                            <div class="form-group" style="display: flex; justify-content: flex-end;">
                                <button type="button" id="agregarCampo" class="btn btn-info"><i class="fas fa-plus-square"></i></button>
                            </div>

                             <!-- Contenedor donde se agregarán los campos de texto -->
                             <div id="contenedorCampos"></div>
                        </div>
                          <div class="row">
                            <button type="submit" id="btnCrearSolicitud" class="btn btn-primary" style="margin-top:1.5%;">Guardar</button>
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
</body>

</html>
<script>

document.getElementById('agregarCampo').addEventListener('click', function() {
    // Contador para asignar un índice único a cada campo
    var contador = document.querySelectorAll('[name^="campoDinamico["]').length;

    // Crear un nuevo elemento input de tipo texto
    var nuevoInput = document.createElement('input');
    nuevoInput.setAttribute('type', 'text');
    nuevoInput.setAttribute('placeholder', 'Introduce un nuevo servicio');
    // Modificar el name para incluir el índice actual del contador
    nuevoInput.setAttribute('name', 'campoDinamico[' + contador + ']'); 
    nuevoInput.setAttribute('class', 'form-control mt-2'); // Agregar margen y clases de Bootstrap

    // Añadir el nuevo input al contenedor
    document.getElementById('contenedorCampos').appendChild(nuevoInput);
});


$(document).ready(function(){
      $('#btnCrearSolicitud').click(function(){        
          var datos = $('#formulario-solicitud').serialize()+ "&accion=guardarSolicitud";
          console.log(datos);  
        $.ajax({
            type:"POST",
            url:"../controller/solicitudController.php",
            data:datos,
            success:function(r){
                console.log(r);
                if(r.resultado == 0){
                alert("fallo :(");
                }else{
                    alert("Agregado con éxito");
                     // Redirección a listar_empresa.php
                     window.location.href = 'listado_solicitudes.php';
                }
            }
          });
          return false;
        });
        
    });

    $(document).ready(function() {
    let totalServiciosActual = 0; // Variable para almacenar el total de servicios actuales
    let selectedServices = new Set(); // Guardamos los checkbox seleccionados

    // Función para guardar los checkbox seleccionados antes de actualizar la lista
    function guardarSeleccionados() {
        selectedServices.clear(); // Limpiar el conjunto antes de guardar
        $('.servicios input[type="checkbox"]:checked').each(function() {
            selectedServices.add($(this).attr('id')); // Guardamos los IDs de los seleccionados
        });
    }

    // Función para restaurar la selección después de actualizar la lista
    function restaurarSeleccionados() {
        selectedServices.forEach(function(serviceId) {
            $('#' + serviceId).prop('checked', true); // Restaurar la selección
        });
    }

    // Función para listar servicios sin perder la selección
    function listarServicios() {
        guardarSeleccionados(); // Guardamos la selección actual antes de actualizar

        $.ajax({
            url: '../controller/solicitudController.php',
            method: 'POST',
            data: { action: 'listarServicios' },
            dataType: 'json',
            success: function(response) {
                var serviciosDiv = $('.servicios');
                serviciosDiv.empty(); // Limpiar cualquier contenido previo

                var servicioHtml = '<div class="row">';
                var counter = 0;
                var counter_list = 1;

                $.each(response, function(index, servicio) {
                    if (counter % 15 === 0) {
                        if (counter !== 0) {
                            servicioHtml += '</div>';
                        }
                        servicioHtml += '<div class="col-lg-4 col-md-6 col-sm-12">';
                    }

                    servicioHtml += '<div class="custom-control custom-checkbox">';
                    servicioHtml += '<input type="checkbox" class="custom-control-input" id="' + servicio.servicio_name + '" name="' + servicio.servicio_name + '" value="' + servicio.nombre_servicio + '">';
                    servicioHtml += '<label class="custom-control-label" for="' + servicio.servicio_name + '">' + counter_list + '. ' + servicio.nombre_servicio + '</label>';
                    servicioHtml += '</div>';

                    counter++;
                    counter_list++;
                });

                servicioHtml += '</div></div>';
                serviciosDiv.append(servicioHtml);

                restaurarSeleccionados(); // Restauramos la selección después de actualizar la lista
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error al obtener los servicios:', textStatus, errorThrown);
            }
        });
    }

    // Función para verificar si hay nuevos servicios en la BD
    function verificarNuevosServicios() {
        $.ajax({
            url: '../controller/solicitudController.php',
            method: 'POST',
            data: { action: 'contarServicios' },
            dataType: 'json',
            success: function(response) {
                if (response.total > totalServiciosActual) {
                    console.log('Nuevo servicio detectado. Actualizando lista...');
                    totalServiciosActual = response.total; // Actualizamos el total
                    listarServicios(); // Recargar la lista solo si hay cambios
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error al contar los servicios:', textStatus, errorThrown);
            }
        });
    }

    // Llamamos a listarServicios() inicialmente para cargar los datos
    listarServicios();

    // Guardamos la cantidad inicial de servicios
    setTimeout(function() {
        $.ajax({
            url: '../controller/solicitudController.php',
            method: 'POST',
            data: { action: 'contarServicios' },
            dataType: 'json',
            success: function(response) {
                totalServiciosActual = response.total; // Guardamos el número inicial de servicios
            }
        });
    }, 1000);

    // Verificamos nuevos servicios cada 10 segundos
    setInterval(verificarNuevosServicios, 10000);
});
    $(document).ready(function() {
        $.ajax({
            url: '../controller/sociedadController.php',
            type: 'GET',
            data: { accion: 'getSociedades' },
            dataType: 'json',
            success: function(data) {
                console.log('Respuesta del servidor:', data); // Depuración
                var select = $('#selectPersona');
                select.empty();
                select.append('<option value="">Selecciona una Persona</option>');
                $.each(data, function(index, item) {
                    select.append('<option value="' + item.id_sociedad + '">' + item.nombre +" " + item.apellido + 
                   
                     '</option>');
                });
            },
            error: function(xhr, status, error) {
            console.error('Error en la solicitud AJAX:', status, error);
            console.log('Respuesta del servidor:', xhr.responseText);
            alert('Error al cargar las opciones');
        }
        });
    });
    </script>