@extends('compro.profile')

@section('content')
<main class="flex flex-col items-center justify-center w-full">
    <!-- Hero Slider Ultra Smooth -->
    <section class="relative h-[80vh] w-full overflow-hidden bg-gray-900 flex items-center justify-center mt-20">
        @if(!empty($sliders) && $sliders->count() > 0)
            <div class="swiper h-full w-full">
                <div class="swiper-wrapper">
                    @foreach($sliders as $slider)
                    <div class="swiper-slide relative overflow-hidden">
                        <img src="{{ asset('storage/' . $slider->image) }}" class="w-full h-[80vh] object-cover transition-transform duration-1000 transform scale-105 hover:scale-110">

                        <!-- Tombol Edit Elegan -->
                        <button 
                          class="absolute top-4 right-4 z-30 px-4 py-2 rounded-lg 
                                bg-white/10 backdrop-blur-md border border-white/20 
                                text-white hover:bg-green-500 hover:text-white 
                                transition-all duration-300 shadow-lg flex items-center gap-2"
                          onclick='openEditSlider({
                              id: {{ $slider->id }},
                              title: @json($slider->title),
                              subtitle: @json($slider->subtitle),
                              image_url: @json($slider->image ? asset("storage/".$slider->image) : "")
                          })'>
                          <i class="fa-solid fa-pen"></i>
                          <span class="hidden md:inline">Edit Slider</span>
                      </button>


                        <!-- Gradient overlay -->
                        <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/30 to-black/10 flex flex-col items-center justify-center text-center px-6">
                            <h2 class="text-4xl md:text-6xl font-extrabold text-green-400 drop-shadow-lg opacity-0 translate-x-[-50px] animate-slideFromLeft">
                                {{ $slider->title }}
                            </h2>
                            <p class="mt-6 text-xl md:text-2xl font-sans font-bold text-gray-100 tracking-normal leading-relaxed drop-shadow-lg opacity-0 translate-x-[40px] animate-slideFromRight delay-200">
                                {{ $slider->subtitle }}
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="swiper-pagination absolute bottom-6 left-0 w-full flex justify-center space-x-3 z-20"></div>
            </div>
        @else
            <!-- Placeholder kalau belum ada slider -->
            <div class="w-full h-full flex flex-col items-center justify-center bg-gray-800 text-gray-400 text-center px-6 relative">
                <p class="text-2xl md:text-4xl font-bold mb-2">Belum ada slider</p>
                <p class="text-lg md:text-xl mb-6">Silakan masukkan slider di admin panel.</p>
                
                <!-- Tombol Tambah di tengah -->
                <button 
                  class="px-6 py-3 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-all duration-300 flex items-center gap-2"
                  onclick="document.getElementById('addSliderModal').classList.remove('hidden')">
                  <i class="fa-solid fa-plus"></i> Tambah Slider
              </button>
            </div>
        @endif
    </section>

    <!-- Tentang Kami -->
  <section id="about" class="py-24 bg-gradient-to-br from-gray-900 via-gray-950 to-black relative overflow-hidden">
      <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-12 items-center px-6">

          <!-- Gambar -->
          <div class="relative group" data-aos="fade-right">
              <div class="rounded-3xl overflow-hidden shadow-2xl transform transition duration-700 group-hover:scale-[1.03] bg-gray-800 h-96 flex items-center justify-center">
                  @if(!empty($data['gambar']))
                      <img src="{{ asset($data['gambar']) }}"
                          alt="Tentang Kami"
                          class="w-full h-96 object-cover transition-transform duration-1000 group-hover:scale-105">
                      <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-black/20 to-transparent transition duration-700"></div>
                  @else
                      <p class="text-gray-400 text-center text-lg md:text-xl">Belum ada gambar tentang kami</p>
                  @endif
              </div>
          </div>

          <!-- Konten Deskripsi -->
          <div data-aos="fade-left">
              <div class="bg-gray-900/60 backdrop-blur-xl p-12 md:p-16 rounded-3xl shadow-2xl border border-gray-700/30 hover:border-green-400/40 transition-all duration-700">

                  <!-- Header -->
                  <h2 class="text-4xl md:text-5xl font-extrabold text-green-400 tracking-tight drop-shadow-md mb-8">
                      Tentang Kami
                  </h2>

                  <!-- Deskripsi -->
                  @if(!empty($data['deskripsi']))
                      <p class="text-gray-200 leading-relaxed text-lg md:text-xl tracking-wide mb-8 text-justify">
                          {{ $data['deskripsi'] }}
                      </p>
                      <button onclick="openModal('editModal')"
                          class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md transition-all duration-300 transform hover:scale-105">
                          ✎ Edit
                      </button>
                  @else
                      <p class="text-gray-400 italic mb-8 text-lg md:text-xl text-center">
                          Belum ada deskripsi tentang perusahaan
                      </p>
                      <button onclick="openModal('addModal')"
                          class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow-md transition-all duration-300 transform hover:scale-105">
                          + Tambah
                      </button>
                  @endif
              </div>
          </div>

      </div>
  </section>


    <!-- Layanan -->
    <section id="services" class="py-24 bg-gray-900">
        <div class="max-w-7xl mx-auto text-center px-6">
            
            <!-- Tombol Tambah Layanan -->
            <div class="flex justify-center gap-4 mb-10">
                <button onclick="openAddServiceModal()" 
                    class="bg-green-500 hover:bg-green-600 text-white px-5 py-2 rounded-lg font-semibold shadow-lg flex items-center gap-2 transition-all duration-300">
                    <i class="fa-solid fa-plus"></i> Tambah Layanan
                </button>
            </div>


            <h2 class="text-4xl md:text-5xl font-extrabold text-green-400 mb-14" data-aos="fade-up">
                Layanan Kami
            </h2>

            <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @if(!empty($layanan) && $layanan->count() > 0)
                    @foreach($layanan as $item)
                    <div class="relative bg-gray-800/70 backdrop-blur-md p-6 rounded-2xl shadow-lg transform transition duration-500 hover:-translate-y-2 hover:scale-[1.02] hover:shadow-green-500/30"
                        data-aos="zoom-in" data-aos-delay="{{ $loop->index * 150 }}">
                        
                        <!-- Gambar -->
                        <div class="overflow-hidden rounded-xl mb-5 relative">
                            <img src="{{ $item->image ? asset('storage/'.$item->image) : 'https://via.placeholder.com/400x300?text=No+Image' }}" 
                                alt="{{ $item->name ?? 'Layanan' }}" 
                                class="w-full h-48 object-cover transition-transform duration-700 hover:scale-110">
                            
                            <!-- Tombol Edit -->
                            <button class="absolute top-3 right-3 bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-lg font-semibold shadow-md flex items-center gap-1 transition-all duration-300 z-10"
                                onclick="openEditServiceModal({{ json_encode($item) }})">
                                <i class="fa-solid fa-pen"></i> Edit
                            </button>
                        </div>

                        <!-- Nama & Deskripsi -->
                        <h3 class="text-2xl font-bold mb-3 text-green-400">{{ $item->name ?? '-' }}</h3>
                        <p class="text-gray-300 leading-relaxed text-base">{{ $item->description ?? '-' }}</p>
                    </div>
                    @endforeach
                @else
                    @for($i = 0; $i < 3; $i++)
                    <div class="bg-gray-800/50 p-6 rounded-2xl shadow-md h-64 flex items-center justify-center">
                        <p class="text-gray-400 text-center">Belum ada layanan tersedia</p>
                    </div>
                    @endfor
                @endif
            </div>
        </div>
    </section>

    <!-- Harga -->
    <section id="harga" class="py-28 bg-gray-900 relative">
        <div class="max-w-7xl mx-auto text-center px-8">
            
            <!-- Tombol Tambah Harga -->
            <div class="flex justify-center gap-4 mb-12">
                <button onclick="openAddPriceModal()" 
                    class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-xl font-semibold shadow-lg flex items-center gap-2 transition-all duration-300 hover:shadow-green-500/40">
                    <i class="fa-solid fa-plus text-lg"></i> Tambah Harga
                </button>
            </div>

            <h2 class="text-5xl md:text-6xl font-extrabold text-green-400 mb-16 tracking-tight" data-aos="fade-up">
                Harga
            </h2>

            <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                @if(!empty($prices) && $prices->count() > 0)
                    @foreach($prices as $item)
                    <div class="relative bg-gray-800/80 backdrop-blur-lg p-8 rounded-3xl shadow-xl transform transition duration-500 hover:-translate-y-3 hover:scale-[1.04] hover:shadow-green-500/40"
                        data-aos="zoom-in" data-aos-delay="{{ $loop->index * 150 }}">
                        
                        <!-- Tombol Edit -->
                        <button class="absolute top-5 right-5 bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg font-semibold shadow-md flex items-center gap-2 transition-all duration-300 z-10"
                            onclick="openEditPriceModal({{ json_encode([
                                'id' => $item->id,
                                'title' => $item->title,
                                'subtitle' => $item->subtitle,
                                'image' => $item->image ? asset('storage/'.$item->image) : null
                            ]) }})">
                            <i class="fa-solid fa-pen"></i> Edit
                        </button>

                        <!-- Gambar -->
                        <div class="overflow-hidden rounded-2xl mb-6">
                            <img src="{{ $item->image ? asset('storage/'.$item->image) : 'https://via.placeholder.com/500x350?text=No+Image' }}" 
                                alt="{{ $item->title ?? 'Harga' }}" 
                                class="w-full h-56 object-cover transition-transform duration-700 hover:scale-110">
                        </div>

                        <!-- Judul & Subtitle -->
                        <h3 class="text-3xl font-bold text-green-400 mb-3">{{ $item->title ?? '-' }}</h3>
                        <p class="text-gray-300 leading-relaxed text-lg">{{ $item->subtitle ?? '-' }}</p>
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

          <!-- Tombol Tambah Gallery -->
          <div class="flex justify-center gap-4 mb-10">
              <button class="bg-green-500 hover:bg-green-600 text-white px-5 py-2 rounded-lg font-semibold shadow-lg flex items-center gap-2 transition-all duration-300"
                  onclick="openAddGalleryModal()">
                  <i class="fa-solid fa-plus"></i> Tambah Gambar
              </button>
          </div>

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

                          <!-- Tombol Edit overlay -->
                          <button class="absolute top-3 right-3 bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-lg font-semibold shadow-lg flex items-center gap-1 transition-all duration-300 opacity-0 group-hover:opacity-100 z-10"
                              onclick='openEditGalleryModal(@json([
                                  "id" => $item->id,
                                  "image" => $item->image ? asset("storage/".$item->image) : null,
                                  "caption" => $item->caption ?? ""
                              ]))'>
                              <i class="fa-solid fa-pen"></i> Edit
                          </button>
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
    <section id="contact" class="py-24 bg-gray-900 text-center w-full">
      <h2 class="text-4xl md:text-3xl font-extrabold text-green-400 mb-12" data-aos="fade-down">
          Kontak Kami
      </h2>

      <!-- Tombol Tambah / Edit -->
      <div class="flex justify-center mb-8 gap-4">
          @if(empty($contact))
              <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg font-semibold shadow-lg flex items-center gap-2 transition-all duration-300"
                  onclick="openAddContactModal()">
                  <i class="fa-solid fa-plus"></i> Tambah Kontak
              </button>
          @else
              <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg font-semibold shadow-lg flex items-center gap-2 transition-all duration-300"
                  onclick='openEditContactModal(@json($contact))'>
                  <i class="fa-solid fa-pen"></i> Edit Kontak
              </button>
          @endif
      </div>

      <div class="grid md:grid-cols-3 gap-8 text-left px-6">
          @php
              $kontakList = [
                  ['icon'=>'fa-map-location','title'=>'Alamat','value'=>$contact->address ?? 'Belum ada alamat tersedia'],
                  ['icon'=>'fa-envelope','title'=>'Email','value'=>$contact->email ?? 'Belum ada email tersedia'],
                  ['icon'=>'fa-phone','title'=>'Telepon','value'=>$contact->phone ?? 'Belum ada telepon tersedia']
              ];
          @endphp

          @foreach($kontakList as $kontak)
          <div class="bg-gray-800 p-6 rounded-3xl shadow-lg flex items-start space-x-4 hover:scale-105 transition-transform duration-300 hover:shadow-gradient opacity-0 translate-y-6" data-aos="fade-up" data-aos-delay="{{ $loop->index*100 }}">
              <i class="fa-solid {{ $kontak['icon'] }} text-green-400 text-3xl mt-1"></i>
              <div>
                  <h3 class="text-xl font-semibold text-green-400 mb-2">{{ $kontak['title'] }}</h3>
                  <p class="text-gray-300">{{ $kontak['value'] }}</p>
              </div>
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

    <!-- Modal Tambah Slider -->
  <div id="addSliderModal" class="fixed inset-0 z-50 hidden bg-black/50 flex items-center justify-center">
      <div class="bg-gray-900 text-white rounded-3xl shadow-2xl w-full max-w-3xl p-6 relative">
          <!-- Header -->
          <div class="flex justify-between items-center border-b border-gray-700 pb-3 mb-4">
              <h3 class="text-2xl font-bold text-green-400">Tambah Slider</h3>
              <button class="text-white text-xl close-modal">&times;</button>
          </div>

          <!-- Form Tambah -->
          <form action="{{ route('slider.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
              @csrf
              <div>
                  <label class="block text-gray-300 mb-2">Gambar Slider</label>
                  <input type="file" name="image" class="w-full text-white bg-gray-800 rounded-lg p-2">
              </div>

              <div>
                  <label class="block text-gray-300 mb-2">Judul Slider</label>
                  <input type="text" name="title" class="w-full p-2 rounded-lg bg-gray-800 text-white border border-gray-700" required>
              </div>

              <div>
                  <label class="block text-gray-300 mb-2">Subtitle</label>
                  <input type="text" name="subtitle" class="w-full p-2 rounded-lg bg-gray-800 text-white border border-gray-700">
              </div>

              <div class="flex justify-end gap-3 mt-4">
                  <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg font-semibold flex items-center gap-2">
                      <i class="fa-solid fa-check"></i> Simpan
                  </button>
                  <button type="button" class="bg-gray-700 hover:bg-gray-600 px-5 py-2 rounded-lg text-white close-modal">Batal</button>
              </div>
          </form>
      </div>
  </div>

  <!-- Modal Edit Slider -->
    <div id="editSliderModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm p-4">
      <div class="bg-gray-900 text-white rounded-3xl shadow-2xl w-full max-w-3xl p-6 relative transform scale-95 opacity-0 transition-all duration-300 ease-out
                  max-h-[90vh] overflow-y-auto" id="editSliderContent">
        
        <!-- Header -->
        <div class="flex justify-between items-center border-b border-gray-700 pb-3 mb-6 sticky top-0 bg-gray-900 z-10">
          <h3 class="text-2xl font-bold text-green-400">Edit Slider</h3>
          <button class="text-white text-2xl hover:text-red-500 transition-all duration-200 close-modal">&times;</button>
        </div>

        <!-- Form -->
        <form id="editSliderForm" method="POST" enctype="multipart/form-data" class="space-y-6">
          @csrf

          <!-- Gambar -->
          <div>
            <label class="block text-gray-300 mb-2 font-medium">Gambar Slider</label>
            <input type="file" name="image" placeholder="Pilih gambar slider..." class="w-full text-white bg-gray-800 rounded-lg p-3 border border-gray-700 focus:outline-none focus:ring-2 focus:ring-green-400 transition-all duration-200">
            <div id="editSliderPreview" class="mt-4 flex justify-center transition-all duration-300 rounded-xl overflow-hidden shadow-inner">
              <!-- Preview gambar akan diisi JS -->
            </div>
          </div>

          <!-- Judul -->
          <div>
            <label class="block text-gray-300 mb-2 font-medium">Judul Slider</label>
            <input type="text" name="title" id="editSliderTitle" placeholder="Masukkan judul slider..." class="w-full p-3 rounded-lg bg-gray-800 text-white border border-gray-700 focus:outline-none focus:ring-2 focus:ring-green-400 shadow-inner transition-all duration-200" required>
          </div>

          <!-- Subtitle -->
          <div>
            <label class="block text-gray-300 mb-2 font-medium">Subtitle</label>
            <input type="text" name="subtitle" id="editSliderSubtitle" placeholder="Masukkan subtitle slider..." class="w-full p-3 rounded-lg bg-gray-800 text-white border border-gray-700 focus:outline-none focus:ring-2 focus:ring-green-400 shadow-inner transition-all duration-200">
          </div>

          <!-- Footer Buttons -->
          <div class="flex justify-end gap-4 mt-6">
            <button type="submit" class="bg-green-500 hover:bg-green-600 px-6 py-2 rounded-lg font-semibold flex items-center gap-2 transition-all duration-200 shadow-md hover:shadow-lg">
              <i class="fa-solid fa-check"></i> Simpan
            </button>
            <button type="button" class="bg-gray-700 hover:bg-gray-600 px-6 py-2 rounded-lg font-semibold transition-all duration-200 shadow-md hover:shadow-lg close-modal">
              Batal
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- Modal Tambah -->
    <div id="addModal" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 hidden">
      <div class="bg-gray-900 rounded-2xl shadow-xl max-w-lg w-full p-6 relative transform transition-all scale-95 opacity-0">
        <button onclick="closeModal('addModal')" class="absolute top-3 right-3 text-gray-400 hover:text-white text-xl">&times;</button>
        <h3 class="text-2xl font-bold text-green-400 mb-4">Tambah Tentang Kami</h3>
        <form action="{{ route('about.save') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="mb-4">
              <label class="block text-gray-300 mb-2">Deskripsi</label>
              <textarea name="deskripsi" class="w-full p-3 rounded-lg bg-gray-800 text-white border border-gray-700 focus:ring-2 focus:ring-green-400 resize-none" rows="4" placeholder="Masukkan deskripsi..."></textarea>
          </div>
          <div class="mb-4">
              <label class="block text-gray-300 mb-2">Upload Gambar</label>
              <input type="file" name="gambar" class="w-full text-gray-300 file:mr-4 file:py-2 file:px-4
                    file:rounded-full file:border-0 file:text-sm file:font-semibold
                    file:bg-green-500 file:text-white hover:file:bg-green-600">
          </div>
          <div class="flex justify-end gap-3">
              <button type="button" onclick="closeModal('addModal')" class="px-4 py-2 bg-gray-600 rounded-lg hover:bg-gray-700 text-white">Batal</button>
              <button type="submit" class="px-4 py-2 bg-green-500 hover:bg-green-600 rounded-lg text-white">Simpan</button>
          </div>
      </form>
      </div>
    </div>

    <!-- Modal Edit -->
    <div id="editModal" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 hidden">
        <div class="bg-gray-900 rounded-2xl shadow-xl max-w-lg w-full p-6 relative transform transition-all scale-95 opacity-0">
            <button onclick="closeModal('editModal')" class="absolute top-3 right-3 text-gray-400 hover:text-white text-xl">&times;</button>
            <h3 class="text-2xl font-bold text-blue-400 mb-4">Edit Tentang Kami</h3>

            <form action="{{ route('about.save') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-300 mb-2">Deskripsi</label>
                    <textarea name="deskripsi" 
                              class="w-full p-3 rounded-lg bg-gray-800 text-white border border-gray-700 focus:ring-2 focus:ring-blue-400 resize-none"
                              rows="4"
                              placeholder="Masukkan deskripsi...">{{ old('deskripsi', $data['deskripsi'] ?? '') }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-300 mb-2">Ganti Gambar</label>
                    @if(!empty($data['gambar']))
                        <img src="{{ asset($data['gambar']) }}" alt="Preview Gambar" class="mb-2 w-32 h-20 object-cover rounded-lg shadow">
                    @endif
                    <input type="file" name="gambar" 
                          class="w-full text-gray-300 file:mr-4 file:py-2 file:px-4
                                  file:rounded-full file:border-0 file:text-sm file:font-semibold
                                  file:bg-blue-500 file:text-white hover:file:bg-blue-600">
                </div>

                <div class="flex justify-end gap-3">
                    <button type="button" onclick="closeModal('editModal')" class="px-4 py-2 bg-gray-600 rounded-lg hover:bg-gray-700 text-white">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 rounded-lg text-white">Update</button>
                </div>
            </form>
        </div>
    </div>


    <!-- Modal Tambah Layanan -->
    <div id="addServiceModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm p-4">
      <div class="bg-gray-900 text-white rounded-3xl shadow-2xl w-full max-w-3xl p-6 relative transform scale-95 opacity-0 transition-all duration-300 ease-out max-h-[90vh] overflow-y-auto" id="addServiceContent">
        
        <!-- Header -->
        <div class="flex justify-between items-center border-b border-gray-700 pb-3 mb-6 sticky top-0 bg-gray-900 z-10">
          <h3 class="text-2xl font-bold text-green-400">Tambah Layanan</h3>
          <button class="text-white text-2xl hover:text-red-500 transition-all duration-200 close-modal">&times;</button>
        </div>

        <!-- Form -->
        <form id="addServiceForm" method="POST" enctype="multipart/form-data" class="space-y-5" action="{{ route('layanan.store') }}" enctype="multipart/form-data">
          @csrf
          <!-- Nama Layanan -->
          <div>
            <label class="block text-gray-300 mb-2 font-medium">Nama Layanan</label>
            <input type="text" name="name" class="w-full p-3 rounded-lg bg-gray-800 text-white border border-gray-700 focus:outline-none focus:ring-2 focus:ring-green-400" required>
          </div>

          <!-- Deskripsi -->
          <div>
            <label class="block text-gray-300 mb-2 font-medium">Deskripsi</label>
            <textarea name="description" rows="5" class="w-full p-3 rounded-lg bg-gray-800 text-white border border-gray-700 focus:outline-none focus:ring-2 focus:ring-green-400" required></textarea>
          </div>

          <!-- Gambar -->
          <div>
            <label class="block text-gray-300 mb-2 font-medium">Gambar</label>
            <input type="file" name="image" class="w-full text-white bg-gray-800 rounded-lg p-2 border border-gray-700 focus:outline-none focus:ring-2 focus:ring-green-400">
          </div>

          <!-- Footer Buttons -->
          <div class="flex justify-end gap-4 mt-6">
            <button type="submit" class="bg-green-500 hover:bg-green-600 px-6 py-2 rounded-lg font-semibold flex items-center gap-2 transition-all duration-200 shadow-md hover:shadow-lg">
              <i class="fa-solid fa-check"></i> Simpan
            </button>
            <button type="button" class="bg-gray-700 hover:bg-gray-600 px-6 py-2 rounded-lg font-semibold transition-all duration-200 shadow-md hover:shadow-lg close-modal">
              Batal
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- Modal Edit Layanan -->
    <div id="editServiceModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm p-4">
      <div class="bg-gray-900 text-white rounded-3xl shadow-2xl w-full max-w-3xl p-6 relative transform scale-95 opacity-0 transition-all duration-300 ease-out max-h-[90vh] overflow-y-auto" id="editServiceContent">
        
        <!-- Header -->
        <div class="flex justify-between items-center border-b border-gray-700 pb-3 mb-6 sticky top-0 bg-gray-900 z-10">
          <h3 class="text-2xl font-bold text-green-400">Edit Layanan</h3>
          <button class="text-white text-2xl hover:text-red-500 transition-all duration-200 close-modal">&times;</button>
        </div>

        <!-- Form -->
        <form id="editServiceForm" method="POST" enctype="multipart/form-data" class="space-y-5">
          @csrf      

          <!-- Nama Layanan -->
          <div>
            <label class="block text-gray-300 mb-2 font-medium">Nama Layanan</label>
            <input type="text" name="name" id="editServiceName" class="w-full p-3 rounded-lg bg-gray-800 text-white border border-gray-700 focus:outline-none focus:ring-2 focus:ring-green-400" required>
          </div>

          <!-- Deskripsi -->
          <div>
            <label class="block text-gray-300 mb-2 font-medium">Deskripsi</label>
            <textarea name="description" id="editServiceDescription" rows="5" class="w-full p-3 rounded-lg bg-gray-800 text-white border border-gray-700 focus:outline-none focus:ring-2 focus:ring-green-400" required></textarea>
          </div>

          <!-- Gambar -->
          <div>
            <label class="block text-gray-300 mb-2 font-medium">Gambar</label>
            <input type="file" name="image" class="w-full text-white bg-gray-800 rounded-lg p-2 border border-gray-700 focus:outline-none focus:ring-2 focus:ring-green-400">
            <div id="editServicePreview" class="mt-4 flex justify-center transition-all duration-300 rounded-xl overflow-hidden"></div>
          </div>

          <!-- Footer Buttons -->
          <div class="flex justify-end gap-4 mt-6">
            <button type="submit" class="bg-green-500 hover:bg-green-600 px-6 py-2 rounded-lg font-semibold flex items-center gap-2 transition-all duration-200 shadow-md hover:shadow-lg">
              <i class="fa-solid fa-check"></i> Simpan
            </button>
            <button type="button" class="bg-gray-700 hover:bg-gray-600 px-6 py-2 rounded-lg font-semibold transition-all duration-200 shadow-md hover:shadow-lg close-modal">
              Batal
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- Modal Tambah Harga -->
    <div id="addPriceModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm p-4">
      <div class="bg-gray-900 text-white rounded-3xl shadow-2xl w-full max-w-3xl p-6 relative transform scale-95 opacity-0 transition-all duration-300 ease-out max-h-[90vh] overflow-y-auto" id="addPriceContent">
          
          <!-- Header -->
          <div class="flex justify-between items-center border-b border-gray-700 pb-3 mb-6 sticky top-0 bg-gray-900 z-10">
              <h3 class="text-2xl font-bold text-green-400">Tambah Harga</h3>
              <button class="text-white text-2xl hover:text-red-500 transition-all duration-200 close-modal">&times;</button>
          </div>

          <!-- Form -->
          <form id="addPriceForm" method="POST" enctype="multipart/form-data" action="{{ route('harga.store') }}" class="space-y-5">
              @csrf
              <!-- Judul -->
              <div>
                  <label class="block text-gray-300 mb-2 font-medium">Judul</label>
                  <input type="text" name="title" class="w-full p-3 rounded-lg bg-gray-800 text-white border border-gray-700 focus:outline-none focus:ring-2 focus:ring-green-400" required>
              </div>

              <!-- Subtitle -->
              <div>
                  <label class="block text-gray-300 mb-2 font-medium">Deskripsi</label>
                  <textarea name="subtitle" rows="4" class="w-full p-3 rounded-lg bg-gray-800 text-white border border-gray-700 focus:outline-none focus:ring-2 focus:ring-green-400" required></textarea>
              </div>

              <!-- Gambar -->
              <div>
                  <label class="block text-gray-300 mb-2 font-medium">Gambar</label>
                  <input type="file" name="image" class="w-full text-white bg-gray-800 rounded-lg p-2 border border-gray-700 focus:outline-none focus:ring-2 focus:ring-green-400">
              </div>

              <!-- Footer Buttons -->
              <div class="flex justify-end gap-4 mt-6">
                  <button type="submit" class="bg-green-500 hover:bg-green-600 px-6 py-2 rounded-lg font-semibold flex items-center gap-2 transition-all duration-200 shadow-md hover:shadow-lg">
                      <i class="fa-solid fa-check"></i> Simpan
                  </button>
                  <button type="button" class="bg-gray-700 hover:bg-gray-600 px-6 py-2 rounded-lg font-semibold transition-all duration-200 shadow-md hover:shadow-lg close-modal">
                      Batal
                  </button>
              </div>
          </form>
      </div>
  </div>

  <!-- Edit Modal Harga -->
    <div id="editPriceModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm p-4">
      <div class="bg-gray-900 text-white rounded-3xl shadow-2xl w-full max-w-3xl p-6 relative transform scale-95 opacity-0 transition-all duration-300 ease-out max-h-[90vh] overflow-y-auto" id="editPriceContent">
          
          <!-- Header -->
          <div class="flex justify-between items-center border-b border-gray-700 pb-3 mb-6 sticky top-0 bg-gray-900 z-10">
              <h3 class="text-2xl font-bold text-green-400">Edit Harga</h3>
              <button class="text-white text-2xl hover:text-red-500 transition-all duration-200 close-modal">&times;</button>
          </div>

          <!-- Form -->
          <form id="editPriceForm" method="POST" enctype="multipart/form-data" class="space-y-5">
              @csrf

              <!-- Judul -->
              <div>
                  <label class="block text-gray-300 mb-2 font-medium">Judul</label>
                  <input type="text" name="title" id="editPriceTitle" class="w-full p-3 rounded-lg bg-gray-800 text-white border border-gray-700 focus:outline-none focus:ring-2 focus:ring-green-400" required>
              </div>

              <!-- Subtitle -->
              <div>
                  <label class="block text-gray-300 mb-2 font-medium">Deskripsi</label>
                  <textarea name="subtitle" id="editPriceSubtitle" rows="4" class="w-full p-3 rounded-lg bg-gray-800 text-white border border-gray-700 focus:outline-none focus:ring-2 focus:ring-green-400" required></textarea>
              </div>

              <!-- Gambar -->
              <div>
                <label class="block text-gray-300 mb-2 font-medium">Gambar</label>
                <input type="file" name="image" class="w-full text-white bg-gray-800 rounded-lg p-2 border border-gray-700 focus:outline-none focus:ring-2 focus:ring-green-400">
                <div id="editPricePreview" class="mt-4 flex justify-center transition-all duration-300 rounded-xl overflow-hidden"></div>
              </div>

              <!-- Footer Buttons -->
              <div class="flex justify-end gap-4 mt-6">
                  <button type="submit" class="bg-green-500 hover:bg-green-600 px-6 py-2 rounded-lg font-semibold flex items-center gap-2 transition-all duration-200 shadow-md hover:shadow-lg">
                      <i class="fa-solid fa-check"></i> Simpan
                  </button>
                  <button type="button" class="bg-gray-700 hover:bg-gray-600 px-6 py-2 rounded-lg font-semibold transition-all duration-200 shadow-md hover:shadow-lg close-modal">
                      Batal
                  </button>
              </div>
          </form>
      </div>
  </div>

  <!-- Add Gallery Modal -->
<div id="addGalleryModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm p-4">
    <div class="bg-gray-900 text-white rounded-3xl shadow-2xl w-full max-w-3xl p-6 relative transform scale-95 opacity-0 transition-all duration-300 ease-out max-h-[90vh] overflow-y-auto" id="addGalleryContent">
        <div class="flex justify-between items-center border-b border-gray-700 pb-3 mb-6 sticky top-0 bg-gray-900 z-10">
            <h3 class="text-2xl font-bold text-green-400">Tambah Gambar</h3>
            <button class="text-white text-2xl hover:text-red-500 transition-all duration-200 close-modal">&times;</button>
        </div>

        <form id="addGalleryForm" class="space-y-5" enctype="multipart/form-data">
            @csrf
            <!-- Gambar -->
            <div>
                <label class="block text-gray-300 mb-2 font-medium">Gambar</label>
                <input type="file" name="image" id="addGalleryImage" class="w-full text-white bg-gray-800 rounded-lg p-2 border border-gray-700 focus:outline-none focus:ring-2 focus:ring-green-400" required>
                <div id="addGalleryPreview" class="mt-4 flex justify-center transition-all duration-300 rounded-xl overflow-hidden"></div>
            </div>

            <!-- Caption -->
            <div>
                <label class="block text-gray-300 mb-2 font-medium">Caption</label>
                <input type="text" name="caption" id="addGalleryCaption" class="w-full p-3 rounded-lg bg-gray-800 text-white border border-gray-700 focus:outline-none focus:ring-2 focus:ring-green-400" placeholder="Tulis caption gambar..." required>
            </div>

            <div class="flex justify-end gap-4 mt-6">
                <button type="button" id="submitGalleryBtn" class="bg-green-500 hover:bg-green-600 px-6 py-2 rounded-lg font-semibold flex items-center gap-2 transition-all duration-200 shadow-md hover:shadow-lg">
                    <i class="fa-solid fa-check"></i> Simpan
                </button>
                <button type="button" class="bg-gray-700 hover:bg-gray-600 px-6 py-2 rounded-lg font-semibold transition-all duration-200 shadow-md hover:shadow-lg close-modal">
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>


  <!-- Edit Gallery Modal -->
  <div id="editGalleryModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm p-4">
      <div class="bg-gray-900 text-white rounded-3xl shadow-2xl w-full max-w-3xl p-6 relative transform scale-95 opacity-0 transition-all duration-300 ease-out max-h-[90vh] overflow-y-auto" id="editGalleryContent">
          <div class="flex justify-between items-center border-b border-gray-700 pb-3 mb-6 sticky top-0 bg-gray-900 z-10">
              <h3 class="text-2xl font-bold text-green-400">Edit Gambar</h3>
              <button class="text-white text-2xl hover:text-red-500 transition-all duration-200 close-modal">&times;</button>
          </div>

          <form id="editGalleryForm" method="POST" enctype="multipart/form-data" class="space-y-5">
              @csrf
              <!-- Gambar -->
              <div>
                  <label class="block text-gray-300 mb-2 font-medium">Gambar</label>
                  <input type="file" name="image" class="w-full text-white bg-gray-800 rounded-lg p-2 border border-gray-700 focus:outline-none focus:ring-2 focus:ring-green-400">
                  <div id="editGalleryPreview" class="mt-4 flex justify-center transition-all duration-300 rounded-xl overflow-hidden"></div>
              </div>

              <!-- Caption -->
              <div>
                  <label class="block text-gray-300 mb-2 font-medium">Caption</label>
                  <input type="text" name="caption" id="editGalleryCaption" class="w-full p-3 rounded-lg bg-gray-800 text-white border border-gray-700 focus:outline-none focus:ring-2 focus:ring-green-400" placeholder="Tulis caption gambar..." required>
              </div>

              <div class="flex justify-end gap-4 mt-6">
                  <button type="submit" class="bg-green-500 hover:bg-green-600 px-6 py-2 rounded-lg font-semibold flex items-center gap-2 transition-all duration-200 shadow-md hover:shadow-lg">
                      <i class="fa-solid fa-check"></i> Simpan
                  </button>
                  <button type="button" class="bg-gray-700 hover:bg-gray-600 px-6 py-2 rounded-lg font-semibold transition-all duration-200 shadow-md hover:shadow-lg close-modal">
                      Batal
                  </button>
              </div>
          </form>
      </div>
  </div>

  <!-- Add Contact Modal -->
  <div id="addContactModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm p-4">
      <div class="bg-gray-900 text-white rounded-3xl shadow-2xl w-full max-w-3xl p-6 relative transform scale-95 opacity-0 transition-all duration-300 ease-out max-h-[90vh] overflow-y-auto" id="addContactContent">
          <div class="flex justify-between items-center border-b border-gray-700 pb-3 mb-6 sticky top-0 bg-gray-900 z-10">
              <h3 class="text-2xl font-bold text-green-400">Tambah Kontak</h3>
              <button class="text-white text-2xl hover:text-red-500 transition-all duration-200 close-modal">&times;</button>
          </div>

          <form id="addContactForm" method="POST" class="space-y-5" action="{{ route('contact.store') }}">
              @csrf
              <!-- Alamat -->
              <div>
                  <label class="block text-gray-300 mb-2 font-medium">Alamat</label>
                  <input type="text" name="address" class="w-full p-3 rounded-lg bg-gray-800 text-white border border-gray-700 focus:outline-none focus:ring-2 focus:ring-green-400" required>
              </div>

              <!-- Email -->
              <div>
                  <label class="block text-gray-300 mb-2 font-medium">Email</label>
                  <input type="email" name="email" class="w-full p-3 rounded-lg bg-gray-800 text-white border border-gray-700 focus:outline-none focus:ring-2 focus:ring-green-400">
              </div>

              <!-- Telepon -->
              <div>
                  <label class="block text-gray-300 mb-2 font-medium">Telepon</label>
                  <input type="text" name="phone" class="w-full p-3 rounded-lg bg-gray-800 text-white border border-gray-700 focus:outline-none focus:ring-2 focus:ring-green-400">
              </div>

              <!-- Footer Buttons -->
              <div class="flex justify-end gap-4 mt-6">
                  <button type="submit" class="bg-green-500 hover:bg-green-600 px-6 py-2 rounded-lg font-semibold flex items-center gap-2 transition-all duration-200 shadow-md hover:shadow-lg">
                      <i class="fa-solid fa-check"></i> Simpan
                  </button>
                  <button type="button" class="bg-gray-700 hover:bg-gray-600 px-6 py-2 rounded-lg font-semibold transition-all duration-200 shadow-md hover:shadow-lg close-modal">
                      Batal
                  </button>
              </div>
          </form>
      </div>
  </div>

  <!-- Edit Contact Modal -->
  <div id="editContactModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm p-4">
      <div class="bg-gray-900 text-white rounded-3xl shadow-2xl w-full max-w-3xl p-6 relative transform scale-95 opacity-0 transition-all duration-300 ease-out max-h-[90vh] overflow-y-auto" id="editContactContent">
          <div class="flex justify-between items-center border-b border-gray-700 pb-3 mb-6 sticky top-0 bg-gray-900 z-10">
              <h3 class="text-2xl font-bold text-green-400">Edit Kontak</h3>
              <button class="text-white text-2xl hover:text-red-500 transition-all duration-200 close-modal">&times;</button>
          </div>
            <form id="editContactForm" action="{{ route('contact.update', $contact->id) }}" method="POST" class="space-y-5">
              @csrf
              <!-- Alamat -->
              <div>
                  <label class="block text-gray-300 mb-2 font-medium">Alamat</label>
                  <input type="text" name="address" id="editContactAddress" class="w-full p-3 rounded-lg bg-gray-800 text-white border border-gray-700 focus:outline-none focus:ring-2 focus:ring-green-400" required>
              </div>

              <!-- Email -->
              <div>
                  <label class="block text-gray-300 mb-2 font-medium">Email</label>
                  <input type="email" name="email" id="editContactEmail" class="w-full p-3 rounded-lg bg-gray-800 text-white border border-gray-700 focus:outline-none focus:ring-2 focus:ring-green-400">
              </div>

              <!-- Telepon -->
              <div>
                  <label class="block text-gray-300 mb-2 font-medium">Telepon</label>
                  <input type="text" name="phone" id="editContactPhone" class="w-full p-3 rounded-lg bg-gray-800 text-white border border-gray-700 focus:outline-none focus:ring-2 focus:ring-green-400">
              </div>

              <!-- Footer Buttons -->
              <div class="flex justify-end gap-4 mt-6">
                  <button type="submit" class="bg-green-500 hover:bg-green-600 px-6 py-2 rounded-lg font-semibold flex items-center gap-2 transition-all duration-200 shadow-md hover:shadow-lg">
                      <i class="fa-solid fa-check"></i> Simpan
                  </button>
                  <button type="button" class="bg-gray-700 hover:bg-gray-600 px-6 py-2 rounded-lg font-semibold transition-all duration-200 shadow-md hover:shadow-lg close-modal">
                      Batal
                  </button>
              </div>
          </form>
      </div>
  </div>

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

/* Swiper navigation style */
.swiper-button-next, .swiper-button-prev {
  color: #22c55e; /* Hijau premium */
  transition: transform 0.3s ease;
}
.swiper-button-next:hover, .swiper-button-prev:hover {
  transform: scale(1.2);
}
.swiper-pagination-bullet {
  background-color: rgba(34,197,94,0.5);
  opacity:1;
}
.swiper-pagination-bullet-active {
  background-color: #22c55e;
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
document.addEventListener('DOMContentLoaded', function() {
    // ------------------------
    // FUNGSI UMUM TUTUP MODAL
    // ------------------------
    function closeModal(modal, content) {
        content.classList.add('scale-95', 'opacity-0');
        content.classList.remove('scale-100', 'opacity-100');
        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }, 300);
    }

    // ------------------------
    // GENERIC OPEN MODAL FUNCTION
    // ------------------------
    function openModal(modal, content) {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        setTimeout(() => {
            content.classList.remove('scale-95', 'opacity-0');
            content.classList.add('scale-100', 'opacity-100');
        }, 50);
    }

    // ------------------------
    // MODAL SLIDER
    // ------------------------
    const editSliderModal = document.getElementById('editSliderModal');
    const editSliderContent = document.getElementById('editSliderContent');
    const addSliderModal = document.getElementById('addSliderModal');
    const addSliderContent = document.getElementById('addSliderContent');

    window.openEditSlider = function(slider) {
        const form = document.getElementById('editSliderForm');
        form.action = `/slider/update/${slider.id}`;
        document.getElementById('editSliderTitle').value = slider.title ?? '';
        document.getElementById('editSliderSubtitle').value = slider.subtitle ?? '';
        document.getElementById('editSliderPreview').innerHTML = slider.image_url
            ? `<img src="${slider.image_url}" class="rounded-xl shadow-lg object-cover max-h-64 w-full md:w-80 border border-gray-700">`
            : '';
        openModal(editSliderModal, editSliderContent);
    }

    window.openAddSlider = function() {
        openModal(addSliderModal, addSliderContent);
    }

    // ------------------------
    // MODAL LAYANAN
    // ------------------------
    const editServiceModal = document.getElementById('editServiceModal');
    const editServiceContent = document.getElementById('editServiceContent');
    const addServiceModal = document.getElementById('addServiceModal');
    const addServiceContent = document.getElementById('addServiceContent');

    window.openEditServiceModal = function(service) {
        const form = document.getElementById('editServiceForm');
        form.action = `/layanan/update/${service.id}`;
        document.getElementById('editServiceName').value = service.name ?? '';
        document.getElementById('editServiceDescription').value = service.description ?? '';
        document.getElementById('editServicePreview').innerHTML = service.image
            ? `<img src="/storage/${service.image}" class="w-full h-44 object-cover rounded-xl mb-4">`
            : '';
        openModal(editServiceModal, editServiceContent);
    }

    window.openAddServiceModal = function() {
        openModal(addServiceModal, addServiceContent);
    }

    // ------------------------
    // MODAL HARGA
    // ------------------------
    const editPriceModal = document.getElementById('editPriceModal');
    const editPriceContent = document.getElementById('editPriceContent');
    const addPriceModal = document.getElementById('addPriceModal');
    const addPriceContent = document.getElementById('addPriceContent');

    window.openEditPriceModal = function(price) {
        const form = document.getElementById('editPriceForm');
        form.action = `/harga/update/${price.id}`;
        document.getElementById('editPriceTitle').value = price.title ?? '';
        document.getElementById('editPriceSubtitle').value = price.subtitle ?? '';
        document.getElementById('editPricePreview').innerHTML = price.image
          ? `<img src="${price.image}" class="w-full h-44 object-contain rounded-xl mb-4">`
          : '';
        openModal(editPriceModal, editPriceContent);
    }

    window.openAddPriceModal = function() {
        openModal(addPriceModal, addPriceContent);
    }

    // ------------------------
    // MODAL GALLERY
    // ------------------------
    const editGalleryModal = document.getElementById('editGalleryModal');
    const editGalleryContent = document.getElementById('editGalleryContent');
    const addGalleryModal = document.getElementById('addGalleryModal');
    const addGalleryContent = document.getElementById('addGalleryContent');

    window.openEditGalleryModal = function(gallery) {
        const form = document.getElementById('editGalleryForm');
        form.action = `/gallery/update/${gallery.id}`;
        document.getElementById('editGalleryCaption').value = gallery.caption ?? '';
        document.getElementById('editGalleryPreview').innerHTML = gallery.image
            ? `<img src="${gallery.image}" class="w-full h-44 object-cover rounded-xl mb-4">`
            : '';
        openModal(editGalleryModal, editGalleryContent);
    }

    // Preview gambar sebelum submit
    document.getElementById('addGalleryImage').addEventListener('change', function() {
        const preview = document.getElementById('addGalleryPreview');
        preview.innerHTML = '';
        const file = this.files[0];
        if(file){
            const reader = new FileReader();
            reader.onload = e => {
                preview.innerHTML = `<img src="${e.target.result}" class="w-full h-44 object-cover rounded-xl mb-4">`;
            }
            reader.readAsDataURL(file);
        }
    });

    // Submit form ketika tombol simpan diklik
    document.getElementById('submitGalleryBtn').addEventListener('click', function() {
        const form = document.getElementById('addGalleryForm');
        form.action = "{{ route('gallery.store') }}"; 
        form.method = "POST";
        form.submit();
    });

    window.openAddGalleryModal = function() {
        openModal(addGalleryModal, addGalleryContent);
    }

    // ------------------------
    // MODAL KONTAK
    // ------------------------
    const editContactModal = document.getElementById('editContactModal');
    const editContactContent = document.getElementById('editContactContent');
    const addContactModal = document.getElementById('addContactModal');
    const addContactContent = document.getElementById('addContactContent');

    window.openEditContactModal = function(contact) {
       const form = document.getElementById('editContactForm');
       form.action = `/contact/update/${contact.id}`;
       document.getElementById('editContactAddress').value = contact.address ?? '';
       document.getElementById('editContactEmail').value = contact.email ?? '';
       document.getElementById('editContactPhone').value = contact.phone ?? '';
       openModal(editContactModal, editContactContent);
    }

    window.openAddContactModal = function() {
        openModal(addContactModal, addContactContent);
    }

    // ------------------------
    // CLOSE MODAL UNTUK SEMUA
    // ------------------------
    document.querySelectorAll('.close-modal').forEach(btn => {
        btn.addEventListener('click', function() {
            const modal = btn.closest('.fixed');
            const content = modal.querySelector('div[id$="Content"]');
            closeModal(modal, content);
        });
    });

    [editSliderModal, addSliderModal, editServiceModal, addServiceModal,
     editPriceModal, addPriceModal, editGalleryModal, addGalleryModal,
     editContactModal, addContactModal].forEach(modal => {
        if(modal){
            modal.addEventListener('click', e => {
                if(e.target === modal){
                    const content = modal.querySelector('div[id$="Content"]');
                    closeModal(modal, content);
                }
            });
        }
    });
});

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

  function openModal(id) {
    const modal = document.getElementById(id);
    modal.classList.remove('hidden');
    setTimeout(() => {
      modal.firstElementChild.classList.remove('scale-95', 'opacity-0');
    }, 10); // animasi sedikit delay
  }

  // Fungsi tutup modal
  function closeModal(id) {
    const modal = document.getElementById(id);
    modal.firstElementChild.classList.add('scale-95', 'opacity-0');
    setTimeout(() => {
      modal.classList.add('hidden');
    }, 200); // sesuai durasi transition
  }
</script>


@endsection
