
<?php 
                                            
                                            $verificar_documento = $controlador->validarDocumento($id_revisar_solicitud);
                                           
                                      
                                                
                                            ?>

<?php
$servicios = $controlador->getServicios($id_revisar_solicitud);
                                                        //print_r($servicios);
                                                    

                                                   //Servicios desde JSONb 

                                                          
                                                            foreach ($servicios as $servicio): ?>
                                                                    <?php if (!empty($servicio['servicios'])): ?>
                                                                        <?php
                                                                        // Decodificar el JSONB
                                                                        $datos = json_decode($servicio['servicios'], true);

                                                                        // Verificar si la decodificación fue exitosa
                                                                        if ($datos) {
                                                                            // Iterar sobre cada par clave-valor del JSONB
                                                                            foreach ($datos as $clave => $valor) {
                                                                                ?>
                                                                              
                                                                              <div class="row">
                                                                                    <div class="col-md-6 mb-3">
                                                                                        <label><?php echo $valor; ?></label>
                                                                                    </div>
                                                                                    <div class="col-md-3 mb-3">
                                                                                        <input type="text" placeholder="Qty" name="cantidad<?php echo $clave; ?>" class="form-control">
                                                                                    </div>
                                                                                    <div class="col-md-3 mb-3">
                                                                                        <input type="text" placeholder="Unit Price" name="valor<?php echo $clave; ?>" class="form-control">
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                                <?php
                                                                            }
                                                                        } else {
                                                                            // Si no se pudo decodificar el JSONB, imprimir un mensaje de error
                                                                            ?>
                                                                            
                                                                                <h4>Error al decodificar el JSONB</h4>
                                                                          
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    <?php endif; ?>
                                                                <?php endforeach; ?>
                                                                <?php foreach ($servicios as $servicio_adicionales): ?>
                                                                    <?php if (!empty($servicio['servicios_adicionales'])): ?>
                                                                        <?php
                                                                        // Decodificar el JSONB
                                                                        $datos_adicionales = json_decode($servicio['servicios_adicionales'], true);

                                                                        // Verificar si la decodificación fue exitosa
                                                                        if ($datos_adicionales) {
                                                                           
                                                                            // Iterar sobre cada par clave-valor del JSONB
                                                                            foreach ($datos_adicionales as $clave => $valor) {
                                                                               
                                                                                ?>
                                                                             
                                                                              <div class="row">
                                                                                    <div class="col-md-6 mb-3">
                                                                                        <label><?php echo $valor; ?></label>
                                                                                    </div>
                                                                                    <div class="col-md-3 mb-3">
                                                                                        <input type="text" placeholder="Qty" name="cantidad<?php echo $valor; ?>" class="form-control">
                                                                                    </div>
                                                                                    <div class="col-md-3 mb-3">
                                                                                        <input type="text" placeholder="Unit Price" name="valor<?php echo $valor; ?>" class="form-control">
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                                <?php
                                                                            }
                                                                        } 
                                                                        ?>
                                                                    <?php endif; ?>
                                                                <?php endforeach; ?>
                                                                <hr class="my-4 primary" > 
                                                                    <div class="row"> 
                                                                            <label class="mb-2 h5" style="margin-top: 2%; padding-bottom: 2%;" for="invoiceNumberInput">
                                                                                In case of issuing an invoice with only a Total:
                                                                            </label>
                                                                            
                                                                                        <div class="col-md-6 mb-3">
                                                                                            <label for="nombreSociedad">Total Invoice</label>
                                                                                        </div>
                                                                                       
                                                                                        <div class="col-md-6 mb-3">
                                                                                            <input type="text" placeholder="Price" name="total_factura" class="form-control" >
                                                                                        </div>
                                                                                        <hr class="my-4 primary" > 
                                                                                    </div>
                                                                    </div>
                                                                    <div class="row" style="margin-bottom: 3%;">
                                                                            <label class="mb-2 h5" style="margin-top: 2%; padding-bottom: 2%;" for="invoiceNumberInput">
                                                                                Observations:
                                                                            </label>
                                                                        <div class="col-12">
                                                                            <textarea class="form-control" rows="5" name="observaciones" id="exampleTextarea" placeholder="write something here"></textarea>
                                                                        </div>
                                                                    </div>
                                                                  
                                                                <div class="row">
                                                                 
                                                                        <input type="hidden" name="id_solicitud" value="<?php echo $id_revisar_solicitud;?>">
                                                                        <button type="button" id="btnInsertarFactura" style="margin-bottom: 1%;" class="btn btn-primary">Insert Invoice</button>
                                                                    
                                                               
                                                                       
                                                                   
                                                                        
                                                                        
                                                                </div>                     
                                                
                                            </form>
                                            <?php } } else{
                                                echo "<div class='alert alert-danger' role='alert'>NO Existe Documento Para Insertar Factura</div>";
                                            }  ?>
                                        </div>
                                        
                                    </div>
                                </div>
                                else{
                                            ?>
                                    <div class="container mt-4">
                                           
                                            
                                            <form id="billingForm">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                       
                                                        <label class="text-center mb-2" style="font-size: smaller;" for="companySelect">
                                                            Company Issuing Invoice:
                                                        </label>
                                                        <select class="form-select" id="companySelect" name="logo">
                                                            <option value="0">Select Company</option>
                                                            <option value="patrinium">Patrinium</option>
                                                            <option value="JairoVargas">Jairo Vargas</option>
                                                            <option value="empresa_3">Empresasss</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3">
                                                        
                                                        <label class="text-center mb-2" style="font-size: smaller;" for="bankAccountSelect">
                                                            Bank Account for Deposit:
                                                        </label>
                                                        <select class="form-select" id="bankAccountSelect" name="cuenta_bancaria">
                                                            <option value="0">Select Bank</option>
                                                            
                                                        <?php
                                                            $banco_consigaciones = $controlador->getBancosConsignacion();   
                                                                foreach ($banco_consigaciones as $banco_consigacion): ?>
                                                                    <option value="<?php echo $banco_consigacion->id_banco; ?>"><?php echo $banco_consigacion->nombre_banco; ?></option>

                                                        ?>
                                                       <?php endforeach; ?>
                                                            
                                                            
                                                        
                                                        
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3">
                                                       
                                                        <label class="text-center mb-2" style="font-size: smaller;" for="invoiceNumberInput">
                                                            Invoice Number:
                                                        </label>
                                                        <input type="text" class="form-control" id="invoiceNumberInput" name="invoice_number" placeholder="Enter invoice number">
                                                    </div>
                                                    <div class="col-md-3">
                                                       
                                                        <label class="text-center mb-2" style="font-size: smaller;" for="invoiceNumberInput">
                                                            TAX:
                                                        </label>
                                                        <input type="text" class="form-control" id="tax" name="tax" placeholder="Enter TAX">
                                                    </div>
                                                    <div class="row mt-4">
                                                        <div class="col-md-4">                                                            
                                                            <label class="text-center mb-2" style="font-size: smaller;" for="invoiceNumberInput">
                                                                Email:
                                                            </label>
                                                            <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email">
                                                        </div>
                                                        <div class="col-md-4">                                                            
                                                            <label class="text-center mb-2" style="font-size: smaller;" for="invoiceNumberInput">
                                                                Adress:
                                                            </label>
                                                            <input type="text" class="form-control" id="adress" name="adress" placeholder="Enter adress">
                                                        </div>
                                                        <div class="col-md-4">                                                            
                                                            <label class="text-center mb-2" style="font-size: smaller;" for="invoiceNumberInput">
                                                                Number TAX:
                                                            </label>
                                                            <input type="text" class="form-control" id="numberTax" name="numberTax" placeholder="Enter tax number">
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                <hr class="my-4 primary" > 

                                                    <div class="row">
                                                        <label class="mb-2 h5" style="margin-top: 2%; padding-bottom: 2%;" for="invoiceNumberInput">
                                                            Billing Services:
                                                        </label>
                                                       
                                                    </div>

                                
                            </div>
<script></script>
                            $(document).ready(function(){
    $('#btnInsertarFactura').click(function(){
        var datos = $('#billingForm').serialize();
        datos += "&accion=insertarFactura"; // Añadir acción específica para el controlador
        console.log(datos); // Para depuración

        $.ajax({
            type: "POST",
            url: "../controller/solicitudController.php",
            data: datos,
            success: function(r){
                console.log(r); // Para depuración
                if(r.resultado == 0){
                    alert("Fallo en la inserción de la factura.");
                } else {
                    alert("Factura insertada con éxito.");
                    window.location.href = 'verSolicitud.php?numero_solicitud=<?php echo $id_revisar_solicitud;?>';
                }
            },
            error: function(){
                alert("Error en la comunicación con el servidor.");
            }
        });
        return false;
    });
});
</script>