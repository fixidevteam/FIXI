<div x-data="{ openSideBar: true }">
    <!-- Navbar -->
    <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start">
                    <button
                        type="button"
                        class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg  hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
                        @click="openSideBar = !openSideBar"
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
                    <a href="{{ route('dashboard') }}">
                        <img src="./images/fixi.png" class="h-10" alt="Logo"/>
                    </a>
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
                                    <x-dropdown-link :href="route('profile.edit')">
                                        {{ __('Profile') }}
                                    </x-dropdown-link>

                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <x-dropdown-link class="text-red-600" :href="route('logout')"
                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                            {{ __('Log Out') }}
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
        x-bind:class="{ '-translate-x-full': !openSideBar }"
        class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform bg-white border-r border-gray-200"
        aria-label="Sidebar"
    >
        <div class="h-full px-3 pb-4 overflow-y-auto bg-white">
            <ul class="space-y-2 font-medium">
                <li><a href="{{ route('dashboard') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100">Dashboard</a></li>
                <li><a href="{{ route('profile.edit') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100">User</a></li>
                <li><a href="#" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100">Kanban</a></li>
                <li><a href="#" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100">Inbox</a></li>
                <li><a href="#" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100">Products</a></li>
                <li><a href="#" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100">Sign In</a></li>
                <li><a href="#" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100">Sign Up</a></li>
            </ul>
        </div>
    </aside>
</div>




