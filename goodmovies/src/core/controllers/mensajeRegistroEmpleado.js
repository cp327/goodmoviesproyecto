
document.getElementById('formAdmin').addEventListener('submit', function (e) {
    e.preventDefault();

    fetch('../models/agregar_empleado.php', {
        method: 'POST',
        body: new FormData(this),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Registro exitoso');
            document.getElementById('formAdmin').reset();
            location.reload();
        } else {
            let errorMsg = '';

            if (data.correoExists) {
                errorMsg += 'El correo ya está en uso.';
            }

            if (errorMsg === '') {
                errorMsg = 'Error al registrar';
            }

            alert(errorMsg);
        }
    })
    .catch(error => {
        console.error('Error de red:', error);
    });
});

