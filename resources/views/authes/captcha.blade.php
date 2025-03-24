@extends('layouts.app')

@section('content')

<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
  <div class="card p-4" style="width: 500px;">
    <h4 class="mb-3 text-center">Captcha Rotasi Gambar</h4>

    <div class="mb-2 text-center text-muted">
      <strong>Putar gambar 2 agar arahnya sama seperti gambar 1!</strong>
    </div>

    {{-- Pesan sukses --}}
    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Pesan error --}}
    @if(session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="row text-center">
      <!-- Gambar 1 -->
      <div class="col-6">
        <p>Gambar 1</p>
        <img id="gambar1" src="{{ $gambar1_url }}" alt="Gambar 1" style="width: 100px; transform: rotate({{ $rotasiGambar1 }}deg); transition: transform 0.5s;">
      </div>

      <!-- Gambar 2 -->
      <div class="col-6">
        <p>Gambar 2</p>
        <img id="gambar2" src="{{ $gambar2_url }}" alt="Gambar 2" style="width: 100px; transition: transform 0.5s;">
      </div>
    </div>

    <div class="d-flex justify-content-center mt-4 gap-2">
      <button class="btn btn-primary" onclick="rotateImage(-45)">⟲ Kiri</button>
      <button class="btn btn-primary" onclick="rotateImage(45)">Kanan ⟳</button>
    </div>

    <!-- Form submit -->
    <form method="POST" action="{{ route('captcha.check') }}" id="captcha-form">
      @csrf
      <input type="hidden" name="rotation2" id="rotation2" value="0">
      <div class="text-center mt-3">
        <button type="submit" class="btn btn-success">Cek Pencocokan</button>
      </div>
    </form>

    <div class="text-center mt-3">
      <small id="timer" class="text-danger fw-bold">Waktu Penyelesaian: 16 detik</small>
    </div>
  </div>
</div>

<script>
  let currentRotation = 0;
  let timeLeft = 16;

  // Fungsi rotasi gambar 2
  function rotateImage(degrees) {
    currentRotation = (currentRotation + degrees + 360) % 360;
    document.getElementById('gambar2').style.transform = 'rotate(' + currentRotation + 'deg)';
    document.getElementById('rotation2').value = currentRotation;
  }

  // Timer countdown
  const timerElement = document.getElementById('timer');
  const countdown = setInterval(() => {
    timeLeft--;
    if (timeLeft <= 0) {
      clearInterval(countdown);
      alert('Waktu habis! Coba lagi.');
      window.location.reload();
    }
    timerElement.textContent = `Waktu Penyelesaian: ${timeLeft} detik`;
  }, 1000);
</script>

@endsection
