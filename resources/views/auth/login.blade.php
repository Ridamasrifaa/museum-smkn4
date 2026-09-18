<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}" />
    <title>Login - Karya PPLG</title>

    @verbatim
    <style type="text/tailwindcss">
        @custom-variant dark (&:where(.dark, .dark *));
    </style>
    @endverbatim

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}" />
    <script src="{{ asset('assets/js/auth/theme.js') }}"></script>
</head>
<body>

    <!-- Elemen Dekoratif Grid Background & Floating Shapes -->
    <div class="decorative-shapes" aria-hidden="true">
        <div class="shape shape-1">✨</div>
        <div class="shape shape-2">MUSEUM VIRTUAL</div>
        <div class="shape shape-3"></div>
        <div class="shape shape-4">CURATOR ACCESS</div>
        <div class="shape shape-5"></div>
        <div class="shape shape-6"></div>
    </div>

    <!-- NAVBAR HEADER BARU -->
    <header class="sticky top-4 z-50 px-4">
        <nav class="relative mx-auto max-w-7xl bg-white dark:bg-zinc-900 rounded-full border-4 border-black dark:border-white shadow-[6px_6px_0px_#000] dark:shadow-[6px_6px_0px_#fff] px-4 sm:px-6 py-3 transition-all duration-300">
            <div class="flex items-center justify-between">
                
                <!-- 1. Logo & Title -->
                <div class="flex items-center gap-2 sm:gap-3">
                    <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl bg-white dark:bg-zinc-800 border-3 border-black dark:border-white flex items-center justify-center font-black shadow-[2px_2px_0px_#000] dark:shadow-[2px_2px_0px_#fff] shrink-0">
                        <img src="{{ asset('assets/img/smk4.png') }}" alt="Logo" class="w-6 h-6 sm:w-7 sm:h-7 object-cover rounded-md" />
                    </div>
                    <span class="text-sm sm:text-lg font-black tracking-wider text-black dark:text-white whitespace-nowrap">MUSEUM.KARYA</span>
                </div>

                <!-- 2. Menu Links (Tampilan Desktop & Dropdown Melayang di Mobile) -->
                <div id="navLinks"
                    class="hidden md:flex flex-col md:flex-row gap-3 md:gap-8 md:items-center
                    absolute md:static left-0 right-0 top-[calc(100%+16px)] md:top-auto
                    bg-zinc-900/95 md:bg-transparent backdrop-blur-md md:backdrop-blur-none
                    rounded-3xl md:rounded-none border-2 md:border-0 border-zinc-700 md:border-none
                    shadow-xl md:shadow-none 
                    p-5 md:p-0 z-50 text-center md:text-left transition-all">
                    
                    <!-- BERANDA -->
                    <a href="{{ url('/') }}"
                        class="text-sm md:text-xs font-black text-zinc-300 hover:text-white transition px-4 md:px-0 py-3 md:py-0 rounded-2xl md:rounded-none">
                        BERANDA
                    </a>

                    <!-- KARYA -->
                    <a href="{{ url('/karya') }}"
                        class="text-sm md:text-xs font-black text-zinc-300 hover:text-white transition px-4 md:px-0 py-3 md:py-0 rounded-2xl md:rounded-none">
                        KARYA
                    </a>

                    <!-- ARTIKEL -->
                    <a href="{{ url('/artikel') }}"
                        class="text-sm md:text-xs font-black text-zinc-300 hover:text-white transition px-4 md:px-0 py-3 md:py-0 rounded-2xl md:rounded-none">
                        ARTIKEL
                    </a>

                    <!-- TENTANG -->
                    <a href="{{ url('/tentang') }}"
                        class="text-sm md:text-xs font-black text-zinc-300 hover:text-white transition px-4 md:px-0 py-3 md:py-0 rounded-2xl md:rounded-none">
                        TENTANG
                    </a>

                    <!-- Tombol LOGIN di Menu Mobile -->
                    <a href="{{ route('login') }}" 
                        class="md:hidden mt-2 text-xs font-black px-5 py-3 bg-[#74B9FF] text-black border-2 border-black rounded-2xl shadow-[2px_2px_0px_#000] active:translate-y-[1px] transition block text-center">
                        LOGIN
                    </a>
                </div>

                <!-- 3. Right Actions (Theme Toggle, Login Desktop, & Hamburger) -->
                <div class="flex items-center gap-2 sm:gap-3">
                    <button
                        id="themeToggle"
                        onclick="toggleTheme()"
                        aria-label="Ganti mode"
                        class="w-9 h-9 sm:w-10 sm:h-10 flex items-center justify-center rounded-full bg-[#FFD23F] border-3 border-black dark:border-white shadow-[2px_2px_0px_#000] dark:shadow-[2px_2px_0px_#fff] text-gray-900 cursor-pointer hover:translate-y-[-2px] transition">
                        🌙
                    </button>
                    
                    <!-- Login (Desktop) -->
                    <a href="{{ route('login') }}" 
                        class="hidden md:inline-block text-[10px] sm:text-xs font-black px-3 sm:px-5 py-2 sm:py-2.5 bg-[#74B9FF] text-black border-3 border-black dark:border-white rounded-full shadow-[2px_2px_0px_#000] dark:shadow-[2px_2px_0px_#fff] hover:bg-[#54a0ff] transition whitespace-nowrap">
                        LOGIN
                    </a>

                    <!-- Hamburger Button (Mobile) -->
                    <button 
                        id="menuToggle" 
                        aria-label="Open Menu" 
                        class="md:hidden w-9 h-9 rounded-xl bg-white dark:bg-zinc-800 border-3 border-black dark:border-white flex items-center justify-center font-black shadow-[2px_2px_0px_#000] dark:shadow-[2px_2px_0px_#fff] text-black dark:text-white cursor-pointer active:translate-y-[1px]">
                        <svg id="hamburgerIcon" class="w-5 h-5 block" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <svg id="closeIcon" class="w-5 h-5 hidden" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

            </div>
        </nav>
    </header>

    <div class="main-wrapper">
        <div class="login-container">
            <!-- Kiri: Form Login -->
            <div class="login-left">
                <div class="login-logo">
                    <div class="login-logo-circle">K</div>
                    <div class="login-logo-text">Karya PPLG</div>
                </div>
                <h1 class="login-title">Selamat Datang</h1>
                <p class="login-subtitle">Masuk untuk melanjutkan ke dashboard Anda</p>

                @if ($errors->any())
                    <div class="login-alert" style="background-color: #fee2e2; color: #b91c1c; padding: 10px; border-radius: 8px; margin-bottom: 15px; font-size: 14px;">
                        {{ $errors->first() }}
                    </div>
                @endif

                @if (session('status'))
                    <div class="login-alert" style="background-color: #d1fae5; color: #065f46; padding: 10px; border-radius: 8px; margin-bottom: 15px; font-size: 14px;">
                        {{ session('status') }}
                    </div>
                @endif

                <form class="login-form" action="{{ route('login') }}" method="POST">
                    @csrf

                    <div class="login-form-group">
                        <label class="login-label" for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Masukan Email Anda" value="{{ old('email') }}" class="login-input @error('email') error @enderror" required autofocus autocomplete="email" />
                        @error('email')
                            <p class="login-error-message" style="color: red; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="login-form-group">
                        <label class="login-label" for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Masukkan password Anda" class="login-input @error('password') error @enderror" required autocomplete="current-password" />
                        @error('password')
                            <p class="login-error-message" style="color: red; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="login-checkbox">
                        <input type="checkbox" id="show-password" />
                        <label for="show-password">Tampilkan Password</label>
                    </div>

                    <button type="submit" class="login-button">Login Sekarang</button>
                </form>

                <div class="login-divider"><span>Atau</span></div>
                <div class="login-social">
                    <a href="{{ route('google.login') }}" class="login-social-btn">
                        <svg viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                            <path fill="#FFC107" d="M43.611 20.083H42V20H24v8h11.303c-1.649 4.657-6.08 8-11.303 8-6.627 0-12-5.373-12-12s5.373-12 12-12c3.059 0 5.842 1.154 7.961 3.039l5.657-5.657C34.046 6.053 29.268 4 24 4 12.955 4 4 12.955 4 24s8.955 20 20 20 20-8.955 20-20c0-1.341-.138-2.65-.389-3.917z" />
                            <path fill="#FF3D00" d="M6.306 14.691l6.571 4.819C14.655 15.108 18.961 12 24 12c3.059 0 5.842 1.154 7.961 3.039l5.657-5.657C34.046 6.053 29.268 4 24 4 16.318 4 9.656 8.337 6.306 14.691z" />
                            <path fill="#4CAF50" d="M24 44c5.166 0 9.86-1.977 13.409-5.192l-6.19-5.238C29.211 35.091 26.715 36 24 36c-5.202 0-9.619-3.317-11.283-7.946l-6.522 5.025C9.505 39.556 16.227 44 24 44z" />
                            <path fill="#1976D2" d="M43.611 20.083H42V20H24v8h11.303c-.792 2.237-2.231 4.166-4.087 5.571.001-.001.002-.001.003-.002l6.19 5.238C36.971 39.205 44 34 44 24c0-1.341-.138-2.65-.389-3.917z" />
                        </svg>
                        <span>Google</span>
                    </a>
                    <button type="button" class="login-social-btn" onclick="showComingSoonModal()">
                        <svg viewBox="0 0 24 24" fill="#111827" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z" />
                        </svg>
                        <span>GitHub</span>
                    </button>
                </div>
                <p class="login-register-text">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="login-register-link">Daftar disini</a>
                </p>
            </div>

            <!-- Modal GitHub Belum Tersedia -->
            <div id="comingSoonModal" class="modal-overlay" onclick="if (event.target === this) closeComingSoonModal();">
                <div class="modal-box">
                    <div class="modal-icon-circle">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" /></svg>
                    </div>
                    <h3 class="modal-title">Segera Hadir</h3>
                    <p class="modal-text">Login dengan GitHub belum tersedia saat ini. Silahkan login dengan Akun Google</p>
                    <button type="button" class="modal-close-btn" onclick="closeComingSoonModal()">Oke, Mengerti</button>
                </div>
            </div>

            <!-- Kanan: Info & Fitur -->
            <div class="login-right">
                <div>
                    <h2 class="right-title">Museum Karya SMK Negeri 4 Tasikmalaya</h2>
                    <p class="right-subtitle">kamu siswa smk 4 kamu punya karya? pamerkan disini</p>
                    <div class="right-features">
                        <div class="right-feature-item"> 
                            <div>
                                <div class="right-feature-title">Portofolio Siswa</div>
                                <p>Tunjukkan karya terbaik Anda kepada dunia</p>
                            </div>
                        </div>
                        <div class="right-feature-item">
                            <div>
                                <div class="right-feature-title">Apresiasi Karya</div>
                                <p>Dapatkan feedback dan apresiasi dari komunitas</p>
                            </div>
                        </div>
                        <div class="right-feature-item">
                            <div>
                                <div class="right-feature-title">Pengembangan Karir</div>
                                <p>Terhubung dengan peluang kerja yang relevan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script Hamburger Toggle Mobile -->
    <script>
        const menuToggle = document.getElementById('menuToggle');
        const navLinks = document.getElementById('navLinks');
        const hamburgerIcon = document.getElementById('hamburgerIcon');
        const closeIcon = document.getElementById('closeIcon');

        menuToggle.addEventListener('click', () => {
            navLinks.classList.toggle('hidden');
            hamburgerIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');
        });

        function showComingSoonModal() {
            document.getElementById("comingSoonModal").classList.add("show");
        }
        function closeComingSoonModal() {
            document.getElementById("comingSoonModal").classList.remove("show");
        }
        document.addEventListener("keydown", function (e) {
            if (e.key === "Escape") closeComingSoonModal();
        });
        document.getElementById("show-password").addEventListener("change", function () {
            document.getElementById("password").type = this.checked ? "text" : "password";
        });
        document.querySelector(".login-form").addEventListener("submit", function (e) {
            const b = this.querySelector(".login-button");
            b.classList.add("loading");
            b.disabled = true;
            b.textContent = "Tunggu bentar....";
        });
    </script>
</body>
</html>