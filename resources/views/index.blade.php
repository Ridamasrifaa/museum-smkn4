<!doctype html>
<html lang="id">

<head>
  
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Museum Karya</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        .my-bg {
            background-color: #046d9793;
        }

        body {
            background-color: #9e9a9ab6;
        }

        .navbar {
            background-color: #ffffff;
        }
    </style>
</head>

<body>
    <!-- header navbar -->
    <header class="navbar shadow-sm sticky top-0 z-50">
        <nav class="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8">
            <div class="flex lg:flex-1 items-center gap-2">
                <div class="w-8 h-8 bg-gray-700 rounded-full flex items-center justify-center">
                    <img src="" alt="Logo" />
                </div>
                <span class="text-2xl font-bold text-blue-600">Museum Karya</span>
            </div>

            <div class="hidden lg:flex lg:gap-x-8">
                <a href="#"
                    class="text-sm font-semibold text-blue-600 border-b-2 border-blue-600 pb-1">Beranda</a>
                <!-- <a href="#" class="text-sm font-semibold text-gray-600 hover:text-gray-900">Artikel</a> -->
                <a href="#" class="text-sm font-semibold text-gray-600 hover:text-gray-900">Karya</a>
                <div class="hidden lg:flex lg:justify-end">
                    <a href="login.html" class="text-sm font-semibold text-gray-600 hover:text-gray-900">Login</a>
                </div>
            </div>
        </nav>
    </header>

    <!-- section di bagian hero -->
    <section class="my-bg text-white py-16">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-6">
                <div class="w-full">
                    <h1 class="text-4xl lg:text-5xl font-bold mb-4 max-w-4xl">Selamat Datang Di Museum Karya Smk Negeri
                        4 Tasikmalaya</h1>
                </div>

                <div class="py-1">
                    <!-- Teks deskripsi sekarang bisa memanjang ke kanan -->
                    <p class="text-xl text-gray-200 mb-1 w-full">Eksplorasi karya Siswa Dalam Bidang Software dan Game
                    </p>
                    <p class="text-base text-gray-300 mb-8 w-full">Hasil dari Project Teaching Factory (Tefa)</p>

                    <div class="flex flex-wrap mt-5 gap-4">
                        <button
                            class="px-6 py-3 border-2 border-white text-white rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition">Login
                            untuk Upload Karya</button>
                        <button
                            class="px-6 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">Telusuri
                            Karya Siswa</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- search dan karya  -->
    <section class="py-12 bg-gradient-to-b from-purple-50 to-pink-50">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mb-12">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Cari Karya</h2>
                <div class="flex gap-3">
                    <input type="text" placeholder="Cari judul, deskripsi, atau kata kunci..."
                        class="flex-1 px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-600" />
                    <button
                        class="px-8 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">Cari
                        Karya</button>
                </div>
            </div>
        </div>
    </section>

    <!-- card terbaru -->
    <section class="py-16 bg-white">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="flex items-center justify-between mb-12">
                <h2 class="text-3xl font-bold text-gray-900">Terbaru</h2>
                <a href="karya.html" class="text-blue-600 font-semibold hover:text-blue-700 flex items-center gap-1">
                    Lihat Semua → </a>
            </div>

            <!-- card karya -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- CARD 1 -->
                <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition">
                    <div
                        class="bg-gradient-to-br from-yellow-400 to-orange-400 h-48 flex items-center justify-center text-center p-4">
                        <div>
                            <p class="text-white font-bold text-2xl">LARI ESTAFET GERAKAN TANGAN</p>
                            <p class="text-white text-sm mt-2">Kelas PJOK</p>
                        </div>
                    </div>
                    <div class="p-6">
                        <span
                            class="inline-block bg-gray-200 text-gray-700 text-xs font-semibold px-3 py-1 rounded-full mb-3">Website</span>
                        <p class="text-gray-600 text-sm mb-4">
                            <strong>OKTAVIA AYU W</strong><br />
                            <span class="text-gray-500">oleh oktaviaayuulandaripplg2202419727</span>
                        </p>
                        <p class="text-gray-900 font-semibold mb-4">power point lari estafet pjok</p>
                        <button
                            class="w-full py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                <path fill-rule="evenodd"
                                    d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Lihat
                        </button>
                    </div>
                </div>

                <!-- CARD 2 -->
                <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition">
                    <div class="bg-blue-400 h-48 flex items-center justify-center text-center p-4">
                        <div>
                            <p class="text-white font-bold text-2xl">PROPERTY OF ARU</p>
                        </div>
                    </div>
                    <div class="p-6">
                        <span
                            class="inline-block bg-gray-200 text-gray-700 text-xs font-semibold px-3 py-1 rounded-full mb-3">
                            Game </span>
                        <p class="text-gray-600 text-sm mb-4">
                            <strong>ALMIRA LUBNAA K</strong><br />
                            <span class="text-gray-500">oleh almiralubnaakhansa</span>
                        </p>
                        <p class="text-gray-900 font-semibold mb-4">Take photo then draw it XD</p>
                        <button
                            class="w-full py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                <path fill-rule="evenodd"
                                    d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Lihat
                        </button>
                    </div>
                </div>

                <!-- CARD 3 -->
                <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition">
                    <div
                        class="bg-gradient-to-br from-blue-400 to-blue-600 h-48 flex items-center justify-center text-center p-4">
                        <div>
                            <p class="text-white font-bold text-2xl">DONOR DARAH KARSA PRADA</p>
                        </div>
                    </div>
                    <div class="p-6">
                        <span
                            class="inline-block bg-gray-200 text-gray-700 text-xs font-semibold px-3 py-1 rounded-full mb-3">
                            Website </span>
                        <p class="text-gray-600 text-sm mb-4">
                            <strong>ALWAN LUTFI M</strong><br />
                            <span class="text-gray-500">oleh alwanlutfimaulidappla2202419702</span>
                        </p>
                        <p class="text-gray-900 font-semibold mb-4">Fleyer Donor Darah KARSA PRADA</p>
                        <button
                            class="w-full py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                <path fill-rule="evenodd"
                                    d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Lihat
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- dibagian footer -->
    <footer class="bg-gray-900 text-white text-center py-5">
        <div class="border-gray-800 text-center text-gray-400 text-sm">
            <p>&copy; 2026.</p>
            <p>&copy; Design By Development</p>
        </div>
    </footer>
</body>

</html>
