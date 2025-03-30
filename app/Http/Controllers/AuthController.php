<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showAuthPage()
    {
        if (session()->has('usersid')) {
            return view('authes.authes')->with('form', 'captcha');
        }
    
        return view('authes.authes');
    }
    public function showMain()
    {
        return view('appes.artikeles');
    }
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $username = $request->input('username');
        $password = $request->input('password');

        $user = User::whereRaw('BINARY `username` = ?', [$username])->first();
        if ($user && Hash::check($password, $user->password)) {
            session([
                'isLoggedIn' => true,
                'userid' => $user->userid, 
                'username' => $user->username,
                'nameuse' => $user->nameuse,
                'improfil' => $user->improfil,
            ]);
            
            return redirect('/artikeles')->with('success', 'Berhasil login!');
        }
        return redirect()->route('authes')
            ->with('error', 'Username atau Password salah!')
            ->with('form', 'login');
    }
    public function logout()
    {
        session()->flush();
        return redirect()->route('authes')->with('success', 'Berhasil logout!')->with('form', 'login');
    }

    public function register(Request $request)
    {
        $username = $request->input('username');
        $nameuse = $request->input('nameuse');
        $email = $request->input('email');
        $password = $request->input('password');
        $password_confirmation = $request->input('password_confirmation');
        $defaultImage = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAMwAAADACAMAAAB/Pny7AAAAMFBMVEXk5ueutLfb3t+nrrHn6eqrsbTh4+S7wMPT1tixt7rKztDBxsi3vL/q7O3Y293Q09Wdj+FKAAAFPklEQVR4nO2c25LbIAxADRZgrv7/vy042SabOyBH8g7npdP2xWckQBDQNA0Gg8FgMBgMBoPBYDAYDAaDwWAwGAwGg92BzKRlQevtL0cFQMvFOe/NhnduSfqQPtlk8SZYdY0Nxi86HswH4uKDFUrcUoR8OlJ4skoQD0zOPsKG5TDRick+E/kvZNMhdECb+Y1KsZmNZm8DsKp3YfkZPSv1x74BtP8gLGeYBwdS+NxlGzl8bT5OsUuqLRNXHVensuk4pmtOg0uGpQ24FpViQ/3l98Da6CLEyi00sNhmGcFsTgMZmgbMhrLM1hvf7lJWT+rP/8Vas1Y+sGE0CYDsictmwyfRwPTKqBCpJc7A0pdkW2i4zM+xW6VAbXEiuv7AlCKNRaIBgkrGUnsU4to7+s9wCA101DHXqEBtUqYyHBfBoeAEj+WiPLmM7qgwb2SCJHaBFWnIZCx1nkFXufwb5WldJt1dll3JGNo8gxTQXHKe0W45O3b+D1C0gwbajpeeyRDv0RDHf5kBNKWLRBz/ZQYg3XAmg+giRJCEMriTmaA9QYOEt/7Ty+CVzBtqIZXBHP9Fhs6l/LqEKjP/JRnayCCnGW1k/tSYwZ7NxjqDJoN2ArBhKcuZXGhiutDWZpP+S1sAzPOMsjmjlcHdaRJvm3t+Mb+Hss7M9PxkfkdIpC6ohwDE47/8bIbmUm440cpg1gCB/NoJoC2byhBnGWqe0f8OCBIrz2gLsxMRK88MvQvCxZkzxCvmiYhzEBg4uOTSGeWGBvm8fCJilDRsrjVNCLeaeMRlwtgIzPRrzIXOn2mUZROYTOqMDPV1ht90JRrxDvOOnpMN8ssMt0D77QYG1fIdrRto+vs/j2jbpjF93dRUcSrBoPB/CDTY8Llqfkt1lcakVH5M9E9fAd+jBP1FxpfA+nFwVGC2Vt4D8rPg5LBwHfpXwLSYt881lfJ8X2j+AvRi5lc6SpmF7yx2C+jk1ROf/O8+8StgXqNXc++j5jnQ/qLUCkzJ2zlT2meUP2d7lJHyEIhxksvqnFsXOcVDdGd4CfyH+ksa2b5cn5HnJjonzv95DPKn5u9PKSeX9yYEW6bibeGxIRjv3ZpSVpu4GxUPmYpEKPOWul87T1OBsiY7LUlyNdpE1hwL+2yB+S2VlXKcXJL8ki5CFjFBPAjGS6WT0MRolotRuq0rU4XHlVAeS3n5YXGiCVG70pWp69xMWOvpWwRBRLtzrqwj7a8VJyc+GO0f68yGbIuTt2GIJmedQNPzSL7es7Qyi0V/txgt9fAuKptOWL94xllUKg5h6lFh/dZGFKR724yt10aY9RuFAUwO98bsMx0vd19Howy7ZtiVjnX7LjsQ/d4ZdmUjwp7BAY38Kuutzn5nnrB8KcMuzH6fNQfAdVWTbahdLqFXtS7EtBH4z1BAftIdcxebeUVONXjftHRHHdxOezF9fehfgzoNxJUwLgWFZxNX0rig2sBCHBdEG9KxfwHlbn1X60JMEK4+fdZ9+SsgvOJGaV6Gguq9ko79RLYL1dehEiT5pHzN3DUJ9LdhxKXnJjdOtz9Eum7Z8oqL6GmDGJkl2UbjJQJIDF2UaQsN0lMSbJrmgIjaIAsN1fQAitu0/INtqGqQXy3j0dLUEfdxPCKq/m0qm8r/nvqdDW5/PFTq3w7g9pPApfbCfc4y6k9+Tm3rQFb7mFuq+wag9sbApvIwHbdxITZz1aBhPWRKq/qawLAsmC/UDRqMTv97UrfScNsv32BrZDgvmQVVJWNm3lR125HMqVs1gTdVLoPBYDAYDAZH4R8eaVEbhZaf7QAAAABJRU5ErkJggg==';
        $existingUser = User::where('username', $username)->first();

        if ($existingUser) {
            return redirect()->route('authes')->with('error', 'Username sudah digunakan!')->with('form', 'register')->withInput();
        }
        if (mb_strlen($username) > 16) {
            return redirect()->route('authes')->with('error', 'Username tidak boleh lebih dari 16 karakter!')->with('form', 'register')->withInput();
        }
        if (mb_strlen($nameuse) > 16) {
            return redirect()->route('authes')->with('error', 'Nama Artikeles tidak boleh lebih dari 16 karakter!')->with('form', 'register')->withInput();
        }
        if ($password !== $password_confirmation) {
            return redirect()->route('authes')->with('error', 'Password dan Konfirmasi Password tidak cocok!')->with('form', 'register')->withInput();
        }
        if (!session()->has('usersid')) {
            $randominputes = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            session([
                'userscapt' => True,
                'captcha_verified' => $randominputes,
                'username' => $username,
                'nameuse' => $nameuse,
                'email' => $email,
                'password' => $password,
                'improfil' => $defaultImage,

            ]);
            return redirect()->route('authes')->with('captchaes', 'Selesaikan captcha terlebih dahulu!.')->with('form', 'captcha')->withInput();
        } else {
            return redirect()->route('authes')->with('registerError', 'Gagal membuat akun!.')->with('form', 'register')->withInput();
        }
        return redirect()->route('authes')->with('registerError', 'Gagal membuat akun!.')->with('form', 'register')->withInput();
    }
}

