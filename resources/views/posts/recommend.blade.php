<x-header>
  <div class="m-1 sm:m-3 md:m-8 lg:m-10">
      <div class="bg-slate-100 mx-auto">
          <div class="flex justify-between py-2">
              <div class="flex mx-auto">
                  <!-- Navigation Links -->
                  <div class="space-x-8 sm:-my-px sm:ml-10 sm:flex">
                      <x-nav-link :href="route('index')" :active="request()->routeIs('index')">
                          {{ __('トップ') }}
                      </x-nav-link>
                      <x-nav-link :href="route('recommend')" :active="request()->routeIs('recommend')">
                          {{ __('おすすめ') }}
                      </x-nav-link>
                  </div>
              </div>
          </div>
      </div>
      <div class="grid justify-center gap-1 grid-cols-3 mt-3 sm:mt-4 md:grid-cols-4 sm:gap-5 lg:grid-cols-5">
       @foreach($posts as $post)
          <div class="rounded border shadow-md">
              <div class="relative rounded m-1 border shadow-md aspect-square overflow-hidden">
                  <a href="/posts/{{ $post->id }}"><img src="{{ $post->images[0]->image_url }}"
                  class="absolute max-w-full max-h-full top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2" alt="画像が読み込めません。"/></a>
              </div>
              <div>
                  <p class="flex-auto text-xs font-mono px-1 pb-2 sm:text-base sm:p-2"><a href="/posts/{{ $post->id }}"><span class="bg-blue-200 text-blue-500 font-bold border rounded-md pl-1 py-0.5"> 求 </span>  {{ $post->wants[0]->name }}</a></p>
              </div>
          </div>
      @endforeach
      </div>
  </div>
</x-header>