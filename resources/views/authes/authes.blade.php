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
    <div class="locard-left">
      <img src="https://via.placeholder.com/500x500" alt="Image" />
    </div>
      <div class="locard-right">
        @include('authes.logines')

        @include('authes.registeres')

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
