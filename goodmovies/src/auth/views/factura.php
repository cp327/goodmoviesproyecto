<?php
session_start();

// Verificar si el usuario tiene una sesión activa
if (!isset($_SESSION['IDuSUARIO']) || empty($_SESSION['IDuSUARIO'])) {
    header("Location: ../../../index.php");
    die();
}

// Verificar si se tienen los datos necesarios para la factura
if (
    !isset($_SESSION['fecha_compra']) ||
    !isset($_SESSION['fecha_expiracion'])
)

// Resto del código de la vista de la factura
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura de Compra</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: black;
        }

        header {
            background-color: #333;
            padding: 10px;
            color: #fff;
            text-align: center;
        }

        .navbar {
            display: flex;
            justify-content: center;
            background-color: #444;
            padding: 10px;
        }

        .navbar a {
            color: #fff;
            text-decoration: none;
            margin: 0 15px;
            padding: 8px 15px;
            border-radius: 5px;
            background-color: #555;
            transition: background-color 0.3s;
        }

        .navbar a:hover {
            background-color: #777;
        }

        .factura-container {
            width: 60%;
            margin: 50px auto;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
        canvas {
  background-color: black;
}

/* styles_index.css (o tu archivo CSS principal) */

canvas#galaxyCanvas {
  position: fixed;
  top: 0;
  left: 0;
  z-index: -1; /* Para asegurarse de que esté detrás del contenido */
}
    </style>
</head>
<body>
<canvas id="galaxyCanvas"></canvas>
    <header>
        <h1>Factura de Compra</h1>
    </header>

    <div class="navbar">
        <!-- Agrega más enlaces según tus necesidades -->
        <a href="login.php?salir=true">Ir al Login</a>
        <a href="../../../index.php?salir=true">Cerrar Sesión e Ir al Inicio</a>
    </div>

    <div class="factura-container">
        <h2>Detalles de la Factura</h2>
        <p>Usuario: <?php echo $_SESSION['correo']; ?></p>
        <p>Fecha de compra: <?php echo $_SESSION['fecha_compra']; ?></p>
        <p>Fecha de expedición: <?php echo $_SESSION['fecha_expiracion']; ?></p>

        <!-- Agrega más detalles de la factura según tus necesidades -->
    </div>

    <?php 
    if (isset($_GET['salir']) && $_GET['salir'] == true) {
        // Limpiar todas las variables de sesión
        session_unset();
    
        // Destruir la sesión
        session_destroy();
    
        // Redirigir al index
        header("Location:../../../index.php");
        exit;
    }
    ?>
<script src="../../public/js/starsAnimation.js"></script>
</body>
</html>