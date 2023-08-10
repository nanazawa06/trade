<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('ユーザ名')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('メールアドレス')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('パスワード')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('もう一度パスワードを入力')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div>
                    <select name="area_id" class="p-3 rounded border border-gray-300">
                        <option value="">所在地</option>
                        @foreach ($areas as $prefecture)
                            <option class="p-3 rounded border border-gray-300" value="{{ $prefecture->id }}">{{ $prefecture->prefecture }}</option>
                        @endforeach
                    </select>
        </div>
        
        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('すでにアカウントを持っている場合') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('送信する') }}
            </x-primary-button>
        </div>
        
        <div class="flex justify-center items-center">
          <span class="w-full border border-black"></span>
          <span class="px-4">もしくは</span>
          <span class="w-full border border-black"></span>
        </div>
        <div class="mb-3">
            <a href='auth/google' class="flex flex-wrap justify-center w-full border border-gray-300 hover:border-gray-500 px-2 py-2 rounded-md">
              <img class="w-5 mr-2" src="https://lh3.googleusercontent.com/COxitqgJr1sJnIDe8-jiKhxDx1FrYbtRHKJ9z_hELisAlapwE9LUPh6fcXIfb5vwpbMl4xl9H9TRFPc5NOO8Sb3VSgIBrfRYvW6cUA">
              Googleで登録
            </a>
        </div>
    </form>
</x-guest-layout>
