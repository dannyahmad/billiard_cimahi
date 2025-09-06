@extends('compro.profile')

@section('content')
<style>
  body {
    background: linear-gradient(120deg, #0f172a, #1e293b, #0f172a);
    background-size: 300% 300%;
    animation: gradientBG 15s ease infinite;
  }
  @keyframes gradientBG {
    0% {background-position: 0% 50%;}
    50% {background-position: 100% 50%;}
    100% {background-position: 0% 50%;}
  }
  /* Animasi fade-up halus */
  @keyframes fadeUp {
      0% { opacity: 0; transform: translateY(20px); }
      100% { opacity: 1; transform: translateY(0); }
  }
  .animate-fade-up {
      animation: fadeUp 0.8s ease forwards;
  }
</style>
<div class="text-white font-sans">
  <!-- Hero Section -->
  <section class="relative bg-cover bg-center bg-no-repeat"
           style="background-image: url('/images/slider1.png'); margin-top:0; padding-top:6rem; padding-bottom:6rem;">
    <!-- Overlay -->
    <div class="absolute inset-0 bg-black bg-opacity-40"></div>

    <div class="relative text-center text-white px-4 sm:px-6 max-w-4xl mx-auto">
      <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-4 opacity-0 translate-y-8 animate-fade-up"
          style="font-family: 'Bungee', Arial, sans-serif; font-weight: 400;"
          data-aos="fade-up">
          Event Spesial Kami
      </h2>

      <p class="mt-4 sm:mt-6 text-lg sm:text-xl md:text-2xl font-sans font-bold text-gray-100 tracking-normal leading-relaxed drop-shadow-lg opacity-0 translate-x-[40px]
                animate-slideFromRight delay-200"
         data-aos="fade-up" data-aos-delay="200">
         Ikuti berbagai event seru dan turnamen billiard dengan hadiah menarik.
      </p>
    </div>
  </section>

  <!-- Event Cards -->
  <section id="event-list"
           class="mt-10 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
    @foreach($events as $event)
    <div data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}"
         class="bg-gray-900 rounded-2xl border border-gray-700 overflow-hidden flex flex-col transition transform hover:scale-[1.02] hover:shadow-xl group relative w-full">

      <!-- Gambar Event -->
      @if($event->gambar)
      <div class="w-full h-56 sm:h-60 overflow-hidden relative">
        <img src="{{ asset('storage/' . $event->gambar) }}"
             alt="Event"
             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
      </div>
      @endif

      <!-- Isi Card -->
      <div class="p-5 sm:p-6 flex flex-col flex-grow space-y-4">
        <!-- Judul -->
        <h3 class="text-xl sm:text-2xl font-bold text-green-400 line-clamp-2 transition-all duration-300 group-hover:drop-shadow-md">
          {{ $event->judul }}
        </h3>

        <!-- Deskripsi -->
        <p class="text-gray-100 text-sm sm:text-base font-semibold leading-relaxed text-justify line-clamp-3 group-hover:line-clamp-none transition-all duration-500 whitespace-pre-line">
          {{ $event->deskripsi }}
        </p>

        <!-- Info Meta -->
        <div class="flex flex-col gap-2 text-gray-300 text-sm">
          <div class="flex items-start gap-2">
            <i class="fas fa-calendar-days text-green-400 w-5"></i>
            <div>
              <p class="font-semibold">Tanggal</p>
              <p class="text-gray-200">
                {{ \Carbon\Carbon::parse($event->tanggal_mulai)->translatedFormat('d F Y') }}
                @if($event->tanggal_selesai)
                  - {{ \Carbon\Carbon::parse($event->tanggal_selesai)->translatedFormat('d F Y') }}
                @endif
              </p>
            </div>
          </div>
          <div class="flex items-start gap-2">
            <i class="fas fa-location-dot text-green-400 w-5"></i>
            <div>
              <p class="font-semibold">Tempat</p>
              <p class="text-gray-200">{{ $event->lokasi ?? '-' }}</p>
            </div>
          </div>
        </div>

        <!-- Tombol Aksi (tinggal Selengkapnya aja) -->
        <div class="mt-auto flex justify-end items-center gap-3 pt-3 border-t border-gray-700 opacity-0 group-hover:opacity-100 translate-y-2 group-hover:translate-y-0 transition-all duration-500">
          <button onclick="showDetail(
              '{{ addslashes($event->judul) }}',
              `{{ addslashes($event->deskripsi) }}`,
              '{{ asset('storage/' . $event->gambar) }}',
              '{{ $event->tanggal_mulai }}',
              '{{ $event->tanggal_selesai ?? '' }}',
              '{{ addslashes($event->lokasi ?? '') }}'
              )"
              class="px-4 py-2 bg-green-500 hover:bg-green-600 rounded-xl text-white text-sm font-semibold transition shadow-md hover:shadow-lg">
              Selengkapnya
          </button>
        </div>
      </div>
    </div>
    @endforeach
  </section>
