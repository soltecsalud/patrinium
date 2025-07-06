<?php
    try {
        // Iniciar sesión
        session_start();

        $vista = $_GET['vista'] ?? null; // Obtener la vista desde la URL

        // Validar sesión
        if (!isset($_SESSION['usuario'])) { // Verificar si la sesión del usuario está activa
            header('Location: crear_usuario.php');
            exit();
        }

        // Validar vista
        $archivoVista = "../views/" . $vista; // Construir la ruta del archivo de vista
        if (file_exists($archivoVista)) { // Verificar si el archivo de vista existe
            include $archivoVista;
        } else {
            echo "❌ Archivo de vista no encontrado.";
        }
        
    } catch (\Throwable $th) {
        // Manejo de errores
        // echo "❌ Error al cargar la vista: " . $th->getMessage(); // Si se produce un error, se descomenta para visualizar el mensaje de error
        echo "❌ Error al cargar la vista: ";
    }


?>