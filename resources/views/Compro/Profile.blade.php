<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title>Company Profile - PT Billiard Jaya</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

  <!-- Bootstrap JS Bundle (sudah include Popper) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <!-- Logo -->
  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.0/css/all.css">

  <!-- Font -->
  <link href="https://fonts.googleapis.com/css2?family=Bungee&display=swap" rel="stylesheet">

  <!-- Swiper CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

  <style>
    /* Background pattern bola billiard */x
    /* Body & background */
body {
    background: radial-gradient(circle at top left, #064e3b, #000000 80%);
    color: #ffffff;
    scroll-behavior: smooth;
    position: relative;
    overflow-x: hidden; /* cegah scroll horizontal */
    margin: 0;
}

/* Pseudo-element agar tidak keluar layar */
body::before,
body::after {
    content: '';
    position: absolute;
    border-radius: 50%;
    filter: blur(100px);
    opacity: 0.15;
    z-index: -1;
    max-width: 100vw;
    max-height: 100vh;
    overflow: hidden;
}

body::before {
    width: 300px;
    height: 300px;
    background: #22c55e;
    top: -50px;
    left: -80px;
}

body::after {
    width: 400px;
    height: 400px;
    background: #0ea5e9;
    bottom: -100px;
    right: -120px;
}

/* Navbar & Mobile Menu */
#mobile-menu {
    overflow-x: hidden;
    max-width: 100vw;
}

/* Pastikan semua elemen tidak melebihi viewport */
html, body {
    width: 100%;
    max-width: 100%;
    overflow-x: hidden !important;
}

/* Swiper, container, atau section */
main, footer, header,  {
    max-width: 100vw;
    overflow-x: hidden;
}

/* Optional: disable user zoom (mobile) */
html {
    touch-action: pan-x pan-y;
}

  /* Animasi link masuk */
/* Animasi link masuk */
#mobile-menu.show .mobile-link {
  opacity: 0;
  transform: translateX(20px);
  animation: fadeSlideIn 0.4s forwards;
}

#mobile-menu.show .mobile-link:nth-child(1) { animation-delay: 0.1s; }
#mobile-menu.show .mobile-link:nth-child(2) { animation-delay: 0.2s; }
#mobile-menu.show .mobile-link:nth-child(3) { animation-delay: 0.3s; }
#mobile-menu.show .mobile-link:nth-child(4) { animation-delay: 0.4s; }
#mobile-menu.show .mobile-link:nth-child(5) { animation-delay: 0.5s; }
#mobile-menu.show .mobile-link:nth-child(6) { animation-delay: 0.6s; }

@keyframes fadeSlideIn {
  to {
    opacity: 1;
    transform: translateX(0);
  }
}

/* Link style */
.mobile-link {
  position: relative;
  color: #d1d5db; /* gray-300 */
  transition: all 0.3s ease;
}

.mobile-link:hover {
  color: #22c55e; /* green-500 */
}

.mobile-link::after {
  content: '';
  position: absolute;
  left: 0;
  bottom: -6px;
  width: 0;
  height: 2px;
  background-color: #22c55e;
  transition: width 0.3s ease;
}

.mobile-link:hover::after {
  width: 100%;
}

html, body {
  width: 100%;
  max-width: 100%;
  overflow-x: hidden !important; /* cegah scroll horizontal */
}

#mobile-menu {
  will-change: transform;
  overflow-x: hidden;
}

/* cegah pseudo-elemen body keluar layar */
body::before,
body::after {
  max-width: 100vw;
  overflow-x: hidden;
}

/* Navlink umum */
.nav-link {
  @apply relative group hover:text-green-400 transition duration-300;
}
.nav-link span {
  @apply absolute left-0 -bottom-1 w-0 h-0.5 bg-green-400 transition-all duration-300 group-hover:w-full;
}
/* Aktif */
.nav-link.active {
  @apply text-green-400 font-semibold;
}

/* Efek shrink saat scroll */
.navbar-shrink {
  background-color: rgba(17, 24, 39, 0.95); /* bg-gray-900/95 */
  padding-top: 0.5rem !important;
  padding-bottom: 0.5rem !important;
}
.navbar-shrink img {
  height: 2.5rem; /* lebih kecil dari h-14 */
}
.navbar-shrink span {
  font-size: 1rem; /* kecilkan tulisan */
}


  </style>
</head>
<body class="bg-gray-900 text-white">

