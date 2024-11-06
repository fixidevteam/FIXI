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
                href="#"
                class="inline-flex items-center text-sm font-medium text-gray-700   ">
                Details du Véhicule
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
          <h2 class="text-2xl font-bold leading-9 tracking-tight text-gray-900">Details du véhicule</h2>
        </div>
        {{-- Details of cars --}}
        <div class="flex flex-col md:flex-row gap-10 items-center">
          {{-- Car Image --}}
          <div class="w-[160px] h-[160px] overflow-hidden rounded-full border flex-shrink-0">
            <img class="w-full h-full object-cover" src="{{asset('storage/'.$voiture->photo)}}" alt="voiture image">
          </div>

          {{-- Car Details in Two Columns --}}
          <div class="flex flex-col md:flex-row gap-5 w-full justify-center md:justify-start">
            {{-- Column 1 --}}
            <div class="flex-1 space-y-4">
              {{-- Marque --}}
              <div>
                <p class="capitalize text-sm font-medium text-gray-900">Marque</p>
                <p class="text-sm text-gray-500">Test</p>
              </div>

              {{-- Matricule --}}
              <div>
                <p class="capitalize text-sm font-medium text-gray-900">Matricule</p>
                <p class="text-sm text-gray-500">1111-a-21</p>
              </div>

              {{-- Modèle --}}
              <div>
                <p class="capitalize text-sm font-medium text-gray-900">Modèle</p>
                <p class="text-sm text-gray-500">iuiuiui</p>
              </div>
            </div>

            {{-- Column 2 --}}
            <div class="flex-1 space-y-4">
              {{-- Date de première mise en circulation --}}
              <div>
                <p class="capitalize text-sm font-medium text-gray-900">Date de première mise en circulation</p>
                <p class="text-sm text-gray-500">{{$voiture->date_de_première_mise_en_circulation}}</p>
              </div>

              {{-- Date d'achat --}}
              <div>
                <p class="capitalize text-sm font-medium text-gray-900">Date d'achat</p>
                <p class="text-sm text-gray-500">{{$voiture->date_achat}}</p>
              </div>

              {{-- Date de dédouanement --}}
              <div>
                <p class="capitalize text-sm font-medium text-gray-900">Date de dédouanement</p>
                <p class="text-sm text-gray-500">{{$voiture->date_de_dédouanement}}</p>
              </div>
            </div>
          </div>
        </div>
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
          <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            @if($voiture->papiersVoiture->isEmpty())
            <p class="p-4 text-gray-500 text-center">Aucune papier disponible.</p>
            @else
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
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
                    {{$papier->type}}
                  </th>
                  <td class="px-6 py-4">
                    {{$papier->date_debut}}
                  </td>
                  <td class="px-6 py-4">
                    {{$papier->date_fin}}
                  </td>
                  <td class="px-6 py-4">
                    @if($papier->photo !== NULL)
                    <img class="rounded-full w-8 h-8" src="{{asset('storage/'.$papier->photo)}}" alt="image description">
                    @else
                    <img class="rounded-full w-8 h-8" src="../images/defaultimage.jpg" alt="image description">
                    @endif
                  </td>
                  <td class="px-6 py-4">
                    <a href="{{route('paiperVoiture.show',$papier)}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Detail</a>
                  </td>
                  <td class="px-6 py-4">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
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
            <a href="">
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
            <p class="p-4 text-gray-500 text-center">Aucune opération disponible.</p>
            @else
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
              <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                  <th scope="col" class="px-6 py-3">Categorie</th>
                  <th scope="col" class="px-6 py-3">Operation</th>
                  <th scope="col" class="px-6 py-3">Description</th>
                  <th scope="col" class="px-6 py-3">Date d'operation</th>
                  <th scope="col" class="px-6 py-3">Action</th>
                  <th scope="col" class="px-6 py-3"></th>
                </tr>
              </thead>
              <tbody>
                @foreach($voiture->operations as $operation)
                <tr class="bg-white border-b">
                  {{-- Categorie --}}
                  <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                    {{ $operation->categorie }}
                  </th>

                  {{-- nom --}}
                  <td class="px-6 py-4">
                    {{ $operation->nom }}
                  </td>

                  {{-- description --}}
                  <td class="px-6 py-4">
                    {{ $operation->description }}
                  </td>

                  {{-- date doperation --}}
                  <td class="px-6 py-4">
                    {{ $operation->date_operation }}
                  </td>



                  {{-- Action --}}
                  <td class="px-6 py-4">
                    <a href="" class="font-medium text-blue-600 hover:underline">Editer</a>
                  </td>

                  {{-- Delete --}}
                  <td class="px-6 py-4">
                    <form action="" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="font-medium text-red-600 hover:underline">Supprimer</button>
                    </form>
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
    {{-- contet close colse --}}
    {{-- footer --}}
    <div class="p-2 border-2 border-gray-200 border-dashed rounded-lg mt-4">
      @include('layouts.footer')
    </div>
  </div>
</x-app-layout>