<div id="captcha-form" class="captcha-card hidden">
    <h2>CAPTCHA</h2>
    <form method="POST" action="{{ route('verifikasikan') }}">
        @csrf
        <div id="img-rotate" class="img-rot">
            <img src="" name="img-rotasi1" id="img-rotate1" class="img-rotasi">
            <img src="" name="img-rotasi2" id="img-rotate2" class="img-rotasi">
        </div>
        <button class="btn-rotasi" id="rotasi-kiri"><</button>
        <button class="btn-rotasi" id="rotasi-kanan">></button>
        <button type="submit" class="btn-login">COCOKAN</button>
    </form>
    <form method="GET" action="{{ route('batal.captcha') }}">
        @csrf
        <button class="close-btn">x</button>
    </form>
</div>
<script src="{{ asset('js/captcha.js') }}"></script>