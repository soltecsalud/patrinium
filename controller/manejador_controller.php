<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
    exit();
} elseif (isset($_SESSION['usuario']) && $_SESSION['configuracion'] === false) {
    echo 'Acesso no autorizado.';
    exit();
}

include_once "../controller/usuarioController.php";
// Obtener el ID del usuario a editar
$usuario_id = isset($_GET['id']) ? $_GET['id'] : null;
// Obtener la información del usuario a editar
$usuario = UsuarioController::ctrlConsultarUsuarioId($usuario_id);





?>