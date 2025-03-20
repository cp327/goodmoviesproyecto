
document.addEventListener('DOMContentLoaded', function() {
  // Código para abrir y cerrar la primera ventana modal
  const openModalButton = document.getElementById('openModalButton');
  const modal = document.querySelector('.container-modal');
  const modalBackground = document.querySelector('.modal-background');

  openModalButton.addEventListener('click', function() {
    modal.style.display = 'block';
    modalBackground.style.display = 'block';
  });

  modalBackground.addEventListener('click', function() {
    modal.style.display = 'none';
    modalBackground.style.display = 'none';
  });
});



document.addEventListener('DOMContentLoaded', function() {
  // Código para abrir y cerrar la segunda ventana modal (edición)
  const openEditModalButtons = document.querySelectorAll('.las.la-edit');
  const editModal = document.querySelector('.container-modal-edit');
  const editModalBackground = document.querySelector('.modal-background');
  const editForm = document.getElementById('formAdmin-edit');

  let currentUserId; // Variable para almacenar el ID del usuario actual

  editForm.addEventListener('submit', function(event){
    event.preventDefault();
    const userID = currentUserId; // Obtener el userID del usuario actual
    const nombre = editForm.elements['nombre-edit'].value;
    const apellido = editForm.elements['apellido-edit'].value;
    const correo = editForm.elements['correo-edit'].value;
    
    console.log('Datos enviados:', JSON.stringify({
      userID: userID,
      nombre: nombre,
      apellido: apellido,
      correo: correo
    }));

    fetch(`../models/actualizar_empleado.php?`,{
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({
        userID: userID,
        nombre: nombre,
        apellido: apellido,
        correo: correo
        
      })
    })
    .then(response => {
      if (!response.ok) {
        throw new Error('Error en la solicitud Fetch');
      }
      return response.json();
    })
    .then(data => {
      console.log('Cambios guardados:', data);
      
      alert('Datos actualizados correctamente');

      
      editModal.style.display = 'none';
      editModalBackground.style.display = 'none';
      location.reload();
    })
    .catch(error => {
      console.error('Error al guardar los cambios:', error);
    });
  });

  openEditModalButtons.forEach(function(button) {
    button.addEventListener('click', function() {
      currentUserId = button.dataset.userId;
      console.log('ID del usuario:', currentUserId);

      fetch(`../models/consulta_empleado.php?IDuSUARIO=${currentUserId}`)
        .then(response => response.json())
        .then(data => {
 
          console.log(data);
          console.log('Nombre:', data.user_data.nombres);
          console.log('Apellido:', data.user_data.apellidos);
          
          console.log('Correo:', data.user_data.correo);

          

          editModal.style.display = 'block';
          editModalBackground.style.display = 'block';

          editForm.elements['nombre-edit'].value = data.user_data.nombres;
          editForm.elements['apellido-edit'].value = data.user_data.apellidos;
          
          editForm.elements['correo-edit'].value = data.user_data.correo;
          
          
        })
        .catch(error => {
          console.error('Error al obtener datos del usuario:', error);
        });
    });
  });

  editModalBackground.addEventListener('click', function() {
    editModal.style.display = 'none';
    editModalBackground.style.display = 'none';
  });
});




