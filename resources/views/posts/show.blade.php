<x-header>
    <div class="mx-5">
        <div class="flex flex-wrap justify-center font-sans gap-x-3">
          <div class="flex gap-3">
            <div class="flex flex-col relative gap-y-1">
                @foreach ($post->images as $image)
                    <div style="max-width:6rem"class="flex-none aspect-square bg-gray-200">
                        <img src="{{ $image->image_url }}" alt="サムネイル" class="sub-image inset-0 w-full h-full object-cover" loading="lazy" />
                    </div>
                @endforeach
            </div>
          
            <div class="flex aspect-square max-w-xl bg-gray-200">
                <img src="{{ $post->images[0]->image_url }}" alt="" id="main-image" class="main-image inset-0 w-full h-full object-cover" loading="lazy" />
            </div>
          </div>
        
          <div class="pt-5 pl-8" style="width:500px;">
              @if (Auth::check() && Auth::user()->id = $post->user->id)
                <a href="/posts/{{ $post->id }}/edit">
                  <button type=submit class=" mb-3 hover:bg-red-100 text-red-500 font-semibold hover:text-red-600 py-2 px-4 border border-red-500 rounded">
                    編集する
                  </button>
                 </a>
              @endif
              </form>
              <div class="">
                <p class="text-gray-900 text-xl title-font mb-3 border-b-2 ">譲
                </p>
                @foreach ($post->gives as $give)
                  <h1 class="text-gray-900 text-2xl max-w-xl title-font font-medium mb-1">
                      {{ $give->name }}
                  </h1>
                @endforeach
                  <div class="px-14">
                  <svg class="h-24 w-24 text-red-500 "  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/>
                    </svg>
                  </div>
                  <p class="text-gray-900 text-xl title-font mb-3 border-b-2 ">求
                </p>
                @foreach ($post->wants as $want)
                  <h1 class="max-w-xl font-semibold text-slate-900 title-font text-2xl mt-3">
                    {{ $want->name }}
                  </h1>
                @endforeach
              </div>
              <p class="mt-7 font-bold text-lg">グッズの説明</p>
              <div class=" bg-slate-100 p-3 mt-3">
                <p class="mt-4 col-start-1 dark:text-slate-700 text-xl">
                    {{ $post->description }}
                </p>
              </div>
        </div>
      </div>
      

        <div class="flex flex-wrap justify-center">
          <div class="flex flex-col flex-auto h-full p-2 mt-4 max-w-2xl">
            <div class="flex flex-col flex-auto flex-shrink-0 rounded-2xl bg-gray-100 h-full p-4">
              <div class="flex flex-col h-full overflow-x-auto mb-4">
                <div class="flex flex-col h-full">
                  <div class="grid grid-cols-12 gap-y-2">
                    @if ($post->chats)
                    
                    @foreach ($post->chats as $chat)
                    
                        @if (!Auth::check() || $chat->user_id != Auth::user()->id)
                            <div class="col-start-1 col-end-8 p-3 rounded-lg">
                              <div class="flex flex-row items-center">
                                <div class="flex items-center justify-center h-10 w-10 rounded-full bg-indigo-500 flex-shrink-0">
                                  <a href="/users/{{ $chat->user_id }}">
                                   <img
                                   src="{{ $chat->user->profile_icon ? $chat->user->profile_icon : asset('images/user_icon.png') }}"
                                   class="rounded-full object-cover border-none bg-gray-200">
                                   </a>
                                </div>
                                <div class="relative ml-3 text-sm bg-white py-2 px-4 shadow rounded-xl">
                                  <div>{{ $chat->message }}</div>
                                </div>
                              </div>
                            </div>
                        @else
                            <div class="col-start-6 col-end-13 p-3 rounded-lg">
                              <div class="flex items-center justify-start flex-row-reverse">
                                <div class="flex items-center justify-center h-10 w-10 rounded-full bg-indigo-500 flex-shrink-0">
                                  <a href="/users/{{ $chat->user_id }}">
                                   <img
                                   src="{{ $chat->user->profile_icon ? $chat->user->profile_icon : asset('images/user_icon.png') }}"
                                   class="rounded-full object-cover border-none bg-gray-200">
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
              <form action="/posts/{{ $post->id }}" method="POST">
                @csrf
                @method('PUT')
                  <div class="flex flex-wrap gap-2 items-center h-auto rounded-xl bg-white w-full p-2">
                    <div class="flex-grow ml-4">
                      <div class="relative w-full">
                        <input
                          type="text"
                          name="chat[message]"
                          class="flex w-full border rounded-xl focus:outline-none focus:border-indigo-300 pl-4 h-10"
                        />
                      </div>
                    </div>
                    <div class="ml-4">
                      <button
                        name="chat[user_id]"
                        value="{{ Auth::check() ? Auth::user()->id : 'guest' }}"
                        class="flex items-center justify-center bg-indigo-500 hover:bg-indigo-600 rounded-xl text-white px-4 py-1 flex-shrink-0"
                      >
                        <span>コメントする</span>
                        <span class="ml-2">
                          <svg
                            class="w-4 h-4 transform rotate-45 -mt-px"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg"
                          >
                            <path
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"
                            ></path>
                          </svg>
                        </span>
                      </button>
                    </div>
                </form>
              </div>
            </div>
          </div>
          <div class="bg-white" style="width:300px;">
            <div class=" border-x border-t mt-5">
               <table class="table-auto w-full ">
                  <tbody>
                     <tr class="border-b hover:bg-gray-50">
                        <td class="p-4">
                           出品者 
                        </td>
                        <td class="p-4">
                           {{ $post->user->name }}
                        </td>
                     </tr>
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
                           {{ $post->area ? $post->area->prefecture : "未定" }}
                        </td>
                     </tr>
                  </tbody>
               </table>
            </div>
          </div> 
        </div>

        <div class="request my-5 mx-2 p-5 max-w-6xl  shadow-md border border-[#e0e0e0]">
            <div class="text-lg font-bold text-center mt-3 mb-3">出品者にトレードリクエストを送る</div>
            <form action="{{ route('store.request') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div>
                    <label for="want" class="text-sm font-medium text-gray-900 block mx-7 mb-2">欲しいグッズ</label>
                    <input type="text" id="want"name="offer[want_item]" value="{{request('search')}}" 
                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                </div>
                <div>
                    <label for="give" class="text-sm font-medium text-gray-900 block mx-7 mb-2">譲るグッズ</label>
                    <input type="text" id="give" name="offer[give_item]" value="{{request('search')}}" 
                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                </div>
                
                <label class="mb-3 mx-7 block text-xl font-semibold text-[#07074D]">
                  画像をアップロード
                </label>
                <div class="flex-1">
                  <div class="grid grid-cols-4 gap-2">
                    <div id="preview0" class="hidden"></div>
                    <div class="upload-box0 relative grid grid-cols-1 mx-2 aspect-square">
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
                    <div class="upload-box1 relative grid grid-cols-1 mx-2 aspect-square">
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
                    <div class="upload-box2 relative grid grid-cols-1 mx-2 aspect-square">
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
                    <div class="upload-box3 relative grid grid-cols-1 mx-2 aspect-square">
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
                  
                  <div class="mt-8">
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
                  <div class="text-center mt-2">
                      <input type=submit value="リクエスト" class=" hover:bg-red-100 text-red-500 font-semibold hover:text-red-600 py-2 px-4 border border-red-500 rounded">
                  </div>
                </div>
              </form>
          </div> 
    </div> 
    <script src="/js/show.js"></script>
</x-header>