// Data Tim Pengembang
// khusus tim pengembangan
const developers = [
    {
        name: "Rida Masrifa Hasbian",
        class: "XII PPLG 1",
        avatar: "https://ui-avatars.com/api/?name=Rida+Masrifa&background=2563EB&color=FFFFFF&size=300",
        avatarModal: "https://ui-avatars.com/api/?name=Rida+Masrifa&background=2563EB&color=FFFFFF&size=500",
        roles: [
            { title: "Backend Developer", bg: "bg-blue-100 dark:bg-blue-900/50", text: "text-blue-800 dark:text-blue-300", border: "border-blue-200 dark:border-blue-800" }
        ],
        github: "https://github.com/Ridamasrifaa",
        portfolio: "#",
        hoverShadow: "hover:shadow-blue-500/5",
        portfolioBorder: "border-blue-300 dark:border-blue-800",
        portfolioText: "text-blue-600 dark:text-blue-400",
        portfolioHover: "hover:bg-blue-50 dark:hover:bg-blue-950/40",
        gridClass: ""
    },
    {
        name: "Salsa Cantika",
        class: "XII PPLG 1",
        avatar: "https://ui-avatars.com/api/?name=Salsa+Cantika&background=7C3AED&color=FFFFFF&size=300",
        avatarModal: "https://ui-avatars.com/api/?name=Nama+Anggota3&background=7C3AED&color=FFFFFF&size=300",
        roles: [
            { title: "Frontend Developer", bg: "bg-purple-100 dark:bg-purple-900/50", text: "text-purple-800 dark:text-purple-300", border: "border-purple-200 dark:border-purple-800" }
        ],
        github: "https://github.com/Salsacantika",
        portfolio: "#",
        hoverShadow: "hover:shadow-sky-500/5",
        portfolioBorder: "border-sky-300 dark:border-sky-800",
        portfolioText: "text-sky-600 dark:text-sky-400",
        portfolioHover: "hover:bg-sky-50 dark:hover:bg-sky-950/40",
        gridClass: ""
    },
    {
        name: "Zaki Nur Faizi",
        class: "XII PPLG 2",
        avatar: "https://ui-avatars.com/api/?name=Zaki+Nurfaizi3&background=7C3AED&color=FFFFFF&size=300",
        avatarModal: "https://ui-avatars.com/api/?name=Nama+Anggota3&background=7C3AED&color=FFFFFF&size=500",
        roles: [
            { title: "Frontend Dev", bg: "bg-sky-100 dark:bg-sky-900/50", text: "text-sky-800 dark:text-sky-300", border: "border-sky-200 dark:border-sky-800" },
            { title: "Backend Dev", bg: "bg-indigo-100 dark:bg-indigo-900/50", text: "text-indigo-800 dark:text-indigo-300", border: "border-indigo-200 dark:border-indigo-800" }
        ],
        github: "https://github.com/faizinurzaki12",
        portfolio: "https://zackynurfazz.netlify.app",
        hoverShadow: "hover:shadow-purple-500/5",
        portfolioBorder: "border-purple-300 dark:border-purple-800",
        portfolioText: "text-purple-600 dark:text-purple-400",
        portfolioHover: "hover:bg-purple-50 dark:hover:bg-purple-950/40",
        gridClass: ""
    },
    {
        name: "Zahra Afifah Hifdillah",
        class: "XII PPLG 2",
        avatar: "https://ui-avatars.com/api/?name=Zahra+Afifah4&background=DB2777&color=FFFFFF&size=300",
        avatarModal: "https://ui-avatars.com/api/?name=Nama+Anggota4&background=DB2777&color=FFFFFF&size=500",
        roles: [
            { title: "Frontend Developer", bg: "bg-pink-100 dark:bg-pink-900/50", text: "text-pink-800 dark:text-pink-300", border: "border-pink-200 dark:border-pink-800" }
        ],
        github: "https://github.com/Zhraaaaa31",
        portfolio: "#",
        hoverShadow: "hover:shadow-pink-500/5",
        portfolioBorder: "border-pink-300 dark:border-pink-800",
        portfolioText: "text-pink-600 dark:text-pink-400",
        portfolioHover: "hover:bg-pink-50 dark:hover:bg-pink-950/40",
        gridClass: "lg:col-start-1 lg:translate-x-1/2"
    },
    {
        name: "All Raffi Ghani Iskandar",
        class: "XII PPLG 2",
        avatar: "https://ui-avatars.com/api/?name=Nama+Anggota5&background=EA580C&color=FFFFFF&size=300",
        avatarModal: "https://ui-avatars.com/api/?name=Nama+Anggota5&background=EA580C&color=FFFFFF&size=500",
        roles: [
            { title: "Backend Developer", bg: "bg-orange-100 dark:bg-orange-900/50", text: "text-orange-800 dark:text-orange-300", border: "border-orange-200 dark:border-orange-800" }
        ],
        github: "https://github.com/alrafighani280-art",
        portfolio: "#",
        hoverShadow: "hover:shadow-orange-500/5",
        portfolioBorder: "border-orange-300 dark:border-orange-800",
        portfolioText: "text-orange-600 dark:text-orange-400",
        portfolioHover: "hover:bg-orange-50 dark:hover:bg-orange-950/40",
        gridClass: "lg:col-start-2 lg:translate-x-1/2"
    }
];

