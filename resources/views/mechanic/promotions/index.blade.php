<x-mechanic-app-layout>
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
                            href="{{ route('mechanic.dashboard') }}"
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
                                href="{{ route('mechanic.promotions.index') }}"
                                class="inline-flex items-center text-sm font-medium text-gray-700">
                                List des promotions
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
                    <h2 class="text-2xl font-bold leading-9 tracking-tight text-gray-900">{{ __('Promotions') }}</h2>
                </div>
                {{-- table --}}
                <div class="my-5">
                    <div>
                        <h2 class="text-lg font-bold mb-4 text-gray-900">Promotions Actives</h2>
                        @if($activePromotions->isEmpty())
                            <p class="p-4 text-gray-500 text-center">Aucune promotion active disponible.</p>
                        @else
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                @foreach($activePromotions as $promotion)
                                    <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow">
                                        <a href="{{ $promotion->lien_promotion }}" target="_blank">
                                            <img class="rounded-t-lg h-52 w-full object-cover" 
                                                src="{{ $promotion->photo_promotion ? asset('storage/' . $promotion->photo_promotion) : '/images/defaultimage.jpg' }}"
                                                alt="promotion image" />
                                        </a>
                                        <div class="p-5">
                                            <a href="{{ $promotion->lien_promotion }}" target="_blank">
                                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ $promotion->nom_promotion }}</h5>
                                            </a>
                                            <p class="mb-3 font-normal text-gray-700">{{ $promotion->garage->name }}</p>
                                            @if($promotion->description !== null)
                                                <p class="mb-3 font-normal text-gray-700">{{ $promotion->description }}</p>
                                            @endif
                                            <div class="flex justify-between items-center flex-wrap">
                                                <p class="mb-3 font-normal text-gray-700">
                                                    <span>{{ $promotion->date_debut }}</span> / 
                                                    <span class="text-green-500">{{ $promotion->date_fin }}</span>
                                                </p>
                                                <p class="mb-3 font-bold text-sm text-green-500">
                                                    <span class="text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded me-2 border bg-green-100 border-green-500">
                                                        <svg class="w-2.5 h-2.5 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm3.982 13.982a1 1 0 0 1-1.414 0l-3.274-3.274A1.012 1.012 0 0 1 9 10V6a1 1 0 0 1 2 0v3.586l2.982 2.982a1 1 0 0 1 0 1.414Z"/>
                                                        </svg>
                                                        Active
                                                    </span>
                                                </p>
                                            </div>
                                            <a href="{{ $promotion->lien_promotion }}" target="_blank" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                                Lire la suite
                                                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                
                    <div class="mt-10">
                        <h2 class="text-lg font-bold mb-4 text-gray-900">Promotions Expirées</h2>
                        @if($expiredPromotions->isEmpty())
                            <p class="p-4 text-gray-500 text-center">Aucune promotion expirée disponible.</p>
                        @else
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                @foreach($expiredPromotions as $promotion)
                                    <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow">
                                        <a href="{{ $promotion->lien_promotion }}" target="_blank">
                                            <img class="rounded-t-lg h-52 w-full object-cover" 
                                                src="{{ $promotion->photo_promotion ? asset('storage/' . $promotion->photo_promotion) : '/images/defaultimage.jpg' }}"
                                                alt="promotion image" />
                                        </a>
                                        <div class="p-5">
                                            <a href="{{ $promotion->lien_promotion }}" target="_blank">
                                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ $promotion->nom_promotion }}</h5>
                                            </a>
                                            <p class="mb-3 font-normal text-gray-700">{{ $promotion->garage->name }}</p>
                                            @if($promotion->description !== null)
                                                <p class="mb-3 font-normal text-gray-700">{{ $promotion->description }}</p>
                                            @endif
                                            <div class="flex justify-between items-center flex-wrap">
                                                <p class="mb-3 font-normal text-gray-700">
                                                    <span>{{ $promotion->date_debut }}</span> / 
                                                    <span class="text-red-500">{{ $promotion->date_fin }}</span>
                                                </p>
                                                <p class="mb-3 font-bold text-sm text-red-500">
                                                    <span class="text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded me-2 border bg-red-100 border-red-500">
                                                        <svg class="w-2.5 h-2.5 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm3.982 13.982a1 1 0 0 1-1.414 0l-3.274-3.274A1.012 1.012 0 0 1 9 10V6a1 1 0 0 1 2 0v3.586l2.982 2.982a1 1 0 0 1 0 1.414Z"/>
                                                        </svg>
                                                        Expired
                                                    </span>
                                                </p>
                                            </div>
                                            <a href="{{ $promotion->lien_promotion }}" target="_blank" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                                Lire la suite
                                                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div class="mt-4">
                        {{ $expiredPromotions->links() }}
                    </div>
                </div>
                
    </div>

    </div>
    {{-- contet close colse --}}
    {{-- footer --}}
    <div class="p-2 border-2 border-gray-200 border-dashed rounded-lg mt-4">
        @include('layouts.footer')
    </div>
    </div>
</x-mechanic-app-layout>