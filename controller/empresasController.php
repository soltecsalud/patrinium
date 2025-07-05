<?php
require_once('../model/modelEmpresas.php');

class EmpresasController {
    public function gestionarEmpresa() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nombre'    => $_POST['nombre_empresa'] ?? null,
                'direccion' => $_POST['direccion_empresa'] ?? null,
                'correo'    => $_POST['correo_empresa'] ?? null,
                // 'logo'      => $_POST['logo_empresa'] ?? null,
            ];

            $logo          = $_FILES['logo_empresa']['name'] ?? null; // Obtener el nombre del archivo del logo
            $rutaExistente = $_POST['ruta_logo_modal'] ?? '';

            if($logo && $_FILES['logo_empresa']['tmp_name']!=''){
                // Definir la ruta donde se almacenará el logo
                $directorio    = '../resource/logos/';
                $nombreArchivo = basename($_FILES['logo_empresa']['name']);
                $rutaArchivo   = $directorio . $nombreArchivo;   

                // Mover el archivo subido al directorio
                if (move_uploaded_file($_FILES['logo_empresa']['tmp_name'], $rutaArchivo)) {
                    $data['logo'] = $rutaArchivo; // Asignar la ruta del logo al array de datos
                } else {
                    echo json_encode(['resultado' => 0, 'mensaje' => 'Error al subir el logo', 'rutaArchivo'=>$nombreArchivo]); // Error al subir el logo
                    return;
                }
            }else{
                // Si no se subió un nuevo logo, usar la ruta existente
                $data['logo'] = $rutaExistente;
            }

            $modelo = new ModelEmpresas();
            // Verificar si se está actualizando o insertando
            if (isset($_POST['ejecutar']) && $_POST['ejecutar'] == 'actualizarEmpresa') {
                $data['id_empresa'] = $_POST['id_empresa_modal'] ?? null; // Obtener el ID de la empresa a actualizar
                $resultado = $modelo->actualizarEmpresa($data);
            } else {
                $resultado = $modelo->insertEmpresa($data);
            }
            
            if ($resultado == "ok") {
                echo json_encode(['resultado' => 1]); // Éxito
            } else {
                echo json_encode(['resultado' => 0]); // Error
            }
        }
    }

    public function listarEmpresas() {
        try {
            $modelo = new ModelEmpresas();
            $resultado = $modelo->listarEmpresas();
            if($resultado){
                echo json_encode(['status' => 'success', 'data' => $resultado]); // Éxito
            }else{
                echo json_encode(['status' => 'error', 'mensaje' => $resultado]); // No se encontraron empresas
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'gestionarEmpresa') {
    $controller = new EmpresasController();
    $controller->gestionarEmpresa();
}else if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'listarEmpresas') {
    $controller = new EmpresasController();
    $controller->listarEmpresas(); 
}else if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'eliminarEmpresa') {
    $id_empresa = $_POST['id_empresa'] ?? null; // Obtener el ID de la empresa a eliminar
    if ($id_empresa) {
        $modelo = new ModelEmpresas();
        $resultado = $modelo->eliminarEmpresa($id_empresa);
        if ($resultado == "ok") {
            echo json_encode(['resultado' => 1]); // Éxito
        } else {
            echo json_encode(['resultado' => 0]); // Error
        }
    } else {
        echo json_encode(['resultado' => 0, 'error' => 'ID de empresa no proporcionado']);
    }
} 


?>