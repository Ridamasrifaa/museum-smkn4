let selectedAdminId = null;

// Mengatur visibilitas field jurusan berdasarkan role
function toggleJurusanField() {
    const roleSelect = document.getElementById('role');
    const jurusanGroup = document.getElementById('jurusanGroup');
    const jurusanInput = document.getElementById('jurusan');

    if (!roleSelect || !jurusanGroup || !jurusanInput) return;

    if (roleSelect.value === '1') {
        jurusanGroup.style.display = 'block';
        jurusanInput.setAttribute('required', 'required');
    } else {
        jurusanGroup.style.display = 'none';
        jurusanInput.removeAttribute('required');
        jurusanInput.value = '';
    }
}

// Membuka modal untuk Tambah Admin
function openCreateModal() {
    const form = document.getElementById('adminForm');
    const modalTitle = document.getElementById('modalTitle');
    const formMethod = document.getElementById('formMethod');
    const adminId = document.getElementById('adminId');
    const passwordGroup = document.getElementById('passwordGroup');
    const passwordInput = document.getElementById('password');
    const passwordHelp = document.getElementById('passwordHelp');
    const adminModal = document.getElementById('adminModal');

    if (form) {
        form.reset();
        form.action = '/superadmin/manajemen-admin';
    }
    if (modalTitle) modalTitle.innerText = 'Tambah Admin Baru';
    if (formMethod) formMethod.value = 'POST';
    if (adminId) adminId.value = '';
    if (passwordGroup) passwordGroup.style.display = 'block';
    if (passwordInput) passwordInput.setAttribute('required', 'required');
    if (passwordHelp) passwordHelp.classList.add('hidden');
    
    toggleJurusanField();
    if (adminModal) adminModal.classList.remove('hidden');
}

// Membuka modal untuk Edit Admin
function openEditModal(data) {
    const form = document.getElementById('adminForm');
    const modalTitle = document.getElementById('modalTitle');
    const formMethod = document.getElementById('formMethod');
    const adminId = document.getElementById('adminId');
    const usernameInput = document.getElementById('username');
    const emailInput = document.getElementById('email');
    const roleSelect = document.getElementById('role');
    const jurusanInput = document.getElementById('jurusan');
    const passwordGroup = document.getElementById('passwordGroup');
    const passwordInput = document.getElementById('password');
    const passwordHelp = document.getElementById('passwordHelp');
    const adminModal = document.getElementById('adminModal');

    if (form) {
        form.action = `/superadmin/manajemen-admin/${data.id}`;
    }
    if (modalTitle) modalTitle.innerText = 'Edit Akun Admin';
    if (formMethod) formMethod.value = 'PUT';
    if (adminId) adminId.value = data.id;
    if (usernameInput) usernameInput.value = data.username;
    if (emailInput) emailInput.value = data.email;
    if (roleSelect) roleSelect.value = data.role;
    
    toggleJurusanField();
    
    if (jurusanInput && data.role == '1') {
        jurusanInput.value = data.jurusan || '';
    }

    if (passwordGroup) passwordGroup.style.display = 'block';
    if (passwordInput) passwordInput.removeAttribute('required');
    if (passwordHelp) passwordHelp.classList.remove('hidden');
    if (adminModal) adminModal.classList.remove('hidden');
}

// Menutup modal form admin
function closeModal() {
    const adminModal = document.getElementById('adminModal');
    if (adminModal) adminModal.classList.add('hidden');
}

// Memunculkan modal konfirmasi hapus
function confirmDelete(id, name) {
    selectedAdminId = id;
    const deleteAdminName = document.getElementById('deleteAdminName');
    const deleteModal = document.getElementById('deleteModal');

    if (deleteAdminName) {
        deleteAdminName.innerText = `Admin "${name}" akan dihapus permanen.`;
    }
    if (deleteModal) {
        deleteModal.classList.remove('hidden');
    }
}

// Menutup modal konfirmasi hapus
function closeDeleteModal() {
    selectedAdminId = null;
    const deleteModal = document.getElementById('deleteModal');
    if (deleteModal) deleteModal.classList.add('hidden');
}

document.addEventListener('DOMContentLoaded', function() {
    // Sembunyikan loading screen setelah halaman siap
    const loadingContent = document.getElementById('loading-content');
    if (loadingContent) {
        loadingContent.style.opacity = '0';
        setTimeout(() => loadingContent.style.display = 'none', 300);
    }

    toggleJurusanField();

    // Event listener untuk tombol edit dinamis berdasarkan atribut data-action="edit"
    document.addEventListener('click', function(e) {
        const editBtn = e.target.closest('[data-action="edit"]');
        if (editBtn) {
            const data = {
                id: editBtn.getAttribute('data-id'),
                username: editBtn.getAttribute('data-username'),
                email: editBtn.getAttribute('data-email'),
                role: editBtn.getAttribute('data-role'),
                jurusan: editBtn.getAttribute('data-jurusan')
            };
            openEditModal(data);
        }
    });

    // Eksekusi hapus saat tombol konfirmasi pada modal hapus diklik
    const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
    if (confirmDeleteBtn) {
        confirmDeleteBtn.addEventListener('click', function() {
            if (selectedAdminId) {
                const deleteForm = document.getElementById(`delete-form-${selectedAdminId}`);
                if (deleteForm) deleteForm.submit();
            }
        });
    }

    // Auto-hide alert sukses/error setelah 4 detik
    setTimeout(function() {
        const successAlert = document.getElementById('successAlert');
        const errorAlert = document.getElementById('errorAlert');
        if (successAlert) successAlert.style.display = 'none';
        if (errorAlert) errorAlert.style.display = 'none';
    }, 4000);
});