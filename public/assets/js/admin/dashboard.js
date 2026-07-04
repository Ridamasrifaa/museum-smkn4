// Loading animation
window.addEventListener("load", function () {
    const loadingContent = document.getElementById("loading-content");
    setTimeout(() => {
        loadingContent.classList.add("opacity-0");
        setTimeout(() => {
            loadingContent.classList.add("hidden");
        }, 300);
    }, 1500);
});

// Logout handler
function handleLogout() {
    if (confirm("Anda yakin ingin logout?")) {
        document.getElementById("logout-form").submit();
    }
}
