<?php 
include('../../config/conexion.php');

if (isset($_GET['IDuSUARIO']) && isset($_GET['estado'])) {
    $id = $_GET['IDuSUARIO'];
    $nuevo_estado = $_GET['estado'];

    // Actualiza el estado del usuario en la base de datos
    $sql = "UPDATE usuarios SET estado = '$nuevo_estado' WHERE IDuSUARIO = $id";
    
    if ($conexion->query($sql) === TRUE) {
        header('Location:../views/empleados.php');
        exit;
    } else {
        echo "Error al actualizar el estado: " . $conexion->error;
    }
}
?>