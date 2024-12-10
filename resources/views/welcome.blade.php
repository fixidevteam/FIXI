<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>FIXI</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased"> 
        <div>
            <section class="relative flex flex-wrap lg:h-screen lg:items-center">
                <div class="w-full px-4 py-12 sm:px-6 sm:py-16 lg:w-1/2 lg:px-8 lg:py-24">
                    <div class="mx-auto max-w-lg text-center">
                        <a href="/">
                            <img class="mx-auto h-16 w-auto" src="/images/fixi.png" alt="Fixi">
                        </a>
                        <p class="mt-4 text-gray-500">
                            Bienvenue sur la plateforme Fixi ! Veuillez choisir votre espace pour commencer.
                        </p>
                    </div>
                    {{-- platform space --}}
                    <div class="mx-auto mb-0 mt-8 max-w-md space-y-6">
                        @if (Route::has('login'))
                            <div>
                                {{-- user auth --}}
                                @auth('web')
                                    <a href="{{ url('/my-fixi/dashboard') }}">
                                        <button
                                        class="w-full inline-block first-letter:capitalize border border-transparent rounded-[20px] bg-red-600 px-5 py-3 text-sm font-medium text-white shadow-sm hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                    >
                                        tableau de bord de l'utilisateur
                                        </button>
                                    </a>
                                @else
                                    <a href="{{ route('login') }}">
                                        <button
                                        class="w-full inline-block first-letter:capitalize border border-transparent rounded-[20px] bg-red-600 px-5 py-3 text-sm font-medium text-white shadow-sm hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                    >
                                        Espace client
                                        </button>
                                    </a>
                                @endauth
                                {{-- mechanic auth --}}
                                @auth('mechanic')
                                    <a href="{{ url('/fixi-pro/mechanic/dashboard') }}">
                                        <button
                                        class="my-5 w-full inline-block first-letter:capitalize border border-transparent rounded-[20px] bg-red-600 px-5 py-3 text-sm font-medium text-white shadow-sm hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                    >
                                        tableau de bord du garage
                                        </button>
                                    </a>
                                @else
                                    <a href="{{ route('mechanic.login') }}">
                                        <button
                                        class="my-5 w-full inline-block first-letter:capitalize border border-transparent rounded-[20px] bg-red-600 px-5 py-3 text-sm font-medium text-white shadow-sm hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                    >
                                        Espace garage
                                        </button>
                                    </a>
                                @endauth
                            </div>
                        @endif
                    </div>
                </div>
                    <div class="relative h-64 w-full sm:h-96 lg:h-full lg:w-1/2">
                        <img
                            alt="Fixi Welcome Image"
                            src="/images/fixiRepair.jpg"
                            class="absolute inset-0 h-full w-full object-cover"
                        />
                    </div>
            </section>
        </div>
    </body>
</html>
