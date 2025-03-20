<?php
// Iniciar la sesión (si no está iniciada)
session_start();

// Obtener el ID del usuario desde la sesión
$idUsuario = isset($_SESSION['IDuSUARIO']) ? $_SESSION['IDuSUARIO'] : null;

// Verificar si el usuario está autenticado
if (!$idUsuario) {
    $response = array('status' => 'error', 'message' => 'Usuario no autenticado');
    echo json_encode($response);
    exit;
}

include("../../config/conexion.php");

// Modificar la consulta para obtener solo películas de la tabla "favoritos" del usuario actual
$query = "SELECT p.* FROM peliculasgm p
          INNER JOIN favoritos f ON p.IDpELICULA = f.IDpELICULA
          WHERE f.IDuSUARIO = $idUsuario
          ORDER BY p.IDpELICULA DESC";

// Encabezados para evitar el almacenamiento en caché
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');

$resultado = $conexion->query($query);

// Establecer el tipo de contenido como JSON
header('Content-Type: application/json');

// Inicia la salida del script JS como JSON
echo "{\n";

// Variable para llevar el conteo de las filas
$index = 0;

// Itera sobre los resultados de la consulta y genera el objeto 'descripcion'
while ($row = $resultado->fetch_assoc()) {
    // Agrega coma y salto de línea antes de las siguientes filas, excepto la primera
    if ($index > 0) {
        echo ",\n";
    }

    echo "  \"{$index}\": {\n";
    echo "    \"idPelicula\": " . $row['IDpELICULA'] . ",\n";
    echo "    \"titulo\": \"" . addslashes($row['TITULO']) . "\",\n";
    echo "    \"subTitulo\": \"" . addslashes($row['CATEGORIA']) . "\",\n";
    echo "    \"desc\": \"" . addslashes($row['SINOPSIS']) . "\",\n";
    echo "    \"videoURL\": \"" . addslashes($row['VIDEO']) . "\"\n";
    echo "  }";

    // Incrementa el índice
    $index++;
}

// Finaliza la salida del script JS
echo "\n}";

// Cierra la conexión a la base de datos
$conexion->close();
?>




