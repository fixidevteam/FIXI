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
                            href="{{ route('paiperPersonnel.index') }}"
                            class="inline-flex items-center text-sm font-medium text-gray-700   ">
                            Mes papier personnels
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
                            Modifier papier personnels
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
        <h2 class="mt-10  text-2xl font-bold leading-9 tracking-tight text-gray-900">Modifier un papier personnel</h2>
        <form method="POST" action="{{ route('paiperPersonnel.update',$papier->id) }}" class="space-y-6" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div>
                <x-input-label for="type" :value="__('Type')" />
                <!-- Select Dropdown -->
                <select id="type" name="type" class="block mt-1 w-full rounded-md border-0 py-1.5 text-sm text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    <option value="" disabled selected>{{ __('Choisissez un type') }}</option>
                    @foreach($types as $type)
                        <option value="{{ $type->type }}" {{ $type->type == $papier->type ? 'selected' : '' }}>
                            {{ $type->type }}
                        </option>
                    @endforeach
                </select>
            
                <x-input-error :messages="$errors->get('type')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="date_debut" :value="__('Date debut')" />
                <x-text-input id="date_debut" class="block mt-1 w-full" type="date" name="date_debut" :value="old('date_debut') ?? $papier->date_debut" autofocus autocomplete="date_debut" />
                <x-input-error :messages="$errors->get('date_debut')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="date_fin" :value="__('Date de fin')" />
                <x-text-input id="date_fin" class="block mt-1 w-full" type="date" name="date_fin" :value="old('date_fin')  ?? $papier->date_fin" autofocus autocomplete="date_fin" />
                <x-input-error :messages="$errors->get('date_fin')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="note" :value="__('Note')" />
                <x-text-textarea id="note" class="block mt-1 w-full" name="note" autofocus autocomplete="note">
                {{ old('note', $papier->note) }}
                </x-text-textarea>
                <x-input-error :messages="$errors->get('note')" class="mt-2" />
            </div>
            <div>
            <x-input-label for="file_input" :value="__('Photo')" />
            <x-file-input id="file_input" class="block mt-1 w-full" type="file" name="photo" :value="old('photo')  ?? $papier->photo" autofocus autocomplete="photo" />
            <x-input-error :messages="$errors->get('photo')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="">
                    {{ __('Modifier le papier personnel') }}
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