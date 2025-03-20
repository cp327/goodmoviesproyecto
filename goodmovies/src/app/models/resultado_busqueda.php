<?php
include("../../config/conexion.php");

// Recuperar la cadena de búsqueda de la URL
$busqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : '';

// Validar la cadena de búsqueda si es necesario
// Aquí podrías agregar validaciones o desinfección para garantizar la seguridad

// Modificar la consulta para obtener resultados que coincidan con la búsqueda
$query = "SELECT * FROM peliculasgm WHERE TITULO LIKE '%$busqueda%' OR CATEGORIA LIKE '%$busqueda%' OR SINOPSIS LIKE '%$busqueda%' ORDER BY IDpELICULA DESC";

// Encabezados para evitar el almacenamiento en caché
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');

$resultado = $conexion->query($query);

// Establecer el tipo de contenido como JSON
header('Content-Type: application/json');

// Inicia la salida del script JS como JSON
echo "[\n";

// Variable para llevar el conteo de las filas
$index = 0;

// Itera sobre los resultados de la consulta y genera el objeto 'resultado'
while ($row = $resultado->fetch_assoc()) {
    // Agrega coma y salto de línea antes de las siguientes filas, excepto la primera
    if ($index > 0) {
        echo ",\n";
    }

    echo "  {\n";
    echo "    \"idPelicula\": " . $row['IDpELICULA'] . ",\n";
    echo "    \"titulo\": \"" . addslashes($row['TITULO']) . "\",\n";
    echo "    \"subTitulo\": \"" . addslashes($row['CATEGORIA']) . "\",\n";
    echo "    \"desc\": \"" . addslashes($row['SINOPSIS']) . "\",\n";
    echo "    \"videoURL\": \"" . addslashes($row['VIDEO']) . "\",\n";
    echo "    \"imgFondo\": \"data:image/jpg;base64," . base64_encode($row['IMGfONDO']) . "\",\n";
    echo "    \"imgPortada\": \"data:image/jpg;base64," . base64_encode($row['IMGpORTADA']) . "\"\n";
    echo "  }";

    // Incrementa el índice
    $index++;
}

// Finaliza la salida del script JS
echo "\n]";
// Cierra la conexión a la base de datos
$conexion->close();
?>
