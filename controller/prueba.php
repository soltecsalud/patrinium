<?php
require_once('../model/modelPersona.php'); // Asegúrate de que la ruta sea correcta.

$resultados = ModelBuscarPersona::obtenerPersona();
echo '<pre>';
print_r($resultados);
echo '</pre>';
?>