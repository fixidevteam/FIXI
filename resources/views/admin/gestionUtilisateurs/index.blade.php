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
                                href="{{ route('admin.gestionUtilisateurs.index') }}"
                                class="inline-flex items-center text-sm font-medium text-gray-700   ">
                                Gestion des utilisateurs
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
                    <h2 class="text-2xl font-bold leading-9 tracking-tight text-gray-900">Liste d'utilisateurs</h2>
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
                        @if($users->isEmpty())
                        <p class="p-4 text-gray-500 text-center">Aucune utilisateur disponible.</p>
                        @else
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <caption class="sr-only">Liste des utilisateurs</caption>
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
                                        status
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($users as $user)
                                <tr class="bg-white border-b">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        {{ $user->name }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $user->email }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $user->telephone }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($user->status)
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
                                        <form action="{{ route('admin.users.toggleStatus', $user->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="{{ $user->status ? 'rounded-[20px] bg-red-600 px-3 py-1 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-gray-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600' : 'rounded-[20px] bg-green-600 px-3 py-1 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600' }}">
                                                {{ $user->status ? 'Desactiver' : 'Activer' }}
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