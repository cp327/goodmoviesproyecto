<?php
// Iniciar la sesión (si no está iniciada)
session_start();

// Obtener el ID del usuario desde la sesión
$idUsuario = isset($_SESSION['IDuSUARIO']) ? $_SESSION['IDuSUARIO'] : null;

// Obtener el ID de la película desde la solicitud POST (asegúrate de validar y sanear esta entrada)
$idPelicula = filter_input(INPUT_POST, 'IDpELICULA', FILTER_SANITIZE_NUMBER_INT);

// Verificar si el ID del usuario y el ID de la película son válidos
if (!$idUsuario || !$idPelicula) {
    $response = array('status' => 'error', 'message' => 'ID de usuario o película no válidos');
    echo json_encode($response);
    exit;
}

// Conexión a la base de datos (ajusta los detalles de la conexión según tu configuración)
include("../../config/conexion.php"); // Ajusta la ruta según tu estructura de carpetas

// Eliminar la película de la lista de favoritos del usuario
$sql = "DELETE FROM favoritos WHERE IDuSUARIO = ? AND IDpELICULA = ?";
$stmt = $conexion->prepare($sql);

if ($stmt) {
    $stmt->bind_param("ii", $idUsuario, $idPelicula);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $response = array('status' => 'success', 'message' => 'Película eliminada de mis favoritos correctamente', 'redirect' => '../views/misFavoritos.php');

        
    } else {
        $response = array('status' => 'error', 'message' => 'Error al eliminar la película de mis favoritos');
    }

    $stmt->close();
} else {
    $response = array('status' => 'error', 'message' => 'Error en la preparación de la consulta');
}

// Cerrar la conexión
$conexion->close();

// Devolver la respuesta en formato JSON
echo json_encode($response);


?>

