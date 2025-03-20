<?php
session_start();

include("../../config/conexion.php");

// Obtener el id del usuario de la sesión
$idUsuario = $_SESSION['IDuSUARIO'];
$correo = $_SESSION['correo'];

// Establecer la zona horaria de Colombia
date_default_timezone_set('America/Bogota');

// Obtener la fecha y hora actual en formato colombiano
$fechaCompra = date('Y-m-d H:i:s');

// Calcular la nueva fecha y hora de expiración (ejemplo: 2 minutos)
$duracionMembresia = 3000000;
$nuevaExpiracion = date('Y-m-d H:i:s', strtotime("+{$duracionMembresia} minutes"));

// Actualizar el rol del usuario a "cliente" y registrar la fecha de compra en la base de datos
$query = "UPDATE usuarios SET estado = '1', membresia_inicio = ?, membresia_expiracion = ? WHERE IDuSUARIO = ? AND correo = ?";
$stmt = $conexion->prepare($query);

if ($stmt) {
    $stmt->bind_param("ssis", $fechaCompra, $nuevaExpiracion, $idUsuario, $correo);
    $stmt->execute();
    $stmt->close();

    // Almacenar datos necesarios en la sesión para la factura
    $_SESSION['fecha_compra'] = $fechaCompra;
    $_SESSION['fecha_expiracion'] = $nuevaExpiracion;

    // Después de procesar la compra, redirige al usuario a la página de la factura
    header("Location: ../views/factura.php");

    exit;
} else {
    echo "Error al actualizar el rol del usuario: " . $conexion->error;
}

$conexion->close();
?>
