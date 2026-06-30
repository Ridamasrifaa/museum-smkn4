<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <title>Upload Project - Student Dashboard Karya PPLG</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  </head>
  <body class="bg-gray-100">
    <div class="flex h-screen bg-gray-100">
      
      <div class="w-64 bg-gray-900 text-white shadow-lg flex flex-col">
        <div class="p-6 border-b border-gray-700">
          <div class="flex items-center gap-3">
            @if(Auth::user()->avatar)
    <img
        src="{{ Auth::user()->avatar }}"
        alt="Foto Profil"
        class="w-10 h-10 rounded-full object-cover">
@else
    <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold">
        {{ strtoupper(substr(Auth::user()->name,0,1)) }}
    </div>
@endif
            <div>
              <p class="font-bold text-sm">{{ Auth::user()->name }}</p>
            </div>
          </div>
        </div>

        <nav class="mt-6 flex-1">
          <a href="{{ url('/siswa/dashboard')}}" class="w-full flex items-center gap-3 px-6 py-3 hover:bg-gray-800 text-gray-400 hover:text-white transition text-left">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
              <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
            </svg>
            <span>Dashboard</span>
          </a>

          <a href="{{ url('/siswa/karya')}}" class="w-full flex items-center gap-3 px-6 py-3 hover:bg-gray-800 text-gray-400 hover:text-white transition text-left">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
              <path d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.3A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z" />
            </svg>
            <span>Karya Ku</span>
          </a>

          <a href="{{ url('/siswa/upload')}}" class="w-full flex items-center gap-3 px-6 py-3 bg-blue-600 text-white border-l-4 border-blue-500 transition">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.293a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
            <span>Upload Project</span>
          </a>
        </nav>

        <div class="border-t border-gray-700 px-6 py-4">
          <form id="logout-form" action="/logout" method="POST" class="hidden">
            @csrf
          </form>
          <button type="button" onclick="handleLogout()" class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-semibold cursor-pointer">Logout</button>
        </div>
      </div>

      <div class="flex-1 overflow-auto flex flex-col">
        <header class="bg-white shadow-sm z-10">
          <div class="px-8 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-900">Upload Project Baru</h1>
           
          </div>
        </header>

        <div class="flex-1 overflow-auto p-8 relative">
          <div id="loading-content" class="absolute inset-0 bg-gray-100 z-40 flex flex-col items-center justify-center transition-opacity duration-300 ease-out m-0!">
            <div class="flex items-center gap-3 bg-white px-6 py-3 rounded-full shadow-sm border border-gray-200">
              <div class="w-5 h-5 border-3 border-blue-600 border-t-transparent rounded-full animate-spin"></div>
              <p class="text-gray-700 font-medium text-sm tracking-wide">Memuat formulir upload...</p>
            </div>
          </div>

          <div class="max-w-2xl mx-auto bg-white rounded-lg shadow p-8">
<form id="uploadForm" method="POST" action="{{ url('/siswa/upload') }}" class="space-y-6"> 
              @csrf

              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Judul Karya *</label>
                <input type="text" name="title" required placeholder="Contoh: Game Android Tebak Kata" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none" />
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Kategori Project *</label>
                <select name="category_id" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                 <option value="">Pilih Kategori</option>

@foreach($categories as $category)
    <option value="{{ $category->id }}">
        {{ $category->name }}
    </option>
@endforeach
                </select>
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Karya *</label>
                <textarea
                  name="description"
                  required
                  rows="4"
                  placeholder="Jelaskan Hasil karya yang telah anda buat....."
                  class="w-full px-4 py-2 border border-gray-300 rounded-lg resize-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                ></textarea>
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Link Repository (GitHub/GitLab) *</label>
                <input type="url" name="live_link" required placeholder="https://github.com/username/project-name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none" />
              </div>

              <div class="border border-gray-200 rounded-lg bg-gray-50 p-4 space-y-3">
                <h4 class="text-sm font-bold text-gray-800">Syarat & Ketentuan Upload Karya:</h4>
                <ul class="text-xs text-gray-600 list-disc list-inside space-y-1">
                  <li>Karya atau kode program harus asli hasil buatan sendiri/tim kelompok (bukan plagiat).</li>
                  <li>Link repository GitHub/GitLab harus bersifat publik agar bisa diperiksa oleh Admin.</li>
                  <li>Karya yang melanggar hak cipta atau mengandung konten negatif akan langsung dihapus.</li>
                </ul>

                <hr class="border-gray-200 my-2" />

                <div class="flex items-start gap-3">
                  <input type="checkbox" id="agreeCheckbox" class="mt-1 h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 cursor-pointer" onchange="toggleSubmitButton()" />
                  <label for="agreeCheckbox" class="text-xs text-gray-700 leading-normal font-medium cursor-pointer select-none">
                    Saya menyetujui semua syarat dan ketentuan di atas serta menjamin bahwa project yang saya upload adalah karya asli saya sendiri.
                  </label>
                </div>
              </div>

              <div class="flex gap-4 pt-2">
                <button type="button" onclick="resetForm()" class="flex-1 px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition font-medium">Reset</button>
                <button type="submit" id="submitBtn" disabled class="flex-1 px-6 py-2 bg-gray-400 text-white rounded-lg font-medium shadow-md cursor-not-allowed transition">Upload Karya</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div id="successModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
      <div class="bg-white rounded-lg shadow-xl max-w-md w-full p-6 text-center">
        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4 text-green-600 text-2xl font-bold">✓</div>
        <h3 class="text-lg font-bold text-gray-900 mb-2">Berhasil!</h3>
        <p class="text-gray-600 mb-6">Karya mu berhasil diupload dan sedang menunggu tinjauan Dari Admin.</p>
        <a href="{{ url('/siswa/dashboard') }}" class="block w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-center font-semibold transition">Kembali ke Dashboard</a>
      </div>
    </div>

    <script>
      const agreeCheckbox = document.getElementById("agreeCheckbox");
      const submitBtn = document.getElementById("submitBtn");

      // Mengontrol penayangan efek loading awal
      window.addEventListener("load", function () {
        const loadingContent = document.getElementById("loading-content");
        setTimeout(() => {
          loadingContent.classList.add("opacity-0");
          setTimeout(() => {
            loadingContent.classList.add("hidden");
          }, 300);
        }, 1000);
      });

      // Mengaktifkan/mematikan tombol upload berdasarkan status ceklis
      function toggleSubmitButton() {
        if (agreeCheckbox.checked) {
          submitBtn.disabled = false;
          submitBtn.classList.remove("bg-gray-400", "cursor-not-allowed");
          submitBtn.classList.add("bg-blue-600", "hover:bg-blue-700", "shadow-blue-200");
        } else {
          submitBtn.disabled = true;
          submitBtn.classList.remove("bg-blue-600", "hover:bg-blue-700", "shadow-blue-200");
          submitBtn.classList.add("bg-gray-400", "cursor-not-allowed");
        }
      }

      function submitForm(e) {
        // Catatan: Jika ingin langsung mengirim data ke Controller Laravel tanpa memicu modal JS interupsi, 
        // hapus baris `e.preventDefault()` di bawah ini.
       
      }

      function resetForm() {
        document.getElementById("uploadForm").reset();
        toggleSubmitButton();
      }

      function handleLogout() {
        if (confirm("Anda yakin ingin logout?")) {
          document.getElementById('logout-form').submit();
        }
      }
    </script>
  </body>
</html>