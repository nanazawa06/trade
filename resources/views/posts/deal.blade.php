<x-header>
    @if (session('error'))
      <div class="flex bg-blue-100 rounded-lg p-4 my-2 text-sm text-blue-700" role="alert">
          <svg class="w-5 h-5 inline mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
          <div>
              {{ session('error') }}
          </div>
      </div>
    @endif
    <head class="w-full h-8 bg-gray-300">
        <h1 class="text-xl font-bold text-justify">取引画面</h1>
    </head>
    <div class="flex flex-wrap">
        <h1 class="flex-auto m-3 text-lg font-semibold text-slate-900">
               譲：{{ $proposal->give_item }}
        </h1>
        <h1 class="flex-auto m-3 text-lg font-semibold text-slate-900">
               求： {{ $proposal->want_item }}
        </h1>
    </div>
    <div class="flex flex-col flex-auto h-full p-6">
        <div class="flex flex-col flex-auto flex-shrink-0 rounded-2xl bg-gray-100 h-full p-4">
            <div class="flex flex-col h-full overflow-x-auto mb-4">
                <div class="flex flex-col h-full">
                  <div class="grid grid-cols-12 gap-y-2">
                    @if ($proposal->chats)
                    
                    @foreach ($proposal->chats as $chat)
                    
                        @if (!Auth::check() || $chat->user_id != Auth::user()->id)
                            <div class="col-start-1 col-end-8 p-3 rounded-lg">
                              <div class="flex flex-row items-center">
                                <div class="flex items-center justify-center h-10 w-10 rounded-full bg-indigo-500 flex-shrink-0">
                                  <a href="/users/{{ $chat->user_id }}">
                                  <img
                                   src="{{ $chat->user->profile_icon ? $chat->user->profile_icon : asset('images/user_icon.png') }}"
                                   class="w-16 h-16 rounded-full object-cover border-none bg-gray-200">
                                   </a>                              </div>
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
                                   class="w-16 h-16 rounded-full object-cover border-none bg-gray-200">
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
            <form action="/posts/{{ $proposal->id }}/deal" method="POST">
                @csrf
                @method('PUT')
              <div class="flex flex-row items-center h-16 rounded-xl bg-white w-full px-4">
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
              </div>
            </form>
        </div>
    </div>
    <x-user-icon user={{ $proposal->post->user }} />
    <form action="{{ route('review') }}" method="POST">
        @csrf
        <div><h4>評価をして下さい</h4></div>
        <div class="max-w-lg mx-auto">
            <fieldset class="flex gap-x-5 mb-5">
                <legend class="sr-only">
                    score
                </legend>
        
                <div class="flex items-center">
                    <input type="radio" name="review[score]" value="5" class="h-4 w-4 border-gray-300 focus:ring-2 focus:ring-blue-300" aria-labelledby="score-option-1" aria-describedby="score-option-1" checked="">
                    <label for="score-option-1" class="text-sm font-medium text-gray-900 ml-2 block">
                    良かった
                    </label>
                </div>
        
                <div class="flex items-center">
                    <input type="radio" name="review[score]" value="3" class="h-4 w-4 border-gray-300 focus:ring-2 focus:ring-blue-300" aria-labelledby="score-option-2" aria-describedby="score-option-2">
                    <label for="score-option-2" class="text-sm font-medium text-gray-900 ml-2 block">
                    ふつう
                    </label>
                </div>
        
                <div class="flex items-center">
                    <input type="radio" name="review[score]" value="0" class="h-4 w-4 border-gray-300 focus:ring-2 focus:ring-blue-300" aria-labelledby="score-option-3" aria-describedby="score-option-3">
                    <label for="score-option-3" class="text-sm font-medium text-gray-900 ml-2 block">
                    良くなかった
                    </label>
                </div>
            </fieldset>
        </div>
        @error('review.score')
            <div class="flex bg-blue-100 rounded-lg p-4 my-2 text-sm text-blue-700" role="alert">
                <svg class="w-5 h-5 inline mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                <div>
                    {{ $message }}
                </div>
            </div>
        @enderror
        
        <div class="m-5 p-3">
            <x-input-label for="review[comment]" :value="__('コメント')" />
            <textarea
              rows="4"
              name="review[comment]"
              class="w-full resize-none rounded-md border border-[#e0e0e0] bg-white py-3 px-4 text-base font-medium shadow-sm text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
              autofocus
            ></textarea>
        </div>
        <button type="submit" class="text-white bg-purple-500 hover:bg-purple-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">取引を終了する</button>
        <input type="hidden" name="review[post_id]" value="{{ $proposal->post->id }}">
        <input type="hidden" name="review[sender_id]" value="{{ Auth::user()->id }}">
        <input type="hidden" name="review[receiver_id]" value="{{ $proposal->post->user->id }}">
    </form>
    <button type="submit" id="requestBtn" class="text-white bg-gray-500 hover:bg-gray-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">キャンセル</button>

</x-header>