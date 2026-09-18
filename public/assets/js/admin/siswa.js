// Loading Screen Timer
window.addEventListener("load", function () {
    const loadingContent = document.getElementById("loading-content");
    if (loadingContent) {
        setTimeout(() => {
            loadingContent.classList.add("opacity-0");
            setTimeout(() => {
                loadingContent.classList.add("hidden");
            }, 300);
        }, 1000);
    }
});

// Modal Controller Edit Siswa
function openSiswaModal(element) {
    const modal = document.getElementById("siswa-modal");
    const form = document.getElementById("modal-form");

    const id = element.getAttribute("data-id");
    const nama = element.getAttribute("data-nama");
    const kelas = element.getAttribute("data-kelas");
    const email = element.getAttribute("data-email");

    form.action = `/admin/siswa/${id}/update`;

    document.getElementById("input-nama").value = nama || "";
    document.getElementById("input-kelas").value = kelas || "";
    document.getElementById("input-email").value = email || "";

    modal.classList.remove("hidden");
}

function closeSiswaModal() {
    document.getElementById("siswa-modal").classList.add("hidden");
}

// Modal Controller Hapus Siswa
function confirmDeleteSiswa(element) {
    const modal = document.getElementById("modal-hapus-siswa");
    const form = document.getElementById("form-hapus-siswa");
    const labelNama = document.getElementById("delete-siswa-nama");

    const id = element.getAttribute("data-id");
    const nama = element.getAttribute("data-nama");

    form.action = `/admin/siswa/${id}`;
    labelNama.innerText = nama;

    modal.classList.remove("hidden");
}

function closeHapusSiswaModal() {
    document.getElementById("modal-hapus-siswa").classList.add("hidden");
}

// Logout Form Trigger
function handleLogout() {
    if (confirm("Anda yakin ingin logout?")) {
        const logoutForm = document.getElementById("logout-form");
        if (logoutForm) {
            logoutForm.submit();
        }
    }
}