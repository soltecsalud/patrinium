<?php
    require('../resource/fpdf/fpdf.php');
    require_once '../model/modelPlantillas.php';

    // Lista completa de checklistItems
    $checklistItems = [
        "General and specific Delaware's Corporation - Advice / Consulting",
        "Letter of Delivery",
        "Delaware Company Guidebook",
        "Mandate Agreement",
        "Draft - Preparation of Certificate of Formation",
        "Certificate of Formation with Apostille de la Hague",
        "Authentication (True and Correct Copy) Certificate Of Formation",
        "Certified Copy of the Certificate of Formation",
        "Company Information Details",
        "Minutes of the First Meeting of the Members",
        "Minutes of the Meeting of the Assembly of Members",
        "Operating Agreement",
        "Register of Members",
        "Statement of Authorized Person",
        "POA to open Checking Account",
        "Bank Account Information",
        "Certificate of Good Standing",
        "Form SS-4",
    ];

    $consultar     = ModelPlantillas::selectChecklist($_GET['sociedad'],$_GET['idSolicitud']);
    $selectedItems = json_decode($consultar[0]['datos'], true);
    
    // Convertir los elementos seleccionados en un array clave-valor para búsqueda rápida
    $selectedMap = [];
    foreach ($selectedItems as $item) {
        $selectedMap[$item['text']] = true;
    }

    // Unir ambas listas asegurando que los nuevos elementos de $dataArray también se incluyan
    $fullChecklist = array_merge($checklistItems, array_keys($selectedMap));
    $fullChecklist = array_unique($fullChecklist);

    // Crear instancia de FPDF
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 12);

    // Encabezado
    $pdf->Cell(190, 10, 'Checklist de Documentos Entregados', 0, 1, 'C');
    $pdf->Ln(5);

    $pdf->SetFont('Arial', 'B', 10);

    // Encabezado con formato especial
    $pdf->Cell(140, 14, '', 0, 0, 'C');
    // $pdf->Cell(130, 14, '', 1, 0, 'C');
    
    // Celda combinada para "Delivered"
    $pdf->Cell(50, 7, 'Delivered', 1, 1, 'C');
    
    // Subencabezados YES y NOT
    $pdf->Cell(140, 7, '', 0, 0); // Espacio vacío
    $pdf->Cell(25, 7, 'YES', 1, 0, 'C');
    $pdf->Cell(25, 7, 'NOT', 1, 1, 'C');

    // Cuerpo de la tabla
    $pdf->SetFont('Arial', '', 10);
    $index = 1;

    foreach ($fullChecklist as $item) { 
        $delivered = isset($selectedMap[$item]) ? 'X' : ''; // Marcar si está en la selección
    
        $pdf->Cell(10, 7, $index, 1, 0, 'C'); 
        $pdf->Cell(130, 7, mb_convert_encoding($item,'UTF-8'), 1, 0, 'L');
        $pdf->Cell(25, 7, $delivered, 1, 0, 'C'); // Marcar con "X" si fue entregado
        $pdf->Cell(25, 7, ($delivered == '') ? 'X' : '', 1, 1, 'C'); // Marcar "Not" si no fue entregado
        $index++;
    }

    // Salida del PDF
    $pdf->Output('D', 'Lista_verificacion.pdf');
?>
