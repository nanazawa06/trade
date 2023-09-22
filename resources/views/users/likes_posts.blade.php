<x-header>
    @include('layouts.navigation')
    <head class="w-full h-8 bg-gray-300">
        <h1 class="text-xl sm:text-3xl font-bold ml-11 mt-3 sm:mt-5">いいね！一覧</h1>
    </head>
    <div class="m-2 md:m-8 lg:m-10">
        <div class="grid justify-center gap-1 grid-cols-3 mt-4 md:grid-cols-4 sm:gap-5 lg:grid-cols-5">
         @foreach($posts as $post)
            <div class="rounded border shadow-md">
                <div class="relative rounded m-1 border shadow-md aspect-square overflow-hidden">
                    <a href="/posts/{{ $post->id }}"><img src="{{ $post->images[0]->image_url }}"
                    class="absolute max-w-full max-h-full top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2" alt="画像が読み込めません。"/></a>
                </div>
                <div>
                    <p class="flex-auto text-xs font-bold px-1 pb-2 sm:p-2 sm:text-base"><a href="/posts/{{ $post->id }}">求：{{ $post->wants[0]->name }}</a></p>
                </div>
            </div>
        @endforeach
        </div>
    </div>
    <script src="/js/app.js"></script>
</x-header>