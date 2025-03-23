<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login & Register</title>
  <link rel="stylesheet" href="{{ asset('css/authes.css') }}">
</head>

<body class="timess" data-show-form="{{ session('showForm') ?? session('form') ?? ($errors->any() ? 'register' : 'login') }}">
  <div class="locardes">
  <div class="cardbg">
    <!-- LEFT SIDE (IMAGE) -->
    <div class="locard-left">
      <img src="https://via.placeholder.com/500x500" alt="Image" />
    </div>
    <!-- RIGHT SIDE (FORM) -->
    <div class="locard-right">
      <!-- LOGIN FORM -->
      <div id="login-form" class="login-card">
        <h2>LOGIN</h2>

        <form method="POST" action="{{ route('login.action') }}">
          @csrf

          <div class="input-group">
            <label for="username-login">Username</label>
            <input type="text" id="username-login" name="username" placeholder="Masukkan username" required>
          </div>

          <div class="input-group">
            <label for="password-login">Password</label>
            <input type="password" id="password-login" name="password" placeholder="Masukkan password" required>
          </div>
          @if(session('success') && session('form') === 'login')
            <div class="feedback success">
              {{ session('success') }}
            </div>
          @endif

          @if(session('error') && (session('form') === 'login' || !session('form')))
            <div class="feedback error">
              {{ session('error') }}
            </div>
          @endif  

          <button type="submit" class="btn-login">Login</button>
        </form>

        <p class="--link">
          Belum punya akun?
          <a href="#" onclick="toggleForm('register')">Daftar</a>
        </p>
      </div>

      <!-- REGISTER FORM -->
      <div id="register-form" class="login-card hidden">
        <h2 class="registertxt">REGISTER</h2>
        <form method="POST" action="{{ route('register.action') }}">
          @csrf
          <div class="input-group">
            <label for="username-register">Username</label>
            <input type="text" name="username" value="{{ old('username') }}" id="username-register" placeholder="Masukkan username" required>
          </div>

          <div class="input-group">
            <label for="nameuse">Nama Artikeles</label>
            <input type="text" name="nameuse" value="{{ old('nameuse') }}" id="nameuse" placeholder="Masukkan nama artikeles" required>
          </div>

          <div class="input-group">
            <label for="password-register">Password</label>
            <input type="password" name="password" value="{{ old('password') }}" id="password-register" placeholder="Masukkan password" required minlength="6">
          </div>

          <div class="input-group">
            <label for="password_confirmation">Masukkan Ulang Password</label>
            <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" id="password_confirmation" placeholder="Masukkan ulang password" required minlength="6">
          </div>

          {{-- Di Register Form --}}
          @if(session('registerError') && session('form') === 'register')
            <div class="feedback error">
              {{ session('registerError') }}
            </div>
          @endif
          @if(session('success') && session('form') === 'register')
            <div class="feedback success">
              {{ session('success') }}
            </div>
          @endif
          @if(session('captchaes') && session('form') === 'captcha')
            <div class="feedback error">
              {{ session('captchaes') }}
            </div>
          @endif
          
          @if(session('captchaesss') && session('form') === 'captcha')
            <button type="button" class="btn-ver" onclick="verifyCaptcha()">
          @endif
            <span id="captcha-not-verified" style="display: inline;">🔒 Verifikasi Captcha</span>
            <span id="captcha-verified" style="display: none;">✅ Captcha Terverifikasi</span>
          </button>
          <button type="submit" class="btn-login">Buat Akun</button>
        </form>
            <p class="--link">  
              Sudah punya akun?
              <a href="#" onclick="toggleForm('login')">Login</a>
            </p>
          </div>
          
        </div>
        </div>
      </div>

  <footer class="footeresauth">
    <p>&copy; {{ date('Y') }} Artikeles by Kelompok 10 tapi aku sendiri.</p>
  </footer>
  <script src="{{ asset('js/authes.js') }}"></script>
</body>

</html>
