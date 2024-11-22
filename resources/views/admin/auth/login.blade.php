<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Connectez-vous à votre compte</h2>
    <form class="space-y-6" method="POST" action="{{ route('admin.login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <div class="mt-2">
                <x-text-input id="email" class="block w-full" type="email" name="email" :value="old('email')"  autofocus autocomplete="username" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <div class="flex items-center justify-between">
                <x-input-label for="password" :value="__('Mot de passe')" />
                <div class="text-sm">
                    @if (Route::has('password.request'))
                    <a class="underline text-sm font-semibold text-blue-600 hover:text-blue-500" href="{{ route('password.request') }}">
                        {{ __('Mot de passe oublié ?') }}
                    </a>
                @endif
                </div>
            </div>
            <div class="mt-2">
                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                 autocomplete="current-password" />
            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-red-600 shadow-sm focus:ring-red-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Rester connecté') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="flex w-full justify-center rounded-[20px] bg-red-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                {{ __('Se connecter') }}
            </x-primary-button>
        </div>
    </form>
    <p class="mt-10 text-center text-sm text-gray-500">
        Vous n'avez pas de compte?
        <a href="{{ route('admin.register') }}" class="font-semibold leading-6 text-blue-600 hover:text-blue-500">{{ __('Inscrivez-vous') }}</a>
      </p>
</x-guest-layout>
