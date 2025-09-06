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

      <a href="javascript:void(0)" onclick="openCreate()"
         class="mt-6 inline-block px-6 sm:px-8 py-3 bg-gradient-to-r from-green-500 via-green-600 to-green-500 
                text-white font-semibold rounded-xl shadow-lg transition-all duration-500 transform 
                hover:scale-105 hover:shadow-2xl hover:from-green-600 hover:via-green-700 hover:to-green-600">
          + Tambah Event
      </a>
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

        <!-- Tombol Aksi -->
        <div class="mt-auto flex justify-end items-center gap-3 pt-3 border-t border-gray-700 opacity-0 group-hover:opacity-100 translate-y-2 group-hover:translate-y-0 transition-all duration-500">
          <button onclick="openEdit({{ $event->id }},
              '{{ addslashes($event->judul) }}',
              `{{ addslashes($event->deskripsi) }}`,
              '{{ $event->tanggal_mulai }}',
              '{{ $event->tanggal_selesai }}',
              '{{ addslashes($event->lokasi ?? '') }}'
              )"
              class="text-yellow-300 hover:text-yellow-100 text-sm font-medium transition">
              <i class="fas fa-edit"></i>
          </button>

          <button onclick="openDelete({{ $event->id }})"
                  class="text-red-400 hover:text-red-200 text-sm font-medium transition">
            <i class="fas fa-trash"></i>
          </button>

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

    <!-- Gambar Event (Landscape, Responsif, Elegan) -->
    <div class="w-full md:w-1/2 bg-gray-800 flex items-center justify-center overflow-hidden rounded-l-2xl">
      <img id="detail-img" src="" alt="Event Detail"
           class="w-full h-48 sm:h-64 md:h-80 lg:h-full object-cover object-center 
                  transition-transform duration-500 ease-in-out hover:scale-105">
    </div>

    <!-- Informasi Event -->
    <div class="w-full md:w-1/2 p-6 sm:p-8 flex flex-col gap-6">

      <!-- Judul -->
      <h3 id="detail-title"
          class="text-2xl sm:text-3xl font-bold text-green-400 border-b border-green-500 pb-2">
      </h3>

      <!-- Tanggal -->
      <div class="bg-gray-800 border border-gray-700 rounded-lg p-4 shadow-sm">
        <div class="flex items-center gap-3 mb-2">
          <i class="fas fa-calendar-alt text-green-400 text-xl"></i>
          <p class="text-gray-400 text-sm uppercase tracking-wide font-semibold">Tanggal Event</p>
        </div>
        <p id="detail-date" class="text-white font-medium text-base"></p>
      </div>

      <!-- Lokasi -->
      <div class="bg-gray-800 border border-gray-700 rounded-lg p-4 shadow-sm">
        <div class="flex items-center gap-3 mb-2">
          <i class="fas fa-location-dot text-green-400 text-xl"></i>
          <p class="text-gray-400 text-sm uppercase tracking-wide font-semibold">Lokasi</p>
        </div>
        <p id="detail-location" class="text-white font-medium text-base"></p>
      </div>

      <!-- Deskripsi -->
      <div class="bg-gray-800 border border-gray-700 rounded-lg p-4 shadow-sm">
        <div class="flex items-center gap-3 mb-2">
          <i class="fas fa-pen-nib text-green-400 text-xl"></i>
          <p class="text-gray-400 text-sm uppercase tracking-wide font-semibold">Deskripsi</p>
        </div>
        <div class="text-white text-base leading-relaxed max-h-48 overflow-y-auto scrollbar-thin scrollbar-thumb-gray-700 scrollbar-track-gray-900">
          <p id="detail-description" class="whitespace-pre-line"></p>
        </div>
      </div>

      <!-- Tombol Kembali -->
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

