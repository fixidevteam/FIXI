<x-guest-layout>
    <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Creéz votre compte</h2>
    <form method="POST" action="{{ route('mechanic.register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nom complet')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="text" name="email" :value="old('email')" autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <!-- phone -->
        <div class="mt-4">
            <x-input-label for="telephone" :value="__('Téléphone')" />
            <x-text-input id="telephone" class="block mt-1 w-full" type="text" name="telephone" :value="old('telephone')"  autocomplete="telephone" />
            <x-input-error :messages="$errors->get('telephone')" class="mt-2" />
        </div>
        <!-- garage -->
        <div class="mt-4">
            <x-input-label for="garage" :value="__('Garage')" />
            <select id="garage" name="garage_id" class="block mt-1 w-full rounded-md border-0 py-1.5 text-sm text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                <option value="">Select garage</option>
                @foreach ($garages as $garage)
                <option value="{{ $garage->id }}" @if(old('garage_id')==$garage->id) selected @endif>{{ $garage->name }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('garage_id')" class="mt-2" />
        </div>
        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Mot de passe')" />

            <x-text-input id="password" class="block mt-1 w-full"
                type="password"
                name="password"
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confimer le mot de passe')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                type="password"
                name="password_confirmation" autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="flex w-full justify-center rounded-[20px] bg-red-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                {{ __('S’inscrire') }}
            </x-primary-button>
        </div>
    </form>
    <p class="mt-10 text-center text-sm text-gray-500">
        Vous avez déjà un compte?
        <a href="{{ route('mechanic.login') }}" class="font-semibold leading-6 text-blue-600 hover:text-blue-500">{{ __('Connectez-vous') }}</a>
    </p>
</x-guest-layout>