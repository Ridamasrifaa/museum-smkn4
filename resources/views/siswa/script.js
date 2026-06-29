// Konfigurasi Halaman & Judul Tab
const pages = {
  'dashboard': { file: 'dashboard.html', title: 'Student Dashboard' },
  'karya': { file: 'karya-saya.html', title: 'Karya Saya' },
  'upload': { file: 'upload-project.html', title: 'Upload Project Baru' }
};

// Fungsi memuat konten dinamis (AJAX Fetch)
function switchTab(tabName) {
  const page = pages[tabName];
  if (!page) return;

  // Ubah Judul Header
  document.getElementById('page-title').textContent = page.title;

  // Ambil file HTML eksternal dan masukkan ke main-content-area
  fetch(page.file)
    .then(response => {
      if (!response.ok) throw new Error('Gagal memuat halaman');
      return response.text();
    })
    .then(html => {
      document.getElementById('main-content-area').innerHTML = html;
      updateSidebarActiveState(tabName);
    })
    .catch(err => {
      document.getElementById('main-content-area').innerHTML = `<p class="text-red-500 font-semibold">Gagal memuat halaman: ${err.message}</p>`;
    });
}

// Mengatur style tombol menu yang sedang aktif
function updateSidebarActiveState(activeTab) {
  const buttons = {
    'dashboard': document.getElementById('btn-dashboard'),
    'karya': document.getElementById('btn-karya'),
    'upload': document.getElementById('btn-upload')
  };

  Object.keys(buttons).forEach(key => {
    if (!buttons[key]) return;
    if (key === activeTab) {
      buttons[key].classList.add('bg-blue-600', 'text-white', 'border-blue-500');
      buttons[key].classList.remove('text-gray-400', 'border-transparent');
    } else {
      buttons[key].classList.remove('bg-blue-600', 'text-white', 'border-blue-500');
      buttons[key].classList.add('text-gray-400', 'border-transparent');
    }
  });
}

// Pengendali Kirim Form di upload-project.html
function handleFormSubmit(e) {
  e.preventDefault();
  alert('Proses upload karya...');
  document.getElementById('successModal').classList.remove('hidden');
}

function resetForm() {
  document.getElementById('uploadForm').reset();
}

// Fungsi Modal
function closeModal(modalId) {
  document.getElementById(modalId).classList.add('hidden');
}

function goToDashboard() {
  closeModal('successModal');
  switchTab('dashboard');
}

function viewDetails(title) {
  document.getElementById('detailTitle').textContent = title;
  document.getElementById('detailContent').innerHTML = `
    <div class="space-y-4">
      <p class="text-gray-600">Detail deskripsi produk projek dari "${title}".</p>
      <div class="flex gap-2">
         <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs">HTML/CSS</span>
         <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs">Tailwind</span>
      </div>
    </div>`;
  document.getElementById('detailModal').classList.remove('hidden');
}

function logout() {
  if (confirm('Anda yakin ingin logout?')) {
    alert('Anda telah logout');
  }
}

// Muat halaman dashboard saat pertama kali web dibuka
window.addEventListener('DOMContentLoaded', () => {
  switchTab('dashboard');
});