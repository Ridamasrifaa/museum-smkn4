<!doctype html>
<html lang="id">

<head>

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Museum Karya - SMKN 4 Tasikmalaya</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <style type="text/tailwindcss">
        @custom-variant dark (&:where(.dark, .dark *));
    </style>
    <link rel="stylesheet" href="{{ asset('assets/css/index.css') }}">
    <style>
        /* Icon toggle mode terang/gelap: disamakan dengan halaman artikel, tampilkan salah satu sesuai mode aktif */
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
                    🏛️</div>
                <span class="text-2xl font-bold text-blue-600">Museum Karya</span>
            </div>
            <div class="hidden lg:flex lg:gap-x-8 lg:items-center">
                <a href="{{ url('/') }}"
                    class="text-sm font-semibold text-blue-600 border-b-2 border-blue-600 pb-1">Beranda</a>
                <a href="{{ url('/karya') }}"
                    class="text-sm font-semibold text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition">Karya</a>
                <a href="{{ url('/artikel') }}"
                    class="text-sm font-semibold text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition">Artikel</a>
                <a href="{{ url('/login') }}"
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

    <section id="beranda" class="my-bg text-white py-32 flex items-center justify-center" style="height: 350px;">
        <div class="mx-auto max-w-7xl px-6 lg:px-8 text-center">
            <h1 class="text-4xl lg:text-6xl font-bold mb-6">Selamat Datang Di Museum Karya SMKN 4 Tasikmalaya</h1>
            <p class="text-xl mb-12">Hasil dari Project Teaching Factory (Tefa)</p>
        </div>
    </section>

    {{-- ===== Kartu Statistik: dipindahkan ke atas, tampil sebelum Semua Karya ===== --}}
    <section class="py-16 bg-white dark:bg-gray-950">
        <div class="max-w-7xl mx-auto px-6">

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">

                <div
                    class="counter-card bg-white dark:bg-gray-900 rounded-2xl shadow-lg p-8 text-center border border-gray-100 dark:border-gray-800">
                    <div class="text-5xl mb-4">📚</div>

                    <p class="text-gray-500 mb-3">
                        Total Karya
                    </p>

                    <div class="flex justify-center items-end gap-1">
                        <h2 class="counter text-blue-600" data-target="{{ $totalKarya }}">0</h2>
                        <!-- Span plus dinonaktifkan: tidak ditampilkan -->
                        <!-- <span class="counter-plus text-blue-600">+</span> -->
                    </div>
                </div>





                <div
                    class="counter-card bg-white dark:bg-gray-900 rounded-2xl shadow-lg p-8 text-center border border-gray-100 dark:border-gray-800">
                    <div class="text-5xl mb-4">👨‍🎓</div>

                    <p class="text-gray-500 mb-3">
                        Total Siswa
                    </p>

                    <h2 class="counter" data-target="{{ $totalSiswa }}">
                        0
                    </h2>

                    <!-- Span plus dinonaktifkan: tidak ditampilkan -->
                    <!-- <span class="text-purple-600 font-bold text-xl">+</span> -->
                </div>


                <div
                    class="counter-card bg-white dark:bg-gray-900 rounded-2xl shadow-lg p-8 text-center border border-gray-100 dark:border-gray-800">
                    <div class="text-5xl mb-4">👨‍🏫</div>

                    <p class="text-gray-500 mb-3">
                        Guru Pembimbing
                    </p>

                    <h2 class="counter" data-target="{{ $totalAdmin }}">
                        0
                    </h2>

                    <!-- Span plus dinonaktifkan: tidak ditampilkan -->
                    <!-- <span class="text-red-600 font-bold text-xl">+</span> -->
                </div>

            </div>

        </div>
    </section>

    <section id="karya" class="py-16 bg-gray-50 dark:bg-gray-900">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="flex items-center justify-between mb-12">
                <h2 class="text-3xl font-bold">📚 Semua Karya</h2>
                <a href="{{ url('/karya') }}"
                    class="text-blue-600 font-semibold hover:text-blue-700 flex items-center gap-1 transition group">
                    Lihat Semua
                    <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
            <div id="allKaryaGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @forelse($projects as $project)
                    <div class="karya-card bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-md card-hover transition-colors duration-300"
                        data-title="{{ $project->title }}" data-desc="{{ $project->description }}"
                        data-category="{{ $project->jurusan }}" data-event="Museum Karya"
                        data-siswa="{{ $project->user->name }}" data-guru="{{ $project->guru_pengampu ?? '-' }}"
                        data-avatar="{{ strtoupper(substr($project->user->name, 0, 1)) }}"
                        data-tahun="{{ $project->created_at->format('Y') }}" data-views="{{ $project->views_count }}"
                        data-likes="{{ $project->likes_count }}" data-tech="{{ $project->technology_stack }}"
                        data-live="{{ $project->live_link }}"
                        data-file-path="{{ $project->file_path ? asset('storage/' . $project->file_path) : '' }}"
                        data-file-type="{{ $project->file_type }}" data-download="#">

                        <div class="iframe-container" onclick="openModal(this.closest('.karya-card'))">
                            @php
                                $isImage = $project->file_path && str_starts_with($project->file_type ?? '', 'image/');
                            @endphp

                            @if ($isImage)
                                <img src="{{ asset('storage/' . $project->file_path) }}" alt="{{ $project->title }}"
                                    class="w-full h-full object-cover" />
                            @elseif ($project->live_link)
                                <iframe src="{{ $project->live_link }}" loading="lazy"></iframe>
                            @else
                                <div class="flex items-center justify-center h-full bg-gray-200">
                                    Tidak ada Preview
                                </div>
                            @endif

                            <div class="overlay"></div>

                        </div>

                        <div class="p-6">

                            <span class="badge-custom mb-3">
                                {{ $project->jurusan }}
                            </span>

                            <p class="text-gray-600 text-sm mt-2">

                                <strong>
                                    {{ $project->user->name }}
                                </strong>

                            </p>

                            <p class="font-semibold mb-4">

                                {{ $project->title }}

                            </p>

                            <button onclick="openModal(this.closest('.karya-card'))"
                                class="w-full py-3 bg-blue-600 text-white rounded-lg">

                                Lihat Detail

                            </button>

                        </div>

                    </div>

                @empty

                    <div class="col-span-4 text-center py-20">

                        <h2 class="text-2xl font-bold">
                            Belum ada karya yang disetujui
                        </h2>

                    </div>
                @endforelse

            </div>
        </div>
    </section>

    <footer class="bg-gray-900 dark:bg-black text-white text-center py-12">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="border-t border-gray-800 pt-8">
                <p class="text-gray-400 text-sm">&copy; 2026 Museum Karya SMKN 4 Tasikmalaya</p>
                <p class="text-gray-400 text-sm">Design &amp; Development By PPLG</p>
            </div>
        </div>
    </footer>

    <!-- Modal Detail -->
    <div id="detailModal"
        class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div
            class="bg-white dark:bg-gray-900 rounded-lg shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto transition-colors duration-300">
            <div
                class="sticky top-0 px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center bg-white dark:bg-gray-900">
                <h3 id="modalTitle" class="text-xl font-bold text-gray-900 dark:text-white"></h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="p-6 space-y-6">
                <div id="modalPreview" class="space-y-4">
                    <img id="modalImagePreview" class="hidden w-full rounded-lg object-contain max-h-[360px]" />
                    <iframe id="modalIframePreview" class="hidden w-full h-80 rounded-lg border border-gray-200"
                        allowfullscreen></iframe>
                    <div id="modalPreviewEmpty"
                        class="hidden w-full h-80 flex items-center justify-center rounded-lg bg-gray-100 text-gray-600 border border-dashed border-gray-300">
                        Tidak ada preview tersedia
                    </div>
                </div>
                <div class="flex gap-2 flex-wrap">
                    <span
                        class="inline-block bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 px-3 py-1 rounded-full text-sm font-semibold">✅
                        Disetujui</span>
                    <span id="modalCategory"
                        class="inline-block bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 px-3 py-1 rounded-full text-sm font-semibold"></span>
                    <span id="modalEvent"
                        class="inline-block bg-purple-100 dark:bg-purple-900 text-purple-800 dark:text-purple-200 px-3 py-1 rounded-full text-sm font-semibold"></span>
                </div>
                <div>
                    <h4 class="font-semibold text-gray-900 dark:text-white mb-2">Deskripsi</h4>
                    <p id="modalDescription" class="text-gray-700 dark:text-gray-300 leading-relaxed"></p>
                </div>
                <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded-lg">
                    <div class="flex items-center gap-3">
                        <div id="modalAvatar"
                            class="w-12 h-12 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold text-lg">
                        </div>
                        <div>
                            <p id="modalSiswa" class="font-semibold text-gray-900 dark:text-white"></p>
                            <p id="modalGuru" class="text-sm text-gray-600 dark:text-gray-400"></p>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded-lg">
                        <p class="text-sm text-gray-600 dark:text-gray-400 font-medium mb-1">Kategori</p>
                        <p id="modalKategoriDetail" class="font-semibold text-gray-900 dark:text-white"></p>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded-lg">
                        <p class="text-sm text-gray-600 dark:text-gray-400 font-medium mb-1">Tahun</p>
                        <p id="modalTahun" class="font-semibold text-gray-900 dark:text-white"></p>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="text-center bg-blue-50 dark:bg-blue-950 p-4 rounded-lg">
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">👁️ Dilihat</p>
                        <p class="text-2xl font-bold text-blue-600 dark:text-blue-400" id="modalViews"></p>
                    </div>
                    <div class="text-center bg-red-50 dark:bg-red-950 p-4 rounded-lg">
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">❤️ Suka</p>
                        <p class="text-2xl font-bold text-red-600 dark:text-red-400" id="modalLikes"></p>
                    </div>
                </div>
                <div>
                    <h4 class="font-semibold text-gray-900 dark:text-white mb-2">🛠️ Teknologi</h4>
                    <p id="modalTech" class="text-gray-700 dark:text-gray-300"></p>
                </div>
                <div class="grid grid-cols-2 gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                    <a id="liveBtn" href="#" target="_blank"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition text-center">🔗
                        Buka Live</a>
                    <a id="downloadBtn" href="#" download
                        class="px-4 py-2 border-2 border-blue-600 text-blue-600 dark:text-blue-400 rounded-lg font-semibold hover:bg-blue-50 dark:hover:bg-blue-950 transition text-center">📥
                        Download</a>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/index.js') }}"></script>
</body>

</html>
