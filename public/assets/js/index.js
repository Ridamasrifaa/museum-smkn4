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
    document.getElementById("modalTitle").textContent = d.title;
    document.getElementById("modalCategory").textContent = d.category;
    document.getElementById("modalEvent").textContent = "🎉 " + d.event;
    document.getElementById("modalDescription").textContent = d.desc;
    document.getElementById("modalSiswa").textContent = d.siswa;
    document.getElementById("modalGuru").textContent = "👨‍🏫 " + d.guru;
    document.getElementById("modalKategoriDetail").textContent = d.category;
    document.getElementById("modalTahun").textContent = d.tahun;
    document.getElementById("modalViews").textContent = d.views;
    document.getElementById("modalLikes").textContent = d.likes;
    document.getElementById("modalTech").textContent = d.tech;
    document.getElementById("modalAvatar").textContent = d.avatar;
    document.getElementById("downloadBtn").href = d.download;
    document.getElementById("liveBtn").href = d.live;
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
