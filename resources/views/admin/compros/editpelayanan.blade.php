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

            <!-- Button Tambah -->
            <div class="mb-4 sm:mb-8">
                <button 
                    class="bg-green-400 text-gray-900 px-6 sm:px-8 py-2.5 sm:py-3 rounded-full hover:bg-green-300 
                        transition shadow-xl font-semibold uppercase tracking-wider text-sm sm:text-base"
                        onclick="openModal('tambahModal')">
                    Tambah Pelayanan
                </button>
            </div>
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

                <div class="flex space-x-2 sm:space-x-3 mt-4">
                    <button class="bg-yellow-400 text-gray-900 px-3 sm:px-4 py-1 rounded-full hover:bg-yellow-300 text-xs sm:text-sm font-medium transition shadow-sm"
                            onclick="openModal('editModal-{{ $p->id }}')">Edit</button>
                    <form action="{{ route('pelayanan.destroyPelayanan', $p->id) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-3 sm:px-4 py-1 rounded-full hover:bg-red-400 text-xs sm:text-sm font-medium transition shadow-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    @endforeach
    </div>


    <!-- Modal Tambah -->
    <div id="tambahModal" class="fixed inset-0 bg-black/50 flex items-center justify-center hidden z-50 p-4 sm:p-6">
    <div class="bg-gray-900 rounded-2xl w-full max-w-lg sm:max-w-xl md:max-w-2xl shadow-xl animate-fadeIn border border-green-400 
                max-h-[90vh] overflow-y-auto relative">
        
        <!-- Tombol close -->
        <button onclick="closeModal('tambahModal')" 
                class="absolute top-3 right-3 text-gray-400 hover:text-white text-2xl font-bold">
        &times;
        </button>

        <!-- Konten modal -->
        <div class="p-6 sm:p-8">
        <!-- Judul Modal -->
        <h3 class="text-xl sm:text-2xl font-bold text-green-400 mb-6 border-b border-gray-700 pb-2 text-center">
            Tambah Pelayanan
        </h3>

        <!-- Form -->
        <form action="{{ route('pelayanan.storePelayanan') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <!-- Nama -->
            <div>
            <label class="block text-gray-300 mb-1 font-medium">Nama Pelayanan</label>
            <input type="text" name="nama" placeholder="Contoh: Nasi Goreng Spesial" 
                    class="w-full p-2.5 rounded-lg bg-gray-800 text-white border border-gray-700 
                            focus:border-green-400 focus:ring-1 focus:ring-green-400 outline-none text-sm sm:text-base" required>
            </div>

            <!-- Kategori -->
            <div>
            <label class="block text-gray-300 mb-1 font-medium">Kategori</label>
            <select name="kategori" 
                    class="w-full p-2.5 rounded-lg bg-gray-800 text-white border border-gray-700 
                            focus:border-green-400 focus:ring-1 focus:ring-green-400 outline-none text-sm sm:text-base" required>
                <option value="">-- Pilih Kategori --</option>
                <option value="Makanan">Makanan</option>
                <option value="Minuman">Minuman</option>
                <option value="Rokok">Rokok</option>
            </select>
            </div>

            <!-- Harga -->
            <div>
            <label class="block text-gray-300 mb-1 font-medium">Harga</label>
            <div class="relative">
                <span class="absolute left-3 top-2.5 text-gray-400">Rp</span>
                <input type="text" id="hargaDisplay" 
                        class="w-full pl-10 p-2.5 rounded-lg bg-gray-800 text-white border border-gray-700 
                                focus:border-green-400 focus:ring-1 focus:ring-green-400 outline-none text-sm sm:text-base" 
                        placeholder="Contoh: 15000" autocomplete="off">
            </div>
            <input type="hidden" name="harga" id="hargaReal">
            </div>

            <!-- Gambar -->
            <div>
            <label class="block text-gray-300 mb-1 font-medium">Upload Gambar</label>
            <input type="file" name="gambar" accept="image/*" 
                    class="w-full text-gray-300 file:mr-3 file:py-2 file:px-4 file:rounded-lg 
                            file:border-0 file:text-xs sm:file:text-sm file:font-semibold 
                            file:bg-green-500 file:text-white hover:file:bg-green-600">
            </div>

            <!-- Tombol aksi -->
            <div class="flex justify-end space-x-3 pt-4 border-t border-gray-700">
            <button type="button" onclick="closeModal('tambahModal')" 
                    class="px-4 sm:px-5 py-2 rounded-lg bg-gray-700 hover:bg-gray-600 transition font-medium text-white text-sm sm:text-base">
                Batal
            </button>
            <button type="submit" 
                    class="px-4 sm:px-5 py-2 rounded-lg bg-green-500 text-white font-semibold hover:bg-green-600 transition shadow-md text-sm sm:text-base">
                Tambah
            </button>
            </div>
        </form>
        </div>
    </div>
    </div>


    <!-- Modal Edit -->
    @foreach($pelayanans as $p)
    <div id="editModal-{{ $p->id }}" class="fixed inset-0 bg-black/50 flex items-center justify-center hidden z-50 p-4 sm:p-6">
    <div class="bg-gray-900 rounded-2xl w-full max-w-lg sm:max-w-xl md:max-w-2xl shadow-xl animate-fadeIn border border-green-400 
                max-h-[90vh] overflow-y-auto relative">
        
        <!-- Tombol close -->
        <button onclick="closeModal('editModal-{{ $p->id }}')" 
                class="absolute top-3 right-3 text-gray-400 hover:text-white text-2xl font-bold">
        &times;
        </button>

        <!-- Konten modal -->
        <div class="p-6 sm:p-8">
        <h3 class="text-xl sm:text-2xl font-bold text-yellow-400 mb-6 border-b border-gray-700 pb-2 text-center">
            Edit {{ $p->nama }}
        </h3>

        <form action="{{ route('pelayanan.updatePelayanan', $p->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf 

            <!-- Nama -->
            <div>
            <label class="block text-gray-300 mb-1 font-medium">Nama Pelayanan</label>
            <input type="text" name="nama" value="{{ $p->nama }}" 
                    class="w-full p-2.5 rounded-lg bg-gray-800 text-white border border-gray-700 
                            focus:border-green-400 focus:ring-1 focus:ring-green-400 outline-none text-sm sm:text-base" required>
            </div>

            <!-- Kategori -->
            <div>
            <label class="block text-gray-300 mb-1 font-medium">Kategori</label>
            <select name="kategori" 
                    class="w-full p-2.5 rounded-lg bg-gray-800 text-white border border-gray-700 
                            focus:border-green-400 focus:ring-1 focus:ring-green-400 outline-none text-sm sm:text-base" required>
                <option value="Makanan" {{ $p->kategori == 'Makanan' ? 'selected' : '' }}>Makanan</option>
                <option value="Minuman" {{ $p->kategori == 'Minuman' ? 'selected' : '' }}>Minuman</option>
                <option value="Rokok" {{ $p->kategori == 'Rokok' ? 'selected' : '' }}>Rokok</option>
            </select>
            </div>

            <!-- Harga -->
            <div>
            <label class="block text-gray-300 mb-1 font-medium">Harga</label>
            <div class="relative">
                <span class="absolute left-3 top-2.5 text-gray-400">Rp</span>
                <!-- Display input (tidak dikirim ke DB) -->
                <input type="text" id="hargaDisplay-{{ $p->id }}" 
                        value="{{ number_format($p->harga,0,',','.') }}" 
                        class="w-full pl-10 p-2.5 rounded-lg bg-gray-800 text-white border border-gray-700 
                                focus:border-green-400 focus:ring-1 focus:ring-green-400 outline-none text-sm sm:text-base" 
                        placeholder="Contoh: 15000" autocomplete="off">
            </div>
            <!-- Hidden input yang dikirim ke DB -->
            <input type="hidden" name="harga" id="hargaReal-{{ $p->id }}" value="{{ $p->harga }}">
            </div>

            <!-- Gambar -->
            <div>
            <label class="block text-gray-300 mb-1 font-medium">Upload Gambar</label>
            <input type="file" name="gambar" accept="image/*" 
                    class="w-full text-gray-300 file:mr-3 file:py-2 file:px-4 file:rounded-lg 
                            file:border-0 file:text-xs sm:file:text-sm file:font-semibold 
                            file:bg-yellow-500 file:text-white hover:file:bg-yellow-600">
            </div>

            <!-- Tombol aksi -->
            <div class="flex justify-end space-x-3 pt-4 border-t border-gray-700">
            <button type="button" onclick="closeModal('editModal-{{ $p->id }}')" 
                    class="px-4 sm:px-5 py-2 rounded-lg bg-gray-700 hover:bg-gray-600 transition font-medium text-white text-sm sm:text-base">
                Batal
            </button>
            <button type="submit" 
                    class="px-4 sm:px-5 py-2 rounded-lg bg-yellow-500 text-gray-900 font-semibold hover:bg-yellow-600 transition shadow-md text-sm sm:text-base">
                Simpan
            </button>
            </div>
        </form>
        </div>
    </div>
    </div>
    @endforeach


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
