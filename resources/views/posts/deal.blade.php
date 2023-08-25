<x-header>
    @if (session('error'))
      <div class="flex bg-blue-100 rounded-lg p-4 my-2 text-sm text-blue-700" role="alert">
          <svg class="w-5 h-5 inline mr-3 md:mt-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
          <div class="md:text-lg">
              {{ session('error') }}
          </div>
      </div>
    @endif
    <head class="w-full h-8 bg-gray-300 my-3">
        <h1 class="text-2xl font-bold text-center md:text-3xl md:my-2">取引画面</h1>
    </head>
    <div class="w-full flex mx-auto flex-col  md:w-4/5 lg:w-2/3 xl:w-1/2">
      <div class="md:text-lg md:mt-3">
        <div class="flex gap-5 mx-4 items-center mb-2">
            <p class="font-medium text-normal">譲るグッズ</p>
            <p class="flex-auto text-sm border border-gray-300 py-1 px-2 mt-2 md:text-lg">
                {{ $proposal->give_item }}
            </p>
        </div>
        <div class="flex gap-2 mx-4 items-center">
            <p class="font-medium text-normal">欲しいグッズ</p>
            <p class="flex-auto text-sm border border-gray-300 py-1 px-2 mt-2 md:text-lg">
                  {{ $proposal->want_item }}
            </p>
        </div>
      </div>
      
      <div class="flex flex-col flex-auto h-full px-4" >
        <div class="w-full">
        <p class="flex-auto text-lg font-semibold text-slate-900 p-1.5 mt-2 ml-5 md:text-xl md:my-3">
          コメントする
        </p>
      </div>
      <div class="flex flex-col flex-auto flex-shrink-0 rounded-2xl bg-slate-100 h-full p-2 w-full" style="max-width:700px;" >
        <div id="chat-board" class="flex flex-col h-full" style="min-height:100px">
            <div class="flex flex-col h-full">
              <div class="grid grid-cols-12" id="messages">
                @if ($proposal->chats)
                  @foreach ($proposal->chats as $chat)
                    @if (!Auth::check() || $chat->user_id != Auth::user()->id)
                      <div class="col-start-1 col-end-12 py-1 rounded-lg">
                          <div class="flex flex-row items-center">
                            <div class="flex items-center justify-center h-10 w-10 rounded-full flex-shrink-0">
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
        <form id="message_form" action="/posts/{{ $proposal->id }}/deal/chat" method="POST">
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
                  data-proposal-id="{{ $proposal->id }}"
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
      <div class="flex items-center px-3 my-3  md:gap-2 bg-slate-50 md:mx-0 md:px-4 md:mt-7">
        <div class="flex-shrink-0 w-12 h-12 md:w-16 md:h-16">
          <a href="/users/{{ $proposal->user_id }}">
          <img class="w-full h-full rounded-full"
              src="{{ $proposal->user->profile_icon ? $proposal->user->profile_icon : asset('images/user_icon.png') }}"
              alt="" />
          </a>
        </div>
        <div class="flex flex-col gap-1 my-5 ">
          <div class="ml-3">
            <p class="text-gray-900 whitespace-no-wrap md:text-lg md:font-bold">
              <a href="/users/{{ $proposal->user_id }}">{{ $proposal->user->name }}</a>
            </p>
          </div>
          <div class="flex ml-2 items-center">
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
      <x-user-icon user={{ $proposal->post->user }} />
      <form action="{{ route('review') }}" method="POST" class="mx-4 my-2 flex flex-col">
          @csrf
          <div class="m-2"><h4 class="text-lg font-medium md:text-xl text-center md:my-3">評価をして下さい</h4></div>
          <div class="max-w-lg mx-auto">
              <fieldset class="flex gap-x-5 mb-5">
                  <legend class="sr-only">
                      score
                  </legend>
          
                  <div class="flex items-center">
                      <input type="radio" name="review[score]" value="5" class="h-4 w-4 border-gray-300 focus:ring-2 focus:ring-blue-300" aria-labelledby="score-option-1" aria-describedby="score-option-1" checked="">
                      <label for="score-option-1" class="text-sm font-medium text-gray-900 ml-2 block md:text-lg">
                      良かった
                      </label>
                  </div>
          
                  <div class="flex items-center">
                      <input type="radio" name="review[score]" value="3" class="h-4 w-4 border-gray-300 focus:ring-2 focus:ring-blue-300" aria-labelledby="score-option-2" aria-describedby="score-option-2">
                      <label for="score-option-2" class="text-sm font-medium text-gray-900 ml-2 block md:text-lg">
                      ふつう
                      </label>
                  </div>
          
                  <div class="flex items-center">
                      <input type="radio" name="review[score]" value="1" class="h-4 w-4 border-gray-300 focus:ring-2 focus:ring-blue-300" aria-labelledby="score-option-3" aria-describedby="score-option-3">
                      <label for="score-option-3" class="text-sm font-medium text-gray-900 ml-2 block md:text-lg">
                      良くなかった
                      </label>
                  </div>
              </fieldset>
          </div>
          @error('review.score')
              <div class="flex bg-blue-100 rounded-lg p-3 text-sm text-blue-700" role="alert">
                  <svg class="w-5 h-5 inline mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                  <div>
                      {{ $message }}
                  </div>
              </div>
          @enderror
          
          <div class="my-2">
              <x-input-label for="review[comment]" :value="__('コメントを送る')" />
              <textarea
                rows="4"
                name="review[comment]"
                class="w-full resize-none rounded-md border border-[#e0e0e0] bg-white py-3 px-4 text-base font-medium shadow-sm text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                autofocus
              ></textarea>
          </div>
          <div class="flex flex-col items-center">
            <button type="submit" class="text-white bg-purple-500 hover:bg-purple-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 max-w-fit">
              取引を終了する
              </button>
          </div>
          <input type="hidden" name="review[proposal_id]" value="{{ $proposal->id }}">
          <input type="hidden" name="review[sender_id]" value="{{ Auth::user()->id }}">
          
      </form>
      <form action="/posts/{{ $proposal->id }}/deal" method="POST" class="mx-4 my-2 flex flex-col items-center">
          @csrf
          @method('DELETE')
        <button type="submit" id="requestBtn"
        class="text-white bg-gray-500 hover:bg-gray-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
          キャンセル
        </button>
      </form>
      </div>
    </div>
    <script src="/js/deal.js"></script>
</x-header>