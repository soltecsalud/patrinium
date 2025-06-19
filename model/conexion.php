<?php

class Conexion{
    static public function conectar(){

    $contrasena = "Crooked13*/";
    $usuario = "postgres";
    // $BD = "patrimonium_noviembre15";
    $BD = "patrimonium";
    // $BD      = "patrimonium_vb2";
    $rutaServidor = "178.16.142.82";
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
