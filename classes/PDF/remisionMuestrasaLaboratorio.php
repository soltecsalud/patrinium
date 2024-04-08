<?php
require('../resource/fpdf/fpdf.php');
require ('../resource/php-barcode/barcode.php');
include_once "../classes/Encriptacion/encriptacion.php";


class RemisionMuestrasALaboratorio extends FPDF
{
    protected $listado;
    public function setHeaderData($datos)
    {
        $this->listado = $datos;
    }

    public function Header()
    {
        // Se define aquí el encabezado personalizado
        // Agregar una imagen
        $this->Rect(28.5,$this->GetY()-10 ,525, 80, '');
        $this->Rect(553.5,$this->GetY()-10 ,210, 80, '');
        $this->Image('../resource/AdminLTE-3.2.0/dist/img/Ese-Centro-logo.png',30,20,80,0,'PNG');
   
        // // Arial bold 15
        $this->Cell(0, 10, iconv('UTF-8', 'windows-1252', ""), 0, 1, 'C');
        $this->ln(0);
        $this->SetFont('Arial', 'B', 16);
        $this->Cell(80, 18,"", 0, 0, 'L');

        // Construir título según técnica de tamizaje
        if ($this->listado['tecnica_tamizaje'] == 'ADN VPH') {
            $titulo = "VPH";
        } else {
            $titulo = "Citología";
        }

        $this->MultiCell(445, 18, mb_convert_encoding("Planilla de Remisión de Muestras ".$titulo." a Laboratorio de Referencia", 'UTF-8'), 0, 'C');
        $this->ln(14);
        $barcodePath = '../resource/barcodes/'.$this->listado['num_listado'] .'.png';

        // Verificar si el directorio existe, si no es así, crearlo
        if (!file_exists(dirname($barcodePath))) {
            mkdir(dirname($barcodePath), 0777, true);
        }

        barcode($barcodePath, $this->listado['num_listado'] , 25, 'horizontal', 'code128', true);
        $this->Image('../resource/barcodes/'.$this->listado['num_listado'].'.png',584,40,150,0,'PNG');
        $this->ln(10);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(105, 18, mb_convert_encoding("N° de Petición inicial:", 'UTF-8'), 'LTB', 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(55, 18, mb_convert_encoding("", 'UTF-8'), 'TBR', 0, 'R');
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(105, 18, mb_convert_encoding("N° de Petición final:", 'UTF-8'), 'LTB', 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(55, 18, mb_convert_encoding("", 'UTF-8'), 'TBR', 0, 'R');
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(80, 18, mb_convert_encoding("N° de registros:", 'UTF-8'), 'LTB', 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(24, 18, mb_convert_encoding($this->listado['cantidad_casos'], 'UTF-8'), 'TBR', 0, 'C');
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(105, 18, mb_convert_encoding("Fecha de generación:", 'UTF-8'), 'LTB', 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(60, 18, date('d/m/Y', strtotime($this->listado['create_at'])), 'TBR', 0, 'L');
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(23, 18, mb_convert_encoding("IPS:", 'UTF-8'), 'LTB', 0, 'L');
        $this->SetFont('Arial', '', 10);
        if (strlen($this->listado['ips_remitente']) > 24) {
            $this->listado['ips_remitente'] = substr($this->listado['ips_remitente'], 0, 21) . '...';
        }
        $this->Cell(123, 18, mb_convert_encoding($this->listado['ips_remitente'], 'UTF-8'), 'TBR', 0, 'L');
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

    public function crearRemisionMuestrasALaboratorio($listado, $casos)
    {
        $this->setHeaderData($listado);
        // Se establecen los datos del encabezado
        $this->AddPage('L', 'Letter');
        $this->ln(25);

        // Construye el contenido del PDF

        /*********************************
         * DATOS DEL PACIENTE
         ***********************************/
        if ($listado['tecnica_tamizaje'] == 'ADN VPH') {
            // Este bloque se ejecutará si el listado corresponde al tamizaje VPH
            $titulo1 = 'N° Petición VPH';
            $titulo2 = 'N° Orden VPH';
        } else {
             // Este bloque se ejecutará si el listado corresponde al Citologia
            $titulo1 = 'N° Petición Citología';
            $titulo2 = 'N° Orden Citología';
        }

        $this->SetFont('Arial', 'B', 7);
        $this->SetTextColor(255, 255, 255);
        $this->SetFillColor(104, 185, 46);
        $this->Cell(72, 18,  mb_convert_encoding( $titulo1 ,'UTF-8'), 1, 0, 'C', True);
        $this->Cell(68, 18,  mb_convert_encoding( $titulo2 ,'UTF-8'), 1, 0, 'C', True);
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(66, 18,  mb_convert_encoding( 'Cédula' ,'UTF-8'), 1, 0, 'C', True);
        $this->Cell(140, 18,  mb_convert_encoding( 'Paciente' ,'UTF-8'), 1, 0, 'C', True);
        $this->Cell(62, 18,  mb_convert_encoding( 'F. Nacimiento' ,'UTF-8'), 1, 0, 'C', True);
        $this->Cell(28, 18,  mb_convert_encoding( 'Edad' ,'UTF-8'), 1, 0, 'C', True);
        $this->Cell(111, 18,  mb_convert_encoding( 'EPS' ,'UTF-8'), 1, 0, 'C', True);
        $this->Cell(73, 18,  mb_convert_encoding( 'Fecha de Toma' ,'UTF-8'), 1, 0, 'C', True);
        $this->Cell(115, 18,  mb_convert_encoding( 'Observaciones' ,'UTF-8'), 1, 0, 'C', True);
        $this->ln(18);

        foreach($casos as $data){
            if ($listado['tecnica_tamizaje'] == 'ADN VPH') {
                // Este bloque se ejecutará si el listado corresponde al tamizaje VPH
                $noPeticion = $data['num_peticion_vph'];
                $noOrden = $data['num_orden_vph'];
            } else {
                 // Este bloque se ejecutará si el listado corresponde al Citologia
                 $noPeticion = $data['num_peticion_citologia'];
                 $noOrden = $data['num_orden_citologia'];
            }
            $documento = number_format(Encryption::decrypt($data['num_documento'], 'soltecsalud'),0, ',', '.');
            $nombre = $data['nombres'].' '.$data['apellido'];
            if (strlen($nombre) > 30) {
                $nombre = substr($nombre, 0, 27) . '...';
            }
            if (strlen($data['eps']) > 24) {
                // $data['eps'] = substr($data['eps'], 0, 21) . '...';
                $data['eps'] = ucwords(strtolower(substr($data['eps'], 0, 21))) . '...';
            }else{
                $data['eps'] = ucwords(strtolower($data['eps']));  
            }
            $this->SetTextColor(22, 51, 113);
            $this->SetFont('Arial', '', 9);
            $this->Cell(72, 18,  mb_convert_encoding( $noPeticion ,'UTF-8'), 1, 0, 'C');
            $this->Cell(68, 18,  mb_convert_encoding( $noOrden ,'UTF-8'), 1, 0, 'C');
            $this->Cell(66, 18,  mb_convert_encoding( $documento ,'UTF-8'), 1, 0, 'R');
            $this->Cell(140, 18,  mb_convert_encoding( $nombre ,'UTF-8'), 1, 0, 'L');
            $this->Cell(62, 18,  date('d/m/Y',strtotime($data['f_nacimiento'])), 1, 0, 'R');
            $this->Cell(28, 18,  mb_convert_encoding(  $data['edad']  ,'UTF-8'), 1, 0, 'C');
            $this->Cell(111, 18,  mb_convert_encoding( $data['eps'] ,'UTF-8'), 1, 0, 'L');
            $this->Cell(73, 18,   date('d/m/Y',strtotime($data['fecha_toma'])), 1, 0, 'R');
            $this->Cell(115, 18,  mb_convert_encoding( '' ,'UTF-8'), 1, 0, 'L');
            $this->ln(18);
        }




        // $this->Cell(100, 18,  iconv('UTF-8', 'windows-1252',"Nombre: "), 1, 0, 'L');
        // $this->SetFont('Arial', '', 10);
        // $this->Cell(162.5, 18,  mb_convert_encoding($datos['nombre_paciente'], 'UTF-8'), 1, 0, 'L');
        // $this->SetFont('Arial', 'B', 10);
        // $this->Cell(130, 18,  iconv('UTF-8', 'windows-1252',"Edad: "), 1, 0, 'L');
        // $this->SetFont('Arial', '', 10);
        // $this->Cell(162.5, 18,  iconv('UTF-8', 'windows-1252',  $datos['edad']), 1, 0, 'L');
        // $this->ln(18);

        // $this->SetFont('Arial', '', 10);
        // $this->SetFont('Arial', 'B', 10);
        // $this->Cell(100, 18,  iconv('UTF-8', 'windows-1252',"Gestante: "), 1, 0, 'L');
        // $this->SetFont('Arial', '', 10);
        // $this->Cell(162.5, 18,  iconv('UTF-8', 'windows-1252',$datos['gestante']), 1, 0, 'L');
        // $this->SetFont('Arial', 'B', 10);
        // $this->Cell(130, 18,  iconv('UTF-8', 'windows-1252',"Remision No: "), 1, 0, 'L');
        // $this->SetFont('Arial', '', 10);
        // $this->Cell(162.5, 18,  iconv('UTF-8', 'windows-1252',$datos['consecutivo']), 1, 0, 'L');
        // $this->ln(18);


        // $this->SetFont('Arial', 'B', 10);
        // $this->Cell(100, 18,  iconv('UTF-8', 'windows-1252',"Remitido Por: "), 1, 0, 'L');
        // $this->SetFont('Arial', '', 10);
        // $this->Cell(162.5, 18,  mb_convert_encoding( $datos['remitido_por'], 'UTF-8'), 1, 0, 'L');
        // // $this->SetFont('Arial', 'B', 10);
        // // $this->Cell(130, 18,  iconv('UTF-8', 'windows-1252',"Fecha de Remision: "), 1, 0, 'L');
        // // $this->SetFont('Arial', '', 10);
        // // $this->Cell(162.5, 18,  iconv('UTF-8', 'windows-1252',$datos['fecha_remision']), 1, 0, 'L');
        // $this->SetFont('Arial', 'B', 10);
        // $this->Cell(130, 18,  mb_convert_encoding("Institución: ", 'UTF-8'), 1, 0, 'L');
        // $this->SetFont('Arial', '', 10);
        // $this->Cell(162.5, 18,  iconv('UTF-8', 'windows-1252',$datos['institucion_remite']), 1, 0, 'L');


        // $this->ln(18);

        // $this->SetFont('Arial', 'B', 10);
        // $this->Cell(100, 18,  mb_convert_encoding("Indicación: ", 'UTF-8'), 1, 0, 'L');
        // $this->SetFont('Arial', '', 10);
        // $this->Cell(162.5, 18,   mb_convert_encoding($datos['indicacion'], 'UTF-8'), 1, 0, 'L');
        // $this->SetFont('Arial', 'B', 10);
        // $this->Cell(130, 18,  iconv('UTF-8', 'windows-1252',"Fecha: "), 1, 0, 'L');
        // $this->SetFont('Arial', '', 10);
        // $this->Cell(162.5, 18,  date('d/m/Y', strtotime($datos['created_at'])), 1, 0, 'L');
       
        // $this->ln(18);

        // $this->SetFont('Arial', 'B', 10);
        // $this->Cell(100, 18,  iconv('UTF-8', 'windows-1252',"Tipo de Consulta: "), 1, 0, 'L');
        // $this->SetFont('Arial', '', 10);
        // $this->Cell(162.5, 18,  iconv('UTF-8', 'windows-1252',$datos['tipo_consulta']), 1, 0, 'L');
        // $this->ln(18);

        // $this->SetFont('Arial', 'B', 10);
        // $this->Cell(100, 18,  iconv('UTF-8', 'windows-1252',"Colposcopista: "), 1, 0, 'L');
        // $this->SetFont('Arial', '', 10);
        // $this->Cell(162.5, 18,  iconv('UTF-8', 'windows-1252',$datos['nombre_doctor']), 1, 0, 'L');
        // $this->SetFont('Arial', 'B', 10);
        // $this->Cell(130, 18,  iconv('UTF-8', 'windows-1252',"Tipo Colposcopia: "), 1, 0, 'L');
        // $this->SetFont('Arial', '', 10);
        // $this->Cell(162.5, 18,  iconv('UTF-8', 'windows-1252',$datos['tipo_colposcopia']), 1, 0, 'L');

        /**********************************
        * GRAFICO
        ***********************************/
        // $this->ln(18);
        // $this->ln(18);
        // $this->SetFont('Arial', 'B', 11);
        // $this->SetTextColor(255, 255, 255);
        // $this->SetFillColor(104, 185, 46);
        // $this->Cell(0, 21,   mb_convert_encoding('HALLAZGOS COLPOSCOPICOS:', 'UTF-8'), 1, 0, 'C', True);
        // $this->ln(21);
        // $this->Rect(28.5,$this->GetY() ,555, 280, '');
        // $data = explode(',', $datos['hallazgos_colposcopicos']);
        // $image_data = base64_decode($data[1]);
        // $hallazgos_colposcopicos_image = tempnam(sys_get_temp_dir(), 'pdfimg') . '.png'; // Cambia la extensión según el formato de la imagen
  
        // // Guarda la imagen temporal
        //  file_put_contents($hallazgos_colposcopicos_image, $image_data);
  
   
        // // Convierte la imagen base64 a un archivo temporal
        // if (file_exists($hallazgos_colposcopicos_image)) {
        //     $this->Image($hallazgos_colposcopicos_image, 30, $this->GetY() + 1, 250, 250); 
        // }
        // // Agrega la imagen al PDF

        // unlink($hallazgos_colposcopicos_image);
        // // Elimina el archivo temporal de la imagen

        /********************************************
         * datos grafico
         *******************************************/

        // $this->Cell(555, 10,  iconv('UTF-8', 'windows-1252',""), 0, 0, 'L');
        // $this->ln(6);
        // $this->Cell(300, 18,  iconv('UTF-8', 'windows-1252',""), 0, 0, 'L');
        // $this->SetFillColor(255, 255, 255);
        // $this->Cell(18, 18,  iconv('UTF-8', 'windows-1252',""), 1, 0, 'L', true);
        // $this->SetTextColor(22, 51, 113);
        // $this->SetFont('Arial', '', 10);
        // $this->Cell(237, 18,  iconv('UTF-8', 'windows-1252',"Normal"), 0, 0, 'L');
        // $this->ln(18);
        // $this->Cell(555, 10,  iconv('UTF-8', 'windows-1252',""), 0, 0, 'L');
        // $this->ln(6);
        // $this->Cell(300, 18,  iconv('UTF-8', 'windows-1252',""), 0, 0, 'L');
        // $this->SetFillColor(255, 54, 143);
        // $this->Cell(18, 18,  iconv('UTF-8', 'windows-1252'," "), 1, 0, 'L', true);
        // $this->SetTextColor(22, 51, 113);
        // $this->SetFont('Arial', '', 10);
        // $this->Cell(237, 18,  iconv('UTF-8', 'windows-1252',"Epitelio Columnar"), 0, 0, 'L');
        // $this->ln(18);
        // $this->Cell(555, 10,  iconv('UTF-8', 'windows-1252',""), 0, 0, 'L');
        // $this->ln(6);
        // $this->Cell(300, 18,  iconv('UTF-8', 'windows-1252',""), 0, 0, 'L');
        // $this->SetFillColor(61, 153, 112);
        // $this->Cell(18, 18,  iconv('UTF-8', 'windows-1252'," "), 1, 0, 'L', true);
        // $this->SetTextColor(22, 51, 113);
        // $this->SetFont('Arial', '', 10);
        // $this->Cell(237, 18,  iconv('UTF-8', 'windows-1252',"Zona Acetoblanca"), 0, 0, 'L');
        // $this->ln(18);
        // $this->Cell(555, 10,  iconv('UTF-8', 'windows-1252',""), 0, 0, 'L');
        // $this->ln(6);
        // $this->Cell(300, 18,  iconv('UTF-8', 'windows-1252',""), 0, 0, 'L');
        // $this->SetFillColor(220, 202, 2);
        // $this->Cell(18, 18,  iconv('UTF-8', 'windows-1252'," "), 1, 0, 'L', true);
        // $this->SetTextColor(22, 51, 113);
        // $this->SetFont('Arial', '', 10);
        // $this->Cell(237, 18,  iconv('UTF-8', 'windows-1252',"Leucoplacia"), 0, 0, 'L');
        // $this->ln(18);
        // $this->Cell(555, 10,  iconv('UTF-8', 'windows-1252',""), 0, 0, 'L');
        // $this->ln(6);
        // $this->Cell(300, 18,  iconv('UTF-8', 'windows-1252',""), 0, 0, 'L');
        // $this->SetFillColor(177, 124, 84);
        // $this->Cell(18, 18,  iconv('UTF-8', 'windows-1252'," "), 1, 0, 'L', true);
        // $this->SetTextColor(22, 51, 113);
        // $this->SetFont('Arial', '', 10);
        // $this->Cell(237, 18,  iconv('UTF-8', 'windows-1252',"Base"), 0, 0, 'L');
        // $this->ln(18);
        // $this->Cell(555, 10,  iconv('UTF-8', 'windows-1252',""), 0, 0, 'L');
        // $this->ln(6);
        // $this->Cell(300, 18,  iconv('UTF-8', 'windows-1252',""), 0, 0, 'L');
        // $this->SetFillColor(53, 202, 223);
        // $this->Cell(18, 18,  iconv('UTF-8', 'windows-1252'," "), 1, 0, 'L', true);
        // $this->SetTextColor(22, 51, 113);
        // $this->SetFont('Arial', '', 10);
        // $this->Cell(237, 18,  iconv('UTF-8', 'windows-1252',"Mosaico"), 0, 0, 'L');
        // $this->ln(18);
        // $this->Cell(555, 10,  iconv('UTF-8', 'windows-1252',""), 0, 0, 'L');
        // $this->ln(6);
        // $this->Cell(300, 18,  iconv('UTF-8', 'windows-1252',""), 0, 0, 'L');
        // $this->SetFillColor(255, 143, 199);
        // $this->Cell(18, 18,  iconv('UTF-8', 'windows-1252'," "), 1, 0, 'L', true);
        // $this->SetTextColor(22, 51, 113);
        // $this->SetFont('Arial', '', 10);
        // $this->Cell(237, 18, mb_convert_encoding("Vasos Atípicos", 'UTF-8'), 0, 0, 'L');
        // $this->ln(18);
        // $this->Cell(555, 10,  iconv('UTF-8', 'windows-1252',""), 0, 0, 'L');
        // $this->ln(6);
        // $this->Cell(300, 18,  iconv('UTF-8', 'windows-1252',""), 0, 0, 'L');
        // $this->SetFillColor(255, 0, 0);
        // $this->Cell(18, 18,  iconv('UTF-8', 'windows-1252'," "), 1, 0, 'L', true);
        // $this->SetTextColor(22, 51, 113);
        // $this->SetFont('Arial', '', 10);
        // $this->Cell(237, 18,  iconv('UTF-8', 'windows-1252',"Colpitis"), 0, 0, 'L');
        // $this->ln(18);
        // $this->Cell(555, 10,  iconv('UTF-8', 'windows-1252',""), 0, 0, 'L');
        // $this->ln(6);
        // $this->Cell(300, 18,  iconv('UTF-8', 'windows-1252',""), 0, 0, 'L');
        // $this->SetFillColor(255, 128, 0);
        // $this->Cell(18, 18,  iconv('UTF-8', 'windows-1252'," "), 1, 0, 'L', true);
        // $this->SetTextColor(22, 51, 113);
        // $this->SetFont('Arial', '', 10);
        // $this->Cell(237, 18,  iconv('UTF-8', 'windows-1252',"Sugestiva V. Papova"), 0, 0, 'L');
        // $this->ln(18);
        // $this->Cell(555, 10,  iconv('UTF-8', 'windows-1252',""), 0, 0, 'L');
        // $this->ln(6);
        // $this->Cell(300, 18,  iconv('UTF-8', 'windows-1252',""), 0, 0, 'L');
        // $this->SetFillColor(155, 155, 155);
        // $this->Cell(18, 18,  iconv('UTF-8', 'windows-1252'," "), 1, 0, 'L', true);
        // $this->SetTextColor(22, 51, 113);
        // $this->SetFont('Arial', '', 10);
        // $this->Cell(237, 18,  iconv('UTF-8', 'windows-1252',"Quistes Naboh"), 0, 0, 'L');
        // $this->ln(10);
        // $this->Cell(300, 18,  iconv('UTF-8', 'windows-1252',""), 0, 0, 'L');
        // $this->ln(18);
        // $this->Cell(250, 18,  iconv('UTF-8', 'windows-1252',""), 0, 0, 'L');
        // $this->SetFont('Arial', '', 9);
        // $this->Cell(18, 18,  iconv('UTF-8', 'windows-1252',"Si"), 0, 0, 'L');
        // $this->Cell(18, 18,  iconv('UTF-8', 'windows-1252',"X"), 1, 0, 'C');
        // $this->Cell(18, 18,  iconv('UTF-8', 'windows-1252',"No"), 0, 0, 'L');
        // $this->Cell(18, 18,  iconv('UTF-8', 'windows-1252',"X"), 1, 0, 'C');
        // $this->Cell(52, 18,  iconv('UTF-8', 'windows-1252',"Exo Cervis"), 0, 0, 'L');
        // $this->Cell(18, 18,  iconv('UTF-8', 'windows-1252',"X"), 1, 0, 'C');
        // $this->Cell(55, 18,  iconv('UTF-8', 'windows-1252',"Endo Cervis"), 0, 0, 'L');
        // $this->Cell(18, 18,  iconv('UTF-8', 'windows-1252',"X"), 1, 0, 'C');
        // $this->Cell(60, 18,  iconv('UTF-8', 'windows-1252',"U Esc Colum"), 0, 0, 'L');
        // $this->Cell(18, 18,  iconv('UTF-8', 'windows-1252',"X"), 1, 0, 'C');
        // $this->ln(30);

        // $this->SetFont('Arial', 'B', 11);
        // $this->SetTextColor(255, 255, 255);
        // $this->SetFillColor(104, 185, 46);
        // $this->Cell(262.5, 18,   mb_convert_encoding("I. ANORMAL", 'UTF-8'), 1, 0, 'L', TRUE);
        // $this->Cell(292.5, 18,   mb_convert_encoding("II. HALLAZGO MISCELÁNEOS", 'UTF-8'), 1, 0, 'L', TRUE);
        // $this->ln(18);

        // // $this->Rect(28.5,$this->GetY() ,200, 280, '');
        // $this->Rect(291,$this->GetY() ,292.5, 78, '');
      
        // $this->Cell(555, 6, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        // $this->ln(6);

        // $this->SetTextColor(22, 51, 113);
        // $this->SetFont('Arial', '', 10);
        // $this->Cell(18, 18, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        // $this->Cell(18, 18, mb_convert_encoding("X", 'UTF-8'), 1, 0, 'C');
        // $this->Cell(226.5, 18, mb_convert_encoding("Lesión en la zona de transformación", 'UTF-8'), 0, 0, 'L');

        // $this->Cell(18, 18, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        // $this->Cell(18, 18, mb_convert_encoding("X", 'UTF-8'), 1, 0, 'C');
        // $this->Cell(110.25, 18, mb_convert_encoding("Superficie Micropailar", 'UTF-8'), 0, 0, 'L');
        // $this->Cell(18, 18, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        // $this->Cell(18, 18, mb_convert_encoding("X", 'UTF-8'), 1, 0, 'C');
        // $this->Cell(110.25, 18, mb_convert_encoding("Atrofia", 'UTF-8'), 0, 0, 'L');

        // $this->ln(18);
        
        // $this->Cell(555, 6, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        // $this->ln(6);

        // $this->SetFont('Arial', '', 10);
        // $this->Cell(18, 18, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        // $this->Cell(18, 18, mb_convert_encoding("X", 'UTF-8'), 1, 0, 'C');
        // $this->Cell(226.5, 18, mb_convert_encoding("Lesión fuera de la zona de transformación", 'UTF-8'), 0, 0, 'L');

        // $this->Cell(18, 18, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        // $this->Cell(18, 18, mb_convert_encoding("X", 'UTF-8'), 1, 0, 'C');
        // $this->Cell(110.25, 18, mb_convert_encoding("Condiloma Exofitico", 'UTF-8'), 0, 0, 'L');
        // $this->Cell(18, 18, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        // $this->Cell(18, 18, mb_convert_encoding("X", 'UTF-8'), 1, 0, 'C');
        // $this->Cell(110.25, 18, mb_convert_encoding("Úlcera", 'UTF-8'), 0, 0, 'L');

        // $this->ln(18);
      
        // $this->Cell(555, 6, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        // $this->ln(6);

        // $this->SetFont('Arial', '', 10);
        // $this->Cell(18, 18, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        // $this->Cell(18, 18, mb_convert_encoding("X", 'UTF-8'), 1, 0, 'C');
        // $this->Cell(226.5, 18, mb_convert_encoding("Lesión completamente visible", 'UTF-8'), 0, 0, 'L');

        // $this->Cell(18, 18, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        // $this->Cell(18, 18, mb_convert_encoding("X", 'UTF-8'), 1, 0, 'C');
        // $this->Cell(110.25, 18, mb_convert_encoding("Inflamación", 'UTF-8'), 0, 0, 'L');
        // $this->Cell(18, 18, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        // $this->Cell(18, 18, mb_convert_encoding("X", 'UTF-8'), 1, 0, 'C');
        // $this->Cell(110.25, 18, mb_convert_encoding("Otro", 'UTF-8'), 0, 0, 'L');

        // $this->ln(18);

        // $this->Cell(555, 6, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        // $this->ln(6);

        // $this->SetFont('Arial', '', 10);
        // $this->Cell(18, 18, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        // $this->Cell(18, 18, mb_convert_encoding("X", 'UTF-8'), 1, 0, 'C');
        // $this->Cell(226.5, 18, mb_convert_encoding("Lesión no visible completamente", 'UTF-8'), 0, 0, 'L');

        // $this->SetTextColor(22, 51, 113);
        // $this->SetFont('Arial', '', 10);
        // $this->Cell(292.5, 18,   mb_convert_encoding("III. APARIENCIA DE LA VULVA", 'UTF-8'), 1, 0, 'L', TRUE);
        
        // $this->ln(18);
        // $this->SetTextColor(22, 51, 113);
        // $this->SetFont('Arial', '', 10);
   
        // $this->Rect(291,$this->GetY() ,292.5, 78, '');

        // $this->Cell(555, 6, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        // $this->ln(6);

        // $this->SetTextColor(22, 51, 113);
        // $this->SetFont('Arial', '', 10);
        // $this->Cell(18, 18, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        // $this->Cell(18, 18, mb_convert_encoding("X", 'UTF-8'), 1, 0, 'C');
        // $this->Cell(226.5, 18, mb_convert_encoding("Unión escamo Columnar no visible", 'UTF-8'), 0, 0, 'L');

        // $this->Cell(18, 18, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        // $this->Cell(18, 18, mb_convert_encoding("X", 'UTF-8'), 1, 0, 'C');
        // $this->Cell(110.25, 18, mb_convert_encoding("Normal", 'UTF-8'), 0, 0, 'L');
        // $this->Cell(18, 18, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        // $this->Cell(18, 18, mb_convert_encoding("X", 'UTF-8'), 1, 0, 'C');
        // $this->Cell(110.25, 18, mb_convert_encoding("Leucoplasia", 'UTF-8'), 0, 0, 'L');

        // $this->ln(18);

        // $this->Cell(555, 6, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        // $this->ln(6);

        // $this->SetTextColor(22, 51, 113);
        // $this->SetFont('Arial', 'B', 11);
        // $this->Cell(262.5, 18,   mb_convert_encoding("Cambios menores", 'UTF-8'), 0, 0, 'C');
        
        // $this->SetFont('Arial', '', 10);

        // $this->Cell(18, 18, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        // $this->Cell(18, 18, mb_convert_encoding("X", 'UTF-8'), 1, 0, 'C');
        // $this->Cell(110.25, 18, mb_convert_encoding("Atrófica", 'UTF-8'), 0, 0, 'L');
        // $this->Cell(18, 18, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        // $this->Cell(18, 18, mb_convert_encoding("X", 'UTF-8'), 1, 0, 'C');
        // $this->Cell(110.25, 18, mb_convert_encoding("Eritroplasia", 'UTF-8'), 0, 0, 'L');

        // $this->ln(18);

        // $this->Cell(555, 6, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        // $this->ln(6);

        // $this->SetTextColor(22, 51, 113);
        // $this->SetFont('Arial', '', 10);
        // $this->Cell(18, 18, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        // $this->Cell(18, 18, mb_convert_encoding("X", 'UTF-8'), 1, 0, 'C');
        // $this->Cell(95.25, 18, mb_convert_encoding("Epitelio", 'UTF-8'), 0, 0, 'L');
        // $this->Cell(18, 18, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        // $this->Cell(18, 18, mb_convert_encoding("X", 'UTF-8'), 1, 0, 'C');
        // $this->Cell(95.25, 18, mb_convert_encoding("Punteado Fino", 'UTF-8'), 0, 0, 'L');

        // $this->Cell(18, 18, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        // $this->Cell(18, 18, mb_convert_encoding("X", 'UTF-8'), 1, 0, 'C');
        // $this->Cell(110.25, 18, mb_convert_encoding("Condiloma", 'UTF-8'), 0, 0, 'L');
        // $this->Cell(18, 18, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        // $this->Cell(18, 18, mb_convert_encoding("X", 'UTF-8'), 1, 0, 'C');
        // $this->Cell(110.25, 18, mb_convert_encoding("Tumor", 'UTF-8'), 0, 0, 'L');

        // $this->ln(18);

        // $this->Cell(555, 6, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        // $this->ln(6);

        // $this->SetTextColor(22, 51, 113);
        // $this->SetFont('Arial', 'B', 11);
        // $this->Cell(262.5, 18,   mb_convert_encoding("Cambios Mayores", 'UTF-8'), 0, 0, 'C');

        // $this->SetTextColor(22, 51, 113);
        // $this->SetFont('Arial', '', 10);
        // $this->Cell(292.5, 18,   mb_convert_encoding("IV. APARIENCIA DE LA VAGINA", 'UTF-8'), 1, 0, 'L', TRUE);
       
        // $this->ln(18);

        // $this->Cell(555, 6, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        // $this->ln(6);

        // $this->SetTextColor(22, 51, 113);
        // $this->SetFont('Arial', '', 10);
        // $this->Cell(18, 18, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        // $this->Cell(18, 18, mb_convert_encoding("X", 'UTF-8'), 1, 0, 'C');
        // $this->Cell(95.25, 18, mb_convert_encoding("Mosaico", 'UTF-8'), 0, 0, 'L');
        // $this->Cell(18, 18, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        // $this->Cell(18, 18, mb_convert_encoding("X", 'UTF-8'), 1, 0, 'C');
        // $this->Cell(95.25, 18, mb_convert_encoding("Leucoplasia", 'UTF-8'), 0, 0, 'L');

        // $this->ln(18);
    
        // $this->Cell(555, 6, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        // $this->ln(6);

        // $this->SetTextColor(22, 51, 113);
        // $this->SetFont('Arial', '', 10);
        // $this->Cell(18, 18, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        // $this->Cell(18, 18, mb_convert_encoding("X", 'UTF-8'), 1, 0, 'C');
        // $this->Cell(95.25, 18, mb_convert_encoding("Epitelio", 'UTF-8'), 0, 0, 'L');
        // $this->Cell(18, 18, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        // $this->Cell(18, 18, mb_convert_encoding("X", 'UTF-8'), 1, 0, 'C');
        // $this->Cell(95.25, 18, mb_convert_encoding("Vasos Atípicos", 'UTF-8'), 0, 0, 'L');

        
        // $this->Cell(18, 18, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        // $this->Cell(18, 18, mb_convert_encoding("X", 'UTF-8'), 1, 0, 'C');
        // $this->Cell(110.25, 18, mb_convert_encoding("Normal", 'UTF-8'), 0, 0, 'L');
        // $this->Cell(18, 18, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        // $this->Cell(18, 18, mb_convert_encoding("X", 'UTF-8'), 1, 0, 'C');
        // $this->Cell(110.25, 18, mb_convert_encoding("Anormal", 'UTF-8'), 0, 0, 'L');
        
        // $this->ln(18);

        // $this->Cell(555, 6, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        // $this->ln(6);

        // $this->SetTextColor(22, 51, 113);
        // $this->SetFont('Arial', '', 10);
        // $this->Cell(18, 18, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        // $this->Cell(18, 18, mb_convert_encoding("X", 'UTF-8'), 1, 0, 'C');
        // $this->Cell(95.25, 18, mb_convert_encoding("Punteado Grueso", 'UTF-8'), 0, 0, 'L');

        // $this->ln(18);

        // $this->Cell(555, 6, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        // $this->ln(6);

        // $this->SetFont('Arial', 'B', 11);
        // $this->SetTextColor(255, 255, 255);
        // $this->SetFillColor(104, 185, 46);
        // $this->Cell(0, 21,   mb_convert_encoding(' V. IMPRESIÓN DIAGNÓSTICA', 'UTF-8'), 1, 0, 'C', True);
        // $this->ln(21);

        // $this->Cell(100, 18,  iconv('UTF-8', 'windows-1252',"Requiere Biopsia: "), 1, 0, 'L');
        // $this->SetFont('Arial', '', 10);
        // $this->Cell(162.5, 18,  iconv('UTF-8', 'windows-1252',$datos['requiere_biopsia']), 1, 0, 'L');
        // $this->SetFont('Arial', 'B', 10);
        // $this->Cell(130, 18,  iconv('UTF-8', 'windows-1252',"Colposcopia: "), 1, 0, 'L');
        // $this->SetFont('Arial', '', 10);
        // $this->Cell(162.5, 18,  iconv('UTF-8', 'windows-1252',$datos['colposcopia_res']), 1, 0, 'L');
        // $this->ln(18);

        // $this->SetFont('Arial', 'B', 10);
        // $this->Cell(262.5, 18,  iconv('UTF-8', 'windows-1252',"Colposcopia Insatisfactoria: "), 1, 0, 'L');
        // $this->SetFont('Arial', '', 10);
        // $this->Cell(292.5, 18,  iconv('UTF-8', 'windows-1252',$datos['motivo_insatisfaccion']), 1, 0, 'L');
       
        // $this->ln(18);

        // $this->SetFont('Arial', 'B', 10);
        // $this->Cell(262.5, 18,  iconv('UTF-8', 'windows-1252',"Diagnostico Colposcopicoa: "), 1, 0, 'L');
        // $this->SetFont('Arial', '', 10);
        // $this->Cell(292.5, 18,  iconv('UTF-8', 'windows-1252',$datos['diagnostico']), 1, 0, 'L');
       
        // $this->ln(18);

        // $this->SetFont('Arial', 'B', 10);
        // $this->Cell(555, 18,  iconv('UTF-8', 'windows-1252',"Observaciones: "), 1, 0, 'L');
               
        // $this->ln(18);
        // $this->SetFont('Arial', '', 10);
        // $this->Cell(555, 18,  iconv('UTF-8', 'windows-1252',$datos['observaciones']), 1, 0, 'L');
       
        // $this->ln(18);
        // $this->Cell(292.5, 18,   mb_convert_encoding("", 'UTF-8'), 1, 0, 'L');
        // $this->SetFont('Arial', 'B', 10);
        // $this->Cell(130, 18,  iconv('UTF-8', 'windows-1252',"Colposcopia: "), 1, 0, 'L');
        // $this->SetFont('Arial', '', 10);
        // $this->Cell(162.5, 18,  iconv('UTF-8', 'windows-1252',$datos['colposcopia_res']), 1, 0, 'L');

        // $this->ln(18);
        // $this->ln(18);
        // $this->SetFont('Arial', 'B', 10);
        // $this->Cell(0, 18,  iconv('UTF-8', 'windows-1252',"Membership plan Disclosures:"), 0, 1, 'L');
        // $this->ln(18);
        // $this->SetFont('Arial', '', 10);
        // // $this->Write(16,  iconv('UTF-8', 'windows-1252',$datos->disclosures));
        // $this->ln(18);
        // $this->SetFont('Arial', 'B', 10);
        // $this->Cell(0, 18,  iconv('UTF-8', 'windows-1252',"Acknowledgement"), 0, 1, 'L');
        // // $this->ln(18);
        // $this->SetFont('ZapfDingbats','', 10);
        // $this->Cell(15, 15, "4", 1, 0, 'C');
        // $this->SetFont('Arial', '', 10);
        // $this->Cell(0, 18,  iconv('UTF-8', 'windows-1252',"I have read and understood the Membership plan disclosures"), 0, 1, 'L');
        // $this->ln(18);
  

        // $this->SetTextColor(0, 36, 102);
        // $this->SetFont('Arial', 'B', 10);
        // $this->Cell(185, 18,  iconv('UTF-8', 'windows-1252',"Plan Name"), 1, 0, 'C');
        // $this->SetFont('Arial', 'B', 10);
        // $this->Cell(185, 18,  iconv('UTF-8', 'windows-1252',"Plan Value"), 1, 0, 'C');
        // $this->SetFont('Arial', 'B', 10);
        // $this->Cell(185, 18,  iconv('UTF-8', 'windows-1252',"Payment Frequency"), 1, 0, 'C');
       
        // $this->ln(18);

        // $this->SetFont('Arial', '', 10);
        // $this->SetFont('Arial', '', 10);
        // // $this->Cell(185, 18,  iconv('UTF-8', 'windows-1252',$datos->plan_name), 1, 0, 'C');
        // $this->SetFont('Arial', '', 10);
        // // $this->Cell(185, 18,  iconv('UTF-8', 'windows-1252',$datos->plan_value), 1, 0, 'C');
        // $this->SetFont('Arial', '', 10);
        // // $this->Cell(185, 18,  iconv('UTF-8', 'windows-1252',$datos->payment_frequency), 1, 0, 'C');

        // $this->ln(18);
        // /********************************************
        // * /DATOS DEL PLAN
        // *******************************************/

        // $this->ln(18);
        // $this->ln(18);
        // $this->SetFont('Arial', 'B', 10);
        // $this->Cell(0, 18,  iconv('UTF-8', 'windows-1252',"Recurrent Payment Disclosure:"), 0, 1, 'L');
        // $this->ln(18);
        // $this->SetFont('Arial', '', 10);
        // // $this->Write(16,  iconv('UTF-8', 'windows-1252',$datos->recurring_charges_disclosure));
        // // $this->Write(16,  iconv('UTF-8', 'windows-1252','The only method of payment accepted by '.$company->company_name.' is by automatic debit to a credit or debit card. '.$company->company_name.' is by automatic debit to a credit or debit card. All payments must be made in dollars, legal currency of the United States of America (US$). United States of America (US$). The Subscriber authorizes '.$company->company_name.' to store his/her signature and credit card in the database and to the automatic charge of the monthly subscription to the card, and it is the Cardmember’s card to be used as a method of payment, otherwise it will be charged automatically. Payment method, otherwise the Affiliate will be responsible for the suspension of the the suspension of the Membership Service due to non-payment, and in turn will assume shall be liable for any damages and prejudices arising from its actions or non-compliance.'));
        // $this->ln(18);
        // $this->SetFont('Arial', 'B', 10);
        // $this->Cell(0, 18,  iconv('UTF-8', 'windows-1252',"Acknowledgement"), 0, 1, 'L');
        // // $this->ln(18);
        // $this->SetFont('ZapfDingbats','', 10);
        // $this->Cell(15, 15, "4", 1, 0, 'C');
        // $this->SetFont('Arial', '', 10);
        // $this->Cell(0, 18,  iconv('UTF-8', 'windows-1252',"I understand the recurrent charges disclosure."), 0, 1, 'L');
        // $this->ln(18);

        // $this->ln(18);
        // $this->SetFont('Arial', 'B', 10);
        // $this->Cell(0, 18,  iconv('UTF-8', 'windows-1252',"Cardholder Signature"), 0, 1, 'L');
        
      
        // if ($datos->payment_method == 'Card') {
        //     $firmante =  $datos->first_name_Cardholder.' '. $datos->last_name_Cardholder;
        // }else{
        //     if ($datos->holders_first_name == '' && $datos->holders_last_name == ''){
        //         $firmante =  $datos->first_name.' '. $datos->last_name;
        //     }else{
        //         $firmante =  $datos->holders_first_name.' '. $datos->holders_last_name;
        //     }
        // }

        // $this->ln(38);
        // $this->SetFont('Arial', 'B', 10);
        // $this->Cell(0, 18,  iconv('UTF-8', 'windows-1252',$firmante), 0, 1, 'L');

        return $this; // Devuelve el objeto PDF generado
    }
}