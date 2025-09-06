<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Layanan;
use App\Models\Price;
use App\Models\Gallery;
use App\Models\Contact;
use App\Models\Event;
use App\Models\Pelayanan;


class ProfilController extends Controller
{
    public function index()
    {
        // Data tabel
        $sliders = Slider::all();
        $layanan = Layanan::all();
        $prices = Price::all();
        $galleries = Gallery::all();
        $contact = Contact::first();

        // Data About dari JSON
        $path = 'about.json';
        if (Storage::exists($path)) {
            $data = json_decode(Storage::get($path), true);
        } else {
            $data = ['gambar' => '', 'deskripsi' => ''];
        }

        // Kirim semua data ke view
        return view('compro.home', compact(
            'sliders', 'layanan', 'prices', 'galleries', 'contact', 'data'
        ));
    }

    public function edit()
    {
        // Data tabel
        $sliders = Slider::all();
        $layanan = Layanan::all();
        $prices = Price::all();
        $galleries = Gallery::all();
        $contact = Contact::first();

        // Data About dari JSON
        $path = 'about.json';
        if (Storage::exists($path)) {
            $data = json_decode(Storage::get($path), true);
        } else {
            $data = ['gambar' => '', 'deskripsi' => ''];
        }

        // Kirim semua data ke view
        return view('admin.compros.edit', compact(
            'sliders', 'layanan', 'prices', 'galleries', 'contact', 'data'
        ));
    }


    public function storeSlider(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $slider = new Slider();
        $slider->title = $request->title;
        $slider->subtitle = $request->subtitle;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('sliders', 'public');
            $slider->image = $path;
        }

        $slider->save();

