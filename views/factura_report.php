<?php
require_once '../controller/controller_factura_report.php';


$controller = new InvoiceController();
$controller->generatePDF();


?>