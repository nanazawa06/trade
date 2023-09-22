import './bootstrap';

import Alpine from 'alpinejs';

import $ from 'jquery';
window.jQuery = $;
window.$ = $;

window.Alpine = Alpine;

Alpine.start();

//スクロールバーを最下部に配置
const chat_board = document.getElementById("chat-board");
function scrollToEnd(scrollBox){
    scrollBox.scrollTop = scrollBox.scrollHeight;
}

if(chat_board){
    scrollToEnd(chat_board);
}

console.log('image取得前');
const mainImage = document.querySelector(".main-image");
const fileInputs = document.querySelectorAll(".file");
const subImages = document.querySelectorAll(".sub-image");
console.log('image取得後');

//小さい画像がクリックされると大きい画像をクリックされた画像に変更する
subImages.forEach(function(image){
    image.onclick = function(event) {
        event.preventDefault();
        console.log('画像がクリックされた');
        mainImage.src = event.target.getAttribute('src');
        console.log('画像変更');
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
            imgContainer.classList.add("relative", "h-full", "w-full", "mx-auto", "bg-slate-100");
            smallImg.classList.add("small-image", "absolute", "top-1/2", "left-1/2", "-translate-x-1/2", "-translate-y-1/2", "max-w-full", "max-h-full", "z-0");
            smallImg.src = fileURL;
            
            //画像とセットで削除ボタンを表示する
            btn.classList.add("delete", "p-0.5", "rounded-full", "absolute", "top-0", "right-0", "bg-gray-400", "text-white", "z-10");
            btn.setAttribute('data-image', fileURL);
            btn.innerHTML = '<svg class="h-5 w-5 sm:h-8 sm:h-8 text-white p-1"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18" />  <line x1="6" y1="6" x2="18" y2="18" /></svg>';
                
            // 削除ボタンが押されると画像を削除する
            btn.addEventListener('click', function(event) {
                event.preventDefault();
                const image = this.getAttribute('data-image');
                deleteImage(image, uploadBox, preview);
                input.value = '';
                });
        };
        reader.readAsDataURL(file);
    }

//ボタンのdata-imageと同じsrcをもつ画像を親要素のdivと一緒に削除
function deleteImage(image, uploadBox, preview) {
    const imageList = document.querySelectorAll(`img[src="${image}"]`);
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



//いいねボタンを押されたときの処理
$(function () {
  let like = $('.like-toggle');
  let likePostId;
  like.on('click', function () { 
    let $this = $(this);
    likePostId = $this.data('post-id'); //iタグに仕込んだdata-post-idの値を取得
    //ajax処理スタート
    $.ajax({
      headers: { 
        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
      },  //↑name属性がcsrf-tokenのmetaタグのcontent属性の値を取得
      url: '/posts/like',
      method: 'POST',
      timeout: 3000,
      data: { //サーバーに送信するデータ
        'post_id': likePostId //いいねされた投稿のidを送る
      },
    })
    //通信成功した時の処理
    .done(function (data) {
      $this.toggleClass('liked'); //likedクラスのON/OFF切り替え。
      $this.next('.like-counter').html(data.post_likes_count);
    })
    //通信失敗した時の処理
    .fail(function () {
      console.log('fail'); 
    });
  });
  });

//チャットが送信された場合の処理
const message_el = document.getElementById("messages");
const message_input = document.getElementById("message_input");
const message_form = document.getElementById("message_form");
const message_btn = document.getElementById("chat_btn");
const post_id = message_input.getAttribute("data-post-id");
const user_id = message_btn.value;

message_form.addEventListener('submit' ,function (e) {
    e.preventDefault();
    if (user_id === null){
        alert("ログインしてください");
        return;
    }
    const message = message_input.value;
    if (message == '') {
        alert("メッセージを入力してください");
        return;
    }
    
    var socket_id = window.Echo.socketId();
    $.ajax({
      headers: { 
        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content'),
        'X-Socket-ID' : socket_id
      },
      url: '/posts/'+ post_id + '/chat',
      method: 'POST',
      timeout: 3000,
      data:{
          'message' : message,
      }
    })
    
    .done(function (data) {
        message_el.innerHTML += 
            `<div class="col-start-2 col-end-13 py-1 rounded-lg">
                <div class="flex items-center justify-start flex-row-reverse">
                    <div class="flex items-center justify-center h-10 w-10 rounded-full bg-indigo-500 flex-shrink-0">
                      <a href="/users/${data.user_id}">
                       <img src="${data.profile_icon}" class="w-10 h-10 rounded-full object-cover border-none bg-gray-200">
                       </a>
                    </div>'
                    <div class="relative mr-3 text-sm bg-indigo-100 py-2 px-4 shadow rounded-xl">
                     <div>${data.message}</div>
                    </div>
                 </div>
            </div>`;
        scrollToEnd(chat_board);
        $(message_input).val('');
        console.log('success');
    })
    
    .fail(function () {
      console.log('fail'); 
    });
});   

window.Echo.channel(`postChat.${post_id}`)
    .listen('MessageSent', (e) =>{
        console.log(e);
            message_el.innerHTML += 
            `<div class="col-start-1 col-end-12 py-1 rounded-lg">
                <div class="flex flex-row items-cente">
                    <div class="flex items-center justify-center h-10 w-10 rounded-full flex-shrink-0">
                      <a href="/users/${e.chat.user.id}">
                       <img src="${e.chat.user.profile_icon}" class="w-10 h-10 rounded-full object-cover border-none bg-gray-200">
                       </a>
                    </div>
                    <div class="relative ml-3 text-sm bg-indigo-100 py-2 px-4 shadow rounded-xl">
                     <div>${e.chat.message}</div>
                    </div>
                 </div>
            </div>`;
            
            scrollToEnd(chat_board);
        });