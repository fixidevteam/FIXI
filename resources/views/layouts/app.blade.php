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
        window.addEventListener('DOMContentLoaded', () => {
            const initialCategorie = document.getElementById('categorie').value;

            if (initialCategorie) {
                loadOperations(initialCategorie); // Load operations based on the initial category
            }

            document.getElementById('categorie').addEventListener('change', function() {
                loadOperations(this.value); // Refresh operations when category changes
            });

            document.getElementById('operation').addEventListener('change', function() {
                if (this.value) { // Only load sous-operations if an operation is selected
                    loadsousOperations(this.value);
                } else {
                    clearSousOperations(); // Clear checkboxes if no operation is selected
                }
            });
        });

        function loadOperations(categorieId) {
            // Safely access the value of existingOperationId if it exists
            const existingOperationElement = document.getElementById('existingOperationId');
            const existingOperationId = existingOperationElement ? existingOperationElement.value : "";

            if (categorieId) {
                fetch(`/api/operations/${categorieId}`)
                    .then(response => {
                        if (!response.ok) throw new Error("Failed to fetch operations");
                        return response.json();
                    })
                    .then(data => {
                        const operationSelect = document.getElementById('operation');
                        operationSelect.innerHTML = '<option value="">Select Operation</option>'; // Clear current options

                        data.forEach(operation => {
                            const option = document.createElement('option');
                            option.value = operation.id;
                            option.textContent = operation.nom_operation;

                            // Auto-select the existing operation if it matches
                            if (operation.id == existingOperationId) {
                                option.selected = true;
                            }

                            operationSelect.appendChild(option);
                        });

                        // Load sous operations if an operation is selected
                        if (operationSelect.value) {
                            loadsousOperations(operationSelect.value);
                        } else {
                            clearSousOperations(); // Clear sous-operations if no operation is selected
                        }
                    })
                    .catch(error => {
                        console.error("Error loading operations:", error); // Log errors
                    });
            } else {
                clearSousOperations(); // Clear sous-operations if no category selected
            }
        }

        function loadsousOperations(operationId) {
            const existingSousOperations = JSON.parse(document.getElementById('existingSousOperations')?.value || '[]');
            const sousOperationContainer = document.getElementById('sousOperationCheckboxes');
            sousOperationContainer.innerHTML = ""; // Clear existing checkboxes

            if (operationId) {
                fetch(`/api/sous-operations/${operationId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.length > 0) {
                            const p = document.createElement('p');
                            p.textContent = 'Sous opération';
                            p.className = 'block text-sm font-medium leading-6 text-gray-900';
                            sousOperationContainer.appendChild(p);

                            data.forEach(sousOperation => {
                                const checkbox = document.createElement('input');
                                checkbox.type = 'checkbox';
                                checkbox.id = `sousOperation_${sousOperation.id}`;
                                checkbox.name = 'sousOperations[]';
                                checkbox.value = sousOperation.id;
                                checkbox.className = 'w-4 h-4 text-black border-gray-300 rounded focus:ring-blue-500 focus:ring-2';

                                if (existingSousOperations.includes(sousOperation.id)) {
                                    checkbox.checked = true;
                                }

                                const label = document.createElement('label');
                                label.htmlFor = `sousOperation_${sousOperation.id}`;
                                label.textContent = sousOperation.nom_sous_operation;
                                label.className = 'ms-2 text-gray-900 text-sm font-medium';

                                const checkboxWrapper = document.createElement('div');
                                checkboxWrapper.appendChild(checkbox);
                                checkboxWrapper.appendChild(label);

                                sousOperationContainer.appendChild(checkboxWrapper);
                            });
                        }
                    });
            }
        }

        function clearSousOperations() {
            document.getElementById('sousOperationCheckboxes').innerHTML = ""; // Clear checkboxes
        }


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