<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        $services = Service::all();
        $prices = Price::all();
        $galleries = Gallery::all();
        $contact = Contact::first();

        return view('profile', compact('data'));
    }

    public function updateSlider(Request $request, $id)
    {
        $slider = Slider::findOrFail($id);
        $slider->title = $request->title;
        $slider->description = $request->description;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('sliders', 'public');
            $slider->image = $path;
        }

        $slider->save();
        return back()->with('success', 'Slider berhasil diperbarui!');
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


    // contoh update kontak
    public function updateContact(Request $request)
    {
        $contact = Contact::first();
        $contact->alamat = $request->alamat;
        $contact->telepon = $request->telepon;
        $contact->email = $request->email;
        $contact->save();

        return back()->with('success', 'Kontak berhasil diperbarui!');
    }

}

