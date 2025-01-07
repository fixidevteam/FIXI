@props(['subtitle' => ''])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $subtitle ?? '' }} | FIXI+</title>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/faviconplus.ico') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://unpkg.com/flowbite@latest/dist/flowbite.min.js"></script>
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- select 2 --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <style>
        /* Select2 input container */
        .select2-container .select2-selection--single {
            display: flex;
            align-items: center; /* Vertically center the text and (X) button */
            justify-content: space-between; /* Space out the elements */
            width: 100%;
            background-color: #FFF; /* Light gray background */
            border: 1px solid #D1D5DB; /* Light border */
            color: #1F2937; /* Dark text color */
            font-size: 0.875rem; /* Font size */
            border-radius: 0.375rem; /* Rounded corners */
            padding: 1rem 0; /* Adjusted padding to center content */
            transition: all 0.2s ease-in-out; /* Smooth transition for hover/focus states */
        }
    
        /* Select2 input container on focus */
        .select2-container .select2-selection--single:focus {
            border-color: #3B82F6; /* Blue border on focus */
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.4); /* Blue focus ring */
            outline: none; /* Remove default outline */
        }
    
        /* Text inside the select box */
        .select2-container .select2-selection__rendered {
            line-height: 1.5rem; /* Align text vertically */
            font-weight: 400; /* Normal font weight */
            color: #1F2937; /* Text color */
            flex-grow: 1; /* Allow text to take available space */
            text-align: left; /* Ensure text is left-aligned */
        }
    
        /* Placeholder text color */
        .select2-container .select2-selection__rendered[aria-placeholder="true"] {
            color: #111827; /* Dark gray color for placeholder */
        }
    
        /* Dropdown container */
        .select2-container--default .select2-results__option {
            padding: 0.5rem; /* Padding inside the dropdown options */
            font-size: 0.875rem; /* Smaller text size */
            color: #1F2937; /* Text color */
            background-color: #FFFFFF; /* White background */
            transition: background-color 0.2s ease-in-out; /* Smooth background transition */
        }
    
        /* Hover effect on options */
        .select2-container--default .select2-results__option:hover {
            background-color: #E0F2FE; /* Light blue background on hover */
            color: #1F2937; /* Dark text on hover */
        }
    
        /* Selected option highlight */
        .select2-container--default .select2-results__option--highlighted {
            background-color: #3B82F6; /* Blue highlight on selected */
            color: #FFFFFF; /* White text on highlight */
        }
    
        /* Focus effect for the search input */
        .select2-search__field {
            font-size: 0.875rem; /* Text size for search */
            color: #4B5563; /* Gray text for search */
            padding: 0.5rem; /* Padding around search input */
            border-radius: 0.375rem; /* Rounded corners for search input */
            border: 1px solid #D1D5DB; /* Light gray border */
            background-color: #F9FAFB; /* Light background */
            margin-bottom: 5px; /* Space below search input */
            transition: all 0.2s ease-in-out; /* Smooth transition */
        }
    
        /* Focus effect on the search input */
        .select2-search__field:focus {
            border-color: #3B82F6; /* Blue border when focused */
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.4); /* Blue focus ring */
            outline: none; /* Remove default outline */
        }
    
        /* Clear button style */
        .select2-container .select2-selection__clear {
            color: #3B82F6; /* Blue color for clear button */
            font-size: 1.25rem; /* Clear button size */
            transition: color 0.2s ease-in-out; /* Smooth transition */
            padding-left: 8px; /* Space between text and (X) */
        }
    
        /* Clear button hover effect */
        .select2-container .select2-selection__clear:hover {
            color: #2563EB; /* Darker blue on hover */
        }
    </style>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-[#F1F1F1]">
        @include('layouts.n')

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const operationSelect = document.getElementById('operation');
            const newOperationWrapper = document.getElementById('newOperationWrapper');
            const newOperationInput = document.getElementById('new_operation');

            const initialCategorie = document.getElementById('categorie').value;

            if (initialCategorie) {
                loadOperations(initialCategorie); // Load operations based on the initial category
            }

            document.getElementById('categorie').addEventListener('change', function() {
                loadOperations(this.value); // Refresh operations when category changes
            });

            operationSelect.addEventListener('change', function() {
                if (this.value === 'autre') {
                    // Show the custom operation input
                    newOperationWrapper.classList.remove('hidden');
                    newOperationInput.setAttribute('required', 'required');
                } else {
                    // Hide the custom operation input
                    newOperationWrapper.classList.add('hidden');
                    newOperationInput.removeAttribute('required');
                    newOperationInput.value = ''; // Clear the input field
                }

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
                        // Add the static "Autre" option
                        const autreOption = document.createElement('option');
                        autreOption.value = 'autre';
                        autreOption.textContent = 'Autre';
                        if (existingOperationId === 'autre' || existingOperationId === 'Autre') {
                            autreOption.selected = true;
                            newOperationWrapper.classList.remove('hidden');
                        }
                        operationSelect.appendChild(autreOption);

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


        function toggleModal(show) {
            const modal = document.getElementById('confirmationModal');
            if (show) {
                modal.classList.remove('hidden');
            } else {
                modal.classList.add('hidden');
            }
        }

        function toggleDropdown() {
            const dropdownMenu = document.getElementById('dropdown-menu');
            dropdownMenu.classList.toggle('hidden');
        }

        // Close the dropdown if the user clicks outside of it
        window.addEventListener('click', function(event) {
            const dropdownMenu = document.getElementById('dropdown-menu');
            const notificationButton = event.target.closest('button');

            if (!event.target.closest('.relative') && dropdownMenu && !notificationButton) {
                dropdownMenu.classList.add('hidden');
            }
        });
    </script>
</body>

</html>