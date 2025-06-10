<?php
require_once('conexion.php');

class PlantillaModel {
    public function guardarPlantilla($rutaArchivo, $nombre, $nombreArchivo) {
        try {
            $sql = "INSERT INTO plantillas (nombre, ruta, createat,nombre_archivo) 
            VALUES (:nombre, :ruta, NOW(),:nombre_archivo);";
            $consulta = Conexion::conectar()->prepare($sql);
            $consulta->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $consulta->bindParam(':ruta', $rutaArchivo, PDO::PARAM_STR);
            $consulta->bindParam(':nombre_archivo', $nombreArchivo, PDO::PARAM_STR);
            if ($consulta->execute()) {
                return "ok";
            } else {
                return "Error en la ejecución del query.";
            }
        } catch (Exception $e) {
            return "Error en la base de datos: " . $e->getMessage();
        }
    }

    
}
?>
