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

    if ($_SESSION['membresia_expiracion'] < date('Y-m-d H:i:s')) {
        // La membresía ha expirado, redirigir a compra.php con JavaScript
        echo '<script>
                setTimeout(function(){
                    window.location.href = "../../auth/views/compra.php";
                }, 1000); // Esperar 1 segundos antes de redirigir
            </script>';
        die();
    }
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
    <link rel="stylesheet" href="../../public/css/stylesAlertAjustes.css">
    <link rel="stylesheet" href="../../public/css/styles_ajustes.css">
    <!-- <link rel="stylesheet" href="../../public/css/styles_responsive_login.css"> -->
    <link rel="stylesheet" href="../../public/css/styles_ajustes_responsive.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>


    
    <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"
    />
    <link rel="shortcut icon" href="../../public/img/logo/logoGM.png">
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
    <canvas id="galaxyCanvas"></canvas>  
    <center>
    <div id="mensaje-container"></div>

    <?php
    $idUsuario = $_SESSION['IDuSUARIO'];
    // Conexión a la base de datos (ajusta los detalles de la conexión según tu configuración)
    include("../../config/conexion.php");

    // Consultar la información del usuario
    $sql = "SELECT * FROM usuarios WHERE IDuSUARIO = ?";
    $stmt = $conexion->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $idUsuario);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Obtener los datos del usuario
            $usuario = $result->fetch_assoc();

            // Mostrar el formulario de ajustes
            ?>

<div class="all">
    <div class="wrapper">
        <div class="form-box login">
            <div class="col-2">
                <form action="../models/actualizar_contrasena.php" id="formulario-contrasena" method="post">
                    <img width="100px" src="../../public/img/logo/logo.png" alt=""><br> 
                    <h2>Ajustes</h2>

                    <div class="input-box">
                        <input type="text" required id="miInput" name="nombres" value="<?php echo $usuario['nombres']; ?>">
                        <label for="nombre">Nombre:</label>
                        <i class='bx bxs-lock-alt'></i>                
                    </div>


                    <div class="input-box">
                        <input type="text" required id="miInput" name="apellidos" value="<?php echo $usuario['apellidos']; ?>">
                        <label for="nombre">Apellidos:</label>
                        <i class='bx bxs-lock-alt'></i>
                    </div>

                    <div class="input-box">
                        <input type="email" required id="miInput" name="correo" value="<?php echo $usuario['correo']; ?>">
                        <label for="correo">Correo electrónico:</label>
                        <i class='bx bxs-lock-alt'></i>
                    </div>

                    <div class="input-box">
                        <input type="password" required id="nuevaContrasena" name="nuevaContrasena" required>
                        <label for="nuevaContrasena">Nueva Contraseña:</label>
                    </div>
<!-- Agrega otros campos del formulario si es necesario -->

                <button class="btn-act" type="submit">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</div>
            <?php
        } else {
            echo "Error: No se encontró información del usuario.";
        }

        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta.";
    }
    // Cerrar la conexión
    $conexion->close();
    ?>
    <!-- Agrega aquí tus enlaces a scripts JavaScript si es necesario -->
    </center>
    
    <!-- ---------------------------------------------------------------- -->


    <script src="../controllers/scriptNavbarHome.js"></script>
    <script src="../controllers/actualizarContrasena.js"></script>
    

    <script>
        document.getElementById('miInput').addEventListener('keydown', function (e) {
            e.preventDefault(); // Evita que se escriba en el campo
        });
    </script>

<script src="../../public/js/starsAnimation.js"></script>
</body>
</html>





