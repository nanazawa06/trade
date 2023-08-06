<x-header>
    @if (Auth::check() && Auth::id() == $user->id)
        @include('layouts.navigation')
    @endif
    <div class="flex">
        <div class="flex flex-1 items-center gap-x-3 p-6">
            <div class=""><a href="/">
                <img
                 id="preview"
                 src="{{ $user->profile_icon ? $user->profile_icon : asset('images/user_icon.png') }}"
                 alt=""
                 class="w-16 h-16 rounded-full object-cover border-none bg-gray-200"></a>
            </div>
            <div class="flex flex-col">
                <div><h2 class="text-2xl">{{ $user->name}}</h2></div>
                <div class="flex items-center justify-center mt-2 mb-4">
                    @for($i = 0; $i < 5; $i++)
                        @if($i < $review_score)
                            <svg class="mx-1 w-4 h-4 fill-current text-yellow-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                        @else
                            <svg class="mx-1 w-4 h-4 fill-current text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                        @endif
                    @endfor
                </div>
            </div>
        </div>
        <div class="ml-auto mr-0 col-span-6 flex flex-wrap items-center text-base justify-end md:flex">
            @if(Auth::check() && $user->id == Auth::user()->id)
            <a href="{{ route('profile.edit') }}"><button class="bg-blue-100 rounded-lg mr-5 border border-indigo-300">プロフィールを編集</button></a>
            @endif
        </div>
    </div>
    
    <div class="px-9 mt-5 mb-5 border-gray-900 ">
        {{ $user->profile }}
    </div>
    <hr>
    <div class="grid justify-center mt-5 gap-1 grid-cols-3 md:grid-cols-4 gap-5 lg:grid-cols-5">
        @foreach($user->posts as $post)
           <div class="rounded border shadow-md">
               <div class="rounded w-50 h-50 m-2 border shadow-md overflow-hidden">
                   <a href="/posts/{{ $post->id }}"><img src="{{$post->id /*$post->images[0]->image_url*/ }} " alt="画像が読み込めません。"/></a>
               </div>
               <div>
                   <p class="flex-auto text-lg font-semibold text-slate-900"><a href="/posts/{{ $post->id }}">求：{{$post->wants[0]->name}}</a></p>
               </div>
           </div>
       @endforeach
    </div>
</x-header>