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
                                href="{{ route('admin.gestionGaragistes.index') }}"
                                class="inline-flex items-center text-sm font-medium text-gray-700   ">
                                Gestion des garagistes
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
                    <h2 class="text-2xl font-bold leading-9 tracking-tight text-gray-900">Liste des garagistes</h2>
                    <div>
                        <a href="{{ route('admin.gestionGaragistes.create') }}">
                            <x-primary-button class="hidden md:block">Ajouter un garagiste</x-primary-button>
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
                                </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    {{-- alert close --}}
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        @if($mechanics->isEmpty())
                        <p class="p-4 text-gray-500 text-center">Aucun garagiste disponible.</p>
                        @else
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <caption class="sr-only">Liste des garagiste</caption>
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        nom complet
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        email
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        tel
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        garage
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        status
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($mechanics as $mechanic)
                                <tr class="bg-white border-b">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        {{ $mechanic->name }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $mechanic->email }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $mechanic->telephone ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $mechanic->garage->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($mechanic->status)
                                        <span class="inline-flex items-center bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                            <span class="w-2 h-2 me-1 bg-green-500 rounded-full"></span>
                                            Active
                                        </span>
                                        @else
                                        <span class="inline-flex items-center bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                            <span class="w-2 h-2 me-1 bg-red-500 rounded-full"></span>
                                            Inactive
                                        </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <form action="{{ route('admin.garagiste.toggleStatus', $mechanic->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="{{ $mechanic->status ? 'rounded-[20px] bg-red-600 px-3 py-1 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-gray-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600' : 'rounded-[20px] bg-green-600 px-3 py-1 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600' }}">
                                                {{ $mechanic->status ? 'Desactiver' : 'Activer' }}
                                            </button>
                                        </form>
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