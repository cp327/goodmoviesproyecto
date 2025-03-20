<?php

include '../../config/conexion.php';
// Inicializar la variable de respuesta
$response = array();

// Obtener el ID del usuario desde la solicitud GET
if (isset($_GET['IDuSUARIO'])) {
    $userId = $_GET['IDuSUARIO'];

    // Consulta para obtener los datos del usuario por su ID
    $sql = "SELECT nombres, apellidos, correo, rol FROM usuarios WHERE IDuSUARIO = $userId";
    $result = $conexion->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
            // Convertir los resultados en un array asociativo
            $row = $result->fetch_assoc();
            // Agregar los datos del usuario al objeto de respuesta
            $response['user_data'] = $row;
        } else {
            // Agregar un mensaje de error al objeto de respuesta
            $response['error'] = "No se encontraron resultados para el ID de usuario proporcionado.";
        }
    } else {
        // Agregar un mensaje de error al objeto de respuesta
        $response['error'] = "Error en la consulta SQL: " . $conexion->error;
    }
} else {
    // Agregar un mensaje de error al objeto de respuesta
    $response['error'] = "Se requiere un ID de usuario.";
}

// Devolver la respuesta como JSON
header('Content-Type: application/json');
echo json_encode($response);

$conexion->close();

?>