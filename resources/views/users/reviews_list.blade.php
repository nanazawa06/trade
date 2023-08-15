<x-header>
    @include('layouts.navigation')
    <head class="w-full h-8 bg-gray-300">
        <h1 class="text-xl font-bold text-justify">レビュー</h1>
    </head>
    <div class="flex flex-col items-center">
        @foreach (Auth::user()->receive_reviews as $review)
            <div class="flex items-center px-3 my-3 mx-4 w-full border md:gap-2 bg-slate-50 md:mx-3 md:px-4 md:mt-7 md:w-2/3 lg:w-1/2">
              <div class="flex-shrink-0 w-12 h-12 md:w-16 md:h-16">
                <a href="/users/{{ $review->sender_id }}">
                <img class="w-full h-full rounded-full"
                    src="{{ $review->sender->profile_icon ? $review->sender->profile_icon : asset('images/user_icon.png') }}"
                    alt="" />
                </a>
              </div>
              <div class="flex flex-col gap-1 my-5 ">
                <div class="ml-4">
                  <p class="text-gray-900 whitespace-no-wrap md:text-lg md:font-bold">
                    <a href="/users/{{ $review->sender_id }}">{{ $review->sender->name }}</a>
                  </p>
                </div>
                <div class="ml-4">
                  <p>{{ $review->comment }}</p>
                </div>
              </div>
            </div>
        @endforeach
    </div>
    <script src="/js/app.js"></script>
</x-header>