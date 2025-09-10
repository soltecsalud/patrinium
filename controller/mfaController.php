<?php 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    header('Content-Type: application/json; charset=UTF-8');
    header('Cache-Control: no-cache, must-revalidate');
    header('Expires: 0');
    include_once '../libs/GoogleAuthenticator-master/PHPGangsta/GoogleAuthenticator.php';
    include("../model/modelMFA.php");

class mfaController { 

    public static function validarMFA() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'validarMFA') {
            $userTotp   = $_POST['mfa_code'];// Obtener el código TOTP introducido por el usuario
            $secret     = $_POST['totp_secret']; // Obtener el secreto del usuario desde la base de datos
            $idSociedad = $_POST['id_sociedad']; // Obtener el ID de la sociedad si está presente


            $gAuth = new PHPGangsta_GoogleAuthenticator();
            $isValid = $gAuth->verifyCode($secret, $userTotp, 2);

            if ($isValid) {   
                modelMFA::mdlActualizarEstadoMFAUsuario('true', $idSociedad);
                echo json_encode([
                    'status' => 'success',
                    'title' => 'Código válido',
                    'message' => 'El código TOTP es válido.'
                ], JSON_UNESCAPED_UNICODE); 
                exit;
            } else {
                echo json_encode([
                    'status' => 'error',
                    'title' => 'Código inválido',
                    'message' => 'El código TOTP no es válido.'
                ], JSON_UNESCAPED_UNICODE);
                exit;
            }
        }
    }

    public static function validarMFASolicitud() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'validarMFASolicitud') {
            $userTotp    = $_POST['mfa_code'];// Obtener el código TOTP introducido por el usuario
            $secret      = $_POST['totp_secret']; // Obtener el secreto del usuario desde la base de datos
            $idSolicitud = $_POST['id_solicitud']; // Obtener el ID de la solicitud si está presente

            $gAuth = new PHPGangsta_GoogleAuthenticator();
            $isValid = $gAuth->verifyCode($secret, $userTotp, 2);

            if ($isValid) {   
                modelMFA::mdlActualizarEstadoMFASolicitud('true', $idSolicitud);
                echo json_encode([
                    'status' => 'success',
                    'title' => 'Código válido',
                    'message' => 'El código TOTP es válido.'
                ], JSON_UNESCAPED_UNICODE); 
                exit;
            } else {
                echo json_encode([
                    'status' => 'error',
                    'title' => 'Código inválido',
                    'message' => 'El código TOTP no es válido.'
                ], JSON_UNESCAPED_UNICODE);
                exit;
            }
        }
    } 

}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if( $_POST['action'] === 'validarMFA'){
        mfaController::validarMFA();
    }else if($_POST['action'] === 'validarMFASolicitud'){
        mfaController::validarMFASolicitud();
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método no permitido o acción no válida.'], JSON_UNESCAPED_UNICODE);
    exit;

}




?>