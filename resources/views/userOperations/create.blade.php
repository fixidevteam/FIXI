<x-app-layout :subtitle="'Ajouter une operation'">
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
                            href="{{ route('dashboard') }}"
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
                                href="{{ route('voiture.index') }}"
                                class="inline-flex items-center text-sm font-medium text-gray-700   ">
                                Mes voitures
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
                                Ajouter une operation
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
                <h2 class="mt-10  text-2xl font-bold leading-9 tracking-tight text-gray-900">Ajouter une operation</h2>
                <form method="POST" action="{{ route('operation.store') }}" class="space-y-6" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <x-input-label for="categorie" :value="__('Categorie de l\'opération')" />
                        <select id="categorie" name="categorie" class="block mt-1 w-full rounded-md border-0 py-1.5 text-sm text-gray-900  shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            @foreach ($categories as $categorie)
                            <option value="{{ $categorie->id }}" @if(old('categorie')==$categorie->id) selected @endif>{{ $categorie->nom_categorie }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('categorie')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="nom" :value="__('Nom de l\'opération (Optionnel)')" />
                        <input type="hidden" id="existingOperationId" value="{{old('nom')}}">
                        <select id="operation" name="nom" class="block mt-1 w-full rounded-md border-0 py-1.5 text-sm text-gray-900  shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            <option value="">Select operation</option>
                        </select>
                        <div id="newOperationWrapper" class="hidden mt-4">
                            <x-input-label for="new_operation" :value="__('Nom de la nouvelle opération')" />
                            <x-text-input id="new_operation" name="autre_operation" type="text" class="block mt-1 w-full" value="{{ old('autre_operation') }}" />
                            <x-input-error :messages="$errors->get('autre_operation')" class="mt-2" />
                        </div>
                        <p class="mt-1 text-sm text-gray-500" id="operation_input_help">Si nous avons trouvé votre opération ici, veuillez l'ajouter dans le champ <label class="font-bold underline" for="description">'Description'</label>. </p>
                        <x-input-error :messages="$errors->get('nom')" class="mt-2" />
                    </div>
                    <!-- Input field for custom operation (hidden by default) -->

                    <div>
                        @if(old('sousOperations'))
                        <input type="hidden" id="existingSousOperations" value="{{ json_encode(old('sousOperations')) }}">
                        @else
                        <input type="hidden" id="existingSousOperations" value="[]">
                        @endif
                        <div id="sousOperationCheckboxes" style="margin-top: 10px;">

                            <!-- Checkboxes for sous operations will be appended here -->
                        </div>
                        <x-input-error :messages="$errors->get('modele')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="date_operation" :value="__('Date de l\'operation')" />
                        <x-text-input id="date_operation" class="block mt-1 w-full" type="date" name="date_operation" :value="old('date_operation')" autofocus autocomplete="date_operation" />
                        <x-input-error :messages="$errors->get('date_operation')" class="mt-2" />
                    </div>
                    
                    <div>
                        <x-input-label for="kilometrage" :value="__('Kilométrage (Optionnel)')" />
                        <x-text-input id="kilometrage" class="block mt-1 w-full" type="number" name="kilometrage" :value="old('kilometrage')" autofocus autocomplete="kilometrage"  min="0" step="1" placeholder='kilometrage du vehicule '/>
                        <x-input-error :messages="$errors->get('kilometrage')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="garage" :value="__('Garage (Optionnel)')" />
                        <select id="garage" name="garage_id" class="block mt-1 w-full rounded-md border-0 py-1.5 text-sm text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            <option value="">Select garage</option>
                            @foreach ($garages as $ville => $villeGarages)
                                <optgroup label="{{ $ville }}">
                                    @foreach ($villeGarages as $garage)
                                        <option value="{{ $garage->id }}" @if(old('garage_id') == $garage->id) selected @endif>
                                            {{ $garage->name }}{{ $garage->quartier ? ' - ' . $garage->quartier : '' }}
                                        </option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                            <option value="autre" @if(old('garage_id') == 'autre') selected @endif>Autre</option>
                        </select>
                        <p class="mt-1 text-sm text-gray-500" id="operation_input_help">Si le nom du garage n'apparaît pas dans la liste, sélectionnez "Autre" pour le saisir manuellement.</p>
                        <x-input-error :messages="$errors->get('garage_id')" class="mt-2" />
                        {{-- new garage --}}
                        <div class="mt-2">
                            <input
                                type="text"
                                id="new_garage_name"
                                name="new_garage_name"
                                value="{{ old('new_garage_name') }}"
                                class="{{ old('garage_id') == 'autre' ? '' : 'hidden' }} mt-1 w-full rounded-md border-0 py-1.5 text-sm text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                placeholder="Entrez le nom du nouveau garage" />
                            <x-input-error :messages="$errors->get('new_garage_name')" class="mt-2" />
                        </div>
                    </div>
                    <div>
                        <x-input-label for="description" :value="__('Description (Optionnel)')" />
                        <x-text-textarea id="description" class="block mt-1 w-full" name="description" autofocus autocomplete="description">
                            {{ old('description') }}
                        </x-text-textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>
                    <div class="shrink-0">
                        <img id='preview_img' class="h-16 w-16 object-cover rounded-full" src="{{session('temp_photo_operation') ? asset('storage/'.session('temp_photo_operation')) : asset('./images/defaultimage.jpg')}}" alt="Current profile photo" />
                    </div>
                    <div>
                        <x-input-label for="file_input" :value="__('Photo (Optionnel)')" />
                        <x-file-input id="file_input" onchange="loadFile(event)" class="block mt-1 w-full" type="file" name="photo" :value="old('photo')" autofocus autocomplete="photo" accept="image/jpeg,png" />
                        <!-- Hidden Input to Preserve Old Value -->
                        @if(session('temp_photo_operation'))
                        <input type="hidden" name="temp_photo_operation" value="{{ session('temp_photo_operation') }}">
                        @endif
                        <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button class="">
                            {{ __('ajouter l\'operation') }}
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
        document.getElementById('garage').addEventListener('change', function() {
            const newGarageInput = document.getElementById('new_garage_name');

            if (this.value === 'autre') {
                newGarageInput.classList.remove('hidden');
                newGarageInput.setAttribute('required', 'required'); // Add 'required' attribute
            } else {
                newGarageInput.classList.add('hidden');
                newGarageInput.removeAttribute('required'); // Remove 'required' attribute
                newGarageInput.value = ''; // Clear the input field
            }
        });

        // Ensure the "Autre" field is visible if it was selected on validation failure
        document.addEventListener('DOMContentLoaded', function() {
            const garageSelect = document.getElementById('garage');
            const newGarageInput = document.getElementById('new_garage_name');

            if (garageSelect.value === 'autre') {
                newGarageInput.classList.remove('hidden');
                newGarageInput.setAttribute('required', 'required'); // Add 'required' attribute
            } else {
                newGarageInput.classList.add('hidden');
                newGarageInput.removeAttribute('required'); // Remove 'required' attribute
            }
        });
        var loadFile = function(event) {
            var input = event.target;
            var file = input.files[0];
            var type = file.type;
            var output = document.getElementById('preview_img');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
        // select 2 :  
        $(document).ready(function() {
            // Initialize select2 for the garage field
            $('#garage').select2({
                placeholder: "Rechercher un garage",
                allowClear: true,
                width: '100%',
                dropdownAutoWidth: true,
            });

            // Show or hide the custom garage input based on the selected option
            $('#garage').on('change', function() {
                if ($(this).val() === 'autre') {
                    $('#new_garage_name').removeClass('hidden').attr('required', 'required');
                } else {
                    $('#new_garage_name').addClass('hidden').removeAttr('required');
                }
            });

            // Ensure the "Autre" field is visible if it was selected on validation failure
            if ($('#garage').val() === 'autre') {
                $('#new_garage_name').removeClass('hidden').attr('required', 'required');
            }
        });


    </script>
</x-app-layout>