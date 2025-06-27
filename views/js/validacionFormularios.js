$(function() {
    $.validator.setDefaults({

        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });



    // Define reglas de validación genéricas para campos comunes
    var reglasComunes = {
        required: {
            required: true,
            messages: {
                required: "Por favor complete este campo"
            }
        },
        email: {
            required: false,
            email: true,
            messages: {
                required: "Por favor ingrese una dirección de correo electrónico válida"
            }
        },
        minlength: function(value, element) {
            return $(element).data('minlength') ? value.length >= $(element).data('minlength') : true;
        }, 
     
    };

    // Define reglas de validación específicas para cada formulario
    var reglasPorFormulario = {};
    reglasPorFormulario['resultadoCitologia'] = {
        email: reglasComunes.email,
        password: {
            required: true,
            minlength: reglasComunes.minlength
        },
        terms: {
            required: true
        }
    };

    // Inicializa la validación para cada formulario
    $('form').each(function() {
        var idFormulario = $(this).attr('id');
        $(this).validate({
            rules: reglasPorFormulario[idFormulario] || {}, // Usa reglas específicas del formulario si están definidas, de lo contrario usa reglas comunes
            messages: {
                terms: "Por favor acepte nuestros términos"
            }
        });
    });
});