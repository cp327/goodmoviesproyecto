<?php
include '../../config/conexion.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['tabla'], $_POST['IDuSUARIO'])) {
        $tabla = $_POST['tabla'];
        $id = intval($_POST['IDuSUARIO']);

        // Agrega otras tablas si es necesario
        $tablas = array(
            "usuarios" => array("IDuSUARIO" => "IDuSUARIO")
        );

        if (array_key_exists($tabla, $tablas)) {
            

            $deleteQuery = "DELETE FROM $tabla WHERE IDuSUARIO = ?";
            $stmt = $conexion->prepare($deleteQuery);
            $stmt->bind_param("i", $id);

            if ($stmt->execute()) {
                echo "Usuario eliminado exitosamente";
            } else {
                echo "Error al eliminar el usuario: " . $stmt->error;
            }

            $stmt->close();
            $conexion->close();
        } else {
            echo "Tabla no encontrada o no permitida";
        }
    } else {
        echo "Faltan parámetros para eliminar el usuario";
    }
} 

else {
    echo "Parámetro 'tabla' no proporcionado en la URL";
}

?>