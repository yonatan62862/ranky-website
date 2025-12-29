document.addEventListener("DOMContentLoaded", () => {
    const tabs = document.querySelectorAll(".services__tab");
    const panels = document.querySelectorAll(".services__panel");

    if (!tabs.length || !panels.length) return;

    tabs.forEach((tab) => {
        tab.addEventListener("click", () => {
            const target = tab.dataset.service;

            // Remove active state from all tabs & panels
            tabs.forEach((t) => t.classList.remove("is-active"));
            panels.forEach((p) => p.classList.remove("is-active"));

            // Activate clicked tab
            tab.classList.add("is-active");

            // Activate matching panel
            const activePanel = document.querySelector(
                `.services__panel[data-service="${target}"]`
            );

            if (activePanel) {
                activePanel.classList.add("is-active");
            }
        });
    });
});
