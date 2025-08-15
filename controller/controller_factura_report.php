<?php
require_once('../resource/fpdf/fpdf.php');
require_once('../model/modelFacturareport.php');


class MyPDF extends FPDF
{
    private $isFirstPage = true;
    // Sobrescribir el método Header para crear un encabezado personalizado
    function Header()
    {

        if ($this->isFirstPage) {

            $this->SetDrawColor(37, 40, 80);
            // Establecer el grosor de la línea (por ejemplo, 1 mm)
            $this->SetLineWidth(3);
            // Dibujar una línea (posición X inicial, posición Y inicial, posición X final, posición Y final)
            $this->Line(5, 1, 204, 1);

            $id_solicitud = $_GET['numero_solicitud'];
            $numeroInvoiceSendModelo = $_GET['invoiceNumber']; // Asumiendo que numero_solicitud es un parámetro GET
            if (isset($_GET['table']) && !empty($_GET['table'])) {
                $getLogo = ReportModel::getJsonFacturaRapida($id_solicitud, $numeroInvoiceSendModelo);
                $nombreCliente = $getLogo[0]->nombre_cliente;
                $createAt =$getLogo[0]->created_at;
            } else {
                $getLogo = ReportModel::getJsonFactura($id_solicitud, $numeroInvoiceSendModelo);
                $getCliente = ReportModel::getCliente($id_solicitud, 'sociedad');
                if (empty($getCliente[0])) {
                    $getCliente = ReportModel::getCliente($id_solicitud, 'personas_cliente');
                }

                // $nombreCliente = $getCliente[0];
                $nombreCliente = $getLogo[0]->nombre_obtenido;
            }
            // $name=$getLogo[0]->nombre_cliente;   

            // $getCliente = ReportModel::getCliente($id_solicitud);

            $numeroInvoice = "";
            $nombreEmpresa = "";
            foreach ($getLogo as $datosLogo) {

                $datosJson = json_decode($datosLogo->datos, true); // Decodifica como array asociativo
                // $datosJson = json_decode($datosFactura->datos); // Decodifica como objeto

                // Acceder a los datos como array asociativo
                $logo = $datosJson['logo'];
                $numeroInvoice = $datosJson['invoice_number'];
                $email = $datosJson['email'];
                $numberTax = $datosJson['number_tax'];
                $adress = $datosJson['adress'];
               
            }

            $nombreEmpresa = $getLogo[0]->nombre_empresa;
            // Si existe la ruta del logo, se usa; de lo contrario, se asigna una ruta por defecto
            $logoBase   = $getLogo[0]->ruta_logo ?? '';
            $rutaImagen = file_exists($logoBase) ? $logoBase : 'imgs/logo_empresa.png'; // Ruta por defecto si no se proporciona una imagen
            // $rutaImagen = $getLogo[0]->ruta_logo;

            // if ($logo == "JairoVargas") {
            //     $rutaImagen = "imgs/logo1.png";
            //     $nombreEmpresa = "Jairo Vargas";
            // }
            // elseif ($logo == "patrinium") {
            //     $rutaImagen = "imgs/logo1.png";
            //     $nombreEmpresa = "Patrimonium";
            // }
            // elseif ($logo == "Vargas & Associates") {
            //     $rutaImagen = "imgs/vargasAsso.png";
            //     $nombreEmpresa = "Vargas & Associates";
            // }
            // elseif ($logo == "Tándem International Business Services") {
            //     $rutaImagen = "imgs/logo_empresa.png";
            //     $nombreEmpresa = "Tándem International Business Services";
            // }
            // elseif ($logo == "Lamva Investment") {
            //     $rutaImagen = "imgs/LAMVA.jpg";
            //     $nombreEmpresa = "Lamva Investment";
            // }

            $direccionComun = "Address:\n6355 NW 36 St\nSuite 507\nVirginia Gardens, FL 33166\nEmail: jairo@patrimonium.co\nPh. 305.428.2020";

            // Configurar el encabezado
            // if($rutaImagen == null || $rutaImagen == '') { 
            //     $rutaImagen = "imgs/logo_empresa.png"; // Ruta por defecto si no se proporciona una imagen
            // }
            $this->Image($rutaImagen, 10, 10, 50, 0, 'PNG');
           


            // Configurar la fuente para el título
            $this->SetFont('Arial', 'B', 15);
            // Posiciona el cursor al lado derecho de la imagen
            $this->SetX(100); // Ajusta esta posición según el tamaño de tu imagen
            // Fecha actual
            $dateOfIssue = date('m/d/Y'); // Formato: 05/09/2024
            // Imprime la fecha de emisión
            $this->Cell(0, 10, 'Date of issue: ' . $createAt, 0, 1, 'C');
            $this->SetX(100);
            $this->Cell(0, 10, 'Invoice No. ' . $numeroInvoice, 0, 1, 'C');
            $this->ln(20);

            $this->SetY(45); // Ajusta este valor si el logo es más alto
            $this->SetX(10); // Asegura alineación con el logo
            $this->SetFont('Arial', 'B', 13);
            $this->MultiCell(100, 6, $nombreEmpresa, 0, 'L');

            $this->SetY(60); // Ajusta este valor si el logo es más alto
            $this->SetX(10); // Asegura alineación con el logo
            $this->SetFont('Arial', 'B', 10);
            $this->MultiCell(100, 6, $direccionComun, 0, 'L');


            // Mover a la derecha para el texto del lado derecho del encabezado

            $this->SetY(55);
            $this->SetX(-100); // Esto coloca la posición x justo antes del margen derecho del documento
            $this->SetFont('Arial', 'B', 10);
            $this->MultiCell(90, 5, " Bill to: " . $nombreCliente . "  \nEmail: " . $email . "\nAdress: " . $adress, 0, 'L');

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
    function Footer()
    {
        // Posicionarse a 1.5 cm del final de la página
        $this->SetY(-15);
        // Configurar la fuente para el pie de página
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, 'Página ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
    function splitText($text, $width)
    {
        $words = explode(' ', $text);
        $lines = [];
        $line = '';

        foreach ($words as $word) {
            $testLine = $line . ($line === '' ? '' : ' ') . $word;
            $testWidth = $this->GetStringWidth($testLine);
            if ($testWidth > $width) {
                $lines[] = $line;
                $line = $word;
            } else {
                $line = $testLine;
            }
        }
        if ($line !== '') {
            $lines[] = $line;
        }

        return $lines;
    }

    function ImprovedTable($header, $data)
    {
        $w = array(100, 20, 40, 30);

        // Cabecera
        for ($i = 0; $i < count($header); $i++) {
            $align = ($i === 0) ? 'L' : 'R'; // Solo la primera columna alineada a la izquierda
            $this->Cell($w[$i], 7, $header[$i], 'B', 0, $align);
        }
        $this->Ln();

        // Datos
        foreach ($data as $row) {
            // $this->Cell($w[0], 10, $row[0], 'B'); // Servicio / nombre
            // $this->Cell($w[1], 10, number_format($row[1]), 'B', 0, 'R'); // Cantidad
            // $this->Cell($w[2], 10, number_format($row[2], 2), 'B', 0, 'R'); // Valor unitario
            // $this->Cell($w[3], 10, number_format($row[3], 2), 'B', 0, 'R'); // Total
            // $this->Ln();
            // Primera línea: servicio principal (sin borde inferior)
            //$this->MultiCell(90, 5, $addressInfo, 0, 'L');  
            $x = $this->GetX();
            $y = $this->GetY();

            // Imprimir la MultiCell para la primera columna (con salto si es necesario)
            $this->SetFont('Arial', 'B', 12);
            $this->MultiCell($w[0], 5, $row[0], 0, 'L');
            $this->SetFont('Arial', 'I', 10);
            // Obtener la altura que ocupó el texto de la MultiCell
            $altura = $this->GetY() - $y;

            // Volver a la posición original + avanzar a la derecha después de la primera columna
            $this->SetXY($x + $w[0], $y);

            // Las siguientes celdas (mismo alto que el de la MultiCell)
            $this->Cell($w[1], $altura, number_format($row[1]), 0, 0, 'R');
            $this->Cell($w[2], $altura, number_format($row[2], 2), 0, 0, 'R');
            $this->Cell($w[3], $altura, number_format($row[3], 2), 0, 0, 'R');

            // Saltar a la siguiente línea
            $this->Ln($altura);
            // Segunda línea: nota con sangría (con borde inferior solamente)
            $x = $this->GetX();
            $y = $this->GetY();

            $sangriaX = 5;
            $texto = trim($row[4]);

            // Ancho de texto disponible con sangría aplicada
            $anchoTexto = $w[0] - $sangriaX;

            // Guardar posición inicial
            $this->SetX($x + $sangriaX);

            // Guardar la posición actual
            $inicioY = $this->GetY();

            // Forzar corte manual de texto según ancho
            $lineas = $this->splitText($texto, $anchoTexto);

            foreach ($lineas as $linea) {
                $this->SetX($x + $sangriaX); // aplicar sangría en cada línea
                $this->Cell($anchoTexto, 5, $linea);
                $this->Ln();
            }

            // Calcular altura total utilizada por las líneas de texto
            $finY = $this->GetY();
            $altura = $finY - $inicioY;

            // Dibujar borde inferior solo al final
            // Línea del borde izquierdo del texto
            $this->Line($x, $finY, $x + $w[0], $finY);

            // Celdas vacías alineadas a la derecha con mismo alto
            $this->SetXY($x + $w[0], $inicioY);
            $this->Cell($w[1], $altura, '', 'B');
            $this->Cell($w[2], $altura, '', 'B');
            $this->Cell($w[3], $altura, '', 'B');

            $this->Ln();
        }

        // Línea de cierre
        $this->Cell(array_sum($w), 0, '', 'T');
    }
}




class InvoiceController
{

    public function generatePDF()
    {
        $id_solicitud            = $_GET['numero_solicitud'];
        $numeroInvoiceSendModelo = $_GET['invoiceNumber']; // Asumiendo que numero_solicitud es un parámetro GET
        if (isset($_GET['table']) && !empty($_GET['table'])) {
            $getDatosFactura = ReportModel::getJsonFacturaRapida($id_solicitud, $numeroInvoiceSendModelo);
            // print_r($getDatosFactura);
            // exit();
        } else {
            $getDatosFactura = ReportModel::getJsonFactura($id_solicitud, $numeroInvoiceSendModelo);
        }
        // $getDatosFactura = ReportModel::getJsonFactura($id_solicitud,$numeroInvoiceSendModelo);
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

            if (isset($datosFactura['tax'])) {
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
                        //  || !isset($servicio['check'])
                        if (!isset($servicio['valor']) || !isset($servicio['cantidad'])) {
                            continue;
                        }

                        $nombreServicio = ReportModel::getNombreServicio($key);
                        $key = $nombreServicio[0] ?? $key;

                        $valor    = (float) $servicio['valor'];
                        $cantidad = (int) $servicio['cantidad'];
                        $descripcionservicio = $servicio['descripcionservicio'] ?? '';
                        // Valida si es una factura rapida, si es asi toma el nombre del servicio digitado por el usuario, si no toma el que ya esta en el sistema
                        if (isset($_GET['table']) && !empty($_GET['table'])) {
                            $array[] = array($servicio['nombre'], $cantidad, $valor, $valor * $cantidad, $descripcionservicio);
                        } else {
                            $array[] = array(str_replace('_', ' ', $key), $cantidad, $valor, $valor * $cantidad, $descripcionservicio);
                        }
                        $subtotal += $valor * $cantidad;
                    }
                }
            }
        }


        // print_r($getDatosFactura);
        // exit();



        $pdf = new MyPDF();
        $pdf->AliasNbPages();
        $pdf->AddPage();



        $header = array('Description', 'Qty', 'Unit Price', 'Amount');
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetY(105);
        $pdf->ImprovedTable($header, $array, $useProvidedTotal);

        $y = $pdf->GetY() + 10;
        $pdf->SetXY(-200, $y);
        $pdf->Cell(115, 10, '', 0, 0, 'R');
        $pdf->Cell(30, 10, 'SUB TOTAL', 0, 0, 'R');
        $pdf->Cell(30, 10, '$' . number_format($subtotal, 2), 0, 1, 'R');



        if ($tax == 0) {

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

            $tax_operacion = 1 + $mult_tax;

            $pdf->Cell(30, 10, '$' . number_format($subtotal * $tax_operacion, 2), 0, 1, 'R');
        } else {
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
            $pdf->Cell(30, 5, 'Observations:', 0, 0, 'L');
            $pdf->SetFont('Arial', '', 10);   // Cambia la fuente a normal para el contenido de observaciones
            $pdf->MultiCell(160, 5, $observaciones, 0, 'J');  // Ajusta el texto a justificado
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
            // Añadir celda para Routing ACH
            $pdf->Cell(0, 5, 'Routing ACH: ' . $item['routing_ach'], 0, 1);
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
