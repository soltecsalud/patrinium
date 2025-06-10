function buscarPaciente(input,div){
    if(input.length > 3) {
        $.ajax({
            url: '../controller/sociedadController.php',
            method: 'GET',
            data: {input: input, accion: 'buscarPersona'},
            success: function(response) {
                console.log('!!!!!');
                
                console.log(response.status);
                console.log('!!!!!');
                
                if(response.status=='ok'){ 
                    div.css('display', 'block');
                }else{
                    div.css('display', 'none');
                }
            }
        });
    }
}

$(document).ready(function(){
    $('#nombre').on('input', function() {
        this.value = this.value.charAt(0).toUpperCase() + this.value.slice(1);
        var input  = $(this).val();
        buscarPaciente(input,$('#divNombreEncontrado'));
    });
    $('#numeroPasaporte').on('input', function() {
        var input  = $(this).val();
        buscarPaciente(input,$('#divPasaporteEncontrado'));
    });
});