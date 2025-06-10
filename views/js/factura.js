function buscarInvoiceNumber(input,$div){
    if (input.length <= 3) {
        return $div.hide();
    }
    
    const tipo_factura = $div.is('#divinvoicenumberencontrado')
        ? 'factura' 
        : $div.is('#divinvoicenumber_facturarapida_encontrado')
        ? 'facturarapida'
        : null;

    if (!tipo_factura) return;
    
    
    $.ajax({
        url: '../controller/facturaController.php',
        method: 'GET',
        data: {input: input, accion: 'buscarInvoiceNumber', tipo_factura: tipo_factura},
        success: function(response) {
            // console.log(response.status);
            if(response.status=='ok'){ 
                $div.show();
            }else{
                $div.hide();
            }
        },
        error: function(xhr, status, error) {
            $div.hide();
        }
    });
    
}


$(document).ready(function(){
    $('#invoiceNumberInput').on('input', function() {
        // this.value = this.value.charAt(0).toUpperCase() + this.value.slice(1);
        buscarInvoiceNumber($(this).val(), $('#divinvoicenumberencontrado'));
    });
    $('#invoiceNumberInput_facturarapida').on('input', function() {
        buscarInvoiceNumber($(this).val(), $('#divinvoicenumber_facturarapida_encontrado'));
    });
});