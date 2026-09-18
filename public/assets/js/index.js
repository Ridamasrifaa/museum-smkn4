// ==========================================
// 1. TEMA TERANG / GELAP (DARK MODE)
// ==========================================
function toggleTheme() {
    const isDark = document.documentElement.classList.toggle('dark');
    localStorage.setItem('theme', isDark ? 'dark' : 'light');
}

// Set tema awal berdasarkan localStorage saat halaman dimuat
(function() {
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark' || (!savedTheme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }
})();


// ==========================================
// 2. ANIMASI COUNTER STATISTIK
// ==========================================
document.addEventListener("DOMContentLoaded", () => {
    const counters = document.querySelectorAll('.counter');
    
    counters.forEach(counter => {
        const target = +counter.getAttribute('data-target');
        let count = 0;
        const speed = target / 50; // Atur kecepatan animasi

        const updateCount = () => {
            count += speed;
            if (count < target) {
                counter.innerText = Math.ceil(count);
                setTimeout(updateCount, 30);
            } else {
                counter.innerText = target;
            }
        };
        
        // Jalankan animasi counter
        if (target > 0) {
            updateCount();
        } else {
            counter.innerText = 0;
        }
    });
});


// ==========================================
// 3. MODAL DETAIL KARYA
// ==========================================
function openModal(card) {
    const modal = document.getElementById('detailModal');
    if (!modal) return;

    // Ambil data dari atribut data-* kartu karya
    const title = card.getAttribute('data-title');
    const description = card.getAttribute('data-desc');
    const category = card.getAttribute('data-category');
    const eventName = card.getAttribute('data-event');
    const siswa = card.getAttribute('data-siswa');
    const guru = card.getAttribute('data-guru');
    const avatar = card.getAttribute('data-avatar');
    const avatarLetter = card.getAttribute('data-avatar-letter');
    const kelas = card.getAttribute('data-kelas');
    const jurusanSiswa = card.getAttribute('data-jurusan-siswa');
    const tahun = card.getAttribute('data-tahun');
    const tech = card.getAttribute('data-tech');
    const liveLink = card.getAttribute('data-live');
    const githubLink = card.getAttribute('data-github');
    const filePath = card.getAttribute('data-file-path');
    const fileType = card.getAttribute('data-file-type');

    // Set Judul & Deskripsi
    document.getElementById('modalTitle').innerText = title || 'Detail Karya';
    document.getElementById('modalDescription').innerText = description || 'Tidak ada deskripsi.';
    document.getElementById('modalCategory').innerText = category || '-';
    document.getElementById('modalEvent').innerText = eventName || 'Museum Karya';
    document.getElementById('modalKategoriDetail').innerText = category || '-';
    document.getElementById('modalTahun').innerText = tahun || '-';
    document.getElementById('modalTech').innerText = tech || '-';
    document.getElementById('modalSiswa').innerText = siswa || 'Siswa';
    document.getElementById('modalBiodata').innerText = `${kelas || '-'} • ${jurusanSiswa || '-'}`;
    

    // Set Avatar Siswa
    const avatarContainer = document.getElementById('modalAvatar');
    if (avatar && avatar !== '') {
        avatarContainer.innerHTML = `<img src="${avatar}" alt="${siswa}" class="w-full h-full object-cover">`;
    } else {
        avatarContainer.innerHTML = avatarLetter || 'S';
    }

    // Set Preview (Gambar / Iframe / Kosong)
    const imgPreview = document.getElementById('modalImagePreview');
    const iframePreview = document.getElementById('modalIframePreview');
    const emptyPreview = document.getElementById('modalPreviewEmpty');

    imgPreview.classList.add('hidden');
    iframePreview.classList.add('hidden');
    emptyPreview.classList.add('hidden');

    const isImage = fileType && fileType.startsWith('image/');

    if (isImage && filePath) {
        imgPreview.src = filePath;
        imgPreview.classList.remove('hidden');
    } else if (liveLink) {
        iframePreview.src = liveLink;
        iframePreview.classList.remove('hidden');
    } else if (filePath) {
        // Jika file berupa dokumen/lainnya
        emptyPreview.innerHTML = `<a href="${filePath}" target="_blank" class="text-blue-600 underline font-semibold">Unduh/Lihat Berkas Lampiran</a>`;
        emptyPreview.classList.remove('hidden');
    } else {
        emptyPreview.innerText = 'Tidak ada preview tersedia';
        emptyPreview.classList.remove('hidden');
    }

    // Tombol Live Link & Github/Action
    const liveBtn = document.getElementById('liveBtn');
    const extraBtn = document.getElementById('extraBtn');
    const githubIcon = document.getElementById('githubIcon');
    const extraBtnText = document.getElementById('extraBtnText');

    if (liveLink) {
        liveBtn.href = liveLink;
        liveBtn.parentElement.style.display = 'block';
    } else {
        liveBtn.parentElement.style.display = 'none';
    }

    if (githubLink && githubLink !== '') {
        extraBtn.href = githubLink;
        extraBtnText.innerText = 'GitHub';
        githubIcon.classList.remove('hidden');
        extraBtn.parentElement.style.display = 'block';
    } else if (filePath) {
        extraBtn.href = filePath;
        extraBtnText.innerText = 'Unduh Berkas';
        githubIcon.classList.add('hidden');
        extraBtn.parentElement.style.display = 'block';
    } else {
        extraBtn.parentElement.style.display = 'none';
    }

    // Tampilkan Modal
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden'; // Mencegah background scroll
}

function closeModal() {
    const modal = document.getElementById('detailModal');
    if (modal) {
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto'; // Kembalikan scroll
        
        // Hentikan pemutaran iframe saat modal ditutup
        const iframePreview = document.getElementById('modalIframePreview');
        if (iframePreview) iframePreview.src = '';
    }
}

// Tutup modal ketika mengklik di luar area konten modal
window.addEventListener('click', (event) => {
    const modal = document.getElementById('detailModal');
    if (event.target === modal) {
        closeModal();
    }
});