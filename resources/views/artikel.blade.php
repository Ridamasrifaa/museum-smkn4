<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikel - Museum Karya SMKN 4 Tasikmalaya</title>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <style type="text/tailwindcss">
        @custom-variant dark (&:where(.dark, .dark *));
    </style>
    <style>
        .icon-moon {
            display: block;
        }

        .icon-sun {
            display: none;
        }

        .dark .icon-moon {
            display: none;
        }

        .dark .icon-sun {
            display: block;
        }
    </style>
</head>

<body class="scroll-smooth bg-white dark:bg-gray-950 text-gray-900 dark:text-gray-100 transition-colors duration-300">

    <header class="navbar shadow-sm sticky top-0 z-50 bg-white dark:bg-gray-900 transition-colors duration-300">
        <nav class="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8">
            <div class="flex lg:flex-1 items-center gap-2">
                <div
                    class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                    🏛️
                </div>
                <span class="text-2xl font-bold text-blue-600">Museum Karya</span>
            </div>
            <div class="hidden lg:flex lg:gap-x-8 lg:items-center">
                <a href="/"
                    class="text-sm font-semibold text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition">Beranda</a>
                <a href="/karya"
                    class="text-sm font-semibold text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition">Karya</a>
                <a href="/artikel"
                    class="text-sm font-semibold text-blue-600 border-b-2 border-blue-600 pb-1">Artikel</a>
                <a href="/login"
                    class="text-sm font-semibold text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition">Login</a>
                <button id="themeToggle" onclick="toggleTheme()" aria-label="Ganti mode terang/gelap"
                    class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-yellow-300">
                    <svg class="icon-sun w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <svg class="icon-moon w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                </button>
            </div>
        </nav>
    </header>

    <section class="bg-gradient-to-r from-sky-600 via-blue-600 to-indigo-700 text-white py-20">

        <div class="max-w-7xl mx-auto px-6">
            <div class="rounded-[2rem] border border-white/10 bg-white/10 backdrop-blur-xl p-10 shadow-2xl">
                <div class="max-w-3xl">
                    <p class="text-sm uppercase tracking-[0.3em] text-sky-200 font-semibold mb-4">Berita & Kegiatan</p>
                    <h1 class="text-5xl lg:text-6xl font-bold leading-tight">
                        Artikel Museum Karya SMKN 4 Tasikmalaya
                    </h1>
                    <p class="mt-6 max-w-2xl text-sky-100 text-lg leading-8">
                        Temukan liputan kegiatan, informasi terbaru, dan cerita inspiratif dari Museum Karya. Pilih
                        artikel yang paling menarik untukmu.
                    </p>
                </div>
            </div>
        </div>

    </section>

    <section class="max-w-7xl mx-auto px-6 py-12">

        @if ($articles->count())

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

                @foreach ($articles as $article)
                    <article
                        class="group overflow-hidden rounded-[1.75rem] border border-gray-200/70 bg-white dark:border-gray-800 dark:bg-gray-950 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-2xl">
                        <div class="overflow-hidden">
                            <img src="{{ asset('storage/' . $article->cover) }}"
                                class="w-full h-60 object-cover transition duration-500 group-hover:scale-105">
                        </div>

                        <div class="p-6">
                            <span
                                class="inline-flex rounded-full bg-sky-100 text-sky-700 px-3 py-1 text-xs font-semibold dark:bg-sky-500/15 dark:text-sky-200">
                                {{ $article->category->name }}
                            </span>

                            <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mt-4 leading-snug">
                                {{ $article->title }}
                            </h2>

                            <p class="mt-4 text-gray-600 dark:text-gray-300 text-sm leading-7 line-clamp-3">
                                {{ $article->excerpt }}
                            </p>

                            <div
                                class="mt-6 flex flex-wrap items-center gap-3 text-xs text-gray-500 dark:text-gray-400">
                                <span>{{ $article->author->name }}</span>
                                <span>•</span>
                                <span>{{ $article->created_at->format('d M Y') }}</span>
                            </div>

                            <a href="{{ route('artikel.show', $article->slug) }}"
                                class="mt-6 inline-flex items-center justify-center rounded-full bg-blue-600 px-5 py-2 text-sm font-semibold text-white transition hover:bg-blue-700">
                                Baca Selengkapnya →
                            </a>
                        </div>
                    </article>
                @endforeach

            </div>
        @else
            <div class="text-center py-32">

                <h2 class="text-3xl font-bold">
                    Belum ada artikel.
                </h2>

                <p class="mt-3 text-gray-500">
                    Artikel akan muncul setelah dipublikasikan oleh admin.
                </p>

            </div>

        @endif

    </section>

    <script>
        function applyTheme(theme) {
            document.documentElement.classList.toggle("dark", theme === "dark");
        }

        function toggleTheme() {
            const isDark = document.documentElement.classList.contains("dark");
            const next = isDark ? "light" : "dark";
            localStorage.setItem("theme", next);
            applyTheme(next);
        }

        (function initTheme() {
            const saved = localStorage.getItem("theme");
            const prefersDark = window.matchMedia("(prefers-color-scheme: dark)").matches;
            applyTheme(saved || (prefersDark ? "dark" : "light"));
        })();
    </script>
