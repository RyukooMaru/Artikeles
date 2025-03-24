namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;


class CaptchaController extends Controller
{
    public function show(Request $request)
    {
        // Path ke folder gambar (asli ada di storage/app/public)
        $folder1 = storage_path('app/public/captcha/gambar1');
        $folder2 = storage_path('app/public/captcha/gambar2');

        // Ambil semua file gambar yang ada di folder
        $imageFiles1 = collect(File::files($folder1))->pluck('filename')->toArray();
        $imageFiles2 = collect(File::files($folder2))->pluck('filename')->toArray();

        // Validasi kalo folder kosong
        if (empty($imageFiles1) || empty($imageFiles2)) {
            return back()->withErrors(['msg' => 'Gambar tidak ditemukan!']);
        }

        // Ambil gambar random dari folder
        $gambar1 = $imageFiles1[array_rand($imageFiles1)];
        $gambar2 = $imageFiles2[array_rand($imageFiles2)];

        // Buat rotasi random buat gambar1
        $rotasiGambar1 = collect([45, 90, 135, 180, 225, 270, 315, 360])->random();

        // Simpan data buat nanti dicek rotasinya
        Session::put('captcha', [
            'gambar1' => $gambar1,
            'gambar2' => $gambar2,
            'rotation1' => $rotasiGambar1
        ]);

        // URL gambar buat dikirim ke blade
        $gambar1_url = asset('storage/captcha/gambar1/' . $gambar1);
        $gambar2_url = asset('storage/captcha/gambar2/' . $gambar2);

        return view('authes.captcha-card', compact('gambar1_url', 'gambar2_url', 'rotasiGambar1'));
    }


    public function check(Request $request)
    {
        $rotation1 = Session::get('captcha.rotation1');
        $rotation2 = $request->input('rotation2');

        if (abs(($rotation2 % 360) - ($rotation1 % 360)) < 1e-5) {
            return redirect()->route('captcha.show')->with('success', 'Rotasi sesuai! Anda berhasil.');
        }

        return redirect()->route('captcha.show')->with('error', 'Rotasi tidak sesuai. Coba lagi!');
    }
}
