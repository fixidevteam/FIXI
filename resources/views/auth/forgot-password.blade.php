<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Mot de passe oublié ? Pas de problème. Indiquez simplement votre adresse e-mail et nous vous enverrons un lien de réinitialisation de mot de passe qui vous permettra d\'en choisir un nouveau.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="flex w-full justify-center rounded-[20px] bg-red-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                {{ __('obtenir le lien de réinitialisation') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
