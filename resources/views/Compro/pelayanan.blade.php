@extends('compro.profile')

@section('content')
<div class="container mx-auto mt-12 px-4">

   <!-- Section Daftar Pelayanan -->
   <section class="relative py-12 sm:py-16 px-6 bg-cover bg-center bg-no-repeat rounded-3xl overflow-hidden shadow-lg"
       style="background-image: url('{{ asset('images/kantin2.jpeg') }}');">
       
       <!-- Overlay gelap -->
       <div class="absolute inset-0 bg-black/60"></div>
       
       <div class="relative z-10 max-w-4xl mx-auto text-center">
           
           <!-- Icon -->
           <div class="flex justify-center items-center mb-6 space-x-6 text-green-400 text-4xl sm:text-5xl">
               <i class="fas fa-utensils drop-shadow-lg"></i>
               <i class="fas fa-hamburger drop-shadow-lg"></i>
               <i class="fas fa-coffee drop-shadow-lg"></i>
           </div>

           <!-- Decorative Line -->
           <div class="h-1 w-20 sm:w-28 bg-green-400 mx-auto mb-6 rounded-full shadow-lg"></div>

           <!-- Judul -->
           <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-green-400 mb-8 sm:mb-10 tracking-wide drop-shadow-lg">
               Daftar Pelayanan
           </h2>
       </div>
   </section>


   {{-- Notifikasi --}}
   @if(session('success'))
       <div class="bg-green-500 text-gray-900 px-5 py-2 rounded-lg my-6 text-center shadow-md font-medium animate-fadeIn">
           {{ session('success') }}
       </div>
   @endif


   <!-- List per Kategori -->
   @foreach(['Makanan' => $makanan, 'Minuman' => $minuman, 'Rokok' => $rokok] as $kategori => $items)
   @php
       $gradient = match($kategori) {
           'Makanan' => 'from-green-400 to-green-600',
           'Minuman' => 'from-yellow-400 to-yellow-600',
           'Rokok'   => 'from-gray-500 to-gray-700',
       };
   @endphp

   <section class="category-section rounded-3xl p-6 sm:p-8 mb-10 sm:mb-12 shadow-xl transition-all duration-500 transform hover:-translate-y-2 animate-section bg-gray-900">

       <!-- Icon kategori -->
       <div class="flex justify-center items-center mb-6 space-x-6 text-4xl sm:text-5xl md:text-6xl">
           @if($kategori == 'Makanan')
               <i class="fas fa-utensils category-icon bg-clip-text text-transparent bg-gradient-to-r {{ $gradient }} animate-gradient-hover"></i>
           @elseif($kategori == 'Minuman')
               <i class="fas fa-coffee category-icon bg-clip-text text-transparent bg-gradient-to-r {{ $gradient }} animate-gradient-hover"></i>
           @elseif($kategori == 'Rokok')
               <i class="fas fa-smoking category-icon bg-clip-text text-transparent bg-gradient-to-r {{ $gradient }} animate-gradient-hover"></i>
           @endif
       </div>

       <!-- Judul kategori -->
       <h4 class="text-2xl sm:text-3xl md:text-4xl font-extrabold mb-6 sm:mb-8 text-green-400 border-b border-gray-700 pb-2 sm:pb-3 tracking-wide text-center">
           {{ $kategori }}
       </h4>

       <!-- Grid Items -->
       <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 sm:gap-8">
           @foreach($items as $p)
           <div class="flex flex-col items-center text-center bg-gray-800 rounded-2xl sm:rounded-3xl p-5 sm:p-6 shadow-md hover:shadow-2xl transition-all duration-500 ease-out transform 
           hover:-translate-y-3 hover:scale-105 hover:bg-gray-750">
               @if($p->gambar)
                   <img src="{{ asset('storage/'.$p->gambar) }}" alt="{{ $p->nama }}" 
                        class="h-24 w-24 sm:h-28 sm:w-28 md:h-32 md:w-32 rounded-full object-cover mb-4 border-2 border-green-400 shadow-lg transition-transform duration-500 hover:scale-110">
               @else
                   <div class="h-24 w-24 sm:h-28 sm:w-28 md:h-32 md:w-32 rounded-full bg-gray-700 flex items-center justify-center mb-4 shadow-lg border-2 border-gray-600">
                       <span class="text-gray-400 text-xs sm:text-sm">No Image</span>
                   </div>
               @endif

               <h5 class="text-base sm:text-lg md:text-xl font-semibold text-green-400 truncate">{{ $p->nama }}</h5>
               <p class="text-gray-300 text-sm sm:text-base mt-2">Rp {{ number_format($p->harga,0,',','.') }}</p>
           </div>
           @endforeach
       </div>
   </section>
   @endforeach
