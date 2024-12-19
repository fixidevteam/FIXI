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
        <div class="flex flex-col justify-center gap-4 my-8 overflow-hidden">
          <img
          class="w-full h-72 object-cover cursor-pointer hover:scale-105 transition-all duration-300 ease-in"
          src="{{ $garage->photo !== NULL ? asset('storage/'.$garage->photo) : '/images/defaultimage.jpg' }}"
          alt="Garage Image"
          id="garageImage"
        >
        </div>
        <div class="flex justify-between items-center my-6">
          <h3 class="text-xl font-medium leading-9 tracking-tight text-gray-900">{{$garage->name}}</h3>
        </div>        
        <div>
          {{-- ville --}}
          <div class="mb-4">
            <p class="first-letter:capitalize text-sm font-medium text-gray-900 ">
              ville
            </p>
            <p class="text-sm text-red-700 font-bold">
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
        <div>
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
          <div class="mb-4">
            <p class="first-letter:capitalize text-sm font-medium text-gray-900 ">
              virtual garage
            </p>
              <a href="{{$garage->virtualGarage}}" class="text-sm text-blue-500 hover:underline" target="_blank">
                <span class="flex items-center">
                  {{ $garage->name }}
                  <svg class="ml-2 w-4 h-4" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 1.25H11.9426C9.63423 1.24999 7.82519 1.24998 6.41371 1.43975C4.96897 1.63399 3.82895 2.03933 2.93414 2.93414C2.03933 3.82895 1.63399 4.96897 1.43975 6.41371C1.24998 7.82519 1.24999 9.63423 1.25 11.9426V12.0574C1.24999 14.3658 1.24998 16.1748 1.43975 17.5863C1.63399 19.031 2.03933 20.1711 2.93414 21.0659C3.82895 21.9607 4.96897 22.366 6.41371 22.5603C7.82519 22.75 9.63423 22.75 11.9426 22.75H12.0574C14.3658 22.75 16.1748 22.75 17.5863 22.5603C19.031 22.366 20.1711 21.9607 21.0659 21.0659C21.9607 20.1711 22.366 19.031 22.5603 17.5863C22.75 16.1748 22.75 14.3658 22.75 12.0574V12C22.75 11.5858 22.4142 11.25 22 11.25C21.5858 11.25 21.25 11.5858 21.25 12C21.25 14.3782 21.2484 16.0864 21.0736 17.3864C20.9018 18.6648 20.5749 19.4355 20.0052 20.0052C19.4355 20.5749 18.6648 20.9018 17.3864 21.0736C16.0864 21.2484 14.3782 21.25 12 21.25C9.62178 21.25 7.91356 21.2484 6.61358 21.0736C5.33517 20.9018 4.56445 20.5749 3.9948 20.0052C3.42514 19.4355 3.09825 18.6648 2.92637 17.3864C2.75159 16.0864 2.75 14.3782 2.75 12C2.75 9.62178 2.75159 7.91356 2.92637 6.61358C3.09825 5.33517 3.42514 4.56445 3.9948 3.9948C4.56445 3.42514 5.33517 3.09825 6.61358 2.92637C7.91356 2.75159 9.62178 2.75 12 2.75C12.4142 2.75 12.75 2.41421 12.75 2C12.75 1.58579 12.4142 1.25 12 1.25Z" fill="currentColor"/>
                    <path d="M12.4697 10.4697C12.1768 10.7626 12.1768 11.2374 12.4697 11.5303C12.7626 11.8232 13.2374 11.8232 13.5303 11.5303L21.25 3.81066V7.34375C21.25 7.75796 21.5858 8.09375 22 8.09375C22.4142 8.09375 22.75 7.75796 22.75 7.34375V2C22.75 1.58579 22.4142 1.25 22 1.25H16.6562C16.242 1.25 15.9062 1.58579 15.9062 2C15.9062 2.41421 16.242 2.75 16.6562 2.75H20.1893L12.4697 10.4697Z" fill="currentColor"/>
                    </svg>                    
                </span>
              </a>
          </div>
          @endif
        </div>
        <div>
          {{-- localisation --}}
        @if($garage->services !== NULL)
        <div class="mb-4">
          <p class="capitalize text-sm font-medium text-gray-900">
            Domaines
          </p>
          <p class="text-sm text-red-700 font-bold">
            {{ implode(' / ', $garage->services) }}
          </p>
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