<x-header>
        <div class="flex">
            <div class="flex flex-1 items-center gap-x-3 p-6">
                <div class=""><a href="/">
                    <img
                     id="preview"
                     src="{{ Auth::user()->profile_icon ? Auth::user()->profile_icon : asset('images/user_icon.png') }}"
                     alt=""
                     class="w-16 h-16 rounded-full object-cover border-none bg-gray-200"></a>
                </div>
                <div class="flex flex-col">
                    <div><h2 class="text-2xl">{{ $user->name}}</h2></div>
                    <div class="flex items-center justify-center rounded-2xl text-indigo-700 h-5 w-5">
                        <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"></path>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="ml-auto mr-0 col-span-6 flex flex-wrap items-center text-base justify-end md:flex">
                @if(Auth::check() && $user->id == Auth::user()->id)
                <a href="{{ route('profile.edit') }}"><button class="bg-blue-100 rounded-lg mr-5 border border-indigo-300">プロフィールを編集</button></a>
                @endif
            </div>
        </div>
        
        @if (Auth::check() && Auth::id() == $user->id)
            @include('layouts.navigation')
        @endif
        
        <div class="px-9 mt-5 mb-5 border-gray-900 ">
            {{ $user->profile }}
        </div>
        <hr>
        <div class="grid justify-center mt-5 gap-1 grid-cols-3 md:grid-cols-4 gap-5 lg:grid-cols-5">
            @foreach($user->posts as $post)
               <div class="rounded border shadow-md">
                   <div class="rounded w-50 h-50 m-2 border shadow-md overflow-hidden">
                       <a href="/posts/{{ $post->id }}"><img src="{{ $post->images[0]->image_url }} " alt="画像が読み込めません。"/></a>
                   </div>
                   <div>
                       <p class="flex-auto text-lg font-semibold text-slate-900"><a href="/posts/{{ $post->id }}">求：{{$post->wants[0]->name}}</a></p>
                   </div>
               </div>
           @endforeach
        </div>
</x-header>