<!-- Navbar -->
<header id="navbar" 
    class="fixed top-0 w-full bg-gray-900/60 backdrop-blur-md shadow-md z-50 transition-all duration-500">
  <div class="max-w-7xl mx-auto flex justify-between items-center px-6 py-4 transition-all duration-500">
    
    <!-- Logo -->
    <a href="{{ auth()->check() && auth()->user()->role == 'admin' ? url('/kasir') : url('/') }}" 
       class="flex items-center space-x-3 group">
      <img src="{{ asset('images/logo_fiks.png') }}" 
           alt="Cimahi Billiard Centre" 
           class="h-14 md:h-16 lg:h-20 w-auto object-contain transform group-hover:scale-105 transition duration-500 ease-in-out"
           id="navbar-logo">
      <span class="hidden lg:block text-xl font-bold text-green-400 tracking-wide group-hover:text-green-300 transition duration-300"
            id="navbar-title">
        Cimahi Billiard Centre
      </span>
    </a>

    <!-- Navigation (Desktop only ≥1024px) -->
    <nav class="hidden lg:flex space-x-8 text-gray-300 font-medium text-base xl:text-lg">
      @if(auth()->check() && auth()->user()->role == 'admin')
          {{-- Link untuk Admin --}}
          <a href="{{ route('admin.compros.edit') }}#about" class="nav-link relative group">
            Tentang
            <span class="absolute left-0 -bottom-1 h-0.5 w-0 bg-green-400 transition-all duration-300 group-hover:w-full"></span>
          </a>
          <a href="{{ route('admin.compros.edit') }}#services" class="nav-link relative group">
            Layanan
            <span class="absolute left-0 -bottom-1 h-0.5 w-0 bg-green-400 transition-all duration-300 group-hover:w-full"></span>
          </a>
          <a href="{{ route('admin.compros.edit') }}#harga" class="nav-link relative group">
            Harga
            <span class="absolute left-0 -bottom-1 h-0.5 w-0 bg-green-400 transition-all duration-300 group-hover:w-full"></span>
          </a>
          <a href="{{ route('admin.compros.edit') }}#contact" class="nav-link relative group">
            Kontak
            <span class="absolute left-0 -bottom-1 h-0.5 w-0 bg-green-400 transition-all duration-300 group-hover:w-full"></span>
          </a>
          <a href="{{ route('admin.compros.editevent') }}" class="nav-link relative group">
            Event
            <span class="absolute left-0 -bottom-1 h-0.5 w-0 bg-green-400 transition-all duration-300 group-hover:w-full"></span>
          </a>
          <a href="{{ route('admin.compros.editpelayanan') }}" class="nav-link relative group">
            Pelayanan
            <span class="absolute left-0 -bottom-1 h-0.5 w-0 bg-green-400 transition-all duration-300 group-hover:w-full"></span>
          </a>
      @else
          {{-- Link untuk User / Publik --}}
          <a href="{{ route('home') }}#about" class="nav-link relative group">
            Tentang
            <span class="absolute left-0 -bottom-1 h-0.5 w-0 bg-green-400 transition-all duration-300 group-hover:w-full"></span>
          </a>
          <a href="{{ route('home') }}#services" class="nav-link relative group">
            Layanan
            <span class="absolute left-0 -bottom-1 h-0.5 w-0 bg-green-400 transition-all duration-300 group-hover:w-full"></span>
          </a>
          <a href="{{ route('home') }}#harga" class="nav-link relative group">
            Harga
            <span class="absolute left-0 -bottom-1 h-0.5 w-0 bg-green-400 transition-all duration-300 group-hover:w-full"></span>
          </a>
          <a href="{{ route('home') }}#contact" class="nav-link relative group">
            Kontak
            <span class="absolute left-0 -bottom-1 h-0.5 w-0 bg-green-400 transition-all duration-300 group-hover:w-full"></span>
          </a>
          <a href="{{ route('compro.event') }}" class="nav-link relative group">
            Event
            <span class="absolute left-0 -bottom-1 h-0.5 w-0 bg-green-400 transition-all duration-300 group-hover:w-full"></span>
          </a>
          <a href="{{ route('compro.pelayanan') }}" class="nav-link relative group">
            Pelayanan
            <span class="absolute left-0 -bottom-1 h-0.5 w-0 bg-green-400 transition-all duration-300 group-hover:w-full"></span>
          </a>
      @endif
    </nav>

    <!-- Hamburger Menu (Tablet & Mobile <1024px) -->
    <div class="lg:hidden flex items-center">
      <button id="mobile-menu-button" class="text-gray-300 hover:text-green-400 focus:outline-none transition">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
      </button>
    </div>
  </div>
</header>


