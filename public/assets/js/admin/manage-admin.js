let editingId = null;
let deleteIdHolder = null;

// Efek loading page
window.addEventListener("load", function () {
    const loadingContent = document.getElementById("loading-content");
    setTimeout(() => {
        loadingContent.classList.add("opacity-0");
        setTimeout(() => {
            loadingContent.classList.add("hidden");
        }, 300);
    }, 1000);
});

// Perbaikan Event delegation Utama
document.addEventListener("click", function (e) {
    const btn = e.target.closest("[data-action]");
    if (!btn) return;

    const id = btn.dataset.id;
    const username = btn.dataset.username; // Diubah dari dataset.name agar konsisten

    if (btn.dataset.action === "edit") {
        editAdmin(id, username, btn.dataset.email);
    }

    if (btn.dataset.action === "delete") {
        openDeleteModal(id, username);
    }
});

function openCreateModal() {
    editingId = null;
    deleteIdHolder = null;
    document.getElementById("modalTitle").textContent = "Tambah Admin Baru";
    document.getElementById("passwordHelp").classList.add("hidden");
    document.getElementById("password").required = true;
    document.getElementById("adminForm").reset();
    document.getElementById("adminId").value = "";
    document.getElementById("formMethod").value = "POST";
    document.getElementById("adminForm").action =
        "{{ url('/admin/manajemen-admin') }}";
    document.getElementById("adminModal").classList.remove("hidden");
}

function editAdmin(id, username, email) {
    editingId = id;
    document.getElementById("modalTitle").textContent = "Edit Admin";
    document.getElementById("passwordHelp").classList.remove("hidden");
    document.getElementById("password").required = false;
    document.getElementById("username").value = username;
    document.getElementById("email").value = email;
    document.getElementById("adminId").value = id;
    document.getElementById("formMethod").value = "PUT";
    document.getElementById("adminForm").action =
        "{{ url('/admin/manajemen-admin') }}/" + id;
    document.getElementById("adminModal").classList.remove("hidden");
}

function closeModal() {
    document.getElementById("adminModal").classList.add("hidden");
    editingId = null;
}

function openDeleteModal(id, username) {
    deleteIdHolder = id;
    document.getElementById("deleteAdminUsername").textContent = `@${username}`;
    document.getElementById("deleteModal").classList.remove("hidden");
}

function closeDeleteModal() {
    deleteIdHolder = null;
    document.getElementById("deleteModal").classList.add("hidden");
}

function confirmDelete() {
    if (!deleteIdHolder) return;
    const form = document.getElementById("deleteForm-" + deleteIdHolder);
    if (form) {
        form.submit();
    }
}

function handleLogout() {
    if (confirm("Anda yakin ingin logout?")) {
        document.getElementById("logout-form").submit();
    }
}
