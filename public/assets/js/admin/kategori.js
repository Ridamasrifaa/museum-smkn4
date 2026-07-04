// SCRIPT LOADING SCREEN LOKAL (100% menggunakan durasi FE Anda)
window.addEventListener("load", function () {
    const loadingContent = document.getElementById("loading-content");
    setTimeout(() => {
        loadingContent.classList.add("opacity-0");
        setTimeout(() => loadingContent.classList.add("hidden"), 300);
    }, 1000);
});

// SCRIPT MODAL BOX DINAMIS (Menggunakan logika BE teman Anda)
function openKategoriModal(mode, element = null) {
    const form = document.getElementById("modal-form");
    const title = document.getElementById("modal-title");
    const input = document.getElementById("input-name");
    const method = document.getElementById("method-container");

    if (mode === "tambah") {
        title.innerHTML = "Tambah Kategori Baru";
        form.action = "/admin/kategori/store";
        method.innerHTML = "";
        input.value = "";
    } else {
        title.innerHTML = "Edit Kategori";
        form.action = "/admin/kategori/" + element.dataset.id + "/update";
        method.innerHTML = '<input type="hidden" name="_method" value="PUT">';
        input.value = element.dataset.name;
    }

    document.getElementById("kategori-modal").classList.remove("hidden");
}

function closeKategoriModal() {
    document.getElementById("kategori-modal").classList.add("hidden");
}

// LOGOUT HANDLER
function handleLogout() {
    if (confirm("Anda yakin ingin logout?")) {
        document.getElementById("logout-form").submit();
    }
}
