<?php
// seguridad
include "../../config/conexion.php";
session_start();
$varsesion = $_SESSION['correo'];
if ($varsesion == null || $varsesion == '') {
    // No tiene acceso, redirigir a index.php
    header("location:../../../index.php");
    die();
}

// Establecer la zona horaria de Colombia
date_default_timezone_set('America/Bogota');

// Impresiones para depuración
// echo 'Antes de la verificación de membresía.<br>';
// var_dump($_SESSION);

// Verificar si el usuario tiene un rol de cliente
if (isset($_SESSION['rol']) && $_SESSION['rol'] == 'cliente') {
    // Si la membresía expiró o no está definida, actualizarla desde la base de datos
    if (!isset($_SESSION['membresia_expiracion']) || $_SESSION['membresia_expiracion'] < date('Y-m-d H:i:s')) {
        // Consultar la fecha de expiración desde la base de datos
        $idUsuario = $_SESSION['IDuSUARIO'];
        $consultaExpiracion = $conexion->prepare("SELECT membresia_expiracion FROM usuarios WHERE IDuSUARIO = ?");
        $consultaExpiracion->bind_param("i", $idUsuario);
        $consultaExpiracion->execute();
        $consultaExpiracion->bind_result($nuevaExpiracion);
        $consultaExpiracion->fetch();
        $consultaExpiracion->close();

        // Almacenar la nueva fecha y hora de expiración en la sesión
        $_SESSION['membresia_expiracion'] = $nuevaExpiracion;
    }

    // Continuar con la verificación de membresía
    // echo 'Fecha/Hora actual: ' . date('Y-m-d H:i:s') . '<br>';
    // echo 'Fecha/Hora expiración: ' . $_SESSION['membresia_expiracion'] . '<br>';

    if ($_SESSION['membresia_expiracion'] < date('Y-m-d H:i:s')) {
        // La membresía ha expirado, redirigir a compra.php con JavaScript
        // $_SESSION['mensaje_alerta'] = 'Tu membresía ha expirado. Por favor, renueva tu membresía.';
        echo '<script>
                setTimeout(function(){
                    window.location.href = "../../auth/views/compra.php";
                }, 1000); // Esperar 1 segundos antes de redirigir
              </script>';
        die();
    } else {
        // echo 'La membresía NO ha expirado.<br>';
    }
} else {
    // echo 'No se cumplen las condiciones para verificar la membresía.<br>';
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


            <div class="" style="--i: 1.35s">
                <div id="ctn-icon-search">
                    <a href="#"><i class="fa-solid fa-magnifying-glass" id="icon-search"></i></a>
                </div>
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
                            <a href="#">‎ <i class="fa-solid fa-user"></i><i class="fas fa-caret-down"></i></a>
                                <div class="dropdown">
                                    <ul>
                                        <li class="dropdown-link">
                                            <a href="misFavoritos.php">Mis favoritos</a>
                                        </li>
                                        <li class="dropdown-link">
                                            <a href="misDescargas.php">Descargas</a>
                                        </li>
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

    <div id="ctn-bars-search">
        <input type="text" id="inputSearch" placeholder="¿Qué deseas buscar?">
        <button id="btnSearch">Buscar</button> <!-- Nuevo botón de búsqueda -->
    </div>

<ul id="box-search">
    <li><a href="#" id="resultadosHref"><i class="fas fa-search"></i></a></li>
</ul>

<div id="cover-ctn-search"></div>
    <!-- ---------------------------------------------------------------- -->
    
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
                <h1>

                </h1>
            </div>

            <div id="sub-titulo">
                <p></p>
            </div>
            <br>
            <div class="btns">
                
                <button class="btn-sec" onclick="agregarAFavoritos()" id="btnFavoritos" data-idpelicula="">
                    <i class="fa-solid fa-star"></i>
                    Añadir a favoritos
                </button>

                
                
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
            <button class="btn-primary" onclick="agregarADescargas()" id="btnDescargas" data-idpelicula="">
                <i class="fa-regular fa-circle-down"></i>
                Descargar
            </button>
        </div>
        <!-- If we need pagination -->
        <div class="swiper-pagination"></div>
    </div>
</div>


<!-- ------------------------------------------------------------------- -->
<div class="content-fijo">
    <div class="position-port">
        <div class="thumbs">

            <div thumbsSlider="" class="swiper cont-pene thumbsSwiper">
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
    <script> var descripcion = <?php include '../models/generar_descripcion.php'; ?> ; </script>
    <script defer src="../controllers/scriptHome.js"></script>
    <script src="../controllers/agregarFavorito.js"></script>
    <script defer src="../controllers/agregarDescarga.js"></script>
    <script src="../controllers/scriptNavbarHome.js"></script>
    



</body>
</html>








