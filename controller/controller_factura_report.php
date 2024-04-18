<?php
require_once( '../resource/fpdf/fpdf.php');
require_once ('../model/modelFacturareport.php');


class MyPDF extends FPDF {
    // Sobrescribir el método Header para crear un encabezado personalizado
    function Header() {
        $this->Image('../resource/AdminLTE-3.2.0/dist/img/logo1.png',30,20,50,0,'PNG');
        // Configurar la fuente para el título
        $this->ln(50);
        $this->SetFont('Arial', 'B', 25);
        // Configura la celda para el título
        $this->Cell(0, 10, 'advance invoice', 0, true, 'C');
        // Agregar una línea para separar
        $this->Cell(0, 10, '', 'B', true, 'C');
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
}

class InvoiceController {
    public function generatePDF() {
        $pdf = new MyPDF();
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12);

        $data = $this->getDataForPDF();
        $header = ['Description', 'Qty', 'Unit Price', 'Amount'];
        $this->createTable($pdf, $header, $data);

        $pdf->Output();
    }

    private function getDataForPDF() {
        // Simula obtener datos
        return [
            ["Minutes of the First Meeting", "1", "$35.00", "$35.00"]
        ];
    }

    private function createTable($pdf, $header, $data) {
        $pdf->SetFillColor(200, 220, 255);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(128, 0, 0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('', 'B');

        $w = array(100, 25, 35, 30);
        foreach ($header as $col)
            $pdf->Cell($w[array_search($col, $header)], 7, $col, 1, 0, 'C', true);
        $pdf->Ln();

        $pdf->SetFillColor(224, 235, 255);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');
        foreach ($data as $row) {
            foreach ($row as $col => $value)
                $pdf->Cell($w[$col], 6, $value, 'LR', 0, 'R', $col % 2 == 0);
            $pdf->Ln();
        }
        $pdf->Cell(array_sum($w), 0, '', 'T');
    }
}
?>