<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>GoodsTrade</title>
        <!-- Fonts -->
        <link href="/css/layout.css" rel="stylesheet">
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <header class="header">
        <div class="appicon"><a href=""><img src=""></a></div>
        <div class="service-name">GoodsTrade</div>
        <div class="serch">
            <form>
                @csrf
                <div>
                    <input type="search" name="want" value="{{request('search')}}" class="searchForWant" placeholder="欲しいものを入力してください" aria-lavel="検索">
                </div>
                <div>
                    <input type="search" name="give" value="{{request('search')}}" class="searchForGive" placeholder="譲るものを入力してください" aria-lavel="検索">
                </div>
                <div>
                    <input type="submit" value="検索" class="searchBtn">
                </div>
            </form>
        </div>
        <div class="">
                <span class=""><button class="btnForPost">出品</button></span>
            @guest
                <span class="toRegister"><a href="{{ route('register') }}">会員登録</a></span>
                <span class="toLogin"><a href="{{ route('login') }}">ログイン</a></span>
            @else
                <span class="toMypage"><a href="{{ route('mypage') }}">会員登録</a></span>
            @endguest                
        </div>
    </header>
    <body>
        
    </body>
</html>