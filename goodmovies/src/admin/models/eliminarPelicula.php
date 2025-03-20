<?php
include "../../config/conexion.php";

$idPelicula = $_REQUEST['IDpELICULA'];

// Eliminar de la tabla favoritos
$queryEliminarFavoritos = "DELETE FROM favoritos WHERE IDpELICULA='$idPelicula'";
$resultadoEliminarFavoritos = $conexion->query($queryEliminarFavoritos);

// Eliminar de la tabla descargas
$queryEliminarDescargas = "DELETE FROM descargas WHERE IDpELICULA='$idPelicula'";
$resultadoEliminarDescargas = $conexion->query($queryEliminarDescargas);

// Ahora, eliminar de la tabla peliculasgm
$queryEliminarPelicula = "DELETE FROM peliculasgm WHERE IDpELICULA='$idPelicula'";
$resultadoEliminarPelicula = $conexion->query($queryEliminarPelicula);

if ($resultadoEliminarFavoritos && $resultadoEliminarDescargas && $resultadoEliminarPelicula) {
    header("location:../views/modificarContenido.php");
} else {
    echo "ERROR";
}

?>