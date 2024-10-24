<?php
require_once('../resource/fpdf/fpdf.php');
require_once ('../model/modelFacturareport.php');


class MyPDF extends FPDF {
    private $isFirstPage = true; 
    // Sobrescribir el método Header para crear un encabezado personalizado
    function Header() {
        
        if ($this->isFirstPage) {
        
        $this->SetDrawColor(37, 40, 80);
        // Establecer el grosor de la línea (por ejemplo, 1 mm)
        $this->SetLineWidth(3);
        // Dibujar una línea (posición X inicial, posición Y inicial, posición X final, posición Y final)
        $this->Line(5, 1, 204, 1);
       
        $id_solicitud=$_GET['numero_solicitud'];
        $numeroInvoiceSendModelo=$_GET['invoiceNumber']; // Asumiendo que numero_solicitud es un parámetro GET
        $getLogo = ReportModel::getJsonFactura($id_solicitud,$numeroInvoiceSendModelo);
        $name=$getLogo[0]->nombre_cliente;   
      
        $numeroInvoice="";
        foreach($getLogo as $datosLogo){

            $datosJson = json_decode($datosLogo->datos, true); // Decodifica como array asociativo
            // $datosJson = json_decode($datosFactura->datos); // Decodifica como objeto
        
            // Acceder a los datos como array asociativo
            $logo = $datosJson['logo'];
            $numeroInvoice = $datosJson['invoice_number'];
            $email=$datosJson['email'];
            $numberTax=$datosJson['number_tax'];
            $adress=$datosJson['adress'];
           
        }
      
        if( $logo=="JairoVargas"){
            $rutaImagen = "../resource/AdminLTE-3.2.0/dist/img/logo1.png";
        }
        elseif ($logo=="patrinium"){
            $rutaImagen = "imgs/logo1.png";
        }
        elseif($logo=="empresa_3"){
            $rutaImagen = "imgs/user_149071.png";
        }
        
     

        $this->Image($rutaImagen,10, 10, 50, 0,'PNG');
        // Configurar la fuente para el título
        $this->SetFont('Arial', 'B', 15);
        // Posiciona el cursor al lado derecho de la imagen
        $this->SetX(70); // Ajusta esta posición según el tamaño de tu imagen
        // Fecha actual
        $dateOfIssue = date('m/d/Y'); // Formato: 05/09/2024
        // Imprime la fecha de emisión
        $this->Cell(0, 10, 'Date of issue: ' . $dateOfIssue, 0, 1, 'C');
        $this->Cell(250, 10, 'Invoice No.'.$numeroInvoice, 0, 1, 'C');
        $this->ln(20);
        

        // Mover a la derecha para el texto de la izquierda del encabezado
        $this->SetY(50);
        $this->SetX(10);
        $this->SetFont('Arial', 'B', 9);
        $this->MultiCell(90, 5, "Patirnium\n\n900 SE Ocean Blvd\nSuite B118\nStuart, Florida 34994\nUnited States of America (USA)\n3059246876\nPatrinium@gmail.com", 0, 'L');

        // Mover a la derecha para el texto del lado derecho del encabezado
        $this->SetY(50);
        $this->SetX(-100); // Esto coloca la posición x justo antes del margen derecho del documento
        $this->MultiCell(90, 5, "Bill to\n\n Email: ". $email."\n Number Tax: ".$numberTax."\n Adress: ".$adress , 0, 'L');

        // Dibuja una línea para separar el encabezado del resto de la página
        
        $this->SetY(60); // Ajusta la posición de la línea según sea necesario
        $this->SetLineWidth(1);
        $this->SetDrawColor(0, 0, 0); // El color del delineado, si necesitas otro color
        $this->Cell(0, 0, '', 'T'); // 'T' significa que se dibujará la parte superior de la celda
        $this->Cell(0, 0, '', 'B', 1, 'C');

        $this->isFirstPage = false; // Indicar que la primera página ya ha sido procesada

    }
}

