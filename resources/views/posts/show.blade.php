<x-header>
    <div class=" mt-5 mx-3 md:mt-8 md:mx-5 lg:flex lg:mx-8 lg:justify-center lg:mx-5 lg:items-start"> 
        <div class="grid grid-cols-4 gap-2 w-full mx-3 md:w-2/3 lg:w-1/2">
            <div class="col-start-1 col-end-5 relative aspect-square bg-slate-100">
                <img src="{{ $post->images[0]->image_url }}" alt="画像が読み込めませんでした" id="main-image" 
                  class="main-image absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 max-w-full max-h-full z-0" loading="lazy" />
            </div>
            @foreach ($post->images as $image )
              <div class="relative aspect-square h-full w-full mx-auto bg-glay-100 rounded-5">
                  <img src="{{ $image->image_url }}" class="sub-image absolute max-w-full max-h-full top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full bg-slate-100" loading="lazy" />
              </div>
            @endforeach
        </div>
        <div class="flex flex-col items-center md:w-2/3 xl:w-2/5 lg:w-1/2">
            <ul class="flex items-center space-x-3 mr-auto mt-4 my-2">
              <li>
                  @auth
                    @if (!$post->isLikedBy(Auth::user()))
                      <span class="likes flex gap-2 items-center bg-slate-300 rounded-xl ml-3 pr-3">
                          <i class="fa fa-heart p-2 rounded-full text-white text-2xl like-toggle md:text-3xl" data-post-id="{{ $post->id }}"></i>
                        <span class="like-counter -ml-2 text-lg">{{$likes}}</span>
                      </span><!-- /.likes -->
                    @else
                      <span class="likes flex gap-2 items-center bg-slate-300 rounded-xl ml-3 pr-3">
                          <i class="liked fa fa-heart p-2 rounded-full text-red-500 text-2xl like-toggle md:text-3xl" data-post-id="{{ $post->id }}"></i>
                        <span class="like-counter -ml-2 text-lg">{{$likes}}</span>
                      </span><!-- /.likes -->
                    @endif
                  @endauth
                  @guest
                    <span class="likes flex gap-2 items-center bg-slate-300 rounded-xl ml-3 pr-3">
                        <i class="fa fa-heart p-2 rounded-full text-white text-2xl like-toggle md:text-3xl"></i>
                      <span class="like-counter -ml-2 text-lg">{{$likes}}</span>
                    </span><!-- /.likes -->
                  @endguest
              </li>
              @if (Auth::check() && Auth::id() == $post->user->id)
                  <li>
                    <button type="submit" class="text-white bg-purple-500 hover:bg-purple-700 font-medium rounded-lg text-sm px-5 py-2.5 max-w-fit lg:mr-6 md:mr-6 md:ml-5">
                      <a href="/posts/{{ $post->id }}/edit">編集する</a>
                    </button>
                  </li>
                  <li>
                      <form action="/posts/{{ $post->id }}" method="POST" class="text-right">
                        @csrf
                        @method('PUT')
                        <input type=submit value="{{ $post->status == 'trading' ? '出品を停止' : '出品を再開' }}" class="text-sm hover:bg-red-100 text-red-500 font-semibold hover:text-red-600 py-2 px-3 border border-red-500 rounded">
                      </form>
                  </li>
              @endif
            </ul>
            <div class="md:text-lg md: w-full lg:w-11/12" style="max-width:700px;">
              <div class="flex mx-4 items-center mb-2 md:mt-3 md:w-full lg:gap-3">
                  <p class="font-medium text-normal w-1/3 lg:w-1/4">譲るグッズ</p>
                  <p class="flex-auto text-sm border border-gray-300 py-1 px-2 mt-2 w-full md:text-lg">
                      @foreach ($post->gives as $give)
                            {{ $give->name }}
                      @endforeach
                  </p>
              </div>
              <div class="flex mx-4 items-center mb-2 md:mt-3 md:w-full lg:gap-3">
                  <p class="font-medium text-normal w-1/3 lg:w-1/4">欲しいグッズ</p>
                  <p class="flex-auto text-sm border border-gray-300 py-1 px-2 mt-2 w-full md:text-lg">
                      @foreach ($post->wants as $want)
                          {{ $want->name }}
                      @endforeach
                  </p>
              </div>
            </div>
          
            <div class="w-full p-3 md:2/3 lg:w-full xl:w-full ">
              <p class="text-lg font-semibold mb-3">グッズの説明</p>
              <div class="w-full bg-slate-100 border border-gray-200">
                  <p class="p-2 xl:min-w-xl overflow-y-scroll" style="max-height:150px;">
                  {{ $post->description }}
                  </p>
              </div>
            </div>
            <div class="flex items-center w-full px-3 my-3  md:gap-2 bg-slate-50 md:mx-0 md:px-4 md:mt-7">
              <div class="flex-shrink-0 w-12 h-12 md:w-16 md:h-16">
                  <a href="/users/{{ $post->user_id }}">
                  <img class="w-full h-full rounded-full"
                      src="{{ $post->user->profile_icon ? $post->user->profile_icon : asset('images/user_icon.png') }}"
                      alt="" />
                  </a>
              </div>
              <div class="flex flex-col gap-1 my-5 ">
                <div class="ml-3">
                  <p class="text-gray-900 whitespace-no-wrap md:text-lg md:font-bold">
                    <a href="/users/{{ $post->user_id }}">{{ $post->user->name }}</a>
                  </p>
                </div>
                <div class="flex items-center mt-2 mb-4">
                    @for($i = 0; $i < 5; $i++)
                        @if($i < $review_score)
                            <svg class="w-4 h-4 md:w-5 md:h-5 fill-current text-yellow-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                        @else
                            <svg class="w-4 h-4 md:w-5 md:h-5 fill-current text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                        @endif
                    @endfor
                </div>
              </div>
            </div>
            <div class="w-full">
              <p class="flex-auto text-lg font-semibold text-slate-900 p-1.5 mt-2 ml-5 md:text-xl md:my-3">
                コメントする
              </p>
            </div>
          <div class="flex flex-col flex-auto flex-shrink-0 rounded-2xl bg-slate-100 h-full p-2 w-full" style="max-width:700px;" >
            <div id="chat-board" class="flex flex-col h-full overflow-x-auto max-h-60" style="min-height:100px">
                <div class="flex flex-col h-full">
                  <div class="grid grid-cols-12" id="messages">
                    @if ($post->chats)
                      @foreach ($post->chats as $chat)
                        @if (!Auth::check() || $chat->user_id != Auth::user()->id)
                          <div class="col-start-1 col-end-12 py-1 rounded-lg">
                              <div class="flex flex-row items-center">
                                <div class="flex items-center justify-center h-10 w-10 rounded-full bg-indigo-500 flex-shrink-0">
                                  <a href="/users/{{ $chat->user_id }}">
                                  <img
                                   src="{{ $chat->user->profile_icon ? $chat->user->profile_icon : asset('images/user_icon.png') }}"
                                   class="w-10 h-10 rounded-full object-cover border-none bg-gray-200">
                                   </a>                              </div>
                                <div class="relative ml-3 text-sm bg-white py-2 px-4 shadow rounded-xl">
                                  <div>{{ $chat->message }} </div>
                                </div>
                              </div>
                            </div>
                        @else
                            <div class="col-start-2 col-end-13 py-1 rounded-lg">
                              <div class="flex items-center justify-start flex-row-reverse">
                                <div class="flex items-center justify-center h-10 w-10 rounded-full bg-indigo-500 flex-shrink-0">
                                  <a href="/users/{{ $chat->user_id }}">
                                   <img
                                   src="{{ $chat->user->profile_icon ? $chat->user->profile_icon : asset('images/user_icon.png') }}"
                                   class="w-10 h-10 rounded-full object-cover border-none bg-gray-200">
                                   </a>
                                </div>
                                <div class="relative mr-3 text-sm bg-indigo-100 py-2 px-4 shadow rounded-xl">
                                  <div>{{ $chat->message }}</div>
                                </div>
                              </div>
                            </div>
                        @endif
                      @endforeach
                    @endif
                  </div>
                </div>
            </div>
          </div>
    
          <div class="w-full">
            <form id="message_form" action="/posts/{{ $post->id }}/chat" method="POST">
              @csrf
              
              <div class="flex flex-row items-center h-16 rounded-xl w-full px-1">
                <div class="flex-grow ml-">
                  <div class="relative w-full">
                    <textarea
                      type="text"
                      rows="1"
                      maxlength="200"
                      placeholder="コメントを入力"
                      id="message_input"
                      name="chat[message]"
                      class="flex w-full border rounded-xl focus:outline-none focus:border-indigo-300 pl-4 h-10 resize-y"
                      data-post-id="{{ $post->id }}"
                    ></textarea>
                  </div>
                </div>
                <div class="ml-4">
                  <button
                    name="chat[user_id]"
                    id="chat_btn"
                    value="{{ Auth::check() ? Auth::user()->id : 'guest' }}"
                    class="flex items-center justify-center bg-indigo-500 hover:bg-indigo-600 rounded-xl text-white px-4 py-1 flex-shrink-0"
                  >
                    <span>送信</span>
                  </button>
                </div>
              </div>
            </form>
          </div>
          @error('chat.message')
            <div class="flex bg-blue-100 rounded-lg p-4 my-2 text-sm text-blue-700" role="alert">
                <svg class="w-5 h-5 inline mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                <div>
                    {{ $message }}
                </div>
            </div>
          @enderror
          <div class="bg-white w-full mb-8" style="max-width:400px;">
            <div class=" border-x border-t mt-5">
               <table class="table-auto w-full ">
                  <tbody>
                     
                     <tr class="border-b hover:bg-gray-50">
                        <td class="p-4">
                           状態
                        </td>
                        <td class="p-4">
                            {{ $post->state->state }}
                        </td>
                     </tr>
                     <tr class="border-b hover:bg-gray-50">
                        <td class="p-4">
                           発送元の地域
                        </td>
                        <td class="p-4">
                           {{ $post->area ? $post->area->prefecture : '未定' }}
                        </td>
                     </tr>
                  </tbody>
               </table>
            </div>
          </div>
        </div>
    </div>
    <div class="my-5 mx-1 p-2 md:mx-auto max-w-5xl shadow-md border border-[#e0e0e0]">
      <div class="text-lg font-bold text-center mt-3 mb-3">出品者にトレードリクエストを送る</div>
      <form action="{{ route('store.request') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div>
              <label for="want" class="text-sm font-medium text-gray-900 block mx-7 mb-2">欲しいグッズ</label>
              <input type="text" id="want"name="offer[want_item]" value="{{request('search')}}" 
              class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
          </div>
          @error('offer.want_item')
            @foreach ($errors->get('want') as $messages)
              @foreach ($messages as $message)
                <div class="flex bg-blue-100 rounded-lg p-4 my-2 text-sm text-blue-700" role="alert">
                    <svg class="w-5 h-5 inline mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                    <div>
                        {{ $message }}
                    </div>
                </div>
              @endforeach
            @endforeach
          @enderror
          <div>
              <label for="give" class="text-sm font-medium text-gray-900 block mx-7 my-2">譲るグッズ</label>
              <input type="text" id="give" name="offer[give_item]" value="{{request('search')}}" 
              class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
          </div>
          @error('offer.give_item')
            @foreach ($errors->get('give') as $messages)
              @foreach ($messages as $message)
                <div class="flex bg-blue-100 rounded-lg p-4 my-2 text-sm text-blue-700" role="alert">
                    <svg class="w-5 h-5 inline mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                    <div>
                        {{ $message }}
                    </div>
                </div>
              @endforeach
            @endforeach
          @enderror
          
          <label class="my-3 mx-7 block text-xl font-semibold text-[#07074D]">
            画像をアップロード
          </label>
          <div class="flex-1">
            <div class="grid grid-cols-4 gap-1 md:gap-2 h-20 sm:h-40 md:h-52 lg:h-60 md:mx-8 xl:mx-11">
              <div id="preview0" class="hidden"></div>
              <div class="upload-box0 relative grid grid-cols-1 mx-2 aspect-square max-h-24 sm:max-h-full">
                <div class='flex items-center justify-center w-full absolute top-0 left-0'>
                    <label class='flex flex-col border-4 border-dashed w-full aspect-square hover:bg-gray-100 hover:border-purple-300 group'>
                        <div class='flex flex-col items-center justify-center pt-7'>
                            <svg class="w-10 h-10 text-purple-400 group-hover:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            
                        </div>
                        <input type="file" name="images[0]" id="" accept="image/*" class="file sr-only"/>
                    </label>
                </div>
              </div>
  
              <div id="preview1" class="hidden"></div>
              <div class="upload-box1 relative grid grid-cols-1 mx-2 aspect-square max-h-24 sm:max-h-full">
                <div class='flex items-center justify-center w-full absolute top-0 left-0'>
                    <label class='flex flex-col border-4 border-dashed w-full aspect-square hover:bg-gray-100 hover:border-purple-300 group'>
                        <div class='flex flex-col items-center justify-center pt-7'>
                            <svg class="w-10 h-10 text-purple-400 group-hover:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            
                        </div>
                        <input type="file" name="images[1]" id="" accept="image/*" class="file sr-only"/>
                    </label>
                </div>
              </div>
  
              <div id="preview2" class="hidden"></div>
              <div class="upload-box2 relative grid grid-cols-1 mx-2 aspect-square max-h-24 sm:max-h-full">
                <div class='flex items-center justify-center w-full absolute top-0 left-0'>
                    <label class='flex flex-col border-4 border-dashed w-full aspect-square hover:bg-gray-100 hover:border-purple-300 group'>
                        <div class='flex flex-col items-center justify-center pt-7'>
                            <svg class="w-10 h-10 text-purple-400 group-hover:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            
                        </div>
                        <input type="file" name="images[2]" id="" accept="image/*" class="file sr-only"/>
                    </label>
                </div>
              </div>
  
              <div id="preview3" class="hidden"></div>
              <div class="upload-box3 relative grid grid-cols-1 mx-2 aspect-square max-h-24 sm:max-h-full">
                <div class='flex items-center justify-center w-full absolute top-0 left-0'>
                    <label class='flex flex-col border-4 border-dashed w-full aspect-square hover:bg-gray-100 hover:border-purple-300 group'>
                        <div class='flex flex-col items-center justify-center pt-7'>
                            <svg class="w-10 h-10 text-purple-400 group-hover:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            
                        </div>
                        <input type="file" name="images[3]" id="" accept="image/*" class="file sr-only"/>
                    </label>
                </div>
              </div>
            </div>
            
            <div class="mt-5">
                <textarea
                    name="offer[message]"
                    rows="6"
                    placeholder="メッセージ"
                    class="
                    w-full
                    rounded
                    py-3
                    px-[14px]
                    text-body-color text-base
                    border border-[f0f0f0]
                    resize-none
                    outline-none
                    focus-visible:shadow-none
                    focus:border-primary
                    "
                    ></textarea>
            </div>
            <input type="hidden" name="offer[user_id]" value="{{ Auth::check() ? Auth::user()->id : 'guest' }}">
            <input type="hidden" name="offer[post_id]" value="{{ $post->id }}">
            <div class="text-center my-2">
                <input type=submit value="リクエスト" class=" hover:bg-red-100 text-red-500 font-semibold hover:text-red-600 py-2 px-4 border border-red-500 rounded">
            </div>
          </div>
        </form>
    </div> 

    <script src="/js/show.js"></script>
</x-header>