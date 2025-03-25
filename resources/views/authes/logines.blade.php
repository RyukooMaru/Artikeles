<div id="login-form" class="login-card">
        <h2>LOGIN</h2>

        <form method="POST" action="{{ route('login.action') }}">
          @csrf
          <div class="input-group">
            <label for="username-login">Username</label>
            <input type="text" id="username-login" name="username" placeholder="Masukkan username" required>
          </div>

          <div class="input-group">
            <label for="password-login">Password</label>
            <input type="password" id="password-login" name="password" placeholder="Masukkan password" required>
          </div>
          @if(session('success') && session('form') === 'login')
            <div class="feedback success">
              {{ session('success') }}
            </div>
          @endif

          @if(session('error') && (session('form') === 'login' || !session('form')))
            <div class="feedback error">
              {{ session('error') }}
            </div>
          @endif  

          <button type="submit" class="btn-login">Login</button>
        </form>

        <p class="--link">
          Belum punya akun?
          <a href="#" onclick="toggleForm('register')">Daftar</a>
        </p>
      </div>