<!-- Mobile Sidebar Menu -->
<div id="mobile-menu" 
     class="fixed top-0 right-0 h-full w-32 bg-gray-900/90 backdrop-blur-lg shadow-lg
            flex flex-col py-8 px-6 space-y-6 text-base font-medium text-gray-200 
            z-50 transition-transform duration-400 transform translate-x-full rounded-l-2xl">

    <!-- Tombol Close -->
    <button onclick="toggleMobileMenu()" 
        class="absolute top-4 right-4 text-gray-400 hover:text-green-400 text-3xl transition-colors duration-300">
        &times;
    </button>

    <!-- Judul / Logo -->
    <div class="mb-4">
        <h2 class="text-xl font-bold text-green-400 tracking-wide">Menu</h2>
    </div>

    <!-- Link Menu -->
    <nav class="flex flex-col space-y-4">
        <a href="{{ route('home') }}#about" class="mobile-link hover:text-green-400 transition">Tentang</a>
        <a href="{{ route('home') }}#services" class="mobile-link hover:text-green-400 transition">Layanan</a>
        <a href="{{ route('home') }}#harga" class="mobile-link hover:text-green-400 transition">Harga</a>
        <a href="{{ route('home') }}#contact" class="mobile-link hover:text-green-400 transition">Kontak</a>
        @if(auth()->check() && auth()->user()->role == 'admin')
            <a href="{{ route('admin.compros.editevent') }}" class="mobile-link hover:text-green-400 transition">Event</a>
            <a href="{{ route('admin.compros.editpelayanan') }}" class="mobile-link hover:text-green-400 transition">Pelayanan</a>
        @else
            <a href="{{ route('compro.event') }}" class="mobile-link hover:text-green-400 transition">Event</a>
            <a href="{{ route('compro.pelayanan') }}" class="mobile-link hover:text-green-400 transition">Pelayanan</a>
        @endif
    </nav>
</div>

 {{-- Content Section --}}
    <main class="p-8">
        @yield('content')
    </main>

    
  <!-- Footer -->
  <footer class="bg-gray-900 py-6 text-center text-gray-500">
    <p>&copy; 2025 PT Billiard Jaya. All rights reserved.</p>
  </footer>

  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script>
    AOS.init({ duration: 1000, once: true });

    // Swiper autoplay
    const swiper = new Swiper('.swiper', {
      loop: true,
      autoplay: {
        delay: 3000,
        disableOnInteraction: false,
      },
      effect: 'slide',
    });
  </script>

  <script>
document.addEventListener('DOMContentLoaded', () => {
  const desktopNav = document.querySelector('header nav');
  const mobileBtn = document.getElementById('mobile-menu-button');
  const mobileMenu = document.getElementById('mobile-menu');

  // Toggle mobile menu (slide in/out)
  function toggleMobileMenu() {
    const mobileMenu = document.getElementById('mobile-menu');

    // cek apakah menu sedang terbuka
    const isOpen = mobileMenu.classList.contains('translate-x-0');

    if (isOpen) {
      mobileMenu.classList.add('translate-x-full');
      mobileMenu.classList.remove('translate-x-0', 'show');
    } else {
      mobileMenu.classList.remove('translate-x-full');
      mobileMenu.classList.add('translate-x-0', 'show');
    }
  }

  // biar bisa dipanggil dari inline onclick
  window.toggleMobileMenu = toggleMobileMenu;


  // Responsive view (desktop vs mobile)
  function handleResponsiveView() {
    if (window.innerWidth < 768) {
      desktopNav?.classList.add('hidden');
      mobileBtn?.classList.remove('hidden');
    } else {
      desktopNav?.classList.remove('hidden');
      mobileBtn?.classList.add('hidden');
      // pastikan menu offscreen ketika kembali ke desktop
      mobileMenu.classList.add('translate-x-full');
      mobileMenu.classList.remove('translate-x-0');
    }
  }

  // Initial check
  handleResponsiveView();

  // Re-check saat resize
  window.addEventListener('resize', handleResponsiveView);

  // Klik hamburger
  mobileBtn?.addEventListener('click', toggleMobileMenu);

  // Tutup menu ketika klik link
  document.querySelectorAll('#mobile-menu a').forEach(link => {
    link.addEventListener('click', () => {
      mobileMenu.classList.add('translate-x-full');
      mobileMenu.classList.remove('translate-x-0');
    });
  });
});

window.addEventListener("scroll", function() {
    const navbar = document.getElementById("navbar");
    if (window.scrollY > 50) {
      navbar.classList.remove("bg-gray-900/60");
      navbar.classList.add("bg-gray-900");
    } else {
      navbar.classList.remove("bg-gray-900");
      navbar.classList.add("bg-gray-900/60");
    }
  });

</script>


</body>
</html>
