
document.querySelectorAll('.las.la-trash').forEach(icon => {
    icon.addEventListener('click', function() {
        // Obtener el ID del usuario
        const userId = this.getAttribute('data-id');

        // Mostrar una confirmación antes de realizar la acción
        const confirmacion = confirm('¿Estás seguro de que quieres eliminar a este empleado?');

        // Verificar la respuesta del usuario
        if (confirmacion) {
            // Si el usuario confirma, realizar la eliminación
            fetch('../models/eliminar_empleado.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `tabla=usuarios&IDuSUARIO=${userId}`, // Asegúrate de incluir todos los parámetros requeridos
            })
            .then(response => {
                if (response.ok) {
                    location.reload(); // Recarga la página después de eliminar el usuario
                } else {
                    console.error('Error al eliminar el usuario');
                }
            })
            .catch(error => console.error('Error de red', error));
        } else {
            // Si el usuario cancela, no realizar la eliminación
            console.log('Eliminación cancelada por el usuario');
        }
    });
});


