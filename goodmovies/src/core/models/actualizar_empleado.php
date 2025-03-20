<?php
include '../../config/conexion.php';

// Inicializar la variable de respuesta
$response = array();

// Obtener los datos del formulario
$data = json_decode(file_get_contents('php://input'), true);

// Verificar que los datos esperados estén presentes
$userID = isset($data['userID']) ? $data['userID'] : null;
$nombre = isset($data['nombre']) ? $data['nombre'] : null;
$apellido = isset($data['apellido']) ? $data['apellido'] : null;
$correo = isset($data['correo']) ? $data['correo'] : null;

// Consulta SQL para actualizar los datos del usuario con una consulta preparada
$sql = "UPDATE usuarios SET nombres=?, apellidos=?, correo=?, contraseña=? WHERE IDuSUARIO=?";
$stmt = $conexion->prepare($sql);

if ($stmt) {
    // Encriptar la contraseña (puedes ajustar el método de hash según tus necesidades)
    $contrasenaEncriptada = password_hash("456", PASSWORD_BCRYPT);

    // Vincular parámetros y ejecutar la consulta
    $stmt->bind_param("ssssi", $nombre, $apellido, $correo, $contrasenaEncriptada, $userID);
    $stmt->execute();

    // Verificar si la actualización fue exitosa
    if ($stmt->affected_rows > 0) {
        $response['success'] = true;
        $response['message'] = "Datos actualizados correctamente.";
    } else {
        $response['success'] = false;
        $response['error'] = "No se realizaron cambios o hubo un error: " . $stmt->error;
    }

    // Cerrar la consulta preparada
    $stmt->close();
} else {
    $response['success'] = false;
    $response['error'] = "Error al preparar la consulta: " . $conexion->error;
}

// Devolver la respuesta como JSON
header('Content-Type: application/json');
echo json_encode($response);

// Cerrar la conexión
$conexion->close();
?>
