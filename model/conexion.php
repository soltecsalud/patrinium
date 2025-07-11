<?php

class Conexion{
    static public function conectar(){

        $contrasena = "2eALqPZXb8Qo@Qhuy!$7Kp";
        $usuario = "postgres";
        // $BD = "patrimonium_noviembre15";
        $BD = "patrimonium_producccion_julio9";
        // $BD      = "patrimonium_vb2";
        $rutaServidor = "127.0.0.1";
        $puerto = "5432";

    $base_de_datos = null;

try {
    $base_de_datos = new PDO("pgsql:host=$rutaServidor;port=$puerto;dbname=$BD", $usuario, $contrasena);
    $base_de_datos->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Conecto con la base de datos ";
} catch (PDOException $e) {
    //throw new Exception("Error al conectar a la base de datos: " . $e->getMessage());
}
return  $base_de_datos;
    }
}
