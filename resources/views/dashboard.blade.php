<x-app-layout>
    <div class="p-4 sm:ml-64">
        <div class="p-2 border-2 border-gray-200 border-dashed rounded-lg mt-14">
            {{-- content (slot on layouts/app.blade.php)--}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-lg font-medium text-gray-900">Good Morning, {{ Auth::user()->name }} </h1>
                    <p class="mt-1 text-sm text-gray-600">Lorem ipsum dolor sit amet consectetur adipisicing elit <br> Ad adipisci in repellendus sunt aspernatur qui incidunt </p>
                    <div class="mt-4">
                      <a href="#">
                        <x-primary-button>Add car</x-primary-button>
                      </a>
                    </div>
                </div>
            </div>
        </div>
        {{-- content --}}
        <div class="p-2 border-2 border-gray-200 border-dashed rounded-lg mt-4">
            {{-- content (slot on layouts/app.blade.php)--}}
            <div>
                <div>
                    <div class="w-full grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
                        {{-- box 1 --}}
                        <div class="flex items-center bg-white p-8 rounded-lg shadow">
                            <div class="flex-shrink-0">
                              <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">2,340</span>
                              <h3 class="text-base font-normal text-gray-500">New products this week</h3>
                            </div>
                            <div class="ml-5 w-0 flex items-center justify-end flex-1 text-green-500 text-base font-bold">
                              14.6%
                              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                  d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z"
                                  clip-rule="evenodd"></path>
                              </svg>
                            </div>
                          </div>
                          {{-- box 2 --}}
                          <div class="flex items-center bg-white p-8 rounded-lg shadow">
                            <div class="flex-shrink-0">
                              <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">2,340</span>
                              <h3 class="text-base font-normal text-gray-500">New products this week</h3>
                            </div>
                            <div class="ml-5 w-0 flex items-center justify-end flex-1 text-green-500 text-base font-bold">
                              14.6%
                              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                  d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z"
                                  clip-rule="evenodd"></path>
                              </svg>
                            </div>
                          </div>
                          {{-- box 3 --}}
                          <div class="flex items-center bg-white p-8 rounded-lg shadow">
                            <div class="flex-shrink-0">
                              <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">2,340</span>
                              <h3 class="text-base font-normal text-gray-500">New products this week</h3>
                            </div>
                            <div class="ml-5 w-0 flex items-center justify-end flex-1 text-green-500 text-base font-bold">
                              14.6%
                              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                  d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z"
                                  clip-rule="evenodd"></path>
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
                              <h3 class="text-xl font-bold leading-none text-gray-900">Latest Customers</h3>
                              <a href="#" class="text-sm font-medium text-blue-600 hover:bg-gray-100 rounded-lg inline-flex items-center p-2">
                                View all
                              </a>
                            </div>
                            <div class="flow-root">
                              <ul role="list" class="divide-y divide-gray-200">
                                <li class="py-3 sm:py-4">
                                  <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                      <img class="h-8 w-8 rounded-full" src="/images/users/neil-sims.png" alt="Neil image">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                      <p class="text-sm font-medium text-gray-900 truncate">
                                        Neil Sims
                                      </p>
                                      <p class="text-sm text-gray-500 truncate">
                                        email@windster.com
                                      </p>
                                    </div>
                                    <div class="inline-flex items-center text-base font-semibold text-gray-900">
                                      $320
                                    </div>
                                  </div>
                                </li>
                                <li class="py-3 sm:py-4">
                                  <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                      <img class="h-8 w-8 rounded-full" src="/images/users/bonnie-green.png" alt="Neil image">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                      <p class="text-sm font-medium text-gray-900 truncate">
                                        Bonnie Green
                                      </p>
                                      <p class="text-sm text-gray-500 truncate">
                                        email@windster.com
                                      </p>
                                    </div>
                                    <div class="inline-flex items-center text-base font-semibold text-gray-900">
                                      $3467
                                    </div>
                                  </div>
                                </li>
                                <li class="py-3 sm:py-4">
                                  <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                      <img class="h-8 w-8 rounded-full" src="/images/users/michael-gough.png" alt="Neil image">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                      <p class="text-sm font-medium text-gray-900 truncate">
                                        Michael Gough
                                      </p>
                                      <p class="text-sm text-gray-500 truncate">
                                        email@windster.com
                                      </p>
                                    </div>
                                    <div class="inline-flex items-center text-base font-semibold text-gray-900">
                                      $67
                                    </div>
                                  </div>
                                </li>
                                <li class="py-3 sm:py-4">
                                  <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                      <img class="h-8 w-8 rounded-full" src="/images/users/thomas-lean.png" alt="Neil image">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                      <p class="text-sm font-medium text-gray-900 truncate">
                                        Thomes Lean
                                      </p>
                                      <p class="text-sm text-gray-500 truncate">
                                        email@windster.com
                                      </p>
                                    </div>
                                    <div class="inline-flex items-center text-base font-semibold text-gray-900">
                                      $2367
                                    </div>
                                  </div>
                                </li>
                                <li class="pt-3 sm:pt-4 pb-0">
                                  <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                      <img class="h-8 w-8 rounded-full" src="/images/users/lana-byrd.png" alt="Neil image">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                      <p class="text-sm font-medium text-gray-900 truncate">
                                        Lana Byrd
                                      </p>
                                      <p class="text-sm text-gray-500 truncate">
                                        email@windster.com
                                      </p>
                                    </div>
                                    <div class="inline-flex items-center text-base font-semibold text-gray-900">
                                      $367
                                    </div>
                                  </div>
                                </li>
                              </ul>
                            </div>
                          </div>
                        {{-- box 1 close --}}
                        {{-- box 2 --}}
                        <div class="bg-white shadow rounded-lg mb-4 p-4 sm:p-6 h-full">
                            <div class="flex items-center justify-between mb-4">
                              <h3 class="text-xl font-bold leading-none text-gray-900">Latest Customers</h3>
                              <a href="#" class="text-sm font-medium text-blue-600 hover:bg-gray-100 rounded-lg inline-flex items-center p-2">
                                View all
                              </a>
                            </div>
                            <div class="flow-root">
                              <ul role="list" class="divide-y divide-gray-200">
                                <li class="py-3 sm:py-4">
                                  <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                      <img class="h-8 w-8 rounded-full" src="/images/users/neil-sims.png" alt="Neil image">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                      <p class="text-sm font-medium text-gray-900 truncate">
                                        Neil Sims
                                      </p>
                                      <p class="text-sm text-gray-500 truncate">
                                        email@windster.com
                                      </p>
                                    </div>
                                    <div class="inline-flex items-center text-base font-semibold text-gray-900">
                                      $320
                                    </div>
                                  </div>
                                </li>
                                <li class="py-3 sm:py-4">
                                  <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                      <img class="h-8 w-8 rounded-full" src="/images/users/bonnie-green.png" alt="Neil image">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                      <p class="text-sm font-medium text-gray-900 truncate">
                                        Bonnie Green
                                      </p>
                                      <p class="text-sm text-gray-500 truncate">
                                        email@windster.com
                                      </p>
                                    </div>
                                    <div class="inline-flex items-center text-base font-semibold text-gray-900">
                                      $3467
                                    </div>
                                  </div>
                                </li>
                                <li class="py-3 sm:py-4">
                                  <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                      <img class="h-8 w-8 rounded-full" src="/images/users/michael-gough.png" alt="Neil image">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                      <p class="text-sm font-medium text-gray-900 truncate">
                                        Michael Gough
                                      </p>
                                      <p class="text-sm text-gray-500 truncate">
                                        email@windster.com
                                      </p>
                                    </div>
                                    <div class="inline-flex items-center text-base font-semibold text-gray-900">
                                      $67
                                    </div>
                                  </div>
                                </li>
                                <li class="py-3 sm:py-4">
                                  <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                      <img class="h-8 w-8 rounded-full" src="/images/users/thomas-lean.png" alt="Neil image">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                      <p class="text-sm font-medium text-gray-900 truncate">
                                        Thomes Lean
                                      </p>
                                      <p class="text-sm text-gray-500 truncate">
                                        email@windster.com
                                      </p>
                                    </div>
                                    <div class="inline-flex items-center text-base font-semibold text-gray-900">
                                      $2367
                                    </div>
                                  </div>
                                </li>
                                <li class="pt-3 sm:pt-4 pb-0">
                                  <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                      <img class="h-8 w-8 rounded-full" src="/images/users/lana-byrd.png" alt="Neil image">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                      <p class="text-sm font-medium text-gray-900 truncate">
                                        Lana Byrd
                                      </p>
                                      <p class="text-sm text-gray-500 truncate">
                                        email@windster.com
                                      </p>
                                    </div>
                                    <div class="inline-flex items-center text-base font-semibold text-gray-900">
                                      $367
                                    </div>
                                  </div>
                                </li>
                              </ul>
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
</x-app-layout>


