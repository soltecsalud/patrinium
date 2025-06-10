<?php
require_once '../model/modelSociedad.php';

if (isset($_GET['accion']) && $_GET['accion'] === 'obtenerExtensionSociedades') {
    try {
        $resultado = modelSociedad::mdlObtenerExtensionSociedades();
        header('Content-Type: application/json');
        echo json_encode($resultado);
    } catch (Exception $e) {
        echo json_encode(["error" => $e->getMessage()]);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['accion'] === 'actualizarDeclaracionMarzo') {
    $id = $_POST['id_personas_sociedad'];
    $estado = $_POST['declararon_marzo'] === 'true' ? true : false;

    try {
        echo json_encode(modelSociedad::mdlActualizarDeclaracionMarzo($id, $estado));
    } catch (Exception $e) {
        echo json_encode(["error" => $e->getMessage()]);
    }
}

if (isset($_GET['accion']) && $_GET['accion'] === 'obtenerSociedadesSinMarzo') {
    try {
        $resultado = modelSociedad::mdlObtenerSociedadesSinDeclararMarzo();
        header('Content-Type: application/json');
        echo json_encode($resultado);
    } catch (Exception $e) {
        echo json_encode(["error" => $e->getMessage()]);
    }
}
?>