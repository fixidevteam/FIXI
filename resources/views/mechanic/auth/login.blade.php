<style>
    #password::-ms-reveal {
        display: none;
    }
</style>
<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Connectez-vous à votre compte</h2>
    <form class="space-y-6" method="POST" action="{{ route('mechanic.login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <div class="mt-2">
                <x-text-input id="email" class="block w-full" type="email" name="email" :value="old('email')" autofocus autocomplete="username" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <div class="flex items-center justify-between">
                <x-input-label for="password" :value="__('Mot de passe')" />
                <div class="text-sm">
                    @if (Route::has('password.request'))
                    <a class="underline text-sm font-semibold text-blue-600 hover:text-blue-500" href="{{ route('password.request') }}">
                        {{ __('Mot de passe oublié ?') }}
                    </a>
                    @endif
                </div>
            </div>
            <div class="mt-2 relative">
                <x-text-input id="password" class="block mt-1 w-full"
                    type="password"
                    name="password"
                    autocomplete="current-password" />
                <button id="toggle-password" type="button" class="absolute inset-y-0 right-3 flex items-center text-gray-400 hover:text-gray-600">
                    <svg id="eye-icon" class="h-5 w-5" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12 8.25C9.92893 8.25 8.25 9.92893 8.25 12C8.25 14.0711 9.92893 15.75 12 15.75C14.0711 15.75 15.75 14.0711 15.75 12C15.75 9.92893 14.0711 8.25 12 8.25ZM9.75 12C9.75 10.7574 10.7574 9.75 12 9.75C13.2426 9.75 14.25 10.7574 14.25 12C14.25 13.2426 13.2426 14.25 12 14.25C10.7574 14.25 9.75 13.2426 9.75 12Z" fill="currentColor" />
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12 3.25C7.48587 3.25 4.44529 5.9542 2.68057 8.24686L2.64874 8.2882C2.24964 8.80653 1.88206 9.28392 1.63269 9.8484C1.36564 10.4529 1.25 11.1117 1.25 12C1.25 12.8883 1.36564 13.5471 1.63269 14.1516C1.88206 14.7161 2.24964 15.1935 2.64875 15.7118L2.68057 15.7531C4.44529 18.0458 7.48587 20.75 12 20.75C16.5141 20.75 19.5547 18.0458 21.3194 15.7531L21.3512 15.7118C21.7504 15.1935 22.1179 14.7161 22.3673 14.1516C22.6344 13.5471 22.75 12.8883 22.75 12C22.75 11.1117 22.6344 10.4529 22.3673 9.8484C22.1179 9.28391 21.7504 8.80652 21.3512 8.28818L21.3194 8.24686C19.5547 5.9542 16.5141 3.25 12 3.25ZM3.86922 9.1618C5.49864 7.04492 8.15036 4.75 12 4.75C15.8496 4.75 18.5014 7.04492 20.1308 9.1618C20.5694 9.73159 20.8263 10.0721 20.9952 10.4545C21.1532 10.812 21.25 11.2489 21.25 12C21.25 12.7511 21.1532 13.188 20.9952 13.5455C20.8263 13.9279 20.5694 14.2684 20.1308 14.8382C18.5014 16.9551 15.8496 19.25 12 19.25C8.15036 19.25 5.49864 16.9551 3.86922 14.8382C3.43064 14.2684 3.17374 13.9279 3.00476 13.5455C2.84684 13.188 2.75 12.7511 2.75 12C2.75 11.2489 2.84684 10.812 3.00476 10.4545C3.17374 10.0721 3.43063 9.73159 3.86922 9.1618Z" fill="currentColor" />
                    </svg>

                </button>
            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-red-600 shadow-sm focus:ring-red-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Rester connecté') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="flex w-full justify-center rounded-[20px] bg-red-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm  focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                {{ __('Se connecter') }}
            </x-primary-button>
        </div>
    </form>
    {{-- <p class="mt-10 text-center text-sm text-gray-500">
        Vous n'avez pas de compte?
        <a href="{{ route('mechanic.register') }}" class="font-semibold leading-6 text-blue-600 hover:text-blue-500">{{ __('Inscrivez-vous') }}</a>
    </p> --}}


    <script>
        document.getElementById('toggle-password').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');

            if (passwordInput.type === 'password') {
                // Switch to text input
                passwordInput.type = 'text';

                // Change to Closed Eye Icon
                eyeIcon.innerHTML = `
                <path fill-rule="evenodd" clip-rule="evenodd" d="M22.2955 6.31064C22.6762 6.4738 22.8526 6.91471 22.6894 7.29543L22 6.99999C22.6894 7.29543 22.6894 7.29543 22.6894 7.29543L22.6887 7.29711L22.6876 7.2996L22.6844 7.30696L22.6738 7.33103C22.6648 7.35117 22.652 7.37938 22.6353 7.41507C22.6021 7.48642 22.5534 7.58774 22.4889 7.71415C22.3601 7.9668 22.1676 8.32067 21.9086 8.73646C21.483 9.4195 20.8725 10.2776 20.062 11.1302L21.0304 12.0985C21.3233 12.3914 21.3233 12.8663 21.0304 13.1592C20.7375 13.4521 20.2626 13.4521 19.9697 13.1592L18.9691 12.1586C18.3094 12.7113 17.5529 13.23 16.6951 13.6562L17.6287 15.091C17.8546 15.4381 17.7563 15.9027 17.4091 16.1286C17.0619 16.3545 16.5973 16.2562 16.3714 15.909L15.2822 14.2351C14.5029 14.4896 13.6591 14.6626 12.75 14.7246V16.5C12.75 16.9142 12.4143 17.25 12 17.25C11.5858 17.25 11.25 16.9142 11.25 16.5V14.7246C10.369 14.6645 9.54922 14.5002 8.78995 14.2584L7.71587 15.9091C7.48997 16.2563 7.02538 16.3546 6.67819 16.1287C6.33101 15.9028 6.23269 15.4382 6.4586 15.091L7.37101 13.6888C6.50663 13.2666 5.74394 12.7502 5.07854 12.1983L4.11756 13.1592C3.82467 13.4521 3.3498 13.4521 3.0569 13.1592C2.76401 12.8663 2.76401 12.3915 3.0569 12.0986L3.98067 11.1748C3.15611 10.3151 2.53537 9.44655 2.10289 8.75466C1.83997 8.33403 1.64472 7.97564 1.514 7.71968C1.4486 7.59162 1.39923 7.48894 1.36549 7.41663C1.34862 7.38047 1.33565 7.35188 1.32654 7.33148L1.31574 7.30709L1.3125 7.29964L1.31142 7.29713L1.31101 7.29618C1.31101 7.29618 1.31069 7.29543 2.00005 6.99999L1.31101 7.29618C1.14784 6.91546 1.32388 6.4738 1.70461 6.31064C2.08502 6.1476 2.52551 6.32354 2.689 6.70361L2.68996 6.70581L2.69603 6.71952C2.70193 6.73271 2.71152 6.7539 2.72485 6.78247C2.75151 6.83963 2.79308 6.92624 2.84989 7.03747C2.96357 7.26009 3.13774 7.58027 3.37485 7.95959C3.85045 8.72047 4.57169 9.70708 5.55573 10.6216C6.42163 11.4263 7.48271 12.1676 8.75177 12.6558C9.70626 13.023 10.7855 13.25 12 13.25C13.2418 13.25 14.3422 13.0128 15.3125 12.6308C16.5739 12.1343 17.6278 11.3882 18.4868 10.582C19.4563 9.67196 20.1669 8.69515 20.6355 7.9432C20.8691 7.5683 21.0407 7.25226 21.1527 7.03266C21.2086 6.92295 21.2496 6.83756 21.2758 6.78124C21.2889 6.75309 21.2984 6.73222 21.3042 6.71923L21.3102 6.70575L21.3107 6.70455M22.2955 6.31064C21.9149 6.14751 21.474 6.32404 21.3107 6.70455Z" fill="currentColor"/>
            `;
            } else {
                // Switch to password input
                passwordInput.type = 'password';

                // Change to Open Eye Icon
                eyeIcon.innerHTML = `
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12 8.25C9.92893 8.25 8.25 9.92893 8.25 12C8.25 14.0711 9.92893 15.75 12 15.75C14.0711 15.75 15.75 14.0711 15.75 12C15.75 9.92893 14.0711 8.25 12 8.25ZM9.75 12C9.75 10.7574 10.7574 9.75 12 9.75C13.2426 9.75 14.25 10.7574 14.25 12C14.25 13.2426 13.2426 14.25 12 14.25C10.7574 14.25 9.75 13.2426 9.75 12Z" fill="currentColor" />
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12 3.25C7.48587 3.25 4.44529 5.9542 2.68057 8.24686L2.64874 8.2882C2.24964 8.80653 1.88206 9.28392 1.63269 9.8484C1.36564 10.4529 1.25 11.1117 1.25 12C1.25 12.8883 1.36564 13.5471 1.63269 14.1516C1.88206 14.7161 2.24964 15.1935 2.64875 15.7118L2.68057 15.7531C4.44529 18.0458 7.48587 20.75 12 20.75C16.5141 20.75 19.5547 18.0458 21.3194 15.7531L21.3512 15.7118C21.7504 15.1935 22.1179 14.7161 22.3673 14.1516C22.6344 13.5471 22.75 12.8883 22.75 12C22.75 11.1117 22.6344 10.4529 22.3673 9.8484C22.1179 9.28391 21.7504 8.80652 21.3512 8.28818L21.3194 8.24686C19.5547 5.9542 16.5141 3.25 12 3.25ZM3.86922 9.1618C5.49864 7.04492 8.15036 4.75 12 4.75C15.8496 4.75 18.5014 7.04492 20.1308 9.1618C20.5694 9.73159 20.8263 10.0721 20.9952 10.4545C21.1532 10.812 21.25 11.2489 21.25 12C21.25 12.7511 21.1532 13.188 20.9952 13.5455C20.8263 13.9279 20.5694 14.2684 20.1308 14.8382C18.5014 16.9551 15.8496 19.25 12 19.25C8.15036 19.25 5.49864 16.9551 3.86922 14.8382C3.43064 14.2684 3.17374 13.9279 3.00476 13.5455C2.84684 13.188 2.75 12.7511 2.75 12C2.75 11.2489 2.84684 10.812 3.00476 10.4545C3.17374 10.0721 3.43063 9.73159 3.86922 9.1618Z" fill="currentColor" />
            `;
            }
        });
    </script>
</x-guest-layout>