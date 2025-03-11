document.addEventListener("DOMContentLoaded", () => {
    const tabs = document.querySelectorAll(".tab-chart");
    const tables = document.querySelectorAll(".chart");
    const btnSeeMore = document.querySelector(".btn-see-more");
    const btnSeeLess = document.querySelector(".btn-see-less");

    function limitRows() {
        tables.forEach((table) => {
            const rows = table.querySelectorAll("tbody tr");
            rows.forEach((row, index) => {
                row.style.display = index < 5 ? "table-row" : "none";
            });
        });
        updateButtons();
    }

    function updateButtons() {
        const table = document.querySelector(".chart:not(.hidden) tbody");
        const rows = table.querySelectorAll("tr");
        const visibleRows = [...rows].filter(row => row.style.display !== "none").length;

        btnSeeMore.style.display = visibleRows < rows.length ? "inline-block" : "none";
        btnSeeLess.style.display = visibleRows > 5 ? "inline-block" : "none";
    }

    tabs.forEach((tab) => {
        tab.addEventListener("click", () => {
            tabs.forEach((t) => t.classList.remove("active"));
            tab.classList.add("active");

            tables.forEach((table) => table.classList.add("hidden"));

            const selectedTab = tab.getAttribute("data-tab");
            const selectedTable = document.getElementById(selectedTab);

            if (selectedTable) {
                selectedTable.classList.remove("hidden");
                limitRows();
            }
        });
    });

    btnSeeMore.addEventListener("click", () => {
        const table = document.querySelector(".chart:not(.hidden) tbody");
        const rows = table.querySelectorAll("tr");
        let visibleRows = [...rows].filter(row => row.style.display !== "none").length;

        visibleRows = Math.min(visibleRows + 5, rows.length);
        rows.forEach((row, index) => {
            row.style.display = index < visibleRows ? "table-row" : "none";
        });

        updateButtons();
    });

    btnSeeLess.addEventListener("click", () => {
        const table = document.querySelector(".chart:not(.hidden) tbody");
        const rows = table.querySelectorAll("tr");
        let visibleRows = [...rows].filter(row => row.style.display !== "none").length;

        visibleRows = Math.max(visibleRows - 5, 5);
        rows.forEach((row, index) => {
            row.style.display = index < visibleRows ? "table-row" : "none";
        });

        updateButtons();
    });

    limitRows();
});
