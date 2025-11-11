let currentSlide = 0;
const slides = document.querySelectorAll('.carousel img');
const dots = document.querySelectorAll('.dot');

// Mostrar la slide correspondiente
function showSlide(index) {
  slides.forEach(slide => slide.classList.remove('active'));
  dots.forEach(dot => dot.classList.remove('active'));

  slides[index].classList.add('active');
  if (dots[index]) dots[index].classList.add('active'); // Evita error si no hay dots
}

// Ir a la siguiente slide
function nextSlide() {
  currentSlide = (currentSlide + 1) % slides.length;
  showSlide(currentSlide);
}

// Ir a la slide anterior (si hay botón "prev")
function prevSlide() {
  currentSlide = (currentSlide - 1 + slides.length) % slides.length;
  showSlide(currentSlide);
}

// Ir a una slide específica (usado con dots)
function goToSlide(index) {
  currentSlide = index;
  showSlide(currentSlide);
}

// Event listeners para los puntos si existen
dots.forEach((dot, index) => {
  dot.addEventListener('click', () => goToSlide(index));
});

// Opcional: agregar listeners a botones si existen
const prevBtn = document.querySelector('.carousel-btn.prev');
const nextBtn = document.querySelector('.carousel-btn.next');

if (prevBtn && nextBtn) {
  prevBtn.addEventListener('click', prevSlide);
  nextBtn.addEventListener('click', nextSlide);
}

// Iniciar carrusel automático cada 5 segundos
setInterval(nextSlide, 5000);

// Mostrar la primera slide al cargar
window.onload = () => showSlide(currentSlide);

