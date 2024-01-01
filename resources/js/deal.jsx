import './bootstrap';

import Alpine from 'alpinejs';
import $ from 'jquery';
window.jQuery = $;
window.$ = $;

window.Alpine = Alpine;

Alpine.start();



//チャットが送信された場合の処理
const message_el = document.getElementById("messages");
const message_input = document.getElementById("message_input");
const message_form = document.getElementById("message_form");
const message_btn = document.getElementById("chat_btn");
const proposal_id = message_input.getAttribute("data-proposal-id");
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
      url: '/posts/'+ proposal_id + '/deal/chat',
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
                    </div>
                    <div class="relative mr-3 text-sm bg-indigo-100 py-2 px-4 shadow rounded-xl">
                     <div>${data.message}</div>
                    </div>
                 </div>
            </div>`;
        $(message_input).val('');
        console.log('success');
    })
    
    .fail(function () {
      console.log('fail'); 
    });
});   

window.Echo.channel(`proposalChat.${proposal_id}`)
    .listen('ProposalMessage', (e) =>{
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
            
        });