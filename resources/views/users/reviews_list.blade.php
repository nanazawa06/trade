<x-header>
    @include('layouts.navigation')
    <head class="w-full h-8 bg-gray-300">
        <h1 class="text-xl font-bold text-justify">レビュー</h1>
    </head>
    <div class="grid grid-rows grid-gap-4 mx-5">
        @foreach (Auth::user()->receive_reviews as $review)
            <div class="flex flex-col rounded border shadow-md focus:ring-2">
                <div class="mr-3">
                    <img
                         id="preview"
                         src="{{ $review->sender->profile_icon ? $review->sender->profile_icon : asset('images/user_icon.png') }}"
                         alt=""
                         class="w-16 h-16 rounded-full object-cover border-none bg-gray-200">
                </div>
                <div class="flex flex-rows gap-3 m-4">
                    <div class="">
                        <p class="font-semibold text-slate-600"><a href="/users/{{ $review->sender_id }}">{{ $review->sender->name }}</a></p>
                    </div>
                    <div class="bg-gray-300">
                        <p class="flex-auto m-2 text-slate-500">{{ $review->comment }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <script src="/js/app.js"></script>
</x-header>