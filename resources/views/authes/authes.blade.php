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
        @include('authes.logines')

        <!-- REGISTER FORM -->
        @include('authes.registeres')

        <!--   CAPTCHA FORM -->
        @if(session('captchaes') && session('form') === 'captcha')
          @include('authes.captchaes')
        @endif          
      </div>
    </div>
  </div>

  <footer class="footeresauth">
    <p>&copy; {{ date('Y') }} Artikeles by Kelompok 10 tapi aku sendiri.</p>
  </footer>
  <script src="{{ asset('js/authes.js') }}"></script>
</body>

</html>