<!-- Modal Create -->
<div id="createModal" class="fixed inset-0 bg-black/50 flex items-center justify-center hidden z-50">
  <div class="bg-gray-800 p-6 rounded-2xl w-full max-w-2xl relative shadow-xl max-h-screen overflow-y-auto">
    
    <!-- Tombol close -->
    <button onclick="closeCreate()" 
            class="absolute top-3 right-3 text-gray-400 hover:text-white text-2xl font-bold">
      &times;
    </button>

    <!-- Judul Modal -->
    <h3 class="text-2xl font-bold text-green-400 mb-6 border-b border-gray-700 pb-2">Tambah Event</h3>

    <!-- Form Create Event -->
    <form id="createForm" method="POST" action="{{ route('events.storeEvent') }}" enctype="multipart/form-data" class="space-y-4">
      @csrf

      <!-- Judul Event -->
      <div>
        <label class="block text-gray-300 mb-1 font-medium">Judul Event</label>
        <input type="text" name="judul" placeholder="Masukkan judul event" 
               class="w-full p-2 rounded-lg bg-gray-700 text-white border border-gray-600 focus:border-green-400 focus:ring focus:ring-green-300/30 outline-none" required>
      </div>

      <!-- Deskripsi -->
      <div>
        <label class="block text-gray-300 mb-1 font-medium">Deskripsi Event</label>
        <textarea name="deskripsi" rows="4" placeholder="Tulis deskripsi lengkap tentang event..." 
                  class="w-full p-2 rounded-lg bg-gray-700 text-white border border-gray-600 focus:border-green-400 focus:ring focus:ring-green-300/30 outline-none" required></textarea>
      </div>

      <!-- Tanggal mulai & selesai -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label class="block text-gray-300 mb-1 font-medium">Tanggal Mulai</label>
          <input type="date" name="tanggal_mulai"
                 class="w-full p-2 rounded-lg bg-gray-700 text-white border border-gray-600 focus:border-green-400 focus:ring focus:ring-green-300/30 outline-none" required>
        </div>
        <div>
          <label class="block text-gray-300 mb-1 font-medium">Tanggal Selesai</label>
          <input type="date" name="tanggal_selesai" 
                 class="w-full p-2 rounded-lg bg-gray-700 text-white border border-gray-600 focus:border-green-400 focus:ring focus:ring-green-300/30 outline-none">
        </div>
      </div>

      <!-- Lokasi -->
      <div>
        <label class="block text-gray-300 mb-1 font-medium">Lokasi Event</label>
        <input type="text" name="lokasi" placeholder="Contoh: Jakarta Convention Center" 
               class="w-full p-2 rounded-lg bg-gray-700 text-white border border-gray-600 focus:border-green-400 focus:ring focus:ring-green-300/30 outline-none">
      </div>

      <!-- Gambar -->
      <div>
        <label class="block text-gray-300 mb-1 font-medium">Upload Poster / Gambar Event</label>
        <input type="file" name="gambar" 
               class="w-full p-2 rounded-lg bg-gray-700 text-white border border-gray-600 focus:border-green-400 focus:ring focus:ring-green-300/30 outline-none file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-green-500 file:text-white hover:file:bg-green-600">
      </div>

      <!-- Tombol Submit -->
      <div class="pt-4 sticky bottom-0 bg-gray-800 pb-2">
        <button type="submit" 
                class="w-full bg-green-500 hover:bg-green-600 px-4 py-3 rounded-lg text-white font-semibold transition duration-300 shadow-md">
           Tambah Event
        </button>
      </div>
    </form>
  </div>
</div>



