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
<link rel="stylesheet" href="{{ asset('assets/css/index.css')}}">
  </head>

  <body class="scroll-smooth bg-white dark:bg-gray-950 text-gray-900 dark:text-gray-100 transition-colors duration-300">
    <header class="navbar shadow-sm sticky top-0 z-50 bg-white dark:bg-gray-900 transition-colors duration-300">
      <nav class="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8">
        <div class="flex lg:flex-1 items-center gap-2">
          <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold text-lg">🏛️</div>
          <span class="text-2xl font-bold text-blue-600">Museum Karya</span>
        </div>
        <div class="hidden lg:flex lg:gap-x-8 lg:items-center">
          <a href="{{ url('/')}}" class="text-sm font-semibold text-blue-600 border-b-2 border-blue-600 pb-1">Beranda</a>
          <a href="{{ url('/karya')}}" class="text-sm font-semibold text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition">Karya</a>
          <!-- <a href="#" class="text-sm font-semibold text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition">Tentang</a> -->
          <a href="{{ url('/login')}}" class="text-sm font-semibold text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition">Login</a>
          <button id="themeToggle" onclick="toggleTheme()" aria-label="Ganti mode terang/gelap" class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-yellow-300">
            <svg class="icon-sun w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
            <svg class="icon-moon w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
            </svg>
          </button>
        </div>
      </nav>
    </header>

    <section id="beranda" class="my-bg text-white py-32 flex items-center justify-center min-h-screen">
      <div class="mx-auto max-w-7xl px-6 lg:px-8 text-center">
        <h1 class="text-4xl lg:text-6xl font-bold mb-6">Selamat Datang Di Museum Karya SMKN 4 Tasikmalaya</h1>
        <p class="text-xl mb-12">Hasil dari Project Teaching Factory (Tefa)</p>
      </div>
    </section>

    <section id="karya" class="py-16 bg-gray-50 dark:bg-gray-900">
      <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="flex items-center justify-between mb-12">
          <h2 class="text-3xl font-bold">📚 Semua Karya</h2>
          <a href="{{ url('/karya')}}" class="text-blue-600 font-semibold hover:text-blue-700 flex items-center gap-1 transition group">
            Lihat Semua
            <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
          </a>
        </div>
        <div id="allKaryaGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
          <!-- KARTU 1 -->
          <div
            class="karya-card bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-md card-hover transition-colors duration-300"
            data-id="1"
            data-title="Catatan Keuangan"
            data-desc="Platform sistem mencatat keuangan anda dan juga dilengkapi fitur target menabung jadi anda bisa mencapai target menabung anda bisa"
            data-category="Website"
            data-event="Bazarr"
            data-siswa="Zaki Nur Faizy"
            data-guru="Adi Iasan"
            data-avatar="Z"
            data-tahun="2024"
            data-views="342"
            data-likes="89"
            data-tech="Html, Css, Javascript"
            data-live="https://catatan-keuanganzs.netlify.app"
            data-download="/files/catatan-keuangan.zip"
          >
            <div class="iframe-container" onclick="openModal(this.closest('.karya-card'))">
              <iframe src="https://catatan-keuanganzs.netlify.app" loading="lazy"></iframe>
              <div class="overlay"></div>
            </div>
            <div class="p-6">
              <span class="badge-custom mb-3">Website</span>
              <p class="text-gray-600 dark:text-gray-400 text-sm mb-2 mt-2">
                <!-- judul -->
                <strong class="text-gray-900 dark:text-gray-200">Catatan keuangan</strong><br />
                <span class="text-gray-500 dark:text-gray-500 text-xs">Created By developer Zaki Nur Faizi</span>
              </p>
              <!-- deskripsi -->
              <p class="text-gray-900 dark:text-white font-semibold mb-4">Catatan Keuangan</p>
              <button onclick="openModal(this.closest('.karya-card'))" class="w-full py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                  <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                </svg>
                Lihat Detail
              </button>
            </div>
          </div>

          <!-- KARTU 2 -->
          <div
            class="karya-card bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-md card-hover transition-colors duration-300"
            data-id="2"
            data-title="PROPERTY OF ARU"
            data-desc="Take photo then draw it XD - Aplikasi interaktif yang memungkinkan pengguna untuk mengambil foto dan menggambarnya"
            data-category="Game"
            data-event="MVP"
            data-siswa="Almira Lubnaa K"
            data-guru="Guru Pembimbing"
            data-avatar="A"
            data-tahun="2024"
            data-views="256"
            data-likes="64"
            data-tech="Unity, C#"
            data-live="https://almiralubnaakhansa.itch.io"
            data-download="/files/property-of-aru.zip"
          >
            <div class="iframe-container" onclick="openModal(this.closest('.karya-card'))">
              <iframe src="https://almiralubnaakhansa.itch.io" loading="lazy"></iframe>
              <div class="overlay"></div>
            </div>
            <div class="p-6">
              <span class="badge-custom mb-3">Game</span>
              <p class="text-gray-600 dark:text-gray-400 text-sm mb-2 mt-2">
                <!-- judul karya -->
                <strong class="text-gray-900 dark:text-gray-200">Almira Lubnaa K</strong><br />
                <span class="text-gray-500 dark:text-gray-500 text-xs">oleh almiralubnaakhansa</span>
              </p>
              <!-- deskripsi -->
              <p class="text-gray-900 dark:text-white font-semibold mb-4">PROPERTY OF ARU</p>
              
              <button onclick="openModal(this.closest('.karya-card'))" class="w-full py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                  <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                </svg>
                Lihat Detail
              </button>
            </div>
          </div>

          <!-- KARTU 3 -->
          <div
            class="karya-card bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-md card-hover transition-colors duration-300"
            data-id="3"
            data-title="Fleyer Donor Darah KARSA PRADA"
            data-desc="Fleyer digital untuk kampanye donor darah KARSA PRADA dengan desain yang menarik dan informatif"
            data-category="Website"
            data-event="Bazarr"
            data-siswa="Alwan Lutfi M"
            data-guru="Guru Pembimbing"
            data-avatar="A"
            data-tahun="2024"
            data-views="198"
            data-likes="45"
            data-tech="React, Tailwind CSS"
            data-live="https://donor-karsa-prada.netlify.app"
            data-download="/files/donor-karsa-prada.zip"
          >
            <div class="iframe-container" onclick="openModal(this.closest('.karya-card'))">
              <iframe src="https://donor-karsa-prada.netlify.app" loading="lazy"></iframe>
              <div class="overlay"></div>
            </div>
            <div class="p-6">
              <span class="badge-custom mb-3">Website</span>
              <p class="text-gray-600 dark:text-gray-400 text-sm mb-2 mt-2">
                <!-- judul -->
                <strong class="text-gray-900 dark:text-gray-200">Alwan Lutfi M</strong><br />
                <span class="text-gray-500 dark:text-gray-500 text-xs">oleh alwanlutfimaulida</span>
              </p>
              <!-- deskripsi -->
              <p class="text-gray-900 dark:text-white font-semibold mb-4">Fleyer Donor Darah KARSA PRADA</p>
              
              <button onclick="openModal(this.closest('.karya-card'))" class="w-full py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                  <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                </svg>
                Lihat Detail
              </button>
            </div>
          </div>

          <!-- KARTU 4 -->
          <div
            class="karya-card bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-md card-hover transition-colors duration-300"
            data-id="4"
            data-title="E-Learning Platform"
            data-desc="Platform pembelajaran online dengan fitur video streaming, quiz interaktif, dan tracking progress siswa"
            data-category="Website"
            data-event="MVP"
            data-siswa="Budi Santoso"
            data-guru="Bu Siti"
            data-avatar="B"
            data-tahun="2024"
            data-views="512"
            data-likes="156"
            data-tech="React, Express, PostgreSQL"
            data-live="https://elearning-demo.vercel.app"
            data-download="/files/elearning-platform.zip"
          >
            <div class="iframe-container" onclick="openModal(this.closest('.karya-card'))">
              <iframe src="https://elearning-demo.vercel.app" loading="lazy"></iframe>
              <div class="overlay"></div>
            </div>
            <div class="p-6">
              <span class="badge-custom mb-3">Website</span>
              <p class="text-gray-600 dark:text-gray-400 text-sm mb-2 mt-2">
                <!-- judul -->
                <strong class="text-gray-900 dark:text-gray-200">Budi Santoso</strong><br />
                <span class="text-gray-500 dark:text-gray-500 text-xs">oleh budisantoso</span>
              </p>
              <!-- deskripsi -->
              <p class="text-gray-900 dark:text-white font-semibold mb-4">E-Learning Platform</p>
              
              <button onclick="openModal(this.closest('.karya-card'))" class="w-full py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                  <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                </svg>
                Lihat Detail
              </button>
            </div>
          </div>

          <!-- KARTU 5 -->
          <div
            class="karya-card bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-md card-hover transition-colors duration-300"
            data-id="5"
            data-title="Mobile Weather App"
            data-desc="Aplikasi mobile untuk melihat informasi cuaca dengan detail, forecast 7 hari, dan notifikasi peringatan"
            data-category="Mobile App"
            data-event="MVP"
            data-siswa="Siti Nurhaliza"
            data-guru="Pak Ahmad"
            data-avatar="S"
            data-tahun="2024"
            data-views="428"
            data-likes="98"
            data-tech="Flutter, Firebase"
            data-live="https://play.google.com/store/apps/details?id=com.weather.app"
            data-download="/files/weather-app.apk"
          >
            <div class="iframe-container gradient-cyan flex items-center justify-center" onclick="openModal(this.closest('.karya-card'))">
              <p class="text-white font-bold text-3xl">🌤️</p>
            </div>
            <div class="p-6">
              <span class="badge-custom mb-3">Mobile App</span>
              <p class="text-gray-600 dark:text-gray-400 text-sm mb-2 mt-2">
                <!-- judul karya -->
                <strong class="text-gray-900 dark:text-gray-200">Siti Nurhaliza</strong><br />
                <span class="text-gray-500 dark:text-gray-500 text-xs">oleh sitinurhaliza</span>
              </p>
              <!-- deskripsi  -->
              <p class="text-gray-900 dark:text-white font-semibold mb-4">Mobile Weather App</p>
              
              <button onclick="openModal(this.closest('.karya-card'))" class="w-full py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                  <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                </svg>
                Lihat Detail
              </button>
            </div>
          </div>

          <!-- KARTU 6 -->
          <div
            class="karya-card bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-md card-hover transition-colors duration-300"
            data-id="6"
            data-title="Social Media Dashboard"
            data-desc="Dashboard untuk mengelola multiple social media accounts dengan scheduling posts dan analytics"
            data-category="Website"
            data-event="Bazarr"
            data-siswa="Diana Kusuma"
            data-guru="Bu Rini"
            data-avatar="D"
            data-tahun="2024"
            data-views="367"
            data-likes="82"
            data-tech="Vue.js, Python"
            data-live="https://social-dashboard-demo.vercel.app"
            data-download="/files/social-dashboard.zip"
          >
            <div class="iframe-container" onclick="openModal(this.closest('.karya-card'))">
              <iframe src="https://social-dashboard-demo.vercel.app" loading="lazy"></iframe>
              <div class="overlay"></div>
            </div>
            <div class="p-6">
              <span class="badge-custom mb-3">Website</span>
              <p class="text-gray-600 dark:text-gray-400 text-sm mb-2 mt-2">
                <!-- judul karya -->
                <strong class="text-gray-900 dark:text-gray-200">Diana Kusuma</strong><br />
                <span class="text-gray-500 dark:text-gray-500 text-xs">oleh dianakusuma</span>
              </p>
              <!-- deskripsi -->
              <p class="text-gray-900 dark:text-white font-semibold mb-4">Social Media Dashboard</p>
              
              <button onclick="openModal(this.closest('.karya-card'))" class="w-full py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                  <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                </svg>
                Lihat Detail
              </button>
            </div>
          </div>
          <!-- KARTU 7 -->
          <div
            class="karya-card bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-md card-hover transition-colors duration-300"
            data-id="6"
            data-title="voting-kokurikuler"
            data-desc="dikembangkan pada tanggal 25 juni 2026"
            data-category="website voting"
            data-event="kokurikuler"
            data-siswa="Zaki Nur Faizi"
            data-guru="---"
            data-avatar="D"
            data-tahun="2026"
            data-views="367"
            data-likes="82"
            data-tech="Html,css, javascript"
            data-live="https://voting-kokurikuler.netlify.app"
            data-download="/files/social-dashboard.zip"
          >
            <div class="iframe-container" onclick="openModal(this.closest('.karya-card'))">
              <iframe src="https://voting-kokurikuler.netlify.app" loading="lazy"></iframe>
              <div class="overlay"></div>
            </div>
            <div class="p-6">
              <span class="badge-custom mb-3">Website</span>
              <p class="text-gray-600 dark:text-gray-400 text-sm mb-2 mt-2">
                <!-- judul karya -->
                <strong class="text-gray-900 dark:text-gray-200">Rida Masrifa</strong><br />
                <span class="text-gray-500 dark:text-gray-500 text-xs">created By developer Rida masrifa</span>
              </p>
              <!-- deskripsi -->
              <p class="text-gray-900 dark:text-white font-semibold mb-4">Voting kokurikuler</p>
              <button onclick="openModal(this.closest('.karya-card'))" class="w-full py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                  <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                </svg>
                Lihat Detail
              </button>
            </div>
          </div>
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
    <div id="detailModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
      <div class="bg-white dark:bg-gray-900 rounded-lg shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto transition-colors duration-300">
        <div class="sticky top-0 px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center bg-white dark:bg-gray-900">
          <h3 id="modalTitle" class="text-xl font-bold text-gray-900 dark:text-white"></h3>
          <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
          </button>
        </div>
        <div class="p-6 space-y-6">
          <div class="flex gap-2 flex-wrap">
            <span class="inline-block bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 px-3 py-1 rounded-full text-sm font-semibold">✅ Disetujui</span>
            <span id="modalCategory" class="inline-block bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 px-3 py-1 rounded-full text-sm font-semibold"></span>
            <span id="modalEvent" class="inline-block bg-purple-100 dark:bg-purple-900 text-purple-800 dark:text-purple-200 px-3 py-1 rounded-full text-sm font-semibold"></span>
          </div>
          <div>
            <h4 class="font-semibold text-gray-900 dark:text-white mb-2">Deskripsi</h4>
            <p id="modalDescription" class="text-gray-700 dark:text-gray-300 leading-relaxed"></p>
          </div>
          <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded-lg">
            <div class="flex items-center gap-3">
              <div id="modalAvatar" class="w-12 h-12 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold text-lg"></div>
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
            <a id="liveBtn" href="#" target="_blank" class="px-4 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition text-center">🔗 Buka Live</a>
            <a id="downloadBtn" href="#" download class="px-4 py-2 border-2 border-blue-600 text-blue-600 dark:text-blue-400 rounded-lg font-semibold hover:bg-blue-50 dark:hover:bg-blue-950 transition text-center">📥 Download</a>
          </div>
        </div>
      </div>
    </div>

    <script>
      // ===== Dark / Light Mode =====
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

      // ===== Modal (baca data langsung dari atribut data-* card, tanpa array JS) =====
      function openModal(card) {
        if (!card) return;
        const d = card.dataset;
        document.getElementById("modalTitle").textContent = d.title;
        document.getElementById("modalCategory").textContent = d.category;
        document.getElementById("modalEvent").textContent = "🎉 " + d.event;
        document.getElementById("modalDescription").textContent = d.desc;
        document.getElementById("modalSiswa").textContent = d.siswa;
        document.getElementById("modalGuru").textContent = "👨‍🏫 " + d.guru;
        document.getElementById("modalKategoriDetail").textContent = d.category;
        document.getElementById("modalTahun").textContent = d.tahun;
        document.getElementById("modalViews").textContent = d.views;
        document.getElementById("modalLikes").textContent = d.likes;
        document.getElementById("modalTech").textContent = d.tech;
        document.getElementById("modalAvatar").textContent = d.avatar;
        document.getElementById("downloadBtn").href = d.download;
        document.getElementById("liveBtn").href = d.live;
        document.getElementById("detailModal").classList.remove("hidden");
      }

      function closeModal() {
        document.getElementById("detailModal").classList.add("hidden");
      }

      document.getElementById("detailModal").addEventListener("click", (e) => {
        if (e.target.id === "detailModal") closeModal();
      });
    </script>
  </body>
</html>
