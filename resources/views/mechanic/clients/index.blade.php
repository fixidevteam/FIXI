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
                              class="inline-flex items-center text-sm font-medium text-gray-700   ">
                              La liste des clients
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
                  <h2 class="text-2xl font-bold leading-9 tracking-tight text-gray-900">Liste des clients</h2>
              </div>
              {{-- search --}}
              <div>
                <form action="{{ route('mechanic.clients.index') }}" method="GET" class="flex items-center w-full mx-auto">   
                  <label for="simple-search" class="sr-only">Search</label>
                  <div class="w-full">
                      <input type="text" name="search" value="{{ old('search', $search) }}" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-500 block w-full ps-5 p-2.5" placeholder="client nom"  />
                  </div>
                  <button type="submit" class="p-2.5 ms-2 text-sm font-medium text-white bg-gray-700 rounded-lg border border-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300">
                      <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                      </svg>
                      <span class="sr-only">Search</span>
                  </button>
                {{-- Reset Button --}}
                <a href="{{ route('mechanic.clients.index') }}" class="p-2.5 ms-2 bg-gray-200 text-gray-900 rounded-lg hover:bg-gray-300">
                    Réinitialiser
                </a>
                </form>
              </div>
              {{-- search close --}}
              {{-- table --}}
              <div class="my-5">
                  <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                      @if($clients->isEmpty())
                      <p class="p-4 text-gray-500 text-center">Aucune client disponible.</p>
                      @else
                      <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                          <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    nom
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    email
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    tel
                                </th>
                            </tr>
                          </thead>
                          <tbody>
                              @foreach($clients as $client)
                              <tr class="bg-white border-b">
                                  <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $client->name }}
                                  </th>
                                  <td class="px-6 py-4">
                                    {{ $client->email }}
                                  </td>
                                  <td class="px-6 py-4">
                                    {{ $client->telephone }}
                                  </td>
                              </tr>
                              @endforeach
                          </tbody>
                      </table>
                  </div>
                  @endif
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
</x-mechanic-app-layout>