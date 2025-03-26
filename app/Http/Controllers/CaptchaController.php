<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use App\Models\Users;

class CaptchaController extends Controller
{

    public function hapus(Request $request)
    {
        if (!session()->has('userid')) {
            return redirect()->back()->with('message', 'Gagal menghapus akun. Userid tidak ditemukan di session.');
        }

        $userid = session('userid');

        $deleted = Users::where('userid', $userid)->delete();

        if ($deleted) {
            session()->flush(); // Hapus semua session
            return redirect(url('/authes'))->with('message', 'Gagal registrasi, coba lagi!.')->with('form', 'register');
        }
    }

    public function generateCaptcha()
    {
        // Folder tempat menyimpan gambar CAPTCHA
        $imageDir1 = public_path('captcha/gambar1');
        $imageDir2 = public_path('captcha/gambar2');

        // Ambil gambar acak dari masing-masing folder
        $imageFiles1 = glob($imageDir1 . '/*.{jpg,jpeg,png}', GLOB_BRACE);
        $imageFiles2 = glob($imageDir2 . '/*.{jpg,jpeg,png}', GLOB_BRACE);

        if (!$imageFiles1 || !$imageFiles2) {
            return back()->with('error', 'Gambar CAPTCHA tidak ditemukan.');
        }

        $randomImage1 = $imageFiles1[array_rand($imageFiles1)];
        $randomImage2 = $imageFiles2[array_rand($imageFiles2)];

        // Rotasi acak untuk gambar pertama
        $rotation1 = [45, 90, 135, 180, 225, 270, 315, 360][array_rand([45, 90, 135, 180, 225, 270, 315, 360])];

        // Simpan data CAPTCHA di session
        Session::put('captcha', [
            'image1' => basename($randomImage1),
            'image2' => basename($randomImage2),
            'rotation1' => $rotation1,
            'rotation2' => 0, // Default rotasi gambar2 (user bisa ubah)
        ]);

        return back();
    }

    public function rotateCaptcha(Request $request)
    {
        $currentCaptcha = Session::get('captcha');

        if (!$currentCaptcha) {
            return back()->with('error', 'Silakan generate CAPTCHA terlebih dahulu.');
        }

        // Update rotasi gambar kedua
        $newRotation = ($currentCaptcha['rotation2'] + 45) % 360;
        $currentCaptcha['rotation2'] = $newRotation;

        Session::put('captcha', $currentCaptcha);

        return back();
    }

    public function validateCaptcha()
    {
        $captcha = Session::get('captcha');

        if (!$captcha) {
            return back()->with('error', 'CAPTCHA tidak tersedia.');
        }

        if ($captcha['rotation1'] == $captcha['rotation2']) {
            Session::forget('captcha');
            return back()->with('success', 'CAPTCHA berhasil! Anda bisa melanjutkan.');
        } else {
            return back()->with('error', 'Rotasi tidak sesuai! Silakan coba lagi.');
        }
    }
}
