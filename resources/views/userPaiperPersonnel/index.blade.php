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
                            <x-primary-button class="hidden md:block">Ajoutr un papier</x-primary-button>
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
                    @if (session('success'))
                    <div class="fixed top-20 right-4 mb-5 flex justify-end z-10"
                    x-data="{ show: true }" 
                    x-show="show" 
                    x-transition:leave="transition ease-in duration-1000" 
                    x-transition:leave-start="opacity-100" 
                    x-transition:leave-end="opacity-0" 
                    x-init="setTimeout(() => show = false, 3000)" 
                    >
                        <div role="alert" class="rounded-xl border border-gray-100 bg-white p-4">
                            <div class="flex items-start gap-4">
                            <span class="text-green-600">
                                <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="size-6"
                                >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                />
                                </svg>
                            </span>
                            <div class="flex-1">
                                <strong class="block font-medium text-gray-900"> {{ session('success') }} </strong>
                                <p class="mt-1 text-sm text-gray-700">{{ session('subtitle') }}</p>
                            </div>
                            </div>
                        </div>
                    </div>
                @endif
                {{-- alert close --}}
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        @if($papiers->isEmpty())
                        <p class="p-4 text-gray-500 text-center">Aucune papier disponible.</p>
                        @else
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
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
                                        {{$papier->type}}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{$papier->date_debut}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$papier->date_fin}}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($papier->photo !== NULL)
                                        <img class="rounded-full w-8 h-8 object-cover" src="{{asset('storage/'.$papier->photo)}}" alt="image description">
                                        @else
                                        <img class="rounded-full w-8 h-8 object-cover" src="images/defaultimage.jpg" alt="image description">
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="{{route('paiperPersonnel.show',$papier->id)}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Details</a>
                                    </td>
                                    <td class="px-6 py-4">
                                        @php
                                            $dateFin = \Carbon\Carbon::parse($papier->date_fin);
                                            $daysRemaining = now()->diffInDays($dateFin, false);
                                        @endphp

                                        @if($daysRemaining === 0)
                                            <div class="flex items-center gap-1">
                                            <svg class="text-yellow-500" width="24" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M12.5 2.75C7.39137 2.75 3.25 6.89137 3.25 12C3.25 17.1086 7.39137 21.25 12.5 21.25C17.6086 21.25 21.75 17.1086 21.75 12C21.75 6.89137 17.6086 2.75 12.5 2.75ZM1.75 12C1.75 6.06294 6.56294 1.25 12.5 1.25C18.4371 1.25 23.25 6.06294 23.25 12C23.25 17.9371 18.4371 22.75 12.5 22.75C6.56294 22.75 1.75 17.9371 1.75 12ZM12.5 7.25C12.9142 7.25 13.25 7.58579 13.25 8V11.6893L15.5303 13.9697C15.8232 14.2626 15.8232 14.7374 15.5303 15.0303C15.2374 15.3232 14.7626 15.3232 14.4697 15.0303L11.9697 12.5303C11.829 12.3897 11.75 12.1989 11.75 12V8C11.75 7.58579 12.0858 7.25 12.5 7.25Z" fill="currentColor"/>
                                            </svg>                            
                                            <span>Expire aujourd'hui</span>
                                            </div>
                                        @elseif($daysRemaining > 0 && $daysRemaining <= 7)
                                            <div class="flex items-center gap-1">
                                            <svg class="text-yellow-500" width="24" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M12.5 2.75C7.39137 2.75 3.25 6.89137 3.25 12C3.25 17.1086 7.39137 21.25 12.5 21.25C17.6086 21.25 21.75 17.1086 21.75 12C21.75 6.89137 17.6086 2.75 12.5 2.75ZM1.75 12C1.75 6.06294 6.56294 1.25 12.5 1.25C18.4371 1.25 23.25 6.06294 23.25 12C23.25 17.9371 18.4371 22.75 12.5 22.75C6.56294 22.75 1.75 17.9371 1.75 12ZM12.5 7.25C12.9142 7.25 13.25 7.58579 13.25 8V11.6893L15.5303 13.9697C15.8232 14.2626 15.8232 14.7374 15.5303 15.0303C15.2374 15.3232 14.7626 15.3232 14.4697 15.0303L11.9697 12.5303C11.829 12.3897 11.75 12.1989 11.75 12V8C11.75 7.58579 12.0858 7.25 12.5 7.25Z" fill="currentColor"/>
                                            </svg>
                                            <span>Ce document expire dans {{ $daysRemaining }} jours.</span>                           
                                            </div>
                                        @elseif($daysRemaining < 0)
                                            <div class="flex items-center gap-1">
                                            <svg class="text-red-500" width="24" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M12.5 2.75C7.39137 2.75 3.25 6.89137 3.25 12C3.25 17.1086 7.39137 21.25 12.5 21.25C17.6086 21.25 21.75 17.1086 21.75 12C21.75 6.89137 17.6086 2.75 12.5 2.75ZM1.75 12C1.75 6.06294 6.56294 1.25 12.5 1.25C18.4371 1.25 23.25 6.06294 23.25 12C23.25 17.9371 18.4371 22.75 12.5 22.75C6.56294 22.75 1.75 17.9371 1.75 12ZM12.5 7.25C12.9142 7.25 13.25 7.58579 13.25 8V11.6893L15.5303 13.9697C15.8232 14.2626 15.8232 14.7374 15.5303 15.0303C15.2374 15.3232 14.7626 15.3232 14.4697 15.0303L11.9697 12.5303C11.829 12.3897 11.75 12.1989 11.75 12V8C11.75 7.58579 12.0858 7.25 12.5 7.25Z" fill="currentColor"/>
                                            </svg>
                                            <span>Ce document est expiré.</span>
                                            </div>
                                        @else
                                            <div class="flex items-center gap-1">
                                            <svg class="text-green-500" width="24" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M12.5 2.75C7.39137 2.75 3.25 6.89137 3.25 12C3.25 17.1086 7.39137 21.25 12.5 21.25C17.6086 21.25 21.75 17.1086 21.75 12C21.75 6.89137 17.6086 2.75 12.5 2.75ZM1.75 12C1.75 6.06294 6.56294 1.25 12.5 1.25C18.4371 1.25 23.25 6.06294 23.25 12C23.25 17.9371 18.4371 22.75 12.5 22.75C6.56294 22.75 1.75 17.9371 1.75 12ZM12.5 7.25C12.9142 7.25 13.25 7.58579 13.25 8V11.6893L15.5303 13.9697C15.8232 14.2626 15.8232 14.7374 15.5303 15.0303C15.2374 15.3232 14.7626 15.3232 14.4697 15.0303L11.9697 12.5303C11.829 12.3897 11.75 12.1989 11.75 12V8C11.75 7.58579 12.0858 7.25 12.5 7.25Z" fill="currentColor"/>
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