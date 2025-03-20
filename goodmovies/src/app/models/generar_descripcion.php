<?php
include("../../config/conexion.php");

// Recuperar la categoría de la URL si se proporciona
$categoria = isset($_GET['categoria']) ? $_GET['categoria'] : '';

// Validar la categoría si es necesario
// Aquí podrías agregar validaciones o desinfección para garantizar la seguridad

// Modificar la consulta para obtener solo películas de la categoría especificada y ordenar por ID de forma descendente
if (!empty($categoria) && $categoria !== 'home') {
    $query = "SELECT * FROM peliculasgm WHERE CATEGORIA = '$categoria' ORDER BY IDpELICULA DESC";
} else {
    // Si no se especifica una categoría o es "home", obtener todas las películas y ordenar por ID de forma descendente
    $query = "SELECT * FROM peliculasgm ORDER BY IDpELICULA DESC";
}

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



