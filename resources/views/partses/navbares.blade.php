<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Artikeles</title>
  <link rel="stylesheet" href="{{ asset('css/partses.css') }}">
</head>
<body>

  <!-- Top Navbar -->
  <header class="top-navbar">
    <div class="left-section">
      <span class="site-title">Artikeles</span>
    </div>

    <div class="search-wrapper">
    <form action="{{ route('appes.searches') }}" method="POST" class="search-form">
        @csrf
        <input 
        type="text" 
        name="history" 
        id="search-input" 
        placeholder="Cari sesuatu..." 
        required 
        />
        <button type="button" id="clear-btn">&times;</button>
    </form>
    </div>


    <div class="right-section">
      @if(session('isLoggedIn'))
        <a href="/profile" title="{{ session('username') }}">
          <img 
            src="{{ session('improfil') ?? 'https://via.placeholder.com/40' }}" 
            alt="Profile" 
            class="profile-img"
          />
        </a>
      @else
        <a href="/authes" class="login-button">
            <img src="https://cdn-icons-png.flaticon.com/128/12366/12366473.png" class="profile-img" alt="Login">
        </a>
      @endif
    </div>
  </header>

  <!-- Sidebar Navigation -->
  <nav class="sidebar">
    <a href="{{ url('/artikeles') }}" class="nav-item home">
      <img src="{{ asset('https://cdn-icons-png.flaticon.com/128/2932/2932143.png') }}" class="icon-img" alt="Home">
      <span>Home</span>
    </a>

    <a href="{{ url('/buates') }}" class="nav-item create">
      <img src="{{ asset('https://cdn-icons-png.flaticon.com/128/3161/3161837.png') }}" class="icon-img" alt="Buat">
      <span>Buat</span>
    </a>

    <a href="#" class="nav-item settings">
      <img src="{{ asset('https://cdn-icons-png.flaticon.com/128/8138/8138637.png') }}" class="icon-img" alt="Settings">
      <span>Settings</span>
    </a>

    @if(session('isLoggedIn'))
      <a href="{{ url('/logout') }}" class="nav-item logout">
        <img src="{{ asset('https://cdn-icons-png.flaticon.com/128/8944/8944313.png') }}" class="icon-img" alt="Logout">
        <span>Logout</span>
      </a>
    @endif
  </nav>

  <!-- Main Content -->
  <main class="main-content">
    @yield('content')
  </main>

  <script src="{{ asset('js/partses.js') }}"></script>
</body>
</html>
