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
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../public/libs/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../../public/css/stylesHome.css">
    <link rel="stylesheet" href="../../public/css/styleNavbarHome.css">
    <link rel="stylesheet" href="../../public/css/styles_home_responsive.css">

    <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"
    />
    <link rel="shortcut icon" href="../../public/img/logo/logo.png">
    <title>GOODMOVIES</title>
</head>
<body>
    <div class="overlay">
        <i class="fa-solid fa-times" onclick="closeOverlay();"></i>
        <div id="trailer">
            
        </div>
    </div>

    <header>
        <div class="container">
            <input type="checkbox" name="" id="check">
            
            <div class="logo-container">
                <h3 class="logo"><img src="../../public/img/logo/logo.png" alt=""></h3>
            </div>


            <div class="nav-btn">
                <div class="nav-links">
                    <ul>
                        <li class="nav-link" style="--i: .6s">
                            <a href="home.php">Home</a>
                        </li>
                        <li class="nav-link" style="--i: .85s">
                            <a href="#">Peliculas<i class="fas fa-caret-down"></i></a>
                            <div class="dropdown">
                                <ul>
                                    <li class="dropdown-link">
                                    <a href="terror.php">Terror</a>
                                    </li>
                                    <li class="dropdown-link">
                                        <a href="drama.php">Drama</a>
                                    </li>
                                    <li class="dropdown-link">
                                        <a href="accion.php">Acción</a>
                                    </li>
                                    <li class="dropdown-link">
                                        <a href="aventura.php">Aventura</a>
                                    </li>
                                    <div class="arrow"></div>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>

                
                    <div class="nav-links">
                        <ul>
                            <li class="nav-link" style="--i: .85s">
                                <a href="#">ID: <?php echo $_SESSION['IDuSUARIO'] ?><i class="fas fa-caret-down"></i></a>
                                <div class="dropdown">
                                    <ul>
                                        <li class="dropdown-link">
                                            <a href="ajustes.php">Ajustes</a>
                                        </li>
                                        <li class="dropdown-link">
                                            <a href="../../auth/models/verificacion.php?salir=1">Salir</a>
                                        </li>
                                        <div class="arrow"></div>
                                    </ul>    
                                </div>
                            </li>
                        </ul>
                    </div>
            </div>

            <div class="hamburger-menu-container">
                <div class="hamburger-menu">
                    <div></div>
                </div>
            </div>
        </div>
    </header>

    <!-- --------------------------------------------------------------- -->
    
    <div class="banner">
        
        <div class="swiper bannerSwiper">
            
            <div class="swiper-wrapper">
                

                <?php 
                include "../../config/conexion.php";
                $query=$conexion->query("SELECT * FROM peliculasgm ORDER BY IDpELICULA DESC");
                while ($row=$query->fetch_object()){
                ?>
                    <div class="swiper-slide">
                    
                        <img src="data:image/jpg;base64,<?php echo base64_encode($row->IMGfONDO); ?>" alt="">
                    
                    </div>
                <?php 
                } 
                ?>
            </div>  
        </div> 
    </div>
<!-- ---------------------------------------------------------------- -->

<div class="position-content">
    <div class="content">
        <div class="tutilo">

            <div id="titulo">
                <h1></h1>
            </div>

            <div id="sub-titulo">
                <p></p>
            </div>
            <br>
            <div class="btns">
                <a href="modificarContenido.php">
                    <button class="btn-sec">
                        <i class="fa-regular fa-pen-to-square"></i>
                        Modificar contenido
                    </button>
                </a>
                
                <button class="btn-sec" onclick="showTrailer();">
                    <i class="fa-solid fa-play"></i>
                    Ver ahora
                </button>
            </div>
        </div>
        <div class="description">
            <div class="navigation-btn">
                <!-- If we need navigation buttons -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
            <div id="description"> 
                <p>
                    
                </p>
            </div>
            <!-- <button class="btn-primary">
                <i class="fa-regular fa-circle-down"></i>
                Descargar
            </button> -->
        </div>
        <!-- If we need pagination -->
        <div class="swiper-pagination"></div>
    </div>
    </div>


<!-- ------------------------------------------------------------------- -->
<div class="content-fijo">
    <div class="position-port">
        <div class="thumbs">

            <div thumbsSlider="" class="swiper thumbsSwiper">
                <div class="categoria-name">
                    <h2>Home</h2>
                </div>
                    <div class="swiper-wrapper pene"> 
                        <?php 
                        $query=$conexion->query("SELECT * FROM peliculasgm ORDER BY IDpELICULA DESC");
                        while ($row=$query->fetch_object()){
                        ?>
        

                        <div class="swiper-slide">     
                            <img src="data:image/jpg;base64,<?php echo base64_encode($row->IMGpORTADA); ?>" alt="">
                        </div>        

                        <?php 
                        } 
                        ?>


                    </div>
            </div>   
        </div>
    </div>
</div>








    
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script>
    var descripcion = <?php include '../models/generar_descripcion.php';?>;
    </script>
    <script defer src="../controllers/scriptHome.js"></script>
</body>
</html>








