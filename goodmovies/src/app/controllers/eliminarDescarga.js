var eliminarDeDescargas = () => {
    var btnDescargas = document.getElementById('btnDescargas');
    var idPelicula = btnDescargas.getAttribute('data-idpelicula');
    console.log(idPelicula);

    // Aquí puedes enviar el idPelicula al servidor (usando AJAX, por ejemplo)
    console.log(`Eliminando película ${idPelicula} de mis descargas`);

    // Llamada AJAX para enviar el ID al servidor
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../models/eliminar_descarga.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Manejar la respuesta del servidor
            var response = JSON.parse(xhr.responseText);
            console.log(response.message);

            if (response.status==='success') {
                window.location.href=response.redirect;
            }

        }
    };

    // Enviar el ID de la película al servidor
    xhr.send("IDpELICULA=" + idPelicula);
};

