document.addEventListener("DOMContentLoaded", function() {
  const header = document.querySelector(".header");

  window.addEventListener("scroll", function() {
      if (window.scrollY > 0) {
          // Hacer scroll hacia abajo: mostrar el header
          header.style.transform = "translateY(0)";
      } else {
          // En el comienzo de la página: ocultar el header
          header.style.transform = "translateY(-200%)";
      }
  });
});


// Espera a que se cargue el DOM
document.addEventListener("DOMContentLoaded", function() {
  // Selecciona todos los elementos con atributos de datos "data-target"
  const smoothScrollButtons = document.querySelectorAll('[data-target]');

  // Agrega un controlador de eventos clic a cada botón
  smoothScrollButtons.forEach(function(button) {
      button.addEventListener('click', function(e) {
          e.preventDefault(); // Evita el comportamiento predeterminado del enlace
          
          // Obtiene el ID del elemento al que se debe desplazar
          const targetID = button.getAttribute('data-target');
          
          // Encuentra el elemento correspondiente al ID
          const targetElement = document.getElementById(targetID);
          
          if (targetElement) {
              // Utiliza scrollIntoView() con el comportamiento de desplazamiento suave
              targetElement.scrollIntoView({
                  behavior: 'smooth',
                  block: 'start', // Opcional, controla la alineación vertical
              });
          }
      });
  });
});






document.addEventListener("DOMContentLoaded", function () {
    const imageLinks = document.querySelectorAll(".image-link");
    const videoModal = document.getElementById("video-modal");
    const video = document.getElementById("video");
    const videoOverlay = document.getElementById("video-overlay");
    const alert = document.getElementById("alert");
    const closeButton = document.getElementById("close-button");
    const alertCloseButton = document.getElementById("alert-close-button");
    let timeout;
    let isVideoBlocked = false;
    let videoStartTime = 0;

    // Configura la deshabilitación de la función de descarga
    video.controlsList.add("nodownload");

    imageLinks.forEach((link) => {
        link.addEventListener("click", function (e) {
            e.preventDefault();
            const videoSrc = link.getAttribute("data-video");
            video.setAttribute("src", videoSrc);
            video.load();
            videoModal.style.display = "block";
            videoStartTime = Date.now(); // Guarda el tiempo de inicio del video

            // Desbloquear la reproducción del video si estaba bloqueado
            if (isVideoBlocked) {
                isVideoBlocked = false;
                video.controls = true;
            }

            video.play();
        });
    });

    closeButton.addEventListener("click", function () {
        video.pause();
        videoModal.style.display = "none";
        videoOverlay.style.display = "none";
    });

    alertCloseButton.addEventListener("click", function () {
        videoOverlay.style.display = "none";
    });

    alert.querySelector(".join-button").addEventListener("click", function () {
        window.location.href = "../vistas/registro.html";
    });

    video.addEventListener("play", function () {
        if (isVideoBlocked) {
            video.pause();
        }
    });

    video.addEventListener("timeupdate", function () {
        const currentTime = Date.now();
        const elapsedSeconds = (currentTime - videoStartTime) / 1000;

        if (!isVideoBlocked && elapsedSeconds >= 10) {
            isVideoBlocked = true;
            video.controls = false;
            video.pause();
            videoOverlay.style.display = "block";
        }
    });
});

























// document.addEventListener("DOMContentLoaded", function () {
//     const imageLinks = document.querySelectorAll(".image-link");
//     const videoModal = document.getElementById("video-modal");
//     const video = document.getElementById("video");
//     const videoOverlay = document.getElementById("video-overlay");
//     const alert = document.getElementById("alert");
//     const closeButton = document.getElementById("close-button");
//     const alertCloseButton = document.getElementById("alert-close-button");
//     let timeout;
//     let isVideoBlocked = false;

//     imageLinks.forEach((link) => {
//         link.addEventListener("click", function (e) {
//             e.preventDefault();
//             const videoSrc = link.getAttribute("data-video");
//             video.setAttribute("src", videoSrc);
//             video.load();
//             videoModal.style.display = "block";

//             // Desbloquear la reproducción del video si estaba bloqueado
//             if (isVideoBlocked) {
//                 isVideoBlocked = false;
//                 video.controls = true;
//             }

//             video.play();
//             clearTimeout(timeout);
//             timeout = setTimeout(function () {
//                 isVideoBlocked = true; // Bloquea la reproducción del video después de 4 segundos
//                 video.controls = false;
//                 video.pause();
//                 videoOverlay.style.display = "block"; // Muestra el video-overlay
//             }, 4000); // Muestra la alerta después de 4 segundos de video
//         });
//     });

