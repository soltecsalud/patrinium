<?php
require_once '../controller/pdf/company_information_details.php';
require_once '../model/modelPdf.php';

$datos = 1; // ID de la solicitud
$respuesta = ModelPdf::obtenerDatosAdicionales($datos);


$companyDetails = $respuesta[0]; // Primer objeto en el array

// Crear una instancia de PDFController y pasar los datos
$pdf = new PDFController($companyDetails);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->CompanyDetails($companyDetails); // Pasar el array de nuevo si es necesario
$pdf->Output();



?>