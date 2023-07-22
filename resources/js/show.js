const previews = document.querySelectorAll(".preview-box img");
const bigPreview = document.querySelector(".top-preview img");
//クリックされた画像を大きく表示する
previews.foreach(image => {
    image.onclick = function() {
        bigPreview.src = image.src;
    };
});
