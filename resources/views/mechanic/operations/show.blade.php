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
                Détails d'operation 
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
        <h2 class="text-2xl font-bold leading-9 tracking-tight text-gray-900 mb-4">Détails d'operation</h2>
        {{-- content of Détails  --}}
        <div class="grid grid-cols-1 md:grid-cols-2">
          {{-- Categorie --}}
          <div class="mb-4">
            <p class="capitalize text-sm font-medium text-gray-900 truncate">
              Categorie
            </p>
            <p class="text-sm text-gray-500 truncate">
              {{ $categories->where('id', $operation->categorie)->first()->nom_categorie ?? 'N/A' }}
            </p>
          </div>
          {{-- Operation --}}
          <div class="mb-4">
            <p class="capitalize text-sm font-medium text-gray-900 truncate">
              Operation
            </p>
            <p class="text-sm text-gray-500 truncate">
              {{ 
                $operation->nom === 'Autre' 
                ? $operation->autre_operation
                : ($ope->where('id', $operation->nom)->first()->nom_operation ?? 'N/A') 
              }}
            </p>
          </div>
          {{-- Date --}}
          <div class="mb-4">
            <p class="capitalize text-sm font-medium text-gray-900 truncate">
              Date
            </p>
            <p class="text-sm text-gray-500 truncate">
              {{ $operation->date_operation }}
            </p>
          </div>
          {{-- Sous operation --}}
          <div>
            <p class="first-letter:capitalize text-sm font-medium text-gray-900 truncate">
              Sous operation
            </p>
            @if($operation->sousoperations->isEmpty())
            <p class="text-sm text-gray-500 truncate">
              N/A
            </p>
            @else
            @foreach ($operation->sousoperations as $sousOp)
            <p class="text-sm text-gray-500 truncate">
              {{$sousOperation->where('id', $sousOp->nom)->first()->nom_sous_operation}}
            </p>
            @endforeach
            @endif
          </div>
        </div>
        {{-- description --}}
        @if($operation->description !== NULL)
        <div class="my-4">
          <p class="capitalize text-sm font-medium text-gray-900 truncate">
            description
          </p>
          <p class="text-sm text-gray-500 truncate">
            operation description 
          </p>
        </div>
        @endif
        {{-- operation description close  --}}
        <div class="flex justify-center my-8 overflow-hidden">
          <img
            class="w-full h-96 object-cover cursor-pointer hover:scale-105 transition-all duration-300 ease-in"
            src="{{ $operation->photo !== NULL ? asset('storage/'.$operation->photo) : '/images/defaultimage.jpg' }}"
            alt="Image d'opération"
            id="operationImage"
          >
        </div>
        {{-- content of Détails  --}}
        <div class="grid grid-cols-1 md:grid-cols-2">
          {{-- Matricule --}}
          <div class="mb-4">
            <p class="capitalize text-sm font-medium text-gray-900 truncate">
              Matricule
            </p>
            <p class="text-sm text-gray-500 truncate">
              <span>{{ explode('-', $operation->voiture->numero_immatriculation)[0] }}</span>-<span dir="rtl">{{ explode('-', $operation->voiture->numero_immatriculation)[1] }}</span>-<span>{{ explode('-', $operation->voiture->numero_immatriculation)[2] }}</span>
            </p>
          </div>
          {{-- Marque --}}
          <div class="mb-4">
            <p class="capitalize text-sm font-medium text-gray-900 truncate">
              Marque
            </p>
            <p class="text-sm text-gray-500 truncate">
              {{ $operation->voiture->marque }}
            </p>
          </div>
          {{-- Modèle --}}
          <div class="mb-4">
            <p class="capitalize text-sm font-medium text-gray-900 truncate">
              Modèle
            </p>
            <p class="text-sm text-gray-500 truncate">
              {{ $operation->voiture->modele }}
            </p>
          </div>
          {{-- Date d'achat --}}
          <div class="mb-4">
            <p class="first-letter:capitalize text-sm font-medium text-gray-900 truncate">
              Date d'achat
            </p>
            <p class="text-sm text-gray-500 truncate">
              {{ $operation->voiture->date_achat ?? 'N/A' }}
            </p>
          </div>
          {{-- Date de première mise en circulation --}}
          <div class="mb-4">
            <p class="first-letter:capitalize text-sm font-medium text-gray-900 truncate">
              Date de première mise en circulation
            </p>
            <p class="text-sm text-gray-500 truncate">
              {{ $operation->voiture->date_de_première_mise_en_circulation ?? 'N/A' }}
            </p>
          </div>
          {{-- La date de dédouanement --}}
          <div class="mb-4">
            <p class="first-letter:capitalize text-sm font-medium text-gray-900 truncate">
              La date de dédouanement
            </p>
            <p class="text-sm text-gray-500 truncate">
              {{ $operation->voiture->date_de_dédouanement ?? 'N/A' }}
            </p>
          </div>
          {{-- Détails du voiture --}}
          <div class="mb-4">
            <a href="{{ route('mechanic.voitures.show',$operation->voiture->id) }}">
                <x-primary-button>Détails du voiture</x-primary-button>
            </a>
          </div>
        </div>
      </div>
    </div>
    {{-- Modal --}}
    <div id="imageModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-75 flex items-center justify-center">
      <div class="relative max-w-4xl w-full mx-auto">
        <img
          id="modalImage"
          src="{{ $operation->photo !== NULL ? asset('storage/'.$operation->photo) : '/images/defaultimage.jpg' }}"
          alt="Image agrandie"
          class="w-full max-h-[80vh] object-contain"
        >
        <button
          class="absolute top-4 right-4 text-white text-2xl font-bold bg-black bg-opacity-50 rounded-full px-3 py-1 hover:bg-opacity-75 hover:text-red-500 transition-all duration-300 ease-in"
          onclick="toggleModalImage(false)"
        >&times;</button>
      </div>
    </div>
  {{-- contet close colse --}}
  {{-- footer --}}
  <div class="p-2 border-2 border-gray-200 border-dashed rounded-lg mt-4">
    @include('layouts.footer')
  </div>
  </div>
  <script>
    const modal = document.getElementById('imageModal');
    const operationImage = document.getElementById('operationImage');
  
    operationImage.addEventListener('click', () => {
      toggleModalImage(true);
    });
  
    modal.addEventListener('click', (event) => {
      // Close the modal only if the click is outside the image
      if (event.target === modal) {
        toggleModalImage(false);
      }
    });
  
    function toggleModalImage(show) {
      modal.classList.toggle('hidden', !show);
      modal.classList.toggle('flex', show);
    }
  </script>
</x-mechanic-app-layout>