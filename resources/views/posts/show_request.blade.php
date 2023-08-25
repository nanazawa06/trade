<x-header>
     <head class="w-full h-8 bg-gray-300 my-3">
        <h1 class="text-2xl font-bold text-center md:text-3xl md:my-2">リクエスト詳細</h1>
    </head>
    <div class="flex flex-col items-center mx-1 sm:mx-3">
        <div class="aspect-square max-w-2xl relative w-full bg-slate-100 md:">
              <img src="{{ $proposal->images()->first() ? $proposal->images[0]->image_url : asset('images/no_image.jpg') }}" alt="画像が読み込めませんでした" id="big-image" 
                class="main-image absolute max-w-full max-h-full top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2" loading="lazy" />
        </div>
  
      <div class="grid grid-cols-4 gap-1 w-full md:w-2/3 xl:w-3/6">
        @if ($proposal->images()->first())
            @foreach ($proposal->images as $image)
                <div class="relative aspect-square h-full w-full mx-auto bg-slate-100 rounded-5">
                    <img src="{{ $image->image_url }}" class="sub-image absolute max-w-full max-h-full top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-slate-100" loading="lazy" />
                </div>
            @endforeach
        @endif
      </div>  
    
      <div class="flex items-center px-3 my-3 w-full md:gap-2 bg-slate-50 md:mx-3 md:px-4 md:mt-7 md:w-2/3 lg:w-1/2">
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
    
      <div class="md:text-lg md:mt-3 w-full md:w-2/3 md:" style="max-width:700px;">
        <div class="flex mx-4 items-center mb-2 md:mt-7 md:w-10/12 lg:w-1/2">
            <p class="font-medium text-normal w-1/3">譲るグッズ</p>
            <p class="flex-auto text-sm border border-gray-300 py-1 px-2 mt-2 w-full md:text-lg">
                {{ $proposal->give_item }}
            </p>
        </div>
        <div class="flex mx-4 items-center mb-2 md:mt-7 md:w-10/12 lg:w-1/2">
            <p class="font-medium text-normal w-4/12">欲しいグッズ</p>
            <p class="flex-auto text-sm border border-gray-300 py-1 px-2 mt-2 w-full md:text-lg">
                {{ $proposal->want_item }}
            </p>
        </div>
      </div>
    
      <div class="w-full p-3 md:w-2/3 xl:w-1/2">
        <p class="text-lg font-semibold  mb-3">メッセージ</p>
        <div class="w-full bg-slate-100 border border-gray-200" style="min-height:110px;">
          <p class=" xl:min-w-xl">{{ $proposal->message }}</p>
        </div>
      </div>
    　<form action="/posts/{{ $proposal->id }}/deal" method="POST" class="mb-5">
          @csrf
          @method('PUT')
          <input type="hidden" name="user_id" value="{{ $proposal->user_id }}">
          <div class="text-center mt-2">
            <input type=submit value="承諾する" class="px-2 py-1 text-xs md:text-sm hover:bg-red-100 text-red-400 bg-p font-semibold hover:text-red-600 border border-red-500 rounded">
          </div>
      </form>
    </div>
    <script src="/js/show.js"></script>
</x-header>