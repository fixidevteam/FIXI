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
                              href=""
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
          {{-- alert --}}
          @if (session('success'))
          <div class="fixed top-20 right-4 mb-5 flex justify-end z-10"
          x-data="{ show: true }" 
          x-show="show" 
          x-transition:leave="transition ease-in duration-1000" 
          x-transition:leave-start="opacity-100" 
          x-transition:leave-end="opacity-0" 
          x-init="setTimeout(() => show = false, 3000)" 
          >
              <div role="alert" class="rounded-xl border border-gray-100 bg-white p-4">
                  <div class="flex items-start gap-4">
                  <span class="text-green-600">
                      <svg
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke-width="1.5"
                      stroke="currentColor"
                      class="size-6"
                      >
                      <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                      />
                      </svg>
                  </span>
                  <div class="flex-1">
                      <strong class="block font-medium text-gray-900"> {{ session('success') }} </strong>
                  </div>
                  </div>
              </div>
          </div>
      @endif
      {{-- alert close --}}
          <div class=" px-5 py-3 text-gray-700 bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <h2 class="my-10  text-2xl font-bold leading-9 tracking-tight text-gray-900">Notifications</h2>
          {{-- notifications --}}
          <div>
            <div class="mb-4">
                <a href="{{ route('notifications.markAllAsRead') }}" class="px-4 py-2 mb-2 text-blue-500 hover:text-blue-700 text-sm font-medium">
                    Marquer tout comme lu
                </a>
            </div>

    
            <div class="bg-white shadow rounded-lg">
              @foreach($notifications as $notification)
                <div class="px-4 py-2 border-b {{ $notification->read_at ? 'bg-gray-100' : 'bg-white' }}">
                    {{ $notification->data['message'] }}
                    <small class="text-gray-500 block">{{ $notification->created_at->diffForHumans() }}</small>
                </div>
              @endforeach
            </div>
            <div class="mt-4">
              {{ $notifications->links() }}
            </div>
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