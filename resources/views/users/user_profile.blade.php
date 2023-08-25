<x-header>
    @if (Auth::check() && Auth::id() == $user->id)
        @include('layouts.navigation')
    @endif
    <div class="flex">
        <div class="flex flex-1 items-center gap-x-3 py-1 px-6 sm:py-6">
            <div class=""><a href="/users/{{ $user->id }}">
                <img
                 id="preview"
                 src="{{ $user->profile_icon }}"
                 alt=""
                 class="w-12 h-12 md:w-16 md:h-16 rounded-full object-cover border-none bg-gray-200"></a>
            </div>
            <div class="flex flex-col">
                <div><h2 class="text-2xl">{{ $user->name}}</h2></div>
                <div class="flex items-center justify-center mt-2 mb-4">
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
        <div class="ml-auto mr-0 col-span-6 flex flex-wrap items-center text-base justify-end md:flex">
            @if(Auth::check() && $user->id == Auth::user()->id)
                <a href="{{ route('profile.edit') }}">
                    <button class="text-xs sm:text-sm hover:bg-red-100 text-red-500 font-semibold hover:text-red-600 py-2 px-3 border border-red-500 rounded">
                        プロフィールを編集
                    </button>
                </a>
            @endif
        </div>
    </div>
    
    <div class="px-9 mt-5 mb-5 border-gray-900 ">
        {{ $user->profile }}
    </div>
    <hr>
    <div class="grid justify-center mt-5 sm:mx-3 gap-1 grid-cols-3 md:grid-cols-4 sm:gap-5 lg:grid-cols-5 md:m-8 lg:m-10">
        @foreach($posts as $post)
           <div class="rounded border shadow-md">
                <div class="relative rounded m-1 border shadow-md aspect-square overflow-hidden">
                    <a href="/posts/{{ $post->id }}"><img src="{{ $post->images[0]->image_url }}"
                    class="absolute max-w-full max-h-full top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2" alt="画像が読み込めません。"/></a>
                </div>
                <div>
                    <p class="flex-auto text-xs sm:text-base p-2"><a href="/posts/{{ $post->id }}">求：{{ $post->wants[0]->name }}</a></p>
                </div>
            </div>
       @endforeach
    </div>
    <script src="/js/app.js"></script>
</x-header>