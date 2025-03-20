document.addEventListener('DOMContentLoaded', function () {
    var formularioContrasena = document.getElementById('formulario-contrasena');
    var mensajeContainer = document.getElementById('mensaje-container');

    if (formularioContrasena) {
        formularioContrasena.addEventListener('submit', function (event) {
            event.preventDefault();

            // Realizar la solicitud AJAX
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '../models/actualizar_contrasena.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            xhr.onload = function () {
                if (xhr.status >= 200 && xhr.status < 300) {
                    var response = JSON.parse(xhr.responseText);

                    // Mostrar la alerta en la página actual
                    mostrarMensaje(response.message, response.status);

                    // Redirigir si es necesario
                    if (response.status === 'success') {
                        // Agregar un retraso de 3 segundos (3000 milisegundos) antes de redirigir
                        setTimeout(function() {
                        window.location.href = '../../auth/views/login.php';
                    }, 1500);
                    }
                    
                } else {
                    // Manejar errores de la solicitud AJAX
                    mostrarMensaje('Error en la solicitud AJAX', 'error');
                }
            };

            // Obtener datos del formulario
            var formData = new FormData(event.target);

            // Enviar la solicitud AJAX con los datos del formulario
            xhr.send(new URLSearchParams(formData));
        });
    }

    function mostrarMensaje(mensaje, tipo) {
        // Limpiar mensajes anteriores
        mensajeContainer.innerHTML = '';

        // Crear elemento para el mensaje
        var mensajeElement = document.createElement('div');
        mensajeElement.className = 'alert';

        // Asignar clase según el tipo de mensaje
        if (tipo === 'success') {
            mensajeElement.classList.add('alert-success');
        } else if (tipo === 'error') {
            mensajeElement.classList.add('alert-danger');
        }

        // Asignar el mensaje al elemento
        mensajeElement.innerHTML = mensaje;

        // Agregar el elemento al contenedor de mensajes
        mensajeContainer.appendChild(mensajeElement);
    }
});
