<?php
include "../../config/conexion.php";
$titulo     =  $_POST    ['TITULO'];
$categoria  =  $_POST    ['CATEGORIA'];
$sinopsis   =  $_POST    ['SINOPSIS'];
$imgPortada =  addslashes(file_get_contents($_FILES['IMGpORTADA']['tmp_name']));
$imgFondo   =  addslashes(file_get_contents($_FILES['IMGfONDO']['tmp_name']));
$video      =  $_POST    ['VIDEO'];


$query      =  "INSERT INTO peliculasgm 
(TITULO,     CATEGORIA,    SINOPSIS,    IMGpORTADA,    IMGfONDO,    VIDEO) 
VALUES 
('$titulo', '$categoria', '$sinopsis', '$imgPortada', '$imgFondo', '$video')";


$resultado  =  $conexion->query($query);

if($resultado){
    header("location:../views/modificarContenido.php");
}else{
    echo "ERROR";
}

?>