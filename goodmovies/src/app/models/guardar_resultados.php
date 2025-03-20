<?php
// Recibir el JSON desde el cuerpo de la solicitud
$data = json_decode(file_get_contents('php://input'), true);

// Almacenar los resultados en un archivo en el servidor
$archivoResultados = 'resultado.json';
file_put_contents($archivoResultados, json_encode($data));

// Devolver una respuesta simple indicando que se han guardado los resultados
echo json_encode(['message' => 'Resultados almacenados con éxito']);
?>
