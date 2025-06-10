<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla con AJAX</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Agregado jQuery -->
</head>
<body>

<div class="container mt-4">
    <h2>Actas por Solicitud</h2>
    <input type="number" id="fk_solicitud" class="form-control mb-3" placeholder="Ingrese ID de solicitud">
    <button id="cargarDatos" class="btn btn-primary">Cargar Datos</button>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#checklistModal">
        Abrir Lista de Chequeo
    </button>

    <table id="tablaPlantillas" class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Fecha Creación</th>
                <th>Contenido HTML</th>
                <th>Nombre Sociedad</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>


<div class="modal fade" id="modalContenidoHTML" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Contenido del Acta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <div id="contenidoHTML"></div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="checklistModal" tabindex="-1" aria-labelledby="checklistModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="checklistModalLabel">Lista de Verificación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="checklistForm">
                    <ul class="list-group" id="checklistItems">
                        <li class="list-group-item"><input class="form-check-input me-2" type="checkbox"> General and specific Delaware's Corporation - Advice / Consulting</li>
                        <li class="list-group-item"><input class="form-check-input me-2" type="checkbox"> Letter of Delivery</li>
                        <li class="list-group-item"><input class="form-check-input me-2" type="checkbox"> Delaware Company Guidebook</li>
                        <li class="list-group-item"><input class="form-check-input me-2" type="checkbox"> Mandate Agreement</li>
                        <li class="list-group-item"><input class="form-check-input me-2" type="checkbox"> Draft - Preparation of Certificate of Formation</li>
                        <li class="list-group-item"><input class="form-check-input me-2" type="checkbox"> Certificate of Formation with Apostille de la Hague</li>
                        <li class="list-group-item"><input class="form-check-input me-2" type="checkbox"> Authentication (True and Correct Copy) Certificate Of Formation</li>
                        <li class="list-group-item"><input class="form-check-input me-2" type="checkbox"> Certified Copy of the Certificate of Formation</li>
                        <li class="list-group-item"><input class="form-check-input me-2" type="checkbox"> Company Information Details</li>
                        <li class="list-group-item"><input class="form-check-input me-2" type="checkbox"> Minutes of the First Meeting of the Members</li>
                        <li class="list-group-item"><input class="form-check-input me-2" type="checkbox"> Minutes of the Meeting of the Assembly of Members</li>
                        <li class="list-group-item"><input class="form-check-input me-2" type="checkbox"> Operating Agreement</li>
                        <li class="list-group-item"><input class="form-check-input me-2" type="checkbox"> Register of Members</li>
                        <li class="list-group-item"><input class="form-check-input me-2" type="checkbox"> Statement of Authorized Person</li>
                        <li class="list-group-item"><input class="form-check-input me-2" type="checkbox"> POA to open Checking Account</li>
                        <li class="list-group-item"><input class="form-check-input me-2" type="checkbox"> Bank Account Information</li>
                        <li class="list-group-item"><input class="form-check-input me-2" type="checkbox"> Certificate of Good Standing</li>
                        <li class="list-group-item"><input class="form-check-input me-2" type="checkbox"> Form SS-4</li>
                    </ul>

                    <!-- Sección para agregar elementos dinámicamente -->
                    <div class="mt-3">
                        <label class="form-label">Agregar EIN Letter Copy</label>
                        <div class="input-group mb-2">
                            <input type="text" id="einText" class="form-control" placeholder="Escribe el contenido">
                            <button type="button" class="btn btn-success" onclick="agregarItem('EIN Letter Copy', 'einText')">+</button>
                        </div>
                        
                        <label class="form-label">Agregar Customizable Numbered Stock Certificate</label>
                        <div class="input-group">
                            <input type="text" id="stockText" class="form-control" placeholder="Escribe el contenido">
                            <button type="button" class="btn btn-success" onclick="agregarItem('Customizable Numbered Stock Certificate', 'stockText')">+</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="guardarBtn">Guardar Selección</button>
            </div>
        </div>
    </div>
</div>

<script>
    function agregarItem(tipo, inputId) {
        const inputField = document.getElementById(inputId);
        const texto = inputField.value.trim();

        if (texto === "") {
            alert("Por favor, ingresa un texto antes de agregar.");
            return;
        }

        const lista = document.getElementById("checklistItems");
        const nuevoItem = document.createElement("li");
        nuevoItem.classList.add("list-group-item", "d-flex", "justify-content-between");
        nuevoItem.innerHTML = `
            <div>
                <input class="form-check-input me-2" type="checkbox"> ${tipo}: ${texto}
            </div>
            <button type="button" class="btn btn-danger btn-sm" onclick="eliminarItem(this)">X</button>
        `;
        lista.appendChild(nuevoItem);

        // Limpiar el campo de texto después de agregar
        inputField.value = "";
    }

    function eliminarItem(boton) {
        boton.parentElement.remove();
    }

    document.getElementById('guardarBtn').addEventListener('click', function () {
        let selectedItems = [];
        document.querySelectorAll('#checklistForm input[type="checkbox"]:checked').forEach((checkbox) => {
            selectedItems.push(checkbox.parentElement.textContent.trim());
        });

        if (selectedItems.length > 0) {
            alert("Elementos seleccionados:\n" + selectedItems.join("\n"));
        } else {
            alert("No se ha seleccionado ningún elemento.");
        }
    });
</script>
<script>
$(document).ready(function() {
    $("#cargarDatos").click(function() {
        let fk_solicitud = $("#fk_solicitud").val();

        if (fk_solicitud === "") {
            alert("Ingrese un ID de solicitud.");
            return;
        }

        $.ajax({
            url: '../controller/obtenerActasController.php',
            type: 'POST',
            data: { action: 'obtenerActas', id_solicitud: fk_solicitud },
            dataType: 'json',
            success: function(response) {
                if (response.status === "success") {
                    let filas = "";
                    response.data.forEach(function(item, index) {
                        filas += `<tr>
                            <td>${item.createat}</td>
                            <td>
                                <button class="btn btn-info ver-html" data-html='${item.contenido_html.replace(/'/g, "&apos;")}' data-bs-toggle="modal" data-bs-target="#modalContenidoHTML">
                                    Ver HTML
                                </button>
                            </td>
                            <td>${item.nombre_sociedad}</td>
                            <td>
                                <button class="btn btn-danger generar-pdf" data-id="${item.id_solicitud}">
                                    PDF
                                </button>
                            </td>
                        </tr>`;
                    });
                    $("#tablaPlantillas tbody").html(filas);
                } else {
                    alert("Error: " + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error("Error AJAX:", error);
            }
        });
    });

    // Evento para abrir el modal con el contenido HTML
    $(document).on("click", ".ver-html", function() {
        let contenidoHTML = $(this).data("html");
        $("#contenidoHTML").html(contenidoHTML);
    });

    // Evento para generar el PDF y abrirlo en nueva pestaña
    $(document).on("click", ".generar-pdf", function() {
        //let id_solicitud = $(this).data("id");
        let id_solicitud = 18;

        $.ajax({
            url: '../controller/obtenerActasController.php',
            type: 'POST',
            data: { action: 'generarPdf', id_solicitud: id_solicitud },
            dataType: 'json',
            success: function(response) {
                if (response.status === "success") {
                    window.open(response.pdf_url, '_blank'); // Abrir el PDF en una nueva pestaña
                } else {
                    alert("Error: " + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error("Error AJAX:", error);
            }
        });
    });
});
</script>


<!-- Bootstrap JS (para el modal) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
