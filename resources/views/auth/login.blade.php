<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <title>Login - Karya PPLG</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/login.css')}}">
    <style>
      /* ===== Penyesuaian agar seluruh halaman pas dalam satu layar (no page scroll) ===== */
      /* Catatan: bagian ini menimpa/menambah beberapa aturan dari login.css agar tinggi
         halaman selalu pas dengan viewport, tanpa mengubah struktur HTML atau JS yang ada. */

      html, body {
        height: 100%;
        overflow: hidden; /* halaman utama tidak akan scroll */
      }

      .login-container {
        height: 100vh;
        height: 100dvh; /* lebih akurat di mobile (memperhitungkan address bar) */
        overflow: hidden;
        display: flex;
      }

      .login-left,
      .login-right {
        height: 100%;
        overflow-y: auto; /* jika konten tetap lebih panjang dari layar kecil, scroll terjadi di dalam kolom ini saja, bukan di seluruh halaman */
        display: flex;
        flex-direction: column;
        justify-content: center;
      }

      /* Kurangi sedikit jarak vertikal supaya lebih mudah muat di layar pendek (mis. laptop 13"/14") */
      .login-left {
        padding-top: clamp(1rem, 3vh, 2.5rem);
        padding-bottom: clamp(1rem, 3vh, 2.5rem);
        gap: 0;
      }

      .login-logo {
        margin-bottom: clamp(0.75rem, 2vh, 1.5rem);
      }

      .login-title {
        margin-bottom: 0.25rem;
      }

      .login-subtitle {
        margin-bottom: clamp(0.75rem, 2vh, 1.25rem);
      }

      .login-form-group {
        margin-bottom: clamp(0.6rem, 1.6vh, 1rem);
      }

      .login-checkbox {
        margin-bottom: clamp(0.75rem, 2vh, 1.25rem);
      }

      .login-divider {
        margin-top: clamp(0.75rem, 2vh, 1.25rem);
        margin-bottom: clamp(0.75rem, 2vh, 1.25rem);
      }

      .right-features {
        gap: clamp(0.75rem, 2vh, 1.5rem);
      }

      /* Di layar yang sangat pendek, kecilkan sedikit ukuran judul supaya semua tetap muat */
      @media (max-height: 700px) {
        .login-title {
          font-size: clamp(1.25rem, 3vh, 1.75rem);
        }

        .right-title {
          font-size: clamp(1.25rem, 3vh, 1.75rem);
        }
      }
    </style>
  </head>
  <body>
    <div class="login-container">
      <div class="login-left">
        <div class="login-logo">
          <div class="login-logo-circle">K</div>
          <div class="login-logo-text">Karya PPLG</div>
        </div>

        <h1 class="login-title">Selamat Datang</h1>
        <p class="login-subtitle">Masuk untuk melanjutkan ke dashboard Anda</p>

        @if ($errors->any())
          <div class="login-alert">
            {{ $errors->first() }}
          </div>
        @endif

        <form class="login-form" action="{{ route('login') }}" method="POST">
          @csrf

          <div class="login-form-group">
            <label class="login-label" for="email">Email</label>
            <input
              type="email"
              id="email"
              name="email"
              placeholder="Masukan Email Anda...."
              value="{{ old('email') }}"
              class="login-input @error('email') error @enderror"
              required
              autofocus
            />
            @error('email')
              <p class="login-error-message">{{ $message }}</p>
            @enderror
          </div>

          <div class="login-form-group">
            <label class="login-label" for="password">Password</label>
            <input
              type="password"
              id="password"
              name="password"
              placeholder="Masukkan password Anda"
              class="login-input @error('password') error @enderror"
              required
            />
            @error('password')
              <p class="login-error-message">{{ $message }}</p>
            @enderror
          </div>

          <div class="login-checkbox">
            <input type="checkbox" id="show-password" />
            <label for="show-password">Tampilkan Password</label>
          </div>

          <button type="submit" class="login-button">Login Sekarang</button>
        </form>

        <div class="login-divider">
          <span>Atau</span>
        </div>

        <div class="login-social">
          <a href="{{ route('google.login') }}" class="login-social-btn">
            <svg viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
              <path fill="#FFC107" d="M43.611 20.083H42V20H24v8h11.303c-1.649 4.657-6.08 8-11.303 8-6.627 0-12-5.373-12-12s5.373-12 12-12c3.059 0 5.842 1.154 7.961 3.039l5.657-5.657C34.046 6.053 29.268 4 24 4 12.955 4 4 12.955 4 24s8.955 20 20 20 20-8.955 20-20c0-1.341-.138-2.65-.389-3.917z"/>
              <path fill="#FF3D00" d="M6.306 14.691l6.571 4.819C14.655 15.108 18.961 12 24 12c3.059 0 5.842 1.154 7.961 3.039l5.657-5.657C34.046 6.053 29.268 4 24 4 16.318 4 9.656 8.337 6.306 14.691z"/>
              <path fill="#4CAF50" d="M24 44c5.166 0 9.86-1.977 13.409-5.192l-6.19-5.238C29.211 35.091 26.715 36 24 36c-5.202 0-9.619-3.317-11.283-7.946l-6.522 5.025C9.505 39.556 16.227 44 24 44z"/>
              <path fill="#1976D2" d="M43.611 20.083H42V20H24v8h11.303c-.792 2.237-2.231 4.166-4.087 5.571.001-.001.002-.001.003-.002l6.19 5.238C36.971 39.205 44 34 44 24c0-1.341-.138-2.65-.389-3.917z"/>
            </svg>
            <span>Google</span>
          </a>
          <button type="button" class="login-social-btn" onclick="showComingSoonModal()">
            <svg viewBox="0 0 24 24" fill="#111827" xmlns="http://www.w3.org/2000/svg">
              <path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/>
            </svg>
            <span>GitHub</span>
          </button>
        </div>

      </div>

      <div id="comingSoonModal" class="modal-overlay" onclick="if(event.target === this) closeComingSoonModal()">
        <div class="modal-box">
          <div class="modal-icon-circle">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
            </svg>
          </div>
          <h3 class="modal-title">Segera Hadir</h3>
          <p class="modal-text">Login dengan GitHub belum tersedia saat ini. Silakan gunakan email atau login dengan Google.</p>
          <button type="button" class="modal-close-btn" onclick="closeComingSoonModal()">Oke, Mengerti</button>
        </div>
      </div>

      <div class="login-right">
        <div>
          <h2 class="right-title">Museum Karya SMK Negeri 4 Tasikmalaya</h2>
          <p class="right-subtitle">Platform untuk menampilkan karya terbaik siswa dalam bidang software dan game.</p>

          <div class="right-features">
            <div class="right-feature-item">
              <span class="right-feature-icon">🎓</span>
              <div>
                <div class="right-feature-title">Portfolio Siswa</div>
                <div class="right-feature-text">Tunjukkan karya terbaik Anda kepada dunia</div>
              </div>
            </div>

            <div class="right-feature-item">
              <span class="right-feature-icon">⭐</span>
              <div>
                <div class="right-feature-title">Apresiasi Karya</div>
                <div class="right-feature-text">Dapatkan feedback dan apresiasi dari komunitas</div>
              </div>
            </div>

            <div class="right-feature-item">
              <span class="right-feature-icon">🚀</span>
              <div>
                <div class="right-feature-title">Pengembangan Karir</div>
                <div class="right-feature-text">Terhubung dengan peluang kerja yang relevan</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script>
      function showComingSoonModal() {
        document.getElementById("comingSoonModal").classList.add("show");
      }

      function closeComingSoonModal() {
        document.getElementById("comingSoonModal").classList.remove("show");
      }

      document.addEventListener("keydown", function (e) {
        if (e.key === "Escape") closeComingSoonModal();
      });

      // LOGIKA UNTUK SHOW / HIDE PASSWORD
      document.getElementById("show-password").addEventListener("change", function () {
        const passwordInput = document.getElementById("password");
        if (this.checked) {
          passwordInput.type = "text";
        } else {
          passwordInput.type = "password";
        }
      });

      // Tampilkan indikator loading saat form benar-benar dikirim ke server
      document.querySelector(".login-form").addEventListener("submit", function () {
        const button = this.querySelector(".login-button");
        button.classList.add("loading");
        button.disabled = true;
      });

      // Validasi real-time (hanya bantu UX, validasi asli tetap di server)
      document.getElementById("email").addEventListener("blur", function () {
        const isValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(this.value);
        this.classList.toggle("error", !isValid && this.value);
      });

      document.getElementById("password").addEventListener("blur", function () {
        const isValid = this.value.length >= 6;
        this.classList.toggle("error", !isValid && this.value);
      });
    </script>
  </body>
</html>