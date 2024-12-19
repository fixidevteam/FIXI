<div>
    <!-- Navbar -->
    <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start">
                    <button
                        type="button"
                        class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
                        id="sidebarToggle">
                        <span class="sr-only">Open sidebar</span>
                        <svg
                            class="w-6 h-6"
                            aria-hidden="true"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                clip-rule="evenodd"
                                fill-rule="evenodd"
                                d="M2 4.75A.75.75 0 012.75
    4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                        </svg>
                    </button>
                    {{-- logo --}}
                    <div class="shrink-0 flex items-center">
                        <a href="{{ route('dashboard') }}">
                            <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                        </a>
                    </div>
                    {{-- logo end --}}
                </div>
                {{-- avatar start --}}
                <div class="flex items-center">
                    <div class="flex items-center ms-3">
                        <!-- Settings Dropdown -->
                        <div class="flex sm:items-center sm:ms-6">
                            <div class="relative inline-block">
                                <!-- Notification Icon -->
                                <button onclick="toggleDropdown()" class="p-2 rounded-full focus:outline-none">
                                    @if(Auth::user()->unreadNotifications->isNotEmpty())
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12 1.25C7.71983 1.25 4.25004 4.71979 4.25004 9V9.7041C4.25004 10.401 4.04375 11.0824 3.65717 11.6622L2.50856 13.3851C1.17547 15.3848 2.19318 18.1028 4.51177 18.7351C5.26738 18.9412 6.02937 19.1155 6.79578 19.2581L6.79768 19.2632C7.56667 21.3151 9.62198 22.75 12 22.75C14.378 22.75 16.4333 21.3151 17.2023 19.2632L17.2042 19.2581C17.9706 19.1155 18.7327 18.9412 19.4883 18.7351C21.8069 18.1028 22.8246 15.3848 21.4915 13.3851L20.3429 11.6622C19.9563 11.0824 19.75 10.401 19.75 9.7041V9C19.75 4.71979 16.2802 1.25 12 1.25ZM15.3764 19.537C13.1335 19.805 10.8664 19.8049 8.62349 19.5369C9.33444 20.5585 10.571 21.25 12 21.25C13.4289 21.25 14.6655 20.5585 15.3764 19.537ZM5.75004 9C5.75004 5.54822 8.54826 2.75 12 2.75C15.4518 2.75 18.25 5.54822 18.25 9V9.7041C18.25 10.6972 18.544 11.668 19.0948 12.4943L20.2434 14.2172C21.0086 15.3649 20.4245 16.925 19.0936 17.288C14.4494 18.5546 9.5507 18.5546 4.90644 17.288C3.57561 16.925 2.99147 15.3649 3.75664 14.2172L4.90524 12.4943C5.45609 11.668 5.75004 10.6972 5.75004 9.7041V9Z" fill="#1C274C" />
                                        <circle cx="18.5" cy="5.5" r="2.5" fill="#DC2626" />
                                    </svg>
                                    @else
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12 1.25C7.71983 1.25 4.25004 4.71979 4.25004 9V9.7041C4.25004 10.401 4.04375 11.0824 3.65717 11.6622L2.50856 13.3851C1.17547 15.3848 2.19318 18.1028 4.51177 18.7351C5.26738 18.9412 6.02937 19.1155 6.79578 19.2581L6.79768 19.2632C7.56667 21.3151 9.62198 22.75 12 22.75C14.378 22.75 16.4333 21.3151 17.2023 19.2632L17.2042 19.2581C17.9706 19.1155 18.7327 18.9412 19.4883 18.7351C21.8069 18.1028 22.8246 15.3848 21.4915 13.3851L20.3429 11.6622C19.9563 11.0824 19.75 10.401 19.75 9.7041V9C19.75 4.71979 16.2802 1.25 12 1.25ZM15.3764 19.537C13.1335 19.805 10.8664 19.8049 8.62349 19.5369C9.33444 20.5585 10.571 21.25 12 21.25C13.4289 21.25 14.6655 20.5585 15.3764 19.537ZM5.75004 9C5.75004 5.54822 8.54826 2.75 12 2.75C15.4518 2.75 18.25 5.54822 18.25 9V9.7041C18.25 10.6972 18.544 11.668 19.0948 12.4943L20.2434 14.2172C21.0086 15.3649 20.4245 16.925 19.0936 17.288C14.4494 18.5546 9.5507 18.5546 4.90644 17.288C3.57561 16.925 2.99147 15.3649 3.75664 14.2172L4.90524 12.4943C5.45609 11.668 5.75004 10.6972 5.75004 9.7041V9Z" fill="#1C274C" />
                                    </svg>
                                    @endif
                                </button>


                                <!-- Dropdown -->
                                <div id="dropdown-menu" class="hidden absolute -right-[78px] md:right-0 mt-2 w-80 bg-white border border-gray-200 rounded-lg shadow-lg z-50">
                                    <!-- Notifications -->
                                    <p class="px-4 py-2 text-sm font-bold text-gray-700 border-b ">
                                        Notifications
                                    </p>
                                    <div class="py-2  overflow-y-auto">
                                        @foreach(Auth::user()->notifications->take(3) as $notification)
                                        <a href="{{route('notifications.markAsRead',$notification->id)}}" class="flex items-center gap-4  px-6 py-4 text-sm border-b {{ $notification->read_at ? 'bg-gray-100' : 'bg-white' }}">
                                            <!-- Icon -->
                                            <div class="flex-shrink-0">
                                                <svg class="text-yellow-500" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M12 7.25C12.4142 7.25 12.75 7.58579 12.75 8V12C12.75 12.4142 12.4142 12.75 12 12.75C11.5858 12.75 11.25 12.4142 11.25 12V8C11.25 7.58579 11.5858 7.25 12 7.25Z" fill="currentColor" />
                                                    <path d="M12 16C12.5523 16 13 15.5523 13 15C13 14.4477 12.5523 14 12 14C11.4477 14 11 14.4477 11 15C11 15.5523 11.4477 16 12 16Z" fill="currentColor" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M8.72339 2.05112C10.1673 1.55658 11.0625 1.25 12 1.25C12.9375 1.25 13.8327 1.55658 15.2766 2.05112L16.004 2.30013C17.4854 2.8072 18.6286 3.19852 19.447 3.53099C19.8592 3.69846 20.2136 3.86067 20.499 4.02641C20.7737 4.1859 21.0492 4.38484 21.2364 4.65154C21.4214 4.91516 21.5171 5.23924 21.5772 5.55122C21.6397 5.87556 21.6774 6.26464 21.7017 6.71136C21.75 7.5984 21.75 8.81361 21.75 10.3898V11.9914C21.75 18.0924 17.142 21.0175 14.4017 22.2146L14.3746 22.2264C14.0348 22.3749 13.7154 22.5144 13.3484 22.6084C12.9609 22.7076 12.5493 22.75 12 22.75C11.4507 22.75 11.0391 22.7076 10.6516 22.6084C10.2846 22.5144 9.96523 22.3749 9.62543 22.2264L9.59833 22.2146C6.85803 21.0175 2.25 18.0924 2.25 11.9914V10.3899C2.25 8.81366 2.25 7.59841 2.2983 6.71136C2.32262 6.26464 2.36031 5.87556 2.42281 5.55122C2.48293 5.23924 2.5786 4.91516 2.76363 4.65154C2.95082 4.38484 3.22634 4.1859 3.50098 4.02641C3.78637 3.86067 4.14078 3.69846 4.55303 3.53099C5.3714 3.19852 6.51462 2.8072 7.99595 2.30014L8.72339 2.05112ZM12 2.75C11.3423 2.75 10.6951 2.96164 9.08062 3.5143L8.5078 3.71037C6.99521 4.22814 5.8921 4.60605 5.11759 4.92069C4.731 5.07774 4.4509 5.20935 4.25429 5.32353C4.15722 5.3799 4.09034 5.42642 4.04567 5.46273C4.0078 5.49351 3.99336 5.51095 3.99129 5.51349C3.98936 5.51663 3.97693 5.5374 3.95943 5.58654C3.93944 5.64265 3.91729 5.72309 3.89571 5.83506C3.85204 6.06169 3.81894 6.37301 3.79608 6.79292C3.75028 7.63411 3.75 8.80833 3.75 10.4167V11.9914C3.75 17.1665 7.6199 19.7135 10.1988 20.84C10.5703 21.0023 10.7848 21.0941 11.0236 21.1552C11.2517 21.2136 11.53 21.25 12 21.25C12.47 21.25 12.7483 21.2136 12.9764 21.1552C13.2152 21.0941 13.4297 21.0023 13.8012 20.84C16.3801 19.7135 20.25 17.1665 20.25 11.9914V10.4167C20.25 8.80833 20.2497 7.63411 20.2039 6.79292C20.1811 6.37301 20.148 6.06169 20.1043 5.83506C20.0827 5.72309 20.0606 5.64265 20.0406 5.58654C20.0231 5.53737 20.0106 5.5166 20.0087 5.51348C20.0066 5.51092 19.9922 5.49349 19.9543 5.46273C19.9097 5.42642 19.8428 5.3799 19.7457 5.32353C19.5491 5.20935 19.269 5.07774 18.8824 4.92069C18.1079 4.60605 17.0048 4.22814 15.4922 3.71037L14.9194 3.5143C13.3049 2.96164 12.6577 2.75 12 2.75Z" fill="currentColor" />
                                                </svg>

                                            </div>
                                            <!-- Notification Message -->
                                            <div class="flex-1 text-gray-800">
                                                {{ $notification->data['message'] }}
                                                <small class="text-gray-500 block">{{ $notification->created_at->diffForHumans() }}</small>
                                            </div>
                                            
                                        </a>
                                        @endforeach
                                    </div>
                                    <a href="{{route('notifications.index')}}" class="block text-center w-full py-2 text-sm font-medium text-blue-500 hover:text-blue-700 rounded-b-lg">Afficher tous</a>
                                </div>

                            </div>

                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                        <div>
                                            <svg class="md:hidden" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M8.25 9C8.25 6.92893 9.92893 5.25 12 5.25C14.0711 5.25 15.75 6.92893 15.75 9C15.75 11.0711 14.0711 12.75 12 12.75C9.92893 12.75 8.25 11.0711 8.25 9ZM12 6.75C10.7574 6.75 9.75 7.75736 9.75 9C9.75 10.2426 10.7574 11.25 12 11.25C13.2426 11.25 14.25 10.2426 14.25 9C14.25 7.75736 13.2426 6.75 12 6.75Z" fill="#1C274C" />
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M1.25 12C1.25 6.06294 6.06294 1.25 12 1.25C17.9371 1.25 22.75 6.06294 22.75 12C22.75 17.9371 17.9371 22.75 12 22.75C6.06294 22.75 1.25 17.9371 1.25 12ZM12 2.75C6.89137 2.75 2.75 6.89137 2.75 12C2.75 14.5456 3.77827 16.851 5.4421 18.5235C5.6225 17.5504 5.97694 16.6329 6.68837 15.8951C7.75252 14.7915 9.45416 14.25 12 14.25C14.5457 14.25 16.2474 14.7915 17.3115 15.8951C18.023 16.6329 18.3774 17.5505 18.5578 18.5236C20.2217 16.8511 21.25 14.5456 21.25 12C21.25 6.89137 17.1086 2.75 12 2.75ZM17.1937 19.6554C17.0918 18.4435 16.8286 17.5553 16.2318 16.9363C15.5823 16.2628 14.3789 15.75 12 15.75C9.62099 15.75 8.41761 16.2628 7.76815 16.9363C7.17127 17.5553 6.90811 18.4434 6.80622 19.6553C8.28684 20.6618 10.0747 21.25 12 21.25C13.9252 21.25 15.7131 20.6618 17.1937 19.6554Z" fill="#1C274C" />
                                            </svg>

                                            <div class="hidden md:block">
                                                {{ Auth::user()->name }}
                                            </div>
                                        </div>

                                        <div class="ms-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <x-dropdown-link :href="route('profile.edit')">
                                        {{ __('Profil') }}
                                    </x-dropdown-link>

                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <x-dropdown-link class="text-red-600" :href="route('logout')"
                                            onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                            {{ __('Se déconnecter') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                        <!-- Settings Dropdown close -->
                    </div>
                </div>
                {{-- avatar close --}}
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <aside
        class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform  bg-white border-r border-gray-200 lg:translate-x-0 -translate-x-full"
        id="sidebar"
        aria-label="Sidebar">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-white">
            <div class="flex-1 bg-white divide-y space-y-1">
                <ul class="space-y-2 font-medium pb-2">
                    <li>
                        <a href="{{ route('dashboard') }}" class="flex items-center p-2 text-gray-900 rounded-lg  hover:bg-gray-100 group {{ Route::is('dashboard') ? 'bg-gray-100' : '' }}">
                            <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 {{ Route::is('dashboard') ? 'text-gray-900' : '' }}" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M17.2059 1.85619C16.1431 1.4375 15.116 1.72093 14.389 2.36753C13.6798 2.99824 13.25 3.96989 13.25 5.00003V9.00003C13.25 9.96653 14.0335 10.75 15 10.75H19C20.0301 10.75 21.0018 10.3202 21.6325 9.61103C22.2791 8.884 22.5625 7.85691 22.1438 6.79412C21.2558 4.53992 19.4601 2.74423 17.2059 1.85619ZM14.75 9.00003V5.00003C14.75 4.37331 15.0149 3.8183 15.3858 3.48838C15.7389 3.17435 16.1774 3.06319 16.6561 3.2518C18.5233 3.98737 20.0127 5.47673 20.7482 7.34392C20.9368 7.82268 20.8257 8.26109 20.5117 8.61418C20.1817 8.98514 19.6267 9.25003 19 9.25003H15C14.8619 9.25003 14.75 9.1381 14.75 9.00003Z" fill="currentColor" />
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M10.9953 2.86997C10.3847 2.47444 9.79417 2.36057 9.1457 2.47365C8.59499 2.56967 8.00554 2.83384 7.37816 3.11499L7.31056 3.14528C6.78871 3.37898 6.28506 3.65696 5.80541 3.97745C4.11981 5.10374 2.80604 6.70457 2.03024 8.57751C1.25444 10.4505 1.05146 12.5114 1.44696 14.4997C1.84245 16.488 2.81867 18.3144 4.25216 19.7479C5.68565 21.1813 7.51202 22.1576 9.50033 22.5531C11.4886 22.9486 13.5496 22.7456 15.4225 21.9698C17.2955 21.194 18.8963 19.8802 20.0226 18.1946C20.3431 17.715 20.621 17.2113 20.8547 16.6895L20.885 16.6218C21.1662 15.9945 21.4303 15.405 21.5264 14.8543C21.6394 14.2059 21.5256 13.6153 21.1301 13.0048C20.7036 12.3466 20.1199 12.025 19.406 11.8792C18.7721 11.7498 17.98 11.7499 17.0722 11.75L15.5 11.75C14.536 11.75 13.8884 11.7484 13.4054 11.6835C12.9439 11.6214 12.7464 11.5142 12.6161 11.3839C12.4858 11.2536 12.3786 11.0561 12.3165 10.5946C12.2516 10.1116 12.25 9.46403 12.25 8.50002L12.25 6.92784C12.2501 6.02003 12.2502 5.22795 12.1208 4.59406C11.9751 3.88016 11.6534 3.29637 10.9953 2.86997ZM7.92364 4.51427C8.64284 4.19218 9.05972 4.01127 9.40336 3.95135C9.66896 3.90504 9.87762 3.93318 10.1797 4.12886C10.434 4.29366 10.5687 4.49038 10.6511 4.89407C10.7464 5.36104 10.75 5.99846 10.75 7.00002L10.75 8.55201C10.75 9.45048 10.7499 10.1997 10.8299 10.7945C10.9143 11.4223 11.1 11.9891 11.5555 12.4446C12.0109 12.9 12.5777 13.0857 13.2055 13.1701C13.8003 13.2501 14.5495 13.25 15.448 13.25L17 13.25C18.0016 13.25 18.639 13.2536 19.1059 13.3489C19.5096 13.4313 19.7064 13.566 19.8712 13.8204C20.0668 14.1224 20.095 14.3311 20.0487 14.5967C19.9887 14.9403 19.8078 15.3572 19.4858 16.0764C19.2863 16.5218 19.049 16.9518 18.7754 17.3613C17.8139 18.8002 16.4473 19.9217 14.8485 20.584C13.2496 21.2462 11.4903 21.4195 9.79296 21.0819C8.09563 20.7443 6.53653 19.9109 5.31282 18.6872C4.08911 17.4635 3.25575 15.9044 2.91813 14.2071C2.58051 12.5097 2.75379 10.7504 3.41606 9.15154C4.07833 7.55268 5.19983 6.18612 6.63876 5.22466C7.04824 4.95106 7.47817 4.71376 7.92364 4.51427Z" fill="currentColor" />
                            </svg>
                            <span class="ms-3 first-letter:capitalize">Accueil</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('voiture.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg  hover:bg-gray-100 group {{ Route::is('voiture.index', 'voiture.*') ? 'bg-gray-100 text-gray-900' : '' }}">
                            <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 {{ Route::is('voiture.index', 'voiture.*') ? 'text-gray-900' : '' }}" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2.75C6.89137 2.75 2.75 6.89137 2.75 12C2.75 17.1086 6.89137 21.25 12 21.25C17.1086 21.25 21.25 17.1086 21.25 12C21.25 6.89137 17.1086 2.75 12 2.75ZM1.25 12C1.25 6.06294 6.06294 1.25 12 1.25C17.9371 1.25 22.75 6.06294 22.75 12C22.75 17.9371 17.9371 22.75 12 22.75C6.06294 22.75 1.25 17.9371 1.25 12ZM6.80317 11.25H9.35352C9.47932 10.8052 9.71426 10.4062 10.0276 10.0838L8.75225 7.87485C7.7184 8.68992 6.99837 9.88531 6.80317 11.25ZM10.0507 7.1238L11.3262 9.33314C11.5418 9.27884 11.7676 9.25 12 9.25C12.2324 9.25 12.4581 9.27883 12.6737 9.33312L13.9493 7.12378C13.3466 6.88264 12.6888 6.75 12 6.75C11.3112 6.75 10.6534 6.88265 10.0507 7.1238ZM15.2477 7.87481L13.9724 10.0837C14.2857 10.4062 14.5207 10.8052 14.6465 11.25H17.1968C17.0016 9.88529 16.2816 8.68988 15.2477 7.87481ZM17.1968 12.75H14.6465C14.5207 13.1949 14.2857 13.5939 13.9723 13.9163L15.2477 16.1252C16.2816 15.3102 17.0016 14.1147 17.1968 12.75ZM13.9492 16.8762L12.6736 14.6669C12.4581 14.7212 12.2324 14.75 12 14.75C11.7676 14.75 11.5419 14.7212 11.3263 14.6669L10.0507 16.8762C10.6534 17.1174 11.3112 17.25 12 17.25C12.6888 17.25 13.3465 17.1174 13.9492 16.8762ZM8.75229 16.1252L10.0276 13.9163C9.71428 13.5938 9.47933 13.1948 9.35352 12.75H6.80317C6.99837 14.1147 7.71842 15.3101 8.75229 16.1252ZM11.3859 13.089C11.3823 13.0869 11.3787 13.0847 11.375 13.0826C11.3715 13.0806 11.368 13.0786 11.3645 13.0766C10.9967 12.859 10.75 12.4583 10.75 12C10.75 11.5434 10.9949 11.1439 11.3605 10.9258C11.3653 10.9231 11.3702 10.9204 11.375 10.9176C11.3801 10.9146 11.3851 10.9116 11.3902 10.9086C11.5705 10.8076 11.7785 10.75 12 10.75C12.2204 10.75 12.4275 10.8071 12.6073 10.9072C12.6131 10.9107 12.619 10.9142 12.6249 10.9177C12.6306 10.9209 12.6362 10.9241 12.642 10.9272C13.0062 11.1457 13.25 11.5444 13.25 12C13.25 12.4595 13.0021 12.8611 12.6327 13.0783C12.6301 13.0797 12.6276 13.0812 12.625 13.0827C12.6222 13.0843 12.6194 13.0859 12.6166 13.0876C12.4347 13.191 12.2242 13.25 12 13.25C11.7768 13.25 11.5673 13.1915 11.3859 13.089ZM5.25 12C5.25 8.27208 8.27208 5.25 12 5.25C15.7279 5.25 18.75 8.27208 18.75 12C18.75 15.7279 15.7279 18.75 12 18.75C8.27208 18.75 5.25 15.7279 5.25 12Z" fill="currentColor" />
                            </svg>
                            <span class="ms-3 first-letter:capitalize">mes voitures</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('operation.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg  hover:bg-gray-100 group {{ Route::is('operation.index', 'operation.*') ? 'bg-gray-100 text-gray-900' : '' }}">
                            <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 {{ Route::is('operation.index', 'operation.*') ? 'text-gray-900' : '' }}" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14 20C14 21.1046 13.1046 22 12 22C10.8954 22 10 21.1046 10 20C10 18.8954 10.8954 18 12 18C13.1046 18 14 18.8954 14 20Z" stroke="currentColor" stroke-width="1.5"/>
                                <path d="M6 4C6 3.05719 6 2.58579 6.29289 2.29289C6.58579 2 7.05719 2 8 2H16C16.9428 2 17.4142 2 17.7071 2.29289C18 2.58579 18 3.05719 18 4C18 4.94281 18 5.41421 17.7071 5.70711C17.4142 6 16.9428 6 16 6H8C7.05719 6 6.58579 6 6.29289 5.70711C6 5.41421 6 4.94281 6 4Z" stroke="currentColor" stroke-width="1.5"/>
                                <path d="M8.5 16.5C8.5 15.6716 9.17157 15 10 15H14C14.8284 15 15.5 15.6716 15.5 16.5C15.5 17.3284 14.8284 18 14 18H10C9.17157 18 8.5 17.3284 8.5 16.5Z" stroke="currentColor" stroke-width="1.5"/>
                                <path d="M14 15.5V5.5" stroke="currentColor" stroke-width="1.5"/>
                                <path d="M10 15.5V6" stroke="currentColor" stroke-width="1.5"/>
                                <path d="M8 8L16 10M8 11.5L16 13.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                <path d="M20 11.4994L22 11.4994M4 11.5004H2M19.0713 14.2999L19.7784 14.9999M4.92871 14.2999L4.2216 14.9999M19.0713 8.69984L19.7784 7.99988M4.92871 8.69984L4.2216 7.99988" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                            </svg>                            
                            <span class="ms-3 first-letter:capitalize">Mes opérations</span>
                         </a>
                    </li>
                    <li>
                        <a href="{{ route('paiperPersonnel.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg  hover:bg-gray-100 group {{ Route::is('paiperPersonnel.index', 'paiperPersonnel.*') ? 'bg-gray-100 text-gray-900' : '' }}">
                            <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 {{ Route::is('paiperPersonnel.index', 'paiperPersonnel.*') ? 'text-gray-900' : '' }}" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M16.3939 2.02121L16.4604 2.03904C17.5598 2.33361 18.431 2.56704 19.1162 2.81458C19.8172 3.06779 20.3888 3.35744 20.8597 3.79847C21.5453 4.44068 22.0252 5.27179 22.2385 6.18671C22.385 6.81503 22.3501 7.45486 22.2189 8.18849C22.0906 8.90573 21.8572 9.77697 21.5626 10.8764L21.0271 12.8747C20.7326 13.974 20.4991 14.8452 20.2516 15.5305C19.9984 16.2314 19.7087 16.803 19.2677 17.2739C18.6459 17.9377 17.8471 18.4087 16.9665 18.6316C16.7093 19.2213 16.3336 19.7554 15.8597 20.1993C15.3888 20.6403 14.8172 20.9299 14.1162 21.1832C13.431 21.4307 12.5598 21.6641 11.4605 21.9587L11.394 21.9765C10.2946 22.2711 9.42337 22.5045 8.70613 22.6328C7.9725 22.764 7.33266 22.7989 6.70435 22.6524C5.78943 22.4391 4.95832 21.9592 4.31611 21.2736C3.87508 20.8027 3.58542 20.2311 3.33222 19.5302C3.08468 18.8449 2.85124 17.9737 2.55667 16.8743L2.02122 14.876C1.72664 13.7766 1.4932 12.9054 1.36495 12.1882C1.23376 11.4546 1.19881 10.8147 1.34531 10.1864C1.55864 9.27149 2.03849 8.44038 2.72417 7.79817C3.19505 7.35714 3.76664 7.06749 4.46758 6.81428C5.15283 6.56674 6.02404 6.3333 7.12341 6.03873L7.15665 6.02983C7.42112 5.95896 7.67134 5.89203 7.90825 5.82944C8.29986 4.43031 8.64448 3.44126 9.31611 2.72417C9.95831 2.03849 10.7894 1.55864 11.7043 1.34531C12.3327 1.19881 12.9725 1.23376 13.7061 1.36495C14.4233 1.49319 15.2945 1.72664 16.3939 2.02121ZM7.45502 7.5028C6.36214 7.79571 5.57905 8.00764 4.9772 8.22505C4.36778 8.4452 4.00995 8.64907 3.74955 8.89296C3.2804 9.33237 2.95209 9.90103 2.80613 10.527C2.72511 10.8745 2.72747 11.2863 2.84152 11.9242C2.95723 12.5712 3.17355 13.381 3.47902 14.521L3.99666 16.4529C4.30212 17.5929 4.51967 18.4023 4.74299 19.0205C4.96314 19.63 5.16701 19.9878 5.4109 20.2482C5.85031 20.7173 6.41897 21.0456 7.04496 21.1916C7.39242 21.2726 7.80425 21.2703 8.4421 21.1562C9.08915 21.0405 9.89893 20.8242 11.0389 20.5187C12.1789 20.2132 12.9884 19.9957 13.6066 19.7724C14.216 19.5522 14.5739 19.3484 14.8343 19.1045C14.9719 18.9756 15.0973 18.8357 15.2096 18.6865C15.0306 18.6612 14.8463 18.629 14.6557 18.5911C13.9839 18.4575 13.1769 18.2413 12.1808 17.9744L12.1234 17.959C11.024 17.6644 10.1528 17.431 9.46758 17.1835C8.76664 16.9302 8.19505 16.6406 7.72416 16.1996C7.03849 15.5574 6.55864 14.7262 6.34531 13.8113C6.19881 13.183 6.23376 12.5432 6.36494 11.8095C6.4932 11.0923 6.72664 10.2211 7.02122 9.12174L7.45502 7.5028ZM13.4421 2.84152C12.8042 2.72747 12.3924 2.72511 12.045 2.80613C11.419 2.95209 10.8503 3.2804 10.4109 3.74955C9.97479 4.21518 9.70642 4.93452 9.2397 6.64323C9.16384 6.92093 9.08365 7.22023 8.99665 7.54488L8.47902 9.47673C8.17355 10.6167 7.95723 11.4265 7.84152 12.0736C7.72747 12.7114 7.72511 13.1232 7.80613 13.4707C7.95209 14.0967 8.2804 14.6654 8.74955 15.1048C9.00995 15.3487 9.36778 15.5525 9.9772 15.7727C10.5954 15.996 11.4049 16.2136 12.5449 16.519C13.5703 16.7938 14.3303 16.997 14.9482 17.1199C15.5635 17.2422 15.981 17.2723 16.3232 17.23C16.3976 17.2209 16.4691 17.2082 16.5389 17.1919C17.1649 17.0459 17.7335 16.7176 18.1729 16.2485C18.4168 15.9881 18.6207 15.6303 18.8408 15.0208C19.0642 14.4026 19.2817 13.5932 19.5872 12.4532L20.1048 10.5213C20.4103 9.38129 20.6266 8.57151 20.7423 7.92446C20.8564 7.28661 20.8587 6.87479 20.7777 6.52733C20.6317 5.90133 20.3034 5.33267 19.8343 4.89327C19.5739 4.64937 19.216 4.4455 18.6066 4.22535C17.9884 4.00203 17.1789 3.78448 16.0389 3.47902C14.8989 3.17355 14.0892 2.95723 13.4421 2.84152Z" fill="currentColor" />
                            </svg>
                            <span class="ms-3 first-letter:capitalize">mes papiers personnels</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('garages.index') }}"  class="flex items-center p-2 text-gray-900 rounded-lg  hover:bg-gray-100 group {{ Route::is('garages.index', 'garages.*') ? 'bg-gray-100 text-gray-900' : '' }}">
                            <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 {{ Route::is('garages.index', 'garages.*') ? 'text-gray-900' : '' }}" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M13.4948 4.33224C12.6423 3.57447 11.3577 3.57447 10.5052 4.33224L4.50518 9.66558C4.02483 10.0926 3.75 10.7046 3.75 11.3472V21.2501H5.25L5.25 15.948C5.24997 15.0496 5.24994 14.3004 5.32991 13.7056C5.41432 13.0778 5.59999 12.511 6.05546 12.0555C6.51093 11.6 7.07773 11.4144 7.70552 11.33C8.3003 11.25 9.04952 11.25 9.94801 11.25H14.052C14.9505 11.25 15.6997 11.25 16.2945 11.33C16.9223 11.4144 17.4891 11.6 17.9445 12.0555C18.4 12.511 18.5857 13.0778 18.6701 13.7056C18.7501 14.3004 18.75 15.0496 18.75 15.9481V21.2501H20.25V11.3472C20.25 10.7046 19.9752 10.0926 19.4948 9.66558L13.4948 4.33224ZM21.75 21.2501V11.3472C21.75 10.2761 21.2919 9.25609 20.4914 8.54446L14.4914 3.21113C13.0705 1.94818 10.9295 1.94818 9.50864 3.21113L3.50864 8.54446C2.70805 9.25609 2.25 10.2761 2.25 11.3472V21.2501H2C1.58579 21.2501 1.25 21.5858 1.25 22.0001C1.25 22.4143 1.58579 22.7501 2 22.7501H22C22.4142 22.7501 22.75 22.4143 22.75 22.0001C22.75 21.5858 22.4142 21.2501 22 21.2501H21.75ZM17.25 21.2501V16.0001C17.25 15.036 17.2484 14.3885 17.1835 13.9054C17.1214 13.444 17.0142 13.2465 16.8839 13.1162C16.7536 12.9859 16.5561 12.8786 16.0946 12.8166C15.6116 12.7516 14.964 12.7501 14 12.7501H10C9.03599 12.7501 8.38843 12.7516 7.90539 12.8166C7.44393 12.8786 7.24643 12.9859 7.11612 13.1162C6.9858 13.2465 6.87858 13.444 6.81654 13.9054C6.75159 14.3885 6.75 15.036 6.75 16.0001V21.2501H17.25ZM9.25 9.00005C9.25 8.58584 9.58579 8.25005 10 8.25005H14C14.4142 8.25005 14.75 8.58584 14.75 9.00005C14.75 9.41426 14.4142 9.75005 14 9.75005H10C9.58579 9.75005 9.25 9.41426 9.25 9.00005ZM8.25 15.5001C8.25 15.0858 8.58579 14.7501 9 14.7501H15C15.4142 14.7501 15.75 15.0858 15.75 15.5001C15.75 15.9143 15.4142 16.2501 15 16.2501H9C8.58579 16.2501 8.25 15.9143 8.25 15.5001ZM8.25 18.5001C8.25 18.0858 8.58579 17.7501 9 17.7501H15C15.4142 17.7501 15.75 18.0858 15.75 18.5001C15.75 18.9143 15.4142 19.25 15 19.25H9C8.58579 19.25 8.25 18.9143 8.25 18.5001Z" fill="currentColor"/>
                            </svg>           
                            <span class="ms-3 first-letter:capitalize">listing des garages</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('promotions.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg  hover:bg-gray-100 group {{ Route::is('promotions.index', 'promotions.*') ? 'bg-gray-100 text-gray-900' : '' }}">
                            <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 {{ Route::is('promotions.index', 'promotions.*') ? 'text-gray-900' : '' }}" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M12.0001 2.75C10.7575 2.75 9.75012 3.75736 9.75012 5V5.25988C10.3072 5.24999 10.9184 5.24999 11.5893 5.25H12.411C13.0818 5.24999 13.693 5.24999 14.2501 5.25988V5C14.2501 3.75736 13.2428 2.75 12.0001 2.75ZM15.7501 5.32793V5C15.7501 2.92893 14.0712 1.25 12.0001 1.25C9.92905 1.25 8.25012 2.92893 8.25012 5V5.32793C8.10739 5.34021 7.96947 5.35444 7.83619 5.3709C6.82622 5.49569 5.9936 5.75783 5.2863 6.34483C4.57901 6.93183 4.16792 7.70189 3.85914 8.67156C3.55991 9.61128 3.3334 10.8194 3.04866 12.3381L3.02798 12.4484C2.62618 14.5912 2.30954 16.2799 2.25143 17.6112C2.19187 18.9758 2.39488 20.106 3.16465 21.0335C3.93443 21.961 5.00785 22.3689 6.36005 22.5618C7.67926 22.75 9.39737 22.75 11.5775 22.75H12.4227C14.6028 22.75 16.321 22.75 17.6402 22.5618C18.9924 22.3689 20.0658 21.961 20.8356 21.0335C21.6054 20.106 21.8084 18.9758 21.7488 17.6112C21.6907 16.2799 21.3741 14.5912 20.9723 12.4484L20.9516 12.3381C20.6668 10.8194 20.4403 9.61129 20.1411 8.67156C19.8323 7.70189 19.4212 6.93183 18.7139 6.34483C18.0066 5.75783 17.174 5.49569 16.164 5.3709C16.0308 5.35444 15.8928 5.34021 15.7501 5.32793ZM8.02012 6.85959C7.16458 6.96529 6.64786 7.16413 6.24426 7.49909C5.84065 7.83406 5.54999 8.30528 5.28843 9.12669C5.02057 9.96788 4.80982 11.0846 4.5137 12.6639C4.09798 14.8811 3.8029 16.4647 3.75 17.6766C3.69801 18.8679 3.88907 19.5576 4.31892 20.0756C4.74876 20.5935 5.39151 20.9084 6.57193 21.0768C7.77284 21.2482 9.38371 21.25 11.6395 21.25H12.3607C14.6165 21.25 16.2274 21.2482 17.4283 21.0768C18.6087 20.9084 19.2515 20.5935 19.6813 20.0756C20.1112 19.5576 20.3022 18.8679 20.2502 17.6766C20.1973 16.4647 19.9023 14.8811 19.4865 12.6639C19.1904 11.0846 18.9797 9.96788 18.7118 9.12669C18.4502 8.30528 18.1596 7.83406 17.756 7.49909C17.3524 7.16413 16.8357 6.96529 15.9801 6.85959C15.104 6.75133 13.9675 6.75 12.3607 6.75H11.6395C10.0327 6.75 8.89627 6.75133 8.02012 6.85959ZM14.4984 11.9394C14.808 12.2146 14.8359 12.6887 14.5607 12.9983L11.894 15.9983C11.7613 16.1475 11.5746 16.2377 11.3752 16.2488C11.1758 16.26 10.9802 16.1911 10.8317 16.0575L9.49839 14.8575C9.19051 14.5804 9.16555 14.1062 9.44265 13.7983C9.71974 13.4904 10.194 13.4654 10.5018 13.7425L11.2743 14.4377L13.4396 12.0017C13.7147 11.6921 14.1888 11.6643 14.4984 11.9394Z" fill="currentColor"/>
                            </svg>
                            <span class="ms-3 first-letter:capitalize">listing des promotions</span>
                         </a>
                    </li>
                    <li>
                        <a href="{{route('voiture.create')}}" class="flex items-center p-2 text-gray-900 rounded-lg  hover:bg-gray-100 group">
                            <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12.75 9C12.75 8.58579 12.4142 8.25 12 8.25C11.5858 8.25 11.25 8.58579 11.25 9L11.25 11.25H9C8.58579 11.25 8.25 11.5858 8.25 12C8.25 12.4142 8.58579 12.75 9 12.75H11.25V15C11.25 15.4142 11.5858 15.75 12 15.75C12.4142 15.75 12.75 15.4142 12.75 15L12.75 12.75H15C15.4142 12.75 15.75 12.4142 15.75 12C15.75 11.5858 15.4142 11.25 15 11.25H12.75V9Z" fill="currentColor" />
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M12 1.25C6.06294 1.25 1.25 6.06294 1.25 12C1.25 17.9371 6.06294 22.75 12 22.75C17.9371 22.75 22.75 17.9371 22.75 12C22.75 6.06294 17.9371 1.25 12 1.25ZM2.75 12C2.75 6.89137 6.89137 2.75 12 2.75C17.1086 2.75 21.25 6.89137 21.25 12C21.25 17.1086 17.1086 21.25 12 21.25C6.89137 21.25 2.75 17.1086 2.75 12Z" fill="currentColor" />
                            </svg>
                            <span class="ms-3 first-letter:capitalize">ajouter une voiture</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('paiperPersonnel.create') }}" class="flex items-center p-2 text-gray-900 rounded-lg  hover:bg-gray-100 group">
                            <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12.75 9C12.75 8.58579 12.4142 8.25 12 8.25C11.5858 8.25 11.25 8.58579 11.25 9L11.25 11.25H9C8.58579 11.25 8.25 11.5858 8.25 12C8.25 12.4142 8.58579 12.75 9 12.75H11.25V15C11.25 15.4142 11.5858 15.75 12 15.75C12.4142 15.75 12.75 15.4142 12.75 15L12.75 12.75H15C15.4142 12.75 15.75 12.4142 15.75 12C15.75 11.5858 15.4142 11.25 15 11.25H12.75V9Z" fill="currentColor" />
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M12 1.25C6.06294 1.25 1.25 6.06294 1.25 12C1.25 17.9371 6.06294 22.75 12 22.75C17.9371 22.75 22.75 17.9371 22.75 12C22.75 6.06294 17.9371 1.25 12 1.25ZM2.75 12C2.75 6.89137 6.89137 2.75 12 2.75C17.1086 2.75 21.25 6.89137 21.25 12C21.25 17.1086 17.1086 21.25 12 21.25C6.89137 21.25 2.75 17.1086 2.75 12Z" fill="currentColor" />
                            </svg>
                            <span class="ms-3 first-letter:capitalize">ajouter un papier</span>
                        </a>
                    </li>
                </ul>
                {{-- second list --}}
                <ul class="space-y-2 font-medium pt-2">
                    <li>
                        <form method="POST" action="{{ route('logout') }}" class="flex items-center p-2 text-gray-900 rounded-lg  hover:bg-gray-100  group">
                            <svg class="w-5 h-5 text-red-500 transition duration-75 group-hover:text-red-700" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 3.25C12.4142 3.25 12.75 3.58579 12.75 4C12.75 4.41421 12.4142 4.75 12 4.75C7.99594 4.75 4.75 7.99594 4.75 12C4.75 16.0041 7.99594 19.25 12 19.25C12.4142 19.25 12.75 19.5858 12.75 20C12.75 20.4142 12.4142 20.75 12 20.75C7.16751 20.75 3.25 16.8325 3.25 12C3.25 7.16751 7.16751 3.25 12 3.25Z" fill="currentColor" />
                                <path d="M16.4697 9.53033C16.1768 9.23744 16.1768 8.76256 16.4697 8.46967C16.7626 8.17678 17.2374 8.17678 17.5303 8.46967L20.5303 11.4697C20.8232 11.7626 20.8232 12.2374 20.5303 12.5303L17.5303 15.5303C17.2374 15.8232 16.7626 15.8232 16.4697 15.5303C16.1768 15.2374 16.1768 14.7626 16.4697 14.4697L18.1893 12.75H10C9.58579 12.75 9.25 12.4142 9.25 12C9.25 11.5858 9.58579 11.25 10 11.25H18.1893L16.4697 9.53033Z" fill="currentColor" />
                            </svg>
                            @csrf
                            <button type="submit" class="ms-3 first-letter:capitalize text-red-500 transition duration-75 group-hover:text-red-700">Se déconnecter</button>
                        </form>
                        </form>
                    </li>
                    <li>
                        <a href="https://fixi.ma/a-propos/" target="_blanck" class="flex items-center p-2 text-gray-900 rounded-lg  hover:bg-gray-100  group">
                            <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.75 18.5C12.1642 18.5 12.5 18.1642 12.5 17.75V11.75C12.5 11.3358 12.1642 11 11.75 11C11.3358 11 11 11.3358 11 11.75V17.75C11 18.1642 11.3358 18.5 11.75 18.5Z" fill="currentColor" />
                                <path d="M11.75 7.75C12.3023 7.75 12.75 8.19772 12.75 8.75C12.75 9.30228 12.3023 9.75 11.75 9.75C11.1977 9.75 10.75 9.30228 10.75 8.75C10.75 8.19772 11.1977 7.75 11.75 7.75Z" fill="currentColor" />
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M1 12.75C1 6.81294 5.81294 2 11.75 2C17.6871 2 22.5 6.81294 22.5 12.75C22.5 18.6871 17.6871 23.5 11.75 23.5C5.81294 23.5 1 18.6871 1 12.75ZM11.75 3.5C6.64137 3.5 2.5 7.64137 2.5 12.75C2.5 17.8586 6.64137 22 11.75 22C16.8586 22 21 17.8586 21 12.75C21 7.64137 16.8586 3.5 11.75 3.5Z" fill="currentColor" />
                            </svg>
                            <span class="ms-3 first-letter:capitalize">À propos de nous</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </aside>
    <!-- Overlay (only visible on mobile) -->
    <div id="overlay" class="hidden bg-black bg-opacity-50 fixed inset-0 z-10 md:hidden"></div>
</div>