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
                href="{{ route('mechanic.operations.index') }}"
                class="inline-flex items-center text-sm font-medium text-gray-700   ">
                La liste des operations
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
                class="inline-flex items-center text-sm font-medium text-gray-700   ">
                Details d'operation 
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
        <h2 class="text-2xl font-bold leading-9 tracking-tight text-gray-900 mb-4">Details d'operation</h2>
        {{-- content of details  --}}
        <div class="grid grid-cols-1 md:grid-cols-2">
          {{-- Categorie --}}
          <div class="mb-4">
            <p class="capitalize text-sm font-medium text-gray-900 truncate">
              Categorie
            </p>
            <p class="text-sm text-gray-500 truncate">
              Categorie operation
            </p>
          </div>
          {{-- Operation --}}
          <div class="mb-4">
            <p class="capitalize text-sm font-medium text-gray-900 truncate">
              Operation
            </p>
            <p class="text-sm text-gray-500 truncate">
              Operation nom
            </p>
          </div>
          {{-- Date --}}
          <div class="mb-4">
            <p class="capitalize text-sm font-medium text-gray-900 truncate">
              Date
            </p>
            <p class="text-sm text-gray-500 truncate">
              Date operation
            </p>
          </div>
          {{-- Sous operation --}}
          {{-- @if(!$operation->sousoperations->isEmpty()) --}}
          <div>
            <p class="capitalize text-sm font-medium text-gray-900 truncate">
              Sous operation
            </p>

            {{-- @foreach ($operation->sousoperations as $sousOp) --}}
            <p class="text-sm text-gray-500 truncate">
              {{-- {{$sousOperation->where('id', $sousOp->nom)->first()->nom_sous_operation }} --}}
              Sous operation
            </p>
            {{-- @endforeach --}}
          </div>
          {{-- @endif --}}
        </div>
        {{-- description --}}
        {{-- @if($operation->description !== NULL) --}}
        <div class="my-4">
          <p class="capitalize text-sm font-medium text-gray-900 truncate">
            description
          </p>
          <p class="text-sm text-gray-500 truncate">
            operation description 
          </p>
        </div>
        {{-- @endif --}}
        {{-- operation description close  --}}
        <div class="flex justify-center my-8">
          {{-- @if($operation->photo !== NULL) --}}
          {{-- <img class="" src="{{asset('storage/'.$operation->photo)}}" alt="image description"> --}}
          {{-- @else --}}
          <img class="" src="../../images/defaultimage.jpg" alt="image description">
          {{-- @endif --}}
        </div>
        {{-- content of details  --}}
        <div class="grid grid-cols-1 md:grid-cols-2">
          {{-- Matricule --}}
          <div class="mb-4">
            <p class="capitalize text-sm font-medium text-gray-900 truncate">
              Matricule
            </p>
            <p class="text-sm text-gray-500 truncate">
              Voiture Matricule
            </p>
          </div>
          {{-- Marque --}}
          <div class="mb-4">
            <p class="capitalize text-sm font-medium text-gray-900 truncate">
              Marque
            </p>
            <p class="text-sm text-gray-500 truncate">
              Voiture Marque
            </p>
          </div>
          {{-- Modèle --}}
          <div class="mb-4">
            <p class="capitalize text-sm font-medium text-gray-900 truncate">
              Modèle
            </p>
            <p class="text-sm text-gray-500 truncate">
              Voiture Modèle
            </p>
          </div>
          {{-- Date d'achat --}}
          <div class="mb-4">
            <p class="capitalize text-sm font-medium text-gray-900 truncate">
              Date d'achat
            </p>
            <p class="text-sm text-gray-500 truncate">
              Voiture Date d'achat
            </p>
          </div>
          {{-- Date de première mise en circulation --}}
          <div class="mb-4">
            <p class="capitalize text-sm font-medium text-gray-900 truncate">
              Date de première mise en circulation
            </p>
            <p class="text-sm text-gray-500 truncate">
              Voiture Date de première mise en circulation
            </p>
          </div>
          {{-- La date de dédouanement --}}
          <div class="mb-4">
            <p class="capitalize text-sm font-medium text-gray-900 truncate">
              La date de dédouanement
            </p>
            <p class="text-sm text-gray-500 truncate">
              Voiture La date de dédouanement
            </p>
          </div>
          {{-- details du voiture --}}
          <div class="mb-4">
            <a href="">
                <x-primary-button>details du voiture</x-primary-button>
            </a>
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