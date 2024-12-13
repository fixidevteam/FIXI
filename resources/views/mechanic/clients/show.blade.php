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
                href="{{ route('mechanic.clients.index') }}"
                class="inline-flex items-center text-sm font-medium text-gray-700">
                La liste des clients
              </a>
            </div>
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
                href=""
                class="inline-flex items-center text-sm font-medium text-gray-700">
                Détails du clients
              </a>
            </div>
          </li>
        </ol>
      </nav>
    </div>
    {{-- content --}}
    <div class="p-2 border-2 border-gray-200 border-dashed rounded-lg mt-4">
      {{-- alert --}}
      @foreach (['success', 'error'] as $type)
      @if (session($type))
      <div class="fixed top-20 right-4 mb-5 flex justify-end z-10"
        x-data="{ show: true }"
        x-show="show"
        x-transition:leave="transition ease-in duration-1000"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        x-init="setTimeout(() => show = false, 3000)">
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
                class="size-6">
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
              @else
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 6.25C12.4142 6.25 12.75 6.58579 12.75 7V13C12.75 13.4142 12.4142 13.75 12 13.75C11.5858 13.75 11.25 13.4142 11.25 13V7C11.25 6.58579 11.5858 6.25 12 6.25Z" fill="currentColor" />
                <path d="M12 17C12.5523 17 13 16.5523 13 16C13 15.4477 12.5523 15 12 15C11.4477 15 11 15.4477 11 16C11 16.5523 11.4477 17 12 17Z" fill="currentColor" />
                <path fill-rule="evenodd" clip-rule="evenodd" d="M1.25 12C1.25 6.06294 6.06294 1.25 12 1.25C17.9371 1.25 22.75 6.06294 22.75 12C22.75 17.9371 17.9371 22.75 12 22.75C6.06294 22.75 1.25 17.9371 1.25 12ZM12 2.75C6.89137 2.75 2.75 6.89137 2.75 12C2.75 17.1086 6.89137 21.25 12 21.25C17.1086 21.25 21.25 17.1086 21.25 12C21.25 6.89137 17.1086 2.75 12 2.75Z" fill="currentColor" />
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
      {{-- content (slot on layouts/app.blade.php)--}}
      <div class="px-5 py-3 text-gray-700 bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="flex justify-between items-center my-6">
          <h2 class="text-2xl font-bold leading-9 tracking-tight text-gray-900">Détails du clients</h2>

          @if($client->created_by_mechanic && $client->mechanic_id == Auth::user()->id)
          <a href="{{ route('mechanic.voitures.create') }}">
            <x-primary-button>ajouter une voiture</x-primary-button>
          </a>
          @endif



        </div>
        {{-- Détails of cars --}}
        <div class="flex flex-col md:flex-row gap-10 items-center">
          {{-- Car Détails in Two Columns --}}
          <div class="flex flex-col md:flex-row gap-5 w-full justify-center md:justify-start">
            {{-- Column 1 --}}
            <div class="flex-1 space-y-4">
              {{-- nom --}}
              <div>
                <p class="capitalize text-sm font-medium text-gray-900">nom</p>
                <p class="text-sm text-gray-500">
                  <span>{{ $client->name }}</span>
                </p>
              </div>

              {{-- email --}}
              <div>
                <p class="capitalize text-sm font-medium text-gray-900">email</p>
                <p class="text-sm text-gray-500">
                  {{ $client->email }}
                </p>
              </div>
            </div>
            {{-- Column 2 --}}
            <div class="flex-1 space-y-4">
              {{-- telephone --}}
              <div>
                <p class="capitalize text-sm font-medium text-gray-900">télephone</p>
                <p class="text-sm text-gray-500">
                  {{ $client->telephone }}
                </p>
              </div>
            </div>
          </div>
        </div>
        {{-- Détails of cars close --}}
      </div>
    </div>
    <div class="p-2 border-2 border-gray-200 border-dashed rounded-lg mt-4">
      {{-- content (slot on layouts/app.blade.php)--}}
      <div class=" px-5 py-3 text-gray-700 bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="flex justify-between items-center my-6">
          <h2 class="text-2xl font-bold leading-9 tracking-tight text-gray-900">véhicules</h2>


        </div>
        {{-- Details of cars --}}
        <div class="divide-y">
          @foreach($client->voitures as $voiture)
          <div>
            <div class="flex flex-col md:flex-row gap-10 items-center my-4">
              {{-- Car Image --}}
              <div class="md:w-[160px] md:h-[160px] overflow-hidden md:rounded-full border flex-shrink-0">
                <a  href="{{ route('mechanic.voitures.show',$voiture->id) }}">
                  @if($voiture->photo !== NULL)
  
                  <img class="w-full h-full object-cover" src="{{asset('storage/'.$voiture->photo)}}" alt="voiture image">
  
                  @else
  
                  <img class="w-full h-full object-cover" src="/images/defaultimage.jpg" alt="image description">
                  @endif
                </a>
              </div>
              {{-- Car Details in Two Columns --}}
              <div class="flex flex-col md:flex-row gap-5 w-full justify-center md:justify-start">
                {{-- Column 1 --}}
                <div class="flex-1 space-y-4">
                  {{-- Matricule --}}
                  <div>
                    <p class="capitalize text-sm font-medium text-gray-900">immatricule</p>
                    <p class="text-sm text-gray-500">
                      <span>{{ explode('-', $voiture->numero_immatriculation)[0] }}</span>-<span dir="rtl">{{ explode('-', $voiture->numero_immatriculation)[1] }}</span>-<span>{{ explode('-', $voiture->numero_immatriculation)[2] }}</span>
                    </p>
                  </div>
  
                  {{-- Marque --}}
                  <div>
                    <p class="capitalize text-sm font-medium text-gray-900">Marque</p>
                    <p class="text-sm text-gray-500">{{$voiture->marque}}</p>
                  </div>
  
                  {{-- Modèle --}}
                  <div>
                    <p class="capitalize text-sm font-medium text-gray-900">Modèle</p>
                    <p class="text-sm text-gray-500">{{$voiture->modele}}</p>
                  </div>
                </div>
  
                {{-- Column 2 --}}
                <div class="flex-1 space-y-4">
                  {{-- Date de première mise en circulation --}}
                  <div>
                    <p class="first-letter:capitalize text-sm font-medium text-gray-900">Date de première mise en circulation</p>
                    <p class="text-sm text-gray-500">{{$voiture->date_de_première_mise_en_circulation ?? 'N/A'}}</p>
                  </div>
  
                  {{-- Date d'achat --}}
                  <div>
                    <p class="first-letter:capitalize text-sm font-medium text-gray-900">Date d'achat</p>
                    <p class="text-sm text-gray-500">{{$voiture->date_achat ?? 'N/A' }}</p>
                  </div>
  
                  {{-- Date de dédouanement --}}
                  <div>
                    <p class="first-letter:capitalize text-sm font-medium text-gray-900">Date de dédouanement</p>
                    <p class="text-sm text-gray-500">{{$voiture->date_de_dédouanement ?? 'N/A' }}</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="my-6 ">
              {{-- Détails du voiture --}}
              <a href="{{ route('mechanic.voitures.show',$voiture->id) }}">
                <x-primary-button>Détails du voiture</x-primary-button>
              </a>
            </div>
          </div>
          @endforeach
          
        </div>
        


        {{-- details of cars close --}}
      </div>
    </div>
    {{-- footer --}}
    <div class="p-2 border-2 border-gray-200 border-dashed rounded-lg mt-4">
      @include('layouts.footer')
    </div>
  </div>
</x-mechanic-app-layout>