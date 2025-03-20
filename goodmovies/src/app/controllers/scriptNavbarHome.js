// Buscador de contenido

// Ejecutando funciones
document.getElementById("icon-search").addEventListener("click", mostrar_buscador);
document.getElementById("cover-ctn-search").addEventListener("click", ocultar_buscador);

document.getElementById("btnSearch").addEventListener("click", function() {
    if (inputSearch.value.trim() !== "") {
        obtenerResultadosJson();
    }
});

// Declarando variables
bars_search = document.getElementById("ctn-bars-search");
cover_ctn_search = document.getElementById("cover-ctn-search");
inputSearch = document.getElementById("inputSearch");
box_search = document.getElementById("box-search");

// Función para mostrar el buscador
function mostrar_buscador() {
    bars_search.style.top = "44px";
    cover_ctn_search.style.display = "block";
    inputSearch.focus();
}

// Función para ocultar el buscador
function ocultar_buscador() {
    bars_search.style.top = "-44px";
    cover_ctn_search.style.display = "none";
    inputSearch.value = "";
    box_search.style.display = "none";
}

// Creando filtrado de búsqueda
document.getElementById("inputSearch").addEventListener("keyup", buscador_interno);

function buscador_interno() {
    filter = inputSearch.value.toUpperCase();
    li = box_search.getElementsByTagName("li");

    // Recorriendo elementos a filtrar mediante los "li"
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        textValue = a.textContent || a.innerText;

        if (textValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
            box_search.style.display = "block";

            if (inputSearch.value === "") {
                box_search.style.display = "none";
            }
        } else {
            li[i].style.display = "none";
        }
    }

    // Si hay resultados coincidentes, generar el JSON y redirigir a resultado.php
    if (box_search.style.display === "block") {
        obtenerResultadosJson();
    }
}

function obtenerResultadosJson() {
    var rutaCompleta = '../models/resultado_busqueda.php?busqueda=' + inputSearch.value;

    fetch(rutaCompleta)
        .then(response => response.json())
        .then(data => {
            // Almacenar la consulta directamente en guardar_resultados.php
            fetch('../models/guardar_resultados.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data),
            })
            .then(response => response.json())
            .then(responseData => {
                // Redirigir a resultado.php y pasar la ruta del archivo como parámetro en la URL
                var resultadosUrl = `../views/resultado.php`;
                window.location.href = resultadosUrl;
            })
            .catch(error => console.error('Error al guardar los resultados:', error));
        })
        .catch(error => console.error('Error al obtener datos desde el servidor:', error));
}


