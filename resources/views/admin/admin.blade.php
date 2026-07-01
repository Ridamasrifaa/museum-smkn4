<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <title>Manajemen Admin - Karya PPLG</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/admin/style.css') }}" />
  </head>
  <body class="bg-gray-100">
    <div class="flex h-screen bg-gray-100">
      
      <div class="w-64 custom-nav-bg text-white shadow-lg flex flex-col justify-between">
        <div>
          <div class="p-6 border-b border-gray-700">
            <div class="flex items-center gap-3">
              <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center font-bold text-lg">A</div>
              <div>
                <p class="font-bold">{{ Auth::user()->name }}</p>
                <p class="text-xs text-gray-400">PPLG</p>
              </div>
            </div>
          </div>
          <nav class="mt-6 space-y-1">
            <a href="{{ url('/admin/dashboard')}}" class="flex items-center gap-3 px-6 py-3 text-gray-300 hover:bg-gray-800 transition">
              <span>Dashboard</span>
            </a>
            <a href="{{ url('/admin/karya')}}" class="flex items-center gap-3 px-6 py-3 text-gray-300 hover:bg-gray-800 transition">
              <span>Data Karya</span>
            </a>
            <a href="{{ url('/admin/siswa')}}" class="flex items-center gap-3 px-6 py-3 text-gray-300 hover:bg-gray-800 transition">
              <span>Data Siswa</span>
            </a>
            <a href="{{ url('/admin/kategori')}}" class="flex items-center gap-3 px-6 py-3 text-gray-300 hover:bg-gray-800 transition">
              <span>Kategori</span>
            </a>
            <a href="{{ url('/admin/manajemen-admin')}}" class="flex items-center gap-3 px-6 py-3 bg-blue-600 text-white transition">
              <span>Manajemen Admin</span>
            </a>
          </nav>
        </div>
        <div class="p-6 border-t border-gray-700">
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
          </form>
          <button type="button" onclick="handleLogout()" class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-semibold cursor-pointer">
            Logout
          </button>
        </div>
      </div>

      <div class="flex-1 flex flex-col overflow-hidden">
        <header class="bg-white shadow-sm z-10">
          <div class="px-8 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-900">Manajemen Akun Admin</h1>
            <div class="flex items-center gap-4">
              <div class="text-right">
                <p class="font-semibold text-gray-900">Admin</p>
                <p class="text-sm text-gray-500">Login sebagai admin</p>
              </div>
            </div>
          </div>
        </header>

        <div class="p-8 flex-1 overflow-auto relative">
          
          <div id="loading-content" class="absolute inset-0 bg-gray-100 z-50 flex flex-col items-center justify-center transition-opacity duration-300 ease-out">
            <div class="flex items-center gap-3 bg-white px-6 py-3 rounded-full shadow-sm border border-gray-200">
              <div class="w-5 h-5 border-3 border-blue-600 border-t-transparent rounded-full animate-spin"></div>
              <p class="text-gray-700 font-medium text-sm tracking-wide">Memuat data...</p>
            </div>
          </div>

          <div class="mb-6 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-900">Daftar Akun Admin</h2>
            <button onclick="openCreateModal()" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold flex items-center gap-2 cursor-pointer">
              <span>+</span> Tambah Admin
            </button>
          </div>

          <div class="bg-white rounded-lg shadow mb-6 p-4">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Cari Admin</h2>
            <div class="flex flex-col sm:flex-row gap-3">
              <input type="text" id="searchInput" placeholder="Cari username atau email..." class="flex-1 px-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-600 text-sm" />
              
              <button type="button" onclick="document.getElementById('searchInput').value = ''; syncFilteredData();" class="px-6 py-2.5 bg-blue-600 text-white rounded-lg font-semibold hover:bg-gray-600 transition text-sm whitespace-nowrap text-center cursor-pointer">Cari</button>
              <a href="" class="px-6 py-2.5 bg-gray-500 text-white rounded-lg font-semibold hover:bg-gray-600 transition text-sm whitespace-nowrap text-center cursor-pointer">Reset</a>
            </div>
          </div>

          <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="overflow-x-auto">
              <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                  <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider w-16">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Username</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider w-32">Aksi</th>
                  </tr>
                </thead>
                <tbody id="tableBody" class="divide-y divide-gray-200">
                  </tbody>
              </table>
            </div>

            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-between items-center text-sm text-gray-600">
              <span>Total: <span id="totalCount" class="font-bold text-gray-800">0</span> Admin</span>
                <div class="flex gap-2">
                    <button id="prevBtn" onclick="prevPage()" class="px-3 py-1 border border-gray-300 rounded bg-white text-gray-400 cursor-not-allowed text-xs" disabled>Sebelumnya</button>
                    <button id="nextBtn" onclick="nextPage()" class="px-3 py-1 border border-gray-300 rounded bg-white text-gray-400 cursor-not-allowed text-xs" disabled>Selanjutnya</button>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div id="adminModal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
      <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
          <h3 id="modalTitle" class="text-lg font-semibold text-gray-900">Tambah Admin Baru</h3>
          <button type="button" onclick="closeModal()" class="text-gray-400 hover:text-gray-600 cursor-pointer">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
          </button>
        </div>

        <form id="adminForm" class="p-6 space-y-4">
          <input type="hidden" id="adminId">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
            <input type="text" id="username" placeholder="Masukkan username" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" required>
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" id="email" placeholder="Masukkan email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" required>
          </div>

          <div id="passwordGroup">
            <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <input type="password" id="password" placeholder="Masukkan password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
            <p id="passwordHelp" class="text-xs text-gray-400 mt-1 hidden">*Kosongkan password jika tidak ingin mengubahnya.</p>
          </div>

          <div class="flex gap-3 pt-4">
            <button type="button" onclick="closeModal()" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition font-medium text-sm">Batal</button>
            <button type="submit" class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium text-sm">Simpan</button>
          </div>
        </form>
      </div>
    </div>

    <div id="deleteModal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
      <div class="bg-white rounded-lg shadow-xl max-w-sm w-full">
        <div class="px-6 py-4 border-b border-gray-200">
          <h3 class="text-lg font-semibold text-gray-900">Konfirmasi Hapus</h3>
        </div>

        <div class="p-6">
          <p class="text-gray-600 mb-4 text-sm">Apakah Anda yakin ingin menghapus akun admin <span id="deleteAdminUsername" class="font-semibold text-red-600"></span>? Tindakan ini tidak dapat dibatalkan.</p>
          <div class="flex gap-3">
            <button type="button" onclick="closeDeleteModal()" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition font-medium text-sm">Batal</button>
            <button type="button" onclick="confirmDelete()" class="flex-1 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-medium text-sm">Hapus</button>
          </div>
        </div>
      </div>
    </div>

    <script>
  // Database Lokal JS Sementara (Ditambah data dummy agar total 10 data)
  let adminData = [
    { id: 1, email: "budi@example.com", username: "budi_admin" },
    { id: 2, email: "siti@example.com", username: "siti_admin" },
    { id: 3, email: "ahmad@example.com", username: "ahmad_mod" },
    { id: 4, email: "rini@example.com", username: "rini_admin" },
    { id: 5, email: "hendra@example.com", username: "hendra_mod" },
    { id: 6, email: "dewi@example.com", username: "dewi_admin" },
    { id: 7, email: "fajar@example.com", username: "fajar_mod" },
    { id: 8, email: "gita@example.com", username: "gita_admin" },
    { id: 9, email: "adi@example.com", username: "adi_mod" },
    { id: 10, email: "nisa@example.com", username: "nisa_admin" }
  ];

  // Variabel untuk melacak Halaman & Limit Data
  let currentPage = 1;
  const rowsPerPage = 5; // Silakan ganti ke 10 jika ingin maksimal 10 data per halaman
  let filteredData = [...adminData]; // Menyimpan data yang sudah difilter pencarian

  let editingId = null;
  let deleteIdHolder = null;

  // Loading Screen Timer
  window.addEventListener("load", function () {
    const loadingContent = document.getElementById("loading-content");
    setTimeout(() => {
      loadingContent.classList.add("opacity-0");
      setTimeout(() => {
        loadingContent.classList.add("hidden");
      }, 300);
    }, 1000);
  });

  // Fungsi Render Tabel dengan Fitur Pagination
  function renderTable() {
    const tableBody = document.getElementById('tableBody');
    const totalCount = document.getElementById('totalCount');
    
    tableBody.innerHTML = '';
    totalCount.textContent = filteredData.length;

    if(filteredData.length === 0) {
      tableBody.innerHTML = `<tr><td colspan="4" class="text-center py-12 text-gray-500 text-sm">Data tidak ditemukan</td></tr>`;
      updatePaginationButtons(0);
      return;
    }

    // Hitung index data yang akan ditampilkan di halaman aktif
    const startIndex = (currentPage - 1) * rowsPerPage;
    const endIndex = startIndex + rowsPerPage;
    const paginatedData = filteredData.slice(startIndex, endIndex);

    // Hitung total halaman berdasarkan data yang tersedia
    const totalPages = Math.ceil(filteredData.length / rowsPerPage);

    paginatedData.forEach((admin, index) => {
      const row = document.createElement('tr');
      row.className = 'hover:bg-gray-50 transition';

      // Nomor urut dinamis mengikuti halaman saat ini
      const rowNumber = startIndex + index + 1;

      row.innerHTML = `
        <td class="px-6 py-4 text-sm text-gray-900">${rowNumber}</td>
        <td class="px-6 py-4 text-sm text-gray-900 font-medium">${admin.username}</td>
        <td class="px-6 py-4 text-sm text-gray-600">${admin.email}</td>
        <td class="px-6 py-4 text-sm text-center">
          <div class="flex justify-center gap-2">
            <button onclick="openEditModal(${admin.id})" class="px-3 py-1 bg-blue-100 text-blue-600 rounded hover:bg-blue-200 transition font-medium text-xs cursor-pointer">Edit</button>
            <button onclick="openDeleteModal(${admin.id}, '${admin.username}')" class="px-3 py-1 bg-red-100 text-red-600 rounded hover:bg-red-200 transition font-medium text-xs cursor-pointer">Hapus</button>
          </div>
        </td>
      `;
      tableBody.appendChild(row);
    });

    updatePaginationButtons(totalPages);
  }

  // Fungsi Mengatur Tombol Prev/Next Aktif atau Disabled
  function updatePaginationButtons(totalPages) {
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');

    // Atur tombol Sebelumnya
    if (currentPage === 1 || totalPages <= 1) {
      prevBtn.disabled = true;
      prevBtn.className = "px-3 py-1 border border-gray-300 rounded bg-white text-gray-400 cursor-not-allowed text-xs";
    } else {
      prevBtn.disabled = false;
      prevBtn.className = "px-3 py-1 border border-gray-300 rounded bg-white text-gray-700 hover:bg-gray-100 cursor-pointer text-xs";
    }

    // Atur tombol Selanjutnya
    if (currentPage === totalPages || totalPages <= 1) {
      nextBtn.disabled = true;
      nextBtn.className = "px-3 py-1 border border-gray-300 rounded bg-white text-gray-400 cursor-not-allowed text-xs";
    } else {
      nextBtn.disabled = false;
      nextBtn.className = "px-3 py-1 border border-gray-300 rounded bg-white text-gray-700 hover:bg-gray-100 cursor-pointer text-xs";
    }
  }

  // Navigasi Pindah Halaman
  function nextPage() {
    const totalPages = Math.ceil(filteredData.length / rowsPerPage);
    if (currentPage < totalPages) {
      currentPage++;
      renderTable();
    }
  }

  function prevPage() {
    if (currentPage > 1) {
      currentPage--;
      renderTable();
    }
  }

  // Membuka Modal Tambah Admin Baru
  function openCreateModal() {
    editingId = null;
    document.getElementById('modalTitle').textContent = 'Tambah Admin Baru';
    document.getElementById('passwordHelp').classList.add('hidden');
    document.getElementById('password').required = true;
    document.getElementById('adminForm').reset();
    document.getElementById('adminId').value = '';
    document.getElementById('adminModal').classList.remove('hidden');
  }

  // Membuka Modal Ubah Admin
  function openEditModal(id) {
    const admin = adminData.find(a => a.id === id);
    if (!admin) return;

    editingId = id;
    document.getElementById('modalTitle').textContent = 'Edit Admin';
    document.getElementById('passwordHelp').classList.remove('hidden');
    document.getElementById('password').required = false;
    
    document.getElementById('adminId').value = id;
    document.getElementById('username').value = admin.username;
    document.getElementById('email').value = admin.email;
    document.getElementById('password').value = '';
    document.getElementById('adminModal').classList.remove('hidden');
  }

  function closeModal() {
    document.getElementById('adminModal').classList.add('hidden');
    editingId = null;
  }

  // Membuka Modal Konfirmasi Hapus Admin
  function openDeleteModal(id, username) {
    deleteIdHolder = id;
    document.getElementById('deleteAdminUsername').textContent = `@${username}`;
    document.getElementById('deleteModal').classList.remove('hidden');
  }

  function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
    deleteIdHolder = null;
  }

  // Aksi Konfirmasi Hapus Data via JS
  function confirmDelete() {
    if(deleteIdHolder) {
      adminData = adminData.filter(a => a.id !== deleteIdHolder);
      // Sinkronisasi ulang data filter setelah dihapus
      syncFilteredData(); 
      closeDeleteModal();
      showNotification('Admin berhasil dihapus');
    }
  }

  // Submit Form (Handle Tambah & Edit)
  document.getElementById('adminForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const username = document.getElementById('username').value;
    const email = document.getElementById('email').value;

    if (editingId) {
      const admin = adminData.find(a => a.id === editingId);
      if (admin) {
        admin.username = username;
        admin.email = email;
      }
      showNotification('Admin berhasil diperbarui');
    } else {
      const newId = adminData.length > 0 ? Math.max(...adminData.map(a => a.id)) + 1 : 1;
      adminData.push({ id: newId, username, email });
      showNotification('Admin berhasil ditambahkan');
    }
    syncFilteredData();
    closeModal();
  });

  // Filter Pencarian Real-Time (Reset ke Halaman 1 saat mengetik)
  document.getElementById('searchInput').addEventListener('input', function() {
    currentPage = 1; 
    syncFilteredData();
  });

  // Sinkronisasi data utama ke data pencarian
  function syncFilteredData() {
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    filteredData = adminData.filter(admin => {
      return admin.username.toLowerCase().includes(searchTerm) || admin.email.toLowerCase().includes(searchTerm);
    });

    // Validasi pencegahan halaman kosong jika menghapus data di halaman terakhir
    const maxPages = Math.ceil(filteredData.length / rowsPerPage);
    if (currentPage > maxPages && maxPages > 0) {
      currentPage = maxPages;
    }
    renderTable();
  }

  // Notifikasi Toast
  function showNotification(message) {
    const notification = document.createElement('div');
    notification.className = 'fixed bottom-4 right-4 px-6 py-3 bg-green-600 text-white rounded-lg shadow-lg z-50 text-sm font-medium transition duration-300';
    notification.style.animation = 'fade-in-out 3s ease-in-out';
    notification.textContent = message;
    document.body.appendChild(notification);
    setTimeout(() => { notification.remove(); }, 3000);
  }

  // Logout Trigger Form Laravel
  function handleLogout() {
    if (confirm('Anda yakin ingin logout?')) {
      document.getElementById('logout-form').submit();
    }
  }

  // Inisialisasi awal tabel saat dimuat
  syncFilteredData();
</script>

    <style>
      @keyframes fade-in-out {
        0% { opacity: 0; transform: translateY(20px); }
        10% { opacity: 1; transform: translateY(0); }
        90% { opacity: 1; transform: translateY(0); }
        100% { opacity: 0; transform: translateY(20px); }
      }
    </style>
  </body>
</html>