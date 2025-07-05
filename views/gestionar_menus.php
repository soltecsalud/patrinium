<?php
include_once "../model/modelMenus.php";
$menus    = ModelMenus::mdlConsultarMenus(); // Obtener todos los menús
$submenus = ModelMenus::mdlConsultarSubmenus();  // Obtener todos los submenús
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
    <!-- Se dejo en la version 13 porque la 14 estaba duplicando la informacion que se mostraba en los select de icono y color -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.18/dist/css/bootstrap-select.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.18/dist/js/bootstrap-select.min.js"></script>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">


    <link rel="stylesheet" href="../views/css/menu-custom.css">

    <title>Registrar Menus</title>
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <section class="content">
            <div class="container">
                <!-- MENÚS -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Gestión de Menús</h3>
                    </div>
                    <div class="card-body">
                        <table id="tablaMenus" class="table table-bordered table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Nombre</th>
                                    <th>&Iacute;cono</th>
                                    <th>Color</th>
                                    <th>Orden</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>

                <!-- SUBMENÚS -->
                <div class="card card-secondary mt-4">
                    <div class="card-header">
                        <h3 class="card-title">Gesti&oacute;n de Submen&uacute;s</h3>
                    </div>
                    <div class="card-body">
                        <table id="tablaSubmenus" class="table table-bordered table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Nombre</th>
                                    <th>Ruta</th>
                                    <th>&Iacute;cono</th>
                                    <th>Men&uacute; Padre</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

    <script>
        const iconLabels = {
            'fas fa-users': 'Usuarios',
            'fas fa-cogs': 'Configuración',
            'fas fa-file-invoice': 'Factura',
            'fas fa-building': 'Empresa',
            'fas fa-chart-bar': 'Reportes',
            'fas fa-database': 'Base de Datos',
            'fas fa-receipt': 'Facturación',
            'fas fa-users-cog': 'Usuarios y Roles',
            'fas fa-shield-alt': 'Seguridad',
            'fas fa-tools': 'Herramientas',
            'fas fa-file-alt': 'Documentos',
            'fas fa-chart-pie': 'Estadísticas',
            'fas fa-envelope': 'Mensajes',
            'fas fa-bell': 'Notificaciones',
            'fas fa-calendar-alt': 'Calendario',
            'fas fa-map-marked-alt': 'Mapas',
            'fas fa-file-upload': 'Subir Archivos',
            'fas fa-file-download': 'Descargar Archivos',
            'fas fa-lock': 'Seguridad',
            'fas fa-chart-line': 'Análisis',
            'fas fa-comments': 'Comentarios',
            'fas fa-question-circle': 'Ayuda',
            'fas fa-info-circle': 'Información',
            'fas fa-exclamation-triangle': 'Advertencia',
            'fas fa-check-circle': 'Confirmación',
            'fas fa-times-circle': 'Error',
            'fas fa-sync-alt': 'Actualizar',
            'fas fa-search': 'Buscar',
            'fas fa-print': 'Imprimir',
            'fas fa-download': 'Descargar',
            // Íconos adicionales, de los submenus
            'fa-user-plus': 'Nuevo Usuario',
            'fa fa-clipboard': 'Portapapeles v1',
            'fas fa-clipboard': 'Portapapeles v2',
            'fas fa-tasks': 'Tareas',
            'fa fa-list': 'Lista'
        };
        function generarOpcionesIconos(iconoSeleccionado) {

            iconoSeleccionado = (iconoSeleccionado || '').trim();

            // Si el ícono no existe, usar el primero del listado como fallback
            if (!iconLabels[iconoSeleccionado]) {
                iconoSeleccionado = Object.keys(iconLabels)[0];
            }

            return Object.entries(iconLabels).map(([icono, etiqueta]) => {
                // console.log(`Icono: ${icono}, Etiqueta: ${etiqueta}`);
                const selected = icono === iconoSeleccionado ? 'selected' : '';
                return `<option value="${icono}" data-content="<i class='${icono}'></i> ${etiqueta}" ${selected}></option>`;
            }).join('');
        }
        let listaMenus = []; // Variable para almacenar los menús
        $(document).ready(function () {
            $.ajax({
                url: '../controller/menusController.php',
                data: { accion: 'consultarMenus' },
                type: 'GET',
                dataType: 'json',
                success: function (menus) {
                    listaMenus = menus;// Guardamos los menús en la variable listaMenus
                    $('.selectpicker').selectpicker('destroy'); // Destruimos el selectpicker para evitar duplicados
                    let tbody = $('#tablaMenus tbody');
                    tbody.html('');
                    menus.forEach(menu => { // Iteramos sobre cada menú
                        // Generamos una fila para cada menú
                        let fila = `
                            <tr data-id="${menu.id}">
                                <td><input type="text" value="${menu.nombre}" class="form-control campo-nombre" data-id="${menu.id}"></td>
                                <td>
                                    <select class="form-control selectpicker campo-icono" data-live-search="true" data-style="btn-outline-secondary" data-id="${menu.id}">
                                        ${generarOpcionesIconos(menu.icono)} 
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control selectpicker selectpicker2 campo-color" data-style="btn-outline-secondary" data-id="${menu.id}">
                                        ${generarOpcionesColores(menu.color)}
                                    </select>
                                </td>
                                <td><input type="number" value="${menu.orden}" class="form-control campo-orden" data-id="${menu.id}"></td>
                                <td>
                                    <button class="btn btn-sm btn-warning btnEditarMenu" data-id="${menu.id}">Editar</button>
                                    <button class="btn btn-sm btn-danger btnEliminarMenu" data-id="${menu.id}">Eliminar</button>
                                </td>
                            </tr>
                        `;
                        tbody.append(fila);
                    });
                    $('.selectpicker').selectpicker('refresh');
                    // Destruir DataTable existente si lo hay
                    if ($.fn.DataTable.isDataTable('#tablaMenus')) {
                        $('#tablaMenus').DataTable().destroy();
                    }
                    $('#tablaMenus').DataTable({
                        responsive: true,
                        language: {
                            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
                        }
                    });
                }
            });

            $.ajax({
                url: '../controller/menusController.php',
                data: { accion: 'consultarSubmenus' },
                type: 'GET',
                dataType: 'json',
                success: function (submenus) {
                    // console.log(submenus);
                    $('.selectpicker-submenu').selectpicker('destroy'); // Destruimos el selectpicker para evitar duplicados
                    let tbody = $('#tablaSubmenus tbody'); 
                    tbody.html('');
                    submenus.forEach(submenu => { // Iteramos sobre cada submenú
                        // Generamos una fila para cada submenú
                        let fila = `
                            <tr data-id="${submenu.id_submenu}">
                                <td><input type="text" value="${submenu.nombre}" class="form-control campo-submenu-nombre" data-id="${submenu.id_submenu}"></td>
                                <td><input type="text" value="${submenu.ruta}" class="form-control campo-submenu-ruta" data-id="${submenu.id_submenu}"></td>
                                <td>
                                    <select class="form-control selectpicker-submenu campo-submenu-icono" data-live-search="true" data-style="btn-outline-secondary" data-id="${submenu.id_submenu}">
                                        ${generarOpcionesIconos(submenu.icono)} 
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control selectpicker-submenu campo-submenu-menupadre" data-live-search="true" data-id="${submenu.id_submenu}">
                                        ${generarOpcionesMenus(submenu.id_menu)}
                                    </select>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-warning btnEditarSubmenu" data-id="${submenu.id_submenu}">Editar</button>
                                    <button class="btn btn-sm btn-danger btnEliminarSubmenu" data-id="${submenu.id_submenu}">Eliminar</button>
                                </td>
                            </tr>
                        `;
                        tbody.append(fila);
                        
                    });
                    $('.selectpicker-submenu').selectpicker('refresh');
                    // Destruir DataTable existente si lo hay
                    if ($.fn.DataTable.isDataTable('#tablaSubmenus')) {
                        $('#tablaSubmenus').DataTable().destroy();
                    }
                    $('#tablaSubmenus').DataTable({
                        responsive: true,
                        language: {
                            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
                        }
                    });
                }
            });

        });

        function generarOpcionesMenus(menuSeleccionado) {
            return listaMenus.map(menu => { // Iteramos sobre cada menú en la lista
                const selected = menu.id == menuSeleccionado ? 'selected' : ''; // Verificamos si el menú es el seleccionado
                return `<option value="${menu.id}" ${selected}>${menu.nombre}</option>`;
            }).join('');
        }
        
        function generarOpcionesColores(colorSeleccionado) {
            const colores = [
                'bg-azul', 'bg-celeste', 'bg-verdeazul', 'bg-verde',
                'bg-verdeoliva', 'bg-verdeosc', 'bg-naranja', 'bg-naranjosc',
                'bg-morado', 'bg-morado1', 'bg-morado2', 'bg-morado3',
                'bg-morado4', 'bg-morado5'
            ];
            return colores.map(color => {
                const selected = color === colorSeleccionado ? 'selected' : '';
                const colorTexto = color.replace('bg-', '').replace('morado', 'Morado ').replace(/[0-9]/g, '').toUpperCase();
                return `<option value="${color}" data-content="<span class='badge menulateral-${color}'>${colorTexto}</span>" ${selected}>${color}</option>`;
            }).join('');
        }
    </script>

    <script>
        $(document).on('click', '.btnEditarMenu', function () {
            const id     = $(this).data('id');
            const nombre = $(`.campo-nombre[data-id="${id}"]`).val();
            const icono  = $(`.campo-icono[data-id="${id}"]`).val();
            const color  = $(`.campo-color[data-id="${id}"]`).val();
            const orden  = $(`.campo-orden[data-id="${id}"]`).val();

            console.log(`Editar menú: ${id}, Nombre: ${nombre}, Ícono: ${icono}, Color: ${color}, Orden: ${orden}`);
            
            if (!nombre || !icono || !color || !orden) {
                alert('⚠️ Por favor, completa todos los campos antes de editar.');
                return;
            }
            // Realizar la petición AJAX para actualizar el menú
            $.ajax({
                url: '../controller/menusController.php',
                method: 'POST',
                data: {
                    id_menu: id,
                    nombre,
                    icono,
                    color,
                    orden,
                    accion: 'editarMenu'
                },
                success: function (response) { 
                    try {
                        const res = JSON.parse(response);
                        if (res.status === 'success') {
                            alert('✅ Menú actualizado correctamente');
                        } else {
                            alert('⚠️ ' + res.message);
                        }
                    } catch (err) {
                        alert('❌ Error inesperado');
                        console.error(response);
                    }
                },
                error: function () {
                    alert('❌ Error al conectar con el servidor');
                }
            });
        });
        $(document).on('click', '.btnEliminarMenu', function () {
            const id = $(this).data('id');
            if (confirm('¿Estás seguro de que deseas eliminar este menú?')) {
                // console.log(`Eliminar menú: ${id}`);
                $.ajax({
                    url: '../controller/menusController.php',
                    method: 'POST',
                    data: { id_menu: id, accion: 'eliminarMenu' },
                    success: function (response) {
                        try {
                            const res = JSON.parse(response);
                            if (res.status === 'success') {
                                alert('✅ Menú eliminado correctamente');
                                location.reload(); // Recargar la página para actualizar la tabla
                            } else {
                                alert('⚠️ ' + res.message);
                            }
                        } catch (err) {
                            alert('❌ Error inesperado');
                            console.error(response);
                        }
                    },
                    error: function () {
                        alert('❌ Error al conectar con el servidor');
                    }
                });
            }
        });
    </script>

    <script>
        $(document).on('click', '.btnEditarSubmenu', function () {
            const id = $(this).data('id');
            const nombre = $(`.campo-submenu-nombre[data-id="${id}"]`).val();
            const ruta = $(`.campo-submenu-ruta[data-id="${id}"]`).val();
            const icono = $(`.campo-submenu-icono[data-id="${id}"]`).val();
            const menu_padre = $(`.campo-submenu-menupadre[data-id="${id}"]`).val();
            // console.log(`Editar submenú: ${id}, Nombre: ${nombre}, Ruta: ${ruta}, Ícono: ${icono}, Menú Padre: ${menu_padre}`);
            if (!nombre || !ruta || !icono || !menu_padre) {
                alert('⚠️ Por favor, completa todos los campos antes de editar.');
                return;
            } 
            // Realizar la petición AJAX para actualizar el submenú
            $.ajax({
                url: '../controller/menusController.php',
                method: 'POST',
                data: {
                    id_submenu: id,
                    nombre,
                    ruta,
                    icono,
                    menu_padre,
                    accion: 'editarSubmenu'
                },
                success: function (response) { 
                    try {
                        const res = JSON.parse(response);
                        if (res.status === 'success') {
                            alert('✅ Submenú actualizado correctamente');
                            // Recargar la página para actualizar la tabla
                            // location.reload();
                        } else {
                            alert('⚠️ ' + res.message);
                        }
                    } catch (err) {
                        alert('❌ Error inesperado');
                        console.error(response);
                    }
                },
                error: function () {
                    alert('❌ Error al conectar con el servidor');
                }
            });
        });
    </script>


</body>

</html>