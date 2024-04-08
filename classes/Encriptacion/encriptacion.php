<?php 
class Encryption  {

    // public static  $key = "soltecsalud"; // llave privada

    static public function encrypt($data, $key)
    {
        // Genera una clave de 256 bits adecuada para AES
        $encryption_key = openssl_digest($key, 'SHA256', TRUE);

        // Genera un IV (Initialization Vector) aleatorio
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('AES-128-CBC'));

        // Cifra los datos usando AES 256 CBC
        $encrypted_data = openssl_encrypt($data, 'AES-128-CBC', $encryption_key, 0, $iv);

        // Combina el IV con los datos cifrados
        $encrypted_data_with_iv = $iv . $encrypted_data;

        // Codifica los datos cifrados en base64 para su almacenamiento seguro
        return base64_encode($encrypted_data_with_iv);
    }

    static public function decrypt($data, $key)
    {
        // Genera una clave de 256 bits adecuada para AES
        $encryption_key = openssl_digest($key, 'SHA256', TRUE);

        // Decodifica los datos cifrados en base64
        $data = base64_decode($data);

        // Extrae el IV de los datos cifrados
        $iv_length = openssl_cipher_iv_length('AES-128-CBC');
        $iv = substr($data, 0, $iv_length);
        $encrypted_data = substr($data, $iv_length);

        // Descifra los datos usando AES 256 CBC
        $decrypted_data = openssl_decrypt($encrypted_data, 'AES-128-CBC', $encryption_key, 0, $iv);

        return $decrypted_data;
    }

}