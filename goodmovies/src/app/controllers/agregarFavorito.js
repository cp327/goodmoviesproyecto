
  var agregarAFavoritos = () => {
    var btnFavoritos = document.getElementById('btnFavoritos');
    var idPelicula = btnFavoritos.getAttribute('data-idpelicula');


    // Llamada AJAX para verificar si la película ya está en favoritos
    var verificarXHR = new XMLHttpRequest();
    verificarXHR.open("POST", "../models/verificar_favorito.php", true);
    verificarXHR.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    verificarXHR.onreadystatechange = function () {
        if (verificarXHR.readyState == 4 && verificarXHR.status == 200) {
            // Manejar la respuesta del servidor
            var response = JSON.parse(verificarXHR.responseText);

            // Verificar si la película ya está en favoritos
            if (response.status === 'success') {
                // Película ya está en la lista, muestra un alert
                alert('Esta película ya está en tu lista de favoritos');
            } else {
                // Llamada AJAX para agregar la película a favoritos
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "../models/agregar_favorito.php", true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        // Manejar la respuesta del servidor
                        var agregarResponse = JSON.parse(xhr.responseText);
                        console.log(agregarResponse.message);
                        alert('Película añadida a favoritos');
                    }
                };

                // Enviar el ID de la película al servidor para agregar a favoritos
                xhr.send("IDpELICULA=" + idPelicula);
            }
        }
    };

    // Enviar el ID de la película al servidor para verificar si ya está en favoritos
    verificarXHR.send("IDpELICULA=" + idPelicula);
};



