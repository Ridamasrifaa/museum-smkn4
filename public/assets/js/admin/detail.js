function openModal(imageSrc) {
    const modal = document.getElementById("imageModal");
    const modalImg = document.getElementById("modalImage");

    // 1. Masukkan URL gambar yang diklik ke dalam tag img di dalam modal
    modalImg.src = imageSrc;

    // 2. Hilangkan class 'hidden' untuk menampilkan modal
    modal.classList.remove("hidden");

    // 3. (Opsional) Mencegah halaman utama bisa di-scroll saat modal aktif
    document.body.style.overflow = "hidden";
}

function closeModal() {
    const modal = document.getElementById("imageModal");

    // 1. Kembalikan class 'hidden' untuk menyembunyikan modal
    modal.classList.add("hidden");

    // 2. Kembalikan fungsi scroll pada halaman utama
    document.body.style.overflow = "auto";
}
window.addEventListener("load", function () {
    const loadingContent = document.getElementById("loading-content");

    // Transisi halus menghapus loading screen setelah 1 detik
    setTimeout(() => {
        loadingContent.classList.add("opacity-0");

        setTimeout(() => {
            loadingContent.classList.add("hidden");
        }, 300); // Sinkron dengan class duration-300 Tailwind
    }, 1000);
});
