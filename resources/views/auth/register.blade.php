<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}" />
    <title>Daftar - Karya PPLG</title>

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

    <!-- NAVBAR HEADER -->
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
            <!-- Kiri: Form Register -->
            <div class="login-left">
                <div class="login-logo">
                    <div class="login-logo-circle">K</div>
                    <div class="login-logo-text">Karya PPLG</div>
                </div>
                <h1 class="login-title">Buat Akun Baru</h1>
                <p class="login-subtitle">Daftar untuk mulai memamerkan karya Anda</p>

                @if ($errors->any())
                    <div class="login-alert" style="background-color: #fee2e2; color: #b91c1c; padding: 10px; border-radius: 8px; margin-bottom: 15px; font-size: 14px;">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form class="login-form" action="{{ route('register') }}" method="POST">
                    @csrf

                    <div class="login-form-group">
                        <label class="login-label" for="name">Nama</label>
                        <input type="text" id="name" name="name" placeholder="Masukkan nama lengkap Anda" value="{{ old('name') }}" class="login-input @error('name') error @enderror" required autofocus autocomplete="name" />
                        @error('name')
                            <p class="login-error-message" style="color: red; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="login-form-group">
                        <label class="login-label" for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Masukan Email Anda" value="{{ old('email') }}" class="login-input @error('email') error @enderror" required autocomplete="email" />
                        @error('email')
                            <p class="login-error-message" style="color: red; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="login-form-group">
                        <label class="login-label" for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Masukkan password Anda" class="login-input @error('password') error @enderror" required autocomplete="new-password" />
                        @error('password')
                            <p class="login-error-message" style="color: red; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="login-form-group">
                        <label class="login-label" for="kode_unik">Kode Unik</label>
                        <input type="text" id="kode_unik" name="kode_unik" placeholder="Masukan Kode unik" value="{{ old('kode_unik') }}" class="login-input @error('kode_unik') error @enderror" required />
                        @error('kode_unik')
                            <p class="login-error-message" style="color: red; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="login-checkbox">
                        <input type="checkbox" id="show-password" />
                        <label for="show-password">Tampilkan Password</label>
                    </div>

                    <button type="submit" class="login-button">Daftar Sekarang</button>
                </form>

                <p class="login-register-text">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="login-register-link">Login disini</a>
                </p>
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

        document.getElementById("show-password").addEventListener("change", function () {
            document.getElementById("password").type = this.checked ? "text" : "password";
        });

        document.querySelector(".login-form").addEventListener("submit", function () {
            const b = this.querySelector(".login-button");
            b.classList.add("loading");
            b.disabled = true;
            b.textContent = "Tunggu bentar....";
        });
    </script>
</body>
</html>