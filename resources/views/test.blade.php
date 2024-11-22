<x-app-layout>
    <div class="p-4 sm:ml-64">
        <div class="p-2 border-2 border-gray-200 border-dashed rounded-lg mt-14">

            <div class="mt-4">
                <label for="options" class="block text-sm font-medium text-gray-700">Choose an option</label>
                <div class="relative mt-1">
                    <select id="options" name="options" class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                        <option value="" disabled selected>Select an option</option>
                        <option value="option1">Option 1</option>
                        <option value="option2">Option 2</option>
                        <option value="add-new">Add New</option>
                    </select>
                </div>
            </div>

            <!-- Hidden Input for Adding a New Option -->
            <div id="add-new-option" class="mt-4 hidden">
                <label for="new-option" class="block text-sm font-medium text-gray-700">Add a new option</label>
                <input id="new-option" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Enter new option">
                <button id="save-option" class="mt-2 px-4 py-2  bg-black text-white text-sm font-medium rounded-md  focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Save
                </button>
            </div>


        </div>
    </div>
    <script>
        const selectElement = document.getElementById('options');
        const addNewOptionDiv = document.getElementById('add-new-option');
        const newOptionInput = document.getElementById('new-option');
        const saveOptionButton = document.getElementById('save-option');

        // Show input field when "Add New" is selected
        selectElement.addEventListener('change', function() {
            if (this.value === 'add-new') {
                addNewOptionDiv.classList.remove('hidden');
                newOptionInput.focus();
            } else {
                addNewOptionDiv.classList.add('hidden');
            }
        });

        // Save the new option
        saveOptionButton.addEventListener('click', function() {
            const newOptionValue = newOptionInput.value.trim();
            if (newOptionValue) {
                // Add the new option to the select dropdown
                const newOption = document.createElement('option');
                newOption.value = newOptionValue;
                newOption.textContent = newOptionValue;

                // Insert the new option and select it
                selectElement.insertBefore(newOption, selectElement.querySelector('option[value="add-new"]'));
                selectElement.value = newOptionValue;

                // Clear and hide the "Add New" input
                newOptionInput.value = '';
                addNewOptionDiv.classList.add('hidden');
            } else {
                alert('Please enter a valid option.');
            }
        });
    </script>
</x-app-layout>