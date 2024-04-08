<?php
require_once('../resource/fpdf/fpdf.php');
require_once('../resource/php-barcode/barcode.php');
include_once "../classes/Encriptacion/encriptacion.php";


class ImprimirColposcopiaBiopsia extends FPDF
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
        $this->MultiCell(430, 18, mb_convert_encoding("HC COLPOSCOPIA BIOPSIA", 'UTF-8'), 0, 'C');
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

    public function crearImpresionColposcopiaBiopsia()
    {
        // $this->setHeaderData($doctor);
        // Se establecen los datos del encabezado
        $this->AddPage('P', 'Letter');
        $this->ln(36);

        $this->SetFont('Arial', 'B', 9);
        $this->Cell(50, 18,  mb_convert_encoding('Nombre:', 'UTF-8'), 0, 0, 'L');
        $this->SetFont('Arial', '', 9);
        $this->Cell(204, 18,  mb_convert_encoding('SANDRA LILIANA TORIJANO CASTRO', 'UTF-8'), 0, 0, 'L');
        // $this->Cell(204, 18, mb_convert_encoding('Nombre:', 'UTF-8'), 0, 0, 'L');
        // $this->ln(18);
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(50, 18,  mb_convert_encoding('Fecha:', 'UTF-8'), 0, 0, 'L');
        $this->SetFont('Arial', '', 9);
        $this->Cell(130, 18,  mb_convert_encoding('', 'UTF-8'), 0, 0, 'L');
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(60, 18,  mb_convert_encoding('Fecha de:', 'UTF-8'), 0, 0, 'L');
        $this->SetFont('Arial', '', 9);
        $this->Cell(50, 18,  mb_convert_encoding('10/03/2024', 'UTF-8'), 0, 0, 'L');
        $this->ln(18);

        $this->SetFont('Arial', 'B', 9);
        $this->Cell(50, 18,  mb_convert_encoding('Direccion:', 'UTF-8'), 0, 0, 'L');
        $this->SetFont('Arial', '', 9);
        $this->Cell(204, 18,  mb_convert_encoding('CRA 26 F# 97-43', 'UTF-8'), 0, 0, 'L');
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(50, 18,  mb_convert_encoding('Telefono:', 'UTF-8'), 0, 0, 'L');
        $this->SetFont('Arial', '', 9);
        $this->Cell(130, 18,  mb_convert_encoding('3182256364', 'UTF-8'), 0, 0, 'L');
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(30, 18,  mb_convert_encoding('Edad:', 'UTF-8'), 0, 0, 'L');
        $this->SetFont('Arial', '', 9);
        $this->Cell(50, 18,  mb_convert_encoding('22', 'UTF-8'), 0, 0, 'L');
        $this->ln(25);


        $this->SetFont('Arial', 'B', 9);
        $this->Cell(50, 18,  mb_convert_encoding('Entidad:', 'UTF-8'), 'TB', 0, 'L');
        $this->SetFont('Arial', '', 9);
        $this->Cell(205, 18,  mb_convert_encoding('Laboratorio Clinico Externo', 'UTF-8'), 'TB', 0, 'C');
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(50, 18,  mb_convert_encoding('Motivo De:', 'UTF-8'), 'TB', 0, 'L');
        $this->SetFont('Arial', '', 9);
        $this->Cell(250, 18,  mb_convert_encoding('', 'UTF-8'), 'TB', 0, 'C');
        $this->ln(25);

        $this->SetFont('Arial', 'B', 9);
        $this->Cell(50, 18,  mb_convert_encoding('MENARC:', 'UTF-8'), 0, 0, 'L');
        $this->SetFont('Arial', '', 9);
        $this->Cell(204, 18,  mb_convert_encoding('MENARC', 'UTF-8'), 0, 0, 'L');
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(52, 18,  mb_convert_encoding('CLICLOS:', 'UTF-8'), 0, 0, 'L');
        $this->SetFont('Arial', '', 9);
        $this->Cell(250, 18,  mb_convert_encoding('MENARC', 'UTF-8'), 0, 0, 'L');
        $this->ln(18);

        $this->SetFont('Arial', 'B', 9);
        $this->Cell(30, 18,  mb_convert_encoding('FUR:', 'UTF-8'), 0, 0, 'L');
        $this->SetFont('Arial', '', 9);
        $this->Cell(224, 18,  mb_convert_encoding('FUR', 'UTF-8'), 0, 0, 'L');
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(40, 18,  mb_convert_encoding('GPAC:', 'UTF-8'), 0, 0, 'L');
        $this->SetFont('Arial', '', 9);
        $this->Cell(262, 18,  mb_convert_encoding('GPAC', 'UTF-8'), 0, 0, 'L');
        $this->ln(18);

        $this->SetFont('Arial', 'B', 9);
        $this->Cell(70, 18,  mb_convert_encoding('Inicio de Vida:', 'UTF-8'), 0, 0, 'L');
        $this->SetFont('Arial', '', 9);
        $this->Cell(60, 18,  mb_convert_encoding('', 'UTF-8'), 0, 0, 'L');
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(35, 18,  mb_convert_encoding('Años:', 'UTF-8'), 0, 0, 'L');
        $this->SetFont('Arial', '', 9);
        $this->Cell(89, 18,  mb_convert_encoding('', 'UTF-8'), 0, 0, 'L');
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(75, 18,  mb_convert_encoding('Enfermedades:', 'UTF-8'), 0, 0, 'L');
        $this->SetFont('Arial', '', 9);
        $this->Cell(227, 18,  mb_convert_encoding('', 'UTF-8'), 0, 0, 'L');
        $this->ln(18);

        $this->SetFont('Arial', 'B', 9);
        $this->Cell(60, 18,  mb_convert_encoding('N°. Parejas:', 'UTF-8'), 0, 0, 'L');
        $this->SetFont('Arial', '', 9);
        $this->Cell(40, 18,  mb_convert_encoding('', 'UTF-8'), 0, 0, 'L');
        $this->ln(25);

        $this->SetFont('Arial', 'B', 9);
        $this->Cell(80, 18,  mb_convert_encoding('Edad del Primer:', 'UTF-8'), 'T', 0, 'L');
        $this->SetFont('Arial', '', 9);
        $this->Cell(174, 18,  mb_convert_encoding('', 'UTF-8'), 'T', 0, 'L');
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(80, 18,  mb_convert_encoding('Edad del Ultimo:', 'UTF-8'), 'T', 0, 'L');
        $this->SetFont('Arial', '', 9);
        $this->Cell(225, 18,  mb_convert_encoding('', 'UTF-8'), 'T', 0, 'L');
        $this->ln(18);

        $this->SetFont('Arial', 'B', 9);
        $this->Cell(52, 18,  mb_convert_encoding('Citologia:', 'UTF-8'), 0, 0, 'L');
        $this->SetFont('Arial', '', 9);
        $this->Cell(202, 18,  mb_convert_encoding('', 'UTF-8'), 0, 0, 'L');
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(60, 18,  mb_convert_encoding('Resultado:', 'UTF-8'), 0, 0, 'L');
        $this->SetFont('Arial', '', 9);
        $this->Cell(245, 18,  mb_convert_encoding('', 'UTF-8'), 0, 0, 'L');
        $this->ln(18);

        $this->SetFont('Arial', 'B', 9);
        $this->Cell(80, 18,  mb_convert_encoding('Citologia Actual:', 'UTF-8'), 0, 0, 'L');
        $this->SetFont('Arial', '', 9);
        $this->Cell(174, 18,  mb_convert_encoding('', 'UTF-8'), 0, 0, 'L');
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(60, 18,  mb_convert_encoding('Resultado:', 'UTF-8'), 0, 0, 'L');
        $this->SetFont('Arial', '', 9);
        $this->Cell(245, 18,  mb_convert_encoding('', 'UTF-8'), 0, 0, 'L');
        $this->ln(18);

        $this->SetFont('Arial', 'B', 9);
        $this->Cell(150, 18,  mb_convert_encoding('Tratamiento Realizados a Nivel:', 'UTF-8'), 0, 0, 'L');
        $this->SetFont('Arial', '', 9);
        $this->Cell(409, 18,  mb_convert_encoding('', 'UTF-8'), 0, 0, 'L');
        $this->ln(18);

        $this->SetFont('Arial', 'B', 9);
        $this->Cell(70, 18,  mb_convert_encoding('Planificaion:', 'UTF-8'), 'B', 0, 'L');
        $this->SetFont('Arial', '', 9);
        $this->Cell(184 , 18,  mb_convert_encoding('', 'UTF-8'), 'B', 0, 'L');
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(35, 18,  mb_convert_encoding('Fuma:', 'UTF-8'), 'B', 0, 'L');
        $this->SetFont('Arial', '', 9);
        $this->Cell(89, 18,  mb_convert_encoding('', 'UTF-8'), 'B', 0, 'L');
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(75, 18,  mb_convert_encoding('Toma Licor:', 'UTF-8'), 'B', 0, 'L');
        $this->SetFont('Arial', '', 9);
        $this->Cell(106, 18,  mb_convert_encoding('', 'UTF-8'), 'B', 0, 'L');
        $this->ln(18);

        $this->SetFont('Arial', 'B', 9);
        $this->Cell(120, 18,  mb_convert_encoding('Antecedentes Personales:', 'UTF-8'), 0, 0, 'L');
        $this->SetFont('Arial', '', 9);
        $this->Cell(174, 18,  mb_convert_encoding('', 'UTF-8'), 0, 0, 'L');
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(120, 18,  mb_convert_encoding('Antecedentes Personales:', 'UTF-8'), 0, 0, 'L');
        $this->SetFont('Arial', '', 9);
        $this->Cell(145, 18,  mb_convert_encoding('', 'UTF-8'), 0, 0, 'L');
        $this->ln(18);

        return $this; // Devuelve el objeto PDF generado
    }
}
