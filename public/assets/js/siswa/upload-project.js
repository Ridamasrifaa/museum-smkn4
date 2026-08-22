const daftarJurusan = ["PPLG", "DKV", "TOI"];
const belumPilihJurusan = document.getElementById("belumPilihJurusan");
const pilihJurusanText = document.getElementById("pilihJurusanText");

function pilihJurusan(nama, event) {
    if (belumPilihJurusan) belumPilihJurusan.classList.add("hidden");
    if (pilihJurusanText) pilihJurusanText.classList.add("hidden");

    document.querySelectorAll('input[name="jurusan"]').forEach((input) => {
        input.value = nama;
    });

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

    document
        .querySelectorAll(".btn-jurusan")
        .forEach((btn) => btn.classList.remove("active"));
    if (event && event.currentTarget) {
        event.currentTarget.classList.add("active");
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

daftarJurusan.forEach((nama) => {
    const form = document.getElementById("form_" + nama);
    if (form) form.addEventListener("submit", validateBeforeSubmit);
});

function toggleSubmitButton(nama) {
    const checkbox = document.getElementById("agree_" + nama);
    const submitBtn = document.getElementById("submit_" + nama);

    if (checkbox.checked) {
        submitBtn.disabled = false;
        submitBtn.classList.remove("bg-gray-400", "cursor-not-allowed");
        submitBtn.classList.add(
            "bg-blue-600",
            "hover:bg-blue-700",
            "cursor-pointer",
        );
    } else {
        submitBtn.disabled = true;
        submitBtn.classList.remove(
            "bg-blue-600",
            "hover:bg-blue-700",
            "cursor-pointer",
        );
        submitBtn.classList.add("bg-gray-400", "cursor-not-allowed");
    }
}

function resetForm(nama) {
    const form = document.getElementById("form_" + nama);
    form.reset();
    form.classList.remove("was-validated");
    toggleSubmitButton(nama);
}

// CEK APAKAH ADA SESSION SUCCESS BERDASARKAN ATRIBUT HTML
document.addEventListener("DOMContentLoaded", function () {
    const pageData = document.getElementById("pageData");
    if (pageData && pageData.getAttribute("data-success") === "true") {
        const successModal = document.getElementById("successModal");
        if (successModal) {
            successModal.classList.remove("hidden");
            successModal.classList.add("flex");
        }
    }
});
