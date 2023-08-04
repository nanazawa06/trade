<x-header>
    <head class="w-full h-8 bg-gray-300">
        <h1 class="text-xl font-bold text-justify">リクエスト一覧</h1>
    </head>
    <div class="grid grid-rows grid-gap-4 m-5">
        @foreach ($proposals as $proposal)
            <div class="flex flex-row rounded border shadow-md focus:ring-2">
                <div class="rounded w-50 h-50 m-2 border shadow-md focus:ring-2 overflow-hidden">
                    <a href="/posts/{{ $proposal->id }}"><img src="{{ $proposal->images[0]->image_url  }}" alt="画像が読み込めません。"/></a>
                </div>
                <div class="m-4">
                    <div class="flex-auto text-lg m-2 font-semibold text-slate-900"><a href="/users/{{ $proposal->user_id }}">リクエストユーザー：{{ $proposal->user->name }}</a></div>
                    <p class="flex-auto text-lg m-2 font-semibold text-slate-900">求：{{ $proposal->want_item }}</p>
                    <p class="flex-auto text-lg m-2 font-semibold text-slate-900">譲：{{ $proposal->give_item }}</p>                        
                    <form action="/posts/{{ $proposal->post->id }}/deal" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $proposal->user_id }}">
                        <button type="submit" class="focus:outline-none focus:ring-2 focus:ring-offset-2  focus:ring-gray-400 ml-3 bg-gray-100 transition duration-150 text-gray-600 ease-in-out hover:border-gray-400 hover:bg-gray-300 border rounded px-8 py-2 text-sm">承諾する</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</x-header>