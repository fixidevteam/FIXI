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
                                href="{{ route('admin.gestionGarages.index') }}"
                                class="inline-flex items-center text-sm font-medium text-gray-700   ">
                                Gestion des garages
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
                    <div>
                        <a href="{{ route('admin.gestionGarages.create') }}">
                            <x-primary-button class="hidden md:block">Ajouter un garage</x-primary-button>
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
                        x-init="setTimeout(() => show = false, 3000)" 
                        >
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
                                    class="size-6"
                                    >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                    />
                                    </svg>
                                    @else
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 6.25C12.4142 6.25 12.75 6.58579 12.75 7V13C12.75 13.4142 12.4142 13.75 12 13.75C11.5858 13.75 11.25 13.4142 11.25 13V7C11.25 6.58579 11.5858 6.25 12 6.25Z" fill="currentColor"/>
                                        <path d="M12 17C12.5523 17 13 16.5523 13 16C13 15.4477 12.5523 15 12 15C11.4477 15 11 15.4477 11 16C11 16.5523 11.4477 17 12 17Z" fill="currentColor"/>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M1.25 12C1.25 6.06294 6.06294 1.25 12 1.25C17.9371 1.25 22.75 6.06294 22.75 12C22.75 17.9371 17.9371 22.75 12 22.75C6.06294 22.75 1.25 17.9371 1.25 12ZM12 2.75C6.89137 2.75 2.75 6.89137 2.75 12C2.75 17.1086 6.89137 21.25 12 21.25C17.1086 21.25 21.25 17.1086 21.25 12C21.25 6.89137 17.1086 2.75 12 2.75Z" fill="currentColor"/>
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
                        @if($garages->isEmpty())
                        <p class="p-4 text-gray-500 text-center">Aucun garage disponible.</p>
                        @else
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <caption class="sr-only">Liste des garages</caption>
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        garage
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        ref
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        ville
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        quartier
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        localisation
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Créé par
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        virtual garage
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($garages as $garage)
                                <tr class="bg-white border-b">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        {{ $garage->name }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $garage->ref }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $garage->ville ?? 'N/A'}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $garage->quartier ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $garage->localisation ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="{{ $garage->user_id ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }} text-xs font-medium me-2 px-2.5 py-0.5 rounded-full">
                                            {{ $garage->user_id ? 'utilisateur' : 'administrateur' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        {!! 
                                            $garage->virtualGarage 
                                                ? '<a  href="'.$garage->virtualGarage.'" target="_blank"><svg class="w-5 h-5 text-gray-500 transition duration-75 hover:text-gray-900" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8.88558 3.36262C11.8283 0.545795 16.5864 0.545795 19.5291 3.36262C22.4903 6.19714 22.4903 10.807 19.5291 13.6415L11.581 21.2495C9.49097 23.2502 6.11532 23.2502 4.02525 21.2495C1.91669 19.2312 1.91669 15.9446 4.02525 13.9263L11.859 6.42771C13.0964 5.24324 15.0896 5.24325 16.327 6.42771C17.5829 7.62989 17.5829 9.59316 16.327 10.7953L8.43612 18.3486C8.13689 18.635 7.66213 18.6247 7.37571 18.3254C7.08929 18.0262 7.09967 17.5515 7.39889 17.265L15.2898 9.71175C15.9286 9.10021 15.9286 8.12285 15.2898 7.5113C14.6324 6.88205 13.5536 6.88205 12.8962 7.5113L5.06248 15.0098C3.57095 16.4376 3.57095 18.7382 5.06248 20.1659C6.57251 21.6114 9.03377 21.6114 10.5438 20.1659L18.4919 12.5579C20.836 10.314 20.836 6.6901 18.4919 4.4462C16.1292 2.1846 12.2855 2.1846 9.9228 4.4462L3.51861 10.5764C3.21939 10.8628 2.74463 10.8524 2.45821 10.5532C2.17179 10.254 2.18216 9.77924 2.48139 9.49281L8.88558 3.36262Z" fill="currentColor"/>
                                                    </svg></a>'
                                                : 'N/A' 
                                        !!}
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('admin.gestionGarages.show',$garage->id) }}" class="font-medium capitalize text-blue-600 dark:text-blue-500 hover:underline">détails</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
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
</x-admin-app-layout>