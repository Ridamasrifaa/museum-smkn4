<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Data Karya - Admin Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/admin/style.css')}}">
  </head>
  <body class="bg-gray-100 relative">

    <div id="toast-container" class="fixed top-5 right-5 z-55 flex flex-col gap-3"></div>

    <div class="flex h-screen bg-gray-100">
      <div class="w-64 custom-nav-bg text-white shadow-lg flex flex-col justify-between">
        <div>
          <div class="p-6 border-b border-gray-700">
            <div class="flex items-center gap-3">
              <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center font-bold text-lg">A</div>
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
            <a href="karya.html" class="flex items-center gap-3 px-6 py-3 nav-link-idle nav-link-active transition">
              <span>Data Karya</span>
            </a>
            <a href="siswa.html" class="flex items-center gap-3 px-6 py-3 nav-link-idle:hover text-gray-300 transition">
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
            <h1 class="text-2xl font-bold text-gray-900">Manajemen Data Karya</h1>
            <div class="flex items-center gap-4">
              <div class="text-right">
                <p class="font-semibold text-gray-900">Admin User</p>
                <p class="text-sm text-gray-500">Login sebagai admin</p>
              </div>
            </div>
          </div>
        </header>

        <div class="p-8 flex-1 overflow-auto">
          <div class="bg-white mb-6 rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Cari Karya</h2>
            <div class="flex flex-col sm:flex-row gap-3">
              <input type="text" placeholder="Cari judul, deskripsi, atau kata kunci..." class="flex-1 px-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-600 text-sm" />
              <button class="px-6 py-2.5 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition text-sm whitespace-nowrap">Cari</button>
            </div>
          </div>

          <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
              <h2 class="text-xl font-bold text-gray-900">Daftar Karya</h2>
            </div>
            <div class="overflow-x-auto">
              <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                  <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Judul</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Siswa</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Kategori</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Url</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Status</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase">Aksi</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                  <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm font-semibold text-gray-900">Game Android</td>
                    <td class="px-6 py-4 text-sm text-gray-600">Oktavia Ayu W</td>
                    <td class="px-6 py-4"><span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold">Game</span></td>
                    <td class="px-6 py-4"><span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold"><a href="https://github.com" target="_blank">https://github.com</a></span></td>
                    <td class="px-6 py-4"><span id="status-1" class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-semibold">Menunggu</span></td>
                    <td id="action-1" class="px-6 py-4 text-center">
                      <button onclick="openModal('approve-karya', 'Oktavia Ayu W', 1)" class="px-3 py-1 bg-green-100 text-green-700 hover:bg-green-200 rounded text-xs font-semibold mr-2 transition cursor-pointer">Approve</button>
                      <button onclick="openModal('reject-karya', 'Oktavia Ayu W', 1)" class="px-3 py-1 bg-red-100 text-red-700 hover:bg-red-200 rounded text-xs font-semibold transition cursor-pointer">Reject</button>
                    </td>
                  </tr>

                  <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm font-semibold text-gray-900">Web E-Commerce Resto</td>
                    <td class="px-6 py-4 text-sm text-gray-600">Ahmad Fauzi</td>
                    <td class="px-6 py-4"><span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-xs font-semibold">Website</span></td>
                    <td class="px-6 py-4"><span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-xs font-semibold"><a href="https://github.com" target="_blank">https://github.com</a></span></td>
                    <td class="px-6 py-4"><span id="status-2" class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-semibold">Menunggu</span></td>
                    <td id="action-2" class="px-6 py-4 text-center">
                      <button onclick="openModal('approve-karya', 'Ahmad Fauzi', 2)" class="px-3 py-1 bg-green-100 text-green-700 hover:bg-green-200 rounded text-xs font-semibold mr-2 transition cursor-pointer">Approve</button>
                      <button onclick="openModal('reject-karya', 'Ahmad Fauzi', 2)" class="px-3 py-1 bg-red-100 text-red-700 hover:bg-red-200 rounded text-xs font-semibold transition cursor-pointer">Reject</button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div id="approve-karya" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4">
      <div class="bg-white rounded-lg shadow-xl max-w-md w-full p-6">
        <h3 class="text-lg font-bold text-gray-900 mb-2">Setujui Karya</h3>
        <p class="text-sm text-gray-600 mb-4">Berikan catatan atau alasan menyetujui karya milik <span id="approve-siswa-name" class="font-bold text-gray-800"></span> (opsional):</p>
        <textarea id="approve-note" class="w-full p-2 border border-gray-300 rounded mb-4 focus:outline-blue-500" rows="3" placeholder="Contoh: Karya sangat bagus dan memenuhi kriteria."></textarea>
        <div class="flex gap-3">
          <button onclick="closeModal('approve-karya')" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">Batal</button>
          <button onclick="submitApprove()" class="flex-1 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-semibold">Setujui & Kirim</button>
        </div>
      </div>
    </div>

    <div id="reject-karya" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4">
      <div class="bg-white rounded-lg shadow-xl max-w-md w-full p-6">
        <h3 class="text-lg font-bold text-gray-900 mb-2">Tolak Karya</h3>
        <p class="text-sm text-gray-600 mb-4">Berikan alasan penolakan karya milik <span id="reject-siswa-name" class="font-bold text-gray-800"></span>:</p>
        <textarea id="reject-note" class="w-full p-2 border border-gray-300 rounded mb-4 focus:outline-red-500" rows="3" placeholder="Contoh: File dokumen pendukung belum lengkap."></textarea>
        <div class="flex gap-3">
          <button onclick="closeModal('reject-karya')" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">Batal</button>
          <button onclick="submitReject()" class="flex-1 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-semibold">Tolak & Kirim</button>
        </div>
      </div>
    </div>

    <script>
      let currentSiswaName = '';
      let currentKaryaId = null;

      function openModal(id, siswaName, karyaId) {
        currentSiswaName = siswaName;
        currentKaryaId = karyaId;

        if (id === 'approve-karya') {
          document.getElementById('approve-siswa-name').innerText = siswaName;
          document.getElementById('approve-note').value = '';
        } else if (id === 'reject-karya') {
          document.getElementById('reject-siswa-name').innerText = siswaName;
          document.getElementById('reject-note').value = '';
        }

        document.getElementById(id).classList.remove("hidden");
      }

      function closeModal(id) {
        document.getElementById(id).classList.add("hidden");
      }

      function showToast(message, type = 'success') {
        const container = document.getElementById('toast-container');
        const toast = document.createElement('div');
        const bgClass = type === 'success' ? 'bg-green-600' : 'bg-red-600';

        toast.className = `${bgClass} text-white px-5 py-3 rounded-lg shadow-lg flex items-center justify-between text-sm min-w-[300px] transition-all duration-300 transform translate-y-2 opacity-0`;
        toast.innerHTML = `
          <span>${message}</span>
          <button onclick="this.parentElement.remove()" class="ml-3 font-bold hover:text-gray-200">✕</button>
        `;

        container.appendChild(toast);

        setTimeout(() => {
          toast.classList.remove('translate-y-2', 'opacity-0');
        }, 10);

        setTimeout(() => {
          toast.classList.add('opacity-0', 'translate-y-[-10px]');
          setTimeout(() => toast.remove(), 300);
        }, 3500);
      }

      // SUBMIT APPROVE (SETUJU)
      function submitApprove() {
        // 1. Ubah Badge Status jadi Disetujui
        const statusBadge = document.getElementById(`status-${currentKaryaId}`);
        if(statusBadge) {
          statusBadge.className = "px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold";
          statusBadge.innerText = "Disetujui";
        }

        // 2. Ubah Tombol Aksi Menjadi Tombol "Lihat"
        const actionCell = document.getElementById(`action-${currentKaryaId}`);
        if(actionCell) {
          actionCell.innerHTML = `
            <button onclick="lihatKarya(${currentKaryaId})" class="px-3 py-1 bg-blue-100 text-blue-700 hover:bg-blue-200 rounded text-xs font-semibold transition cursor-pointer">
              Lihat
            </button>
          `;
        }

        closeModal('approve-karya');
        showToast(`Notifikasi berhasil dikirim! Karya ${currentSiswaName} telah disetujui.`, 'success');
      }

      // SUBMIT REJECT (TOLAK)
      function submitReject() {
        const note = document.getElementById('reject-note').value.trim();
        if (!note) {
          alert('Mohon isi alasan penolakan terlebih dahulu!');
          return;
        }

        // 1. Ubah Badge Status jadi Ditolak
        const statusBadge = document.getElementById(`status-${currentKaryaId}`);
        if(statusBadge) {
          statusBadge.className = "px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs font-semibold";
          statusBadge.innerText = "Ditolak";
        }

        // 2. Hilangkan Semua Tombol Aksi (Tinggalkan tanda strip atau kosong)
        const actionCell = document.getElementById(`action-${currentKaryaId}`);
        if(actionCell) {
          actionCell.innerHTML = `<span class="text-gray-400">-</span>`;
        }

        closeModal('reject-karya');
        showToast(`Notifikasi penolakan berhasil dikirim ke ${currentSiswaName}.`, 'danger');
      }

      // Fungsi Pembantu saat Tombol "Lihat" di klik (Bisa kamu kembangkan nanti)
      function lihatKarya(id) {
        alert(`Membuka detail data karya dengan ID: ${id}`);
        // Contoh implementasi asli nanti: window.location.href = `detail-karya.html?id=${id}`;
      }
    </script>
  </body>
</html>