// Render Cards Dev ke HTML
document.addEventListener("DOMContentLoaded", function () {
    const teamContainer = document.getElementById("team-grid");
    if (!teamContainer) return;

    teamContainer.innerHTML = developers.map(dev => {
        const rolesHTML = dev.roles.map(r => 
            `<span class="inline-block px-2.5 py-0.5 text-xs font-semibold rounded-full ${r.bg} ${r.text} border ${r.border}">
                ${r.title}
            </span>`
        ).join(" ");

        return `
            <div class="bg-white dark:bg-gray-900 rounded-2xl p-6 border border-slate-200/80 dark:border-gray-800/80 shadow-xs ${dev.hoverShadow} hover:-translate-y-1 transition-all duration-300 text-center ${dev.gridClass}">
                <div class="w-20 h-20 mx-auto mb-4 rounded-full p-[3px] bg-gradient-to-br from-blue-500 to-indigo-500 cursor-pointer"
                     onclick="openAvatarModal('${dev.avatarModal}', '${dev.name}')">
                    <img src="${dev.avatar}" alt="Foto ${dev.name}" class="w-full h-full rounded-full object-cover ring-2 ring-white dark:ring-gray-900" />
                </div>
                <h3 class="font-bold text-base text-slate-900 dark:text-white">${dev.name}</h3>
                <p class="text-[11px] font-bold uppercase tracking-wider text-cyan-400 mt-0.5 mb-3">${dev.class}</p>

                <div class="flex items-center justify-center gap-1.5 flex-wrap">
                    ${rolesHTML}
                </div>

                <div class="grid grid-cols-2 gap-2 mt-5 pt-5 border-t border-slate-100 dark:border-gray-800/80">
                    <a href="${dev.github}" target="_blank" class="inline-flex items-center justify-center gap-1.5 py-2 rounded-lg text-xs font-semibold border border-slate-300 dark:border-gray-700 text-slate-700 dark:text-gray-300 hover:bg-slate-50 dark:hover:bg-gray-800 transition">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                            <path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/>
                        </svg>
                        GitHub
                    </a>
                    <a href="${dev.portfolio}" target="_blank" class="py-2 rounded-lg text-xs font-semibold border ${dev.portfolioBorder} ${dev.portfolioText} ${dev.portfolioHover} transition">
                        Portofolio
                    </a>
                </div>
            </div>
        `;
    }).join("");
});