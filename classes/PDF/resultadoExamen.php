<?php
require('../resource/fpdf/fpdf.php');
include_once "../classes/Encriptacion/encriptacion.php";


class ResultadoExamen extends FPDF
{
    public function Header()
    {
        // Se define aquí el encabezado personalizado
        // Agregar una imagen
        $this->Image('../resource/AdminLTE-3.2.0/dist/img/Ese-Centro-logo.png',30,20,90,0,'PNG');
        $this->Image('../views/imgs/Sello-Icontec-SUA-2019-1.png',520,20,40,55,'PNG');
        $this->Cell(0, 10, iconv('UTF-8', 'windows-1252', ""), 0, 1, 'C');
        $this->ln(0);
        $this->SetFont('Arial', 'B', 13);
        $this->Cell(65, 18,"", 0, 0, 'L');
        $this->MultiCell(430, 18, mb_convert_encoding("LABORATORIO DE REFERENCIA DE CITOLOGÍA Y PATOLOGÍA RED DE SALUD CENTRO E.S.E", 'UTF-8'), 0, 'C');
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
        $this->Cell(60, 10, iconv('UTF-8', 'windows-1252', 'Impreso el ' . $fecha_actual . ' a las ' . $hora_actual), 0, 0, 'L');
        $this->Cell(0, 10, iconv('UTF-8', 'windows-1252', 'Page ' . $this->PageNo()), 0, 0, 'C');
        $this->Cell(0, 10, iconv('UTF-8', 'windows-1252', 'Powered by SoltecSalud'), 0, 0, 'R', 0, 'https://www.soltecsalud.com');
    }

