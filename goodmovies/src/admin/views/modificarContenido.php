<?php
// seguridad
session_start();
$varsesion = $_SESSION['correo'];
if ($varsesion == null || $varsesion = '') {
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
    <link rel="stylesheet" href="../../public/css/styles_modificar.css">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Open+Sans&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>GOODMOVIES</title>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        // Función para asignar eventos a los iconos
function assignEventsToIcons() {
    // Agrega el icono de editar a cada elemento de clase .buton1
    $('.buton1').html('<i class="bx bxs-edit"></i>');

    // Agrega el icono de eliminar a cada elemento de clase .buton2
    $('.buton2').html('<i class="bx bxs-trash"></i>');
}

$(document).ready(function () {
    $(document).on('input', '#searchInput', function () {
        var searchTerm = $(this).val().trim();

        if (searchTerm.length > 0) {
            $.ajax({
                type: 'POST',
                url: 'search.php',
                data: { searchTerm: searchTerm },
                success: function (data) {
                    // Limpiar el contenido de la tabla antes de agregar los nuevos resultados
                    $('.table tbody').empty();

                    // Agregar los nuevos resultados
                    $('.table tbody').html(data);

                    // Mostrar la tabla
                    $('.table').show();

                    // Volver a asignar eventos a los iconos después de actualizar la tabla
                    assignEventsToIcons();
                }
            });
        } else {
            // Si no hay término de búsqueda, muestra la tabla completa
            $.ajax({
                type: 'POST',
                url: 'search.php',
                data: { searchTerm: '' },
                success: function (data) {
                    // Limpiar el contenido de la tabla antes de agregar los resultados completos
                    $('.table tbody').empty();

                    // Agregar los resultados completos
                    $('.table tbody').html(data);

                    // Mostrar la tabla
                    $('.table').show();

                    // Volver a asignar eventos a los iconos después de actualizar la tabla
                    assignEventsToIcons();
                }
            });
        }
    });

    // Asignar eventos a los iconos cuando se carga la página
    assignEventsToIcons();
});

    </script>
</head>

<body>
    <header class="header">
        <h1 class="logotipo">ADMINISTRADOR DE PELÍCULAS</h1>
        <label for="check" class="icons"></label>
        <nav class="navbar">
            <!-- <a href="" style="--i:0;">Nosotros</a>
            <a href="" style="--i:1;">Contacto</a> -->
        </nav>
    </header>

    <div class="containerall">
        <div class="letters">
            <h2>TABLA DE PELICULAS</h2>
        </div>


        <div class="minicont">

        <div class="search-container">
            <!-- <i class='bx bx-search'></i> -->
            <input class="botones inn" type="text" id="searchInput" placeholder="ID, título, sinopsis o categoría">
            <div id="searchResults"></div>
        </div>

        <div class="cont-btns">
            <a href="home.php" class=""><button class="btn2 botones">Inicio</button></a>
            <a href="agregarPeliculaForm.php"><button class="btn botones">Agregar pelicula</button></a>
            <!-- <a href="modificarContenidoSeries.php"><button class="btn1 botones">Ir a admin. Series</button></a> -->
        </div>

        </div>
<center>
        <table class="table">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Titulo</td>
                    <td>Categoria</td>
                    <td>Sinopsis</td>
                    <td>Portada</td>
                    <td>Video</td>
                    <td>Actualizar</td>
                    <td>Eliminar</td>
                </tr>
            </thead>
            <tbody>
                <?php
                include("../../config/conexion.php");
                $query = "SELECT * FROM peliculasgm";
                $resultado = $conexion->query($query);
                while ($row = $resultado->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row['IDpELICULA'] . '</td>';
                    echo '<td>' . $row['TITULO'] . '</td>';
                    echo '<td>' . $row['CATEGORIA'] . '</td>';
                    echo '<td class="sinopsis">' . $row['SINOPSIS'] . '</td>';
                    echo '<td><img width="100px" src="data:image/jpg;base64,' . base64_encode($row['IMGpORTADA']) . '"/></td>';
                    echo '<td>' . $row['VIDEO'] . '</td>';
                    echo '<td><a class="iconos" href="actualizarPeliculaForm.php?IDpELICULA=' . $row['IDpELICULA'] . '"><div class="buton1"><i class="bx bxs-edit icon-edit"></i></div></a></td>';
                    echo '<td><a class="iconos" href="../models/eliminarPelicula.php?IDpELICULA=' . $row['IDpELICULA'] . '"><div class="buton2"><i class="bx bxs-trash"></i></div></a></td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>

</center>
        <br>
    </div>
</body>

</html>
