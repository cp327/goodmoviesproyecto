<?php
session_start();

// Verificar si se enviaron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    include("../../config/conexion.php");

    // Obtener el ID del usuario desde la sesión
    $idUsuario = isset($_SESSION['IDuSUARIO']) ? $_SESSION['IDuSUARIO'] : null;

    // Validar y obtener la nueva contraseña
    $nuevaContrasena = isset($_POST['nuevaContrasena']) ? $_POST['nuevaContrasena'] : '';

    if (!empty($idUsuario) && !empty($nuevaContrasena)) {
        // Hash de la nueva contraseña
        $hashContrasena = password_hash($nuevaContrasena, PASSWORD_DEFAULT);

        // Actualizar la contraseña en la base de datos
        $sql = "UPDATE usuarios SET contraseña = ? WHERE IDuSUARIO = ?";
        $stmt = $conexion->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("si", $hashContrasena, $idUsuario);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                // Contraseña actualizada con éxito
                $response = array('status' => 'success', 'message' => 'Contraseña actualizada correctamente');
            } else {
                // Error al actualizar la contraseña
                $response = array('status' => 'error', 'message' => 'Error al actualizar la contraseña');
            }

            $stmt->close();
        } else {
            // Error en la preparación de la consulta
            $response = array('status' => 'error', 'message' => 'Error en la preparación de la consulta');
        }
    } else {
        // Datos incompletos
        $response = array('status' => 'error', 'message' => 'Datos incompletos');
    }

    // Cerrar la conexión
    $conexion->close();

    // Devolver la respuesta en formato JSON
    echo json_encode($response);
} else {
    // Redirigir si no se envió el formulario correctamente
    header("location:../views/ajustes.php");
    die();
}
?>
