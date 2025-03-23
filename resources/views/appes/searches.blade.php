<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Artikeles</title>
  <link rel="stylesheet" href="{{ asset('css/appes.css') }}">
</head>
<body>
    
    
  @include('partses.navbares')
  <div class="main-content">
    @yield('content')
  </div>
  <script src="{{ asset('js/appes.js') }}"></script>
</body>
</html>