    public function crearResultadoExamen($datos)
    {
        $this->AddPage('P', 'Legal');
        $this->ln(25);

        // Construye el contenido del PDF

        /***********************************
         * DATOS DEL BLOQUE IDENTIFICACION
         ***********************************/
    

        $this->SetFont('Arial', 'B', 11);
        $this->SetTextColor(255, 255, 255);
        $this->SetFillColor(104, 185, 46);
        $this->Cell(0, 21,   mb_convert_encoding('INDENTIFICACIÓN','UTF-8'), 1, 0, 'C', True);
        $this->ln(21);

        $documento = number_format(Encryption::decrypt($datos['num_documento'], 'soltecsalud'),0, ',', '.');
        $this->SetTextColor(22, 51, 113);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(110, 18,  mb_convert_encoding("Tipo de Documento",'UTF-8'), 1, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(152.5, 18,  mb_convert_encoding($datos['tipo_doc'], 'UTF-8'), 1, 0, 'L');
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(130, 18, mb_convert_encoding("N° de Documento",'UTF-8'), 1, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(162.5, 18, mb_convert_encoding($documento,'UTF-8'), 1, 0, 'L');
        $this->ln(18);

        $nombre = $datos['nombres'].' '.$datos['apellido'];
        if (strlen($nombre) > 30) {
            $nombre = substr($nombre, 0, 27) . '...';
        }
        $this->SetTextColor(22, 51, 113);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(110, 18,  iconv('UTF-8', 'windows-1252',"Nombre Completo: "), 1, 0, 'L');
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(152.5, 18,  mb_convert_encoding($nombre, 'UTF-8'), 1, 0, 'L');
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(130, 18,  iconv('UTF-8', 'windows-1252',"Edad: "), 1, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(162.5, 18,  iconv('UTF-8', 'windows-1252',  $datos['edad']), 1, 0, 'L');
        $this->ln(18);

        $this->SetTextColor(22, 51, 113);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(110, 18,  iconv('UTF-8', 'windows-1252',"Fecha de Nacimiento: "), 1, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(152.5, 18,  mb_convert_encoding($datos['f_nacimiento'], 'UTF-8'), 1, 0, 'L');
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(130, 18,  iconv('UTF-8', 'windows-1252',"Barrio: "), 1, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(162.5, 18,   mb_convert_encoding( $datos['barrio'] ,'UTF-8' ), 1, 0, 'L');
        $this->ln(18);

        $this->SetTextColor(22, 51, 113);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(110, 18,  mb_convert_encoding("Ciudad:",'UTF-8'), 1, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(152.5, 18,  mb_convert_encoding($datos['mun_residencia'], 'UTF-8'), 1, 0, 'L');
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(130, 18, mb_convert_encoding("Dirección:",'UTF-8'), 1, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(162.5, 18,   mb_convert_encoding( $datos['direccion'] ,'UTF-8' ), 1, 0, 'L');
        $this->ln(18);


        $this->SetTextColor(22, 51, 113);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(110, 18,  mb_convert_encoding("Comuna:",'UTF-8'), 1, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(152.5, 18,  mb_convert_encoding($datos['comuna'], 'UTF-8'), 1, 0, 'L');
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(130, 18, mb_convert_encoding("N° de Contacto:",'UTF-8'), 1, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(162.5, 18,   mb_convert_encoding( $datos['tel_celular'] ,'UTF-8' ), 1, 0, 'L');
        $this->ln(18);

        $this->SetTextColor(22, 51, 113);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(110, 18,  mb_convert_encoding("Correo:",'UTF-8'), 1, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(152.5, 18,  mb_convert_encoding($datos['correo'], 'UTF-8'), 1, 0, 'L');
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(130, 18, mb_convert_encoding("Entidad Remitente:",'UTF-8'), 1, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(162.5, 18,   mb_convert_encoding( $datos['ese'] ,'UTF-8' ), 1, 0, 'L');
        $this->ln(18);

        $this->SetTextColor(22, 51, 113);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(110, 18,  mb_convert_encoding("N° Interno:",'UTF-8'), 1, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(152.5, 18,  mb_convert_encoding("No hay dato", 'UTF-8'), 1, 0, 'L');
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(130, 18, mb_convert_encoding("Fecha de la Toma:",'UTF-8'), 1, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(162.5, 18,   mb_convert_encoding( $datos['fecha_toma'] ,'UTF-8' ), 1, 0, 'L');
        $this->ln(18);
   
        if (strlen($datos['nombre_ips']) > 30) {
            $datos['nombre_ips'] = ucwords(strtolower(substr($datos['nombre_ips'], 0, 27))) . '...';
        }else{
            $datos['nombre_ips'] = ucwords(strtolower($datos['nombre_ips']));  
        }
        $this->SetTextColor(22, 51, 113);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(110, 18,  mb_convert_encoding("Lugar de la Toma:",'UTF-8'), 1, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(152.5, 18,  mb_convert_encoding($datos['nombre_ips'], 'UTF-8'), 1, 0, 'L');
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(130, 18, mb_convert_encoding("Fecha de",'UTF-8'), 1, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(162.5, 18,   mb_convert_encoding( "No contexto" ,'UTF-8' ), 1, 0, 'L');
        $this->ln(18);

        if($datos['tamizaje']=='ADN VPH'){
            $peticion = $datos['peticion_vph'];
        }else{
            $peticion = $datos['peticion_citologia'];
        }
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(110, 18,  mb_convert_encoding("N° Peticion:",'UTF-8'), 1, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(152.5, 18,  $peticion, 1, 0, 'L');
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(130, 18, mb_convert_encoding("Fecha de Estudio:",'UTF-8'), 1, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(162.5, 18,   mb_convert_encoding( "No hay dato" ,'UTF-8' ), 1, 0, 'L');
        $this->ln(18);

        if (strlen($datos['nombre_eps']) > 30) {
            $datos['nombre_eps'] = ucwords(strtolower(substr($datos['nombre_eps'], 0, 27))) . '...';
        }else{
            $datos['nombre_eps'] = ucwords(strtolower($datos['nombre_eps']));  
        }
        $this->SetTextColor(22, 51, 113);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(110, 18,  mb_convert_encoding("EPS:",'UTF-8'), 1, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(152.5, 18,  mb_convert_encoding($datos['nombre_eps'], 'UTF-8'), 1, 0, 'L');
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(130, 18, mb_convert_encoding("",'UTF-8'), 1, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(162.5, 18,   mb_convert_encoding( "" ,'UTF-8' ), 1, 0, 'L');
        $this->ln(18);

        /**********************************
        * ANTECEDENTES
        ***********************************/
        $this->SetFont('Arial', 'B', 11);
        $this->SetTextColor(255, 255, 255);
        $this->SetFillColor(104, 185, 46);
        $this->Cell(0, 18,   mb_convert_encoding('ANTECEDENTES', 'UTF-8'), 1, 0, 'C', True);
        $this->ln(18);

        if($datos['estado_gestacion']=='No Gestante' || $datos['estado_gestacion']==null){
            $embarazada = 'No';
        }else{
            $embarazada = 'Si';
        }
        $this->SetTextColor(22, 51, 113);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(110, 18,  mb_convert_encoding("Está Embarazada:",'UTF-8'), 1, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(152.5, 18,  mb_convert_encoding($embarazada, 'UTF-8'), 1, 0, 'L');
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(130, 18, mb_convert_encoding("Última Menstruación:",'UTF-8'), 1, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(162.5, 18,   mb_convert_encoding($datos['last_menstruacion'],'UTF-8' ), 1, 0, 'L');
        $this->ln(18);

        if($datos['last_citologia']=== null){
            $primeraCito = 'Si';
        }else{
            $primeraCito = 'No';
        }
        $this->SetTextColor(22, 51, 113);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(110, 18,  mb_convert_encoding("Citología 1ra Vez:",'UTF-8'), 1, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(152.5, 18,  mb_convert_encoding($primeraCito, 'UTF-8'), 1, 0, 'L');
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(130, 18, mb_convert_encoding("Método de Planificación:",'UTF-8'), 1, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(162.5, 18,   mb_convert_encoding($datos['metodo_planificacion'],'UTF-8' ), 1, 0, 'L');
        $this->ln(18);

        $this->SetTextColor(22, 51, 113);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(110, 18,  mb_convert_encoding("Resultado:",'UTF-8'), 1, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(152.5, 18,  mb_convert_encoding($datos['resul_last_citologia'], 'UTF-8'), 1, 0, 'L');
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(130, 18, mb_convert_encoding("Fecha Citología Previa:",'UTF-8'), 1, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(162.5, 18,   mb_convert_encoding($datos['last_citologia'],'UTF-8' ), 1, 0, 'L');
        $this->ln(18);

        $this->SetTextColor(22, 51, 113);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(110, 18,  mb_convert_encoding("Procedimiento:",'UTF-8'), 1, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(152.5, 18,  mb_convert_encoding($datos['esquema'], 'UTF-8'), 1, 0, 'L');
        // verificar si este si es el dato o procedimiento de hallazgos
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(130, 18, mb_convert_encoding("Institución:",'UTF-8'), 1, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(162.5, 18,   mb_convert_encoding("NO se sabe de donde sale",'UTF-8' ), 1, 0, 'L');
        $this->ln(18);

        $fecha = new DateTime($datos['last_citologia']);
        $hoy = new DateTime();
        $intervalo = $hoy->diff($fecha);
        $tiempo=  $intervalo->y . " años, " . $intervalo->m." meses, ".$intervalo->d." días";
        $this->SetTextColor(22, 51, 113);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(110, 18,  mb_convert_encoding("Aspecto del cuello:",'UTF-8'), 1, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(152.5, 18,  mb_convert_encoding($datos['aspecto_cuello'], 'UTF-8'), 1, 0, 'L');
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(130, 18, mb_convert_encoding("Hace cuanto se realizó:",'UTF-8'), 1, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(162.5, 18,   mb_convert_encoding($tiempo,'UTF-8' ), 1, 0, 'L');
        $this->ln(18);

        $this->SetTextColor(22, 51, 113);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(110, 18,  mb_convert_encoding("N° de Embarazos:",'UTF-8'), 1, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(152.5, 18,  mb_convert_encoding($datos['num_embarazos']!=null?$datos['num_embarazos']:0, 'UTF-8'), 1, 0, 'L');
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(130, 18, mb_convert_encoding("N° de Partos:",'UTF-8'), 1, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(162.5, 18,   mb_convert_encoding($datos['num_partos']!=null?$datos['num_partos']:0,'UTF-8' ), 1, 0, 'L');
        $this->ln(18);

        $this->SetTextColor(22, 51, 113);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(110, 18,  mb_convert_encoding("N° de Cesareas:",'UTF-8'), 1, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(152.5, 18,  mb_convert_encoding($datos['cesareas']!=null?$datos['cesareas']:0, 'UTF-8'), 1, 0, 'L');
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(130, 18, mb_convert_encoding("N° de Abortos:",'UTF-8'), 1, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(162.5, 18,   mb_convert_encoding($datos['abortos']!=null?$datos['abortos']:0,'UTF-8' ), 1, 0, 'L');
        $this->ln(18);
    
        $this->SetFont('Arial', 'B', 11);
        $this->SetTextColor(255, 255, 255);
        $this->SetFillColor(104, 185, 46);

        /**********************************
        * RESULTADOS
        ***********************************/
        $this->Cell(0, 18,   mb_convert_encoding('RESULTADO DE CITOLOGÍA CERVICO UTERINA', 'UTF-8'), 1, 0, 'C', True);
        $this->ln(18);

        $this->Rect(28.5,$this->GetY() ,555, 500, '');

        $this->SetTextColor(22, 51, 113);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(555, 18, mb_convert_encoding("Técnica de Tamizaje: ".$datos['tamizaje'], 'UTF-8'), 0, 0, 'C');
        $this->ln(18);

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(555, 18, mb_convert_encoding("CALIDAD DE LA: ", 'UTF-8'), 0, 0, 'L');
        $this->ln(18);
  
        $this->SetFont('Arial', '', 10);
        $this->Cell(555, 18, mb_convert_encoding("No se sabe de donde sale el texto", 'UTF-8'), 0, 0, 'L');
        $this->ln(18);

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(555, 18, mb_convert_encoding("CATEGORIZACIÓN GENERAL: ", 'UTF-8'), 0, 0, 'L');
        $this->ln(18);
  
        $this->SetFont('Arial', '', 10);
        $this->Cell(555, 18, mb_convert_encoding($datos['resultado'], 'UTF-8'), 0, 0, 'L');
        $this->ln(18);

        
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(555, 18, mb_convert_encoding("MICROORGANISMOS: ", 'UTF-8'), 0, 0, 'L');
        $this->ln(18);
  
        $this->SetFont('Arial', '', 10);
        $this->Cell(555, 18, mb_convert_encoding("NO EXISTE CAMPO", 'UTF-8'), 0, 0, 'L');
        $this->ln(18);

              
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(555, 18, mb_convert_encoding("OBSERVACIONES POR CITOLOGÍA: ", 'UTF-8'), 0, 0, 'L');
        $this->ln(18);
  
        $this->SetFont('Arial', '', 10);
        $this->Cell(555, 18, mb_convert_encoding("NO EXISTE CAMPO", 'UTF-8'), 0, 0, 'L');
        $this->ln(18);

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(555, 18, mb_convert_encoding("OBSERVACIONES POR PATOLOGÍA: ", 'UTF-8'), 0, 0, 'L');
        $this->ln(18);
  
        $this->SetFont('Arial', '', 10);
        $this->Cell(555, 18, mb_convert_encoding("NO EXISTE CAMPO", 'UTF-8'), 0, 0, 'L');
        $this->ln(18);
 


        // // Guarda la imagen temporal
        //  file_put_contents($hallazgos_colposcopicos_image, $image_data);
  
   
        // Convierte la imagen base64 a un archivo temporal
        // if (file_exists($hallazgos_colposcopicos_image)) {
        //     $this->Image($hallazgos_colposcopicos_image, 30, $this->GetY() + 1, 250, 250); 
        // }
        // Agrega la imagen al PDF

        // unlink($hallazgos_colposcopicos_image);
        // Elimina el archivo temporal de la imagen



        $this->ln(18);
   
        
        $this->Line(40, $this->GetY() + 38, 270, $this->GetY() + 38);

        $firmante =  "Nombre".' '. "Citologo";
  

        $this->ln(38);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(10, 18, mb_convert_encoding("",'UTF-8'), 0, 0, 'L');
        $this->Cell(0, 18, mb_convert_encoding($firmante,'UTF-8'), 0, 0, 'L');
        $this->ln(18);
        $this->Cell(10, 18, mb_convert_encoding("",'UTF-8'), 0, 0, 'L');
        $this->Cell(0, 18, mb_convert_encoding("Citologo(a)",'UTF-8'), 0, 0, 'L');

        return $this; // Devuelve el objeto PDF generado
    }
}