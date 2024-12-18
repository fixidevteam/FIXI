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
                                href="{{ route('operation.index') }}"
                                class="inline-flex items-center text-sm font-medium text-gray-700   ">
                                Mes opérations
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
                    <h2 class="text-2xl font-bold leading-9 tracking-tight text-gray-900">Liste des opérations</h2>
                </div>
                {{-- table --}}
                <div class="my-5">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        @if($operations->isEmpty())
                        <p class="p-4 text-gray-500 text-center">Aucun opérations disponible.</p>
                        @else
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <caption class="sr-only">Liste des opérations</caption>
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        numero d'immatriculation
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Categorie
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        opération
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        garage
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Photo
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Date d'opération
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($operations as $operation)
                                <tr class="bg-white border-b">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        <a href="{{ route('voiture.show',$operation->voiture_id) }}">
                                            <span>{{ explode('-', $operation->voiture->numero_immatriculation)[0] }}</span>-<span dir="rtl">{{ explode('-', $operation->voiture->numero_immatriculation)[1] }}</span>-<span>{{ explode('-', $operation->voiture->numero_immatriculation)[2] }}</span>
                                        </a>
                                    </th>
                                    <td class="px-6 py-4">
                                        {{
                                            $categories->where('id',$operation->categorie)->first()->nom_categorie ?? 'N/A';
                                        }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ 
                                            $operation->nom === 'Autre' 
                                                ? $operation->autre_operation 
                                                : ($operationsAll->where('id', $operation->nom)->first()->nom_operation ?? 'N/A') 
                                        }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{
                                            $garages->where('id', $operation->garage_id)->first()->name ?? 'N/A';
                                        }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('operation.show',$operation->id) }}">
                                            @if($operation->photo !== NULL)
                                            <img class="rounded-full w-8 h-8 object-cover" src="{{asset('storage/'.$operation->photo)}}" alt="image description">
                                            @else
                                            <img class="rounded-full w-8 h-8 object-cover" src="/images/defaultimage.jpg" alt="image description">
                                            @endif
                                        </a>
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$operation->date_operation ?? 'N/A'}}
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('operation.show',$operation->id) }}" class="font-medium capitalize text-blue-600 dark:text-blue-500 hover:underline">Détails</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
                <div class="my-4">
                    {{ $operations->links() }}
                </div>
                {{-- table close --}}
            </div>
        </div>
        {{-- contet close colse --}}
        {{-- footer --}}
        <div class="p-2 border-2 border-gray-200 border-dashed rounded-lg mt-4">
            @include('layouts.footer')
        </div>
    </div>
</x-app-layout>