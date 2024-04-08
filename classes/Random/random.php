<?php 
class Random  {
    static public function generateUuidV4()
    {
        // Genera 16 bytes de datos aleatorios (128 bits)
        $data = random_bytes(16);

        // Establece el bit de versión a 0100
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);

        // Establece el bit de variante a 10
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

        // Formatea los bytes como un UUID v4 (8-4-4-4-12)
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

    //generar clave aleatoria() 
    static public function generateRandomString($length = 10) { 
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length); 
    } 


    static public function pgArrayParse($literal){
        // funcion para decodificar campo tipo array text
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
    
}