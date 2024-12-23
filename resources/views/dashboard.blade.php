<x-app-layout>

  <div class="p-4 sm:ml-64">

    @if(!$promotions->isEmpty())
    <div class="p-2 border-2 border-gray-200 border-dashed rounded-lg mt-14">
      <div id="default-carousel" class="relative w-full m-auto" data-carousel="slide">
        <!-- Carousel wrapper -->
        <div class="relative h-32 md:h-40 lg:h-48 overflow-hidden rounded-lg">
          @foreach($promotions as $promotion)
          <!-- Item 1 -->
          <div class="hidden duration-1000 ease-in-out" data-carousel-item>
            <a href="{{$promotion->lien_promotion}}" target="_blank">
              <img src="{{asset('storage/'.$promotion->photo_promotion)}}" class="absolute block w-full h-full object-cover" alt="{{$promotion->nom_promotion}}">
            </a>
          </div>
          @endforeach
          <!-- Item 2 -->
        </div>
        <!-- Slider indicators -->
        <div class="absolute z-30 flex -translate-x-1/2 bottom-3 left-1/2 space-x-3 rtl:space-x-reverse">
          @foreach($promotions as $promotion)
          <button type="button" class="w-3 h-3 rounded-full bg-gray-300" aria-current="true" aria-label="Slide {{$promotion->id}}" data-carousel-slide-to="{{$promotion->id}}"></button>
          @endforeach
        </div>
        <!-- Slider controls -->
        <button type="button" class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-3 cursor-pointer group focus:outline-none" data-carousel-prev>
          <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-gray-800/50 text-white">
            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4" />
            </svg>
            <span class="sr-only">Previous</span>
          </span>
        </button>
        <button type="button" class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-3 cursor-pointer group focus:outline-none" data-carousel-next>
          <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-gray-800/50 text-white">
            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 9l4-4-4-4" />
            </svg>
            <span class="sr-only">Next</span>
          </span>
        </button>
      </div>
    </div>
    @endif
    <div class="p-2 border-2 border-gray-200 border-dashed rounded-lg {{ $promotions->isEmpty() ? 'mt-14' : 'mt-4' }}">
      {{-- content (slot on layouts/app.blade.php)--}}
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          <h1 class="text-lg font-medium text-gray-900">Bonjour, {{ Auth::user()->name }} </h1>
          <p class="text-sm text-gray-600 md:w-[300px] sm:w-full mx-0 text-left">Ajoutez vos informations en quelques clics,et accédez à une vue d’ensemble claire et sécurisée de toutes vos données importantes.</p>
          <div class="mt-4">
            <a href="{{ route('voiture.create') }}">
              <x-primary-button>Ajouter une voiture</x-primary-button>
            </a>
          </div>
        </div>
      </div>
    </div>

    {{-- content --}}
    <div class="p-2 border-2 border-gray-200 border-dashed rounded-lg mt-4">
      {{-- content (slot on layouts/app.blade.php)--}}
      <div>
        <div>
          <div class="w-full grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
            {{-- box 1 --}}
            <div class="flex items-center bg-white p-8 rounded-lg shadow">
              <div class="flex-shrink-0">
                <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">{{ Auth::user()->voitures->count() }}</span>
                <h3 class="text-base font-normal text-gray-500 first-letter:capitalize">nombre des voitures</h3>
              </div>
              <div class="ml-5 w-0 flex items-center justify-end flex-1 text-gray-600 text-base font-bold">
                <svg class="w-5 h-5" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2.75C6.89137 2.75 2.75 6.89137 2.75 12C2.75 17.1086 6.89137 21.25 12 21.25C17.1086 21.25 21.25 17.1086 21.25 12C21.25 6.89137 17.1086 2.75 12 2.75ZM1.25 12C1.25 6.06294 6.06294 1.25 12 1.25C17.9371 1.25 22.75 6.06294 22.75 12C22.75 17.9371 17.9371 22.75 12 22.75C6.06294 22.75 1.25 17.9371 1.25 12ZM6.80317 11.25H9.35352C9.47932 10.8052 9.71426 10.4062 10.0276 10.0838L8.75225 7.87485C7.7184 8.68992 6.99837 9.88531 6.80317 11.25ZM10.0507 7.1238L11.3262 9.33314C11.5418 9.27884 11.7676 9.25 12 9.25C12.2324 9.25 12.4581 9.27883 12.6737 9.33312L13.9493 7.12378C13.3466 6.88264 12.6888 6.75 12 6.75C11.3112 6.75 10.6534 6.88265 10.0507 7.1238ZM15.2477 7.87481L13.9724 10.0837C14.2857 10.4062 14.5207 10.8052 14.6465 11.25H17.1968C17.0016 9.88529 16.2816 8.68988 15.2477 7.87481ZM17.1968 12.75H14.6465C14.5207 13.1949 14.2857 13.5939 13.9723 13.9163L15.2477 16.1252C16.2816 15.3102 17.0016 14.1147 17.1968 12.75ZM13.9492 16.8762L12.6736 14.6669C12.4581 14.7212 12.2324 14.75 12 14.75C11.7676 14.75 11.5419 14.7212 11.3263 14.6669L10.0507 16.8762C10.6534 17.1174 11.3112 17.25 12 17.25C12.6888 17.25 13.3465 17.1174 13.9492 16.8762ZM8.75229 16.1252L10.0276 13.9163C9.71428 13.5938 9.47933 13.1948 9.35352 12.75H6.80317C6.99837 14.1147 7.71842 15.3101 8.75229 16.1252ZM11.3859 13.089C11.3823 13.0869 11.3787 13.0847 11.375 13.0826C11.3715 13.0806 11.368 13.0786 11.3645 13.0766C10.9967 12.859 10.75 12.4583 10.75 12C10.75 11.5434 10.9949 11.1439 11.3605 10.9258C11.3653 10.9231 11.3702 10.9204 11.375 10.9176C11.3801 10.9146 11.3851 10.9116 11.3902 10.9086C11.5705 10.8076 11.7785 10.75 12 10.75C12.2204 10.75 12.4275 10.8071 12.6073 10.9072C12.6131 10.9107 12.619 10.9142 12.6249 10.9177C12.6306 10.9209 12.6362 10.9241 12.642 10.9272C13.0062 11.1457 13.25 11.5444 13.25 12C13.25 12.4595 13.0021 12.8611 12.6327 13.0783C12.6301 13.0797 12.6276 13.0812 12.625 13.0827C12.6222 13.0843 12.6194 13.0859 12.6166 13.0876C12.4347 13.191 12.2242 13.25 12 13.25C11.7768 13.25 11.5673 13.1915 11.3859 13.089ZM5.25 12C5.25 8.27208 8.27208 5.25 12 5.25C15.7279 5.25 18.75 8.27208 18.75 12C18.75 15.7279 15.7279 18.75 12 18.75C8.27208 18.75 5.25 15.7279 5.25 12Z" fill="currentColor" />
                </svg>
              </div>
            </div>
            {{-- box 2 --}}
            <div class="flex items-center bg-white p-8 rounded-lg shadow">
              <div class="flex-shrink-0">
                <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">{{ Auth::user()->papiersUsers->count() }}</span>
                <h3 class="text-base font-normal text-gray-500 first-letter:capitalize">nombre des papiers</h3>
              </div>
              <div class="ml-5 w-0 flex items-center justify-end flex-1 text-gray-600 text-base font-bold">
                <svg class="w-5 h-5" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M16.3939 2.02121L16.4604 2.03904C17.5598 2.33361 18.431 2.56704 19.1162 2.81458C19.8172 3.06779 20.3888 3.35744 20.8597 3.79847C21.5453 4.44068 22.0252 5.27179 22.2385 6.18671C22.385 6.81503 22.3501 7.45486 22.2189 8.18849C22.0906 8.90573 21.8572 9.77697 21.5626 10.8764L21.0271 12.8747C20.7326 13.974 20.4991 14.8452 20.2516 15.5305C19.9984 16.2314 19.7087 16.803 19.2677 17.2739C18.6459 17.9377 17.8471 18.4087 16.9665 18.6316C16.7093 19.2213 16.3336 19.7554 15.8597 20.1993C15.3888 20.6403 14.8172 20.9299 14.1162 21.1832C13.431 21.4307 12.5598 21.6641 11.4605 21.9587L11.394 21.9765C10.2946 22.2711 9.42337 22.5045 8.70613 22.6328C7.9725 22.764 7.33266 22.7989 6.70435 22.6524C5.78943 22.4391 4.95832 21.9592 4.31611 21.2736C3.87508 20.8027 3.58542 20.2311 3.33222 19.5302C3.08468 18.8449 2.85124 17.9737 2.55667 16.8743L2.02122 14.876C1.72664 13.7766 1.4932 12.9054 1.36495 12.1882C1.23376 11.4546 1.19881 10.8147 1.34531 10.1864C1.55864 9.27149 2.03849 8.44038 2.72417 7.79817C3.19505 7.35714 3.76664 7.06749 4.46758 6.81428C5.15283 6.56674 6.02404 6.3333 7.12341 6.03873L7.15665 6.02983C7.42112 5.95896 7.67134 5.89203 7.90825 5.82944C8.29986 4.43031 8.64448 3.44126 9.31611 2.72417C9.95831 2.03849 10.7894 1.55864 11.7043 1.34531C12.3327 1.19881 12.9725 1.23376 13.7061 1.36495C14.4233 1.49319 15.2945 1.72664 16.3939 2.02121ZM7.45502 7.5028C6.36214 7.79571 5.57905 8.00764 4.9772 8.22505C4.36778 8.4452 4.00995 8.64907 3.74955 8.89296C3.2804 9.33237 2.95209 9.90103 2.80613 10.527C2.72511 10.8745 2.72747 11.2863 2.84152 11.9242C2.95723 12.5712 3.17355 13.381 3.47902 14.521L3.99666 16.4529C4.30212 17.5929 4.51967 18.4023 4.74299 19.0205C4.96314 19.63 5.16701 19.9878 5.4109 20.2482C5.85031 20.7173 6.41897 21.0456 7.04496 21.1916C7.39242 21.2726 7.80425 21.2703 8.4421 21.1562C9.08915 21.0405 9.89893 20.8242 11.0389 20.5187C12.1789 20.2132 12.9884 19.9957 13.6066 19.7724C14.216 19.5522 14.5739 19.3484 14.8343 19.1045C14.9719 18.9756 15.0973 18.8357 15.2096 18.6865C15.0306 18.6612 14.8463 18.629 14.6557 18.5911C13.9839 18.4575 13.1769 18.2413 12.1808 17.9744L12.1234 17.959C11.024 17.6644 10.1528 17.431 9.46758 17.1835C8.76664 16.9302 8.19505 16.6406 7.72416 16.1996C7.03849 15.5574 6.55864 14.7262 6.34531 13.8113C6.19881 13.183 6.23376 12.5432 6.36494 11.8095C6.4932 11.0923 6.72664 10.2211 7.02122 9.12174L7.45502 7.5028ZM13.4421 2.84152C12.8042 2.72747 12.3924 2.72511 12.045 2.80613C11.419 2.95209 10.8503 3.2804 10.4109 3.74955C9.97479 4.21518 9.70642 4.93452 9.2397 6.64323C9.16384 6.92093 9.08365 7.22023 8.99665 7.54488L8.47902 9.47673C8.17355 10.6167 7.95723 11.4265 7.84152 12.0736C7.72747 12.7114 7.72511 13.1232 7.80613 13.4707C7.95209 14.0967 8.2804 14.6654 8.74955 15.1048C9.00995 15.3487 9.36778 15.5525 9.9772 15.7727C10.5954 15.996 11.4049 16.2136 12.5449 16.519C13.5703 16.7938 14.3303 16.997 14.9482 17.1199C15.5635 17.2422 15.981 17.2723 16.3232 17.23C16.3976 17.2209 16.4691 17.2082 16.5389 17.1919C17.1649 17.0459 17.7335 16.7176 18.1729 16.2485C18.4168 15.9881 18.6207 15.6303 18.8408 15.0208C19.0642 14.4026 19.2817 13.5932 19.5872 12.4532L20.1048 10.5213C20.4103 9.38129 20.6266 8.57151 20.7423 7.92446C20.8564 7.28661 20.8587 6.87479 20.7777 6.52733C20.6317 5.90133 20.3034 5.33267 19.8343 4.89327C19.5739 4.64937 19.216 4.4455 18.6066 4.22535C17.9884 4.00203 17.1789 3.78448 16.0389 3.47902C14.8989 3.17355 14.0892 2.95723 13.4421 2.84152Z" fill="currentColor" />
                </svg>
              </div>
            </div>
            {{-- box 3 --}}
            {{-- count all operations that made on the cars --}}
            @php
            $operationsCount = Auth::user()->voitures->sum(function ($voiture) {
            return $voiture->operations->count();
            });
            @endphp
            <div class="flex items-center bg-white p-8 rounded-lg shadow">
              <div class="flex-shrink-0">
                <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">{{ $operationsCount }}</span>
                <h3 class="text-base font-normal text-gray-500 first-letter:capitalize">nombre des operations</h3>
              </div>
              <div class="ml-5 w-0 flex items-center justify-end flex-1 text-gray-600 text-base font-bold">
                <svg class="w-5 h-5" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M14 20C14 21.1046 13.1046 22 12 22C10.8954 22 10 21.1046 10 20C10 18.8954 10.8954 18 12 18C13.1046 18 14 18.8954 14 20Z" stroke="currentColor" stroke-width="1.5" />
                  <path d="M6 4C6 3.05719 6 2.58579 6.29289 2.29289C6.58579 2 7.05719 2 8 2H16C16.9428 2 17.4142 2 17.7071 2.29289C18 2.58579 18 3.05719 18 4C18 4.94281 18 5.41421 17.7071 5.70711C17.4142 6 16.9428 6 16 6H8C7.05719 6 6.58579 6 6.29289 5.70711C6 5.41421 6 4.94281 6 4Z" stroke="currentColor" stroke-width="1.5" />
                  <path d="M8.5 16.5C8.5 15.6716 9.17157 15 10 15H14C14.8284 15 15.5 15.6716 15.5 16.5C15.5 17.3284 14.8284 18 14 18H10C9.17157 18 8.5 17.3284 8.5 16.5Z" stroke="currentColor" stroke-width="1.5" />
                  <path d="M14 15.5V5.5" stroke="currentColor" stroke-width="1.5" />
                  <path d="M10 15.5V6" stroke="currentColor" stroke-width="1.5" />
                  <path d="M8 8L16 10M8 11.5L16 13.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                  <path d="M20 11.4994L22 11.4994M4 11.5004H2M19.0713 14.2999L19.7784 14.9999M4.92871 14.2999L4.2216 14.9999M19.0713 8.69984L19.7784 7.99988M4.92871 8.69984L4.2216 7.99988" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                </svg>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="p-2 border-2 border-gray-200 border-dashed rounded-lg mt-4">
      {{-- content (slot on layouts/app.blade.php)--}}
      <div>
        <div>
          <div class="grid grid-cols-1 2xl:grid-cols-2 gap-4">
            {{-- box 1 --}}
            <div class="bg-white shadow rounded-lg mb-4 p-4 sm:p-6 h-full">
              <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-bold leading-none text-gray-900 first-letter:capitalize">Mes voitures</h3>
                <a href="{{ route('voiture.index') }}" class="text-sm font-medium text-blue-600 hover:bg-gray-100 rounded-lg inline-flex items-center p-2 first-letter:capitalize">
                  Afficher tout
                </a>
              </div>
              <div class="flow-root">
                @if(Auth::user()->voitures ->isEmpty())
                <p class="p-4 text-gray-500 text-center">Aucun voiture disponible.</p>
                @else
                <ul role="list" class="divide-y divide-gray-200">
                  @foreach (Auth::user()->voitures->take(5) as $voiture)
                  <li class="py-3 sm:py-4">
                    <div class="flex items-center space-x-4">
                      <div class="flex-shrink-0">
                        @if($voiture->photo !== NULL)
                        <img class="rounded-full w-8 h-8 object-cover" src="{{asset('storage/'.$voiture->photo)}}" alt="image description">
                        @else
                        <img class="rounded-full w-8 h-8 object-cover" src="/images/defaultimage.jpg" alt="image description">
                        @endif
                      </div>
                      <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate">
                          {{$voiture->marque ." ". $voiture->modele}}
                        </p>
                        <p class="text-sm text-gray-500 truncate">
                          <span>{{ explode('-', $voiture->numero_immatriculation)[0] }}</span>-<span dir="rtl">{{ explode('-', $voiture->numero_immatriculation)[1] }}</span>-<span>{{ explode('-', $voiture->numero_immatriculation)[2] }}</span>
                        </p>
                      </div>
                      <div class="inline-flex items-center text-base font-semibold text-gray-900">
                        <a href="{{ route('voiture.show',$voiture->id) }}" class="text-sm font-medium text-blue-600  inline-flex items-center p-2 capitalize hover:underline">details</a>
                      </div>
                    </div>
                  </li>
                  @endforeach
                </ul>
                @endif
              </div>
            </div>
            {{-- box 1 close --}}
            {{-- box 2 --}}
            <div class="bg-white shadow rounded-lg mb-4 p-4 sm:p-6 h-full">
              <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-bold leading-none text-gray-900 first-letter:capitalize">Mes papiers personnels</h3>
                <a href="{{ route('paiperPersonnel.index') }}" class="text-sm font-medium text-blue-600 hover:bg-gray-100 rounded-lg inline-flex items-center p-2 first-letter:capitalize">
                  Afficher tout
                </a>
              </div>
              <div class="flow-root">
                @if(Auth::user()->papiersUsers->isEmpty())
                <p class="p-4 text-gray-500 text-center">Aucun papier disponible.</p>
                @else
                <ul role="list" class="divide-y divide-gray-200">
                  @foreach (Auth::user()->papiersUsers->take(5) as $papier)
                  <li class="py-3 sm:py-4">
                    <div class="flex items-center space-x-4">
                      <div class="flex-shrink-0">
                        @if($papier->photo !== NULL)
                        @php
                        $fileExtension = pathinfo($papier->photo, PATHINFO_EXTENSION);
                        @endphp

                        @if(in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png']))
                        <!-- Display the actual photo -->
                        <img class="rounded-full w-8 h-8 object-cover" src="{{ asset('storage/' . $papier->photo) }}" alt="image description">
                        @elseif(strtolower($fileExtension) === 'pdf')
                        <!-- Display the default image for PDFs -->
                        <img class="rounded-full w-8 h-8 object-cover" src="{{ asset('/images/file.png') }}" alt="default image">
                        @else
                        <!-- Display the default image for unsupported formats -->
                        <img class="rounded-full w-8 h-8 object-cover" src="{{ asset('/images/defaultimage.jpg') }}" alt="default image">
                        @endif
                        @else
                        <!-- Display the default image if no photo is provided -->
                        <img class="rounded-full w-8 h-8 object-cover" src="{{ asset('/images/defaultimage.jpg') }}" alt="default image">
                        @endif
                      </div>
                      <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate">
                          {{$papier->type}}
                        </p>
                        <p class="text-sm text-gray-500 truncate">
                          {{$papier->date_debut }} / <span class="text-red-600">{{$papier->date_fin}}</span>
                        </p>
                      </div>
                      <div class="inline-flex items-center text-base font-semibold text-gray-900">
                        <a href="{{route('paiperPersonnel.show',$papier->id)}}" class="text-sm font-medium text-blue-600 inline-flex items-center p-2 capitalize hover:underline">Details</a>
                      </div>
                    </div>
                  </li>
                  @endforeach
                </ul>
                @endif
              </div>
            </div>
            {{-- box 2 close --}}
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
</x-app-layout>