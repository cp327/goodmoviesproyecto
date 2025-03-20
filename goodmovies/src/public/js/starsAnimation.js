const canvas = document.getElementById('galaxyCanvas');
const ctx = canvas.getContext('2d');

let stars = [];
const numStars = 200;

function initializeStars() {
  stars = [];
  for (let i = 0; i < numStars; i++) {
    const x = Math.random() * canvas.width;
    const y = Math.random() * canvas.height;
    const radius = Math.random() * 2;
    const alpha = Math.random();
    const speed = Math.random() * 0.6 + 0.05;

    stars.push({ x, y, radius, alpha, speed });
  }
}

function resizeCanvas() {
  canvas.width = window.innerWidth;
  canvas.height = window.innerHeight;

  initializeStars(); // Reiniciar las posiciones iniciales al cambiar el tamaño
}

// Llamar a initializeStars y resizeCanvas al cargar la página
initializeStars();
resizeCanvas();

window.addEventListener('resize', resizeCanvas);

function drawStar(star) {
  ctx.beginPath();
  ctx.arc(star.x, star.y, star.radius, 0, Math.PI * 2);
  ctx.fillStyle = `rgba(255, 255, 255, ${star.alpha})`;
  ctx.fill();
}

function animate() {
  ctx.clearRect(0, 0, canvas.width, canvas.height);

  for (const star of stars) {
    star.y = (star.y + star.speed) % canvas.height;
    drawStar(star);
  }

  requestAnimationFrame(animate);
}

animate();
