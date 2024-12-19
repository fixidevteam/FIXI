<x-mechanic-app-layout>
  <div class="p-4 sm:ml-64">
    <div class="p-2 border-2 border-gray-200 border-dashed rounded-lg mt-14">
      {{-- content (slot on layouts/app.blade.php)--}}
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          <div class="flex flex-col md:flex-row md:justify-between md:items-center">
            <h1 class="text-lg font-medium text-gray-900">Bonjour, {{ Auth::user()->name }} </h1>
            <div>
              <h2 class="text-lg font-medium text-gray-900 flex items-center">
                REF: 
                <span id="garage-ref" class="cursor-pointer ml-2 flex items-center">
                  {{ Auth::user()->garage?->ref }}
                  <!-- Copy Icon -->
                  <svg 
                        id="copy-icon"
                        class="ml-1 w-4 h-4 text-gray-700 hover:text-gray-900" 
                        xmlns="http://www.w3.org/2000/svg" 
                        viewBox="0 0 24 24" 
                        fill="none">
                        <path 
                            fill-rule="evenodd" 
                            clip-rule="evenodd" 
                            d="M7.2626 3.26045C7.38219 2.13044 8.33828 1.25 9.5 1.25H14.5C15.6617 1.25 16.6178 2.13044 16.7374 3.26045C17.5005 3.27599 18.1603 3.31546 18.7236 3.41895C19.4816 3.55818 20.1267 3.82342 20.6517 4.34835C21.2536 4.95027 21.5125 5.70814 21.6335 6.60825C21.75 7.47522 21.75 8.57754 21.75 9.94513V16.0549C21.75 17.4225 21.75 18.5248 21.6335 19.3918C21.5125 20.2919 21.2536 21.0497 20.6517 21.6517C20.0497 22.2536 19.2919 22.5125 18.3918 22.6335C17.5248 22.75 16.4225 22.75 15.0549 22.75H8.94513C7.57754 22.75 6.47522 22.75 5.60825 22.6335C4.70814 22.5125 3.95027 22.2536 3.34835 21.6517C2.74643 21.0497 2.48754 20.2919 2.36652 19.3918C2.24996 18.5248 2.24998 17.4225 2.25 16.0549V9.94513C2.24998 8.57754 2.24996 7.47522 2.36652 6.60825C2.48754 5.70814 2.74643 4.95027 3.34835 4.34835C3.87328 3.82342 4.51835 3.55818 5.27635 3.41895C5.83973 3.31546 6.49952 3.27599 7.2626 3.26045ZM7.26496 4.76087C6.54678 4.7762 5.99336 4.81234 5.54735 4.89426C4.98054 4.99838 4.65246 5.16556 4.40901 5.40901C4.13225 5.68577 3.9518 6.07435 3.85315 6.80812C3.75159 7.56347 3.75 8.56458 3.75 10V16C3.75 17.4354 3.75159 18.4365 3.85315 19.1919C3.9518 19.9257 4.13225 20.3142 4.40901 20.591C4.68577 20.8678 5.07435 21.0482 5.80812 21.1469C6.56347 21.2484 7.56458 21.25 9 21.25H15C16.4354 21.25 17.4365 21.2484 18.1919 21.1469C18.9257 21.0482 19.3142 20.8678 19.591 20.591C19.8678 20.3142 20.0482 19.9257 20.1469 19.1919C20.2484 18.4365 20.25 17.4354 20.25 16V10C20.25 8.56458 20.2484 7.56347 20.1469 6.80812C20.0482 6.07434 19.8678 5.68577 19.591 5.40901C19.3475 5.16556 19.0195 4.99838 18.4527 4.89426C18.0066 4.81234 17.4532 4.7762 16.735 4.76087C16.6058 5.88062 15.6544 6.75 14.5 6.75H9.5C8.34559 6.75 7.39424 5.88062 7.26496 4.76087ZM9.5 2.75C9.08579 2.75 8.75 3.08579 8.75 3.5V4.5C8.75 4.91421 9.08579 5.25 9.5 5.25H14.5C14.9142 5.25 15.25 4.91421 15.25 4.5V3.5C15.25 3.08579 14.9142 2.75 14.5 2.75H9.5ZM6.25 10.5C6.25 10.0858 6.58579 9.75 7 9.75H17C17.4142 9.75 17.75 10.0858 17.75 10.5C17.75 10.9142 17.4142 11.25 17 11.25H7C6.58579 11.25 6.25 10.9142 6.25 10.5ZM7.25 14C7.25 13.5858 7.58579 13.25 8 13.25H16C16.4142 13.25 16.75 13.5858 16.75 14C16.75 14.4142 16.4142 14.75 16 14.75H8C7.58579 14.75 7.25 14.4142 7.25 14ZM8.25 17.5C8.25 17.0858 8.58579 16.75 9 16.75H15C15.4142 16.75 15.75 17.0858 15.75 17.5C15.75 17.9142 15.4142 18.25 15 18.25H9C8.58579 18.25 8.25 17.9142 8.25 17.5Z" 
                            fill="currentColor" 
                        />
                    </svg>
                  <!-- Check Icon (hidden by default) -->
                  <svg id="check-icon" 
                       class="ml-1 w-4 h-4 text-green-600 hidden" 
                       xmlns="http://www.w3.org/2000/svg" 
                       fill="none" 
                       viewBox="0 0 24 24" 
                       stroke-width="1.5" 
                       stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                </span>
              </h2>
            </div>
          </div>
          <p class="text-sm text-gray-600 md:w-[300px] sm:w-full mx-0 text-left">Ajoutez vos informations en quelques clics,et accédez à une vue d’ensemble claire et sécurisée de toutes vos données importantes.</p>
          <div class="mt-4">
            <a href="{{ route('mechanic.operations.index') }}">
              <x-primary-button>mes opération</x-primary-button>
            </a>
          </div>
        </div>
      </div>
    </div>
    {{-- content --}}
    <div class="p-2 border-2 border-gray-200 border-dashed rounded-lg mt-4">
      {{-- content (slot on layouts/app.blade.php)--}}
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div class="p-6 text-gray-900">
        <!-- THE CHART  -->
        <form method="GET" action="{{ route('mechanic.dashboard') }}" class="mb-4 w-full flex flex-col sm:flex-row sm:items-end items-end justify-between  gap-4">
          <!-- Dropdown Container -->
          <div class="flex flex-col w-full  ">
            <label for="year" class="text-sm font-medium text-gray-700 mb-1 sm:mb-0">Sélectionnez l'année :</label>
            <select name="year" id="year" class="block mt-1 w-full rounded-md border-0 py-1.5 text-sm text-gray-900  shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
              @foreach($years as $year)
              <option value="{{ $year }}" {{ $year == $selectedYear ? 'selected' : '' }}>
                {{ $year }}
              </option>
              @endforeach
            </select>
          </div>

          <!-- Submit Button -->
          <x-primary-button class="">
            {{ __('Filter') }}
          </x-primary-button>
        </form>
        <canvas id="operationsChart" height="250" class="w-full bg-white"></canvas>
        <!-- END OF CHART -->
      </div>
      </div>
    </div>

    <div class="p-2 border-2 border-gray-200 border-dashed rounded-lg mt-4">
      {{-- content (slot on layouts/app.blade.php)--}}
      <div>
        <div>
          <div class="w-full grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
            {{-- box 1 --}}
            <div class="flex items-center bg-white p-8 rounded-lg shadow">
              <div class="flex-shrink-0">
                <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">{{ Auth::user()->garage->operations()->count() }}</span>
                <h3 class="text-base font-normal text-gray-500 first-letter:capitalize">nombre des operations</h3>
              </div>
              <div class="ml-5 w-0 flex items-center justify-end flex-1 text-gray-600 text-base font-bold">
                <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
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
            {{-- box 2 --}}
            <div class="flex items-center bg-white p-8 rounded-lg shadow">
              <div class="flex-shrink-0">
                <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">
                  {{
                                    $voituresCount = Auth::user()->garage->operations()
                                    ->whereHas('voiture')
                                    ->distinct('voiture_id')
                                    ->count('voiture_id')
                                }}
                </span>
                <h3 class="text-base font-normal text-gray-500 first-letter:capitalize">nombre des véhicules</h3>
              </div>
              <div class="ml-5 w-0 flex items-center justify-end flex-1 text-gray-600 text-base font-bold">
                <svg class="w-5 h-5" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M16.3939 2.02121L16.4604 2.03904C17.5598 2.33361 18.431 2.56704 19.1162 2.81458C19.8172 3.06779 20.3888 3.35744 20.8597 3.79847C21.5453 4.44068 22.0252 5.27179 22.2385 6.18671C22.385 6.81503 22.3501 7.45486 22.2189 8.18849C22.0906 8.90573 21.8572 9.77697 21.5626 10.8764L21.0271 12.8747C20.7326 13.974 20.4991 14.8452 20.2516 15.5305C19.9984 16.2314 19.7087 16.803 19.2677 17.2739C18.6459 17.9377 17.8471 18.4087 16.9665 18.6316C16.7093 19.2213 16.3336 19.7554 15.8597 20.1993C15.3888 20.6403 14.8172 20.9299 14.1162 21.1832C13.431 21.4307 12.5598 21.6641 11.4605 21.9587L11.394 21.9765C10.2946 22.2711 9.42337 22.5045 8.70613 22.6328C7.9725 22.764 7.33266 22.7989 6.70435 22.6524C5.78943 22.4391 4.95832 21.9592 4.31611 21.2736C3.87508 20.8027 3.58542 20.2311 3.33222 19.5302C3.08468 18.8449 2.85124 17.9737 2.55667 16.8743L2.02122 14.876C1.72664 13.7766 1.4932 12.9054 1.36495 12.1882C1.23376 11.4546 1.19881 10.8147 1.34531 10.1864C1.55864 9.27149 2.03849 8.44038 2.72417 7.79817C3.19505 7.35714 3.76664 7.06749 4.46758 6.81428C5.15283 6.56674 6.02404 6.3333 7.12341 6.03873L7.15665 6.02983C7.42112 5.95896 7.67134 5.89203 7.90825 5.82944C8.29986 4.43031 8.64448 3.44126 9.31611 2.72417C9.95831 2.03849 10.7894 1.55864 11.7043 1.34531C12.3327 1.19881 12.9725 1.23376 13.7061 1.36495C14.4233 1.49319 15.2945 1.72664 16.3939 2.02121ZM7.45502 7.5028C6.36214 7.79571 5.57905 8.00764 4.9772 8.22505C4.36778 8.4452 4.00995 8.64907 3.74955 8.89296C3.2804 9.33237 2.95209 9.90103 2.80613 10.527C2.72511 10.8745 2.72747 11.2863 2.84152 11.9242C2.95723 12.5712 3.17355 13.381 3.47902 14.521L3.99666 16.4529C4.30212 17.5929 4.51967 18.4023 4.74299 19.0205C4.96314 19.63 5.16701 19.9878 5.4109 20.2482C5.85031 20.7173 6.41897 21.0456 7.04496 21.1916C7.39242 21.2726 7.80425 21.2703 8.4421 21.1562C9.08915 21.0405 9.89893 20.8242 11.0389 20.5187C12.1789 20.2132 12.9884 19.9957 13.6066 19.7724C14.216 19.5522 14.5739 19.3484 14.8343 19.1045C14.9719 18.9756 15.0973 18.8357 15.2096 18.6865C15.0306 18.6612 14.8463 18.629 14.6557 18.5911C13.9839 18.4575 13.1769 18.2413 12.1808 17.9744L12.1234 17.959C11.024 17.6644 10.1528 17.431 9.46758 17.1835C8.76664 16.9302 8.19505 16.6406 7.72416 16.1996C7.03849 15.5574 6.55864 14.7262 6.34531 13.8113C6.19881 13.183 6.23376 12.5432 6.36494 11.8095C6.4932 11.0923 6.72664 10.2211 7.02122 9.12174L7.45502 7.5028ZM13.4421 2.84152C12.8042 2.72747 12.3924 2.72511 12.045 2.80613C11.419 2.95209 10.8503 3.2804 10.4109 3.74955C9.97479 4.21518 9.70642 4.93452 9.2397 6.64323C9.16384 6.92093 9.08365 7.22023 8.99665 7.54488L8.47902 9.47673C8.17355 10.6167 7.95723 11.4265 7.84152 12.0736C7.72747 12.7114 7.72511 13.1232 7.80613 13.4707C7.95209 14.0967 8.2804 14.6654 8.74955 15.1048C9.00995 15.3487 9.36778 15.5525 9.9772 15.7727C10.5954 15.996 11.4049 16.2136 12.5449 16.519C13.5703 16.7938 14.3303 16.997 14.9482 17.1199C15.5635 17.2422 15.981 17.2723 16.3232 17.23C16.3976 17.2209 16.4691 17.2082 16.5389 17.1919C17.1649 17.0459 17.7335 16.7176 18.1729 16.2485C18.4168 15.9881 18.6207 15.6303 18.8408 15.0208C19.0642 14.4026 19.2817 13.5932 19.5872 12.4532L20.1048 10.5213C20.4103 9.38129 20.6266 8.57151 20.7423 7.92446C20.8564 7.28661 20.8587 6.87479 20.7777 6.52733C20.6317 5.90133 20.3034 5.33267 19.8343 4.89327C19.5739 4.64937 19.216 4.4455 18.6066 4.22535C17.9884 4.00203 17.1789 3.78448 16.0389 3.47902C14.8989 3.17355 14.0892 2.95723 13.4421 2.84152Z" fill="currentColor" />
                </svg>
              </div>
            </div>
            {{-- box 3 --}}
            <div class="flex items-center bg-white p-8 rounded-lg shadow">
              <div class="flex-shrink-0">
                <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">
                  @php
                  $mechanic = Auth::guard('mechanic')->user();

                  $clientsCount = \App\Models\User::whereHas('voitures', function ($query) use ($mechanic) {
                  $query->whereHas('operations', function ($operationQuery) use ($mechanic) {
                  $operationQuery->where('garage_id', $mechanic->garage_id);
                  });
                  })->distinct('id')->count('id');
                  @endphp
                  {{$clientsCount}} </span>
                <h3 class="text-base font-normal text-gray-500 first-letter:capitalize">nombre des clients</h3>
              </div>
              <div class="ml-5 w-0 flex items-center justify-end flex-1 text-gray-600 text-base font-bold">
                <svg class="w-5 h-5" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M9 1.25C6.37665 1.25 4.25 3.37665 4.25 6C4.25 8.62335 6.37665 10.75 9 10.75C11.6234 10.75 13.75 8.62335 13.75 6C13.75 3.37665 11.6234 1.25 9 1.25ZM5.75 6C5.75 4.20507 7.20507 2.75 9 2.75C10.7949 2.75 12.25 4.20507 12.25 6C12.25 7.79493 10.7949 9.25 9 9.25C7.20507 9.25 5.75 7.79493 5.75 6Z" fill="currentColor" />
                  <path d="M15 2.25C14.5858 2.25 14.25 2.58579 14.25 3C14.25 3.41421 14.5858 3.75 15 3.75C16.2426 3.75 17.25 4.75736 17.25 6C17.25 7.24264 16.2426 8.25 15 8.25C14.5858 8.25 14.25 8.58579 14.25 9C14.25 9.41421 14.5858 9.75 15 9.75C17.0711 9.75 18.75 8.07107 18.75 6C18.75 3.92893 17.0711 2.25 15 2.25Z" fill="currentColor" />
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M3.67815 13.5204C5.07752 12.7208 6.96067 12.25 9 12.25C11.0393 12.25 12.9225 12.7208 14.3219 13.5204C15.7 14.3079 16.75 15.5101 16.75 17C16.75 18.4899 15.7 19.6921 14.3219 20.4796C12.9225 21.2792 11.0393 21.75 9 21.75C6.96067 21.75 5.07752 21.2792 3.67815 20.4796C2.3 19.6921 1.25 18.4899 1.25 17C1.25 15.5101 2.3 14.3079 3.67815 13.5204ZM4.42236 14.8228C3.26701 15.483 2.75 16.2807 2.75 17C2.75 17.7193 3.26701 18.517 4.42236 19.1772C5.55649 19.8253 7.17334 20.25 9 20.25C10.8267 20.25 12.4435 19.8253 13.5776 19.1772C14.733 18.517 15.25 17.7193 15.25 17C15.25 16.2807 14.733 15.483 13.5776 14.8228C12.4435 14.1747 10.8267 13.75 9 13.75C7.17334 13.75 5.55649 14.1747 4.42236 14.8228Z" fill="currentColor" />
                  <path d="M18.1607 13.2674C17.7561 13.1787 17.3561 13.4347 17.2674 13.8393C17.1787 14.2439 17.4347 14.6439 17.8393 14.7326C18.6317 14.9064 19.2649 15.2048 19.6829 15.5468C20.1014 15.8892 20.25 16.2237 20.25 16.5C20.25 16.7507 20.1294 17.045 19.7969 17.3539C19.462 17.665 18.9475 17.9524 18.2838 18.1523C17.8871 18.2717 17.6624 18.69 17.7818 19.0867C17.9013 19.4833 18.3196 19.708 18.7162 19.5886C19.5388 19.3409 20.2743 18.9578 20.8178 18.4529C21.3637 17.9457 21.75 17.2786 21.75 16.5C21.75 15.6352 21.2758 14.912 20.6328 14.3859C19.9893 13.8593 19.1225 13.4783 18.1607 13.2674Z" fill="currentColor" />
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
                <h3 class="text-xl font-bold leading-none text-gray-900 first-letter:capitalize">la liste des operations</h3>
                <a href="{{ route('mechanic.operations.index') }}" class="text-sm font-medium text-blue-600 hover:bg-gray-100 rounded-lg inline-flex items-center p-2">
                  Afficher tout
                </a>
              </div>
              <div class="flow-root">
                @if(Auth::user()->garage->operations->isEmpty())
                <p class="p-4 text-gray-500 text-center">Aucun operation disponible.</p>
                @else
                <ul role="list" class="divide-y divide-gray-200">
                  @foreach (Auth::user()->garage->operations->take(5) as $operation)
                  <li class="py-3 sm:py-4">
                    <div class="flex items-center space-x-4">
                      <div class="flex-shrink-0">
                        @if($operation->photo !== NULL)
                        <img class="h-8 w-8 rounded-full object-cover" src="{{asset('storage/'.$operation->photo)}}" alt="Neil image">
                        @else
                        <img class="rounded-full w-8 h-8 object-cover" src="/images/defaultimage.jpg" alt="image description">
                        @endif
                      </div>
                      <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate">
                          @php
                          $categorie = App\Models\nom_categorie::find($operation->categorie);
                          @endphp
                          {{$categorie->nom_categorie}}
                        </p>
                        <p class="text-sm text-gray-500 truncate">
                          @php
                                $nomOp = $operation->nom === 'Autre'
                                ? "Autre" // Display "autre" or a default
                                : App\Models\nom_operation::find($operation->nom);
                          @endphp
                                {{ is_string($nomOp) ? $nomOp : ($nomOp->nom_operation ?? 'N/A') }}
                        </p>
                      </div>
                      <div class="inline-flex items-center text-base font-semibold text-gray-900">
                        <a href="{{ route('mechanic.operations.show',$operation->id) }}" class="text-sm font-medium text-blue-600  inline-flex items-center p-2 capitalize hover:underline">Détails</a>
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
                <h3 class="text-xl font-bold leading-none text-gray-900 first-letter:capitalize">la liste des véhicules</h3>
                <a href="{{ route('mechanic.voitures.index') }}" class="text-sm font-medium text-blue-600 hover:bg-gray-100 rounded-lg inline-flex items-center p-2">
                  Afficher tout
                </a>
              </div>
              <div class="flow-root">
                @if(Auth::user()->garage->operations->isEmpty())
                <p class="p-4 text-gray-500 text-center">Aucun voiture disponible.</p>
                @else
                <ul role="list" class="divide-y divide-gray-200">
                  @foreach (Auth::user()->garage->operations->take(5) as $operation)
                  <li class="py-3 sm:py-4">
                    <div class="flex items-center space-x-4">
                      <div class="flex-shrink-0">
                        @if($operation->voiture->photo !== NULL)
                        <img class="h-8 w-8 rounded-full object-cover" src="{{asset('storage/'.$operation->voiture->photo)}}" alt="Neil image">
                        @else
                        <img class="rounded-full w-8 h-8 object-cover" src="/images/defaultimage.jpg" alt="image description">
                        @endif
                      </div>
                      <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate">
                          {{$operation->voiture->marque ." ". $operation->voiture->modele}}
                        </p>
                        <p class="text-sm text-gray-500 truncate">
                          <span>{{ explode('-', $operation->voiture->numero_immatriculation)[0] }}</span>-<span dir="rtl">{{ explode('-', $operation->voiture->numero_immatriculation)[1] }}</span>-<span>{{ explode('-', $operation->voiture->numero_immatriculation)[2] }}</span>
                        </p>
                      </div>
                      <div class="inline-flex items-center text-base font-semibold text-gray-900">
                        <a href="{{ route('mechanic.voitures.show',$operation->voiture->id) }}" class="text-sm font-medium text-blue-600  inline-flex items-center p-2 capitalize hover:underline">Détails</a>
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
  <script>
    // Data passed from the controller
    const labels = @json($labels); // Month names
    const values = @json($values); // Operation counts

    const ctx = document.getElementById('operationsChart').getContext('2d');
    new Chart(ctx, {
      type: 'line',
      data: {
        labels: labels, // Labels for the x-axis
        datasets: [{
          label: 'Nombre des operations',
          data: values, // Data for the y-axis
          backgroundColor: 'rgb(220, 38, 28)',
          borderColor: 'rgb(220, 38, 28)',
          borderWidth: 1,
          tension: 0.4,

        }]
      },
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: true,
            ticks: {
              stepSize: 1,
              callback: function(value) {
                return Number.isInteger(value) ? value : '';
              }
            }
          }
        }
      }
    });
  </script>
</x-mechanic-app-layout>