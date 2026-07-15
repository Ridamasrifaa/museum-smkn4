// ===== Dark / Light Mode =====
function applyTheme(theme) {
    document.documentElement.classList.toggle("dark", theme === "dark");
}

function toggleTheme() {
    const isDark = document.documentElement.classList.contains("dark");
    const next = isDark ? "light" : "dark";
    localStorage.setItem("theme", next);
    applyTheme(next);
}
(function initTheme() {
    const saved = localStorage.getItem("theme");
    const prefersDark = window.matchMedia(
        "(prefers-color-scheme: dark)",
    ).matches;
    applyTheme(saved || (prefersDark ? "dark" : "light"));
})();

// ===== Modal (baca data langsung dari atribut data-* card, tanpa array JS) =====
function openModal(card) {
    if (!card) return;
    const d = card.dataset;
    const modalTitle = document.getElementById("modalTitle");
    const modalCategory = document.getElementById("modalCategory");
    const modalEvent = document.getElementById("modalEvent");
    const modalDescription = document.getElementById("modalDescription");
    const modalSiswa = document.getElementById("modalSiswa");
    const modalGuru = document.getElementById("modalGuru");
    const modalKategoriDetail = document.getElementById("modalKategoriDetail");
    const modalTahun = document.getElementById("modalTahun");
    const modalViews = document.getElementById("modalViews");
    const modalLikes = document.getElementById("modalLikes");
    const modalTech = document.getElementById("modalTech");
    const modalAvatar = document.getElementById("modalAvatar");
    const liveBtn = document.getElementById("liveBtn");
    const downloadBtn = document.getElementById("downloadBtn");
    const previewImage = document.getElementById("modalImagePreview");
    const previewIframe = document.getElementById("modalIframePreview");
    const previewEmpty = document.getElementById("modalPreviewEmpty");
    const filePath = d.filePath || "";
    const fileType = d.fileType || "";

    if (modalTitle) modalTitle.textContent = d.title;
    if (modalCategory) modalCategory.textContent = d.category;
    if (modalEvent) modalEvent.textContent = "🎉 " + d.event;
    if (modalDescription) modalDescription.textContent = d.desc;
    if (modalSiswa) modalSiswa.textContent = d.siswa;
    if (modalGuru) modalGuru.textContent = "👨‍🏫 " + d.guru;
    if (modalKategoriDetail) modalKategoriDetail.textContent = d.category;
    if (modalTahun) modalTahun.textContent = d.tahun;
    if (modalViews) modalViews.textContent = d.views;
    if (modalLikes) modalLikes.textContent = d.likes;
    if (modalTech) modalTech.textContent = d.tech;
    if (modalAvatar) modalAvatar.textContent = d.avatar;
    if (downloadBtn) downloadBtn.href = d.download;
    if (liveBtn) liveBtn.href = d.live;

    if (previewImage && previewIframe && previewEmpty) {
        const isImage = filePath && fileType.startsWith("image/");
        if (isImage) {
            previewImage.src = filePath;
            previewImage.classList.remove("hidden");
            previewIframe.classList.add("hidden");
            previewEmpty.classList.add("hidden");
        } else if (d.live) {
            previewIframe.src = d.live;
            previewIframe.classList.remove("hidden");
            previewImage.classList.add("hidden");
            previewEmpty.classList.add("hidden");
        } else {
            previewImage.classList.add("hidden");
            previewIframe.classList.add("hidden");
            previewEmpty.classList.remove("hidden");
        }
    }

    document.getElementById("detailModal").classList.remove("hidden");
}

function closeModal() {
    document.getElementById("detailModal").classList.add("hidden");
}

document.getElementById("detailModal").addEventListener("click", (e) => {
    if (e.target.id === "detailModal") closeModal();
});
document.addEventListener("DOMContentLoaded", () => {
    const counters = document.querySelectorAll(".counter");

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) return;

                const counter = entry.target;

                const target = parseInt(counter.dataset.target);

                let current = 0;

                const duration = 1800; // 1.8 detik

                const increment = target / (duration / 16);

                function update() {
                    current += increment;

                    if (current >= target) {
                        counter.innerText = target.toLocaleString();
                    } else {
                        counter.innerText =
                            Math.floor(current).toLocaleString();

                        requestAnimationFrame(update);
                    }
                }

                update();

                observer.unobserve(counter);
            });
        },
        {
            threshold: 0.5,
        },
    );

    counters.forEach((counter) => {
        observer.observe(counter);
    });
});
const cards = document.querySelectorAll(".counter-card");

const cardObserver = new IntersectionObserver(
    (entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add("show");
            }
        });
    },
    {
        threshold: 0.2,
    },
);

cards.forEach((card) => cardObserver.observe(card));
