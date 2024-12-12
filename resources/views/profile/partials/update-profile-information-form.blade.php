<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Informations du profil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Mettre à jour les informations de profil et l'adresse e-mail de votre compte.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Nom')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>
        <!-- Add Phone Field -->
        <div>
            <x-input-label for="telephone" :value="__('Téléphone')" />
            <x-text-input id="telephone" name="telephone" type="text" class="mt-1 block w-full" :value="old('telephone', $user->telephone)" required  autocomplete="telephone" />
            <x-input-error class="mt-2" :messages="$errors->get('telephone')" />
        </div>
        <!-- Add Ville Field -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
            <div>
                <x-input-label for="currentVille" :value="__('Ville Actuelle')" />
                <x-text-input id="currentVille" type="text" class="mt-1 block w-full" :value="old('ville', $user->ville)" readonly/>
            </div>
            <!-- Add Quartier Field -->
            <div>
                <x-input-label for="cuuentQuartier" :value="__('Quartier Actuelle')" />
                <x-text-input id="cuuentQuartier" type="text" class="mt-1 block w-full" :value="old('quartier', $user->quartier)" readonly/>
            </div>
        </div>
        

        <!-- Ville Field -->
        <div>
            <x-input-label for="ville" :value="__('Ville')" />
            <select id="ville" name="ville" class="block mt-1 w-full rounded-md border-0 py-1.5 text-sm text-gray-900  shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                <option value="">{{ __('Sélectionnez une Ville') }}</option>
                @foreach($villes as $ville)
                    <option value="{{ $ville->id }}" >
                        {{ $ville->ville }}
                    </option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('ville')" />
        </div>

        <!-- Quartier Field -->
        <div>
            <x-input-label for="quartier" :value="__('Quartier')" />
            <select id="quartier" name="quartier" class="block mt-1 w-full rounded-md border-0 py-1.5 text-sm text-gray-900  shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                <option value="" selected>{{ __('Sélectionnez un Quartier (Optionnel)') }}</option>
                <!-- Quartiers will be populated dynamically by JavaScript -->
                @if($user->ville)
                    @foreach($quartiers as $quartier)
                        <option value="{{ $quartier->name }}" 
                            {{ old('quartier', $user->quartier) == $quartier->name ? 'selected' : '' }}>
                            {{ $quartier->name }}
                        </option>
                    @endforeach
                @endif
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('quartier')" />
        </div>


        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('sauvegarder') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Enregistré.') }}</p>
            @endif
        </div>
    </form>
</section>

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

    // Trigger on Ville change
    villeSelect.addEventListener('change', function () {
        const villeId = this.value;
        if (villeId) {
            fetchQuartiers(villeId);
        } else {
            quartierSelect.innerHTML = '<option value="" selected>{{ __("Sélectionnez un Quartier (Optionnel)") }}</option>';
        }
    });

    // Handle pre-selected Ville and Quartier
    const preSelectedVille = "{{ $user->ville_id }}"; // Use the ville ID here
    const preSelectedQuartier = "{{ $user->quartier }}";
    if (preSelectedVille) {
        fetchQuartiers(preSelectedVille, preSelectedQuartier);
        }
    });
</script>
