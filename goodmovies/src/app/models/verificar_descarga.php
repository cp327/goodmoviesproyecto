<?php
session_start();

// Obtener el ID del usuario desde la sesión
$idUsuario = isset($_SESSION['IDuSUARIO']) ? $_SESSION['IDuSUARIO'] : null;

// Obtener el ID de la película desde la solicitud POST
$idPelicula = filter_input(INPUT_POST, 'IDpELICULA', FILTER_SANITIZE_NUMBER_INT);

// Verificar si el ID del usuario y el ID de la película son válidos
if (!$idUsuario || !$idPelicula) {
    $response = array('status' => 'error', 'message' => 'ID de usuario o película no válidos');
    echo json_encode($response);
    exit;
}

// Conexión a la base de datos (ajusta los detalles de la conexión según tu configuración)
include("../../config/conexion.php");

// Consultar si la película ya está en favoritos
$sql = "SELECT * FROM descargas WHERE IDuSUARIO = ? AND IDpELICULA = ?";
$stmt = $conexion->prepare($sql);

if ($stmt) {
    $stmt->bind_param("ii", $idUsuario, $idPelicula);
    $stmt->execute();
    $stmt->store_result();

    // Verificar si ya está en favoritos
    if ($stmt->num_rows > 0) {
        $response = array('status' => 'success', 'message' => 'Película ya está en tu lista de descargas');
    } else {
        $response = array('status' => 'error', 'message' => 'Película no está en tu lista de descargas');
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
