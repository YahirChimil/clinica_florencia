<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Clínica Hospital Florencia | Oaxaca</title>
  <!-- Tailwind CSS via CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: '#09476e',
            secondary: '#e2f0fb',
            'primary-dark': '#073654',
          }
        }
      }
    }
  </script>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="font-sans bg-gray-50">
  <!-- Navbar Responsive -->
  <header class="bg-primary text-white shadow-lg">
    <div class="container mx-auto px-4 md:px-6 py-3 md:py-4 flex justify-between items-center">
      <div class="flex items-center">
        <a href="https://2scjc811-8080.usw3.devtunnels.ms//citas">
          <img src="src/logo_clinica2.png" alt="Logo" class="h-12 md:h-16">
        </a>
        <span class="text-lg md:text-2xl font-bold ml-2">Clínica Florencia</span>
      </div>
      
      <!-- Menú Desktop -->
      <nav class="hidden md:flex space-x-6 lg:space-x-8">
        <a href="#inicio" class="hover:text-secondary">Inicio</a>
        <a href="#nosotros" class="hover:text-secondary">Quiénes Somos</a>
        <a href="#ubicacion" class="hover:text-secondary">Ubicación</a>
        <a href="<?= base_url('citas/new') ?>" class="bg-secondary text-primary px-3 py-1 md:px-4 md:py-2 rounded-lg font-bold hover:bg-white transition whitespace-nowrap">
          Agendar Cita
        </a>
      </nav>
      
      <!-- Botón Móvil -->
      <button id="menu-btn" class="md:hidden text-2xl focus:outline-none">
        ☰
      </button>
    </div>
    
    <!-- Menú Móvil -->
    <div id="mobile-menu" class="md:hidden hidden bg-primary-dark px-4 pb-3">
      <a href="#inicio" class="block py-2 hover:text-secondary">Inicio</a>
      <a href="#nosotros" class="block py-2 hover:text-secondary">Quiénes Somos</a>
      <a href="#ubicacion" class="block py-2 hover:text-secondary">Ubicación</a>
      <a href="<?= base_url('citas/new') ?>" class="block bg-secondary text-primary px-4 py-2 rounded-lg font-bold mt-2 text-center">
        Agendar Cita
      </a>
    </div>
  </header>

  <!-- Hero Section -->
  <section id="inicio" class="bg-gradient-to-r from-primary to-blue-900 text-white py-12 md:py-20">
    <div class="container mx-auto px-4 md:px-6 text-center">
      <h1 class="text-3xl md:text-5xl font-bold mb-4 md:mb-6">Cuidando tu salud en Oaxaca</h1>
      <p class="text-lg md:text-xl mb-6 md:mb-8">Atención médica integral con calidez y profesionalismo</p>
      <a href="<?= base_url('citas/new') ?>" class="inline-block bg-white text-primary px-6 py-2 md:px-8 md:py-3 rounded-lg font-bold hover:bg-secondary transition">
        <i class="fas fa-calendar-check mr-2"></i>Agendar cita
      </a>
    </div>
  </section>

  <!-- Quiénes Somos -->
  <section id="nosotros" class="py-12 md:py-16 bg-white">
    <div class="container mx-auto px-4 md:px-6">
      <div class="text-center mb-8 md:mb-12">
        <h2 class="text-2xl md:text-3xl font-bold text-primary mb-3 md:mb-4">Quiénes Somos</h2>
        <div class="w-20 md:w-24 h-1 bg-secondary mx-auto"></div>
      </div>
      <div class="max-w-4xl mx-auto">
        <p class="text-base md:text-lg text-gray-700 mb-6 md:mb-8">
          En <strong>Clínica Hospital Florencia</strong>, nos dedicamos a brindar atención médica integral con calidez, ética y profesionalismo. Ubicados en el corazón del barrio de Jalatlaco en Oaxaca, somos un centro de salud comprometido con el bienestar de nuestra comunidad.
        </p>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
          <!-- Misión -->
          <div class="bg-secondary p-4 md:p-6 rounded-lg">
            <div class="text-primary text-xl md:text-2xl mb-3 md:mb-4">
              <i class="fas fa-bullseye"></i>
            </div>
            <h3 class="font-bold text-lg md:text-xl mb-2 md:mb-3 text-primary">Misión</h3>
            <p class="text-sm md:text-base text-gray-700">Brindar atención médica integral, ética y de alta calidad con tecnología de vanguardia y un trato humano y empático.</p>
          </div>
          
          <!-- Visión -->
          <div class="bg-secondary p-4 md:p-6 rounded-lg">
            <div class="text-primary text-xl md:text-2xl mb-3 md:mb-4">
              <i class="fas fa-eye"></i>
            </div>
            <h3 class="font-bold text-lg md:text-xl mb-2 md:mb-3 text-primary">Visión</h3>
            <p class="text-sm md:text-base text-gray-700">Ser reconocidos en Oaxaca por nuestra excelencia médica y atención centrada en el paciente.</p>
          </div>
          
          <!-- Valores -->
          <div class="bg-secondary p-4 md:p-6 rounded-lg">
            <div class="text-primary text-xl md:text-2xl mb-3 md:mb-4">
              <i class="fas fa-heart"></i>
            </div>
            <h3 class="font-bold text-lg md:text-xl mb-2 md:mb-3 text-primary">Valores</h3>
            <ul class="list-disc list-inside text-sm md:text-base text-gray-700 space-y-1">
              <li>Compromiso</li>
              <li>Calidez</li>
              <li>Profesionalismo</li>
              <li>Ética</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Ubicación -->
  <section id="ubicacion" class="py-12 md:py-16 bg-gray-100">
    <div class="container mx-auto px-4 md:px-6">
      <div class="text-center mb-8 md:mb-12">
        <h2 class="text-2xl md:text-3xl font-bold text-primary mb-3 md:mb-4">Ubicación</h2>
        <div class="w-20 md:w-24 h-1 bg-secondary mx-auto"></div>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12 items-center">
        <div>
          <h3 class="text-lg md:text-xl font-semibold mb-3 md:mb-4 text-primary">Encuéntranos en Jalatlaco</h3>
          <p class="text-sm md:text-base text-gray-700 mb-3 md:mb-4">
            Estamos ubicados en el corazón del barrio de Jalatlaco, Oaxaca, para servirte con accesibilidad y comodidad.
            
          </p>
          <div class="space-y-2 md:space-y-3">
            <p class="flex items-center text-sm md:text-base text-gray-700">
              <i class="fas fa-map-marker-alt text-primary mr-2 md:mr-3"></i> 
              Curtidurías 320, Barrio de Jalatlaco, 68080 Oaxaca de Juárez, Oax.
            </p>
            <p class="flex items-center text-sm md:text-base text-gray-700">
              <i class="fas fa-phone-alt text-primary mr-2 md:mr-3"></i> 
              (951) 
            </p>
          </div>
        </div>
        <div class="h-64 md:h-80 bg-gray-300 rounded-lg overflow-hidden mt-4 md:mt-0">
          <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3814.1456042717673!2d-96.71542029999999!3d17.0655291!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85c7223717d04505%3A0xa337ff3194d15340!2sCl%C3%ADnica%20Hospital%20Florencia!5e0!3m2!1ses!2smx!4v1744843405097!5m2!1ses!2smx" 
            width="100%" 
            height="100%" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy">
          </iframe>
        </div>
      </div>
    </div>
  </section>

  <!-- Call to Action -->
  <section class="py-10 md:py-12 bg-primary text-white">
    <div class="container mx-auto px-4 md:px-6 text-center">
      <h2 class="text-xl md:text-3xl font-bold mb-4 md:mb-6">¿Necesitas atención médica?</h2>
      <a href="<?= base_url('citas') ?>" class="inline-block bg-white text-primary px-6 py-2 md:px-8 md:py-3 rounded-lg font-bold hover:bg-secondary transition">
        <i class="fas fa-calendar-check mr-2"></i>Agendar cita ahora
      </a>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-gray-800 text-white py-6 md:py-8">
    <div class="container mx-auto px-4 md:px-6">
      <div class="flex flex-col md:flex-row justify-between items-center">
        <div class="mb-4 md:mb-0 text-center md:text-left">
          <div class="flex items-center justify-center md:justify-start">
            <i class="fas fa-hospital-alt text-xl md:text-2xl mr-2 md:mr-3"></i>
            <span class="text-lg md:text-xl font-bold">Clínica Hospital Florencia</span>
          </div>
          <p class="text-xs md:text-sm text-gray-400 mt-1 md:mt-2">Jalatlaco, Oaxaca</p>
        </div>
        <div class="flex space-x-4 md:space-x-6">
          <a href="#" class="text-gray-400 hover:text-white text-lg md:text-xl"><i class="fab fa-facebook"></i></a>
          <a href="#" class="text-gray-400 hover:text-white text-lg md:text-xl"><i class="fab fa-instagram"></i></a>
          <a href="#" class="text-gray-400 hover:text-white text-lg md:text-xl"><i class="fab fa-whatsapp"></i></a>
        </div>
      </div>
      <div class="border-t border-gray-700 mt-6 md:mt-8 pt-6 md:pt-8 text-center text-xs md:text-sm text-gray-400">
        <p>© 2023 Clínica Hospital Florencia. Todos los derechos reservados.</p>
      </div>
    </div>
  </footer>

  <!-- Script del Menú Móvil -->
  <script>
    const menuBtn = document.getElementById('menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    
    menuBtn.addEventListener('click', () => {
      mobileMenu.classList.toggle('hidden');
      menuBtn.innerHTML = mobileMenu.classList.contains('hidden') ? '☰' : '✕';
    });
  </script>
</body>
</html>