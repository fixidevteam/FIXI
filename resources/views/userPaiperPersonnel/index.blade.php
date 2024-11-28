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
                </ol>
            </nav>

        </div>
        {{-- content --}}
        <div class="p-2 border-2 border-gray-200 border-dashed rounded-lg mt-4">
            {{-- content (slot on layouts/app.blade.php)--}}
            <div class=" px-5 py-3 text-gray-700 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex justify-between items-center my-6">
                    <h2 class="text-2xl font-bold leading-9 tracking-tight text-gray-900">Liste des papier personnels</h2>
                    <div>
                        <a href="{{ route('paiperPersonnel.create') }}">
                            <x-primary-button class="hidden md:block">Ajouter un papier</x-primary-button>
                            <x-primary-button class="sm:hidden">
                                <svg class="w-5 h-5 text-white" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12.75 9C12.75 8.58579 12.4142 8.25 12 8.25C11.5858 8.25 11.25 8.58579 11.25 9L11.25 11.25H9C8.58579 11.25 8.25 11.5858 8.25 12C8.25 12.4142 8.58579 12.75 9 12.75H11.25V15C11.25 15.4142 11.5858 15.75 12 15.75C12.4142 15.75 12.75 15.4142 12.75 15L12.75 12.75H15C15.4142 12.75 15.75 12.4142 15.75 12C15.75 11.5858 15.4142 11.25 15 11.25H12.75V9Z" fill="currentColor" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12 1.25C6.06294 1.25 1.25 6.06294 1.25 12C1.25 17.9371 6.06294 22.75 12 22.75C17.9371 22.75 22.75 17.9371 22.75 12C22.75 6.06294 17.9371 1.25 12 1.25ZM2.75 12C2.75 6.89137 6.89137 2.75 12 2.75C17.1086 2.75 21.25 6.89137 21.25 12C21.25 17.1086 17.1086 21.25 12 21.25C6.89137 21.25 2.75 17.1086 2.75 12Z" fill="currentColor" />
                                </svg>
                            </x-primary-button>
                        </a>
                    </div>
                </div>
                {{-- table --}}
                <div class="my-5">
                    {{-- alert --}}
                    @foreach (['success', 'error'] as $type)
                    @if (session($type))
                    <div class="fixed top-20 right-4 mb-5 flex justify-end z-10"
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition:leave="transition ease-in duration-1000"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        x-init="setTimeout(() => show = false, 3000)">
                        <div role="alert" class="rounded-xl border border-gray-100 bg-white p-4 shadow-md">
                            <div class="flex items-start gap-4">
                                <span class="{{ $type === 'success' ? 'text-green-600' : 'text-red-600' }}">
                                    @if ($type === 'success')
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="size-6">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    @else
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 6.25C12.4142 6.25 12.75 6.58579 12.75 7V13C12.75 13.4142 12.4142 13.75 12 13.75C11.5858 13.75 11.25 13.4142 11.25 13V7C11.25 6.58579 11.5858 6.25 12 6.25Z" fill="currentColor" />
                                        <path d="M12 17C12.5523 17 13 16.5523 13 16C13 15.4477 12.5523 15 12 15C11.4477 15 11 15.4477 11 16C11 16.5523 11.4477 17 12 17Z" fill="currentColor" />
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M1.25 12C1.25 6.06294 6.06294 1.25 12 1.25C17.9371 1.25 22.75 6.06294 22.75 12C22.75 17.9371 17.9371 22.75 12 22.75C6.06294 22.75 1.25 17.9371 1.25 12ZM12 2.75C6.89137 2.75 2.75 6.89137 2.75 12C2.75 17.1086 6.89137 21.25 12 21.25C17.1086 21.25 21.25 17.1086 21.25 12C21.25 6.89137 17.1086 2.75 12 2.75Z" fill="currentColor" />
                                    </svg>
                                    @endif
                                </span>
                                <div class="flex-1">
                                    <strong class="block font-medium text-gray-900"> {{ session($type) }} </strong>
                                    <p class="mt-1 text-sm text-gray-700">{{ session('subtitle') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                    {{-- alert close --}}
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        @if($papiers->isEmpty())
                        <p class="p-4 text-gray-500 text-center">Aucun papier disponible.</p>
                        @else
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <caption class="sr-only">Liste des papier personnels</caption>
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        type
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        date debut
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        date fin
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Photo
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                    <th scope="col" class="px-6 py-3">

                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($papiers as $papier)
                                <tr class="bg-white border-b">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        <a href="{{route('paiperPersonnel.show',$papier->id)}}">

                                            {{$papier->type}}
                                        </a>
                                    </th>
                                    <td class="px-6 py-4">
                                        {{$papier->date_debut}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$papier->date_fin}}
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="{{route('paiperPersonnel.show',$papier->id)}}">

                                            @if($papier->photo !== NULL)
                                            @php
                                            $fileExtension = pathinfo($papier->photo, PATHINFO_EXTENSION);
                                            @endphp

                                            @if(in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png']))
                                            <!-- Display the actual photo -->
                                            <img class="rounded-full w-8 h-8 object-cover" src="{{ asset('storage/' . $papier->photo) }}" alt="image description">
                                            @elseif(strtolower($fileExtension) === 'pdf')
                                            <!-- Display the default image for PDFs -->
                                            <img class="rounded-full w-8 h-8 object-cover" src="{{ asset('/images/file.png') }}" alt="default image">
                                            @else
                                            <!-- Display the default image for unsupported formats -->
                                            <img class="rounded-full w-8 h-8 object-cover" src="{{ asset('/images/defaultimage.jpg') }}" alt="default image">
                                            @endif
                                            @else
                                            <!-- Display the default image if no photo is provided -->
                                            <img class="rounded-full w-8 h-8 object-cover" src="{{ asset('/images/defaultimage.jpg') }}" alt="default image">
                                            @endif
                                        </a>
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="{{route('paiperPersonnel.show',$papier->id)}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Détails</a>
                                    </td>
                                    <td class="px-6 py-4">
                                        @php
                                        $dateFin = \Carbon\Carbon::parse($papier->date_fin);
                                        $daysRemaining = now()->diffInDays($dateFin, false);
                                        @endphp

                                        @if($daysRemaining === 0)
                                        <div class="flex items-center gap-1">
                                            <svg class="text-red" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12 7.25C12.4142 7.25 12.75 7.58579 12.75 8V12C12.75 12.4142 12.4142 12.75 12 12.75C11.5858 12.75 11.25 12.4142 11.25 12V8C11.25 7.58579 11.5858 7.25 12 7.25Z" fill="red" />
                                                <path d="M12 16C12.5523 16 13 15.5523 13 15C13 14.4477 12.5523 14 12 14C11.4477 14 11 14.4477 11 15C11 15.5523 11.4477 16 12 16Z" fill="red" />
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M8.72339 2.05112C10.1673 1.55658 11.0625 1.25 12 1.25C12.9375 1.25 13.8327 1.55658 15.2766 2.05112L16.004 2.30013C17.4854 2.8072 18.6286 3.19852 19.447 3.53099C19.8592 3.69846 20.2136 3.86067 20.499 4.02641C20.7737 4.1859 21.0492 4.38484 21.2364 4.65154C21.4214 4.91516 21.5171 5.23924 21.5772 5.55122C21.6397 5.87556 21.6774 6.26464 21.7017 6.71136C21.75 7.5984 21.75 8.81361 21.75 10.3898V11.9914C21.75 18.0924 17.142 21.0175 14.4017 22.2146L14.3746 22.2264C14.0348 22.3749 13.7154 22.5144 13.3484 22.6084C12.9609 22.7076 12.5493 22.75 12 22.75C11.4507 22.75 11.0391 22.7076 10.6516 22.6084C10.2846 22.5144 9.96523 22.3749 9.62543 22.2264L9.59833 22.2146C6.85803 21.0175 2.25 18.0924 2.25 11.9914V10.3899C2.25 8.81366 2.25 7.59841 2.2983 6.71136C2.32262 6.26464 2.36031 5.87556 2.42281 5.55122C2.48293 5.23924 2.5786 4.91516 2.76363 4.65154C2.95082 4.38484 3.22634 4.1859 3.50098 4.02641C3.78637 3.86067 4.14078 3.69846 4.55303 3.53099C5.3714 3.19852 6.51462 2.8072 7.99595 2.30014L8.72339 2.05112ZM12 2.75C11.3423 2.75 10.6951 2.96164 9.08062 3.5143L8.5078 3.71037C6.99521 4.22814 5.8921 4.60605 5.11759 4.92069C4.731 5.07774 4.4509 5.20935 4.25429 5.32353C4.15722 5.3799 4.09034 5.42642 4.04567 5.46273C4.0078 5.49351 3.99336 5.51095 3.99129 5.51349C3.98936 5.51663 3.97693 5.5374 3.95943 5.58654C3.93944 5.64265 3.91729 5.72309 3.89571 5.83506C3.85204 6.06169 3.81894 6.37301 3.79608 6.79292C3.75028 7.63411 3.75 8.80833 3.75 10.4167V11.9914C3.75 17.1665 7.6199 19.7135 10.1988 20.84C10.5703 21.0023 10.7848 21.0941 11.0236 21.1552C11.2517 21.2136 11.53 21.25 12 21.25C12.47 21.25 12.7483 21.2136 12.9764 21.1552C13.2152 21.0941 13.4297 21.0023 13.8012 20.84C16.3801 19.7135 20.25 17.1665 20.25 11.9914V10.4167C20.25 8.80833 20.2497 7.63411 20.2039 6.79292C20.1811 6.37301 20.148 6.06169 20.1043 5.83506C20.0827 5.72309 20.0606 5.64265 20.0406 5.58654C20.0231 5.53737 20.0106 5.5166 20.0087 5.51348C20.0066 5.51092 19.9922 5.49349 19.9543 5.46273C19.9097 5.42642 19.8428 5.3799 19.7457 5.32353C19.5491 5.20935 19.269 5.07774 18.8824 4.92069C18.1079 4.60605 17.0048 4.22814 15.4922 3.71037L14.9194 3.5143C13.3049 2.96164 12.6577 2.75 12 2.75Z" fill="red" />
                                            </svg>
                                            <span>Expire aujourd'hui</span>
                                        </div>
                                        @elseif($daysRemaining > 0 && $daysRemaining <= 7 )
                                            <div class="flex items-center gap-1">
                                            <svg class="text-orange-500" width="24" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M12.5 2.75C7.39137 2.75 3.25 6.89137 3.25 12C3.25 17.1086 7.39137 21.25 12.5 21.25C17.6086 21.25 21.75 17.1086 21.75 12C21.75 6.89137 17.6086 2.75 12.5 2.75ZM1.75 12C1.75 6.06294 6.56294 1.25 12.5 1.25C18.4371 1.25 23.25 6.06294 23.25 12C23.25 17.9371 18.4371 22.75 12.5 22.75C6.56294 22.75 1.75 17.9371 1.75 12ZM12.5 7.25C12.9142 7.25 13.25 7.58579 13.25 8V11.6893L15.5303 13.9697C15.8232 14.2626 15.8232 14.7374 15.5303 15.0303C15.2374 15.3232 14.7626 15.3232 14.4697 15.0303L11.9697 12.5303C11.829 12.3897 11.75 12.1989 11.75 12V8C11.75 7.58579 12.0858 7.25 12.5 7.25Z" fill="currentColor" />
                                            </svg>
                                            <span>Ce document expire dans {{ $daysRemaining }} jours.</span>
                    </div>
                    @elseif($daysRemaining > 0 && $daysRemaining <= 90 )
                        <div class=" flex items-center gap-1">
                        <svg class="text-yellow-500" width="24" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12.5 2.75C7.39137 2.75 3.25 6.89137 3.25 12C3.25 17.1086 7.39137 21.25 12.5 21.25C17.6086 21.25 21.75 17.1086 21.75 12C21.75 6.89137 17.6086 2.75 12.5 2.75ZM1.75 12C1.75 6.06294 6.56294 1.25 12.5 1.25C18.4371 1.25 23.25 6.06294 23.25 12C23.25 17.9371 18.4371 22.75 12.5 22.75C6.56294 22.75 1.75 17.9371 1.75 12ZM12.5 7.25C12.9142 7.25 13.25 7.58579 13.25 8V11.6893L15.5303 13.9697C15.8232 14.2626 15.8232 14.7374 15.5303 15.0303C15.2374 15.3232 14.7626 15.3232 14.4697 15.0303L11.9697 12.5303C11.829 12.3897 11.75 12.1989 11.75 12V8C11.75 7.58579 12.0858 7.25 12.5 7.25Z" fill="currentColor" />
                        </svg>
                        <span>Ce document expire dans {{ $daysRemaining }} jours.</span>
                </div>

                @elseif($daysRemaining < 0)
                    <div class="flex items-center gap-1">
                    <svg class="text-red" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 7.25C12.4142 7.25 12.75 7.58579 12.75 8V12C12.75 12.4142 12.4142 12.75 12 12.75C11.5858 12.75 11.25 12.4142 11.25 12V8C11.25 7.58579 11.5858 7.25 12 7.25Z" fill="red" />
                        <path d="M12 16C12.5523 16 13 15.5523 13 15C13 14.4477 12.5523 14 12 14C11.4477 14 11 14.4477 11 15C11 15.5523 11.4477 16 12 16Z" fill="red" />
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8.72339 2.05112C10.1673 1.55658 11.0625 1.25 12 1.25C12.9375 1.25 13.8327 1.55658 15.2766 2.05112L16.004 2.30013C17.4854 2.8072 18.6286 3.19852 19.447 3.53099C19.8592 3.69846 20.2136 3.86067 20.499 4.02641C20.7737 4.1859 21.0492 4.38484 21.2364 4.65154C21.4214 4.91516 21.5171 5.23924 21.5772 5.55122C21.6397 5.87556 21.6774 6.26464 21.7017 6.71136C21.75 7.5984 21.75 8.81361 21.75 10.3898V11.9914C21.75 18.0924 17.142 21.0175 14.4017 22.2146L14.3746 22.2264C14.0348 22.3749 13.7154 22.5144 13.3484 22.6084C12.9609 22.7076 12.5493 22.75 12 22.75C11.4507 22.75 11.0391 22.7076 10.6516 22.6084C10.2846 22.5144 9.96523 22.3749 9.62543 22.2264L9.59833 22.2146C6.85803 21.0175 2.25 18.0924 2.25 11.9914V10.3899C2.25 8.81366 2.25 7.59841 2.2983 6.71136C2.32262 6.26464 2.36031 5.87556 2.42281 5.55122C2.48293 5.23924 2.5786 4.91516 2.76363 4.65154C2.95082 4.38484 3.22634 4.1859 3.50098 4.02641C3.78637 3.86067 4.14078 3.69846 4.55303 3.53099C5.3714 3.19852 6.51462 2.8072 7.99595 2.30014L8.72339 2.05112ZM12 2.75C11.3423 2.75 10.6951 2.96164 9.08062 3.5143L8.5078 3.71037C6.99521 4.22814 5.8921 4.60605 5.11759 4.92069C4.731 5.07774 4.4509 5.20935 4.25429 5.32353C4.15722 5.3799 4.09034 5.42642 4.04567 5.46273C4.0078 5.49351 3.99336 5.51095 3.99129 5.51349C3.98936 5.51663 3.97693 5.5374 3.95943 5.58654C3.93944 5.64265 3.91729 5.72309 3.89571 5.83506C3.85204 6.06169 3.81894 6.37301 3.79608 6.79292C3.75028 7.63411 3.75 8.80833 3.75 10.4167V11.9914C3.75 17.1665 7.6199 19.7135 10.1988 20.84C10.5703 21.0023 10.7848 21.0941 11.0236 21.1552C11.2517 21.2136 11.53 21.25 12 21.25C12.47 21.25 12.7483 21.2136 12.9764 21.1552C13.2152 21.0941 13.4297 21.0023 13.8012 20.84C16.3801 19.7135 20.25 17.1665 20.25 11.9914V10.4167C20.25 8.80833 20.2497 7.63411 20.2039 6.79292C20.1811 6.37301 20.148 6.06169 20.1043 5.83506C20.0827 5.72309 20.0606 5.64265 20.0406 5.58654C20.0231 5.53737 20.0106 5.5166 20.0087 5.51348C20.0066 5.51092 19.9922 5.49349 19.9543 5.46273C19.9097 5.42642 19.8428 5.3799 19.7457 5.32353C19.5491 5.20935 19.269 5.07774 18.8824 4.92069C18.1079 4.60605 17.0048 4.22814 15.4922 3.71037L14.9194 3.5143C13.3049 2.96164 12.6577 2.75 12 2.75Z" fill="red" />
                    </svg>
                    <span>Ce document est expiré.</span>
            </div>
            @else
            <div class="flex items-center gap-1">
                <svg class="text-green-500" width="24" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12.5 2.75C7.39137 2.75 3.25 6.89137 3.25 12C3.25 17.1086 7.39137 21.25 12.5 21.25C17.6086 21.25 21.75 17.1086 21.75 12C21.75 6.89137 17.6086 2.75 12.5 2.75ZM1.75 12C1.75 6.06294 6.56294 1.25 12.5 1.25C18.4371 1.25 23.25 6.06294 23.25 12C23.25 17.9371 18.4371 22.75 12.5 22.75C6.56294 22.75 1.75 17.9371 1.75 12ZM12.5 7.25C12.9142 7.25 13.25 7.58579 13.25 8V11.6893L15.5303 13.9697C15.8232 14.2626 15.8232 14.7374 15.5303 15.0303C15.2374 15.3232 14.7626 15.3232 14.4697 15.0303L11.9697 12.5303C11.829 12.3897 11.75 12.1989 11.75 12V8C11.75 7.58579 12.0858 7.25 12.5 7.25Z" fill="currentColor" />
                </svg>
                <span>Jours restants avant expiration : {{ $daysRemaining }}</span>
            </div>
            @endif
            </td>
            </tr>
            @endforeach
            </tbody>
            </table>
            @endif
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
</x-app-layout>