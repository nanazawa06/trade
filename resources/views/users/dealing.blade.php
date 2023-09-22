<x-header>
    @include('layouts.navigation')
    <head class="w-full h-8">
        <h1 class="text-xl sm:text-3xl font-bold ml-11 mt-3 sm:mt-5">取引中</h1>
    </head>
    <div class="m-1 sm:m-3 md:m-8 lg:m-10">
        @foreach ($dealings as $proposal)
            <div class="flex flex-col p-2 m-2 sm:m-5 text-lg font-semibold shadow-md border rounded-sm mx-6 xl:mx-24">
                <div class="flex flex-row gap-5 items-center xl:gap-10">
                  <div class="w-1/5 aspect-square flex-shrink-0 relative" style="min-width:100px;">
                    <a href="/posts/{{ $proposal->id }}/deal">
                      <img class="absolute max-w-full max-h-full top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2" src="{{ $proposal->images()->first() ? $proposal->images[0]->image_url : asset('images/no_image.jpg') }}" alt="画像が読み込めません。"/>
                    </a>
                  </div>
                  <div class="flex flex-col gap-1">
                      <div class="flex items-center">
                        <div class="flex-shrink-0 w-8 h-8 md:w-10 md:h-10 lg:w-14 lg:h-14">
                          <a href="/users/{{ $proposal->user_id }}">
                          <img class="w-full h-full rounded-full"
                              src="{{ $proposal->user->profile_icon ? $proposal->user->profile_icon : asset('images/user_icon.png') }}"
                              alt="" />
                          </a>
                        </div>
                        <div class="flex flex-wrap">
                          <div class="ml-3">
                            <p class="text-gray-900 whitespace-no-wrap text-sm md:text-lg lg:text-xl">
                              <a href="/users/{{ $proposal->user_id }}">{{ $proposal->user->name }}</a>
                            </p>
                          </div>
                          <div class="flex ml-2 items-center">
                            @for($i = 0; $i < 5; $i++)
                                @if($i < $proposal->user->averageScore())
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
                        <a href="/posts/{{ $proposal->id }}/deal">
                        <p class="text-xs text-gray-800 font-semibold md:text-lg">求：{{ $proposal->want_item }} </p>
                        <p class="text-xs text-gray-800 md:text-lg">譲：{{ $proposal->give_item }}</p>
                        </a>
                  </div>
               </div>
            </div>
        @endforeach
    </div>
    <script src="/js/app.js"></script>
</x-header>