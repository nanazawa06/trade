<x-header>
    <div>
        <div class="flex font-sans gap-x-3">
            <div class="preview-box flex-row relative gap-y-1">
                @foreach ( $post->images as $image )
                    <div class="flex-none w-40 relative">
                        <img src="{{ $image->image_url }}" alt="サムネイル" class="absolute inset-0 w-full h-full object-cover" loading="lazy" />
                    </div>
                @endforeach
            </div>
            <div class="top-preview flex-none w-48 relative">
                <img src="{{ $post->images[0]->image_url }}" alt="" id="mainImage" class="absolute inset-0 w-full h-full object-cover" loading="lazy" />
            </div>
            <div class="flex-auto p-6">
                <div class="flex flex-wrap">
                    <h1 class="flex-auto text-lg font-semibold text-slate-900">
                        @foreach ($post->wants as $want)
                            {{ $want->name }}
                        @endforeach
                    </h1>
                    <h1 class="flex-auto text-lg font-semibold text-slate-900">
                        @foreach ($post->gives as $give)
                            {{ $give->name }}
                        @endforeach
                    </h1>
                </div>
                <p class="mt-4 text-sm leading-6 col-start-1 dark:text-slate-600">
                    {{ $post->description }}
                </p>
            </div>
        </div>
        <div class="flex font-sans">
          <div class="flex flex-col flex-auto h-full p-6">
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
                                  A
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
                                  B
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
              <div class="flex flex-row items-center h-16 rounded-xl bg-white w-full px-4">
                <form action="/posts/{{ $post->id }}" method="POST">
                @csrf
                @method('PUT')
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

          <div class="bg-white">
            <div class="overflow-x-auto border-x border-t">
               <table class="table-auto w-full">
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
                           {{ $post->user->area->prefecture }} 
                        </td>
                     </tr>
                  </tbody>
               </table>
            </div>
          </div>
        </div>
        <div class="request">
            <form action="{{ route('store.request') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div>
                    <label for="want" class="text-sm font-medium text-gray-900 block mb-2">欲しいグッズ</label>
                    <input type="text" id="want"name="offer[want_item]" value="{{request('search')}}" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block rounded-none rounded-r-md sm:text-sm border-gray-300" placeholder="欲しいグッズ" aria-lavel="検索">
                </div>
                <div>
                    <label for="give" class="text-sm font-medium text-gray-900 block mb-2">譲るグッズ</label>
                    <input type="text" id="give" name="offer[give_item]" value="{{request('search')}}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5" placeholder="譲るグッズ" aria-lavel="検索">
                </div>
            
                <div class="preview-box flex"></div>
                <div class="upload-box"></div>
                <div class="grid grid-cols-1 mt-5 mx-7">
                    <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold mb-1">Upload Photo</label>
                    <div class='flex items-center justify-center w-full'>
                        <label class='flex flex-col border-4 border-dashed w-full h-32 hover:bg-gray-100 hover:border-purple-300 group'>
                            <div class='flex flex-col items-center justify-center pt-7'>
                                <svg class="w-10 h-10 text-purple-400 group-hover:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <p class='lowercase text-sm text-gray-400 group-hover:text-purple-600 pt-1 tracking-wider'>Select a photo</p>
                            </div>
                            <input type="file" name="images[]" id="input" accept="image/*" multiple class="sr-only" />
                        </label>
                    </div>
                </div>
                <input type="hidden" name="offer[user_id]" value="{{ Auth::check() ? Auth::user()->id : 'guest' }}">
                <input type="hidden" name="offer[post_id]" value="{{ $post->id }}">
                <div>
                    <input type=submit value="リクエスト" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5">
                </div>
            </form>
        </div>
    </div>
    <script src="/js/show.js"></script>
</x-header>