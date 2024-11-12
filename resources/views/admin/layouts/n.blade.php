<div>
    <!-- Navbar -->
    <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start">
                    <button
                        type="button"
                        class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
                        id="sidebarToggle"
                    >
                        <span class="sr-only">Open sidebar</span>
                        <svg
                            class="w-6 h-6"
                            aria-hidden="true"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                clip-rule="evenodd"
                                fill-rule="evenodd"
                                d="M2 4.75A.75.75 0 012.75
    4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"
                            ></path>
                        </svg>
                    </button>
                    {{-- logo --}}
                    <div class="shrink-0 flex items-center">
                        <a href="{{ route('admin.dashboard') }}">
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
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                        <div>{{ Auth::user()->name }}</div>

                                        <div class="ms-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <x-dropdown-link :href="route('admin.profile.edit')">
                                        {{ __('Profile') }}
                                    </x-dropdown-link>

                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('admin.logout') }}">
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
        aria-label="Sidebar"
    >
        <div class="h-full px-3 pb-4 overflow-y-auto bg-white">
            <div class="flex-1 bg-white divide-y space-y-1">
            <ul class="space-y-2 font-medium pb-2">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center p-2 text-gray-900 rounded-lg  hover:bg-gray-100  group">
                        <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M17.2059 1.85619C16.1431 1.4375 15.116 1.72093 14.389 2.36753C13.6798 2.99824 13.25 3.96989 13.25 5.00003V9.00003C13.25 9.96653 14.0335 10.75 15 10.75H19C20.0301 10.75 21.0018 10.3202 21.6325 9.61103C22.2791 8.884 22.5625 7.85691 22.1438 6.79412C21.2558 4.53992 19.4601 2.74423 17.2059 1.85619ZM14.75 9.00003V5.00003C14.75 4.37331 15.0149 3.8183 15.3858 3.48838C15.7389 3.17435 16.1774 3.06319 16.6561 3.2518C18.5233 3.98737 20.0127 5.47673 20.7482 7.34392C20.9368 7.82268 20.8257 8.26109 20.5117 8.61418C20.1817 8.98514 19.6267 9.25003 19 9.25003H15C14.8619 9.25003 14.75 9.1381 14.75 9.00003Z" fill="currentColor"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M10.9953 2.86997C10.3847 2.47444 9.79417 2.36057 9.1457 2.47365C8.59499 2.56967 8.00554 2.83384 7.37816 3.11499L7.31056 3.14528C6.78871 3.37898 6.28506 3.65696 5.80541 3.97745C4.11981 5.10374 2.80604 6.70457 2.03024 8.57751C1.25444 10.4505 1.05146 12.5114 1.44696 14.4997C1.84245 16.488 2.81867 18.3144 4.25216 19.7479C5.68565 21.1813 7.51202 22.1576 9.50033 22.5531C11.4886 22.9486 13.5496 22.7456 15.4225 21.9698C17.2955 21.194 18.8963 19.8802 20.0226 18.1946C20.3431 17.715 20.621 17.2113 20.8547 16.6895L20.885 16.6218C21.1662 15.9945 21.4303 15.405 21.5264 14.8543C21.6394 14.2059 21.5256 13.6153 21.1301 13.0048C20.7036 12.3466 20.1199 12.025 19.406 11.8792C18.7721 11.7498 17.98 11.7499 17.0722 11.75L15.5 11.75C14.536 11.75 13.8884 11.7484 13.4054 11.6835C12.9439 11.6214 12.7464 11.5142 12.6161 11.3839C12.4858 11.2536 12.3786 11.0561 12.3165 10.5946C12.2516 10.1116 12.25 9.46403 12.25 8.50002L12.25 6.92784C12.2501 6.02003 12.2502 5.22795 12.1208 4.59406C11.9751 3.88016 11.6534 3.29637 10.9953 2.86997ZM7.92364 4.51427C8.64284 4.19218 9.05972 4.01127 9.40336 3.95135C9.66896 3.90504 9.87762 3.93318 10.1797 4.12886C10.434 4.29366 10.5687 4.49038 10.6511 4.89407C10.7464 5.36104 10.75 5.99846 10.75 7.00002L10.75 8.55201C10.75 9.45048 10.7499 10.1997 10.8299 10.7945C10.9143 11.4223 11.1 11.9891 11.5555 12.4446C12.0109 12.9 12.5777 13.0857 13.2055 13.1701C13.8003 13.2501 14.5495 13.25 15.448 13.25L17 13.25C18.0016 13.25 18.639 13.2536 19.1059 13.3489C19.5096 13.4313 19.7064 13.566 19.8712 13.8204C20.0668 14.1224 20.095 14.3311 20.0487 14.5967C19.9887 14.9403 19.8078 15.3572 19.4858 16.0764C19.2863 16.5218 19.049 16.9518 18.7754 17.3613C17.8139 18.8002 16.4473 19.9217 14.8485 20.584C13.2496 21.2462 11.4903 21.4195 9.79296 21.0819C8.09563 20.7443 6.53653 19.9109 5.31282 18.6872C4.08911 17.4635 3.25575 15.9044 2.91813 14.2071C2.58051 12.5097 2.75379 10.7504 3.41606 9.15154C4.07833 7.55268 5.19983 6.18612 6.63876 5.22466C7.04824 4.95106 7.47817 4.71376 7.92364 4.51427Z" fill="currentColor"/>
                        </svg>
                        <span class="ms-3 capitalize">Accueil</span>
                     </a>
                </li>
                <li>
                    <a href="{{ route('admin.gestionUtilisateurs.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg  hover:bg-gray-100  group">
                        <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9 1.25C6.37665 1.25 4.25 3.37665 4.25 6C4.25 8.62335 6.37665 10.75 9 10.75C11.6234 10.75 13.75 8.62335 13.75 6C13.75 3.37665 11.6234 1.25 9 1.25ZM5.75 6C5.75 4.20507 7.20507 2.75 9 2.75C10.7949 2.75 12.25 4.20507 12.25 6C12.25 7.79493 10.7949 9.25 9 9.25C7.20507 9.25 5.75 7.79493 5.75 6Z" fill="currentColor"/>
                            <path d="M15 2.25C14.5858 2.25 14.25 2.58579 14.25 3C14.25 3.41421 14.5858 3.75 15 3.75C16.2426 3.75 17.25 4.75736 17.25 6C17.25 7.24264 16.2426 8.25 15 8.25C14.5858 8.25 14.25 8.58579 14.25 9C14.25 9.41421 14.5858 9.75 15 9.75C17.0711 9.75 18.75 8.07107 18.75 6C18.75 3.92893 17.0711 2.25 15 2.25Z" fill="currentColor"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M3.67815 13.5204C5.07752 12.7208 6.96067 12.25 9 12.25C11.0393 12.25 12.9225 12.7208 14.3219 13.5204C15.7 14.3079 16.75 15.5101 16.75 17C16.75 18.4899 15.7 19.6921 14.3219 20.4796C12.9225 21.2792 11.0393 21.75 9 21.75C6.96067 21.75 5.07752 21.2792 3.67815 20.4796C2.3 19.6921 1.25 18.4899 1.25 17C1.25 15.5101 2.3 14.3079 3.67815 13.5204ZM4.42236 14.8228C3.26701 15.483 2.75 16.2807 2.75 17C2.75 17.7193 3.26701 18.517 4.42236 19.1772C5.55649 19.8253 7.17334 20.25 9 20.25C10.8267 20.25 12.4435 19.8253 13.5776 19.1772C14.733 18.517 15.25 17.7193 15.25 17C15.25 16.2807 14.733 15.483 13.5776 14.8228C12.4435 14.1747 10.8267 13.75 9 13.75C7.17334 13.75 5.55649 14.1747 4.42236 14.8228Z" fill="currentColor"/>
                            <path d="M18.1607 13.2674C17.7561 13.1787 17.3561 13.4347 17.2674 13.8393C17.1787 14.2439 17.4347 14.6439 17.8393 14.7326C18.6317 14.9064 19.2649 15.2048 19.6829 15.5468C20.1014 15.8892 20.25 16.2237 20.25 16.5C20.25 16.7507 20.1294 17.045 19.7969 17.3539C19.462 17.665 18.9475 17.9524 18.2838 18.1523C17.8871 18.2717 17.6624 18.69 17.7818 19.0867C17.9013 19.4833 18.3196 19.708 18.7162 19.5886C19.5388 19.3409 20.2743 18.9578 20.8178 18.4529C21.3637 17.9457 21.75 17.2786 21.75 16.5C21.75 15.6352 21.2758 14.912 20.6328 14.3859C19.9893 13.8593 19.1225 13.4783 18.1607 13.2674Z" fill="currentColor"/>
                        </svg>                            
                        <span class="ms-3 capitalize">Gestion des utilisateurs</span>
                     </a>
                </li>
                <li>
                    <a href="{{ route('admin.gestionGaragistes.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg  hover:bg-gray-100  group">
                        <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M5.42677 1.25002C5.45086 1.25004 5.47528 1.25005 5.50005 1.25005C5.52482 1.25005 5.54924 1.25004 5.57332 1.25002C5.96605 1.24983 6.26904 1.24968 6.53655 1.30289C7.62745 1.51988 8.48021 2.37265 8.69721 3.46355C8.75042 3.73105 8.75027 4.03405 8.75007 4.42677C8.75006 4.45086 8.75005 4.47528 8.75005 4.50005V4.75005H15.25V4.50005C15.25 4.47528 15.25 4.45086 15.25 4.42677C15.2498 4.03405 15.2497 3.73105 15.3029 3.46355C15.5199 2.37265 16.3727 1.51988 17.4635 1.30289C17.7311 1.24968 18.034 1.24983 18.4268 1.25002C18.4509 1.25004 18.4753 1.25005 18.5 1.25005C18.5248 1.25005 18.5492 1.25004 18.5733 1.25002C18.966 1.24983 19.269 1.24968 19.5365 1.30289C20.6274 1.51988 21.4802 2.37265 21.6972 3.46355C21.7504 3.73105 21.7503 4.03404 21.7501 4.42676C21.7501 4.45084 21.75 4.47527 21.75 4.50005V6.50005C21.75 6.52482 21.7501 6.54925 21.7501 6.57334C21.7503 6.96606 21.7504 7.26904 21.6972 7.53654C21.4802 8.62744 20.6274 9.48021 19.5365 9.69721C19.269 9.75042 18.966 9.75027 18.5733 9.75007C18.5492 9.75006 18.5248 9.75005 18.5 9.75005C18.4753 9.75005 18.4509 9.75006 18.4268 9.75007C18.034 9.75027 17.7311 9.75042 17.4635 9.69721C16.3727 9.48021 15.5199 8.62744 15.3029 7.53655C15.2497 7.26904 15.2498 6.96605 15.25 6.57332C15.25 6.54924 15.25 6.52482 15.25 6.50005V6.25005H8.75005V6.50005C8.75005 6.52482 8.75006 6.54924 8.75007 6.57332C8.75027 6.96605 8.75042 7.26904 8.69721 7.53654C8.48021 8.62744 7.62744 9.48021 6.53655 9.69721C6.26904 9.75042 5.96605 9.75027 5.57332 9.75007C5.54924 9.75006 5.52482 9.75005 5.50005 9.75005C5.47528 9.75005 5.45086 9.75006 5.42677 9.75007C5.03405 9.75027 4.73105 9.75042 4.46355 9.69721C3.37265 9.48021 2.51988 8.62744 2.30289 7.53655C2.24968 7.26904 2.24983 6.96605 2.25002 6.57332C2.25004 6.54924 2.25005 6.52482 2.25005 6.50005V4.50005C2.25005 4.47528 2.25004 4.45086 2.25002 4.42677C2.24983 4.03405 2.24968 3.73105 2.30289 3.46355C2.51988 2.37265 3.37265 1.51988 4.46355 1.30289C4.73105 1.24968 5.03405 1.24983 5.42677 1.25002ZM7.25005 4.50005C7.25005 3.99944 7.24641 3.85867 7.22603 3.75618C7.1274 3.26032 6.73977 2.8727 6.24391 2.77407C6.14142 2.75368 6.00065 2.75005 5.50005 2.75005C4.99944 2.75005 4.85867 2.75368 4.75618 2.77407C4.26032 2.8727 3.8727 3.26032 3.77407 3.75618C3.75368 3.85867 3.75005 3.99944 3.75005 4.50005V6.50005C3.75005 7.00065 3.75368 7.14142 3.77407 7.24391C3.8727 7.73977 4.26032 8.1274 4.75618 8.22603C4.85867 8.24641 4.99944 8.25005 5.50005 8.25005C6.00065 8.25005 6.14142 8.24641 6.24391 8.22603C6.73977 8.1274 7.1274 7.73977 7.22603 7.24391C7.24641 7.14142 7.25005 7.00065 7.25005 6.50005V4.50005ZM16.75 6.50005C16.75 7.00065 16.7537 7.14142 16.7741 7.24391C16.8727 7.73977 17.2603 8.1274 17.7562 8.22603C17.8587 8.24641 17.9994 8.25005 18.5 8.25005C19.0007 8.25005 19.1414 8.24641 19.2439 8.22603C19.7398 8.1274 20.1274 7.73977 20.226 7.24391C20.2464 7.14142 20.25 7.00065 20.25 6.50005V4.50005C20.25 3.99944 20.2464 3.85867 20.226 3.75618C20.1274 3.26032 19.7398 2.8727 19.2439 2.77407C19.1414 2.75368 19.0007 2.75005 18.5 2.75005C17.9994 2.75005 17.8587 2.75368 17.7562 2.77407C17.2603 2.8727 16.8727 3.26032 16.7741 3.75618C16.7537 3.85867 16.75 3.99944 16.75 4.50005V6.50005ZM12.3859 8.85693C12.7411 9.07004 12.8563 9.53074 12.6432 9.88592L11.8247 11.25H13.5C13.7703 11.25 14.0196 11.3954 14.1527 11.6305C14.2858 11.8657 14.2822 12.1542 14.1432 12.3859L12.6432 14.8859C12.4301 15.2411 11.9694 15.3563 11.6142 15.1432C11.259 14.9301 11.1438 14.4694 11.3569 14.1142L12.1754 12.75H10.5C10.2298 12.75 9.98053 12.6047 9.8474 12.3696C9.71427 12.1344 9.71791 11.8459 9.85693 11.6142L11.3569 9.11418C11.57 8.75899 12.0307 8.64382 12.3859 8.85693ZM5.42677 14.25C5.45086 14.25 5.47528 14.25 5.50005 14.25C5.52482 14.25 5.54924 14.25 5.57332 14.25C5.96605 14.2498 6.26904 14.2497 6.53655 14.3029C7.62745 14.5199 8.48021 15.3727 8.69721 16.4635C8.75042 16.7311 8.75027 17.034 8.75007 17.4268C8.75006 17.4509 8.75005 17.4753 8.75005 17.5V17.75H15.25V17.5C15.25 17.4753 15.25 17.4509 15.25 17.4268C15.2498 17.034 15.2497 16.7311 15.3029 16.4635C15.5199 15.3727 16.3727 14.5199 17.4635 14.3029C17.7311 14.2497 18.034 14.2498 18.4268 14.25C18.4509 14.25 18.4753 14.25 18.5 14.25C18.5248 14.25 18.5492 14.25 18.5733 14.25C18.966 14.2498 19.269 14.2497 19.5365 14.3029C20.6274 14.5199 21.4802 15.3727 21.6972 16.4635C21.7504 16.7311 21.7503 17.034 21.7501 17.4268C21.7501 17.4508 21.75 17.4753 21.75 17.5V19.5C21.75 19.5248 21.7501 19.5492 21.7501 19.5733C21.7503 19.9661 21.7504 20.269 21.6972 20.5365C21.4802 21.6274 20.6274 22.4802 19.5365 22.6972C19.269 22.7504 18.9661 22.7503 18.5733 22.7501C18.5493 22.7501 18.5248 22.75 18.5 22.75C18.4753 22.75 18.4508 22.7501 18.4268 22.7501C18.034 22.7503 17.7311 22.7504 17.4635 22.6972C16.3727 22.4802 15.5199 21.6274 15.3029 20.5365C15.2497 20.269 15.2498 19.966 15.25 19.5733C15.25 19.5492 15.25 19.5248 15.25 19.5V19.25H8.75005V19.5C8.75005 19.5248 8.75006 19.5492 8.75007 19.5733C8.75027 19.966 8.75042 20.269 8.69721 20.5365C8.48021 21.6274 7.62744 22.4802 6.53655 22.6972C6.26904 22.7504 5.96606 22.7503 5.57334 22.7501C5.54925 22.7501 5.52482 22.75 5.50005 22.75C5.47527 22.75 5.45084 22.7501 5.42676 22.7501C5.03404 22.7503 4.73105 22.7504 4.46355 22.6972C3.37265 22.4802 2.51988 21.6274 2.30289 20.5365C2.24968 20.269 2.24983 19.9661 2.25002 19.5733C2.25004 19.5492 2.25005 19.5248 2.25005 19.5V17.5C2.25005 17.4753 2.25004 17.4509 2.25002 17.4268C2.24983 17.034 2.24968 16.7311 2.30289 16.4635C2.51988 15.3727 3.37265 14.5199 4.46355 14.3029C4.73105 14.2497 5.03405 14.2498 5.42677 14.25ZM7.25005 17.5C7.25005 16.9994 7.24641 16.8587 7.22603 16.7562C7.1274 16.2603 6.73977 15.8727 6.24391 15.7741C6.14142 15.7537 6.00065 15.75 5.50005 15.75C4.99944 15.75 4.85867 15.7537 4.75618 15.7741C4.26032 15.8727 3.8727 16.2603 3.77407 16.7562C3.75368 16.8587 3.75005 16.9994 3.75005 17.5V19.5C3.75005 20.0007 3.75368 20.1414 3.77407 20.2439C3.8727 20.7398 4.26032 21.1274 4.75618 21.226C4.85867 21.2464 4.99944 21.25 5.50005 21.25C6.00065 21.25 6.14142 21.2464 6.24391 21.226C6.73977 21.1274 7.1274 20.7398 7.22603 20.2439C7.24641 20.1414 7.25005 20.0007 7.25005 19.5V17.5ZM16.75 19.5C16.75 20.0007 16.7537 20.1414 16.7741 20.2439C16.8727 20.7398 17.2603 21.1274 17.7562 21.226C17.8587 21.2464 17.9994 21.25 18.5 21.25C19.0007 21.25 19.1414 21.2464 19.2439 21.226C19.7398 21.1274 20.1274 20.7398 20.226 20.2439C20.2464 20.1414 20.25 20.0007 20.25 19.5V17.5C20.25 16.9994 20.2464 16.8587 20.226 16.7562C20.1274 16.2603 19.7398 15.8727 19.2439 15.7741C19.1414 15.7537 19.0007 15.75 18.5 15.75C17.9994 15.75 17.8587 15.7537 17.7562 15.7741C17.2603 15.8727 16.8727 16.2603 16.7741 16.7562C16.7537 16.8587 16.75 16.9994 16.75 17.5V19.5Z" fill="currentColor"/>
                        </svg>     
                        <span class="ms-3 capitalize">Gestion des gargistes</span>
                     </a>
                </li>
                <li>
                    <a href="{{ route('admin.gestionGarages.index') }}"  class="flex items-center p-2 text-gray-900 rounded-lg  hover:bg-gray-100  group">
                        <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M13.4948 4.33224C12.6423 3.57447 11.3577 3.57447 10.5052 4.33224L4.50518 9.66558C4.02483 10.0926 3.75 10.7046 3.75 11.3472V21.2501H5.25L5.25 15.948C5.24997 15.0496 5.24994 14.3004 5.32991 13.7056C5.41432 13.0778 5.59999 12.511 6.05546 12.0555C6.51093 11.6 7.07773 11.4144 7.70552 11.33C8.3003 11.25 9.04952 11.25 9.94801 11.25H14.052C14.9505 11.25 15.6997 11.25 16.2945 11.33C16.9223 11.4144 17.4891 11.6 17.9445 12.0555C18.4 12.511 18.5857 13.0778 18.6701 13.7056C18.7501 14.3004 18.75 15.0496 18.75 15.9481V21.2501H20.25V11.3472C20.25 10.7046 19.9752 10.0926 19.4948 9.66558L13.4948 4.33224ZM21.75 21.2501V11.3472C21.75 10.2761 21.2919 9.25609 20.4914 8.54446L14.4914 3.21113C13.0705 1.94818 10.9295 1.94818 9.50864 3.21113L3.50864 8.54446C2.70805 9.25609 2.25 10.2761 2.25 11.3472V21.2501H2C1.58579 21.2501 1.25 21.5858 1.25 22.0001C1.25 22.4143 1.58579 22.7501 2 22.7501H22C22.4142 22.7501 22.75 22.4143 22.75 22.0001C22.75 21.5858 22.4142 21.2501 22 21.2501H21.75ZM17.25 21.2501V16.0001C17.25 15.036 17.2484 14.3885 17.1835 13.9054C17.1214 13.444 17.0142 13.2465 16.8839 13.1162C16.7536 12.9859 16.5561 12.8786 16.0946 12.8166C15.6116 12.7516 14.964 12.7501 14 12.7501H10C9.03599 12.7501 8.38843 12.7516 7.90539 12.8166C7.44393 12.8786 7.24643 12.9859 7.11612 13.1162C6.9858 13.2465 6.87858 13.444 6.81654 13.9054C6.75159 14.3885 6.75 15.036 6.75 16.0001V21.2501H17.25ZM9.25 9.00005C9.25 8.58584 9.58579 8.25005 10 8.25005H14C14.4142 8.25005 14.75 8.58584 14.75 9.00005C14.75 9.41426 14.4142 9.75005 14 9.75005H10C9.58579 9.75005 9.25 9.41426 9.25 9.00005ZM8.25 15.5001C8.25 15.0858 8.58579 14.7501 9 14.7501H15C15.4142 14.7501 15.75 15.0858 15.75 15.5001C15.75 15.9143 15.4142 16.2501 15 16.2501H9C8.58579 16.2501 8.25 15.9143 8.25 15.5001ZM8.25 18.5001C8.25 18.0858 8.58579 17.7501 9 17.7501H15C15.4142 17.7501 15.75 18.0858 15.75 18.5001C15.75 18.9143 15.4142 19.25 15 19.25H9C8.58579 19.25 8.25 18.9143 8.25 18.5001Z" fill="currentColor"/>
                        </svg>           
                        <span class="ms-3 capitalize">Gestion des garages</span>
                     </a>
                </li>
                <li>
                    <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg  hover:bg-gray-100  group">
                        <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14 20C14 21.1046 13.1046 22 12 22C10.8954 22 10 21.1046 10 20C10 18.8954 10.8954 18 12 18C13.1046 18 14 18.8954 14 20Z" stroke="currentColor" stroke-width="1.5"/>
                            <path d="M6 4C6 3.05719 6 2.58579 6.29289 2.29289C6.58579 2 7.05719 2 8 2H16C16.9428 2 17.4142 2 17.7071 2.29289C18 2.58579 18 3.05719 18 4C18 4.94281 18 5.41421 17.7071 5.70711C17.4142 6 16.9428 6 16 6H8C7.05719 6 6.58579 6 6.29289 5.70711C6 5.41421 6 4.94281 6 4Z" stroke="currentColor" stroke-width="1.5"/>
                            <path d="M8.5 16.5C8.5 15.6716 9.17157 15 10 15H14C14.8284 15 15.5 15.6716 15.5 16.5C15.5 17.3284 14.8284 18 14 18H10C9.17157 18 8.5 17.3284 8.5 16.5Z" stroke="currentColor" stroke-width="1.5"/>
                            <path d="M14 15.5V5.5" stroke="currentColor" stroke-width="1.5"/>
                            <path d="M10 15.5V6" stroke="currentColor" stroke-width="1.5"/>
                            <path d="M8 8L16 10M8 11.5L16 13.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                            <path d="M20 11.4994L22 11.4994M4 11.5004H2M19.0713 14.2999L19.7784 14.9999M4.92871 14.2999L4.2216 14.9999M19.0713 8.69984L19.7784 7.99988M4.92871 8.69984L4.2216 7.99988" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                        </svg>   
                        <span class="ms-3 capitalize">Gestion des operations</span>
                     </a>
                </li>
                <li>
                    <a href="{{ route('admin.profile.edit') }}" class="flex items-center p-2 text-gray-900 rounded-lg  hover:bg-gray-100  group">
                        <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2.75C6.89137 2.75 2.75 6.89137 2.75 12C2.75 17.1086 6.89137 21.25 12 21.25C17.1086 21.25 21.25 17.1086 21.25 12C21.25 6.89137 17.1086 2.75 12 2.75ZM1.25 12C1.25 6.06294 6.06294 1.25 12 1.25C17.9371 1.25 22.75 6.06294 22.75 12C22.75 17.9371 17.9371 22.75 12 22.75C6.06294 22.75 1.25 17.9371 1.25 12ZM6.80317 11.25H9.35352C9.47932 10.8052 9.71426 10.4062 10.0276 10.0838L8.75225 7.87485C7.7184 8.68992 6.99837 9.88531 6.80317 11.25ZM10.0507 7.1238L11.3262 9.33314C11.5418 9.27884 11.7676 9.25 12 9.25C12.2324 9.25 12.4581 9.27883 12.6737 9.33312L13.9493 7.12378C13.3466 6.88264 12.6888 6.75 12 6.75C11.3112 6.75 10.6534 6.88265 10.0507 7.1238ZM15.2477 7.87481L13.9724 10.0837C14.2857 10.4062 14.5207 10.8052 14.6465 11.25H17.1968C17.0016 9.88529 16.2816 8.68988 15.2477 7.87481ZM17.1968 12.75H14.6465C14.5207 13.1949 14.2857 13.5939 13.9723 13.9163L15.2477 16.1252C16.2816 15.3102 17.0016 14.1147 17.1968 12.75ZM13.9492 16.8762L12.6736 14.6669C12.4581 14.7212 12.2324 14.75 12 14.75C11.7676 14.75 11.5419 14.7212 11.3263 14.6669L10.0507 16.8762C10.6534 17.1174 11.3112 17.25 12 17.25C12.6888 17.25 13.3465 17.1174 13.9492 16.8762ZM8.75229 16.1252L10.0276 13.9163C9.71428 13.5938 9.47933 13.1948 9.35352 12.75H6.80317C6.99837 14.1147 7.71842 15.3101 8.75229 16.1252ZM11.3859 13.089C11.3823 13.0869 11.3787 13.0847 11.375 13.0826C11.3715 13.0806 11.368 13.0786 11.3645 13.0766C10.9967 12.859 10.75 12.4583 10.75 12C10.75 11.5434 10.9949 11.1439 11.3605 10.9258C11.3653 10.9231 11.3702 10.9204 11.375 10.9176C11.3801 10.9146 11.3851 10.9116 11.3902 10.9086C11.5705 10.8076 11.7785 10.75 12 10.75C12.2204 10.75 12.4275 10.8071 12.6073 10.9072C12.6131 10.9107 12.619 10.9142 12.6249 10.9177C12.6306 10.9209 12.6362 10.9241 12.642 10.9272C13.0062 11.1457 13.25 11.5444 13.25 12C13.25 12.4595 13.0021 12.8611 12.6327 13.0783C12.6301 13.0797 12.6276 13.0812 12.625 13.0827C12.6222 13.0843 12.6194 13.0859 12.6166 13.0876C12.4347 13.191 12.2242 13.25 12 13.25C11.7768 13.25 11.5673 13.1915 11.3859 13.089ZM5.25 12C5.25 8.27208 8.27208 5.25 12 5.25C15.7279 5.25 18.75 8.27208 18.75 12C18.75 15.7279 15.7279 18.75 12 18.75C8.27208 18.75 5.25 15.7279 5.25 12Z" fill="currentColor"/>
                        </svg>                            
                        <span class="ms-3 capitalize">Gestion papiers voitures</span>
                     </a>
                </li>
                <li>
                    <a href="{{ route('admin.profile.edit') }}" class="flex items-center p-2 text-gray-900 rounded-lg  hover:bg-gray-100  group">
                        <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M16.3939 2.02121L16.4604 2.03904C17.5598 2.33361 18.431 2.56704 19.1162 2.81458C19.8172 3.06779 20.3888 3.35744 20.8597 3.79847C21.5453 4.44068 22.0252 5.27179 22.2385 6.18671C22.385 6.81503 22.3501 7.45486 22.2189 8.18849C22.0906 8.90573 21.8572 9.77697 21.5626 10.8764L21.0271 12.8747C20.7326 13.974 20.4991 14.8452 20.2516 15.5305C19.9984 16.2314 19.7087 16.803 19.2677 17.2739C18.6459 17.9377 17.8471 18.4087 16.9665 18.6316C16.7093 19.2213 16.3336 19.7554 15.8597 20.1993C15.3888 20.6403 14.8172 20.9299 14.1162 21.1832C13.431 21.4307 12.5598 21.6641 11.4605 21.9587L11.394 21.9765C10.2946 22.2711 9.42337 22.5045 8.70613 22.6328C7.9725 22.764 7.33266 22.7989 6.70435 22.6524C5.78943 22.4391 4.95832 21.9592 4.31611 21.2736C3.87508 20.8027 3.58542 20.2311 3.33222 19.5302C3.08468 18.8449 2.85124 17.9737 2.55667 16.8743L2.02122 14.876C1.72664 13.7766 1.4932 12.9054 1.36495 12.1882C1.23376 11.4546 1.19881 10.8147 1.34531 10.1864C1.55864 9.27149 2.03849 8.44038 2.72417 7.79817C3.19505 7.35714 3.76664 7.06749 4.46758 6.81428C5.15283 6.56674 6.02404 6.3333 7.12341 6.03873L7.15665 6.02983C7.42112 5.95896 7.67134 5.89203 7.90825 5.82944C8.29986 4.43031 8.64448 3.44126 9.31611 2.72417C9.95831 2.03849 10.7894 1.55864 11.7043 1.34531C12.3327 1.19881 12.9725 1.23376 13.7061 1.36495C14.4233 1.49319 15.2945 1.72664 16.3939 2.02121ZM7.45502 7.5028C6.36214 7.79571 5.57905 8.00764 4.9772 8.22505C4.36778 8.4452 4.00995 8.64907 3.74955 8.89296C3.2804 9.33237 2.95209 9.90103 2.80613 10.527C2.72511 10.8745 2.72747 11.2863 2.84152 11.9242C2.95723 12.5712 3.17355 13.381 3.47902 14.521L3.99666 16.4529C4.30212 17.5929 4.51967 18.4023 4.74299 19.0205C4.96314 19.63 5.16701 19.9878 5.4109 20.2482C5.85031 20.7173 6.41897 21.0456 7.04496 21.1916C7.39242 21.2726 7.80425 21.2703 8.4421 21.1562C9.08915 21.0405 9.89893 20.8242 11.0389 20.5187C12.1789 20.2132 12.9884 19.9957 13.6066 19.7724C14.216 19.5522 14.5739 19.3484 14.8343 19.1045C14.9719 18.9756 15.0973 18.8357 15.2096 18.6865C15.0306 18.6612 14.8463 18.629 14.6557 18.5911C13.9839 18.4575 13.1769 18.2413 12.1808 17.9744L12.1234 17.959C11.024 17.6644 10.1528 17.431 9.46758 17.1835C8.76664 16.9302 8.19505 16.6406 7.72416 16.1996C7.03849 15.5574 6.55864 14.7262 6.34531 13.8113C6.19881 13.183 6.23376 12.5432 6.36494 11.8095C6.4932 11.0923 6.72664 10.2211 7.02122 9.12174L7.45502 7.5028ZM13.4421 2.84152C12.8042 2.72747 12.3924 2.72511 12.045 2.80613C11.419 2.95209 10.8503 3.2804 10.4109 3.74955C9.97479 4.21518 9.70642 4.93452 9.2397 6.64323C9.16384 6.92093 9.08365 7.22023 8.99665 7.54488L8.47902 9.47673C8.17355 10.6167 7.95723 11.4265 7.84152 12.0736C7.72747 12.7114 7.72511 13.1232 7.80613 13.4707C7.95209 14.0967 8.2804 14.6654 8.74955 15.1048C9.00995 15.3487 9.36778 15.5525 9.9772 15.7727C10.5954 15.996 11.4049 16.2136 12.5449 16.519C13.5703 16.7938 14.3303 16.997 14.9482 17.1199C15.5635 17.2422 15.981 17.2723 16.3232 17.23C16.3976 17.2209 16.4691 17.2082 16.5389 17.1919C17.1649 17.0459 17.7335 16.7176 18.1729 16.2485C18.4168 15.9881 18.6207 15.6303 18.8408 15.0208C19.0642 14.4026 19.2817 13.5932 19.5872 12.4532L20.1048 10.5213C20.4103 9.38129 20.6266 8.57151 20.7423 7.92446C20.8564 7.28661 20.8587 6.87479 20.7777 6.52733C20.6317 5.90133 20.3034 5.33267 19.8343 4.89327C19.5739 4.64937 19.216 4.4455 18.6066 4.22535C17.9884 4.00203 17.1789 3.78448 16.0389 3.47902C14.8989 3.17355 14.0892 2.95723 13.4421 2.84152Z" fill="currentColor"/>
                        </svg>                            
                        <span class="ms-3 capitalize">Gestion papiers pesonnels</span>
                     </a>
                </li>
            </ul>
            {{-- second list --}}
            <ul class="space-y-2 font-medium pt-2">
                <li>
                    <form method="POST" action="{{ route('admin.logout') }}" class="flex items-center p-2 text-gray-900 rounded-lg  hover:bg-gray-100  group">
                        <svg class="w-5 h-5 text-red-500 transition duration-75 group-hover:text-red-700" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 3.25C12.4142 3.25 12.75 3.58579 12.75 4C12.75 4.41421 12.4142 4.75 12 4.75C7.99594 4.75 4.75 7.99594 4.75 12C4.75 16.0041 7.99594 19.25 12 19.25C12.4142 19.25 12.75 19.5858 12.75 20C12.75 20.4142 12.4142 20.75 12 20.75C7.16751 20.75 3.25 16.8325 3.25 12C3.25 7.16751 7.16751 3.25 12 3.25Z" fill="currentColor"/>
                            <path d="M16.4697 9.53033C16.1768 9.23744 16.1768 8.76256 16.4697 8.46967C16.7626 8.17678 17.2374 8.17678 17.5303 8.46967L20.5303 11.4697C20.8232 11.7626 20.8232 12.2374 20.5303 12.5303L17.5303 15.5303C17.2374 15.8232 16.7626 15.8232 16.4697 15.5303C16.1768 15.2374 16.1768 14.7626 16.4697 14.4697L18.1893 12.75H10C9.58579 12.75 9.25 12.4142 9.25 12C9.25 11.5858 9.58579 11.25 10 11.25H18.1893L16.4697 9.53033Z" fill="currentColor"/>
                        </svg>
                            @csrf
                            <button type="submit" class="ms-3 capitalize text-red-500 transition duration-75 group-hover:text-red-700">Se déconnecter</button>
                        </form>
                     </form>
                </li>
                <li>
                    <a href="https://fixi.ma/a-propos/" target="_blanck" class="flex items-center p-2 text-gray-900 rounded-lg  hover:bg-gray-100  group">
                        <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.75 18.5C12.1642 18.5 12.5 18.1642 12.5 17.75V11.75C12.5 11.3358 12.1642 11 11.75 11C11.3358 11 11 11.3358 11 11.75V17.75C11 18.1642 11.3358 18.5 11.75 18.5Z" fill="currentColor"/>
                            <path d="M11.75 7.75C12.3023 7.75 12.75 8.19772 12.75 8.75C12.75 9.30228 12.3023 9.75 11.75 9.75C11.1977 9.75 10.75 9.30228 10.75 8.75C10.75 8.19772 11.1977 7.75 11.75 7.75Z" fill="currentColor"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M1 12.75C1 6.81294 5.81294 2 11.75 2C17.6871 2 22.5 6.81294 22.5 12.75C22.5 18.6871 17.6871 23.5 11.75 23.5C5.81294 23.5 1 18.6871 1 12.75ZM11.75 3.5C6.64137 3.5 2.5 7.64137 2.5 12.75C2.5 17.8586 6.64137 22 11.75 22C16.8586 22 21 17.8586 21 12.75C21 7.64137 16.8586 3.5 11.75 3.5Z" fill="currentColor"/>
                        </svg>
                        <span class="ms-3 capitalize">À propos de nous</span>
                     </a>
                </li>
            </ul>
            </div>
        </div>
    </aside>
    <!-- Overlay (only visible on mobile) -->
    <div id="overlay" class="hidden bg-black bg-opacity-50 fixed inset-0 z-10 md:hidden"></div>

</div>




