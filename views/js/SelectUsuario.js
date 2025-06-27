var currentUrl2 = window.location.href;
// Extrae la URL base
var baseUrl2 = currentUrl2.split("/").slice(0, 4).join("/");
// nota:cambiar el 4 por el 3 cuando este en el servidor
// if(baseUrl=="http://localhost"){
//     baseUrl = baseUrl+'/PTM';
// }
$(document).ready(function() {
    // cargar_usuarios();
    cargar_roles();
});

// function cargar_usuarios() {
//     var cod = '';
//     $.ajax({
//         type: 'post',
//         url: baseUrl2+'/controller/selectUsuarioController.php',
//         data: cod,
//         success: function(resp) {
//             $('#usuario_recepcion').append(resp);
//             $('#usuario_toma').append(resp);
//         },
//     });
// }

function cargar_roles() {
    var cod = '';
    $.ajax({
        type: 'post',
        url: baseUrl2+'/controller/selectRolesController.php',
        data: cod,
        success: function(resp) {
            $('#rol').append(resp);
        },
    });
}