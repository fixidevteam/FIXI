<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-[#F1F1F1]">
        @include('admin.layouts.n')
    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>
    </div>
</body>
<script>
    function toggleModal(show, form) {
        const modal = document.getElementById(form); // Get the modal element by ID
        if (show) {
            modal.classList.remove('hidden'); // Remove 'hidden' to show the modal
        } else {
            modal.classList.add('hidden'); // Add 'hidden' to hide the modal
        }
    }
    function toggleModalDelete(show) {
            const modal = document.getElementById('confirmationModal');
            if (show) {
                modal.classList.remove('hidden');
            } else {
                modal.classList.add('hidden');
            }
    }
</script>

</html>