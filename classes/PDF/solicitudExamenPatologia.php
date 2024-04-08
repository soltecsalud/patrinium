<?php
require_once('../resource/fpdf/fpdf.php');
require_once('../resource/php-barcode/barcode.php');
include_once "../classes/Encriptacion/encriptacion.php";


class ImprimirSolicitudExamenPatologia extends FPDF
{
    /* protected $citologo;
    public function setHeaderData($datos)
    {
        $this->citologo = $datos;
    } */

    public function Header()
    {
        // Se define aquí el encabezado personalizado
        // Agregar una imagen
        $this->Image('../resource/AdminLTE-3.2.0/dist/img/Ese-Centro-logo.png', 30, 20, 90, 0, 'PNG');
        $this->Image('../views/imgs/Sello-Icontec-SUA-2019-1.png', 520, 20, 40, 55, 'PNG');
        $this->Cell(0, 10, iconv('UTF-8', 'windows-1252', ""), 0, 1, 'C');
        $this->ln(0);
        $this->SetFont('Arial', 'B', 13);
        $this->Cell(65, 18, "", 0, 0, 'L');
        $this->MultiCell(430, 18, mb_convert_encoding("SOLICITUD DE EXAMEN DE PATOLOGIA", 'UTF-8'), 0, 'C');
        $this->ln(14);
        $this->SetFont('Arial', '', 8);
        $this->Cell(520, 18, iconv('UTF-8', 'windows-1252', "053"), 0, 1, 'R');
        $this->ln(0);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(470, 18, iconv('UTF-8', 'windows-1252', ""), 0, 0, 'R');
        $this->Cell(85, 18, iconv('UTF-8', 'windows-1252', "APD-F-47"), 'TB', 0, 'C');
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

    public function crearImpresionSolicitudExmanen()
    {
        // $this->setHeaderData($doctor);
        // Se establecen los datos del encabezado
        $this->AddPage('P', 'Letter');
        $this->ln(36);

        $this->SetFont('Arial', '', 9);
        /* $this->SetTextColor(255, 255, 255);
        $this->SetFillColor(104, 185, 46); */
        $this->Cell(78, 18,  mb_convert_encoding('Fecha de Entrega:', 'UTF-8'), 0, 0, 'L');
        $this->Cell(390, 18,  mb_convert_encoding('09/03/2024', 'UTF-8'), 0, 0, 'L');
        $this->Cell(90, 18,  mb_convert_encoding('24000047PNR', 'UTF-8'), 'B', 0, 'C');
        $this->ln(18);
        // $this->SetFont('Arial', 'B', 8);
        $this->Cell(72, 18,  mb_convert_encoding('Biopsias Previas:', 'UTF-8'), 0, 0, 'L');
        $this->Cell(395, 18,  mb_convert_encoding('Si', 'UTF-8'), 0, 0, 'L');
        $this->Cell(91, 18,  mb_convert_encoding('N° de Historia', 'UTF-8'), 0, 0, 'C');
        $this->ln(18);

        $this->Cell(78, 18,  mb_convert_encoding('N° de Documento:', 'UTF-8'), 0, 0, 'L');
        $this->Cell(110, 18,  mb_convert_encoding('1007412611', 'UTF-8'), 0, 0, 'L');
        /*         $this->Cell(73, 18,  mb_convert_encoding( 'Fecha de Toma' ,'UTF-8'), 1, 0, 'C', True);
        $this->Cell(115, 18,  mb_convert_encoding( 'Observaciones' ,'UTF-8'), 1, 0, 'C', True); */
        $this->ln(25);


        $this->SetFont('Arial', '', 9);
        $this->Cell(80, 18,  mb_convert_encoding('Nombre Completo:', 'UTF-8'), 'T', 0, 'L');
        $this->Cell(200, 18,  mb_convert_encoding('SANDRA LORENA TORIJANO', 'UTF-8'), 'T', 0, 'L');
        $this->Cell(30, 18,  mb_convert_encoding('EPS:', 'UTF-8'), 'T', 0, 'L');
        $this->Cell(250, 18,  mb_convert_encoding('Secretaria De Salud Departamental Del Valle Del Cauca', 'UTF-8'), 'T', 0, 'L');
        $this->ln(18);
        $this->Cell(40, 18,  mb_convert_encoding('Edad:', 'UTF-8'), 'B', 0, 'L');
        $this->Cell(40, 18,  mb_convert_encoding('22', 'UTF-8'), 'B', 0, 'C');
        $this->Cell(50, 18,  mb_convert_encoding('Sexo:', 'UTF-8'), 'B', 0, 'L');
        $this->Cell(150, 18,  mb_convert_encoding('F', 'UTF-8'), 'B', 0, 'L');
        $this->Cell(65, 18,  mb_convert_encoding('Institucion:', 'UTF-8'), 'B', 0, 'L');
        $this->Cell(215, 18,  mb_convert_encoding('Laboratorio Clinico Externo', 'UTF-8'), 'B', 0, 'L');
        $this->ln(36);

        $this->SetFont('Arial', '', 9);
        $this->Cell(90, 18,  mb_convert_encoding('Diagnostico Clinico:', 'UTF-8'), 0, 0, 'L');
        $this->ln(18);
        $this->Cell(200, 18,  mb_convert_encoding('De alto grado', 'UTF-8'), 0, 0, 'L');
        $this->ln(108);

        $this->SetFont('Arial', '', 9);
        $this->Cell(150, 18,  mb_convert_encoding('Datos Clinicos del Laboratorio:', 'UTF-8'), 0, 0, 'L');
        $this->ln(18);
        $this->Cell(200, 18,  mb_convert_encoding('Biopsia Nic 3', 'UTF-8'), 0, 0, 'L');
        $this->ln(72);

        $this->SetFont('Arial', '', 9);
        $this->Cell(100, 18,  mb_convert_encoding('Operacion Realizada:', 'UTF-8'), 0, 0, 'L');
        $this->Cell(120, 18,  mb_convert_encoding('Conizacion', 'UTF-8'), 0, 0, 'L');
        $this->ln(18);
        $this->Cell(100, 18,  mb_convert_encoding('Hallazgos Operatorios:', 'UTF-8'), 0, 0, 'L');
        $this->Cell(120, 18,  mb_convert_encoding('Nic 3', 'UTF-8'), 0, 0, 'L');
        $this->ln(36);

        $this->SetFont('Arial', '', 9);
        $this->Cell(100, 54,  mb_convert_encoding('Tejidos Enviados:', 'UTF-8'), 0, 0, 'L');
        $this->Cell(61, 18,  mb_convert_encoding('Especimen A:', 'UTF-8'), 0, 0, 'L');
        $this->Cell(70, 18,  mb_convert_encoding('Exocenvix', 'UTF-8'), 0, 0, 'L');
        $this->ln(18);
        $this->Cell(161, 18,  mb_convert_encoding('Especimen B:', 'UTF-8'), 0, 0, 'R');
        $this->Cell(70, 18,  mb_convert_encoding('Endoxenvis', 'UTF-8'), 0, 0, 'L');
        $this->ln(18);
        $this->Cell(161, 18,  mb_convert_encoding('Especimen C:', 'UTF-8'), 0, 0, 'R');
        $this->Cell(70, 18,  mb_convert_encoding('Endoxenvis', 'UTF-8'), 0, 0, 'L');



        return $this; // Devuelve el objeto PDF generado
    }
}
