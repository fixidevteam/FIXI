@props(['disabled' => false])
<style>
    /* Hide the default file input */
    input[type="file"]::-webkit-file-upload-button {
        height: 36px;
        background-color: #1f2937;
        /* Dark gray color */
        color: #ffffff;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 500;
        text-align: center;
        transition: background-color 0.2s ease;
    }
</style>
<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'rounded-md border-0  text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6']) !!}>