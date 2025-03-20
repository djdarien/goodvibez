document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".box").forEach(box => {
        box.addEventListener("click", function () {
            let sectionId = this.id;
            fetch(`counter.php?section=${sectionId}`)
                .then(response => response.json())
                .then(data => console.log(`Updated count for ${sectionId}:`, data[sectionId]))
                .catch(error => console.error("Error:", error));
        });
    });
});