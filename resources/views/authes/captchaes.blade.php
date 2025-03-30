<div id="captcha-form" class="captcha-card hidden">
    <h2>CAPTCHA</h2>
    <form method="POST" action="{{ route('verifikasikan.captcha') }}">
        @csrf
        <input type="hidden" name="rotasi1" id="rotasi1">
        <input type="hidden" name="rotasi2" id="rotasi2">
        <div id="img-rotate" class="img-rot">
            <img src="" id="img-rotate1" class="img-rotasi">
            <img src="" id="img-rotate2" class="img-rotasi">
        </div>
        <button type="button" class="btn-rotasi" id="rotasi-kiri"><</button>
        <button type="button" class="btn-rotasi" id="rotasi-kanan">></button>
        <button type="submit" class="btn-login">COCOKAN</button>
    </form>
    <form method="GET" action="{{ route('batal.captcha') }}">
        <button class="close-btn">x</button>
    </form>
</div>

<div id="captcha-form1" class="captcha-card hidden">
    <h2>CODE CAPTCHA</h2>
    <form method="POST" action="">
        <div class="input-group">
            <label for="kode-verifikasi">Kode verifikasi</label>
            <input type="integer" name="captcha_verified" id="kode-verifikasi" placeholder="Masukkan kode verifikasi" required minlength="6">
        </div>
        @if(session('captchaupdate') && session('form') === 'captcha1')
            <div class="feedback error">
                {{ session('captchaupdate') }}
            </div>
        @endif
        <button type="submit" class="btn-login">VERIFIKASI</button>
    </form>
    <form method="GET" action="{{ route('batal.captcha') }}">
        @csrf
        <button class="close-btn">x</button>
    </form>
</div>
<script src="{{ asset('js/captcha.js') }}"></script>