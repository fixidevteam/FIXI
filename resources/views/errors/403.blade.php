<!-- resources/views/errors/403.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('403') }}
        </h2>
    </x-slot>
    {{-- custome page --}}
    <div>
        <div class="sm:ml-64">
            <div class="py-16">
                <div class="flex h-screen flex-col bg-white">
                  
                    <div class="flex flex-1 items-center justify-center">
                      <div class="mx-auto max-w-xl px-4 py-8 text-center">
                        <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                            403 - Accès Refusé
                        </h1>
                  
                        <p class="my-4 text-gray-500">
                            Désolé, vous n'avez pas l'autorisation d'accéder à cette page.
                        </p>
                  
                        <a
                          href="{{ route('dashboard') }}"
                        >
                        <x-primary-button>
                            Retourner à l'accueil
                        </x-primary-button>
                        </a>
                      </div>
                    </div>
                  </div>
            </div>
        </div>
    </div>
    
</x-app-layout>

