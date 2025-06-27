var currentUrlp = window.location.href;
// Extrae la URL base
var baseUrlp = currentUrlp.split("/").slice(0, 4).join("/");
// var baseUrl1 = currentUrl1.split("/").slice(0, 3).join("/");
// nota:cambiar el 4 por el 3 cuando este en el servidor
// console.log(baseUrl1);
$(document).ready(function() {
    $(document).on('click', '.delete-usuario', function(e) {
        // capturamos el evento clic del boton eliminar sede
        var id_usuario = $(this).data('id');
        //capturamos el id de la sede en una variable
        deleteUsuario(id_usuario);
        //enviamos el id a la funcion sededelete
        e.preventDefault();
    });
});

function deleteUsuario(id_usuario) {
    swal({
        title: '\u00bfEstas seguro?',
        text: "El usuario se borrar\u00e1 de forma permanente!",
        icon: 'warning',
        buttons: true,
        dangerMode: true,
        allowOutsideClick: false
            // creamos el mensaje que permite al usuario confirmar si va a eliminar la sede
    }).then((willDelete) => {
        if (willDelete) {
            // si el usuario confirma la eliminacion enviamos la variable capturada al archivo eliminar sede a traves de ajax
            $.ajax({
                type: 'get',
                url: baseUrlp+'/controller/usuarioController.php',
                data: 'deleteUsuario=' + id_usuario
            }).done(function(respuesta) {
                // evaluamos si el archivo php devuelve alguna respuesta
                if (respuesta == false) {
                    swal("Error", "Un error ha ocurrido!", {
                        icon: "error",
                    });
                    location.reload();
                    // si no devuelve ninguna respuesta mostramos el mensaje de error y redireccionamos al inicio
                } else {
                    var url = respuesta;
                    swal("Confirmaci\u00f3n", "El usuario ha sido eliminado!", {
                        icon: "success",
                    });
                    setTimeout(() => {
                        location.href = "./consultar_usuarios.php";
                      }, 1000);
                    // si devuelve respuesta mostramos el mensaje de confirmacion y redireccionamos a la pagina de la empresa despues de un segundo
                }
            });
        }
    });
}