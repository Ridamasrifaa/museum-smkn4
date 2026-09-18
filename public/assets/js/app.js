const appInfo = [
    {
        version: "v1.0.0",
        lastUpdated: "17 September 2026",
        updates: [
            "Rilis awal platform Museum Karya",
            "Penambahan fitur integrasi data tim dinamis",
            "Perbaikan bug dan peningkatan performa"
        ],
        bugFixes: [
            "Perbaikan crash saat submit form",
            "Fix responsive layout",
            "perbaikan bug",
        ]
    }
];

document.addEventListener("DOMContentLoaded", function () {
    const latestVersion = appInfo[0];
    const appVersionElem = document.getElementById("app-version");
    
    if (appVersionElem && latestVersion) {
        appVersionElem.textContent = latestVersion.version;
    }

    const changelogListElem = document.getElementById("changelogList");
    if (changelogListElem) {
        changelogListElem.innerHTML = appInfo.map((item, index) => {
            const updatesList = item.updates.map(up => `<li class="text-xs text-slate-600 dark:text-gray-300">• ${up}</li>`).join("");
            const isLatest = index === 0;

            return `
                <div class="border-l-2 ${isLatest ? 'border-blue-500' : 'border-slate-200 dark:border-gray-700'} pl-4 relative">
                    <div class="flex items-center gap-2">
                        <span class="font-bold text-sm text-slate-900 dark:text-white">${item.version}</span>
                        ${isLatest ? '<span class="px-2 py-0.5 text-[10px] font-bold bg-blue-100 text-blue-700 dark:bg-blue-900/60 dark:text-blue-300 rounded-full">Terbaru</span>' : ''}
                    </div>
                    <p class="text-[11px] text-slate-400 dark:text-gray-500 mb-2">${item.lastUpdated}</p>
                    <ul class="space-y-1">
                        ${updatesList}
                    </ul>
                </div>
            `;
        }).join("");
    }
});