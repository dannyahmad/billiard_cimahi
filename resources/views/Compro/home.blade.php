@extends('compro.profile')

@section('content')
<main class="flex flex-col items-center justify-center w-full">
   <!-- Hero Slider Ultra Smooth -->
    <section class="relative h-[80vh] w-full overflow-hidden bg-gray-900 flex items-center justify-center mt-20">
        @if(!empty($sliders) && $sliders->count() > 0)
            <div class="swiper h-full w-full">
                <div class="swiper-wrapper">
                    @foreach($sliders as $slider)
                        <div class="swiper-slide relative overflow-hidden group">
                            <!-- Gambar -->
                            <img src="{{ asset('storage/' . $slider->image) }}" 
                                class="w-full h-[80vh] object-cover transform transition duration-[3000ms] scale-105 group-hover:scale-110">

                            <!-- Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/40 to-black/20 flex flex-col items-center justify-center text-center px-6">
                                <!-- Judul -->
                                <h2 class="text-4xl md:text-6xl font-extrabold text-green-400 drop-shadow-lg opacity-0 translate-y-8 animate-fadeUp delay-200">
                                    {{ $slider->title }}
                                </h2>

                                <!-- Sub Judul -->
                                <p class="mt-6 text-lg md:text-2xl font-medium text-gray-100 tracking-wide leading-relaxed drop-shadow-lg opacity-0 translate-y-10 animate-fadeUp delay-500">
                                    {{ $slider->subtitle }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="swiper-pagination absolute bottom-8 left-0 w-full flex justify-center z-20"></div>
            </div>
        @else
            <!-- Placeholder -->
            <div class="w-full h-full flex flex-col items-center justify-center bg-gray-800 text-gray-400 text-center px-6 relative">
                <p class="text-2xl md:text-4xl font-bold mb-2">Belum ada slider</p>
                <p class="text-lg md:text-xl mb-6">Silakan masukkan slider di admin panel.</p>
            </div>
        @endif
    </section>

    <!-- Tentang Kami -->
    <section id="about" class="py-28 bg-gradient-to-br from-gray-900 via-black to-gray-950 relative overflow-hidden">
    <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-14 items-center px-6">
        
        <!-- Gambar -->
        <div class="relative group overflow-hidden rounded-3xl shadow-2xl" data-aos="fade-right">
        <div class="relative w-full h-96 bg-gray-800 flex items-center justify-center overflow-hidden">
            @if(!empty($data['gambar']))
            <img src="{{ asset($data['gambar']) }}"
                alt="Tentang Kami"
                class="w-full h-96 object-cover transition-transform duration-[1200ms] group-hover:scale-105">
            <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-black/20 to-transparent"></div>
            <div class="absolute inset-0 pointer-events-none shine-overlay transition-opacity duration-700 opacity-0 group-hover:opacity-100"></div>
            @else
            <p class="text-gray-400 text-center text-base md:text-lg">Belum ada gambar tentang kami</p>
            @endif
        </div>
        </div>

        <!-- Konten -->
        <div data-aos="fade-left">
        <div class="relative bg-gray-900/60 backdrop-blur-xl p-10 md:p-14 rounded-3xl shadow-xl border border-gray-700/30 overflow-hidden group transition-all duration-700 hover:border-green-400/50 hover:shadow-[0_0_25px_rgba(34,197,94,0.4)] hover:pulse-glow">
            
            <!-- Header -->
            <h2 class="relative text-3xl md:text-4xl font-extrabold text-green-400 tracking-tight drop-shadow-lg mb-6 overflow-hidden">
            <span class="relative inline-block shine-effect group-hover:text-shadow-glow transition duration-500">
                Tentang Kami
            </span>
            </h2>

            <!-- Deskripsi -->
            @if(!empty($data['deskripsi']))
            <p class="text-gray-300 leading-relaxed text-base md:text-lg tracking-wide mb-6 text-justify">
                {{ $data['deskripsi'] }}
            </p>
            @else
            <p class="text-gray-400 italic mb-6 text-base md:text-lg text-center">
                Belum ada deskripsi tentang perusahaan
            </p>
            @endif
        </div>
        </div>
    </div>
    </section>


    <!-- Layanan -->
    <section id="services" class="py-28 bg-gray-900 relative">
    <div class="max-w-7xl mx-auto text-center px-6">
        <h2 class="text-4xl md:text-5xl font-extrabold text-green-400 mb-16 tracking-tight" data-aos="fade-up">
        Layanan Kami
        </h2>

        <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
        @if(!empty($layanan) && $layanan->count() > 0)
            @foreach($layanan as $item)
            <div class="relative group bg-gray-800/70 backdrop-blur-lg rounded-3xl shadow-xl overflow-hidden transform transition-all duration-500 hover:-translate-y-3 hover:scale-[1.03] hover:shadow-green-500/40"
                data-aos="zoom-in" data-aos-delay="{{ $loop->index * 150 }}">
            
            <!-- Gambar -->
            <div class="overflow-hidden relative">
                <img src="{{ $item->image ? asset('storage/'.$item->image) : 'https://via.placeholder.com/400x300?text=No+Image' }}" 
                alt="{{ $item->name ?? 'Layanan' }}" 
                class="w-full h-52 object-cover transition-transform duration-700 group-hover:scale-110">
                
                <!-- Overlay -->
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent opacity-0 group-hover:opacity-100 transition duration-500 flex items-center justify-center">
                </div>
            </div>

            <!-- Konten -->
            <div class="p-8 text-center">
                <!-- Ikon -->
                <div class="flex justify-center mb-4">
                <i class="fa-solid fa-bullseye text-green-400 text-3xl group-hover:scale-110 transition-transform duration-300"></i>
                </div>
                
                <h3 class="text-2xl font-bold mb-3 text-green-400 group-hover:text-green-300 transition">
                {{ $item->name ?? '-' }}
                </h3>
                <p class="text-gray-300 leading-relaxed text-base md:text-lg">
                {{ $item->description ?? '-' }}
                </p>
            </div>
            </div>
            @endforeach
        @else
            @for($i = 0; $i < 3; $i++)
            <div class="bg-gray-800/50 p-8 rounded-3xl shadow-md h-72 flex items-center justify-center">
            <p class="text-gray-400 text-center">Belum ada layanan tersedia</p>
            </div>
            @endfor
        @endif
        </div>
    </div>
    </section>



    <!-- Harga -->
    <section id="harga" class="py-28 bg-gray-900 relative">
        <div class="max-w-7xl mx-auto text-center px-6 md:px-12">
            <h2 class="text-4xl md:text-5xl font-extrabold text-green-400 mb-16 tracking-tight" data-aos="fade-up">
                Harga
            </h2>

            <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @if(!empty($prices) && $prices->count() > 0)
                    @foreach($prices as $item)
                    <div class="relative group
                        {{ $loop->iteration == 2 ? 'scale-105 border-2 border-green-400 shadow-green-500/50 shadow-2xl' : 'border border-gray-700' }}
                        bg-gray-800/80 backdrop-blur-lg p-8 rounded-3xl shadow-xl transform transition duration-500 hover:-translate-y-3 hover:scale-[1.04]"
                        data-aos="zoom-in" data-aos-delay="{{ $loop->index * 150 }}">
                        
                        <!-- Badge untuk highlight -->
                        @if($loop->iteration == 2)
                            <span class="absolute -top-4 left-1/2 -translate-x-1/2 bg-green-500 text-gray-900 text-sm font-bold px-4 py-1 rounded-full shadow-lg">
                                ⭐ Paling Favorit
                            </span>
                        @endif

                        <div class="overflow-hidden rounded-xl mb-5 md:mb-6">
                            <img src="{{ $item->image ? asset('storage/'.$item->image) : 'https://via.placeholder.com/500x350?text=No+Image' }}" 
                                alt="{{ $item->title ?? 'Harga' }}" 
                                class="w-full h-44 sm:h-52 md:h-56 lg:h-60 object-cover transition-transform duration-700 hover:scale-110">
                        </div>

                        <!-- Judul & Subtitle -->
                        <h3 class="text-2xl md:text-3xl font-bold text-green-400 mb-3">{{ $item->title ?? '-' }}</h3>
                        <p class="text-gray-300 leading-relaxed text-base md:text-lg">{{ $item->subtitle ?? '-' }}</p>
                    </div>
                    @endforeach
                @else
                    @for($i = 0; $i < 3; $i++)
                    <div class="bg-gray-800/50 p-8 rounded-3xl shadow-md h-72 flex items-center justify-center">
                        <p class="text-gray-400 text-center text-lg">Belum ada data harga tersedia</p>
                    </div>
                    @endfor
                @endif
            </div>
        </div>
    </section>


    <!-- Gallery -->
    <section id="gallery" class="py-24 bg-gray-900">
        <div class="max-w-7xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <h2 class="text-4xl md:text-3xl font-extrabold text-green-400 mb-14" data-aos="fade-up">
                Galeri
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                @if(!empty($galleries) && $galleries->count() > 0)
                    @foreach($galleries as $item)
                        <div class="relative overflow-hidden rounded-2xl shadow-lg bg-gray-800 transform transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl group opacity-0 translate-y-6"
                            data-aos="zoom-in"
                            data-aos-delay="{{ $loop->index * 100 }}">
                            <!-- Gambar -->
                            <div class="aspect-[16/9] overflow-hidden rounded-t-2xl relative cursor-pointer"
                                onclick="openGalleryModal({{ $loop->index }})">
                                <img src="{{ $item->image ? asset('storage/'.$item->image) : 'https://via.placeholder.com/400x225?text=No+Image' }}"
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                    alt="Gallery Image">
                                <!-- Caption overlay -->
                                @if(!empty($item->caption))
                                    <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-black/70 via-black/40 to-transparent text-white p-3 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                        <p class="text-sm md:text-base truncate" title="{{ $item->caption }}">{{ $item->caption }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @else
                    @for($i = 0; $i < 6; $i++)
                        <div class="flex items-center justify-center bg-gray-800/50 rounded-2xl shadow-md h-48 opacity-50 transform transition-all duration-500">
                            <p class="text-gray-400 text-center text-sm sm:text-base">Belum ada gambar</p>
                        </div>
                    @endfor
                @endif
            </div>
        </div>
    </section>

    <!-- Kontak -->
    <section id="contact" class="py-20 bg-gray-900 text-center w-full">
    <h2 class="text-3xl md:text-4xl font-extrabold text-green-400 mb-12 tracking-wide" data-aos="fade-down">
        Kontak Kami
    </h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 md:gap-8 px-6 max-w-6xl mx-auto">
        @php
            $kontakList = [
                ['icon'=>'fa-map-location-dot','title'=>'Alamat','value'=>$contact->address ?? 'Belum ada alamat tersedia'],
                ['icon'=>'fa-envelope','title'=>'Email','value'=>$contact->email ?? 'Belum ada email tersedia'],
                ['icon'=>'fa-phone','title'=>'Telepon','value'=>$contact->phone ?? 'Belum ada telepon tersedia']
            ];
        @endphp

        @foreach($kontakList as $kontak)
        <div class="bg-gray-800/90 p-8 rounded-2xl shadow-lg 
                    flex flex-col items-center text-center 
                    hover:scale-[1.03] hover:bg-gray-800 transition-all duration-500 
                    hover:shadow-xl hover:shadow-green-400/20 cursor-default
                    opacity-0 translate-y-6"
            data-aos="fade-up" data-aos-delay="{{ $loop->index*150 }}">
        
        <!-- Icon -->
        <div class="flex items-center justify-center w-14 h-14 rounded-full bg-gray-700 mb-4">
            <i class="fa-solid {{ $kontak['icon'] }} text-green-400 text-2xl"></i>
        </div>
        
        <!-- Info -->
        <h3 class="text-lg md:text-xl font-semibold text-green-400 mb-2">
            {{ $kontak['title'] }}
        </h3>
        <p class="text-sm md:text-base text-gray-300 leading-relaxed break-words">
            {{ $kontak['value'] }}
        </p>
        </div>
        @endforeach
    </div>
    </section>


      <div class="mt-16 rounded-3xl overflow-hidden shadow-lg w-full px-6" data-aos="fade-up" data-aos-delay="400">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.123456789!2d107.5463!3d-6.8765!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e8f8c1c3d0f3%3A0xabcdef1234567890!2sPasar%20Antri%20Baru%2C%20Jl.%20Sriwijaya%20II%20No.008%2C%20Setiamanah%2C%20Cimahi%20Tengah%2C%20Cimahi%2C%20West%20Java%2040522!5e0!3m2!1sid!2sid!4v1692960000000!5m2!1sid!2sid"
              class="w-full h-96 border-0 rounded-3xl" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
          </iframe>
      </div>
    </section>

</main>

<style>
/* Animasi fade up */
@keyframes fadeUp {0% {opacity:0; transform:translateY(20px);} 100% {opacity:1; transform:translateY(0);} }
.animate-fadeUp {animation: fadeUp 0.8s ease forwards;}

/* Smooth fade & slide for slider text */
/* Teks slide dari kiri */
/* Animasi teks masuk */
@keyframes slideFromLeft { 0% {opacity:0; transform:translateX(-50px);} 100% {opacity:1; transform:translateX(0);} }
@keyframes slideFromRight { 0% {opacity:0; transform:translateX(50px);} 100% {opacity:1; transform:translateX(0);} }
@keyframes slideFadeUp { 0% {opacity:0; transform:translateY(20px);} 100% {opacity:1; transform:translateY(0);} }
@keyframes gradientShift {
  0% { transform: translate(0, 0); }
  50% { transform: translate(10px, -10px); }
  100% { transform: translate(0, 0); }
}
/* Shine teks */
  .shine-effect::before {
    content: "";
    position: absolute;
    top: 0;
    left: -75%;
    height: 100%;
    width: 50%;
    background: linear-gradient(120deg, transparent, rgba(255,255,255,0.35), transparent);
    animation: shine 3s infinite;
    opacity: 0;
  }

  /* Shine overlay gambar */
  .shine-overlay::before {
    content: "";
    position: absolute;
    top: 0;
    left: -100%;
    width: 50%;
    height: 100%;
    background: linear-gradient(120deg, transparent, rgba(255,255,255,0.25), transparent);
    animation: shineOverlay 3s infinite;
    opacity: 0;
  }

  .shine-effect::before,
  .shine-overlay::before {
    animation-play-state: paused;
  }

  .group:hover .shine-effect::before,
  .group:hover .shine-overlay::before {
    animation-play-state: running;
    opacity: 1;
    transition: opacity 0.7s ease-in-out;
  }

  /* Glow teks */
  .text-shadow-glow {
    text-shadow: 0 0 10px rgba(34, 197, 94, 0.7),
                 0 0 20px rgba(34, 197, 94, 0.5),
                 0 0 30px rgba(34, 197, 94, 0.3);
  }

  /* Pulsing glow box */
  .pulse-glow {
    animation: pulseGlow 3s infinite ease-in-out;
  }

  @keyframes pulseGlow {
    0%, 100% {
      box-shadow: 0 0 15px rgba(34,197,94,0.3),
                  0 0 30px rgba(34,197,94,0.2);
    }
    50% {
      box-shadow: 0 0 25px rgba(34,197,94,0.5),
                  0 0 40px rgba(34,197,94,0.3);
    }
  }

  @keyframes shine {
    0% { left: -75%; }
    100% { left: 125%; }
  }

  @keyframes shineOverlay {
    0% { left: -100%; }
    100% { left: 100%; }
  }

.animate-gradient {
  animation: gradientShift 10s ease-in-out infinite;
}

.animate-slideFromLeft { animation: slideFromLeft 1s ease forwards; }
.animate-slideFromRight { animation: slideFromRight 1s ease forwards; }
.animate-slideFadeUp { animation: slideFadeUp 1s ease forwards; }
.animate-slideFadeUp.delay-200 { animation-delay: 0.2s; }
.animate-slideFadeUp.delay-400 { animation-delay: 0.4s; }

/* Hover scale gambar */
.swiper-slide img { transition: transform 1s ease; }
.swiper-slide:hover img { transform: scale(1.1); }

/* Pagination bullets */
.swiper-pagination-bullet {
  width: 12px;
  height: 12px;
  background-color: rgba(34,197,94,0.5);
  opacity:1;
}
.swiper-pagination-bullet-active {
  background-color: #22c55e;
  box-shadow: 0 0 8px #22c55e;
}

/* Responsif untuk mobile & tablet */
@media (max-width: 768px) {
  .swiper-slide img { height: 60vh; }
  .animate-slideFromLeft, .animate-slideFromRight { transform: translateX(0); }
  h2 { font-size: 2.5rem; }
  p { font-size: 1rem; }
}
/* Overlay dan efek blur */
.slider-overlay {
  backdrop-filter: blur(3px);
}

    /* Pagination Custom */
    .swiper-pagination-bullet {
        width: 14px;
        height: 14px;
        background: rgba(255,255,255,0.4);
        border: 2px solid #22c55e; /* hijau */
        opacity: 0.8;
        transition: all 0.4s ease;
        margin: 0 6px !important;
    }
    .swiper-pagination-bullet-active {
        background: #22c55e;
        box-shadow: 0 0 12px #22c55e, 0 0 20px #22c55e;
        transform: scale(1.2);
    }

/* Shadow & hover premium */
.service-card, .gallery-card {
    box-shadow: 0 12px 30px rgba(0,0,0,0.2), 0 0 30px rgba(72,187,120,0.2);
    transition: transform 0.3s ease, box-shadow 0.5s ease;
}
.service-card:hover, .gallery-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.3), 0 0 40px rgba(72,187,120,0.3);
}

