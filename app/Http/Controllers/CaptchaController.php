<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

class CaptchaController extends Controller
{
    public function show(Request $request)
    {
        Session::put('form', 'captcha');
        // Path ke folder gambar di public
        $folder1 = public_path('Captcha/gambar 1');
        $folder2 = public_path('Captcha/gambar 2');

        $imageFiles1 = collect(File::files($folder1))->pluck('filename')->toArray();
        $imageFiles2 = collect(File::files($folder2))->pluck('filename')->toArray();

        if (empty($imageFiles1) || empty($imageFiles2)) {
            return back()->withErrors(['msg' => 'Gambar tidak ditemukan!']);
        }

        $gambar1 = $imageFiles1[array_rand($imageFiles1)];
        $gambar2 = $imageFiles2[array_rand($imageFiles2)];

        $rotasiGambar1 = collect([45, 90, 135, 180, 225, 270, 315, 360])->random();

        Session::put('captcha', [
            'gambar1' => $gambar1,
            'gambar2' => $gambar2,
            'rotation1' => $rotasiGambar1
        ]);

        $gambar1_url = asset('Captcha/gambar 1/' . $gambar1);
        $gambar2_url = asset('Captcha/gambar 2/' . $gambar2);

        return view('authes.captcha', compact('gambar1_url', 'gambar2_url', 'rotasiGambar1'));
        
    }

    public function check(Request $request)
    {
        $rotation1 = Session::get('captcha.rotation1');
        $rotation2 = $request->input('rotation2');

        if (abs(($rotation2 % 360) - ($rotation1 % 360)) < 1e-5) {
            return redirect()->route('login')->with([
                'success' => 'Rotasi sesuai! Anda berhasil.',
                'form' => 'login' // Kembali ke form login setelah berhasil
            ]);
        }

        return redirect()->route('captcha.show')->with('error', 'Rotasi tidak sesuai. Coba lagi!');
    }
    

}