<div id="editModal" class="fixed inset-0 bg-black/50 flex items-center justify-center hidden z-50">
  <div class="bg-gray-800 p-6 rounded-2xl w-full max-w-2xl relative shadow-xl max-h-screen overflow-y-auto">
    
    <!-- Tombol close -->
    <button onclick="closeEdit()" 
            class="absolute top-3 right-3 text-gray-400 hover:text-white text-2xl font-bold">
      &times;
    </button>

    <!-- Judul Modal -->
    <h3 class="text-2xl font-bold text-yellow-400 mb-6 border-b border-gray-700 pb-2">Edit Event</h3>

    <!-- Form Edit Event -->
    <form id="editForm" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

        <!-- Judul Event -->
        <div>
            <label class="block text-gray-300 mb-1 font-medium">Judul Event</label>
            <input type="text" id="editJudul" name="judul" placeholder="Masukkan judul event" 
                   class="w-full p-2 rounded-lg bg-gray-700 text-white border border-gray-600 focus:border-green-400 focus:ring focus:ring-green-300/30 outline-none" required>
        </div>

        <!-- Deskripsi Event -->
        <div>
            <label class="block text-gray-300 mb-1 font-medium">Deskripsi Event</label>
            <textarea id="editDeskripsi" name="deskripsi" rows="4" placeholder="Tulis deskripsi lengkap tentang event..." 
                      class="w-full p-2 rounded-lg bg-gray-700 text-white border border-gray-600 focus:border-green-400 focus:ring focus:ring-green-300/30 outline-none" required></textarea>
        </div>

        <!-- Tanggal mulai & selesai -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-gray-300 mb-1 font-medium">Tanggal Mulai</label>
                <input type="date" id="editMulai" name="tanggal_mulai"
                       class="w-full p-2 rounded-lg bg-gray-700 text-white border border-gray-600 focus:border-green-400 focus:ring focus:ring-green-300/30 outline-none" required>
            </div>
            <div>
                <label class="block text-gray-300 mb-1 font-medium">Tanggal Selesai</label>
                <input type="date" id="editSelesai" name="tanggal_selesai"
                       class="w-full p-2 rounded-lg bg-gray-700 text-white border border-gray-600 focus:border-green-400 focus:ring focus:ring-green-300/30 outline-none">
            </div>
        </div>

        <!-- Lokasi Event -->
        <div>
            <label class="block text-gray-300 mb-1 font-medium">Lokasi Event</label>
            <input type="text" id="editLokasi" name="lokasi" placeholder="Contoh: Jakarta Convention Center" 
                   class="w-full p-2 rounded-lg bg-gray-700 text-white border border-gray-600 focus:border-green-400 focus:ring focus:ring-green-300/30 outline-none">
        </div>

        <!-- Upload Poster / Gambar Event -->
        <div>
            <label class="block text-gray-300 mb-1 font-medium">Upload Poster / Gambar Event</label>
            <input type="file" id="gambarInput" name="gambar"
                   class="w-full p-2 rounded-lg bg-gray-700 text-white border border-gray-600 focus:border-green-400 focus:ring focus:ring-green-300/30 outline-none file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-green-500 file:text-white hover:file:bg-green-600">
            
            <img id="gambarPreview" src="" alt="Preview Gambar Event" class="mt-2 w-full h-48 object-cover rounded-lg border border-gray-600 hidden">
        </div>

        <!-- Tombol Submit -->
        <div class="pt-4 sticky bottom-0 bg-gray-800 pb-2">
            <button type="submit" 
                    class="w-full bg-green-500 hover:bg-green-600 px-4 py-3 rounded-lg text-white font-semibold transition duration-300 shadow-md">
               Update Event
            </button>
        </div>
    </form>
  </div>
</div>


<!-- Modal Delete -->
<div id="deleteModal" class="fixed inset-0 bg-black/50 flex items-center justify-center hidden z-50">
  <div class="bg-gray-800 p-6 rounded-2xl w-full max-w-md text-center relative">
    <button onclick="closeDelete()" class="absolute top-3 right-3 text-white text-xl">&times;</button>
    <h3 class="text-2xl text-red-400 mb-4">Hapus Event</h3>
    <p class="text-gray-300 mb-6">Yakin ingin menghapus event ini?</p>
    <form id="deleteForm" method="POST">
      @csrf
      @method('DELETE')
      <button type="submit" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded text-white font-semibold">Hapus</button>
      <button type="button" onclick="closeDelete()" class="bg-gray-500 hover:bg-gray-600 px-4 py-2 rounded text-white font-semibold ml-2">Batal</button>
    </form>
  </div>
</div>

<script>
  function openCreate() { document.getElementById('createModal').classList.remove('hidden'); }
  function closeCreate() { document.getElementById('createModal').classList.add('hidden'); }

  function openEdit(id, judul, deskripsi, mulai, selesai, lokasi) {
    const modal = document.getElementById('editModal');
    const form = document.getElementById('editForm');

    modal.classList.remove('hidden');
    form.action = '/events/update/' + id;

    document.getElementById('editJudul').value = judul;
    document.getElementById('editDeskripsi').value = deskripsi;
    document.getElementById('editMulai').value = mulai;
    document.getElementById('editSelesai').value = selesai ?? '';
    document.getElementById('editLokasi').value = lokasi ?? '';

    // Preview gambar kosong dulu
    const preview = document.getElementById('gambarPreview');
    if(gambarUrl){
        preview.src = gambarUrl;          // url dari database
        preview.classList.remove('hidden');
    } else {
        preview.src = '';
        preview.classList.add('hidden');
    }
}

  function closeEdit() { document.getElementById('editModal').classList.add('hidden'); }

  function openDelete(id) {
    const form = document.getElementById('deleteForm');
    form.action = '/events/destroy/' + id; // sesuai route kamu
    document.getElementById('deleteModal').classList.remove('hidden');
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
    if(file){
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