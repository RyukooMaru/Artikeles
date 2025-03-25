<div id="captcha-form" class="login-card hidden">
  <h3>CAPTCHA Verification</h3>

  @if(session('error'))
      <p style="color: red;">{{ session('error') }}</p>
  @endif

  @if(session('success'))
      <p style="color: green;">{{ session('success') }}</p>
  @endif

  @php
      $captcha = session('captcha');
  @endphp

  @if($captcha)
      <div style="display: flex; justify-content: space-between; align-items: center;">
          <!-- Gambar 1 -->
          <div>
              <p>Gambar 1 (Patokan)</p>
              <img src="{{ asset('captcha/gambar1/' . $captcha['image1']) }}" 
                  style="width: 100px; transform: rotate({{ $captcha['rotation1'] }}deg);">
          </div>

          <!-- Gambar 2 (User bisa ubah rotasinya) -->
          <div>
              <p>Gambar 2</p>
              <img src="{{ asset('captcha/gambar2/' . $captcha['image2']) }}" 
                  style="width: 100px; transform: rotate({{ $captcha['rotation2'] }}deg);">
          </div>
      </div>

      <!-- Tombol Rotate -->
      <form method="POST" action="{{ route('captcha.rotate') }}">
          @csrf
          <button type="submit">Putar Gambar 2</button>
      </form>

      <!-- Tombol Cek CAPTCHA -->
      <form method="POST" action="{{ route('captcha.validate') }}">
          @csrf
          <button type="submit">Cek Pencocokan</button>
      </form>
  @else
      <form method="GET" action="{{ route('captcha.generate') }}">
          <button type="submit">Generate CAPTCHA</button>
      </form>
  @endif

  <form method="POST" action="{{ route('hapus.request') }}">
    @csrf
    <button type="submit" class="close-btn">X</button>
  </form>
</div>