<x-app-layout>
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
              href="{{ route('dashboard') }}"
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
                href="{{ route('garages.index') }}"
                class="inline-flex items-center text-sm font-medium text-gray-700   ">
                Listing des garage
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
                Détails des garages
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
          <h2 class="text-2xl font-bold leading-9 tracking-tight text-gray-900">Détails des garages</h2>
        </div>
        {{-- details of garage --}}
        <div class="flex justify-between items-center my-6">
          <h3 class="text-xl font-medium leading-9 tracking-tight text-gray-900">{{$garage->name}}</h3>
        </div>
        <div class="flex flex-col justify-center gap-4 my-8 overflow-hidden">
          <img
          class="w-full h-96 object-cover cursor-pointer hover:scale-105 transition-all duration-300 ease-in"
          src="{{ $garage->photo !== NULL ? asset('storage/'.$garage->photo) : '/images/defaultimage.jpg' }}"
          alt="Garage Image"
          id="garageImage"
        >
        </div>        
        <div class="grid grid-cols-1 md:grid-cols-2">
          {{-- ville --}}
          <div class="mb-4">
            <p class="first-letter:capitalize text-sm font-medium text-gray-900 ">
              ville
            </p>
            <p class="text-sm text-gray-500 ">
              {{$garage->ville}}
            </p>
          </div>
          {{-- quartier --}}
          @if($garage->quartier !== NULL)
          <div class="mb-4">
            <p class="first-letter:capitalize text-sm font-medium text-gray-900 ">
              quartier
            </p>
            <p class="text-sm text-gray-500 ">
              {{$garage->quartier}}
            </p>
          </div>
          @endif
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2">
          {{-- localisation --}}
        @if($garage->localisation !== NULL)
        <div class="mb-4">
          <p class="capitalize text-sm font-medium text-gray-900">
            localisation
          </p>
          <p class="text-sm text-gray-500">
            {{$garage->localisation}}
          </p>
        </div>
        @endif
          {{-- virtualGarage --}}
          @if($garage->virtualGarage !== NULL)
          <div>
            <p class="first-letter:capitalize text-sm font-medium text-gray-900 ">
              virtual garage
            </p>
              <a href="{{$garage->virtualGarage}}" class="text-sm text-blue-500 hover:underline">{{ $garage->name }}</a>
          </div>
          @endif
        </div>
        {{-- details of garage close --}}
      </div>
    </div>
    {{-- Modal for Image --}}
    <div id="imageModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-75 flex items-center justify-center">
      <div class="relative max-w-4xl w-full mx-auto">
        <img 
          id="modalImage" 
          src="{{ $garage->photo ? asset('storage/' . $garage->photo) : '/images/defaultimage.jpg' }}" 
          alt="Expanded Garage Image" 
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
    const garageImage = document.getElementById('garageImage');
  
    if (garageImage) {
      garageImage.addEventListener('click', () => {
        toggleModalImage(true);
      });
    }
  
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
</x-app-layout>