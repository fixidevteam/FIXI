<x-app-layout>
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg mt-14">
            {{-- content (slot on layouts/app.blade.php)--}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                <p> {{ __("You're logged in!") }}
                    {{ Auth::user()->name }}
                </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


