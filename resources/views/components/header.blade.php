<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>GoodsTrade</title>
        <link href="/css/app.css" rel="stylesheet">
        <!-- Fonts -->
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
            <span class=""><a href="/posts/create"><button class="p-2 pl-5 pr-5 bg-red-500 text-gray-100 text-lg rounded-lg focus:border-4 border-red-300">出品</button></a></span>
           @guest
                <span class="rounded-lg"><a href="/register" class="mr-5 hover:text-gray-900">会員登録</a></span>
                <span class="rounded-lg"><a href="/login" class="mr-5 hover:text-gray-900">ログイン</a></span>
            @else
                <span class="rounded-lg"><a href="{{route('user_page', ['user' => Auth::user()->id])}}" class="mr-5 hover:text-gray-900">マイページ</a></span>
            @endguest                   
        </nav>
        <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::check() && Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('アカウント') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('ログアウト') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
      </div>
    </header>
    <body>
        {{ $slot }}
        
    </body>
</html>