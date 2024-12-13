<x-guest-layout>
    <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Creéz votre compte</h2>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nom complet')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"  autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="text" name="email" :value="old('email')"  autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <!-- Ville -->
        <div class="mt-4">
        <x-input-label for="ville" :value="__('Ville')" />
            <select id="ville" class="block mt-1 w-full rounded-md border-0 py-1.5 text-sm text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" name="ville">
                <option value="" disabled {{ old('ville') ? '' : 'selected' }}>{{ __('Sélectionnez une Ville') }}</option>
                @foreach($villes as $ville)
                    <option value="{{ $ville->id }}" {{ old('ville') == $ville->id ? 'selected' : '' }}>
                        {{ $ville->ville }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Quartier -->
        <div class="mt-4">
        <x-input-label for="quartier" :value="__('Quartier')" />
            <select id="quartier" class="block mt-1 w-full rounded-md border-0 py-1.5 text-sm text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" name="quartier">
                <option value="" selected>{{ __('Sélectionnez un Quartier (Optionnel)') }}</option>
                @if(old('ville'))
                    @foreach($quartiers as $quartier)
                        <option value="{{ $quartier->quartier }}" {{ old('quartier') == $quartier->quartier ? 'selected' : '' }}>
                            {{ $quartier->quartier }}
                        </option>
                    @endforeach
                @endif
            </select>
        </div>


        <!-- phone -->
        <div class="mt-4">
            <x-input-label for="telephone" :value="__('Téléphone')" />
            <x-text-input id="telephone" class="block mt-1 w-full" type="text" name="telephone" :value="old('telephone')"  autocomplete="telephone" />
            <x-input-error :messages="$errors->get('telephone')" class="mt-2" />
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
                            name="password_confirmation"  autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="flex w-full justify-center rounded-[20px] bg-red-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                {{ __('S\'inscrire') }}
            </x-primary-button>
        </div>
    </form>
    {{-- login with google --}}
    <div class="my-10">
        <span class="relative flex justify-center">
            <div
              class="absolute inset-x-0 top-1/2 h-px -translate-y-1/2 bg-transparent bg-gradient-to-r from-transparent via-gray-500 to-transparent opacity-75"
            ></div>
          
            <span class="relative z-10 bg-white text-xs px-6">Ou</span>
          </span>
          <a href="/auth/google/redirect">
            <button class="w-full mt-1 px-4 py-2 border flex justify-center items-center  gap-2 border-slate-200 rounded-lg text-slate-700 hover:border-slate-400 hover:text-slate-900  hover:shadow transition duration-150">
                <svg class="w-6 h-6" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5.57338 0.52637C3.97473 1.08096 2.59606 2.13358 1.63987 3.52962C0.683675 4.92567 0.200366 6.59155 0.26093 8.28258C0.321493 9.9736 0.922737 11.6006 1.97635 12.9247C3.02996 14.2488 4.4804 15.2001 6.11463 15.6389C7.43953 15.9807 8.82764 15.9958 10.1596 15.6826C11.3663 15.4116 12.4819 14.8318 13.3971 14.0001C14.3497 13.1081 15.0412 11.9732 15.3971 10.7176C15.784 9.35221 15.8529 7.91629 15.5984 6.52012H8.15838V9.60637H12.4671C12.381 10.0986 12.1965 10.5684 11.9246 10.9877C11.6527 11.4069 11.2989 11.767 10.8846 12.0464C10.3585 12.3944 9.76537 12.6286 9.14338 12.7339C8.51956 12.8499 7.8797 12.8499 7.25588 12.7339C6.62361 12.6031 6.0255 12.3422 5.49963 11.9676C4.65481 11.3696 4.02047 10.52 3.68713 9.54012C3.34815 8.54186 3.34815 7.45963 3.68713 6.46137C3.92441 5.76164 4.31667 5.12454 4.83463 4.59762C5.42737 3.98355 6.17779 3.54462 7.00357 3.32896C7.82935 3.11331 8.69858 3.12928 9.51588 3.37512C10.1543 3.57111 10.7382 3.91354 11.2209 4.37512C11.7067 3.89179 12.1917 3.4072 12.6759 2.92137C12.9259 2.66012 13.1984 2.41137 13.4446 2.14387C12.7078 1.45822 11.843 0.924691 10.8996 0.57387C9.18176 -0.049893 7.3021 -0.066656 5.57338 0.52637Z" fill="white"/>
                    <path d="M5.57348 0.526245C7.30206 -0.067184 9.18171 -0.0508623 10.8997 0.572495C11.8432 0.925699 12.7077 1.46179 13.4435 2.14999C13.1935 2.41749 12.9297 2.66749 12.6747 2.92749C12.1897 3.41166 11.7051 3.89416 11.221 4.37499C10.7383 3.91342 10.1544 3.57098 9.51598 3.37499C8.69895 3.1283 7.82975 3.1114 7.00375 3.32617C6.17775 3.54094 5.42687 3.97907 4.83348 4.59249C4.31552 5.11941 3.92326 5.75652 3.68598 6.45624L1.09473 4.44999C2.02224 2.6107 3.62816 1.20377 5.57348 0.526245Z" fill="#E33629"/>
                    <path d="M0.407926 6.43745C0.547203 5.74719 0.778431 5.07873 1.09543 4.44995L3.68668 6.4612C3.34769 7.45946 3.34769 8.54169 3.68668 9.53995C2.82334 10.2066 1.95959 10.8766 1.09543 11.55C0.301864 9.97035 0.0598419 8.17058 0.407926 6.43745Z" fill="#F8BD00"/>
                    <path d="M8.15876 6.5188H15.5988C15.8533 7.91496 15.7844 9.35088 15.3975 10.7163C15.0416 11.9719 14.3501 13.1067 13.3975 13.9988C12.5613 13.3463 11.7213 12.6988 10.885 12.0463C11.2996 11.7666 11.6535 11.4062 11.9254 10.9865C12.1973 10.5668 12.3817 10.0965 12.4675 9.6038H8.15876C8.15751 8.5763 8.15876 7.54755 8.15876 6.5188Z" fill="#587DBD"/>
                    <path d="M1.09375 11.55C1.95792 10.8834 2.82167 10.2134 3.685 9.54004C4.01901 10.5203 4.65426 11.3699 5.5 11.9675C6.02751 12.3404 6.62691 12.5992 7.26 12.7275C7.88382 12.8435 8.52368 12.8435 9.1475 12.7275C9.76949 12.6223 10.3626 12.3881 10.8888 12.04C11.725 12.6925 12.565 13.34 13.4012 13.9925C12.4861 14.8247 11.3705 15.4049 10.1637 15.6763C8.83176 15.9894 7.44365 15.9744 6.11875 15.6325C5.07088 15.3528 4.09209 14.8595 3.24375 14.1838C2.34583 13.4709 1.61244 12.5725 1.09375 11.55Z" fill="#319F43"/>
                    </svg>                
                <span>continuer avec google</span>
            </button>
        </a>
    </div>
    <p class="text-center text-sm text-gray-500">
        Vous avez déjà un compte?
        <a href="{{ route('login') }}" class="font-semibold leading-6 text-blue-600 hover:text-blue-500">{{ __('Connectez-vous') }}</a>
    </p>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
        const villeSelect = document.getElementById('ville');
        const quartierSelect = document.getElementById('quartier');

        function fetchQuartiers(villeId, preSelectedQuartier = null) {
            quartierSelect.innerHTML = '<option value="" selected>{{ __("Chargement...") }}</option>';

            fetch(`/quartiers?ville_id=${villeId}`)
                .then(response => response.json())
                .then(data => {
                    quartierSelect.innerHTML = '<option value="" selected>{{ __("Sélectionnez un Quartier (Optionnel)") }}</option>';
                    data.forEach(quartier => {
                        const selected = preSelectedQuartier === quartier.quartier ? 'selected' : '';
                        quartierSelect.innerHTML += `<option value="${quartier.quartier}" ${selected}>${quartier.quartier}</option>`;
                    });
                })
                .catch(error => {
                    console.error('Error fetching quartiers:', error);
                    quartierSelect.innerHTML = '<option value="" disabled>{{ __("Erreur de chargement") }}</option>';
                });
        }

        villeSelect.addEventListener('change', function () {
            const villeId = this.value;
            if (villeId) {
                fetchQuartiers(villeId);
            } else {
                quartierSelect.innerHTML = '<option value="" selected>{{ __("Sélectionnez un Quartier (Optionnel)") }}</option>';
            }
        });

        const preSelectedVille = "{{ old('ville') }}";
        const preSelectedQuartier = "{{ old('quartier') }}";
        if (preSelectedVille) {
            fetchQuartiers(preSelectedVille, preSelectedQuartier);
        }
    });



    </script>
    
</x-guest-layout>
