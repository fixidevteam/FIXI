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
                                href="{{ route('admin.gestionOperation.index') }}"
                                class="inline-flex items-center text-sm font-medium text-gray-700   ">
                                Gestion des operations
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
                                Modifier une sous operation
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
                <h2 class="mt-10  text-2xl font-bold leading-9 tracking-tight text-gray-900">Modifier une sous operation </h2>
                <form method="POST" action="{{ route('admin.gestionSousOperation.update',$sous->id) }}" class="space-y-6">
                    @csrf
                    @method('PUT')
                    <div>
                        <x-input-label for="operation" :value="__('Categorie')" />
                        <select id="operation" name="nom_operation_id" class="block mt-1 w-full rounded-md border-0 py-1.5 text-sm text-gray-900  shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            @foreach ($operations as $operation)
                            <option value="{{ $operation->id }}" @if(old('nom_operation_id')==$operation->id || $sous->nom_operation_id == $operation->id ) selected @endif >{{ $operation->nom_operation }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('operation')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="nom_sous_operation" :value="__('Sous Operation')" />
                        <x-text-input id="nom_sous_operation" class="block mt-1 w-full" type="text" name="nom_sous_operation" :value="old('nom_sous_operation') ?? $sous->nom_sous_operation" autofocus autocomplete="nom_sous_operation" />
                        <x-input-error :messages="$errors->get('nom_sous_operation')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button class="flex justify-center rounded-[20px] bg-red-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                            {{ __('Modifier sous operation') }}
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
</x-admin-app-layout>