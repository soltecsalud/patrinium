<?php
require('../resource/fpdf/fpdf.php');


class ReporteColposcopia extends FPDF
{
    public function Header()
    {
        // Se define aquí el encabezado personalizado
        // Agregar una imagen
     
        $this->Image('../resource/AdminLTE-3.2.0/dist/img/Ese-Centro-logo.png',30,20,100,0,'PNG');
        $this->Image('../views/imgs/Sello-Icontec-SUA-2019-1.png',520,20,40,55,'PNG');
        // // Arial bold 15
        $this->Cell(0, 18, iconv('UTF-8', 'windows-1252', ""), 0, 1, 'C');
        $this->ln(0);
        $this->SetFont('Arial', 'B', 16);
        $this->Cell(0, 18, iconv('UTF-8', 'windows-1252', "INFORME COLPOSCOPIO"), 0, 1, 'C');
        $this->ln(14);
        $this->SetFont('Arial', '', 8);
        $this->Cell(520, 8, iconv('UTF-8', 'windows-1252', "053"), 0, 1, 'R');
        $this->ln(4);
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
        $this->Cell(60, 10, mb_convert_encoding('Impreso el ' . $fecha_actual . ' a las ' . $hora_actual,'UTF-8'), 0, 0, 'L');
        $this->Cell(0, 10, mb_convert_encoding('Página ' . $this->PageNo(),'UTF-8'), 0, 0, 'C');
        $this->Cell(0, 10, mb_convert_encoding('Powered by SoltecSalud','UTF-8'), 0, 0, 'R', 0, 'https://www.soltecsalud.com');
    }

