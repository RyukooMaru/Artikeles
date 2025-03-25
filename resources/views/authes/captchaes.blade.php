<div id="captcha-form" class="login-card hidden">
  <h2>CAPTCHA</h2>
  <form method="POST" action="{{ route('captcha.action') }}">
    @csrf
    <!-- Tambah elemen CAPTCHA di sini -->
    <div class="captcha-img">
      <img src="{{ asset('captcha-image.jpg') }}" alt="Captcha Image">
    </div>
    <div class="input-group">
      <label for="captcha">Masukkan kode</label>
      <input type="text" name="captcha" id="captcha" required>
    </div>

    <!-- Pesan flash error/success -->
    @if(session('captchaes'))
      <div class="feedback error">
        {{ session('captchaes') }}
      </div>
    @endif
    <button type="submit" class="btn-login">Verifikasi</button>
  </form>

  <p class="--link">
    Gagal verifikasi? <a href="#" onclick="toggleForm('register')">Kembali ke register</a>
  </p>
</div>
