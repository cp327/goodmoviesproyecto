<?php
include '../../config/conexion.php';

$nombre = $_POST["nombres"];
$apellido = $_POST["apellidos"];
$correo = $_POST["correo"];
$estado = $_POST["estado"];

$correoExists = false;

// Consulta preparada para verificar si el correo ya existe
$checkCorreoQuery = $conexion->prepare("SELECT * FROM usuarios WHERE correo = ?");
$checkCorreoQuery->bind_param("s", $correo);
$checkCorreoQuery->execute();
$resultCorreo = $checkCorreoQuery->get_result();

if ($resultCorreo->num_rows > 0) {
    $correoExists = true;
}

if ($correoExists) {
    $response = array('success' => false, 'correoExists' => $correoExists);
    echo json_encode($response);
} else {
    // Si no existen, procede con la inserción
    if (!empty($nombre) && !empty($apellido) && !empty($correo)) {
        // Generar una contraseña temporal (puedes personalizar este proceso)
        $contraseñaTemporal = '123';

        // Hash de la contraseña temporal
        $hashContraseña = password_hash($contraseñaTemporal, PASSWORD_DEFAULT);

        // Consulta preparada para la inserción
        $sql = $conexion->prepare("INSERT INTO usuarios (nombres, apellidos, correo, estado, rol, contraseña) VALUES (?, ?, ?, ?, 'empleado', ?)");
        $sql->bind_param("sssss", $nombre, $apellido, $correo, $estado, $hashContraseña);
        $sql->execute();

        if ($sql->affected_rows > 0) {
            $response = array('success' => true, 'message' => 'Registro exitoso');
            echo json_encode($response);
        } else {
            $response = array('success' => false, 'message' => 'Error al insertar datos: ' . $conexion->error);
            echo json_encode($response);
        }

        // Cerrar la consulta preparada
        $sql->close();
    } else {
        $response = array('success' => false, 'message' => 'Por favor complete todos los campos obligatorios');
        echo json_encode($response);
    }
}

// Cerrar la consulta preparada
$checkCorreoQuery->close();
$conexion->close();
?>
