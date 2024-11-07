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
                                href="{{ route('voiture.create') }}"
                                class="inline-flex items-center text-sm font-medium text-gray-700   ">
                                Modifer Voiture
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
            <h2 class="mt-10  text-2xl font-bold leading-9 tracking-tight text-gray-900">Modifier Voiture</h2>
            <form method="POST" action="{{route('voiture.update',$voiture->id)}}" class="space-y-6" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div>
                    <x-input-label for="numero_immatriculation" :value="__('Numero d\'immatriculation')" />
                    <x-text-input id="numero_immatriculation" class="block mt-1 w-full" type="text" name="numero_immatriculation" :value="old('numero_immatriculation') ?? $voiture->numero_immatriculation" autofocus autocomplete="numero_immatriculation" />
                    <x-input-error :messages="$errors->get('numero_immatriculation')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="marque" :value="__('Marque')" />
                    <x-text-input id="marque" class="block mt-1 w-full" type="text" name="marque" :value="old('marque')  ?? $voiture->marque" autofocus autocomplete="marque" />
                    <x-input-error :messages="$errors->get('marque')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="modele" :value="__('Modele')" />
                    <x-text-input id="modele" class="block mt-1 w-full" type="text" name="modele" :value="old('modele') ?? $voiture->modele" autofocus autocomplete="modele" />
                    <x-input-error :messages="$errors->get('modele')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="file_input" :value="__('Photo')" />
                    <x-file-input id="file_input" class="block mt-1 w-full" type="file" name="photo" :value="old('photo') ?? $voiture->photo" autofocus autocomplete="photo" accept="image/*" />
                    <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="date_de_première_mise_en_circulation" :value="__('Date de première mise en circulation')" />
                    <x-text-input id="date_de_première_mise_en_circulation" class="block mt-1 w-full" type="date" name="date_de_première_mise_en_circulation" :value="old('date_de_première_mise_en_circulation')  ?? $voiture->date_de_première_mise_en_circulation" autofocus autocomplete="date_de_première_mise_en_circulation" />
                    <x-input-error :messages="$errors->get('date_de_première_mise_en_circulation')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="date_achat" :value="__('Date d\'achat')" />
                    <x-text-input id="date_achat" class="block mt-1 w-full" type="date" name="date_achat" :value="old('date_achat') ?? $voiture->date_achat" autofocus autocomplete="date_achat" />
                    <x-input-error :messages="$errors->get('date_achat')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="date_de_dédouanement" :value="__('Date de dédouanement')" />
                    <x-text-input id="date_de_dédouanement" class="block mt-1 w-full" type="date" name="date_de_dédouanement" :value="old('date_de_dédouanement') ?? $voiture->date_de_dédouanement" autofocus autocomplete="date_de_dédouanement" />
                    <x-input-error :messages="$errors->get('date_de_dédouanement')" class="mt-2" />
                </div>



                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="flex justify-center rounded-[20px] bg-red-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                        {{ __('Modifier voiture') }}
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