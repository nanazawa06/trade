import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


const mainImage = document.querySelector(".main-image");
const fileInputs = document.querySelectorAll(".file");
const subImages = document.querySelectorAll(".sub-image");

console.log(fileInputs);
//小さい画像がクリックされると大きい画像をクリックされた画像に変更する
subImages.forEach(function(image){
    console.log(image);
    image.onclick = function(event) {
        event.preventDefault();
        console.log(event);
        mainImage.src = event.target.getAttribute('src');
        console.log(event.target.getAttribute('src'));
        };
});

//アップロードされた画像を表示する
function loadImg(e, uploadBox, preview, input) {
    try {
        var file = e.target.files[0];
    } catch (error) {
        var file = e.dataTransfer.files[0];
    }
    if (!file) return;  // 何も選択されなければreturn
    uploadBox.classList.add("hidden");
    preview.classList.remove("hidden");
        var reader = new FileReader();
        reader.onload = function(e) {
            const fileURL = e.target.result;  //ファイルのurlを取得
            var imgContainer = document.createElement('div');
            var smallImg = document.createElement('img');
            var btn = document.createElement('button');
            
            //画像をpreviewに小さく表示
            imgContainer.appendChild(smallImg);
            imgContainer.appendChild(btn);
            preview.appendChild(imgContainer);
            imgContainer.classList.add("relative", "h-full", "w-full", "mx-auto", "overflow-hidden", "rounded-5");
            smallImg.classList.add("small-image", "absolute", "w-full", "w-full", "z-0", "bg-slate-100");
            smallImg.src = fileURL;
            
            //画像とセットで削除ボタンを表示する
            btn.classList.add("delete", "p-1", "rounded", "absolute", "top-0", "right-0", "bg-glay-400", "text-white", "z-10");
            btn.setAttribute('data-image', fileURL);
            btn.textContent = '削除';
                
            // 削除ボタンが押されると画像を削除する
            btn.addEventListener('click', function(event) {
                event.preventDefault();
                const image = this.getAttribute('data-image');
                deleteImage(image, uploadBox, preview);
                input.value = '';
                });
            console.log('show.loadImg');
        };
        reader.readAsDataURL(file);
    }

//ボタンのdata-imageと同じsrcをもつ画像を親要素のdivと一緒に削除
function deleteImage(image, uploadBox, preview) {
    const imageList = document.querySelectorAll(`img[src="${image}"]`);
    console.log(imageList);
    imageList.forEach(function(element) {
        element.parentNode.remove();
    });
    uploadBox.classList.remove("hidden");
    preview.classList.add("hidden");
}


var num = 0;
fileInputs.forEach(function(input) {
    var uploadBox = document.querySelector(".upload-box" + num);
    var preview = document.getElementById('preview' + num);
    input.addEventListener("change", function(event){loadImg(event, uploadBox, preview, input)}, false);
    // ファイルがドロップされた時の処理
    uploadBox.addEventListener("drop", function(event){event.preventDefault(); loadImg(event, uploadBox, preview, input)}, false);
    // ドラッグした時の処理
    uploadBox.addEventListener("dragover", dragover, false);
    // ドラッグがエリアから離れた時の処理
    uploadBox.addEventListener("dragleave", dragleave, false);
    num++;
});

function dragover(e){ // ドラッグした時に背景色を変える
    e.stopPropagation();
    e.preventDefault();
    this.style.background = "#e1e7f0";
}

function dragleave(e){  // ドラッグがエリアから離れたら背景色を元に戻す
    e.stopPropagation();
    e.preventDefault();
    this.style.background = "#fff";
}

