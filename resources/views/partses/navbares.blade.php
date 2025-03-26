<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Artikeles</title>
  <link rel="icon" href="{{ asset('favicon.ico') }}">
  <link rel="stylesheet" href="{{ asset('css/partses.css') }}">
</head>
<body>
  <header class="top-navbar">
    <img src="{{ asset('icouth.png') }}" alt="" class="brandes"/>

    <div class="search-wrapper">
        <form action="{{ route('appes.searches') }}" method="POST" class="search-form">
            @csrf
            <input type="text" name="history" id="search-input" placeholder="Cari sesuatu..." required />
            <button type="button" id="clear-btn">&times;</button>
        </form>
    </div>

    @if(session('isLoggedIn'))
        <a href="/profile" title="{{ session('username') }}">
            <img src="{{ session('improfil') ?? 'https://via.placeholder.com/40' }}" alt="Profile" class="improfiles"/>
        </a>
    @else
        <a href="/authes" class="login-button">
            <img src="https://cdn-icons-png.flaticon.com/128/12366/12366473.png" class="improfiles" alt="Login">
        </a>
    @endif
    
    <img src="https://cdn-icons-png.flaticon.com/128/6512/6512751.png" class="toggle-mode" data-mode="light">
    <img src="https://cdn-icons-png.flaticon.com/128/6512/6512751.png" class="toggle-mode hidden" data-mode="dark">
    
    
        
  </header>
  <nav class="sidebar">
    <a href="{{ url('/artikeles') }}" class="nav-item home">
        <img src="https://cdn-icons-png.flaticon.com/128/2932/2932143.png"
             class="icon-img"
             alt="Home"
             data-light="https://cdn-icons-png.flaticon.com/128/2932/2932143.png"
             data-dark="{{ asset('hdm.png') }}">
        <span>Home</span>
    </a>
    <a href="{{ url('/buates') }}" class="nav-item create">
        <img src="https://cdn-icons-png.flaticon.com/128/3161/3161837.png"
             class="icon-img"
             alt="Buat"
             data-light="https://cdn-icons-png.flaticon.com/128/3161/3161837.png"
             data-dark="{{ asset('adm.png') }}">
        <span>Buat</span>
    </a>
    <a href="#" class="nav-item settings">
        <img src="https://cdn-icons-png.flaticon.com/128/2956/2956788.png"
             class="icon-img"
             alt="Settings"
             data-light="https://cdn-icons-png.flaticon.com/128/2956/2956788.png"
             data-dark="{{ asset('sdm.png') }}">
        <span>Settings</span>
    </a>
    @if(session('isLoggedIn'))
        <a href="{{ url('/logout') }}" class="nav-item logout">
            <img src="https://cdn-icons-png.flaticon.com/128/10405/10405584.png"
                 class="icon-img"
                 alt="Logout"
                 data-light="https://cdn-icons-png.flaticon.com/128/10405/10405584.png"
                 data-dark="{{ asset('ldm.png') }}">
            <span>Logout</span>
        </a>
    @endif
  </nav>
  <script src="{{ asset('js/partses.js') }}"></script>
</body>
</html>
