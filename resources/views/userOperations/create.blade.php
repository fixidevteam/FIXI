<x-app-layout>
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
                        <!-- <x-text-input id="categorie" class="block mt-1 w-full" type="text" name="categorie" :value="old('categorie')" autofocus autocomplete="categorie" /> -->
                        <select id="categorie" name="categorie" class="block mt-1 w-full rounded-md border-0 block py-1.5 w-full text-sm text-gray-900  shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            <option value="">Select Categorie</option>
                            @foreach ($categories as $categorie)
                            <option value="{{ $categorie->id }}"@if(old('categorie') == $categorie->id) selected @endif>{{ $categorie->nom_categorie }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('categorie')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="nom" :value="__('Nom de l\'opération')" />
                        <select id="operation" name="nom" class="block mt-1 w-full rounded-md border-0 block py-1.5 w-full text-sm text-gray-900  shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" disabled>
                            <option value="">Select Operation</option>
                        </select>

                        <x-input-error :messages="$errors->get('nom')" class="mt-2" />
                    </div>
                    <div>

                        <div id="sousOperationCheckboxes" style="margin-top: 10px;">

                            <!-- Checkboxes for sous operations will be appended here -->
                        </div>
                        <x-input-error :messages="$errors->get('modele')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="date_operation" :value="__('Date de l\'Operation')" />
                        <x-text-input id="date_operation" class="block mt-1 w-full" type="date" name="date_operation" :value="old('date_operation')" autofocus autocomplete="date_operation" />
                        <x-input-error :messages="$errors->get('date_operation')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="garage" :value="__('Garage')" />
                        <x-text-input id="garage" class="block mt-1 w-full" type="date" name="garage" :value="old('garage')" autofocus autocomplete="garage" />
                        <x-input-error :messages="$errors->get('garage')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="description" :value="__('Description')" />
                        <x-text-textarea id="description" class="block mt-1 w-full" name="description" :value="old('description')" autofocus autocomplete="description" />
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="file_input" :value="__('Photo')" />
                        <x-file-input id="file_input" class="block mt-1 w-full" type="file" name="photo" :value="old('photo')" autofocus autocomplete="photo" accept="image/*" />
                        <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button class="flex justify-center rounded-[20px] bg-red-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                            {{ __('ajouter operation') }}
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
</x-app-layout>