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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/styles_tabla_admin.css">
    <link rel="stylesheet" href="../../public/css/style.css">
    <title>GOODMOVIES</title>
    <link rel="icon" href="../../public/img/logo/logoGM.png" type="image/x-icon">
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
<div class="main-content">

<main>      
    <div class="page-header">
            <h1>Panel administrativo</h1>
            <small>Peliculas</small>
    </div>
    <div class="page-content">

    <?php 
    include 'template.php'; 
    ?>

        <div class="search-container">
            <h3>Buscador:</h3>
            <!-- <i class='bx bx-search'></i> -->
            <input class="buscador" type="text" id="searchInput" placeholder="Buscar por ID, título, sinopsis o categoría">
            <div id="searchResults"></div>
        </div>

<div style="margin-left: 180px;" >
        <table class="table">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Titulo</td>
                    <td>Categoria</td>
                    <td>Sinopsis</td>
                    <td>Portada</td>
                    <td>Video</td>
                    <!-- <td>Actualizar</td>
                    <td>Eliminar</td> -->
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
                    echo '<td >' . $row['CATEGORIA'] . '</td>';
                    echo '<td class="sinopsis" width="50%" >' . $row['SINOPSIS'] . '</td>';
                    echo '<td><img width="100px" src="data:image/jpg;base64,' . base64_encode($row['IMGpORTADA']) . '"/></td>';
                    echo '<td>' . $row['VIDEO'] . '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
        </div>
        </div>
</main>
</div>
</body>
</html>