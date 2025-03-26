<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login & Register</title>
  <link rel="stylesheet" href="{{ asset('css/authes.css') }}">
  <link rel="icon" href="{{ asset('icon.png') }}">
</head>

<body class="timess" data-show-form="{{ session('showForm') ?? session('form') ?? ($errors->any() ? 'register' : 'login') }}">
  <div class="locardes">
  <div class="cardbg">
    <div class="locard-left">
      <img id="gifImage" src="{{ asset('ico.gif') }}" class="gifet"/>
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
  <script>
  var iconPath = "{{ asset('icouth.png') }}";
  </script>
</body>

</html>
