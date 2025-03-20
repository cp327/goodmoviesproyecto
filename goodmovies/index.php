<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GOODMOVIES</title>
    <link rel="stylesheet" href="src/public/css/styles_index.css">
    <link rel="stylesheet" href="src/public/css/styles_index_responsive.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" href="src/public/img/logo/logoGM.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="src/public/libs/fontawesome/all.min.css"  crossorigin="anonymous">

</head>
<body>
<canvas id="galaxyCanvas"></canvas>

    <header class="header">

    
        <h1 class="logotipo">GOODMOVIES</h1>
    
        <input type="checkbox" name="" id="check">
    
        <label for="check" class="icons">
            <i class='bx bx-menu' id="menu-icon"></i>
            <i class='bx bx-x' id="close-icon"></i>
        </label>

        <nav class="navbar">
        
            <a class="iniciar-s" href="src/auth/views/login.php" style="--i:2;">Iniciar sesión</a>
        
        </nav>

    </header>


    <a class="fixed-login-button" href="src/auth/views/login.php"><button id="login-btn" class="btn-2">INICIAR SESIÓN</button></a>





    <div class="cont-der des">

        <div class="img-slo">
            <img class="logoprim" src="src/public/img/logo/logoGM.png" alt="">
        </div>

        <div class="img-slo1">
            <h1>GOODMOVIES</h1>
        </div>


        <div class="info-cont">

                <div class="vacio">
                    
                    <span></span>
                </div>

                <div class="info-good">
                    <h2>EN GOODMOVIES PODRAS ENCONTRAR LAS MEJORES PELICULAS A TU ALCANCE. ¿QUE ESPERAS PARA UNIRTE A NOSOTROS Y EMPEZAR A DISFRUTAR DE LA MEJOR EXPERIENCIA?</h2>
                </div>
        </div>

        <div class="cont-btn">

            <div class="vacio2">
                    <span></span>
            </div>


            <div class="foke">
                <a href="#" data-target="tabla-seccion"><button class="btn-1 ntb">UNIRME +</button></a>
                <a href="#" data-target="footer"><button class="btn-4 ntb">MÁS INFORMACIÓN</button></a>
            </div>

        </div>
    </div>






    <div class="slider">
        <img class="slide position" src="src/public/img/wallpapers/it-wall.webp" alt="Imagen 1">
        <img class="slide position" src="src/public/img/wallpapers/cillian-murphy-j-robert-oppenheimer-desert-i9.webp" alt="Imagen 2">
        <img class="slide position" src="src/public/img/wallpapers/marvels-spider-man-remastered-moon-p7.webp" alt="Imagen 3">
        <img class="slide position" src="src/public/img/wallpapers/the-nun-2-movie-ka.webp" alt="Imagen 4">
        <img class="slide position" src="src/public/img/wallpapers/the-flash-multiverse-pp.webp" alt="Imagen 5">
        <img class="slide position" src="src/public/img/wallpapers/five-nights-at-freddys-ko.webp" alt="Imagen 6">
        <img class="slide position" src="src/public/img/wallpapers/the-chronicles-of-john-wick-8s.webp" alt="Imagen 7">
        <img class="slide position" src="src/public/img/wallpapers/fast-x-chinese-poster-ik (1).webp" alt="Imagen 8">
        <img class="slide position" src="src/public/img/wallpapers/wonder-woman-justice-league-poster-hl.webp" alt="Imagen 9">
        <img class="slide position" src="src/public/img/wallpapers/rocket-raccoon-guardians-of-the-galaxy-vol-3-poster-aq.webp" alt="Imagen 10">
        <img class="slide position" src="src/public/img/wallpapers/harrison-ford-indiana-jones-and-the-dial-of-destiny-4k-wl.webp" alt="Imagen 11">
    </div>


<div class="txt-mejor">
    <h3>EL MEJOR CONTENIDO SOLO PARA TI</h3>
</div>

<div class="txt-disfruta">
    <span>Disfruta de las mejores series y películas en la mejor calidad. Únete a GoodMovies.</span>
</div>

