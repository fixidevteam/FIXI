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