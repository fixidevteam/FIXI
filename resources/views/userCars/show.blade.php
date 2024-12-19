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
                href="{{ route('voiture.index') }}"
                class="inline-flex items-center text-sm font-medium text-gray-700   ">
                Mes voitures
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
                Détails du véhicule
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
          <h2 class="text-2xl font-bold leading-9 tracking-tight text-gray-900">Détails du véhicule</h2>
          <div class="flex items-center">
            <a href="{{route('voiture.edit',['voiture'=>$voiture])}}">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M11.9426 1.25L13.5 1.25C13.9142 1.25 14.25 1.58579 14.25 2C14.25 2.41421 13.9142 2.75 13.5 2.75H12C9.62177 2.75 7.91356 2.75159 6.61358 2.92637C5.33517 3.09825 4.56445 3.42514 3.9948 3.9948C3.42514 4.56445 3.09825 5.33517 2.92637 6.61358C2.75159 7.91356 2.75 9.62177 2.75 12C2.75 14.3782 2.75159 16.0864 2.92637 17.3864C3.09825 18.6648 3.42514 19.4355 3.9948 20.0052C4.56445 20.5749 5.33517 20.9018 6.61358 21.0736C7.91356 21.2484 9.62177 21.25 12 21.25C14.3782 21.25 16.0864 21.2484 17.3864 21.0736C18.6648 20.9018 19.4355 20.5749 20.0052 20.0052C20.5749 19.4355 20.9018 18.6648 21.0736 17.3864C21.2484 16.0864 21.25 14.3782 21.25 12V10.5C21.25 10.0858 21.5858 9.75 22 9.75C22.4142 9.75 22.75 10.0858 22.75 10.5V12.0574C22.75 14.3658 22.75 16.1748 22.5603 17.5863C22.366 19.031 21.9607 20.1711 21.0659 21.0659C20.1711 21.9607 19.031 22.366 17.5863 22.5603C16.1748 22.75 14.3658 22.75 12.0574 22.75H11.9426C9.63423 22.75 7.82519 22.75 6.41371 22.5603C4.96897 22.366 3.82895 21.9607 2.93414 21.0659C2.03933 20.1711 1.63399 19.031 1.43975 17.5863C1.24998 16.1748 1.24999 14.3658 1.25 12.0574V11.9426C1.24999 9.63423 1.24998 7.82519 1.43975 6.41371C1.63399 4.96897 2.03933 3.82895 2.93414 2.93414C3.82895 2.03933 4.96897 1.63399 6.41371 1.43975C7.82519 1.24998 9.63423 1.24999 11.9426 1.25ZM16.7705 2.27592C18.1384 0.908029 20.3562 0.908029 21.7241 2.27592C23.092 3.6438 23.092 5.86158 21.7241 7.22947L15.076 13.8776C14.7047 14.2489 14.4721 14.4815 14.2126 14.684C13.9069 14.9224 13.5761 15.1268 13.2261 15.2936C12.929 15.4352 12.6169 15.5392 12.1188 15.7052L9.21426 16.6734C8.67801 16.8521 8.0868 16.7126 7.68711 16.3129C7.28742 15.9132 7.14785 15.322 7.3266 14.7857L8.29477 11.8812C8.46079 11.3831 8.56479 11.071 8.7064 10.7739C8.87319 10.4239 9.07761 10.0931 9.31605 9.78742C9.51849 9.52787 9.7511 9.29529 10.1224 8.924L16.7705 2.27592ZM20.6634 3.33658C19.8813 2.55448 18.6133 2.55448 17.8312 3.33658L17.4546 3.7132C17.4773 3.80906 17.509 3.92327 17.5532 4.05066C17.6965 4.46372 17.9677 5.00771 18.48 5.51999C18.9923 6.03227 19.5363 6.30346 19.9493 6.44677C20.0767 6.49097 20.1909 6.52273 20.2868 6.54543L20.6634 6.16881C21.4455 5.38671 21.4455 4.11867 20.6634 3.33658ZM19.1051 7.72709C18.5892 7.50519 17.9882 7.14946 17.4193 6.58065C16.8505 6.01185 16.4948 5.41082 16.2729 4.89486L11.2175 9.95026C10.801 10.3668 10.6376 10.532 10.4988 10.7099C10.3274 10.9297 10.1804 11.1676 10.0605 11.4192C9.96337 11.623 9.88868 11.8429 9.7024 12.4017L9.27051 13.6974L10.3026 14.7295L11.5983 14.2976C12.1571 14.1113 12.377 14.0366 12.5808 13.9395C12.8324 13.8196 13.0703 13.6726 13.2901 13.5012C13.468 13.3624 13.6332 13.199 14.0497 12.7825L19.1051 7.72709Z" fill="#2563EB" />
              </svg>
            </a>
            <button type="submit" class="ml-5 text-red-500 flex items-center justify-center" onclick="toggleModal(true)">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.87787 4.24993C10.1871 3.37503 11.0215 2.75 12 2.75C12.9785 2.75 13.813 3.37503 14.1222 4.24993C14.2602 4.64047 14.6887 4.84517 15.0793 4.70713C15.4698 4.56909 15.6745 4.1406 15.5365 3.75007C15.022 2.29459 13.634 1.25 12 1.25C10.3661 1.25 8.97804 2.29459 8.46361 3.75007C8.32557 4.1406 8.53026 4.56909 8.9208 4.70713C9.31134 4.84517 9.73983 4.64047 9.87787 4.24993Z" fill="#DC2626" />
                <path d="M2.75 6C2.75 5.58579 3.08579 5.25 3.5 5.25H20.5001C20.9143 5.25 21.2501 5.58579 21.2501 6C21.2501 6.41421 20.9143 6.75 20.5001 6.75H3.5C3.08579 6.75 2.75 6.41421 2.75 6Z" fill="#DC2626" />
                <path d="M5.11686 7.75166C5.53015 7.72411 5.88753 8.03681 5.91508 8.45011L6.37503 15.3492C6.46488 16.6971 6.52891 17.6349 6.66948 18.3405C6.80583 19.025 6.99616 19.3873 7.26957 19.6431C7.54299 19.8988 7.91715 20.0647 8.60915 20.1552C9.32255 20.2485 10.2626 20.25 11.6134 20.25H12.3868C13.7376 20.25 14.6776 20.2485 15.391 20.1552C16.083 20.0647 16.4572 19.8988 16.7306 19.6431C17.004 19.3873 17.1943 19.025 17.3307 18.3405C17.4712 17.6349 17.5353 16.6971 17.6251 15.3492L18.0851 8.45011C18.1126 8.03681 18.47 7.72411 18.8833 7.75166C19.2966 7.77921 19.6093 8.13659 19.5818 8.54989L19.1183 15.5016C19.0328 16.7844 18.9637 17.8205 18.8018 18.6336C18.6334 19.4789 18.347 20.185 17.7554 20.7384C17.1638 21.2919 16.4402 21.5307 15.5856 21.6425C14.7635 21.75 13.7251 21.75 12.4395 21.75H11.5607C10.2751 21.75 9.23663 21.75 8.41459 21.6425C7.55994 21.5307 6.83639 21.2919 6.2448 20.7384C5.6532 20.185 5.36678 19.4789 5.19838 18.6336C5.03641 17.8205 4.96735 16.7844 4.88186 15.5016L4.41841 8.54989C4.39085 8.13659 4.70356 7.77921 5.11686 7.75166Z" fill="#DC2626" />
              </svg>
            </button>
          </div>

        </div>
        {{-- Details of cars --}}
        <div class="flex flex-col md:flex-row gap-10 items-center">
          {{-- Car Image --}}
          <div class="md:w-[160px] md:h-[160px] overflow-hidden md:rounded-full border flex-shrink-0">
            @if($voiture->photo !== NULL)
            <img class="w-full h-full object-cover" src="{{asset('storage/'.$voiture->photo)}}" alt="voiture image">
            @else
            <img class="w-full h-full object-cover" src="/images/defaultimage.jpg" alt="image description">
            @endif
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
        @if($voiture->operations->isNotEmpty())
        <div class="my-4 flex sm:justify-start">
          <a href="{{route('voiture.pdf',$voiture->id)}}">
            <x-primary-button class="block md:inline-block">Télécharger l’historique complet des opérations</x-primary-button>
          </a>
        </div>
        @endif

        {{-- details of cars close --}}
      </div>
    </div>
    <div class="p-2 border-2 border-gray-200 border-dashed rounded-lg mt-4">
      {{-- content (slot on layouts/app.blade.php)--}}
      <div class=" px-5 py-3 text-gray-700 bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="flex justify-between items-center my-6">
          <h2 class="text-2xl font-bold leading-9 tracking-tight text-gray-900">Liste des papiers du véhicule</h2>
          <div>
            <a href="{{route('paiperVoiture.create',$voiture)}}">
              <x-primary-button class="hidden md:block">ajouter un papier</x-primary-button>
              <x-primary-button class="sm:hidden">
                <svg class="w-5 h-5 text-white" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M12.75 9C12.75 8.58579 12.4142 8.25 12 8.25C11.5858 8.25 11.25 8.58579 11.25 9L11.25 11.25H9C8.58579 11.25 8.25 11.5858 8.25 12C8.25 12.4142 8.58579 12.75 9 12.75H11.25V15C11.25 15.4142 11.5858 15.75 12 15.75C12.4142 15.75 12.75 15.4142 12.75 15L12.75 12.75H15C15.4142 12.75 15.75 12.4142 15.75 12C15.75 11.5858 15.4142 11.25 15 11.25H12.75V9Z" fill="currentColor" />
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M12 1.25C6.06294 1.25 1.25 6.06294 1.25 12C1.25 17.9371 6.06294 22.75 12 22.75C17.9371 22.75 22.75 17.9371 22.75 12C22.75 6.06294 17.9371 1.25 12 1.25ZM2.75 12C2.75 6.89137 6.89137 2.75 12 2.75C17.1086 2.75 21.25 6.89137 21.25 12C21.25 17.1086 17.1086 21.25 12 21.25C6.89137 21.25 2.75 17.1086 2.75 12Z" fill="currentColor" />
                </svg>
              </x-primary-button>
            </a>
          </div>
        </div>
        {{-- table --}}
        <div class="my-5">
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
          <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            @if($voiture->papiersVoiture->isEmpty())
            <p class="p-4 text-gray-500 text-center">Aucun papier disponible.</p>
            @else
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
              <caption class="sr-only">Liste des papiers voiture</caption>
              <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                  <th scope="col" class="px-6 py-3">
                    type
                  </th>
                  <th scope="col" class="px-6 py-3">
                    date de debut
                  </th>
                  <th scope="col" class="px-6 py-3">
                    date de fin
                  </th>
                  <th scope="col" class="px-6 py-3">
                    Photo
                  </th>
                  <th scope="col" class="px-6 py-3">
                    Action
                  </th>
                  <th scope="col" class="px-6 py-3">

                  </th>
                </tr>
              </thead>
              <tbody>
                @foreach($voiture->papiersVoiture as $papier)
                <tr class="bg-white border-b">
                  <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                    <a href="{{route('paiperVoiture.show',$papier)}}">

                      {{$papier->type}}
                    </a>
                  </th>
                  <td class="px-6 py-4">
                    {{$papier->date_debut}}
                  </td>
                  <td class="px-6 py-4">
                    {{$papier->date_fin}}
                  </td>
                  <td class="px-6 py-4">
                    <a href="{{route('paiperVoiture.show',$papier)}}">

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
                    </a>
                  </td>
                  <td class="px-6 py-4">
                    <a href="{{route('paiperVoiture.show',$papier)}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Détails</a>
                  </td>
                  <td class="px-6 py-4">
                    @php
                    $dateFin = \Carbon\Carbon::parse($papier->date_fin);
                    $daysRemaining = now()->diffInDays($dateFin, false);
                    @endphp

                    @if($daysRemaining === 0)
                    <div class="flex items-center gap-1">
                      <svg class="text-red" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 7.25C12.4142 7.25 12.75 7.58579 12.75 8V12C12.75 12.4142 12.4142 12.75 12 12.75C11.5858 12.75 11.25 12.4142 11.25 12V8C11.25 7.58579 11.5858 7.25 12 7.25Z" fill="red" />
                        <path d="M12 16C12.5523 16 13 15.5523 13 15C13 14.4477 12.5523 14 12 14C11.4477 14 11 14.4477 11 15C11 15.5523 11.4477 16 12 16Z" fill="red" />
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8.72339 2.05112C10.1673 1.55658 11.0625 1.25 12 1.25C12.9375 1.25 13.8327 1.55658 15.2766 2.05112L16.004 2.30013C17.4854 2.8072 18.6286 3.19852 19.447 3.53099C19.8592 3.69846 20.2136 3.86067 20.499 4.02641C20.7737 4.1859 21.0492 4.38484 21.2364 4.65154C21.4214 4.91516 21.5171 5.23924 21.5772 5.55122C21.6397 5.87556 21.6774 6.26464 21.7017 6.71136C21.75 7.5984 21.75 8.81361 21.75 10.3898V11.9914C21.75 18.0924 17.142 21.0175 14.4017 22.2146L14.3746 22.2264C14.0348 22.3749 13.7154 22.5144 13.3484 22.6084C12.9609 22.7076 12.5493 22.75 12 22.75C11.4507 22.75 11.0391 22.7076 10.6516 22.6084C10.2846 22.5144 9.96523 22.3749 9.62543 22.2264L9.59833 22.2146C6.85803 21.0175 2.25 18.0924 2.25 11.9914V10.3899C2.25 8.81366 2.25 7.59841 2.2983 6.71136C2.32262 6.26464 2.36031 5.87556 2.42281 5.55122C2.48293 5.23924 2.5786 4.91516 2.76363 4.65154C2.95082 4.38484 3.22634 4.1859 3.50098 4.02641C3.78637 3.86067 4.14078 3.69846 4.55303 3.53099C5.3714 3.19852 6.51462 2.8072 7.99595 2.30014L8.72339 2.05112ZM12 2.75C11.3423 2.75 10.6951 2.96164 9.08062 3.5143L8.5078 3.71037C6.99521 4.22814 5.8921 4.60605 5.11759 4.92069C4.731 5.07774 4.4509 5.20935 4.25429 5.32353C4.15722 5.3799 4.09034 5.42642 4.04567 5.46273C4.0078 5.49351 3.99336 5.51095 3.99129 5.51349C3.98936 5.51663 3.97693 5.5374 3.95943 5.58654C3.93944 5.64265 3.91729 5.72309 3.89571 5.83506C3.85204 6.06169 3.81894 6.37301 3.79608 6.79292C3.75028 7.63411 3.75 8.80833 3.75 10.4167V11.9914C3.75 17.1665 7.6199 19.7135 10.1988 20.84C10.5703 21.0023 10.7848 21.0941 11.0236 21.1552C11.2517 21.2136 11.53 21.25 12 21.25C12.47 21.25 12.7483 21.2136 12.9764 21.1552C13.2152 21.0941 13.4297 21.0023 13.8012 20.84C16.3801 19.7135 20.25 17.1665 20.25 11.9914V10.4167C20.25 8.80833 20.2497 7.63411 20.2039 6.79292C20.1811 6.37301 20.148 6.06169 20.1043 5.83506C20.0827 5.72309 20.0606 5.64265 20.0406 5.58654C20.0231 5.53737 20.0106 5.5166 20.0087 5.51348C20.0066 5.51092 19.9922 5.49349 19.9543 5.46273C19.9097 5.42642 19.8428 5.3799 19.7457 5.32353C19.5491 5.20935 19.269 5.07774 18.8824 4.92069C18.1079 4.60605 17.0048 4.22814 15.4922 3.71037L14.9194 3.5143C13.3049 2.96164 12.6577 2.75 12 2.75Z" fill="red" />
                      </svg>
                      <span>Expire aujourd'hui</span>
                    </div>
                    @elseif($daysRemaining > 0 && $daysRemaining <= 7 )
                      <div class="flex items-center gap-1">
                      <svg class="text-orange-500" width="24" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12.5 2.75C7.39137 2.75 3.25 6.89137 3.25 12C3.25 17.1086 7.39137 21.25 12.5 21.25C17.6086 21.25 21.75 17.1086 21.75 12C21.75 6.89137 17.6086 2.75 12.5 2.75ZM1.75 12C1.75 6.06294 6.56294 1.25 12.5 1.25C18.4371 1.25 23.25 6.06294 23.25 12C23.25 17.9371 18.4371 22.75 12.5 22.75C6.56294 22.75 1.75 17.9371 1.75 12ZM12.5 7.25C12.9142 7.25 13.25 7.58579 13.25 8V11.6893L15.5303 13.9697C15.8232 14.2626 15.8232 14.7374 15.5303 15.0303C15.2374 15.3232 14.7626 15.3232 14.4697 15.0303L11.9697 12.5303C11.829 12.3897 11.75 12.1989 11.75 12V8C11.75 7.58579 12.0858 7.25 12.5 7.25Z" fill="currentColor" />
                      </svg>
                      <span>Ce document expire dans {{ $daysRemaining }} jours.</span>
          </div>
          @elseif($daysRemaining > 0 && $daysRemaining <= 90 )
            <div class=" flex items-center gap-1">
            <svg class="text-yellow-500" width="24" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" clip-rule="evenodd" d="M12.5 2.75C7.39137 2.75 3.25 6.89137 3.25 12C3.25 17.1086 7.39137 21.25 12.5 21.25C17.6086 21.25 21.75 17.1086 21.75 12C21.75 6.89137 17.6086 2.75 12.5 2.75ZM1.75 12C1.75 6.06294 6.56294 1.25 12.5 1.25C18.4371 1.25 23.25 6.06294 23.25 12C23.25 17.9371 18.4371 22.75 12.5 22.75C6.56294 22.75 1.75 17.9371 1.75 12ZM12.5 7.25C12.9142 7.25 13.25 7.58579 13.25 8V11.6893L15.5303 13.9697C15.8232 14.2626 15.8232 14.7374 15.5303 15.0303C15.2374 15.3232 14.7626 15.3232 14.4697 15.0303L11.9697 12.5303C11.829 12.3897 11.75 12.1989 11.75 12V8C11.75 7.58579 12.0858 7.25 12.5 7.25Z" fill="currentColor" />
            </svg>
            <span>Ce document expire dans {{ $daysRemaining }} jours.</span>
        </div>

        @elseif($daysRemaining < 0)
          <div class="flex items-center gap-1">
          <svg class="text-red" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 7.25C12.4142 7.25 12.75 7.58579 12.75 8V12C12.75 12.4142 12.4142 12.75 12 12.75C11.5858 12.75 11.25 12.4142 11.25 12V8C11.25 7.58579 11.5858 7.25 12 7.25Z" fill="red" />
            <path d="M12 16C12.5523 16 13 15.5523 13 15C13 14.4477 12.5523 14 12 14C11.4477 14 11 14.4477 11 15C11 15.5523 11.4477 16 12 16Z" fill="red" />
            <path fill-rule="evenodd" clip-rule="evenodd" d="M8.72339 2.05112C10.1673 1.55658 11.0625 1.25 12 1.25C12.9375 1.25 13.8327 1.55658 15.2766 2.05112L16.004 2.30013C17.4854 2.8072 18.6286 3.19852 19.447 3.53099C19.8592 3.69846 20.2136 3.86067 20.499 4.02641C20.7737 4.1859 21.0492 4.38484 21.2364 4.65154C21.4214 4.91516 21.5171 5.23924 21.5772 5.55122C21.6397 5.87556 21.6774 6.26464 21.7017 6.71136C21.75 7.5984 21.75 8.81361 21.75 10.3898V11.9914C21.75 18.0924 17.142 21.0175 14.4017 22.2146L14.3746 22.2264C14.0348 22.3749 13.7154 22.5144 13.3484 22.6084C12.9609 22.7076 12.5493 22.75 12 22.75C11.4507 22.75 11.0391 22.7076 10.6516 22.6084C10.2846 22.5144 9.96523 22.3749 9.62543 22.2264L9.59833 22.2146C6.85803 21.0175 2.25 18.0924 2.25 11.9914V10.3899C2.25 8.81366 2.25 7.59841 2.2983 6.71136C2.32262 6.26464 2.36031 5.87556 2.42281 5.55122C2.48293 5.23924 2.5786 4.91516 2.76363 4.65154C2.95082 4.38484 3.22634 4.1859 3.50098 4.02641C3.78637 3.86067 4.14078 3.69846 4.55303 3.53099C5.3714 3.19852 6.51462 2.8072 7.99595 2.30014L8.72339 2.05112ZM12 2.75C11.3423 2.75 10.6951 2.96164 9.08062 3.5143L8.5078 3.71037C6.99521 4.22814 5.8921 4.60605 5.11759 4.92069C4.731 5.07774 4.4509 5.20935 4.25429 5.32353C4.15722 5.3799 4.09034 5.42642 4.04567 5.46273C4.0078 5.49351 3.99336 5.51095 3.99129 5.51349C3.98936 5.51663 3.97693 5.5374 3.95943 5.58654C3.93944 5.64265 3.91729 5.72309 3.89571 5.83506C3.85204 6.06169 3.81894 6.37301 3.79608 6.79292C3.75028 7.63411 3.75 8.80833 3.75 10.4167V11.9914C3.75 17.1665 7.6199 19.7135 10.1988 20.84C10.5703 21.0023 10.7848 21.0941 11.0236 21.1552C11.2517 21.2136 11.53 21.25 12 21.25C12.47 21.25 12.7483 21.2136 12.9764 21.1552C13.2152 21.0941 13.4297 21.0023 13.8012 20.84C16.3801 19.7135 20.25 17.1665 20.25 11.9914V10.4167C20.25 8.80833 20.2497 7.63411 20.2039 6.79292C20.1811 6.37301 20.148 6.06169 20.1043 5.83506C20.0827 5.72309 20.0606 5.64265 20.0406 5.58654C20.0231 5.53737 20.0106 5.5166 20.0087 5.51348C20.0066 5.51092 19.9922 5.49349 19.9543 5.46273C19.9097 5.42642 19.8428 5.3799 19.7457 5.32353C19.5491 5.20935 19.269 5.07774 18.8824 4.92069C18.1079 4.60605 17.0048 4.22814 15.4922 3.71037L14.9194 3.5143C13.3049 2.96164 12.6577 2.75 12 2.75Z" fill="red" />
          </svg>
          <span>Ce document est expiré.</span>
      </div>
      @else
      <div class="flex items-center gap-1">
        <svg class="text-green-500" width="24" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" clip-rule="evenodd" d="M12.5 2.75C7.39137 2.75 3.25 6.89137 3.25 12C3.25 17.1086 7.39137 21.25 12.5 21.25C17.6086 21.25 21.75 17.1086 21.75 12C21.75 6.89137 17.6086 2.75 12.5 2.75ZM1.75 12C1.75 6.06294 6.56294 1.25 12.5 1.25C18.4371 1.25 23.25 6.06294 23.25 12C23.25 17.9371 18.4371 22.75 12.5 22.75C6.56294 22.75 1.75 17.9371 1.75 12ZM12.5 7.25C12.9142 7.25 13.25 7.58579 13.25 8V11.6893L15.5303 13.9697C15.8232 14.2626 15.8232 14.7374 15.5303 15.0303C15.2374 15.3232 14.7626 15.3232 14.4697 15.0303L11.9697 12.5303C11.829 12.3897 11.75 12.1989 11.75 12V8C11.75 7.58579 12.0858 7.25 12.5 7.25Z" fill="currentColor" />
        </svg>
        <span>Jours restants avant expiration : {{ $daysRemaining }}</span>
      </div>
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
  <div class="p-2 border-2 border-gray-200 border-dashed rounded-lg mt-4">
    {{-- content (slot on layouts/app.blade.php)--}}
    <div class=" px-5 py-3 text-gray-700 bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div class="flex justify-between items-center my-6">
        <h2 class="text-2xl font-bold leading-9 tracking-tight text-gray-900">Liste des operations du véhicule</h2>
        <div>
          <a href="{{route('operation.create')}}">
            <x-primary-button class="hidden md:block">ajouter une operation</x-primary-button>
            <x-primary-button class="sm:hidden">
              <svg class="w-5 h-5 text-white" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12.75 9C12.75 8.58579 12.4142 8.25 12 8.25C11.5858 8.25 11.25 8.58579 11.25 9L11.25 11.25H9C8.58579 11.25 8.25 11.5858 8.25 12C8.25 12.4142 8.58579 12.75 9 12.75H11.25V15C11.25 15.4142 11.5858 15.75 12 15.75C12.4142 15.75 12.75 15.4142 12.75 15L12.75 12.75H15C15.4142 12.75 15.75 12.4142 15.75 12C15.75 11.5858 15.4142 11.25 15 11.25H12.75V9Z" fill="currentColor" />
                <path fill-rule="evenodd" clip-rule="evenodd" d="M12 1.25C6.06294 1.25 1.25 6.06294 1.25 12C1.25 17.9371 6.06294 22.75 12 22.75C17.9371 22.75 22.75 17.9371 22.75 12C22.75 6.06294 17.9371 1.25 12 1.25ZM2.75 12C2.75 6.89137 6.89137 2.75 12 2.75C17.1086 2.75 21.25 6.89137 21.25 12C21.25 17.1086 17.1086 21.25 12 21.25C6.89137 21.25 2.75 17.1086 2.75 12Z" fill="currentColor" />
              </svg>
            </x-primary-button>
          </a>
        </div>
      </div>
      {{-- table --}}
      <div class="my-5">

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
          @if($voiture->operations->isEmpty())
          <p class="p-4 text-gray-500 text-center">Aucun opération disponible.</p>
          @else
          <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <caption class="sr-only">Liste des opérations</caption>
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
              <tr>
                <th scope="col" class="px-6 py-3">Categorie</th>
                <th scope="col" class="px-6 py-3">Operation</th>
                <th scope="col" class="px-6 py-3">Photo</th>
                <th scope="col" class="px-6 py-3">Date d'operation</th>
                <th scope="col" class="px-6 py-3">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($voiture->operations as $operation)
              <tr class="bg-white border-b">
                {{-- Categorie --}}
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                  <a href="{{ route('operation.show',$operation->id) }}">
                    {{
                      $categories->where('id',$operation->categorie)->first()->nom_categorie ;
                    }}
                  </a>
                </th>

                {{-- nom --}}
                <td class="px-6 py-4">
                  {{
                      $operation->nom === 'Autre' 
                      ? $operation->autre_operation 
                      : ($operations->where('id', $operation->nom)->first()->nom_operation ?? 'N/A')
                  }}
                </td>

                {{-- description --}}
                <td class="px-6 py-4">
                  <a href="{{ route('operation.show',$operation->id) }}">
                    @if($operation->photo !== NULL)
                    <img class="rounded-full w-8 h-8 object-cover" src="{{asset('storage/'.$operation->photo)}}" alt="image description">
                    @else
                    <img class="rounded-full w-8 h-8 object-cover" src="/images/defaultimage.jpg" alt="image description">
                    @endif
                  </a>
                </td>

                {{-- date doperation --}}
                <td class="px-6 py-4">
                  {{ $operation->date_operation }}
                </td>
                {{-- Action --}}
                <td class="px-6 py-4">
                  <a href="{{ route('operation.show',$operation->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Détails</a>
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

  <!-- Confirmation Modal (Hidden by default) -->
  <div id="confirmationModal" class="fixed inset-0 bg-white bg-opacity-30 backdrop-blur-[2px] flex items-center justify-center hidden">
    <div class="bg-white rounded-lg p-6 w-96 shadow-lg ">
      <h2 class="text-lg font-bold text-gray-800">Confirmation de suppression</h2>
      <p class="text-gray-600 mt-2">Êtes-vous sûr de vouloir supprimer cette voiture ? Cette action ne peut pas être annulée.</p>

      <!-- Action Buttons -->
      <div class="flex justify-end mt-4">
        <button onclick="toggleModal(false)" class="px-4 py-2 bg-gray-300 text-gray-800 rounded mr-2">
          Annuler
        </button>
        <form id="deleteForm" action="{{ route('voiture.destroy', ['voiture' => $voiture->id]) }}" method="POST">
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
</x-app-layout>