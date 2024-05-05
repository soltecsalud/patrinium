<?php
require_once( '../resource/fpdf/fpdf.php');
require_once ('../model/modelFacturareport.php');


class MyPDF extends FPDF {
    // Sobrescribir el método Header para crear un encabezado personalizado
    function Header() {
        
        $this->SetDrawColor(37, 40, 80);
        // Establecer el grosor de la línea (por ejemplo, 1 mm)
        $this->SetLineWidth(3);
        // Dibujar una línea (posición X inicial, posición Y inicial, posición X final, posición Y final)
        $this->Line(5, 1, 204, 1);
       
        
        $getLogo=  ReportModel::getJsonFactura();
        foreach($getLogo as $datosLogo){

            $datosJson = json_decode($datosLogo->datos, true); // Decodifica como array asociativo
            // $datosJson = json_decode($datosFactura->datos); // Decodifica como objeto
        
            // Acceder a los datos como array asociativo
            $logo = $datosJson['logo'];
           
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
        $dateOfIssue = date('F j, Y'); // Formato: April 16, 2024
        // Imprime la fecha de emisión
        $this->Cell(0, 10, 'Date of issue: ' . $dateOfIssue, 0, 1, 'C');
        $this->Cell(250, 10, 'Invoice', 0, 1, 'C');
        $this->ln(20);
        

        // Mover a la derecha para el texto de la izquierda del encabezado
        $this->SetY(50);
        $this->SetX(10);
        $this->SetFont('Arial', 'B', 9);
        $this->MultiCell(90, 5, "Patirnium\n\n900 SE Ocean Blvd\nSuite B118\nStuart, Florida 34994\nUnited States of America (USA)\n3059246876\nmembercloudmarketing@gmail.com", 0, 'L');

        // Mover a la derecha para el texto del lado derecho del encabezado
        $this->SetY(50);
        $this->SetX(-100); // Esto coloca la posición x justo antes del margen derecho del documento
        $this->MultiCell(90, 5, "Bill to\n\nJuan Pablo Izquierdo\nizquierdoJuan@gmail.com", 0, 'L');

        // Dibuja una línea para separar el encabezado del resto de la página
        
        $this->SetY(60); // Ajusta la posición de la línea según sea necesario
        $this->SetLineWidth(1);
        $this->SetDrawColor(0, 0, 0); // El color del delineado, si necesitas otro color
        $this->Cell(0, 0, '', 'T'); // 'T' significa que se dibujará la parte superior de la celda
        $this->Cell(0, 0, '', 'B', 1, 'C');

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

        $getDatosFactura=  ReportModel::getJsonFactura();
        foreach($getDatosFactura as $datosFactura){

            $datosFactura = json_decode($datosFactura->datos, true); // Decodifica como array asociativo
            // $datosJson = json_decode($datosFactura->datos); // Decodifica como objeto
        
            // Acceder a los datos como array asociativo
           
            $total = $datosFactura['Total'];
            $letterOfDelivery = 1;
            $generalAdvice = 2;
            $cuentaBancaria = $datosFactura['cuenta_bancaria'];
            $array = array();
            $comprobacion=0;
            if (empty($letterOfDelivery)) {

                $comprobacion=1;

            }else{
                array_push($array,array('Letter of Delivery', '1', $letterOfDelivery, $letterOfDelivery));
            }
            if (empty($generalAdvice)) {

                $comprobacion=15;

            }else{
                array_push($array,array('General Corporation Advice Consulting', '1', $generalAdvice, $generalAdvice));
            }

        }
        $total_impr=0;
        if(isset($total)){
            $total_impr = $total;
        }else{
            $total_impr = 17000;
        }

        $pdf = new MyPDF();
        $pdf->AliasNbPages();
        $pdf->AddPage();
     
       
        
     
       
        
   
        // Títulos de las columnas
        $pdf->SetFont('Arial', 'B', 12);
        $header = array('Description', 'Qty', 'Unit Price', 'Amount');
        // Datos de la factura
        $pdf->SetFont('Arial', '', 12);
        $data =  $array;

        // Posición en la página
        $pdf->SetY(105);
        $pdf->ImprovedTable($header, $data);

        // Ajustamos la posición para los totales
        $y = $pdf->GetY() + 5;
        $pdf->SetXY(-215, $y);
        $pdf->Cell(130, 10, '', 0, 0, 'R');
        $pdf->Cell(30, 10, 'Subtotal', 0, 0, 'R');
        $pdf->Cell(30, 10,'$'.$total_impr.'.00', 0, 1, 'R');

        $pdf->SetX(-215);
        $pdf->Cell(130, 10, '', 0, 0, 'R');
        $pdf->Cell(30, 10, 'Total', 0, 0, 'R');
        $pdf->Cell(30, 10,'$'.$total_impr.'.00', 0, 1, 'R');

        $pdf->SetX(-215);
        $pdf->Cell(130, 10, '', 0, 0, 'R');
        $pdf->Cell(30, 10, 'Amount due', 0, 0, 'R');
        $pdf->Cell(30, 10,'$'.$total_impr.'.00', 0, 1, 'R');

        $pdf->Cell(90, 10,'Transferir a Cuenta bancaria No  '.$cuentaBancaria.'  Banco xxx', 0, 1, 'R');
       
        
        

        $pdf->Output();
    }



}
?>