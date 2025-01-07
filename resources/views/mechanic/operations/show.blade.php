<x-mechanic-app-layout :subtitle="'Détails d’opération'">
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
        {{-- test --}}
        <div class="flex flex-col md:flex-row gap-10 items-center my-6">
          <div class="md:w-[500px] md:h-[250px] overflow-hidden  border flex-shrink-0">
            <img
              class="w-full h-full object-cover cursor-pointer"
              src="{{ $operation->photo ? asset('storage/'.$operation->photo) : asset('/images/defaultimage.jpg') }}"
              alt="{{ $operation->photo ? 'Operation Image' : 'Default Image' }}"
              id="operationImage">
          </div>

          {{-- Details in Two Columns --}}
          <div class="flex flex-col md:flex-row gap-5 w-full justify-center md:justify-start">
            {{-- Column 1 --}}
            <div class="flex-1 space-y-4">
              <div>
                <p class="capitalize text-sm font-medium text-gray-900">Categorie</p>
                <p class="text-sm text-gray-500">
                  {{ $categories->where('id', $operation->categorie)->first()->nom_categorie ?? 'N/A' }}
                </p>
              </div>
              <div>
                <p class="first-letter:uppercase text-sm font-medium text-gray-900">date d'operation</p>
                <p class="text-sm text-gray-500">
                  {{ $operation->date_operation }}
                </p>
              </div>
              @if($operation->description !== NULL)
              <div>
                <p class="first-letter:uppercase text-sm font-medium text-gray-900">description</p>
                <p class="text-sm text-gray-500">
                  {{ $operation->description }}
                </p>
              </div>
              @endif
            </div>
            {{-- Column 2 --}}
            <div class="flex-1 space-y-4">
              <div>
                <p class="capitalize text-sm font-medium text-gray-900">operation</p>
                <p class="text-sm text-gray-500">
                  {{ 
                    $operation->nom === 'Autre' 
                    ? $operation->autre_operation
                    : ($ope->where('id', $operation->nom)->first()->nom_operation ?? 'N/A') 
                  }}
                </p>
              </div>
              @if(!$operation->sousoperations->isEmpty())
              <div>
                <p class="first-letter:uppercase text-sm font-medium text-gray-900">Sous operation</p>
                @foreach ($operation->sousoperations as $sousOp)
                <p class="text-sm text-gray-500 truncate">
                  {{$sousOperation->where('id', $sousOp->nom)->first()->nom_sous_operation }}
                </p>
                @endforeach
              </div>
              @endif
            </div>
          </div>
        </div>
        {{-- test --}}
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