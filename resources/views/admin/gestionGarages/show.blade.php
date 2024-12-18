<x-admin-app-layout>
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
              href="{{ route('admin.dashboard') }}"
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
                href="{{ route('admin.gestionGarages.index') }}"
                class="inline-flex items-center text-sm font-medium text-gray-700   ">
                Gestion des garages
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
        <div class="flex justify-between items-center my-6">
          <h3 class="text-xl font-medium leading-9 tracking-tight text-gray-900">{{$garage->name}}</h3>
          <div class="flex items-center">
            <a href="{{route('admin.gestionGarages.edit',$garage->id)}}">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M11.9426 1.25L13.5 1.25C13.9142 1.25 14.25 1.58579 14.25 2C14.25 2.41421 13.9142 2.75 13.5 2.75H12C9.62177 2.75 7.91356 2.75159 6.61358 2.92637C5.33517 3.09825 4.56445 3.42514 3.9948 3.9948C3.42514 4.56445 3.09825 5.33517 2.92637 6.61358C2.75159 7.91356 2.75 9.62177 2.75 12C2.75 14.3782 2.75159 16.0864 2.92637 17.3864C3.09825 18.6648 3.42514 19.4355 3.9948 20.0052C4.56445 20.5749 5.33517 20.9018 6.61358 21.0736C7.91356 21.2484 9.62177 21.25 12 21.25C14.3782 21.25 16.0864 21.2484 17.3864 21.0736C18.6648 20.9018 19.4355 20.5749 20.0052 20.0052C20.5749 19.4355 20.9018 18.6648 21.0736 17.3864C21.2484 16.0864 21.25 14.3782 21.25 12V10.5C21.25 10.0858 21.5858 9.75 22 9.75C22.4142 9.75 22.75 10.0858 22.75 10.5V12.0574C22.75 14.3658 22.75 16.1748 22.5603 17.5863C22.366 19.031 21.9607 20.1711 21.0659 21.0659C20.1711 21.9607 19.031 22.366 17.5863 22.5603C16.1748 22.75 14.3658 22.75 12.0574 22.75H11.9426C9.63423 22.75 7.82519 22.75 6.41371 22.5603C4.96897 22.366 3.82895 21.9607 2.93414 21.0659C2.03933 20.1711 1.63399 19.031 1.43975 17.5863C1.24998 16.1748 1.24999 14.3658 1.25 12.0574V11.9426C1.24999 9.63423 1.24998 7.82519 1.43975 6.41371C1.63399 4.96897 2.03933 3.82895 2.93414 2.93414C3.82895 2.03933 4.96897 1.63399 6.41371 1.43975C7.82519 1.24998 9.63423 1.24999 11.9426 1.25ZM16.7705 2.27592C18.1384 0.908029 20.3562 0.908029 21.7241 2.27592C23.092 3.6438 23.092 5.86158 21.7241 7.22947L15.076 13.8776C14.7047 14.2489 14.4721 14.4815 14.2126 14.684C13.9069 14.9224 13.5761 15.1268 13.2261 15.2936C12.929 15.4352 12.6169 15.5392 12.1188 15.7052L9.21426 16.6734C8.67801 16.8521 8.0868 16.7126 7.68711 16.3129C7.28742 15.9132 7.14785 15.322 7.3266 14.7857L8.29477 11.8812C8.46079 11.3831 8.56479 11.071 8.7064 10.7739C8.87319 10.4239 9.07761 10.0931 9.31605 9.78742C9.51849 9.52787 9.7511 9.29529 10.1224 8.924L16.7705 2.27592ZM20.6634 3.33658C19.8813 2.55448 18.6133 2.55448 17.8312 3.33658L17.4546 3.7132C17.4773 3.80906 17.509 3.92327 17.5532 4.05066C17.6965 4.46372 17.9677 5.00771 18.48 5.51999C18.9923 6.03227 19.5363 6.30346 19.9493 6.44677C20.0767 6.49097 20.1909 6.52273 20.2868 6.54543L20.6634 6.16881C21.4455 5.38671 21.4455 4.11867 20.6634 3.33658ZM19.1051 7.72709C18.5892 7.50519 17.9882 7.14946 17.4193 6.58065C16.8505 6.01185 16.4948 5.41082 16.2729 4.89486L11.2175 9.95026C10.801 10.3668 10.6376 10.532 10.4988 10.7099C10.3274 10.9297 10.1804 11.1676 10.0605 11.4192C9.96337 11.623 9.88868 11.8429 9.7024 12.4017L9.27051 13.6974L10.3026 14.7295L11.5983 14.2976C12.1571 14.1113 12.377 14.0366 12.5808 13.9395C12.8324 13.8196 13.0703 13.6726 13.2901 13.5012C13.468 13.3624 13.6332 13.199 14.0497 12.7825L19.1051 7.72709Z" fill="#2563EB" />
              </svg>
            </a>
            <button type="submit" class="ml-5 text-red-500 flex items-center justify-center" onclick="toggleModalDelete(true)">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.87787 4.24993C10.1871 3.37503 11.0215 2.75 12 2.75C12.9785 2.75 13.813 3.37503 14.1222 4.24993C14.2602 4.64047 14.6887 4.84517 15.0793 4.70713C15.4698 4.56909 15.6745 4.1406 15.5365 3.75007C15.022 2.29459 13.634 1.25 12 1.25C10.3661 1.25 8.97804 2.29459 8.46361 3.75007C8.32557 4.1406 8.53026 4.56909 8.9208 4.70713C9.31134 4.84517 9.73983 4.64047 9.87787 4.24993Z" fill="#DC2626" />
                <path d="M2.75 6C2.75 5.58579 3.08579 5.25 3.5 5.25H20.5001C20.9143 5.25 21.2501 5.58579 21.2501 6C21.2501 6.41421 20.9143 6.75 20.5001 6.75H3.5C3.08579 6.75 2.75 6.41421 2.75 6Z" fill="#DC2626" />
                <path d="M5.11686 7.75166C5.53015 7.72411 5.88753 8.03681 5.91508 8.45011L6.37503 15.3492C6.46488 16.6971 6.52891 17.6349 6.66948 18.3405C6.80583 19.025 6.99616 19.3873 7.26957 19.6431C7.54299 19.8988 7.91715 20.0647 8.60915 20.1552C9.32255 20.2485 10.2626 20.25 11.6134 20.25H12.3868C13.7376 20.25 14.6776 20.2485 15.391 20.1552C16.083 20.0647 16.4572 19.8988 16.7306 19.6431C17.004 19.3873 17.1943 19.025 17.3307 18.3405C17.4712 17.6349 17.5353 16.6971 17.6251 15.3492L18.0851 8.45011C18.1126 8.03681 18.47 7.72411 18.8833 7.75166C19.2966 7.77921 19.6093 8.13659 19.5818 8.54989L19.1183 15.5016C19.0328 16.7844 18.9637 17.8205 18.8018 18.6336C18.6334 19.4789 18.347 20.185 17.7554 20.7384C17.1638 21.2919 16.4402 21.5307 15.5856 21.6425C14.7635 21.75 13.7251 21.75 12.4395 21.75H11.5607C10.2751 21.75 9.23663 21.75 8.41459 21.6425C7.55994 21.5307 6.83639 21.2919 6.2448 20.7384C5.6532 20.185 5.36678 19.4789 5.19838 18.6336C5.03641 17.8205 4.96735 16.7844 4.88186 15.5016L4.41841 8.54989C4.39085 8.13659 4.70356 7.77921 5.11686 7.75166Z" fill="#DC2626" />
              </svg>
            </button>
          </div>
        </div>

        <div class="flex flex-col md:flex-row gap-10 items-center">
          <div class="md:w-[160px] md:h-[160px] overflow-hidden md:rounded-full border flex-shrink-0">
            <img
              class="w-full h-full object-cover cursor-pointer hover:scale-105 transition-all duration-300 ease-in"
              src="{{ $garage->photo ? asset('storage/'.$garage->photo) : asset('/images/defaultimage.jpg') }}"
              alt="{{ $garage->photo ? 'Garage Image' : 'Default Image' }}"
              id="garageImage">
          </div>

          {{-- Car Details in Two Columns --}}
          <div class="flex flex-col md:flex-row gap-5 w-full justify-center md:justify-start">
            {{-- Column 1 --}}
            <div class="flex-1 space-y-4">
              {{-- garage --}}
              <div>
                <p class="capitalize text-sm font-medium text-gray-900">Garage</p>
                <p class="text-sm text-gray-500">{{$garage->name}}{{ $garage->quartier ? ' - ' . $garage->quartier : '' }}</p>
              </div>
              {{-- ref --}}
              <div>
                <p class="capitalize text-sm font-medium text-gray-900">Reference de garage</p>
                <p class="text-sm text-gray-500">{{$garage->ref}}</p>
              </div>
              <div>
                <p class="capitalize text-sm font-medium text-gray-900"> Localisation</p>
                <p class="text-sm text-gray-500">{{$garage->localisation ?? 'N/A'}}</p>
              </div>
              <div>
                <p class="capitalize text-sm font-medium text-gray-900">Domaines</p>
                <p class="text-sm text-gray-500"> 
                    @if($garage->services)
                        {{ implode(' / ', $garage->services) }}
                    @else
                        <span class="text-sm text-gray-500">N/A</span>
                    @endif
                </p>
              </div>
            </div>

            {{-- Column 2 --}}
            <div class="flex-1 space-y-4">
              {{-- location --}}
              <div>
                <p class="capitalize text-sm font-medium text-gray-900">Ville</p>
                <p class="text-sm text-gray-500">{{$garage->ville ?? 'N/A'}}</p>
              </div>
              <div>
                <p class="capitalize text-sm font-medium text-gray-900">quartier</p>
                <p class="text-sm text-gray-500">{{$garage->quartier ?? 'N/A'}}</p>
              </div>
              <div>
                <p class="capitalize text-sm font-medium text-gray-900">virtual garage</p>
                <p class="text-sm text-gray-500">
                  {!! 
                    $garage->virtualGarage 
                        ? '<a  href="'.$garage->virtualGarage.'" target="_blank"><svg class="w-5 h-5 text-gray-500 transition duration-75 hover:text-gray-900" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M8.88558 3.36262C11.8283 0.545795 16.5864 0.545795 19.5291 3.36262C22.4903 6.19714 22.4903 10.807 19.5291 13.6415L11.581 21.2495C9.49097 23.2502 6.11532 23.2502 4.02525 21.2495C1.91669 19.2312 1.91669 15.9446 4.02525 13.9263L11.859 6.42771C13.0964 5.24324 15.0896 5.24325 16.327 6.42771C17.5829 7.62989 17.5829 9.59316 16.327 10.7953L8.43612 18.3486C8.13689 18.635 7.66213 18.6247 7.37571 18.3254C7.08929 18.0262 7.09967 17.5515 7.39889 17.265L15.2898 9.71175C15.9286 9.10021 15.9286 8.12285 15.2898 7.5113C14.6324 6.88205 13.5536 6.88205 12.8962 7.5113L5.06248 15.0098C3.57095 16.4376 3.57095 18.7382 5.06248 20.1659C6.57251 21.6114 9.03377 21.6114 10.5438 20.1659L18.4919 12.5579C20.836 10.314 20.836 6.6901 18.4919 4.4462C16.1292 2.1846 12.2855 2.1846 9.9228 4.4462L3.51861 10.5764C3.21939 10.8628 2.74463 10.8524 2.45821 10.5532C2.17179 10.254 2.18216 9.77924 2.48139 9.49281L8.88558 3.36262Z" fill="currentColor"/>
                            </svg></a>'
                        : 'N/A' 
                  !!}
                </p>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
    <div class="p-2 border-2 border-gray-200 border-dashed rounded-lg mt-4">
      {{-- content (slot on layouts/app.blade.php)--}}
      <div class=" px-5 py-3 text-gray-700 bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="flex justify-between items-center my-6">
          <h2 class="text-2xl font-bold leading-9 tracking-tight text-gray-900">Liste des garagiste</h2>
        </div>
        {{-- table --}}
        <div class="my-5">

          <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            @if($garage->mechanics->isEmpty())
            <p class="p-4 text-gray-500 text-center">Aucun mécanicien assigné à ce garage.</p>
            @else
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
              <caption class="sr-only">Liste des mécaniciens</caption>
              <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                  <th scope="col" class="px-6 py-3">garagiste nom</th>
                  <th scope="col" class="px-6 py-3">email</th>
                  <th scope="col" class="px-6 py-3">tel</th>
                  <th scope="col" class="px-6 py-3">status</th>
                </tr>
              </thead>
              <tbody>
                @foreach($garage->mechanics as $mechanic)
                <tr class="bg-white border-b">
                  <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                    {{$mechanic->name}}
                  </th>
                  <td class="px-6 py-4">
                    {{$mechanic->email}}
                  </td>
                  <td class="px-6 py-4">
                    {{$mechanic->telephone ?? 'N/A'}}
                  </td>
                  <td class="px-6 py-4">
                    @if ($mechanic->status)
                    <span class="inline-flex items-center bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                      <span class="w-2 h-2 me-1 bg-green-500 rounded-full"></span>
                      Active
                    </span>
                    @else
                    <span class="inline-flex items-center bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                      <span class="w-2 h-2 me-1 bg-red-500 rounded-full"></span>
                      Inactive
                    </span>
                    @endif
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            @endif
          </div>

        </div>
        {{-- table close --}}
      </div>
    </div>
    {{-- Modal --}}
    <div id="imageModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-75 flex items-center justify-center">
      <div class="relative max-w-4xl w-full mx-auto">
        <img
          id="modalImage"
          src="{{ $garage->photo !== NULL ? asset('storage/'.$garage->photo) : asset('/images/defaultimage.jpg') }}"
          alt="Expanded Garage Image"
          class="w-full max-h-[80vh] object-contain">
        <button
          class="absolute top-4 right-4 text-white text-2xl font-bold bg-black bg-opacity-50 rounded-full px-3 py-1 hover:bg-opacity-75"
          onclick="toggleModalImage(false)">&times;</button>
      </div>
    </div>
    <!-- Confirmation Modal (Hidden by default) -->
    <div id="confirmationModal" class="fixed inset-0 bg-white bg-opacity-30 backdrop-blur-[2px] flex items-center justify-center hidden">
      <div class="bg-white rounded-lg p-6 w-96 shadow-lg ">
        <h2 class="text-lg font-bold text-gray-800">Confirmation de suppression</h2>
        <p class="text-gray-600 mt-2">Êtes-vous sûr de vouloir supprimer cette garage ? Cette action ne peut pas être annulée.</p>

        <!-- Action Buttons -->
        <div class="flex justify-end mt-4">
          <button onclick="toggleModalDelete(false)" class="px-4 py-2 bg-gray-300 text-gray-800 rounded mr-2">
            Annuler
          </button>
          <form id="deleteForm" action="{{ route('admin.gestionGarages.destroy', $garage->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
              confirmer
            </button>
          </form>
        </div>
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
      // Close the modal if the click is outside the image
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