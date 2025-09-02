<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Layanan;
use App\Models\Price;
use App\Models\Gallery;
use App\Models\Contact;

class ProfilController extends Controller
{
        public function index()
    {
        $sliders = Slider::all();
        $layanan = Layanan::all();
        $prices = Price::all();
        $galleries = Gallery::all();
        $contact = Contact::first();

                        // dd($galleries);

        return view('compro.home', compact('sliders','layanan','prices','galleries','contact'));
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
}
