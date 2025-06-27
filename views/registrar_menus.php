<?php

include_once "../model/RolesModelo.php";
include_once "../model/modelMenus.php";

$roles = RolesModelo::mdlConsultarRoles(); // Obtener todos los roles
$menus = ModelMenus::mdlConsultarMenus(); // Obtener todos los menús y submenús

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once "head/head_views.php"; ?>
    
    <!-- <link rel="stylesheet" href="css/estilos generales.css">
    <link rel="stylesheet" href="css/estilosPersonalizadosSelect2.css"> -->
    <!-- Asegúrate de tener estos archivos en tu plantilla -->

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- jQuery (primero) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Bootstrap Select (después de jQuery y Bootstrap) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta3/css/bootstrap-select.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta3/js/bootstrap-select.min.js"></script>

    <link rel="stylesheet" href="../views/css/menu-custom.css">

    <title>Registrar Menus</title>
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <section class="content">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Registrar Menus</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <form id="form-crear-menu">   
                                <div class="form-row">
                                    <div class="col"> 
                                        <input type="text" class="form-control" name="nombre" placeholder="Nombre del menú" required>
                                    </div>
                                </div>
                                <div class="form-row pt-2">
                                    <div class="col">
                                        <select class="form-control selectpicker" name="icono" data-live-search="true" data-style="btn-outline-secondary" title="Elige un ícono" required>
                                            <option value="fas fa-users" data-icon="fas fa-users"> Usuarios</option>
                                            <option value="fas fa-cogs" data-icon="fas fa-cogs"> Configuraci&oacute;n</option>
                                            <option value="fas fa-file-invoice" data-icon="fas fa-file-invoice"> Factura</option>
                                            <option value="fas fa-building" data-icon="fas fa-building"> Empresa</option>
                                            <option value="fas fa-chart-bar" data-icon="fas fa-chart-bar"> Reportes</option>
                                            <option value="fas fa-database" data-icon="fas fa-database"> Base de Datos</option>
                                            <option value="fas fa-receipt" data-icon="fas fa-receipt"> Facturaci&oacute;n</option>
                                            <option value="fas fa-users-cog" data-icon="fas fa-users-cog"> Usuarios y Roles</option>
                                            <option value="fas fa-shield-alt" data-icon="fas fa-shield-alt"> Seguridad</option>
                                            <option value="fas fa-tools" data-icon="fas fa-tools"> Herramientas</option>
                                            <option value="fas fa-file-alt" data-icon="fas fa-file-alt"> Documentos</option>
                                            <option value="fas fa-chart-pie" data-icon="fas fa-chart-pie"> Estadísticas</option>
                                            <option value="fas fa-envelope" data-icon="fas fa-envelope"> Mensajes</option>
                                            <option value="fas fa-bell" data-icon="fas fa-bell"> Notificaciones</option>
                                            <option value="fas fa-calendar-alt" data-icon="fas fa-calendar-alt"> Calendario</option>
                                            <option value="fas fa-map-marked-alt" data-icon="fas fa-map-marked-alt"> Mapas</option>
                                            <option value="fas fa-file-upload" data-icon="fas fa-file-upload"> Subir Archivos</option>
                                            <option value="fas fa-file-download" data-icon="fas fa-file-download"> Descargar Archivos</option>
                                            <option value="fas fa-lock" data-icon="fas fa-lock"> Seguridad</option>
                                            <option value="fas fa-chart-line" data-icon="fas fa-chart-line"> Análisis</option>
                                            <option value="fas fa-comments" data-icon="fas fa-comments"> Comentarios</option>
                                            <option value="fas fa-question-circle" data-icon="fas fa-question-circle"> Ayuda</option>
                                            <option value="fas fa-info-circle" data-icon="fas fa-info-circle"> Información</option>
                                            <option value="fas fa-exclamation-triangle" data-icon="fas fa-exclamation-triangle"> Advertencia</option>
                                            <option value="fas fa-check-circle" data-icon="fas fa-check-circle"> Confirmación</option>
                                            <option value="fas fa-times-circle" data-icon="fas fa-times-circle"> Error</option>
                                            <option value="fas fa-sync-alt" data-icon="fas fa-sync-alt"> Actualizar</option>
                                            <option value="fas fa-search" data-icon="fas fa-search"> Buscar</option>
                                            <option value="fas fa-print" data-icon="fas fa-print"> Imprimir</option>
                                            <option value="fas fa-download" data-icon="fas fa-download"> Descargar</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <!-- <input type="text" class="form-control" name="color" placeholder="Color del menú (ej: bg-primary)"> -->
                                        <select class="form-control selectpicker2" name="color" id="colorSelect"
                                                data-style="btn-outline-secondary"
                                                title="Seleccione un color"
                                                data-live-search="false">
                                        <option value="bg-azul" data-content="<span class='badge menulateral-bg-azul'>Azul oscuro</span>">Azul oscuro</option>
                                        <option value="bg-celeste" data-content="<span class='badge menulateral-bg-celeste'>Celeste</span>">Celeste</option>
                                        <option value="bg-verdeazul" data-content="<span class='badge menulateral-bg-verdeazul'>Verde azulado</span>">Verde azulado</option>
                                        <option value="bg-verde" data-content="<span class='badge menulateral-bg-verde'>Verde</span>">Verde</option>
                                        <option value="bg-verdeoliva" data-content="<span class='badge menulateral-bg-verdeoliva'>Verde oliva</span>">Verde oliva</option>
                                        <option value="bg-verdeosc" data-content="<span class='badge menulateral-bg-verdeosc'>Verde oscuro</span>">Verde oscuro</option>
                                        <option value="bg-naranja" data-content="<span class='badge menulateral-bg-naranja'>Naranja</span>">Naranja</option>
                                        <option value="bg-naranjosc" data-content="<span class='badge menulateral-bg-naranjosc'>Naranja oscuro</span>">Naranja oscuro</option>
                                        <option value="bg-morado" data-content="<span class='badge menulateral-bg-morado'>Morado</span>">Morado</option>
                                        <option value="bg-morado1" data-content="<span class='badge menulateral-bg-morado1'>Morado 1</span>">Morado 1</option>
                                        <option value="bg-morado2" data-content="<span class='badge menulateral-bg-morado2'>Morado 2</span>">Morado 2</option>
                                        <option value="bg-morado3" data-content="<span class='badge menulateral-bg-morado3'>Morado 3</span>">Morado 3</option>
                                        <option value="bg-morado4" data-content="<span class='badge menulateral-bg-morado4'>Morado 4</span>">Morado 4</option>
                                        <option value="bg-morado5" data-content="<span class='badge menulateral-bg-morado5'>Morado 5</span>">Morado 5</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- Vista previa del menú -->
                                <div class="mt-3">
                                    <label>Vista previa:</label>
                                    <div id="vista-previa-menu" class="nav-item bg-azul p-2 rounded d-inline-block">
                                        <a href="#" class="nav-link d-flex align-items-center">
                                        <i id="icono-preview" class="fas fa-users mr-2"></i>
                                        <span id='nombre-menu'>Nombre men&uacute;</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" id="btnGuardarMenu" class="btn btn-success mt-3">Guardar Menu</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Registrar Submenus</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <form id="form-crear-submenu">  
                                <div class="form-row">
                                    <div class="col">
                                        <select class="form-control selectpicker" name="menu" data-live-search="true" data-style="btn-outline-secondary" title="Elige un menú" required>
                                            <?php foreach ($menus as $menu): ?>
                                                <option value="<?= $menu['id'] ?>" data-icon="<?= $menu['icono'] ?>"><?= $menu['nombre'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row pt-2">
                                    <div class="col"> 
                                        <input type="text" class="form-control" name="nombre_submenu" placeholder="Nombre del submenú" required>
                                    </div>
                                </div>
                                <div class="form-row pt-2">
                                    <div class="col">
                                        <select class="form-control selectpicker" name="icono" data-live-search="true" data-style="btn-outline-secondary" title="Elige un ícono" required>
                                            <option value="fas fa-users" data-icon="fas fa-users"> Usuarios</option>
                                            <option value="fas fa-cogs" data-icon="fas fa-cogs"> Configuraci&oacute;n</option>
                                            <option value="fas fa-file-invoice" data-icon="fas fa-file-invoice"> Factura</option>
                                            <option value="fas fa-building" data-icon="fas fa-building"> Empresa</option>
                                            <option value="fas fa-chart-bar" data-icon="fas fa-chart-bar"> Reportes</option>
                                            <option value="fas fa-database" data-icon="fas fa-database"> Base de Datos</option>
                                            <option value="fas fa-receipt" data-icon="fas fa-receipt"> Facturaci&oacute;n</option>
                                            <option value="fas fa-users-cog" data-icon="fas fa-users-cog"> Usuarios y Roles</option>
                                            <option value="fas fa-shield-alt" data-icon="fas fa-shield-alt"> Seguridad</option>
                                            <option value="fas fa-tools" data-icon="fas fa-tools"> Herramientas</option>
                                            <option value="fas fa-file-alt" data-icon="fas fa-file-alt"> Documentos</option>
                                            <option value="fas fa-chart-pie" data-icon="fas fa-chart-pie"> Estadísticas</option>
                                            <option value="fas fa-envelope" data-icon="fas fa-envelope"> Mensajes</option>
                                            <option value="fas fa-bell" data-icon="fas fa-bell"> Notificaciones</option>
                                            <option value="fas fa-calendar-alt" data-icon="fas fa-calendar-alt"> Calendario</option>
                                            <option value="fas fa-map-marked-alt" data-icon="fas fa-map-marked-alt"> Mapas</option>
                                            <option value="fas fa-file-upload" data-icon="fas fa-file-upload"> Subir Archivos</option>
                                            <option value="fas fa-file-download" data-icon="fas fa-file-download"> Descargar Archivos</option>
                                            <option value="fas fa-lock" data-icon="fas fa-lock"> Seguridad</option>
                                            <option value="fas fa-chart-line" data-icon="fas fa-chart-line"> Análisis</option>
                                            <option value="fas fa-comments" data-icon="fas fa-comments"> Comentarios</option>
                                            <option value="fas fa-question-circle" data-icon="fas fa-question-circle"> Ayuda</option>
                                            <option value="fas fa-info-circle" data-icon="fas fa-info-circle"> Información</option>
                                            <option value="fas fa-exclamation-triangle" data-icon="fas fa-exclamation-triangle"> Advertencia</option>
                                            <option value="fas fa-check-circle" data-icon="fas fa-check-circle"> Confirmación</option>
                                            <option value="fas fa-times-circle" data-icon="fas fa-times-circle"> Error</option>
                                            <option value="fas fa-sync-alt" data-icon="fas fa-sync-alt"> Actualizar</option>
                                            <option value="fas fa-search" data-icon="fas fa-search"> Buscar</option>
                                            <option value="fas fa-print" data-icon="fas fa-print"> Imprimir</option>
                                            <option value="fas fa-download" data-icon="fas fa-download"> Descargar</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" id="ruta" name="ruta" placeholder="Ruta (ej: vista_usuarios)" required>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" id="btnGuardarSubmenu" class="btn btn-success mt-3">Guardar Submenu</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    
    <script>
        $(document).ready(function () {
            $('.selectpicker').selectpicker();
            $('.selectpicker2').selectpicker();
        });
    </script>

    <script>
        function actualizarVistaPrevia() {
            const iconoSeleccionado = document.querySelector('select[name="icono"]').value;
            const colorSeleccionado = document.querySelector('select[name="color"]').value;

            // Cambiar ícono
            const icono = document.getElementById('icono-preview');
            icono.className = iconoSeleccionado + ' mr-2';
            
            // Cambiar color de fondo
            const contenedor = document.getElementById('vista-previa-menu');
            // contenedor.className = 'nav-item p-2 rounded d-inline-block ' + colorSeleccionado;
            contenedor.className = 'nav-item p-2 rounded d-inline-block menulateral-' + colorSeleccionado;

            // Cambiar nombre del menú
            const nombreMenu = document.getElementById('nombre-menu');
            const nombreInput = document.querySelector('input[name="nombre"]').value;
            nombreMenu.textContent = nombreInput || 'Nombre menú'; // Si el input está vacío
            
            if(!iconoSeleccionado) icono.className = 'fas fa-users mr-2'; // Cambiar el ícono por defecto si no se selecciona uno
            if (colorSeleccionado != '') { // Si hay un color seleccionado
                nombreMenu.style.color = '#fff'; // Cambiar el color del texto a blanco
                icono.style.color = '#fff';
            } else {
                nombreMenu.style.color = ''; // Si no hay color seleccionado, usar el color por defecto
                icono.style.color = '';
            }
            
        }

        // Detectar cambios
        document.querySelector('input[name="nombre"]').addEventListener('input', actualizarVistaPrevia);
        document.querySelector('select[name="icono"]').addEventListener('change', actualizarVistaPrevia);
        document.querySelector('select[name="color"]').addEventListener('change', actualizarVistaPrevia);
    </script>

    <script>
        document.getElementById('ruta').addEventListener('input', function (e) {
            // Reemplazar puntos y convertir a minúsculas
            this.value = this.value.replace(/\./g, '').toLowerCase();
        });
    </script>

    <script>
        $('#btnGuardarMenu').on('click', function (e) {
            e.preventDefault(); // Evitar el envío del formulario por defecto
            const formData = new FormData(document.getElementById('form-crear-menu'));
            formData.append('accion', 'registrarMenu'); // Agregar la acción al FormData
            // Validar que el campo de nombre no esté vacío
            if (!formData.get('nombre')) {
                swal("Error", "Por favor, ingresa un nombre para el menú.", "error");
                return; // Detener la ejecución si el nombre no está ingresado
            }
            // Validar que el campo de color no esté vacío
            if (!formData.get('color')) {
                swal("Error", "Por favor, selecciona un color para el menú.", "error");
                return; // Detener la ejecución si el color no está seleccionado
            }
            // Validar que el campo de ícono no esté vacío
            if (!formData.get('icono')) {
                swal("Error", "Por favor, selecciona un ícono para el menú.", "error");
                return; // Detener la ejecución si el ícono no está seleccionado
            }
            $.ajax({
                url: '../controller/menusController.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    var resp = JSON.parse(response);
                    if (resp.status === 'success') { 
                        swal("Éxito", "Menú registrado correctamente.", "success");
                        // Aquí puedes redirigir o actualizar la vista
                        setTimeout(function() { 
                            window.location.href = '../views/registrar_menus.php'; // Redirigir a la lista de menús
                        }, 1000); // Esperar 2 segundos antes de redirigir
                    } else {
                        swal("Error", "No se pudo registrar el menú.", "error");
                    }
                },
                error: function () {
                    swal("Error", "Ocurrió un error al registrar el menú.", "error");
                }
            });
        });
        $('#btnGuardarSubmenu').on('click', function (e) {
            e.preventDefault(); // Evitar el envío del formulario por defecto
            const formData = new FormData(document.getElementById('form-crear-submenu'));
            formData.append('accion', 'registrarSubmenu'); // Agregar la acción al FormData
            // Validar que el campo de menú no esté vacío
            if (!formData.get('menu')) {
                swal("Error", "Por favor, selecciona un menú para el submenú.", "error");
                return; // Detener la ejecución si el menú no está seleccionado
            }
            // Validar que el campo de nombre del submenú no esté vacío
            if (!formData.get('nombre_submenu')) {
                swal("Error", "Por favor, ingresa un nombre para el submenú.", "error");
                return; // Detener la ejecución si el nombre del submenú no está ingresado
            }
            // Validar que el campo de ícono no esté vacío
            if (!formData.get('icono')) {
                swal("Error", "Por favor, selecciona un ícono para el submenú.", "error");
                return; // Detener la ejecución si el ícono no está seleccionado
            }
            // Validar que el campo de ruta no esté vacío
            if (!formData.get('ruta')) {
                swal("Error", "Por favor, ingresa una ruta para el submenú.", "error");
                return; // Detener la ejecución si la ruta no está ingresada
            }
            $.ajax({
                url: '../controller/menusController.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    var resp = JSON.parse(response);
                    if (resp.status === 'success') { 
                        swal("Éxito", "Submenú registrado correctamente.", "success");
                        // Aquí puedes redirigir o actualizar la vista
                        setTimeout(function() { 
                            window.location.href = '../views/registrar_menus.php'; // Redirigir a la lista de menús
                        }, 2000); // Esperar 2 segundos antes de redirigir
                    } else {
                        swal("Error", "No se pudo registrar el submenú.", "error");
                    }
                },
                error: function () {
                    swal("Error", "Ocurrió un error al registrar el submenú.", "error");
                }
            });
        });
    </script>



</body>

</html>