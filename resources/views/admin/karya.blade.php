<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <title>Data Karya - Admin Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/admin/style.css') }}" />
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
            <a href="{{ url('/admin/dashboard')}}" class="flex items-center gap-3 px-6 py-3 text-gray-300 transition">
              <span>Dashboard</span>
            </a>
            <a href="{{ url('/admin/karya')}}" class="flex items-center gap-3 px-6 py-3 bg-blue-600 text-white transition">
              <span>Data Karya</span>
            </a>
            <a href="{{ url('/admin/siswa')}}" class="flex items-center gap-3 px-6 py-3 text-gray-300 transition">
              <span>Data Siswa</span>
            </a>
            <a href="{{ url('/admin/kategori')}}" class="flex items-center gap-3 px-6 py-3 text-gray-300 transition">
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

        <div class="p-8 flex-1 overflow-auto relative">
          <div id="loading-content" class="absolute inset-0 bg-gray-100 z-40 flex flex-col items-center justify-center transition-opacity duration-300 ease-out">
            <div class="flex items-center gap-3 bg-white px-6 py-3 rounded-full shadow-sm border border-gray-200">
              <div class="w-5 h-5 border-3 border-blue-600 border-t-transparent rounded-full animate-spin"></div>
              <p class="text-gray-700 font-medium text-sm tracking-wide">Memuat data karya...</p>
            </div>
          </div>

          <div class="bg-white mb-6 rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Cari Karya</h2>
            <div class="flex flex-col sm:flex-row gap-3">
              <input type="text" placeholder="Cari judul, deskripsi, atau kata kunci..." class="flex-1 px-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-600 text-sm" />
              <button class="px-6 py-2.5 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition text-sm whitespace-nowrap">Cari</button>
            </div>
          </div>

          <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
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
                    <td class="px-6 py-4">
                      <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold"><a href="https://github.com" target="_blank">https://github.com</a></span>
                    </td>
                    <td class="px-6 py-4"><span id="status-1" class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-semibold">Menunggu</span></td>
                    <td id="action-1" class="px-6 py-4 text-center">
                      <button type="button" onclick="openActionModal('approve', this)" data-id="1" data-nama="Oktavia Ayu W" class="px-3 py-1 bg-green-100 text-green-700 hover:bg-green-200 rounded text-xs font-semibold mr-1 transition cursor-pointer">Approve</button>
                      <button type="button" onclick="openActionModal('reject', this)" data-id="1" data-nama="Oktavia Ayu W" class="px-3 py-1 bg-red-100 text-red-700 hover:bg-red-200 rounded text-xs font-semibold transition cursor-pointer">Reject</button>
                    </td>
                  </tr>

                  <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm font-semibold text-gray-900">Web E-Commerce Resto</td>
                    <td class="px-6 py-4 text-sm text-gray-600">Ahmad Fauzi</td>
                    <td class="px-6 py-4"><span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-xs font-semibold">Website</span></td>
                    <td class="px-6 py-4">
                      <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-xs font-semibold"><a href="https://github.com" target="_blank">https://github.com</a></span>
                    </td>
                    <td class="px-6 py-4"><span id="status-2" class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-semibold">Menunggu</span></td>
                    <td id="action-2" class="px-6 py-4 text-center">
                      <button type="button" onclick="openActionModal('approve', this)" data-id="2" data-nama="Ahmad Fauzi" class="px-3 py-1 bg-green-100 text-green-700 hover:bg-green-200 rounded text-xs font-semibold mr-1 transition cursor-pointer">Approve</button>
                      <button type="button" onclick="openActionModal('reject', this)" data-id="2" data-nama="Ahmad Fauzi" class="px-3 py-1 bg-red-100 text-red-700 hover:bg-red-200 rounded text-xs font-semibold transition cursor-pointer">Reject</button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div id="action-modal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4">
      <div class="bg-white rounded-lg shadow-xl max-w-md w-full p-6">
        <h3 id="modal-title" class="text-lg font-bold text-gray-900 mb-2">Konfirmasi Aksi</h3>
        <p class="text-sm text-gray-600 mb-4">
          Berikan catatan/alasan untuk karya milik <span id="modal-siswa-name" class="font-bold text-gray-800"></span>:
        </p>
        
        <form id="modal-form" method="POST" action="">
          @csrf
          @method('PUT')
          
          <input type="hidden" name="status" id="modal-status-input" value="">

          <textarea id="modal-note" name="catatan" class="w-full p-2 border border-gray-300 rounded mb-4 focus:outline-none" rows="3"></textarea>
          
          <div class="flex gap-3">
            <button type="button" onclick="closeActionModal()" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">Batal</button>
            <button type="button" onclick="submitModalForm()" id="modal-submit-btn" class="flex-1 px-4 py-2 text-white rounded-lg transition font-semibold">Kirim</button>
          </div>
        </form>
      </div>
    </div>

    <script>
      // SCRIPT LOADING SCREEN
      window.addEventListener("load", function () {
        const loadingContent = document.getElementById("loading-content");
        setTimeout(() => {
          loadingContent.classList.add("opacity-0");
          setTimeout(() => loadingContent.classList.add("hidden"), 300);
        }, 1000);
      });

      // VARIABEL STATE LOKAL
      let currentKaryaId = null;
      let currentSiswaName = "";

      // FUNGSI MEMBUKA MODAL
      function openActionModal(type, element) {
        currentKaryaId = element.getAttribute('data-id');
        currentSiswaName = element.getAttribute('data-nama');

        const modal = document.getElementById('action-modal');
        const title = document.getElementById('modal-title');
        const nameContainer = document.getElementById('modal-siswa-name');
        const statusInput = document.getElementById('modal-status-input');
        const textarea = document.getElementById('modal-note');
        const submitBtn = document.getElementById('modal-submit-btn');
        const form = document.getElementById('modal-form');

        nameContainer.innerText = currentSiswaName;
        textarea.value = "";

        // Contoh set URL action form Laravel secara statis
        form.action = `/admin/karya/${currentKaryaId}/update-status`; 

        if (type === 'approve') {
          title.innerText = "Setujui Karya";
          statusInput.value = "disetujui";
          textarea.placeholder = "Contoh: Karya sangat bagus dan memenuhi kriteria...";
          textarea.required = false;
          textarea.className = "w-full p-2 border border-gray-300 rounded mb-4 focus:ring-2 focus:ring-green-500 outline-none";
          
          submitBtn.innerText = "Setujui & Kirim";
          submitBtn.className = "flex-1 px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition font-semibold";
        } else if (type === 'reject') {
          title.innerText = "Tolak Karya";
          statusInput.value = "ditolak";
          textarea.placeholder = "Contoh: Mohon perbaiki repositori karena masih private...";
          textarea.required = true;
          textarea.className = "w-full p-2 border border-gray-300 rounded mb-4 focus:ring-2 focus:ring-red-500 outline-none";
          
          submitBtn.innerText = "Tolak & Kirim";
          submitBtn.className = "flex-1 px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition font-semibold";
        }

        modal.classList.remove('hidden');
      }

      function closeActionModal() {
        document.getElementById('action-modal').classList.add('hidden');
      }

      // FUNGSI SIMULASI AKSIS SETELAH SUBMIT MODAL
      function submitModalForm() {
        const statusInput = document.getElementById('modal-status-input').value;
        const textarea = document.getElementById('modal-note');

        if (statusInput === 'ditolak' && !textarea.value.trim()) {
          alert("Mohon isi alasan penolakan terlebih dahulu!");
          return;
        }

        const statusBadge = document.getElementById(`status-${currentKaryaId}`);
        const actionCell = document.getElementById(`action-${currentKaryaId}`);

        if (statusInput === 'disetujui') {
          if (statusBadge) {
            statusBadge.className = "px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold";
            statusBadge.innerText = "Disetujui";
          }
          if (actionCell) {
            actionCell.innerHTML = `<button type="button" class="px-3 py-1 bg-blue-100 text-blue-700 rounded text-xs font-semibold transition">Lihat</button>`;
          }
          showToast(`Karya milik ${currentSiswaName} berhasil disetujui!`, "success");
        } else {
          if (statusBadge) {
            statusBadge.className = "px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs font-semibold";
            statusBadge.innerText = "Ditolak";
          }
          if (actionCell) {
            actionCell.innerHTML = `<span class="text-gray-400">-</span>`;
          }
          showToast(`Karya milik ${currentSiswaName} ditolak.`, "danger");
        }

        closeActionModal();

        // CATATAN: Jika ingin form benar-benar mengirim data ke Controller Laravel lewat Route,
        // aktifkan baris kode di bawah ini:
        document.getElementById('modal-form').submit();
      }

      // TOAST NOTIFIKASI LOKAL
      function showToast(message, type = "success") {
        const container = document.getElementById("toast-container");
        const toast = document.createElement("div");
        const bgClass = type === "success" ? "bg-green-600" : "bg-red-600";

        toast.className = `${bgClass} text-white px-5 py-3 rounded-lg shadow-lg flex items-center justify-between text-sm min-w-[300px] transition-all duration-300`;
        toast.innerHTML = `
          <span>${message}</span>
          <button onclick="this.parentElement.remove()" class="ml-3 font-bold hover:text-gray-200">✕</button>
        `;
        container.appendChild(toast);
        setTimeout(() => toast.remove(), 3500);
      }
    </script>
  </body>
</html>