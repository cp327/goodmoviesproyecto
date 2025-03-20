<?php
session_start(); // Iniciar sesión

include("../../config/conexion.php");

// Verificar si hay una sesión activa y cerrarla
if (isset($_SESSION['correo'])) {
    session_unset();
    session_destroy();
}

$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$correo = $_POST['correo'];
$contraseña = $_POST['contraseña'];

// Verificar si el correo ya existe en la base de datos
$consultaCorreoExistente = $conexion->prepare("SELECT IDuSUARIO FROM usuarios WHERE correo = ?");
$consultaCorreoExistente->bind_param("s", $correo);
$consultaCorreoExistente->execute();
$consultaCorreoExistente->store_result();

if ($consultaCorreoExistente->num_rows > 0) {
    // El correo ya existe, mostrar un mensaje de error
    $_SESSION['mensaje_alerta'] = 'El correo electrónico ya está registrado';
} else {
    // El correo no existe, proceder con la inserción
    $hashContraseña = password_hash($contraseña, PASSWORD_DEFAULT);

    $query = "INSERT INTO usuarios (nombres, apellidos, correo, contraseña, rol) VALUES (?, ?, ?, ?, 'cliente')";
    $stmt = $conexion->prepare($query);

    if ($stmt) {
        $stmt->bind_param("ssss", $nombres, $apellidos, $correo, $hashContraseña);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            // Obtener el ID del usuario recién registrado
            $idUsuario = $stmt->insert_id;
        
            // Almacenar en la sesión
            $_SESSION['correo'] = $correo;
            $_SESSION['IDuSUARIO'] = $idUsuario;
        
            header("Location: ../views/compra.php");
            exit;
        } else {
            // Mostrar un mensaje de error
            $_SESSION['mensaje_alerta'] = 'No se ha podido registrar al usuario';
        }

        $stmt->close();
    } else {
        $_SESSION['mensaje_alerta'] = 'Error en la preparación de la consulta: ' . $conexion->error;
    }
}

// Cerrar las consultas
$consultaCorreoExistente->close();
$conexion->close();

// Redirigir de vuelta al formulario de registro
header("Location: ../views/registro.php");
exit;
?>