    // Sobrescribir el método Footer para crear un pie de página personalizado
    function Footer() {
        // Posicionarse a 1.5 cm del final de la página
        $this->SetY(-15);
        // Configurar la fuente para el pie de página
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, 'Página ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

    function ImprovedTable($header, $data) {
        
        // Anchura de las columnas
        
        $w = array(100, 20, 40, 30);
        // Cabecera
        for($i = 0; $i < count($header); $i++)
            $this->Cell($w[$i], 7, $header[$i],  'B');
        $this->Ln();
        // Datos
        foreach($data as $row) {
            $this->Cell($w[0], 10, $row[0], 'B');
            $this->Cell($w[1], 10, $row[1], 'B');
            $this->Cell($w[2], 10, $row[2], 'B');
            $this->Cell($w[3], 10, $row[3], 'B');
            $this->Ln();
        }
        // Línea de cierre
        $this->Cell(array_sum($w), 0, '', 'T');
    }
}




class InvoiceController {
        public function generatePDF() {
            $id_solicitud = $_GET['numero_solicitud']; 
            $numeroInvoiceSendModelo=$_GET['invoiceNumber']; // Asumiendo que numero_solicitud es un parámetro GET
            $getDatosFactura = ReportModel::getJsonFactura($id_solicitud,$numeroInvoiceSendModelo);
            $subtotal = 0;
            $array = [];
            $tax = 0;
            $useProvidedTotal = false;
            $observaciones = '';  // Variable para almacenar las observaciones
            $cuenta_bancaria = 0;  // Variable para almacenar la cuenta bancaria
            foreach ($getDatosFactura as $item) {
                $datosFactura = json_decode($item->datos, true);

                
                if (isset($datosFactura['cuenta_bancaria'])) {
                    $cuenta_bancaria = $datosFactura['cuenta_bancaria'];
                   
                } 

                if(isset($datosFactura['tax'])){
                    $tax = $datosFactura['tax'];
                }   

                // Guarda las observaciones si están presentes
                if (isset($datosFactura['observaciones'])) {
                    $observaciones = $datosFactura['observaciones'];
                }
    
                if (!empty($datosFactura['Total'])) {
                    $subtotal = (float) $datosFactura['Total'];
                    $useProvidedTotal = true;
                } else {
                    if (isset($datosFactura['servicios'])) {
                        foreach ($datosFactura['servicios'] as $key => $servicio) {
                            if (!isset($servicio['valor']) || !isset($servicio['cantidad'])) {
                                continue;
                            }
                            $valor = (float) $servicio['valor'];
                            $cantidad = (int) $servicio['cantidad'];
                            $array[] = array($key, $cantidad, $valor, $valor * $cantidad);
                            $subtotal += $valor * $cantidad;
                        }
                    }
                }
            }
    
           
            
            $pdf = new MyPDF();
            $pdf->AliasNbPages();
            $pdf->AddPage();
    
            $header = array('Description', 'Qty', 'Unit Price', 'Amount');
            $pdf->SetFont('Arial', '', 12);
            $pdf->SetY(105);
            $pdf->ImprovedTable($header, $array, $useProvidedTotal);

            $y = $pdf->GetY() + 10;
            $pdf->SetXY(-215, $y);
            $pdf->Cell(130, 10, '', 0, 0, 'R');
            $pdf->Cell(30, 10, 'SUB TOTAL', 0, 0, 'R');
            $pdf->Cell(30, 10, '$' . number_format($subtotal, 2), 0, 1, 'R');

            if($tax==0){
               
          

            $y = $pdf->GetY() + 1;
            $pdf->SetXY(-215, $y);
            $pdf->Cell(130, 10, '', 0, 0, 'R');
            $pdf->Cell(30, 10, 'TAX', 0, 0, 'R');
            $pdf->Cell(30, 10, '$' . number_format($tax, 2), 0, 1, 'R');            
        

            $y = $pdf->GetY() + 1;
            $pdf->SetXY(-215, $y);
            $pdf->Cell(130, 10, '', 0, 0, 'R');
            $pdf->Cell(30, 10, 'Total', 0, 0, 'R');
            if ($tax < 10) {
                $mult_tax = $tax / 10;
            } else {
                $mult_tax = $tax / 100;
            }
            
            $tax_operacion = 1+$mult_tax;
            
            $pdf->Cell(30, 10, '$' . number_format($subtotal*$tax_operacion,2), 0, 1, 'R');
        }else{
            $y = $pdf->GetY() + 1;
            $pdf->SetXY(-215, $y);
            $pdf->Cell(130, 10, '', 0, 0, 'R');
            $pdf->Cell(30, 10, 'Total', 0, 0, 'R');
            $pdf->Cell(30, 10, '$' . number_format($subtotal, 2), 0, 1, 'R');
        }
            $pdf->Ln(5); 
             // Añadir observaciones si existen
             // Añadir observaciones si existen
        if (!empty($observaciones)) {
            $pdf->SetX(-200);
            $pdf->SetFont('Arial', 'B', 10);  // Cambia la fuente a negrita para el título de observaciones
            $pdf->Cell(30, 10, 'observations:', 0, 0, 'L');
            $pdf->SetFont('Arial', '', 10);   // Cambia la fuente a normal para el contenido de observaciones
            $pdf->MultiCell(160, 10, $observaciones, 0, 'J');  // Ajusta el texto a justificado
        }

            // Información de la cuenta bancaria
            $pdf->Ln(10); 
            $pdf->SetX(-215);
            $pdf->Cell(15, 10, '', 0, 0, 'R');
             // Salto de línea (ajusta según sea necesario
            $pdf->SetFont('Arial', 'B', 10); 

            $datosBanco = ReportModel::getBanco($cuenta_bancaria);
            foreach ($datosBanco as $item) {
                // Añadir celda para nombre del banco
                $pdf->Cell(0, 5, 'Nombre del Banco: ' . $item['nombre_banco'], 0, 1);
                // Añadir celda para nombre de la cuenta
                $pdf->Cell(0, 5, 'Nombre de la Cuenta: ' . $item['nombre_cuenta'], 0, 1);
                // Añadir celda para número de cuenta
                $pdf->Cell(0, 5, 'Número de Cuenta: ' . $item['numero_cuenta'], 0, 1);
                // Añadir celda para ABA
                $pdf->Cell(0, 5, 'ABA (Routing): ' . $item['aba'], 0, 1);
                // Añadir celda para SWIFT
                $pdf->Cell(0, 5, 'SWIFT: ' . $item['swift'], 0, 1);
                // Añadir celda para dirección
                $pdf->Cell(0, 5, 'Dirección: ' . $item['sucursal'], 0, 1);
                // Añadir celda para teléfono
                
            }

            $pdf->Ln(10);    
            // Añadir observaciones si existen
            $pdf->Cell(0, 10, 'Thank you for your Business', 0, 1, 'C');
    
            $pdf->Output();
        }
    }
?>
