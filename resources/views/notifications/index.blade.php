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
                              href="{{ route('notifications.index') }}"
                              class="inline-flex items-center text-sm font-medium text-gray-700   ">
                              Notifications
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
          <h2 class="my-10  text-2xl font-bold leading-9 tracking-tight text-gray-900">Notifications</h2>
          {{-- notifications --}}
            {{-- Paiper Personnels Notifications --}}
            <div class="my-4">
              <h2 class="mb-2 text-xl font-medium leading-9 tracking-tight text-gray-900">Papiers Personnels</h2>
              @if($paipersPersonnels->isEmpty())
                  <p>Aucune notification pour les paipers personnels.</p>
              @else
              <div class="flow-root">
                <dl class="-my-3 divide-y divide-gray-100 text-sm">
                  @foreach($paipersPersonnels as $papier)
                  @php
                      $daysRemaining = now()->diffInDays($papier->date_fin, false);
                  @endphp
                  {{-- type --}}
                  <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Type</dt>
                    <dd class="text-gray-700 sm:col-span-2">{{ $papier->type }}</dd>
                  </div>
                  {{-- date fin --}}
                  <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Date de fin</dt>
                    <dd class="text-gray-700 sm:col-span-2">{{ $papier->date_fin }}</dd>
                  </div>
                  {{-- expiration --}}
                  <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Expiration</dt>
                    @if($daysRemaining === 0)
                    <dd class="text-gray-700 sm:col-span-2">Expire aujourd'hui.</dd>
                    @elseif($daysRemaining > 0 && $daysRemaining <= 7)
                    <dd class="text-gray-700 sm:col-span-2">Expire bientôt dans {{ $daysRemaining }} jours.</dd>
                    @elseif($daysRemaining < 0)
                    <dd class="text-gray-700 sm:col-span-2">Ce document est expiré.</dd>
                    @endif
                  </div>
                  @endforeach
                </dl>
              </div>
              @endif
            </div>
    {{-- Papier Voitures Notifications --}}
    <h2 class="mb-2 text-xl font-medium leading-9 tracking-tight text-gray-900">Papiers Voitures</h2>
    @if($papiersVoitures->isEmpty())
        <p>Aucune notification pour les papiers voitures.</p>
    @else
    <div class="my-4">
      <div class="flow-root">
        <dl class="-my-3 divide-y divide-gray-100 text-sm">
              @foreach($papiersVoitures as $papier)
                  @php
                      $daysRemaining = now()->diffInDays($papier->date_fin, false);
                  @endphp
  
                  {{-- type --}}
                  <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Type</dt>
                    <dd class="text-gray-700 sm:col-span-2">{{ $papier->type }}</dd>
                  </div>
                  {{-- date fin --}}
                  <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Date de fin</dt>
                    <dd class="text-gray-700 sm:col-span-2">{{ $papier->date_fin }}</dd>
                  </div>
                  {{-- expiration --}}
                  <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Expiration</dt>
                    @if($daysRemaining === 0)
                    <dd class="text-gray-700 sm:col-span-2">Expire aujourd'hui.</dd>
                    @elseif($daysRemaining > 0 && $daysRemaining <= 7)
                    <dd class="text-gray-700 sm:col-span-2">Expire bientôt dans {{ $daysRemaining }} jours.</dd>
                    @elseif($daysRemaining < 0)
                    <dd class="text-gray-700 sm:col-span-2">Ce document est expiré.</dd>
                    @endif
                  </div>
              @endforeach
            </dl>
      </div>
      @endif
    </div>
          {{-- notification close --}}
          </div>
      </div>
      {{-- contet close colse --}}
      {{-- footer --}}
      <div class="p-2 border-2 border-gray-200 border-dashed rounded-lg mt-4">
          @include('layouts.footer')
      </div>
  </div>
</x-app-layout>