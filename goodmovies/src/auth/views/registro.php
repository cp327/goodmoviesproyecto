<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GOODMOVIES</title>
    <link rel="stylesheet" href="../../public/css/styles_registro.css">
    <link rel="stylesheet" href="../../public/css/styles_responsive_registro.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" href="../../public/img/logo/logoGM.png" type="image/x-icon">
    
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

            <form class="form1" action="../models/registrar_usuario.php" method="POST">  
                
                
                <?php
                include("../../config/conexion.php");
                ?>

                
                <div class="lah2">



                
                    <img src="../../public/img/logo/logo.png" alt=""><br>  
                    <h2>Registrate</h2>
                </div>      
                <div class="input-box"> 
                    <input type="text" required name="nombres">       
                    <label>Nombres</label> 
                    <i class='bx bxs-user'></i>     
                </div>

                <div class="input-box"> 
                    <input type="text" required name="apellidos">       
                    <label>Apellidos</label> 
                    <i class='bx bxs-user'></i>     
                </div>

                <div class="input-box"> 
                    <input type="email" required name="correo">       
                    <label>Correo Electrónico</label> 
                    <i class='bx bxs-envelope'></i>     
                </div>
        
                <div class="input-box"> 
                    <input type="password" required name="contraseña"> 
                    <label>Contraseña</label> 
                    <i class='bx bxs-lock-alt'></i>       
                </div>
        
                <button type="submit" class="btn">Continuar</button>
                <?php
    include "../../config/conexion.php";
    session_start();


if (isset($_SESSION['mensaje_alerta'])) {
    echo '<span class="alertica">' . $_SESSION['mensaje_alerta'] . '</span>';
    unset($_SESSION['mensaje_alerta']); 
}
?>
                <div class="logreg-link">
                    <p>¿Ya tienes cuenta? <a href="login.php" class="register-link">Iniciar Sesión</a></p>
                </div>



                
            </form>
        
        </div>

        <script src="../../public/js/starsAnimation.js"></script>
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