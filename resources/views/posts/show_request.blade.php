<x-header>
    <div class="p-3 m-3">
        <div class="preview-box flex flex-rows-2 relative gap-y-3 gap-x-3">
            @foreach ( $proposal->images as $image )
                <div class="flex-none w-150 relative">
                    <img src="{{ $image->image_url }}" alt="サムネイル" class="absolute inset-0 w-full h-full object-cover" loading="lazy" />
                </div>
            @endforeach
        </div>
        <x-user-icon user="{{ $proposal->user }}"></x-user-icon>
        <div class="flex flex-wrap">
            <h1 class="flex-auto text-lg font-semibold text-slate-900">
                {{ $proposal->want_item }}
            </h1>
            <h1 class="flex-auto text-lg font-semibold text-slate-900">
                {{ $proposal->give_item }}
            </h1>
        </div>
        <div class="bg-gray-300">
            <p class="flex-auto m-2 text-slate-500">{{ $proposal->message }}</p>
        </div>
        <form action="/posts/{{ $proposal->id }}/deal" method="POST">
            @csrf
            <input type="hidden" name="user_id" value="{{ $proposal->user_id }}">
            <button type="submit" class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 ml-3 bg-gray-100 transition duration-150 text-gray-600 ease-in-out hover:border-gray-400 hover:bg-gray-300 border rounded px-8 py-2 text-sm">承諾する</button>
        </form>
    </div>
</x-header>