</div>

  <!-- Detail Event -->
  <section id="event-detail" class="hidden max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
  <div class="bg-gray-900 rounded-2xl shadow-lg border border-gray-700 flex flex-col md:flex-row overflow-hidden">

    <!-- Gambar Event -->
    <div class="w-full md:w-1/2 bg-gray-800 flex items-center justify-center overflow-hidden rounded-l-2xl">
      <img id="detail-img" src="" alt="Event Detail"
           class="w-full h-48 sm:h-64 md:h-80 lg:h-full object-cover object-center 
                  transition-transform duration-500 ease-in-out hover:scale-105">
    </div>

    <!-- Informasi Event -->
    <div class="w-full md:w-1/2 p-6 sm:p-8 flex flex-col gap-6">
      <h3 id="detail-title"
          class="text-2xl sm:text-3xl font-bold text-green-400 border-b border-green-500 pb-2">
      </h3>

      <div class="bg-gray-800 border border-gray-700 rounded-lg p-4 shadow-sm">
        <div class="flex items-center gap-3 mb-2">
          <i class="fas fa-calendar-alt text-green-400 text-xl"></i>
          <p class="text-gray-400 text-sm uppercase tracking-wide font-semibold">Tanggal Event</p>
        </div>
        <p id="detail-date" class="text-white font-medium text-base"></p>
      </div>

      <div class="bg-gray-800 border border-gray-700 rounded-lg p-4 shadow-sm">
        <div class="flex items-center gap-3 mb-2">
          <i class="fas fa-location-dot text-green-400 text-xl"></i>
          <p class="text-gray-400 text-sm uppercase tracking-wide font-semibold">Lokasi</p>
        </div>
        <p id="detail-location" class="text-white font-medium text-base"></p>
      </div>

      <div class="bg-gray-800 border border-gray-700 rounded-lg p-4 shadow-sm">
        <div class="flex items-center gap-3 mb-2">
          <i class="fas fa-pen-nib text-green-400 text-xl"></i>
          <p class="text-gray-400 text-sm uppercase tracking-wide font-semibold">Deskripsi</p>
        </div>
        <div class="text-white text-base leading-relaxed max-h-48 overflow-y-auto scrollbar-thin scrollbar-thumb-gray-700 scrollbar-track-gray-900">
          <p id="detail-description" class="whitespace-pre-line"></p>
        </div>
      </div>

      <div>
        <button onclick="backToList()"
                class="px-6 py-2 bg-green-500 hover:bg-green-600 rounded-lg 
                       text-white font-semibold shadow-md transition">
          ← Kembali ke Daftar
        </button>
      </div>
    </div>
  </div>
</section>

<script>
  function openCreate() { document.getElementById('createModal').classList.remove('hidden'); }
  function closeCreate() { document.getElementById('createModal').classList.add('hidden'); }

  function openEdit(id, judul, deskripsi, mulai, selesai, lokasi) {
    const modal = document.getElementById('editModal');
    const form = document.getElementById('editForm');

    modal.classList.remove('hidden');
    form.action = '/events/' + id;

    document.getElementById('editJudul').value = judul;
    document.getElementById('editDeskripsi').value = deskripsi;
    document.getElementById('editMulai').value = mulai;
    document.getElementById('editSelesai').value = selesai ?? '';
    document.getElementById('editLokasi').value = lokasi ?? '';

    // Preview gambar kosong dulu
    const preview = document.getElementById('gambarPreview');
    preview.src = '';
    preview.classList.add('hidden');
}

  function closeEdit() { document.getElementById('editModal').classList.add('hidden'); }

  function openDelete(id) {
      document.getElementById('deleteModal').classList.remove('hidden');
      document.getElementById('deleteForm').action = '/events/' + id;
  }
  function closeDelete() { document.getElementById('deleteModal').classList.add('hidden'); }

  function showDetail(title, desc, img, tanggalMulai, tanggalSelesai, lokasi) {
    document.getElementById('event-list').classList.add('hidden');
    document.getElementById('event-detail').classList.remove('hidden');

    document.getElementById('detail-title').innerText = title;
    document.getElementById('detail-description').innerText = desc;
    document.getElementById('detail-img').src = img;
    
    function formatTanggal(tgl) {
            if (!tgl) return '-';
            const date = new Date(tgl);
            const options = { weekday: 'long', day: '2-digit', month: 'long', year: 'numeric' };
            return new Intl.DateTimeFormat('id-ID', options).format(date);
        }

        const formattedMulai = formatTanggal(tanggalMulai);
        const formattedSelesai = tanggalSelesai ? formatTanggal(tanggalSelesai) : null;

        document.getElementById('detail-date').innerText = formattedSelesai
            ? `${formattedMulai} - ${formattedSelesai}`
            : formattedMulai;    document.getElementById('detail-location').innerText = lokasi ?? '-';
      }

  function backToList() {
    document.getElementById('event-detail').classList.add('hidden');
    document.getElementById('event-list').classList.remove('hidden');
  }
  document.getElementById('gambarInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const preview = document.getElementById('gambarPreview');
    if(file) {
        const reader = new FileReader();
        reader.onload = function(event) {
            preview.src = event.target.result;
            preview.classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    }
});
</script>
@endsection