<x-admin-app-layout>
  <div class="p-4 sm:ml-64">
      <div class="p-2 border-2 border-gray-200 border-dashed rounded-lg mt-14">
          {{-- Breadcrumb navigation --}}
          <nav
              class="flex px-5 py-3 text-gray-700 bg-white overflow-hidden shadow-sm sm:rounded-lg"
              aria-label="Breadcrumb">
              <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
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
                              href="{{ route('admin.gestionPromotions.index') }}"
                              class="inline-flex items-center text-sm font-medium text-gray-700">
                              Gestion des promotions
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
                              href="{{ route('admin.gestionPromotions.edit', $promotion->id) }}"
                              class="inline-flex items-center text-sm font-medium text-gray-700">
                              Modifier promotion
                          </a>
                      </div>
                  </li>
              </ol>
          </nav>
      </div>

      {{-- Content --}}
      <div class="p-2 border-2 border-gray-200 border-dashed rounded-lg mt-4">
          <div class="px-5 py-3 text-gray-700 bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <h2 class="mt-10 text-2xl font-bold leading-9 tracking-tight text-gray-900">Modifier promotion</h2>
              <form method="POST" action="{{ route('admin.gestionPromotions.update', $promotion->id) }}" class="space-y-6" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div>
                      <x-input-label for="nom_promotion" :value="__('Promotion')" />
                      <x-text-input id="nom_promotion" class="block mt-1 w-full" type="text" name="nom_promotion" :value="old('nom_promotion', $promotion->nom_promotion)" autofocus autocomplete="nom_promotion" />
                      <x-input-error :messages="$errors->get('nom_promotion')" class="mt-2" />
                  </div>
                  <div>
                      <x-input-label for="ville" :value="__('Ville')" />
                      <select id="ville" name="ville" class="block mt-1 w-full rounded-md border-0 py-1.5 text-sm text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                          <option value="" selected>{{ __('Choisissez la ville') }}</option>
                          @foreach($villes as $ville)
                              <option value="{{ $ville->ville }}" {{ old('ville', $promotion->ville) == $ville->ville ? 'selected' : '' }}>
                                  {{ $ville->ville }}
                              </option>
                          @endforeach
                      </select>
                      <x-input-error :messages="$errors->get('ville')" class="mt-2" />
                  </div>
                  <div>
                      <x-input-label for="date_debut" :value="__('Date début')" />
                      <x-text-input id="date_debut" class="block mt-1 w-full" type="date" name="date_debut" :value="old('date_debut', $promotion->date_debut)" autofocus autocomplete="date_debut" />
                      <x-input-error :messages="$errors->get('date_debut')" class="mt-2" />
                  </div>
                  <div>
                      <x-input-label for="date_fin" :value="__('Date de fin')" />
                      <x-text-input id="date_fin" class="block mt-1 w-full" type="date" name="date_fin" :value="old('date_fin', $promotion->date_fin)" autofocus autocomplete="date_fin" />
                      <x-input-error :messages="$errors->get('date_fin')" class="mt-2" />
                  </div>
                  <div>
                      <x-input-label for="lien_promotion" :value="__('Lien promotion')" />
                      <x-text-input id="lien_promotion" class="block mt-1 w-full" type="text" name="lien_promotion" :value="old('lien_promotion', $promotion->lien_promotion)" autofocus autocomplete="lien_promotion" />
                      <x-input-error :messages="$errors->get('lien_promotion')" class="mt-2" />
                  </div>
                  <div>
                      <x-input-label for="garage" :value="__('Garage')" />
                      <select id="garage" name="garage_id" class="block mt-1 w-full rounded-md border-0 py-1.5 text-sm text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                          <option value="">Select garage</option>
                          @foreach ($garages as $garage)
                              <option value="{{ $garage->id }}" {{ old('garage_id', $promotion->garage_id) == $garage->id ? 'selected' : '' }}>
                                  {{ $garage->name }}{{ $garage->quartier ? ' - ' . $garage->quartier : '' }}
                              </option>
                          @endforeach
                      </select>
                      <x-input-error :messages="$errors->get('garage_id')" class="mt-2" />
                  </div>
                  <div>
                    <x-input-label for="description" :value="__('Description')" />
                    <x-text-textarea id="description" class="block mt-1 w-full" name="description" autofocus autocomplete="description">
                        {{ old('description') ?? $promotion->description }}
                    </x-text-textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>
                  <div>
                      <x-input-label for="file_input" :value="__('Photo')" />
                      <x-file-input id="file_input" class="block mt-1 w-full" type="file" name="photo_promotion" autofocus autocomplete="photo_promotion" accept="image/*" />
                      <x-input-error :messages="$errors->get('photo_promotion')" class="mt-2" />
                  </div>

                  <div class="flex items-center justify-end mt-4">
                      <x-primary-button class="flex justify-center rounded-[20px] bg-red-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-gray-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                          {{ __('Modifier promotion') }}
                      </x-primary-button>
                  </div>
              </form>
          </div>
      </div>

      {{-- Footer --}}
      <div class="p-2 border-2 border-gray-200 border-dashed rounded-lg mt-4">
          @include('layouts.footer')
      </div>
  </div>
</x-admin-app-layout>
