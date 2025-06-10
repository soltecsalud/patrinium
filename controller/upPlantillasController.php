<?php
// controlador: plantillaController.php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    include_once '../model/modelUpPlantilla.php';
    $modelo = new PlantillaModel();
    
    // Definir la ruta donde se almacenará el archivo
    $directorio = '../resource/plantillas/';
    $nombreArchivo = basename($_FILES['archivo']['name']);
    $rutaArchivo = $directorio . $nombreArchivo;
    
    if (move_uploaded_file($_FILES['archivo']['tmp_name'], $rutaArchivo)) {
        $resultado = $modelo->guardarPlantilla($rutaArchivo, $_POST['nombre'],$nombreArchivo);
        if ($resultado === 'ok') {
            echo "<script>
                    alert('Plantilla subida con éxito.');
                    window.location.href = document.referrer;
                  </script>";
        } else {
            echo "<script>
                    alert('Error al subir la plantilla en la base de datos.');
                    window.location.href = document.referrer;
                  </script>";
        }
    } else {
        echo "<script>
                alert('Error al mover el archivo al directorio de plantillas.');
                window.location.href = document.referrer;
              </script>";
    }
}
?>