    public function crearReporteColposcopia($datos)
    {
        $this->AddPage('P', 'Legal');
        $this->ln(15);

        // Construye el contenido del PDF

        /*********************************
         * DATOS DEL PACIENTE
         ***********************************/

        $this->SetFont('Arial', 'B', 11);
        $this->SetTextColor(255, 255, 255);
        $this->SetFillColor(104, 185, 46);
        $this->Cell(0, 21, mb_convert_encoding('Datos del Paciente','UTF-8'), 1, 0, 'C', True);
        $this->ln(21);

        $this->SetTextColor(22, 51, 113);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(100, 18, mb_convert_encoding("Nombre: ",'UTF-8'), 1, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(162.5, 18,  mb_convert_encoding($datos['nombre_paciente'], 'UTF-8'), 1, 0, 'L');
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(130, 18, mb_convert_encoding("Edad: ",'UTF-8'), 1, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(162.5, 18,  mb_convert_encoding($datos['edad'],'UTF-8' ), 1, 0, 'L');
        $this->ln(18);

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

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(100, 18, mb_convert_encoding("Remitido Por: ",'UTF-8'), 1, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(162.5, 18,  mb_convert_encoding( $datos['remitido_por'], 'UTF-8'), 1, 0, 'L');
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(130, 18,  mb_convert_encoding("Institución: ", 'UTF-8'), 1, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(162.5, 18,  iconv('UTF-8', 'windows-1252',$datos['institucion_remite']), 1, 0, 'L');


        $this->ln(18);

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(100, 18, mb_convert_encoding("Indicación: ", 'UTF-8'), 1, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(162.5, 18, mb_convert_encoding($datos['indicacion'], 'UTF-8'), 1, 0, 'L');
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(130, 18, mb_convert_encoding("Fecha: ",'UTF-8'), 1, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(162.5, 18,  date('d/m/Y', strtotime($datos['created_at'])), 1, 0, 'L');
       
        // $this->ln(18);

        // $this->SetFont('Arial', 'B', 10);
        // $this->Cell(100, 18,  iconv('UTF-8', 'windows-1252',"Tipo de Consulta: "), 1, 0, 'L');
        // $this->SetFont('Arial', '', 10);
        // $this->Cell(162.5, 18,  iconv('UTF-8', 'windows-1252',$datos['tipo_consulta']), 1, 0, 'L');
        // $this->ln(18);

        // $this->SetFont('Arial', 'B', 10);
        // $this->Cell(130, 18,  iconv('UTF-8', 'windows-1252',"Tipo Colposcopia: "), 1, 0, 'L');
        // $this->SetFont('Arial', '', 10);
        // $this->Cell(162.5, 18,  iconv('UTF-8', 'windows-1252',$datos['tipo_colposcopia']), 1, 0, 'L');

        /**********************************
        * GRAFICO
        ***********************************/
        $this->ln(18);
        $this->SetFont('Arial', 'B', 11);
        $this->SetTextColor(255, 255, 255);
        $this->SetFillColor(104, 185, 46);
        $this->Cell(0, 18,   mb_convert_encoding('HALLAZGOS COLPOSCOPICOS:', 'UTF-8'), 1, 0, 'C', True);
        $this->ln(18);

        $this->Rect(28.5,$this->GetY() ,555, 255, '');

        $data = explode(',', $datos['hallazgos_colposcopicos']);
        $image_data = base64_decode($data[1]);
        $hallazgos_colposcopicos_image = tempnam(sys_get_temp_dir(), 'pdfimg') . '.png'; // Cambia la extensión según el formato de la imagen
  
        // Guarda la imagen temporal
         file_put_contents($hallazgos_colposcopicos_image, $image_data);
  
   
        // Convierte la imagen base64 a un archivo temporal
        if (file_exists($hallazgos_colposcopicos_image)) {
            $this->Image($hallazgos_colposcopicos_image, 30, $this->GetY() + 1, 250, 250); 
        }
        // Agrega la imagen al PDF

        unlink($hallazgos_colposcopicos_image);
        // Elimina el archivo temporal de la imagen

        /********************************************
         * datos grafico
         *******************************************/
        $cadena = $datos['items_grafico'];
        $decoded = str_getcsv(trim($cadena, '{}'));
        
        foreach ($decoded as &$value) {
            $value = ($value=='t') ? true : false;
        }

        $this->Cell(555, 4,  iconv('UTF-8', 'windows-1252',""), 0, 0, 'L');
        $this->ln(4);
        $this->Cell(300, 18,  iconv('UTF-8', 'windows-1252',""), 0, 0, 'L');
        $this->SetFillColor(255, 255, 255);
        $this->SetTextColor(22, 51, 113);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(18, 18, (isset($decoded[0]) && $decoded[0]) ? 'X' : '', 1, 0, 'L', true);
        $this->SetTextColor(22, 51, 113);
        $this->SetFont('Arial', '', 10);
        $this->Cell(237, 18,  iconv('UTF-8', 'windows-1252',"Normal"), 0, 0, 'L');
        $this->ln(18);
        $this->Cell(555, 4,  iconv('UTF-8', 'windows-1252',""), 0, 0, 'L');
        $this->ln(4);

        $this->Cell(300, 18,  iconv('UTF-8', 'windows-1252',""), 0, 0, 'L');
        $this->SetFillColor(255, 54, 143);
        $this->SetTextColor(255, 255, 255);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(18, 18, (isset($decoded[1]) && $decoded[1]) ? 'X' : '', 1, 0, 'C', true);
        $this->SetTextColor(22, 51, 113);
        $this->SetFont('Arial', '', 10);
        $this->Cell(237, 18,  iconv('UTF-8', 'windows-1252',"Epitelio Columnar"), 0, 0, 'L');
        $this->ln(18);
        $this->Cell(555, 4,  iconv('UTF-8', 'windows-1252',""), 0, 0, 'L');
        $this->ln(4);
        $this->Cell(300, 18,  iconv('UTF-8', 'windows-1252',""), 0, 0, 'L');
        $this->SetFillColor(61, 153, 112);
        $this->SetTextColor(255, 255, 255);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(18, 18, (isset($decoded[2]) && $decoded[2]) ? 'X' : '', 1, 0, 'C', true);
        $this->SetTextColor(22, 51, 113);
        $this->SetFont('Arial', '', 10);
        $this->Cell(237, 18,  iconv('UTF-8', 'windows-1252',"Zona Acetoblanca"), 0, 0, 'L');
        $this->ln(18);
        $this->Cell(555, 4,  iconv('UTF-8', 'windows-1252',""), 0, 0, 'L');
        $this->ln(4);
        $this->Cell(300, 18,  iconv('UTF-8', 'windows-1252',""), 0, 0, 'L');
        $this->SetFillColor(220, 202, 2);
        $this->SetTextColor(255, 255, 255);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(18, 18, (isset($decoded[3]) && $decoded[3]) ? 'X' : '', 1, 0, 'C', true);
        $this->SetTextColor(22, 51, 113);
        $this->SetFont('Arial', '', 10);
        $this->Cell(237, 18,  iconv('UTF-8', 'windows-1252',"Leucoplacia"), 0, 0, 'L');
        $this->ln(18);
        $this->Cell(555, 4,  iconv('UTF-8', 'windows-1252',""), 0, 0, 'L');
        $this->ln(4);
        $this->Cell(300, 18,  iconv('UTF-8', 'windows-1252',""), 0, 0, 'L');
        $this->SetFillColor(177, 124, 84);
        $this->SetTextColor(255, 255, 255);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(18, 18, (isset($decoded[4]) && $decoded[4]) ? 'X' : '', 1, 0, 'C', true);
        $this->SetTextColor(22, 51, 113);
        $this->SetFont('Arial', '', 10);
        $this->Cell(237, 18,  iconv('UTF-8', 'windows-1252',"Base"), 0, 0, 'L');
        $this->ln(18);
        $this->Cell(555, 4,  iconv('UTF-8', 'windows-1252',""), 0, 0, 'L');
        $this->ln(4);
        $this->Cell(300, 18,  iconv('UTF-8', 'windows-1252',""), 0, 0, 'L');
        $this->SetFillColor(53, 202, 223);
        $this->SetTextColor(255, 255, 255);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(18, 18, (isset($decoded[5]) && $decoded[5]) ? 'X' : '', 1, 0, 'C', true);
        $this->SetTextColor(22, 51, 113);
        $this->SetFont('Arial', '', 10);
        $this->Cell(237, 18,  iconv('UTF-8', 'windows-1252',"Mosaico"), 0, 0, 'L');
        $this->ln(18);
        $this->Cell(555, 4,  iconv('UTF-8', 'windows-1252',""), 0, 0, 'L');
        $this->ln(4);
        $this->Cell(300, 18,  iconv('UTF-8', 'windows-1252',""), 0, 0, 'L');
        $this->SetFillColor(255, 143, 199);
        $this->SetTextColor(255, 255, 255);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(18, 18, (isset($decoded[6]) && $decoded[6]) ? 'X' : '', 1, 0, 'C', true);
        $this->SetTextColor(22, 51, 113);
        $this->SetFont('Arial', '', 10);
        $this->Cell(237, 18, mb_convert_encoding("Vasos Atípicos", 'UTF-8'), 0, 0, 'L');
        $this->ln(18);
        $this->Cell(555, 4,  iconv('UTF-8', 'windows-1252',""), 0, 0, 'L');
        $this->ln(4);
        $this->Cell(300, 18,  iconv('UTF-8', 'windows-1252',""), 0, 0, 'L');
        $this->SetFillColor(255, 0, 0);
        $this->SetTextColor(255, 255, 255);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(18, 18, (isset($decoded[7]) && $decoded[7]) ? 'X' : '', 1, 0, 'C', true);
        $this->SetTextColor(22, 51, 113);
        $this->SetFont('Arial', '', 10);
        $this->Cell(237, 18,  iconv('UTF-8', 'windows-1252',"Colpitis"), 0, 0, 'L');
        $this->ln(18);
        $this->Cell(555, 4,  iconv('UTF-8', 'windows-1252',""), 0, 0, 'L');
        $this->ln(4);
        $this->Cell(300, 18,  iconv('UTF-8', 'windows-1252',""), 0, 0, 'L');
        $this->SetFillColor(255, 128, 0);
        $this->SetTextColor(255, 255, 255);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(18, 18, (isset($decoded[8]) && $decoded[8]) ? 'X' : '', 1, 0, 'C', true);
        $this->SetTextColor(22, 51, 113);
        $this->SetFont('Arial', '', 10);
        $this->Cell(237, 18,  iconv('UTF-8', 'windows-1252',"Sugestiva V. Papova"), 0, 0, 'L');
        $this->ln(18);
        $this->Cell(555, 4,  iconv('UTF-8', 'windows-1252',""), 0, 0, 'L');
        $this->ln(4);
        $this->Cell(300, 18,  iconv('UTF-8', 'windows-1252',""), 0, 0, 'L');
        $this->SetFillColor(155, 155, 155);
        $this->SetTextColor(255, 255, 255);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(18, 18, (isset($decoded[9]) && $decoded[9]) ? 'X' : '', 1, 0, 'C', true);
        $this->SetTextColor(22, 51, 113);
        $this->SetFont('Arial', '', 10);
        $this->Cell(237, 18,  iconv('UTF-8', 'windows-1252',"Quistes Naboh"), 0, 0, 'L');
        $this->ln(10);
        $this->Cell(300, 18,  iconv('UTF-8', 'windows-1252',""), 0, 0, 'L');
        $this->ln(18);
        $this->Cell(250, 18,  iconv('UTF-8', 'windows-1252',""), 0, 0, 'L');
        $this->SetFont('Arial', '', 9);
        $this->Cell(18, 18,  iconv('UTF-8', 'windows-1252',"Si"), 0, 0, 'L');
        $this->Cell(18, 18,  $datos['vista_uec']=='Si'? 'X' : '' , 1, 0, 'C');
        $this->Cell(18, 18,  iconv('UTF-8', 'windows-1252',"No"), 0, 0, 'L');
        $this->Cell(18, 18,  $datos['vista_uec']=='No'? 'X' : '' , 1, 0, 'C');

        function pgArrayParse($literal){
            if ($literal == '') return;
            // Remover caracteres no deseados
            $literal = str_replace(['{', '}'], '', $literal);
            // Separar los valores por comas
            $values = explode(',', $literal);
            // Limpiar cada valor
            foreach ($values as &$value) {
                $value = trim($value);
                // Si el valor está entre comillas, remover las comillas y escaparlas
                if (strpos($value, '"') === 0 && strrpos($value, '"') === strlen($value) - 1) {
                    $value = trim($value, '"');
                    $value = str_replace('\\"', '"', $value);
                }
            }
            return $values;
        }
        
        
        $zonas_uec = pgArrayParse($datos['zonas_uec']);
        
        $this->Cell(52, 18,  iconv('UTF-8', 'windows-1252',"Exo Cervix"), 0, 0, 'L');
        $this->Cell(18, 18, $datos['vista_uec']=='Si'?'': (in_array('Exo Cervix', $zonas_uec) ? 'X' : ''), 1, 0, 'C');
        $this->Cell(55, 18,  iconv('UTF-8', 'windows-1252',"Endo Cervix"), 0, 0, 'L');
        $this->Cell(18, 18,$datos['vista_uec']=='Si'?'':( in_array('Endo Cervix', $zonas_uec) ? 'X' : ''), 1, 0, 'C');
        $this->Cell(60, 18,  iconv('UTF-8', 'windows-1252',"U Esc Colum"), 0, 0, 'L');
        $this->Cell(18, 18, $datos['vista_uec']=='Si'?'':(in_array('U Esc Colum',  $zonas_uec) ? 'X' : ''), 1, 0, 'C');
        $this->ln(25);

        $this->SetFont('Arial', 'B', 11);
        $this->SetTextColor(255, 255, 255);
        $this->SetFillColor(104, 185, 46);
        $this->Cell(262.5, 18,   mb_convert_encoding("I. ANORMAL", 'UTF-8'), 1, 0, 'L', TRUE);
        $this->Cell(292.5, 18,   mb_convert_encoding("II. HALLAZGO MISCELÁNEOS", 'UTF-8'), 1, 0, 'L', TRUE);
        $this->ln(18);

        $this->Rect(28.5,$this->GetY() ,262.5, 246, '');
        $this->Rect(291,$this->GetY() ,292.5, 70, '');
      
        $this->Cell(555, 4, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        $this->ln(4);

        $motivo_insatisfaccion = pgArrayParse($datos['motivo_insatisfaccion']);
        $this->SetTextColor(22, 51, 113);
        $this->SetFont('Arial', '', 10);
        $this->Cell(18, 18, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        $this->Cell(18, 18, $datos['colposcopia_res']=="Normal"?'':(in_array('Lesión en la zona de transformación', $motivo_insatisfaccion) ? 'X' : ''), 1, 0, 'C');
        $this->Cell(226.5, 18, mb_convert_encoding("Lesión en la zona de transformación", 'UTF-8'), 0, 0, 'L');

        $this->Cell(18, 18, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        $this->Cell(18, 18, $datos['hallazgos_miselaneos']=='Superficie Micropailar' ? 'X' : '', 1, 0, 'C');
        $this->Cell(110.25, 18, mb_convert_encoding("Superficie Micropailar", 'UTF-8'), 0, 0, 'L');
        $this->Cell(18, 18, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        $this->Cell(18, 18, $datos['hallazgos_miselaneos']=='Atrofia' ? 'X' : '', 1, 0, 'C');
        $this->Cell(110.25, 18, mb_convert_encoding("Atrofia", 'UTF-8'), 0, 0, 'L');

        $this->ln(18);
        
        $this->Cell(555, 4, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        $this->ln(4);

        $this->SetFont('Arial', '', 10);
        $this->Cell(18, 18, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        $this->Cell(18, 18, $datos['colposcopia_res']=="Normal"?'':(in_array('Lesión fuera de la zona de transformación', $motivo_insatisfaccion) ? 'X' : ''), 1, 0, 'C');
        $this->Cell(226.5, 18, mb_convert_encoding("Lesión fuera de la zona de transformación", 'UTF-8'), 0, 0, 'L');

        $this->Cell(18, 18, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        $this->Cell(18, 18, $datos['hallazgos_miselaneos']=='Condiloma Exofitico' ? 'X' : '', 1, 0, 'C');
        $this->Cell(110.25, 18, mb_convert_encoding("Condiloma Exofitico", 'UTF-8'), 0, 0, 'L');
        $this->Cell(18, 18, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        $this->Cell(18, 18, $datos['hallazgos_miselaneos']=='Úlcera' ? 'X' : '', 1, 0, 'C');
        $this->Cell(110.25, 18, mb_convert_encoding("Úlcera", 'UTF-8'), 0, 0, 'L');

        $this->ln(18);
      
        $this->Cell(555, 4, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        $this->ln(4);

        $this->SetFont('Arial', '', 10);
        $this->Cell(18, 18, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        $this->Cell(18, 18, $datos['colposcopia_res']=="Normal"?'':(in_array('Lesión completamente visible', $motivo_insatisfaccion) ? 'X' : ''), 1, 0, 'C');
        $this->Cell(226.5, 18, mb_convert_encoding("Lesión completamente visible", 'UTF-8'), 0, 0, 'L');

        $this->Cell(18, 18, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        $this->Cell(18, 18, $datos['hallazgos_miselaneos']=='Inflamación' ? 'X' : '', 1, 0, 'C');
        $this->Cell(110.25, 18, mb_convert_encoding("Inflamación", 'UTF-8'), 0, 0, 'L');
        $this->Cell(18, 18, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        $this->Cell(18, 18, $datos['hallazgos_miselaneos']=='Otro' ? 'X' : '', 1, 0, 'C');
        $this->Cell(110.25, 18, mb_convert_encoding("Otro", 'UTF-8'), 0, 0, 'L');

        $this->ln(18);

        $this->Cell(555, 4, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        $this->ln(4);

        $this->SetFont('Arial', '', 10);
        $this->Cell(18, 18, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        $this->Cell(18, 18, $datos['colposcopia_res']=="Normal"?'':(in_array('Lesión no visible completamente', $motivo_insatisfaccion) ? 'X' : ''), 1, 0, 'C');
        $this->Cell(226.5, 18, mb_convert_encoding("Lesión no visible completamente", 'UTF-8'), 0, 0, 'L');

        $this->SetTextColor(255, 255, 255);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(292.5, 18,   mb_convert_encoding("III. APARIENCIA DE LA VULVA", 'UTF-8'), 1, 0, 'L', TRUE);
        
        $this->ln(18);
        $this->SetTextColor(22, 51, 113);
        $this->SetFont('Arial', '', 10);
   
        $this->Rect(291,$this->GetY() ,292.5, 70, '');

        $this->Cell(555, 4, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        $this->ln(4);

        $this->SetTextColor(22, 51, 113);
        $this->SetFont('Arial', '', 10);
        $this->Cell(18, 18, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        $this->Cell(18, 18, $datos['colposcopia_res']=="Normal"?'':(in_array('Unión escamo Columnar no visible', $motivo_insatisfaccion) ? 'X' : ''), 1, 0, 'C');
        $this->Cell(226.5, 18, mb_convert_encoding("Unión escamo Columnar no visible", 'UTF-8'), 0, 0, 'L');

        $this->Cell(18, 18, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        $this->Cell(18, 18, $datos['apariencia_vulva']=='Normal' ? 'X' : '', 1, 0, 'C');
        $this->Cell(110.25, 18, mb_convert_encoding("Normal", 'UTF-8'), 0, 0, 'L');
        $this->Cell(18, 18, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        $this->Cell(18, 18, $datos['apariencia_vulva']=='Leucoplasia' ? 'X' : '', 1, 0, 'C');
        $this->Cell(110.25, 18, mb_convert_encoding("Leucoplasia", 'UTF-8'), 0, 0, 'L');

        $this->ln(18);

        $this->Cell(555, 4, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        $this->ln(4);

        $this->SetTextColor(22, 51, 113);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(262.5, 18,   mb_convert_encoding("Cambios menores", 'UTF-8'), 0, 0, 'C');
        
        $this->SetFont('Arial', '', 10);

        $this->Cell(18, 18, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        $this->Cell(18, 18, $datos['apariencia_vulva']=='Atrófica' ? 'X' : '', 1, 0, 'C');
        $this->Cell(110.25, 18, mb_convert_encoding("Atrófica", 'UTF-8'), 0, 0, 'L');
        $this->Cell(18, 18, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        $this->Cell(18, 18, $datos['apariencia_vulva']=='Eritroplasia' ? 'X' : '', 1, 0, 'C');
        $this->Cell(110.25, 18, mb_convert_encoding("Eritroplasia", 'UTF-8'), 0, 0, 'L');

        $this->ln(18);

        $this->Cell(555, 4, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        $this->ln(4);

        $this->SetTextColor(22, 51, 113);
        $this->SetFont('Arial', '', 10);
        $this->Cell(18, 18, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        $this->Cell(18, 18, in_array('Epitelio_menor', $motivo_insatisfaccion) ? 'X' : '', 1, 0, 'C');
        $this->Cell(95.25, 18, mb_convert_encoding("Epitelio", 'UTF-8'), 0, 0, 'L');
        $this->Cell(18, 18, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        $this->Cell(18, 18, in_array('Punteado Fino', $motivo_insatisfaccion) ? 'X' : '', 1, 0, 'C');
        $this->Cell(95.25, 18, mb_convert_encoding("Punteado Fino", 'UTF-8'), 0, 0, 'L');

        $this->Cell(18, 18, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        $this->Cell(18, 18, $datos['apariencia_vulva']=='Condiloma' ? 'X' : '', 1, 0, 'C');
        $this->Cell(110.25, 18, mb_convert_encoding("Condiloma", 'UTF-8'), 0, 0, 'L');
        $this->Cell(18, 18, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        $this->Cell(18, 18, $datos['apariencia_vulva']=='Tumor' ? 'X' : '', 1, 0, 'C');
        $this->Cell(110.25, 18, mb_convert_encoding("Tumor", 'UTF-8'), 0, 0, 'L');

        $this->ln(18);

        $this->Cell(555, 4, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        $this->ln(4);

        $this->SetTextColor(22, 51, 113);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(262.5, 18,   mb_convert_encoding("Cambios Mayores", 'UTF-8'), 0, 0, 'C');

        $this->SetTextColor(255, 255, 255);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(292.5, 18,   mb_convert_encoding("IV. APARIENCIA DE LA VAGINA", 'UTF-8'), 1, 0, 'L', TRUE);
               
        $this->ln(18);
        $this->Rect(291,$this->GetY() ,292.5, 70, '');

        $this->Cell(555, 4, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        $this->ln(4);

        $this->SetTextColor(22, 51, 113);
        $this->SetFont('Arial', '', 10);
        $this->Cell(18, 18, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        $this->Cell(18, 18, in_array('Mosaico', $motivo_insatisfaccion) ? 'X' : '', 1, 0, 'C');
        $this->Cell(95.25, 18, mb_convert_encoding("Mosaico", 'UTF-8'), 0, 0, 'L');
        $this->Cell(18, 18, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        $this->Cell(18, 18, in_array('Leucoplasia', $motivo_insatisfaccion) ? 'X' : '', 1, 0, 'C');
        $this->Cell(95.25, 18, mb_convert_encoding("Leucoplasia", 'UTF-8'), 0, 0, 'L');

        $this->ln(18);
    
        $this->Cell(555, 4, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        $this->ln(4);

        $this->SetTextColor(22, 51, 113);
        $this->SetFont('Arial', '', 10);
        $this->Cell(18, 18, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        $this->Cell(18, 18, in_array('Epitelio_mayor', $motivo_insatisfaccion) ? 'X' : '', 1, 0, 'C');
        $this->Cell(95.25, 18, mb_convert_encoding("Epitelio", 'UTF-8'), 0, 0, 'L');
        $this->Cell(18, 18, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        $this->Cell(18, 18, in_array('Vasos Atípicos', $motivo_insatisfaccion) ? 'X' : '', 1, 0, 'C');
        $this->Cell(95.25, 18, mb_convert_encoding("Vasos Atípicos", 'UTF-8'), 0, 0, 'L');

        
        $this->Cell(18, 18, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        $this->Cell(18, 18, $datos['apariencia_vagina']=='Normal' ? 'X' : '', 1, 0, 'C');
        $this->Cell(110.25, 18, mb_convert_encoding("Normal", 'UTF-8'), 0, 0, 'L');
        $this->Cell(18, 18, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        $this->Cell(18, 18, $datos['apariencia_vagina']=='Anormal' ? 'X' : '', 1, 0, 'C');
        $this->Cell(110.25, 18, mb_convert_encoding("Anormal", 'UTF-8'), 0, 0, 'L');
        
        $this->ln(18);

        $this->Cell(555, 4, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        $this->ln(4);

        $this->SetTextColor(22, 51, 113);
        $this->SetFont('Arial', '', 10);
        $this->Cell(18, 18, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        $this->Cell(18, 18, in_array('Punteado Grueso', $motivo_insatisfaccion) ? 'X' : '', 1, 0, 'C');
        $this->Cell(95.25, 18, mb_convert_encoding("Punteado Grueso", 'UTF-8'), 0, 0, 'L');

        $this->ln(18);

        $this->Cell(555, 4, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        $this->ln(4);

        $this->SetFont('Arial', 'B', 11);
        $this->SetTextColor(255, 255, 255);
        $this->SetFillColor(104, 185, 46);
        $this->Cell(0, 18,   mb_convert_encoding(' V. IMPRESIÓN DIAGNÓSTICA', 'UTF-8'), 1, 0, 'L', True);
        $this->ln(18);

        $this->Rect(28.5,$this->GetY() ,555, 114, '');

        $this->Cell(555, 4, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        $this->ln(4);

        $diagnostico = pgArrayParse($datos['diagnostico']);
        $this->SetTextColor(22, 51, 113);
        $this->SetFont('Arial', '', 10);
        $this->Cell(18, 18, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        $this->Cell(18, 18, in_array('Normal', $diagnostico) ? 'X' : '', 1, 0, 'C');
        $this->Cell(140.25, 18, mb_convert_encoding("Normal", 'UTF-8'), 0, 0, 'L');
        $this->Cell(18, 18, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        $this->Cell(18, 18, in_array('Lesión Intraepitelial', $diagnostico) ? 'X' : '', 1, 0, 'C');
        $this->Cell(140.25, 18, mb_convert_encoding("Lesión Intraepitelial", 'UTF-8'), 0, 0, 'L');

        $this->Cell(18, 18, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        $this->Cell(18, 18, in_array('Bajo Grado', $diagnostico) ? 'X' : '', 1, 0, 'C');
        $this->Cell(50.25, 18, mb_convert_encoding("Bajo Grado", 'UTF-8'), 0, 0, 'L');
        $this->Cell(18, 18, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        $this->Cell(18, 18, in_array('Alto Grado', $diagnostico) ? 'X' : '', 1, 0, 'C');
        $this->Cell(85.25, 18, mb_convert_encoding("Alto Grado", 'UTF-8'), 0, 0, 'L');
        $this->ln(18);

        $this->Cell(555, 4, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        $this->ln(4);

        $this->SetTextColor(22, 51, 113);
        $this->SetFont('Arial', '', 10);
        $this->Cell(18, 18, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        $this->Cell(18, 18, in_array('Insatisfactoria', $diagnostico) ? 'X' : '', 1, 0, 'C');
        $this->Cell(140.25, 18, mb_convert_encoding("Insatisfactoria", 'UTF-8'), 0, 0, 'L');
        $this->Cell(18, 18, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        $this->Cell(18, 18, in_array('Carcinoma Invasivo', $diagnostico) ? 'X' : '', 1, 0, 'C');
        $this->Cell(140.25, 18, mb_convert_encoding("Carcinoma Invasivo", 'UTF-8'), 0, 0, 'L');

        $this->ln(18);

        $this->Cell(555, 4, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        $this->ln(4);

        $this->SetTextColor(22, 51, 113);
        $this->SetFont('Arial', '', 10);
        $this->Cell(18, 18, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        $this->Cell(18, 18, in_array('Inflamatoria', $diagnostico) ? 'X' : '', 1, 0, 'C');
        $this->Cell(140.25, 18, mb_convert_encoding("Inflamatoria", 'UTF-8'), 0, 0, 'L');
        $this->Cell(18, 18, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        $this->Cell(18, 18, in_array('Cervix no Visible', $diagnostico) ? 'X' : '', 1, 0, 'C');
        $this->Cell(140.25, 18, mb_convert_encoding("Cervix no Visible", 'UTF-8'), 0, 0, 'L');

        $this->ln(18);

        $this->Cell(555, 4, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        $this->ln(4);

        $this->SetTextColor(22, 51, 113);
        $this->SetFont('Arial', '', 10);
        $this->Cell(18, 18, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        $this->Cell(18, 18, in_array('Atrofia', $diagnostico) ? 'X' : '', 1, 0, 'C');
        $this->Cell(140.25, 18, mb_convert_encoding("Atrofia", 'UTF-8'), 0, 0, 'L');
        $this->Cell(18, 18, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        $this->Cell(18, 18, in_array('Otro', $diagnostico) ? 'X' : '', 1, 0, 'C');
        $this->Cell(140.25, 18, mb_convert_encoding("Otro", 'UTF-8'), 0, 0, 'L');

        $this->ln(18);

        $this->Cell(555, 4, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        $this->ln(4);

        $this->SetTextColor(22, 51, 113);
        $this->SetFont('Arial', '', 10);
        $this->Cell(18, 18, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        $this->Cell(18, 18, in_array('Sugestiva de Papiloma', $diagnostico) ? 'X' : '', 1, 0, 'C');
        $this->Cell(140.25, 18, mb_convert_encoding("Sugestiva de Papiloma", 'UTF-8'), 0, 0, 'L');

        $this->ln(18);

        $this->Cell(555, 4, mb_convert_encoding("", 'UTF-8'), 0, 0, 'L');
        $this->ln(4);

        $this->Rect(28.5,$this->GetY() ,555, 120, '');

        $this->SetTextColor(22, 51, 113);
        $this->SetFont('Arial', 'B', 10);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(555, 16,  iconv('UTF-8', 'windows-1252',"Observaciones: "), 0, 0, 'L');
               
        $this->ln(14);
        $this->SetFont('Arial', '', 10);
        $this->MultiCell(555, 14,  iconv('UTF-8', 'windows-1252',$datos['observaciones']), 0, 'L');
       
        $this->ln(0);

        $this->Line(40, $this->GetY() + 20, 270, $this->GetY() + 20);

        $firmante = $datos['nombre_doctor'];
  
        $this->ln(23);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(10, 11, mb_convert_encoding("",'UTF-8'), 0, 0, 'L');
        $this->Cell(0, 11, mb_convert_encoding($firmante,'UTF-8'), 0, 0, 'L');
        $this->ln(11);
        $this->Cell(10, 11, mb_convert_encoding("",'UTF-8'), 0, 0, 'L');
        $this->Cell(0, 11, mb_convert_encoding("Colposcopista",'UTF-8'), 0, 0, 'L');

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

     
        // $this->Cell(292.5, 18,   mb_convert_encoding("", 'UTF-8'), 1, 0, 'L');
        // $this->SetFont('Arial', 'B', 10);
        // $this->Cell(130, 18,  iconv('UTF-8', 'windows-1252',"Colposcopia: "), 1, 0, 'L');
        // $this->SetFont('Arial', '', 10);
        // $this->Cell(162.5, 18,  iconv('UTF-8', 'windows-1252',$datos['colposcopia_res']), 1, 0, 'L');

 
  


        return $this; // Devuelve el objeto PDF generado
    }
}