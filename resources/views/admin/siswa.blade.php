<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Data Siswa - Admin Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="../assets/css/admin/style.css" />
  </head>
  <body class="bg-gray-100">
    <div class="flex h-screen bg-gray-100">
      <div class="w-64 custom-nav-bg text-white shadow-lg flex flex-col justify-between">
        <div>
          <div class="p-6 border-b border-gray-700">
            <div class="flex items-center gap-3">
              <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center font-bold text-lg">A <img src="" alt=""></div>
              <div>
                <p class="font-bold">Admin</p>
                <p class="text-xs text-gray-400">PPLG</p>
              </div>
            </div>
          </div>
          <nav class="mt-6 space-y-1">
            <a href="dashboard.html" class="flex items-center gap-3 px-6 py-3 nav-link-idle:hover text-gray-300">
              <span>Dashboard</span>
            </a>
            <a href="karya.html" class="flex items-center gap-3 px-6 py-3 nav-link-idle:hover text-gray-300 transition">
              <span>Data Karya</span>
            </a>
            <a href="siswa.html" class="flex items-center gap-3 px-6 py-3  nav-link-idle nav-link-active text-gray-300 transition">
              <span>Data Siswa</span>
            </a>
            <a href="kategori.html" class="flex items-center gap-3 px-6 py-3 nav-link-idle:hover text-gray-300 transition">
              <span>Kategori</span>
            </a>
          </nav>
        </div>
        <div class="p-6 border-t border-gray-700">
          <button class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-semibold">Logout</button>
        </div>
      </div>

      <div class="flex-1 flex flex-col overflow-hidden">
        <header class="bg-white shadow-sm z-10">
          <div class="px-8 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-900">Manajemen Data Siswa</h1>
            <div class="flex items-center gap-4">
              <div class="text-right">
                <p class="font-semibold text-gray-900">Admin User</p>
                <p class="text-sm text-gray-500">Login sebagai admin</p>
              </div>
            </div>
          </div>
        </header>

        <div class="p-8 flex-1 overflow-auto space-y-6">
          <!-- Section Search (Sekarang sejajar dan serasi dengan tabel) -->
          <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Cari Siswa</h2>
            <div class="flex flex-col sm:flex-row gap-3">
              <input type="text" placeholder="Cari nama, kelas, atau email siswa..." class="flex-1 px-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-600 text-sm" />
              <button class="px-6 py-2.5 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition text-sm whitespace-nowrap">Cari Siswa</button>
            </div>
          </div>

          <!-- Section Tabel Daftar Siswa -->
          <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
              <h2 class="text-xl font-bold text-gray-900">Daftar Siswa</h2>
              <!-- <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold">Tambah Siswa</button> -->
            </div>
            <div class="overflow-x-auto">
              <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                  <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Kelas</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Aksi</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                  <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm font-semibold text-gray-900">Oktavia Ayu W</td>
                    <td class="px-6 py-4 text-sm text-gray-600">XII RPL 1</td>
                    <td class="px-6 py-4 text-sm text-gray-600">oktavia@email.com</td>
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
  </body>
</html>
