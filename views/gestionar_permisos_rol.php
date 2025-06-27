<?php

include_once "../model/RolesModelo.php";
include_once "../model/modelMenus.php";

$roles = RolesModelo::mdlConsultarRoles(); // Obtener todos los roles
$menusYSubmenus = ModelMenus::mdlConsultarMenusYSubmenus(); // Obtener todos los menús y submenús

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>


    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <title>Gestion de Permisos por Rol</title>
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <section class="content">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Gesti&oacute;n de Permisos por Rol</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <form id="form-permisos">
                                <label for="rol">Seleccionar rol:</label>
                                <select id="rol" name="rol" class="form-select">
                                    <option value="" disabled selected>-- Elige un rol --</option>
                                    <?php foreach ($roles as $rol): ?>
                                        <option value="<?= $rol['id'] ?>"><?= $rol['rol'] ?></option>
                                    <?php endforeach; ?>
                                </select>   
                                <div id="contenedor-submenus" class="pt-2"></div>
                                <div class="text-center">
                                    <button type="submit" id="btnGuardarPermisos" class="btn btn-success mt-3" style="display: none;">Guardar permisos</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        document.getElementById('rol').addEventListener('change', function () { // Agregar un evento al select para detectar cuando se cambia el rol seleccionado
            const idRol = this.value;
            const contenedor = document.getElementById('contenedor-submenus');// Obtener el contenedor donde se mostrarán los permisos
            contenedor.innerHTML = '<p>Cargando permisos...</p>';

            if (!idRol) { // Si no se selecciona un rol, limpiar el contenedor y salir
                contenedor.innerHTML = '';
                return;
            }

            fetch(`../controller/RolesController.php?accion=consultarPermisosRol&id_rol=${idRol}`) // Realizar la solicitud al controlador para obtener los permisos del rol seleccionado
                .then(response => response.json())
                .then(data => {
                    contenedor.innerHTML = ''; // Limpiar el contenedor

                    if (data.length === 0) { // Si no hay permisos asignados al rol, mostrar un mensaje
                        contenedor.innerHTML = '<p>No hay permisos asignados a este rol.</p>';
                        return;
                    }
                    
                    // data.forEach(menu  => { // Iterar sobre los menús y submenús obtenidos
                    //     const card = document.createElement('div'); // Crear un nuevo elemento div para cada menú
                    //     card.className = 'card mb-3'; // Asignar clases para el estilo de la tarjeta

                    //     const header = document.createElement('div'); // Crear el encabezado de la tarjeta
                    //     header.className = 'card-header bg-primary text-white'; // Asignar clases para el estilo del encabezado
                    //     header.textContent = menu.nombre; // Asignar el nombre del menú al encabezado
                    //     card.appendChild(header);// Agregar el encabezado a la tarjeta

                    //     const body = document.createElement('div');// Crear el cuerpo de la tarjeta
                    //     body.className = 'card-body row';// Asignar clases para el estilo del cuerpo

                    //     menu.submenus.forEach(sub => { // Iterar sobre los submenús del menú
                    //         const col = document.createElement('div'); // Crear un nuevo elemento div para cada submenú
                    //         col.className = 'col-md-4';// Asignar clases para el estilo de la columna
                    //         // Crear el checkbox para el submenú 
                    //         const check = `
                    //             <div class="form-check">
                    //             <input class="form-check-input" type="checkbox" name="permisos[]" id="permiso_${sub.id_submenu}" value="${sub.id_submenu}" ${sub.activo ? 'checked' : ''}>
                    //             <label class="form-check-label" for="permiso_${sub.id_submenu}">${sub.nombre}</label>
                    //             </div>
                    //         `;
                    //         col.innerHTML = check; // Asignar el HTML del checkbox al div de la columna
                    //         body.appendChild(col); // Agregar la columna al cuerpo de la tarjeta
                    //     });
                    //     card.appendChild(body); // Agregar el cuerpo a la tarjeta
                    //     contenedor.appendChild(card); // Agregar la tarjeta al contenedor de permisos
                    // });
                    data.forEach((menu, index) => {
                    const collapseId = `collapseMenu${index}`;

                    const card = document.createElement('div');
                    card.className = 'card mb-2';

                    // Header del menú
                    const header = document.createElement('div');
                    header.className = 'card-header';
                    header.style.cursor = 'pointer';
                    header.setAttribute('data-toggle', 'collapse');
                    header.setAttribute('data-target', `#${collapseId}`);
                    header.setAttribute('aria-expanded', 'false');
                    header.setAttribute('aria-controls', collapseId);
                    header.innerHTML = `<strong>${menu.nombre}</strong>`;
                    card.appendChild(header);

                    // Contenedor colapsable de submenús
                    const collapseDiv = document.createElement('div');
                    collapseDiv.className = 'collapse';
                    collapseDiv.id = collapseId;

                    const body = document.createElement('div');
                    body.className = 'card-body row';

                    menu.submenus.forEach(sub => {
                        const col = document.createElement('div');
                        col.className = 'col-md-4';

                        col.innerHTML = `
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="permisos[]" id="permiso_${sub.id_submenu}" value="${sub.id_submenu}" ${sub.activo ? 'checked' : ''}>
                            <label class="form-check-label" for="permiso_${sub.id_submenu}">${sub.nombre}</label>
                        </div>
                        `;
                        body.appendChild(col);
                    });

                    collapseDiv.appendChild(body);
                    card.appendChild(collapseDiv);
                    contenedor.appendChild(card);
                    });


                    $('#btnGuardarPermisos').show(); // Mostrar el botón de guardar permisos
                })
                .catch(error => {
                    console.error('Error al cargar los permisos:', error);
                    contenedor.innerHTML = '<p>Error al cargar los permisos.</p>';
                });

        });

        document.getElementById('form-permisos').addEventListener('submit', function (e) {
            e.preventDefault(); // Prevenir el envío del formulario

            const formData = new FormData(this); // Obtener los datos del formulario
            const idRol = document.getElementById('rol').value; // Obtener el ID del rol seleccionado

            if (!idRol) {
                alert('Por favor, selecciona un rol.'); // Validar que se haya seleccionado un rol
                return;
            }

            fetch('../controller/RolesController.php?accion=editarPermisosRol', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data['status']=="success") { // Verificar si la respuesta es exitosa
                        swal("Éxito", "Los permisos se han guardado correctamente.", "success");
                    } else {
                        swal("Error", "No se pudieron guardar los permisos.", "error");
                    }
                })
                .catch(error => {
                    console.error('Error al guardar los permisos:', error);
                    swal("Error", "Ocurrió un error al guardar los permisos.", "error");
                });
        });

    </script>

</body>

</html>