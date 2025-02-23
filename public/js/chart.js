// tab chart ardan
document.addEventListener("DOMContentLoaded", () => {
    const tabs = document.querySelectorAll(".tab-chart");
    const tables = document.querySelectorAll(".chart");
    
    function limitRows() {
        tables.forEach((table) => {
            const rows = table.querySelectorAll("tbody tr");
            rows.forEach((row, index) => {
                row.style.display = index < 5 ? "table-row" : "none";
            });
        });
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
            }
        });
    });

    limitRows();

    const button = document.getElementById("toggle-button");
    let isExpanded = false;
    let visibleRows = 5;
    
    button.addEventListener("click", () => {
        const table = document.querySelector(".chart:not(.hidden) tbody");
        const rows = table.querySelectorAll("tr");

        if (!isExpanded) {
            visibleRows = Math.min(visibleRows + 5, rows.length);
        } else {
            visibleRows = Math.max(visibleRows - 5, 5);
        }

        rows.forEach((row, index) => {
            row.style.display = index < visibleRows ? "table-row" : "none";
        });
        
        if (visibleRows >= rows.length) {
            button.textContent = "Show Less";
            isExpanded = true;
        } else if (visibleRows === 5) {
            button.textContent = "See More";
            isExpanded = false;
        }
    });
});
 