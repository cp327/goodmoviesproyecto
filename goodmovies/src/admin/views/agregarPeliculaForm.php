<?php
//seguridad
session_start();
$varsesion=$_SESSION['correo'];
if($varsesion==null || $varsesion=''){
    // echo 'NO TIENE ACCESO';
    header("location:../../../index.php");
    // echo 'NO TIENE ACCESO';
    die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="libs/fontawesome/css/all.min.css">
    <link href="libs/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../public/css/styles_agregar.css">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Open+Sans&display=swap" rel="stylesheet">

    <title>GOODMOVIES</title>
</head>
<body>
<div class="all">
    

    <div class="wrapper">
        <div class="form-box login">

        <div>
            <h1>AGREGAR PELICULA</h1>
        </div>

        <form class="form1" action="../models/agregarPelicula.php" method="POST" enctype="multipart/form-data">

            <div class="input-box"> 
                <input type="text" required  class="form-control" placeholder="" name="TITULO">
                <label>TITULO</label>
            </div>
      

            <div class="cate">
                <label for="">Categoria: </label>
                <select class="form-select" name="CATEGORIA" required>
                    <option value="">Seleccionar...</option>
                    <option value="Terror">Terror</option>
                    <option value="Drama">Drama</option>
                    <option value="Acción">Acción</option>
                    <option value="Aventura">Aventura</option>
                </select>
            </div>
            <!-- <input type="text" required  class="form-control" placeholder="Categoria" name="CATEGORIA"> -->

            <div>
                <label for="">SINOPSIS</label><br>
                <textarea type="submit" required id="" cols="80" name="SINOPSIS" value="" rows="7"></textarea>
            </div>


            <div>
                <label for="">Imagen de cartelera: </label>
                <input class="btn4" type="file" required class="form-control" name="IMGpORTADA">
            </div>
      
            <div>
                <label for="">Imagen de fondo: </label>
                <input class="btn4" type="file" required class="form-control" name="IMGfONDO">
            </div> 
         

            <div class="input-box">
                <input type="text" required  class="form-control" placeholder="" name="VIDEO">
                <label for="">VIDEO</label>
            </div> 
            <br>

            <div class="botones">
                <button type="submit" class="btn1" value="agregar">Agregar<i class="bi bi-person-plus"></i></button>
                <button type="reset" class="btn2" value="cancelar">Cancelar</button>
            </div>

            
        </form>

                <a href="modificarContenido.php" class=""><button class="btn3">Atrás</button></a> 
        </div>

    </div>



</div>
</body>
</html>

