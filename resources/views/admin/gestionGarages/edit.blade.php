<x-admin-app-layout>
    <div class="p-4 sm:ml-64">
        <div class="p-2 border-2 border-gray-200 border-dashed rounded-lg mt-14">
            {{-- content (slot on layouts/app.blade.php)--}}
            <nav
                class="flex px-5 py-3 text-gray-700 bg-white overflow-hidden shadow-sm sm:rounded-lg "
                aria-label="Breadcrumb">
                <ol
                    class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                    <li class="inline-flex items-center">
                        <a
                            href="{{ route('admin.dashboard') }}"
                            class="inline-flex items-center text-sm font-medium text-gray-700">
                            Accueil
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg
                                class="rtl:rotate-180 block w-3 h-3 mx-1 text-gray-400"
                                aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 6 10">
                                <path
                                    stroke="currentColor"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="m1 9 4-4-4-4" />
                            </svg>
                            <a
                                href="{{ route('admin.gestionGarages.index') }}"
                                class="inline-flex items-center text-sm font-medium text-gray-700   ">
                                Gestion des garages
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg
                                class="rtl:rotate-180 block w-3 h-3 mx-1 text-gray-400"
                                aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 6 10">
                                <path
                                    stroke="currentColor"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="m1 9 4-4-4-4" />
                            </svg>
                            <a
                                href=""
                                class="inline-flex items-center text-sm font-medium text-gray-700   ">
                                Modifier garage
                            </a>
                        </div>
                    </li>
                </ol>
            </nav>

        </div>
        {{-- content --}}
        <div class="p-2 border-2 border-gray-200 border-dashed rounded-lg mt-4">
            {{-- content (slot on layouts/app.blade.php)--}}
            <div class=" px-5 py-3 text-gray-700 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <h2 class="mt-10  text-2xl font-bold leading-9 tracking-tight text-gray-900">Modifier Garage</h2>
                <form method="POST" action="{{ route('admin.gestionGarages.update',$garage->id) }}" class="space-y-6" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div>
                        <x-input-label for="name" :value="__('Garage')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name') ?? $garage->name" autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="ref" :value="__('Ref')" />
                        <x-text-input id="ref" class="block mt-1 w-full" type="text" name="ref" :value="old('ref') ?? $garage->ref" autofocus autocomplete="ref" />
                        <x-input-error :messages="$errors->get('ref')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="localisation" :value="__('Localisation')" />
                        <x-text-input id="localisation" class="block mt-1 w-full" type="text" name="localisation" :value="old('localisation') ?? $garage->localisation" autofocus autocomplete="localisation" />
                        <x-input-error :messages="$errors->get('localisation')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="ville" :value="__('Ville')" />
                        <select id="ville" 
                                class="block mt-1 w-full rounded-md border-0 py-1.5 text-sm text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" 
                                name="ville">
                            <option value="" {{ old('ville', $garage->ville) ? '' : 'selected' }}>
                                {{ __('Sélectionnez une Ville') }}
                            </option>
                            @foreach($villes as $ville)
                                <option value="{{ $ville->id }}" {{ old('ville', $garage->ville) == $ville->ville ? 'selected' : '' }}>
                                    {{ $ville->ville }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('ville')" class="mt-2" />
                    </div>
                    
                    <div>
                        <x-input-label for="quartier" :value="__('Quartier')" />
                        <select id="quartier" 
                                class="block mt-1 w-full rounded-md border-0 py-1.5 text-sm text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" 
                                name="quartier">
                            <option value="" selected>
                                {{ __('Sélectionnez un Quartier (Optionnel)') }}
                            </option>
                            @if(old('ville', $garage->ville))
                                @foreach($quartiers as $quartier)
                                    <option value="{{ $quartier->quartier }}" {{ old('quartier', $garage->quartier) == $quartier->quartier ? 'selected' : '' }}>
                                        {{ $quartier->quartier }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        <x-input-error :messages="$errors->get('quartier')" class="mt-2" />
                    </div>
                    
                    <div>
                        <x-input-label for="virtualGarage" :value="__('Garage virtual')" />
                        <x-text-input id="virtualGarage" class="block mt-1 w-full" type="text" name="virtualGarage" :value="old('virtualGarage')?? $garage->virtualGarage" autofocus autocomplete="virtualGarage" />
                        <x-input-error :messages="$errors->get('virtualGarage')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="services" :value="__('Domaines')" />
                        <div class="mt-2 space-y-2">
                            <label class="flex items-center">
                                <input type="checkbox" 
                                    name="services[]" 
                                    value="Carrosserie" 
                                    class="w-4 h-4 text-black border-gray-300 rounded focus:ring-blue-500 focus:ring-2"
                                    {{ in_array('Carrosserie', old('services', $garage->services ?? [])) ? 'checked' : '' }} />
                                <span class="ml-2 text-sm text-gray-600">{{ __('Carrosserie') }}</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" 
                                    name="services[]" 
                                    value="Lavage" 
                                    class="w-4 h-4 text-black border-gray-300 rounded focus:ring-blue-500 focus:ring-2"
                                    {{ in_array('Lavage', old('services', $garage->services ?? [])) ? 'checked' : '' }} />
                                <span class="ml-2 text-sm text-gray-600">{{ __('Lavage') }}</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" 
                                    name="services[]" 
                                    value="Mécanique" 
                                    class="w-4 h-4 text-black border-gray-300 rounded focus:ring-blue-500 focus:ring-2"
                                    {{ in_array('Mécanique', old('services', $garage->services ?? [])) ? 'checked' : '' }} />
                                <span class="ml-2 text-sm text-gray-600">{{ __('Mécanique') }}</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" 
                                    name="services[]" 
                                    value="Pneumatique" 
                                    class="w-4 h-4 text-black border-gray-300 rounded focus:ring-blue-500 focus:ring-2"
                                    {{ in_array('Pneumatique', old('services', $garage->services ?? [])) ? 'checked' : '' }} />
                                <span class="ml-2 text-sm text-gray-600">{{ __('Pneumatique') }}</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" 
                                    name="services[]" 
                                    value="Dépannage" 
                                    class="w-4 h-4 text-black border-gray-300 rounded focus:ring-blue-500 focus:ring-2"
                                    {{ in_array('Dépannage', old('services', $garage->services ?? [])) ? 'checked' : '' }} />
                                <span class="ml-2 text-sm text-gray-600">{{ __('Dépannage') }}</span>
                            </label>
                        </div>
                    </div>                    
                    <div>
                        <x-input-label for="file_input" :value="__('Photo')" />
                        <x-file-input id="file_input" class="block mt-1 w-full" type="file" name="photo" :value="old('photo')" autofocus autocomplete="photo" accept="image/*" />
                        <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button class="flex justify-center rounded-[20px] bg-red-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-gray-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                            {{ __('Modifier le garage') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>

        </div>
        {{-- contet close colse --}}
        {{-- footer --}}
        <div class="p-2 border-2 border-gray-200 border-dashed rounded-lg mt-4">
            @include('layouts.footer')
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
    const villeSelect = document.getElementById('ville');
    const quartierSelect = document.getElementById('quartier');

    function fetchQuartiers(villeId, preSelectedQuartier = null) {
        quartierSelect.innerHTML = '<option value="" selected>{{ __("Chargement...") }}</option>';

        fetch(`/quartiers?ville_id=${villeId}`)
            .then(response => response.json())
            .then(data => {
                quartierSelect.innerHTML = '<option value="" selected>{{ __("Sélectionnez un quartier (Optionnel)") }}</option>';
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

    // Fetch quartiers when a new ville is selected
    villeSelect.addEventListener('change', function () {
        const villeId = this.value;
        if (villeId) {
            fetchQuartiers(villeId);
        } else {
            quartierSelect.innerHTML = '<option value="" selected>{{ __("Sélectionnez un Quartier (Optionnel)") }}</option>';
        }
    });

    // Preload quartiers if a ville is pre-selected
    const preSelectedVille = "{{ old('ville', $garage->ville) }}";
    const preSelectedQuartier = "{{ old('quartier', $garage->quartier) }}";
    if (preSelectedVille) {
        fetchQuartiers(preSelectedVille, preSelectedQuartier);
        }
    });
    </script>
</x-admin-app-layout>