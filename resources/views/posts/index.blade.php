<!DOCTYPE html>
<x-header>
    <div class="p-10">
        <div class="serch">
            <form>
                @csrf
                <div>
                    <label for="want" class="text-sm font-medium text-gray-900 block mb-2">欲しいグッズ</label>
                    <input type="search" id="want"name="want" value="{{request('search')}}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5" placeholder="欲しいものを入力してください" aria-lavel="検索">
                </div>
                <div>
                    <label for="give" class="text-sm font-medium text-gray-900 block mb-2">譲るグッズ</label>
                    <input type="search" id="give" name="give" value="{{request('search')}}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5" placeholder="譲るものを入力してください" aria-lavel="検索">
                </div>
                <div>
                    <select name="prefecture" class="p-3 rounded border border-gray-300">
                        <option value="">所在地から検索</option>
                        @foreach ($areas as $prefecture)
                            <option class="" value="{{ $prefecture->id }}">{{ $prefecture->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <button type="submit" value="検索" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-500 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">検索</button>
                </div>
            </form>
        </div>
        <div class="grid justify-center gap-1 grid-cols-3 md:grid-cols-4 gap-5 lg:grid-cols-5">
         @foreach($posts as $post)
            <div class="rounded border shadow-md">
                <div class="rounded w-50 h-50 m-2 border shadow-md overflow-hidden">
                    <a href="/posts/{{ $post->id }}"><img src="{{ $post->id/*$post->images[0]->image_url*/  }}" alt="画像が読み込めません。"/></a>
                </div>
                <div>
                    <p class="flex-auto text-lg font-semibold text-slate-900"><a href="/posts/{{ $post->id }}">求：{{ $post->wants[0]->name }}</a></p>
                </div>
            </div>
        @endforeach
        </div>
</x-header>