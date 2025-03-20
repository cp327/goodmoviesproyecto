<?php
include("../../config/conexion.php");

if (isset($_POST['searchTerm'])) {
    $searchTerm = $_POST['searchTerm'];

    if (!empty($searchTerm)) {
        $query = "SELECT * FROM peliculasgm
                  WHERE IDpELICULA LIKE '%$searchTerm%'
                     OR TITULO LIKE '%$searchTerm%'
                     OR SINOPSIS LIKE '%$searchTerm%'
                     OR CATEGORIA LIKE '%$searchTerm'";
    } else {
        $query = "SELECT * FROM peliculasgm";
    }

    $result = $conexion->query($query);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['IDpELICULA'] . '</td>';
            echo '<td>' . $row['TITULO'] . '</td>';
            echo '<td>' . $row['CATEGORIA'] . '</td>';
            echo '<td class="sinopsis">' . $row['SINOPSIS'] . '</td>';
            echo '<td><img width="100px" src="data:image/jpg;base64,' . base64_encode($row['IMGpORTADA']) . '"/></td>';
            echo '<td>' . $row['VIDEO'] . '</td>';
            echo '</tr>';
        }
    } else {
        echo '<tr><td colspan="8">No se encontraron resultados.</td></tr>';
    }
}
?>
