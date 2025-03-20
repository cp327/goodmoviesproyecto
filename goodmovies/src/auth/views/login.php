<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GOODMOVIES</title>
    <link rel="icon" href="../../public/img/logo/logoGM.png" type="image/x-icon">
    <link rel="stylesheet" href="../../public/css/styles_login.css">
    <link rel="stylesheet" href="../../public/css/styles_responsive_login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    
    
</head>


<body>


<canvas id="galaxyCanvas"></canvas>

    <header class="header">
        <a href="../../../index.php" style="--i:2;"><img class="logo" src="../../public/img/logo/logo.png" alt="">   </a>
        <input type="checkbox" name="" id="check">
        <label for="check" class="icons">
        </label>
        <nav class="navbar">
        </nav>
    </header>







    <div class="wrapper">

    

        <div class="form-box login">

            <form class="form1" action="../models/verificacion.php" method="POST">    
                
                <?php
                include("../../config/conexion.php");
                ?>
                
                <div class="lah2">


                    <img src="../../public/img/logo/logo.png" alt=""><br>  
                    <h2>Iniciar Sesión</h2>
                </div>      
                <div class="input-box"> 
                    <input type="text" required name="correo">       
                    <label>Correo Electrónico</label> 
                    <i class='bx bxs-user'></i>     
                </div>
        
                <div class="input-box"> 
                    <input type="password" required name="contraseña"> 
                    <label>Contraseña</label> 
                    <i class='bx bxs-lock-alt'></i>       
                </div>
        
                <button type="submit" class="btn" value="continuar" name="entrar">Continuar</button>

                <?php
                    include "../../config/conexion.php";
                    session_start();

                if (isset($_SESSION['mensaje_alerta'])) {
                    echo '<div class="alertica">' . $_SESSION['mensaje_alerta'] . '</div>';
                    unset($_SESSION['mensaje_alerta']); 
                }

                ?>
        
                <div class="logreg-link">
                    <p>¿No tienes cuenta? <a href="registro.php" class="register-link">Registrarme</a></p>
                </div>


            </form>
        </div>
        

        <script src="../../public/js/starsAnimation.js"></script>
        <!-- Script JavaScript para cerrar la alerta automáticamente después de un tiempo -->
<script>
    setTimeout(function() {
        var alertica = document.querySelector('.alertica');
        if (alertica) {
            alertica.style.display = 'none';
        }
    }, 5000); // 3000 milisegundos (3 segundos)
</script>
</body>
</html>