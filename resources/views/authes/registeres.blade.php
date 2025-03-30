    <div id="register-form" class="login-card hidden">
        <h2 class="registertxt">REGISTER</h2>
        <form method="POST" action="{{ route('register.action') }}">
          @csrf
          <div class="input-group">
            <label for="username-register">Username</label>
            <input type="text" name="username" value="{{ old('username') }}" id="username-register" placeholder="Masukkan username" required>
          </div>

          <div class="input-group">
            <label for="nameuse">Nama Artikeles</label>
            <input type="text" name="nameuse" value="{{ old('nameuse') }}" id="nameuse" placeholder="Masukkan nama artikeles" required>
          </div>
          
          <div class="input-group">
            <label for="email">Email</label>
            <input type="text" name="email" value="{{ old('email') }}" id="email" placeholder="Masukkan email" required>
          </div>

          <div class="input-group">
            <label for="password-register">Password</label>
            <input type="password" name="password" value="{{ old('password') }}" id="password-register" placeholder="Masukkan password" required minlength="6">
          </div>

          <div class="input-group">
            <label for="password_confirmation">Masukkan Ulang Password</label>
            <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" id="password_confirmation" placeholder="Masukkan ulang password" required minlength="6">
          </div>

          {{-- Di Register Form --}}
          @if(session('error') && session('form') === 'register')
            <div class="feedback error">
              {{ session('error') }}
            </div>
          @endif
          @if(session('success') && session('form') === 'register')
            <div class="feedback success">
              {{ session('success') }}
            </div>
          @endif          
          @if(session('captchaes') && session('form') === 'captcha')
            <div class="feedback error">
              {{ session('captchaes') }}
            </div>
          @endif          

          @if(session('message'))
            <div class="feedback error">
              {{ session('message') }}
            </div>
          @endif
          <div class="input-group">
          <button type="submit" class="btn-login">Buat Akun</button>
          </div>
          <p class="--link">  
              Sudah punya akun?
              <a href="#" onclick="toggleForm('login')">Login</a>
            </p>
        </div>
        </div>
    </div>