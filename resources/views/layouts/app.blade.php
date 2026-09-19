<!doctype html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Museum Karya - SMKN 4 Tasikmalaya')</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png')}}">

    {{-- Terapkan tema SEBELUM halaman dirender supaya tidak berkedip (flash) --}}
    <script>
        (function () {
            var saved = localStorage.getItem('theme');
            var prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            var isDark = saved ? saved === 'dark' : prefersDark;
            document.documentElement.classList.toggle('dark', isDark);
        })();
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style type="text/tailwindcss">
        @custom-variant dark (&:where(.dark, .dark *));
    </style>

    {{-- CSS khusus tiap halaman --}}
    @stack('styles')
</head>
<body class="@yield('body_class', 'bg-[#FFFDF5] dark:bg-zinc-950 text-slate-900 dark:text-zinc-100 transition-colors duration-300 antialiased flex flex-col min-h-screen')">

    {{-- Navbar utama (dipakai semua halaman) --}}
    @include('partials.navbar')

    {{-- Isi halaman --}}
    @yield('content')

    {{-- JS navbar: ganti tema & menu mobile (satu-satunya tempat, jangan diulang di file JS halaman) --}}
    <script>
        // ===== Ganti tema terang/gelap =====
        window.toggleTheme = function () {
            var next = document.documentElement.classList.contains('dark') ? 'light' : 'dark';
            localStorage.setItem('theme', next);
            document.documentElement.classList.toggle('dark', next === 'dark');
        };

        // ===== Menu mobile (hamburger) =====
        // ===== Menu mobile (hamburger) =====
        (function () {
            var menuToggle = document.getElementById('menuToggle');
            var navLinks = document.getElementById('navLinks');
            var hamburgerIcon = document.getElementById('hamburgerIcon');
            var closeIcon = document.getElementById('closeIcon');
            if (!menuToggle || !navLinks) return;

            function setMenu(open) {
                navLinks.classList.toggle('hidden', !open);
                navLinks.classList.toggle('flex', open);
                menuToggle.setAttribute('aria-expanded', String(open));
                menuToggle.setAttribute('aria-label', open ? 'Close Menu' : 'Open Menu');

                if (hamburgerIcon && closeIcon) {
                    hamburgerIcon.classList.toggle('hidden', open);
                    hamburgerIcon.classList.toggle('block', !open);
                    closeIcon.classList.toggle('hidden', !open);
                    closeIcon.classList.toggle('block', open);
                }
            }

            menuToggle.addEventListener('click', function () {
                setMenu(menuToggle.getAttribute('aria-expanded') !== 'true');
            });

            // Tutup menu saat link diklik, tekan Escape, atau layar melebar ke desktop
            navLinks.querySelectorAll('a').forEach(function (a) {
                a.addEventListener('click', function () { setMenu(false); });
            });
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') setMenu(false);
            });
            window.matchMedia('(min-width: 768px)').addEventListener('change', function (e) {
                if (e.matches) setMenu(false);
            });
        })();
    </script>

    {{-- JS khusus tiap halaman --}}
    @stack('scripts')
</body>
</html>