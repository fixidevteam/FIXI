<x-mechanic-app-layout>
    <div class="p-4 sm:ml-64">
        <div class="p-2 border-2 border-gray-200 border-dashed rounded-lg mt-14">
            {{-- Breadcrumb --}}
            <nav class="flex px-5 py-3 text-gray-700 bg-white shadow-sm sm:rounded-lg">
                <ol class="inline-flex items-center space-x-1 md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="{{ route('mechanic.dashboard') }}" class="text-sm font-medium text-gray-700">
                            Accueil
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-3 h-3 mx-1 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <a href="{{ route('mechanic.operations.index') }}" class="text-sm font-medium text-gray-700">
                                Mes opérations
                            </a>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <div class="p-2 border-2 border-gray-200 border-dashed rounded-lg mt-4">
            {{-- Header --}}
            <div class="px-5 py-3 bg-white shadow-sm sm:rounded-lg">
                <div class="flex justify-between items-center my-6">
                    <h2 class="text-2xl font-bold text-gray-900">Liste des opérations</h2>
                </div>

                {{-- Search Form --}}
                <form action="{{ route('mechanic.operations.index') }}" method="GET" class="flex items-center w-full mx-auto">
                    <input 
                        type="text" 
                        name="search" 
                        id="search" 
                        value="{{ old('search', $search) }}" 
                        placeholder="Numero d'immatriculation" 
                        class="w-full p-2.5 border border-gray-300 rounded-lg text-sm text-gray-900 bg-gray-50 focus:ring-blue-600 focus:border-blue-500" 
                    />
                    <button type="submit" class="p-2.5 ms-2 bg-gray-700 text-white rounded-lg hover:bg-gray-800">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                        <span class="sr-only">Search</span>
                    </button>
                    {{-- Reset Button --}}
                    <a href="{{ route('mechanic.operations.index') }}" class="p-2.5 ms-2 bg-gray-200 text-gray-900 rounded-lg hover:bg-gray-300">
                        Réinitialiser
                    </a>
                </form>

                {{-- Table --}}
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg my-5">
                    @if($operations->isEmpty())
                        <p class="p-4 text-gray-500 text-center">Aucun opération disponible.</p>
                    @else
                        <table class="w-full text-sm text-left text-gray-500">
                            <caption class="sr-only">Liste des opérations</caption>
                            <thead class="text-xs uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Numéro d'immatriculation</th>
                                    <th scope="col" class="px-6 py-3">Catégorie</th>
                                    <th scope="col" class="px-6 py-3">Opération</th>
                                    <th scope="col" class="px-6 py-3">Sous Opération</th>
                                    <th scope="col" class="px-6 py-3">Date d'opération</th>
                                    <th scope="col" class="px-6 py-3">Photo</th>
                                    <th scope="col" class="px-6 py-3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($operations as $operation)
                                    <tr class="bg-white border-b">
                                        <td class="px-6 py-4 font-medium text-gray-900">
                                            <span>{{ explode('-', $operation->voiture->numero_immatriculation)[0] }}</span>-<span dir="rtl">{{ explode('-', $operation->voiture->numero_immatriculation)[1] }}</span>-<span>{{ explode('-', $operation->voiture->numero_immatriculation)[2] }}</span>
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $categories->where('id', $operation->categorie)->first()->nom_categorie ?? 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $ope->where('id', $operation->nom)->first()->nom_operation ?? 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4">
                                            @php
                                                $sousOperations = $ope->where('id', $operation->nom)->first()->sousOperations ?? [];
                                            @endphp
                                            {{ $sousOperations->first()->nom_sous_operation ?? 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $operation->date_operation }}
                                        </td>
                                        <td class="px-6 py-4">
                                            @if($operation->voiture->photo)
                                                <img class="w-8 h-8 object-cover rounded-full" src="{{ asset('storage/' . $operation->voiture->photo) }}" alt="Voiture">
                                            @else
                                                <img class="w-8 h-8 object-cover rounded-full" src="{{ asset('images/defaultimage.jpg') }}" alt="Default">
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <a href="{{ route('mechanic.operations.show',$operation->id) }}" class="text-blue-600 hover:underline">Détails</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-mechanic-app-layout>