/* Parallax images */
.parallax-img {
    transition: transform 0.3s ease-out;
}
.parallax-card:hover .parallax-img {
    transform: scale(1.05);
}

/* Dynamic shadow gradient on scroll */
</style>

<script>
// ===== Animate cards on scroll =====
const observer = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if(entry.isIntersecting){
      const cards = entry.target.querySelectorAll('.service-card, .gallery-card');
      cards.forEach((card, index) => {
        setTimeout(() => {
          card.classList.remove('opacity-0','translate-y-6','translate-y-8');
          card.classList.add('animate-fadeUp');
        }, index * 100);
      });
      observer.unobserve(entry.target);
    }
  });
}, {threshold:0.1});

document.querySelectorAll('#services, #gallery').forEach(section => observer.observe(section));

// ===== Dynamic shadow gradient on scroll =====
window.addEventListener('scroll', () => {
  const scrollPos = window.scrollY;
  const greenShift = Math.min(187 + scrollPos * 0.05, 255);
  const cards = document.querySelectorAll('.service-card, .gallery-card');
  cards.forEach(card => {
      card.style.boxShadow = `0 12px 30px rgba(0,0,0,0.2), 0 0 30px rgba(72, ${greenShift}, 120, 0.3)`;
  });
});

// ===== Initialize AOS =====
if (typeof AOS !== 'undefined') {
  AOS.init({
    duration: 800,
    once: true,
  });
}

  
</script>


@endsection
