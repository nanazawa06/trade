<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>GoodsTrade</title>
        <!-- Fonts -->
        @viteReactRefresh
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <header class="border-b border-slate-200">
      
      <div class="px-4 py-3 sm:py-5 mx-auto bg-gray-300 sm:max-w-full md:px-16 lg:px-8">
          <div class="relative flex items-center justify-between">
            <a href="/" aria-label="Company" title="Company" class="inline-flex items-center">
              <svg class="w-8 text-deep-purple-accent-400" viewBox="0 0 24 24" stroke-linejoin="round" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" stroke="currentColor" fill="none">
                <rect x="3" y="1" width="7" height="12"></rect>
                <rect x="3" y="17" width="7" height="6"></rect>
                <rect x="14" y="1" width="7" height="6"></rect>
                <rect x="14" y="11" width="7" height="12"></rect>
              </svg>
              <span class="ml-2 text-xl font-bold tracking-wide text-gray-800 ">GoodsTrade</span>
            </a>
            <div>
                <ul class="flex items-center hidden space-x-8 sm:flex sm:space-x-4">
                    @guest
                      <li><a href="/register" aria-label="会員登録" title="会員登録" class="font-medium tracking-wide text-gray-700  hover:underline">会員登録</a></li>
                      <li><a href="/login" aria-label="ログイン" title="ログイン" class="font-medium tracking-wide text-gray-700 hover:underline">ログイン</a></li>
                    @else
                      <li><a href="{{ route('user_page', ['user' => Auth::id()]) }}" aria-label="マイページ" title="マイページ" class="font-medium tracking-wide text-gray-700 hover:underline">マイページ</a></li>
                    @endguest
                      <li>
                    <a
                      href="/posts/create"
                      class="inline-flex items-center justify-center h-10 px-4 font-medium tracking-wide text-white transition duration-200 rounded shadow-md bg-purple-500  focus:shadow-outline hover:underline hover:bg-purple-700"
                      aria-label="Sign up"
                      title="Sign up"
                    >
                      出品
                    </a>
                  </li>
                </ul>
                <div class="inline-flex items-center justify-center sm:hidden">
                    <a
                      href="/posts/create"
                      class="inline-flex items-center justify-center h-8 px-3 font-xs tracking-wide text-white rounded shadow-md bg-purple-500 hover:underline hover:bg-purple-700"
                    >
                      出品
                    </a>
                    <!-- Mobile menu -->
                    <div class="sm:hidden">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                              <button aria-label="Open Menu" title="Open Menu" class="p-2 -mr-1 transition duration-200 rounded focus:outline-none focus:shadow-outline hover:bg-deep-purple-50 focus:bg-deep-purple-50">
                                <svg class="w-5 text-gray-600" viewBox="0 0 24 24">
                                  <path fill="currentColor" d="M23,13H1c-0.6,0-1-0.4-1-1s0.4-1,1-1h22c0.6,0,1,0.4,1,1S23.6,13,23,13z"></path>
                                  <path fill="currentColor" d="M23,6H1C0.4,6,0,5.6,0,5s0.4-1,1-1h22c0.6,0,1,0.4,1,1S23.6,6,23,6z"></path>
                                  <path fill="currentColor" d="M23,20H1c-0.6,0-1-0.4-1-1s0.4-1,1-1h22c0.6,0,1,0.4,1,1S23.6,20,23,20z"></path>
                                </svg>
                              </button>
                            </x-slot>
                            
                            <x-slot name="content">
                                @if ( Auth::check() )
                                <x-dropdown-link href="{{ route('user_page', ['user' => Auth::id()]) }}">
                                    {{ __('マイページ') }}
                                </x-dropdown-link>
                                
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('アカウント') }}
                                </x-dropdown-link>
                                @endif
                                <!-- Authentication -->
                                @guest
                                    <x-dropdown-link :href="route('login')">
                                        {{ __('ログイン') }}
                                    </x-dropdown-link>
                                    <x-dropdown-link :href="route('register')">
                                        {{ __('会員登録') }}
                                    </x-dropdown-link>
                                @else
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-dropdown-link :href="route('logout')"
                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                            {{ __('ログアウト') }}
                                        </x-dropdown-link>
                                    </form>
                                @endguest
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>
            </div>
          </div>
        </div>    
        @if (isset($header))
          <div class="w-full h-8">
            <h1 class="text-xl sm:text-3xl font-bold ml-11 mt-3 sm:mt-5">{{ $header }}</h1>
          </div>
        @endif
    </header>
    <body>
        {{ $slot }}
        
    </body>
</html>