<section class="sec-poster">
    <div class="sec-poster1">
        <a href="#" class="image-link" data-video="src/public/video/it-trailer.mp4"><img src="src/public/img/posters/lamonja2.jpg" alt=""></a>
        <a href="#" class="image-link" data-video="src/public/video/it-trailer.mp4"><img src="src/public/img/posters/elclub.jpg" alt=""></a>
        <a href="#" class="image-link" data-video="src/public/video/it-trailer.mp4"><img src="src/public/img/posters/spider-nuevouniverso.jpg" alt=""></a>
        <a href="#" class="image-link" data-video="src/public/video/it-trailer.mp4"><img src="src/public/img/posters/bluebettle.jpg" alt=""></a>
        <a href="#" class="image-link" data-video="src/public/video/it-trailer.mp4"><img src="src/public/img/posters/megalodon222.jpg" alt=""></a>
    </div>

    <div class="sec-poster2">
        <a href="#" class="image-link" data-video="src/public/video/it-trailer.mp4"><img src="src/public/img/posters/theflashofc.jpg" alt=""></a>
        <a href="#" class="image-link" data-video="src/public/video/it-trailer.mp4"><img src="src/public/img/posters/venom1.jpg" alt=""></a>
        <a href="#" class="image-link" data-video="src/public/video/it-trailer.mp4"><img src="src/public/img/posters/carss33.jpg" alt=""></a>
        <a href="#" class="image-link" data-video="src/public/video/it-trailer.mp4"><img src="src/public/img/posters/openjaimeeee.jpg" alt=""></a>
        <a href="#" class="image-link" data-video="src/public/video/it-trailer.mp4"><img src="src/public/img/posters/elaro.jpg" alt=""></a>
    </div>
</section>


<div id="video-modal" class="modal">
    <div id="close-button" class="close-button">×</div>
    <video id="video" controls autoplay>
        <source src="" type="video/mp4">
        Tu navegador no soporta el elemento de video.
    </video>
</div>

<div id="video-overlay" class="video-overlay">
    <div class="alert" id="alert">
        <p>Para continuar viendo suscribete a GoodMovies</p>
        <a href="src/auth/views/registro.php" class="join-button"><button class="btn">Unirme</button></a>
        <div id="alert-close-button" class="alert-close-button">×</div>
    </div>
</div>

<div class="txt-unete">
    <H3>UNETE A NOSOTROS</H3>
</div>

<div class="txt-mte">
    <span>Mejora tu experiencia.</span>
</div>


<section class="sec-tabla" id="tabla-seccion">
        <table class="tabla">
            <tr>
                <td><img class="imgdt" src="src/public/img/posters/imagendelatabla.png" alt=""></td>
                <td>

                    <div class="cont-td">
                        <img class="logo-tabla" src="src/public/img/logo/logoGM.png" alt="">
                        <li class="">GOOD PLAN</li>
                        <a href="src/auth/views/registro.php"><button class="btn">COP 35.900/MES</button></a>
                    </div>
                </td>
            </tr>
            <tr>
                <td>Resolución 720p - 1080p</td>
                <td>✓</td>
            </tr>
            <tr>
                <td>Resolucion 1440p - 2160p</td>
                <td>✓</td>
            </tr>
            <tr>
                <td>Descargar películas en HD</td>
                <td>✓</td>
            </tr>
            <tr>
                <td>Descargar películas en 4K</td>
                <td>✓</td>
            </tr>
        </table>
</section>


<div class="txt-experiencia">
    <h3>DISFRUTA DE LA MEJOR EXPERIENCIA</h3>
</div>

<div class="txt-dsp">
    <span>Disponibilidad en múltiples dispositivos</span>
</div>


<div class="cont-img-ds">
    <img src="src/public/img/posters/3dispositivos.png" alt="">
</div>


<div class="cont-linea">
    <hr>
</div>




<div class="cont-txts-ln">
    <div class="lt">
        <h3>Guarda tus titulos favoritos para verlos donde quieras</h3>
    </div>

    <div class="lt">
        <h3>Entretenimiento para toda la familia</h3>
    </div>

    <div class="lt">
        <h3>Disfruta de la mejor experiencia las diferentes plataformas</h3>
    </div>
</div>


<div class="foot" id="footer">
    
    <div class="cont-img-foot">
        <img class="img-foot" src="src/public/img/logo/logo.png" alt="">
    </div>

    <div class="txt-foot">
        <SELECT NAME="Idioma">
            <OPTION selected>Idioma
            <OPTION>Español
            <OPTION>English
            </SELECT>
        <a href="">Términos de uso</a>
        <a href="">Política de privacidad</a>
        <a href="">Ayuda</a>
        <a href="">Dispositivos compatibles</a>
    </div>

        <div class="txt-foot2 ld">
            <a href="">Acerca de GoodMovies</a>
        </div>
    
        <div class="txt-foot3 ld">
            <span>© 2023 GoodMovies Company. Todos los derechos reservados.</span>
        </div>

        <div class="txt-foot4 ld">
            <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos placeat nostrum est doloremque officia ratione, illum id dolorem, tempore consectetur numquam voluptatem incidunt voluptates eum maiores aliquam nam distinctio voluptatum!</span>
        </div>

</div> 


<script src="src/public/js/index.js"></script>
<script src="js/starsAnimation.js"></script>
</body>
</html>