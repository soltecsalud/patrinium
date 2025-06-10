function buscarSociedad(input,div){
    if(input.length > 3) {
        $.ajax({
            url: '../controller/sociedadController.php',
            method: 'GET',
            data: {input: input, accion: 'buscarNombreSociedad'},
            success: function(response) {
                // console.log('!!!!!');
                
                // console.log(response.status);
                // console.log('!!!!!');
                
                if(response.status=='ok'){ 
                    div.css('display', 'block');
                }else{
                    div.css('display', 'none');
                }
            }
        });
    }
}
function mostrarValor(valor) {
    return valor && valor !== 'N/A' ? valor : "<span class='text-na'>N/A</span>";
  }
  
$(document).ready(function(){
    $('#inputNombreSociedad').on('input', function() {
        this.value = this.value.charAt(0).toUpperCase() + this.value.slice(1);
        var input  = $(this).val();
        buscarSociedad(input,$('#divNombreEncontrado'));
    });
    // $('#numeroPasaporte').on('input', function() {
    //     var input  = $(this).val();
    //     buscarSociedad(input,$('#divPasaporteEncontrado'));
    // });
});