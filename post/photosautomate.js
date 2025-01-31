<script>
document.addEventListener("DOMContentLoaded", function () {
    let folder = "images/";  // Folder where images are stored
    let gallery = document.querySelector(".image-gallery");

    let imageFiles = ["photo1.jpg", "photo2.jpg", "photo3.jpg", "photo4.jpg"]; // GitHub doesn't support auto-folder listing

    imageFiles.forEach(file => {
        let img = document.createElement("img");
        img.src = folder + file;
        img.alt = "Gallery Image";
        gallery.appendChild(img);
    });
});
</script>