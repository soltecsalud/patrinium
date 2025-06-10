<?php
require_once '../model/modelEnvioRenovacion.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['ajax'])) {
    $datos = SociedadModelo::obtenerSociedades();
    echo json_encode(['data' => $datos]);
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['tablaInactivas'])) {
    $datos = SociedadModelo::obtenerTablaInactivas();
    echo json_encode(['data' => $datos]);
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['RenovacionEnviada'])) {
    $datos = SociedadModelo::obtenerRenovacionEnviadas();
    echo json_encode(['data' => $datos]);
    exit;
}

// ESTE BLOQUE DEBE EXISTIR para retornar solo el total
if ($_SERVER['REQUEST_METHOD'] === 'GET' && $_GET['total']==1) {
    $total = SociedadModelo::obtenerTotalSociedades(); // esta función debe estar en tu modelo
    echo json_encode($total);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['nombre_sociedad'])) {
    $nombre_sociedad = $_GET['nombre_sociedad'];
    $datos = SociedadModelo::obtenerEstadosPorSociedad($nombre_sociedad);
    echo json_encode(['data' => $datos]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['activas'])) {
    header('Content-Type: application/json');
    $total = SociedadModelo::obtenerSociedadesActivas();
    echo json_encode($total);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['inactivas'])) {
    header('Content-Type: application/json');
    $total = SociedadModelo::obtenerSociedadesInactivas();
    echo json_encode($total);
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['correoEnviado'])) {
    header('Content-Type: application/json');
    $total = SociedadModelo::obtenerSociedadesEnvidaCorreo();
    echo json_encode($total);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['update'])) {
     $id = $_POST['id_solicitud'];
    $destino = $_POST['correo_destino'];
    $asunto = $_POST['asunto'];
    $mensaje = $_POST['mensaje'];

    $enviado = SociedadModelo::enviarCorreoRenovacion($destino, $asunto, $mensaje);

    if ($enviado) {
        $resultado = SociedadModelo::marcarCorreoEnviado($id);
        echo json_encode(['success' => $resultado, 'mensaje' => 'Correo enviado con éxito']);
    } else {
        echo json_encode(['success' => false, 'error' => 'No se pudo enviar el correo']);
    }

    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['multiples'])) {
    header('Content-Type: application/json');
    
    $idSolicitud = (int) $_GET['id_solicitud'];
    $sociedades = SociedadModelo::obtenerSociedadesConMultiplesEstados($idSolicitud);

    echo json_encode(['sociedades' => $sociedades]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['conteo_estados'])) {
    header('Content-Type: application/json');

    
    $id_solicitud = (int) $_GET['id_solicitud'];

 
    $conteo = SociedadModelo::obtenerConteoPorEstado($id_solicitud);
    echo json_encode($conteo); 
 
    exit;
}