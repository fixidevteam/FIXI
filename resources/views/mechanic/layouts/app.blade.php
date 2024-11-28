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
        @include('mechanic.layouts.n')
        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const initialCategorie = document.getElementById('categorie').value;

            if (initialCategorie) {
                loadOperations(initialCategorie); // Load operations based on the initial category
            }

            document.getElementById('categorie').addEventListener('change', function() {
                loadOperations(this.value); // Refresh operations when category changes
            });

            document.getElementById('operation').addEventListener('change', function() {
                if (this.value) {
                    loadsousOperations(this.value); // Load sous-operations when an operation is selected
                } else {
                    clearSousOperations(); // Clear checkboxes if no operation is selected
                }
            });
        });

        function loadOperations(categorieId) {
            const existingOperationElement = document.getElementById('existingOperationId');
            const existingOperationId = existingOperationElement ? existingOperationElement.value : "";

            if (categorieId) {
                fetch(`/api/operations/${categorieId}`)
                    .then(response => response.json())
                    .then(data => {
                        const operationSelect = document.getElementById('operation');
                        operationSelect.innerHTML = '<option value="">Select operation</option>';

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

                        // Load sous-operations if an operation is selected
                        if (operationSelect.value) {
                            loadsousOperations(operationSelect.value);
                        } else {
                            clearSousOperations();
                        }
                    })
                    .catch(error => console.error("Error loading operations:", error));
            } else {
                clearSousOperations();
            }
        }

        function loadsousOperations(operationId) {
            // Parse existingSousOperations safely and normalize to integers
            const existingSousOperations = JSON.parse(document.getElementById('existingSousOperations')?.value || '[]').map(Number);
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

                                // Mark checkbox as checked if sousOperation.id exists in existingSousOperations
                                if (existingSousOperations.includes(Number(sousOperation.id))) {
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
                    })
                    .catch(error => {
                        console.error("Error loading sous-operations:", error);
                    });
            }
        }

        function clearSousOperations() {
            document.getElementById('sousOperationCheckboxes').innerHTML = ""; // Clear sous-operations container
        }
    </script>
</body>

</html>