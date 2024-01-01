<!DOCTYPE html>
<x-header>
    <div class="m-1 sm:m-3 md:m-8 lg:m-10">
        <div id="app"></div>
        <div class="serch">
            <form action="{{ route('index') }}" method=GET>
                @csrf
                <div class="flex flex-wrap gap-1 sm:gap-4">
                    <div>
                        <label for="want" class="text-xs sm:text-sm font-medium block mb-1 sm:mb-2">欲しいグッズ</label>
                        <input type="search" id="want"name="want" value="{{request('want')}}" 
                        class="border border-gray-300 text-gray-900 focus:border-[#6A64F1] focus:shadow-md sm:text-sm rounded block p-1.5 sm:p-2.5"
                        style="min-width:300px" aria-lavel="検索">
                    </div>
                    <div>
                        <label for="give" class="text-xs sm:text-sm font-medium block mb-1 sm:mb-2">ゆずるグッズ</label>
                        <input type="search" id="give" name="give" value="{{request('give')}}" 
                        class="border border-gray-300 text-gray-900 focus:border-[#6A64F1] focus:shadow-md sm:text-sm rounded block p-1.5 sm:p-2.5"
                        style="min-width:300px" aria-lavel="検索">
                    </div>
                </div>
                <div class="mt-2 sm:mt-3">
                    <select name="area" class="p-2 text-xs sm:text-base rounded border border-gray-300">
                        <option value="">所在地</option>
                        @foreach ($areas as $prefecture)
                            <option class="p-2 sm:p-3 rounded border border-gray-300" value="{{ $prefecture->id }}">{{ $prefecture->prefecture }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <button type="submit" value="検索" class="inline-flex justify-center py-1 px-3 sm:py-2 sm:px-4 mt-2 sm:mt-3 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-500 hover:bg-indigo-700">検索</button>
                </div>
                
            </form>
        </div>
        <div class="grid justify-center gap-1 grid-cols-3 mt-3 sm:mt-4 md:grid-cols-4 sm:gap-5 lg:grid-cols-5">
         @foreach($posts as $post)
            <div class="rounded border shadow-md">
                <div class="relative rounded m-1 border shadow-md aspect-square overflow-hidden">
                    <a href="/posts/{{ $post->id }}"><img src="{{ $post->images[0]->image_url }}"
                    class="absolute max-w-full max-h-full top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2" alt="画像が読み込めません。"/></a>
                </div>
                <div>
                    <p class="flex-auto text-xs px-1 pb-2 sm:text-base sm:p-2"><a href="/posts/{{ $post->id }}">求：{{ $post->wants[0]->name }}</a></p>
                </div>
            </div>
        @endforeach
        </div>
        <div class='paginate'>
            {{ $posts->links() }}
        </div>
    </div>
</x-header>