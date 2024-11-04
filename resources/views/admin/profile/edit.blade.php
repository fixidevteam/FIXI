<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="mt-2">
        <div class="sm:ml-64">
            <div class="py-16">
                {{-- profile info --}}
                <div class="sm:mx-2 p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('admin.profile.partials.update-profile-information-form')
                    </div>
                </div>
                {{-- profile info close --}}
                {{-- update pass --}}
                <div class="sm:mx-2 my-4 p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('admin.profile.partials.update-password-form')
                    </div>
                </div>
                {{-- update pass close--}}
                {{-- delete acc  --}}
                <div class="sm:mx-2 p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('admin.profile.partials.delete-user-form')
                    </div>
                </div>
                {{-- delete acc close --}}
            </div>
        </div>
    </div>
</x-admin-app-layout>
