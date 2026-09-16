document.addEventListener("DOMContentLoaded", function () {
    const pageData = document.getElementById("pageData");
    const isSuccess = pageData?.dataset.success === "true" || pageData?.getAttribute("data-success") === "true";
    const activeJurusan = pageData?.dataset.activeJurusan || pageData?.getAttribute("data-active-jurusan");

    // 1. Tampilkan modal berhasil jika session success bernilai true
    if (isSuccess) {
        const successModal = document.getElementById("successModal");
        if (successModal) {
            successModal.classList.remove("hidden");
            successModal.classList.add("flex");
        }
    }

    // 2. Jika ada jurusan aktif dari session (setelah submit / error validasi), otomatis buka formnya
    if (activeJurusan) {
        pilihJurusan(activeJurusan);
    }

    // 3. Pasang event listener untuk validasi HTML5 sebelum submit pada tiap form
    daftarJurusan.forEach((nama) => {
        const form = document.getElementById("form_" + nama);
        if (form) {
            form.addEventListener("submit", validateBeforeSubmit);
        }
    });
});

const daftarJurusan = ["PPLG", "DKV", "TOI"];

function pilihJurusan(nama, event = null) {
    const belumPilihJurusan = document.getElementById("belumPilihJurusan");
    const pilihJurusanText = document.getElementById("pilihJurusanText");

    if (belumPilihJurusan) belumPilihJurusan.classList.add("hidden");
    if (pilihJurusanText) pilihJurusanText.classList.add("hidden");

    // Update nilai hidden input jurusan
    document.querySelectorAll('input[name="jurusan"]').forEach((input) => {
        input.value = nama;
    });

    // Tampilkan form yang dipilih dan sembunyikan form lainnya
    daftarJurusan.forEach((j) => {
        const form = document.getElementById("form_" + j);
        if (form) {
            if (j === nama) {
                form.classList.remove("hidden");
            } else {
                form.classList.add("hidden");
            }
        }
    });

    // Reset dan atur status tombol jurusan aktif
    document.querySelectorAll(".btn-jurusan").forEach((btn) => {
        btn.classList.remove("active");
    });

    if (event && event.currentTarget) {
        event.currentTarget.classList.add("active");
    } else {
        const activeBtn = Array.from(document.querySelectorAll(".btn-jurusan")).find(
            (btn) => btn.textContent.trim() === nama
        );
        if (activeBtn) activeBtn.classList.add("active");
    }
}

function validateBeforeSubmit(e) {
    const form = e.target;
    if (!form.checkValidity()) {
        e.preventDefault();
        form.classList.add("was-validated");

        const firstInvalid = form.querySelector(":invalid");
        if (firstInvalid) {
            firstInvalid.scrollIntoView({
                behavior: "smooth",
                block: "center",
            });
            firstInvalid.focus();
        }
    }
}

function toggleSubmitButton(nama) {
    const checkbox = document.getElementById("agree_" + nama);
    const submitBtn = document.getElementById("submit_" + nama);

    if (!checkbox || !submitBtn) return;

    if (checkbox.checked) {
        submitBtn.disabled = false;
        submitBtn.classList.remove("bg-gray-400", "cursor-not-allowed");
        submitBtn.classList.add("bg-blue-600", "hover:bg-blue-700", "cursor-pointer");
    } else {
        submitBtn.disabled = true;
        submitBtn.classList.remove("bg-blue-600", "hover:bg-blue-700", "cursor-pointer");
        submitBtn.classList.add("bg-gray-400", "cursor-not-allowed");
    }
}

function resetForm(nama) {
    const form = document.getElementById("form_" + nama);
    if (form) {
        form.reset();
        form.classList.remove("was-validated");
        toggleSubmitButton(nama);
    }
}