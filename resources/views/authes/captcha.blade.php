<link rel="stylesheet" href="{{ asset('css/authes.css') }}">
@if(session('captchaes') && session('form') === 'captcha') 
<div class="locardesmini" id="locardesmini">
    <div class="login-card">
        <button type="button" class="close-btn" onclick="closeCard()">×</button>
        <p style="color: black;">Ini locardesmini nya berada di center...</p>
    </div>
</div>
@endif
<script src="{{ asset('js/authes.js') }}"></script>