</div>

<script>
function openModal(id) {
    document.getElementById(id).classList.remove('hidden');
}
function closeModal(id) {
    document.getElementById(id).classList.add('hidden');
}
document.querySelectorAll('.animate-item').forEach((card, index) => {
    card.style.animationDelay = `${index * 100}ms`;
});

document.addEventListener("DOMContentLoaded", function () {
    // Loop semua input hargaDisplay-*
    document.querySelectorAll("[id^=hargaDisplay]").forEach(input => {
        input.addEventListener("input", function () {
            // Cari pasangan hidden input hargaReal
            let id = this.id.replace("hargaDisplay", ""); 
            let realInput = document.getElementById("hargaReal" + id);

            // Ambil hanya angka
            let value = this.value.replace(/\D/g, "");
            if (!value) {
                this.value = "";
                realInput.value = "";
                return;
            }

            // Simpan angka mentah ke hidden input
            realInput.value = value;

            // Format tampilan pakai ribuan
            this.value = new Intl.NumberFormat("id-ID").format(value);
        });
    });
});

</script>

<style>
@keyframes fadeIn {
    from {opacity: 0; transform: translateY(-20px);}
    to {opacity: 1; transform: translateY(0);}
}
@keyframes fadeSlideUp {
    0% {opacity: 0; transform: translateY(20px);}
    100% {opacity: 1; transform: translateY(0);}
}
/* Animasi masuk section */
@keyframes fadeSlideUpSection {
    0% {opacity: 0; transform: translateY(20px);}
    100% {opacity: 1; transform: translateY(0);}
}

/* Hover gradient animasi icon kategori */
@keyframes gradientShift {
    0% {background-position: 0%;}
    50% {background-position: 100%;}
    100% {background-position: 0%;}
}
.animate-gradient-hover {
    background-size: 200% 200%;
    animation: gradientShift 3s ease infinite;
}

.animate-section {
    animation: fadeSlideUpSection 0.5s ease forwards;
}

/* Animasi masuk item */
@keyframes fadeSlideUpItem {
    0% {opacity: 0; transform: translateY(10px);}
    100% {opacity: 1; transform: translateY(0);}
}

@keyframes fadeUp {
    to {opacity:1; transform: translateY(0);}
}

.animate-item {
    opacity: 0;
    transform: translateY(20px);
    animation: fadeUp 0.6s forwards;
}

/* Shadow section subtle */
.category-section {
    background-color: #111827;
    border-radius: 1rem;
    transition: all 0.5s ease;
    box-shadow: 0 4px 10px rgba(0,0,0,0.15);
}
.category-section:hover {
    box-shadow: 0 15px 25px rgba(0, 128, 0, 0.15), 0 5px 15px rgba(0, 255, 128, 0.05);
}

/* Gradient hover ikon per kategori */
.category-icon {
    transition: all 0.4s ease;
}
.category-icon:hover {
    background: linear-gradient(135deg, #38b000, #00ffb8);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    transform: translateY(-4px) scale(1.2);
}

</style>
@endsection