        return back()->with('success', 'Slider berhasil ditambahkan!');
    }

    public function updateSlider(Request $request, $id)
    {
        $slider = Slider::findOrFail($id); // ganti $sliders -> $slider

        $slider->title = $request->title;
        $slider->subtitle = $request->subtitle;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('sliders', 'public');
            $slider->image = $path;
        }

        $slider->save();
        return back()->with('success', 'Slider berhasil diperbarui!');
    }

    public function storeLayanan(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048'
        ]);

        $layanan = new Layanan();
        $layanan->name = $request->name;
        $layanan->description = $request->description;

        if ($request->hasFile('image')) {
            $layanan->image = $request->file('image')->store('layanan', 'public');
        }

        $layanan->save();
        return back()->with('success', 'Layanan berhasil ditambahkan!');
    }

    public function updateLayanan(Request $request, $id)
    {
        $layanan = Layanan::findOrFail($id);

        $layanan->name = $request->name;
        $layanan->description = $request->description;

        if ($request->hasFile('image')) {
            $file = $request->file('image')->store('uploads/layanan', 'public');
            $layanan->image = $file;
        }

        $layanan->save();

        return redirect()->back()->with('success', 'Layanan berhasil diupdate');
    }

    public function storePrice(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $price = new price();
        $price->title = $request->title;
        $price->subtitle = $request->subtitle;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('price', 'public');
            $price->image = $path;
        }

        $price->save();
        // dd($request->all());

        return back()->with('success', 'Price berhasil ditambahkan!');
    }

    public function updatePrice(Request $request, $id)
    {
        $price = Price::findOrFail($id);

        $price->title = $request->title;
        $price->subtitle = $request->subtitle;

        if ($request->hasFile('image')) {
            $file = $request->file('image')->store('uploads/prices', 'public');
            $price->image = $file;
        }

        $price->save();

        return redirect()->back()->with('success', 'Price berhasil diupdate');
    }

    public function storeGallery(Request $request)
{
    $request->validate([
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        'caption' => 'nullable|string|max:255',
    ]);

    // Simpan data baru
    $galleries = new Gallery();
    $galleries->caption = $request->caption;

    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('galleries', 'public');
        $galleries->image = $path;
    }

    $galleries->save();

    // Ambil ulang semua data gallery dengan asset()
    $allGalleries = Gallery::all()->map(function ($item) {
        return [
            'id' => $item->id,
            'caption' => $item->caption,
            'image' => $item->image ? asset('storage/' . $item->image) : null, // ✅ storage path
        ];
    });

    // Bisa dipakai 2 cara:
    // 1. Kalau redirect biasa:
    return back()->with('success', 'Gallery berhasil ditambahkan!')->with('galleries', $allGalleries);

    // 2. Kalau pakai AJAX, lebih cocok return JSON:
    // return response()->json([
    //     'success' => true,
    //     'message' => 'Gallery berhasil ditambahkan!',
    //     'galleries' => $allGalleries,
    // ]);
}


    public function updateGallery(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);

        $gallery->caption = $request->caption;

        if ($request->hasFile('image')) {
            $file = $request->file('image')->store('uploads/galleries', 'public');
            $gallery->image = $file;
        }

        $gallery->save();

        return redirect()->back()->with('success', 'Gallery berhasil diupdate');
    }

    public function storeContact(Request $request)
    {
        // Validasi request
        $request->validate([
            'address' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
        ]);

        // Buat instance model Contact
        $contact = new Contact();
        $contact->address = $request->address;
        $contact->phone = $request->phone;
        $contact->email = $request->email;

        $contact->save();

        return back()->with('success', 'Kontak berhasil ditambahkan!');
    }

    // contoh update kontak
    public function updateContact(Request $request)
    {
        $contact = Contact::first();
        $contact->address = $request->address;
        $contact->phone = $request->phone;
        $contact->email = $request->email;
        $contact->save();

        return back()->with('success', 'Kontak berhasil diperbarui!');
    }
    public function save(Request $request)
    {
        $request->validate([
            'deskripsi' => 'required|string|max:5000',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $path = 'about.json';

        // Ambil data lama
        $data = ['gambar' => '', 'deskripsi' => ''];
        if (Storage::exists($path)) {
            $data = json_decode(Storage::get($path), true);
        }

        // Update deskripsi
        $data['deskripsi'] = $request->deskripsi;

        // Upload gambar baru jika ada
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/tentang', $filename);
            $data['gambar'] = 'storage/tentang/' . $filename;
        }

        // Simpan JSON
        Storage::put($path, json_encode($data, JSON_PRETTY_PRINT));

        return redirect()->back()->with('success', 'Tentang Kami berhasil disimpan!');
    }

    public function events()
    {
        $events = Event::latest()->get();

        // Halaman public (tanpa tombol admin)
        return view('compro.event', compact('events'));
    }

    public function manageEvents()
    {
        $events = Event::latest()->get();

        // Halaman admin (ada tombol tambah/edit/hapus)
        return view('admin.compros.editevent', compact('events'));
    }

    public function storeEvent(Request $request)
        {
            $request->validate([
                'judul' => 'required',
                'deskripsi' => 'required',
                'tanggal_mulai' => 'required|date',
                'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
                'lokasi' => 'nullable|string',
                'gambar' => 'nullable|image|max:2048'
            ]);

            $data = $request->except('_token');

            if ($request->hasFile('gambar')) {
                $data['gambar'] = $request->file('gambar')->store('events', 'public');
            }

            Event::create($data);

            return back()->with('success', 'Event berhasil ditambahkan');
        }

        public function updateEvent(Request $request, Event $event)
        {
            $request->validate([
                'judul' => 'required',
                'deskripsi' => 'required',
                'tanggal_mulai' => 'required|date',
                'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
                'lokasi' => 'nullable|string',
                'gambar' => 'nullable|image|max:2048'
            ]);

            $data = $request->only(['judul','deskripsi','tanggal_mulai','tanggal_selesai','lokasi']);

            if ($request->hasFile('gambar')) {
                // hapus gambar lama
                if($event->gambar && \Storage::disk('public')->exists($event->gambar)){
                    \Storage::disk('public')->delete($event->gambar);
                }

                // simpan gambar baru
                $data['gambar'] = $request->file('gambar')->store('events', 'public');
            }

            $event->update($data);

            return back()->with('success', 'Event berhasil diupdate');
        }


        public function destroyEvent(Event $event)
        {
            $event->delete();
            return back()->with('success', 'Event berhasil dihapus');
        }


    public function pelayanan()
    {
        $makanan = Pelayanan::where('kategori', 'Makanan')->get();
        $minuman = Pelayanan::where('kategori', 'Minuman')->get();
        $rokok   = Pelayanan::where('kategori', 'Rokok')->get();

        $pelayanans = Pelayanan::all();

        return view('compro.pelayanan', compact('makanan', 'minuman', 'rokok', 'pelayanans'));
    }

    public function managePelayanan()
    {
        $makanan = Pelayanan::where('kategori', 'Makanan')->get();
        $minuman = Pelayanan::where('kategori', 'Minuman')->get();
        $rokok   = Pelayanan::where('kategori', 'Rokok')->get();

        $pelayanans = Pelayanan::all();

        return view('admin.compros.editpelayanan', compact('makanan', 'minuman', 'rokok', 'pelayanans'));
    }

    public function storePelayanan(Request $request)
    {
        $request->validate([
            'nama'     => 'required|string|max:255',
            'kategori' => 'required|in:Makanan,Minuman,Rokok',
            'harga'    => 'required|numeric',
            'gambar'   => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $data = $request->only('nama','kategori','harga');

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('pelayanan', 'public');
        }

        Pelayanan::create($data);

        return back()->with('success', $request->kategori.' berhasil ditambahkan');
    }

    public function updatePelayanan(Request $request, Pelayanan $pelayanan)
    {
        $request->validate([
            'nama'     => 'required|string|max:255',
            'kategori' => 'required|in:Makanan,Minuman,Rokok',
            'harga'    => 'required|numeric',
            'gambar'   => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $data = $request->only('nama','kategori','harga');

        if ($request->hasFile('gambar')) {
            if ($pelayanan->gambar && Storage::disk('public')->exists($pelayanan->gambar)) {
                Storage::disk('public')->delete($pelayanan->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('pelayanan', 'public');
        }

        $pelayanan->update($data);

        return back()->with('success', $request->kategori.' berhasil diperbarui');
    }

    public function destroyPelayanan(Pelayanan $pelayanan)
    {
        $kategori = $pelayanan->kategori;

        if ($pelayanan->gambar && Storage::disk('public')->exists($pelayanan->gambar)) {
            Storage::disk('public')->delete($pelayanan->gambar);
        }

        $pelayanan->delete();

        return back()->with('success', $kategori.' berhasil dihapus');
    }

    }
