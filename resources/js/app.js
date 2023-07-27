import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

console.log('test');
document.addEventListener('DOMContentLoaded', function() {
        const uploadBox = document.querySelector(".upload-box");
        const previewBox = document.querySelector(".preview-box");
        const fileInput = document.getElementById("input");
        const topPreview = document.querySelector(".top-preview");
        const btnDelete = document.querySelectorAll(".delete");

        //アップロードされた画像を表示する
        function loadImg(e) {
            const file = e.target.files[0];  // inputのvalueを取得
            if (!file) return;  // 何も選択されなければreturn
            const reader = new FileReader();
            
            reader.onload = function(e) {
                const fileURL = e.target.result;  //ファイルのurlを取得
                var imgContainer = document.createElement('div');
                var smallImg = document.createElement('img');
                var btn = document.createElement('button');
                var bigImgContainer = document.createElement('div')
                var bigImg = document.createElement('img');
                imgContainer.appendChild(smallImg);
                imgContainer.appendChild(btn);
                previewBox.appendChild(imgContainer);
                smallImg.setAttribute('class', 'image');
                smallImg.setAttribute('style', 'height:20%;');
                smallImg.src = fileURL;  // fileのurlをsrcに指定
                //画像とセットで削除ボタンを表示する
                btn.setAttribute('class', 'delete');
                btn.setAttribute('data-image', fileURL);
                btn.textContent = '削除';
                //アップロードした画像を一覧とは別で大きく表示する
                if (!document.querySelector('.big-image')) {
                    bigImgContainer.appendChild(bigImg);
                    topPreview.appendChild(bigImgContainer);
                    bigImg.setAttribute('style', 'width:60%;');
                    bigImg.classList.add('big-image');
                }
                //クリックされた画像を大きく表示する
                bigImg.src = fileURL;
                smallImg.onclick = function() {
                    topPreview.src = fileURL;
                    };
                // 削除ボタンを押した際にページのリロードを防ぐ
                btn.addEventListener('click', function(event) {
                    event.preventDefault();
                    const image = this.getAttribute('data-image');
                    // 画像を削除する処理
                    deleteImage(image);
                    });
            };
            reader.readAsDataURL(file);
        };
        
        // inputのvalueが変更された時の処理
        fileInput.addEventListener("change", loadImg, false);
        // uploadBoxをクリックすると、inputがクリックされたことになる
        uploadBox.addEventListener("click", () => fileInput.click());

        //ボタンのdata-imageと同じsrcをもつ画像を親要素のdivと一緒に削除
        function deleteImage(image) {
            const imageList = document.querySelectorAll(`img[src="${image}"]`);
            imageList.forEach(function(element) {
                element.parentNode.remove();
            });
            
        }
        
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

        function dropLoad(e) {
            e.stopPropagation();
            e.preventDefault();

            uploadBox.style.background = "#fff"; //背景色を白に戻す
            let file = e.dataTransfer.files[0]; //ドロップしたファイルを取得
            let reader = new FileReader();
            reader.onloadend = event => {
                let fileURL = event.target.result;  //ファイルのURLを取得
                let img = document.createElement('img');
                img.src = fileURL;  // fileのurlをsrcに指定
                previewBox.appendChild(img);
            }
            reader.readAsDataURL(file);
        }

        // ファイルがドロップされた時の処理
        uploadBox.addEventListener("drop", dropLoad, false);
        // ドラッグした時の処理
        uploadBox.addEventListener("dragover", dragover, false);
        // ドラッグがエリアから離れた時の処理
        uploadBox.addEventListener("dragleave", dragleave, false);
        console.log('test');
        
    });