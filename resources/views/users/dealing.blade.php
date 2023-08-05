<x-header>
    @include('layouts.navigation')
    <head class="w-full h-8 bg-gray-300">
        <h1 class="text-xl font-bold text-justify">取引中</h1>
    </head>
    <div class="grid grid-rows grid-gap-4 m-5">
        @foreach ($dealings as $proposal)
            <div class="flex flex-row rounded border shadow-md focus:ring-2">
                <div class="rounded w-50 h-50 m-2 border shadow-md focus:ring-2 overflow-hidden">
                    <a href="/posts/requests/{{ $proposal->id }}"><img src="{{ $proposal->images[0]->image_url  }}" alt="画像が読み込めません。"/></a>
                </div>
                <div class="m-4">
                    <div class="flex-auto text-lg m-2 font-semibold text-slate-900"><a href="/users/{{ $proposal->user_id }}">リクエストユーザー：{{ $proposal->user->name }}</a></div>
                    <p class="flex-auto text-lg m-2 font-semibold text-slate-900">求：{{ $proposal->want_item }}</p>
                    <p class="flex-auto text-lg m-2 font-semibold text-slate-900">譲：{{ $proposal->give_item }}</p> 
                </div>
            </div>
        @endforeach
    </div>
</x-header>