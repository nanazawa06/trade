<x-header>
    <head class="w-full h-8 bg-gray-300">
        <h1 class="text-xl font-bold text-justify">レビュー</h1>
    </head>
    <div class="grid grid-rows grid-gap-4 m-5">
        @foreach (Auth::user()->receive_reviews as $review)
            <div class="flex flex-row rounded border shadow-md focus:ring-2">
                <div class="mr-3">
                    <img
                         id="preview"
                         src="{{ $review->sender->profile_icon ? $review->sender->profile_icon : asset('images/user_icon.png') }}"
                         alt=""
                         class="w-16 h-16 rounded-full object-cover border-none bg-gray-200">
                </div>
                <div class="m-4">
                    <div class="">
                        <a href="/uses/{{ $proposal->user_id }}">ユーザー：{{ $review->sender->name }}</a>
                        <span class="flex-auto text-lg m-2 font-semibold text-slate-900">{{ $review->comment }}</span>
                    </div>
                    <p class="flex-auto text-lg m-2 font-semibold text-slate-900">{{ $review->comment }}</p>
                </div>
            </div>
        @endforeach
    </div>
</x-header>