//     closeButton.addEventListener("click", function () {
//         video.pause();
//         videoModal.style.display = "none";
//         videoOverlay.style.display = "none"; // Oculta el video-overlay
//     });

//     alertCloseButton.addEventListener("click", function () {
//         videoOverlay.style.display = "none"; // Oculta el video-overlay al hacer clic en la X de la alerta
//     });

//     alert.querySelector(".join-button").addEventListener("click", function () {
//         window.location.href = "../vistas/registro.html";
//     });

//     // Evitar la reproducción del video si isVideoBlocked es true
//     video.addEventListener("play", function () {
//         if (isVideoBlocked) {
//             video.pause();
//         }
//     });
// });


// // ...
// alertCloseButton.addEventListener("click", function () {
//     videoOverlay.style.display = "none"; // Oculta el video-overlay al hacer clic en la X de la alerta
// });

// // ... codigo que funciona


















// document.addEventListener("DOMContentLoaded", function () {
//     const imageLinks = document.querySelectorAll(".image-link");
//     const videoModal = document.getElementById("video-modal");
//     const video = document.getElementById("video");
//     const videoOverlay = document.getElementById("video-overlay");
//     const alert = document.getElementById("alert");
//     const closeButton = document.getElementById("close-button");
//     const alertCloseButton = document.getElementById("alert-close-button");
//     let timeout;
//     let isVideoBlocked = false;
//     let videoStartTime = 0;

//     imageLinks.forEach((link) => {
//         link.addEventListener("click", function (e) {
//             e.preventDefault();
//             const videoSrc = link.getAttribute("data-video");
//             video.setAttribute("src", videoSrc);
//             video.load();
//             videoModal.style.display = "block";
//             videoStartTime = Date.now(); // Guarda el tiempo de inicio del video

//             // Desbloquear la reproducción del video si estaba bloqueado
//             if (isVideoBlocked) {
//                 isVideoBlocked = false;
//                 video.controls = true;
//             }

//             video.play();
//         });
//     });

//     closeButton.addEventListener("click", function () {
//         video.pause();
//         videoModal.style.display = "none";
//         videoOverlay.style.display = "none";
//     });

//     alertCloseButton.addEventListener("click", function () {
//         videoOverlay.style.display = "none";
//     });

//     alert.querySelector(".join-button").addEventListener("click", function () {
//         window.location.href = "../vistas/registro.html";
//     });

//     video.addEventListener("play", function () {
//         if (isVideoBlocked) {
//             video.pause();
//         }
//     });

//     video.addEventListener("timeupdate", function () {
//         const currentTime = Date.now();
//         const elapsedSeconds = (currentTime - videoStartTime) / 1000;

//         if (!isVideoBlocked && elapsedSeconds >= 4) {
//             isVideoBlocked = true;
//             video.controls = false;
//             video.pause();
//             videoOverlay.style.display = "block";
//         }
//     });
// });

let slideIndex = 0;
const slides = document.querySelectorAll(".slide");

function showSlide() {
    slides[slideIndex].style.opacity = 0;
    slideIndex = (slideIndex + 1) % slides.length;
    slides[slideIndex].style.opacity = 1;
}

// Iniciar el slider
slides[0].style.opacity = 1;
setInterval(showSlide, 3000);




const canvas = document.getElementById('galaxyCanvas');
const ctx = canvas.getContext('2d');

canvas.width = window.innerWidth;
canvas.height = window.innerHeight;

const stars = [];
const numStars = 200;

for (let i = 0; i < numStars; i++) {
  const x = Math.random() * canvas.width;
  const y = Math.random() * canvas.height;
  const radius = Math.random() * 2;
  const alpha = Math.random();
  const speed = Math.random() * 0.5 + 0.1;

  stars.push({ x, y, radius, alpha, speed });
}

function drawStar(star) {
  ctx.beginPath();
  ctx.arc(star.x, star.y, star.radius, 0, Math.PI * 2);
  ctx.fillStyle = `rgba(255, 255, 255, ${star.alpha})`;
  ctx.fill();
}

function animate() {
  ctx.clearRect(0, 0, canvas.width, canvas.height);

  for (const star of stars) {
    drawStar(star);
    star.y += star.speed;
    if (star.y > canvas.height) {
      star.y = 0;
    }
  }

  requestAnimationFrame(animate);
}

animate();
