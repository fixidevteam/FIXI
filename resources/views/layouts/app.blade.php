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
    <div class="min-h-screen bg-[#F9FAFB]">
        @include('layouts.n')
        <!-- Page Heading -->
        {{-- @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
    </div>
    </header>
    @endif --}}

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>
    </div>
    <script>
        document.getElementById('categorie').addEventListener('change', function() {
            const categorieId = this.value;
            if (categorieId) {
                fetch(`/api/operations/${categorieId}`)
                    .then(response => response.json())
                    .then(data => {
                        const operationSelect = document.getElementById('operation');
                        operationSelect.innerHTML = '<option value="">Select Operation</option>';
                        data.forEach(operation => {
                            const option = document.createElement('option');
                            option.value = operation.id;
                            option.textContent = operation.nom_operation;
                            operationSelect.appendChild(option);
                        });
                        operationSelect.disabled = false;
                        document.getElementById('sousOperation').disabled = true;
                    });
            }
        });

        document.getElementById('operation').addEventListener('change', function() {
            const operationId = this.value;
            if (operationId) {
                fetch(`/api/sous-operations/${operationId}`)
                    .then(response => response.json())
                    .then(data => {
                        const sousOperationContainer = document.getElementById('sousOperationCheckboxes');
                        sousOperationContainer.innerHTML = ""; // Clear existing checkboxes

                        // Check if there are any sousOperations before adding the <p> element
                        if (data.length > 0) {
                            // Create and add the <p> element
                            const p = document.createElement('p');
                            p.textContent = 'Sous opération'; // Set the text content here
                            p.className = 'block text-sm font-medium leading-6 text-gray-900';
                            sousOperationContainer.appendChild(p); // Append <p> at the top of the container

                            // Loop through each sousOperation and create a checkbox with a label
                            data.forEach(sousOperation => {
                                const checkbox = document.createElement('input');
                                checkbox.type = 'checkbox';
                                checkbox.id = `sousOperation_${sousOperation.id}`;
                                checkbox.name = 'sousOperations[]';
                                checkbox.value = sousOperation.id;
                                checkbox.className = 'w-4 h-4 text-black border-gray-300 rounded focus:ring-blue-500 focus:ring-2';

                                const label = document.createElement('label');
                                label.htmlFor = `sousOperation_${sousOperation.id}`;
                                label.textContent = sousOperation.nom_sous_operation;
                                label.className = 'ms-2 text-gray-900 text-sm font-medium';

                                const checkboxWrapper = document.createElement('div');
                                checkboxWrapper.appendChild(checkbox);
                                checkboxWrapper.appendChild(label);

                                sousOperationContainer.appendChild(checkboxWrapper); // Append each checkbox and label to the container
                            });
                        }
                    });
            }
        });

        function toggleModal(show) {
            const modal = document.getElementById('confirmationModal');
            if (show) {
                modal.classList.remove('hidden');
            } else {
                modal.classList.add('hidden');
            }
        }
    </script>
</body>

</html>