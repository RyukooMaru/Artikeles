<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buates;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BuatesController extends Controller
{
    // Menampilkan halaman buat artikel
    public function buat()
    {
        if (!session('isLoggedIn')) {
            return redirect()->route('authes');
        }

        return view('appes.buates'); // Halaman form buat artikel
    }

    // Simpan artikel baru
    public function simpan(Request $request)
    {
        if (!session('isLoggedIn')) {
            return redirect()->route('authes');
        }

        // Validasi inputan form
        $validator = Validator::make($request->all(), [
            'judul'  => 'required|string|max:255',
            'konten' => 'required|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Generate SEO-friendly strings
        $judul = $request->judul;
        $konten = $request->konten;

        $lseo = Str::slug($judul);         // Buat slug judul, contoh: "Belajar Laravel" => "belajar-laravel"
        $kseo = Str::words(strip_tags($konten), 20, '...'); // Ambil 20 kata pertama dari konten (buat SEO)

        // Buat artikel baru
        Buates::create([
            'userid'  => session('id'), // ambil user id dari session
            'judul'   => $judul,
            'lseo'    => $lseo,
            'kseo'    => $kseo,
            'konten'  => $konten,
            'deltime' => null, // default null (jika nanti mau soft-delete)
            'delmode' => 0,    // default aktif
        ]);

        return redirect()->route('appes.artikeles')->with('success', 'Artikel berhasil dibuat!');
    }
}
