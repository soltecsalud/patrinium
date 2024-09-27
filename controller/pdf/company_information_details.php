<?php
require_once('../resource/fpdf/fpdf.php');

class PDFController extends FPDF {
    private $companyDetails;

    // Constructor para recibir el array de datos
    public function __construct($companyDetails) {
        parent::__construct(); // Llamar al constructor de FPDF
        $this->companyDetails = $companyDetails; // Guardar los detalles de la compañía
    }
    // Encabezado del PDF
      // Encabezado del PDF
      function Header() {
        $this->SetFont('Arial', 'B', 16);

        // Nombre del cliente
        if (isset($this->companyDetails->nombre_llc)) {
            $this->Cell(0, 10, $this->companyDetails->nombre_llc, 0, 1, 'C'); // Centrar el nombre del cliente
        } else {
            $this->Cell(0, 10, 'N/A', 0, 1, 'C');
        }
        $this->Ln(2);
       
        
        if (isset($this->companyDetails->nombre_cliente) && isset($this->companyDetails->apellido_cliente)) {
            
            $srFile = '( '.$this->companyDetails->nombre_cliente . ' ' . $this->companyDetails->apellido_cliente.' )';
            $this->SetFont('Arial', 'B', 18);
            $this->Cell(0, 10, $srFile, 0, 1, 'C'); // Centrar SR y FILE
        } else {
            $this->Cell(0, 10, 'SR and FILE not available', 0, 1, 'C');
        }
        $this->Ln(2);

        $this->SetFont('Arial', '', 6);
        $this->Cell(0, 6, '(A Delaware Limited Liability Company)', 0, 1, 'C'); // Centrar Company Information

        // SR y FILE
        if (isset($this->companyDetails->sr_numero) ){
            $srFile = 'SR ' . $this->companyDetails->sr_numero;
            $this->SetFont('Arial', '', 12);
            $this->Cell(0, 10, $srFile, 0, 1, 'C'); // Centrar SR y FILE
        } else {
            $this->Cell(0, 10, 'SR and FILE not available', 0, 1, 'C');
        }
        $this->Ln(5);

        // Información de la compañía
        $this->SetFont('Arial', 'B', 18);
        $this->Cell(0, 10, 'COMPANY INFORMATION DETAILS', 0, 1, 'C'); // Centrar Company Info
        $this->Ln(10);
    }

    // Pie de página
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

    function CompanyDetails($companyDetails) {
        // Obtener los datos de la compañía
        
        $this->SetFont('Arial', 'B', 12);
        
        // Dibujar un rectángulo para encerrar el área
        $x = 10; // Margen izquierda
        $y = 50; // Margen superior
       

        // Colocar el cursor dentro del rectángulo para agregar el contenido
        $this->SetXY($x + 25, $y + 20); // Margen dentro del rectángulo

        // Simular viñetas y agregar contenido dentro del rectángulo
        $bullet = "• ";  // Símbolo de viñeta

        // Verificar si el array no está vacío y contiene un objeto stdClass
        
            // Accedemos al primer objeto en el array
           
    
            // Imprimir cada propiedad con la sintaxis correcta para objetos
            $this->SetXY($x + 25, $y + 25);
            $this->Cell(0, 10, $bullet . 'Datexzx of Organization and Registration: ' . (isset($companyDetails->date_organization) ? $companyDetails->date_organization : 'N/A'), 0, 1);
            $this->SetXY($x + 25, $y + 35);
            $this->Cell(0, 10, $bullet . 'State of Organization: ' . (isset($companyDetails->state_organization) ? $companyDetails->state_organization : 'N/A'), 0, 1);
            $this->SetXY($x + 25, $y + 45);
            $this->Cell(0, 10, $bullet . 'Principal Place of Business: ' . (isset($companyDetails->principal_business) ? $companyDetails->principal_business : 'N/A'), 0, 1);
            $this->SetXY($x + 25, $y + 55);
            $this->Cell(0, 10, $bullet . 'Managing Members: ' . (isset($companyDetails->managing_members) ? $companyDetails->managing_members : 'N/A'), 0, 1);
            $this->SetXY($x + 25, $y + 65);
            $this->Cell(0, 10, $bullet . 'Bank Account: ' . (isset($companyDetails->bank_account) ? $companyDetails->bank_account : 'N/A'), 0, 1);
            $this->SetXY($x + 25, $y + 75);
            $this->Cell(0, 10, $bullet . 'Fiscal Year: ' . (isset($companyDetails->fiscal_year) ? $companyDetails->fiscal_year : 'N/A'), 0, 1);
            $this->SetXY($x + 25, $y + 85);
            $this->Cell(0, 10, $bullet . 'EIN: ' . (isset($companyDetails->ein) ? $companyDetails->ein : 'N/A'), 0, 1);
            $this->SetXY($x + 25, $y + 95);
            $this->Cell(0, 10, $bullet . 'Date of Annual Meeting: ' . (isset($companyDetails->date_annual_meeting) ? $companyDetails->date_annual_meeting : 'N/A'), 0, 1);
            $this->SetXY($x + 25, $y + 105);
            $this->Cell(0, 10, $bullet . 'Secretary: ' . (isset($companyDetails->secretary) ? $companyDetails->secretary : 'N/A'), 0, 1);
            $this->SetXY($x + 25, $y + 115);
            $this->Cell(0, 10, $bullet . 'Treasurer: ' . (isset($companyDetails->treasurer) ? $companyDetails->treasurer : 'N/A'), 0, 1);
            $this->SetXY($x + 25, $y + 125);
            $this->Cell(0, 10, $bullet . 'Members: ' . (isset($companyDetails->members) ? $companyDetails->members : 'N/A'), 0, 1);
            $this->SetXY($x + 25, $y + 135);
            $this->Cell(0, 10, $bullet . 'Initial Temporal Manager: ' . (isset($companyDetails->initial_manager) ? $companyDetails->initial_manager : 'N/A'), 0, 1);
    
        
    }
}
?>
