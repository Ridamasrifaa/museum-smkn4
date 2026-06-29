<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Data Kategori - Admin Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="../assets/css/admin/style.css" />
  </head>
  <body class="bg-gray-100">
    <div class="flex h-screen bg-gray-100">
      <!-- SIDEBAR -->
      <div class="w-64 custom-nav-bg text-white shadow-lg flex flex-col justify-between">
        <div>
          <div class="p-6 border-b border-gray-700">
            <div class="flex items-center gap-3">
              <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center font-bold text-lg">A <img src="" alt="" /></div>
              <div>
                <p class="font-bold">Admin</p>
                <p class="text-xs text-gray-400">PPLG</p>
              </div>
            </div>
          </div>
          <nav class="mt-6 space-y-1">
            <a href="dashboard.html" class="flex items-center gap-3 px-6 py-3 text-gray-300 nav-link-idle:hover">
              <span>Dashboard</span>
            </a>
            <a href="karya.html" class="flex items-center gap-3 px-6 py-3 nav-link-idle:hover text-gray-300 transition">
              <span>Data Karya</span>
            </a>
            <a href="siswa.html" class="flex items-center gap-3 px-6 py-3 nav-link-idle:hover text-gray-300 transition">
              <span>Data Siswa</span>
            </a>
            <a href="kategori.html" class="flex items-center gap-3 px-6 py-3 nav-link-idle nav-link-active text-gray-300 transition">
              <span>Kategori</span>
            </a>
          </nav>
        </div>
        <div class="p-6 border-t border-gray-700">
          <button class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-semibold">Logout</button>
        </div>
      </div>

      <!-- MAIN CONTENT -->
      <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Header -->
        <header class="bg-white shadow-sm z-10">
          <div class="px-8 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-900">Manajemen Kategori Karya</h1>
            <div class="flex items-center gap-4">
              <div class="text-right">
                <p class="font-semibold text-gray-900">Admin User</p>
                <p class="text-sm text-gray-500">Login sebagai admin </p>
              </div>
            </div>
          </div>
        </header>

        <!-- Area Tabel Kategori -->
        <div class="p-8 flex-1 overflow-auto">
          <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
              <h2 class="text-xl font-bold text-gray-900">Daftar Kategori</h2>
              <button onclick="openModal('tambah-kategori')" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold">Tambah Kategori</button>
            </div>

            <div class="overflow-x-auto">
              <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                  <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Nama Kategori</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Aksi</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                  <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm text-gray-600">1</td>
                    <td class="px-6 py-4 text-sm font-semibold text-gray-900">
                      <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold">Game</span>
                    </td>
                    <td class="px-6 py-4 text-sm">
                      <button class="text-blue-600 hover:text-blue-800 mr-3">Edit</button>
                      <button class="text-red-600 hover:text-red-800">Hapus</button>
                    </td>
                  </tr>

                  <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm text-gray-600">2</td>
                    <td class="px-6 py-4 text-sm font-semibold text-gray-900">
                      <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-xs font-semibold">Website</span>
                    </td>
                    <td class="px-6 py-4 text-sm">
                      <button class="text-blue-600 hover:text-blue-800 mr-3">Edit</button>
                      <button class="text-red-600 hover:text-red-800">Hapus</button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- MODAL TAMBAH KATEGORI (Khusus di halaman kategori) -->
    <div id="tambah-kategori" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
      <div class="bg-white rounded-lg shadow-xl max-w-md w-full p-6">
        <h3 class="text-lg font-bold text-gray-900 mb-4">Tambah Kategori Baru</h3>
        <div class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Kategori</label>
            <input type="text" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Contoh: Mobile App" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
            <textarea class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none resize-none" rows="3" placeholder="Deskripsi singkat kategori..."></textarea>
          </div>
        </div>
        <div class="flex gap-3 mt-6">
          <button onclick="closeModal('tambah-kategori')" class="flex-1 px-4 py-2 border rounded-lg text-gray-700 hover:bg-gray-50">Batal</button>
          <button class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Simpan</button>
        </div>
      </div>
    </div>

    <script>
      function openModal(id) {
        document.getElementById(id).classList.remove("hidden");
      }
      function closeModal(id) {
        document.getElementById(id).classList.add("hidden");
      }
    </script>
  </body>
</html>
