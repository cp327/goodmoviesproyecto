var descripcion; // Declarar la variable fuera del bloque
// Función para obtener descripciones
document.addEventListener('DOMContentLoaded', function () {
  fetch('../models/descripcion_favorito.php')
    .then(response => response.json())
    .then(data => {
      descripcion = data; // Asignar el valor a la variable fuera del bloque
      console.log(descripcion);

      // Resto de tu código
      var cambioTitulo = (index) => {
        var btnFavoritos = document.getElementById('btnFavoritos');
    
        // Verifica si el objeto y el índice existen
        if (descripcion && descripcion[index]) {
            // Actualiza el atributo data-idpelicula del botón con el ID de la película
            btnFavoritos.setAttribute('data-idpelicula', descripcion[index].idPelicula);
            console.log(`data-idpelicula favorito actualizado a ${descripcion[index].idPelicula}`);
        } else {
            // Manejar el caso donde el objeto o el índice no existen
            console.error(`El objeto con índice ${index} no está definido en 'descripcion'.`);
        }
    
        // Agrega tu lógica para aplicar estilos dinámicamente aquí
    };
    

      // Swiper cambio de descripción
      swiper.on('activeIndexChange', function(){
        cambioTitulo(swiper.activeIndex);
      });
      // Llama a cambioTitulo con el índice 0 después de cargar la página
      cambioTitulo(0);
    })

  // Obtener automáticamente las descripciones de la categoría de favoritos
  fetch('../models/descripcion_descarga.php')
    .then(response => response.json())
    .then(data => {
      descripcion = data; // Asignar el valor a la variable fuera del bloque
      console.log(descripcion);

      // Resto de tu código
      var cambioTitulo = (index) => {
        var titulo = document.querySelector('#titulo');
        var subTitulo = document.querySelector('#sub-titulo');
        var desc = document.querySelector('#description');
        var btnDescargas = document.getElementById('btnDescargas');
    
        // Verifica si el objeto y el índice existen
        if (descripcion && descripcion[index]) {
            titulo.innerHTML = `<h1>${descripcion[index].titulo}</h1>`;
            subTitulo.innerHTML = `<p>${descripcion[index].subTitulo}</p>`;
            desc.innerHTML = `<p>${descripcion[index].desc}</p>`;
    
            // Actualiza el atributo data-idpelicula del botón con el ID de la película
            btnDescargas.setAttribute('data-idpelicula', descripcion[index].idPelicula);
            console.log(`data-idpelicula descarga actualizado a ${descripcion[index].idPelicula}`);
        } else {
            // Manejar el caso donde el objeto o el índice no existen
            console.error(`El objeto con índice ${index} no está definido en 'descripcion'.`);
        }
    
        // Agrega tu lógica para aplicar estilos dinámicamente aquí
    };
    

      // Swiper cambio de descripción
      swiper.on('activeIndexChange', function(){
        cambioTitulo(swiper.activeIndex);
      });
      // Llama a cambioTitulo con el índice 0 después de cargar la página
      cambioTitulo(0);
    })
    .catch(error => console.error('Error al obtener datos desde el servidor:', error));
});




// Resto de tu código (Swiper, funciones adicionales, etc.)


// Ver overlay + trailer "pelicula/serie"
var overlay = document.querySelector(".overlay");
var videoContenedor = document.querySelector('#trailer');
var showTrailer = () => {
  var index = swiper.activeIndex;
  var youtubeVideoId = obtenerYoutubeVideoId(descripcion[index].videoURL);

  if (youtubeVideoId) {
    videoContenedor.innerHTML = `
    <div id="video"><iframe 
        width="560" 
        height="315" 
        src="https://www.youtube.com/embed/${youtubeVideoId}?autoplay=1&mute=1" 
        frameborder="0" 
        allowfullscreen
      ></iframe></div>
    `;
    
    overlay.classList.add("show");
  } else {
    console.error('No se pudo obtener el ID del video de YouTube.');
  }
};

// Función para obtener el ID del video de YouTube desde la URL
function obtenerYoutubeVideoId(url) {
  // Intenta extraer el ID del video desde la URL directa de YouTube
  var match = url.match(/(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=|watch\?.+&video_ids=))([^"&?\/\s]{11})/);

  return match && match[1];
}

// Cerrar overlay + pausar video
var closeOverlay = () => {
  var iframe = document.querySelector("#trailer iframe");
  if (iframe) {
    var iframeSrc = iframe.src;
    iframe.src = iframeSrc; // Pausa el video y reinicia el iframe
  }

  overlay.classList.remove('show');
};




// animacion de cartas de portadas mas swiper
var thumbsSwiper = new Swiper('.thumbsSwiper',{
    spaceBetween: 10,
    slidesPerView: 5,
    breakpoints:{
        200:{
            slidesPerView: 1.5
        },
        400:{
            slidesPerView: 1.5
        },
        600:{
            slidesPerView: 2
        },
        750:{
            slidesPerView: 2.5
        },
        850:{
            slidesPerView: 3
        },
        1339:{
            slidesPerView: 3.5
        },
        1440:{
            slidesPerView: 4.5
        },
    },
    freeMode: true,
    watchSlidesProgress: true,
})




// swiper
const swiper = new Swiper('.bannerSwiper', {
    // spaceBetween: 0,
    effect: "fade",
    
    // If we need pagination
    pagination: {
        el: '.swiper-pagination',
        clickable: true
    },

    // Navigation arrows
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    // cambio de portada+fondo segun la pelicula
    thumbs:{
        swiper: thumbsSwiper
    }
});
