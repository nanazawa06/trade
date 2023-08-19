import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', function() {
        const topPreview = document.querySelector(".top-preview");
        const fileInputs = document.querySelectorAll(".file");
        const deleteButtons = document.querySelectorAll(".delete");
        

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
                    var bigImg = document.getElementById('big-image');
                    //アップロードした画像を一覧とは別で大きく表示する
                    //bigImgが取得できなければ作成する
                    if (! bigImg) {
                        var bigImg = document.createElement('img');
                        var bigImgContainer = document.createElement('div');
                        topPreview.appendChild(bigImgContainer);
                        bigImgContainer.classList.add("aspect-square", "relative", "max-w-2xl", "bg-glay-100");
                        bigImgContainer.appendChild(bigImg);
                        bigImg.id = 'big-image';
                        bigImg.classList.add("absolute", "top-1/2", "left-1/2", "-translate-x-1/2", "-translate-y-1/2", "max-w-full", "max-h-full");
                    }
                    bigImg.src = fileURL;
                    
                    //画像をpreviewに小さく表示
                    imgContainer.appendChild(smallImg);
                    imgContainer.appendChild(btn);
                    preview.appendChild(imgContainer);
                    imgContainer.classList.add("relative", "h-full", "w-full", "mx-auto", "rounded-5");
                    smallImg.classList.add("small-image", "absolute", "top-1/2", "left-1/2", "-translate-x-1/2", "-translate-y-1/2", "max-w-full", "max-h-full", "bg-slate-100", "z-0");
                    smallImg.src = fileURL;
                    
                    //画像とセットで削除ボタンを表示する
                    btn.classList.add("delete", "absolute", "right-0", "bg-gray-400", "rounded-full", "z-10");
                    btn.innerHTML = '<svg class="h-4 w-4 sm:h-8 sm:w-8 text-white p-1 "  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18" />  <line x1="6" y1="6" x2="18" y2="18" /></svg>';
                    btn.setAttribute('data-image', fileURL);
                    //btn.textContent = '削除';
                    
                    //小さい画像がクリックされると大きい画像を変更する
                    smallImg.onclick = function() {
                        bigImg.src = fileURL;
                        };
                        
                    // 削除ボタンが押されると画像を削除する
                    btn.addEventListener('click', function(event) {
                        event.preventDefault();
                        const image = this.getAttribute('data-image');
                        deleteImage(image, uploadBox, preview);
                        input.value = '';
                        });
                    console.log('loading');
                };
                reader.readAsDataURL(file);
            };
        
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
        
        deleteButtons.forEach(function(btn){
            btn.onclick = function(){
                console.log('button clicked');
                const previewElement = btn.parentElement.parentElement;
                btn.parentNode.remove();
                previewElement.classList.add("hidden");
                previewElement.nextElementSibling.classList.remove("hidden");
                previewElement.nextElementSibling.getElementsByClassName('file').value = '';
            }
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
        
        
});