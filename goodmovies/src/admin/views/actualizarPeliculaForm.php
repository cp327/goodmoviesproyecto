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
    <link href="libs/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../public/css/styles_actualizar.css">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Open+Sans&display=swap" rel="stylesheet">


    <title>GOODMOVIES</title>
</head>
<body>
<div class="all">
    

    <div class="wrapper">
        <div class="form-box login">

        <h3>ACTUALIZAR PELICULA</h3>
        <?php
        $idPelicula=$_REQUEST["IDpELICULA"];
        include("../../config/conexion.php");
        $query= "SELECT * FROM peliculasgm WHERE IDpELICULA='$idPelicula'";
        $resultado= $conexion->query($query);
        $row=$resultado->fetch_assoc();

        ?>
        <div class="col-2">
            <form action="../models/actualizarPelicula.php?IDpELICULA=<?php echo $row['IDpELICULA'];?>" method="POST" enctype="multipart/form-data">

            <div class="input-box">
                <input type="text" required class="form-control" placeholder="" name="TITULO" value="<?php echo $row['TITULO'];?>">
                <label for="">TITULO</label>
            </div>

            <div>
                <label for="">Categoria: </label>
                <select class="form-select" name="CATEGORIA">
                <?php  
                    if($row['CATEGORIA'] =="Terror"){
                    echo '<option value="Terror" selected>Terror</option>';
                    echo '<option value="Drama">Drama</option>';
                    echo '<option value="Acción">Acción</option>';
                    echo '<option value="Aventura">Aventura</option>';
                    }elseif($row['CATEGORIA'] =="Drama"){
                    echo '<option value="Drama" selected>Drama</option>';
                    echo '<option value="Terror" >Terror</option>';
                    echo '<option value="Acción">Acción</option>';
                    echo '<option value="Aventura">Aventura</option>';
                    }elseif($row['CATEGORIA'] =="Acción"){
                    echo '<option value="Acción" selected>Acción</option>';
                    echo '<option value="Terror" >Terror</option>';
                    echo '<option value="Drama" >Drama</option>';
                    echo '<option value="Aventura">Aventura</option>';
                    }else{
                    echo '<option value="Aventura" selected>Aventura</option>';
                    echo '<option value="Terror" >Terror</option>';
                    echo '<option value="Drama" >Drama</option>';
                    echo '<option value="Acción" >Acción</option>';
                    }   
            ?>
            </select>
            </div> 

            <div>
                <label for="">SINOPSIS</label><br>
                <textarea type="submit" id="" cols="70" name="SINOPSIS" value="" rows="4"><?php echo $row['SINOPSIS'];?></textarea>
            </div>

            <div>
                <label for="">Imagen de cartelera: </label>
                <input class="btn4" type="file" class="form-control" placeholder="" name="IMGpORTADA" value="">
                <br>
            </div>

            <!-- <div class="cont-imgs">
                <label for="">Cartelera actual:</label>
                <img src="data:image/jpg;base64,<?php echo base64_encode($row['IMGpORTADA']);?>"/>
            </div> -->

            <div>
                <label for="">Imagen de fondo: </label>
                <input  class="btn4" type="file"  class="form-control" placeholder="" name="IMGfONDO" value=""><br>
            </div>

            <!-- <div class="cont-imgs">
                <label for="">Fondo actual:</label>
                <img src="data:image/jpg;base64,<?php echo base64_encode($row['IMGfONDO']);?>"/>
            </div> -->

            <div class="input-box">              
                <input type="text" required class="form-control" placeholder="" name="VIDEO" value="<?php echo $row['VIDEO'];?>">
                <label for="">URL de video: </label>
            </div> 
            
            <div class="botones">
                <button type="submit" class="btn1" name="actualizar">Actualizar</button>
                <a href="modificarContenido.php" class="btn active"><button class="btn2">Atrás</button></a>
            </div>    
            </form>
        </div>

        </div>
    </div>

            <div class="cont-imgs">
                <label for="">Cartelera actual:</label><br>
                <img class="img1" src="data:image/jpg;base64,<?php echo base64_encode($row['IMGpORTADA']);?>"/><br>
                <label for="">Fondo actual:</label><br>
                <img class="img2" src="data:image/jpg;base64,<?php echo base64_encode($row['IMGfONDO']);?>"/>
            </div>
</div>
</body>
</html>




