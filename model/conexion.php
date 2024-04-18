<?php

class Conexion{
    static public function conectar(){

    $contrasena = "root";
    $usuario = "postgres";
    $BD = "patrinium";
    $rutaServidor = "127.0.0.1";
    $puerto = "5433";

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
