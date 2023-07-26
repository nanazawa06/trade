<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>GoodsTrade</title>
        <!-- Fonts -->
        <link href="css/app.css" rel="stylesheet">
        <link href="/css/layout.css" rel="stylesheet">
        <script src="/js/app.js"></script>
    </head>
    <header class="border-b border-slate-200">
      <div class="flex">
        <div class="flex flex-1 items-center gap-x-3 p-6">
            <div class=""><a href="/">
                <svg class="h-8 w-8 text-green-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
              　</svg></a>
             </div>
            <div><h2 class="text-2xl">GoodsTrade</h2></div>
        </div>
        <nav class="ml-auto mr-0 col-span-6 flex flex-wrap items-center text-base justify-end md:flex">
            <span class=""><a href="/posts/create"><button class="bg-blue-100 rounded-lg mr-5 border border-indigo-300">出品</button></a></span>
           @guest
                <span class="rounded-lg"><a href="/register" class="mr-5 hover:text-gray-900">会員登録</a></span>
                <span class="rounded-lg"><a href="/login" class="mr-5 hover:text-gray-900">ログイン</a></span>
            @else
                <span class="rounded-lg"><a href="/mypage" class="mr-5 hover:text-gray-900">マイページ</a></span>
            @endguest         
        </nav>
      </div>
    </header>
    <body>
        {{ $slot }}
    </body>
</html>