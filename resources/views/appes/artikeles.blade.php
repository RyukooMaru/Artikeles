<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Artikeles</title>
  <link rel="stylesheet" href="{{ asset('css/appes.css') }}">
  <link rel="icon" href="{{ asset('favicon.ico') }}">
</head>
<body>
  @if(session('searcherror'))
    <div class="alert-container">
        <div class="alert-card">
            {{ session('searcherror') }}
            <span class="close-alert" onclick="this.parentElement.style.display='none';">&times;</span>
        </div>
    </div>
  @endif
  @include('partses.navbares')
  <div class="main-content">
    @yield('content')
  </div>
  <script src="{{ asset('js/appes.js') }}"></script>
</body>
</html>
