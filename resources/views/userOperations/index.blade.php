<x-app-layout :subtitle="'Liste des opérations'">
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
                    @if($operations->isNotEmpty())
                    <div>
                        <a href="{{ route('operations.pdf') }}">
                            <x-primary-button class="btn-pdf hidden md:block">
                                Télécharger l'historique
                            </x-primary-button>
                            <x-primary-button class="sm:hidden">
                                <svg class="w-5 h-5 text-white" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M5.07868 5.06891C8.87402 1.27893 15.0437 1.31923 18.8622 5.13778C22.6824 8.95797 22.7211 15.1313 18.9262 18.9262C15.1312 22.7211 8.95793 22.6824 5.13774 18.8622C2.87389 16.5984 1.93904 13.5099 2.34047 10.5812C2.39672 10.1708 2.775 9.88377 3.18537 9.94002C3.59575 9.99627 3.88282 10.3745 3.82658 10.7849C3.4866 13.2652 4.27782 15.881 6.1984 17.8016C9.44288 21.0461 14.6664 21.0646 17.8655 17.8655C21.0646 14.6664 21.046 9.44292 17.8015 6.19844C14.5587 2.95561 9.33889 2.93539 6.13935 6.12957L6.88705 6.13333C7.30126 6.13541 7.63535 6.47288 7.63327 6.88709C7.63119 7.3013 7.29372 7.63539 6.87951 7.63331L4.33396 7.62052C3.92269 7.61845 3.58981 7.28556 3.58774 6.8743L3.57495 4.32874C3.57286 3.91454 3.90696 3.57707 4.32117 3.57498C4.73538 3.5729 5.07285 3.907 5.07493 4.32121L5.07868 5.06891ZM11.9999 7.24992C12.4141 7.24992 12.7499 7.58571 12.7499 7.99992V11.6893L15.0302 13.9696C15.3231 14.2625 15.3231 14.7374 15.0302 15.0302C14.7373 15.3231 14.2624 15.3231 13.9696 15.0302L11.2499 12.3106V7.99992C11.2499 7.58571 11.5857 7.24992 11.9999 7.24992Z" fill="currentColor" />
                                </svg>
                            </x-primary-button>
                        </a>
                    </div>
                    @endif
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
                                        @if($operation->photo !== NULL)
                                        <img class="rounded-full w-8 h-8 object-cover cursor-pointer" src="{{asset('storage/'.$operation->photo)}}" alt="image description">
                                        @else
                                        <img class="rounded-full w-8 h-8 object-cover cursor-pointer" src="/images/defaultimage.jpg" alt="image description">
                                        @endif
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
                <div id="imageModalOperation" class="fixed inset-0 z-50 hidden bg-black bg-opacity-75 flex items-center justify-center">
                    <div class="relative max-w-4xl w-full mx-auto">
                        <img id="modalImageOperation" src="" alt="Operation Image" class="w-full max-h-[80vh] object-contain">
                        <button class="absolute top-4 right-4 text-white text-2xl font-bold bg-black bg-opacity-50 rounded-full px-3 py-1 hover:bg-opacity-75 hover:text-red-500 transition-all duration-300 ease-in" onclick="toggleModalImageOperation(false)">&times;</button>
                    </div>
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
    <script>
        const modal = document.getElementById('imageModalOperation');
        const images = document.querySelectorAll('img.object-cover');

        images.forEach(image => {
            image.addEventListener('click', () => {
                document.getElementById('modalImageOperation').src = image.src;
                toggleModalImageOperation(true);
            });
        });

        modal.addEventListener('click', (event) => {
            if (event.target === modal) {
                toggleModalImageOperation(false);
            }
        });

        function toggleModalImageOperation(show) {
            modal.classList.toggle('hidden', !show);
            modal.classList.toggle('flex', show);
        }
    </script>
</x-app-layout>