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
                    {{-- @if($operations->isNotEmpty())
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
                        <a href="{{ route('operations.export') }}" class="btn btn-primary">Exporter en Excel</a>
                    </div>
                    @endif --}}
                    {{--  --}}
                    <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-[24px] font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" type="button">
                        Télécharger l'historique
                        <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                        </svg>
                    </button>
                    
                    <!-- Dropdown menu -->
                    <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-52">
                        <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownDefaultButton">
                            @if($operations->isNotEmpty())
                                <li>
                                    <a href="{{ route('operations.pdf') }}" class="block px-4 py-2 hover:bg-gray-100">
                                        <span class="flex items-center gap-2">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12.5303 17.5303C12.3897 17.671 12.1989 17.75 12 17.75C11.8011 17.75 11.6103 17.671 11.4697 17.5303L8.96967 15.0303C8.67678 14.7374 8.67678 14.2626 8.96967 13.9697C9.26256 13.6768 9.73744 13.6768 10.0303 13.9697L11.25 15.1893V11C11.25 10.5858 11.5858 10.25 12 10.25C12.4142 10.25 12.75 10.5858 12.75 11V15.1893L13.9697 13.9697C14.2626 13.6768 14.7374 13.6768 15.0303 13.9697C15.3232 14.2626 15.3232 14.7374 15.0303 15.0303L12.5303 17.5303Z" fill="#1C274C"/>
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M12.0574 1.25H11.9426C9.63423 1.24999 7.82519 1.24998 6.41371 1.43975C4.96897 1.63399 3.82895 2.03933 2.93414 2.93414C2.03933 3.82895 1.63399 4.96897 1.43975 6.41371C1.24998 7.82519 1.24999 9.63422 1.25 11.9426V12H1.26092C1.25 12.5788 1.25 13.2299 1.25 13.9664V14.0336C1.25 15.4053 1.24999 16.4807 1.32061 17.3451C1.39252 18.2252 1.54138 18.9523 1.87671 19.6104C2.42799 20.6924 3.30762 21.572 4.38956 22.1233C5.04769 22.4586 5.7748 22.6075 6.65494 22.6794C7.51927 22.75 8.59469 22.75 9.96637 22.75H14.0336C15.4053 22.75 16.4807 22.75 17.3451 22.6794C18.2252 22.6075 18.9523 22.4586 19.6104 22.1233C20.6924 21.572 21.572 20.6924 22.1233 19.6104C22.4586 18.9523 22.6075 18.2252 22.6794 17.3451C22.75 16.4807 22.75 15.4053 22.75 14.0336V13.9664C22.75 13.2302 22.75 12.5787 22.7391 12H22.75V11.9426C22.75 9.63423 22.75 7.82519 22.5603 6.41371C22.366 4.96897 21.9607 3.82895 21.0659 2.93414C20.1711 2.03933 19.031 1.63399 17.5863 1.43975C16.1748 1.24998 14.3658 1.24999 12.0574 1.25ZM4.38956 5.87671C3.82626 6.16372 3.31781 6.53974 2.88197 6.98698C2.89537 6.85884 2.91012 6.73444 2.92637 6.61358C3.09825 5.33517 3.42514 4.56445 3.9948 3.9948C4.56445 3.42514 5.33517 3.09825 6.61358 2.92637C7.91356 2.75159 9.62177 2.75 12 2.75C14.3782 2.75 16.0864 2.75159 17.3864 2.92637C18.6648 3.09825 19.4355 3.42514 20.0052 3.9948C20.5749 4.56445 20.9018 5.33517 21.0736 6.61358C21.0899 6.73445 21.1046 6.85884 21.118 6.98698C20.6822 6.53975 20.1737 6.16372 19.6104 5.87671C18.9523 5.54138 18.2252 5.39252 17.3451 5.32061C16.4807 5.24999 15.4053 5.25 14.0336 5.25H9.96645C8.59472 5.25 7.51929 5.24999 6.65494 5.32061C5.7748 5.39252 5.04769 5.54138 4.38956 5.87671ZM5.07054 7.21322C5.48197 7.00359 5.9897 6.87996 6.77708 6.81563C7.57322 6.75058 8.58749 6.75 10 6.75H14C15.4125 6.75 16.4268 6.75058 17.2229 6.81563C18.0103 6.87996 18.518 7.00359 18.9295 7.21322C19.7291 7.62068 20.3793 8.27085 20.7868 9.07054C20.9964 9.48197 21.12 9.9897 21.1844 10.7771C21.2494 11.5732 21.25 12.5875 21.25 14C21.25 15.4125 21.2494 16.4268 21.1844 17.2229C21.12 18.0103 20.9964 18.518 20.7868 18.9295C20.3793 19.7291 19.7291 20.3793 18.9295 20.7868C18.518 20.9964 18.0103 21.12 17.2229 21.1844C16.4268 21.2494 15.4125 21.25 14 21.25H10C8.58749 21.25 7.57322 21.2494 6.77708 21.1844C5.9897 21.12 5.48197 20.9964 5.07054 20.7868C4.27085 20.3793 3.62068 19.7291 3.21322 18.9295C3.00359 18.518 2.87996 18.0103 2.81563 17.2229C2.75058 16.4268 2.75 15.4125 2.75 14C2.75 12.5875 2.75058 11.5732 2.81563 10.7771C2.87996 9.9897 3.00359 9.48197 3.21322 9.07054C3.62068 8.27085 4.27085 7.62069 5.07054 7.21322Z" fill="#1C274C"/>
                                            </svg>
                                            Exporter en PDF
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('operations.export') }}" class="block px-4 py-2 hover:bg-gray-100">
                                        <span class="flex items-center gap-2">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M3.95526 2.25C3.97013 2.25001 3.98505 2.25001 4.00001 2.25001L20.0448 2.25C20.4776 2.24995 20.8744 2.24991 21.1972 2.29331C21.5527 2.3411 21.9284 2.45355 22.2374 2.76257C22.5465 3.07159 22.6589 3.44732 22.7067 3.8028C22.7501 4.12561 22.7501 4.52245 22.75 4.95526V5.04475C22.7501 5.47757 22.7501 5.8744 22.7067 6.19721C22.6589 6.55269 22.5465 6.92842 22.2374 7.23744C21.9437 7.53121 21.5896 7.64733 21.25 7.69914V13.0564C21.25 14.8942 21.25 16.3498 21.0969 17.489C20.9392 18.6615 20.6071 19.6104 19.8588 20.3588C19.1104 21.1071 18.1615 21.4392 16.989 21.5969C15.8498 21.75 14.3942 21.75 12.5564 21.75H11.4436C9.60583 21.75 8.1502 21.75 7.01098 21.5969C5.83856 21.4392 4.88961 21.1071 4.14125 20.3588C3.39289 19.6104 3.06077 18.6615 2.90314 17.489C2.74998 16.3498 2.74999 14.8942 2.75001 13.0564L2.75001 7.69914C2.41038 7.64733 2.05634 7.53121 1.76257 7.23744C1.45355 6.92842 1.3411 6.55269 1.29331 6.19721C1.24991 5.8744 1.24995 5.47757 1.25 5.04476C1.25001 5.02988 1.25001 5.01496 1.25001 5.00001C1.25001 4.98505 1.25001 4.97013 1.25 4.95526C1.24995 4.52244 1.24991 4.12561 1.29331 3.8028C1.3411 3.44732 1.45355 3.07159 1.76257 2.76257C2.07159 2.45355 2.44732 2.3411 2.8028 2.29331C3.12561 2.24991 3.52244 2.24995 3.95526 2.25ZM4.25001 7.75001V13C4.25001 14.9068 4.2516 16.2615 4.38977 17.2892C4.52503 18.2952 4.7787 18.8749 5.20191 19.2981C5.62512 19.7213 6.20477 19.975 7.21086 20.1102C8.23852 20.2484 9.59319 20.25 11.5 20.25H12.5C14.4068 20.25 15.7615 20.2484 16.7892 20.1102C17.7952 19.975 18.3749 19.7213 18.7981 19.2981C19.2213 18.8749 19.475 18.2952 19.6102 17.2892C19.7484 16.2615 19.75 14.9068 19.75 13V7.75001H12.75V14.0455L14.4425 12.1649C14.7196 11.8571 15.1938 11.8321 15.5017 12.1092C15.8096 12.3863 15.8346 12.8605 15.5575 13.1684L12.5575 16.5017C12.4152 16.6598 12.2126 16.75 12 16.75C11.7874 16.75 11.5848 16.6598 11.4425 16.5017L8.44254 13.1684C8.16544 12.8605 8.1904 12.3863 8.49828 12.1092C8.80617 11.8321 9.28038 11.8571 9.55748 12.1649L11.25 14.0455V7.75001H4.25001ZM20 6.25001C20.4926 6.25001 20.7866 6.24841 20.9973 6.22008C21.0939 6.2071 21.1423 6.19181 21.164 6.18285C21.1691 6.18077 21.1724 6.17916 21.1743 6.17815L21.1768 6.17678L21.1781 6.17434C21.1792 6.1724 21.1808 6.16909 21.1828 6.16404C21.1918 6.14226 21.2071 6.0939 21.2201 5.99734C21.2484 5.78662 21.25 5.49261 21.25 5.00001C21.25 4.5074 21.2484 4.21339 21.2201 4.00267C21.2071 3.90611 21.1918 3.85775 21.1828 3.83597C21.1808 3.83093 21.1792 3.82761 21.1781 3.82568L21.1768 3.82323L21.1743 3.82187C21.1724 3.82086 21.1691 3.81924 21.164 3.81717C21.1423 3.80821 21.0939 3.79291 20.9973 3.77993C20.7866 3.7516 20.4926 3.75001 20 3.75001H4.00001C3.5074 3.75001 3.21339 3.7516 3.00267 3.77993C2.90611 3.79291 2.85775 3.80821 2.83597 3.81717C2.83093 3.81924 2.82761 3.82086 2.82568 3.82187L2.82324 3.82324L2.82187 3.82568C2.82086 3.82761 2.81924 3.83093 2.81717 3.83597C2.80821 3.85775 2.79291 3.90611 2.77993 4.00267C2.7516 4.21339 2.75001 4.5074 2.75001 5.00001C2.75001 5.49261 2.7516 5.78662 2.77993 5.99734C2.79291 6.0939 2.80821 6.14226 2.81717 6.16404C2.81924 6.16909 2.82086 6.1724 2.82187 6.17434L2.82324 6.17677L2.82568 6.17815C2.82761 6.17916 2.83093 6.18077 2.83597 6.18285C2.85775 6.19181 2.90611 6.2071 3.00267 6.22008C3.21339 6.24841 3.5074 6.25001 4.00001 6.25001H20ZM2.82324 6.17677C2.82284 6.17636 2.82297 6.17644 2.82324 6.17677V6.17677Z" fill="#1C274C"/>
                                            </svg>
                                            Exporter en Excel
                                        </span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                    
                    {{--  --}}
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