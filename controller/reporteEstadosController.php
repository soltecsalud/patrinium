<?php
require_once '../model/reporteEstadosModel.php';

class ReporteEstadosController {
    public static function cargarDatosMapa() {
        $datos = MapaEstadosModel::obtenerDatosEstados();
        echo json_encode($datos);
    }
	
	public static function obtenerSociedadPorEstado() {
        $datos = MapaEstadosModel::obtenerSociedadPorEstado();

 
        if ($datos === false) {
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Error en la consulta SQL']);
            return;
        }

      
        header('Content-Type: application/json');
        echo json_encode($datos);
    }
}

if (isset($_GET['action']) && $_GET['action'] == 'cargar_datos') {
    ReporteEstadosController::cargarDatosMapa();
}
if (isset($_GET['action']) && $_GET['action'] == 'obtener_sociedad_estado') {
    ReporteEstadosController::obtenerSociedadPorEstado();
}
?>
