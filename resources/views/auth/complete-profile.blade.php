<x-guest-layout>
    <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Complete votre compte</h2>
    <form class="space-y-6" method="POST" action="{{ route('complete-profile.post') }}">
        @csrf
        <div>
            <x-input-label for="telephone" :value="__('Téléphone')" />
            <div class="mt-2">
                <x-text-input id="telephone" class="block w-full" type="text" name="telephone" :value="old('telephone')" autofocus autocomplete="telephone" placeholder="+2126" />
            </div>
            <x-input-error :messages="$errors->get('telephone')" class="mt-2" />
        </div>
       <!-- Ville -->
       <div class="mt-4">
        <x-input-label for="ville" :value="__('Ville')" />
            <select id="ville" class="block mt-1 w-full rounded-md border-0 py-1.5 text-sm text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" name="ville">
                <option value="" disabled {{ old('ville') ? '' : 'selected' }}>{{ __('Sélectionnez une Ville') }}</option>
                @foreach($villes as $ville)
                    <option value="{{ $ville->ville }}" {{ old('ville') == $ville->ville ? 'selected' : '' }}>
                        {{ $ville->ville }}
                    </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('ville')" class="mt-2" />
        </div>    
        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="flex w-full justify-center rounded-[20px] bg-red-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                {{ __('Complete Profile') }}
            </x-primary-button>
        </div>
    </form>    
</x-guest-layout>
