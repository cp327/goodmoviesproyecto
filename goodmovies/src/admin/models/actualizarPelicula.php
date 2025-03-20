<?php
include "../../config/conexion.php";

$idPelicula  = $_REQUEST['IDpELICULA'];
$titulo      = $_POST['TITULO'];
$categoria   = $_POST['CATEGORIA'];
$sinopsis    = $_POST['SINOPSIS'];
$imgPortada  = $_FILES['IMGpORTADA']['tmp_name'];
$imgFondo    = $_FILES['IMGfONDO']['tmp_name'];
$video       = $_POST['VIDEO'];

// Obtener los datos binarios actuales de la imagen de portada
$querySelectPortada = "SELECT IMGpORTADA FROM peliculasgm WHERE IDpELICULA = '$idPelicula'";
$resultSelectPortada = $conexion->query($querySelectPortada);
$rowPortada = $resultSelectPortada->fetch_assoc();
$oldImgPortada = $rowPortada['IMGpORTADA'];

// Obtener los datos binarios actuales de la imagen de fondo
$querySelectFondo = "SELECT IMGfONDO FROM peliculasgm WHERE IDpELICULA = '$idPelicula'";
$resultSelectFondo = $conexion->query($querySelectFondo);
$rowFondo = $resultSelectFondo->fetch_assoc();
$oldImgFondo = $rowFondo['IMGfONDO'];

// Verificar si se ha enviado un nuevo archivo para la imagen de portada
if (!empty($imgPortada)) {
    // Leer los datos binarios del nuevo archivo
    $newImgPortada = file_get_contents($imgPortada);
} else {
    // Si no se envió un nuevo archivo, conservar los datos binarios de la imagen anterior
    $newImgPortada = $oldImgPortada;
}

// Verificar si se ha enviado un nuevo archivo para la imagen de fondo
if (!empty($imgFondo)) {
    // Leer los datos binarios del nuevo archivo
    $newImgFondo = file_get_contents($imgFondo);
} else {
    // Si no se envió un nuevo archivo, conservar los datos binarios de la imagen anterior
    $newImgFondo = $oldImgFondo;
}

// Escapar los datos binarios antes de insertarlos en la base de datos
$newImgPortada = addslashes($newImgPortada);
$newImgFondo = addslashes($newImgFondo);

// Actualizar la base de datos con los nuevos valores
$query = "UPDATE peliculasgm SET 
    TITULO       = '$titulo', 
    CATEGORIA    = '$categoria', 
    SINOPSIS     = '$sinopsis', 
    IMGpORTADA   = '$newImgPortada', 
    IMGfONDO     = '$newImgFondo', 
    VIDEO        = '$video' 
WHERE 
    IDpELICULA   = '$idPelicula'";

$resultado = $conexion->query($query);

if ($resultado) {
    header("Location:../views/modificarContenido.php");
} else {
    echo "ERROR AL ACTUALIZAR";
}
?>



