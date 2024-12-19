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
                                href="{{ route('garages.index') }}"
                                class="inline-flex items-center text-sm font-medium text-gray-700">
                                Listing des garages
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
                <div class="flex justify-between items-center my-6">
                    <h2 class="text-2xl font-bold leading-9 tracking-tight text-gray-900">Liste des garages</h2>
                </div>
                <form method="GET" action="{{ route('garages.index') }}" class="mb-4">
                    <div class="flex items-center space-x-2">
                        <!-- Select Dropdown for Ville -->
                        <select 
                            name="ville" 
                            class="block mt-1 w-full rounded-md border-0 py-1.5 text-sm text-gray-900  shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                        >
                            <option value="">Sélectionner une ville</option>
                            @foreach($villes as $ville)
                                <option value="{{ $ville->ville }}" {{ request('ville') == $ville->ville ? 'selected' : '' }}>
                                    {{ $ville->ville }} ({{ $ville->garages_count }})
                                </option>
                            @endforeach
                        </select>
                        <!-- Search Button -->
                        <button type="submit" class="p-2.5 ms-2 bg-gray-700 text-white rounded-lg hover:bg-gray-800">
                            <svg class="w-4 h-4" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M11.5 2.75C6.66751 2.75 2.75 6.66751 2.75 11.5C2.75 16.3325 6.66751 20.25 11.5 20.25C16.3325 20.25 20.25 16.3325 20.25 11.5C20.25 6.66751 16.3325 2.75 11.5 2.75ZM1.25 11.5C1.25 5.83908 5.83908 1.25 11.5 1.25C17.1609 1.25 21.75 5.83908 21.75 11.5C21.75 14.0605 20.8111 16.4017 19.2589 18.1982L22.5303 21.4697C22.8232 21.7626 22.8232 22.2374 22.5303 22.5303C22.2374 22.8232 21.7626 22.8232 21.4697 22.5303L18.1982 19.2589C16.4017 20.8111 14.0605 21.75 11.5 21.75C5.83908 21.75 1.25 17.1609 1.25 11.5Z" fill="currentColor"/>
                            </svg>                            
                            <span class="sr-only">Search</span>
                        </button>
                        {{-- Reset Button --}}
                        <a href="{{ route('garages.index') }}" class="hidden md:block p-2.5 ms-2 bg-gray-200 text-gray-900 rounded-lg hover:bg-gray-300">
                            Réinitialiser
                        </a>
                        <a href="{{ route('garages.index') }}" class="md:hidden p-2.5 ms-2 bg-gray-700 text-white rounded-lg hover:bg-gray-800 font-semibold">
                            <svg class="w-4 h-4" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M11.5 2.75C6.66751 2.75 2.75 6.66751 2.75 11.5C2.75 16.3325 6.66751 20.25 11.5 20.25C16.3325 20.25 20.25 16.3325 20.25 11.5C20.25 6.66751 16.3325 2.75 11.5 2.75ZM1.25 11.5C1.25 5.83908 5.83908 1.25 11.5 1.25C17.1609 1.25 21.75 5.83908 21.75 11.5C21.75 14.0605 20.8111 16.4017 19.2589 18.1982L22.5303 21.4697C22.8232 21.7626 22.8232 22.2374 22.5303 22.5303C22.2374 22.8232 21.7626 22.8232 21.4697 22.5303L18.1982 19.2589C16.4017 20.8111 14.0605 21.75 11.5 21.75C5.83908 21.75 1.25 17.1609 1.25 11.5ZM8.25 11.5C8.25 11.0858 8.58579 10.75 9 10.75H14C14.4142 10.75 14.75 11.0858 14.75 11.5C14.75 11.9142 14.4142 12.25 14 12.25H9C8.58579 12.25 8.25 11.9142 8.25 11.5Z" fill="currentColor"/>
                            </svg>                            
                            <span class="sr-only">Réinitialiser Search</span>
                        </a>
                    </div>
                </form>                
                {{-- card --}}
                <div class="my-5">
                    <div class="">
                        @if($garages->isEmpty())
                            <p class="p-4 text-gray-500 text-center">Aucun garage disponible.</p>
                        @else
                        <div class="space-y-4">
                            @foreach($garages as $garage)
                            <div>
                                <div class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row w-full hover:bg-gray-100">
                                    <img 
                                        class="object-cover w-full h-96 rounded-t-lg md:h-60 md:w-60 md:rounded-none md:rounded-s-lg"
                                        src="{{ $garage->photo ? asset('storage/' . $garage->photo) : '/images/defaultimage.jpg' }}"
                                        alt="Garage Image"
                                        loading="lazy"
                                    >
                                    <div class="flex flex-col justify-between p-4 leading-normal w-full">
                                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ $garage->name }}</h5>
                                        <p class="mb-3 font-normal text-gray-700">
                                            <span class="text-red-700 font-bold">{{ $garage->ville }}</span> {{ $garage->quartier ? '- ' . $garage->quartier : '' }}
                                        </p>
                                        @if($garage->localisation)
                                            <p class="mb-3 font-normal text-gray-700">{{ $garage->localisation }}</p>
                                        @endif
                                        @if($garage->services)
                                        <p class="mb-3 text-red-700 font-bold">{{ implode(' / ', $garage->services) }}</p>
                                        @endif
                                        <a href="{{ route('garages.show', $garage->id) }}">
                                            <button class="inline-flex items-center px-4 py-2 bg-red-600 text-white font-semibold text-xs rounded-[24px] hover:bg-gray-700 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition ease-in-out duration-150">
                                                {{ __('Plus de détails') }}
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>                        
                        @endif
                    </div>
                </div>
                {{-- card close --}}
                <!-- Pagination Links -->
                <div class="mt-4">
                    {{ $garages->appends(['ville' => request('ville')])->links() }}
                </div>
    </div>

    </div>
    {{-- contet close colse --}}
    {{-- footer --}}
    <div class="p-2 border-2 border-gray-200 border-dashed rounded-lg mt-4">
        @include('layouts.footer')
    </div>
    </div>
</x-app-layout>