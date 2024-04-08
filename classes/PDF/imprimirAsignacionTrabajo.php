<?php
require('../resource/fpdf/fpdf.php');
require ('../resource/php-barcode/barcode.php');
include_once "../classes/Encriptacion/encriptacion.php";


class ImprimirAsignacionTrabajoCitologo extends FPDF
{
    protected $citologo;
    public function setHeaderData($datos)
    {
        $this->citologo = $datos;
    }

    public function Header()
    {
        // Se define aquí el encabezado personalizado
        // Agregar una imagen
        $this->Rect(28.5,$this->GetY()-10 ,950, 70, '');
        $this->Image('../resource/AdminLTE-3.2.0/dist/img/Ese-Centro-logo.png',30,20,80,0,'PNG');
   
        // // Arial bold 15
        $this->Cell(0, 10, iconv('UTF-8', 'windows-1252', ""), 0, 1, 'C');
        $this->ln(0);
        $this->SetFont('Arial', 'B', 24);
        $this->Cell(80, 18,"", 0, 0, 'L');

        $this->MultiCell(0, 25, mb_convert_encoding("Asignacion de Trabajos Citologicos", 'UTF-8'), 0, 'C');
        $this->ln(28);
    
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(118, 18, mb_convert_encoding("Citologo Asignado:", 'UTF-8'), 0, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $nombres = isset($this->citologo['nombres']) ? $this->citologo['nombres'] : '';
        $apellidos = isset($this->citologo['apellidos']) ? $this->citologo['apellidos'] : '';
        $this->Cell(800, 18, mb_convert_encoding($nombres.' '.$apellidos, 'UTF-8'), 0, 0, 'L');
        $this->ln(18);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(130, 18, mb_convert_encoding("Fecha de Asignación:", 'UTF-8'), 0, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(800, 18, '1/03/2024', 0, 0, 'L');
    }

    public function Footer()
    {
        // Se define aquí el pie de página personalizado
        $fecha_actual = date("Y-m-d");
        $hora_actual = date("H:i:s a");
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(60, 10, iconv('UTF-8', 'windows-1252', 'Impreso el ' . $fecha_actual . ' a las ' . $hora_actual), 0, 0, 'L');
        $this->Cell(0, 10, iconv('UTF-8', 'windows-1252', 'Page ' . $this->PageNo()), 0, 0, 'C');
        $this->Cell(0, 10, iconv('UTF-8', 'windows-1252', 'Powered by SoltecSalud'), 0, 0, 'R', 0, 'https://www.soltecsalud.com');
    }

    public function crearImpresionAsignarTrabajoCitologo($casos, $doctor)
    {
        $this->setHeaderData($doctor);
        // Se establecen los datos del encabezado
        $this->AddPage('L', 'Legal');
        $this->ln(20);

        $this->SetFont('Arial', 'B', 7);
        $this->SetTextColor(255, 255, 255);
        $this->SetFillColor(104, 185, 46);
        $this->Cell(72, 18,  mb_convert_encoding( 'N° Orden' ,'UTF-8'), 1, 0, 'C', True);
        $this->Cell(68, 18,  mb_convert_encoding( 'N° Peticion' ,'UTF-8'), 1, 0, 'C', True);
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(66, 18,  mb_convert_encoding( 'F. Toma' ,'UTF-8'), 1, 0, 'C', True);
        $this->Cell(90, 18,  mb_convert_encoding( 'N° Documento' ,'UTF-8'), 1, 0, 'C', True);
        $this->Cell(110, 18,  mb_convert_encoding( 'Nombres' ,'UTF-8'), 1, 0, 'C', True);
        $this->Cell(110, 18,  mb_convert_encoding( 'Apellidos' ,'UTF-8'), 1, 0, 'C', True);
        $this->Cell(25, 18,  mb_convert_encoding( 'Edad' ,'UTF-8'), 1, 0, 'C', True);
/*         $this->Cell(73, 18,  mb_convert_encoding( 'Fecha de Toma' ,'UTF-8'), 1, 0, 'C', True);
        $this->Cell(115, 18,  mb_convert_encoding( 'Observaciones' ,'UTF-8'), 1, 0, 'C', True); */
        $this->ln(18);

        foreach($casos as $data){

            $noOrden = $data['num_orden_citologia'];
            $noPeticion = $data['num_peticion_citologia'];
            $documento = number_format(Encryption::decrypt($data['num_documento'], 'soltecsalud'),0, ',', '.');
            $nombre = $data['nombres'];
            $apellido = $data['apellido'];
            $this->SetTextColor(22, 51, 113);
            $this->SetFont('Arial', '', 9);
            $this->Cell(72, 18,  mb_convert_encoding( $noOrden ,'UTF-8'), 1, 0, 'C');
            $this->Cell(68, 18,  mb_convert_encoding( $noPeticion ,'UTF-8'), 1, 0, 'C');
            $this->Cell(66, 18,  mb_convert_encoding( $data['fecha_toma'] ,'UTF-8'), 1, 0, 'C');
            $this->Cell(90, 18,  mb_convert_encoding( $documento ,'UTF-8'), 1, 0, 'C');
            $this->Cell(110, 18,  mb_convert_encoding( $nombre ,'UTF-8'), 1, 0, 'C');
            $this->Cell(110, 18,  mb_convert_encoding( $apellido ,'UTF-8'), 1, 0, 'C');
            $this->Cell(25, 18,  mb_convert_encoding( $data['edad'] ,'UTF-8'), 1, 0, 'C');
            $this->ln(18);
        }

        return $this; // Devuelve el objeto PDF generado
    }
}