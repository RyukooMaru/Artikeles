<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CaptchaController extends Controller
{
    public function verifikasiCaptcha(Request $request)
    {
        return redirect()->route('authes')->with('error', 'Gagal Registrasi!')->with('form', 'register')->withInput();
    }
    public function getRandomImages()
    {
        $path1 = public_path('captcha/gambar1');
        $path2 = public_path('captcha/gambar2');
        $files1 = File::files($path1);
        $files2 = File::files($path2);
        $randomImage1 = $files1[array_rand($files1)]->getFilename();
        $randomImage2 = $files2[array_rand($files2)]->getFilename();
        $rotations = [0, 45, 90, 135, 180, 225, 270];
        $rotation1 = $rotations[array_rand($rotations)];
        do {
            $rotation2 = $rotations[array_rand($rotations)];
        } while ($rotation2 === $rotation1);
        return response()->json([
            'image1' => asset("captcha/gambar1/$randomImage1"),
            'image2' => asset("captcha/gambar2/$randomImage2"),
            'rotation1' => $rotation1,
            'rotation2' => $rotation2
        ]);
    }
    public function hapus(){
        session()->flush();
        return redirect()->route('authes')->with('error', 'Gagal Registrasi!')->with('form', 'register')->withInput();
    }
}
